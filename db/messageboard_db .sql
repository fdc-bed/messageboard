-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 09, 2023 at 11:18 AM
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
(1, 6, 7, 'Zoro!', '2023-11-09 17:44:59', '0000-00-00 00:00:00', '67'),
(2, 6, 7, 'Hey!!!', '2023-11-09 17:51:14', '0000-00-00 00:00:00', '67'),
(3, 6, 7, 'Wats Up!', '2023-11-09 17:51:26', '0000-00-00 00:00:00', '67'),
(4, 7, 6, 'Luffy!', '2023-11-09 17:52:12', '0000-00-00 00:00:00', '67'),
(5, 6, 7, 'how are you?!', '2023-11-09 17:55:15', '0000-00-00 00:00:00', '67'),
(6, 16, 2, 'test', '2023-11-09 18:12:41', '0000-00-00 00:00:00', '162');

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
(1, 1, 7, '67', '2023-11-09 17:44:59'),
(3, 2, 7, '67', '2023-11-09 17:51:14'),
(4, 2, 6, '67', '2023-11-09 17:51:14'),
(5, 3, 7, '67', '2023-11-09 17:51:26'),
(6, 3, 6, '67', '2023-11-09 17:51:26'),
(7, 4, 6, '67', '2023-11-09 17:52:12'),
(8, 4, 7, '67', '2023-11-09 17:52:12'),
(9, 5, 7, '67', '2023-11-09 17:55:15'),
(10, 5, 6, '67', '2023-11-09 17:55:15'),
(11, 6, 2, '162', '2023-11-09 18:12:41'),
(12, 6, 16, '162', '2023-11-09 18:12:41');

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
  `modified_ip` varchar(225) DEFAULT NULL,
  `last_login_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_image`, `gender`, `birthdate`, `hobby`, `created_date`, `modified_ip`, `last_login_datetime`) VALUES
(1, 'Debo Sama', 'bed.ouano@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', 'images-09.jpeg', 'M', '1997-11-11', 'sleeping, eating and dreaming', '2023-11-01 07:13:14', NULL, '2023-11-06 14:54:14'),
(2, 'Ouano. Obed', 'test@gmail.com', '321', 'download-01.jpeg', 'M', '2000-06-27', 'sleepings, dancing, singing', '2023-11-01 07:14:40', NULL, '2023-11-09 17:15:39'),
(6, 'Monkey D. Luffy', 'luffy@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', '1699262720-1449604645-cf3aa769d2fce71f55e5ffbf585740ce.jpg', 'M', '2006-11-03', 'Eating and Sleeping', '2023-11-06 09:23:14', NULL, '2023-11-09 17:34:56'),
(7, 'Zoro Roronoa', 'zoro@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', 'f31ea05d300cfe3aebfc0576d0faba10.jpg', 'M', '1996-06-07', 'Sleeping, drinking Booze', '2023-11-07 02:01:37', NULL, '2023-11-09 17:51:52'),
(8, 'God D. Usopp', 'usopp@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', 'artworks-rZsSrvKHn5zUpKDN-ytX19A-t500x500.jpg', 'M', '1999-11-03', 'Crafting', '2023-11-07 05:25:03', NULL, '2023-11-09 11:46:20'),
(9, 'Vinsmoke Sanji ', 'sanji@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', '0d64011278398713.6298a107bc43c.jpg', 'M', '1999-11-11', 'Cooking', '2023-11-07 05:25:38', NULL, '2023-11-07 13:33:59'),
(10, 'Tony Tony Chopper', 'chopper@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', '456486991c251c4f1241951116de88a3.jpg', 'M', '1999-11-10', 'Reading Books', '2023-11-07 05:26:08', NULL, '2023-11-07 13:30:39'),
(11, 'Nico Robin', 'robin@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', 'images (1).jpeg', 'F', '1995-10-10', 'Archeologist', '2023-11-07 05:26:24', NULL, '2023-11-07 13:41:05'),
(12, 'Franky', 'franky@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', '035b40228c942eb12eaa649460d9ffe5.jpg', 'M', '1995-11-01', 'Mecha', '2023-11-07 05:26:54', NULL, '2023-11-07 13:40:33'),
(13, 'Brook', 'brook@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', 'df9vvb5-4106e2a4-ce77-43ab-abc8-6de3312aaad2.jpg', 'M', '1969-11-19', 'Singing', '2023-11-07 05:27:12', NULL, '2023-11-07 13:38:30'),
(14, 'Jimbei', 'jimbei@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', 'ewtdgavhrqia.jpg', 'M', '1996-11-13', 'Karate', '2023-11-07 05:27:33', NULL, '2023-11-07 17:44:30'),
(15, 'Nami', 'nami@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', 'Nami_face.jpg', NULL, '1999-11-10', 'Drawing and Geography', '2023-11-07 05:30:06', NULL, '2023-11-07 13:36:06'),
(16, 'test333', 'test124@gmail.com', '3f7b88e01485b66cab4f0522f88ff180576bcf68', NULL, NULL, NULL, NULL, '2023-11-08 09:16:23', NULL, '2023-11-09 17:59:59');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message_status`
--
ALTER TABLE `message_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
