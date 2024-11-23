<?php

namespace App\Http\Controllers\System\Profile;

use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Http\Request;
use App\Events\ResetPasswordEvent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Services\System\Role\RoleService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\System\PasswordRequest;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    protected $roleService, $staff, $user, $userPasswords;
    public function __construct(RoleService $roleService, UserPassword $userPassword, User $user)
    {
        $this->roleService = $roleService;
        $this->userPasswords = $userPassword;
        $this->user = $user;
    }
    public function viewProfile()
    {

        $data = [
            'item' => $this->getUserDetail()
        ];
        $data['indexUrl'] = 'profile';
        $data['indexUrl'] = 'profile';
        $data['moduleName'] = 'Profile';
        $data['breadCrumb'] =  $this->breadCrumbForIndex();
        return view('system.profile.show', $data);
    }

    public function getUserDetail()
    {
        return User::where('id', authUser()->id)->first();
    }

    public function breadCrumbForIndex()
    {
        $breadCrumb = [
            $this->baseBreadCrumb(),
            [
                'title' => 'Profile',
            ]
        ];
        return $breadCrumb;
    }

    public function breadCrumbForForm()
    {
        $breadCrumb = [
            $this->baseBreadCrumb(),
            [
                'title' => 'Profile',
                'link' => 'system/profile',
                'active' => true
            ],
            [
                'title' => 'Update',
                'link' => 'profile',
                'link' => 'profile',
            ]
        ];
        return $breadCrumb;
    }

    public function breadCrumbForPassword()
    {
        $breadCrumb = [
            $this->baseBreadCrumb(),
            [
                'title' => 'Profile',
                'link' => 'my-profile',
                'active' => true
            ],
            [
                'title' => 'Password',
            ]
        ];
        return $breadCrumb;
    }

    public function baseBreadCrumb()
    {
        return [
            'title' => 'Dashboard',
            'link' =>  'home.index',
            'active' => true
        ];
    }

    public function updateProfileForm()
    {
        $data = [
            'item' => $this->getUserDetail()
        ];
        $data['indexUrl'] = 'profile';
        $data['moduleName'] = 'Profile';
        $data['breadCrumb'] =  $this->breadCrumbForForm();

        $data['gender'] = [
            ['value' => 1, 'label' => 'Male'],
            ['value' => 0, 'label' => 'Female'],
        ];

        return view('system.profile.profile-form', $data);
    }

    public function updateProfile(Request $request)
    {
        $rules = [
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore(authUser()->id), // Exclude current record by ID
            ],
            'contact_number' => 'min:0|max:10',
        ];
        $request->validate($rules);
        $user = $this->getUserDetail();
        $data = $request->except('_token', 'password', 'role_id', 'status');
        $user->update($data);
        return redirect()->route('profile')->with(['success' => 'Profile has been updated']);
    }

    public function updatePasswordForm()
    {
        $data['moduleName'] = 'Profile';
        $data['breadCrumb'] =  $this->breadCrumbForPassword();
        return view('system.profile.change-password', $data);
    }

    public function updatePassword(PasswordRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $user = $this->user->find(authUser()->id);
            $hashedPassword = Hash::make($request->password);

            $user->update([
                'password' => $hashedPassword,
                'is_password_change' => true
            ]);

            $this->userPasswords->create([
                'user_id' => $user->id,
                'password' => $hashedPassword
            ]);

            $count = $user->userPasswords->count();

            if ($count == 5) {
                $oldestPassword = $user->userPasswords()->oldest()->first();
                $oldestPassword->delete();
            }
            return redirect()->route('profile')->with(['success' => 'Password has been changed successfully.']);
        });
    }

    public function setResetPassword($request)
    {
        try {
            $user = $this->user->where('id', authUser()->id)->first();
            $user->update([
                'password' => $request->new_password,
            ]);
            return redirect()->back()->with(['success' => 'Password has been updated successfully.']);
        } catch (\Exception $e) {
            dd($e);
            // throw new CustomGenericException($e->getMessage());
        }
    }



    public function checkIfPasswordIsCorrect($user, $request)
    {
        if (Hash::check($request->current_password, $user->password)) {
            return true;
        } else {
            return false;
        }
    }




    public function forgotPasswordForm()
    {
        return view('system.profile.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $token = generateToken(10);
            $user = $this->user->where('email', $request->email)->first();

            if (isset($user)) {
                $user->update([
                    'token' => $token,
                    'is_token_expired' => false
                ]);
                event(new ResetPasswordEvent($user, $token));
            } else {
                return redirect()->back()->withErrors(['email' => "Email doesn't exist in our system."])->withInput();
            }

            return redirect()->back()->with(['success' => 'A reset link has been sent to your email.']);
        });
    }

    public function resetPasswordForm(Request $request, $token)
    {
        $user = $this->getUserByToken($token);


        if (isset($user) && $user->is_token_expired != true) {
            return view('system.profile.reset-password', ['token' => $token]);
        }
        return view('system.errors.404');
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password|min:5',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = $this->user->where('token', $request->token)->first() ?? $this->staff->where('token', $request->token)->first();

        $user->update([
            'password' => Hash::make($request->password),
            'is_token_expired' => true
        ]);

        return redirect()->route('login')->with(['success' => 'Password has been successfully changed']);
    }

    public function getUserByToken($token)
    {
        return  $this->user->where('token', $token)->first() ?? null;
    }
}
