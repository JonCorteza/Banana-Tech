-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 12, 2024 at 03:15 PM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u156797878_bananatechpark`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_constants`
--

CREATE TABLE `tbl_constants` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `sub_value` varchar(100) NOT NULL,
  `other` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_constants`
--

INSERT INTO `tbl_constants` (`id`, `category`, `value`, `sub_value`, `other`, `created_at`) VALUES
(2, 'Card', 'PWD', '10', '', '2023-03-16 20:09:06'),
(3, 'Card', 'Senior', '10', '', '2023-03-16 20:09:21'),
(4, 'Penalty', 'Wrong Park', '40', '', '2023-03-29 00:52:49'),
(6, 'Amount', '500', '', '', '2023-03-31 22:00:05'),
(8, 'Status', 'Reserved', '', '', '2023-04-05 22:37:23'),
(9, 'Status', 'Park In', '', '', '2023-04-05 22:37:23'),
(10, 'Status', 'Park Out', '', '', '2023-04-05 22:37:31'),
(12, 'Card', 'Guest', '', '', '2023-05-22 01:07:00'),
(14, 'RFID', 'ED:5C:10:E3', '73:DF:C2:17,31:5F:56:47,B3:73:45:4B,28:9A:A2:89,ED:5C,BF:82:A7:89:10:E3,ED:1D:11:E3', '', '2023-06-29 03:47:14'),
(15, 'RFID', 'BF:82:A7:89', '73:DF:C2:17,31:5F:56:47,B3:73:45:4B,28:9A:A2:89,ED:5C:10:E3,ED:1D:11:E3,BF:82:A7:89', '', '2023-07-03 15:33:21'),
(16, 'RFID', '28:9A:A2:89', '73:DF:C2:17,31:5F:56:47,B3:73:45:4B,28:9A:A2:89,ED:5C:10:E3,ED:1D:11:E3,BF:82:A7:89', '', '2024-01-20 07:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fares`
--

