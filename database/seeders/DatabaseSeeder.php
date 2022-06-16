<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\Group;
use App\Models\School;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Word;
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
            ]);
        Dictionary::factory(5)->create();
        School::factory(5)->create();
        Teacher::factory(5)->create();
        Group::factory(5)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
