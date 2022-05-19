-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2021 at 11:09 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_estate`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `bill_id` int(11) NOT NULL,
  `phone` text NOT NULL,
  `apartment` text NOT NULL,
  `house` text NOT NULL,
  `rent` text NOT NULL,
  `water` text NOT NULL,
  `garbage` text NOT NULL,
  `month` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shortCode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bill_id`, `phone`, `apartment`, `house`, `rent`, `water`, `garbage`, `month`, `time`, `shortCode`) VALUES
(7, '0720797382', 'Miracle', 'H2', '10000', '420', '200', '2021-12', '2021-12-17 07:06:20', '600983'),
(16, '0722334455', 'Elite', 'H2', '12000', '200', '200', '2021-11', '2021-12-14 15:48:03', '600984'),
(20, '070000001', 'Roimen', 'H1', '7000', '200', '100', '2021-11', '2021-12-15 07:19:38', '600982'),
(22, '0799776655', 'Roimen', 'H2', '400', '210', '11', '2021-12', '2021-12-17 06:25:33', '600982'),
(23, '071029001', 'Elite', 'H1', '10000', '200', '150', '2021-10', '2021-12-17 07:10:29', '600984'),
(25, '0721552991', 'Miracle', 'H1', '9000', '200', '110', '2021-12', '2021-12-17 08:07:21', '600983'),
(26, '0720797382', 'Miracle', 'H2', '10000', '300', '200', '2021-12', '2021-12-14 17:28:59', '600983'),
(27, '0722334455', 'Elite', 'H2', '6000', '200', '200', '2021-12', '2021-12-15 09:13:24', '600984'),
(28, '070000001', 'Roimen', 'H1', '7000', '210', '110', '2021-12', '2021-12-17 07:32:20', '600982'),
(30, '071029001', 'Elite', 'H1', '8000', '250', '150', '2021-12', '2021-12-15 09:13:49', '600984'),
(31, '0720797382', 'Miracle', 'H2', '10', '40', '20', '2021-11', '2021-12-17 06:35:02', '600983'),
(33, '0707357072', 'Miracle', 'H1', '8000', '310', '200', '2021-11', '2021-12-17 06:51:37', '600983'),
(41, '070000001', 'Elite', 'H3', '7000', '100', '50', '2021-12', '2021-12-17 07:33:14', '600984');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `house_id` int(11) NOT NULL,
  `number` text NOT NULL,
  `type` text NOT NULL,
  `apartment` text NOT NULL,
  `rent` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`house_id`, `number`, `type`, `apartment`, `rent`, `status`) VALUES
(2, 'H1', 'Bedsitter', 'Miracle', '8000', 'Vacant'),
(4, 'H2', 'Bedsitter', 'Miracle', '10000', 'Occupied'),
(5, 'H1', 'Four Bedroom', 'Elite', '45000', 'Occupied'),
(6, 'H2', 'One Bedroom', 'Elite', '12000', 'Vacant'),
(10, 'H1', 'One Bedroom', 'Roimen', '10000', 'Occupied'),
(11, 'H2', 'Single room', 'Roimen', '7000', 'Occupied'),
(13, 'H3', 'Single room', 'Elite', '7000', 'Occupied'),
(14, 'H3', 'Single room', 'Roimen', '7000', 'Occupied');

-- --------------------------------------------------------

--
-- Table structure for table `mpesa`
--

