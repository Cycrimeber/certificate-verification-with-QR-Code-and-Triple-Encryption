-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 07:31 AM
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
-- Database: `qrcertificate`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `serial` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `matric_no` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `award` varchar(50) NOT NULL,
  `cert_id` varchar(11) NOT NULL,
  `qrcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`serial`, `firstname`, `lastname`, `matric_no`, `email`, `department`, `dob`, `award`, `cert_id`, `qrcode`) VALUES
(1, 'Scarlet', 'Ballard', 'bsu/11232', 'hesel@mailinator.com', 'Computer Science', '0000-00-00', 'First Class', '112342', 'temp/testNHdyNE1XMzVWWTQ9.png'),
(2, 'Phina', 'Bill', 'bsu/11231', 'hesl@mailinator.com', 'Computer Science', '0000-00-00', 'First Class', '4334453', 'temp/testL2lUYWV6Z1NXWnM9.png'),
(3, 'Deirdre', 'Vincent', 'bsu/1231209', 'kyjy@mailinator.com', 'Computer Engineering', '0000-00-00', 'Second Class', '1878480', 'temp/testOVlkTC9KYm00Ymc9.png'),
(4, 'Madeson', 'Marshall', 'uniAgric/18/112387', 'jytuhaxo@mailinator.com', 'Elect Elect', '0000-00-00', 'Second Class', '8787667', 'temp/testbGM4ZUc4Z21ndUU9.png'),
(5, 'Darrel', 'Beach', 'nacest/hnd19/6654', 'lahydufo@mailinator.com', 'Banking and Finance', '0000-00-00', 'Upper Credit', '776633', 'temp/testTWc1b1NkeUlJVVE9.png'),
(6, 'Yen', 'Cervantes', 'nacest/14/11222', 'mipima@mailinator.com', 'Computer Engineering', '0000-00-00', 'HND', '870001', 'temp/testdGZoV2k3K3NZcEk9.png'),
(7, 'Leroy', 'Rush', 'nacest/12/11222', 'bapip@mailinator.com', 'Civil Engineering', '0000-00-00', 'HND', '870881', 'temp/testTGZrekV3K3FJWlU9.png'),
(8, 'james', 'philip', 'nacest/14/11292', 'jp@gmail.com', 'Science Laboratory Technology', '0000-00-00', 'First Class', '800881', 'temp/testZEZPbnlEbzRXb2M9.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`serial`),
  ADD UNIQUE KEY `mat_no` (`matric_no`),
  ADD UNIQUE KEY `cert_id` (`cert_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
