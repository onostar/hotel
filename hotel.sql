-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2022 at 04:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

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
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(11) NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank`, `account_number`) VALUES
(1, 'Access Bank', '0030596252');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `department`, `category`, `price`) VALUES
(6, 'Accomodation', 'Gold Room', 25000),
(7, 'Restaurant', 'Grills', 0),
(8, 'Bar', 'Bar Items', 0),
(9, 'Restaurant', 'Proteins', 0),
(10, 'Restaurant', 'African Dishes', 0),
(13, 'Accomodation', 'Silver Room', 15000),
(21, 'Accomodation', 'Platinum Room', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `check_ins`
--

CREATE TABLE `check_ins` (
  `guest_id` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_address` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in_date` datetime NOT NULL,
  `check_out_date` datetime NOT NULL,
  `amount_due` int(25) NOT NULL,
  `status` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp(),
  `posted_by` int(11) NOT NULL,
  `stay_extended` int(11) NOT NULL,
  `date_extended` datetime NOT NULL,
  `extended_by` int(11) NOT NULL,
  `checked_out` datetime NOT NULL,
  `checked_out_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department`) VALUES
(1, 'Accomodation'),
(2, 'Restaurant'),
(3, 'Bar');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_price` int(255) NOT NULL,
  `sales_price` int(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_status` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `department`, `category`, `item_name`, `cost_price`, `sales_price`, `quantity`, `item_status`, `date_created`) VALUES
(1, 'Accomodation', 6, 'Gold 202', 0, 0, 0, 0, '2022-12-06 10:48:02'),
(2, 'Accomodation', 13, 'SIlver 225', 0, 0, 0, 0, '2022-12-06 10:53:54'),
(3, 'Bar', 8, 'Hennessy Vsop', 33000, 70000, 1, 0, '2022-12-06 10:59:35'),
(4, 'Bar', 8, 'Heineken', 350, 700, 21, 0, '2022-12-06 10:59:46'),
(5, 'Bar', 8, 'Goldberg', 300, 500, 40, 0, '2022-12-06 10:59:56'),
(6, 'Bar', 8, 'Medium Stout', 350, 600, 47, 0, '2022-12-06 11:01:53'),
(7, 'Bar', 8, 'Fayrouz', 200, 500, 38, 0, '2022-12-06 11:02:01'),
(8, 'Restaurant', 10, 'Ogbono Soup With Pounded Yam', 0, 2500, 0, 0, '2022-12-06 11:24:32'),
(9, 'Restaurant', 9, 'Turkey', 1500, 2000, 0, 0, '2022-12-06 11:24:44'),
(10, 'Restaurant', 9, 'Chicken', 1200, 1500, 0, 0, '2022-12-06 11:24:48'),
(11, 'Restaurant', 7, 'Cat Fish', 1800, 2500, 0, 0, '2022-12-06 11:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `guest` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `amount_due` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` int(11) NOT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp(),
  `posted_by` int(11) NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item` int(11) NOT NULL,
  `cost_price` int(255) NOT NULL,
  `sales_price` int(255) NOT NULL,
  `vendor` int(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expiration_date` date NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `invoice`, `item`, `cost_price`, `sales_price`, `vendor`, `quantity`, `expiration_date`, `posted_by`, `post_date`) VALUES
