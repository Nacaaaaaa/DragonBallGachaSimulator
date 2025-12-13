-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2025 at 06:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dragonball`
--

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `rarity` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `power` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  `skill` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`id`, `name`, `rarity`, `type`, `power`, `speed`, `defense`, `skill`, `image`) VALUES
(1, 'Goku – Base Form', '★★', 'Saiyan', 5000, 4500, 3000, 'Kamehameha', '../assets/image/program/karakter/son goku.jpg'),
(2, 'Goku – Super Saiyan', '★★★★★', 'Saiyan', 12000, 9500, 8900, 'Final Flash Supreme', '../assets/image/program/karakter/son goku(saiyan).jpg'),
(3, 'Vegeta – Super Saiyan', '★★★★', 'Saiyan', 10000, 8000, 7500, 'Galick Gun', '../assets/image/program/karakter/vegeta.jpg'),
(4, 'Gohan – Teen (Base Form)', '★★★', 'Saiyan - Earthling', 4800, 4800, 3200, 'Masenko', '../assets/image/program/karakter/gohan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `coins` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `coins`) VALUES
(1, 'bambang', 'bambang@yahoo.com', 'bambang1', 'user', 9999999),
(2, 'bambanga', 'bambang@a.v', 'b1111', 'user', 9999),
(3, 'admin', 'admin@gmail.com', 'admin123', 'admin', 9999999);

-- --------------------------------------------------------

--
-- Table structure for table `user_characters`
--

CREATE TABLE `user_characters` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `character_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_characters`
--

INSERT INTO `user_characters` (`id`, `user_id`, `character_id`) VALUES
(28, 2, 2),
(29, 1, 3),
(30, 1, 2),
(31, 1, 1),
(32, 2, 1),
(33, 2, 3),
(38, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_characters`
--
ALTER TABLE `user_characters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_character` (`character_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_characters`
--
ALTER TABLE `user_characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_characters`
--
ALTER TABLE `user_characters`
  ADD CONSTRAINT `fk_character` FOREIGN KEY (`character_id`) REFERENCES `characters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
