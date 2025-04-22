-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 22, 2024 lúc 06:42 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nph_kho68`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_transactions`
--

CREATE TABLE `bank_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `posting_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `debit_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'VND',
  `description` text COLLATE utf8mb4_unicode_ci,
  `add_description` text COLLATE utf8mb4_unicode_ci,
  `available_balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `beneficiary_account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ben_account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ben_account_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracing_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1726830739),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1726830739;', 1726830739),
('a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1726979010),
('a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1726979010;', 1726979010);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `wordpress_product_id` bigint UNSIGNED DEFAULT NULL,
  `social_account_product_id` bigint UNSIGNED DEFAULT NULL,
  `course_product_id` bigint UNSIGNED DEFAULT NULL,
  `attribute_id` bigint UNSIGNED DEFAULT NULL,
  `other_product_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS ((`quantity` * `price`)) STORED,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `wordpress_product_id`, `social_account_product_id`, `course_product_id`, `attribute_id`, `other_product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 1, NULL, NULL, 1, 69000.00, '2024-09-17 19:05:00', '2024-09-17 19:05:00'),
(2, 1, 1, NULL, NULL, NULL, NULL, 2, 99000.00, '2024-09-19 19:42:12', '2024-09-19 19:43:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Wordpress', 'wordpress', NULL, 'active', '2024-09-16 21:09:43', '2024-09-16 21:09:43'),
(2, 'Plugin', 'plugin', 1, 'active', '2024-09-16 21:09:51', '2024-09-16 21:09:51'),
(3, 'Theme', 'theme', 1, 'active', '2024-09-16 21:09:59', '2024-09-16 21:09:59'),
(4, 'Tài khoản', 'tai-khoan', NULL, 'active', '2024-09-16 21:20:47', '2024-09-16 21:20:47'),
(5, 'Facebook', 'facebook', 4, 'active', '2024-09-16 21:21:16', '2024-09-16 21:21:16'),
(6, 'Tiktok', 'tiktok', 4, 'active', '2024-09-16 21:21:27', '2024-09-16 21:21:27'),
(7, 'Khóa học', 'khoa-hoc', NULL, 'active', '2024-09-16 21:21:35', '2024-09-16 21:21:35'),
(8, 'Ngoại ngữ', 'ngoai-ngu', 7, 'active', '2024-09-17 00:57:59', '2024-09-17 00:57:59'),
(9, 'Tin học văn phòng', 'tin-hoc-van-phong', 7, 'active', '2024-09-17 00:58:22', '2024-09-17 00:58:22'),
(10, 'Sản phẩm khác', 'san-pham-khac', NULL, 'active', '2024-09-17 19:14:22', '2024-09-17 19:14:22'),
(11, 'Mã kích hoạt', 'ma-kich-hoat', 10, 'active', '2024-09-17 19:14:55', '2024-09-17 20:25:34'),
(12, 'Thương hiệu', 'thuong-hieu', NULL, 'active', '2024-09-17 19:15:55', '2024-09-17 19:15:55'),
(13, 'Apple', 'apple', 12, 'active', '2024-09-17 19:16:03', '2024-09-17 19:16:03'),
(14, 'Google', 'google', 12, 'active', '2024-09-17 19:16:11', '2024-09-17 19:16:11'),
(15, 'Adobe', 'adobe', 12, 'active', '2024-09-17 19:16:31', '2024-09-17 19:16:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_social_account_product`
--

