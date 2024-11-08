-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 08, 2024 at 01:12 PM
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
  `vat` decimal(10,2) DEFAULT NULL,
  `ssc_levy` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total_payment` decimal(10,2) DEFAULT NULL,
  `booking_ref` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  KEY `room_number` (`room_number`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `room_number`, `customer_name`, `customer_email`, `customer_mobile`, `checking_date`, `checkout_date`, `paid`, `vat`, `ssc_levy`, `discount`, `total_payment`, `booking_ref`, `created_at`, `updated_at`) VALUES
(38, 1, 'plyn', 'test@smaple.com', '0715631693', '2024-11-21', '2024-11-26', 1, 5400.00, 750.00, 0.00, 36150.00, 'booking_672db4356740f8.03824739', '2024-11-08 06:50:07', '2024-11-08 09:29:30'),
(37, 88, 'Adam', 'adam@gmail.com', '0715631292', '2024-11-08', '2024-11-09', 1, 85140.00, 11825.00, 0.00, 569965.00, 'booking_672db32df11df7.24907877', '2024-11-08 06:50:07', '2024-11-08 09:43:26'),
(44, 1, 'NEW', 'new@gmail.com', '0715631292', '2024-11-08', '2024-11-09', 1, 1800.00, 250.00, 0.00, 12050.00, 'booking_672e0444969752.96707388', '2024-11-08 12:29:56', '2024-11-08 12:30:08'),
(46, 88, 'werewr', 'wer@sample.com', '0715631693', '2024-11-15', '2024-11-16', 1, 7740.00, 1075.00, 0.00, 51815.00, 'booking_672e04eeaa5769.75064838', '2024-11-08 12:32:46', '2024-11-08 12:33:01'),
(47, 88, 'dssdf', 'adam@gmail.com', '0723654896', '2024-11-28', '2024-11-29', 1, 7740.00, 1075.00, 0.00, 51815.00, 'booking_672e05fb509093.73751640', '2024-11-08 12:37:15', '2024-11-08 12:45:04'),
(48, 88, 'cccc', 'cc@gmail.com', '23424', '2024-11-21', '2024-11-22', 1, 7740.00, 1075.00, 0.00, 51815.00, 'booking_672e09bc2d46c7.14532994', '2024-11-08 12:53:16', '2024-11-08 12:54:40');

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
(88, 'edfsdfsd hbfvhfdbjhfd', 'room2.jpg', 'dffdsgf', 45, 'no', 43000, '2024-10-24 15:04:30', '2024-11-08 05:49:51'),
(1, 'Room 1', 'eight.jpg', 'Type 1', 3, 'yes', 10000, '2024-10-06 15:59:48', '2024-10-24 15:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `testimonial_id` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_image_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testimonial_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `star_rating` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`testimonial_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`testimonial_id`, `client_name`, `client_image_name`, `testimonial_description`, `star_rating`) VALUES
(1, 'TEST', 'testtimonial-1.jpg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 4),
(2, 'Adam', 'testtimonial-2.jpg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 5),
(3, 'Obama', 'c2.jpg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uemail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ustatus` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`uname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uname`, `uemail`, `upassword`, `ustatus`) VALUES
('wert', 'test@sample.com', '$2y$10$Epy3BeV9c6e5DGe9pnWPueOcP.GFpDnyoK7YRfhN/05uPuhsTlaLq', '1'),
('hggj', 'gjg@Qdf', '$2y$10$Pyn.gxG2nrBRxHBCiLlfkOm9/oJuxnOAdDhkb.2mJnxWz.KajDjaC', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
