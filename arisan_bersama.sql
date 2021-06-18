-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2021 at 06:33 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arisan_bersama`
--

-- --------------------------------------------------------

--
-- Table structure for table `arisan`
--

CREATE TABLE `arisan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `unique_id` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `nominal` bigint(20) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `time_start` date NOT NULL,
  `period` enum('harian','mingguan','bulanan') NOT NULL,
  `long_time` int(11) NOT NULL,
  `max_join` date DEFAULT NULL,
  `status` enum('join_dibuka','sedang_berlangsung','selesai') NOT NULL DEFAULT 'join_dibuka',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arisan`
--

INSERT INTO `arisan` (`id`, `user_id`, `unique_id`, `title`, `nominal`, `description`, `time_start`, `period`, `long_time`, `max_join`, `status`, `created_at`, `updated_at`) VALUES
(11, 4, '404-3822', 'Arisan Keluarga Cemara', 100000, 'Per minggu 100000', '2021-06-24', 'mingguan', 20, NULL, 'join_dibuka', '2021-06-18 02:38:22', NULL),
(12, 4, '404-4010', 'Arisan Kantor', 100000, 'Awal Bulan', '2021-07-01', 'mingguan', 20, NULL, 'sedang_berlangsung', '2021-06-18 02:40:10', '2021-06-18 16:11:39');

--
-- Triggers `arisan`
--
DELIMITER $$
CREATE TRIGGER `arisan_add` AFTER INSERT ON `arisan` FOR EACH ROW BEGIN

	INSERT INTO `order_participant` (`arisan_id`, `user_id`, `number`, `status`) VALUES (new.id, new.user_id, 0, 'belum_menang');

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_participant`
--

CREATE TABLE `order_participant` (
  `id` int(11) NOT NULL,
  `arisan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `number` int(11) NOT NULL DEFAULT 0,
  `income` bigint(20) NOT NULL DEFAULT 0,
  `status` enum('belum_terkonfirmasi','belum_menang','sudah_menang') NOT NULL DEFAULT 'belum_terkonfirmasi',
  `img` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_participant`
--

INSERT INTO `order_participant` (`id`, `arisan_id`, `user_id`, `number`, `income`, `status`, `img`, `created_at`, `updated_at`) VALUES
(2, 11, 4, 0, 0, 'belum_menang', NULL, '2021-06-18 02:38:22', '2021-06-18 14:44:35'),
(3, 12, 4, 1, 200000, 'belum_menang', NULL, '2021-06-18 02:40:10', '2021-06-18 16:11:39'),
(6, 12, 5, 2, 200000, 'belum_menang', NULL, '2021-06-18 15:30:37', '2021-06-18 16:11:39');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `arisan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_amount` bigint(20) NOT NULL,
  `label` tinytext DEFAULT NULL,
  `status` enum('menunggu_konfirmasi','pembarayaran_berhasil','pembarayaran_ditolak') NOT NULL DEFAULT 'menunggu_konfirmasi',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` enum('user','administrator') NOT NULL DEFAULT 'user',
  `name` varchar(100) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `tel`, `created_at`) VALUES
(4, 'rizki', '$2y$10$SObmvWntKbOnBWStt/lkZuU.nEmlIpioFGQamA8SK/p55E78zTMlS', 'user', 'Rizki Aryandi', '6289602604839', '2021-06-17 22:54:07'),
(5, 'vinnalia', '$2y$10$uIMxs8dLCw1RSlQmciH4/OFxcOyHolfKA2WOK6YrF5Pyq/hX5jxCq', 'user', 'Vinnalia Mega Utami', '6281387751424', '2021-06-18 11:36:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arisan`
--
ALTER TABLE `arisan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD KEY `FK_USER_ARISAN` (`user_id`);

--
-- Indexes for table `order_participant`
--
ALTER TABLE `order_participant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ORDER_ARiSAN` (`arisan_id`),
  ADD KEY `FK_ORDER_USER` (`user_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ARISAN_TRANSACTION` (`arisan_id`),
  ADD KEY `FK_USERS_TRANSACTION` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arisan`
--
ALTER TABLE `arisan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_participant`
--
ALTER TABLE `order_participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arisan`
--
ALTER TABLE `arisan`
  ADD CONSTRAINT `FK_USER_ARISAN` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_participant`
--
ALTER TABLE `order_participant`
  ADD CONSTRAINT `FK_ORDER_ARiSAN` FOREIGN KEY (`arisan_id`) REFERENCES `arisan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ORDER_USER` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FK_ARISAN_TRANSACTION` FOREIGN KEY (`arisan_id`) REFERENCES `arisan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USERS_TRANSACTION` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
