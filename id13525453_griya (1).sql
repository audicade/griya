-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 02, 2021 at 01:06 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id13525453_griya`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(23, 'cobaaja', 'cobaaja@gmail.com', 'default.jpg', '$2y$10$bwHJJX7N1ucvVEiMYiER5e3col5XllsUUVG42f/u/t.xJV21oXT4.', 1, 1, 1589225942),
(24, 'Audlyn', 'audi.pratama.45@gmail.com', 'tumblr_n7rh71ytou1r31n4zo1_2501.gif', '$2y$10$iglBzcfrpQ4h8O3hgn1or.7h/DthprjGOFE/V2h5c17MjoTbk7Vum', 2, 1, 1589227178),
(25, 'admin', 'admin@gmail.com', 'default.jpg', '$2y$10$KoFPF9L7MwnciWh9DAEOouLmyYZhAx5LdehYC1tpXCDD6.AfJbT5G', 2, 1, 1589406763);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Property');

-- --------------------------------------------------------

--
-- Table structure for table `user_property`
--

CREATE TABLE `user_property` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `location` varchar(128) NOT NULL,
  `number` bigint(20) NOT NULL,
  `price` int(11) NOT NULL,
  `spec` varchar(128) NOT NULL,
  `property_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_property`
--

INSERT INTO `user_property` (`id`, `email`, `username`, `image`, `location`, `number`, `price`, `spec`, `property_id`, `is_active`, `date_created`) VALUES
(34, 'audi.pratama.45@gmail.com', 'Audlyn', 'images.jpg', 'probolinggo', 81230425724, 500000000, '1 ruang tamu, 2 kamar tidur, 1 kamar mandi, 1 dapur', 25, 1, 1589395900),
(35, 'audi.pratama.45@gmail.com', 'Audlyn', '163516128.jpg', 'Bali', 81230425724, 500000000, '1 ruang tamu, 2 kamar tidur, 1 kamar mandi, 1 dapur', 25, 0, 1589395928),
(36, 'audi.pratama.45@gmail.com', 'Audlyn', 'images_(1).jpg', 'Pasuruan', 81230425724, 500000000, '1 ruang tamu, 2 kamar tidur, 1 kamar mandi, 1 dapur', 25, 0, 1589395952),
(37, 'audi.pratama.45@gmail.com', 'Audlyn', 'rumah-dijual-lokasi-strategis-di-singopuran.jpeg', 'Banyuwangi', 81230425724, 500000000, '1 ruang tamu, 2 kamar tidur, 1 kamar mandi, 1 dapur', 25, 0, 1589395982),
(38, 'audi.pratama.45@gmail.com', 'Audlyn', 'ri_(1).jpg', 'Sidoarjo', 81230425724, 500000000, '1 ruang tamu, 2 kamar tidur, 1 kamar mandi, 1 dapur', 25, 0, 1589396011),
(41, 'audi.pratama.45@gmail.com', 'Audlyn', '1-571912823-Rumah-Minimalis-Spek-Wah-Harga-Murah-di-Bambu-Residence-3-Ungaran1.jpg', 'Pasuruan', 81230425724, 450000000, '1 ruang tamu, 2 kamar tidur, 1 kamar mandi, 1 dapur', 24, 1, 1589878519);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Anggota', 'admin', 'fas fa-fw fa-users', 1),
(5, 3, 'Pasar', 'property', 'fas fa-fw fa-store', 1),
(6, 3, 'Unggah Properti', 'property/upload', 'fas fa-fw fa-cloud-upload-alt', 1),
(8, 3, 'Data Properti', 'property/mypro', 'fas fa-fw fa-bed', 1),
(10, 1, 'Akun yang Dicekal', 'admin/ban', 'fas fa-fw fa-user-lock', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_property`
--
ALTER TABLE `user_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_property`
--
ALTER TABLE `user_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
