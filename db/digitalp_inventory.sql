-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 13, 2017 at 11:13 AM
-- Server version: 5.5.45-37.4-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `digitalp_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Metador');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `parent_id` varchar(200) NOT NULL,
  `sl` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `sl`) VALUES
(1, 'Stationary', '-1', 1),
(2, 'Furniture', '-1', 1),
(3, 'Computer Goods', '-1', 1),
(4, 'Software', '-1', 1),
(5, 'Cookeries', '-1', 1),
(6, 'Beverage', '-1', 1),
(7, 'Machinary', '-1', 1),
(8, 'Electrical', '-1', 1),
(9, 'à¦•à¦¾à¦—à¦œ', '1', 1),
(10, 'à¦•à¦²à¦®', '1', 1),
(11, 'à¦ªà§‡à¦¨à¦¸à¦¿à¦²', '1', 1),
(12, 'à¦ªà§‡à¦¨à¦¸à¦¿à¦² à¦•à¦¾à¦Ÿà¦¾à¦°', '1', 1),
(13, 'à¦°à§‡à¦œà¦¿à¦¸à§à¦Ÿà¦¾à¦°', '1', 1),
(14, 'à¦«à¦¾à¦‡à¦²', '1', 1),
(15, 'à¦•à¦¾à¦à¦šà¦¿', '1', 1),
(16, 'à¦•à¦²à¦®à¦¦à¦¾à¦¨à¦¿', '1', 1),
(17, 'à¦ªà§‡à¦ªà¦¾à¦° à¦“à§Ÿà§‡à¦Ÿ', '1', 1),
(18, 'à¦Ÿà§‡à¦ª', '1', 1),
(19, 'à¦¸à§à¦Ÿà¦¾à¦ªà¦²à¦¾à¦°', '1', 1),
(20, 'à¦•à§à¦²à¦¿à¦ª', '1', 1),
(21, 'à¦•à§à¦²à¦¿à¦ª à¦¬à§‹à¦°à§à¦¡', '1', 1),
(22, 'à¦«à§‹à¦²à§à¦¡à¦¾à¦°', '1', 1),
(23, 'à¦à¦¨à§à¦Ÿà¦¿ à¦•à¦¾à¦Ÿà¦¾à¦°', '1', 1),
(24, 'à¦›à§à¦°à¦¿', '1', 1),
(25, 'à¦ªà¦¿à¦¨', '1', 1),
(26, 'à¦‡à¦°à§‡à¦œà¦¾à¦°', '1', 1),
(27, 'à¦†à¦ à¦¾', '1', 1),
(28, 'à¦®à§Ÿà¦²à¦¾à¦° à¦à§à§œà¦¿', '1', 1),
(29, 'à¦¸à¦¿à¦² à¦ªà§à¦¯à¦¾à¦¡', '1', 1),
(30, 'à¦¬à¦¾à¦‡à¦¨à§à¦¡à¦¿à¦‚ à¦®à§‡à¦¶à¦¿à¦¨', '7', 1),
(31, 'à¦ªà¦¾à¦¨à§à¦¸ à¦®à§‡à¦¶à¦¿à¦¨', '1', 1),
(32, 'à¦²à§‡à¦®à§à¦¨à§‡à¦¶à§‡à¦¨ à¦®à§‡à¦¶à¦¿à¦¨', '7', 1),
(33, 'à¦–à¦¾à¦®', '1', 1),
(34, 'à¦“à§Ÿà¦¾à¦¶', '1', 1),
(35, 'à¦•à§à¦¯à¦¾à¦²à¦•à§à¦²à§‡à¦Ÿà¦°', '1', 1),
(36, 'à¦•à§‡à¦¬à¦²à§â€Œà¦¸', '8', 1),
(37, 'à¦•à¦¾à¦ªà§œ', '1', 1),
(38, 'à¦Ÿà¦¿à¦¸à§à¦¯à§', '1', 1),
(39, 'à¦¸à¦¾à¦¬à¦¾à¦¨', '1', 1),
(40, 'à¦Ÿà§‡à¦¬à¦¿à¦²', '2', 1),
(41, 'à¦šà§‡à§Ÿà¦¾à¦°', '2', 1),
(42, 'à¦¸à§‹à¦«à¦¾', '2', 1),
(44, 'à¦«à¦¾à¦‡à¦² à¦°â€à§à¦¯à¦¾à¦•', '2', 1),
(45, 'à¦†à¦²à¦®à¦¿à¦°à¦¾', '2', 1),
(46, 'à¦«à¦¾à¦‡à¦² à¦•à§‡à¦¬à¦¿à¦¨à§‡à¦Ÿ', '2', 1),
(47, 'à¦¹à¦¾à¦™à§à¦—à¦¾à¦°', '2', 1),
(48, 'à¦†à§Ÿà¦¨à¦¾', '2', 1),
(49, 'à¦•à¦¾à¦ª', '5', 1),
(50, 'à¦ªà§à¦²à§‡à¦Ÿ', '5', 1),
(51, 'à¦šà¦¾à¦®à¦š', '5', 1),
(52, 'à¦—à§à¦²à¦¾à¦¸', '5', 1),
(53, 'Antivirus', '4', 1),
(54, 'à¦…à¦ªà¦¾à¦°à§‡à¦Ÿà¦° à¦¸à¦¿à¦¸à§à¦Ÿà§‡à¦®', '4', 1),
(55, 'à¦®à¦¾à¦‡à¦•à§à¦°à§‹à¦¸à¦«à¦Ÿ à¦…à¦«à¦¿à¦¸', '4', 1),
(56, 'à¦‡à¦‰à¦Ÿà¦¿à¦²à¦¿à¦Ÿà¦¿à¦¸', '4', 1),
(57, 'à¦à¦¡à§‹à¦¬ à¦«à¦Ÿà§‹à¦¶à¦ª', '4', 1),
(58, 'Vehicle', '-1', 1),
(59, 'PajeroSports', '58', 1),
(60, 'ASX Jeep', '58', 1),
(61, 'à¦®à¦Ÿà¦°à¦¸à¦¾à¦‡à¦•à§‡à¦²', '58', 1),
(62, 'à¦à§Ÿà¦¾à¦° à¦«à§à¦°à§‡à¦¶à¦¨à¦¾à¦°', '1', 1),
(63, 'à¦¹à¦¾à¦‡à¦²à¦¾à¦‡à¦Ÿà¦¾à¦°', '1', 1),
(65, 'à¦¬à§‹à¦°à§à¦¡ à¦®à¦¾à¦°à§à¦•à¦¾à¦°', '1', 1),
(66, 'à¦¹à¦¾à¦°à¦ªà¦¿à¦•', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`) VALUES
(1, 'blue');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `requisition_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `user_id`, `orderid`, `requisition_id`, `created`) VALUES
(1, 3, 316066, 1, '2016-11-28 00:00:00'),
(2, 3, 328062, 4, '2016-11-29 00:00:00'),
(3, 3, 328063, 7, '2016-12-05 00:00:00'),
(4, 3, 328064, 8, '2016-12-06 00:00:00'),
(5, 3, 328065, 9, '2016-12-06 00:00:00'),
(6, 3, 328066, 10, '2016-12-06 00:00:00'),
(7, 3, 328067, 5, '2016-12-06 00:00:00'),
(8, 3, 328068, 13, '2016-12-19 14:00:25'),
(9, 3, 328069, 14, '2016-12-25 13:00:12'),
(10, 10, 328070, 16, '2017-01-18 05:43:31'),
(11, 10, 328071, 17, '2017-02-06 13:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `deliverydetails`
--

CREATE TABLE IF NOT EXISTS `deliverydetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` smallint(6) NOT NULL,
  `product_id` int(11) NOT NULL,
  `measure_id` smallint(6) NOT NULL,
  `deliveries_id` int(11) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `ddate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `deliverydetails`
