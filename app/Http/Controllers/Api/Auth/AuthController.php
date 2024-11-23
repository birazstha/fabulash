<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\ProfileCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{

    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->except('confirm_password');
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = 1;
        $this->user->create($data);
        return $this->successResponse();
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Create a token for the authenticated user
            $tokenResult = $user->createToken('MyAppToken');
            return response()->json([
                'data' => [
                    'accessToken' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => $tokenResult->token->expires_at->toDateTimeString(),
                ]
            ], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        dd($user);
        return new ProfileCollection($user);
    }

    public function logout()
    {

        // Get the authenticated user
        $user = Auth::user();



        // Revoke the user's access token
        $user->token()->revoke();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
