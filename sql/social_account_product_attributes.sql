-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3308
-- Thời gian đã tạo: Th9 12, 2024 lúc 05:56 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

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
-- Cấu trúc bảng cho bảng `social_account_product_attributes`
--

CREATE TABLE `social_account_product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `social_product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `additional_price` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `social_account_product_attributes`
--

INSERT INTO `social_account_product_attributes` (`id`, `social_product_id`, `attribute_name`, `additional_price`, `created_at`, `updated_at`, `quantity`) VALUES
(5, 4, 'FB Có Trên 70 BÀI VIẾT TỪ NĂM 2023→2024 Bao VIP', 50000, '2024-09-11 04:25:43', '2024-09-11 20:29:24', 100),
(6, 4, 'FB CÓ TỪ 80-300 BÀI VIẾT TỪ NĂM 2022-2024 Ít Bài 2024', 100000, '2024-09-11 20:10:14', '2024-09-11 20:29:24', 200),
(7, 4, 'Facebook Có Random Bài viết từ năm 2023→24 Trên 20 Bài Viết ', 150000, '2024-09-11 20:10:14', '2024-09-11 20:29:24', 300),
(8, 4, 'FB CÓ TỪ 50-150 BÀI VIẾT TỪ NĂM 2024 DÙNG SIÊU NGON', 200000, '2024-09-11 20:10:14', '2024-09-11 20:29:24', 10),
(9, 4, 'FB Có Trên 80 BÀI VIẾT TỪ NĂM 2022→2023 vip', 400000, '2024-09-11 20:10:14', '2024-09-11 20:29:24', 20),
(10, 5, '4123', 124, '2024-09-11 20:46:34', '2024-09-11 20:46:34', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `social_account_product_attributes`
--
ALTER TABLE `social_account_product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_account_product_attributes_social_product_id_foreign` (`social_product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `social_account_product_attributes`
--
ALTER TABLE `social_account_product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `social_account_product_attributes`
--
ALTER TABLE `social_account_product_attributes`
  ADD CONSTRAINT `social_account_product_attributes_social_product_id_foreign` FOREIGN KEY (`social_product_id`) REFERENCES `social_account_products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
