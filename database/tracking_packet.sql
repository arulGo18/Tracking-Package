-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2026 at 05:54 AM
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
-- Database: `tracking_packet`
--

-- --------------------------------------------------------

--
-- Table structure for table `consolidations`
--

CREATE TABLE `consolidations` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `consolidation_number` varchar(50) NOT NULL,
  `status` varchar(100) DEFAULT 'Created',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `shipment_created` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consolidations`
--

INSERT INTO `consolidations` (`id`, `seller_id`, `consolidation_number`, `status`, `created_at`, `shipment_created`) VALUES
(1, 1, 'CONS001', 'Created', '2026-06-15 05:21:45', 0),
(2, 1, 'CONS-BDI-005', 'Created', '2026-06-17 07:23:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `consolidation_details`
--

CREATE TABLE `consolidation_details` (
  `id` int(11) NOT NULL,
  `consolidation_id` int(11) NOT NULL,
  `incoming_shipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consolidation_details`
--

INSERT INTO `consolidation_details` (`id`, `consolidation_id`, `incoming_shipment_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `consolidation_orders`
--

CREATE TABLE `consolidation_orders` (
  `id` int(11) NOT NULL,
  `consolidation_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consolidation_orders`
--

INSERT INTO `consolidation_orders` (`id`, `consolidation_id`, `order_id`, `created_at`) VALUES
(1, 2, 3, '2026-06-17 07:23:20'),
(2, 2, 4, '2026-06-17 07:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `dropshippers`
--

CREATE TABLE `dropshippers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dropshippers`
--

INSERT INTO `dropshippers` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(1, 'Ilyas', 'ilyas@gmail.com', '$2y$10$4A.fH25I26PV4dkt3BWltO9NeZEMnK5r0x/8rC3/Z9OHXzm9KaEnS', '2026-06-16 06:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `dropship_orders`
--

CREATE TABLE `dropship_orders` (
  `id` int(11) NOT NULL,
  `dropshipper_id` int(11) NOT NULL,
  `supplier_name` varchar(150) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_country` varchar(100) NOT NULL,
  `customer_address` text NOT NULL,
  `tracking_number` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dropship_orders`
--

INSERT INTO `dropship_orders` (`id`, `dropshipper_id`, `supplier_name`, `product_name`, `customer_name`, `customer_country`, `customer_address`, `tracking_number`, `status`, `created_at`) VALUES
(1, 1, 'Shenzhen Electronics Ltd', 'Mouse', 'Arul', 'Indonesia', 'JALAN PEMBANGUNAN 1 NOMER 23, RT.007/003, RAWA BADAK UTARA, KOJA, JAKARTA UTARA', 'SPX348792473984', 'Customs Clearance', '2026-06-16 06:39:03'),
(2, 1, 'Guangzhou Supplier', 'Kaca', 'Gilang', 'Indonesia', 'JALAN PEMBANGUNAN 1 NOMER 23, RT.007/003, RAWA BADAK UTARA, KOJA, JAKARTA SElatan', 'SPXID03490248098532', 'Exported', '2026-06-16 16:34:06'),
(3, 1, 'Guangzhou Supplier', 'Keyboard', 'arhan', 'Indonesia', 'JALAN PEMBANGUNAN 1 NOMER 23, RT.007/003, RAWA BADAK UTARA, KOJA, JAKARTA UTARA', 'SPX930453408904535', 'In Transit', '2026-06-17 03:28:16'),
(4, 1, 'Guangzhou Supplier', 'karpet', 'ilham', 'Indonesia', 'JALAN PEMBANGUNAN 1 NOMER 23, RT.007/003, RAWA BADAK UTARA, KOJA, JAKARTA UTARA', 'SPX93480395803495', 'Delivered', '2026-06-17 03:28:31'),
(5, 1, 'Shenzhen Supplier', 'Logitech G304', 'Ahadi Nurah', 'Indonesia', 'JALAN PEMBANGUNAN 1 NOMER 23, RT.007/003, RAWA BADAK UTARA, KOJA, JAKARTA UTARA', NULL, 'Pending', '2026-06-17 14:35:37');

-- --------------------------------------------------------

--
-- Table structure for table `dropship_tracking_histories`
--

CREATE TABLE `dropship_tracking_histories` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dropship_tracking_histories`
--

INSERT INTO `dropship_tracking_histories` (`id`, `order_id`, `location`, `status`, `created_at`) VALUES
(1, 1, 'Guangzhou', 'Packed', '2026-06-16 16:23:38'),
(2, 1, 'Shenzhen Export Hub', 'Exported', '2026-06-16 16:24:01'),
(3, 1, 'Jakarta Customs', 'Customs Clearance', '2026-06-16 16:24:16'),
(4, 2, 'Hong Kong Port', 'Exported', '2026-06-16 17:08:50'),
(5, 4, 'Guangzhou', 'outgoing', '2026-06-17 03:30:09'),
(6, 4, 'Shenzhen Export Hub', 'Delivered', '2026-06-17 03:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `incoming_shipments`
--

CREATE TABLE `incoming_shipments` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `tracking_number` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incoming_shipments`
--

INSERT INTO `incoming_shipments` (`id`, `seller_id`, `supplier_id`, `tracking_number`, `status`, `created_at`) VALUES
(1, 1, 2, 'CN003', 'In Transit', '2026-06-15 04:55:54'),
(2, 1, 3, 'KN001', 'Packed', '2026-06-16 05:04:56'),
(3, 1, 2, 'TRS11045', 'Arrived Indonesia', '2026-06-16 05:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `incoming_tracking_histories`
--

CREATE TABLE `incoming_tracking_histories` (
  `id` int(11) NOT NULL,
  `incoming_shipment_id` int(11) NOT NULL,
  `location` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incoming_tracking_histories`
--

INSERT INTO `incoming_tracking_histories` (`id`, `incoming_shipment_id`, `location`, `status`, `created_at`) VALUES
(1, 1, 'Hong Kong Port', 'Created', '2026-06-15 05:03:02'),
(2, 1, 'Hong Kong Port', 'Export Clearance', '2026-06-15 05:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `product_name` varchar(150) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `address` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `shipment_created` tinyint(1) DEFAULT 0,
  `consolidated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `seller_id`, `customer_name`, `customer_email`, `product_name`, `quantity`, `address`, `status`, `created_at`, `shipment_created`, `consolidated`) VALUES
(1, 1, 'arhan', NULL, 'Kaca', 3, 'jalan jala jala', 'Packed', '2026-06-17 06:06:55', 1, 0),
(2, 1, 'bintang', NULL, 'mika', 5, 'akamsi', 'Packed', '2026-06-17 06:34:46', 1, 0),
(3, 1, 'Budi', 'budi@gmail.com', 'minyak', 2, 'laba lba', 'Pending', '2026-06-17 07:11:01', 0, 1),
(4, 1, 'Budi santo', 'budi@gmail.com', 'kardus', 3, 'JALAN PEMBANGUNAN 1 NOMER 23, RT.007/003, RAWA BADAK UTARA, KOJA, JAKARTA UTARA', 'Pending', '2026-06-17 07:11:35', 0, 1),
(5, 1, 'budi gait', 'budi@gmail.com', 'kain', 3, 'JALAN PEMBANGUNAN 1 NOMER 23, RT.007/003, RAWA BADAK UTARA, KOJA, JAKARTA UTARA', 'Pending', '2026-06-17 07:13:34', 0, 0),
(6, 1, 'Revan', 'revan@mail.com', 'laptop', 1, 'jalan walngan', 'Packed', '2026-06-17 09:28:43', 1, 0),
(7, 1, 'Jaka Kusdarwono', 'jaka@mail.com', 'paku', 2, 'JALAN PEMBANGUNAN 1 NOMER 23, RT.007/003, RAWA BADAK UTARA, KOJA, JAKARTA UTARA', 'Pending', '2026-06-17 14:31:20', 0, 0),
(8, 3, 'diah hidayat', 'diah@mail.com', 'buku', 1, 'JALAN PEMBANGUNAN 1 NOMER 23, RT.007/003, RAWA BADAK UTARA, KOJA, JAKARTA UTARA', 'Pending', '2026-06-17 15:57:12', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(50) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `consolidation_id` int(11) DEFAULT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `buyer_email` varchar(100) DEFAULT NULL,
  `shipment_type` enum('personal','consolidation','reseller') NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `tracking_number`, `seller_id`, `consolidation_id`, `buyer_name`, `buyer_email`, `shipment_type`, `status`, `created_at`) VALUES
(2, 'TRK1781497373', 1, NULL, 'Aldi', 'aldi@mail.com', 'personal', 'In Transit', '2026-06-15 04:22:53'),
(3, 'TRK1781503586', 1, 1, 'Budi Santoso', 'ilyasyasinnurulah18@gmail.com', 'consolidation', 'Created', '2026-06-15 06:06:26'),
(4, 'TRK1781586805', 1, NULL, 'Ilyas', 'iyas@mail.com', 'reseller', 'outgoing', '2026-06-16 05:13:25'),
(5, 'TRK1781673310', 1, NULL, 'gilang', 'ilyasyasinnurulah18@gmail.com', 'personal', 'Created', '2026-06-17 05:15:10'),
(6, 'TRK1781676729685', 1, NULL, 'arhan', NULL, 'personal', 'Packed', '2026-06-17 06:12:10'),
(7, 'TRK1781678099676', 1, NULL, 'bintang', NULL, 'personal', 'Packed', '2026-06-17 06:34:59'),
(8, 'TRK1781687806', 1, 2, 'Budi Santoso', 'budi@mail.com', 'consolidation', 'In Transit', '2026-06-17 09:16:46'),
(9, 'TRK1781688533248', 1, NULL, 'Revan', NULL, 'personal', 'In Transit', '2026-06-17 09:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `seller_id`, `supplier_name`, `email`, `phone`, `country`, `created_at`) VALUES
(2, 1, 'Shenzhen Electronics Ltd', 'info@shenzhen.com', '+86 123456789', 'China', '2026-06-15 04:55:06'),
(3, 1, 'Guangzhou Supplier', 'supplier@gmail.com', '08123456789', 'China', '2026-06-16 05:03:47'),
(4, 1, 'Taiwan Shop', 'thai@mail.com', '937489204239048029', 'TAIWAN', '2026-06-17 04:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `tracking_histories`
--

CREATE TABLE `tracking_histories` (
  `id` int(11) NOT NULL,
  `shipment_id` int(11) NOT NULL,
  `location` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracking_histories`
--

INSERT INTO `tracking_histories` (`id`, `shipment_id`, `location`, `status`, `created_at`) VALUES
(2, 2, 'Jakarta Hub', 'In Transit', '2026-06-15 04:23:32'),
(3, 4, 'Jakarta Warehouse', 'In Transit', '2026-06-16 05:14:07'),
(4, 4, 'Jakarta Warehouse', 'outgoing', '2026-06-16 05:15:00'),
(5, 9, 'Jakarta Warehouse', 'In Transit', '2026-06-17 09:35:34'),
(6, 8, 'badas HUB', 'In Transit', '2026-06-17 09:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('seller','reseller') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Ilyas', 'ilyas@mail.com', '$2y$10$M/LsDH7IKbeocE1Fbbn4S.9UlIJH71Ad6pSL5oPuebsgl7AKAt0nO', 'seller', '2026-06-15 03:13:59'),
(3, 'ILYAS YASIN NURULAH', 'ilyas@gmail.com', '$2y$10$KD5488YmIaMWU1DwVIULy.Eacppky7cDk2Hr/qLBAtkj/ibIyp95m', 'seller', '2026-06-17 15:44:43'),
(5, 'Arul Hidayat', 'arul@gmail.com', '$2y$10$zSIxcwv8UQnAqrBSqHdR1.5w7z6wgxExi8zXU1NBJZnuq/AQpKn2u', 'seller', '2026-06-17 15:55:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consolidations`
--
ALTER TABLE `consolidations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consolidation_number` (`consolidation_number`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `consolidation_details`
--
ALTER TABLE `consolidation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consolidation_id` (`consolidation_id`),
  ADD KEY `incoming_shipment_id` (`incoming_shipment_id`);

--
-- Indexes for table `consolidation_orders`
--
ALTER TABLE `consolidation_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dropshippers`
--
ALTER TABLE `dropshippers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `dropship_orders`
--
ALTER TABLE `dropship_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dropship_tracking_histories`
--
ALTER TABLE `dropship_tracking_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incoming_shipments`
--
ALTER TABLE `incoming_shipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_number` (`tracking_number`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `incoming_tracking_histories`
--
ALTER TABLE `incoming_tracking_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incoming_shipment_id` (`incoming_shipment_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_number` (`tracking_number`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `fk_shipment_consolidation` (`consolidation_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `tracking_histories`
--
ALTER TABLE `tracking_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment_id` (`shipment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consolidations`
--
ALTER TABLE `consolidations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `consolidation_details`
--
ALTER TABLE `consolidation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consolidation_orders`
--
ALTER TABLE `consolidation_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dropshippers`
--
ALTER TABLE `dropshippers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dropship_orders`
--
ALTER TABLE `dropship_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dropship_tracking_histories`
--
ALTER TABLE `dropship_tracking_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `incoming_shipments`
--
ALTER TABLE `incoming_shipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `incoming_tracking_histories`
--
ALTER TABLE `incoming_tracking_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tracking_histories`
--
ALTER TABLE `tracking_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consolidations`
--
ALTER TABLE `consolidations`
  ADD CONSTRAINT `consolidations_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `consolidation_details`
--
ALTER TABLE `consolidation_details`
  ADD CONSTRAINT `consolidation_details_ibfk_1` FOREIGN KEY (`consolidation_id`) REFERENCES `consolidations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `consolidation_details_ibfk_2` FOREIGN KEY (`incoming_shipment_id`) REFERENCES `incoming_shipments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `incoming_shipments`
--
ALTER TABLE `incoming_shipments`
  ADD CONSTRAINT `incoming_shipments_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `incoming_shipments_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `incoming_tracking_histories`
--
ALTER TABLE `incoming_tracking_histories`
  ADD CONSTRAINT `incoming_tracking_histories_ibfk_1` FOREIGN KEY (`incoming_shipment_id`) REFERENCES `incoming_shipments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `fk_shipment_consolidation` FOREIGN KEY (`consolidation_id`) REFERENCES `consolidations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shipments_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tracking_histories`
--
ALTER TABLE `tracking_histories`
  ADD CONSTRAINT `tracking_histories_ibfk_1` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
