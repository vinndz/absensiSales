-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2025 at 12:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `manPowerId` varchar(50) NOT NULL,
  `manPowerName` varchar(50) NOT NULL,
  `dealerCode` varchar(50) NOT NULL,
  `dealerName` varchar(50) NOT NULL,
  `dealerGroupName` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `manPowerId`, `manPowerName`, `dealerCode`, `dealerName`, `dealerGroupName`, `image`, `created_at`, `updated_at`) VALUES
(1, 'MP001', 'John Doe', 'DC001', 'Super Cars Dealer', 'Putera Group', '', '2025-09-04 15:49:44', '2025-09-04 15:49:44'),
(2, 'MP002', 'Jane Smith', 'DC002', 'Best Motors', 'Deta Group', '', '2025-09-04 15:49:44', '2025-09-04 15:49:44'),
(3, 'MP003', 'Mike Johnson', 'DC003', 'AutoWorld', 'Victory Group', '', '2025-09-04 15:49:44', '2025-09-04 15:49:44'),
(4, 'MP004', 'Emily Davis', 'DC004', 'City Car Sales', 'Pelita Group', '', '2025-09-04 15:49:44', '2025-09-04 15:49:44'),
(5, 'MP005', 'Daniel Wilson', 'DC005', 'Prime Auto', 'Sumber Mas Group', '', '2025-09-04 15:49:44', '2025-09-04 15:49:44'),
(6, 'MP006', 'Sophia Brown', 'DC006', 'Speedy Motors', 'Putera Group', '', '2025-09-04 15:49:44', '2025-09-04 15:49:44'),
(7, 'MP007', 'James Taylor', 'DC007', 'Luxury Cars', 'Deta Group', '', '2025-09-04 15:49:44', '2025-09-04 15:49:44'),
(8, 'MP008', 'Olivia Miller', 'DC008', 'Top Gear Auto', 'Victory Group', '', '2025-09-04 15:49:44', '2025-09-04 15:49:44'),
(9, 'MP009', 'David Anderson', 'DC009', 'Fast Track Autos', 'Pelita Group', '', '2025-09-04 15:49:44', '2025-09-04 15:49:44'),
(10, 'MP010', 'Isabella Thomas', 'DC010', 'Auto Galaxy', 'Sumber Mas Group', '', '2025-09-04 15:49:44', '2025-09-04 15:49:44'),
(11, 'a', 'b', 'c', 'd', 'Flagship', 'images/kW5rnax0E5QerudQoSGq09QOl1NiLuMnLtoCJwnn.png', '2025-09-04 15:57:51', '2025-09-04 15:57:51'),
(12, 'TEST123', 'JEREMY', 'JJ1234', 'DEALER Y', 'YAMAHA', 'images/uBBcum010ccMonPgwbdVpDQXZ8scpJl39cufrCzI.jpg', '2025-09-06 11:42:56', '2025-09-06 11:42:56'),
(13, 'K1234', 'Kevin', 'D1234', 'TESTING', 'TEST', 'images/nirUd04iu9LWP14dP3BhV8royrnDNibn1p5I5bAM.jpg', '2025-09-06 15:07:28', '2025-09-06 15:07:28'),
(14, 'T1234', 'R234', 'TESTING', 'A', '2', 'images/5OWVBekxygRs4Yk7lTXUmNwCsGSXt6LC2AUvpcV1.jpg', '2025-09-06 15:15:20', '2025-09-06 15:15:20'),
(15, '1', '2', '3', '4', '5', 'images/8UmHtGTrL40GYUlwQfpEDNp9SL0AIScBnRJA6918.jpg', '2025-09-06 15:18:33', '2025-09-06 15:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `sales_attendance`
--

CREATE TABLE `sales_attendance` (
  `id` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  `checkIn` datetime NOT NULL,
  `checkOut` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales_attendance`
--

INSERT INTO `sales_attendance` (`id`, `employeeId`, `checkIn`, `checkOut`) VALUES
(1, 1, '2025-09-06 10:29:39', NULL),
(2, 2, '2025-09-06 11:17:01', NULL),
(3, 12, '2025-09-06 13:23:27', NULL),
(4, 4, '2025-09-06 13:24:31', NULL),
(5, 10, '2025-09-06 13:27:14', NULL),
(6, 9, '2025-09-06 13:31:47', NULL),
(7, 8, '2025-09-06 14:50:38', NULL),
(8, 15, '2025-09-06 15:20:19', NULL),
(9, 15, '2025-09-06 15:20:22', NULL),
(10, 15, '2025-09-06 15:22:11', NULL),
(11, 15, '2025-09-06 15:22:20', NULL),
(12, 1, '2025-09-06 15:33:43', NULL),
(13, 1, '2025-09-06 16:16:13', NULL),
(14, 1, '2025-09-06 16:16:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_dealer`
--

CREATE TABLE `schedule_dealer` (
  `id` int(11) NOT NULL,
  `dealerGroupName` varchar(50) NOT NULL,
  `total` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_attendance`
--
ALTER TABLE `sales_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_dealer`
--
ALTER TABLE `schedule_dealer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sales_attendance`
--
ALTER TABLE `sales_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `schedule_dealer`
--
ALTER TABLE `schedule_dealer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
