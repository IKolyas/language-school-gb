<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class DictionaryPostRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['dictionary_name' => "string", 'creator_id' => "integer"])]
    public function rules(): array
    {
        return [
            'dictionary_name' => 'required|unique:dictionaries|string|max:255',
            'creator_id' => 'required|integer',
        ];
    }

    #[ArrayShape(['dictionary_name.required' => "string", 'creator_id.required' => "string", 'creator_id.integer' => 'string'])]
    public function messages(): array
    {
        return [
            'dictionary_name.required' => 'Поле :dictionary_name обязательно к заполнению!',
            'creator_id.required' => 'Поле :creator_id обязательно к заполнению',
            'creator_id.integer' => 'Поле :creator_id должно быть числом',
        ];
    }

    #[ArrayShape(['dictionary_name' => "string", 'creator_id' => "string"])]
    public function attributes(): array
    {
        return [
            'dictionary_name' => 'Название словаря',
            'creator_id' => 'Создатель',
        ];
    }
}
