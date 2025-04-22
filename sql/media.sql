-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 25, 2024 lúc 03:56 PM
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
-- Cấu trúc bảng cho bảng `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `directory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'media',
  `visibility` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` int UNSIGNED DEFAULT NULL,
  `height` int UNSIGNED DEFAULT NULL,
  `size` int UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `exif` text COLLATE utf8mb4_unicode_ci,
  `curations` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tenant_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `media`
--

INSERT INTO `media` (`id`, `disk`, `directory`, `visibility`, `name`, `path`, `width`, `height`, `size`, `type`, `ext`, `alt`, `title`, `description`, `caption`, `exif`, `curations`, `created_at`, `updated_at`, `tenant_id`) VALUES
(1, 'public', 'media', 'public', 'dd037326-7961-4974-b512-4f0f498e6e97', 'media/dd037326-7961-4974-b512-4f0f498e6e97.png', 1920, 1925, 895660, 'image/png', 'png', NULL, 'screencapture-technt-net-category-source-code-2024-08-06-17_07_37', NULL, NULL, NULL, NULL, '2024-09-22 20:48:07', '2024-09-22 20:48:07', NULL),
(2, 'public', 'media', 'public', 'fb3a7978-061d-4d2e-81f9-8919e964b317', 'media/fb3a7978-061d-4d2e-81f9-8919e964b317.png', 1920, 4202, 3402695, 'image/png', 'png', NULL, 'screencapture-lambangdaihocphoithat-dich-vu-lam-bang-dai-hoc-gia-re-page-5-2024-09-05-22_54_37', NULL, NULL, NULL, NULL, '2024-09-22 22:18:00', '2024-09-22 22:18:00', NULL),
(4, 'public', 'media', 'public', '9250ae6f-2b9f-4c1f-9593-b4ed4d6d6ddf', 'media/9250ae6f-2b9f-4c1f-9593-b4ed4d6d6ddf.png', 1920, 1554, 183967, 'image/png', 'png', NULL, 'screencapture-technt-net-wp-admin-admin-php-2024-06-30-11_24_27', NULL, NULL, NULL, NULL, '2024-09-25 02:38:57', '2024-09-25 02:38:57', NULL),
(5, 'public', 'media', 'public', '18762c47-6689-411c-ac2c-8a8317c7f625', 'media/18762c47-6689-411c-ac2c-8a8317c7f625.png', 1920, 1080, 260284, 'image/png', 'png', NULL, 'hncbtn', NULL, NULL, NULL, NULL, '2024-09-25 02:47:20', '2024-09-25 02:47:20', NULL),
(6, 'public', 'media', 'public', 'bafcb6b7-00cd-4cea-8f73-dde81ce3275d', 'media/bafcb6b7-00cd-4cea-8f73-dde81ce3275d.png', 1920, 1277, 153744, 'image/png', 'png', NULL, 'ok', NULL, NULL, NULL, NULL, '2024-09-25 03:22:51', '2024-09-25 03:22:51', NULL),
(7, 'public', 'SettingWebsite', 'public', 'a6e7b6d6-1589-4a69-8524-fdfc479c7593', 'SettingWebsite/a6e7b6d6-1589-4a69-8524-fdfc479c7593.png', 500, 500, 10831, 'image/png', 'png', NULL, 'maymacnano', NULL, NULL, NULL, NULL, '2024-09-25 08:54:47', '2024-09-25 08:54:47', NULL),
(8, 'public', 'SettingWebsite', 'public', 'ed504fd0-2b1b-4366-96bb-b400b81c87a8', 'SettingWebsite/ed504fd0-2b1b-4366-96bb-b400b81c87a8.png', 500, 500, 9529, 'image/png', 'png', NULL, 'fm', NULL, NULL, NULL, NULL, '2024-09-25 08:55:10', '2024-09-25 08:55:10', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
