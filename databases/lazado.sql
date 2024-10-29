-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 08:00 AM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `qty`) VALUES
(10, 40, 3, 1),
(14, 35, 5, 1),
(120, 37, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(2) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Keyboard'),
(2, 'Mouse'),
(3, 'Headset'),
(4, 'Monitor'),
(5, 'Chair'),
(6, 'Streaming');

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

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` varchar(1) NOT NULL DEFAULT '0',
  `discounted_price` decimal(10,2) NOT NULL,
  `category` int(2) NOT NULL,
  `available` varchar(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `discount`, `discounted_price`, `category`, `available`, `created_at`, `file_name`) VALUES
(1, 'MONITOR (จอมอนิเตอร์) LG ULTRAGEAR 24GS50F-B - 23.7 VA FHD 180Hz', 'Brands	LG\r\nDisplay Size (in.)	24', 3950.00, '1', 3690.00, 4, '1', '2024-10-26 08:23:56', 'MONITOR (จอมอนิเตอร์) LG ULTRAGEAR 24GS50F-B - 23.7 VA FHD 180Hz.jpg'),
(2, 'WIRELESS MOUSE (เมาส์ไร้สาย) PULSAR X2 WIRELESS MINI (PX202S) WHITE', 'Dimensions W x D x H	116 x 61 x37 mm\r\nClick life span	N/A\r\nScroll Whell	YES\r\nNumber of buttons	5 buttons\r\nInterface	2.4GHz Wireless\r\nSensor Resolution	26,000 DPI\r\nSensor technology	PAW 3395\r\nWireless technology	2.4GHz Wireless Techology\r\nColor	WHITE\r\nWarranty	2 Years', 3990.00, '1', 2990.00, 2, '0', '2024-10-26 08:23:56', 'WIRELESS MOUSE (เมาส์ไร้สาย) PULSAR X2 WIRELESS MINI (PX202S) WHITE.png'),
(4, 'GAMING CHAIR (เก้าอี้เกมมิ่ง) COOLER MASTER CALIBER X2 STREET FIGHTER 6 (CHUNLI)', 'Brand	COOLER MASTER\r\nMaterial	PU Leather\r\nType	Gaming Chair\r\nWeight	24.7 kg\r\nColor	CHUN-LI\r\nWarranty	2 Years', 8490.00, '0', 0.00, 5, '1', '2024-10-26 08:23:56', 'GAMING CHAIR (เก้าอี้เกมมิ่ง) COOLER MASTER CALIBER X2 STREET FIGHTER 6 (CHUNLI).png'),
(5, 'HEADSET (หูฟัง) STEELSERIES ARCTIS 1 WIRELESS (BLACK)', 'รายละเอียดสินค้าโดยย่อ\r\n• Headset Response : 20 Hz - 20000 Hz\r\n• Mic Response : 100 Hz - 6500 Hz', 4290.00, '0', 0.00, 3, '0', '2024-10-26 08:23:56', 'HEADSET (หูฟัง) STEELSERIES ARCTIS 1 WIRELESS (BLACK).jpg'),
(6, 'WIRELESS HEADSET (หูฟังไร้สาย) STEELSERIES ARCTIS 7+ (BLACK)', 'รายละเอียดสินค้าโดยย่อ\r\n• Headset Response : 20 Hz - 20000 Hz\r\n• Mic Response : 100 Hz - 6500 Hz', 7990.00, '1', 7490.00, 3, '1', '2024-10-26 08:23:56', 'WIRELESS HEADSET (หูฟังไร้สาย) STEELSERIES ARCTIS 7+ (BLACK).png'),
(7, 'MONITOR (จอมอนิเตอร์) BENQ ZOWIE XL2411K - 24 INCH TN FHD 144Hz', 'รายละเอียดสินค้าโดยย่อ\r\n• Color gamut : 98% sRGB\r\n• Color Support : 16.7 Million\r\n• Response Time : 1 ms(GTG)\r\n• Brightness : 320 Nits\r\n• Aspect Ratio : 16:9\r\n• DyAc™ Technology', 7990.00, '0', 0.00, 4, '1', '2024-10-26 08:23:56', 'MONITOR (จอมอนิเตอร์) BENQ ZOWIE XL2411K - 24 INCH TN FHD 144Hz.png'),
(8, 'WIRELESS KEYBOARD (คีย์บอร์ดไร้สาย) NEOLUTION E-SPORT THUNDER (BLACK) (BLUE SWITCH - RGB - EN/TH)', 'รายละเอียดสินค้าโดยย่อ\r\n• Blue Switch (Clicky)\r\n• RGB LED\r\n• English / Thai Keycap\r\n• ANSI\r\n• Wired USB (Detachable USB-C to USB-A)\r\n• Bluetooth', 1590.00, '0', 0.00, 1, '1', '2024-10-26 08:23:56', 'WIRELESS KEYBOARD (คีย์บอร์ดไร้สาย) NEOLUTION E-SPORT THUNDER (BLACK) (BLUE SWITCH - RGB - EN-TH).jpg'),
(9, 'WIRELESS MOUSE (เมาส์ไร้สาย) GLORIOUS MODEL O 2 PRO WIRELESS 4K/8KHz EDITION (BLACK)', 'รายละเอียดสินค้าโดยย่อ\r\n• Up to 26,000 DPI\r\n• 2.4GHz Wireless / Wired\r\n• BAMF 2.0 26K Sensor\r\n• Polling Rate 8,000 Hz (Wired)\r\n• Glorious Optical Switches\r\n• Switch Lifecycle 100M Clicks\r\n• Speed 650 IPS\r\n• Acceleration 50 G\r\n• Programmable Buttons 6\r\n• Windows / MacOS / Linux', 5490.00, '0', 0.00, 2, '1', '2024-10-26 08:23:56', 'WIRELESS MOUSE (เมาส์ไร้สาย) GLORIOUS MODEL O 2 PRO WIRELESS 4K-8KHz EDITION (BLACK).jpg'),
(10, 'VIDEO CAPTURE DEVICE (อุปกรณ์จับภาพหน้าจอ) AVERMEDIA LIVE GAMER EXTREME 3 (GC551G2)', 'รายละเอียดสินค้าโดยย่อ\r\n• การบันทึกแบบ 4Kp30\r\n• ปรับอัตรารีเฟรชได้อย่างอิสระ\r\n• สตรีมหลายช่องทางด้วย RECentral\r\n• เวลาหน่วงแบบต่ำเป็นพิเศษ', 6190.00, '1', 5990.00, 6, '1', '2024-10-26 08:23:56', 'VIDEO CAPTURE DEVICE (อุปกรณ์จับภาพหน้าจอ) AVERMEDIA LIVE GAMER EXTREME 3 (GC551G2).jpg'),
(62, 'WIRELESS MOUSE (เมาส์ไร้สาย) RAZER VIPER V3 PRO - BLACK', 'รายละเอียดสินค้าโดยย่อ\r\n\r\n• Up to 35,000 DPI\r\n• Razer HyperSpeed Wireless, Wired connection\r\n• Focus Pro 35K Optical Sensor Gen-2\r\n• Programmable Button 6\r\n• Speed 750 IPS\r\n• Acceleration 70 G\r\n• Optical Mouse Switches Gen-3\r\n• Switch Lifecycle 90-million Clicks', 5290.00, '0', 0.00, 2, '1', '2024-10-27 03:26:30', 'WIRELESS MOUSE (เมาส์ไร้สาย) RAZER VIPER V3 PRO - BLACK.png'),
(63, 'WIRELESS KEYBOARD (คีย์บอร์ดไร้สาย) LOGITECH G PRO X TKL (BLACK) (LOGITECH GX BROWN SWITCH - LIGHTSY', 'รายละเอียดสินค้าโดยย่อ\r\n\r\n• Logitech GX Brown Switch (Tactile)\r\n• Lightsync RGB\r\n• English / Thai Keycap\r\n• ANSI\r\n• Wired (Detachable USB-C to USB-A)\r\n• Lightspeed Wireless (USB Receiver Included)\r\n• Bluetooth', 6490.00, '0', 0.00, 1, '1', '2024-10-27 03:32:54', 'WIRELESS KEYBOARD (คีย์บอร์ดไร้สาย) LOGITECH G PRO X TKL (BLACK) (LOGITECH GX BROWN SWITCH - LIGHTSY.png'),
(79, 'WIRELESS HEADSET (หูฟังไร้สาย) HYPERX CLOUD MINI (BLACK)', 'รายละเอียดสินค้าโดยย่อ\r\n• ระดับเสียงต่ำกว่า 85dB\r\n• คุณภาพเสียงที่เต็มอิ่ม\r\n• ไมโครโฟนบูมความทนทานสูงแบบพับเก็บได้\r\n• น้ำหนักเบาสบาย', 1890.00, '0', 0.00, 3, '1', '2024-10-27 12:20:31', 'WIRELESS HEADSET (หูฟังไร้สาย) HYPERX CLOUD MINI (BLACK).png');

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
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
