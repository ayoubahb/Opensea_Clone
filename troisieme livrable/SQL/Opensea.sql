-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 23, 2022 at 08:41 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Opensea`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `artist_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `name`, `email`, `password`, `artist_img`) VALUES
(8, 'ayoub', 'ayoub@gmail.com', 'ayoub', 'https://dl.dropboxusercontent.com/s/8qkef8mj4zkp289/nft2.jpeg?dl=0'),
(22, 'boura', 'boura@g.l', 'boura@g.l', 'upload_img/nft9.jpeg'),
(23, 'maekkkkkkk', 'mo@g.l', 'mo@g.', 'upload_img/nf3.jpeg'),
(25, 'younes', 'younes@l.l', 'younes@l.l', 'upload_img/Screenshot 2022-11-23 at 19.49.15.jpg'),
(26, 'cbn', 'fg@sdfg.l', 'qwertyui', 'upload_img/nf3.jpeg'),
(27, 'ec', 'dc@d.l', 'qw', 'upload_img/nft6.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `num_nfts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `name`, `artist_id`, `num_nfts`) VALUES
(34, 'Monky', 8, 4),
(35, 'Boy', 22, 2),
(36, 'Art', 23, 3),
(38, '#META#', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `nfts`
--

CREATE TABLE `nfts` (
  `id` int(11) NOT NULL,
  `img` varchar(500) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `coll_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nfts`
--

INSERT INTO `nfts` (`id`, `img`, `name`, `price`, `description`, `coll_id`) VALUES
(32, 'upload_img/nf3.jpeg', 'Monky #1', 13, 'Monky #1', 34),
(33, 'upload_img/nft1.jpeg', 'Monky #2', 10, 'Monky #2', 34),
(34, 'upload_img/nft2.jpeg', 'Monky #3', 15, 'Monky #3', 34),
(35, 'upload_img/nft4.jpeg', 'Monky #4', 44, 'Monky #4', 34),
(37, 'upload_img/nft7.jpeg', 'Boy #2', 24, 'Boy #2', 35),
(38, 'upload_img/nft8.jpeg', 'Boy #3', 50, 'Boy #3', 35),
(39, 'upload_img/nft5.jpeg', 'Art #1', 60, 'Art #1', 36),
(40, 'upload_img/nft10.jpeg', 'Art #2', 5, 'Art #2\r\n', 36),
(41, 'upload_img/nft11.jpeg', 'Art #3', 9, 'Art #3', 36),
(43, 'upload_img/Screenshot 2022-11-23 at 19.35.32.jpg', 'Meta#1', 0.12, 'meta', 38),
(44, 'upload_img/Screenshot 2022-11-23 at 19.49.15.jpg', 'Meta#2', 13, 'Meta#2', 38);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist` (`artist_id`);

--
-- Indexes for table `nfts`
--
ALTER TABLE `nfts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nfts_ibfk_1` (`coll_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `nfts`
--
ALTER TABLE `nfts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`);

--
-- Constraints for table `nfts`
--
ALTER TABLE `nfts`
  ADD CONSTRAINT `nfts_ibfk_1` FOREIGN KEY (`coll_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
