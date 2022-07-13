<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            WordSeeder::class,
            DictionarySeeder::class,
            SchoolSeeder::class,
            TeacherSeeder::class,
            GroupSeeder::class,
            DictionaryWordSeeder::class,
            DictionaryUserSeeder::class,
            GroupUserSeeder::class,
            RatingSeeder::class,
        ]);
    }
}
