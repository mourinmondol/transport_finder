-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2019 at 05:40 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transport_finder`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@app.com', '$2y$10$RTHyqwhOqdmwAD117rj3.uGAJ.QrnOoXLD3GkkfJmthaUm/eWb2aC', NULL, '2019-03-17 11:40:58', '2019-03-17 11:40:58'),
(3, 'admi1n@app.com', '$2y$10$mv.dRyyvd7qmlERyF8Zvv.huNkMeMzjncpo0H/4lb7Bdydg5OC3t6', NULL, '2019-03-17 14:21:53', '2019-03-17 14:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `feedback_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback_comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `given_to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `given_to_id` int(10) UNSIGNED NOT NULL,
  `given_by` int(10) UNSIGNED NOT NULL,
  `feedback_status` int(10) UNSIGNED DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `feedback_type`, `feedback_comment`, `given_to`, `given_to_id`, `given_by`, `feedback_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Like', 'Trusted Info!', 'Bus', 2, 1, 0, NULL, '2019-03-23 20:14:47', '2019-03-23 20:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `informations`
--

CREATE TABLE `informations` (
  `id` int(10) UNSIGNED NOT NULL,
  `information_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `information_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `informations`
--

INSERT INTO `informations` (`id`, `information_type`, `information_description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'About', 'tuhtgyuijfghjftghjfghujty', NULL, '2019-03-24 13:19:11', '2019-03-24 13:19:11'),
(2, 'Docs', 'ghfuhytryujftgy', NULL, '2019-03-24 13:21:14', '2019-03-24 13:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_17_155602__create_admins_table', 1),
(4, '2019_03_17_170256__create_transports_table', 1),
(5, '2019_03_17_170350__create_stations_table', 1),
(6, '2019_03_17_170547__create_routes_table', 1),
(7, '2019_03_17_170601__create_feedbacks_table', 1),
(8, '2019_03_17_170709__create_informations_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(10) UNSIGNED NOT NULL,
  `posted_by` int(11) DEFAULT NULL,
  `route_SSID` int(10) UNSIGNED NOT NULL,
  `route_DSID` int(10) UNSIGNED NOT NULL,
  `route_TID` int(10) UNSIGNED NOT NULL,
  `route_fare` double(8,2) DEFAULT NULL,
  `route_distance` double(8,2) DEFAULT NULL,
  `route_description` text COLLATE utf8mb4_unicode_ci,
  `route_likes` int(10) UNSIGNED DEFAULT '0',
  `route_dislikes` int(10) UNSIGNED DEFAULT '0',
  `route_status` int(10) UNSIGNED DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `posted_by`, `route_SSID`, `route_DSID`, `route_TID`, `route_fare`, `route_distance`, `route_description`, `route_likes`, `route_dislikes`, `route_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 2, 2, 10.00, 422.74, 'This is a Intercity Bus which runs through Savar To Saidabad.', NULL, NULL, 1, NULL, '2019-03-23 19:54:47', '2019-03-23 19:54:47'),
(2, 1, 2, 2, 2, 10.00, 0.00, 'fgdfhggfjhutgyhj', 0, 0, 0, NULL, '2019-03-24 14:23:48', '2019-03-24 14:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` int(10) UNSIGNED NOT NULL,
  `posted_by` int(11) DEFAULT NULL,
  `station_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `station_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `station_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `station_lat` double(8,4) DEFAULT NULL,
  `station_long` double(8,4) DEFAULT NULL,
  `station_description` text COLLATE utf8mb4_unicode_ci,
  `station_likes` int(10) UNSIGNED DEFAULT '0',
  `station_dislikes` int(10) UNSIGNED DEFAULT '0',
  `station_status` int(10) UNSIGNED DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `posted_by`, `station_name`, `station_type`, `station_image`, `station_lat`, `station_long`, `station_description`, `station_likes`, `station_dislikes`, `station_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Dhanmondi 32', 'Bus', '1553366654.jpg', 32.9697, -96.8032, 'A Road Transport Station for Local Transport', NULL, NULL, 1, NULL, '2019-03-23 18:44:14', '2019-03-23 18:44:14'),
(2, NULL, 'Shyamoli', 'Bus', '1553366886.jpg', 29.4679, -98.5351, 'A Road Transport Station for Local Transport', NULL, NULL, 1, NULL, '2019-03-23 18:48:06', '2019-03-23 18:48:06'),
(3, 1, 'Kalabagan', 'Bus', '1553437065.jpg', 24.0984, 90.3287, 'Near Kalabagn Playground', 0, 0, 0, NULL, '2019-03-24 14:17:45', '2019-03-24 14:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `id` int(10) UNSIGNED NOT NULL,
  `posted_by` int(11) DEFAULT NULL,
  `transport_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transport_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transport_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transport_description` text COLLATE utf8mb4_unicode_ci,
  `transport_likes` int(10) UNSIGNED DEFAULT '0',
  `transport_dislikes` int(10) UNSIGNED DEFAULT '0',
  `transport_status` int(10) UNSIGNED DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transports`
--

INSERT INTO `transports` (`id`, `posted_by`, `transport_name`, `transport_type`, `transport_image`, `transport_description`, `transport_likes`, `transport_dislikes`, `transport_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, NULL, 'Moumita', 'Bus', '1553091400.jpg', 'Intercity Bus   dsfdftyut', 0, 0, 1, NULL, '2019-03-20 14:16:40', '2019-03-20 14:16:40'),
(3, 1, 'Transsilva', 'Bus', '1553436298.jpg', 'Intercity Bus Service  hgj', 0, 0, 0, NULL, '2019-03-24 14:00:13', '2019-03-24 14:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rajons', 'admin@app.com', NULL, '$2y$10$P0R7EULJ21NYSOZOkHSXzenX6F/8XJf463k.uyt91BAjQ6wviqkHO', NULL, '2019-03-17 14:14:52', '2019-03-17 14:14:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informations`
--
ALTER TABLE `informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `informations`
--
ALTER TABLE `informations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transports`
--
ALTER TABLE `transports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