(4, '344344', 3, 33000, 65000, 2, 3, '2026-12-30', 1, '2022-12-11 10:04:15'),
(5, '344344', 4, 350, 700, 2, 30, '2025-12-30', 1, '2022-12-11 10:04:48'),
(6, '344455', 7, 200, 450, 2, 20, '2025-12-30', 1, '2022-12-11 10:20:29'),
(7, '344455', 6, 350, 600, 2, 24, '2024-12-30', 1, '2022-12-11 10:21:11'),
(8, '344455', 4, 350, 700, 2, 24, '2025-12-30', 1, '2022-12-11 10:21:44'),
(15, '343343', 5, 200, 500, 1, 1, '2024-12-30', 1, '2022-12-11 11:56:09'),
(16, '343343', 6, 350, 600, 1, 20, '2025-12-30', 1, '2022-12-11 11:56:49'),
(17, '343343', 7, 200, 450, 1, 3, '2024-12-30', 1, '2022-12-11 11:59:05'),
(27, '67676', 6, 350, 600, 1, 4, '2025-12-30', 1, '2022-12-11 12:23:19'),
(29, '310099', 5, 200, 500, 2, 2, '2025-12-30', 1, '2022-12-11 13:06:43'),
(30, '9899888', 5, 200, 500, 1, 2, '2025-12-30', 1, '2022-12-11 13:10:30'),
(34, '767676', 3, 33000, 65000, 1, 8, '2027-12-30', 1, '2022-12-12 08:48:13'),
(35, '89890', 3, 33000, 65000, 2, 5, '2025-12-31', 1, '2022-12-12 09:00:27'),
(37, '2334555', 5, 300, 500, 1, 5, '2025-12-30', 1, '2022-12-12 09:06:14'),
(41, '67676700', 7, 200, 500, 1, 10, '2025-12-30', 43, '2022-12-12 09:14:09'),
(42, '565656', 3, 33000, 70000, 1, 8, '2027-12-30', 1, '2022-12-21 10:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `sales_status` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `item`, `staff`, `invoice`, `quantity`, `price`, `total_amount`, `posted_by`, `sales_status`, `post_date`) VALUES
(91, 4, 1, 'wk00126726097', 3, 700, 2100, 1, 0, '2022-12-26 22:39:33'),
(92, 5, 2, 'wk00225342947', 1, 500, 500, 1, 0, '2022-12-26 22:42:37'),
(93, 7, 2, 'wk00277387519', 2, 500, 1000, 1, 0, '2022-12-26 22:42:53'),
(94, 4, 2, 'wk00231573472', 2, 700, 1400, 1, 0, '2022-12-28 08:52:19'),
(95, 5, 2, 'wk00235411077', 3, 500, 1500, 1, 0, '2022-12-28 08:55:25'),
(96, 8, 2, 'wk00235411077', 1, 2500, 2500, 1, 0, '2022-12-28 08:55:34'),
(99, 8, 1, 'wk00135083475', 1, 2500, 2500, 1, 0, '2022-12-28 09:03:43'),
(100, 7, 1, 'wk00135083475', 1, 500, 500, 1, 0, '2022-12-28 09:03:59'),
(101, 6, 1, 'wk00135083475', 1, 600, 600, 1, 0, '2022-12-28 09:04:09'),
(102, 4, 2, 'wk00242912708', 1, 700, 700, 1, 0, '2022-12-28 11:15:04'),
(103, 4, 1, 'wk00197743805', 2, 700, 1400, 1, 0, '2022-12-29 08:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `staff_name`, `phone_number`, `home_address`, `created`) VALUES
(1, 'Paul Ikpefua', '08035716496', '23 Sapele Road', '2022-12-12 13:23:51'),
(2, 'Jerome Boateng', '0807766609090', '24 Sapele Road', '2022-12-12 13:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `username`, `user_role`, `user_password`, `status`, `reg_date`) VALUES
(1, 'Administrator', 'Admin', 'Admin', '$2y$10$nspoGcC9jOIvGO0FKS6K/OAMiY2F0ybPzgQMlZ1VZU6SM/fjUENuy', 0, '2022-09-27 13:47:21'),
(43, 'Kelly Ikpefua', 'Onostar', 'Cashier', '$2y$10$j7T6VKMKFQ5eeMdwnBmnXeuVy.OtdJDAr1sN6VS2LcffKfpALlSUu', 0, '2022-12-06 09:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `vendor` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor`, `contact_person`, `phone`, `email_address`, `created_date`) VALUES
(1, 'Oswin Supermarket', 'Mr Oswin', '07057456881', 'oswin@mail.com', '2022-12-10 11:20:54'),
(2, 'Druccicare Pharmacy', 'Pharm Chris Oisakede', '08076765445', 'druci@mail.com', '2022-12-10 11:26:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `check_ins`
--
ALTER TABLE `check_ins`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `check_ins`
--
ALTER TABLE `check_ins`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
