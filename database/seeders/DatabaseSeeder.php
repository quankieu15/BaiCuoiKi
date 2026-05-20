<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Nhớ thêm dòng này để dùng DB class

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

        // 🔥 BƠM CỨNG 1 ĐƠN HÀNG ẢO VÀO DATABASE ĐỂ ADMIN CÓ DỮ LIỆU ĐỂ HIỂN THỊ:
        DB::table('orders')->insert([
            'user_id' => 1, // ID của tài khoản customer hoặc admin trong bảng users
            'service_id' => 1, // ID của dịch vụ đầu tiên trong bảng services
            'quantity' => 2,
            'total_price' => 500000,
            'status' => 'pending', // Trạng thái chờ Admin duyệt
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}