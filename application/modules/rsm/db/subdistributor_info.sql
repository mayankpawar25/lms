-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2018 at 01:12 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `distributor_info`
--

CREATE TABLE IF NOT EXISTS `subdistributor_info` (
  `id` int(30) NOT NULL,
  `admin_id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `postal_code` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `assigned_to` varchar(30) NOT NULL,
  `status` int(30) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributor_info`
--

INSERT INTO `subdistributor_info` (`id`, `admin_id`, `name`, `first_name`, `email`, `phone`, `street`, `city`, `state`, `postal_code`, `country`, `assigned_to`, `status`, `created`, `modified`) VALUES
(1, 1, 'Mr', 'Demo', 'admin@gmail.com', '1234567890', 'Indore', 'Indore', 'Madhya Pradesh', '450000', 'India', 'Admin', 0, '2018-06-30', '2018-06-30'),
(2, 1, 'Mr', 'Test', 'admin@gmail.com', '1234567890', 'Indore', 'Indore', 'Madhya Pradesh', '450000', 'India', 'Admin', 0, '2018-06-30', '2018-06-30'),
(3, 1, 'Mr', 'Demo', 'admin@gmail.com', '1234567890', 'Indore', 'Indore', 'Madhya Pradesh', '450000', 'India', 'Admin', 0, '2018-06-30', '2018-06-30'),
(4, 1, 'Mr', 'Demo', 'admin@gmail.com', '1234567890', 'Indore', 'Indore', 'Madhya Pradesh', '450000', 'India', 'Admin', 0, '2018-06-30', '2018-06-30'),
(5, 1, 'Mr', 'Demo', 'admin@gmail.com', '1234567890', 'Indore', 'Indore', 'Madhya Pradesh', '450000', 'India', 'Admin', 0, '2018-06-30', '2018-06-30'),
(6, 1, 'Mr', 'testDemo', 'admin@gmail.com', '1234567890', 'Indore', 'Indore', 'Madhya Pradesh', '450000', 'India', 'Admin', 0, '2018-06-30', '2018-06-30'),
(7, 1, 'Mr', 'testDemo', 'admin@gmail.com', '1234567890', 'Indore', 'Indore', 'Madhya Pradesh', '450000', 'India', 'Admin', 0, '2018-06-30', '2018-06-30'),
(8, 1, 'Mr', 'testDemo', 'admin@gmail.com', '1234567890', 'Indore', 'Indore', 'Madhya Pradesh', '450000', 'India', 'Admin', 0, '2018-06-30', '2018-06-30'),
(9, 1, 'Mr', 'testDemo', 'admin@gmail.com', '1234567890', 'Indore', 'Indore', 'Madhya Pradesh', '450000', 'India', 'Admin', 0, '2018-06-30', '2018-06-30'),
(10, 1, 'Mr', 'testDemo', 'admin@gmail.com', '1234567890', 'Indore', 'Indore', 'Madhya Pradesh', '450000', 'India', 'Admin', 0, '2018-06-30', '2018-06-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `distributor_info`
--
ALTER TABLE `subdistributor_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distributor_info`
--
ALTER TABLE `subdistributor_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