CREATE TABLE `mpesa` (
  `TransNID` int(11) NOT NULL,
  `TransType` text NOT NULL,
  `TransID` text NOT NULL,
  `TransTime` text NOT NULL,
  `TransAmount` text NOT NULL,
  `BusinessShortCode` text NOT NULL,
  `BillRefNumber` text NOT NULL,
  `InvoiceNumber` text NOT NULL,
  `OrgAccBalance` text NOT NULL,
  `ThirdPartyTransID` text NOT NULL,
  `MSISDN` text NOT NULL,
  `FirstName` text NOT NULL,
  `MiddleName` text NOT NULL,
  `LastName` text NOT NULL,
  `monthMPESA` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mpesa`
--

INSERT INTO `mpesa` (`TransNID`, `TransType`, `TransID`, `TransTime`, `TransAmount`, `BusinessShortCode`, `BillRefNumber`, `InvoiceNumber`, `OrgAccBalance`, `ThirdPartyTransID`, `MSISDN`, `FirstName`, `MiddleName`, `LastName`, `monthMPESA`) VALUES
(2, 'Pay Bill', 'PL291I7UX5', '20211202025903', '9000.00', '600984', 'H2', '', '129345.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-12'),
(3, 'Pay Bill', 'PL291I7UX6', '20211202025950', '11000.00', '600983', 'H2', '', '129445.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-12'),
(4, 'Pay Bill', 'PL281I7UX8', '20211202034434', '4000.00', '600982', 'H1', '', '129335.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-12'),
(5, 'Pay Bill', 'PL291I7UX7', '20211202025950', '5000.00', '600983', 'H1', '', '129445.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-12'),
(7, 'Pay Bill', 'PL291I7UX5', '20211202025903', '2000.00', '600984', 'H1', '', '129345.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-12'),
(8, 'Pay Bill', 'PL281I7UX8', '20211202034434', '6000.00', '600982', 'H2', '', '129335.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-12'),
(10, 'Pay Bill', 'PL291I7UX5', '20211202025903', '10000.00', '600984', 'H2', '', '129345.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-11'),
(11, 'Pay Bill', 'PL291I7UX5', '20211202025903', '3000.00', '600984', 'H1', '', '129345.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-11'),
(12, 'Pay Bill', 'PL291I7UX6', '20211202025950', '11000.00', '600983', 'H2', '', '129445.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-11'),
(13, 'Pay Bill', 'PL291I7UX7', '20211202025950', '5000.00', '600983', 'H1', '', '129445.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-11'),
(14, 'Pay Bill', 'PL281I7UX8', '20211202034434', '5000.00', '600982', 'H1', '', '129335.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-11'),
(16, 'Pay Bill', 'PL291I7UX7', '20211202025950', '3000.00', '600983', 'H1', '', '129445.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-11'),
(17, 'Pay Bill', 'PL291I7UX6', '20211202025950', '10.00', '600983', 'H2', '', '129445.00', '', '254708374149', 'John', 'J.', 'Doe', '2021-11');

-- --------------------------------------------------------

--
-- Table structure for table `payement`
--

CREATE TABLE `payement` (
  `id` int(11) NOT NULL,
  `apartment` text NOT NULL,
  `house` text NOT NULL,
  `amount` text NOT NULL,
  `month` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `location` text NOT NULL,
  `units` text NOT NULL,
  `owners_name` text NOT NULL,
  `owners_number` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shortCode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `name`, `location`, `units`, `owners_name`, `owners_number`, `date`, `shortCode`) VALUES
(2, 'Roimen', 'Kitale', '10', 'Chep', '0707357072', '2021-12-12 07:34:58', '600982'),
(5, 'Miracle', 'Nairobi, Rongai', '13', 'Carlos', '0707357072', '2021-12-12 07:54:22', '600983'),
(6, 'Elite', 'Nairobi', '30', 'Kinuthia', '0740826478', '2021-12-12 07:35:29', '600984');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenant_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `house_number` text NOT NULL,
  `apartment` text NOT NULL,
  `year` text NOT NULL,
  `status` text NOT NULL,
  `last_billed_month` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`tenant_id`, `name`, `phone`, `email`, `house_number`, `apartment`, `year`, `status`, `last_billed_month`) VALUES
(1, 'benson ndiwa', '0707357072', 'bnkimtai@gmail.com', 'H1', 'Miracle', 'January,2021', 'Residing', '2021-11'),
(2, 'Kezline', '0707357072', 'kezkeisy@gmail.com', 'H1', 'Elite', 'Nov, 2021', 'Residing', '2021-10'),
(3, 'Lee Mutai', '070000001', 'gakinya@gmail.com', 'H2', 'Elite', 'Nov, 2021', 'Residing', '2021-12'),
(4, 'Eliud Kipkoech', '0727215178', 'eliud@gmail.com', 'H2', 'Miracle', 'Feb, 2020', 'Residing', '2021-11'),
(5, 'John David', '070000001', 'bnkimtai@gmail.com', 'H1', 'Roimen', 'Nov, 2021', 'Residing', '2021-12'),
(6, 'Agnes Moraa', '070000001', 'gakinya@gmail.com', 'H2', 'Roimen', 'Nov, 2021', 'Residing', '2021-12'),
(7, 'Mike', '070000001', 'bnkimtai@gmail.com', 'H3', 'Elite', 'Feb, 2020', 'Residing', '2021-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `first_name` text NOT NULL,
  `surname` text NOT NULL,
  `phone` text NOT NULL,
  `role` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `first_name`, `surname`, `phone`, `role`, `password`) VALUES
(1, 'bnkimtai@gmail.com', 'ben', 'ndiwa', '07070357072', 'admin', '12345'),
(2, 'kezkeisy@gmail.com', 'kez', 'keisy', '074082645', 'user', '54321'),
(4, 'alex@gmail.com', 'alex', 'njuguna', '0700342', 'user', '12345'),
(5, 'abu@gmail.com', 'abu', 'ndiwa', '0707357072', 'user', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`house_id`);

--
-- Indexes for table `mpesa`
--
ALTER TABLE `mpesa`
  ADD PRIMARY KEY (`TransNID`);

--
-- Indexes for table `payement`
--
ALTER TABLE `payement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `house_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mpesa`
--
ALTER TABLE `mpesa`
  MODIFY `TransNID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payement`
--
ALTER TABLE `payement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
