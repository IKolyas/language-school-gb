<?php

namespace Database\Factories;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DictionaryFactory extends Factory
{
    protected $model = Dictionary::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dictionary_name' => $this->faker->city(),
            'creator_id' => mt_rand(1, 3),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
