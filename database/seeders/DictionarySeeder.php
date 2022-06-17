<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DictionarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dictionary::factory(5)->create();
    }
}
