<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketServiceSeeder extends Seeder
{
    public function run(): void
    {
        $tickets = [
            ['title' => 'Vé Trọn Gói Sun World Ba Na Hills', 'location' => 'Đà Nẵng', 'price' => 900000, 'description' => 'Đã bao gồm vé cáp treo khứ hồi, tham quan Cầu Vàng và vui chơi miễn phí tại Fantasy Park.'],
            ['title' => 'Vé Vui Chơi VinWonders Phú Quốc', 'location' => 'Kiên Giang', 'price' => 950000, 'description' => 'Khám phá công viên chủ đề lớn nhất Việt Nam với hàng trăm trò chơi cảm giác mạnh và show diễn triệu đô.'],
            ['title' => 'Vé Tham Quan Ký Ức Hội An - Hạng ECO', 'location' => 'Quảng Nam', 'price' => 600000, 'description' => 'Thưởng thức show diễn thực cảnh đẹp nhất thế giới, tái hiện 400 năm lịch sử thương cảng Hội An.'],
        ];

        foreach ($tickets as $item) {
            DB::table('services')->updateOrInsert(
                ['title' => $item['title']],
                [
                    'user_id' => 1,
                    'category_id' => 2, // Vé tham quan
                    'category' => 'ticket',
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'location' => $item['location'],
                    'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=500',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}