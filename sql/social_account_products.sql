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
-- Cấu trúc bảng cho bảng `social_account_products`
--

CREATE TABLE `social_account_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sold` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) DEFAULT NULL,
  `short_content` text DEFAULT NULL,
  `long_content` longtext DEFAULT NULL,
  `data_account` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `social_account_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `social_account_products`
--

INSERT INTO `social_account_products` (`id`, `name`, `slug`, `thumbnail`, `stock`, `sold`, `price`, `short_content`, `long_content`, `data_account`, `created_at`, `updated_at`, `social_account_id`, `category_id`) VALUES
(4, 'Hotmail Trust sống 6-12 tháng chuyên dùng Verify', 'hotmail-trust-song-6-12-thang-chuyen-dung-verify', 'Social/01J7GDA2C7V6TRDV5J2X5QH61T.png', 900, 10, 100000.00, '<ul><li><strong>IMAP: </strong>Có</li><li><strong>POP3: </strong>Có</li><li><strong>Verify: </strong>Chưa</li><li><strong>Live</strong>: 6-12 tháng</li></ul><p><br></p>', '<h1><strong>Hotmail TRUST là gì ?</strong></h1><p>Hotmail là một địa chỉ email khá quen thuộc do <a href=\"https://www.microsoft.com/vi-vn\"><strong>Microsoft</strong>&nbsp;</a>phát hành . Outlook hoặc Hotmail là địa chỉ để đăng nhập hòm thư (email) của Microsoft phát hành. <strong>Hotmail Trust </strong>dống như tên gọi của nó (trust) là dạng tài khoản mail có thể live từ 6-12 tháng. Đã bật IMAP và POP3 để có thể đọc được thư qua các công cụ hỗ trợ</p><p>Hotmail Trust có domain mail là @Hotmail.com. Ví dụ như vuavia123@Hotmail.com là một dạng địa chỉ mail của Microsoft</p><p>Khác với email Hotmail thông thường chỉ có<strong><em> thể live từ 24-72h</em></strong>. Sau từng đó thời gian sẽ phải bắt xác minh lại Tài khoản để có thể sử dụng tiếp. <a href=\"https://vuavia.vn/san-pham/hotmail-trust/\"><strong>Hotmail Trust</strong></a> có thể sống từ 6-12 tháng.</p><h2><strong>Hotmail TRUST nên dùng để làm gì?</strong></h2><p>Thông thường email này dùng để <strong><em>Verify cho Clone Facebook, hoặc change thông tin via Facebook, hoặc dùng để nhận mã OTP</em></strong>. Hoặc có thể sử dụng vào nhiều mục đích như làm Email Marketing…</p><h3><strong>Ưu điểm của Email Hotmail Trust này là gì?</strong></h3><ul><li>Hotmail Domain có giá rất rẻ chỉ từ 200đ</li><li>Tài khoản này đã bật POP3, IMAP giúp cho việc tích hợp các công cụ và tool dễ dàng</li><li>Tài khoản live lâu từ 6-12 tháng mà không cần phải verify lại để sử dụng tiếp</li></ul><h3><strong>Lưu ý khi sử dụng tài khoản này:</strong></h3><p>Mặc dù Hotmail <strong>TRUST</strong> có thể live từ 6-12 tháng tuy nhiên khi sử dụng loại email này. Khách hàng chỉ nên Sử dụng <strong>IMAP</strong> để truy cập. KHÔNG nên đăng nhập bằng trình duyệt trực tiếp. Trường hợp có thể vẫn bắt xác minh lại như thường. Và lúc này bạn cần Verify lại tài khoản mail này để có thể sử dụng tiếp. Theo đánh giá thì loại mail này rất oke, nếu xếp hạng thì chỉ có thua email của Google đó là Gmail. Còn lại để sử dụng các tính năng như nhận OTP thì có thể dùng loại này</p><p><br></p>', '241242', '2024-09-11 04:25:43', '2024-09-11 04:25:43', 4, 13),
(5, '13123', '13123', 'Social/01J7J5E1DE3XQMTRZRKGVNJFTZ.jpg', 123, 0, 234234.00, '<p>123</p>', '<p>123</p>', '123', '2024-09-11 20:46:34', '2024-09-11 20:46:34', 4, 14);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `social_account_products`
--
ALTER TABLE `social_account_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `social_account_products_slug_unique` (`slug`),
  ADD KEY `social_account_products_social_account_id_foreign` (`social_account_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `social_account_products`
--
ALTER TABLE `social_account_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `social_account_products`
--
ALTER TABLE `social_account_products`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `social_account_products_social_account_id_foreign` FOREIGN KEY (`social_account_id`) REFERENCES `social_accounts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
