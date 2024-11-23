<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CheckPasswordUsage implements Rule
{
    protected $value, $errorMessage = 'The :attribute is invalid.'; // Default message

    public function __construct($value)
    {
        $this->value = $value; // Store the passed value
    }

    public function passes($attribute, $value)
    {
        if (request()->segment(2) == 'reset-password') {
            $user = User::where('token', $this->value->token)->first();
        } else {
            $user = authUser();
        }

        $oldPasswords = $user->userPasswords; // Assuming userPasswords relation exists

        $check = false;
        foreach ($oldPasswords as $oldPassword) {
            if (Hash::check($this->value->password, $oldPassword->password)) {
                $check = true;
            }
        }

        if ($check) {
            $this->errorMessage = 'The :attribute must not match a previously used password.';
            return false;
        }
      

        return true;
    }


    public function message()
    {
        return $this->errorMessage;
    }
}
