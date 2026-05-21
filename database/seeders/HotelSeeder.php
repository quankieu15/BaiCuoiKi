<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        // Giữ lại đúng 2 khách sạn làm mẫu theo ý ông
        $hotelsSample = [
            ['Amanoi Resort Vĩnh Hy', 'Ninh Thuận', 35000000, 'Ẩn mình trong vườn quốc gia Núi Chúa, khu nghỉ dưỡng 6 sao đẳng cấp quốc tế với hồ bơi vô cực ngắm trọn vịnh Vĩnh Hy.'],
            ['Six Senses Ninh Van Bay', 'Khánh Hòa', 22000000, 'Biệt thự tựa vách đá biệt lập, có hồ bơi riêng và quản gia phục vụ 24/7, di chuyển hoàn toàn bằng tàu cáp.']
        ];

        foreach ($hotelsSample as $item) {
            // 1. Đổ vào bảng hotels trước
            DB::table('hotels')->updateOrInsert(
                ['name' => $item[0]],
                [
                    'location' => $item[1],
                    'address' => 'Khu vực ' . $item[1] . ', Việt Nam',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            // 2. Bốc ID khách sạn ra để làm khóa ngoại
            $hotelId = DB::table('hotels')->where('name', $item[0])->value('id');

            // 3. Đổ thẳng vào bảng services với danh mục Khách sạn (ID = 5)
            DB::table('services')->updateOrInsert(
                ['title' => 'Villas/Phòng Nghỉ Dưỡng Tại ' . $item[0]],
                [
                    'hotel_id' => $hotelId,
                    'user_id' => 1,         
                    'category_id' => 5, // Danh mục Khách sạn
                    'category' => 'hotel', 
                    'description' => $item[3],
                    'price' => $item[2],
                    'location' => $item[1],
                    'image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}