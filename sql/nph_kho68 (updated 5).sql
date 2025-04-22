-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 13, 2024 lúc 02:55 AM
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
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1726133908),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1726133908;', 1726133908);

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

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `total`, `created_at`, `updated_at`) VALUES
(5, 8, 0.00, '2024-09-12 00:53:58', '2024-09-12 00:53:58'),
(7, 1, 123000.00, '2024-09-12 03:05:28', '2024-09-12 03:05:28');

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
(20, 7, 6, NULL, NULL, NULL, NULL, 1, 123000.00, '2024-09-12 03:05:28', '2024-09-12 03:05:28');

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
(9, 'Wordpress', '#', NULL, 'active', '2024-09-04 20:51:48', '2024-09-12 19:49:56'),
(10, 'Plugin', 'plugin', 9, 'active', '2024-09-04 20:52:05', '2024-09-12 02:29:33'),
(12, 'Tài khoản', '#', NULL, 'active', '2024-09-09 23:31:25', '2024-09-12 19:52:38'),
(13, 'Facebook', 'facebook', 12, 'active', '2024-09-09 23:31:35', '2024-09-09 23:31:35'),
(14, 'Tiktok', 'tiktok', 12, 'active', '2024-09-09 23:31:42', '2024-09-09 23:32:07'),
(15, 'Khóa học', '#', NULL, 'active', '2024-09-10 19:01:54', '2024-09-12 19:53:13'),
(16, 'Python', 'python', 15, 'active', '2024-09-10 19:06:39', '2024-09-11 19:27:21'),
(17, 'Khác', 'khac', NULL, 'active', '2024-09-10 19:58:13', '2024-09-10 19:58:13'),
(18, 'Theme', 'theme', 9, 'active', '2024-09-12 02:29:51', '2024-09-12 02:29:51');

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
  `duration` int DEFAULT NULL,
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
(2, 16, 'Python for Data Science and Machine Learning Bootcamp', 'python-for-data-science-and-machine-learning-bootcamp', '<h2><br>Requirements</h2><ul><li>Some programming experience</li><li>Admin permissions to download files</li></ul><p><br></p>', '<h2>Description</h2><p>Are you ready to start your path to becoming a Data Scientist!&nbsp;</p><p>This comprehensive course will be your guide to learning how to use the power of Python to analyze data, create beautiful visualizations, and use powerful machine learning algorithms!</p><p>Data Scientist has been ranked the number one job on Glassdoor and the average salary of a data scientist is over $120,000 in the United States according to Indeed! Data Science is a rewarding career that allows you to solve some of the world\'s most interesting problems!</p><p>This course is designed for both beginners with some programming experience or experienced developers looking to make the jump to Data Science!</p><p>This comprehensive course is comparable to other Data Science bootcamps that usually cost thousands of dollars, but now you can learn all that information at a fraction of the cost! With <strong>over 100 HD video lectures</strong> and <strong>detailed code notebooks for every lecture </strong>this is one of the most comprehensive course for data science and machine learning on Udemy!</p><p>We\'ll teach you how to program with Python, how to create amazing data visualizations, and how to use Machine Learning with Python! Here a just a few of the topics we will be learning:</p><ul><li>Programming with Python</li><li>NumPy with Python</li><li>Using pandas Data Frames to solve complex tasks</li><li>Use pandas to handle Excel Files</li><li>Web scraping with python</li><li>Connect Python to SQL</li><li>Use matplotlib and seaborn for data visualizations</li><li>Use plotly for interactive visualizations</li><li>Machine Learning with SciKit Learn, including:</li><li>Linear Regression</li><li>K Nearest Neighbors</li><li>K Means Clustering</li><li>Decision Trees</li><li>Random Forests</li><li>Natural Language Processing</li><li>Neural Nets and Deep Learning</li><li>Support Vector Machines</li><li>and much, much more!</li></ul><p>Enroll in the course and become a data scientist today!</p><p><br></p>', 600000.00, 500000.00, 'courses/01J7J0W3QD34J87A1AV07E0J8E.jpg', 'Jose Portilla', 999, 'Chuyên gia', 0, NULL, NULL, 0, 'active', '2024-09-11 19:26:52', '2024-09-11 19:26:52');

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
(3, 2, 'py1', '<p>Noi dung Step py1</p>', NULL, 0, NULL, 0, '2024-09-12 02:43:20', '2024-09-12 02:43:20'),
(4, 2, 'py2', '<p>Noi dung Step py2&nbsp;</p>', NULL, 0, NULL, 0, '2024-09-12 02:44:11', '2024-09-12 02:44:11');

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
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

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
(4, '2024_08_30_074556_create_customers_table', 2),
(6, '2024_08_30_075623_create_user_details_table', 3),
(8, '2024_09_02_035333_create_products_table', 4),
(9, '2024_09_02_035443_create_carts_table', 4),
(11, '2024_09_02_075811_create_categories_table', 4),
(12, '2024_09_03_042850_create_wordpress_products_table', 4),
(13, '2024_09_03_044446_create_tags_table', 4),
(14, '2024_09_03_044648_create_courses_table', 4),
(15, '2024_09_03_045350_create_course_modules_table', 4),
(16, '2024_09_03_064801_create_social_accounts_table', 4),
(17, '2024_09_03_065113_create_social_account_products_table', 4),
(18, '2024_09_03_074945_create_social_account_product_attributes_table', 4),
(19, '2024_09_08_164946_create_other_products_table', 5),
(20, '2024_09_09_060613_add_category_id_to_social_accounts_table', 6),
(21, '2024_09_10_070950_category_social_account_product', 7),
(23, '2024_09_02_035542_create_cart_items_table', 8),
(24, '2024_09_12_025428_add_attribute_id_to_cart_items_table', 9),
(25, '2024_09_12_032511_add_quantity_to_social_account_product_attributes', 10),
(26, '2024_09_12_012831_create_media_table', 11),
(27, '2024_09_12_040704_create_orders_and_order_items_tables', 11);

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

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `payment_method`, `payment_date`, `created_at`, `updated_at`) VALUES
(13, 8, 150000.00, 'completed', 'vnpay', NULL, '2024-09-12 00:52:18', '2024-09-12 00:52:44'),
(14, 1, 1232000.00, 'pending', 'vnpay', NULL, '2024-09-12 02:39:14', '2024-09-12 02:39:14'),
(15, 1, 882000.00, 'completed', 'vnpay', NULL, '2024-09-12 02:47:18', '2024-09-12 02:49:57');

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

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `social_account_product_id`, `wordpress_product_id`, `course_product_id`, `attribute_id`, `other_product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(10, 13, 4, NULL, NULL, 5, NULL, 1, 50000.00, 50000.00, '2024-09-12 00:52:18', '2024-09-12 00:52:18'),
(11, 13, 4, NULL, NULL, 6, NULL, 1, 100000.00, 100000.00, '2024-09-12 00:52:18', '2024-09-12 00:52:18'),
(12, 14, 4, NULL, NULL, 5, NULL, 2, 50000.00, 100000.00, '2024-09-12 02:39:14', '2024-09-12 02:39:14'),
(13, 14, NULL, NULL, 2, NULL, NULL, 1, 600000.00, 600000.00, '2024-09-12 02:39:14', '2024-09-12 02:39:14'),
(14, 14, NULL, 4, NULL, NULL, NULL, 1, 532000.00, 532000.00, '2024-09-12 02:39:14', '2024-09-12 02:39:14'),
(15, 15, 4, NULL, NULL, 8, NULL, 1, 200000.00, 200000.00, '2024-09-12 02:47:18', '2024-09-12 02:47:18'),
(16, 15, 4, NULL, NULL, 7, NULL, 1, 150000.00, 150000.00, '2024-09-12 02:47:18', '2024-09-12 02:47:18'),
(17, 15, NULL, 4, NULL, NULL, NULL, 1, 532000.00, 532000.00, '2024-09-12 02:47:18', '2024-09-12 02:47:18');

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
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `demo_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `sold_quantity` int DEFAULT '0',
  `system_requirements` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Đang đổ dữ liệu cho bảng `other_products`
--

INSERT INTO `other_products` (`id`, `name`, `slug`, `category_id`, `thumbnail`, `gallery`, `type`, `description`, `demo_link`, `download_link`, `price`, `stock`, `sold_quantity`, `system_requirements`, `created_at`, `updated_at`) VALUES
(3, 'giang', 'giang', 17, 'OtherProduct/01J7GEEG5T985HYDE0XKEQ4SAM.png', '[{\"image\":\"OtherProduct\\/gallery\\/01J7GEEG5ZKVE4CWA00F2KCCDJ.png\"}]', NULL, '<p>124</p>', 'http://localhost:8000/k68-admin/other-products/create', 'http://localhost:8000/k68-admin/other-products/create', 123123.00, 123, 0, '<p>123123</p>', '2024-09-11 04:45:37', '2024-09-11 04:45:37');

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
('HXsZRCErqT0ZUMQ55MltCgJjj8HxtcmCEavprt92', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiR3gxNHpsaWJWek4xWnpsTENDb1BDOG0wdmJNVmRLVldSdjJZeHpvVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jYXRlZ29yeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiQxYjFNalA1L0dzRy9SY3J4a2EyLjZlY3JzNGp1WnpNUHl0ck5oVHRiVGtwWkk5aVZ2ZmVpUyI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1726196062),
('XeCzDW5no5mXDCc8DjhC6YKHpa44CW2pPUrMl0ZG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUDN3V21UaEFneDFTU0xjR05iNkhrV3psVlp0YWFaUEtqeVdVVGRaQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2s2OC1hZG1pbiI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvazY4LWFkbWluL2xvZ2luIjt9fQ==', 1726193697);

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
(4, 13, 'Tài khoản Facebook', 'tai-khoan-facebook', '2024-09-11 04:22:42', '2024-09-11 04:22:42');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `social_account_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `social_account_products`
--

INSERT INTO `social_account_products` (`id`, `name`, `slug`, `thumbnail`, `stock`, `sold`, `price`, `short_content`, `long_content`, `data_account`, `created_at`, `updated_at`, `social_account_id`, `category_id`) VALUES
(4, 'Hotmail Trust sống 6-12 tháng chuyên dùng Verify', 'hotmail-trust-song-6-12-thang-chuyen-dung-verify', 'Social/01J7GDA2C7V6TRDV5J2X5QH61T.png', 900, 10, 100000.00, '<ul><li><strong>IMAP: </strong>Có</li><li><strong>POP3: </strong>Có</li><li><strong>Verify: </strong>Chưa</li><li><strong>Live</strong>: 6-12 tháng</li></ul><p><br></p>', '<h1><strong>Hotmail TRUST là gì ?</strong></h1><p>Hotmail là một địa chỉ email khá quen thuộc do <a href=\"https://www.microsoft.com/vi-vn\"><strong>Microsoft</strong>&nbsp;</a>phát hành . Outlook hoặc Hotmail là địa chỉ để đăng nhập hòm thư (email) của Microsoft phát hành. <strong>Hotmail Trust </strong>dống như tên gọi của nó (trust) là dạng tài khoản mail có thể live từ 6-12 tháng. Đã bật IMAP và POP3 để có thể đọc được thư qua các công cụ hỗ trợ</p><p>Hotmail Trust có domain mail là @Hotmail.com. Ví dụ như vuavia123@Hotmail.com là một dạng địa chỉ mail của Microsoft</p><p>Khác với email Hotmail thông thường chỉ có<strong><em> thể live từ 24-72h</em></strong>. Sau từng đó thời gian sẽ phải bắt xác minh lại Tài khoản để có thể sử dụng tiếp. <a href=\"https://vuavia.vn/san-pham/hotmail-trust/\"><strong>Hotmail Trust</strong></a> có thể sống từ 6-12 tháng.</p><h2><strong>Hotmail TRUST nên dùng để làm gì?</strong></h2><p>Thông thường email này dùng để <strong><em>Verify cho Clone Facebook, hoặc change thông tin via Facebook, hoặc dùng để nhận mã OTP</em></strong>. Hoặc có thể sử dụng vào nhiều mục đích như làm Email Marketing…</p><h3><strong>Ưu điểm của Email Hotmail Trust này là gì?</strong></h3><ul><li>Hotmail Domain có giá rất rẻ chỉ từ 200đ</li><li>Tài khoản này đã bật POP3, IMAP giúp cho việc tích hợp các công cụ và tool dễ dàng</li><li>Tài khoản live lâu từ 6-12 tháng mà không cần phải verify lại để sử dụng tiếp</li></ul><h3><strong>Lưu ý khi sử dụng tài khoản này:</strong></h3><p>Mặc dù Hotmail <strong>TRUST</strong> có thể live từ 6-12 tháng tuy nhiên khi sử dụng loại email này. Khách hàng chỉ nên Sử dụng <strong>IMAP</strong> để truy cập. KHÔNG nên đăng nhập bằng trình duyệt trực tiếp. Trường hợp có thể vẫn bắt xác minh lại như thường. Và lúc này bạn cần Verify lại tài khoản mail này để có thể sử dụng tiếp. Theo đánh giá thì loại mail này rất oke, nếu xếp hạng thì chỉ có thua email của Google đó là Gmail. Còn lại để sử dụng các tính năng như nhận OTP thì có thể dùng loại này</p><p><br></p>', '241242', '2024-09-11 04:25:43', '2024-09-11 04:25:43', 4, 13),
(5, '13123', '13123', 'Social/01J7J5E1DE3XQMTRZRKGVNJFTZ.jpg', 123, 0, 234234.00, '<p>123</p>', '<p>123</p>', '123', '2024-09-11 20:46:34', '2024-09-11 20:46:34', 4, 14);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `social_account_product_attributes`
--

CREATE TABLE `social_account_product_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `social_product_id` bigint UNSIGNED NOT NULL,
  `attribute_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_price` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0'
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
(1, 'NHT', 'huutai90909@gmail.com', NULL, '$2y$12$1b1MjP5/GsG/Rcrxka2.6ecrs4juZzMPytrNhTtbTkpZI9iVvfeiS', NULL, '2024-08-30 00:25:20', '2024-09-12 02:26:39'),
(5, 'abc', 'nht4646@gmail.com', NULL, '$2y$12$YYB8bpCTXxiCdMj1YXiVHuNVKLdLc/HsXT/viW6s0ZP5ffubgbSnS', NULL, '2024-08-30 01:13:23', '2024-08-30 20:19:35'),
(8, '2508roblox', '2508roblox@gmail.com', NULL, '$2y$12$M/lsxVxXEkvL6gGC.R1BsealO.HLC2mlAWLdHnvLV8ebYQWdnKI9G', NULL, '2024-09-11 19:18:56', '2024-09-11 19:18:56');

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
(3, 5, 'abc', 'abckad', '34', '127.0.0.1', 'customer', '0', '2024-08-29 18:13:23', '2024-09-01 10:56:42'),
(4, 1, 'nht2312', 'nht', '21234', '127.0.0.1', 'admin', '0', '2024-08-29 18:13:23', '2024-09-01 19:55:10'),
(5, 8, '2508roblox', NULL, NULL, '127.0.0.1', 'customer', '0', '2024-09-11 19:18:56', '2024-09-11 19:18:56');

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
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
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
) ;

