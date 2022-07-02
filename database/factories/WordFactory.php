<?php

namespace Database\Factories;

use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WordFactory extends Factory
{
    protected $model = Word::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'word' => $this->faker->word(),
            'translation' => $this->faker->word(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
