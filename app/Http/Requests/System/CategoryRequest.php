<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'required|string|max:255|unique:categories,title',
        ];

        if ($this->isMethod('PUT')) {
            $rules['title'] = 'required|string|max:255';
        }
        return $rules;
    }
}
