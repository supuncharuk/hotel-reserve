-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 04, 2024 at 11:44 PM
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
  `discount` int DEFAULT NULL,
  `vat` int DEFAULT NULL,
  `total_payment` int DEFAULT NULL,
  `booking_ref` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `room_number` (`room_number`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `room_number`, `customer_name`, `customer_email`, `customer_mobile`, `checking_date`, `checkout_date`, `paid`, `discount`, `vat`, `total_payment`, `booking_ref`) VALUES
(1, 1, 'test', 'test@smaple.com', '0124563978', '2024-11-01', '2024-11-03', 0, NULL, NULL, NULL, ''),
(22, 1, 'test', 'sample@gmail.com', '0715631245', '2024-11-23', '2024-11-24', 1, 0, 1800, 12050, 'booking_67294e4c97ff66.12364944'),
(21, 1, 'test', 'sample@gmail.com', '0715631245', '2024-11-21', '2024-11-22', 0, NULL, NULL, NULL, 'booking_67294b4bebc5a1.48923254'),
(20, 1, 'Adam', 'adam@gmail.com', '0715631693', '2024-11-03', '2024-11-04', 0, NULL, NULL, NULL, 'booking_67290ce5726d43.39911385');

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
  `room_availability` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`room_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_number`, `room_name`, `room_image_name`, `room_type`, `no_persons`, `ac_availability`, `room_price`, `room_availability`, `created_at`, `updated_at`) VALUES
(88, 'edfsdfsd hbfvhfdbjhfd', 'room2.jpg', 'dffdsgf', 45, 'no', 435325, 0, '2024-10-24 15:04:30', '2024-10-24 15:15:18'),
(1, 'Room 1', 'eight.jpg', 'Type 1', 3, 'yes', 10000, 0, '2024-10-06 15:59:48', '2024-10-24 15:20:06');

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
