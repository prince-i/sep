-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2021 at 10:50 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sep_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(14) NOT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `position`) VALUES
(1, 'Associate'),
(2, 'Jr. Staff'),
(3, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(14) NOT NULL,
  `deptCode` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `deptCode`, `section_name`) VALUES
(1, 'PROD', 'Section 1'),
(2, 'PROD', 'Section 2'),
(3, 'PROD', 'Section 3'),
(4, 'PROD', 'Section 4'),
(5, 'PROD', 'Section 5'),
(6, 'PROD', 'Section 6');

-- --------------------------------------------------------

--
-- Table structure for table `sep_request`
--

CREATE TABLE `sep_request` (
  `id` int(14) NOT NULL,
  `requester` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `approver` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `batch_num` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employee_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `training_needs` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schedule` date DEFAULT NULL,
  `actual_sched` date DEFAULT NULL,
  `training_status` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `training_approval` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `step` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sep_request`
--

INSERT INTO `sep_request` (`id`, `requester`, `approver`, `batch_num`, `employee_id`, `name`, `position`, `section`, `training_needs`, `reason`, `schedule`, `actual_sched`, `training_status`, `training_approval`, `remarks`, `step`) VALUES
(3, 'req', 'app', '1', '007', 'james bond', 'Staff', 'Section 1', 'ST', 'REQUIREMENT FOR POSITION', '2022-01-10', NULL, NULL, NULL, 'AYAW KO', '0'),
(4, 'req', 'app', '1', '008', 'Henry Sy', 'Staff', 'Section 2', 'ST', 'REQUIREMENT FOR POSITION', '2022-01-10', NULL, NULL, NULL, NULL, '1'),
(5, 'req', 'app', '1', '009', 'Mark Zuckerberg', 'Staff', 'Section 1', 'ST', 'REQUIREMENT FOR POSITION', '2022-01-10', NULL, NULL, NULL, 'need other training', '0'),
(6, 'req', 'app', '2', '010', 'Elon Musk', 'Associate', 'Section 1', 'ET', 'REQUIREMENT FOR POSITION', '2022-01-10', NULL, NULL, NULL, NULL, '2'),
(9, 'app', 'app', '29', 'DDS', 'Rodrigo Duterte', 'Associate', 'Section 1', 'ET', 'REQUIREMENT FOR POSITION', '2022-01-10', NULL, NULL, NULL, NULL, '2'),
(10, 'app', 'app', '29', '111', 'Bong Go', 'Associate', 'Section 1', 'ET', 'REQUIREMENT FOR POSITION', '2022-01-10', NULL, NULL, NULL, NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `training_schedule`
--

CREATE TABLE `training_schedule` (
  `id` int(14) NOT NULL,
  `training_sched` date DEFAULT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `training_schedule`
--

INSERT INTO `training_schedule` (`id`, `training_sched`, `description`) VALUES
(1, '2022-01-10', 'SEP ANNUAL TRAINING');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(14) NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_add` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email_add`, `password`, `name`, `position`, `role`, `level`, `section`) VALUES
(1, 'req', 'req@email.com', 'req', 'test requester', 'jr staff', 'requestor', '1', 'Section 1'),
(2, 'app', 'app@email.com', 'app', 'Test Approver', 'Supervisor', 'approver', '2', 'Section 1'),
(3, 'admin', 'admin@email.com', 'admin', 'RTS RECIEVING', 'JR STAFF', 'admin', '3', 'RTS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sep_request`
--
ALTER TABLE `sep_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_schedule`
--
ALTER TABLE `training_schedule`
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
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sep_request`
--
ALTER TABLE `sep_request`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `training_schedule`
--
ALTER TABLE `training_schedule`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
