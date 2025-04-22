-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3308
-- Thời gian đã tạo: Th9 22, 2024 lúc 09:01 AM
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
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(2, 'view_any_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(3, 'create_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(4, 'update_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(5, 'restore_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(6, 'restore_any_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(7, 'replicate_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(8, 'reorder_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(9, 'delete_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(10, 'delete_any_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(11, 'force_delete_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(12, 'force_delete_any_category', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(13, 'view_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(14, 'view_any_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(15, 'create_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(16, 'update_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(17, 'restore_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(18, 'restore_any_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(19, 'replicate_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(20, 'reorder_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(21, 'delete_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(22, 'delete_any_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(23, 'force_delete_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(24, 'force_delete_any_course', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(25, 'view_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(26, 'view_any_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(27, 'create_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(28, 'update_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(29, 'restore_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(30, 'restore_any_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(31, 'replicate_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(32, 'reorder_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(33, 'delete_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(34, 'delete_any_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(35, 'force_delete_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(36, 'force_delete_any_course::module', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(37, 'view_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(38, 'view_any_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(39, 'create_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(40, 'update_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(41, 'restore_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(42, 'restore_any_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(43, 'replicate_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(44, 'reorder_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(45, 'delete_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(46, 'delete_any_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(47, 'force_delete_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(48, 'force_delete_any_other::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(49, 'view_role', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(50, 'view_any_role', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(51, 'create_role', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(52, 'update_role', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(53, 'delete_role', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(54, 'delete_any_role', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(55, 'view_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(56, 'view_any_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(57, 'create_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(58, 'update_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(59, 'restore_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(60, 'restore_any_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(61, 'replicate_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(62, 'reorder_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(63, 'delete_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(64, 'delete_any_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(65, 'force_delete_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(66, 'force_delete_any_social::account::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(67, 'view_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(68, 'view_any_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(69, 'create_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(70, 'update_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(71, 'restore_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(72, 'restore_any_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(73, 'replicate_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(74, 'reorder_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(75, 'delete_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(76, 'delete_any_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(77, 'force_delete_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(78, 'force_delete_any_user', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(79, 'view_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(80, 'view_any_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(81, 'create_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(82, 'update_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(83, 'restore_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(84, 'restore_any_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(85, 'replicate_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(86, 'reorder_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(87, 'delete_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(88, 'delete_any_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(89, 'force_delete_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(90, 'force_delete_any_website::setting', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(91, 'view_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(92, 'view_any_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(93, 'create_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(94, 'update_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(95, 'restore_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(96, 'restore_any_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(97, 'replicate_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(98, 'reorder_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(99, 'delete_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(100, 'delete_any_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(101, 'force_delete_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(102, 'force_delete_any_wordpress::product', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(103, 'widget_ProductStats', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(104, 'widget_OrderStats', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(105, 'widget_OrderCountChart', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(106, 'widget_SalesChart', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(107, 'widget_RecentOrders', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14'),
(108, 'widget_RecentDeposits', 'web', '2024-09-21 20:42:14', '2024-09-21 20:42:14');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
