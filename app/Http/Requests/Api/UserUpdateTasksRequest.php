<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UserUpdateTasksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['tasks' => "json"])]
    public function rules(): array
    {
        return [
            'tasks' => 'required|json',
        ];
    }

    #[ArrayShape(['tasks.required' => 'json'])]
    public function messages(): array
    {
        return [
            'tasks.required' => 'Поле :dictionary_name обязательно к заполнению!',
        ];
    }

    #[ArrayShape(['tasks' => "string"])]
    public function attributes(): array
    {
        return [
            'tasks' => 'Tasks',
        ];
    }
}
