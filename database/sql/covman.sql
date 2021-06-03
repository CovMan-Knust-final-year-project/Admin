-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2021 at 01:24 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covman`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `status`, `company_name`, `phone_number`, `username`, `email`, `address`, `password`, `date_created`, `time_created`, `time_stamp`) VALUES
(24, 1, 'Kwame Nkrumah US Tech', '0268977129', 'jesse', 'info@knust.edu.gh', 'None', '$6$rounds=1000$ldfowetwnvmlope$EnGg4dQ2nQ8lwUUWGF3IR.y3iCMUvUTV/h6jO2Zm7GIou5vyL4smPcWXyvTEHxA6Jchq9BAKp1/7oPE.Y46k2.', '2021-05-26', '01:04:21', '2021-05-28 10:04:49'),
(25, 1, 'RivEnterprise', '0268977129', 'admin', NULL, NULL, '$6$rounds=1000$ldfowetwnvmlope$EnGg4dQ2nQ8lwUUWGF3IR.y3iCMUvUTV/h6jO2Zm7GIou5vyL4smPcWXyvTEHxA6Jchq9BAKp1/7oPE.Y46k2.', '2021-05-26', '01:06:35', '2021-05-26 01:06:35'),
(28, 1, 'Jesse Inc', '0268977123', 'jesse3', NULL, NULL, '$6$rounds=1000$ldfowetwnvmlope$EnGg4dQ2nQ8lwUUWGF3IR.y3iCMUvUTV/h6jO2Zm7GIou5vyL4smPcWXyvTEHxA6Jchq9BAKp1/7oPE.Y46k2.', '2021-05-28', '10:01:12', '2021-05-28 10:01:12'),
(30, 1, 'Julieen Inc', '0546545050', 'naana', 'naanajoyko5050@gmail.com', 'Kumasi', '$6$rounds=1000$ldfowetwnvmlope$ClfIx6cauk2s2MdMM28.JLcf274ga4s7zSLYL50UuTYiVADJjY0mv/1a/1sUM3gRFE.wOw1xNfwrI8KtwPiJ4.', '2021-05-29', '12:55:57', '2021-05-29 13:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `venue` int(11) NOT NULL,
  `date_marked` date NOT NULL,
  `time_marked` time NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `status`, `org_id`, `user_id`, `venue`, `date_marked`, `time_marked`, `time_stamp`) VALUES
(1, 1, 30, 7, 3, '2021-05-18', '23:32:15', '2021-05-31 22:48:05'),
(2, 1, 30, 7, 3, '2021-05-13', '13:32:15', '2021-05-26 22:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `scan_id` int(11) NOT NULL,
  `date_reported` date NOT NULL,
  `time_reported` time NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `org_id`, `status`, `user_id`, `scan_id`, `date_reported`, `time_reported`, `time_stamp`) VALUES
(1, 24, 1, 6, 1, '2021-05-27', '06:09:23', '2021-05-27 20:09:23'),
(2, 24, 1, 6, 1, '2021-05-27', '06:09:49', '2021-05-27 20:09:49'),
(3, 24, 1, 7, 1, '2021-05-27', '06:23:30', '2021-06-01 20:40:56'),
(4, 24, 1, 7, 1, '2021-05-27', '06:25:00', '2021-06-01 20:40:59'),
(5, 24, 1, 7, 1, '2021-05-27', '06:25:13', '2021-06-01 20:41:02'),
(6, 24, 1, 6, 1, '2021-05-27', '06:27:27', '2021-05-27 20:27:27'),
(7, 24, 1, 6, 1, '2021-05-27', '06:36:22', '2021-05-27 20:36:22'),
(8, 30, 1, 6, 1, '2021-05-29', '01:14:00', '2021-05-29 15:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_logged_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `phone_number`, `name`, `date_logged_in`) VALUES
(1, '0268977129', 'Jesse Anim', '2021-05-27 18:33:13'),
(2, '0270000000', 'John Anim', '2021-05-27 18:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date_added` date NOT NULL,
  `time_added` time NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `status`, `org_id`, `user_id`, `topic`, `message`, `date_added`, `time_added`, `timestamp`) VALUES