--

INSERT INTO `deliverydetails` (`id`, `quantity`, `product_id`, `measure_id`, `deliveries_id`, `purpose`, `ddate`) VALUES
(1, 100, 1, 1, 1, '', '2016-11-28'),
(2, 5, 1, 1, 2, '', '2016-11-29'),
(3, 1, 2, 1, 2, '', '2016-11-29'),
(4, 1, 3, 1, 2, '', '2016-11-29'),
(5, 1, 4, 1, 2, '', '2016-11-29'),
(6, 5, 1, 1, 3, '', '2016-12-05'),
(7, 1, 4, 1, 3, '', '2016-12-05'),
(8, 8, 1, 1, 4, '', '2016-12-06'),
(9, 1, 3, 1, 4, '', '2016-12-06'),
(10, 22, 1, 1, 5, '', '2016-12-06'),
(11, 8, 4, 1, 5, '', '2016-12-06'),
(12, 5, 1, 1, 6, '', '2016-12-06'),
(13, 1, 4, 1, 6, '', '2016-12-06'),
(14, 5, 2, 1, 7, '', '2016-12-06'),
(15, 226, 8, 1, 8, '', '2016-12-19'),
(16, 10, 1, 1, 9, '', '2016-12-25'),
(17, 1, 2, 1, 9, '', '2016-12-25'),
(18, 1, 3, 1, 9, '', '2016-12-25'),
(19, 2, 7, 1, 9, '', '2016-12-25'),
(20, 1, 8, 1, 9, '', '2016-12-25'),
(21, 2, 3, 1, 10, '', '2017-01-18'),
(22, 1, 7, 1, 10, '', '2017-01-18'),
(23, 5, 1, 1, 11, '', '2017-02-06'),
(24, 1, 3, 1, 11, '', '2017-02-06'),
(25, 1, 4, 1, 11, '', '2017-02-06'),
(26, 1, 7, 1, 11, '', '2017-02-06'),
(27, 1, 8, 1, 11, '', '2017-02-06');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`) VALUES
(1, 'ADMINISTRATION', '1'),
(3, 'FINANCE', '1'),
(4, 'PLANNING & DEVELOPMENT', '1'),
(5, 'SYSTEM & TRAINING', '1');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE IF NOT EXISTS `designations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `status`) VALUES
(1, 'Director General', '1'),
(2, 'Additional Director General', '1'),
(3, 'Systems Manager', '1'),
(4, 'Director (Planning & Development) ', '1'),
(5, 'Director (Admin & Finance)', '1'),
(6, 'Deputy Director (Administration)', '1'),
(7, 'Deputy Director (Systems and Training)', '1'),
(8, 'Assistant Director (Administration)', '1'),
(9, 'Assistant Director (Services)', '1'),
(10, 'Assistant Director (Finance)', '1'),
(11, 'Assistant Director (Planning and Development)', '1'),
(12, 'Assistant Programmer (Planning and Development)', '1'),
(13, 'Assistant Programmer (Systems and Training)', '1'),
(14, 'Assistant Programmer', '1'),
(15, 'Administrative Officer', '1'),
(16, 'Deputy Director (Finance)', '1'),
(17, 'Assistant Network Engineer', '1');

