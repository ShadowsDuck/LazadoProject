-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 08:05 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fullname`, `address`, `usertype`) VALUES
(40, 'admin', '$2y$10$iV81cDBCOwQRSTizg5rD/Oitignye3a2n/HUrT/QpUgcU50PID/wq', 'boombasuagr1141@gmail.com', 'aphidet phonwen', 'Yanyao Sawankhalok Sukhothai 64110', 'admin'),
(44, 'user', '$2y$10$8kUBVULJPMaG65qktplSt.p2ABleRFk.RuiKH91QmNiGmFvZ429Pa', 'F_Phonwen@hotmail.com', 'aphidet phonwen', 'Yanyao Sawankhalok Sukhothai 64110', 'user'),
(45, 'admin1', '$2y$10$u8glVbXCs5sUx0wAbED.veMRYKMMx2T1Tu1Vv/vJnN8veTIXtxojy', '', 'Tanaphat Partoom', NULL, 'admin'),
(46, 'admin2', '$2y$10$XAY0.XCmoktuOx4hBcuU6.OaUH4V5sypUSDPxi4252HXXHSiVPyHG', '', 'Ratchanon Ar-sasri', NULL, 'admin'),
(47, 'admin3', '$2y$10$i/OdoY9yeYyT5LK5cEUGL.ufl6q6I3rTDly8L7aK4gh0FtsMMSjpi', '', 'Sawatcharat Lamdap', NULL, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
