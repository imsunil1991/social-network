-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2017 at 10:25 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id` int(11) NOT NULL,
  `requester` int(11) NOT NULL,
  `user_requested` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`id`, `requester`, `user_requested`, `status`, `updated_at`, `created_at`) VALUES
(47, 25, 23, 1, '2017-12-25 14:34:48', '2017-12-25 07:59:47'),
(49, 24, 25, 1, '2017-12-27 08:49:51', '2017-12-27 03:19:38'),
(50, 26, 23, 1, '2017-12-27 08:52:03', '2017-12-27 03:21:21'),
(51, 26, 24, 1, '2017-12-27 08:51:39', '2017-12-27 03:21:26'),
(52, 23, 24, 1, '2017-12-27 09:00:25', '2017-12-27 03:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `about` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `city`, `country`, `about`, `updated_at`, `created_at`) VALUES
(18, 23, 'BENGALURU', 'xwqxqxqw', 'sswqsqwdq', '2017-12-27 07:50:28', '2017-12-24 23:54:09'),
(19, 24, 'Mangalore', 'India', 'AXADX', '2017-12-27 09:12:29', '2017-12-25 07:57:13'),
(20, 25, NULL, NULL, NULL, '2017-12-25 07:59:24', '2017-12-25 07:59:24'),
(21, 26, NULL, NULL, NULL, '2017-12-27 03:21:08', '2017-12-27 03:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `slug`, `email`, `pic`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(23, 'sunil', 'male', 'sunil', 'sunilgaja7@gmail.com', 'photo.jpg', '$2y$10$543SmGGjO4g8sZf14JUfUOllHtHSxrl3Leihd59AVbJPB.dVDuZjW', 'z7RrUd9GvuZrmEghgdEsGzFmz1aKSFMZf8O6kxCVIWtg0WSbyYx7DD3w5mJd', '2017-12-24 23:54:09', '2017-12-24 23:54:09'),
(24, 'Jagga H G', 'male', 'jagga-h-g', 'suniljagga7@gmail.com', 'vinuT.JPG', '$2y$10$Ib/IpdlNDIPT/mH2phD77.hWMKC35lXh/xtipZrPpmMVCEDu/GLIO', 'Wahv8eEuS5PVQCFuGZ46MHEXLoIrbLaaRqNjDGh0AtofARJ5xC8KTx9NmaEW', '2017-12-25 07:57:13', '2017-12-25 07:57:13'),
(25, 'SUnil  Creatise', 'male', 'sunil-creatise', 'sunil@creatise.in', 'boy.png', '$2y$10$1y41zCccOVGhlgCuwyYvY.AtttCW9RaaMF9lhiiy9jsMoLCS1Q1Ry', 'cskNmEldifvrEOP0aMWdxPRbCEjseHJTiBkeDOZ4Rk60XZGLdA4faAq6ur5n', '2017-12-25 07:59:24', '2017-12-25 07:59:24'),
(26, 'Ampakka M N', 'male', 'ampakka-m-n', 'ampi@gmail.com', 'boy.png', '$2y$10$EpHgLyeqKqGwKx3cH6E5l.VmW7UHP97383Wp2tXLrWvVtfIKTypF2', 'URiKyaXYFXphEkMvTyGVpBZoUhu5teEnoa4pzq7ibRQwhlCT5Celqwz7evGF', '2017-12-27 03:21:08', '2017-12-27 03:21:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
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
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