-- --------------------------------------------------------

--
-- Table structure for table `measures`
--

CREATE TABLE IF NOT EXISTS `measures` (
  `id` smallint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `measures`
--

INSERT INTO `measures` (`id`, `name`) VALUES
(1, 'Piece');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `pcid` int(11) NOT NULL,
  `productcode` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `measure_id` smallint(6) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `limitation` tinyint(4) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `pcid`, `productcode`, `name`, `price`, `measure_id`, `brand_id`, `size_id`, `color_id`, `limitation`, `description`, `status`) VALUES
(1, 1, 10, 'PMET01', 'à¦®à§‡à¦Ÿà¦¾à¦¡à§‹à¦°', 1, 1, NULL, NULL, NULL, 2, 'asdfaaasdf', '1'),
(2, 1, 11, 'HB01', 'HB', 1, 1, NULL, NULL, NULL, 2, 'HP Pencil', '1'),
(3, 4, 53, 'Kaspersky01', 'Kaspersky', 1, 1, NULL, NULL, NULL, 1, 'Kaspersky Password Manager', '1'),
(4, 4, 53, 'Kaspersky02', 'Kaspersky IS', 1, 1, NULL, NULL, NULL, 1, 'Kaspersky Internet Security', '1'),
(6, 58, 59, 'PS2014', 'PajeroSports', 1, 1, NULL, NULL, NULL, 2, 'asd', '1'),
(7, 1, 9, 'PA480gm', 'A4 (80gm)', 1, 1, NULL, NULL, NULL, 1, 'PA480gm Double A', '1'),
(8, 1, 62, 'airfreshner01', 'Air Freshner', 1, 1, NULL, NULL, NULL, 2, 'à¦à§Ÿà¦¾à¦° à¦«à§à¦°à§‡à¦¶à¦¨à¦¾à¦°', '1'),
(9, 1, 10, 'PG01', 'Gel', 1, 1, NULL, NULL, NULL, 1, 'High Quality Pen', '1'),
(10, 1, 63, 'SHR', 'à¦²à¦¾à¦²', 1, 1, NULL, NULL, NULL, 1, 'haighlighter', '1'),
(11, 1, 27, 'FB01', 'à¦«à§‡à¦¬à¦¿à¦¸à§à¦Ÿà¦¿à¦• à¦†à¦ à¦¾', 1, 1, NULL, NULL, NULL, 0, 'FB01', '1'),
(12, 1, 14, 'FM01', 'à¦®à¦¿à¦Ÿà¦¿à¦‚', 1, 1, NULL, NULL, NULL, 1, 'FM01', '1'),
(13, 1, 23, 'ACUTTER01', 'à¦•à¦¾à¦Ÿà¦¾à¦°', 1, 1, NULL, NULL, NULL, 1, 'à¦•à¦¾à¦Ÿà¦¾à¦°', '1'),
(14, 1, 14, 'DCF01', 'à¦¡à¦¾à¦¬à¦² à¦•à§à¦²à¦¿à¦ª', 1, 1, NULL, NULL, NULL, 1, 'DCF01', '1'),
(15, 1, 20, 'BCLIP01', 'à¦¬à¦¾à¦‡à¦¨à§à¦¡à¦¾à¦° (à¦›à§‹à¦Ÿ)', 1, 1, NULL, NULL, NULL, 1, 'BCLIP01', '1'),
(16, 1, 10, 'PSEM01', 'à¦¸à§‡à¦®à¦¿à¦¨à¦¾à¦°', 1, 1, NULL, NULL, NULL, 1, 'PSEM01', '1'),
(17, 1, 27, 'GTUBE01', 'à¦Ÿà¦¿à¦‰à¦¬', 1, 1, NULL, NULL, NULL, 0, 'GTUBE01', '1'),
(18, 1, 19, 'SM01', 'à¦¸à§à¦Ÿà¦¾à¦ªà¦²à¦¾à¦° à¦®à§‡à¦¶à¦¿à¦¨ (à¦›à§‹à¦Ÿ)', 1, 1, NULL, NULL, NULL, 0, 'SM01', '1'),
(19, 1, 19, 'SM02', 'à¦¸à§à¦Ÿà¦¾à¦ªà¦²à¦¾à¦° (à¦¬à§œ)', 1, 1, NULL, NULL, NULL, 0, 'SM02', '1'),
(20, 1, 11, 'PFC01', 'à¦«à¦¾à¦‡à¦¬à¦¾à¦° à¦•à¦¾à¦¸à§à¦Ÿà§‡à¦²', 1, 1, NULL, NULL, NULL, 0, 'PFC01', '1'),
(21, 1, 11, 'PG01', 'à¦¸à¦¾à¦§à¦¾à¦°à¦£', 1, 1, NULL, NULL, NULL, 0, 'PG01', '1'),
(22, 1, 65, 'WBM01', 'à¦“à§Ÿà¦¾à¦‡à¦Ÿ à¦¬à§‹à¦°à§à¦¡ à¦®à¦¾à¦°à§à¦•à¦¾à¦°', 1, 1, NULL, NULL, NULL, 0, 'WBM01', '1'),
(23, 1, 66, 'H01', 'à¦¹à¦¾à¦°à¦ªà¦¿à¦•', 1, 1, NULL, NULL, NULL, 0, 'H01', '1');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(120) NOT NULL,
  `location` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `designation_id`, `department_id`, `phone`, `email`, `location`) VALUES
