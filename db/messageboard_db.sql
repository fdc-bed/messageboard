-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 06, 2023 at 10:44 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messageboard_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `message_key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_id`, `to_id`, `content`, `created_date`, `modified_date`, `message_key`) VALUES
(1, 6, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-06 17:29:51', '0000-00-00 00:00:00', '61');

-- --------------------------------------------------------

--
-- Table structure for table `message_status`
--

CREATE TABLE `message_status` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_key` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message_status`
--

INSERT INTO `message_status` (`id`, `message_id`, `user_id`, `message_key`, `created_date`) VALUES
(1, 1, 1, '61', '2023-11-06 17:29:51'),
(2, 1, 6, '61', '2023-11-06 17:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL COMMENT 'M = Male, F = Female',
  `birthdate` date DEFAULT NULL,
  `hobby` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_image`, `gender`, `birthdate`, `hobby`, `created_date`, `last_login_datetime`) VALUES
(1, 'Debo Sama', 'bed.ouano@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', 'images-09.jpeg', 'M', '1997-11-11', 'sleeping, eating and dreaming', '2023-11-01 07:13:14', '2023-11-06 14:54:14'),
(2, 'Ouano. Obed', 'test@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', 'download-01.jpeg', 'M', '2000-06-27', 'sleepings, dancing, singing', '2023-11-01 07:14:40', '2023-11-06 17:28:02'),
(3, 'Just For', 'just.for@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', NULL, 'F', '1999-12-08', 'test', '2023-11-02 03:33:46', '2023-11-02 02:10:20'),
(4, 'Holy Moly', 'test.test@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', 'avatar-659651_640.png', 'M', '1998-12-16', 'sleeping', '2023-11-03 00:47:57', '2023-11-03 17:45:03'),
(5, 'John Doe', 'fdc.obed@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', '3f20f4ab4d31fab03090b8b0fddf3936.jpg', NULL, '2004-12-31', 'Cutting', '2023-11-03 05:47:48', '2023-11-03 17:28:27'),
(6, 'Monkey D. Luffy', 'luffy@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', '1699262720-1449604645-cf3aa769d2fce71f55e5ffbf585740ce.jpg', 'M', '2006-11-03', 'Eating and Sleeping', '2023-11-06 09:23:14', '2023-11-06 17:28:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_status`
--
ALTER TABLE `message_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message_status`
--
ALTER TABLE `message_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
