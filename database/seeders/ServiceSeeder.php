<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [];

        // ==========================================
        // PHÂN KHÚC 1: SIÊU SANG CHẢNH / KHÁCH SẠN 5-6 SAO (20 cái)
        // Giá từ: 10,000,000 đ - 50,000,000 đ
        // ==========================================
        $luxury = [
            ['Amanoi Resort Vĩnh Hy', 'Ninh Thuận', 35000000, 'Ẩn mình trong vườn quốc gia Núi Chúa, khu nghỉ dưỡng 6 sao đẳng cấp quốc tế với hồ bơi vô cực ngắm trọn vịnh Vĩnh Hy.'],
            ['Six Senses Ninh Van Bay', 'Khánh Hòa', 22000000, 'Biệt thự tựa vách đá biệt lập, có hồ bơi riêng và quản gia phục vụ 24/7, di chuyển hoàn toàn bằng tàu cáp.'],
            ['InterContinental Danang Sun Peninsula Resort', 'Đà Nẵng', 18000000, 'Tuyệt tác kiến trúc của Bill Bensley trên bán đảo Sơn Trà, nơi giao thoa giữa văn hóa bản địa và sự xa hoa.'],
            ['Regent Phu Quoc', 'Kiên Giang', 15000000, 'Khu nghỉ dưỡng sang trọng bậc nhất đảo ngọc với thiết kế hồ bơi vô cực trên cao và dịch vụ chuẩn thượng lưu.'],
            ['Four Seasons Resort The Nam Hai', 'Quảng Nam', 20000000, 'Nằm dọc bãi biển Hà My thơ mộng, mang thiết kế villa phong thủy tinh tế và không gian tĩnh lặng tuyệt đối.'],
            ['Zannier Hotels Bãi San Hô', 'Phú Yên', 14500000, 'Khu nghỉ dưỡng biệt lập bảo tồn thiên nhiên hoang sơ, thiết kế lấy cảm hứng từ làng chài truyền thống Việt Nam.'],
            ['Capella Hanoi', 'Hà Nội', 13000000, 'Khách sạn boutique tái hiện nhà hát Opera thời hoàng kim những năm 1920 ngay trung tâm thủ đô.'],
            ['JW Marriott Phu Quoc Emerald Bay Resort', 'Kiên Giang', 11000000, 'Mô hình trường đại học giả tưởng độc đáo bên bãi Khem, rực rỡ sắc màu và góc check-in triệu đô.'],
            ['Anantara Quy Nhon Villas', 'Bình Định', 16000000, 'Chỉ gồm 26 căn biệt thự hướng biển biệt lập, hồ bơi riêng, bồn tắm đá nguyên khối sang trọng.'],
            ['Banyan Tree Lăng Cô', 'Thừa Thiên Huế', 12500000, 'Biệt thự sân vườn và hồ bơi riêng biệt lập giữa vịnh biển Lăng Cô hoang sơ và núi non hùng vĩ.'],
            ['The Reverie Saigon', 'TP Hồ Chí Minh', 12000000, 'Khách sạn hoàng gia xa hoa bậc nhất Sài Thành với nội thất dát vàng phong cách Ý thượng lưu.'],
            ['Azerai Ke Ga Bay', 'Bình Thuận', 10500000, 'Khu nghỉ dưỡng yên bình hướng tầm nhìn ra hải đăng Kê Gà cổ kính, kiến trúc tối giản tinh tế.'],
            ['Topas Ecolodge', 'Lào Cai', 10000000, 'Khu nghỉ dưỡng sinh thái nằm trên đỉnh đồi Sapa với hồ bơi vô cực nước nóng ngắm ruộng bậc thang.'],
            ['Mia Resort Nha Trang', 'Khánh Hòa', 11500000, 'Thiết kế xanh thân thiện môi trường, nằm thoai thoải trên sườn núi đá nhìn thẳng ra đại dương xanh.'],
            ['Park Hyatt Saigon', 'TP Hồ Chí Minh', 13500000, 'Biểu tượng sang trọng phong cách Pháp cổ điển ngay công trường Lam Sơn, trung tâm quận 1.'],
            ['Sofitel Legend Metropole Hanoi', 'Hà Nội', 14000000, 'Khách sạn di sản có lịch sử từ năm 1901, nơi đón tiếp các nguyên thủ quốc gia và siêu sao thế giới.'],
            ['Avani Harbour View', 'Hải Phòng', 10000000, 'Kiến trúc thuộc địa Pháp sang trọng, tọa lạc tại vị trí đắc địa nhìn ra cảng Hải Phòng sầm uất.'],
            ['Legacy Yên Tử - MGallery', 'Quảng Ninh', 10200000, 'Thánh địa nghỉ dưỡng mang phong cách cung điện thời Trần, đậm chất thiền định và tâm linh.'],
            ['Shinta Mani Wild Sapa', 'Lào Cai', 45000000, 'Siêu biệt thự lều trại xa xỉ ẩn mình giữa rừng già, trải nghiệm thiên nhiên nguyên bản thượng lưu.'],
            ['Maia Resort Quy Nhon', 'Bình Định', 11000000, 'Thiên đường nghỉ dưỡng ẩm thực với các căn villa thiết kế mở đón gió biển và ẩm thực tinh hoa.']
        ];

        // ==========================================
        // PHÂN KHÚC 2: CAO CẤP / RESORT 4-5 SAO (20 cái)
        // Giá từ: 4,000,000 đ - 9,500,000 đ
        // ==========================================
        $premium = [
            ['Vinpearl Resort & Spa Phu Quoc', 'Kiên Giang', 5500000, 'Mái ngói đỏ mang phong cách Địa Trung Hải, bãi biển riêng tư dài 3km hoang sơ tuyệt đẹp.'],
            ['Furama Resort Danang', 'Đà Nẵng', 6200000, 'Khu nghỉ dưỡng ẩm thực hàng đầu Việt Nam hướng ra bãi biển Mỹ Khê, phong cách Chăm Pa.'],
            ['Pullman Danang Beach Resort', 'Đà Nẵng', 5100000, 'Không gian hiện đại, năng động bên bờ biển, thích hợp cho cả nghỉ dưỡng gia đình và công tác.'],
            ['Novotel Danang Premier Han River', 'Đà Nẵng', 4500000, 'Khách sạn cao tầng view trọn vẹn sông Hàn và các cây cầu biểu tượng, có sky bar đỉnh cao.'],
            ['Sheraton Nha Trang Hotel & Towers', 'Khánh Hòa', 4800000, 'Tọa lạc trên đường Trần Phú, tất cả các phòng đều có ban công hướng biển Nha Trang.'],
            ['Silk Sense Hoi An River Resort', 'Quảng Nam', 4200000, 'Khu nghỉ dưỡng sinh thái yên bình bên sông Cổ Cò, sử dụng hồ bơi nước muối khoáng.'],
            ['Victoria Sapa Resort & Spa', 'Lào Cai', 4600000, 'Chalet gỗ phong cách thung lũng Thụy Sĩ cổ điển, có tầm nhìn ôm trọn đỉnh Fansipan.'],
            ['Pilgrimage Village Boutique Resort', 'Thừa Thiên Huế', 4300000, 'Làng hành hương yên bình, mộc mạc mang đậm nét kiến trúc làng quê Huế xưa cổ kính.'],
            ['The Grand Ho Tram Strip', 'Bà Rịa - Vũng Tàu', 5800000, 'Phức hợp giải trí và nghỉ dưỡng quy mô lớn bậc nhất miền Nam với casino và sân golf đẳng cấp.'],
            ['Imperial Hotel Vũng Tàu', 'Bà Rịa - Vũng Tàu', 4900000, 'Khách sạn phong cách hoàng gia Anh duy nhất tại Vũng Tàu với nội thất cổ điển lộng lẫy.'],
            ['Caravelle Saigon', 'TP Hồ Chí Minh', 5300000, 'Khách sạn lịch sử trung tâm Sài Gòn, dịch vụ chuẩn mực và tầm nhìn đắt giá ra Nhà Hát Thành Phố.'],
            ['Lotte Hotel Hanoi', 'Hà Nội', 5500000, 'Nằm tại các tầng cao nhất của tòa tháp Lotte, view panaroma toàn cảnh thủ đô Hà Nội.'],
            ['Pao\'s Sapa Leisure Hotel', 'Lào Cai', 4100000, 'Đường cong kiến trúc uốn lượn như ruộng bậc thang, view thung lũng Mường Hoa siêu đẹp.'],
            ['Belvedere Resort Tam Đảo', 'Vĩnh Phúc', 4000000, 'Tọa lạc giữa lưng chừng núi mờ sương, nổi tiếng với góc check-in hồ bơi tràn mây ấn tượng.'],
            ['Pandanus Resort Mũi Né', 'Bình Thuận', 4400000, 'Khu vườn nhiệt đới rộng lớn ngập tràn cây xanh và hoa rực rỡ bên bãi biển Mũi Né.'],
            ['Sol by Meliá Phu Quoc', 'Kiên Giang', 4700000, 'Phong cách trẻ trung, phóng khoáng phong cách Địa Trung Hải, nằm tại Bãi Trường yên bình.'],
            ['Amiana Resort Nha Trang', 'Khánh Hòa', 7500000, 'Nổi tiếng với hồ bơi nước biển tự nhiên rộng lớn và bãi biển riêng tư cát trắng mịn.'],
            ['Sailing Club Resort Mũi Né', 'Bình Thuận', 6000000, 'Khu nghỉ dưỡng boutique nhỏ xinh, phong cách mộc mạc nhưng tinh tế đến từng chi tiết.'],
            ['Melia Ba Vi Mountain Retreat', 'Hà Nội', 6800000, 'Ẩn mình giữa rừng quốc gia Ba Vì mờ sương, không gian kiến trúc Pháp cổ kính thuộc địa.'],
            ['Flamingo Đại Lải Resort', 'Vĩnh Phúc', 5000000, 'Tổ hợp biệt thự xanh ven hồ Đại Lải, nổi tiếng với tòa nhà bọc cây xanh độc đáo.']
        ];

        // ==========================================
        // PHÂN KHÚC 3: TẦM TRUNG / KHÁCH SẠN 3-4 SAO (20 cái)
        // Giá từ: 1,500,000 đ - 3,500,000 đ
        // ==========================================
        $midrange = [
            ['Liberty Central Saigon Centre', 'TP Hồ Chí Minh', 2200000, 'Khách sạn tiện nghi, hiện đại thích hợp cho khách du lịch tự túc muốn ở trung tâm quận 1.'],
            ['Alagon Saigon Hotel & Spa', 'TP Hồ Chí Minh', 1800000, 'Có hồ bơi tầng thượng lãng mạn, vị trí gần chợ Bến Thành cực thuận tiện di chuyển.'],
            ['Hanoi Hotel Silk Path', 'Hà Nội', 2500000, 'Nằm trong khu phố cổ, phong cách thiết kế kết hợp hài hòa giữa nét Á Đông và phương Tây.'],
            ['Muong Thanh Luxury Da Nang', 'Đà Nẵng', 2100000, 'Khách sạn cao tầng nằm sát biển Mỹ Khê, dịch vụ đầy đủ, phòng ốc rộng rãi.'],
            ['Aria Hotel Da Nang', 'Đà Nẵng', 1600000, 'Khách sạn boutique hiện đại, giá hợp lý, cách bãi tắm biển chỉ vài bước chân.'],
            ['Stella Maris Beach Danang', 'Đà Nẵng', 2400000, 'Thiết kế sang trọng, hồ bơi vô cực tầng thượng view biển ngoạn mục.'],
            ['Balcona Hotel Da Nang', 'Đà Nẵng', 1900000, 'Tất cả các phòng đều có ban công ngắm biển hoặc thành phố, dịch vụ thân thiện.'],
            [' TTC Hotel - Ngoc Lan', 'Lâm Đồng', 1700000, 'Tọa lạc trên đồi cao nhìn xuống hồ Xuân Hương thơ mộng, ngay trung tâm Đà Lạt.'],
            ['Sapa Jade Hill Resort', 'Lào Cai', 3200000, 'Bungalow cọ độc đáo nằm giữa bản làng, mang không gian ấm cúng xứ lạnh.'],
            [' TTC Hotel - Phan Thiết', 'Bình Thuận', 1500000, 'Khách sạn cao nhất thành phố Phan Thiết, hướng view ra biển và công viên đồi dương.'],
            ['Victoria Can Tho Resort', 'Cần Thơ', 2800000, 'Khu nghỉ dưỡng đậm chất Tây Đô cổ điển bên bờ sông Hậu yên bình.'],
            ['Lasenta Boutique Hotel Hoian', 'Quảng Nam', 1800000, 'Khách sạn view cánh đồng lúa xanh mướt rực rỡ, không gian yên tĩnh thư thái.'],
            ['Belle Maison Hadana Hoi An', 'Quảng Nam', 1950000, 'Mang phong cách trang nhã, ấm cúng, có hồ bơi sân vườn siêu chill.'],
            ['Phu Quoc Ocean Pearl Hotel', 'Kiên Giang', 1650000, 'Nằm trên đường Trần Hưng Đạo sầm uất, phòng ốc hiện đại, khuôn viên rộng.'],
            ['Lahana Resort Phu Quoc', 'Kiên Giang', 2300000, 'Resort sinh thái trên đồi cao, bao quanh bởi rừng cây tự nhiên và hồ bơi vô cực.'],
            ['Nesta Hotel Can Tho', 'Cần Thơ', 1550000, 'Nằm ngay bến phà cũ nhìn ra sông Hậu, gió lồng lộng, không gian thoáng đãng.'],
            ['Sài Gòn Ninh Chữ Hotel & Resort', 'Ninh Thuận', 1750000, 'Nằm ngay mặt biển Ninh Chữ hoang sơ, hồ bơi sát biển siêu rộng.'],
            ['Bình An Village Vũng Tàu', 'Bà Rịa - Vũng Tàu', 3500000, 'Boutique resort mang phong cách làng quê châu Âu cổ điển ven biển bãi Trước.'],
            ['Malibu Hotel Vũng Tàu', 'Bà Rịa - Vũng Tàu', 2600000, 'Hồ bơi chân mây tầng cao nhìn ra bãi Sau Vũng Tàu cực kỳ hoành tráng.'],
            ['Mercure Danang French Village Bana Hills', 'Đà Nẵng', 3100000, 'Trải nghiệm ngủ đêm giữa làng Pháp cổ kính mờ sương trên đỉnh Bà Nà.']
        ];

        // ==========================================
        // PHÂN KHÚC 4: TIẾT KIỆM / HOMESTAY / BUNGALOW (20 cái)
        // Giá từ: 600,000 đ - 1,200,000 đ
        // ==========================================
        $budget = [
            ['Dalat Wonder Homestay', 'Lâm Đồng', 750000, 'Căn nhà gỗ nhỏ xinh ven sườn đồi, sáng sớm săn mây ngắm rừng thông.'],
            ['The Circle Vietnam Homestay', 'Lâm Đồng', 650000, 'Mô hình phòng ống cống độc đáo rực rỡ sắc màu, view thung lũng Đà Lạt.'],
            ['Lee\'s House in Buon Ma Thuot', 'Đắk Lắk', 900000, 'Homestay phong cách Bali giữa lòng Tây Nguyên với tiểu cảnh chụp ảnh sống ảo.'],
            ['Hoi An Loongboong Homestay', 'Quảng Nam', 700000, 'Ngôi nhà gạch mộc mạc ẩn mình trong khu vườn xanh, cách phố cổ 1km.'],
            ['An Bang Beach Hideaway', 'Quảng Nam', 1100000, 'Bungalow tranh tre nứa lá xinh xắn ẩn mình ngay sát bãi biển An Bàng.'],
            ['Sapa Clay House', 'Lào Cai', 1200000, 'Homestay tường đất truyền thống độc đáo của người Hà Nhì, view ruộng bậc thang.'],
            ['Little Sapa Homestay', 'Lào Cai', 600000, 'Không gian gia đình ấm cúng, chủ nhà thân thiện, thưởng thức đặc sản Tây Bắc.'],
            ['Chày Lập Farmstay', 'Quảng Bình', 1150000, 'Trải nghiệm làm nông dân và chèo thuyền kayak bên vườn quốc gia Phong Nha.'],
            ['Nguyen Shack Homestay Ninh Binh', 'Ninh Bình', 850000, 'Bungalow tre dựng sát vách núi đá vôi, bao quanh bởi đầm sen thơm ngát.'],
            ['Chez Beo Homestay', 'Ninh Bình', 650000, 'Nằm sâu trong thung lũng lộng gió, trải nghiệm cuộc sống hoang dã thiên nhiên.'],
            ['Mekong Rustic Can Tho', 'Cần Thơ', 950000, 'Nhà miệt vườn miền Tây, xung quanh là vườn cây ăn trái trĩu quả.'],
            ['Lang Thang Homestay Quy Nhơn', 'Bình Định', 600000, 'Thiết kế vintage nhẹ nhàng, nằm ngay trung tâm thành phố biển Quy Nhơn.'],
            ['Phượt Homestay đảo Phú Quý', 'Bình Thuận', 600000, 'Điểm dừng chân lý tưởng cho dân phượt, chủ nhà hỗ trợ thuê xe máy và dẫn tour.'],
            ['9 Station Hostel Phu Quoc', 'Kiên Giang', 800000, 'Mô hình hostel cao cấp có hồ bơi riêng, không gian sinh hoạt chung hiện đại.'],
            ['The Hill Homestay Vũng Tàu', 'Bà Rịa - Vũng Tàu', 700000, 'Nằm trên sườn núi nhỏ, thiết kế container độc đáo, trẻ trung.'],
            ['Hanoi Family Homestay', 'Hà Nội', 750000, 'Trải nghiệm sống cùng gia đình người Hà Nội cổ trong ngõ nhỏ phố cổ.'],
            ['Kiki\'s House Nha Trang', 'Khánh Hòa', 650000, 'Homestay ấm cúng gần sông Cái, yên tĩnh và không gian sinh hoạt chung rộng rãi.'],
            ['Mộc Châu Arena Village', 'Sơn La', 850000, 'Ngủ đêm trong các thùng container giữa đồi chè xanh mướt mát Mộc Châu.'],
            ['Ta Van Ecogreen Homestay', 'Lào Cai', 700000, 'Nằm tại bản Tả Van, cửa sổ nhìn thẳng ra dòng suối Mường Hoa rì rào.'],
            ['Tam Cốc River View Homestay', 'Ninh Bình', 900000, 'Sát bờ sông Ngô Đồng, ngắm nhìn thuyền chở khách đi giữa các hang động.']
        ];

        // ==========================================
        // PHÂN KHÚC 5: BÌNH DÂN / NHÀ NGHỈ / HOSTEL GIƯỜNG TẦNG (20 cái)
        // Giá từ: 150,000 đ - 450,000 đ
        // ==========================================
        $economy = [
            ['Nhà nghỉ Thu Phương', 'Hà Nội', 300000, 'Phòng nghỉ bình dân, sạch sẽ, đầy đủ điều hòa, wifi ngay gần bến xe Mỹ Đình.'],
            ['Nhà nghỉ Hải Hà', 'TP Hồ Chí Minh', 350000, 'Nằm trong ngõ quận Thanh Xuân, yên tĩnh, giá rẻ cho sinh viên thuê theo giờ/ngày.'],
            ['Khách sạn mini Hoa Hồng', 'Đà Nẵng', 350000, 'Cách biển Mỹ Khê 500m, phòng cơ bản, chủ nhà nhiệt tình chỉ chỗ ăn uống rẻ.'],
            ['Nhà nghỉ Phong Lan', 'Bà Rịa - Vũng Tàu', 400000, 'Bình dân bãi Sau, thích hợp cho nhóm bạn ở ghép tiết kiệm chi phí.'],
            ['Đà Lạt BedStation Hostel', 'Lâm Đồng', 180000, 'Giường tầng dorm sạch sẽ, trung tâm, có khu vực bếp chung tự nấu ăn.'],
            ['Saigon Backpacker Hostel', 'TP Hồ Chí Minh', 200000, 'Nằm ngay khu phố Tây Bùi Viện, quầy bar sôi động, nhiều khách quốc tế.'],
            ['Hanoi Backpackers Hostel', 'Hà Nội', 220000, 'Giường tầng tiện lợi phố Mã Mây, miễn phí một ly bia tươi vào mỗi buổi tối.'],
            ['Nhà nghỉ Tây Bắc', 'Lào Cai', 300000, 'Gần chợ đêm Sapa, phòng sưởi ấm bằng chăn điện cơ bản, giá siêu rẻ.'],
            ['Nhà nghỉ Bình Minh', 'Ninh Bình', 280000, 'Gần bến xe Ninh Bình, thuận tiện di chuyển đi Tràng An, Bái Đính.'],
            ['Nhà nghỉ Thanh Bình', 'Quảng Nam', 350000, 'Phòng nghỉ gia đình giá rẻ ngoài rìa phố cổ Hội An, có xe đạp miễn phí.'],
            ['Quy Nhon Pub & Hostel', 'Bình Định', 150000, 'Giường dorm siêu tiết kiệm cho dân phượt một mình, ngay sát phố ẩm thực.'],
            ['Nhà nghỉ Cát Bà Green', 'Hải Phòng', 400000, 'Phòng nghỉ tiêu chuẩn, điều hòa mát rượi ngay trung tâm thị trấn Cát Bà.'],
            ['Nhà nghỉ Hòn Gai', 'Quảng Ninh', 350000, 'Vùng ven Hạ Long, phòng sạch sẽ gọn gàng, giá không lo bị chặt chém.'],
            ['Phú Quốc Gecko Hostel', 'Kiên Giang', 250000, 'Phòng dorm tập thể giường tầng, không gian chung thiết kế mộc mạc, thân thiện.'],
            ['Mũi Né Backpackers', 'Bình Thuận', 200000, 'Giường tầng giá rẻ, có hồ bơi chung nhỏ ngoài trời cho khách giao lưu.'],
            ['Nhà nghỉ Sông Hương', 'Thừa Thiên Huế', 280000, 'Nằm bên bờ bắc sông Hương, phòng ốc rộng rãi mang phong cách gia đình.'],
            ['Nha Trang Zone Hostel', 'Khánh Hòa', 180000, 'Thiết kế container độc lạ, giường dorm có rèm che riêng tư, ổ cắm đầy đủ.'],
            ['Nhà nghỉ Đồng Văn', 'Hà Giang', 300000, 'Điểm dừng chân lý tưởng trên cung đường phượt Quản Bạ - Yên Minh - Đồng Văn.'],
            ['Nhà nghỉ Mai Châu', 'Hòa Bình', 250000, 'Ngủ nhà sàn tập thể của người Thái, trải nghiệm văn hóa mộc mạc.'],
            ['Nhà nghỉ Cần Thơ Giá Rẻ', 'Cần Thơ', 300000, 'Nằm gần trường Đại học Cần Thơ, sạch sẽ, an ninh tốt, chủ nhà vui tính.']
        ];

       // Gộp data chạy vòng lặp để build mảng insert database
        $allCategories = [$luxury, $premium, $midrange, $budget, $economy];

        foreach ($allCategories as $category) {
            foreach ($category as $item) {
                $services[] = [
                    'category_id' => 1, // Điền ID danh mục mặc định của bạn vào đây (Ví dụ: 1)
                    'user_id' => 2,     // Điền ID user mặc định vào đây giống như ảnh Laragon (Ví dụ: 2)
                    'title' => $item[0],
                    'location' => $item[1],
                    'price' => $item[2],
                    'description' => $item[3],
                    'image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401', // Thêm ảnh demo tránh lỗi rỗng
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Bơm thẳng 100 cái vào bảng services
        DB::table('services')->insert($services);
    }
}