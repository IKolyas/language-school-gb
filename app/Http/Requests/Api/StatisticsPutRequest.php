<?php


namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StatisticsPutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['training_days' => "integer",  'training_days_strike' => "integer", 'max_training_days_strike' => "integer",])]
    public function rules(): array
    {
        return [
            'training_days' => 'required|integer',
            'training_days_strike' => 'required|integer',
            'max_training_days_strike' => 'required|integer',
        ];
    }
}
