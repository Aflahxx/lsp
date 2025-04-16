-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 08:42 AM
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
-- Database: `daftar_hadir`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpha') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `user_id`, `tanggal`, `status`) VALUES
(9, 19, '2025-04-11', 'Izin'),
(11, 20, '2025-04-11', 'Hadir');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('guru','siswa','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nama`, `username`, `password`, `role`) VALUES
(18, 'Tedi Gunawan', 'tedi123', '$2y$10$CaV.wEzpIhfH9o.YsFD89er2X8B4gm.jy1Ol1l.75OotZDZZOwO3.', 'guru'),
(19, 'Yusup Dwi Saputra', 'ucup', '$2y$10$DKMm.HdF4NjC6U6W0OsHp.0bu1LlXYOkBBbKhNOWLa2qAhIoJDr5u', 'siswa'),
(20, 'Herman Nasution', 'Herman', '$2y$10$H3nOBAhOagklIu/j/6MxHudOvxBSGWNWA2RNkh8INKnKlWHY3R0SO', 'siswa'),
(21, 'Tamam F', 'tamamf', '$2y$10$8NIM6FY4uDkVr8yRmMiJKeYHEUlqTH7AQsaRG3gvZFnc2hy7EP.1e', 'guru'),
(22, 'Budi', 'bud1', '$2y$10$bY1FXQEuDqzQQMRE.82Ba.Mwb/hTVgAiFB3RPlO21ENLkUFElVaDy', 'siswa'),
(23, 'bu inggit', 'inggit', '$2y$10$LhwyAYJdh0cNsWYmiQK6o.6WHtXRq6NgZ.8HvIjFxnkc8XjqdGCAW', 'guru'),
(24, 'Shalman Eldilko', 'Shalman', '$2y$10$.6IOHBvOTxSP/R6840HSsen2/WlF8zCVy/o/jl1pi2rVI2lxCcGXW', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
