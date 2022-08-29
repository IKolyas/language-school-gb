<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'lastname' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Misha',
                'lastname' => 'Cheglok',
                'email' => 'cheglokm@yandex.ru',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'User',
                'lastname' => 'User',
                'email' => 'user@user.com',
                'password' => Hash::make('password'),
            ]]);

        User::factory(10)->create();
    }

}
