-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-03-2024 a las 01:16:10
-- Versión del servidor: 8.0.32-0ubuntu0.22.04.2
-- Versión de PHP: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `paradores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cashiers`
--

CREATE TABLE `cashiers` (
  `id` bigint UNSIGNED NOT NULL,
  `code` smallint NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `open` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `cash` decimal(12,2) DEFAULT '0.00',
  `debits` decimal(12,2) DEFAULT '0.00',
  `credits` decimal(12,2) DEFAULT '0.00',
  `transfers` decimal(12,2) DEFAULT '0.00',
  `total` decimal(12,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cashiers`
--

INSERT INTO `cashiers` (`id`, `code`, `name`, `open`, `active`, `cash`, `debits`, `credits`, `transfers`, `total`, `created_at`, `updated_at`) VALUES
(1, 106, 'Caja Nº 106', 1, 0, '100.00', '0.00', '0.00', '0.00', '100.00', '2024-03-24 10:41:40', '2024-03-26 07:10:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gaseosas', '2024-03-24 10:38:04', '2024-03-24 10:38:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_code` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `name`, `identity`, `tax_code`, `phone`, `email`, `business`, `created_at`, `updated_at`) VALUES
(1, 'CONSUMIDOR FINAL', '11111111', '11111111111', '3884080552', 'cliente@gmail.com', NULL, '2024-03-24 10:43:02', '2024-03-24 10:43:02'),
(2, 'PEREZ JUAN PABLO', '22222222', '2022222222', NULL, NULL, NULL, '2024-03-25 02:53:39', '2024-03-25 02:53:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` int UNSIGNED NOT NULL,
  `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `url`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
(1, 'products/65ffd8bab7141.jpg', 2, 'App\\Models\\Product', '2024-03-24 10:39:38', '2024-03-24 10:39:38'),
(2, 'products/65ffd8e81c56d.jpg', 3, 'App\\Models\\Product', '2024-03-24 10:40:24', '2024-03-24 10:40:24'),
(3, 'products/66008466a455c.jpg', 1, 'App\\Models\\Product', '2024-03-24 22:52:06', '2024-03-24 22:52:06'),
(4, 'products/66017ff4b42a8.jpg', 4, 'App\\Models\\Product', '2024-03-25 16:45:24', '2024-03-25 16:45:24'),
(5, 'products/6601c7a7c40e0.jpg', 5, 'App\\Models\\Product', '2024-03-25 21:51:19', '2024-03-25 21:51:19'),
(6, 'products/6601c7fa55b56.jpg', 6, 'App\\Models\\Product', '2024-03-25 21:52:42', '2024-03-25 21:52:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `quantity` int UNSIGNED DEFAULT NULL,
  `day` date DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `name`, `image`, `price`, `quantity`, `day`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'Coca-Cola 2.5lts', '/storage/products/66008466a455c.jpg', '2300.00', 3, '2024-03-24', 1, '2024-03-25 00:06:11', '2024-03-25 00:06:11'),
(2, 'Fanta 2.5lts', '/storage/products/65ffd8e81c56d.jpg', '2150.60', 2, '2024-03-24', 3, '2024-03-25 00:06:12', '2024-03-25 00:06:12'),
(3, 'Sprite 2.5lts', '/storage/products/65ffd8bab7141.jpg', '2200.00', 3, '2024-03-24', 2, '2024-03-25 02:33:28', '2024-03-25 02:33:28'),
(4, 'Coca-Cola 2.5lts', '/storage/products/66008466a455c.jpg', '2300.00', 7, '2024-03-24', 1, '2024-03-25 02:33:28', '2024-03-25 02:33:28'),
(5, 'Coca-Cola 2.5lts', '/storage/products/66008466a455c.jpg', '2300.00', 5, '2024-03-24', 1, '2024-03-25 02:42:26', '2024-03-25 02:42:26'),
(6, 'Sprite 2.5lts', '/storage/products/65ffd8bab7141.jpg', '2200.00', 5, '2024-03-24', 2, '2024-03-25 02:48:21', '2024-03-25 02:48:21'),
(7, 'Sprite 2.5lts', '/storage/products/65ffd8bab7141.jpg', '2200.00', 1, '2024-03-24', 2, '2024-03-25 02:51:55', '2024-03-25 02:51:55'),
(9, 'Manaos Naranja 3lts', '/storage/products/6601c7a7c40e0.jpg', '1500.85', 5, '2024-03-25', 5, '2024-03-26 00:52:08', '2024-03-26 00:52:08'),
(11, 'Manaos Naranja 3lts', '/storage/products/6601c7a7c40e0.jpg', '1500.85', 8, '2024-03-26', 5, '2024-03-26 06:45:34', '2024-03-26 06:45:34'),
(16, 'Manaos Naranja 3lts', '/storage/products/6601c7a7c40e0.jpg', '1500.85', 5, '2024-03-26', 5, '2024-03-26 06:53:03', '2024-03-26 06:53:03'),
(17, 'Manaos Cola 3lts', '/storage/products/66017ff4b42a8.jpg', '1500.50', 3, '2024-03-26', 4, '2024-03-26 06:53:26', '2024-03-26 06:53:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_sale`
--

CREATE TABLE `item_sale` (
  `id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED DEFAULT NULL,
  `sale_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int UNSIGNED DEFAULT NULL,
  `day` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `item_sale`
--

INSERT INTO `item_sale` (`id`, `item_id`, `sale_id`, `quantity`, `day`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, '2024-03-24', NULL, NULL),
(2, 2, 2, 2, '2024-03-24', NULL, NULL),
(3, 3, 3, 3, '2024-03-24', NULL, NULL),
(4, 4, 3, 7, '2024-03-24', NULL, NULL),
(5, 5, 4, 5, '2024-03-24', NULL, NULL),
(6, 6, 5, 5, '2024-03-24', NULL, NULL),
(7, 7, 6, 1, '2024-03-24', NULL, NULL),
(9, 9, 8, 5, '2024-03-25', NULL, NULL),
(15, 16, 9, 5, '2024-03-26', NULL, NULL),
(16, 17, 7, 3, '2024-03-26', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(37, '2014_10_12_000000_create_users_table', 1),
(38, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(39, '2014_10_12_100000_create_password_resets_table', 1),
(40, '2019_08_19_000000_create_failed_jobs_table', 1),
(41, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(42, '2024_03_21_021436_create_categories_table', 1),
(43, '2024_03_21_021640_create_products_table', 1),
(44, '2024_03_21_023440_create_clients_table', 1),
(45, '2024_03_21_024955_add_admin_column_to_users_table', 1),
(46, '2024_03_21_030206_create_sales_table', 1),
(47, '2024_03_21_032054_create_items_table', 1),
(48, '2024_03_21_032705_create_item_sale_table', 1),
(49, '2024_03_21_034437_create_shops_table', 1),
(50, '2024_03_21_034943_create_images_table', 1),
(51, '2024_03_22_110619_create_cashiers_table', 1),
(52, '2024_03_22_143325_create_status_cashiers_table', 1),
(53, '2024_03_24_231427_add_foreign_key_cashier_id_to_sales_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price` decimal(12,2) DEFAULT '0.00',
  `sale_price` decimal(12,2) DEFAULT '0.00',
  `stock` int NOT NULL DEFAULT '0',
  `minimum_stock` int DEFAULT '0',
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `purchase_price`, `sale_price`, `stock`, `minimum_stock`, `barcode`, `expiration_date`, `active`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Coca-Cola 2.5lts', 'Coca-Cola 2.5lts', '1900.00', '2300.00', 15, 10, NULL, '2024-03-31', 1, 1, '2024-03-24 10:38:47', '2024-03-25 02:42:26'),
(2, 'Sprite 2.5lts', 'Sprite 2.5lts', '1700.00', '2200.00', 21, 10, NULL, '2024-03-31', 1, 1, '2024-03-24 10:39:38', '2024-03-25 02:51:55'),
(3, 'Fanta 2.5lts', 'Fanta 2.5lts', '1950.00', '2150.60', 38, 10, NULL, '2024-03-31', 1, 1, '2024-03-24 10:40:23', '2024-03-25 00:06:12'),
(4, 'Manaos Cola 3lts', 'Manaos Cola 3lts', '1300.00', '1500.50', 17, 10, NULL, '2024-03-30', 1, 1, '2024-03-25 16:45:24', '2024-03-26 06:53:26'),
(5, 'Manaos Naranja 3lts', 'Manaos Naranja 3lts', '1300.00', '1500.85', 2, 10, NULL, '2024-03-30', 1, 1, '2024-03-25 21:51:17', '2024-03-26 06:53:03'),
(6, 'Manaos Citrus 3lts', 'Manaos Citrus 3lts', '1250.80', '1540.35', 25, 10, NULL, '2024-03-30', 1, 1, '2024-03-25 21:52:42', '2024-03-25 21:52:42'),
(7, 'Torasso 1.5lts', 'Torasso 1.5lts', '1294.45', '1922.00', 20, 10, NULL, '2024-03-30', 1, 1, '2024-03-25 21:58:26', '2024-03-25 21:58:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `payment` decimal(12,2) DEFAULT NULL,
  `day` date DEFAULT NULL,
  `client_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `cashier_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `total`, `payment`, `day`, `client_id`, `user_id`, `cashier_id`, `created_at`, `updated_at`) VALUES
(2, '11201.20', '11201.20', '2024-03-24', 1, 1, 1, '2024-03-25 00:06:11', '2024-03-25 00:06:11'),
(3, '22700.00', '50000.00', '2024-03-24', 1, 1, 1, '2024-03-25 02:33:28', '2024-03-25 02:33:28'),
(4, '11500.00', '11500.00', '2024-03-24', 1, 1, 1, '2024-03-25 02:42:26', '2024-03-25 02:42:26'),
(5, '11000.00', '11000.00', '2024-03-24', 1, 1, 1, '2024-03-25 02:48:21', '2024-03-25 02:48:21'),
(6, '2200.00', '2200.00', '2024-03-24', 1, 1, 1, '2024-03-25 02:51:55', '2024-03-25 02:51:55'),
(7, '4501.50', '4501.50', '2024-03-25', 1, 1, 1, '2024-03-26 00:46:27', '2024-03-26 06:53:26'),
(8, '7504.25', '10000.00', '2024-03-25', 1, 1, 1, '2024-03-26 00:52:08', '2024-03-26 00:52:08'),
(9, '7504.25', '7504.25', '2024-03-26', 1, 1, 1, '2024-03-26 04:58:47', '2024-03-26 06:53:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shops`
--

CREATE TABLE `shops` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_cashiers`
--

CREATE TABLE `status_cashiers` (
  `id` bigint UNSIGNED NOT NULL,
  `date_time` datetime NOT NULL,
  `operation` enum('open','close') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cashier_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `cash` decimal(12,2) DEFAULT '0.00',
  `debits` decimal(12,2) DEFAULT '0.00',
  `credits` decimal(12,2) DEFAULT '0.00',
  `transfers` decimal(12,2) DEFAULT '0.00',
  `total` decimal(12,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `status_cashiers`
--

INSERT INTO `status_cashiers` (`id`, `date_time`, `operation`, `cashier_id`, `user_id`, `cash`, `debits`, `credits`, `transfers`, `total`, `created_at`, `updated_at`) VALUES
(1, '2024-03-24 19:09:59', 'open', 1, 1, '1900.00', '0.00', '0.00', '0.00', '1900.00', '2024-03-25 01:09:59', '2024-03-25 01:09:59'),
(2, '2024-03-24 22:16:48', 'close', 1, 1, '60501.00', '0.00', '0.00', '0.00', '60501.00', '2024-03-25 04:16:48', '2024-03-25 04:16:48'),
(3, '2024-03-25 09:30:23', 'open', 1, 1, '2300.00', '0.00', '0.00', '0.00', '2300.00', '2024-03-25 15:30:23', '2024-03-25 15:30:23'),
(4, '2024-03-25 09:42:59', 'close', 1, 1, '2300.00', '0.00', '0.00', '0.00', '2300.00', '2024-03-25 15:42:59', '2024-03-25 15:42:59'),
(5, '2024-03-25 09:43:15', 'open', 1, 1, '4300.00', '0.00', '0.00', '0.00', '4300.00', '2024-03-25 15:43:16', '2024-03-25 15:43:16'),
(6, '2024-03-25 10:22:11', 'close', 1, 1, '4300.00', '0.00', '0.00', '0.00', '4300.00', '2024-03-25 16:22:11', '2024-03-25 16:22:11'),
(7, '2024-03-25 10:22:25', 'open', 1, 1, '98220.00', '0.00', '0.00', '0.00', '98220.00', '2024-03-25 16:22:25', '2024-03-25 16:22:25'),
(8, '2024-03-25 10:40:07', 'close', 1, 1, '98220.00', '0.00', '0.00', '0.00', '98220.00', '2024-03-25 16:40:07', '2024-03-25 16:40:07'),
(9, '2024-03-25 10:40:28', 'open', 1, 1, '1200.00', '0.00', '0.00', '0.00', '1200.00', '2024-03-25 16:40:28', '2024-03-25 16:40:28'),
(10, '2024-03-26 01:09:23', 'close', 1, 1, '19209.85', '0.00', '0.00', '0.00', '19209.85', '2024-03-26 07:09:23', '2024-03-26 07:09:23'),
(11, '2024-03-26 01:10:19', 'open', 1, 1, '100.00', '0.00', '0.00', '0.00', '100.00', '2024-03-26 07:10:19', '2024-03-26 07:10:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` tinyint(1) DEFAULT '1',
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `admin`, `active`) VALUES
(1, 'Diego', 'diego@dominio.com', NULL, '$2y$12$r.Xz9Fn.pOX5s0MJhG/wSeBvMTjDb3khkI2Ecca.bIBuGUI9DhjWa', NULL, '2024-03-24 10:37:44', '2024-03-24 10:37:44', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `item_sale`
--
ALTER TABLE `item_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_sale_item_id_foreign` (`item_id`),
  ADD KEY `item_sale_sale_id_foreign` (`sale_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_client_id_foreign` (`client_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`),
  ADD KEY `sales_cashier_id_foreign` (`cashier_id`);

--
-- Indices de la tabla `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status_cashiers`
--
ALTER TABLE `status_cashiers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_cashiers_cashier_id_foreign` (`cashier_id`),
  ADD KEY `status_cashiers_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `item_sale`
--
ALTER TABLE `item_sale`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status_cashiers`
--
ALTER TABLE `status_cashiers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `item_sale`
--
ALTER TABLE `item_sale`
  ADD CONSTRAINT `item_sale_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_sale_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_cashier_id_foreign` FOREIGN KEY (`cashier_id`) REFERENCES `cashiers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sales_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `status_cashiers`
--
ALTER TABLE `status_cashiers`
  ADD CONSTRAINT `status_cashiers_cashier_id_foreign` FOREIGN KEY (`cashier_id`) REFERENCES `cashiers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `status_cashiers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
