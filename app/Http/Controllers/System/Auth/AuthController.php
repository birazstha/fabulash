<?php

namespace App\Http\Controllers\System\Auth;

use App\Events\ResetPasswordEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPassword;
use App\Rules\CheckPasswordUsage;
use App\Rules\PasswordComplexity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $user, $userPassword;
    public function __construct(User $user, UserPassword $userPassword)
    {
        $this->user = $user;
        $this->userPassword = $userPassword;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validator($request);
        if (Auth::guard('web')->attempt($request->only('username', 'password'), $request->remember)) {
            if (!Auth::user()->is_password_set) {
                $userId = Auth::user()->id;
                Auth::logout();
                return redirect()->route('login.setPasswordForm', ['userId' => $userId]);
            }
            return redirect()->route('home.index');
        }
        return $this->loginFailed();
    }

    public function setPasswordForm(Request $request)
    {
        $userId = $request->userId;
        return view('auth.setPassword', compact('userId'));
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $user =  $this->user->where('id', $request->id)->first();
        $password = Hash::make($request->password);
        if (!isset($user)) {
            if (!isset($user)) {
                flash()->addError('User not found.');
                return redirect()->back();
            }
        }

        //Storing Password in UserPasswords table.
        $this->userPassword->create([
            'user_id' => $request->id,
            'password' => $password
        ]);

        //Update user's password with his new password.
        $user->update([
            'password' => $password,
            'is_password_set' => true
        ]);

        return redirect()->route('login')->with('success', 'Password has been changed.');
    }

    private function validator(Request $request)
    {
        $rules = [
            'username' => 'required|max:191',
            'password' => 'required',
        ];

        $messages = [];

        $request->validate($rules, $messages);
    }


    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->withErrors(['username' => 'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()
            ->route('login.form')
            ->with('status', 'Admin has been logged out!');
    }

    public function forgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {

                $request->validate([
                    'email' => 'required|email|exists:users,email',
                ]);

                $token = generateToken(10);
                $user = $this->user->where('email', $request->email)->first();

                if (isset($user)) {
                    $user->update([
                        'token' => $token,
                        'is_token_expired' => false
                    ]);
                    event(new ResetPasswordEvent($user, $token));
                }
                return redirect()->route('login')->with(['success' => 'A reset link has been sent to your email.']);
            });
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function resetPasswordForm(Request $request, $token)
    {
        $user = $this->getUserByToken($token);
        if (isset($user) && $user->is_token_expired != true) {
            return view('auth.reset-password', ['token' => $token]);
        }
        return view('error.404');
    }

    public function resetPassword(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $request->validate([
                'token' => 'required',
                'password' => ['required', new PasswordComplexity($request->password), new CheckPasswordUsage($request)],
                'confirm_password' => 'required|same:password',
            ]);

            $user = $this->user->where('token', $request->token)->first();

            $hashedPassword = Hash::make($request->password);

            $user->update([
                'password' => $hashedPassword,
                'is_token_expired' => true
            ]);

            $this->userPassword->create([
                'user_id' => $user->id,
                'password' => $hashedPassword,
            ]);


            $count = $user->userPasswords->count();

            if ($count == 5) {
                $oldestPassword = $user->userPasswords()->oldest()->first();
                $oldestPassword->delete();
            }
            return redirect()->route('login')->with(['success' => 'Password has been successfully changed']);
        });
    }

    public function getUserByToken($token)
    {
        return  $this->user->where('token', $token)->first() ?? null;
    }
}
