<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_user')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'user_id' => $i,
                'group_id' => mt_rand(1, 2),
            ];
        }
        return $data;
    }
}
