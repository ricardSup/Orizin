-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2017 at 03:05 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prj_copy`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `total_cost` double(8,2) NOT NULL DEFAULT '0.00',
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `total_cost`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 800000.00, 2, 1, '2017-11-29 00:58:47', '2017-11-29 03:48:05'),
(4, 98000.00, 2, 1, '2017-11-29 04:06:37', '2017-11-29 04:06:43'),
(5, 896000.00, 1, 1, '2017-11-29 04:19:23', '2017-11-29 05:31:22'),
(6, 98000.00, 2, 1, '2017-11-29 04:19:42', '2017-11-29 04:19:52'),
(7, 196000.00, 2, 1, '2017-11-29 04:20:05', '2017-11-29 07:08:24'),
(8, 190000.00, 2, 1, '2017-12-12 08:05:50', '2017-12-12 08:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `cost` double(8,2) NOT NULL,
  `cart_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `qty`, `cost`, `cart_id`, `product_id`, `created_at`, `updated_at`) VALUES
(19, 1, 190000.00, 8, 25, '2017-12-12 08:05:50', '2017-12-12 08:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ACTION', NULL, NULL),
(12, 'ADVENTURE', '2017-11-26 07:42:57', '2017-11-26 07:42:57'),
(13, 'INDIE', '2017-12-12 07:40:26', '2017-12-12 07:40:56'),
(14, 'FPS', '2017-12-12 07:40:46', '2017-12-12 07:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2017_11_05_054548_create_users_table', 1),
('2017_11_05_054648_create_categories_table', 1),
('2017_11_05_054715_create_products_table', 1),
('2017_11_05_054739_create_carts_table', 1),
('2017_11_05_054803_create_cart_items_table', 1),
('2017_11_05_054836_create_payments_table', 1),
('2017_11_27_015246_create_rates_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `total_cost` double(8,2) NOT NULL,
  `cart_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `date`, `total_cost`, `cart_id`, `created_at`, `updated_at`) VALUES
(4, '2017-11-29 11:19:52', 98000.00, 6, '2017-11-29 04:19:52', '2017-11-29 04:19:52'),
(5, '2017-11-29 12:31:22', 896000.00, 5, '2017-11-29 05:31:22', '2017-11-29 05:31:22'),
(6, '2017-11-29 14:08:24', 196000.00, 7, '2017-11-29 07:08:24', '2017-11-29 07:08:24'),
(7, '2017-12-12 15:05:59', 190000.00, 8, '2017-12-12 08:05:59', '2017-12-12 08:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `release_date` date NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `rate` int(1) DEFAULT '0',
  `desc` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `price`, `name`, `picture`, `release_date`, `category_id`, `rate`, `desc`, `created_at`, `updated_at`) VALUES
(18, 90000.00, 'GTA San Andreas', '1513089267.jpg', '2003-12-06', 12, 0, 'Grand Theft Auto: San Andreas is an action-adventure video game developed by Rockstar North and published by Rockstar Games. It was released on 26 October 2004 for PlayStation 2, and on 7 June 2005 for Microsoft Windows and Xbox. A high definition remastered version received a physical release for both Xbox 360 and PlayStation 3 on 30 June 2015 and 1 December 2015, respectively. It is the seventh title in the Grand Theft Auto series, and the first main entry since 2002\'s Grand Theft Auto: Vice City. It was released on the same day as the handheld game Grand Theft Auto Advance for Game Boy Advance.', '2017-12-12 07:34:27', '2017-12-12 07:34:27'),
(19, 100000.00, 'Grand Theft Auto: Liberty City Stories', '1513089433.jpg', '2004-12-12', 12, 0, 'Grand Theft Auto: Liberty City Stories was the first Grand Theft Auto game released for the PlayStation Portable. Set in Liberty City in 1998, it is a prequel to the events of Grand Theft Auto Advance and Grand Theft Auto III, and the chronological sequel to Grand Theft Auto: San Andreas.', '2017-12-12 07:37:13', '2017-12-12 07:37:13'),
(20, 199000.00, 'Middle-earth™', '1513090298.jpg', '2017-12-12', 1, 0, 'The Outlaw Tribe are Mordor\'s ultimate rebels, defying the domination of the Dark Lord and the Bright Lord alike and fighting for the Age of the Orc. However, when they can be controlled they make fearsome followers and mighty warriors. They wield unique chains to capture their enemies and salvage weapons and armor.', '2017-12-12 07:43:18', '2017-12-12 07:51:38'),
(21, 799000.00, 'Fallout 4 VR', '1513089917.jpg', '2017-12-12', 1, 0, 'Fallout 4, the legendary post-apocalyptic adventure from Bethesda Game Studios and winner of more than 200 ‘Best Of’ awards, including the DICE and BAFTA Game of the Year, comes in its entirety to VR.', '2017-12-12 07:45:17', '2017-12-12 07:45:17'),
(22, 7224.00, 'Anubis Dungeon', '1513090032.jpg', '2017-12-02', 13, 0, 'The judge of the kingdom of the dead is the guide of the dead to the afterlife, but what if the living cheated death?', '2017-12-12 07:47:12', '2017-12-12 07:47:12'),
(23, 39999.00, 'Disputed Space', '1513090121.jpg', '2017-12-30', 14, 0, 'Experience epic space battles while piloting a small, fast fighter ship as part of a fleet that lashes out against enemy factions across stunning procedurally generated star systems in Disputed Space.', '2017-12-12 07:48:41', '2017-12-12 07:48:41'),
(24, 69999.00, 'Alpha Mike Foxtrot VR - AMF VR', '1513090256.jpg', '2006-07-21', 14, 0, 'Get ready for the Next Generation in Virtual Reality First Person Shooters! Focusing on fast-paced gameplay and immersive environments, Alpha Mike Foxtrot VR (AMF VR) delivers the goods. Put on your headset and engage in all-out warfare with Bots, Friends (or Enemies) around the globe.', '2017-12-12 07:50:56', '2017-12-12 07:50:56'),
(25, 190000.00, 'Life is Strange Episode 1', '1513091119.jpg', '2017-12-17', 12, 0, 'Episode 1 now FREE! Life is Strange is an award-winning and critically acclaimed episodic adventure game that allows the player to rewind time and affect the past, present and future.', '2017-12-12 08:03:34', '2017-12-12 08:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `user_id`, `product_id`, `rate`, `created_at`, `updated_at`) VALUES
(6, 2, 25, 5, '2017-12-12 08:05:39', '2017-12-12 08:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DOB` date NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `DOB`, `picture`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pandji', '08953089231', 'p@gmail.com', '$2y$10$ul0T.91bQM.hw8ag6ywhKOLWupUXpbl9oasOkBtVaZkf8J65Eycy6', '1999-11-20', '', 0, 'M16OFWlxno6G72giAZ5Oxab8qmD1S8j8UOy6EQ5KBoggWgKDpSbvQ5H1mXkO', '2017-11-23 23:12:17', '2017-11-29 08:41:38'),
(2, 'Susanto', '08959092231', 's@gmail.com', '$2y$10$N./jK5c6fvjJ6BN93JsYt.VE/CofkKfM.IwENm2GlVi6WjgK2splG', '1999-11-20', '1511693337.JPEG', 1, 'yqJN9LX5MrVoY8cJlHN8u3cb1JoWdhUiE5jSaB4ikRNeIjDsseqInwMRMrp6', '2017-11-23 23:13:10', '2017-11-29 19:59:15'),
(4, 'test1', '', 't@gmail.com', '$2y$10$Jb88YMZRHh.DHcn0qeNoeux0fMzAF.rK/NLR53LwepAXMT0NLKJgS', '1980-02-20', '1511705895.jpg', 0, 'oTLSBbKRSPbrjqJSfYWXN699syMrjqzPN5T0eaHg0lZiONh2cHNmRJ5m70AU', '2017-11-26 07:18:15', '2017-11-26 07:34:16'),
(5, 'ricad', '', 'ricad@gmail.com', '$2y$10$WqObIhHEVmsxbqkIRZlpf.Lb2/Nle5D4EyKwaZlklO75kD8p9zF/a', '0000-00-00', '', 0, 'yyxewTDvfp5Vho6Rf6Qf5zhQnUNa8dIDSRSE6ZNQF3cx8cJHJJrf5qBr7Pfc', '2017-11-29 09:21:44', '2017-11-29 09:22:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_cart_id_foreign` (`cart_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rates_user_id_foreign` (`user_id`),
  ADD KEY `rates_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_email_index` (`email`),
  ADD KEY `users_is_admin_index` (`is_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