(1, 1, 24, 6, 'Hello', 'Hi', '2021-05-27', '12:26:24', '2021-05-27 02:26:24'),
(2, 1, 24, 6, 'Testing', 'testing the messaging capability', '2021-05-27', '12:28:55', '2021-05-27 02:28:55'),
(3, 1, 24, 6, 'Testing', 'testing', '2021-05-27', '12:29:54', '2021-05-27 02:29:54'),
(4, 1, 24, 6, 'testing', 'Thre three', '2021-05-27', '12:33:54', '2021-05-27 02:33:54'),
(5, 1, 24, 6, 's', 's', '2021-05-27', '12:36:14', '2021-05-27 02:36:14'),
(6, 1, 24, 6, 'One', 'One', '2021-05-27', '12:36:38', '2021-05-27 02:36:38'),
(7, 1, 24, 6, 'One', 'One', '2021-05-27', '12:37:07', '2021-05-27 02:37:07'),
(8, 1, 24, 6, 'One', 'One', '2021-05-27', '12:39:17', '2021-05-27 02:39:17'),
(9, 1, 24, 6, 'hello', 'Hi', '2021-05-27', '05:41:29', '2021-05-27 19:41:29'),
(10, 1, 24, 6, 'One', 'ONe', '2021-05-27', '05:44:07', '2021-05-27 19:44:07'),
(11, 1, 24, 6, 'One', 'ONe', '2021-05-27', '05:44:10', '2021-05-27 19:44:10'),
(12, 1, 24, 6, 'One', 'ONe', '2021-05-27', '05:44:13', '2021-05-27 19:44:13'),
(13, 1, 24, 6, 'One', 'One', '2021-05-27', '05:44:40', '2021-05-27 19:44:40'),
(14, 1, 24, 6, 'Hello', 'testing the messaging', '2021-05-27', '06:28:25', '2021-05-27 20:28:25'),
(15, 1, 24, 6, 'Testing', 'testing the messaging', '2021-05-27', '06:28:51', '2021-05-27 20:28:51'),
(16, 1, 24, 6, 'Trying', 'Testing mic one two', '2021-05-27', '06:30:07', '2021-05-27 20:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `mount_point`
--

CREATE TABLE `mount_point` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `operational_status` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `timestamp_` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mount_point`
--

INSERT INTO `mount_point` (`id`, `status`, `operational_status`, `org_id`, `venue`, `timestamp_`) VALUES
(2, 1, 0, 24, 'College of Science', '2021-05-26 11:28:25'),
(3, 1, 1, 24, 'KSB Inner room', '2021-05-26 11:28:05'),
(4, 1, 0, 30, 'College of Science', '2021-05-29 13:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `scans`
--

CREATE TABLE `scans` (
  `id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `mount_point_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `temperature` double NOT NULL,
  `date_scanned` date NOT NULL,
  `time_scanned` time NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scans`
--

INSERT INTO `scans` (`id`, `org_id`, `mount_point_id`, `status`, `user_id`, `temperature`, `date_scanned`, `time_scanned`, `time_stamp`) VALUES
(1, 30, 2, 1, 7, 40, '2021-05-28', '23:27:13', '2021-06-01 08:21:52'),
(2, 30, 2, 0, 7, 20, '2021-05-28', '08:40:52', '2021-06-09 08:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `org_id`, `status`, `image`, `first_name`, `last_name`, `dob`, `phone_number`, `level`, `date_created`, `time_created`, `time_stamp`) VALUES
(6, 24, 1, 'helpinghand.jpg', 'John', 'Legend', '2021-05-19', '0268977129', 200, '2021-05-26', '10:06:25', '2021-05-30 12:51:15'),
(7, 30, 1, 'driver.png', 'John', 'Anim', '2021-05-12', '0270000000', 100, '2021-05-29', '01:09:46', '2021-05-31 21:21:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mount_point`
--
ALTER TABLE `mount_point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scans`
--
ALTER TABLE `scans`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mount_point`
--
ALTER TABLE `mount_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scans`
--
ALTER TABLE `scans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
