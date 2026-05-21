<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InternationalTourSeeder extends Seeder
{
    public function run(): void
    {
        $tours = [
            ['title' => 'Tour Khám Phá Đảo Quốc Sư Tử Singapore 4 Ngày 3 Đêm', 'location' => 'Singapore', 'price' => 11990000, 'description' => 'Check-in Marina Bay Sands, công viên Gardens by the Bay và hòn đảo vui chơi giải trí Sentosa.'],
            ['title' => 'Tour Hàn Quốc Mùa Hoa Anh Đào: Seoul - Nami 5 Ngày', 'location' => 'Hàn Quốc', 'price' => 16500000, 'description' => 'Trải nghiệm mặc Hanbok tham quan cung điện Gyeongbokgung, check-in đảo Nami thơ mộng.'],
            ['title' => 'Tour Trải Nghiệm Nhật Bản: Tokyo - Núi Phú Sĩ - Kyoto 6 Ngày', 'location' => 'Nhật Bản', 'price' => 28900000, 'description' => 'Khám phá thủ đô Tokyo sầm uất, ngắm núi Phú Sĩ hùng vĩ và trải nghiệm tàu siêu tốc Shinkansen.'],
        ];

        foreach ($tours as $item) {
            DB::table('services')->updateOrInsert(
                ['title' => $item['title']],
                [
                    'user_id' => 1,
                    'category_id' => 4, // Tour quốc tế
                    'category' => 'international_tour',
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'location' => $item['location'],
                    'image' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=500',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}