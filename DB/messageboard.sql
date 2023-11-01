-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2023 at 08:17 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messageboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `recipient_id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `conversation_id`, `message`, `created`, `modified`) VALUES
(1, 1, 0, 'post1', '2023-10-26 07:02:04', '2023-10-26 07:02:04'),
(2, 4, 0, 'post2', '2023-10-26 07:04:24', '2023-10-26 07:04:24'),
(3, 2, 0, 'post3', '2023-10-26 07:09:45', '2023-10-26 07:09:45'),
(4, 1, 0, 'post4', '2023-10-26 07:13:57', '2023-10-26 07:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(11) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `birthdate` varchar(128) NOT NULL,
  `hobby` text NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `last_login_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `gender`, `birthdate`, `hobby`, `email`, `password`, `created`, `modified`, `last_login_time`) VALUES
(1, 'test1', '', 'Female', '10-10-2013', 'fhdhdfdhfdh', 'test1@test.com', '$2a$10$0zzqENGZ.MY1cxnclC0L7u/tHtkVo5kAP6/2MjsSMQiUqLloWTJYy', '2023-10-30 06:06:28', '2023-11-01 07:14:28', '2023-11-01 06:13:31'),
(2, 'test222', '', 'Female', '20-11-2023', 'qweqeqweq', 'test2@test.com', '$2a$10$vsLEJYgbMoyfWnmGPcEkQOT5LfM.MVmx9ZMQINIC6WMy7LtnkWJeS', '2023-10-31 08:54:30', '2023-11-01 03:59:36', '2023-11-01 03:58:47'),
(3, 'test3', '', '', '', '', 'test3@test.com', '$2a$10$5VpGZ24X0TWoydn1Rr36mO4O1bznJTu0sQqhpLfVf7Ug9I4N8OZTK', '2023-10-31 10:22:21', '2023-10-31 10:22:27', '2023-10-31 10:22:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
