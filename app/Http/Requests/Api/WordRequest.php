<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class WordRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['word' => "string", 'translation' => "string", 'dictionary_id' => 'integer'])]
    public function rules(): array
    {
        return [
            'word' => 'required|string|max:255',
            'translation' => 'required|string|max:255',
            'dictionary_id' => 'required|integer',
        ];
    }
}
