-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2023 at 03:25 PM
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
(1, '001060704', '30420592050', 'Rakhi Azfa Rifansya', '089521580188', NULL, 5, 2, '2023-02-09 14:08:18');

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
(2, '3273090280020002', 'Rakhi Azfa Rifansya', 'Bandung', '2004-07-06', 'Pria', 'Islam', 'Jl. Wastukencana No. 67-24B', 1, '2023-02-09 14:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `leave_of_absences`
--

CREATE TABLE `leave_of_absences` (
  `id` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `category` enum('Cuti Tahunan','Cuti Pernikahan','Cuti Sakit') NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('accepted','rejected','draft') NOT NULL DEFAULT 'draft',
  `employee_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_of_absences`
--

INSERT INTO `leave_of_absences` (`id`, `start`, `end`, `category`, `description`, `status`, `employee_id`, `created_at`) VALUES
(1, '2023-02-09', '2023-02-11', 'Cuti Pernikahan', '', 'accepted', 1, '2023-02-09 14:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `leave_of_absence_histories`
--

CREATE TABLE `leave_of_absence_histories` (
  `id` int(11) NOT NULL,
  `employee_nip` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_email` varchar(255) NOT NULL,
  `leave_of_absence_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_of_absence_histories`
--

INSERT INTO `leave_of_absence_histories` (`id`, `employee_nip`, `employee_name`, `employee_email`, `leave_of_absence_id`, `created_at`) VALUES
(1, '001060704', 'Rakhi Azfa Rifansya', 'rakhi.azfa@example.co.id', 1, '2023-02-09 14:22:48');

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
(2, 'Indonesia', 'Jawa barat', 'Bandung', '40116', 'Jl. Wastukencana No. 67-24B', 1, '2023-02-09 14:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `presences`
--

CREATE TABLE `presences` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `presence_time` time NOT NULL,
  `late_time` int(11) NOT NULL,
  `status` enum('Present','Permission','Sick') DEFAULT NULL,
  `description` text DEFAULT NULL,
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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(20) NOT NULL,
  `name` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`) VALUES
(1, 'admin', '2023-02-09 07:24:56'),
(2, 'employee', '2023-02-09 07:25:07'),
(3, 'trainee', '2023-02-09 07:25:27');

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
(1, 'Pagi', '08:00:00', '12:00:00', '2023-02-04 03:53:26'),
(2, 'Siang', '01:00:00', '03:00:00', '2023-02-04 03:53:26'),
(5, 'Malam', '06:00:00', '12:00:00', '2023-02-06 15:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee','trainee','') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@example.co.id', '$2y$10$s0OkjMFBxAupz9gpv/VGTej564k/O.yxRn1ZMzd8TdkXtdbEekToe', 'admin', '2023-02-09 14:05:02'),
(2, 'Rakhi Azfa Rifansya', 'rakhi.azfa@example.co.id', '$2y$10$i05aWjSJMoKS6gZauWC2uO4nBz.OR8nUuFqwPppvMVK6DZdFA6ouS', 'employee', '2023-02-09 14:08:18');

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
-- Indexes for table `leave_of_absences`
--
ALTER TABLE `leave_of_absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_of_absences_ibfk_1` (`employee_id`);

--
-- Indexes for table `leave_of_absence_histories`
--
ALTER TABLE `leave_of_absence_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_of_absence_id` (`leave_of_absence_id`);

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
  ADD UNIQUE KEY `presence_id` (`presence_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `identities`
--
ALTER TABLE `identities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_of_absences`
--
ALTER TABLE `leave_of_absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leave_of_absence_histories`
--
ALTER TABLE `leave_of_absence_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `leave_of_absences`
--
ALTER TABLE `leave_of_absences`
  ADD CONSTRAINT `leave_of_absences_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `leave_of_absence_histories`
--
ALTER TABLE `leave_of_absence_histories`
  ADD CONSTRAINT `leave_of_absence_histories_ibfk_1` FOREIGN KEY (`leave_of_absence_id`) REFERENCES `leave_of_absences` (`id`);

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
