-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2024 at 12:43 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `room_number` int NOT NULL,
  `customer_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `checking_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `ssc_levy` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `total_payment` decimal(10,2) NOT NULL,
  `booking_ref` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  KEY `room_number` (`room_number`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `room_number`, `customer_name`, `customer_email`, `customer_mobile`, `checking_date`, `checkout_date`, `paid`, `vat`, `ssc_levy`, `discount`, `total_payment`, `booking_ref`, `created_at`, `updated_at`) VALUES
(1, 14, 'K.D. Ramanayake', 'kdramanayake@gmail.com', '0776452136', '2024-11-09', '2024-11-12', 1, 78975.00, 10968.75, 0.00, 528693.75, 'booking_672ea2b7eb5cd6.93016083', '2024-11-08 23:45:59', '2024-11-08 23:48:06'),
(2, 1, 'T. W. Kannangara', 'twkannangara@gmail.com', '0716589632', '2024-11-09', '2024-11-12', 1, 15795.00, 2193.75, 0.00, 105738.75, 'booking_672ea3ec32f633.16593596', '2024-11-08 23:51:08', '2024-11-08 23:52:41'),
(3, 6, 'R. T. Malinga', 'rtmalinga@gmail.com', '0756934589', '2024-11-20', '2024-11-27', 0, 0.00, 0.00, 0.00, 0.00, 'booking_672eb023484b52.41975944', '2024-11-09 00:43:15', '2024-11-09 00:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_number` int NOT NULL,
  `room_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_image_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_persons` int DEFAULT NULL,
  `ac_availability` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_price` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`room_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_number`, `room_name`, `room_image_name`, `room_type`, `no_persons`, `ac_availability`, `room_price`, `created_at`, `updated_at`) VALUES
(5, 'Ocean View Room', 'room3.jpg', 'special', 3, 'yes', 64350, '2024-11-08 22:57:33', '2024-11-08 23:10:58'),
(14, 'Presidential Suite', 'room4.jpg', 'special', 4, 'yes', 146250, '2024-11-08 22:58:43', '2024-11-08 23:09:09'),
(2, 'Family Room', 'room2.jpg', 'special', 4, 'yes', 52650, '2024-11-08 22:56:28', '2024-11-08 22:56:28'),
(13, 'Executive Suite', 'room1.jpg', 'special', 2, 'yes', 73125, '2024-11-08 22:54:55', '2024-11-08 23:09:38'),
(8, 'Garden View Room', 'room1.jpg', 'special', 2, 'yes', 46800, '2024-11-08 23:00:18', '2024-11-08 23:10:35'),
(10, 'Junior Suite', 'room2.jpg', 'special', 2, 'yes', 50625, '2024-11-08 23:03:00', '2024-11-08 23:21:58'),
(1, 'Standard Single Room', 'about_banner.jpg', 'normal', 1, 'yes', 29250, '2024-11-08 23:13:46', '2024-11-08 23:13:46'),
(3, 'Standard Double Room', 'about_bg.jpg', 'normal', 2, 'yes', 38025, '2024-11-08 23:14:38', '2024-11-08 23:14:38'),
(4, 'Superior Double Room', 'banner_bg.jpg', 'normal', 2, 'yes', 43875, '2024-11-08 23:15:54', '2024-11-08 23:15:54'),
(6, 'Standard Triple Room', 'facilites_bg.jpg', 'normal', 3, 'yes', 49725, '2024-11-08 23:16:48', '2024-11-08 23:16:48'),
(7, 'Economy Room', 'room1.jpg', 'normal', 2, 'yes', 26325, '2024-11-08 23:17:39', '2024-11-08 23:17:39'),
(9, 'Standard Quad Room', 'room2.jpg', 'normal', 4, 'yes', 58500, '2024-11-08 23:18:22', '2024-11-08 23:18:22'),
(11, 'Deluxe Room', 'room3.jpg', 'normal', 2, 'yes', 52650, '2024-11-08 23:19:18', '2024-11-08 23:20:33'),
(12, 'Standard Family Room', 'about_banner.jpg', 'normal', 4, 'yes', 64350, '2024-11-08 23:20:02', '2024-11-08 23:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uemail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ustatus` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`uname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uname`, `uemail`, `upassword`, `is_admin`, `ustatus`) VALUES
('admin', 'Test@gmail.com', '$2y$10$a.vlregXfanvM7jEdhuFFOAaBkSdcTRKzDUvRJQDSvs7jkxYeSUh.', 'yes', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
