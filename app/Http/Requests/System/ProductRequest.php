<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required',
            'title' => 'required|min:3|max:20',
            'short_description' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'integer',
            'rank' => 'integer',
            'status' => 'required|boolean',

        ];
    }
}
