<?php

namespace Database\Seeders;

use App\Models\Word;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('words')->insert([
            [
                'word' => 'body',
                'translation' => 'тело',
            ],
            [
                'word' => 'boy',
                'translation' => 'мальчик',
            ],
            [
                'word' => 'girl',
                'translation' => 'девочка',
            ],
            [
                'word' => 'day',
                'translation' => 'день',
            ],
            [
                'word' => 'life',
                'translation' => 'жизнь',
            ],
            [
                'word' => 'man',
                'translation' => 'мужчина',
            ],
            [
                'word' => 'woman',
                'translation' => 'женщина',
            ],
            [
                'word' => 'year',
                'translation' => 'год',
            ],
            [
                'word' => 'air',
                'translation' => 'воздух',
            ],
            [
                'word' => 'game',
                'translation' => 'игра',
            ],
        ]);
        Word::factory(10)->create();
    }
}
