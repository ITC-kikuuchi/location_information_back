<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_area')->insert([
            [
                'area_name' => '2F 開発部屋',
                'is_default_area' => true,
                'created_at' => now(),
            ],
            [
                'area_name' => '2F 会議室',
                'is_default_area' => false,
                'created_at' => now(),
            ],
            [
                'area_name' => '1F 開発部屋',
                'is_default_area' => true,
                'created_at' => now(),
            ],
            [
                'area_name' => '1F 会議室',
                'is_default_area' => false,
                'created_at' => now(),
            ],
            [
                'area_name' => '自宅',
                'is_default_area' => true,
                'created_at' => now(),
            ],
            [
                'area_name' => 'なし',
                'is_default_area' => false,
                'created_at' => now(),
            ]
        ]);
    }
}
