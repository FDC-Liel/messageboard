-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 02, 2023 at 12:17 PM
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
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `sender_id`, `recipient_id`, `created`) VALUES
(1, 1, 4, '2023-11-01 11:48:00'),
(2, 3, 1, '2023-11-01 11:49:59'),
(3, 5, 4, '2023-11-01 11:50:14'),
(4, 1, 3, '2023-11-02 06:56:35'),
(5, 7, 4, '2023-11-02 09:17:49'),
(8, 7, 3, '2023-11-02 10:27:21'),
(9, 8, 7, '2023-11-02 11:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `conversation_id`, `message`, `created`, `modified`) VALUES
(1, 1, 1, 'post1', '2023-10-26 07:02:04', '2023-10-26 07:02:04'),
(2, 4, 2, 'post2', '2023-10-26 07:04:24', '2023-10-26 07:04:24'),
(3, 2, 3, 'post3', '2023-10-26 07:09:45', '2023-10-26 07:09:45'),
(4, 1, 2, 'post4', '2023-10-26 07:13:57', '2023-10-26 07:13:57'),
(6, 7, 8, 'asdasd', '2023-11-02 10:27:21', '2023-11-02 10:27:21'),
(7, 7, 8, 'qweqwe', '2023-11-02 10:52:31', '2023-11-02 10:52:31'),
(8, 7, 8, 'qweqwe', '2023-11-02 10:52:47', '2023-11-02 10:52:47'),
(9, 7, 8, 'qweqwe', '2023-11-02 10:52:47', '2023-11-02 10:52:47'),
(10, 8, 9, 'hello', '2023-11-02 11:07:51', '2023-11-02 11:07:51'),
(11, 7, 9, 'hi', '2023-11-02 11:08:57', '2023-11-02 11:08:57'),
(12, 8, 9, 'hai', '2023-11-02 11:11:41', '2023-11-02 11:11:41'),
(13, 7, 9, 'testing', '2023-11-02 11:15:05', '2023-11-02 11:15:05'),
(14, 8, 9, 'message from user8', '2023-11-02 11:53:38', '2023-11-02 11:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `birthdate` varchar(128) DEFAULT NULL,
  `hobby` text DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `last_login_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `gender`, `birthdate`, `hobby`, `email`, `password`, `created`, `modified`, `last_login_time`) VALUES
(1, 'test1', '6543535588b27-p2.jpg', 'Female', '09-19-2013', 'updated hobby updated hobby updated hobby', 'test1@test.com', '$2a$10$h0D5EMY/OLp940jc1xOL...miv2w6L7mpesHx2sfAGomr0OgHtA8.', '2023-10-30 06:06:28', '2023-11-02 08:44:21', '2023-11-02 05:57:57'),
(2, 'test222', '6542177f7e6af-p1.jpg', 'Female', '20-11-2023', 'qweqeqweq', 'test2@test.com', '$2a$10$vsLEJYgbMoyfWnmGPcEkQOT5LfM.MVmx9ZMQINIC6WMy7LtnkWJeS', '2023-10-31 08:54:30', '2023-11-02 05:58:38', '2023-11-02 05:58:38'),
(3, 'abcd3', '654355b2c0cb1-p1.jpg', 'Male', '11-30-2023', 'abcd3abcd3abcd3', 'abcd3@test.com', '$2a$10$5VpGZ24X0TWoydn1Rr36mO4O1bznJTu0sQqhpLfVf7Ug9I4N8OZTK', '2023-10-31 10:22:21', '2023-11-02 08:54:26', '2023-10-31 10:22:27'),
(4, 'user4', '6542216304b67-p1.jpg', 'Male', '03-25-2015', 'user4user4user4user4user4user4user4user4', 'user4@test.com', '$2a$10$sAyIVuApqc1FLg1USK2wv.7R/IkK9VOFD7srfIJJxTWnd4e0ynObe', '2023-11-01 10:47:53', '2023-11-01 10:59:20', '2023-11-01 10:59:20'),
(5, 'test5', '6542317cb353a-65421077ede7c-p2.jpg', 'Female', '08-13-2023', 'fdssdgsgdsgsdgsd', 'test5@test.com', '$2a$10$hBKtqrWRYg7SbRbaM26jDOfdvhBmgkdd6ovi5VGXEdWF718KLadgW', '2023-11-01 11:01:19', '2023-11-01 12:16:47', '2023-11-01 12:16:47'),
(6, 'user6', '6542341caa6fd-p3.jpg', 'Female', '08-14-2031', 'Hobby Hobby Hobby Hobby Hobby Hobby Hobby Hobby Hobby', 'user6@test.com', '$2a$10$senSURg2M6cX5A.C97EWQuq8rlwjJfVq8dmcXV.zBw9a5VdHJemUi', '2023-11-01 12:17:50', '2023-11-01 12:19:01', '2023-11-01 12:19:01'),
(7, 'user7', '6543669a2c067-p2.jpg', 'Male', '05-18-2023', 'weqqeqeqwe', 'user7@test.com', '$2a$10$EN0Gc77JP/LiCdipSaeUrODPkKTRU5H6Qmg1CrVKsIAxLwshVERAi', '2023-11-02 08:58:46', '2023-11-02 11:10:30', '2023-11-02 11:10:30'),
(8, 'user8', '65437466b72f8-p1.jpg', 'Female', '12-13-2012', '123123123132132', 'user8@test.com', '$2a$10$vsqsKAkEgGs5bm89ZkOH7Ovk4D48/xh0kqFece0CWTr6sBORYgjpK', '2023-11-02 11:03:58', '2023-11-02 11:06:41', '2023-11-02 11:06:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipient_id_fk` (`recipient_id`),
  ADD KEY `sender_id_fk` (`sender_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_conversation_id_fk` (`conversation_id`),
  ADD KEY `message_user_id_fk` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `recipient_id_fk` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sender_id_fk` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `message_conversation_id_fk` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `message_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
