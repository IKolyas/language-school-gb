<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictionaryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dictionary_user')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            for ($k= mt_rand(1, 5); $k >= 1; $k--) {
                $data[] = [
                    'user_id' => $i,
                    'dictionary_id' => $k,
                ];
            }
        }
        return $data;
    }
}
