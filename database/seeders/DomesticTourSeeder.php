<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomesticTourSeeder extends Seeder
{
    public function run(): void
    {
        $tours = [
            ['title' => 'Tour Bản Sắc Tây Bắc: Hà Nội - Sapa 3 Ngày 2 Đêm', 'location' => 'Lào Cai', 'price' => 2850000, 'description' => 'Chinh phục đỉnh Fansipan, check-in bản Cát Cát và thưởng thức ẩm thực thắng cố đặc sản.'],
            ['title' => 'Tour Khám Phá Đảo Ngọc Phú Quốc 4 Ngày 3 Đêm', 'location' => 'Kiên Giang', 'price' => 4500000, 'description' => 'Trọn gói vé máy bay, cano lặn ngắm san hô 4 đảo, tham quan cáp treo Hòn Thơm dài nhất thế giới.'],
            ['title' => 'Tour Di Sản Miền Trung: Đà Nẵng - Hội An - Huế 4 Ngày', 'location' => 'Đà Nẵng', 'price' => 3990000, 'description' => 'Tham quan Đại Nội Kinh Thành Huế, Phố cổ Hội An rực rỡ đèn lồng và tắm biển Mỹ Khê.'],
        ];

        foreach ($tours as $item) {
            DB::table('services')->updateOrInsert(
                ['title' => $item['title']],
                [
                    'user_id' => 1,
                    'category_id' => 3, // Tour trong nước
                    'category' => 'domestic_tour',
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'location' => $item['location'],
                    'image' => 'https://images.unsplash.com/photo-1528127269322-539801943592?w=500',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}