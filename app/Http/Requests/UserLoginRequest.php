<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['email' => "string",
        'password' => "string"])]
    public function rules(): array
    {
        return [
            'email' => 'required|max:255|email',
            'password' => 'required|max:255'
        ];
    }

    #[ArrayShape(['email.required' => "string",
        'password.required' => "string",
        'email.email' => "string"])]
    public function messages(): array
    {
        return [
            'email.required' => 'Поле email обязательно к заполнению.',
            'password.required'  => 'Поле password обязательно к заполнению.',
            'email.email'  => 'Поле email не прошло валидацию.',
        ];
    }
}
