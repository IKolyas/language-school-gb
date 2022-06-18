<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictionaryWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dictionary_word')->insert($this->getData());
        DB::table('dictionary_word')->insert($this->getAllWords());
    }

    private function getData(): array
    {
        $data = [];
        for ($i = 1; $i <= 5; $i++) {
            for ($k= mt_rand(1, 10); $k <= 10; $k++) {
                $data[] = [
                    'dictionary_id' => $i,
                    'word_id' => $k,
                ];
            }
        }
        return $data;
    }

    private function getAllWords(): array
    {
        $allWords = [];
        for ($i = 1; $i <= 10; $i++) {
            $allWords[] = [
                    'dictionary_id' => 1,
                    'word_id' => $i,
                ];
        }
        return $allWords;
    }

}