(1, 3, 1, 1, '01245345', 'n@mail.com', 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetails`
--

CREATE TABLE IF NOT EXISTS `purchasedetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `price` float NOT NULL,
  `measure_id` smallint(6) NOT NULL,
  `ddate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `purchasedetails`
--

INSERT INTO `purchasedetails` (`id`, `product_id`, `purchase_id`, `quantity`, `price`, `measure_id`, `ddate`) VALUES
(1, 1, 1, 600, 100, 1, '2016-11-27'),
(2, 2, 2, 10, 10, 1, '2016-11-27'),
(3, 1, 3, 20, 23, 1, '2016-11-01'),
(4, 1, 4, 100, 10, 1, '2016-11-27'),
(5, 1, 5, 400, 10, 1, NULL),
(6, 1, 6, 300, 10, 1, '2016-11-28'),
(7, 1, 7, 500, 25, 1, '2016-11-28'),
(8, 3, 8, 10, 1000, 1, '2016-11-29'),
(9, 4, 9, 50, 1000, 1, '2016-11-29'),
(10, 4, 10, 40, 1100, 1, '2016-11-24'),
(11, 1, 11, 5, 12, 1, '2016-12-06'),
(12, 6, 12, 2, 6900000, 1, '2016-12-06'),
(13, 7, 13, 100, 400, 1, '2016-12-06'),
(14, 8, 14, 6, 100, 1, '2014-07-24'),
(15, 8, 15, 5, 110, 1, '2014-08-02'),
(16, 8, 16, 30, 110, 1, '2014-08-04'),
(17, 8, 17, 5, 110, 1, '2014-09-25'),
(18, 8, 18, 6, 110, 1, '2014-11-03'),
(19, 8, 19, 4, 110, 1, '2014-11-10'),
(20, 8, 20, 6, 110, 1, '2014-12-09'),
(21, 8, 21, 1, 110, 1, '2015-01-07'),
(22, 8, 22, 10, 110, 1, '2015-02-25'),
(23, 8, 23, 25, 110, 1, '2015-03-03'),
(24, 8, 24, 10, 110, 1, '2015-05-02'),
(25, 8, 25, 100, 110, 1, '2015-06-14'),
(26, 8, 26, 1, 110, 1, '2015-08-05'),
(27, 8, 27, 10, 110, 1, '2015-07-18'),
(28, 8, 28, 12, 110, 1, '2016-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(30) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `created` date NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `invoice`, `supplier_id`, `created`, `modified`) VALUES
(1, '1234', 5, '2016-11-26', '2016-11-26 11:38:40'),
(2, '15264', 4, '2016-11-27', '2016-11-26 13:37:38'),
(3, '46657', 2, '2016-11-01', '2016-11-27 06:00:04'),
(4, '254', 4, '2016-11-27', '2016-11-27 07:59:49'),
(5, '4234', 5, '2016-11-28', '2016-11-28 09:31:12'),
(6, '46546', 4, '2016-11-28', '2016-11-28 12:10:25'),
(7, '1231', 2, '2016-11-28', '2016-11-29 05:30:03'),
(8, '12345', 5, '2016-11-29', '2016-11-29 13:48:51'),
(9, '4567', 0, '2016-11-29', '2016-11-29 13:49:36'),
(10, '7894', 4, '2016-11-24', '2016-11-29 14:05:08'),
(11, '111', 0, '2016-12-06', '2016-12-06 06:47:29'),
(12, '456546', 4, '2016-12-06', '2016-12-06 13:24:35'),
(13, 'asd', 5, '2016-12-06', '2016-12-06 13:25:14'),
(14, '1234', 0, '2014-07-24', '2016-12-19 13:43:01'),
(15, '1234', 0, '2014-08-02', '2016-12-19 13:43:55'),
(16, '1234', 0, '2014-08-04', '2016-12-19 13:44:58'),
(17, '1234', 0, '2014-09-25', '2016-12-19 13:45:43'),
(18, '1234', 0, '2014-11-03', '2016-12-19 13:46:29'),
(19, '1234', 0, '2014-11-10', '2016-12-19 13:47:04'),
(20, '1234', 0, '2014-12-09', '2016-12-19 13:47:36'),
(21, '12324', 0, '2015-01-07', '2016-12-19 13:48:22'),
(22, '1234', 0, '2015-02-25', '2016-12-19 13:49:00'),
(23, '1234', 0, '2015-03-03', '2016-12-19 13:49:29'),
(24, '1234', 0, '2015-05-02', '2016-12-19 13:49:56'),
(25, '1234', 0, '2015-06-14', '2016-12-19 13:50:29'),
(26, '12134', 0, '2015-08-05', '2016-12-19 13:51:05'),
(27, '1234', 2, '2016-07-18', '2016-12-19 13:52:42'),
(28, '1234', 0, '2016-12-01', '2016-12-19 13:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `requisitiondetails`
--

CREATE TABLE IF NOT EXISTS `requisitiondetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` smallint(6) NOT NULL,
  `product_id` int(11) NOT NULL,
  `requisition_id` int(11) NOT NULL,
  `measure_id` smallint(6) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `requisitiondetails`
--

INSERT INTO `requisitiondetails` (`id`, `quantity`, `product_id`, `requisition_id`, `measure_id`, `purpose`) VALUES
(1, 100, 1, 1, 1, 'Seminar'),
(2, 1, 4, 2, 1, 'Administrative'),
(3, 1, 4, 3, 1, 'Protect PC'),
(4, 5, 1, 4, 1, ''),
(5, 1, 2, 4, 1, ''),
(6, 1, 3, 4, 1, ''),
(7, 1, 4, 4, 1, ''),
(8, 5, 2, 5, 1, 'Meeting Purpose'),
(9, 5, 2, 6, 1, ''),
(10, 4, 3, 6, 1, ''),
(11, 5, 1, 7, 1, 'Administrative'),
(12, 1, 4, 7, 1, 'Administrative'),
(13, 8, 1, 8, 1, 'Administrative'),
(14, 1, 3, 8, 1, 'Administrative'),
(15, 22, 1, 9, 1, 'Seminar'),
(16, 8, 4, 9, 1, 'Administrative'),
(17, 5, 1, 10, 1, 'Administrative'),
(18, 1, 4, 10, 1, 'Administrative'),
(19, 9, 4, 11, 1, 'Personal'),
(20, 3, 1, 12, 1, ''),
(21, 3, 3, 12, 1, ''),
(22, 3, 4, 12, 1, ''),
(23, 2, 6, 12, 1, ''),
(24, 1, 7, 12, 1, ''),
(25, 226, 8, 13, 1, 'Administrative'),
(26, 10, 1, 14, 1, 'Meeting Purpose'),
(27, 1, 2, 14, 1, 'Administrative'),
(28, 1, 3, 14, 1, 'Administrative'),
(29, 2, 7, 14, 1, 'Administrative'),
(30, 1, 8, 14, 1, 'Personal'),
(31, 10, 1, 15, 1, 'Meeting Purpose'),
(32, 2, 3, 16, 1, 'Personal'),
(33, 1, 7, 16, 1, 'Administrative'),
(34, 5, 1, 17, 1, 'Meeting Purpose'),
(35, 1, 3, 17, 1, 'Administrative'),
(36, 1, 4, 17, 1, 'Administrative'),
(37, 1, 7, 17, 1, 'Administrative'),
(38, 1, 8, 17, 1, 'Meeting Purpose');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE IF NOT EXISTS `requisitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `location` varchar(250) NOT NULL,
  `requisitionno` int(11) NOT NULL,
  `dateupdate` datetime NOT NULL,
  `status` char(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `user_id`, `location`, `requisitionno`, `dateupdate`, `status`, `created`) VALUES
(1, 2, 'IT', 87227, '2016-12-07 12:24:08', '2', '2016-11-28 12:06:49'),
(2, 2, 'ADMINISTRATIOn', 38437, '2016-11-29 14:01:44', '2', '2016-11-29 13:50:24'),
(3, 2, 'ADMINISTRATION', 57305, '0000-00-00 00:00:00', '3', '2016-11-29 13:52:49'),
(4, 2, 'ADMINISTRATION', 81274, '2016-11-29 14:01:29', '4', '2016-11-29 14:00:14'),
(5, 2, 'ADMINISTRATION', 87228, '2016-12-04 13:09:20', '4', '2016-12-04 13:07:30'),
(6, 2, 'ADMINISTRATION', 87229, '0000-00-00 00:00:00', '1', '2016-12-04 13:28:16'),
(7, 2, 'ADMINISTRATION', 87230, '2016-12-05 09:53:57', '4', '2016-12-05 09:50:15'),
(8, 6, 'ADMINISTRATION', 87231, '2016-12-06 05:45:57', '4', '2016-12-06 05:42:29'),
(9, 6, 'ADMINISTRATION', 87232, '2016-12-06 06:32:20', '4', '2016-12-06 06:31:12'),
(10, 6, 'ADMINISTRATION', 87233, '2016-12-07 12:24:22', '2', '2016-12-06 10:01:31'),
(11, 2, 'ADMINISTRATION', 87234, '2016-12-14 12:16:09', '2', '2016-12-14 12:06:29'),
(12, 2, 'ADMINISTRATION', 87235, '0000-00-00 00:00:00', '1', '2016-12-19 13:32:39'),
(13, 2, 'ADMINISTRATION', 87236, '2016-12-19 13:58:55', '4', '2016-12-19 13:57:51'),
(14, 6, 'ADMINISTRATION', 87237, '2016-12-25 12:59:10', '4', '2016-12-25 12:44:48'),
(15, 2, 'ADMINISTRATION', 87238, '0000-00-00 00:00:00', '1', '2017-01-08 12:54:12'),
(16, 6, 'ADMINISTRATION', 87239, '2017-01-18 05:40:50', '4', '2017-01-18 05:39:19'),
(17, 6, 'ADMINISTRATION', 87240, '2017-02-06 13:25:19', '4', '2017-02-06 13:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(150) NOT NULL,
  `metadescription` varchar(500) NOT NULL,
  `email` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE IF NOT EXISTS `sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`) VALUES
(1, 'A4');

-- --------------------------------------------------------

--
-- Table structure for table `stockacrchives`
--

CREATE TABLE IF NOT EXISTS `stockacrchives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `stockIn` float NOT NULL,
  `stockOut` float NOT NULL,
  `balance` float NOT NULL,
  `sdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `stockacrchives`
--

INSERT INTO `stockacrchives` (`id`, `product_id`, `stockIn`, `stockOut`, `balance`, `sdate`) VALUES
(1, 1, 1540, 240, 1300, '2016-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `price` float NOT NULL,
  `measure_id` smallint(11) NOT NULL,
  `status` char(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime NOT NULL,
  `ddate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `quantity`, `price`, `measure_id`, `status`, `created`, `modified`, `ddate`) VALUES
(1, 1, 820, 500, 1, '1', '2016-11-27 11:31:13', '2016-11-27 11:31:13', '2016-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `email` varchar(120) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `contactperson` varchar(90) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile`, `email`, `address`, `contactperson`, `status`) VALUES
(2, 'mohin', '12345', 'm@gmail.com', 'Chittagong', 'mansura', '0'),
(4, 'Nishu', '01234235', 'n@mail.com', 'asdf', 'her', '0'),
(5, 'SN', '01234235543543', 's@mail.com', 'asgasg', 'hmmm', '0'),
(6, 'fgdfgdfg', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(7, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(8, 'ALAM ENTERPRISE', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(9, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(10, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(11, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(12, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(13, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(14, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(15, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(16, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(17, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(18, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(19, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1'),
(20, 'ABC', '0', 'a@a.com', 'n/a', 'n/a', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `username` varchar(50) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(90) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `department_id`, `designation_id`, `role`, `name`, `username`, `mobile`, `email`, `password`, `status`) VALUES
(5, 1, 8, 4, 'Super Admin', 'istiyak', '01918101885', 'istiyak@doict.gov.bd', '6ae967a9371c42675f0ec89b273f1d0376e09a07', '1'),
(6, 1, 8, 3, 'Sabbir Hassan Murad', 'sabbir', '01719143356', 'murad.dub@gmail.com', 'd3e7482cf930b6d541c357d1914b936d2dd8567b', '1'),
(8, 1, 1, 1, 'admin', 'admin', '567', 'n@gmail.com', 'd3e7482cf930b6d541c357d1914b936d2dd8567b', '1'),
(10, 5, 2, 2, 'storekeeper', 'storekeeper', '57', 'n@gmail.com', 'd3e7482cf930b6d541c357d1914b936d2dd8567b', '1'),
(11, 1, 1, 1, 'requisitioner', 'requisitioner', '345', 'n@gmail.com', 'd3e7482cf930b6d541c357d1914b936d2dd8567b', '1'),
(12, 1, 1, 3, 'Banamali Bhowmick', 'dg', '', 'banamalibhowmick@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(13, 1, 2, 3, 'Maliha Nargis', 'adg', '+8801720069564', 'malihanargis@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(14, 5, 3, 3, 'Md. Mohsinul Alam', 'sm', '+8801550151109', 'mohsin@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(15, 4, 4, 3, 'IQBAL MAHMUD', 'iqbal', '+8801550151090', 'iqbal@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(16, 1, 5, 3, 'Md. Rezaul Maksud Jahedi', 'jahedi', '+8801711166328', 'jahedi6076@yahoo.com', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(17, 3, 16, 3, 'Sheikh Matiar Rahman', 'matiar', '+8801711585323', 'matiars@yahoo.com', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(18, 1, 6, 1, 'Mustain Billah', 'mustain', '+8801752039572', 'mustain15166@gmail.com', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(19, 5, 7, 3, 'Md. Rabiul Islam', 'rabiul', '+8801777259991', 'rabiul@doict.gov.bd', '6779284ce975d4b1b08b08d764b848e4e99f7002', '1'),
(20, 4, 12, 3, 'Jamil Ahmed bhuiyan', 'jamil', '+8801726231123', 'jamil@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(21, 4, 11, 3, 'Mohammad Naeem Hasan', 'naeem', '+8801558749990', 'naeem@doict.gov.bd', '6779284ce975d4b1b08b08d764b848e4e99f7002', '1'),
(22, 1, 9, 3, 'Md. Shohidul Islam', 'Shohidul', '+8801717406362', 'shohid@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(23, 4, 14, 3, 'Md. Abdullah-Al-Bayazid', 'bayazid', '+8801713822228', 'bayazid.ap@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(24, 5, 13, 3, 'Yeasmin Akter', 'yeasmin', '+8801715962194', 'yeasmin@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(25, 3, 10, 3, 'S. M. Aynul Islam', 'aynul', '+8801721327620', 'aynul@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(26, 5, 17, 2, 'Ayesha Siddiqua', 'ayesha', '+8801913551699', 'ayesha@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(27, 3, 14, 3, 'Md. Abu Zafor', 'zafor', '+8801719984357', 'zafor@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(28, 1, 14, 3, 'Subarna Rani Sarkar', 'Subarna', '01717385252', 'subarna@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(29, 1, 14, 3, 'S.M Al Mahmud', 'Mahmud', '01719921365', 'almahmud@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(30, 4, 14, 3, 'Md. zahidul Islam', 'zahidul', '01534863207', 'zahid@doict.gov.bd', '3212009291bb8532282161fb4b02aa7f01bbb60d', '1'),
(31, 1, 15, 1, 'Superadmin', 'Superadmin', '54677', 'n@gmail.com', 'd3e7482cf930b6d541c357d1914b936d2dd8567b', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
