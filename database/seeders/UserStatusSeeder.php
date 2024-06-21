<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_user_status')->insert([
            [
                'user_status' => '自席',
                'created_at' => now(),
            ],
            [
                'user_status' => '離席',
                'created_at' => now(),
            ],
            [
                'user_status' => '会議中',
                'created_at' => now(),
            ],
            [
                'user_status' => '外出中',
                'created_at' => now(),
            ],
            [
                'user_status' => 'なし',
                'created_at' => now(),
            ]
        ]);
    }
}
