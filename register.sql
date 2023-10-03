-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2023 at 09:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_success`
--

CREATE TABLE `login_success` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `network_ip` varchar(100) NOT NULL,
  `system_ip` varchar(100) NOT NULL,
  `browser_details` varchar(100) NOT NULL,
  `server_name` varchar(100) NOT NULL,
  `user_city` varchar(100) DEFAULT NULL,
  `user_state` varchar(100) DEFAULT NULL,
  `user_country` varchar(100) DEFAULT NULL,
  `login_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_success`
--

INSERT INTO `login_success` (`id`, `username`, `network_ip`, `system_ip`, `browser_details`, `server_name`, `user_city`, `user_state`, `user_country`, `login_date`) VALUES
(1, '1000', '::1', '{\n  \"ip\": \"110.224.84.144\",\n  \"city\": \"Chennai\",\n  \"region\": \"Tamil Nadu\",\n  \"country\": \"IN\",\n  \"loc', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Sa', 'DESKTOP-9K1D2EQ', NULL, NULL, NULL, '2023-10-03 09:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `profile_update_history`
--

CREATE TABLE `profile_update_history` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `mob` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  `pin` int(20) NOT NULL,
  `update_date` datetime NOT NULL,
  `updated_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_update_history`
--

INSERT INTO `profile_update_history` (`id`, `username`, `mob`, `email`, `fname`, `lname`, `city`, `country`, `state`, `dob`, `gender`, `image`, `pin`, `update_date`, `updated_by`) VALUES
(1, '1000', 2147483647, 'hathimshynu@gmail.com', 'hathim', 'hathim', 'sdf', 'India', 'tamilnadu', '2023-10-11', 'male', 'c80b4a76fe048c97469d89dfd3c3c266.jpg', 17824314, '2023-10-03 12:08:52', 'user'),
(2, '1000', 2147483647, 'hathimshynu@gmail.com', 'hathim', 'hathim', 'sdf', 'India', 'tamilnadu', '2023-10-11', 'male', '6447de8bb2aef32fe829b62151f305af.jpg', 17824314, '2023-10-03 12:16:09', 'user'),
(3, '1000', 2147483647, 'hathimshynu@gmail.com', 'hathim', 'hathim', 'sdf', 'India', 'tamilnadu', '2023-10-11', 'male', '40fa506466837722844e201288f2b5e1.jpg', 17844, '2023-10-03 12:19:17', 'user'),
(4, '1000', 2147483647, 'hathimshynu@gmail.com', 'hathim', 'hathim', 'sdf', 'India', 'tamilnadu', '2023-10-11', 'male', 'e5bb8150e7c226bd99f6834ba029a145.jpg', 17844, '2023-10-03 12:25:50', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `pwd_hint` varchar(100) NOT NULL,
  `mob` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  `pin` int(20) NOT NULL,
  `entry_date` datetime NOT NULL,
  `login_count` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `username`, `pwd`, `pwd_hint`, `mob`, `email`, `fname`, `lname`, `city`, `country`, `state`, `dob`, `gender`, `image`, `pin`, `entry_date`, `login_count`) VALUES
(1, '1000', '531fe6dd9268933fd3e94c661893ef2e44a03da6', 'pTvX1Bly', 2147483647, 'hathimshynu@gmail.com', 'hathim', 'hathim', 'sdf', 'India', 'tamilnadu', '2023-10-11', 'male', 'e5bb8150e7c226bd99f6834ba029a145.jpg', 17844, '2023-10-02 17:18:39', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_success`
--
ALTER TABLE `login_success`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_update_history`
--
ALTER TABLE `profile_update_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_success`
--
ALTER TABLE `login_success`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profile_update_history`
--
ALTER TABLE `profile_update_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
