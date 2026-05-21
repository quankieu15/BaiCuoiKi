<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarServiceSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            ['title' => 'Thuê Xe Tự Lái VinFast VF8 Hạng Sang', 'location' => 'Hà Nội', 'price' => 1200000, 'description' => 'Xe điện đời mới sạch sẽ, giao xe tận nơi, bảo hiểm đầy đủ.'],
            ['title' => 'Thuê Xe 7 Chỗ Toyota Fortuner Có Tài Xế', 'location' => 'TP Hồ Chí Minh', 'price' => 1800000, 'description' => 'Tài xế lịch sự, rành đường, phục vụ đưa đón sân bay hoặc đi tỉnh.'],
            ['title' => 'Thuê Xe Cưới Mercedes C200 Mui Trần', 'location' => 'Đà Nẵng', 'price' => 3500000, 'description' => 'Xe hoa sang trọng, đã bao gồm kết hoa tươi cao cấp và tài xế phục vụ cưới hỏi.'],
        ];

        foreach ($cars as $item) {
            DB::table('services')->updateOrInsert(
                ['title' => $item['title']],
                [
                    'user_id' => 1,
                    'category_id' => 1, // Thuê xe
                    'category' => 'car',
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'location' => $item['location'],
                    'image' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=500',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}