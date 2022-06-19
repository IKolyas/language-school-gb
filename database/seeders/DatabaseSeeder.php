<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\Group;
use App\Models\School;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
