<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $category = DB::table('categories')->where('name', 'like', '%Tour%')->first();
        $categoryId = $category ? $category->id : 1;

        $destinations = [
            ['name' => 'Vịnh Hạ Long', 'province' => 'Quảng Ninh', 'img' => 'https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Thị trấn Sa Pa', 'province' => 'Lào Cai', 'img' => 'https://images.unsplash.com/photo-1508873699372-7aeab60b44ab?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Cao nguyên Hà Giang', 'province' => 'Hà Giang', 'img' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Tràng An Ninh Bình', 'province' => 'Ninh Bình', 'img' => 'https://images.unsplash.com/photo-1590523821994-27bc89d81373?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Thủ đô Hà Nội', 'province' => 'Hà Nội', 'img' => 'https://images.unsplash.com/photo-1509060464153-4466739b78d0?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Cầu Vàng Đà Nẵng', 'province' => 'Đà Nẵng', 'img' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Phố cổ Hội An', 'province' => 'Quảng Nam', 'img' => 'https://images.unsplash.com/photo-1569154941061-e231b4725ef1?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Cố đô Huế', 'province' => 'Thừa Thiên Huế', 'img' => 'https://images.unsplash.com/photo-1571167472097-f58c775084f7?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Biển Nha Trang', 'province' => 'Khánh Hòa', 'img' => 'https://images.unsplash.com/photo-1540206351-d6465b3ac5c1?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Thành phố Đà Lạt', 'province' => 'Lâm Đồng', 'img' => 'https://images.unsplash.com/photo-1583212292454-1fe6229603b7?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Đảo Ngọc Phú Quốc', 'province' => 'Kiên Giang', 'img' => 'https://images.unsplash.com/photo-1583212292454-1fe6229603b7?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Biển Vũng Tàu', 'province' => 'Bà Rịa - Vũng Tàu', 'img' => 'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Chợ nổi Cần Thơ', 'province' => 'Cần Thơ', 'img' => 'https://images.unsplash.com/photo-1599708153386-62e2d1626084?auto=format&fit=crop&w=800&q=80'],
        ];

        $packages = [
            [
                'prefix' => 'Tour Xa Xỉ Thượng Lưu: Siêu Nghỉ Dưỡng Tại',
                'price_min' => 15000000, 'price_max' => 32000000,
            ],
            [
                'prefix' => 'Tour Cao Cấp Luxury: Trải Nghiệm Nghỉ Dưỡng Tại',
                'price_min' => 6000000, 'price_max' => 11000000,
            ],
            [
                'prefix' => 'Tour Tiêu Chuẩn Comfort: Khám Phá Danh Thắng',
                'price_min' => 2500000, 'price_max' => 4500000,
            ],
            [
                'prefix' => 'Tour Bình Dân Tiết Kiệm: Phượt Bụi Trải Nghiệm',
                'price_min' => 950000, 'price_max' => 1700000,
            ]
        ];

        $partnerId = DB::table('users')->where('id', '>', 0)->value('id') ?? 1;
        $tourCount = 0;
        $maxTours = 50;

        while ($tourCount < $maxTours) {
            foreach ($destinations as $dest) {
                foreach ($packages as $pack) {
                    if ($tourCount >= $maxTours) break 2;

                    $title = $pack['prefix'] . ' ' . $dest['name'] . ' (3 Ngày 2 Đêm)';
                    $price = rand($pack['price_min'], $pack['price_max']);
                    $price = floor($price / 10000) * 10000;

                    // Lấy ngẫu nhiên 1 khách sạn cùng tỉnh thành để gán vào hotel_id
                    $randomHotelId = DB::table('hotels')
                        ->where('location', 'like', '%' . $dest['province'] . '%')
                        ->inRandomOrder()
                        ->value('id');

                    // Lấy thông tin khách sạn để đưa vào chuỗi mô tả lịch trình
                    $hotelName = DB::table('hotels')->where('id', $randomHotelId)->value('name') ?? 'Khách sạn cao cấp tiêu chuẩn';
                    $hotelAddress = DB::table('hotels')->where('id', $randomHotelId)->value('address') ?? $dest['province'];

                    $fullDescription = "<h4>🌟 ĐIỂM NỔI BẬT CỦA HÀNH TRÌNH</h4>"
                        . "<ul>"
                        . "<li><b>Phương tiện:</b> Xe du lịch đời mới máy lạnh đưa đón trọn gói.</li>"
                        . "<li><b>Lưu trú:</b> Nghỉ dưỡng tại " . $hotelName . " (Địa chỉ: " . $hotelAddress . ").</li>"
                        . "<li><b>Ẩm thực:</b> Trọn gói các bữa ăn đặc sản phong phú mang đậm hương vị vùng miền của " . $dest['name'] . ".</li>"
                        . "</ul>"
                        . "<hr>"
                        . "<h4>📅 LỊCH TRÌNH CHI TIẾT (3 NGÀY 2 ĐÊM)</h4>"
                        . "<div class='timeline'>"
                        . "  <p><b>📍 NGÀY 1: KHỞI HÀNH ĐẾN " . mb_convert_case($dest['name'], MB_CASE_UPPER, "UTF-8") . " - CHECK IN NGHỈ DƯỠNG (Ăn Trưa, Tối)</b></p>"
                        . "  <ul>"
                        . "    <li><b>Sáng:</b> Xe và hướng dẫn viên đón quý khách tại điểm hẹn, khởi hành đi " . $dest['name'] . ". Quý khách ăn sáng nhẹ trên xe và tham gia các trò chơi giao lưu vui nhộn.</li>"
                        . "    <li><b>Trưa:</b> Đến nơi, đoàn dùng bữa trưa tại nhà hàng với các món ăn đặc sản địa phương. Sau đó làm thủ tục nhận phòng tại <b>" . $hotelName . "</b> và nghỉ ngơi.</li>"
                        . "    <li><b>Chiều:</b> Bắt đầu hành trình khám phá biểu tượng du lịch đầu tiên tại " . $dest['name'] . ", tự do chụp hình check-in lưu niệm với những góc máy lung linh nhất.</li>"
                        . "    <li><b>Tối:</b> Thưởng thức bữa tối sang trọng. Tự do dạo chơi phố đi bộ, chợ đêm hoặc tham gia các hoạt động giải trí về đêm.</li>"
                        . "  </ul>"
                        . "  <p><b>📍 NGÀY 2: CHINH PHỤC DANH THẮNG KỲ VĨ - TRẢI NGHIỆM HOẠT ĐỘNG VUI CHƠI (Ăn Sáng, Trưa, Tối)</b></p>"
                        . "  <ul>"
                        . "    <li><b>Sáng:</b> Dùng buffet sáng tại khách sạn. Xe đưa đoàn đi tham quan cụm danh thắng nổi tiếng nhất vùng, lắng nghe hướng dẫn viên thuyết minh về lịch sử, văn hóa bản địa.</li>"
                        . "    <li><b>Trưa:</b> Bữa trưa ngập tràn hải sản tươi ngon hoặc tiệc nướng BBQ đặc sắc.</li>"
                        . "    <li><b>Chiều:</b> Tham gia hoạt động trải nghiệm thực tế (chèo thuyền kayak, đi cáp treo hoặc tắm biển tùy thuộc vào địa danh " . $dest['name'] . ").</li>"
                        . "    <li><b>Tối:</b> Ăn tối tại nhà hàng. Tham gia chương trình Gala Dinner ấm cúng hoặc tự do thưởng thức cafe view ngắm toàn cảnh thành phố từ trên cao.</li>"
                        . "  </ul>"
                        . "  <p><b>📍 NGÀY 3: MUA SẮM ĐẶC SẢN - TẠM BIỆT " . mb_convert_case($dest['name'], MB_CASE_UPPER, "UTF-8") . " (Ăn Sáng, Trưa)</b></p>"
                        . "  <ul>"
                        . "    <li><b>Sáng:</b> Thức dậy đón bình minh, ăn sáng. Xe đưa đoàn ghé thăm các làng nghề truyền thống hoặc trung tâm đặc sản để mua quà lưu niệm cho người thân và gia đình.</li>"
                        . "    <li><b>Trưa:</b> Làm thủ tục trả phòng khách sạn. Đoàn dùng bữa trưa nhẹ nhàng trước khi lên xe quay trở về điểm đón ban đầu.</li>"
                        . "    <li><b>Chiều muộn:</b> Về đến nơi, hướng dẫn viên chia tay và hẹn gặp lại quý khách trong những hành trình tiếp theo!</li>"
                        . "  </ul>"
                        . "</div>";

                    DB::table('services')->insert([
                        'category_id' => $categoryId,
                        'user_id'     => $partnerId,
                        'hotel_id'    => $randomHotelId, // 🔥 ĐÃ FIX: Nhét trực tiếp ID khách sạn vào đây
                        'title'       => $title,
                        'price'       => $price,
                        'location'    => $dest['province'],
                        'description' => $fullDescription,
                        'image'       => $dest['img'],
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);

                    $tourCount++;
                }
            }
        }
    }
}