--
-- Đang đổ dữ liệu cho bảng `wordpress_products`
--

INSERT INTO `wordpress_products` (`id`, `category_id`, `name`, `slug`, `image`, `gallery`, `sku`, `type`, `status`, `version`, `short_content`, `long_content`, `price`, `sale_price`, `sold`, `demo`, `download_link`, `system_requirements`, `license_key`, `license_expiration_date`, `views`, `created_at`, `updated_at`) VALUES
(4, 18, 'Avada | Website Builder For WordPress & eCommerce', 'avada-website-builder-for-wordpress-ecommerce', 'Wordpress/01J7JSGTMQG4RX4S16PQB2EREV.jpg', '[]', 'K68-FV1QPU', NULL, 'active', '7.11', '<p><a href=\"https://avada.com/whats-new/\"><strong><em>Avada 7.11 is live!</em></strong></a><em> This feature-rich version introduces a wide range of new design options and tons of new features. We have introduced Multi-Step Avada Forms, Pixel Width &amp; Flex Grow for Columns, and Mailchimp tag/group support. In addition, you can now create a WooCommerce thank you page when designing a site with the Avada Setup Wizard, improvements to the Prebuilt Website Import process, text stroke styling, ToTop button styling, and so much more.</em></p>', '<blockquote><a href=\"https://avada.com/whats-new/\"><strong>Avada 7.11 is live!</strong></a> This feature-rich version introduces a wide range of new design options and tons of new features. We have introduced Multi-Step Avada Forms, Pixel Width &amp; Flex Grow for Columns, and Mailchimp tag/group support. In addition, you can now create a WooCommerce thank you page when designing a site with the Avada Setup Wizard, improvements to the Prebuilt Website Import process, text stroke styling, ToTop button styling, and so much more.</blockquote><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1190,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/96751e9bb3f2af1b5fe86d2c456246327072cd86/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303161766164612d76657273696f6e2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/96751e9bb3f2af1b5fe86d2c456246327072cd86/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303161766164612d76657273696f6e2d3731312e6a7067\" width=\"1230\" height=\"1190\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1230,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/79c5ac51595483483d931d416434dee79bd071be/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30326d756c74692d737465702d61766164612d666f726d732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/79c5ac51595483483d931d416434dee79bd071be/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30326d756c74692d737465702d61766164612d666f726d732d3731312e6a7067\" width=\"1230\" height=\"1230\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1260,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/0689a28236a5472729d49de5452b752aa071646f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303461766164612d6d6567612d6d656e752d6275696c6465722d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/0689a28236a5472729d49de5452b752aa071646f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303461766164612d6d6567612d6d656e752d6275696c6465722d3731312e6a7067\" width=\"1230\" height=\"1260\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1190,&quot;href&quot;:&quot;https://avada.com/whats-new/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/d73cb8398dd80afb2a961df8db5ac3e846d21a9f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303561766164612d726f6c652d6d616e616765722d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/whats-new/\"><img src=\"https://camo.envatousercontent.com/d73cb8398dd80afb2a961df8db5ac3e846d21a9f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303561766164612d726f6c652d6d616e616765722d3731312e6a7067\" width=\"1230\" height=\"1190\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1144,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/15629db8c4b1d92d3ca595e70b916a51de2c0401/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303661766164612d73657475702d77697a6172642d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/15629db8c4b1d92d3ca595e70b916a51de2c0401/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303661766164612d73657475702d77697a6172642d3731312e6a7067\" width=\"1230\" height=\"1144\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1028,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/c15cf77ce8e74a0400dc3b9e8b36e4b6e45b45eb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303761766164612d73747564696f2d7374796c696e672d6f7074696f6e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/c15cf77ce8e74a0400dc3b9e8b36e4b6e45b45eb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303761766164612d73747564696f2d7374796c696e672d6f7074696f6e732d3731312e6a7067\" width=\"1230\" height=\"1028\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1100,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/08a0c5e24adb0c5f2cd54bb77bba2a31bc98dac7/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30386f66662d63616e7661732d6275696c6465722d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/08a0c5e24adb0c5f2cd54bb77bba2a31bc98dac7/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30386f66662d63616e7661732d6275696c6465722d3731312e6a7067\" width=\"1230\" height=\"1100\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1337,&quot;href&quot;:&quot;https://www.siteground.com/avada?afcode=452502cf59bfef470b2806e5ba67670a&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/50ef36b4123509f16a756b9e499d3dd2f6874912/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30397369746567726f756e642d61766164612d686f7374696e672d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://www.siteground.com/avada?afcode=452502cf59bfef470b2806e5ba67670a\"><img src=\"https://camo.envatousercontent.com/50ef36b4123509f16a756b9e499d3dd2f6874912/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30397369746567726f756e642d61766164612d686f7374696e672d3731312e6a7067\" width=\"1230\" height=\"1337\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1958,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/d188d81cde79c1df28f628d7c6d9569498d2f204/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313061766164612d73747564696f2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/d188d81cde79c1df28f628d7c6d9569498d2f204/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313061766164612d73747564696f2d3731312e6a7067\" width=\"1230\" height=\"1958\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2300,&quot;href&quot;:&quot;https://avada.com/feature/performance-wizard/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/371450a3e2bd7eab947d52d91c8d17ca20a9ca22/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313161766164612d706572666f726d616e63652d77697a6172642d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/feature/performance-wizard/\"><img src=\"https://camo.envatousercontent.com/371450a3e2bd7eab947d52d91c8d17ca20a9ca22/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313161766164612d706572666f726d616e63652d77697a6172642d3731312e6a7067\" width=\"1230\" height=\"2300\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/5766c0cc1ef29985915dc1771d5951cc809fd4bb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313261766164612d776f6f636f6d6d657263652d6275696c6465722d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:1117}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/5766c0cc1ef29985915dc1771d5951cc809fd4bb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313261766164612d776f6f636f6d6d657263652d6275696c6465722d3731312d7363616c65642e6a7067\" width=\"1117\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/359bd7a0f865a560c53b7da93b2cbfbd7352a94a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313361766164612d706f73742d636172642d6c61796f7574732d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:989}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/359bd7a0f865a560c53b7da93b2cbfbd7352a94a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313361766164612d706f73742d636172642d6c61796f7574732d3731312d7363616c65642e6a7067\" width=\"989\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1759,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/e96a90876b1f53d8b7b2ba47b475f59d6561c218/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f31346d6f62696c652d667269656e646c792d6374612d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/e96a90876b1f53d8b7b2ba47b475f59d6561c218/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f31346d6f62696c652d667269656e646c792d6374612d3731312e6a7067\" width=\"1230\" height=\"1759\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:10241,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/340d3447f2e23afbbe0b96a3ca9aaf9d9c027e44/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313561766164612d6275696c646572732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/340d3447f2e23afbbe0b96a3ca9aaf9d9c027e44/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313561766164612d6275696c646572732d3731312e6a7067\" width=\"1230\" height=\"10241\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1660,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/03227fd4921aacdf407572d1193c9d167ca547dc/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313661766164612d64657369676e2d6c61796f75742d656c656d656e74732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/03227fd4921aacdf407572d1193c9d167ca547dc/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313661766164612d64657369676e2d6c61796f75742d656c656d656e74732d3731312e6a7067\" width=\"1230\" height=\"1660\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1615,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/050e2026e583a375d7bc590d1f8762233afbff33/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313775706c6f61642d637573746f6d2d69636f6e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/050e2026e583a375d7bc590d1f8762233afbff33/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313775706c6f61642d637573746f6d2d69636f6e732d3731312e6a7067\" width=\"1230\" height=\"1615\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1945,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/6b7477dde2f3b070359ed053b5e786b1340f8d94/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313861766164612d64796e616d69632d636f6e74656e742d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/6b7477dde2f3b070359ed053b5e786b1340f8d94/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313861766164612d64796e616d69632d636f6e74656e742d3731312e6a7067\" width=\"1230\" height=\"1945\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:937,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/e8e755721a10725dca41fd174cfebc8cb6076a10/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3139656e7661746f2d63656f2d636f6c6c69732d7265766965772d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/e8e755721a10725dca41fd174cfebc8cb6076a10/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3139656e7661746f2d63656f2d636f6c6c69732d7265766965772d3731312e6a7067\" width=\"1230\" height=\"937\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/prebuilt-websites/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/0bea2b3f993da87f29ab1eb6925decb5a49ee781/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323061766164612d7072656275696c742d77656273697465732d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:783}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/prebuilt-websites/\"><img src=\"https://camo.envatousercontent.com/0bea2b3f993da87f29ab1eb6925decb5a49ee781/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323061766164612d7072656275696c742d77656273697465732d3731312d7363616c65642e6a7067\" width=\"783\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:280,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/1e8d817892a7b0dc84dfd196dc46986b51eb2bcb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32316275792d61766164612d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/1e8d817892a7b0dc84dfd196dc46986b51eb2bcb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32316275792d61766164612d3731312e6a7067\" width=\"1230\" height=\"280\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:986,&quot;href&quot;:&quot;https://avada.com/reviews/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/a2b7ba19b0dcf0cce4ebc2a7fa477b0cb6309fb2/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32327374657068656e2d656e7661746f2d7265766965772d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/reviews/\"><img src=\"https://camo.envatousercontent.com/a2b7ba19b0dcf0cce4ebc2a7fa477b0cb6309fb2/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32327374657068656e2d656e7661746f2d7265766965772d3731312e6a7067\" width=\"1230\" height=\"986\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/reviews/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/c46aa757005f9a75508da2cf7f0e3b1216016085/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323361766164612d352d737461722d726576696577732d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:755}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/reviews/\"><img src=\"https://camo.envatousercontent.com/c46aa757005f9a75508da2cf7f0e3b1216016085/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323361766164612d352d737461722d726576696577732d3731312d7363616c65642e6a7067\" width=\"755\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2358,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/8fe92ddba22227290c138a60aa65f9f3fe8bbe8a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323470617373696f6e6174652d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/8fe92ddba22227290c138a60aa65f9f3fe8bbe8a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323470617373696f6e6174652d3731312e6a7067\" width=\"1230\" height=\"2358\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:310,&quot;href&quot;:&quot;https://avada.com/help-center/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/915b9a6f62dda306a867b89b679fc9e87f8d2dcd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3235636f6d70726568656e736976652d646f63756d656e746174696f6e2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/help-center/\"><img src=\"https://camo.envatousercontent.com/915b9a6f62dda306a867b89b679fc9e87f8d2dcd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3235636f6d70726568656e736976652d646f63756d656e746174696f6e2d3731312e6a7067\" width=\"1230\" height=\"310\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:315,&quot;href&quot;:&quot;mailto:https://www.youtube.com/@AvadaVideos&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/eb290b074ac5cf9d0f2b9432cd91041a8562a14a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3236657874656e736976652d766964656f2d7475746f7269616c732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"mailto:https://www.youtube.com/@AvadaVideos\"><img src=\"https://camo.envatousercontent.com/eb290b074ac5cf9d0f2b9432cd91041a8562a14a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3236657874656e736976652d766964656f2d7475746f7269616c732d3731312e6a7067\" width=\"1230\" height=\"315\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1292,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/30a745b02f1257b466da600762e127cca0a764b5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32377072656d69756d2d706c7567696e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/30a745b02f1257b466da600762e127cca0a764b5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32377072656d69756d2d706c7567696e732d3731312e6a7067\" width=\"1230\" height=\"1292\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1246,&quot;href&quot;:&quot;https://avada.com/features/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/2c7a17fef4fd7fe67ad95963db9faef979e67477/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323861766164612d64657369676e2d696e746567726174696f6e2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/features/\"><img src=\"https://camo.envatousercontent.com/2c7a17fef4fd7fe67ad95963db9faef979e67477/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323861766164612d64657369676e2d696e746567726174696f6e2d3731312e6a7067\" width=\"1230\" height=\"1246\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:284,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/84768613d547a351756ab4fb60980acaa86ad04c/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3239677574656e626572672d6f7074696d697a65642d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/84768613d547a351756ab4fb60980acaa86ad04c/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3239677574656e626572672d6f7074696d697a65642d3731312e6a7067\" width=\"1230\" height=\"284\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1169,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/e8c52cc84a1a1074af12f6363939c5f1a6783b11/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333061766164612d707269766163792d746f6f6c732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/e8c52cc84a1a1074af12f6363939c5f1a6783b11/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333061766164612d707269766163792d746f6f6c732d3731312e6a7067\" width=\"1230\" height=\"1169\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:677,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/d7ef72473b794b6ef58a8fc2abb766800eb880a1/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333161766164612d73616c65732d636f756e742d6374612d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/d7ef72473b794b6ef58a8fc2abb766800eb880a1/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333161766164612d73616c65732d636f756e742d6374612d3731312e6a7067\" width=\"1230\" height=\"677\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1175,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/b31ce133ecaf2475946456e5180872cdb8c912d5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33327472616e736c6174696f6e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/b31ce133ecaf2475946456e5180872cdb8c912d5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33327472616e736c6174696f6e732d3731312e6a7067\" width=\"1230\" height=\"1175\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1820,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/31a74371ac4f367edcfeb29b1a03b0d5b2e4d4f3/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333361766164612d667265652d757064617465732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/31a74371ac4f367edcfeb29b1a03b0d5b2e4d4f3/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333361766164612d667265652d757064617465732d3731312e6a7067\" width=\"1230\" height=\"1820\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2470,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/55fd1bfa55b67e8f5b0e4215142c04d04ed79de9/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3334646576656c6f7065642d696e2d686f7573652d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/55fd1bfa55b67e8f5b0e4215142c04d04ed79de9/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3334646576656c6f7065642d696e2d686f7573652d3731312e6a7067\" width=\"1230\" height=\"2470\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/8a3a28291714cf0e110f128d3a24727c078a92a0/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3335726561736f6e732d746f2d6275792d61766164612d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:620}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/8a3a28291714cf0e110f128d3a24727c078a92a0/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3335726561736f6e732d746f2d6275792d61766164612d3731312d7363616c65642e6a7067\" width=\"620\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:384,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/ea3f146adc636f904100bf3ec6f97a17f23fdcdd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33366a6f696e2d61766164612d636f6d6d756e6974792d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/ea3f146adc636f904100bf3ec6f97a17f23fdcdd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33366a6f696e2d61766164612d636f6d6d756e6974792d3731312e6a7067\" width=\"1230\" height=\"384\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/217ebe6813e6ec5ee39a8940fd4b8030413dffa6/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3337746f702d73656c6c696e672d7468656d652d616c6c2d74696d652d3731312e6a7067&quot;}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/217ebe6813e6ec5ee39a8940fd4b8030413dffa6/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3337746f702d73656c6c696e672d7468656d652d616c6c2d74696d652d3731312e6a7067\" width=\"1230\" height=\"380\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><strong>Avada is available to purchase and download!</strong></p><p>Avada is a Website Builder for WordPress that offers a comprehensive range of features for creating custom websites, including an intuitive Drag &amp; Drop <a href=\"https://avada.com/feature/live-visual-builder/\">Live Visual Builder</a>, a <a href=\"https://avada.com/feature/layout-builder/\">Layout Builder</a>, a <a href=\"https://avada.com/feature/header-builder/\">Header Builder</a>, a <a href=\"https://avada.com/feature/footer-builder/\">Footer Builder</a>, the <a href=\"https://avada.com/feature/form-builder/\">Avada Form Builder</a>, an <a href=\"https://avada.com/feature/woocommerce/\">eCommerce Builder</a>, WooCommerce integration, the <a href=\"https://avada.com/feature/setup-wizard/\">Avada Setup Wizard</a>, and performance optimization tools. In addition, Avada supports dynamic content and is mobile-friendly, ensuring websites are responsive across all devices, from mobile to desktop.</p><p>Avada is also the #1 selling WordPress Website Builder on the marketplace and has been continuously for more than 11+ years. 950,000+ beginners, marketers, professionals, agencies, businesses, and creatives trust Avada for total design freedom. Our illustrious history is a testament to the fact that Avada is the most versatile and easy-to-use multi-purpose WordPress theme on the market today. Years of refinement and feedback have reinforced our determination to be the best at what we do and provide you with the tools to make things happen efficiently and quickly without requiring coding knowledge.</p><p>Below we have highlighted some of Avada’s features! The list may be long, but so are the reasons to purchase Avada and join the most significant WordPress community out there!</p><ul><li>Avada has Intuitive visual front-end design and editing tools for you to create beautiful websites, fast.</li><li>A clean, modern, multi-purpose designs which can be adapted and used for any website design and layout</li><li>The #1 selling WordPress theme on the market for 11+ years and counting</li><li>A highly advanced network of options for easy customizations without modifying the code</li><li>Dozens of professionally designed demos that can be imported fast with the click of a button</li><li>More than 25,000+ ratings with a 5-Star Average</li><li>Always compatible with the latest WordPress versions</li><li>Always compatible with the latest versions of 3rd party integrated plugins</li><li>WordPress Multisite (WPMU) Tested and Approved</li><li>Built with HTML5 and CSS3</li><li>100% SEO Optimized and perfectly compatible with Plugins like Yoast SEO</li><li>Adherence to strict WordPress and PHP coding standards</li><li>Performance enhancements for fast, reliable, quality websites</li><li>Cross-Browser Compatibility: FireFox, Safari, Chrome, IE9, IE10, IE11</li><li>100% Responsive Theme with pixel perfect accuracy – and you can disable responsiveness</li><li>Easy to use Fusion Builder Visual Editor, the best visual page builder on the market</li><li>Full control over site width; content area and sidebars</li><li>Retina Ready, Ultra-High Resolution Graphics</li><li>Social Icons and Theme Icons are CSS Font Icons, no Images</li><li>Automatic Theme Updater directly through the WordPress Admin interface</li><li>Automatic Patch tool to apply fixes and improvements with one click, no other theme has this</li><li>Dual, flexible sidebars throughout the theme</li><li>1-6 Column Support</li><li>One Page Parallax feature for any page</li><li>CSS3 animations enable or disable on desktop/mobile</li><li>Child Theme Compatible – Your Avada package includes a basic child theme</li><li>Strong focus on typography, usability and overall user-experience</li><li>jQuery Enhancements for modern websites</li><li>JavaScript files are automatically combined and minified for added performance</li><li>JS/PHP Compiler for CSS that combines all styles into one generated file for added performance</li><li>Includes the Font Awesome icon set, fully integrated</li><li>Font Awesome Pro can be enabled to use with Avada</li><li>60 Layered PSD’s included of the original Avada Classic design</li><li>Compatible with Ubermenu (uber does not support sticky headers)</li><li>Compatible with Many Popular Plugins like WPML, Yoast, W3TC, JetPack, Slider Revolution, Layer Slider, WooCommerce, The Events Calendar, bbPress, BuddyPress, WP Rocket, All In One SEO, NextGen Gallery, UpDraft Plus to name a few</li></ul><p><strong>Professional 5-Star Customer Support</strong></p><ul><li>We take pride in offering THE BEST after sales support around. We care about your site as much as you and will help in anyway possible</li><li>Feature Packed Updates – get new features and new development in each future update</li><li>Technical Support with a growing community of over 950,000 customers! At our support center, we answer each and every ticket as if it was our own because we care about you and your site</li><li>Customer feedback always welcomed for new features</li><li>Once you register your purchase, you can use our advanced support ticket system to receive professional support</li><li>Includes the most extensive online documentation you can find and its constantly being updated with new material</li><li>Multiple HD video tutorials for easy instruction</li><li>Access our extensive knowledge base that is ever-growing</li><li>Ever growing user base, read our user testimonials</li></ul><p><strong>100+ Professionally Designed Prebuilt Websites</strong></p><ul><li>The Best Website Importer On The Market – Industry leading demo import that is amazingly easy to use and the fastest way to build your website. One click website import allows you to install a full demo with everything, or a partial demo. Want the Creative demo but with Modern Shop products for an eCommerce site? Easily done! And you can quickly uninstall any imported demo content with a click.</li><li><a href=\"https://avada.website/\">Professionally designed prebuilt websites</a> that you can import with just a click. Industry leading designs created by a team of professional designers.</li><li>More added with each major update based on popular demand</li><li>Each demo is professionally designed to truly represent the exact nature of the industry; Cafe, Gym, Agency, Travel, Photography just to name a few</li><li>Beautiful easy to use interface through a Welcome Screen that allows you to view each prebuilt website, preview it, then import with just a click.</li><li>WooCommerce shop setup and products import, bbPress content imports, Events Calendar content imports</li><li>Each prebuilt website has been optimized using the <a href=\"https://avada.com/feature/performance-wizard/\">Avada Performance Wizard</a></li></ul><p><strong>Advanced Theme Options Network</strong> Fusion Theme Options control options and settings globally throughout the site, whereas Fusion Page Options control individual pages and posts. Individual page options give you the freedom to change anything on a single page or post that will thereby override the global Theme Options. The Avada Advanced Options Network gives you the ultimate flexibility to design and style layouts that are unique and stand out from the rest of the site.</p><ul><li>50+ main and sub theme option panels loaded with powerful customization options</li><li>Extensive options which provide incredible customization options without having to modify code</li><li>Fully dependent options so the only you see are the options that are in use based on your configuration</li><li>Entire option network correlation so you can quickly see what is set global vs individual</li><li>Incredible search feature that allows you to quickly find any option you need</li><li>Advanced options to enable or disable individual features for performance enhancements</li><li>Full control over the entire layout; site width, content area, sidebars and more</li><li>Logically organized options based on normal site building procedures</li><li>Customized repeater fields that allow for unlimited custom fonts and icons</li><li>Custom fonts can be used in any font-family filed throughout the site</li><li>Combined options for things like typography put you in full control of all settings in one area saving you precious time</li><li>Easily import and export your data for using on different installs or for safe backups</li><li>Native WordPress feel that has the same hover effects, styles and pulls user color profiles</li><li>All running on a customized version of the powerful Redux Framework</li></ul><p><strong>Advanced Fusion Page/Post Options</strong> We created the page and post options to extend the Avada Theme Options. Doing this gives you extreme flexibility by being able to override the global Theme Options and create unique and dynamic content-rich pages that stand out. Any single page or post (or more than one) can have a different layout and styling compared to the rest of the site.</p><ul><li>Multiple option panels with amazingly deep customization options: Sliders, Page, Post, Header, Footer, Sidebars, Backgrounds, Portfolio, Page Title Bar</li><li>Assign any slider to any page or post, show slider above or below header, use transparent header per page</li><li>Customize page title bar for any page or post</li><li>Customize page settings like paddings uniquely for each page or post</li><li>Customize header styles individually for any page or post</li><li>Insert custom images or colors for header section, main section, boxed background per page or post</li><li>Choose a custom menu per page or post</li><li>Enable or Disable headers, footers, sliders, sidebars, backgrounds and more per page or post</li><li>Customize various parts of the portfolio per page or portfolio posts</li><li>Insert custom excerpt length per portfolio pages</li><li>Customize sidebars and sidebar positions for any page or post.</li></ul><p><strong>Incredible Theme Updates That Make All The Difference</strong></p><ul><li>Avada releases continued value packed feature updates based off user requested features and demands</li><li>Continued codebase improvements for performance enhancements and future maintenance</li><li>Every update is <strong>FREE</strong> to anyone who has bought a license</li></ul><p><strong>Multiple Premium Slider Options</strong></p><ul><li>Includes Amazing <a href=\"https://www.sliderrevolution.com/?utm_source=themeforest.net&amp;utm_medium=content\"><strong>Revolution Slider Plugin</strong></a> – $35 Value</li><li>Includes the <a href=\"https://codecanyon.net/item/layerslider-wp-the-wordpress-parallax-slider/1362246\"><strong>Awesome Parallax Layer Slider Plugin</strong></a> – $22 Value</li><li>Custom Fusion Slider With Parallax Effect, Full Screen options and self hosted / youtube / vimeo support</li><li>Includes Elastic Slider</li><li>Includes FlexSlider 2 for page and post sliders</li><li>All sliders are touch swipe compatible and fully responsive</li></ul><p><strong>Intuitive Avada Builder Live</strong></p><ul><li>Beautiful visual page builder to help you easily build creative layouts</li><li>Most intuitive page builder on the market, easy to use while producing incredible results</li><li>Easy to use user interface makes page building a breeze</li><li>Drag and drop any of our elements to your hearts content</li><li>Easily create stunning pages within minutes using short codes</li><li>Save custom page layouts to reuse on other pages or post</li><li>Dozens of design elements to build unique pages quickly</li><li>Global options per short code element and individual overrides in Fusion Builder</li><li>Includes element previews for text, images and more</li><li>Over 60+ Elements and endless options to easily build creative layouts</li><li>Many short codes have several design options to choose from</li><li>Includes short code Generator integrated into Fusion Builder and default WordPress editor</li></ul><p><strong>Avada Mega Menu</strong></p><ul><li>A beautiful Avada Mega Menu design for large stylish menus and they are widget ready</li><li>Normal menus with 5 level dropdown</li><li>Accepts widgets; add maps, images, forms, any widget available!</li><li>Use from 1-6 columns</li><li>Set the menu to be full width or specific pixel value</li><li>Control each column width for more creative layouts</li><li>Insert background images in the full mega menu, or in individual columns</li><li>Insert icons or custom thumbnails next to menu items</li><li>Menu highlight labels can be added to any menu item for added visual cues</li></ul><p><strong>WooCommerce Compatible With Extensive Design Integration</strong></p><ul><li>Plugin ready with full design integration</li><li>Intuitive theme options panel for industry leading customization options</li><li>Options for 1-6 Columns</li><li>Custom featured product slider to display your products</li><li>Custom featured product carousel to display your products</li><li>Full width or sidebar single product pages</li><li>Full width or sidebar shop page</li><li>Avada Single product gallery or default WooCommerce product gallery</li><li>Single product image zoom on hover or disable zoom via options network</li><li>Display products based on category, ID or SKU</li><li>WooCommerce short codes are compatible with Avada columns</li><li>Continued collaboration with WooCommerce team to ensure compatibility</li></ul><p><strong>Popular Plugin Design Integration</strong></p><ul><li>WooCommerce compatible with <a href=\"https://avada.website/classic-shop/\"><strong>full design integration</strong></a></li><li>The Events Calendar compatible with <a href=\"https://avada.website/church/events/\"><strong>full design integration</strong></a></li><li>bbPress compatible with <a href=\"https://theme-fusion.com/avada/forums/forum/general-information/\"><strong>full design integration</strong></a></li><li><a href=\"https://avada.com/documentation/multilingual-management-with-wpml-and-avada/\"><strong>WPML plugin ready</strong></a></li><li><a href=\"https://avada.com/documentation/setting-up-a-multilingual-site-with-avada-and-wpml-or-polylang/\">Polyang</a> compatible</li><li>Continued collaboration with each team to ensure compatibility</li></ul><p><strong>Unlimited Color &amp; Styling Options</strong></p><ul><li>Extremely detailed theme options that allow you to control colors across the theme</li><li>Short code styling tab in theme options to style short codes with ease</li><li>Unlimited Color Options / Skins with Backend Color Picker</li><li>Full Color Customizations – change every element with ease including short codes</li><li>Choose a Light or Dark skin with one click</li><li>Choose from 8 pre-defined color skins, or create your own</li><li>Beautiful color pickers with integrated color and opacity sliders for added creativity</li></ul><p><strong>Advanced Portfolio Layout Options</strong></p><ul><li>3 layout options to choose from; Grid, Masonry, Classic, Text</li><li>1-6 column classic layout options</li><li>1-6 column text layout options along with a boxed or unboxed mode</li><li>Portfolio Masonry layout with unique hover effect</li><li>Portfolio Grid layout</li><li>Recent Work short code to insert portfolio posts on any page or post</li><li>Chose from auto image sizes or cropped image sizes</li><li>Global theme options settings and individual page and post settings</li><li>Set up multiple portfolio pages and set custom categories per page</li><li>Choose custom layout for archive/category pages</li><li>Select specific categories for each portfolio, fully customized</li><li>Set custom skills and tags for each portfolio posts</li><li>Easily order your Portfolio Items with awesome Re-Order Plugin</li><li>Awesome image rollovers with light box and link icons!</li><li>Full-Width featured image or Half-Width featured image single post page</li><li>New Full width single post page with no details or sidebar</li><li>Use 100% Width page template on single post pages</li><li>Use sidebars or dual sidebars on single post pages, also enable/disable project details and descriptions</li><li>Select a premium slider to show on your portfolio posts or page!</li><li>Use Images, Slideshows, &amp; Videos Very Easily!</li><li>Set Custom Featured Image size per post</li><li>Show or hide rollover icons per post</li><li>Change the opacity and color of image rollovers</li><li>Auto generated thumbnails</li><li>Easily specify the number of items per page</li><li>Automatic pagination</li><li>Sortable/filterable categories</li><li>Enable comments on portfolio posts</li><li>Many more bells and whistles to build the perfect portfolio site</li></ul><p><br></p>', 532000.00, NULL, '12', 'https://themeforest.net/item/avada-responsive-multipurpose-theme/full_screen_preview/2833226?_ga=2.40752614.515451604.1726133672-1375679939.1724922480', NULL, NULL, NULL, NULL, 0, '2024-09-12 02:37:36', '2024-09-12 02:37:36');
INSERT INTO `wordpress_products` (`id`, `category_id`, `name`, `slug`, `image`, `gallery`, `sku`, `type`, `status`, `version`, `short_content`, `long_content`, `price`, `sale_price`, `sold`, `demo`, `download_link`, `system_requirements`, `license_key`, `license_expiration_date`, `views`, `created_at`, `updated_at`) VALUES
(5, 18, 'Builder For WordPress & eCommerce', 'builder-for-wordpress-ecommerce', 'Wordpress/01J7JSGTMQG4RX4S16PQB2EREV.jpg', '[]', 'K68-FV5GJ3', NULL, 'active', '12.43', '<p><a href=\"https://avada.com/whats-new/\"><strong><em>Avada 7.11 is live!</em></strong></a><em> This feature-rich version introduces a wide range of new design options and tons of new features. We have introduced Multi-Step Avada Forms, Pixel Width &amp; Flex Grow for Columns, and Mailchimp tag/group support. In addition, you can now create a WooCommerce thank you page when designing a site with the Avada Setup Wizard, improvements to the Prebuilt Website Import process, text stroke styling, ToTop button styling, and so much more.</em></p>', '<blockquote><a href=\"https://avada.com/whats-new/\"><strong>Avada 7.11 is live!</strong></a> This feature-rich version introduces a wide range of new design options and tons of new features. We have introduced Multi-Step Avada Forms, Pixel Width &amp; Flex Grow for Columns, and Mailchimp tag/group support. In addition, you can now create a WooCommerce thank you page when designing a site with the Avada Setup Wizard, improvements to the Prebuilt Website Import process, text stroke styling, ToTop button styling, and so much more.</blockquote><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1190,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/96751e9bb3f2af1b5fe86d2c456246327072cd86/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303161766164612d76657273696f6e2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/96751e9bb3f2af1b5fe86d2c456246327072cd86/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303161766164612d76657273696f6e2d3731312e6a7067\" width=\"1230\" height=\"1190\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1230,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/79c5ac51595483483d931d416434dee79bd071be/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30326d756c74692d737465702d61766164612d666f726d732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/79c5ac51595483483d931d416434dee79bd071be/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30326d756c74692d737465702d61766164612d666f726d732d3731312e6a7067\" width=\"1230\" height=\"1230\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1260,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/0689a28236a5472729d49de5452b752aa071646f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303461766164612d6d6567612d6d656e752d6275696c6465722d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/0689a28236a5472729d49de5452b752aa071646f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303461766164612d6d6567612d6d656e752d6275696c6465722d3731312e6a7067\" width=\"1230\" height=\"1260\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1190,&quot;href&quot;:&quot;https://avada.com/whats-new/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/d73cb8398dd80afb2a961df8db5ac3e846d21a9f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303561766164612d726f6c652d6d616e616765722d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/whats-new/\"><img src=\"https://camo.envatousercontent.com/d73cb8398dd80afb2a961df8db5ac3e846d21a9f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303561766164612d726f6c652d6d616e616765722d3731312e6a7067\" width=\"1230\" height=\"1190\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1144,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/15629db8c4b1d92d3ca595e70b916a51de2c0401/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303661766164612d73657475702d77697a6172642d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/15629db8c4b1d92d3ca595e70b916a51de2c0401/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303661766164612d73657475702d77697a6172642d3731312e6a7067\" width=\"1230\" height=\"1144\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1028,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/c15cf77ce8e74a0400dc3b9e8b36e4b6e45b45eb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303761766164612d73747564696f2d7374796c696e672d6f7074696f6e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/c15cf77ce8e74a0400dc3b9e8b36e4b6e45b45eb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303761766164612d73747564696f2d7374796c696e672d6f7074696f6e732d3731312e6a7067\" width=\"1230\" height=\"1028\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1100,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/08a0c5e24adb0c5f2cd54bb77bba2a31bc98dac7/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30386f66662d63616e7661732d6275696c6465722d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/08a0c5e24adb0c5f2cd54bb77bba2a31bc98dac7/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30386f66662d63616e7661732d6275696c6465722d3731312e6a7067\" width=\"1230\" height=\"1100\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1337,&quot;href&quot;:&quot;https://www.siteground.com/avada?afcode=452502cf59bfef470b2806e5ba67670a&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/50ef36b4123509f16a756b9e499d3dd2f6874912/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30397369746567726f756e642d61766164612d686f7374696e672d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://www.siteground.com/avada?afcode=452502cf59bfef470b2806e5ba67670a\"><img src=\"https://camo.envatousercontent.com/50ef36b4123509f16a756b9e499d3dd2f6874912/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30397369746567726f756e642d61766164612d686f7374696e672d3731312e6a7067\" width=\"1230\" height=\"1337\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1958,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/d188d81cde79c1df28f628d7c6d9569498d2f204/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313061766164612d73747564696f2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/d188d81cde79c1df28f628d7c6d9569498d2f204/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313061766164612d73747564696f2d3731312e6a7067\" width=\"1230\" height=\"1958\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2300,&quot;href&quot;:&quot;https://avada.com/feature/performance-wizard/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/371450a3e2bd7eab947d52d91c8d17ca20a9ca22/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313161766164612d706572666f726d616e63652d77697a6172642d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/feature/performance-wizard/\"><img src=\"https://camo.envatousercontent.com/371450a3e2bd7eab947d52d91c8d17ca20a9ca22/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313161766164612d706572666f726d616e63652d77697a6172642d3731312e6a7067\" width=\"1230\" height=\"2300\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/5766c0cc1ef29985915dc1771d5951cc809fd4bb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313261766164612d776f6f636f6d6d657263652d6275696c6465722d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:1117}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/5766c0cc1ef29985915dc1771d5951cc809fd4bb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313261766164612d776f6f636f6d6d657263652d6275696c6465722d3731312d7363616c65642e6a7067\" width=\"1117\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/359bd7a0f865a560c53b7da93b2cbfbd7352a94a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313361766164612d706f73742d636172642d6c61796f7574732d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:989}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/359bd7a0f865a560c53b7da93b2cbfbd7352a94a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313361766164612d706f73742d636172642d6c61796f7574732d3731312d7363616c65642e6a7067\" width=\"989\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1759,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/e96a90876b1f53d8b7b2ba47b475f59d6561c218/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f31346d6f62696c652d667269656e646c792d6374612d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/e96a90876b1f53d8b7b2ba47b475f59d6561c218/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f31346d6f62696c652d667269656e646c792d6374612d3731312e6a7067\" width=\"1230\" height=\"1759\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:10241,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/340d3447f2e23afbbe0b96a3ca9aaf9d9c027e44/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313561766164612d6275696c646572732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/340d3447f2e23afbbe0b96a3ca9aaf9d9c027e44/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313561766164612d6275696c646572732d3731312e6a7067\" width=\"1230\" height=\"10241\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1660,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/03227fd4921aacdf407572d1193c9d167ca547dc/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313661766164612d64657369676e2d6c61796f75742d656c656d656e74732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/03227fd4921aacdf407572d1193c9d167ca547dc/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313661766164612d64657369676e2d6c61796f75742d656c656d656e74732d3731312e6a7067\" width=\"1230\" height=\"1660\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1615,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/050e2026e583a375d7bc590d1f8762233afbff33/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313775706c6f61642d637573746f6d2d69636f6e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/050e2026e583a375d7bc590d1f8762233afbff33/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313775706c6f61642d637573746f6d2d69636f6e732d3731312e6a7067\" width=\"1230\" height=\"1615\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1945,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/6b7477dde2f3b070359ed053b5e786b1340f8d94/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313861766164612d64796e616d69632d636f6e74656e742d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/6b7477dde2f3b070359ed053b5e786b1340f8d94/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313861766164612d64796e616d69632d636f6e74656e742d3731312e6a7067\" width=\"1230\" height=\"1945\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:937,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/e8e755721a10725dca41fd174cfebc8cb6076a10/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3139656e7661746f2d63656f2d636f6c6c69732d7265766965772d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/e8e755721a10725dca41fd174cfebc8cb6076a10/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3139656e7661746f2d63656f2d636f6c6c69732d7265766965772d3731312e6a7067\" width=\"1230\" height=\"937\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/prebuilt-websites/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/0bea2b3f993da87f29ab1eb6925decb5a49ee781/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323061766164612d7072656275696c742d77656273697465732d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:783}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/prebuilt-websites/\"><img src=\"https://camo.envatousercontent.com/0bea2b3f993da87f29ab1eb6925decb5a49ee781/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323061766164612d7072656275696c742d77656273697465732d3731312d7363616c65642e6a7067\" width=\"783\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:280,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/1e8d817892a7b0dc84dfd196dc46986b51eb2bcb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32316275792d61766164612d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/1e8d817892a7b0dc84dfd196dc46986b51eb2bcb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32316275792d61766164612d3731312e6a7067\" width=\"1230\" height=\"280\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:986,&quot;href&quot;:&quot;https://avada.com/reviews/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/a2b7ba19b0dcf0cce4ebc2a7fa477b0cb6309fb2/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32327374657068656e2d656e7661746f2d7265766965772d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/reviews/\"><img src=\"https://camo.envatousercontent.com/a2b7ba19b0dcf0cce4ebc2a7fa477b0cb6309fb2/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32327374657068656e2d656e7661746f2d7265766965772d3731312e6a7067\" width=\"1230\" height=\"986\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/reviews/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/c46aa757005f9a75508da2cf7f0e3b1216016085/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323361766164612d352d737461722d726576696577732d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:755}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/reviews/\"><img src=\"https://camo.envatousercontent.com/c46aa757005f9a75508da2cf7f0e3b1216016085/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323361766164612d352d737461722d726576696577732d3731312d7363616c65642e6a7067\" width=\"755\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2358,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/8fe92ddba22227290c138a60aa65f9f3fe8bbe8a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323470617373696f6e6174652d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/8fe92ddba22227290c138a60aa65f9f3fe8bbe8a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323470617373696f6e6174652d3731312e6a7067\" width=\"1230\" height=\"2358\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:310,&quot;href&quot;:&quot;https://avada.com/help-center/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/915b9a6f62dda306a867b89b679fc9e87f8d2dcd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3235636f6d70726568656e736976652d646f63756d656e746174696f6e2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/help-center/\"><img src=\"https://camo.envatousercontent.com/915b9a6f62dda306a867b89b679fc9e87f8d2dcd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3235636f6d70726568656e736976652d646f63756d656e746174696f6e2d3731312e6a7067\" width=\"1230\" height=\"310\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:315,&quot;href&quot;:&quot;mailto:https://www.youtube.com/@AvadaVideos&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/eb290b074ac5cf9d0f2b9432cd91041a8562a14a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3236657874656e736976652d766964656f2d7475746f7269616c732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"mailto:https://www.youtube.com/@AvadaVideos\"><img src=\"https://camo.envatousercontent.com/eb290b074ac5cf9d0f2b9432cd91041a8562a14a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3236657874656e736976652d766964656f2d7475746f7269616c732d3731312e6a7067\" width=\"1230\" height=\"315\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1292,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/30a745b02f1257b466da600762e127cca0a764b5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32377072656d69756d2d706c7567696e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/30a745b02f1257b466da600762e127cca0a764b5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32377072656d69756d2d706c7567696e732d3731312e6a7067\" width=\"1230\" height=\"1292\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1246,&quot;href&quot;:&quot;https://avada.com/features/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/2c7a17fef4fd7fe67ad95963db9faef979e67477/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323861766164612d64657369676e2d696e746567726174696f6e2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/features/\"><img src=\"https://camo.envatousercontent.com/2c7a17fef4fd7fe67ad95963db9faef979e67477/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323861766164612d64657369676e2d696e746567726174696f6e2d3731312e6a7067\" width=\"1230\" height=\"1246\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:284,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/84768613d547a351756ab4fb60980acaa86ad04c/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3239677574656e626572672d6f7074696d697a65642d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/84768613d547a351756ab4fb60980acaa86ad04c/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3239677574656e626572672d6f7074696d697a65642d3731312e6a7067\" width=\"1230\" height=\"284\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1169,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/e8c52cc84a1a1074af12f6363939c5f1a6783b11/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333061766164612d707269766163792d746f6f6c732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/e8c52cc84a1a1074af12f6363939c5f1a6783b11/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333061766164612d707269766163792d746f6f6c732d3731312e6a7067\" width=\"1230\" height=\"1169\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:677,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/d7ef72473b794b6ef58a8fc2abb766800eb880a1/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333161766164612d73616c65732d636f756e742d6374612d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/d7ef72473b794b6ef58a8fc2abb766800eb880a1/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333161766164612d73616c65732d636f756e742d6374612d3731312e6a7067\" width=\"1230\" height=\"677\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1175,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/b31ce133ecaf2475946456e5180872cdb8c912d5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33327472616e736c6174696f6e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/b31ce133ecaf2475946456e5180872cdb8c912d5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33327472616e736c6174696f6e732d3731312e6a7067\" width=\"1230\" height=\"1175\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1820,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/31a74371ac4f367edcfeb29b1a03b0d5b2e4d4f3/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333361766164612d667265652d757064617465732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/31a74371ac4f367edcfeb29b1a03b0d5b2e4d4f3/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333361766164612d667265652d757064617465732d3731312e6a7067\" width=\"1230\" height=\"1820\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2470,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/55fd1bfa55b67e8f5b0e4215142c04d04ed79de9/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3334646576656c6f7065642d696e2d686f7573652d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/55fd1bfa55b67e8f5b0e4215142c04d04ed79de9/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3334646576656c6f7065642d696e2d686f7573652d3731312e6a7067\" width=\"1230\" height=\"2470\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/8a3a28291714cf0e110f128d3a24727c078a92a0/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3335726561736f6e732d746f2d6275792d61766164612d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:620}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/8a3a28291714cf0e110f128d3a24727c078a92a0/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3335726561736f6e732d746f2d6275792d61766164612d3731312d7363616c65642e6a7067\" width=\"620\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:384,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/ea3f146adc636f904100bf3ec6f97a17f23fdcdd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33366a6f696e2d61766164612d636f6d6d756e6974792d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/ea3f146adc636f904100bf3ec6f97a17f23fdcdd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33366a6f696e2d61766164612d636f6d6d756e6974792d3731312e6a7067\" width=\"1230\" height=\"384\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/217ebe6813e6ec5ee39a8940fd4b8030413dffa6/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3337746f702d73656c6c696e672d7468656d652d616c6c2d74696d652d3731312e6a7067&quot;}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/217ebe6813e6ec5ee39a8940fd4b8030413dffa6/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3337746f702d73656c6c696e672d7468656d652d616c6c2d74696d652d3731312e6a7067\" width=\"1230\" height=\"380\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><strong>Avada is available to purchase and download!</strong></p><p>Avada is a Website Builder for WordPress that offers a comprehensive range of features for creating custom websites, including an intuitive Drag &amp; Drop <a href=\"https://avada.com/feature/live-visual-builder/\">Live Visual Builder</a>, a <a href=\"https://avada.com/feature/layout-builder/\">Layout Builder</a>, a <a href=\"https://avada.com/feature/header-builder/\">Header Builder</a>, a <a href=\"https://avada.com/feature/footer-builder/\">Footer Builder</a>, the <a href=\"https://avada.com/feature/form-builder/\">Avada Form Builder</a>, an <a href=\"https://avada.com/feature/woocommerce/\">eCommerce Builder</a>, WooCommerce integration, the <a href=\"https://avada.com/feature/setup-wizard/\">Avada Setup Wizard</a>, and performance optimization tools. In addition, Avada supports dynamic content and is mobile-friendly, ensuring websites are responsive across all devices, from mobile to desktop.</p><p>Avada is also the #1 selling WordPress Website Builder on the marketplace and has been continuously for more than 11+ years. 950,000+ beginners, marketers, professionals, agencies, businesses, and creatives trust Avada for total design freedom. Our illustrious history is a testament to the fact that Avada is the most versatile and easy-to-use multi-purpose WordPress theme on the market today. Years of refinement and feedback have reinforced our determination to be the best at what we do and provide you with the tools to make things happen efficiently and quickly without requiring coding knowledge.</p><p>Below we have highlighted some of Avada’s features! The list may be long, but so are the reasons to purchase Avada and join the most significant WordPress community out there!</p><ul><li>Avada has Intuitive visual front-end design and editing tools for you to create beautiful websites, fast.</li><li>A clean, modern, multi-purpose designs which can be adapted and used for any website design and layout</li><li>The #1 selling WordPress theme on the market for 11+ years and counting</li><li>A highly advanced network of options for easy customizations without modifying the code</li><li>Dozens of professionally designed demos that can be imported fast with the click of a button</li><li>More than 25,000+ ratings with a 5-Star Average</li><li>Always compatible with the latest WordPress versions</li><li>Always compatible with the latest versions of 3rd party integrated plugins</li><li>WordPress Multisite (WPMU) Tested and Approved</li><li>Built with HTML5 and CSS3</li><li>100% SEO Optimized and perfectly compatible with Plugins like Yoast SEO</li><li>Adherence to strict WordPress and PHP coding standards</li><li>Performance enhancements for fast, reliable, quality websites</li><li>Cross-Browser Compatibility: FireFox, Safari, Chrome, IE9, IE10, IE11</li><li>100% Responsive Theme with pixel perfect accuracy – and you can disable responsiveness</li><li>Easy to use Fusion Builder Visual Editor, the best visual page builder on the market</li><li>Full control over site width; content area and sidebars</li><li>Retina Ready, Ultra-High Resolution Graphics</li><li>Social Icons and Theme Icons are CSS Font Icons, no Images</li><li>Automatic Theme Updater directly through the WordPress Admin interface</li><li>Automatic Patch tool to apply fixes and improvements with one click, no other theme has this</li><li>Dual, flexible sidebars throughout the theme</li><li>1-6 Column Support</li><li>One Page Parallax feature for any page</li><li>CSS3 animations enable or disable on desktop/mobile</li><li>Child Theme Compatible – Your Avada package includes a basic child theme</li><li>Strong focus on typography, usability and overall user-experience</li><li>jQuery Enhancements for modern websites</li><li>JavaScript files are automatically combined and minified for added performance</li><li>JS/PHP Compiler for CSS that combines all styles into one generated file for added performance</li><li>Includes the Font Awesome icon set, fully integrated</li><li>Font Awesome Pro can be enabled to use with Avada</li><li>60 Layered PSD’s included of the original Avada Classic design</li><li>Compatible with Ubermenu (uber does not support sticky headers)</li><li>Compatible with Many Popular Plugins like WPML, Yoast, W3TC, JetPack, Slider Revolution, Layer Slider, WooCommerce, The Events Calendar, bbPress, BuddyPress, WP Rocket, All In One SEO, NextGen Gallery, UpDraft Plus to name a few</li></ul><p><strong>Professional 5-Star Customer Support</strong></p><ul><li>We take pride in offering THE BEST after sales support around. We care about your site as much as you and will help in anyway possible</li><li>Feature Packed Updates – get new features and new development in each future update</li><li>Technical Support with a growing community of over 950,000 customers! At our support center, we answer each and every ticket as if it was our own because we care about you and your site</li><li>Customer feedback always welcomed for new features</li><li>Once you register your purchase, you can use our advanced support ticket system to receive professional support</li><li>Includes the most extensive online documentation you can find and its constantly being updated with new material</li><li>Multiple HD video tutorials for easy instruction</li><li>Access our extensive knowledge base that is ever-growing</li><li>Ever growing user base, read our user testimonials</li></ul><p><strong>100+ Professionally Designed Prebuilt Websites</strong></p><ul><li>The Best Website Importer On The Market – Industry leading demo import that is amazingly easy to use and the fastest way to build your website. One click website import allows you to install a full demo with everything, or a partial demo. Want the Creative demo but with Modern Shop products for an eCommerce site? Easily done! And you can quickly uninstall any imported demo content with a click.</li><li><a href=\"https://avada.website/\">Professionally designed prebuilt websites</a> that you can import with just a click. Industry leading designs created by a team of professional designers.</li><li>More added with each major update based on popular demand</li><li>Each demo is professionally designed to truly represent the exact nature of the industry; Cafe, Gym, Agency, Travel, Photography just to name a few</li><li>Beautiful easy to use interface through a Welcome Screen that allows you to view each prebuilt website, preview it, then import with just a click.</li><li>WooCommerce shop setup and products import, bbPress content imports, Events Calendar content imports</li><li>Each prebuilt website has been optimized using the <a href=\"https://avada.com/feature/performance-wizard/\">Avada Performance Wizard</a></li></ul><p><strong>Advanced Theme Options Network</strong> Fusion Theme Options control options and settings globally throughout the site, whereas Fusion Page Options control individual pages and posts. Individual page options give you the freedom to change anything on a single page or post that will thereby override the global Theme Options. The Avada Advanced Options Network gives you the ultimate flexibility to design and style layouts that are unique and stand out from the rest of the site.</p><ul><li>50+ main and sub theme option panels loaded with powerful customization options</li><li>Extensive options which provide incredible customization options without having to modify code</li><li>Fully dependent options so the only you see are the options that are in use based on your configuration</li><li>Entire option network correlation so you can quickly see what is set global vs individual</li><li>Incredible search feature that allows you to quickly find any option you need</li><li>Advanced options to enable or disable individual features for performance enhancements</li><li>Full control over the entire layout; site width, content area, sidebars and more</li><li>Logically organized options based on normal site building procedures</li><li>Customized repeater fields that allow for unlimited custom fonts and icons</li><li>Custom fonts can be used in any font-family filed throughout the site</li><li>Combined options for things like typography put you in full control of all settings in one area saving you precious time</li><li>Easily import and export your data for using on different installs or for safe backups</li><li>Native WordPress feel that has the same hover effects, styles and pulls user color profiles</li><li>All running on a customized version of the powerful Redux Framework</li></ul><p><strong>Advanced Fusion Page/Post Options</strong> We created the page and post options to extend the Avada Theme Options. Doing this gives you extreme flexibility by being able to override the global Theme Options and create unique and dynamic content-rich pages that stand out. Any single page or post (or more than one) can have a different layout and styling compared to the rest of the site.</p><ul><li>Multiple option panels with amazingly deep customization options: Sliders, Page, Post, Header, Footer, Sidebars, Backgrounds, Portfolio, Page Title Bar</li><li>Assign any slider to any page or post, show slider above or below header, use transparent header per page</li><li>Customize page title bar for any page or post</li><li>Customize page settings like paddings uniquely for each page or post</li><li>Customize header styles individually for any page or post</li><li>Insert custom images or colors for header section, main section, boxed background per page or post</li><li>Choose a custom menu per page or post</li><li>Enable or Disable headers, footers, sliders, sidebars, backgrounds and more per page or post</li><li>Customize various parts of the portfolio per page or portfolio posts</li><li>Insert custom excerpt length per portfolio pages</li><li>Customize sidebars and sidebar positions for any page or post.</li></ul><p><strong>Incredible Theme Updates That Make All The Difference</strong></p><ul><li>Avada releases continued value packed feature updates based off user requested features and demands</li><li>Continued codebase improvements for performance enhancements and future maintenance</li><li>Every update is <strong>FREE</strong> to anyone who has bought a license</li></ul><p><strong>Multiple Premium Slider Options</strong></p><ul><li>Includes Amazing <a href=\"https://www.sliderrevolution.com/?utm_source=themeforest.net&amp;utm_medium=content\"><strong>Revolution Slider Plugin</strong></a> – $35 Value</li><li>Includes the <a href=\"https://codecanyon.net/item/layerslider-wp-the-wordpress-parallax-slider/1362246\"><strong>Awesome Parallax Layer Slider Plugin</strong></a> – $22 Value</li><li>Custom Fusion Slider With Parallax Effect, Full Screen options and self hosted / youtube / vimeo support</li><li>Includes Elastic Slider</li><li>Includes FlexSlider 2 for page and post sliders</li><li>All sliders are touch swipe compatible and fully responsive</li></ul><p><strong>Intuitive Avada Builder Live</strong></p><ul><li>Beautiful visual page builder to help you easily build creative layouts</li><li>Most intuitive page builder on the market, easy to use while producing incredible results</li><li>Easy to use user interface makes page building a breeze</li><li>Drag and drop any of our elements to your hearts content</li><li>Easily create stunning pages within minutes using short codes</li><li>Save custom page layouts to reuse on other pages or post</li><li>Dozens of design elements to build unique pages quickly</li><li>Global options per short code element and individual overrides in Fusion Builder</li><li>Includes element previews for text, images and more</li><li>Over 60+ Elements and endless options to easily build creative layouts</li><li>Many short codes have several design options to choose from</li><li>Includes short code Generator integrated into Fusion Builder and default WordPress editor</li></ul><p><strong>Avada Mega Menu</strong></p><ul><li>A beautiful Avada Mega Menu design for large stylish menus and they are widget ready</li><li>Normal menus with 5 level dropdown</li><li>Accepts widgets; add maps, images, forms, any widget available!</li><li>Use from 1-6 columns</li><li>Set the menu to be full width or specific pixel value</li><li>Control each column width for more creative layouts</li><li>Insert background images in the full mega menu, or in individual columns</li><li>Insert icons or custom thumbnails next to menu items</li><li>Menu highlight labels can be added to any menu item for added visual cues</li></ul><p><strong>WooCommerce Compatible With Extensive Design Integration</strong></p><ul><li>Plugin ready with full design integration</li><li>Intuitive theme options panel for industry leading customization options</li><li>Options for 1-6 Columns</li><li>Custom featured product slider to display your products</li><li>Custom featured product carousel to display your products</li><li>Full width or sidebar single product pages</li><li>Full width or sidebar shop page</li><li>Avada Single product gallery or default WooCommerce product gallery</li><li>Single product image zoom on hover or disable zoom via options network</li><li>Display products based on category, ID or SKU</li><li>WooCommerce short codes are compatible with Avada columns</li><li>Continued collaboration with WooCommerce team to ensure compatibility</li></ul><p><strong>Popular Plugin Design Integration</strong></p><ul><li>WooCommerce compatible with <a href=\"https://avada.website/classic-shop/\"><strong>full design integration</strong></a></li><li>The Events Calendar compatible with <a href=\"https://avada.website/church/events/\"><strong>full design integration</strong></a></li><li>bbPress compatible with <a href=\"https://theme-fusion.com/avada/forums/forum/general-information/\"><strong>full design integration</strong></a></li><li><a href=\"https://avada.com/documentation/multilingual-management-with-wpml-and-avada/\"><strong>WPML plugin ready</strong></a></li><li><a href=\"https://avada.com/documentation/setting-up-a-multilingual-site-with-avada-and-wpml-or-polylang/\">Polyang</a> compatible</li><li>Continued collaboration with each team to ensure compatibility</li></ul><p><strong>Unlimited Color &amp; Styling Options</strong></p><ul><li>Extremely detailed theme options that allow you to control colors across the theme</li><li>Short code styling tab in theme options to style short codes with ease</li><li>Unlimited Color Options / Skins with Backend Color Picker</li><li>Full Color Customizations – change every element with ease including short codes</li><li>Choose a Light or Dark skin with one click</li><li>Choose from 8 pre-defined color skins, or create your own</li><li>Beautiful color pickers with integrated color and opacity sliders for added creativity</li></ul><p><strong>Advanced Portfolio Layout Options</strong></p><ul><li>3 layout options to choose from; Grid, Masonry, Classic, Text</li><li>1-6 column classic layout options</li><li>1-6 column text layout options along with a boxed or unboxed mode</li><li>Portfolio Masonry layout with unique hover effect</li><li>Portfolio Grid layout</li><li>Recent Work short code to insert portfolio posts on any page or post</li><li>Chose from auto image sizes or cropped image sizes</li><li>Global theme options settings and individual page and post settings</li><li>Set up multiple portfolio pages and set custom categories per page</li><li>Choose custom layout for archive/category pages</li><li>Select specific categories for each portfolio, fully customized</li><li>Set custom skills and tags for each portfolio posts</li><li>Easily order your Portfolio Items with awesome Re-Order Plugin</li><li>Awesome image rollovers with light box and link icons!</li><li>Full-Width featured image or Half-Width featured image single post page</li><li>New Full width single post page with no details or sidebar</li><li>Use 100% Width page template on single post pages</li><li>Use sidebars or dual sidebars on single post pages, also enable/disable project details and descriptions</li><li>Select a premium slider to show on your portfolio posts or page!</li><li>Use Images, Slideshows, &amp; Videos Very Easily!</li><li>Set Custom Featured Image size per post</li><li>Show or hide rollover icons per post</li><li>Change the opacity and color of image rollovers</li><li>Auto generated thumbnails</li><li>Easily specify the number of items per page</li><li>Automatic pagination</li><li>Sortable/filterable categories</li><li>Enable comments on portfolio posts</li><li>Many more bells and whistles to build the perfect portfolio site</li></ul><p><br></p>', 123000.00, NULL, '0', 'https://themeforest.net/item/avada-responsive-multipurpose-theme/full_screen_preview/2833226?_ga=2.40752614.515451604.1726133672-1375679939.1724922480', NULL, NULL, NULL, NULL, 0, '2024-09-12 02:45:36', '2024-09-12 02:45:36');
INSERT INTO `wordpress_products` (`id`, `category_id`, `name`, `slug`, `image`, `gallery`, `sku`, `type`, `status`, `version`, `short_content`, `long_content`, `price`, `sale_price`, `sold`, `demo`, `download_link`, `system_requirements`, `license_key`, `license_expiration_date`, `views`, `created_at`, `updated_at`) VALUES
(6, 10, 'iTera - IT, SEO, Digital WordPress Theme', 'itera-it-business-wordpress-theme', 'Wordpress/01J7JSGTMQG4RX4S16PQB2EREV.jpg', '[]', 'K68-FV54J3', NULL, 'active', '6.3', '<p><a href=\"https://avada.com/whats-new/\"><strong><em>Avada 7.11 is live!</em></strong></a><em> This feature-rich version introduces a wide range of new design options and tons of new features. We have introduced Multi-Step Avada Forms, Pixel Width &amp; Flex Grow for Columns, and Mailchimp tag/group support. In addition, you can now create a WooCommerce thank you page when designing a site with the Avada Setup Wizard, improvements to the Prebuilt Website Import process, text stroke styling, ToTop button styling, and so much more.</em></p>', '<blockquote><a href=\"https://avada.com/whats-new/\"><strong>Avada 7.11 is live!</strong></a> This feature-rich version introduces a wide range of new design options and tons of new features. We have introduced Multi-Step Avada Forms, Pixel Width &amp; Flex Grow for Columns, and Mailchimp tag/group support. In addition, you can now create a WooCommerce thank you page when designing a site with the Avada Setup Wizard, improvements to the Prebuilt Website Import process, text stroke styling, ToTop button styling, and so much more.</blockquote><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1190,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/96751e9bb3f2af1b5fe86d2c456246327072cd86/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303161766164612d76657273696f6e2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/96751e9bb3f2af1b5fe86d2c456246327072cd86/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303161766164612d76657273696f6e2d3731312e6a7067\" width=\"1230\" height=\"1190\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1230,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/79c5ac51595483483d931d416434dee79bd071be/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30326d756c74692d737465702d61766164612d666f726d732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/79c5ac51595483483d931d416434dee79bd071be/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30326d756c74692d737465702d61766164612d666f726d732d3731312e6a7067\" width=\"1230\" height=\"1230\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1260,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/0689a28236a5472729d49de5452b752aa071646f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303461766164612d6d6567612d6d656e752d6275696c6465722d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/0689a28236a5472729d49de5452b752aa071646f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303461766164612d6d6567612d6d656e752d6275696c6465722d3731312e6a7067\" width=\"1230\" height=\"1260\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1190,&quot;href&quot;:&quot;https://avada.com/whats-new/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/d73cb8398dd80afb2a961df8db5ac3e846d21a9f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303561766164612d726f6c652d6d616e616765722d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/whats-new/\"><img src=\"https://camo.envatousercontent.com/d73cb8398dd80afb2a961df8db5ac3e846d21a9f/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303561766164612d726f6c652d6d616e616765722d3731312e6a7067\" width=\"1230\" height=\"1190\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1144,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/15629db8c4b1d92d3ca595e70b916a51de2c0401/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303661766164612d73657475702d77697a6172642d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/15629db8c4b1d92d3ca595e70b916a51de2c0401/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303661766164612d73657475702d77697a6172642d3731312e6a7067\" width=\"1230\" height=\"1144\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1028,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/c15cf77ce8e74a0400dc3b9e8b36e4b6e45b45eb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303761766164612d73747564696f2d7374796c696e672d6f7074696f6e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/c15cf77ce8e74a0400dc3b9e8b36e4b6e45b45eb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f303761766164612d73747564696f2d7374796c696e672d6f7074696f6e732d3731312e6a7067\" width=\"1230\" height=\"1028\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1100,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/08a0c5e24adb0c5f2cd54bb77bba2a31bc98dac7/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30386f66662d63616e7661732d6275696c6465722d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/08a0c5e24adb0c5f2cd54bb77bba2a31bc98dac7/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30386f66662d63616e7661732d6275696c6465722d3731312e6a7067\" width=\"1230\" height=\"1100\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1337,&quot;href&quot;:&quot;https://www.siteground.com/avada?afcode=452502cf59bfef470b2806e5ba67670a&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/50ef36b4123509f16a756b9e499d3dd2f6874912/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30397369746567726f756e642d61766164612d686f7374696e672d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://www.siteground.com/avada?afcode=452502cf59bfef470b2806e5ba67670a\"><img src=\"https://camo.envatousercontent.com/50ef36b4123509f16a756b9e499d3dd2f6874912/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f30397369746567726f756e642d61766164612d686f7374696e672d3731312e6a7067\" width=\"1230\" height=\"1337\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1958,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/d188d81cde79c1df28f628d7c6d9569498d2f204/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313061766164612d73747564696f2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/d188d81cde79c1df28f628d7c6d9569498d2f204/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313061766164612d73747564696f2d3731312e6a7067\" width=\"1230\" height=\"1958\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2300,&quot;href&quot;:&quot;https://avada.com/feature/performance-wizard/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/371450a3e2bd7eab947d52d91c8d17ca20a9ca22/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313161766164612d706572666f726d616e63652d77697a6172642d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/feature/performance-wizard/\"><img src=\"https://camo.envatousercontent.com/371450a3e2bd7eab947d52d91c8d17ca20a9ca22/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313161766164612d706572666f726d616e63652d77697a6172642d3731312e6a7067\" width=\"1230\" height=\"2300\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/5766c0cc1ef29985915dc1771d5951cc809fd4bb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313261766164612d776f6f636f6d6d657263652d6275696c6465722d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:1117}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/5766c0cc1ef29985915dc1771d5951cc809fd4bb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313261766164612d776f6f636f6d6d657263652d6275696c6465722d3731312d7363616c65642e6a7067\" width=\"1117\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/359bd7a0f865a560c53b7da93b2cbfbd7352a94a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313361766164612d706f73742d636172642d6c61796f7574732d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:989}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/359bd7a0f865a560c53b7da93b2cbfbd7352a94a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313361766164612d706f73742d636172642d6c61796f7574732d3731312d7363616c65642e6a7067\" width=\"989\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1759,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/e96a90876b1f53d8b7b2ba47b475f59d6561c218/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f31346d6f62696c652d667269656e646c792d6374612d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/e96a90876b1f53d8b7b2ba47b475f59d6561c218/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f31346d6f62696c652d667269656e646c792d6374612d3731312e6a7067\" width=\"1230\" height=\"1759\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:10241,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/340d3447f2e23afbbe0b96a3ca9aaf9d9c027e44/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313561766164612d6275696c646572732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/340d3447f2e23afbbe0b96a3ca9aaf9d9c027e44/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313561766164612d6275696c646572732d3731312e6a7067\" width=\"1230\" height=\"10241\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1660,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/03227fd4921aacdf407572d1193c9d167ca547dc/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313661766164612d64657369676e2d6c61796f75742d656c656d656e74732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/03227fd4921aacdf407572d1193c9d167ca547dc/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313661766164612d64657369676e2d6c61796f75742d656c656d656e74732d3731312e6a7067\" width=\"1230\" height=\"1660\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1615,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/050e2026e583a375d7bc590d1f8762233afbff33/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313775706c6f61642d637573746f6d2d69636f6e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/050e2026e583a375d7bc590d1f8762233afbff33/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313775706c6f61642d637573746f6d2d69636f6e732d3731312e6a7067\" width=\"1230\" height=\"1615\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1945,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/6b7477dde2f3b070359ed053b5e786b1340f8d94/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313861766164612d64796e616d69632d636f6e74656e742d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/6b7477dde2f3b070359ed053b5e786b1340f8d94/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f313861766164612d64796e616d69632d636f6e74656e742d3731312e6a7067\" width=\"1230\" height=\"1945\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:937,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/e8e755721a10725dca41fd174cfebc8cb6076a10/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3139656e7661746f2d63656f2d636f6c6c69732d7265766965772d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/e8e755721a10725dca41fd174cfebc8cb6076a10/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3139656e7661746f2d63656f2d636f6c6c69732d7265766965772d3731312e6a7067\" width=\"1230\" height=\"937\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/prebuilt-websites/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/0bea2b3f993da87f29ab1eb6925decb5a49ee781/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323061766164612d7072656275696c742d77656273697465732d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:783}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/prebuilt-websites/\"><img src=\"https://camo.envatousercontent.com/0bea2b3f993da87f29ab1eb6925decb5a49ee781/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323061766164612d7072656275696c742d77656273697465732d3731312d7363616c65642e6a7067\" width=\"783\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:280,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/1e8d817892a7b0dc84dfd196dc46986b51eb2bcb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32316275792d61766164612d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/1e8d817892a7b0dc84dfd196dc46986b51eb2bcb/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32316275792d61766164612d3731312e6a7067\" width=\"1230\" height=\"280\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:986,&quot;href&quot;:&quot;https://avada.com/reviews/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/a2b7ba19b0dcf0cce4ebc2a7fa477b0cb6309fb2/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32327374657068656e2d656e7661746f2d7265766965772d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/reviews/\"><img src=\"https://camo.envatousercontent.com/a2b7ba19b0dcf0cce4ebc2a7fa477b0cb6309fb2/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32327374657068656e2d656e7661746f2d7265766965772d3731312e6a7067\" width=\"1230\" height=\"986\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/reviews/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/c46aa757005f9a75508da2cf7f0e3b1216016085/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323361766164612d352d737461722d726576696577732d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:755}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/reviews/\"><img src=\"https://camo.envatousercontent.com/c46aa757005f9a75508da2cf7f0e3b1216016085/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323361766164612d352d737461722d726576696577732d3731312d7363616c65642e6a7067\" width=\"755\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2358,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/8fe92ddba22227290c138a60aa65f9f3fe8bbe8a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323470617373696f6e6174652d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/8fe92ddba22227290c138a60aa65f9f3fe8bbe8a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323470617373696f6e6174652d3731312e6a7067\" width=\"1230\" height=\"2358\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:310,&quot;href&quot;:&quot;https://avada.com/help-center/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/915b9a6f62dda306a867b89b679fc9e87f8d2dcd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3235636f6d70726568656e736976652d646f63756d656e746174696f6e2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/help-center/\"><img src=\"https://camo.envatousercontent.com/915b9a6f62dda306a867b89b679fc9e87f8d2dcd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3235636f6d70726568656e736976652d646f63756d656e746174696f6e2d3731312e6a7067\" width=\"1230\" height=\"310\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:315,&quot;href&quot;:&quot;mailto:https://www.youtube.com/@AvadaVideos&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/eb290b074ac5cf9d0f2b9432cd91041a8562a14a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3236657874656e736976652d766964656f2d7475746f7269616c732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"mailto:https://www.youtube.com/@AvadaVideos\"><img src=\"https://camo.envatousercontent.com/eb290b074ac5cf9d0f2b9432cd91041a8562a14a/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3236657874656e736976652d766964656f2d7475746f7269616c732d3731312e6a7067\" width=\"1230\" height=\"315\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1292,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/30a745b02f1257b466da600762e127cca0a764b5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32377072656d69756d2d706c7567696e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/30a745b02f1257b466da600762e127cca0a764b5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f32377072656d69756d2d706c7567696e732d3731312e6a7067\" width=\"1230\" height=\"1292\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1246,&quot;href&quot;:&quot;https://avada.com/features/&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/2c7a17fef4fd7fe67ad95963db9faef979e67477/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323861766164612d64657369676e2d696e746567726174696f6e2d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/features/\"><img src=\"https://camo.envatousercontent.com/2c7a17fef4fd7fe67ad95963db9faef979e67477/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f323861766164612d64657369676e2d696e746567726174696f6e2d3731312e6a7067\" width=\"1230\" height=\"1246\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:284,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/84768613d547a351756ab4fb60980acaa86ad04c/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3239677574656e626572672d6f7074696d697a65642d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/84768613d547a351756ab4fb60980acaa86ad04c/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3239677574656e626572672d6f7074696d697a65642d3731312e6a7067\" width=\"1230\" height=\"284\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1169,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/e8c52cc84a1a1074af12f6363939c5f1a6783b11/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333061766164612d707269766163792d746f6f6c732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/e8c52cc84a1a1074af12f6363939c5f1a6783b11/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333061766164612d707269766163792d746f6f6c732d3731312e6a7067\" width=\"1230\" height=\"1169\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:677,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/d7ef72473b794b6ef58a8fc2abb766800eb880a1/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333161766164612d73616c65732d636f756e742d6374612d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/d7ef72473b794b6ef58a8fc2abb766800eb880a1/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333161766164612d73616c65732d636f756e742d6374612d3731312e6a7067\" width=\"1230\" height=\"677\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1175,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/b31ce133ecaf2475946456e5180872cdb8c912d5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33327472616e736c6174696f6e732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/b31ce133ecaf2475946456e5180872cdb8c912d5/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33327472616e736c6174696f6e732d3731312e6a7067\" width=\"1230\" height=\"1175\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1820,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/31a74371ac4f367edcfeb29b1a03b0d5b2e4d4f3/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333361766164612d667265652d757064617465732d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/31a74371ac4f367edcfeb29b1a03b0d5b2e4d4f3/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f333361766164612d667265652d757064617465732d3731312e6a7067\" width=\"1230\" height=\"1820\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2470,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/55fd1bfa55b67e8f5b0e4215142c04d04ed79de9/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3334646576656c6f7065642d696e2d686f7573652d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/55fd1bfa55b67e8f5b0e4215142c04d04ed79de9/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3334646576656c6f7065642d696e2d686f7573652d3731312e6a7067\" width=\"1230\" height=\"2470\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:2560,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/8a3a28291714cf0e110f128d3a24727c078a92a0/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3335726561736f6e732d746f2d6275792d61766164612d3731312d7363616c65642e6a7067&quot;,&quot;width&quot;:620}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/8a3a28291714cf0e110f128d3a24727c078a92a0/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3335726561736f6e732d746f2d6275792d61766164612d3731312d7363616c65642e6a7067\" width=\"620\" height=\"2560\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:384,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/ea3f146adc636f904100bf3ec6f97a17f23fdcdd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33366a6f696e2d61766164612d636f6d6d756e6974792d3731312e6a7067&quot;,&quot;width&quot;:1230}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/ea3f146adc636f904100bf3ec6f97a17f23fdcdd/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f33366a6f696e2d61766164612d636f6d6d756e6974792d3731312e6a7067\" width=\"1230\" height=\"384\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image&quot;,&quot;href&quot;:&quot;https://avada.com/buy-avada&quot;,&quot;url&quot;:&quot;https://camo.envatousercontent.com/217ebe6813e6ec5ee39a8940fd4b8030413dffa6/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3337746f702d73656c6c696e672d7468656d652d616c6c2d74696d652d3731312e6a7067&quot;}\" data-trix-content-type=\"image\" class=\"attachment attachment--preview\"><a href=\"https://avada.com/buy-avada\"><img src=\"https://camo.envatousercontent.com/217ebe6813e6ec5ee39a8940fd4b8030413dffa6/68747470733a2f2f61766164612e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032342f30322f3337746f702d73656c6c696e672d7468656d652d616c6c2d74696d652d3731312e6a7067\" width=\"1230\" height=\"380\"><figcaption class=\"attachment__caption\"></figcaption></a></figure></p><p><strong>Avada is available to purchase and download!</strong></p><p>Avada is a Website Builder for WordPress that offers a comprehensive range of features for creating custom websites, including an intuitive Drag &amp; Drop <a href=\"https://avada.com/feature/live-visual-builder/\">Live Visual Builder</a>, a <a href=\"https://avada.com/feature/layout-builder/\">Layout Builder</a>, a <a href=\"https://avada.com/feature/header-builder/\">Header Builder</a>, a <a href=\"https://avada.com/feature/footer-builder/\">Footer Builder</a>, the <a href=\"https://avada.com/feature/form-builder/\">Avada Form Builder</a>, an <a href=\"https://avada.com/feature/woocommerce/\">eCommerce Builder</a>, WooCommerce integration, the <a href=\"https://avada.com/feature/setup-wizard/\">Avada Setup Wizard</a>, and performance optimization tools. In addition, Avada supports dynamic content and is mobile-friendly, ensuring websites are responsive across all devices, from mobile to desktop.</p><p>Avada is also the #1 selling WordPress Website Builder on the marketplace and has been continuously for more than 11+ years. 950,000+ beginners, marketers, professionals, agencies, businesses, and creatives trust Avada for total design freedom. Our illustrious history is a testament to the fact that Avada is the most versatile and easy-to-use multi-purpose WordPress theme on the market today. Years of refinement and feedback have reinforced our determination to be the best at what we do and provide you with the tools to make things happen efficiently and quickly without requiring coding knowledge.</p><p>Below we have highlighted some of Avada’s features! The list may be long, but so are the reasons to purchase Avada and join the most significant WordPress community out there!</p><ul><li>Avada has Intuitive visual front-end design and editing tools for you to create beautiful websites, fast.</li><li>A clean, modern, multi-purpose designs which can be adapted and used for any website design and layout</li><li>The #1 selling WordPress theme on the market for 11+ years and counting</li><li>A highly advanced network of options for easy customizations without modifying the code</li><li>Dozens of professionally designed demos that can be imported fast with the click of a button</li><li>More than 25,000+ ratings with a 5-Star Average</li><li>Always compatible with the latest WordPress versions</li><li>Always compatible with the latest versions of 3rd party integrated plugins</li><li>WordPress Multisite (WPMU) Tested and Approved</li><li>Built with HTML5 and CSS3</li><li>100% SEO Optimized and perfectly compatible with Plugins like Yoast SEO</li><li>Adherence to strict WordPress and PHP coding standards</li><li>Performance enhancements for fast, reliable, quality websites</li><li>Cross-Browser Compatibility: FireFox, Safari, Chrome, IE9, IE10, IE11</li><li>100% Responsive Theme with pixel perfect accuracy – and you can disable responsiveness</li><li>Easy to use Fusion Builder Visual Editor, the best visual page builder on the market</li><li>Full control over site width; content area and sidebars</li><li>Retina Ready, Ultra-High Resolution Graphics</li><li>Social Icons and Theme Icons are CSS Font Icons, no Images</li><li>Automatic Theme Updater directly through the WordPress Admin interface</li><li>Automatic Patch tool to apply fixes and improvements with one click, no other theme has this</li><li>Dual, flexible sidebars throughout the theme</li><li>1-6 Column Support</li><li>One Page Parallax feature for any page</li><li>CSS3 animations enable or disable on desktop/mobile</li><li>Child Theme Compatible – Your Avada package includes a basic child theme</li><li>Strong focus on typography, usability and overall user-experience</li><li>jQuery Enhancements for modern websites</li><li>JavaScript files are automatically combined and minified for added performance</li><li>JS/PHP Compiler for CSS that combines all styles into one generated file for added performance</li><li>Includes the Font Awesome icon set, fully integrated</li><li>Font Awesome Pro can be enabled to use with Avada</li><li>60 Layered PSD’s included of the original Avada Classic design</li><li>Compatible with Ubermenu (uber does not support sticky headers)</li><li>Compatible with Many Popular Plugins like WPML, Yoast, W3TC, JetPack, Slider Revolution, Layer Slider, WooCommerce, The Events Calendar, bbPress, BuddyPress, WP Rocket, All In One SEO, NextGen Gallery, UpDraft Plus to name a few</li></ul><p><strong>Professional 5-Star Customer Support</strong></p><ul><li>We take pride in offering THE BEST after sales support around. We care about your site as much as you and will help in anyway possible</li><li>Feature Packed Updates – get new features and new development in each future update</li><li>Technical Support with a growing community of over 950,000 customers! At our support center, we answer each and every ticket as if it was our own because we care about you and your site</li><li>Customer feedback always welcomed for new features</li><li>Once you register your purchase, you can use our advanced support ticket system to receive professional support</li><li>Includes the most extensive online documentation you can find and its constantly being updated with new material</li><li>Multiple HD video tutorials for easy instruction</li><li>Access our extensive knowledge base that is ever-growing</li><li>Ever growing user base, read our user testimonials</li></ul><p><strong>100+ Professionally Designed Prebuilt Websites</strong></p><ul><li>The Best Website Importer On The Market – Industry leading demo import that is amazingly easy to use and the fastest way to build your website. One click website import allows you to install a full demo with everything, or a partial demo. Want the Creative demo but with Modern Shop products for an eCommerce site? Easily done! And you can quickly uninstall any imported demo content with a click.</li><li><a href=\"https://avada.website/\">Professionally designed prebuilt websites</a> that you can import with just a click. Industry leading designs created by a team of professional designers.</li><li>More added with each major update based on popular demand</li><li>Each demo is professionally designed to truly represent the exact nature of the industry; Cafe, Gym, Agency, Travel, Photography just to name a few</li><li>Beautiful easy to use interface through a Welcome Screen that allows you to view each prebuilt website, preview it, then import with just a click.</li><li>WooCommerce shop setup and products import, bbPress content imports, Events Calendar content imports</li><li>Each prebuilt website has been optimized using the <a href=\"https://avada.com/feature/performance-wizard/\">Avada Performance Wizard</a></li></ul><p><strong>Advanced Theme Options Network</strong> Fusion Theme Options control options and settings globally throughout the site, whereas Fusion Page Options control individual pages and posts. Individual page options give you the freedom to change anything on a single page or post that will thereby override the global Theme Options. The Avada Advanced Options Network gives you the ultimate flexibility to design and style layouts that are unique and stand out from the rest of the site.</p><ul><li>50+ main and sub theme option panels loaded with powerful customization options</li><li>Extensive options which provide incredible customization options without having to modify code</li><li>Fully dependent options so the only you see are the options that are in use based on your configuration</li><li>Entire option network correlation so you can quickly see what is set global vs individual</li><li>Incredible search feature that allows you to quickly find any option you need</li><li>Advanced options to enable or disable individual features for performance enhancements</li><li>Full control over the entire layout; site width, content area, sidebars and more</li><li>Logically organized options based on normal site building procedures</li><li>Customized repeater fields that allow for unlimited custom fonts and icons</li><li>Custom fonts can be used in any font-family filed throughout the site</li><li>Combined options for things like typography put you in full control of all settings in one area saving you precious time</li><li>Easily import and export your data for using on different installs or for safe backups</li><li>Native WordPress feel that has the same hover effects, styles and pulls user color profiles</li><li>All running on a customized version of the powerful Redux Framework</li></ul><p><strong>Advanced Fusion Page/Post Options</strong> We created the page and post options to extend the Avada Theme Options. Doing this gives you extreme flexibility by being able to override the global Theme Options and create unique and dynamic content-rich pages that stand out. Any single page or post (or more than one) can have a different layout and styling compared to the rest of the site.</p><ul><li>Multiple option panels with amazingly deep customization options: Sliders, Page, Post, Header, Footer, Sidebars, Backgrounds, Portfolio, Page Title Bar</li><li>Assign any slider to any page or post, show slider above or below header, use transparent header per page</li><li>Customize page title bar for any page or post</li><li>Customize page settings like paddings uniquely for each page or post</li><li>Customize header styles individually for any page or post</li><li>Insert custom images or colors for header section, main section, boxed background per page or post</li><li>Choose a custom menu per page or post</li><li>Enable or Disable headers, footers, sliders, sidebars, backgrounds and more per page or post</li><li>Customize various parts of the portfolio per page or portfolio posts</li><li>Insert custom excerpt length per portfolio pages</li><li>Customize sidebars and sidebar positions for any page or post.</li></ul><p><strong>Incredible Theme Updates That Make All The Difference</strong></p><ul><li>Avada releases continued value packed feature updates based off user requested features and demands</li><li>Continued codebase improvements for performance enhancements and future maintenance</li><li>Every update is <strong>FREE</strong> to anyone who has bought a license</li></ul><p><strong>Multiple Premium Slider Options</strong></p><ul><li>Includes Amazing <a href=\"https://www.sliderrevolution.com/?utm_source=themeforest.net&amp;utm_medium=content\"><strong>Revolution Slider Plugin</strong></a> – $35 Value</li><li>Includes the <a href=\"https://codecanyon.net/item/layerslider-wp-the-wordpress-parallax-slider/1362246\"><strong>Awesome Parallax Layer Slider Plugin</strong></a> – $22 Value</li><li>Custom Fusion Slider With Parallax Effect, Full Screen options and self hosted / youtube / vimeo support</li><li>Includes Elastic Slider</li><li>Includes FlexSlider 2 for page and post sliders</li><li>All sliders are touch swipe compatible and fully responsive</li></ul><p><strong>Intuitive Avada Builder Live</strong></p><ul><li>Beautiful visual page builder to help you easily build creative layouts</li><li>Most intuitive page builder on the market, easy to use while producing incredible results</li><li>Easy to use user interface makes page building a breeze</li><li>Drag and drop any of our elements to your hearts content</li><li>Easily create stunning pages within minutes using short codes</li><li>Save custom page layouts to reuse on other pages or post</li><li>Dozens of design elements to build unique pages quickly</li><li>Global options per short code element and individual overrides in Fusion Builder</li><li>Includes element previews for text, images and more</li><li>Over 60+ Elements and endless options to easily build creative layouts</li><li>Many short codes have several design options to choose from</li><li>Includes short code Generator integrated into Fusion Builder and default WordPress editor</li></ul><p><strong>Avada Mega Menu</strong></p><ul><li>A beautiful Avada Mega Menu design for large stylish menus and they are widget ready</li><li>Normal menus with 5 level dropdown</li><li>Accepts widgets; add maps, images, forms, any widget available!</li><li>Use from 1-6 columns</li><li>Set the menu to be full width or specific pixel value</li><li>Control each column width for more creative layouts</li><li>Insert background images in the full mega menu, or in individual columns</li><li>Insert icons or custom thumbnails next to menu items</li><li>Menu highlight labels can be added to any menu item for added visual cues</li></ul><p><strong>WooCommerce Compatible With Extensive Design Integration</strong></p><ul><li>Plugin ready with full design integration</li><li>Intuitive theme options panel for industry leading customization options</li><li>Options for 1-6 Columns</li><li>Custom featured product slider to display your products</li><li>Custom featured product carousel to display your products</li><li>Full width or sidebar single product pages</li><li>Full width or sidebar shop page</li><li>Avada Single product gallery or default WooCommerce product gallery</li><li>Single product image zoom on hover or disable zoom via options network</li><li>Display products based on category, ID or SKU</li><li>WooCommerce short codes are compatible with Avada columns</li><li>Continued collaboration with WooCommerce team to ensure compatibility</li></ul><p><strong>Popular Plugin Design Integration</strong></p><ul><li>WooCommerce compatible with <a href=\"https://avada.website/classic-shop/\"><strong>full design integration</strong></a></li><li>The Events Calendar compatible with <a href=\"https://avada.website/church/events/\"><strong>full design integration</strong></a></li><li>bbPress compatible with <a href=\"https://theme-fusion.com/avada/forums/forum/general-information/\"><strong>full design integration</strong></a></li><li><a href=\"https://avada.com/documentation/multilingual-management-with-wpml-and-avada/\"><strong>WPML plugin ready</strong></a></li><li><a href=\"https://avada.com/documentation/setting-up-a-multilingual-site-with-avada-and-wpml-or-polylang/\">Polyang</a> compatible</li><li>Continued collaboration with each team to ensure compatibility</li></ul><p><strong>Unlimited Color &amp; Styling Options</strong></p><ul><li>Extremely detailed theme options that allow you to control colors across the theme</li><li>Short code styling tab in theme options to style short codes with ease</li><li>Unlimited Color Options / Skins with Backend Color Picker</li><li>Full Color Customizations – change every element with ease including short codes</li><li>Choose a Light or Dark skin with one click</li><li>Choose from 8 pre-defined color skins, or create your own</li><li>Beautiful color pickers with integrated color and opacity sliders for added creativity</li></ul><p><strong>Advanced Portfolio Layout Options</strong></p><ul><li>3 layout options to choose from; Grid, Masonry, Classic, Text</li><li>1-6 column classic layout options</li><li>1-6 column text layout options along with a boxed or unboxed mode</li><li>Portfolio Masonry layout with unique hover effect</li><li>Portfolio Grid layout</li><li>Recent Work short code to insert portfolio posts on any page or post</li><li>Chose from auto image sizes or cropped image sizes</li><li>Global theme options settings and individual page and post settings</li><li>Set up multiple portfolio pages and set custom categories per page</li><li>Choose custom layout for archive/category pages</li><li>Select specific categories for each portfolio, fully customized</li><li>Set custom skills and tags for each portfolio posts</li><li>Easily order your Portfolio Items with awesome Re-Order Plugin</li><li>Awesome image rollovers with light box and link icons!</li><li>Full-Width featured image or Half-Width featured image single post page</li><li>New Full width single post page with no details or sidebar</li><li>Use 100% Width page template on single post pages</li><li>Use sidebars or dual sidebars on single post pages, also enable/disable project details and descriptions</li><li>Select a premium slider to show on your portfolio posts or page!</li><li>Use Images, Slideshows, &amp; Videos Very Easily!</li><li>Set Custom Featured Image size per post</li><li>Show or hide rollover icons per post</li><li>Change the opacity and color of image rollovers</li><li>Auto generated thumbnails</li><li>Easily specify the number of items per page</li><li>Automatic pagination</li><li>Sortable/filterable categories</li><li>Enable comments on portfolio posts</li><li>Many more bells and whistles to build the perfect portfolio site</li></ul><p><br></p>', 123000.00, NULL, '0', 'https://themeforest.net/item/itera-it-business-wordpress-theme/full_screen_preview/23344987?_ga=2.43367009.515451604.1726133672-1375679939.1724922480', NULL, NULL, NULL, NULL, 0, '2024-09-12 02:45:56', '2024-09-12 02:45:56');

--
-- Chỉ mục cho các bảng đã đổ
--

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
  ADD KEY `social_account_products_social_account_id_foreign` (`social_account_id`),
  ADD KEY `fk_category_id` (`category_id`);

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
-- Chỉ mục cho bảng `wordpress_products`
--
ALTER TABLE `wordpress_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wordpress_products_sku_unique` (`sku`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `category_social_account_product`
--
ALTER TABLE `category_social_account_product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `course_modules`
--
ALTER TABLE `course_modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `other_products`
--
ALTER TABLE `other_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `social_accounts`
--
ALTER TABLE `social_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `social_account_products`
--
ALTER TABLE `social_account_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `social_account_product_attributes`
--
ALTER TABLE `social_account_product_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `wordpress_products`
--
ALTER TABLE `wordpress_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- Các ràng buộc cho bảng `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `social_account_products`
--
ALTER TABLE `social_account_products`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `social_account_products_social_account_id_foreign` FOREIGN KEY (`social_account_id`) REFERENCES `social_accounts` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `social_account_product_attributes`
--
ALTER TABLE `social_account_product_attributes`
  ADD CONSTRAINT `social_account_product_attributes_social_product_id_foreign` FOREIGN KEY (`social_product_id`) REFERENCES `social_account_products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
