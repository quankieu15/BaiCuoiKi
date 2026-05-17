<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            HotelSeeder::class,    // Chạy sinh 1000 khách sạn trước
            ServiceSeeder::class,  // Chạy sinh 50 Tour du lịch sau
        ]);
    }
}