-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 12:55 PM
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(255) NOT NULL,
  `category` int(2) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `img`, `category`, `featured`, `active`) VALUES
(1, 'MONITOR (จอมอนิเตอร์) LG ULTRAGEAR 24GS50F-B - 23.7 VA FHD 180Hz', 'Brands	LG\r\nDisplay Size (in.)	24\"\r\nPanel Size (in.)	23.7\" VA\r\nResolution	1920 x 1080\r\nResolution Type	FHD\r\nDisplay color	16.7 Million 8 bits (6bits+FRC)\r\nBrightness	\r\n200 cd/m² (Min)\r\n250 cd/m² (Typ.)\r\nContrast ratio	\r\n3000 : 1 (Typ.)\r\n1800 : 1 (Min.)\r\nResponse Time	\r\n1ms (MBR)\r\n5ms (GtG at Faster)\r\nAspect Ratio	16 : 9\r\nRefresh Rate	180Hz\r\nScreen Curvature	Flat screen\r\nPixel Pitch (H x V)	0.2739 x 0.2739 mm\r\nViewing Angle (CR≧10)	178° (H) / 178° (V)\r\nColor Gamut	NTSC : 72% (CIE1931) (Typ)\r\nHDR Support	HDR10\r\nAdaptive Sync	AMD FreeSync™\r\nDisplay Surface	Anti-Glare\r\nFlicker free	Yes\r\nLow Blue Light	Yes\r\nConnectivity	\r\n1 x DisplayPort™ 1.4\r\n2 x HDMI™ 2.0\r\nBuilt-in Speaker	No\r\nPower Consumption	\r\nPower Input : 100-240 V 50/60Hz\r\nDC Output : 19V 1.3A\r\nPower Type : External Power Adaptor\r\nConsumption (DC Off) : 0.3 Watt\r\nConsumption (Sleep Mode) : 0.5 Watt\r\nConsumption (typical) : 15.7 Watt\r\nConsumption (max) : 16 Watt\r\nConsumption (Energy Star) : 18 Watt\r\nMechanical	\r\nDisplay Position Adjustments : Tilt\r\nWall Mountable : 100x100mm\r\nDimension (W x H x D)	539.5 x 414.2 x 195.6 mm\r\nWeight (Esti.)	\r\nNet Weight without stand : 2.9 kg\r\nNet Weight with stand : 3.5 kg\r\nNet Weight with Packaging : 5.3 kg\r\nColor	BLACK\r\nWarranty	3 Years', 3890.00, '', 4, '', ''),
(2, 'MOUSE (เมาส์) PULSAR X2 MINI WIRELESS WHITE (PX202S)', 'Dimensions W x D x H	116 x 61 x37 mm\r\nClick life span	N/A\r\nScroll Whell	YES\r\nNumber of buttons	5 buttons\r\nInterface	2.4GHz Wireless\r\nSensor Resolution	26,000 DPI\r\nSensor technology	PAW 3395\r\nWireless technology	2.4GHz Wireless Techology\r\nColor	WHITE\r\nWarranty	2 Years', 2390.00, '', 2, '', ''),
(3, 'KEYBOARD (คีย์บอร์ด) LOGITECH G PRO X TKL LIGHTSPEED WIRELESS (TACTILE) (BLACK) (EN/TH)', '', 6590.00, '', 1, '', ''),
(4, 'GAMING CHAIR (เก้าอี้เกมมิ่ง) COOLER MASTER CALIBER X2 STREET FIGHTER 6 (CHUNLI)', 'Brand	COOLER MASTER\r\nMaterial	PU Leather\r\nType	Gaming Chair\r\nWeight	24.7 kg\r\nColor	CHUN-LI\r\nWarranty	2 Years', 8490.00, '', 5, '', ''),
(5, 'HEADSET (หูฟัง) STEELSERIES ARCTIS 1 WIRELESS (BLACK) (2Y)', 'Brand	STEELSERIES\r\nColor	BLACK\r\nConnector	\r\n4-pole 3.5 mm.\r\n2.4 GHz lossless\r\nDriver Unit	40mm.\r\nFrequency Response	20Hz ~ 20000 Hz.\r\nSensitivity	98 db\r\nInput Impedance	32 Ohms\r\nMic. Frequency Response	100Hz - 6500Hz\r\nMic. Sensitivity	-38dBV/Pa\r\nWarranty	2 Years', 2990.00, '', 3, '', ''),
(6, 'HEADSET (หูฟัง) STEELSERIES ARCTIS 7+ WIRELESS (BLACK) (2Y)', 'Brand	STEELSERIES\r\nColor	BLACK\r\nConnector	\r\n4-pole 3.5 mm.\r\n2.4 GHz lossless\r\nDriver Unit	40mm.\r\nFrequency Response	20Hz ~ 20000 Hz.\r\nSensitivity	98 db\r\nInput Impedance	32 Ohms\r\nMic. Frequency Response	100Hz - 6500Hz\r\nMic. Sensitivity	-38 dB\r\nWarranty	2 Years', 4490.00, '', 3, '', ''),
(7, 'MONITOR (จอมอนิเตอร์) BENQ ZOWIE XL2411K - 24 TN FHD 144Hz', 'Brands	BENQ\r\nDisplay Size (in.)	24\"\r\nPanel Type	TN\r\nPanel Size (in.)	24\"\r\nResolution	1920 x 1080\r\nResolution Type	FHD\r\nBrightness	320 cd/m²\r\nContrast ratio	1000 : 1\r\nResponse Time	1ms\r\nAspect Ratio	16 : 9\r\nRefresh Rate	144Hz\r\nScreen Curvature	Flat screen\r\nViewing Angle (CR≧10)	178° (H) / 178° (V)\r\nFlicker free	Yes\r\nLow Blue Light	Yes\r\nConnectivity	\r\n2 x HDMI™\r\n1 x DisplayPort™\r\n1 x 3.5mm Audio Out\r\nPower Consumption	45 Watt\r\nDimension (W x H x D)	517 - 362 x 576 x 209 mm\r\nWeight (Esti.)	10 kg\r\nColor	BLACK\r\nWarranty	3 Years', 7190.00, '', 4, '', ''),
(8, 'KEYBOARD (คีย์บอร์ด) NEOLUTION E-SPORT THUNDER (BLUE SWITCH) (EN/TH)', 'Brand	NEOLUTION\r\nSwitch Name	BLUE SWITCH\r\nConnectivity	USB\r\nLighting	RGB\r\nLocalization	EN/TH\r\nDimension	310 x 100 x 40 mm.\r\nWeight.	0.600 Kg\r\nType	MECHANICAL KEYBOARD\r\nWIRED/WIRELESS	WIRED\r\nWarranty	2 Years', 1990.00, '', 1, '', ''),
(9, 'MOUSE (เมาส์) GLORIOUS MODEL O 2 PRO 4K/8KHz EDITION WIRELESS (BLACK)', 'Dimensions W x D x H	128 x 67 x 62 mm\r\nClick life span	100 MILLION\r\nScroll Whell	YES\r\nNumber of buttons	6 buttons\r\nBattery Life	80 hours\r\nBattery Type	N/A\r\nInterface	\r\nWIRED\r\n2.4GHz Wireless\r\nSensor Resolution	26,000 DPI\r\nSensor technology	BAMF 2.0\r\nWireless technology	Wireless 2.4G\r\nColor	BLACK\r\nWarranty	2 Years', 5490.00, '', 2, '', ''),
(10, 'CAPTURE CARD (อุปกรณ์จับภาพหน้าจอ) AVERMEDIA LIVE GAMER EXTREME 3 GC551G2', 'อินเทอร์เฟซ: USB 3.2 (Gen 1) Type-C (plug and play, UVC)\r\nช่องอินพุตวิดีโอ: HDMI 2.0\r\nช่องเอาต์พุตวิดีโอ (ส่งผ่านสัญญาณ): HDMI 2.0\r\nช่องอินพุตเสียง: HDMI 2.0 / สายสัญญาณเสียงอินพุต 3.5 มม. (แบบ 3-Pole)\r\nช่องอินพุตเสียง (ส่งผ่านสัญญาณ): HDMI 2.0 / สายสัญญาณเสียงเอาต์พุต 3.5 มม. (แบบ 3-Pole)\r\nความละเอียดสูงสุดของ HDR Pass-Through: 2160p60 / 1440p120 / 1080p240\r\nความละเอียดสูงสุดของ VRR Pass-Through: 1440p120 / 1080p120\r\nความละเอียดที่รองรับ (อินพุตวิดีโอ): 2160p, 1440p, 1080p, 1080i, 720p, 576p, 480p\r\nความละเอียดในการจับภาพสูงสุด: 2160p30 / 1440p60 / 1080p60\r\nขนาด (กว้าง x ยาว xสูง) 112.5 x 66.1 x 20.9 มม. (4.43 x 2.6 x 0.82 นิ้ว)\r\nน้ำหนัก: 85 ก. (3 ออนซ์)', 7590.00, '', 6, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
