<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseApiFormRequest extends FormRequest
{
    protected $stopOnFirstFailure = false;

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => true,
            'result' => [
                'errors' => $validator->errors(),
            ]
        ]));
    }
}
