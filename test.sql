-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 03:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`) VALUES
(1, 'Stryx', 'Qaz', 'Stryx', '$2y$10$STMqVTPaPhPvgBB3DVNji.MKGl7ny4L2R5aiBi8BJpw4Pt6uyZECi', 'stryx@email.co.za'),
(2, 'qaz', 'qaz', 'shawn', '$2y$10$.T/.iMOqR08mQYFwYm7pm.m1fOII5GeqkZf6qZjnMZo4us3LPpMce', 'shawnw@websavvy.co.za'),
(3, 'wsxqaz', 'wsxqaz', 'wsxqaz', '$2y$10$Mx3kd3ppFnvbRF0bkWlqGuXNKX/HpQOpzD4RLVA75gZXITWRaRrLS', 'wsxqaz@email.co.za'),
(6, 'qwe', 'qwe', 'qwe', '$2y$10$nA6Zu.JI0jWGV/OPqTXLWezQBiSFWY0uDzIrOd2.gjR1E0tD9f8tC', 'qwe@qwe.co.za'),
(7, 'zxc', 'zxc', 'zxc', '$2y$10$euXQKQ/H1myZDw3606r.3.41mA08amGRrLjsNnkSfGtozPssu99A6', 'zxc@zxc.co.za'),
(8, 'Stryx', 'Qaz', 'fghjfghfgh', '$2y$10$p1CIvgWvarIaLAWjlrJqmOy3H960EPV5R9F7xUR8nByEp4BC8mTsm', 'sdfsdf@sdfsdf.co.za'),
(9, 'Shawn', 'Whelan', 'ShawnWhelan', '$2y$10$lHvCgPuyyKjcKIPDl.OlWu8xjYQd7PjfcjgX9b8ISkkBtxMrSpApO', 'shawn@websavvy.co.za');

-- --------------------------------------------------------

--
-- Table structure for table `user_votes`
--

CREATE TABLE `user_votes` (
  `user_id` int(11) NOT NULL,
  `vote_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_votes`
--

INSERT INTO `user_votes` (`user_id`, `vote_id`) VALUES
(1, 1),
(9, 1),
(3, 2),
(7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `option` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `option`) VALUES
(3, 'C'),
(2, 'C#'),
(6, 'C++'),
(4, 'JAVA'),
(1, 'PHP'),
(5, 'Python');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_votes`
--
ALTER TABLE `user_votes`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `vote_id` (`vote_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `option` (`option`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_votes`
--
ALTER TABLE `user_votes`
  ADD CONSTRAINT `user_votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_votes_ibfk_2` FOREIGN KEY (`vote_id`) REFERENCES `votes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
