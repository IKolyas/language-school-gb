<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ratings')->insert([
            [
                'word_id' => '2',
                'user_id' => '3',
                'rating' => '3',
            ],
            [
                'word_id' => '3',
                'user_id' => '3',
                'rating' => '3',
            ],
            [
                'word_id' => '4',
                'user_id' => '3',
                'rating' => '3',
            ],
            [
                'word_id' => '5',
                'user_id' => '3',
                'rating' => '3',
            ],
            [
                'word_id' => '6',
                'user_id' => '3',
                'rating' => '3',
            ],
            [
                'word_id' => '7',
                'user_id' => '3',
                'rating' => '0',
            ],
            [
                'word_id' => '8',
                'user_id' => '3',
                'rating' => '0',
            ],
            [
                'word_id' => '9',
                'user_id' => '3',
                'rating' => '3',
            ],
            [
                'word_id' => '10',
                'user_id' => '3',
                'rating' => '0',
            ],
            [
                'word_id' => '4',
                'user_id' => '2',
                'rating' => '2',
            ],
            [
                'word_id' => '5',
                'user_id' => '2',
                'rating' => '2',
            ],
            [
                'word_id' => '6',
                'user_id' => '2',
                'rating' => '2',
            ],
            [
                'word_id' => '7',
                'user_id' => '2',
                'rating' => '2',
            ],
            [
                'word_id' => '7',
                'user_id' => '1',
                'rating' => '1',
            ],
        ]);
    }
}
