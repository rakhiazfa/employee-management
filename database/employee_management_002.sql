-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 06:06 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_recovery` varchar(255) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `nip`, `npwp`, `name`, `phone`, `email_recovery`, `shift_id`, `user_id`, `created_at`) VALUES
(2, '001060704', '', 'Rakhi Azfa Rifansya', '089521580180', NULL, 2, 3, '2023-02-05 17:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `identities`
--

CREATE TABLE `identities` (
  `id` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Pria','Wanita') DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `identities`
--

INSERT INTO `identities` (`id`, `nik`, `name`, `place_of_birth`, `date_of_birth`, `gender`, `religion`, `address`, `employee_id`, `created_at`) VALUES
(2, '3293070607040002', 'Rakhi Azfa Rifansya', 'Bandung', '2000-07-03', 'Pria', 'Islam', 'Jl. Wastukencana No. 67-24B', 2, '2023-02-05 17:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `country`, `province`, `city`, `postal_code`, `address`, `employee_id`, `created_at`) VALUES
(2, 'Indonesia', 'Jawa Barat', 'Bandung', '40116', 'Jl. Wastukencana No. 67-24B', 2, '2023-02-05 17:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `presences`
--

CREATE TABLE `presences` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `presence_time` time NOT NULL,
  `late_time` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `presence_histories`
--

CREATE TABLE `presence_histories` (
  `id` int(11) NOT NULL,
  `employee_nip` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_email` varchar(255) NOT NULL,
  `shift_name` varchar(255) NOT NULL,
  `shift_start` time NOT NULL,
  `shift_end` time NOT NULL,
  `presence_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `start`, `end`, `created_at`) VALUES
(1, 'Pagi', '08:00:00', '10:00:00', '2023-02-04 03:53:26'),
(2, 'Siang', '13:00:00', '15:00:00', '2023-02-04 03:53:26'),
(3, 'Sore', '15:00:00', '17:00:00', '2023-02-04 03:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@example.co.id', '$2y$10$Q/G/5IuXP8GTE7U6wxQk9uYWP/6BMDvWOBclXbOucBcOFad9Z15Ii', 'admin', '2023-02-04 06:30:26'),
(3, 'Rakhi Azfa Rifansya', 'rakhiazfa0421@gmail.com', '$2y$10$7T4iCS6XzbxuiJhQw.Gaz.nfKBRpyZA9FzM2ZVhkUZpo7X4xoJaCu', 'employee', '2023-02-05 17:51:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `npwp` (`npwp`),
  ADD UNIQUE KEY `email_recovery` (`email_recovery`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `identities`
--
ALTER TABLE `identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `presences`
--
ALTER TABLE `presences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presences_ibfk_1` (`employee_id`);

--
-- Indexes for table `presence_histories`
--
ALTER TABLE `presence_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presence_id` (`presence_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `identities`
--
ALTER TABLE `identities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `presences`
--
ALTER TABLE `presences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presence_histories`
--
ALTER TABLE `presence_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `identities`
--
ALTER TABLE `identities`
  ADD CONSTRAINT `identities_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `presences`
--
ALTER TABLE `presences`
  ADD CONSTRAINT `presences_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `presence_histories`
--
ALTER TABLE `presence_histories`
  ADD CONSTRAINT `presence_histories_ibfk_1` FOREIGN KEY (`presence_id`) REFERENCES `presences` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
