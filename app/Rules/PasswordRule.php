<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class PasswordRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $currentPassword = authUser()->password;
        if (!Hash::check($value, $currentPassword)) {
            $fail($this->message());
        }
    }

    public function message()
    {
        return 'The current password is incorrect.';
    }
}
