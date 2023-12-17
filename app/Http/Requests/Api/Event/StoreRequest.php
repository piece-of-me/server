<?php

namespace App\Http\Requests\Api\Event;

use App\Http\Requests\Api\BaseApiFormRequest as FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'header' => 'required|string',
            'text' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле ":attribute" должно обязательно',
            'string' => 'Поле ":attribute" должно быть строкой',
        ];
    }
}
