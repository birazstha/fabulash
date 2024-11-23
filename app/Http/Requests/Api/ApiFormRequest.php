<?php

// app/Http/Requests/Api/ApiFormRequest.php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class ApiFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, $this->buildApiErrorResponse($validator));
    }

    /**
     * Build the API error response.
     *
     * @param  Validator  $validator
     * @return JsonResponse
     */
    protected function buildApiErrorResponse(Validator $validator)
    {
        return response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422);
    }
}
