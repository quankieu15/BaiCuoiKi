<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // 1. LẤY CHÍNH XÁC DANH MỤC THEO TÊN CŨ CỦA BẠN (KHÔNG ĐỔI TÊN)
            $carCategory = DB::table('categories')->where('name', 'like', '%Thuê xe%')->first();
            $carCategoryId = $carCategory ? $carCategory->id : DB::table('categories')->insertGetId([
                'name' => 'Thuê xe',
                'slug' => Str::slug('Thuê xe'),
                'created_at' => now(), 'updated_at' => now()
            ]);

            $ticketCategory = DB::table('categories')->where('name', 'like', '%Vé tham quan%')->first();
            $ticketCategoryId = $ticketCategory ? $ticketCategory->id : DB::table('categories')->insertGetId([
                'name' => 'Vé tham quan',
                'slug' => Str::slug('Vé tham quan'),
                'created_at' => now(), 'updated_at' => now()
            ]);

            $tourCategory = DB::table('categories')->where('name', 'like', '%Tour%')->first();
            $tourCategoryId = $tourCategory ? $tourCategory->id : DB::table('categories')->insertGetId([
                'name' => 'Tour du lịch',
                'slug' => Str::slug('Tour du lịch'),
                'created_at' => now(), 'updated_at' => now()
            ]);

            $partnerId = DB::table('users')->where('role', 'partner')->value('id') ?? 1;

            // Dữ liệu xe chuẩn kèm ảnh riêng biệt
            $cars = [
                ['name' => 'Mazda CX-5', 'img' => 'https://images.unsplash.com/photo-1566008889981-be99bf389441?auto=format&fit=crop&w=800&q=80'],
                ['name' => 'Toyota Camry', 'img' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?auto=format&fit=crop&w=800&q=80'],
                ['name' => 'Honda Civic', 'img' => 'https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?auto=format&fit=crop&w=800&q=80']
            ];

            // Dữ liệu tour chuẩn kèm ảnh riêng biệt 
            $tours = [
                ['name' => 'Tour Hạ Long Kỳ Quan Đất Dựng', 'img' => 'https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=800&q=80'],
                ['name' => 'Tour Phú Quốc Đảo Ngọc Nắng Vàng', 'img' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80'],
                ['name' => 'Tour Khám Phá Đà Nẵng - Hội An', 'img' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=800&q=80']
            ];

            // Dữ liệu vé
            $parks = ['VinWonders Phú Quốc', 'Sun World Ba Na Hills', 'VinWonders Nha Trang'];
            $ticketImg = 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=800&q=80';

            $locations = ['Hà Nội', 'TP. Hồ Chí Minh', 'Đà Nẵng', 'Nha Trang', 'Phú Quốc', 'Hạ Long', 'Sapa'];

            $servicesBatch = [];
            $totalRecords = 10000;
            $batchSize = 500;

            $this->command->info("⏳ Đang lặp tạo chuẩn 10,000 dịch vụ...");

            for ($i = 1; $i <= $totalRecords; $i++) {
                $loc = $locations[array_rand($locations)];
                
                // Chia đều chuẩn 3 nhóm dữ liệu độc lập
                if ($i % 3 === 0) {
                    // 1. TOUR
                    $selectedTour = $tours[array_rand($tours)];
                    $title = $selectedTour['name'] . ' ' . rand(2024, 2026);
                    $price = rand(3000000, 10000000);
                    $img = $selectedTour['img'];
                    $categoryId = $tourCategoryId;
                    $description = "<h4>✈️ LỊCH TRÌNH TOUR HẤP DẪN</h4><ul><li>Điểm đến: $loc</li><li>Bao gồm xe đưa đón, ăn uống và khách sạn trọn gói.</li></ul>";
                } elseif ($i % 3 === 1) {
                    // 2. XE
                    $selectedCar = $cars[array_rand($cars)];
                    $title = 'Cho thuê xe tự lái ' . $selectedCar['name'] . ' đời mới ' . rand(2024, 2026);
                    $price = rand(800000, 2000000);
                    $img = $selectedCar['img'];
                    $categoryId = $carCategoryId;
                    $description = "<h4>🚗 QUY ĐỊNH NHẬN XE TỰ LÁI</h4><ul><li>Dòng xe: " . $selectedCar['name'] . "</li><li>Giao xe miễn phí khu vực $loc. Thủ tục cần CCCD.</li></ul>";
                } else {
                    // 3. VÉ
                    $park = $parks[array_rand($parks)];
                    $title = '[Vé Vào Cửa] ' . $park . ' trọn gói vui chơi';
                    $price = rand(500000, 1200000);
                    $img = $ticketImg;
                    $categoryId = $ticketCategoryId;
                    $description = "<h4>🎟️ THÔNG TIN VÉ THAM QUAN</h4><ul><li>Địa điểm: $park</li><li>Quét mã QR code tại cổng vào trực tiếp không cần xếp hàng.</li></ul>";
                }

                $servicesBatch[] = [
                    'category_id' => $categoryId,
                    'user_id'     => $partnerId,
                    'hotel_id'    => null, 
                    'title'       => $title,
                    'price'       => floor($price / 10000) * 10000,
                    'location'    => $loc,
                    'description' => $description,
                    'image'       => $img,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];

                if (count($servicesBatch) === $batchSize || $i === $totalRecords) {
                    DB::table('services')->insert($servicesBatch);
                    $servicesBatch = []; 
                }
            }

            $this->command->info("🎉 Đã tạo xong 10,000 dịch vụ ngay ngắn!");

        } catch (\Exception $e) {
            $this->command->error("❌ Lỗi vòng lặp seeder: " . $e->getMessage());
        }
    }
}