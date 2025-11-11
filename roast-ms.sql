-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 05:20 PM
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
(1, '97e360af-b535-4ab1-974d-968e2056179b', 'Barista One', '2025-11-11 20:53:45', '2025-11-11 22:35:05', 1.69, '2025-11-11');

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

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `holiday_date` date NOT NULL,
  `holiday_name` varchar(255) NOT NULL,
  `holiday_type` enum('Regular','Special') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `holiday_date`, `holiday_name`, `holiday_type`) VALUES
(1, '2025-01-01', 'New Year\'s Day', 'Regular'),
(2, '2025-04-01', 'Eid\'l Fitr', 'Regular'),
(3, '2025-04-09', 'Araw ng Kagitingan', 'Regular'),
(4, '2025-04-17', 'Maundy Thursday', 'Regular'),
(5, '2025-04-18', 'Good Friday', 'Regular'),
(6, '2025-05-01', 'Labor Day', 'Regular'),
(7, '2025-06-06', 'Eidul Adha', 'Regular'),
(8, '2025-06-12', 'Independence Day', 'Regular'),
(9, '2025-08-25', 'National Heroes Day', 'Regular'),
(10, '2025-11-30', 'Bonifacio Day', 'Regular'),
(11, '2025-12-25', 'Christmas Day', 'Regular'),
(12, '2025-12-30', 'Rizal Day', 'Regular'),
(13, '2025-08-21', 'Ninoy Aquino Day', 'Special'),
(14, '2025-11-01', 'All Saints\' Day', 'Special'),
(15, '2025-12-08', 'Feast of the Immaculate Conception of Mary', 'Special'),
(16, '2025-12-31', 'Last Day of the Year', 'Special'),
(17, '2025-01-29', 'Chinese New Year', 'Special'),
(18, '2025-04-19', 'Black Saturday', 'Special'),
(19, '2025-05-12', 'National and Local Elections', 'Special'),
(20, '2025-12-24', 'Christmas Eve', 'Special'),
(21, '2025-10-31', 'All Saints\' Day Eve', 'Special');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item_id` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `quantity_in_stock` int(11) DEFAULT 0,
  `unit_of_measure` varchar(50) DEFAULT NULL,
  `cost_price` decimal(10,2) DEFAULT 0.00,
  `selling_price` decimal(10,2) DEFAULT 0.00,
  `stock_value` decimal(10,2) GENERATED ALWAYS AS (`quantity_in_stock` * `cost_price`) STORED,
  `reorder_level` int(11) DEFAULT 0,
  `status` enum('Available','Low Stock','Out of Stock') DEFAULT 'Available',
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_id`, `product_name`, `category`, `supplier`, `quantity_in_stock`, `unit_of_measure`, `cost_price`, `selling_price`, `reorder_level`, `status`, `last_updated`) VALUES
(1, 'CUP-001', 'Plastic Cups 22oz', 'Cups & Containers', 'Default Supplier', 600, 'pcs', 0.00, 0.00, 100, 'Available', '2025-11-08 00:09:04'),
(2, 'CUP-002', 'Plastic Cups 16oz', 'Cups & Containers', 'Default Supplier', 400, 'pcs', 0.00, 0.00, 100, 'Available', '2025-11-07 23:40:05'),
(3, 'CUP-003', 'Hot Coffee Cups', 'Cups & Containers', 'Default Supplier', 200, 'pcs', 0.00, 0.00, 50, 'Available', '2025-11-07 23:40:05'),
(4, 'LID-001', 'Cup Lids', 'Accessories', 'Default Supplier', 1000, 'pcs', 0.00, 0.00, 100, 'Available', '2025-11-07 23:40:05'),
(5, 'STR-001', 'Straws (100 pcs per pack)', 'Accessories', 'Default Supplier', 10, 'packs', 0.00, 0.00, 3, 'Available', '2025-11-07 23:40:05'),
(6, 'BAG-001', 'Takeout Bag (Single)', 'Packaging', 'Default Supplier', 1, 'pack', 0.00, 0.00, 2, 'Low Stock', '2025-11-07 23:40:05'),
(7, 'BAG-002', 'Takeout Bag (Double)', 'Packaging', 'Default Supplier', 1, 'pack', 0.00, 0.00, 2, 'Low Stock', '2025-11-07 23:40:05'),
(8, 'JAM-001', 'Strawberry Jam', 'Ingredients', 'Doking', 5, 'jars', 0.00, 0.00, 3, 'Available', '2025-11-07 23:40:05'),
(9, 'SYR-001', 'Strawberry Syrup Drizzle', 'Ingredients', 'Premium Bubbles', 5, 'bottles', 0.00, 0.00, 3, 'Available', '2025-11-07 23:40:05'),
(10, 'SYR-002', 'Caramel Drizzle', 'Ingredients', 'Premium Bubbles', 20, 'packs', 0.00, 0.00, 5, 'Available', '2025-11-07 23:40:05'),
(11, 'SYR-003', 'Chocolate Drizzle', 'Ingredients', 'Premium Bubbles', 20, 'packs', 0.00, 0.00, 5, 'Available', '2025-11-07 23:40:05'),
(12, 'SYR-004', 'Caramel Syrup', 'Ingredients', 'Torani', 5, 'bottles', 0.00, 0.00, 2, 'Available', '2025-11-07 23:40:05'),
(13, 'SYR-005', 'Vanilla Syrup', 'Ingredients', 'Torani', 3, 'bottles', 0.00, 0.00, 2, 'Available', '2025-11-07 23:40:05'),
(14, 'SYR-006', 'Hazelnut Syrup', 'Ingredients', 'Torani', 2, 'bottles', 0.00, 0.00, 2, 'Low Stock', '2025-11-07 23:40:05'),
(15, 'COF-001', 'Arabia Coffee Beans', 'Ingredients', 'Default Supplier', 10, 'kilos', 0.00, 0.00, 3, 'Available', '2025-11-07 23:40:05'),
(16, 'MLK-001', 'Condensed Milk (1kg)', 'Ingredients', 'Doreen', 20, 'pcs', 0.00, 0.00, 5, 'Available', '2025-11-07 23:40:05'),
(17, 'MTC-001', 'Matcha Powder', 'Ingredients', 'Injoy', 20, 'packs', 0.00, 0.00, 5, 'Available', '2025-11-07 23:40:05'),
(18, 'ORE-001', 'Crushed Oreo', 'Ingredients', 'Default Supplier', 5, 'packs', 0.00, 0.00, 3, 'Available', '2025-11-07 23:40:05'),
(19, 'MLK-002', 'Barista Milk', 'Ingredients', 'Arla', 20, 'boxes', 0.00, 0.00, 5, 'Available', '2025-11-08 22:13:07'),
(20, 'ICE-001', 'Ice', 'Daily Consumables', 'Default Supplier', 4, 'sacks', 0.00, 0.00, 2, 'Low Stock', '2025-11-08 12:12:42'),
(21, 'WTR-001', 'Mineral Water', 'Daily Consumables', 'Default Supplier', 4, 'gallons', 0.00, 0.00, 2, 'Low Stock', '2025-11-08 12:12:46');

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
(1, '2025-11-11', 'Evening', 'Barista One', 13, 1290.00, '2025-11-11 15:00:40');

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
(1, 1, 10, 6, 110.00, 660.00),
(2, 1, 17, 7, 90.00, 630.00);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`) VALUES
(1, 'Doking'),
(2, 'Premium Bubbles'),
(3, 'Torani'),
(4, 'Doreen'),
(5, 'Injoy'),
(6, 'Arla'),
(7, 'Default Supplier');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `picture` varchar(255) DEFAULT '/roast-ms/assets/images/default-150x150.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `username`, `password`, `role`, `created_at`, `picture`) VALUES
(1, '49e349af-d80e-45a8-8336-ce45deafcfc9', 'Administrator', 'admin', '$2y$10$qi29r7qJZSfmD5P/hw3HtuVdaUWmhi1Y8ZM3mu6cJFruMin6Mw.o.', 'Administrator', '2025-02-25 03:41:34', '/roast-ms/assets/images/default-150x150.png'),
(2, '97e360af-b535-4ab1-974d-968e2056179b', 'Barista One', 'barista', '$2y$10$y1GeEfjSMyf.5vlowkaicu4/MhQhNXsaHWsKgj.K3ZV0SOZofuo4q', 'Barista', '2025-02-25 03:42:52', '/roast-ms/uploads/profile_97e360af-b535-4ab1-974d-968e2056179b_1762865602.png'),
(5, 'a09601b7-e0b8-4281-829b-04040f40e099', 'Manager', 'manager', '$2y$10$9sYaX2aclWsZL/YjVeJraOKI1hU89b8VCCVYPleVm7jeHfSVSZMkK', 'Manager', '2025-11-11 13:51:13', '/roast-ms/assets/images/default-150x150.png');

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
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_id` (`item_id`);

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
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
