-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 04, 2017 at 05:51 PM
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
-- Table structure for table `kwf_pages_meta`
--

CREATE TABLE IF NOT EXISTS `kwf_pages_meta` (
	  `page_id` varchar(255) NOT NULL,
	  `domain_component_id` varchar(255) NOT NULL,
	  `subroot_component_id` varchar(255) NOT NULL,
	  `expanded_component_id` varchar(255) NOT NULL,
	  `deleted` int(11) NOT NULL,
	  `rebuilt` tinyint(4) NOT NULL,
	  `changed_date` datetime DEFAULT NULL,
	  `changed_recursive` tinyint(4) DEFAULT NULL,
	  `fulltext_indexed_date` datetime DEFAULT NULL,
	  `meta_noindex` tinyint(4) NOT NULL,
	  `sitemap_priority` decimal(2,1) NOT NULL,
	  `sitemap_changefreq` varchar(20) CHARACTER SET utf8 NOT NULL,
	  `fulltext_skip` tinyint(4) NOT NULL,
	  `url` text NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	--
-- Indexes for dumped tables
--

--
-- Indexes for table `kwf_pages_meta`
--
ALTER TABLE `kwf_pages_meta`
 ADD PRIMARY KEY (`page_id`), ADD KEY `domain_component_id` (`domain_component_id`), ADD KEY `deleted` (`deleted`), ADD KEY `expanded_component_id` (`expanded_component_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

