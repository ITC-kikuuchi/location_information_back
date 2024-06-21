<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // シードクラスの呼び出し
        $this->call([
            AreaSeeder::class,
            AttendanceSeeder::class,
            UserStatusSeeder::class,
            UserSeeder::class,
        ]);
    }
}
