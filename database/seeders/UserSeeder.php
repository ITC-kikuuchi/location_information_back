<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_user')->insert([
            [
                'mail_address' => 'kikuuchi@itcowork.co.jp',
                'password' => Hash::make('password'),
                'user_name' => '菊内尊雄',
                'user_name_kana' => 'きくうちたかお',
                'default_area_id' => 1,
                'is_admin' => true,
                'attendance_id' => 6,
                'user_status_id' => 5,
                'created_at' => now(),
            ],
        ]);
    }
}
