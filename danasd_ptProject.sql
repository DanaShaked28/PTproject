-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 14, 2021 at 11:46 PM
-- Server version: 5.6.51
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `danasd_ptProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `Reports`
--

CREATE TABLE `Reports` (
  `report_no` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `AptNo` int(4) NOT NULL,
  `Details` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reports`
--

INSERT INTO `Reports` (`report_no`, `Name`, `AptNo`, `Details`) VALUES
(1, 'Dana', 45, 'n,mn,nb,'),
(2, 'lee', 14, 'n,mn'),
(3, 'lee', 14, 'aeafgs'),
(4, '<script>alert(\"Hola!\")</script', 14, 'afsa'),
(5, '<script>alert(\"Hola!\")</script', 17, 'report'),
(6, 'Dana', 65, 'eaef');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `AptNo` int(4) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `Name`, `LastName`, `Email`, `AptNo`, `Username`, `Password`, `Admin`) VALUES
(3, 'Lee', 'Shaked', 'danas001@gmail.com', 12, 'lee', '1234', 1),
(5, 'Laima', 'Roktal', 'lai@rok.com', 65, 'laima', '17177', 0),
(6, 'Dana', 'Roktal', 'danaroktal@gmail.com', 78, 'Dana', '12345', 0),
(20, 'Dana', 'Goldner', 'danas001@gmail.com', 31, 'daa283', '<script>alert(\'Boom!\')</script>', 0),
(17, 'Shay', 'Goldner', 'SG@gmail.com', 23, 'Shay', '2839', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Reports`
--
ALTER TABLE `Reports`
  ADD PRIMARY KEY (`report_no`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `AptNo.` (`AptNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Reports`
--
ALTER TABLE `Reports`
  MODIFY `report_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
