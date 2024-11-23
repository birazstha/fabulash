<?php

namespace App\Http\Requests\System;

use App\Rules\CheckPasswordUsage;
use App\Rules\PasswordComplexity;
use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'current_password' => ['required', new PasswordRule($request->current_password)],
            'password' => ['required', new PasswordComplexity($request->password), new CheckPasswordUsage($request)],
            'confirm_password' => 'required|same:password',

        ];
    }
}
