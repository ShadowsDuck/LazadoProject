-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 08:04 AM
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
-- Database: `lazado`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(40) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_email`, `customer_address`) VALUES
(35, 44, 4, 8490.00, 5, 42450.00, '2024-10-28 21:41:28', '2', 'aphidet phonwen', 'F_Phonwen@hotmail.com', 'Yanyao Sawankhalok Sukhothai 64110'),
(36, 44, 1, 3950.00, 1, 3950.00, '2024-10-28 21:42:03', '2', 'aphidet phonwen', 'F_Phonwen@hotmail.com', 'Yanyao Sawankhalok Sukhothai 64110'),
(37, 44, 9, 5490.00, 1, 5490.00, '2024-10-28 21:42:03', '0', 'aphidet phonwen', 'F_Phonwen@hotmail.com', 'Yanyao Sawankhalok Sukhothai 64110'),
(38, 44, 7, 7990.00, 1, 7990.00, '2024-10-28 21:42:03', '1', 'aphidet phonwen', 'F_Phonwen@hotmail.com', 'Yanyao Sawankhalok Sukhothai 64110'),
(39, 45, 10, 5990.00, 5, 29950.00, '2024-10-29 01:46:16', '2', 'Tanaphat Partoom', '', ''),
(40, 44, 1, 3690.00, 1, 3690.00, '2024-10-29 13:44:25', '1', 'aphidet phonwen', 'F_Phonwen@hotmail.com', 'Yanyao Sawankhalok Sukhothai 64110');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