CREATE TABLE `category_social_account_product` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `social_account_product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `courses`
--

CREATE TABLE `courses` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `long_description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` text COLLATE utf8mb4_unicode_ci,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_count` int NOT NULL DEFAULT '0',
  `download_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` bigint UNSIGNED DEFAULT '0',
  `status` enum('active','inactive','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `courses`
--

INSERT INTO `courses` (`id`, `category_id`, `title`, `slug`, `short_description`, `long_description`, `price`, `sale_price`, `image`, `instructor`, `duration`, `level`, `video_count`, `download_link`, `video_url`, `views`, `status`, `created_at`, `updated_at`) VALUES
(1, 8, 'Phát âm chuẩn Tiếng Anh – Vũ Thuỳ Linh', 'phat-am-chuan-tieng-anh-vu-thuy-linh', '<ul><li>Thời lượng: 12 giờ 36 phút</li><li>Giáo trình: 43 bài giảng</li><li>Sở hữu khóa học trọn đời</li></ul><p><br></p>', '<h2>Share Khóa học Phát âm chuẩn Tiếng Anh của giảng viên Vũ Thuỳ Linh</h2><h3>Bạn Sẽ Học Được Gì?</h3><p>✅ Đọc đúng được toàn bộ 44 nguyên âm và phụ âm tiếng Anh</p><p>✅ Cải thiện khả năng NGHE tiếng Anh một cách rõ rệt</p><p>✅ Nói được bất kì từ nào trong tiếng Anh chuẩn 100% ngữ âm và trọng âm</p><p>✅ Nói chuẩn và tự tin giao tiếp tiếng Anh các câu đơn giản</p><p>✅ Có thể hướng dẫn người&nbsp; khác nói chuẩn tiếng Anh</p><p>✅ Nền tảng tốt để phát triển khả năng giao tiếp, phản xạ nhanh</p><h3>Giới Thiệu Khóa Học</h3><p>Có phải bạn đang:</p><ul><li>Mất gốc tiếng Anh hoặc học từ không biết gì nhưng không biết nên bắt đầu từ đâu?</li><li>Muốn tự tin giao tiếp với người nước ngoài nhưng lại sợ nói sai và không nghe được người nước ngoài nói?</li><li>Muốn sở hữu bộ âm chuẩn 100% âm Anh – Mỹ để thấy việc nghe nói tiếng Anh cực kì dễ, thêm yêu thích và tự tin nói tiếng Anh?</li><li>Bạn muốn học ngoại ngữ online nhưng chưa tìm được địa chỉ uy tín, phù hợp</li></ul><p>Vậy thì đây là khóa học ĐẦU TIÊN và QUAN TRỌNG NHẤT với bạn. Vì sao?</p><p>Khi học tiếng Anh hay bất cứ một ngôn ngữ nào khác đều có 3 yếu tố: Ngữ âm, từ vựng và ngữ pháp. Trong 3 yếu tố này thì NGỮ ÂM là nền tảng, và nền móng quan trọng nhất để học tốt tiếng Anh. Và khi có ngữ âm tốt, thì việc nghe nói tiếng Anh của bạn sẽ trở nên CỰC KÌ ĐƠN GIẢN.</p><p>Khóa học phát âm Tiếng Anh online của giảng viên Linh Vũ Phát âm chuẩn Tiếng Anh dành cho bất kỳ ai mới bắt đầu học tiếng Anh, bạn sẽ tiết kiệm rất nhiều thời gian tìm tài liệu trên mạng cũng như tham khảo các cách học âm khác nhau, vì đây là phương pháp học tiếng Anh PHÙ HỢP VÀ HIỆU QUẢ NHẤT DÀNH CHO NGƯỜI VIỆT.</p><p><br><br></p><p><br></p>', 599000.00, 69000.00, 'courses/01J81A20XYB2KXRQECPDRERE6A.jpg', 'Vũ Thuỳ Linh', '12 giờ 36 phút', 'Tất cả các cấp độ', 0, NULL, NULL, 0, 'active', '2024-09-17 17:55:59', '2024-09-17 17:56:58'),
(2, 8, 'Luyện Thi Topik I – Châu Thùy Trang', 'luyen-thi-topik-i-chau-thuy-trang', '<ul><li>Sở hữu khóa học trọn đời</li></ul>', '<p>Khóa học chính là giải pháp tối ưu giúp bạn tiết kệm thời gian, chi phí học tập, ôn luyện Topik I để đạt điểm số cao như bạn mong muốn.</p><h2>Bạn sẽ học được gì</h2><p>Củng cố vốn Tựng – Ngữ pháp cần thiết khi đi thi Topik I</p><p>Có được kỹ năng làm bài thi tiết kiệm thời gian, hiệu quả, đạt điểm số cao</p><p>Luyện giải đề thi với 16 dạng câu hỏi thường gặp</p><p>Tự tin đạt điểm cao khi thi Topik I</p><h2>Giới thiệu khóa học</h2><h3><strong>TOPIK là gì ?</strong></h3><p>Nếu bạn đang có dự định đi du học Hàn Quốc hoặc làm việc tại các Công ty Hàn Quốc thì kỳ thi năng lực tiếng Hàn TOPIK vô cùng quan trọng và cần thiết. TOPIK là chứng chỉ duy nhất được thừa nhận trên toàn thế giới về năng lực tiếng Hàn, là điều kiện cơ bản để có thể nhập quốc tịch Hàn Quốc, xin việc, làm việc tại Hàn Quốc.</p><h3><strong>Luyện thi Topik I có tại Unica.vn</strong></h3><p>Bạn đang lo lắng vì kì thi Topik I sắp tới mà bạn chưa ôn luyện ? Hay do bận rộn bạn không sắp xếp được thời gian đến trung tâm luyện thi? Bạn chưa tìm được phương pháp học ngoại ngữ online phù hợp? Khóa học <strong><em>“Luyện Thi Topik I”</em></strong> được biên soạn bởi giảng viên <strong><em>Châu Thùy Trang</em></strong> có tại Unica.vn chính là giải pháp tối ưu dành cho bạn, giúp bạn tiết kiệm thời gian, chi phí học tập, ôn luyện. Khóa học sẽ giúp bạn ôn lại một số từ vựng cần nắm khi thi Topik I, ôn lại tất cả các cấu trúc ngữ pháp khi thi Topik I, đặc biệt là luyện giải đề thi với 16 dạng câu thường gặp trong Topik I.</p><h3><strong>Nội dung khóa học</strong></h3><p>Giáo trình khóa học có 75 bài giảng bao gồm các phần học chính như sau:</p><p>– Phần 1: Từ vựng thường gặp trong Topik 1</p><p>– Phần 2: Ngữ pháp cần biết trong Topik 1</p><p>– Phần 3: Luyện kỹ năng giải đề</p><p>Giảng viên Châu Thùy Trang tốt nghiệp khoa Hàn Quốc Ngữ trường Đại học Hannam, có 6 năm kinh nghiệm giảng dạy tiếng Hàn sẽ giúp bạn ôn luyện và chuẩn bị tốt nhất cho kì thi Topik I.</p><p>Vậy còn chần chừ gì mà không nhanh tay đăng ký tham gia khóa học <strong><em>Luyện Thi Topik I</em></strong> tại Unica.vn để có cơ hội chinh phục Topik I trong thời gian ngắn nhất !</p><p>Chúc các bạn thành công !</p>', 900000.00, 79000.00, 'courses/01J81FD09BSV4D2F7KCT61N5Y7.jpg', 'Châu Thùy Trang', '08 giờ 06 phút', 'Tất cả các cấp độ', 0, NULL, NULL, 0, 'active', '2024-09-17 19:29:22', '2024-09-17 19:29:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course_modules`
--

CREATE TABLE `course_modules` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_count` int NOT NULL DEFAULT '0',
  `download_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `course_modules`
--

INSERT INTO `course_modules` (`id`, `course_id`, `title`, `content`, `video_url`, `video_count`, `download_link`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Phần 1: 6 Phụ âm cơ bản đầu tiên', '<p>Bài 1: Âm TH không rung (Part 1)<br>Bài 2: Âm TH không rung (Part 2)<br>Bài 3: Âm TH rung (Part 1)<br>Bài 4: Âm TH rung (Part 2)<br>Bài 5: Âm S (Part 1)<br>Bài 6: Âm S (Part 2)<br>Bài 7: Âm Z (Part 1)<br>Bài 8: Âm Z (Part 2)<br>Bài 9: Âm Z (Part 3)<br>Bài 10: Âm F (Part 1)<br>Bài 11: Âm F (Part 2)<br>Bài 12: Âm F (Part 3)<br>Bài 13: Âm V (Part 1)<br>Bài 14: Âm V (Part 2)<br>Bài 15: Âm V (Part 3)</p>', NULL, 0, NULL, 0, '2024-09-17 19:20:55', '2024-09-17 19:20:55'),
(2, 1, 'Phần 2: 9 Phụ âm quan trọng tiếp theo', '<p>Bài 16: Âm T (Part 1)<br>Bài 17: Âm T (Part 2)<br>Bài 18: Âm T (Part 3)<br>Bài 19: Âm D<br>Bài 20: Âm SH không rung (Part 1)<br>Bài 21: Âm SH không rung (Part 2)<br>Bài 22: Âm SH rung<br>Bài 23: Âm CH<br>Bài 24: Âm D3 (Part 1)<br>Bài 25: Âm D3 (Part 2)<br>Bài 26: Âm W<br>Bài 27: Âm KW<br>Bài 28: Âm Y</p>', NULL, 0, NULL, 0, '2024-09-17 19:21:14', '2024-09-17 19:21:14'),
(3, 1, 'Phần 3: Các âm ghép trong tiếng Anh', '<p>Bài 29: Âm TR<br>Bài 30: Âm DR<br>Bài 31: Âm FR<br>Bài 32: Âm VR<br>Bài 33: Âm K<br>Bài 34: Âm KR<br>Bài 35: Âm G<br>Bài 36: Âm GR<br>Bài 37: Âm P<br>Bài 38: Âm PR<br>Bài 39: Âm B<br>Bài 40: Âm BR<br>Bài 41: Âm STR<br>Bài 42: Âm THR<br>Bài 43: Tổng kết khóa học</p>', NULL, 0, NULL, 0, '2024-09-17 19:21:25', '2024-09-17 19:21:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"293450db-a6a4-4b33-853e-d0153f4668a0\",\"displayName\":\"App\\\\Jobs\\\\FetchBankTransactionJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":5,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FetchBankTransactionJob\",\"command\":\"O:32:\\\"App\\\\Jobs\\\\FetchBankTransactionJob\\\":0:{}\"}}', 0, NULL, 1726878564, 1726878564),
(2, 'default', '{\"uuid\":\"236c9d88-d0a3-41a1-905a-01086aefe1e1\",\"displayName\":\"App\\\\Jobs\\\\CheckBankTransactionJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":60,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":\"10\",\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CheckBankTransactionJob\",\"command\":\"O:32:\\\"App\\\\Jobs\\\\CheckBankTransactionJob\\\":2:{s:19:\\\"\\u0000*\\u0000transaction_code\\\";s:8:\\\"NAPTIEN1\\\";s:10:\\\"\\u0000*\\u0000user_id\\\";i:1;}\"}}', 0, NULL, 1726878564, 1726878564);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_30_075623_create_user_details_table', 1),
(5, '2024_09_02_035333_create_products_table', 1),
(6, '2024_09_02_035443_create_carts_table', 1),
(7, '2024_09_02_075811_create_categories_table', 1),
(8, '2024_09_03_042850_create_wordpress_products_table', 1),
(9, '2024_09_03_044446_create_tags_table', 1),
(10, '2024_09_03_044648_create_courses_table', 1),
(11, '2024_09_03_045350_create_course_modules_table', 1),
(12, '2024_09_03_064801_create_social_accounts_table', 1),
(13, '2024_09_03_065113_create_social_account_products_table', 1),
(14, '2024_09_03_074945_create_social_account_product_attributes_table', 1),
(15, '2024_09_08_164946_create_other_products_table', 1),
(16, '2024_09_09_035542_create_cart_items_table', 1),
(17, '2024_09_09_060613_add_category_id_to_social_accounts_table', 1),
(18, '2024_09_10_070950_category_social_account_product', 1),
(19, '2024_09_12_012831_create_media_table', 1),
(20, '2024_09_12_025428_add_attribute_id_to_cart_items_table', 1),
(21, '2024_09_12_032511_add_quantity_to_social_account_product_attributes', 1),
(22, '2024_09_12_040704_create_orders_and_order_items_tables', 1),
(23, '2024_09_13_035546_create_website_settings_table', 1),
(24, '2024_09_15_131328_create_wishlists_table', 1),
(25, '2024_09_16_021521_create_reviews_table', 1),
(26, '2024_09_16_030548_create_wallets_table', 1),
(27, '2024_09_16_030902_create_transactions_table', 1),
(28, '2024_09_16_111303_create_bank_transactions_table', 1),
(29, '2024_09_16_122215_add_is_read_column_to_bank_transactions_table', 1),
(30, '2024_09_09_035444_create_carts_table', 2),
(31, '2024_09_18_115951_remove_social_account_id_from_social_account_products', 2),
(32, '2024_09_18_132044_add_attributes_and_status_to_social_account_product_attributes', 2),
(33, '2024_09_18_134607_add_country_to_social_account_products_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `social_account_product_id` bigint UNSIGNED DEFAULT NULL,
  `wordpress_product_id` bigint UNSIGNED DEFAULT NULL,
  `course_product_id` bigint UNSIGNED DEFAULT NULL,
  `attribute_id` bigint UNSIGNED DEFAULT NULL,
  `other_product_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `other_products`
--

CREATE TABLE `other_products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` json DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `demo_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `sold_quantity` int DEFAULT '0',
  `system_requirements` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `additional_data` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `other_products`
--

INSERT INTO `other_products` (`id`, `name`, `slug`, `category_id`, `thumbnail`, `gallery`, `type`, `description`, `demo_link`, `download_link`, `price`, `stock`, `sold_quantity`, `system_requirements`, `created_at`, `updated_at`, `status`, `additional_data`) VALUES
(1, 'Key kích hoạt Voicemod Pro 1 tháng PC/MAC', 'key-kich-hoat-voicemod-pro-1-thang-pcmac', 11, 'OtherProduct/01J81JQZMV8H8SN3STNNSBBVB9.png', '[{\"image\": null}]', NULL, '<h2>Key kích hoạt Voicemod Pro là gì&nbsp;</h2><p>Key kích hoạt Voicemod Pro là một phần mềm giúp người dùng thay đổi được giọng nói và tạo hiệu ứng âm thanh độc đáo trong quá trình trò chuyện trực tuyến và ghi âm. Phần mềm này cho phép bạn thay đổi được giọng nói của mình thành nhiều giọng khác nhau, từ giọng trẻ con đến giọng robot, giọng hài hước,.. Người dùng có thể sử dụng Voicemod Pro trong các cuộc trò chuyện trực tuyến qua ứng dụng như Discord, Skype, VRChat, PUBG, và nhiều nền tảng trò chơi và ứng dụng khác.</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:500,&quot;url&quot;:&quot;https://gamikey.com/wp-content/uploads/2024/03/key-kich-hoat-voicemod-pro-1-thang-pc-mac.png&quot;,&quot;width&quot;:800}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><img src=\"https://gamikey.com/wp-content/uploads/2024/03/key-kich-hoat-voicemod-pro-1-thang-pc-mac.png\" width=\"800\" height=\"500\"><figcaption class=\"attachment__caption\"></figcaption></figure><br><em>Voicemod Pro, một phần mềm thay đổi được giọng nói, hiệu ứng âm thanh<br></em><br></p><p>Ngoài ra, thì Voicemod Pro cung cấp một bộ sưu tập lớn các hiệu ứng âm thanh và giọng nói để bạn tùy chỉnh và tạo ra âm thanh độc đáo. Bạn có thể điều chỉnh tốc độ, âm lượng và cường độ của hiệu ứng âm thanh, tạo ra sự đa dạng và sáng tạo trong trò chuyện của mình. Voicemod Pro cũng hỗ trợ ghi âm và phát lại các tệp âm thanh với hiệu ứng đã tạo để bạn có thể chia sẻ hoặc sử dụng lại chúng.</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:500,&quot;url&quot;:&quot;https://gamikey.com/wp-content/uploads/2024/03/key-kich-hoat-voicemod-pro-1-thang-pc-mac-1.png&quot;,&quot;width&quot;:800}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><img src=\"https://gamikey.com/wp-content/uploads/2024/03/key-kich-hoat-voicemod-pro-1-thang-pc-mac-1.png\" width=\"800\" height=\"500\"><figcaption class=\"attachment__caption\"></figcaption></figure><br><em>Voicemod Pro cung cấp hiệu ứng âm thanh, ghi âm và phát lại các tệp âm<br></em><br></p><p>Nếu bạn là một streamer, game thủ và những người yêu thích tạo nội dung trực tuyến, thì đây chắc chắn là một phần mềm thú vị, bởi nó sẽ giúp bạn tạo ra những trải nghiệm sáng tạo và thú vị trong quá trình trò chuyện và tương tác với người xem.</p><h2>Key kích hoạt Voicemod Pro có những tính năng tương thích nào?</h2><p>Voicemod Pro có tính năng tương thích với nhiều ứng dụng và nền tảng khác nhau. Dưới đây là một số tính năng tương thích phổ biến của Voicemod Pro:</p><ul><li>Bộ sưu tập giọng nói và hiệu ứng âm thanh độc quyền: Voicemod Pro cung cấp nhiều giọng nói và hiệu ứng âm thanh hơn so với phiên bản miễn phí.</li><li>Tạo giọng nói tùy chỉnh: Bạn có thể sử dụng Voicemod Pro để tạo giọng nói của riêng mình bằng cách ghi âm giọng nói của bạn và áp dụng các hiệu ứng âm thanh.</li></ul><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:500,&quot;url&quot;:&quot;https://gamikey.com/wp-content/uploads/2024/03/key-kich-hoat-voicemod-pro-1-thang-pc-mac-2.png&quot;,&quot;width&quot;:800}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><img src=\"https://gamikey.com/wp-content/uploads/2024/03/key-kich-hoat-voicemod-pro-1-thang-pc-mac-2.png\" width=\"800\" height=\"500\"><figcaption class=\"attachment__caption\"></figcaption></figure><br><em>Voicemod Pro giúp tạo giọng nói của riêng mình bằng cách ghi âm và sử dụng hiệu ứng âm thanh.<br></em><br></p><ul><li>Loại bỏ tiếng ồn: Voicemod Pro có thể loại bỏ tiếng ồn nền khỏi micrô của bạn, giúp cho giọng nói của bạn nghe rõ ràng hơn.</li><li>Ứng dụng trò chuyện trực tuyến: Phần mềm này tương thích với các ứng dụng trò chuyện và gọi video như Discord, Skype, TeamSpeak, Twitch, OBS, VRChat và nhiều ứng dụng khác. Bạn có thể thay đổi giọng nói và áp dụng hiệu ứng âm thanh trong quá trình trò chuyện trực tuyến với bạn bè hoặc cộng đồng.</li><li>Trò chơi trực tuyến: Voicemod Pro tương thích với nhiều nền tảng trò chơi trực tuyến như Fortnite, PUBG, League of Legends, Minecraft và nhiều trò chơi khác. Bạn có thể tạo ra giọng nói và âm thanh độc đáo để tương tác với người chơi khác trong trò chơi.</li><li>Ghi âm và phát lại: Phần mềm cho phép bạn ghi âm giọng nói của mình và áp dụng hiệu ứng âm thanh để tạo ra các tệp âm thanh độc đáo. Bạn có thể lưu trữ và chia sẻ các tệp ghi âm này hoặc sử dụng lại chúng trong các tương tác trực tuyến khác.</li></ul><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:500,&quot;url&quot;:&quot;https://gamikey.com/wp-content/uploads/2024/03/key-kich-hoat-voicemod-pro-1-thang-pc-mac-3.png&quot;,&quot;width&quot;:800}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><img src=\"https://gamikey.com/wp-content/uploads/2024/03/key-kich-hoat-voicemod-pro-1-thang-pc-mac-3.png\" width=\"800\" height=\"500\"><figcaption class=\"attachment__caption\"></figcaption></figure><br><em>Voicemod Pro tương thích với nhiều nền tảng trò chơi trực tuyến như Fortnite, PUBG, League of Legends,….<br></em><br></p><ul><li>Phần mềm chỉnh sửa âm thanh: Voicemod Pro cung cấp tính năng tương thích với các phần mềm chỉnh sửa âm thanh như Adobe Audition, Audacity và các ứng dụng khác. Bạn có thể nhập các tệp âm thanh đã ghi âm và chỉnh sửa chúng để tạo ra các hiệu ứng âm thanh phức tạp hơn.</li></ul><p><br></p>', NULL, NULL, 149000.00, 1000, 12, NULL, '2024-09-17 20:27:47', '2024-09-21 21:49:29', 'active', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_content` text COLLATE utf8mb4_unicode_ci,
  `long_content` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `stock` int UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `reviewable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewable_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `comment`, `rating`, `user_id`, `reviewable_type`, `reviewable_id`, `created_at`, `updated_at`) VALUES
(1, 'ok', 5, 1, 'App\\Models\\OtherProduct', 1, '2024-09-17 20:30:30', '2024-09-17 20:30:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('yWYVn1S6UHTNqcBEfVF8FMk7sx0snhMJA85ep43i', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiUlpSR0w5OGs3SklmZmg3eGNaMjNKeW1PbGpkNGJmMTM2cm03c1NYdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkemdjTEh6b3ZucHdyQlc3VzJmdWJxZVFyRmRiYzB1MXpMcXY4N21OZnlhQk5yakpnTkVVRDYiO3M6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1726987300);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `social_accounts`
--

CREATE TABLE `social_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `social_accounts`
--

INSERT INTO `social_accounts` (`id`, `category_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 5, 'Facebook', 'facebook', '2024-09-17 01:02:20', '2024-09-17 01:02:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `social_account_products`
--

CREATE TABLE `social_account_products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `sold` int NOT NULL DEFAULT '0',
  `price` decimal(10,2) DEFAULT NULL,
  `short_content` text COLLATE utf8mb4_unicode_ci,
  `long_content` longtext COLLATE utf8mb4_unicode_ci,
  `data_account` longtext COLLATE utf8mb4_unicode_ci,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `social_account_products`
--

INSERT INTO `social_account_products` (`id`, `name`, `slug`, `thumbnail`, `stock`, `sold`, `price`, `short_content`, `long_content`, `data_account`, `country`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'FACEBOOK VIỆT CỔ 1000-5000 BẠN BÈ TẠO 2005-2022', 'facebook-viet-co-1000-5000-ban-be-tao-2005-2022', 'Social/01J81G8645NR09VH8MHM2NMGTZ.png', 0, 0, NULL, NULL, '<p>LƯU Ý : ĐĂNG NHẬP BẰNG M.FACEBOOK ĐỂ TRÁNH XÁC MINH DANH TÍNH&nbsp;</p><p>- NÊN NGÂM 1 2 NGÀY RỒI THAY ĐỔI THÔNG TIN TẠI TRANG . FACEBOOK.HACKED</p><p>- BẢO HÀNH LOGIN SAU 6H KỂ TỪ KHI LOGIN THÀNH CÔNG ( KHÔNG BẢO HÀNH CHO VIỆC&nbsp; IP XẤU DẪN TỚI KHÓA NÍCH )</p><p>- NÍCH GHI ĐÚNG MÔ TẢ : KHÔNG ĐÚNG MÔ TẢ SHOP ĐỀN Ạ</p><p>ĐỊNH DẠNG NÍCH :&nbsp; UID|PASS|2FA|MAIL|PASSMAIL</p><p><strong>CÁCH ĐỂ TRÁNH BỊ KHÓA TÀI KHOẢN :&nbsp;</strong></p><p><strong>NÊN THAY ĐỔI THÔNG TIN 1 NGÀY THAY ĐỔI 1 CÁI VÍ DỤ TÊN , THAY XONG NGÀY SAU CẬP NHẤT AVT, THAY ĐỔI TỪ TỪ THEO Ý KHÁCH HÀNH</strong></p><p><strong>NÊN SÀI 1 CHOME 1 PROXY ĐỂ LOGIN FACEBOOK , KHÔNG SÀI 1 ĐỊA CHỈ IP ĐỂ LOGIN NHIỀU FACEBOOK LÀM VẬY FACEBOOK SẼ PHÁT HIỆN SPAM ĐÓ.</strong></p><p>CẢM ƠN KHÁCH HÀNG CẦN HỖ TRỢ GÌ CỨ NHẮN TIN SHOP NHÉ . CẢM ƠN</p>', NULL, NULL, '2024-09-17 19:44:13', '2024-09-17 19:44:13', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `social_account_product_attributes`
--

CREATE TABLE `social_account_product_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `social_product_id` bigint UNSIGNED NOT NULL,
  `attribute_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `account_data` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('inactive','active','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `social_account_product_attributes`
--

INSERT INTO `social_account_product_attributes` (`id`, `social_product_id`, `attribute_name`, `additional_price`, `created_at`, `updated_at`, `quantity`, `account_data`, `status`) VALUES
(1, 1, 'FB THẬT CÓ >10 BÀI ĐĂNG EDIT 0-5000 BB >18T TẠO 2015-2022', 59999.00, '2024-09-17 19:44:13', '2024-09-17 19:44:13', 1116, NULL, 'inactive'),
(2, 1, 'FB VN >20 BÀI THAY ẢNH(NGẪU NHIÊN) KO CÓ TG >18T', 79999.00, '2024-09-17 19:44:13', '2024-09-17 19:44:13', 230, NULL, 'inactive'),
(3, 1, 'FB VN NỮ RD 2000-5000 BẠN BÈ 2015-2023 CÓ BÀI ĐĂNG TRÊN 18T ', 99999.00, '2024-09-17 19:44:13', '2024-09-17 19:44:13', 210, NULL, 'inactive');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `wallet_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `transaction_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nht2312', 'huutai90909@gmail.com', NULL, '$2y$12$zgcLHzovnpwrBW7W2fubqeQrFdbc0u1zLqv87mNfyaBNrjJgNEUD6', '3IRWq3mmy56Fn7AoQPyQhR9OYWxbdygPl3135LxoO4TEKZrCUEm9rOmodS80', '2024-09-16 21:06:17', '2024-09-16 21:06:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('customer','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `banned` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `username`, `fullname`, `phone`, `ip_address`, `role`, `banned`, `created_at`, `updated_at`) VALUES
(1, 1, 'nht2312', NULL, NULL, '127.0.0.1', 'admin', '0', '2024-09-16 21:06:17', '2024-09-16 21:06:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `website_settings`
--

CREATE TABLE `website_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_description` text COLLATE utf8mb4_unicode_ci,
  `site_keywords` text COLLATE utf8mb4_unicode_ci,
  `site_author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_policy` text COLLATE utf8mb4_unicode_ci,
  `warranty_policy` text COLLATE utf8mb4_unicode_ci,
  `privacy_policy` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `website_settings`
--

INSERT INTO `website_settings` (`id`, `email`, `support_phone`, `logo`, `favicon`, `site_name`, `site_description`, `site_keywords`, `site_author`, `payment_policy`, `warranty_policy`, `privacy_policy`, `created_at`, `updated_at`) VALUES
(1, 'admin@technt.net', '0987654321', NULL, NULL, 'KHO68', NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-17 07:59:24', '2024-09-17 07:59:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wordpress_products`
--

CREATE TABLE `wordpress_products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` json DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `version` text COLLATE utf8mb4_unicode_ci,
  `short_content` text COLLATE utf8mb4_unicode_ci,
  `long_content` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `sold` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_requirements` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_expiration_date` date DEFAULT NULL,
  `views` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wordpress_products`
--

INSERT INTO `wordpress_products` (`id`, `category_id`, `name`, `slug`, `image`, `gallery`, `sku`, `type`, `status`, `version`, `short_content`, `long_content`, `price`, `sale_price`, `sold`, `demo`, `download_link`, `system_requirements`, `license_key`, `license_expiration_date`, `views`, `created_at`, `updated_at`) VALUES
(1, 3, 'Wizor’s | Investments & Business WordPress Theme', 'wizors-investments-business-wordpress-theme', 'Wordpress/01J86MJAZR7EX379HDK8ZYJPXP.webp', '[]', 'K68-RCGCAC', NULL, 'active', '2.12', '<ul><li>Hỗ trợ tư vấn Theme &amp; Plugin miễn phí</li><li>Miễn phí cài đặt import Theme giống mẫu demo</li><li>Sử dụng không giới hạn Website, tên miền</li></ul><p><br></p>', '<ul><li>Hỗ trợ tư vấn Theme &amp; Plugin miễn phí</li><li>Sử dụng không giới hạn Website, tên miền</li><li>Miễn phí cài đặt import Theme giống mẫu demo</li><li>Miễn phí thay logo, màu sắc chủ đạo, Hotline, Chat</li></ul><p><br></p>', 99000.00, NULL, NULL, 'https://wizors.ancorathemes.com/splash/#', NULL, NULL, NULL, NULL, 0, '2024-09-19 19:35:52', '2024-09-19 19:35:52'),
(2, 3, 'Vara – Architecture WordPress Theme', 'vara-architecture-wordpress-theme', 'Wordpress/01J86R5KETB60VEP8E83PCTGV8.webp', '[]', 'K68-LMWKO5', NULL, 'active', '1.2.1', NULL, '<h2><strong>Các tính năng chính của Theme Vara WordPress:</strong></h2><ul><li>Biểu tượng FontAwesome</li><li>Bố cục đáp ứng trên Bootstrap</li><li>Bao gồm thanh trượt Revolution</li><li>Khả năng tương thích giữa các trình duyệt: Firefox, Safari, Chrome, IE11+</li><li>Tùy chọn chủ đề với Kirki Customizer</li><li>Parallax và nền video</li><li>Hỗ trợ chuyên nghiệp 24/7</li><li>Sẵn sàng dịch</li><li>Tương thích với WooCommerce</li><li>Tùy chỉnh màu sắc không giới hạn</li><li>Hơn 800 Phông chữ Google</li><li>Tùy chỉnh tiêu đề</li><li>Trình tạo trang Elementor tuyệt vời</li><li>Thiết kế sáng tạo</li><li>Một trang và Nhiều trang</li><li>Tối ưu hóa và hỗ trợ SEO</li><li>Tùy chọn trang linh hoạt dễ sử dụng</li><li>Tài liệu trực tuyến</li><li>Tùy chọn hiển thị phản hồi</li><li>Bao gồm chủ đề con</li><li>Biểu mẫu liên hệ 7</li><li>Mã HTML hợp lệ của W3C</li><li>Không cần kiến ​​thức lập trình</li><li>Hỗ trợ plugin JetPack</li><li>Hỗ trợ plugin Yoast SEO</li><li>Cập nhật thường xuyên</li><li>Nhập nội dung demo chỉ bằng một cú nhấp chuột</li><li>Và nhiều hơn nữa…</li></ul><p><br></p>', 100000.00, 99000.00, '12', 'https://gradastudio.com/vara/', NULL, NULL, NULL, NULL, 0, '2024-09-19 20:38:49', '2024-09-19 20:52:04'),
(3, 3, 'Webteck – IT Solution and Technology WordPress Theme', 'webteck-it-solution-and-technology-wordpress-theme', 'Wordpress/01J86RNP6H1VH234VP1530BKKB.webp', '[]', 'K68-8R8AFQ', NULL, 'active', '1.0', NULL, '<ul><li>Hỗ trợ tư vấn Theme &amp; Plugin miễn phí</li><li>Sử dụng không giới hạn Website, tên miền</li><li>Miễn phí cài đặt import Theme giống mẫu demo</li><li>Miễn phí thay logo, màu sắc chủ đạo, Hotline, Chat</li></ul><p><br></p>', 119000.00, NULL, '40', 'https://preview.themeforest.net/item/webteck-it-solution-and-technology-wordpress-theme/full_screen_preview/50460704?_ga=2.92461080.483151661.1714872017-605661150.1707760096', NULL, NULL, NULL, NULL, 0, '2024-09-19 20:47:36', '2024-09-19 20:47:36'),
(4, 3, 'Neuros | AI Agency & Technology WordPress Theme', 'neuros-ai-agency-technology-wordpress-theme', 'Wordpress/01J86TCA3DVN3CRCBPEWXCTPDE.webp', '[]', 'K68-KB5KU3', NULL, 'active', '1.3.0', NULL, '<p>Giới thiệu <strong>Neuros – Theme WordPress AI-Powered</strong> tuyệt đỉnh Khám phá tương lai của các theme WordPress với Neuros. Theme sáng tạo này khai thác sức mạnh của trí tuệ nhân tạo để tạo ra một trang web thực sự thích ứng và tùy chỉnh cho bất kỳ ngành hoặc ngách nào.</p><p><strong>Được xây dựng cho tính linh hoạt</strong></p><p>Neuros vượt qua những hạn chế của các chủ đề WordPress truyền thống nhờ thiết kế phổ quát của nó. Nó có thể cung cấp năng lượng cho các trang web trong hầu như bất kỳ lĩnh vực nào – cho dù bạn cần</p><p><strong>danh mục đầu tư, công ty sáng tạo, doanh nghiệp, công ty, công nghiệp, trang web tiếp thị, công ty AI và khởi nghiệp, công nghệ hiện đại</strong></p><p>và hơn thế nữa, Neuros sẽ hỗ trợ bạn. Thiết kế hiện đại, bóng bẩy tạo nên tuyên bố nhưng vẫn đủ linh hoạt để phù hợp với nhu cầu của nhiều trang web khác nhau. Với sự trợ giúp của Neuros, bạn có thể tạo:</p><ul><li><ul><li><strong>Các trang web danh mục đầu tư bóng bẩy</strong></li></ul></li></ul><p>Tính thẩm mỹ hiện đại, thanh lịch rất phù hợp với các trang web danh mục đầu tư để giới thiệu tác phẩm sáng tạo. Các nhiếp ảnh gia, nhà thiết kế, nghệ sĩ và những người sáng tạo khác có thể để các dự án của họ tỏa sáng.</p><ul><li><ul><li><strong>Các trang web của Cơ quan mạnh mẽ</strong></li></ul></li></ul><p>Thiết kế web, tiếp thị, quảng cáo, tư vấn và các cơ quan khác có thể tận dụng Neuros để truyền đạt chuyên môn. Tích hợp AI cũng chứng minh khả năng tiên tiến của bạn.</p><ul><li><ul><li><strong>Lý tưởng cho các trang web kinh doanh</strong></li></ul></li></ul><p>Bất kể ngành nghề của bạn là gì, Neuros đều mang đến giao diện chuyên nghiệp, bóng bẩy hoàn hảo cho mọi loại hình doanh nghiệp. Tính linh hoạt đáp ứng nhu cầu từ các trang web của công ty đến các nhà bán lẻ, tài chính, tư vấn, chăm sóc sức khỏe, v.v.</p><ul><li><ul><li><strong>Cân cho sự tăng trưởng</strong></li></ul></li></ul><p>Neuros có các tính năng mạnh mẽ và các tùy chọn thiết kế mở rộng để mở rộng quy mô với tổ chức của bạn. Nó xử lý các nhu cầu khắt khe của các trang web cấp doanh nghiệp.</p><ul><li><ul><li><strong>Các trang web tiếp thị tập trung vào chuyển đổi</strong></li></ul></li></ul><p>Đối với các trang web công ty tập trung vào việc tạo khách hàng tiềm năng và bán hàng, Neuros cung cấp tất cả các công cụ cho các trang đích và kênh chuyển đổi cao. Tối ưu hóa để tối đa hóa ROI.</p>', 119000.00, NULL, '79', 'https://demo.artureanec.com/themes/neuros/intro/#demo', NULL, NULL, NULL, NULL, 0, '2024-09-19 21:17:26', '2024-09-19 21:17:26'),
(5, 3, 'Truvik – Immigration Consulting WordPress Theme + RTL', 'truvik-immigration-consulting-wordpress-theme-rtl', 'Wordpress/01J86TE3K9NVNH6XCMG3PY6ANR.webp', '[]', 'K68-S1Q1W0', NULL, 'active', '1.5', NULL, '<p><strong>Truvik</strong> là một theme WordPress mang tính biểu tượng được thiết kế đặc biệt để tư vấn thị thực, nhà cung cấp dịch vụ nhập cư, luật sư nhập cư, tư vấn, đại lý di trú, việc làm ở nước ngoài, các trang web liên quan đến lớp huấn luyện.</p><h2><strong>Truvik là sự kết hợp hoàn hảo cho một số lĩnh vực như</strong></h2><ul><li><strong>Kinh doanh &amp;; Dịch vụ: </strong>Đại lý Visa, Tư vấn Visa, Dịch vụ xuất nhập cảnh, Luật sư di trú Dịch vụ pháp lý: Việc làm ở nước ngoài, Lớp huấn luyện, Dịch vụ Visa</li><li><strong>Blog:</strong> Thích hợp cho tất cả các loại giáo dục, tour du lịch, tarvels, blog, bài viết, trang web</li></ul><p>Chúng tôi đã xây dựng Truvik rất dễ dàng và rất tương thích để bạn có thể sử dụng nó để tạo bất kỳ trang web kinh doanh nhu cầu nào của mình.<br>Chủ đề bao gồm tất cả các trang bên trong quan trọng như Trang chủ tuyệt đẹp, Giới thiệu, Dịch vụ của bạn, Huấn luyện, Quốc gia, Liên hệ với chúng tôi, Nhóm, Tin tức, Đánh giá, v.v. Chủ đề rất dễ tùy chỉnh với trình tạo trang Elementor và nó có rất nhiều tính năng và bảng quản trị rất mạnh cho bất kỳ khách hàng nào để tạo một trang web tốt một cách nhanh chóng.</p>', 99000.00, NULL, '123', 'https://truvik.preyantechnosys.com/', NULL, NULL, NULL, NULL, 0, '2024-09-19 21:18:25', '2024-09-19 21:18:25'),
(6, 3, 'King – Viral Magazine WordPress Theme', 'king-viral-magazine-wordpress-theme', 'Wordpress/01J86TFVGMXYDB83SVC0F8P7VC.jpg', '[]', 'K68-K05LX5', NULL, 'active', '9.5.2', NULL, '<p><strong>King</strong> là một theme WordPress dành cho Tạp chí Viral được thiết kế để giúp nội dung của bạn lan truyền… Chủ đề King có các tính năng độc đáo, cho phép người dùng cộng đồng gửi tin tức, video, hình ảnh, danh sách, cuộc thăm dò và câu đố đố, đồng thời nó đi kèm với các trang hồ sơ người dùng, hệ thống theo dõi, nút chia sẻ, danh sách hấp dẫn, thịnh hành và nhiều vị trí quảng cáo, v.v.… tất cả đều có trong chủ đề, không cần plugin . Nếu bạn muốn làm cho trang web của mình tương tác hơn, King Theme có nhiều tính năng hay trong lĩnh vực này. Chủ đề King là một kiệt tác hiện đại sẽ biến trang web của bạn thành một trang web lan truyền lý tưởng. Hãy độc đáo với chủ đề King Viral…</p>', 98000.00, NULL, '222', 'https://wp.kingthemes.net/promo/#homedemos', NULL, NULL, NULL, NULL, 0, '2024-09-19 21:19:22', '2024-09-19 21:19:22'),
(7, 2, 'ARPrice – WordPress Pricing Table Plugin', 'arprice-wordpress-pricing-table-plugin', 'Wordpress/01J86THZRFVV7ZW9DJFRR4R5BM.webp', '[]', 'K68-SVX43B', NULL, 'active', NULL, NULL, '<p><strong>ARPrice</strong> là <strong>plugin bảng giá</strong> đầy đủ và đầy đủ tính năng nhất cho WordPress năm 2024 với 300+ mẫu bảng giá, cung cấp cho bạn tất cả các công cụ bạn cần để xây dựng các kế hoạch định giá và bảng so sánh độc đáo và đáp ứng trong vài phút. Bạn cũng có thể tạo ra màn trình diễn đội đẹp một cách dễ dàng.<br>Bảng điều khiển ARPrice đẹp và trực quan thực sự là một trong những loại, với trình chỉnh sửa thời gian thực ấn tượng. Chọn một mẫu và sau đó sử dụng các công cụ nhấp, kéo và thả đơn giản để tùy chỉnh bảng của bạn, đến từng chi tiết cuối cùng. Bạn có thể thêm số lượng cột không giới hạn, thay đổi màu sắc, phông chữ và biểu tượng và thêm hình ảnh và ruy băng của riêng bạn (ví dụ: để quảng cáo giảm giá).</p>', 89000.00, NULL, '86', 'https://www.arpriceplugin.com/', NULL, NULL, NULL, NULL, 0, '2024-09-19 21:20:32', '2024-09-19 21:20:32');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_wordpress_product_id_foreign` (`wordpress_product_id`),
  ADD KEY `cart_items_social_account_product_id_foreign` (`social_account_product_id`),
  ADD KEY `cart_items_course_product_id_foreign` (`course_product_id`),
  ADD KEY `cart_items_other_product_id_foreign` (`other_product_id`),
  ADD KEY `cart_items_attribute_id_foreign` (`attribute_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Chỉ mục cho bảng `category_social_account_product`
--
ALTER TABLE `category_social_account_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_social_account_product_category_id_foreign` (`category_id`),
  ADD KEY `fk_category_social_product` (`social_account_product_id`);

--
-- Chỉ mục cho bảng `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `course_modules`
--
ALTER TABLE `course_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_modules_course_id_foreign` (`course_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `other_products`
--
ALTER TABLE `other_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `other_products_slug_unique` (`slug`),
  ADD KEY `other_products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_reviewable_type_reviewable_id_index` (`reviewable_type`,`reviewable_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `social_accounts_slug_unique` (`slug`),
  ADD KEY `social_accounts_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `social_account_products`
--
ALTER TABLE `social_account_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `social_account_products_slug_unique` (`slug`),
  ADD KEY `social_account_products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `social_account_product_attributes`
--
ALTER TABLE `social_account_product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_account_product_attributes_social_product_id_foreign` (`social_product_id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_wallet_id_foreign` (`wallet_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `wordpress_products`
--
ALTER TABLE `wordpress_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wordpress_products_sku_unique` (`sku`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `category_social_account_product`
--
ALTER TABLE `category_social_account_product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `course_modules`
--
ALTER TABLE `course_modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `other_products`
--
ALTER TABLE `other_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `social_accounts`
--
ALTER TABLE `social_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `social_account_products`
--
ALTER TABLE `social_account_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `social_account_product_attributes`
--
ALTER TABLE `social_account_product_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `wordpress_products`
--
ALTER TABLE `wordpress_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `social_account_product_attributes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_course_product_id_foreign` FOREIGN KEY (`course_product_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_other_product_id_foreign` FOREIGN KEY (`other_product_id`) REFERENCES `other_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_social_account_product_id_foreign` FOREIGN KEY (`social_account_product_id`) REFERENCES `social_account_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_wordpress_product_id_foreign` FOREIGN KEY (`wordpress_product_id`) REFERENCES `wordpress_products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `category_social_account_product`
--
ALTER TABLE `category_social_account_product`
  ADD CONSTRAINT `category_social_account_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_category_social_product` FOREIGN KEY (`social_account_product_id`) REFERENCES `social_account_products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `course_modules`
--
ALTER TABLE `course_modules`
  ADD CONSTRAINT `course_modules_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `other_products`
--
ALTER TABLE `other_products`
  ADD CONSTRAINT `other_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `social_account_products`
--
ALTER TABLE `social_account_products`
  ADD CONSTRAINT `social_account_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `social_account_product_attributes`
--
ALTER TABLE `social_account_product_attributes`
  ADD CONSTRAINT `social_account_product_attributes_social_product_id_foreign` FOREIGN KEY (`social_product_id`) REFERENCES `social_account_products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
