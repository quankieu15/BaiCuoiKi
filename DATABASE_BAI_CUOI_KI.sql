-- --------------------------------------------------------
-- Máy chủ:                      127.0.0.1
-- Server version:               8.0.46 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Phiên bản:           12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for bai_cuoi_ki
CREATE DATABASE IF NOT EXISTS `bai_cuoi_ki` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bai_cuoi_ki`;

-- Dumping data for table bai_cuoi_ki.cache: ~0 rows (approximately)

-- Dumping data for table bai_cuoi_ki.cache_locks: ~0 rows (approximately)

-- Dumping data for table bai_cuoi_ki.categories: ~5 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Thuê xe', 'thue-xe', '2026-05-21 02:28:46', '2026-05-21 02:28:46'),
	(2, 'Vé tham quan', 've-tham-quan', '2026-05-21 02:28:46', '2026-05-21 02:28:46'),
	(3, 'Tour trong nước', 'tour-trong-nuoc', '2026-05-21 02:28:46', '2026-05-21 02:28:46'),
	(4, 'Tour quốc tế', 'tour-quoc-te', '2026-05-21 02:28:46', '2026-05-21 02:28:46'),
	(5, 'Khách sạn', 'khach-san', '2026-05-21 02:28:46', '2026-05-21 02:28:46');

-- Dumping data for table bai_cuoi_ki.failed_jobs: ~0 rows (approximately)

-- Dumping data for table bai_cuoi_ki.feedbacks: ~0 rows (approximately)

-- Dumping data for table bai_cuoi_ki.hotels: ~2 rows (approximately)
INSERT INTO `hotels` (`id`, `name`, `location`, `address`, `description`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'Amanoi Resort Vĩnh Hy', 'Ninh Thuận', 'Khu vực Ninh Thuận, Việt Nam', NULL, NULL, '2026-05-21 02:28:46', '2026-05-21 02:28:46'),
	(2, 'Six Senses Ninh Van Bay', 'Khánh Hòa', 'Khu vực Khánh Hòa, Việt Nam', NULL, NULL, '2026-05-21 02:28:46', '2026-05-21 02:28:46');

-- Dumping data for table bai_cuoi_ki.hotel_service: ~0 rows (approximately)

-- Dumping data for table bai_cuoi_ki.jobs: ~0 rows (approximately)

-- Dumping data for table bai_cuoi_ki.job_batches: ~0 rows (approximately)

-- Dumping data for table bai_cuoi_ki.migrations: ~18 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_05_17_080000_create_hotels_table', 1),
	(5, '2026_05_17_092402_create_categories_table', 1),
	(6, '2026_05_17_092406_create_services_table', 1),
	(7, '2026_05_17_092410_create_orders_table', 1),
	(8, '2026_05_17_092413_create_reviews_table', 1),
	(9, '2026_05_17_133118_add_columns_to_hotels_table', 1),
	(10, '2026_05_17_143036_create_hotel_service_table', 1),
	(11, '2026_05_17_155518_add_avatar_to_users_table', 1),
	(12, '2026_05_18_044802_add_date_and_note_to_orders_table', 1),
	(13, '2026_05_18_143545_add_approved_at_to_orders_table', 1),
	(14, '2026_05_18_152228_add_payment_proof_to_orders_table', 1),
	(15, '2026_05_19_134216_add_category_to_services_table', 1),
	(16, '2026_05_19_143913_create_feedbacks_table', 1),
	(17, '2026_05_19_145333_add_status_to_services_table', 1),
	(18, '2026_05_21_101416_add_is_visible_to_reviews_table', 2);

-- Dumping data for table bai_cuoi_ki.orders: ~12 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `service_id`, `quantity`, `booking_date`, `total_price`, `status`, `approved_at`, `note`, `payment_method`, `payment_proof`, `created_at`, `updated_at`) VALUES
	(1, 3, 1, 1, '2026-05-24', 35000000.00, 'approved', NULL, 'Cần hỗ trợ gấp thủ tục check-in VIP.', 'cod', NULL, '2026-05-21 02:28:46', '2026-05-21 02:56:39'),
	(2, 3, 12, 1, '2026-05-29', 11990000.00, 'approved', NULL, NULL, 'cod', NULL, '2026-05-21 02:54:02', '2026-05-21 02:56:36'),
	(3, 3, 1, 50, '2026-05-31', 1750000000.00, 'approved', NULL, NULL, 'cod', 'proofs/jvgeFEoTyfCaDJnjZ0yaGEnJST6026DLrl15XW9g.jpg', '2026-05-21 02:54:34', '2026-05-22 07:06:10'),
	(4, 3, 15, 1, '2026-05-29', 5000000.00, 'accepted', '2026-05-23 07:27:55', NULL, 'cod', 'proofs/uPNi7xvgL1wOT421ccWUraSTJhq48raNDrUzB8lx.jpg', '2026-05-22 06:34:30', '2026-05-23 07:27:55'),
	(5, 3, 15, 1, '2026-05-28', 5000000.00, 'accepted', '2026-05-23 07:27:54', NULL, 'cod', NULL, '2026-05-23 00:17:18', '2026-05-23 07:27:54'),
	(6, 3, 15, 10, '2026-05-29', 50000000.00, 'approved', NULL, 'ăn chay', 'cod', NULL, '2026-05-23 08:39:19', '2026-05-23 08:45:24'),
	(7, 3, 14, 50, '2026-05-27', 1445000000.00, 'approved', NULL, NULL, 'cod', NULL, '2026-05-23 08:44:34', '2026-05-23 08:45:16'),
	(8, 4, 9, 70, '2026-05-28', 199500000.00, 'pending', NULL, NULL, 'cod', NULL, '2026-05-23 08:49:25', '2026-05-23 08:49:25'),
	(9, 5, 9, 30, '2026-05-29', 85500000.00, 'pending', NULL, NULL, 'cod', NULL, '2026-05-23 08:52:22', '2026-05-23 08:52:22'),
	(10, 3, 16, 40, '2026-05-28', 128400000.00, 'accepted', '2026-05-23 09:02:18', NULL, 'cod', NULL, '2026-05-23 08:58:58', '2026-05-23 09:02:18'),
	(11, 3, 17, 1, '2026-06-04', 54321000.00, 'pending', NULL, NULL, 'cod', NULL, '2026-05-23 09:08:11', '2026-05-23 09:08:11'),
	(12, 3, 17, 1, '2026-06-07', 54321000.00, 'pending', NULL, NULL, 'cod', 'proofs/l1Axg3ICw4Fxj8qvPX5uyKCxpWR1U4RWBg0z1EzQ.png', '2026-05-23 09:08:31', '2026-06-03 04:29:25');

-- Dumping data for table bai_cuoi_ki.password_reset_tokens: ~0 rows (approximately)

-- Dumping data for table bai_cuoi_ki.reviews: ~4 rows (approximately)
INSERT INTO `reviews` (`id`, `user_id`, `service_id`, `rating`, `is_visible`, `comment`, `is_approved`, `created_at`, `updated_at`) VALUES
	(1, 3, 1, 5, 1, '3', 1, '2026-05-21 02:57:59', '2026-05-21 03:14:49'),
	(2, 3, 1, 5, 1, 'f', 1, '2026-05-21 03:36:16', '2026-05-21 03:36:16'),
	(3, 3, 13, 5, 1, '3', 1, '2026-05-21 03:45:10', '2026-05-21 03:45:10'),
	(4, 3, 1, 5, 1, '3', 1, '2026-05-21 03:54:56', '2026-05-21 03:54:56');

-- Dumping data for table bai_cuoi_ki.services: ~17 rows (approximately)
INSERT INTO `services` (`id`, `category_id`, `user_id`, `hotel_id`, `title`, `description`, `price`, `status`, `location`, `image`, `created_at`, `updated_at`, `category`) VALUES
	(1, 5, 2, 1, 'Villas/Phòng Nghỉ Dưỡng Tại Amanoi Resort Vĩnh Hy', 'Ẩn mình trong vườn quốc gia Núi Chúa, khu nghỉ dưỡng 6 sao đẳng cấp quốc tế với hồ bơi vô cực ngắm trọn vịnh Vĩnh Hy.', 35000000.00, 'active', 'Ninh Thuận', 'uploads/services/1779457521.jpg', '2026-05-21 02:28:46', '2026-05-22 06:45:21', 'hotel'),
	(2, 5, 2, 2, 'Villas/Phòng Nghỉ Dưỡng Tại Six Senses Ninh Van Bay', 'Biệt thự tựa vách đá biệt lập, có hồ bơi riêng và quản gia phục vụ 24/7, di chuyển hoàn toàn bằng tàu cáp.', 22000000.00, 'active', 'Khánh Hòa', 'uploads/services/1779457548.jpg', '2026-05-21 02:28:46', '2026-05-22 06:45:48', 'hotel'),
	(3, 1, 2, NULL, 'Thuê Xe Tự Lái VinFast VF8 Hạng Sang', 'Xe điện đời mới sạch sẽ, giao xe tận nơi, bảo hiểm đầy đủ.', 1200000.00, 'active', 'Hà Nội', 'uploads/services/1779457622.png', '2026-05-21 02:28:46', '2026-05-22 06:47:02', 'car'),
	(4, 1, 2, NULL, 'Thuê Xe 7 Chỗ Toyota Fortuner Có Tài Xế', 'Tài xế lịch sự, rành đường, phục vụ đưa đón sân bay hoặc đi tỉnh.', 1800000.00, 'active', 'TP Hồ Chí Minh', 'uploads/services/1779457685.jpg', '2026-05-21 02:28:46', '2026-05-22 06:48:05', 'car'),
	(5, 1, 2, NULL, 'Thuê Xe Mercedes C200 Mui Trần', 'Xe hoa sang trọng, đã bao gồm kết hoa tươi cao cấp và tài xế phục vụ cưới hỏi.', 3500000.00, 'active', 'Đà Nẵng', 'uploads/services/1779457725.jpg', '2026-05-21 02:28:46', '2026-05-22 06:51:42', 'car'),
	(6, 2, 2, NULL, 'Vé Trọn Gói Sun World Ba Na Hills', 'Đã bao gồm vé cáp treo khứ hồi, tham quan Cầu Vàng và vui chơi miễn phí tại Fantasy Park.', 900000.00, 'active', 'Đà Nẵng', 'uploads/services/1779457759.jpg', '2026-05-21 02:28:46', '2026-05-22 06:49:19', 'ticket'),
	(7, 2, 2, NULL, 'Vé Vui Chơi VinWonders Phú Quốc', 'Khám phá công viên chủ đề lớn nhất Việt Nam với hàng trăm trò chơi cảm giác mạnh và show diễn triệu đô.', 950000.00, 'active', 'Kiên Giang', 'uploads/services/1779457765.jpg', '2026-05-21 02:28:46', '2026-05-22 06:49:25', 'ticket'),
	(8, 2, 2, NULL, 'Vé Tham Quan Ký Ức Hội An - Hạng ECO', 'Thưởng thức show diễn thực cảnh đẹp nhất thế giới, tái hiện 400 năm lịch sử thương cảng Hội An.', 600000.00, 'active', 'Quảng Nam', 'uploads/services/1779457772.jpg', '2026-05-21 02:28:46', '2026-05-22 06:49:32', 'ticket'),
	(9, 3, 2, NULL, 'Tour Bản Sắc Tây Bắc: Hà Nội - Sapa 3 Ngày 2 Đêm', 'Chinh phục đỉnh Fansipan, check-in bản Cát Cát và thưởng thức ẩm thực thắng cố đặc sản.', 2850000.00, 'active', 'Đ. Thạch Sơn, Sa Pa, Lào Cai 31786, Việt Nam', 'uploads/services/1779457288.jpg', '2026-05-22 05:50:55', '2026-05-22 06:41:28', 'domestic_tour'),
	(10, 3, 2, NULL, 'Tour Khám Phá Đảo Ngọc Phú Quốc 4 Ngày 3 Đêm', 'Trọn gói vé máy bay, cano lặn ngắm san hô 4 đảo, tham quan cáp treo Hòn Thơm dài nhất thế giới.', 4500000.00, 'active', 'Dương Đông, Phú Quốc, Kiên Giang, Việt Nam', 'uploads/services/1779457371.jpg', '2026-05-22 05:50:55', '2026-05-22 06:42:51', 'domestic_tour'),
	(11, 3, 2, NULL, 'Tour Di Sản Miền Trung: Đà Nẵng - Hội An - Huế 4 Ngày', 'Tham quan Đại Nội Kinh Thành Huế, Phố cổ Hội An rực rỡ đèn lồng và tắm biển Mỹ Khê.', 3990000.00, 'active', 'Minh An, Hội An, Quảng Nam', 'uploads/services/1779457481.jpg', '2026-05-22 05:50:55', '2026-05-23 06:14:37', 'domestic_tour'),
	(12, 4, 2, NULL, 'Tour Khám Phá Đảo Quốc Sư Tử Singapore 4 Ngày 3 Đêm', 'Check-in Marina Bay Sands, công viên Gardens by the Bay và hòn đảo vui chơi giải trí Sentosa.', 11990000.00, 'active', 'Marina Bay, Singapore', 'uploads/services/1779457805.jpg', '2026-05-21 02:28:46', '2026-05-23 08:47:38', 'international_tour'),
	(13, 4, 2, NULL, 'Tour Hàn Quốc Mùa Hoa Anh Đào: Seoul - Nami 5 Ngày', 'Trải nghiệm mặc Hanbok tham quan cung điện Gyeongbokgung, check-in đảo Nami thơ mộng.', 16500000.00, 'active', 'Seoul, Hàn Quốc', 'uploads/services/1779457831.jpg', '2026-05-21 02:28:46', '2026-05-23 08:46:11', 'international_tour'),
	(14, 4, 2, NULL, 'Tour Trải Nghiệm Nhật Bản: Tokyo - Núi Phú Sĩ - Kyoto 6 Ngày', 'Khám phá thủ đô Tokyo sầm uất, ngắm núi Phú Sĩ hùng vĩ và trải nghiệm tàu siêu tốc Shinkansen.', 28900000.00, 'active', 'Tokyo, Nhật Bản', 'uploads/services/1779457868.jpg', '2026-05-21 02:28:46', '2026-05-23 08:48:02', 'international_tour'),
	(15, 3, 2, NULL, 'Tour Sa Pa kỳ vĩ 3 Ngày 2 Đêm - Khởi hành từ Hà Nội', 'Sapa là thị trấn vùng cao tuyệt đẹp thuộc tỉnh Lào Cai, cách Hà Nội khoảng 350km. Nơi đây nổi tiếng với khí hậu mát mẻ quanh năm, thung lũng mờ sương, những thửa ruộng bậc thang trải dài và nền văn hóa bản địa đặc sắc.', 5000000.00, 'active', 'Sa Pa', 'uploads/services/1779456789.jpg', '2026-05-22 06:33:09', '2026-05-22 06:41:40', 'trong_nuoc'),
	(16, 3, 6, NULL, 'Di sản Ninh Bình', 'TOUR VIP TRONG NƯỚC – TRẢI NGHIỆM ĐẲNG CẤP 5 SAO ✨🇻🇳\r\n\r\nKhám phá vẻ đẹp Việt Nam theo phong cách thượng lưu với hệ thống Tour VIP cao cấp dành riêng cho khách hàng yêu thích sự sang trọng, riêng tư và dịch vụ chuyên nghiệp. Mỗi hành trình đều được thiết kế tinh tế, kết hợp nghỉ dưỡng đẳng cấp, ẩm thực đặc sắc và trải nghiệm độc quyền tại những điểm đến nổi tiếng hàng đầu Việt Nam.', 3210000.00, 'active', 'Tràng An, Ninh Bình', 'uploads/services/1779551797.jpg', '2026-05-23 08:56:37', '2026-05-23 08:58:42', 'trong_nuoc'),
	(17, 4, 6, NULL, 'TOUR CANADA – KHÁM PHÁ XỨ SỞ LÁ PHONG 🍁✈️', 'Trải nghiệm hành trình du lịch Canada đẳng cấp với những thành phố hiện đại, thiên nhiên hùng vĩ và nền văn hóa đa sắc màu. Tour được thiết kế dành cho khách yêu thích nghỉ dưỡng cao cấp, khám phá thiên nhiên và tận hưởng dịch vụ chuẩn quốc tế.', 54321000.00, 'active', 'Niagara, Canada', 'uploads/services/1779552463.jpg', '2026-05-23 09:07:16', '2026-05-23 09:07:56', 'trong_nuoc');

-- Dumping data for table bai_cuoi_ki.sessions: ~0 rows (approximately)

-- Dumping data for table bai_cuoi_ki.users: ~6 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `role`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Quản trị viên Hệ thống', 'admin@gmail.com', NULL, NULL, '$2y$12$.53RgUZZTHDlsJXSkqFTmeyMTex.uYtx4nBjzzoIaRxWsi.RuQ3Yq', 'admin', '0911223344', NULL, '2026-05-21 02:28:46', '2026-05-21 02:28:46'),
	(2, 'HKT TRAVEL', 'partner@gmail.com', NULL, NULL, '$2y$12$5jQcga/ul6EtEC968UmZpO18bcEZi/0FSycXT5v/t8nIXyCV3WTu2', 'partner', '0988776655', NULL, '2026-05-21 02:28:46', '2026-05-21 02:28:46'),
	(3, 'Trần Văn Khánh', 'customer@gmail.com', 'avatars/YetSsfqgWBX0LAGIYQkbFemrDMcIG8XP1XYfBSIE.png', NULL, '$2y$12$s8l0d43H5V5tNNSII8O3S.BCb.miFi0Tw436x/Kj684DAyOoMJgAa', 'customer', '0905123456', 'LtjqAc8JNplxARpdrguIRjavF1XO5q2Pq1jbXb1dOC6PMAFBzQJbo0v5g6sv', '2026-05-21 02:28:46', '2026-05-21 04:30:47'),
	(4, 'Trịnh Thị Thương', 'thuong@gmail.com', NULL, NULL, '$2y$12$auvqVaMtTkWHykZsNmp7.e5//szdkzjcF.a5Iq.5ttwy7T3DRZCAi', 'customer', '0123456789', NULL, '2026-05-23 08:48:57', '2026-05-23 08:48:57'),
	(5, 'Anh Tên Là Bằng', 'hau@gmail.com', NULL, NULL, '$2y$12$7qUN9JS/8n0GZySZjeb2YudXvXVeBNefbYNj4OGO9ckyzejWrvDpe', 'customer', '0123456789', NULL, '2026-05-23 08:51:59', '2026-05-23 08:51:59'),
	(6, 'Hoàng Hướng Hậu', 'partner2@gmail.com', NULL, NULL, '$2y$12$7/W4Ix8fkw56oEzWCMmeD.MFfdib4JkYJrTiI5T0UUlEdZ67yRW/W', 'partner', '1234567890', NULL, '2026-05-23 08:52:58', '2026-05-23 08:53:47');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
