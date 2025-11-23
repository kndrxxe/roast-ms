-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2025 at 06:08 PM
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
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `action` varchar(255) NOT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `user_id`, `username`, `action`, `table_name`, `record_id`, `old_value`, `new_value`, `ip_address`, `created_at`) VALUES
(1, 2147483647, 'Barista One', 'Clocked in', 'dtr_logs', 4, NULL, '2025-11-24 00:43:26', '::1', '2025-11-23 16:43:26'),
(2, 2147483647, 'Barista One', 'Clocked out', 'dtr_logs', 4, '2025-11-24 00:43:26', '2025-11-24 00:43:36', '::1', '2025-11-23 16:43:36'),
(3, NULL, 'Barista One', 'Updated sale #46', 'sales & sales_items', 46, '{\"sale\":{\"id\":\"46\",\"sale_date\":\"2023-01-15\",\"shift\":\"Morning\",\"barista\":\"Barista One\",\"total_quantity\":\"8\",\"total_amount\":\"880.00\",\"created_at\":\"2025-11-21 00:31:32\"},\"items\":[{\"id\":\"125\",\"sale_id\":\"46\",\"product_id\":\"10\",\"quantity\":\"8\",\"unit_price\":\"110.00\",\"total\":\"880.00\"}]}', '{\"sale\":{\"sale_date\":\"2023-01-15\",\"shift\":\"Morning\",\"barista\":\"Barista One\",\"total_quantity\":10,\"total_amount\":1100},\"items\":[{\"product_id\":\"10\",\"quantity\":10,\"unit_price\":110,\"total\":1100}]}', '::1', '2025-11-23 16:45:37'),
(4, 2147483647, 'Barista One', 'Updated profile picture', 'users', 2147483647, '/roast-ms/uploads/profile_97e360af-b535-4ab1-974d-968e2056179b_1763916458.png', '/roast-ms/uploads/profile_97e360af-b535-4ab1-974d-968e2056179b_1763916582.png', '::1', '2025-11-23 16:49:42');

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
(1, '97e360af-b535-4ab1-974d-968e2056179b', 'Barista One', '2025-11-11 20:53:45', '2025-11-11 22:35:05', 1.69, '2025-11-11'),
(2, '97e360af-b535-4ab1-974d-968e2056179b', 'Barista One', '2025-11-12 00:28:25', '2025-11-12 00:28:28', 0.00, '2025-11-12'),
(3, 'a7c77dfd-7e24-4ea0-8946-785c4c7ae58a', 'Barista Two', '2025-11-21 00:59:31', '2025-11-21 00:59:33', 0.00, '2025-11-21'),
(4, '97e360af-b535-4ab1-974d-968e2056179b', 'Barista One', '2025-11-24 00:43:26', '2025-11-24 00:43:36', 0.00, '2025-11-24');

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
(5, 1, 'Kendrix Brosas', 'brosaskndrx05@gmail.com', 'Masarap', '2025-11-20 05:42:34'),
(6, 5, 'Kendrix Brosas', 'brosaskndrx05@gmail.com', 'hindi siya masarap.', '2025-11-20 05:44:06'),
(7, 4, 'Kendrix Brosas', 'brosaskndrx05@gmail.com', 'masarap', '2025-11-20 06:19:36'),
(8, 1, 'Kendrix Brosas', 'brosaskndrx05@gmail.com', 'hindi masarap', '2025-11-23 15:44:43');

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
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_id`, `product_name`, `category`, `supplier`, `quantity_in_stock`, `unit_of_measure`, `cost_price`, `selling_price`, `reorder_level`, `last_updated`) VALUES
(1, 'CUP-001', 'Plastic Cups 22oz', 'Cups & Containers', 'Default Supplier', 600, 'pcs', 0.00, 0.00, 100, '2025-11-08 00:09:04'),
(2, 'CUP-002', 'Plastic Cups 16oz', 'Cups & Containers', 'Default Supplier', 300, 'pcs', 0.00, 0.00, 100, '2025-11-24 00:25:11'),
(3, 'CUP-003', 'Hot Coffee Cups', 'Cups & Containers', 'Default Supplier', 200, 'pcs', 0.00, 0.00, 50, '2025-11-07 23:40:05'),
(4, 'LID-001', 'Cup Lids', 'Accessories', 'Default Supplier', 1000, 'pcs', 0.00, 0.00, 100, '2025-11-07 23:40:05'),
(5, 'STR-001', 'Straws (100 pcs per pack)', 'Accessories', 'Default Supplier', 10, 'packs', 0.00, 0.00, 3, '2025-11-07 23:40:05'),
(6, 'BAG-001', 'Takeout Bag (Single)', 'Packaging', 'Default Supplier', 26, 'pack', 0.00, 0.00, 2, '2025-11-23 23:30:36'),
(7, 'BAG-002', 'Takeout Bag (Double)', 'Packaging', 'Default Supplier', 28, 'pack', 0.00, 0.00, 2, '2025-11-23 23:30:54'),
(8, 'JAM-001', 'Strawberry Jam', 'Ingredients', 'Doking', 5, 'jars', 0.00, 0.00, 3, '2025-11-07 23:40:05'),
(9, 'SYR-001', 'Strawberry Syrup Drizzle', 'Ingredients', 'Premium Bubbles', 5, 'bottles', 0.00, 0.00, 3, '2025-11-07 23:40:05'),
(10, 'SYR-002', 'Caramel Drizzle', 'Ingredients', 'Premium Bubbles', 20, 'packs', 0.00, 0.00, 5, '2025-11-07 23:40:05'),
(11, 'SYR-003', 'Chocolate Drizzle', 'Ingredients', 'Premium Bubbles', 20, 'packs', 0.00, 0.00, 5, '2025-11-07 23:40:05'),
(12, 'SYR-004', 'Caramel Syrup', 'Ingredients', 'Torani', 5, 'bottles', 0.00, 0.00, 2, '2025-11-07 23:40:05'),
(13, 'SYR-005', 'Vanilla Syrup', 'Ingredients', 'Torani', 3, 'bottles', 0.00, 0.00, 2, '2025-11-07 23:40:05'),
(14, 'SYR-006', 'Hazelnut Syrup', 'Ingredients', 'Torani', 5, 'bottles', 0.00, 0.00, 2, '2025-11-24 00:21:51'),
(15, 'COF-001', 'Arabia Coffee Beans', 'Ingredients', 'Default Supplier', 10, 'kilos', 0.00, 0.00, 3, '2025-11-07 23:40:05'),
(16, 'MLK-001', 'Condensed Milk (1kg)', 'Ingredients', 'Doreen', 20, 'pcs', 0.00, 0.00, 5, '2025-11-07 23:40:05'),
(17, 'MTC-001', 'Matcha Powder', 'Ingredients', 'Injoy', 20, 'packs', 0.00, 0.00, 5, '2025-11-07 23:40:05'),
(18, 'ORE-001', 'Crushed Oreo', 'Ingredients', 'Default Supplier', 5, 'packs', 0.00, 0.00, 3, '2025-11-07 23:40:05'),
(19, 'MLK-002', 'Barista Milk', 'Ingredients', 'Arla', 20, 'boxes', 0.00, 0.00, 5, '2025-11-08 22:13:07'),
(20, 'ICE-001', 'Ice', 'Daily Consumables', 'Default Supplier', 130, 'sacks', 0.00, 0.00, 130, '2025-11-23 23:21:49'),
(21, 'WTR-001', 'Mineral Water', 'Daily Consumables', 'Default Supplier', 0, 'gallons', 0.00, 0.00, 50, '2025-11-23 23:34:27');

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
(1, '2023-03-12', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:31:32'),
(2, '2024-07-05', 'Afternoon', 'Barista Two', 6, 540.00, '2025-11-20 16:31:32'),
(3, '2025-01-20', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:31:32'),
(4, '2023-11-15', 'Morning', 'Barista One', 4, 360.00, '2025-11-20 16:31:32'),
(5, '2024-05-22', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:31:32'),
(6, '2025-08-30', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:31:32'),
(7, '2023-02-17', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:31:32'),
(8, '2024-09-03', 'Afternoon', 'Barista Two', 6, 540.00, '2025-11-20 16:31:32'),
(9, '2025-04-10', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:31:32'),
(10, '2023-06-25', 'Morning', 'Barista One', 4, 360.00, '2025-11-20 16:31:32'),
(11, '2024-12-19', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:31:32'),
(12, '2025-03-08', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:31:32'),
(13, '2023-08-14', 'Morning', 'Barista One', 7, 630.00, '2025-11-20 16:31:32'),
(14, '2024-02-27', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:31:32'),
(15, '2025-06-05', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:31:32'),
(16, '2023-01-30', 'Morning', 'Barista One', 4, 360.00, '2025-11-20 16:31:32'),
(17, '2024-10-11', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:31:32'),
(18, '2025-07-21', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:31:32'),
(19, '2023-09-09', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:31:32'),
(20, '2024-04-15', 'Afternoon', 'Barista Two', 6, 540.00, '2025-11-20 16:31:32'),
(21, '2023-05-12', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:31:32'),
(22, '2024-06-01', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:31:32'),
(23, '2025-03-18', 'Afternoon', 'Barista Two', 6, 540.00, '2025-11-20 16:31:32'),
(24, '2023-07-22', 'Evening', 'Barista Three', 4, 360.00, '2025-11-20 16:31:32'),
(25, '2024-08-10', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:31:32'),
(26, '2025-02-14', 'Afternoon', 'Barista Two', 6, 540.00, '2025-11-20 16:31:32'),
(27, '2023-12-05', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:31:32'),
(28, '2024-01-20', 'Morning', 'Barista One', 4, 360.00, '2025-11-20 16:31:32'),
(29, '2025-09-15', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:31:32'),
(30, '2023-10-18', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:31:32'),
(31, '2023-04-03', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:31:32'),
(32, '2024-11-11', 'Afternoon', 'Barista Two', 6, 540.00, '2025-11-20 16:31:32'),
(33, '2025-05-23', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:31:32'),
(34, '2023-02-28', 'Morning', 'Barista One', 10, 900.00, '2025-11-20 16:31:32'),
(35, '2024-03-17', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:31:32'),
(36, '2025-12-01', 'Evening', 'Barista Three', 6, 660.00, '2025-11-20 16:31:32'),
(37, '2023-06-09', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:31:32'),
(38, '2024-09-27', 'Afternoon', 'Barista Two', 6, 540.00, '2025-11-20 16:31:32'),
(39, '2025-01-11', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:31:32'),
(40, '2023-08-30', 'Morning', 'Barista One', 4, 360.00, '2025-11-20 16:31:32'),
(41, '2024-05-05', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:31:32'),
(42, '2025-07-08', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:31:32'),
(43, '2023-11-21', 'Morning', 'Barista One', 7, 630.00, '2025-11-20 16:31:32'),
(44, '2024-12-25', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:31:32'),
(45, '2025-06-30', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:31:32'),
(46, '2023-01-15', 'Morning', 'Barista One', 10, 1100.00, '2025-11-20 16:31:32'),
(47, '2024-04-28', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:31:32'),
(48, '2025-09-05', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:31:32'),
(49, '2023-03-07', 'Morning', 'Barista One', 6, 660.00, '2025-11-20 16:31:32'),
(50, '2024-07-18', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:31:32'),
(51, '2023-04-20', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:39:27'),
(52, '2024-05-15', 'Afternoon', 'Barista Two', 6, 540.00, '2025-11-20 16:39:27'),
(53, '2025-06-10', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:39:27'),
(54, '2023-07-22', 'Morning', 'Barista One', 4, 360.00, '2025-11-20 16:39:27'),
(55, '2024-08-05', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:39:27'),
(56, '2025-09-18', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:39:27'),
(57, '2023-10-30', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:39:27'),
(58, '2024-11-11', 'Afternoon', 'Barista Two', 6, 540.00, '2025-11-20 16:39:27'),
(59, '2025-12-07', 'Evening', 'Barista Three', 1, 110.00, '2025-11-20 16:39:27'),
(60, '2023-03-05', 'Morning', 'Barista One', 4, 360.00, '2025-11-20 16:39:27'),
(61, '2024-01-25', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:39:27'),
(62, '2025-02-16', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:39:27'),
(63, '2023-05-12', 'Morning', 'Barista One', 7, 630.00, '2025-11-20 16:39:27'),
(64, '2024-06-03', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:39:27'),
(65, '2025-07-09', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:39:27'),
(66, '2023-08-21', 'Morning', 'Barista One', 4, 360.00, '2025-11-20 16:39:27'),
(67, '2024-09-14', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:39:27'),
(68, '2025-10-27', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:39:27'),
(69, '2023-12-05', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:39:27'),
(70, '2024-02-18', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:39:27'),
(71, '2023-04-20', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:40:45'),
(72, '2024-05-15', 'Afternoon', 'Barista Two', 6, 540.00, '2025-11-20 16:40:45'),
(73, '2025-06-10', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:40:45'),
(74, '2023-07-22', 'Morning', 'Barista One', 4, 360.00, '2025-11-20 16:40:45'),
(75, '2024-08-05', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:40:45'),
(76, '2025-09-18', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:40:45'),
(77, '2023-10-30', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:40:45'),
(78, '2024-11-11', 'Afternoon', 'Barista Two', 6, 540.00, '2025-11-20 16:40:45'),
(79, '2025-12-07', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:40:45'),
(80, '2023-03-05', 'Morning', 'Barista One', 4, 360.00, '2025-11-20 16:40:45'),
(81, '2024-01-25', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:40:45'),
(82, '2025-02-16', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:40:45'),
(83, '2023-05-12', 'Morning', 'Barista One', 7, 630.00, '2025-11-20 16:40:45'),
(84, '2024-06-03', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:40:45'),
(85, '2025-07-09', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:40:45'),
(86, '2023-08-21', 'Morning', 'Barista One', 4, 360.00, '2025-11-20 16:40:45'),
(87, '2024-09-14', 'Afternoon', 'Barista Two', 5, 450.00, '2025-11-20 16:40:45'),
(88, '2025-10-27', 'Evening', 'Barista Three', 6, 540.00, '2025-11-20 16:40:45'),
(89, '2023-12-05', 'Morning', 'Barista One', 5, 450.00, '2025-11-20 16:40:45'),
(90, '2024-02-18', 'Evening', 'Barista Three', 7, 630.00, '2025-11-20 16:40:45');

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
(1, 1, 7, 3, 90.00, 270.00),
(2, 1, 24, 2, 90.00, 180.00),
(3, 2, 7, 2, 90.00, 180.00),
(4, 2, 24, 3, 90.00, 270.00),
(5, 3, 7, 3, 90.00, 270.00),
(6, 3, 24, 2, 90.00, 180.00),
(7, 3, 5, 2, 90.00, 180.00),
(8, 4, 7, 2, 90.00, 180.00),
(9, 4, 24, 2, 90.00, 180.00),
(10, 5, 7, 3, 90.00, 270.00),
(11, 5, 24, 2, 90.00, 180.00),
(12, 6, 7, 2, 90.00, 180.00),
(13, 6, 24, 3, 90.00, 270.00),
(14, 7, 7, 3, 90.00, 270.00),
(15, 7, 24, 2, 90.00, 180.00),
(16, 8, 7, 2, 90.00, 180.00),
(17, 8, 24, 3, 90.00, 270.00),
(18, 9, 7, 3, 90.00, 270.00),
(19, 9, 24, 2, 90.00, 180.00),
(20, 9, 5, 1, 90.00, 90.00),
(21, 10, 7, 2, 90.00, 180.00),
(22, 10, 24, 2, 90.00, 180.00),
(23, 11, 7, 3, 90.00, 270.00),
(24, 11, 24, 2, 90.00, 180.00),
(25, 12, 7, 2, 90.00, 180.00),
(26, 12, 24, 3, 90.00, 270.00),
(27, 13, 7, 3, 90.00, 270.00),
(28, 13, 24, 2, 90.00, 180.00),
(29, 13, 5, 2, 90.00, 180.00),
(30, 14, 7, 2, 90.00, 180.00),
(31, 14, 24, 2, 90.00, 180.00),
(32, 15, 7, 3, 90.00, 270.00),
(33, 15, 24, 2, 90.00, 180.00),
(34, 16, 7, 2, 90.00, 180.00),
(35, 16, 24, 3, 90.00, 270.00),
(36, 17, 7, 3, 90.00, 270.00),
(37, 17, 24, 2, 90.00, 180.00),
(38, 18, 7, 2, 90.00, 180.00),
(39, 18, 24, 3, 90.00, 270.00),
(40, 19, 7, 3, 90.00, 270.00),
(41, 19, 24, 2, 90.00, 180.00),
(42, 19, 5, 2, 90.00, 180.00),
(43, 20, 7, 2, 90.00, 180.00),
(44, 20, 24, 2, 90.00, 180.00),
(45, 21, 7, 3, 90.00, 270.00),
(46, 21, 24, 2, 90.00, 180.00),
(47, 22, 7, 2, 90.00, 180.00),
(48, 22, 24, 3, 90.00, 270.00),
(49, 23, 7, 3, 90.00, 270.00),
(50, 23, 24, 2, 90.00, 180.00),
(51, 23, 5, 2, 90.00, 180.00),
(52, 24, 7, 2, 90.00, 180.00),
(53, 24, 24, 2, 90.00, 180.00),
(54, 25, 7, 3, 90.00, 270.00),
(55, 25, 24, 2, 90.00, 180.00),
(56, 26, 7, 2, 90.00, 180.00),
(57, 26, 24, 3, 90.00, 270.00),
(58, 27, 7, 3, 90.00, 270.00),
(59, 27, 24, 2, 90.00, 180.00),
(60, 27, 5, 2, 90.00, 180.00),
(61, 28, 7, 2, 90.00, 180.00),
(62, 28, 24, 2, 90.00, 180.00),
(63, 29, 7, 3, 90.00, 270.00),
(64, 29, 24, 2, 90.00, 180.00),
(65, 30, 7, 2, 90.00, 180.00),
(66, 30, 24, 3, 90.00, 270.00),
(67, 31, 7, 3, 90.00, 270.00),
(68, 31, 24, 2, 90.00, 180.00),
(69, 32, 7, 2, 90.00, 180.00),
(70, 32, 24, 3, 90.00, 270.00),
(72, 36, 41, 6, 110.00, 660.00),
(77, 71, 7, 3, 90.00, 270.00),
(78, 71, 24, 2, 90.00, 180.00),
(79, 72, 7, 2, 90.00, 180.00),
(80, 72, 24, 3, 90.00, 270.00),
(81, 73, 7, 3, 90.00, 270.00),
(82, 73, 24, 2, 90.00, 180.00),
(83, 73, 5, 2, 90.00, 180.00),
(84, 74, 7, 2, 90.00, 180.00),
(85, 74, 24, 2, 90.00, 180.00),
(86, 75, 7, 3, 90.00, 270.00),
(87, 75, 24, 2, 90.00, 180.00),
(88, 76, 7, 2, 90.00, 180.00),
(89, 76, 24, 3, 90.00, 270.00),
(90, 77, 7, 3, 90.00, 270.00),
(91, 77, 24, 2, 90.00, 180.00),
(92, 78, 7, 2, 90.00, 180.00),
(93, 78, 24, 3, 90.00, 270.00),
(94, 79, 7, 3, 90.00, 270.00),
(95, 79, 24, 2, 90.00, 180.00),
(96, 79, 5, 2, 90.00, 180.00),
(97, 80, 7, 2, 90.00, 180.00),
(98, 80, 24, 2, 90.00, 180.00),
(99, 81, 7, 3, 90.00, 270.00),
(100, 81, 24, 2, 90.00, 180.00),
(101, 82, 7, 2, 90.00, 180.00),
(102, 82, 24, 3, 90.00, 270.00),
(103, 83, 7, 3, 90.00, 270.00),
(104, 83, 24, 2, 90.00, 180.00),
(105, 83, 5, 2, 90.00, 180.00),
(106, 84, 7, 2, 90.00, 180.00),
(107, 84, 24, 2, 90.00, 180.00),
(108, 85, 7, 3, 90.00, 270.00),
(109, 85, 24, 2, 90.00, 180.00),
(110, 86, 7, 2, 90.00, 180.00),
(111, 86, 24, 3, 90.00, 270.00),
(112, 87, 7, 3, 90.00, 270.00),
(113, 87, 24, 2, 90.00, 180.00),
(114, 88, 7, 2, 90.00, 180.00),
(115, 88, 24, 3, 90.00, 270.00),
(116, 89, 7, 3, 90.00, 270.00),
(117, 89, 24, 2, 90.00, 180.00),
(118, 89, 5, 2, 90.00, 180.00),
(119, 90, 7, 2, 90.00, 180.00),
(120, 90, 24, 2, 90.00, 180.00),
(121, 59, 30, 1, 110.00, 110.00),
(122, 49, 24, 6, 110.00, 660.00),
(124, 34, 17, 10, 90.00, 900.00),
(126, 46, 10, 10, 110.00, 1100.00);

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
(2, '97e360af-b535-4ab1-974d-968e2056179b', 'Barista One', 'barista', '$2y$10$y1GeEfjSMyf.5vlowkaicu4/MhQhNXsaHWsKgj.K3ZV0SOZofuo4q', 'Barista', '2025-02-25 03:42:52', '/roast-ms/uploads/profile_97e360af-b535-4ab1-974d-968e2056179b_1763916582.png'),
(5, 'a09601b7-e0b8-4281-829b-04040f40e099', 'Manager', 'manager', '$2y$10$9sYaX2aclWsZL/YjVeJraOKI1hU89b8VCCVYPleVm7jeHfSVSZMkK', 'Manager', '2025-11-11 13:51:13', '/roast-ms/assets/images/default-150x150.png'),
(6, 'a7c77dfd-7e24-4ea0-8946-785c4c7ae58a', 'Barista Two', 'baristatwo', '$2y$10$/yg5iHCgJvey/DgdoI0hsuyi0gbnrLjifmJKxZ6wmUQPDwqVsjWh2', 'Barista', '2025-11-20 16:58:10', '/roast-ms/assets/images/default-150x150.png'),
(7, '4c49a036-d4b8-4349-866e-1fe48ed92239', 'Barista Three', 'baristathree', '$2y$10$GiNKFOQnqxcxftuSOGyUd.X4pLm70JnWmDdJHAcuTL6dRaExaXqTa', 'Barista', '2025-11-20 16:58:38', '/roast-ms/assets/images/default-150x150.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dtr_logs`
--
ALTER TABLE `dtr_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD CONSTRAINT `fk_sale` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_items_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
