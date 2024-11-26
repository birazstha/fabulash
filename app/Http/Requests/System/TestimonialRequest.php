<?php

namespace App\Http\Requests\System;

use App\Models\Partner;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'words' => 'required|min:6|max:255',
            'name' => 'required|min:2|max:255',
            'post' => 'nullable|max:255',
            'company' => 'nullable|max:255',
            'status' => 'required|boolean',
            'rank' => 'required|integer',
        ];
    }
}