CREATE TABLE `tbl_fares` (
  `id` int(11) NOT NULL,
  `card_type` varchar(50) NOT NULL,
  `is_walkin` int(11) NOT NULL,
  `amount_per_hr` double(15,2) NOT NULL,
  `succeed_hr` int(11) NOT NULL,
  `suceeding_amount` double(15,2) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_fares`
--

INSERT INTO `tbl_fares` (`id`, `card_type`, `is_walkin`, `amount_per_hr`, `succeed_hr`, `suceeding_amount`, `comments`, `created_at`) VALUES
(1, 'Guest', 0, 20.00, 4, 30.00, '4hrs succeed', '2023-03-29 00:13:07'),
(2, 'Guest', 1, 40.00, 4, 20.00, '4hrs succeed', '2023-03-29 00:38:27'),
(3, 'Discounted', 0, 10.00, 3, 20.00, '1hr free, 3succeed', '2023-03-29 00:40:26'),
(4, 'Discounted', 1, 10.00, 3, 20.00, '2hr free, 3succeed', '2023-03-29 00:40:26'),
(7, 'Discounted	', 1, 100.00, 2, 30.00, '', '2023-04-05 23:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locations`
--

CREATE TABLE `tbl_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `frame` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_locations`
--

INSERT INTO `tbl_locations` (`id`, `name`, `address`, `lat`, `lng`, `frame`, `status`, `created_at`) VALUES
(1, 'Millionaires Park', 'P2FQ+C2P Millionaires Village, Emerland Street, Novaliches, Quezon City, 1117 Metro Manila', '14.723589', '121.0353953', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.8054431541436!2d121.03539531484167!3d14.723588989724261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0fee6e8a48f%3A0x1cbc4a70d74f3043!2sMillionaires%20Park!5e0!3m2!1sen!2sph!4v1667139368795!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Active', '2022-10-30 22:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parks`
--

CREATE TABLE `tbl_parks` (
  `id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `park_code` varchar(50) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `sub_status` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Available',
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_parks`
--

INSERT INTO `tbl_parks` (`id`, `loc_id`, `user_id`, `park_code`, `lat`, `lng`, `sub_status`, `status`, `image`, `created_at`) VALUES
(1, 0, 25, 'L1P1', '14.658734751964026', '121.02884715525752', '', 'Available', 'LP1.png', '2023-04-20 08:06:42'),
(2, 0, 25, 'L1P2', '14.658718115716262 ', '121.0288576824739', '', 'Available', 'LP2.png', '2023-05-13 00:06:04'),
(3, 0, 45, 'L1P3', '14.7772936', '121.0455255', 'Reserved', 'Available', 'LP3.png', '2023-05-15 01:38:30'),
(4, 0, 45, 'L1P4', '14.777932', '121.056378', 'Reserved', 'Available', 'LP4.png', '2023-05-15 01:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `amount` double(15,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `user_id`, `reservation_id`, `type`, `amount`, `created_at`) VALUES
(33, 32, NULL, 'Pay Out', 0.00, '2023-05-22 01:20:10'),
(34, 32, NULL, 'Pay Out', 0.00, '2023-05-22 01:20:21'),
(35, 32, NULL, 'Pay Out', 0.00, '2023-05-22 01:21:41'),
(36, 32, NULL, 'Pay Out', 0.00, '2023-05-22 01:22:02'),
(37, 33, NULL, 'Pay In', 500.00, '2023-06-20 14:54:30'),
(38, 1, NULL, 'Pay In', 1000.00, '2023-06-29 08:24:43'),
(39, 1, NULL, 'Pay In', 10000.00, '2023-11-20 17:26:53'),
(40, 36, NULL, 'Pay In', 999999.00, '2023-11-20 17:27:42'),
(41, 35, NULL, 'Pay In', 99999.00, '2023-11-20 17:27:48'),
(42, 34, NULL, 'Pay In', 25000.00, '2023-11-20 17:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservations`
--

CREATE TABLE `tbl_reservations` (
  `id` int(11) NOT NULL,
  `park_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `reserveNo` varchar(50) NOT NULL,
  `card_type` varchar(50) NOT NULL,
  `guest_type` varchar(50) NOT NULL,
  `time_reserved` time DEFAULT NULL,
  `time_arrival` time DEFAULT NULL,
  `reserve_hr` double(11,2) NOT NULL,
  `park_in` time DEFAULT NULL,
  `park_out` time DEFAULT NULL,
  `park_hr` int(11) NOT NULL,
  `total_hr` int(11) NOT NULL,
  `sub_total` double(15,2) NOT NULL,
  `discount` double(15,2) NOT NULL,
  `penalty` double(15,2) NOT NULL,
  `total` double(15,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `notif` varchar(255) NOT NULL,
  `xdate` date NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reservations`
--

INSERT INTO `tbl_reservations` (`id`, `park_id`, `user_id`, `reserveNo`, `card_type`, `guest_type`, `time_reserved`, `time_arrival`, `reserve_hr`, `park_in`, `park_out`, `park_hr`, `total_hr`, `sub_total`, `discount`, `penalty`, `total`, `status`, `notif`, `xdate`, `created_at`) VALUES
(79, 2, 32, 'kl65Dcb', 'Guest', 'Reserved', '03:55:00', '17:00:00', 1.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-05-22', '2023-05-22 07:55:59'),
(80, 1, 32, 'FKCtQA3', 'Guest', 'Reserved', '03:01:00', '16:01:00', 1.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-05-30', '2023-05-30 07:01:46'),
(81, 1, 32, 'KWsF6Uy', 'Guest', 'Reserved', '03:13:00', '16:20:00', 1.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-06-27', '2023-06-27 07:14:33'),
(83, 1, 25, 'a3ck0SJ', 'Senior', 'Reserved', '04:06:00', '19:07:00', 3.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-06-29', '2023-06-29 08:07:24'),
(84, 2, 25, 'DWKoTfE', 'Senior', 'Reserved', '04:38:00', '20:38:00', 4.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-06-29', '2023-06-29 08:38:55'),
(85, 1, 25, 'snmgJiS', 'Senior', 'Reserved', '03:45:00', '16:46:00', 1.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-07-05', '2023-07-05 07:46:53'),
(86, 2, 34, 'hJS0Ndb', '', 'Reserved', '03:46:00', '17:00:00', 1.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-07-05', '2023-07-05 07:49:36'),
(87, 1, 25, 'UK9yzOJ', 'Senior', 'Reserved', '04:01:00', '17:01:00', 1.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-07-05', '2023-07-05 08:01:41'),
(88, 1, 36, 'DhyZntF', '', 'Reserved', '10:22:00', '00:20:00', 22.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-10-04', '2023-10-04 14:23:18'),
(89, 2, 32, 'idQbfhu', 'Guest', 'Reserved', '05:19:00', '18:20:00', 1.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-10-14', '2023-10-14 09:19:50'),
(90, 3, 32, 'aYeOBik', 'Guest', 'Reserved', '10:38:00', '12:38:00', 2.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-11-05', '2023-11-05 10:38:38'),
(91, 4, 32, 'Z8xgQMT', 'Guest', 'Reserved', '04:07:00', '06:08:00', 10.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-11-05', '2023-11-05 16:11:44'),
(92, 2, 32, 'P0BMcbg', 'Guest', 'Reserved', '04:13:00', '21:14:00', 5.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-11-05', '2023-11-05 16:14:55'),
(93, 3, 32, 'Dgq6SnY', 'Guest', 'Reserved', '04:15:00', '19:15:00', 3.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-11-05', '2023-11-05 16:16:01'),
(94, 0, 46, 'UWBQKR8', '', 'Reserved', '10:40:00', '10:39:00', 12.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-04', '2023-12-04 14:40:58'),
(95, 0, 46, '7zAKkFT', '', 'Reserved', '10:40:00', '10:39:00', 12.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-04', '2023-12-04 14:40:58'),
(96, 0, 46, 'rByxgJR', '', 'Reserved', '10:44:00', '10:43:00', 12.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-04', '2023-12-04 14:44:45'),
(97, 0, 46, 'LpoFOha', '', 'Reserved', '10:44:00', '10:43:00', 12.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-04', '2023-12-04 14:44:45'),
(98, 3, 46, 'IfE2eht', '', 'Reserved', '04:38:00', '16:37:00', 12.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-04', '2023-12-04 20:38:24'),
(99, 4, 45, '9WzhYri', '', 'Reserved', '08:57:00', '08:30:00', 0.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-05', '2023-12-05 00:57:38'),
(100, 1, 36, 'YpHxijE', 'PWD', 'Reserved', '10:37:00', '22:40:00', 0.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-05', '2023-12-05 14:38:25'),
(101, 4, 45, 'YHzZUab', '', 'Reserved', '10:59:00', '12:59:00', 10.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-05', '2023-12-05 14:59:26'),
(102, 0, 45, 'QlPy5GA', '', 'Reserved', '10:59:00', '10:59:00', 12.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-05', '2023-12-05 14:59:56'),
(103, 0, 45, 'CiuYrnV', '', 'Reserved', '10:59:00', '13:01:00', 10.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-05', '2023-12-05 15:00:07'),
(104, 4, 45, 'vpDNohw', '', 'Reserved', '11:32:00', '13:32:00', 10.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-07', '2023-12-07 15:32:34'),
(105, 0, 45, 'ZxVEwAL', '', 'Reserved', '11:32:00', '23:33:00', 0.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-07', '2023-12-07 15:32:44'),
(106, 4, 45, '4OPVs1b', '', 'Reserved', '01:06:00', '14:22:00', 1.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2023-12-17', '2023-12-17 05:07:13'),
(107, 0, 45, 'ZUBJnCA', '', 'Reserved', '01:37:00', '14:00:00', 0.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-02', '2024-01-02 05:38:25'),
(108, 2, 25, '3Tfyrlq', 'Senior', 'Reserved', '03:42:00', '19:43:00', 4.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-02', '2024-01-02 07:43:09'),
(109, 0, 25, '2Ud0FKR', 'Senior', 'Reserved', '03:43:00', '21:49:00', 6.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-02', '2024-01-02 07:43:36'),
(110, 4, 45, 'OKRvNJf', '', 'Reserved', '05:26:00', '19:00:00', 2.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-07', '2024-01-07 09:26:32'),
(111, 3, 45, 'uALSbrR', '', 'Reserved', '10:19:00', '18:00:00', 4.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-07', '2024-01-07 14:19:51'),
(112, 4, 45, 'jU54wVT', '', 'Reserved', '10:19:00', '20:00:00', 2.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-07', '2024-01-07 14:20:12'),
(113, 0, 45, 'bE5ylnf', '', 'Reserved', '10:20:00', '18:00:00', 4.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-07', '2024-01-07 14:20:23'),
(114, 0, 45, 'GuP0wEt', '', 'Reserved', '10:20:00', '16:00:00', 6.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-07', '2024-01-07 14:20:39'),
(115, 3, 45, 'o9Lp3rY', '', 'Reserved', '07:09:00', '00:00:00', 19.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-11', '2024-01-11 11:09:33'),
(116, 4, 45, 'k0wgzDO', '', 'Reserved', '07:13:00', '01:00:00', 18.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-11', '2024-01-11 11:13:11'),
(117, 0, 45, 'vf9dwP3', '', 'Reserved', '07:13:00', '02:00:00', 17.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-11', '2024-01-11 11:13:29'),
(118, 1, 25, 'ls2ECSv', 'Senior', 'Reserved', '02:43:00', '14:45:00', 0.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Cancelled', 'Cancelled Reservation', '2024-01-20', '2024-01-20 06:44:08'),
(119, 3, 45, 'wOQyKkC', '', 'Reserved', '11:33:00', '02:33:00', 21.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Reserved', '', '2024-02-18', '2024-02-18 15:33:51'),
(120, 4, 45, 'JVwrDve', '', 'Reserved', '11:33:00', '01:34:00', 22.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Reserved', '', '2024-02-18', '2024-02-18 15:34:19'),
(121, 0, 45, 'Iz1iN9H', '', 'Reserved', '11:34:00', '00:35:00', 23.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Reserved', '', '2024-02-18', '2024-02-18 15:34:30'),
(122, 0, 45, 'Hi26RWQ', '', 'Reserved', '10:22:00', '22:24:00', 0.00, NULL, NULL, 0, 0, 0.00, 0.00, 0.00, 0.00, 'Reserved', '', '2024-03-11', '2024-03-11 14:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(5) NOT NULL,
  `userNo` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `bday` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `emailCode` varchar(255) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `xagree` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `plate_no` varchar(50) NOT NULL,
  `card_type` varchar(50) NOT NULL,
  `rfidno` varchar(255) NOT NULL,
  `balance_amount` double(15,2) NOT NULL,
  `attempt_no` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `userNo`, `role`, `fname`, `lname`, `mname`, `bday`, `age`, `gender`, `address`, `email`, `emailCode`, `contact`, `xagree`, `username`, `password`, `pic`, `status`, `lat`, `lng`, `plate_no`, `card_type`, `rfidno`, `balance_amount`, `attempt_no`, `created_at`) VALUES
(1, '1', 'Admin', 'Jon', 'Corteza', 'jcb', '1993-01-11', '26', 'Male', 'address', 'jonathancorteza@gmail.com', '', '09156958793', 1, 'asd', 'S2lWbWlXNThnQXRFQzd3VWdiZVl6dz09', 'JCB1.jpg', 'Active', '', '', 'WEY 123', 'Guest', 'ED:5C:10:E3', 16000.00, 0, '2023-03-16 20:19:57'),
(35, '48b531b', 'User', 'luis', 'jon', NULL, '', '', '', 'bicol region 5', 'jonluis@test.com', '1448fb2f3752e08d58299b8430899ba3', '09156958793', 0, 'jonluis@test.com', 'ZmNodHNxZmtiYVN6c3k2V21WVmpXQT09', 'default.png', 'Active', '', '', 'knkh', 'Guest', 'hkkg', 99999.00, 0, '2023-08-14 02:51:53'),
(25, 'AAA111', 'User', 'Jeffrey', 'Diana', 'A', '2023-04-13', '0', 'Male', 'Cavite', 'znmerchandisetrade@gmail.com', '', '09171234567', 0, 'Jeffd', 'NTlFaW05YkQ3K3F5YnQvVTdySmZydz09', 'download (1).jpg', 'Active', '', '', 'ABC 123', 'Senior', '28:9A:A2:89', 50000.00, 0, '2023-04-13 11:57:17'),
(34, 'dce2a47', 'User', ' Ervin', 'Moran', NULL, '', '', '', 'Caloocan', 'emoran@amauonline.com', 'fda1ca96d287967cdb2ce69c45b5430e', '09210306292', 0, 'emoran@amauonline.com', 'ZmRxUXhSVi9BQjYxa3ZrNWJpTmx2UT09', 'default.png', 'Inactive', '', '', 'ljlj', 'Senior', ',hkh', 25000.00, 0, '2023-07-05 07:31:38'),
(36, '632a84d', 'User', ' Luisa', 'Nerbes', 'B', '1987-11-28', '36', 'Female', 'Camalig, Albay', 'luisa.nerbes@gmail.com', '029f395a7aa4966c97d061989ac8809b', '09995420187', 0, 'luisa.nerbes@gmail.com', 'cDdTckVBdGxUT2hpekVNc0M3bHZiQT09', 'default.png', '', '', '', 'khkh', 'PWD', 'mbh', 999999.00, 0, '2023-10-04 14:20:52'),
(33, '6d5f931', 'User', ' Jeff', 'Diana', 'A', '2016-02-17', '21', 'Male', ' Imus City, Cavite', 'basketxpress@gmail.com', 'b50026e6de834369852e4a9b4498e1b3', '09179999999', 0, 'basketxpress@gmail.com', 'bHp0QzNRREFiYzRFUTVNSVhKQW82Zz09', 'default.png', 'Active', '', '', 'njlj', 'PWD', ',njlj', 500.00, 0, '2023-06-20 14:48:53'),
(45, 'a00543e', 'User', 'corteza', 'jonathan', NULL, '', '', '', 'manila', 'jonathancorteza@yahoo.com', '2d15015f12bbdd06abf8d7a2591a1ee6', '09156958793', 0, 'jonathancorteza@yahoo.com', 'VFE1M1UrcnNERTVGQkRyZ0lIMzhSUT09', 'default.png', 'Active', '', '', '', '', '', 0.00, 0, '2023-11-22 09:06:17'),
(38, '57682e2', 'User', ' Tyrone Miguel', 'Banquirigan', NULL, '', '', '', 'Libod,Camalig,Albay', 'tyronemiguel04@gmail.com', '79bc9fc57c1b943249c6517a486681fd', '09693473901', 0, 'tyronemiguel04@gmail.com', 'Y1Q0aGoyZTJzT25mVnZmeVYwTUxZZz09', 'default.png', 'Active', '', '', '', '', '', 0.00, 0, '2023-11-22 03:00:01'),
(46, 'ce4ada9', 'User', 'joshua a.', 'palma', NULL, '', '', '', 'caloocan city', 'joshuapalma57@gmail.com', '6deefebb14fe02ae1decb1043c5a560a', '09773708351', 0, 'joshuapalma57@gmail.com', 'a0RqM0I1dFJCZDQzenFHWVlReDE4MDdPTjVGZkF2UjFBOEE2MH', 'default.png', 'Active', '', '', '', '', '', 0.00, 0, '2023-11-27 20:21:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_constants`
--
ALTER TABLE `tbl_constants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_fares`
--
ALTER TABLE `tbl_fares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_locations`
--
ALTER TABLE `tbl_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_parks`
--
ALTER TABLE `tbl_parks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_constants`
--
ALTER TABLE `tbl_constants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_fares`
--
ALTER TABLE `tbl_fares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_locations`
--
ALTER TABLE `tbl_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_parks`
--
ALTER TABLE `tbl_parks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
