<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_attendance')->insert([
            [
                'attendance_status' => '出社',
                'created_at' => now(),
            ],
            [
                'attendance_status' => 'リモート',
                'created_at' => now(),
            ],
            [
                'attendance_status' => '退勤',
                'created_at' => now(),
            ],
            [
                'attendance_status' => '出張',
                'created_at' => now(),
            ],
            [
                'attendance_status' => '休暇',
                'created_at' => now(),
            ],
            [
                'attendance_status' => 'なし',
                'created_at' => now(),
            ]
        ]);
    }
}
