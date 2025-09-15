-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2025 at 06:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roast-ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `dtr_logs`
--

CREATE TABLE `dtr_logs` (
  `id` int(11) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `total_hours` decimal(5,2) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dtr_logs`
--

INSERT INTO `dtr_logs` (`id`, `user_id`, `name`, `time_in`, `time_out`, `total_hours`, `date`) VALUES
(2, '97e360af-b535-4ab1-974d-968e2056179b', 'Barista One', '2025-05-14 00:31:27', '2025-05-13 18:32:05', 5.98, '2025-05-14'),
(3, '97e360af-b535-4ab1-974d-968e2056179b', 'Barista One', '2025-06-01 20:51:10', '2025-06-01 15:21:00', 5.50, '2025-06-01'),
(4, '97e360af-b535-4ab1-974d-968e2056179b', 'Barista One', '2025-08-18 20:57:26', '2025-08-18 14:57:35', 5.98, '2025-08-18'),
(5, '97e360af-b535-4ab1-974d-968e2056179b', 'Barista One', '2025-08-26 22:02:22', '2025-08-26 16:03:19', 5.98, '2025-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `rating`, `name`, `email`, `comment`, `created_at`) VALUES
(1, 4, 'Kendrix Brosas', 'brosaskndrx05@gmail.com', 'masarap', '2025-09-09 02:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `size`, `price`) VALUES
(1, 'Coffee', 'Americano', '16oz', 90.00),
(2, 'Coffee', 'Americano', '22oz', 110.00),
(3, 'Coffee', 'Cappuccino', '16oz', 90.00),
(4, 'Coffee', 'Cappuccino', '22oz', 110.00),
(5, 'Coffee', 'White Mocha', '16oz', 90.00),
(6, 'Coffee', 'White Mocha', '22oz', 110.00),
(7, 'Coffee', 'Toffee Latte', '16oz', 90.00),
(8, 'Coffee', 'Toffee Latte', '22oz', 110.00),
(9, 'Coffee', 'Vanilla Latte', '16oz', 90.00),
(10, 'Coffee', 'Vanilla Latte', '22oz', 110.00),
(11, 'Coffee', 'Spanish Latte', '16oz', 90.00),
(12, 'Coffee', 'Spanish Latte', '22oz', 110.00),
(13, 'Coffee', 'Hazelnut Latte', '16oz', 90.00),
(14, 'Coffee', 'Hazelnut Latte', '22oz', 110.00),
(15, 'Coffee', 'Caramel Macchiato', '16oz', 90.00),
(16, 'Coffee', 'Caramel Macchiato', '22oz', 110.00),
(17, 'Coffee', 'White Chocolate Mocha', '16oz', 90.00),
(18, 'Coffee', 'White Chocolate Mocha', '22oz', 110.00),
(19, 'Non-Coffee', 'Classic Chocolate', '16oz', 90.00),
(20, 'Non-Coffee', 'Classic Chocolate', '22oz', 110.00),
(21, 'Non-Coffee', 'Strawberry Latte', '16oz', 90.00),
(22, 'Non-Coffee', 'Strawberry Latte', '22oz', 110.00),
(23, 'Non-Coffee', 'Matcha Latte', '16oz', 90.00),
(24, 'Non-Coffee', 'Matcha Latte', '22oz', 110.00),
(25, 'Matcha Series', 'Dirty Matcha', '16oz', 90.00),
(26, 'Matcha Series', 'Dirty Matcha', '22oz', 110.00),
(27, 'Matcha Series', 'Chocolate Matcha', '16oz', 90.00),
(28, 'Matcha Series', 'Chocolate Matcha', '22oz', 110.00),
(29, 'Matcha Series', 'Oreo Matcha', '16oz', 90.00),
(30, 'Matcha Series', 'Oreo Matcha', '22oz', 110.00),
(31, 'Matcha Series', 'Strawberry Matcha', '16oz', 90.00),
(32, 'Matcha Series', 'Strawberry Matcha', '22oz', 110.00),
(33, 'Matcha Series', 'Caramel Matcha', '16oz', 90.00),
(34, 'Matcha Series', 'Caramel Matcha', '22oz', 110.00),
(35, 'Frappe', 'Creamy Oreo', '16oz', 110.00),
(36, 'Frappe', 'Creamy Oreo', '22oz', 130.00),
(37, 'Frappe', 'Java Chip', '16oz', 110.00),
(38, 'Frappe', 'Java Chip', '22oz', 130.00),
(39, 'Frappe', 'Chocolate', '16oz', 110.00),
(40, 'Frappe', 'Chocolate', '22oz', 130.00),
(41, 'Frappe', 'Strawberry', '16oz', 110.00),
(42, 'Frappe', 'Strawberry', '22oz', 130.00),
(43, 'Frappe', 'Caramel Macchiato', '16oz', 110.00),
(44, 'Frappe', 'Caramel Macchiato', '22oz', 130.00),
(45, 'Snacks', 'Fries', 'Regular', 100.00),
(46, 'Snacks', 'Nachos', 'Regular', 120.00);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Manager'),
(3, 'Accountant'),
(4, 'Barista');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `shift` varchar(20) NOT NULL,
  `barista` varchar(100) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `sale_date`, `shift`, `barista`, `total_quantity`, `total_amount`, `created_at`) VALUES
(1, '2025-09-15', 'Morning', 'Administrator', 6, 680.00, '2025-09-15 13:44:28'),
(2, '2025-09-15', 'Morning', 'Administrator', 6, 690.00, '2025-09-15 15:04:59'),
(3, '2025-09-15', 'Evening', 'Administrator', 1, 110.00, '2025-09-15 16:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_items`
--

INSERT INTO `sales_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `total`) VALUES
(16, 1, 7, 2, 90.00, 180.00),
(17, 1, 36, 3, 130.00, 390.00),
(18, 1, 41, 1, 110.00, 110.00),
(25, 2, 46, 3, 120.00, 360.00),
(26, 2, 26, 3, 110.00, 330.00),
(31, 3, 8, 1, 110.00, 110.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` char(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Administrator','Manager','Barista') NOT NULL DEFAULT 'Barista',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `username`, `password`, `role`, `created_at`) VALUES
(1, '49e349af-d80e-45a8-8336-ce45deafcfc9', 'Administrator', 'admin', '$2y$10$qi29r7qJZSfmD5P/hw3HtuVdaUWmhi1Y8ZM3mu6cJFruMin6Mw.o.', 'Administrator', '2025-02-25 03:41:34'),
(2, '97e360af-b535-4ab1-974d-968e2056179b', 'Barista One', 'barista', '$2y$10$.c3aVFs/.dpn4BsozGJAnO7dYXWkbAI0CrPecS/XuhV2Pa9jDDEPi', 'Barista', '2025-02-25 03:42:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dtr_logs`
--
ALTER TABLE `dtr_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dtr_logs`
--
ALTER TABLE `dtr_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD CONSTRAINT `sales_items_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
