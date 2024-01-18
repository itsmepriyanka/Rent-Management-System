-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 11:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalhouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`) VALUES
(2, 'priyanka kharel', 'priyanka', 'priyanka123@gmail.co', 'Priyank@123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `house_id` int(30) NOT NULL,
  `booking_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `tenant_id`, `house_id`, `booking_date`) VALUES
(2, 11, 22, '2023-10-11 13:03:47');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(30) NOT NULL,
  `house_no` varchar(50) NOT NULL,
  `category_id` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `availability` tinyint(1) DEFAULT 1,
  `electricity` tinyint(1) DEFAULT NULL,
  `drinking_water` tinyint(1) DEFAULT NULL,
  `parking` tinyint(1) DEFAULT NULL,
  `internet` tinyint(1) DEFAULT NULL,
  `security` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `house_no`, `category_id`, `description`, `price`, `location`, `longitude`, `latitude`, `image`, `availability`, `electricity`, `drinking_water`, `parking`, `internet`, `security`) VALUES
(21, '001', '12', '1BHK', 22000, 'Patan Dhoka', 85.3214, 27.6791, '', 0, 0, NULL, NULL, NULL, NULL),
(22, '002', '16', '4BHK', 55000, 'Patan Dhoka', 85.3214, 27.6791, 0x696d616765732f6f6e65322e6a7067, 0, NULL, NULL, NULL, NULL, NULL),
(25, '555', '18', '', 85000, 'BEDHJEWBF', 83.1225, 27.1135, 0x696d616765732f362e362e706e67, 1, NULL, NULL, NULL, NULL, NULL),
(26, '111', '16', '', 56, 'jhamsekhel', 0, 788787, 0x696d616765732f362e322e706e67, 1, NULL, NULL, NULL, NULL, NULL),
(28, '222', '16', '', 22000, 'Patan Dhoka', 85.3666, 27.6915, 0x696d616765732f6361726f7573656c2e706e67, 1, 1, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `house_categories`
--

CREATE TABLE `house_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `house_categories`
--

INSERT INTO `house_categories` (`id`, `name`) VALUES
(12, 'single'),
(16, 'duplex');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `tenant_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `invoice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `tenant_id`, `amount`, `date_created`, `invoice`) VALUES
(2, 1, 2300, '2023-10-05 00:00:00', 23432),
(6, 11, 1200, '2023-10-12 00:00:00', 123),
(7, 11, 2200, '2023-10-11 00:00:00', 25);

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `house_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 0= inactive',
  `date_in` date NOT NULL,
  `id_type` varchar(100) NOT NULL,
  `id_photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `name`, `email`, `password`, `contact`, `address`, `house_id`, `status`, `date_in`, `id_type`, `id_photo`) VALUES
(1, 'priyanka kharel', 'krishmakharel2016@gmail.com', '123456P#', '9822222222', 'mnrhf', 0, 1, '0000-00-00', 'Citizenship', '6.1.png'),
(2, 'rejina thapa', 'rejina@gmail.com', 'Rejin@123', '9800000000', 'manamaiju', 0, 1, '0000-00-00', 'Driving Licence', 'tenant_photos/Screenshot (22).png'),
(7, 'shruti', 'shruti@gmail.com', '12345S#', '9800000000', 'baneshwor', 0, 1, '0000-00-00', 'Driving Licence', 'tenant_photos/6.2.png'),
(9, 'reshma', 'reshma@gmail.com', 'Reashm@123', '9800000000', 'manamaiju', 0, 1, '0000-00-00', 'Citizenship', 'tenant_photos/6.7.png'),
(11, 'user', 'user@gmail.com', 'user123', '9800000000', 'baneshwor', 0, 1, '0000-00-00', 'Citizenship', 'tenant_photos/Screenshot (135).png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `house_id` (`house_id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `house_no` (`house_no`);

--
-- Indexes for table `house_categories`
--
ALTER TABLE `house_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice` (`invoice`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `house_categories`
--
ALTER TABLE `house_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
