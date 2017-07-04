DROP TABLE kwf_update;

-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 04, 2017 at 06:29 PM
-- Server version: 5.5.54-0+deb8u1
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `piaservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `kwf_updates`
--

CREATE TABLE IF NOT EXISTS `kwf_updates` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `log` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kwf_updates`
--
ALTER TABLE `kwf_updates`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kwf_updates`
--
ALTER TABLE `kwf_updates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=244;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


INSERT INTO `kwf_updates` (`id`, `name`, `executed_at`, `log`) VALUES (NULL, 'test', NULL, '');
