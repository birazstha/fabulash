<?php

namespace App\Http\Requests\Api;



class CategoryRequest extends ApiFormRequest
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

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['title'] = 'required|string|max:255';
        }
        return $rules;
    }
}
