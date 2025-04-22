-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3308
-- Thời gian đã tạo: Th9 15, 2024 lúc 04:31 AM
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
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1726196939),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1726196939;', 1726196939),
('a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1726319587),
('a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1726319587;', 1726319587);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `total`, `created_at`, `updated_at`) VALUES
(9, 8, 22601348.00, '2024-09-13 03:13:47', '2024-09-13 04:22:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `wordpress_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `social_account_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`quantity` * `price`) STORED,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `wordpress_product_id`, `social_account_product_id`, `course_product_id`, `attribute_id`, `other_product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(27, 9, NULL, NULL, 2, NULL, NULL, 4, 600000.00, '2024-09-13 03:14:52', '2024-09-13 04:14:21'),
(28, 9, NULL, 4, NULL, 5, NULL, 36, 50000.00, '2024-09-13 03:15:19', '2024-09-13 04:22:34'),
(29, 9, 4, NULL, NULL, NULL, NULL, 1, 788888.00, '2024-09-13 03:19:29', '2024-09-13 03:19:29'),
(30, 9, NULL, 4, NULL, 7, NULL, 1, 150000.00, '2024-09-13 03:36:42', '2024-09-13 03:36:42'),
(31, 9, NULL, NULL, NULL, NULL, 4, 20, 123123.00, '2024-09-13 03:43:38', '2024-09-13 04:12:30'),
(32, 9, 6, NULL, NULL, NULL, NULL, 15, 1000000.00, '2024-09-13 03:48:34', '2024-09-13 04:21:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Wordpress', 'wordpress', NULL, 'active', '2024-09-04 20:51:48', '2024-09-04 20:51:48'),
(10, 'Plugin Wordpress', 'plugin-wordpress', 9, 'active', '2024-09-04 20:52:05', '2024-09-04 20:52:05'),
(12, 'Tài khoản', 'tai-khoan', NULL, 'active', '2024-09-09 23:31:25', '2024-09-09 23:31:25'),
(13, 'Facebook', 'facebook', 12, 'active', '2024-09-09 23:31:35', '2024-09-09 23:31:35'),
(14, 'Tiktok', 'tiktok', 12, 'active', '2024-09-09 23:31:42', '2024-09-09 23:32:07'),
(15, 'Khóa học', 'khoa-hoc', NULL, 'active', '2024-09-10 19:01:54', '2024-09-10 19:01:54'),
(16, 'Python', 'python', 15, 'active', '2024-09-10 19:06:39', '2024-09-11 19:27:21'),
(17, 'Khác', 'khac', NULL, 'active', '2024-09-10 19:58:13', '2024-09-10 19:58:13'),
(18, 'key phần mềm', 'key-phan-mem', 17, 'active', '2024-09-12 19:30:35', '2024-09-12 19:30:35'),
(19, 'wordpress', 'wordpress-1', 9, 'active', '2024-09-14 00:48:40', '2024-09-14 00:48:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_social_account_product`
--

CREATE TABLE `category_social_account_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `social_account_product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `instructor` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `video_count` int(11) NOT NULL DEFAULT 0,
  `download_link` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `views` bigint(20) UNSIGNED DEFAULT 0,
  `status` enum('active','inactive','draft') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `courses`
--

INSERT INTO `courses` (`id`, `category_id`, `title`, `slug`, `short_description`, `long_description`, `price`, `sale_price`, `image`, `instructor`, `duration`, `level`, `video_count`, `download_link`, `video_url`, `views`, `status`, `created_at`, `updated_at`) VALUES
(2, 16, 'Python for Data Science and Machine Learning Bootcamp', 'python-for-data-science-and-machine-learning-bootcamp', '<h2><br>Requirements</h2><ul><li>Some programming experience</li><li>Admin permissions to download files</li></ul><p><br></p>', '<h2>Description</h2><p>Are you ready to start your path to becoming a Data Scientist!&nbsp;</p><p>This comprehensive course will be your guide to learning how to use the power of Python to analyze data, create beautiful visualizations, and use powerful machine learning algorithms!</p><p>Data Scientist has been ranked the number one job on Glassdoor and the average salary of a data scientist is over $120,000 in the United States according to Indeed! Data Science is a rewarding career that allows you to solve some of the world\'s most interesting problems!</p><p>This course is designed for both beginners with some programming experience or experienced developers looking to make the jump to Data Science!</p><p>This comprehensive course is comparable to other Data Science bootcamps that usually cost thousands of dollars, but now you can learn all that information at a fraction of the cost! With <strong>over 100 HD video lectures</strong> and <strong>detailed code notebooks for every lecture </strong>this is one of the most comprehensive course for data science and machine learning on Udemy!</p><p>We\'ll teach you how to program with Python, how to create amazing data visualizations, and how to use Machine Learning with Python! Here a just a few of the topics we will be learning:</p><ul><li>Programming with Python</li><li>NumPy with Python</li><li>Using pandas Data Frames to solve complex tasks</li><li>Use pandas to handle Excel Files</li><li>Web scraping with python</li><li>Connect Python to SQL</li><li>Use matplotlib and seaborn for data visualizations</li><li>Use plotly for interactive visualizations</li><li>Machine Learning with SciKit Learn, including:</li><li>Linear Regression</li><li>K Nearest Neighbors</li><li>K Means Clustering</li><li>Decision Trees</li><li>Random Forests</li><li>Natural Language Processing</li><li>Neural Nets and Deep Learning</li><li>Support Vector Machines</li><li>and much, much more!</li></ul><p>Enroll in the course and become a data scientist today!</p><p><br></p>', 600000.00, 500000.00, 'courses/01J7J0W3QD34J87A1AV07E0J8E.jpg', 'Jose Portilla', 999, 'Chuyên gia', 0, NULL, NULL, 0, 'active', '2024-09-11 19:26:52', '2024-09-11 19:26:52'),
(3, 16, 'Python for Data Science and Machine Learning Bootcamp', 'python-for-data-science-and-machine-learning-bootcamp123', '<h2><br>Requirements</h2><ul><li>Some programming experience</li><li>Admin permissions to download files</li></ul><p><br></p>', '<h2>Description</h2><p>Are you ready to start your path to becoming a Data Scientist!&nbsp;</p><p>This comprehensive course will be your guide to learning how to use the power of Python to analyze data, create beautiful visualizations, and use powerful machine learning algorithms!</p><p>Data Scientist has been ranked the number one job on Glassdoor and the average salary of a data scientist is over $120,000 in the United States according to Indeed! Data Science is a rewarding career that allows you to solve some of the world\'s most interesting problems!</p><p>This course is designed for both beginners with some programming experience or experienced developers looking to make the jump to Data Science!</p><p>This comprehensive course is comparable to other Data Science bootcamps that usually cost thousands of dollars, but now you can learn all that information at a fraction of the cost! With <strong>over 100 HD video lectures</strong> and <strong>detailed code notebooks for every lecture </strong>this is one of the most comprehensive course for data science and machine learning on Udemy!</p><p>We\'ll teach you how to program with Python, how to create amazing data visualizations, and how to use Machine Learning with Python! Here a just a few of the topics we will be learning:</p><ul><li>Programming with Python</li><li>NumPy with Python</li><li>Using pandas Data Frames to solve complex tasks</li><li>Use pandas to handle Excel Files</li><li>Web scraping with python</li><li>Connect Python to SQL</li><li>Use matplotlib and seaborn for data visualizations</li><li>Use plotly for interactive visualizations</li><li>Machine Learning with SciKit Learn, including:</li><li>Linear Regression</li><li>K Nearest Neighbors</li><li>K Means Clustering</li><li>Decision Trees</li><li>Random Forests</li><li>Natural Language Processing</li><li>Neural Nets and Deep Learning</li><li>Support Vector Machines</li><li>and much, much more!</li></ul><p>Enroll in the course and become a data scientist today!</p><p><br></p>', 600000.00, NULL, 'courses/01J7J0W3QD34J87A1AV07E0J8E.jpg', 'Jose Portilla', 999, 'Chuyên gia', 0, NULL, NULL, 0, 'active', '2024-09-11 19:26:52', '2024-09-11 19:26:52'),
(4, 15, '234234234 43546123', '234234234-43546123', '<p>123</p>', '<p>123</p>', 12313123.00, NULL, 'courses/01J7MNMF5C3SFPNSX1W9K368QJ.png', '123', 123, 'Chuyên gia', 0, NULL, NULL, 0, 'active', '2024-09-12 20:08:10', '2024-09-12 20:08:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course_modules`
--

CREATE TABLE `course_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `video_count` int(11) NOT NULL DEFAULT 0,
  `download_link` varchar(255) DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `course_modules`
--

INSERT INTO `course_modules` (`id`, `course_id`, `title`, `content`, `video_url`, `video_count`, `download_link`, `order`, `created_at`, `updated_at`) VALUES
(3, 3, '23', '<p>123</p>', 'http://localhost:8000/k68-admin/other-products/create', 0, 'http://localhost:8000/k68-admin/other-products/create', 0, '2024-09-13 04:34:59', '2024-09-13 04:34:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
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
(27, '2024_09_12_040704_create_orders_and_order_items_tables', 11),
(28, '2024_09_03_042850_create_wordpress_products_table', 12),
(29, '2024_09_13_035546_create_website_settings_table', 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `payment_method`, `payment_date`, `created_at`, `updated_at`) VALUES
(42, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-11 02:05:11', '2024-09-14 02:05:11'),
(43, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(44, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(45, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(46, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(47, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(48, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(49, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(50, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(51, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-01-14 02:05:11', '2024-09-14 02:05:11'),
(52, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(53, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(54, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(55, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(56, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11'),
(57, 1, 100000.00, 'pending', 'vnpay', NULL, '2024-09-14 02:05:11', '2024-09-14 02:05:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `social_account_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `wordpress_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `social_account_product_id`, `wordpress_product_id`, `course_product_id`, `attribute_id`, `other_product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(15, 42, 4, NULL, NULL, 5, NULL, 2, 50000.00, 100000.00, '2024-09-14 02:05:11', '2024-09-14 02:05:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `other_products`
--

CREATE TABLE `other_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `type` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `demo_link` varchar(255) DEFAULT NULL,
  `download_link` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sold_quantity` int(11) DEFAULT 0,
  `system_requirements` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `other_products`
--

INSERT INTO `other_products` (`id`, `name`, `slug`, `category_id`, `thumbnail`, `gallery`, `type`, `description`, `demo_link`, `download_link`, `price`, `stock`, `sold_quantity`, `system_requirements`, `created_at`, `updated_at`) VALUES
(3, 'giang', 'giang', 17, 'OtherProduct/01J7GEEG5T985HYDE0XKEQ4SAM.png', '[{\"image\":\"OtherProduct\\/gallery\\/01J7GEEG5ZKVE4CWA00F2KCCDJ.png\"}]', NULL, '<p>124</p>', 'http://localhost:8000/k68-admin/other-products/create', 'http://localhost:8000/k68-admin/other-products/create', 123123.00, 123, 0, '<p>123123</p>', '2024-09-11 04:45:37', '2024-09-11 04:45:37'),
(4, '123', '123', 18, 'OtherProduct/01J7MKH2BKV148HMBFRP00WD96.jpg', '[{\"image\":\"OtherProduct\\/gallery\\/01J7MKH2BQPBQ1V00XSD9ETEFE.jpg\"}]', NULL, '<p>123123</p>', 'http://localhost:8000/k68-admin/other-products/create', 'http://localhost:8000/k68-admin/other-products/create', 123123.00, 1233, 0, '<p>http://localhost:8000/k68-admin/other-products/create</p>', '2024-09-12 19:31:22', '2024-09-12 19:31:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_content` text DEFAULT NULL,
  `long_content` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `stock` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','draft') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CS1iviSKLqDALQCv64ArbSyYUxUxzeTbSFYqw0JC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMHd5bTllUmtQV0RXVXVHWXdaa1dDMGIxRkRsSzRtZmY0QjNVTDVlYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9rNjgtYWRtaW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkUkJpeXljZ3U5d3FCRWtGMU44eFJVdVAuQkczdUJKWWFsN0lyLy85NkxTQW0zZ3hEYTNZTTYiO3M6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1726325727);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `social_accounts`
--

CREATE TABLE `social_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'NHT', 'huutai90909@gmail.com', NULL, '$2y$12$RBiyycgu9wqBEkF1N8xRUuP.BG3uBJYal7Ir//96LSAm3gxDa3YM6', NULL, '2024-08-30 00:25:20', '2024-09-11 04:17:03'),
(5, 'abc', 'nht4646@gmail.com', NULL, '$2y$12$YYB8bpCTXxiCdMj1YXiVHuNVKLdLc/HsXT/viW6s0ZP5ffubgbSnS', NULL, '2024-08-30 01:13:23', '2024-08-30 20:19:35'),
(8, '2508roblox', '2508roblox@gmail.com', NULL, '$2y$12$M/lsxVxXEkvL6gGC.R1BsealO.HLC2mlAWLdHnvLV8ebYQWdnKI9G', NULL, '2024-09-11 19:18:56', '2024-09-11 19:18:56'),
(9, '13123', 'trangia42344ngzxc@gmail.com', NULL, '$2y$12$twKJKt6PiV/h63q6YShczuO8Dy1VMAnJBAm7qkipii9yiFqNu4ZfS', NULL, '2024-09-14 07:03:48', '2024-09-14 07:03:48'),
(10, 'giang', 'trangiangz123xc@gmail.com', NULL, '$2y$12$BWXfU.4dsaOLeb.bcf0i6.fVhierVdqFqGggtdEGK4MYubB6MT/B.', NULL, '2024-09-14 07:04:40', '2024-09-14 07:04:40'),
(11, 'giang', 'trangiangz234xc@gmail.com', NULL, '$2y$12$LPWwLUM4m4MM2o8k1MgopuKghHEF0FdbYr4zUyPzJx6V9siloUvSO', NULL, '2024-09-14 07:06:16', '2024-09-14 07:06:16'),
(13, 'giang', 'trangiang234z234xc@gmail.com', NULL, '$2y$12$LLYhBmEggJS.JdrnhiAwyeev0o5bFE7pEMQ6r5HqbHw.9JaHgbgcO', NULL, '2024-09-14 07:06:36', '2024-09-14 07:06:36'),
(15, 'giang', 'trangian124v3rqcrfcgzxc@gmail.com', NULL, '$2y$12$rlbd8lM0lAQSRrMpUXDwuO8WaaZJPO7Y97WhORQTXoIsJkKY2HaoC', NULL, '2024-09-14 07:07:00', '2024-09-14 07:07:00'),
(16, 'tài khoản facebook', 'trangiaafwef324ngzxc@gmail.com', NULL, '$2y$12$NMkEDKqNr56PPOFT4.aeeOq7.MyujRSDbJw1vTjp3GwXXPTemUrPC', NULL, '2024-09-14 07:07:20', '2024-09-14 07:07:20'),
(17, 'tài khoản facebook', 'trangiaa111fwef324ngzxc@gmail.com', NULL, '$2y$12$RXW/7AHe3VZQt91B2rDrceTIqBC/oDvL8OZTNwcBNZ53bfQTKqmS.', NULL, '2024-09-14 07:07:55', '2024-09-14 07:07:55'),
(18, 'giang', 'trangiangzxc@gmail.com', NULL, '$2y$12$A/kX5BQG9GhapdpyV/.mie.ceysG5Ua14/TR9.QDlZuUNbRVrVa2.', NULL, '2024-09-14 07:10:47', '2024-09-14 07:10:47'),
(20, 'giang', 'tra232523ngiangzxc@gmail.com', NULL, '$2y$12$8oqzGOhhxJMj27ozelEf7eatjBaApcu/1NNCa/SN4TSF9izovhV4W', NULL, '2024-09-14 07:11:25', '2024-09-14 07:11:25'),
(21, '123124324234', 'trangi1231325235231cccccangzxc@gmail.com', NULL, '$2y$12$vhYbMyrLW.sOSXKPLB2KKeCGfkgKdw7Pi.gjSdJvZuiD47j5GOiQ.', NULL, '2024-09-14 07:12:19', '2024-09-14 07:14:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `banned` enum('0','1') NOT NULL DEFAULT '0',
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
-- Cấu trúc bảng cho bảng `website_settings`
--

CREATE TABLE `website_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `support_phone` varchar(20) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `site_description` text DEFAULT NULL,
  `site_keywords` text DEFAULT NULL,
  `site_author` varchar(255) DEFAULT NULL,
  `payment_policy` text DEFAULT NULL,
  `warranty_policy` text DEFAULT NULL,
  `privacy_policy` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wordpress_products`
--

CREATE TABLE `wordpress_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `sku` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','draft') NOT NULL DEFAULT 'draft',
  `version` text DEFAULT NULL,
  `short_content` text DEFAULT NULL,
  `long_content` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `sold` varchar(255) DEFAULT NULL,
  `demo` varchar(255) DEFAULT NULL,
  `download_link` varchar(255) DEFAULT NULL,
  `system_requirements` varchar(255) DEFAULT NULL,
  `license_key` varchar(255) DEFAULT NULL,
  `license_expiration_date` date DEFAULT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Chỉ mục cho bảng `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `category_social_account_product`
--
ALTER TABLE `category_social_account_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `course_modules`
--
ALTER TABLE `course_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `other_products`
--
ALTER TABLE `other_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `social_accounts`
--
ALTER TABLE `social_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `social_account_products`
--
ALTER TABLE `social_account_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `social_account_product_attributes`
--
ALTER TABLE `social_account_product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `wordpress_products`
--
ALTER TABLE `wordpress_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
