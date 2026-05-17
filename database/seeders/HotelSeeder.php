<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = [];

        // 1. Mảng các thương hiệu resort/khách sạn cao cấp tại Việt Nam
        $brands = [
            'Vinpearl Resort & Spa', 'Vinpearl Luxury', 'Mường Thanh Luxury Hotel', 
            'Mường Thanh Grand', 'Mường Thanh Holiday', 'Pullman Hotel & Resort', 
            'Novotel Beach Resort', 'Sheraton Hotel', 'InterContinental Resort', 
            'Sofitel Legend', 'FLC Luxury Resort', 'Saigon Emerald Hotel', 
            'Gami Eco Resort', 'Central Premium Hotel', 'Grand Tourane Hotel', 
            'Silk Path Grand', 'Anantara Resort & Villas', 'Avani Harbour View', 
            'The Cliff Resort', 'Mercure Hotel', 'Victoria Beach Resort'
        ];

        // 2. Danh sách các địa danh du lịch, quận huyện cụ thể thuộc 63 tỉnh thành để sinh dữ liệu phân tán
        $touristDestinations = [
            // Miền Bắc
            ['sub' => 'Sa Pa', 'province' => 'Lào Cai'],
            ['sub' => 'Bắc Hà', 'province' => 'Lào Cai'],
            ['sub' => 'Bãi Cháy', 'province' => 'Quảng Ninh'],
            ['sub' => 'Hòn Gai', 'province' => 'Quảng Ninh'],
            ['sub' => 'Tuần Châu', 'province' => 'Quảng Ninh'],
            ['sub' => 'Cẩm Phả', 'province' => 'Quảng Ninh'],
            ['sub' => 'Vân Đồn', 'province' => 'Quảng Ninh'],
            ['sub' => 'Móng Cái', 'province' => 'Quảng Ninh'],
            ['sub' => 'Hoàn Kiếm', 'province' => 'Hà Nội'],
            ['sub' => 'Ba Đình', 'province' => 'Hà Nội'],
            ['sub' => 'Tây Hồ', 'province' => 'Hà Nội'],
            ['sub' => 'Cầu Giấy', 'province' => 'Hà Nội'],
            ['sub' => 'Đống Đa', 'province' => 'Hà Nội'],
            ['sub' => 'Hai Bà Trưng', 'province' => 'Hà Nội'],
            ['sub' => 'Sóc Sơn', 'province' => 'Hà Nội'],
            ['sub' => 'Đông Anh', 'province' => 'Hà Nội'],
            ['sub' => 'Hoa Lư', 'province' => 'Ninh Bình'],
            ['sub' => 'Tràng An', 'province' => 'Ninh Bình'],
            ['sub' => 'Tam Cốc', 'province' => 'Ninh Bình'],
            ['sub' => 'Cát Bà', 'province' => 'Hải Phòng'],
            ['sub' => 'Đồ Sơn', 'province' => 'Hải Phòng'],
            ['sub' => 'Mai Châu', 'province' => 'Hòa Bình'],
            ['sub' => 'Kim Bôi', 'province' => 'Hòa Bình'],
            ['sub' => 'Mộc Châu', 'province' => 'Sơn La'],
            ['sub' => 'Mù Cang Chải', 'province' => 'Yên Bái'],
            ['sub' => 'Đồng Văn', 'province' => 'Hà Giang'],
            ['sub' => 'Mèo Vạc', 'province' => 'Hà Giang'],
            ['sub' => 'Trùng Khánh', 'province' => 'Cao Bằng'],
            ['sub' => 'Ba Bể', 'province' => 'Bắc Kạn'],
            ['sub' => 'Tam Đảo', 'province' => 'Vĩnh Phúc'],
            ['sub' => 'Đại Lải', 'province' => 'Vĩnh Phúc'],
            
            // Miền Trung
            ['sub' => 'Hải Châu', 'province' => 'Đà Nẵng'],
            ['sub' => 'Thanh Khê', 'province' => 'Đà Nẵng'],
            ['sub' => 'Sơn Trà', 'province' => 'Đà Nẵng'],
            ['sub' => 'Ngũ Hành Sơn', 'province' => 'Đà Nẵng'],
            ['sub' => 'Liên Chiểu', 'province' => 'Đà Nẵng'],
            ['sub' => 'Hội An', 'province' => 'Quảng Nam'],
            ['sub' => 'Điện Bàn', 'province' => 'Quảng Nam'],
            ['sub' => 'Lộc Thọ', 'province' => 'Khánh Hòa'],
            ['sub' => 'Vĩnh Hòa', 'province' => 'Khánh Hòa'],
            ['sub' => 'Cam Ranh', 'province' => 'Khánh Hòa'],
            ['sub' => 'Ninh Hòa', 'province' => 'Khánh Hòa'],
            ['sub' => 'Phan Thiết', 'province' => 'Bình Thuận'],
            ['sub' => 'Mũi Né', 'province' => 'Bình Thuận'],
            ['sub' => 'Quy Nhơn', 'province' => 'Bình Định'],
            ['sub' => 'Nhơn Lý', 'province' => 'Bình Định'],
            ['sub' => 'Tuy Hòa', 'province' => 'Phú Yên'],
            ['sub' => 'Sông Cầu', 'province' => 'Phú Yên'],
            ['sub' => 'Ninh Chữ', 'province' => 'Ninh Thuận'],
            ['sub' => 'Phan Rang', 'province' => 'Ninh Thuận'],
            ['sub' => 'Phong Nha', 'province' => 'Quảng Bình'],
            ['sub' => 'Đồng Hới', 'province' => 'Quảng Bình'],
            ['sub' => 'Vĩnh Linh', 'province' => 'Quảng Trị'],
            ['sub' => 'Lăng Cô', 'province' => 'Thừa Thiên Huế'],
            ['sub' => 'Hương Thủy', 'province' => 'Thừa Thiên Huế'],
            ['sub' => 'Sầm Sơn', 'province' => 'Thanh Hóa'],
            ['sub' => 'Cửa Lò', 'province' => 'Nghệ An'],

            // Tây Nguyên
            ['sub' => 'Phường 1', 'province' => 'Đà Lạt, Lâm Đồng'],
            ['sub' => 'Hồ Tuyền Lâm', 'province' => 'Đà Lạt, Lâm Đồng'],
            ['sub' => 'Buôn Ma Thuột', 'province' => 'Đắk Lắk'],
            ['sub' => 'Pleiku', 'province' => 'Gia Lai'],
            ['sub' => 'Kon Tum', 'province' => 'Kon Tum'],
            ['sub' => 'Gia Nghĩa', 'province' => 'Đắk Nông'],

            // Miền Nam
            ['sub' => 'Quận 1', 'province' => 'TP Hồ Chí Minh'],
            ['sub' => 'Quận 3', 'province' => 'TP Hồ Chí Minh'],
            ['sub' => 'Quận 5', 'province' => 'TP Hồ Chí Minh'],
            ['sub' => 'Quận 7', 'province' => 'TP Hồ Chí Minh'],
            ['sub' => 'Thủ Đức', 'province' => 'TP Hồ Chí Minh'],
            ['sub' => 'Củ Chi', 'province' => 'TP Hồ Chí Minh'],
            ['sub' => 'Phú Quốc', 'province' => 'Kiên Giang'],
            ['sub' => 'Rạch Giá', 'province' => 'Kiên Giang'],
            ['sub' => 'Hà Tiên', 'province' => 'Kiên Giang'],
            ['sub' => 'Vũng Tàu', 'province' => 'Bà Rịa - Vũng Tàu'],
            ['sub' => 'Con Đảo', 'province' => 'Bà Rịa - Vũng Tàu'],
            ['sub' => 'Xuyên Mộc', 'province' => 'Bà Rịa - Vũng Tàu'],
            ['sub' => 'Long Điền', 'province' => 'Bà Rịa - Vũng Tàu'],
            ['sub' => 'Ninh Kiều', 'province' => 'Cần Thơ'],
            ['sub' => 'Cái Răng', 'province' => 'Cần Thơ'],
            ['sub' => 'Thủ Dầu Một', 'province' => 'Bình Dương'],
            ['sub' => 'Dĩ An', 'province' => 'Bình Dương'],
            ['sub' => 'Biên Hòa', 'province' => 'Đồng Nai'],
            ['sub' => 'Long Thành', 'province' => 'Đồng Nai'],
            ['sub' => 'Tây Ninh', 'province' => 'Tây Ninh'],
            ['sub' => 'Châu Đốc', 'province' => 'An Giang'],
            ['sub' => 'Long Xuyên', 'province' => 'An Giang'],
            ['sub' => 'Mỹ Tho', 'province' => 'Tiền Giang'],
            ['sub' => 'Bến Tre', 'province' => 'Bến Tre'],
            ['sub' => 'Vĩnh Long', 'province' => 'Vĩnh Long'],
            ['sub' => 'Cao Lãnh', 'province' => 'Đồng Tháp'],
            ['sub' => 'Sóc Trăng', 'province' => 'Sóc Trăng'],
            ['sub' => 'Bạc Liêu', 'province' => 'Bạc Liêu'],
            ['sub' => 'Cà Mau', 'province' => 'Cà Mau'],
            ['sub' => 'Vị Thanh', 'province' => 'Hậu Giang'],
            ['sub' => 'Trà Vinh', 'province' => 'Trà Vinh'],
            ['sub' => 'Tân An', 'province' => 'Long An'],
            ['sub' => 'Đồng Xoài', 'province' => 'Bình Phước'],
        ];

        // 3. Tiến hành vòng lặp nhân chéo để tạo ra hơn 1000 Record độc nhất
        $counter = 1;
        foreach ($touristDestinations as $dest) {
            foreach ($brands as $index => $brand) {
                // Đổi cách nối chuỗi theo chỉ số vòng lặp để tên khách sạn không bị trùng
                $hotelName = $brand . ' ' . $dest['sub'] . ' (Cơ sở ' . ($index + 1) . ')';
                $location = $dest['sub'] . ', ' . $dest['province'];

                $hotels[] = [
                    'name' => $hotelName,
                    'location' => $location,
                    'address' => 'Số ' . rand(1, 250) . ' Đường Du Lịch, ' . $location, // Sinh thêm số nhà ngẫu nhiên cho thật
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                $counter++;
                
                // Đạt mốc hơn 1000 cái thì dừng lại cho tối ưu bộ nhớ script
                if ($counter > 1100) {
                    break 2;
                }
            }
        }

        // 4. Chèn dữ liệu theo dạng Chunk (chia nhỏ 200 bản ghi mỗi lần chèn) để Laravel không bị quá tải bộ nhớ RAM
        $chunks = array_chunk($hotels, 200);
        foreach ($chunks as $chunk) {
            foreach ($chunk as $hotel) {
                DB::table('hotels')->updateOrInsert(
                    ['name' => $hotel['name']], // Tránh trùng lặp
                    [
                        'location' => $hotel['location'],
                        'address' => $hotel['address'],
                        'created_at' => $hotel['created_at'],
                        'updated_at' => $hotel['updated_at']
                    ]
                );
            }
        }
    }
}