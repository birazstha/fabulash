<?php

namespace App\Http\Requests\System;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'max:255',
            'short_description' => 'max:255',
            'rank' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ];
    }
}
