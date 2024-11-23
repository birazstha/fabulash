<?php

namespace App\Http\Requests\Api;

use App\Rules\CheckClientId;
use App\Rules\CheckClientSecret;
use Illuminate\Http\Request;

class LoginRequest extends ApiFormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        return [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'clientId' => ['required', new CheckClientId()],
            'clientSecret' => ['required', new CheckClientSecret($request->clientId)]
        ];
    }
}
