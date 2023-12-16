<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiFormRequest as FormRequest;
use App\Models\User;

class LoginRequest extends FormRequest
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
            'login' => ['required', 'string', 'max:' . User::LOGIN_MAX_LENGTH, 'doesnt_start_with:' . implode(',', range(0, 9))],
            'password' => ['required', 'string', 'min:10', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле ":attribute" должно присутствовать',
            'string' => 'Поле ":attribute" должно быть строкой',
            'min' => 'Поле ":attribute" должно быть длиннее :min символов',
            'max' => 'Поле ":attribute" должно быть короче :max символов',
            'doesnt_start_with' => 'Поле ":attribute" не может начинаться с числа',
        ];
    }
}
