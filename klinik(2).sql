-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 03:07 PM
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
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `pesakit`
--

CREATE TABLE `pesakit` (
  `nama` varchar(200) DEFAULT NULL,
  `tinggi` double DEFAULT NULL,
  `berat` double DEFAULT NULL,
  `bmi` double DEFAULT NULL,
  `blood_pressure` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `blood_type` varchar(2) DEFAULT NULL,
  `blood_sugar` varchar(50) DEFAULT NULL,
  `age` varchar(10) DEFAULT NULL,
  `ic` varchar(20) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `oxygen_level` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesakit`
--

INSERT INTO `pesakit` (`nama`, `tinggi`, `berat`, `bmi`, `blood_pressure`, `kelas`, `blood_type`, `blood_sugar`, `age`, `ic`, `phone_number`, `oxygen_level`) VALUES
('ali', 1.6, 60, 23.44, '120/60', NULL, 'A-', '2.3', '12', '025673918763', '01892735627', 98),
('john', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', '0299368928302', '01183937232', NULL),
('ABU BAKAR BIN OMAR', 1.7, 60, 20.76, '120/50', '5K', 'AB', '23', '14', '0800292129292', '01111888742', 98.4),
('kepongboss', 1.2, 70, 48.61, '120/60', '5B', 'B', '120', '12', '09872140293', '0198972666', 20),
('kepong', NULL, NULL, NULL, NULL, '', NULL, NULL, '32', '1231231231', '9883746832', NULL),
('fhbfalkjkjda', NULL, NULL, NULL, NULL, '3A', NULL, NULL, '12', '1231232131', '323123133', NULL),
('kdlk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', '1232131', '32322', NULL),
('323212', NULL, NULL, NULL, NULL, '1A', NULL, NULL, '13', '123213131', '21312313', NULL),
('fjndkfaknad', NULL, NULL, NULL, NULL, '1A', NULL, NULL, '13', '231231', '342334', NULL),
('lokeboshao', 1.42, 22, 10.91, NULL, NULL, NULL, NULL, '33', '2722830289383', '3838393332', NULL),
('jkfnkkjnf', NULL, NULL, NULL, NULL, '1A', NULL, NULL, '32', '3123123', '123123', NULL),
('3123123', NULL, NULL, NULL, NULL, '1A', NULL, NULL, '21', '323212', '3213123', NULL),
('knjaklfdnaljndflk', 0.12, 32, 2222.22, NULL, '1A', NULL, NULL, '32', '324314', '432143413', NULL),
('Rina', 0.12, 32, 2222.22, '120/34', '1A', 'AB', '23', '43', '811221015062', '0127489049', 90),
('ejknfjaf', 1.6, 54, 21.09, '90/50', '1A', 'A-', '9.2', '12', '88398', '3423423', 95),
('loke', NULL, NULL, NULL, NULL, '3G', NULL, NULL, '14', '89389282942', '0192938999', NULL),
('boss', NULL, NULL, NULL, NULL, '1A', NULL, NULL, '12', '938939', '4949483030', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pesakit`
--
ALTER TABLE `pesakit`
  ADD PRIMARY KEY (`ic`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
