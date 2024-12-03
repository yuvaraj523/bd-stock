-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 02:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quotation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_item`
--

CREATE TABLE `add_item` (
  `id` int(11) NOT NULL,
  `item_name` varchar(225) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_item`
--

INSERT INTO `add_item` (`id`, `item_name`, `price`, `stock`) VALUES
(38, 'AQUASEAL NANO - (1 LT)', 563.00, '0'),
(39, 'AQUASEAL NANO - (5 LT)', 2515.00, '0'),
(40, 'AQUASEAL NANO - (20 LT)', 9660.00, '0'),
(41, ' AQUASEAL NANO - (600ml)', 357.00, '0'),
(42, 'DAMP STOP - (1 KG)', 950.00, '0'),
(43, 'DAMP STOP - (10 KG)', 7400.00, '0'),
(44, 'DAMP STOP X  - (100 GM)', 440.00, '0'),
(45, 'DAMP STOP X - (500 GM)	', 1950.00, '0'),
(46, 'DAMP STOP X - (1 KG)	', 3400.00, '0'),
(48, 'DAMPSTOP XW - (1 kg)', 680.00, '0'),
(49, 'DAMPSTOP XW - (5 kg)', 3100.00, ''),
(50, 'DAMPSTOP XW - (20kg)', 11200.00, ''),
(51, 'AQUA SEAL 2K - (20 KG)', 3410.00, ''),
(52, 'LEAKSHIELD (WHITE) - (1 KG)', 645.00, ''),
(53, 'LEAKSHIELD (WHITE) - (5 KG)', 2980.00, ''),
(54, ' LEAKSHIELD (WHITE)	- (25 KG)', 10077.00, ''),
(55, 'LEAKSHIELD (TERACOTTA)	 - (1 KG)', 670.00, ''),
(56, 'LEAKSHIELD (TERACOTTA) - (5 KG)	', 3090.00, ''),
(57, 'LEAKSHIELD (TERACOTTA) - (25 KG)', 10407.00, ''),
(58, ' LEAKSHIELD PLUS - (20 KG)', 13980.00, ''),
(59, 'GARDENGUARD - (5 KG)', 3350.00, ''),
(60, 'GARDENGUARD -	(20 KG)	', 11850.00, ''),
(61, ' AQUASEAL TANK GUARD - (1 KG)', 1320.00, ''),
(62, 'AQUASEAL TANK GUARD -(5 KG)', 5750.00, ''),
(63, 'AQUASEAL CRYSTALLINE - (25 KG)', 3450.00, ''),
(64, 'AQUASEAL MAGIC PU - (5 Kg)', 12760.00, ''),
(65, 'BUILDING ALL ROUNDER - (1 KG)', 635.00, ''),
(66, ' BUILDING ALL ROUNDER - (5 KG)', 2875.00, ''),
(67, ' BUILDING ALL ROUNDER - (20 KG)', 9950.00, ''),
(68, 'PROTECTCOAT CT 600 - (10 KG)', 9100.00, ''),
(69, 'PROTECTCOAT BW500 -  (5 Kg)', 1400.00, ''),
(70, ' PROTECTCOAT BW500 - (20 Kg)', 3950.00, ''),
(71, 'WALLSHIELD - (5 Kg)	', 2600.00, ''),
(72, 'WALLSHIELD COLOUR	 - (5 Kg)', 2600.00, ''),
(73, 'WALLSHIELD - (20 Kg)', 9800.00, ''),
(74, 'WALLSHIELD COLOUR	- (20 Kg)', 9800.00, ''),
(75, ' AQUASEAL PLASTER - (25 Kg)', 1150.00, '0'),
(76, 'CRACKSTOP - (1 KG)', 108.00, ''),
(77, 'CRACKSTOP-X - (1 KG)', 350.00, ''),
(78, 'CRACKSTOP-X - (5 KG)', 1400.00, ''),
(79, ' CRACKSTOP-X - (25 KG)', 7000.00, ''),
(80, 'CRACKSTOP-XP - (1 KG)', 460.00, ''),
(81, 'CRACKSTOP FIBER 6MM - (125 GM)', 110.00, ''),
(82, 'CRACKSTOP FIBER 12 MM - (125 GM)', 110.00, ''),
(83, 'BD CRACKSTOP MESH 4\"(\"145 GSM X 50 MTR\")', 480.00, ''),
(84, ' CRACKSTOP MESH 6\"	(\"145 GSM X 50 MTR\")	', 610.00, ''),
(85, 'CRACKSTOP MESH 45 GSM - (1 MTR)	', 1700.00, ''),
(86, 'CRACKSTOP MESH 110 GSM - (1 MTR)	', 2400.00, ''),
(87, ' CORROSHIELD RCR - (500 ML)	', 400.00, ''),
(88, ' CORROSHIELD RCR - (300ml)	', 250.00, ''),
(89, 'CORROSHIELD RCR - (1 Lit)', 650.00, ''),
(90, 'CORROSHIELD CR - (1 KG)	', 230.00, ''),
(91, 'CORROSHIELD CR - (5 KG)	', 878.00, ''),
(92, 'CORROSHIELD CR - (20Lit)', 3400.00, ''),
(93, 'CORROSHIELD ZR - (1 KG)	', 1294.00, ''),
(94, ' CORROSHIELD BR - (1 Kg)', 490.00, ''),
(95, ' WATERSTOP SB - (10 mtr)	', 6500.00, ''),
(96, ' SEAL TAPE EJ - (25 mtr)	', 14000.00, ''),
(97, 'SEAL TAPE NW - (50 mtr)	', 9400.00, ''),
(98, 'SEAL TAPE NW - (10Mtr)	', 2350.00, ''),
(99, 'SEAL TAPE SA - (10 mtr)	', 2700.00, ''),
(100, ' SEAL TAPE SA - (1.5 mtr)	', 510.00, ''),
(101, ' CONPRO PC - (25 pcs)', 2900.00, ''),
(102, ' SHEET SEALER - (5 Mtr)	', 7800.00, ''),
(103, 'SHEET SEALER - (30 Mtr)	', 37737.00, ''),
(104, 'CONCRETE  POWER - (1 Lit	)', 207.00, ''),
(105, 'CONCRETE  POWER - (5 Lit)', 838.00, ''),
(106, 'CONCRETE  POWER - (20 Lit)	', 2970.00, ''),
(107, 'PLASTER POWER - (1 Lit)	', 215.00, ''),
(108, 'PLASTER POWER - (5 Lit)', 868.00, ''),
(109, 'PLASTER POWER	- (20 Lit)	', 3010.00, ''),
(110, 'HONEY COMB SEALER - (225 GMS)	', 140.00, ''),
(111, 'TILE CLEAN MASTER - (500 ml)	', 205.00, ''),
(112, 'TILE CLEAN MASTER - (1 Lit)	', 397.00, ''),
(113, 'PAINT REMOVER 500 - (500 ml)	', 251.00, ''),
(114, 'PAINT REMOVER 500 - (1 Lit)	', 431.00, ''),
(115, ' INSTANT STOP - (	1 KG)	', 165.00, ''),
(116, 'INSTANT STOP - (5 KG)	', 700.00, ''),
(117, ' NANGURAM NS - (5 KG)	', 300.00, ''),
(118, 'NANGURAM NS - (25 KG)	', 1045.00, ''),
(119, 'NANGURAM BP - (1 KG)	', 110.00, ''),
(120, 'NANGURAM BP - (5 KG)	', 400.00, ''),
(121, 'NANGURAM BP - (25 KG)', 1300.00, ''),
(122, ' NANGURAM MC - (25 KG)	', 1600.00, ''),
(123, ' NANGURAM ANCHOR FIX - (1 KG)	', 700.00, ''),
(124, 'NANGURAM ANCHORFIX POWER - (1 Kg)	', 2400.00, ''),
(125, 'BLOCKS POWER - (20 Lit)	', 2880.00, ''),
(126, 'FLOOR STRONGER - (25 Kg)	', 985.00, ''),
(127, ' CONCRETE BOND - (1 Kg	)', 1258.00, ''),
(128, ' MULTIPURPOSE EP - (1 kg)', 1320.00, ''),
(129, 'AQUASEAL TILE COAT - (1 KG)	', 1320.00, ''),
(130, 'PLASTER BOND  BOOSTER - (1 Lit	)', 435.00, ''),
(131, 'PLASTER BOND  BOOSTER	 - (5 Lit)	', 1925.00, ''),
(132, 'PLASTER BOND  BOOSTER - (20 Lit)	', 7200.00, ''),
(133, 'CONPRO CC - (1 Lit)	', 350.00, ''),
(134, ' CONPRO CC - (5 Lit)	', 1680.00, ''),
(135, 'CONPRO CC - (20 Lit)	', 6700.00, ''),
(136, 'CONPRO RC - (1 Lit)', 590.00, ''),
(137, 'CONPRO RC - (5 Lit)	', 2700.00, ''),
(138, 'CONPRO RC - (20 Lit )	', 8880.00, ''),
(139, ' CONPRO BR	- (80 rft)	', 580.00, ''),
(140, 'TERMITESTOP X - (1 Lit )	', 490.00, ''),
(141, 'TERMITESTOP X - (5 Lit)', 1990.00, ''),
(142, 'CONPRO E-PAD 12mm (1.3x2.5sq,mtr)(3.25 Sq.Mtr)	', 1353.00, ''),
(143, ' CONPRO E-PAD 18mm (1.3x2.5sq,mtr)(3.25 Sq.Mtr)	', 2030.00, ''),
(144, 'CONPRO E-PAD 20mm (1.3x2.5sq,mtr)(3.25 Sq.Mtr)', 2255.00, ''),
(145, 'E-PAD 25mm (1.3x2.5sq,mtr)	(3.25 Sq.Mtr)	', 2820.00, ''),
(146, 'CONPRO E-PAD 40mm (1.3x2.5sq,mtr)(3.25 Sq.Mtr)	', 4510.00, ''),
(147, ' FLOOR SHIELD -3MM (1.3X30M)	(420 Sq.Ft)	', 2940.00, ''),
(148, 'SHUTTERING SEALER - (100 SQM)	', 2800.00, ''),
(149, 'TILE FIX POWER - (25 KG)	', 660.00, ''),
(150, ' TILE FIX BOOSTER - (250 ML)	', 210.00, ''),
(151, 'TILE FIX LEVELLER CLIP - (50 nos)	', 180.00, ''),
(152, 'TILE FIX LEVELLER WAGES - (50 nos)', 200.00, ''),
(153, 'TILE FIX SPACER 2MM - (100 nos)	', 100.00, ''),
(154, 'TILE FIX SPACER 3MM - (100 nos)	', 110.00, ''),
(155, 'TILE FIX SPACER 4MM - (100 nos)	', 120.00, ''),
(156, 'TILE FIX SPACER 5MM - (100 nos)	', 130.00, ''),
(157, 'TILE FIX SPACER 6MM	- (100 nos)	', 140.00, ''),
(158, 'TILE FIX SPACER 8MM - (100 nos)	', 150.00, ''),
(159, ' TILE JOINT SEALER-LQ - (100 ML)	', 110.00, ''),
(160, 'TILE JOINT SEALER WHITE - (1 KG)	', 103.00, ''),
(161, ' TILE JOINT SEALER WHITE - (5 KG)	', 475.00, ''),
(162, 'TILE JOINT SEALER WHITE - (25 KG)	', 2240.00, ''),
(163, 'TILE JOINT SEALER PRO - (1 Kg)', 165.00, ''),
(164, 'TILE JOINT SEALER PRO - (5 Kg)', 700.00, ''),
(165, ' TILE JOINT SEALER PRO - (25 Kg)	', 3400.00, ''),
(166, 'TILE JOINT SEALER IVORY - (1 KG)	', 103.00, ''),
(167, 'TILE JOINT SEALER COLOUR - (1 Kg)', 113.00, ''),
(168, 'TILE JOINT SEALER PLUS - (1 KG)	', 1386.00, ''),
(169, 'TILE JOINT SEALER PLUS - (5 KG)	', 4600.00, ''),
(170, 'TILE JOINT SEALER PLUS  COLOUR - (1 Kg)	', 1436.00, ''),
(171, 'TILE FIX POWER BOND - (1 Lit )	', 480.00, ''),
(172, 'TILE FIX POWER BOND - (5 Lit )	', 2400.00, ''),
(173, 'TILE FIX POWER BOND - (20 Lit )	', 9200.00, ''),
(174, 'TJS CLEAR - (500 ml)	', 275.00, ''),
(175, ' SEAL PU - (600 ml	)', 787.00, ''),
(176, 'SEAL PS	- (4 KG)	', 1950.00, ''),
(177, 'SEAL AC	- (290 ml)	', 235.00, ''),
(178, 'THERMOSHIELD COAT - (5 KG)	', 3340.00, ''),
(179, 'THERMOSHIELD COAT	 -  (20 Lit)', 8100.00, ''),
(180, 'THERMOSHIELD PRIMER - (4 Lit	)	', 950.00, ''),
(181, 'THERMOSHIELD PRIMER - (20 Lit )	', 4400.00, ''),
(182, 'THERMOSHIELD PLUS - (4 Lit )	', 2060.00, ''),
(183, 'THERMOSHIELD PLUS - (20 Lit	)', 9800.00, ''),
(199, 'DAMP STOP X -  (5 KG)', 12980.00, '0');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `quotation No` varchar(100) NOT NULL,
  `quotation To` varchar(255) DEFAULT NULL,
  `mobileno` varchar(20) NOT NULL,
  `quotation Amount` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `profit` decimal(10,2) DEFAULT NULL,
  `loss` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin2`
--

CREATE TABLE `admin2` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `s_no` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(13, 'info@imayam.com', '$2y$10$DMGkpcRyI2fOm6TsllgvTue2VRortcf5UAOBD9CfZl1T9PxbmUcZO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_item`
--
ALTER TABLE `add_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin2`
--
ALTER TABLE `admin2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotation_id` (`quotation_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_item`
--
ALTER TABLE `add_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=632;

--
-- AUTO_INCREMENT for table `admin2`
--
ALTER TABLE `admin2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1187;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin2`
--
ALTER TABLE `admin2`
  ADD CONSTRAINT `admin2_ibfk_1` FOREIGN KEY (`quotation_id`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
