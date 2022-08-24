-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2022 at 10:42 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `slug`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Event 521', 'event-521', '2022-08-23 01:29:51', '2022-08-23 01:29:51', 0),
(2, 'Event 694', 'event-694', '2022-08-23 01:29:51', '2022-08-23 01:29:51', 0),
(3, 'Event 670', 'event-670', '2022-08-23 01:29:51', '2022-08-23 01:29:51', 0),
(4, 'Event 898', 'event-898', '2022-08-23 01:29:51', '2022-08-23 01:29:51', 0),
(5, 'Event 903', 'event-903', '2022-08-23 01:29:51', '2022-08-23 01:29:51', 0),
(6, 'Event 244', 'event-244', '2022-08-23 01:29:51', '2022-08-23 01:29:51', 0),
(7, 'Event 516', 'event-516', '2022-08-23 01:29:51', '2022-08-23 01:29:51', 0),
(8, 'Event 688', 'event-688', '2022-08-23 01:29:51', '2022-08-23 02:01:22', 0),
(9, 'Event 250', 'event-250', '2022-08-23 01:29:51', '2022-08-23 13:55:08', 1),
(10, 'Event 720', 'event-720', '2022-08-23 01:29:51', '2022-08-23 13:55:04', 1),
(11, 'sdfwfwe erewr', 'fwer werwr', '2022-08-23 01:55:37', '2022-08-23 13:55:49', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `events_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
