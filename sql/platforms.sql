-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2021 at 08:04 PM
-- Server version: 10.2.38-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhardygr_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
                             `platformId` int(11) NOT NULL,
                             `platformName` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`platformId`, `platformName`) VALUES
(1, 'PC'),
(2, 'Playstation 3'),
(3, 'Playstation 4'),
(4, 'Playstation 5'),
(5, 'Xbox 360'),
(6, 'Xbox One'),
(7, 'Xbox Series X'),
(8, 'Gamecube'),
(9, 'Wii'),
(10, 'Wii U'),
(11, 'Switch'),
(12, 'DS'),
(13, '3DS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
    ADD PRIMARY KEY (`platformId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
    MODIFY `platformId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
