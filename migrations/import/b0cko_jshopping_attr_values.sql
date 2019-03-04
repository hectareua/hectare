-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: hectare.mysql.ukraine.com.ua
-- Generation Time: Sep 28, 2016 at 12:34 PM
-- Server version: 5.6.27-75.0-log
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hectare_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `b0cko_jshopping_attr_values`
--

CREATE TABLE IF NOT EXISTS `b0cko_jshopping_attr_values` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_id` int(11) NOT NULL,
  `value_ordering` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `name_uk-UA` varchar(255) NOT NULL,
  PRIMARY KEY (`value_id`),
  KEY `attr_id` (`attr_id`),
  KEY `value_ordering` (`value_ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `b0cko_jshopping_attr_values`
--

INSERT INTO `b0cko_jshopping_attr_values` (`value_id`, `attr_id`, `value_ordering`, `image`, `name_en-GB`, `name_ru-RU`, `name_uk-UA`) VALUES
(1, 1, 3, '', '', '5л', '5л'),
(2, 1, 2, '', '', '1л', '1л'),
(3, 1, 5, '', '', '20л', '20л'),
(4, 2, 1, '', '', '2014', '2014'),
(5, 2, 2, '', '', '2015', '2015'),
(6, 1, 1, '', '', '0,5', '0,5'),
(7, 1, 4, '', '', '10л', '10л'),
(8, 1, 6, '', '', '1 п.о.', '1 п.о'),
(9, 1, 14, '', '', '20 кг', '20 кг'),
(10, 1, 9, '', '', '2кг', '2 кг'),
(11, 1, 7, '', '', '1 кг', '1 кг'),
(12, 1, 12, '', '', '10 кг', '10 кг'),
(13, 1, 16, '', '', '30 кг', '30 кг'),
(14, 1, 15, '', '', '25 кг', '25 кг'),
(15, 1, 13, '', '', '15 кг', '15 кг'),
(16, 1, 9, '', '', '3 кг', '3 кг'),
(17, 1, 11, '', '', '5 кг', '5 кг'),
(18, 1, 10, '', '', '1,5 кг', '1,5 кг'),
(19, 1, 17, '', '', '4 мл', '4 мл'),
(20, 1, 19, '', '', '20 мл', '20 мл'),
(21, 1, 20, '', '', '100 мл', '100 мл'),
(22, 1, 22, '', '', '500 мл', '500 мл'),
(23, 1, 18, '', '', '10 мл', '10 мл'),
(25, 1, 24, '', '', '10 г', '10 г'),
(26, 1, 25, '', '', '200 г', '200 г'),
(27, 1, 21, '', '', '300 мл', '300 мл'),
(28, 1, 23, '', '', '1000 мл', '1000 мл'),
(29, 1, 26, '', '', '1 г', '1 г'),
(30, 1, 27, '', '', '5 г', '5 г'),
(31, 1, 28, '', '', '15 мл', '15 мл'),
(32, 1, 29, '', '', '50 мл', '50 мл'),
(33, 1, 30, '', '', '250 мл', '250 мл'),
(34, 1, 31, '', '', '30 г', '30 г'),
(35, 1, 32, '', '', '0.4 кг', '0.4 кг'),
(36, 1, 33, '', '', '0.8 кг', '0.8 кг'),
(37, 1, 34, '', '', '1.2 кг', '1.2 кг'),
(38, 1, 35, '', '', '0.5 г', '0.5 г'),
(39, 1, 36, '', '', '0.3 г', '0.3 г'),
(40, 1, 37, '', '', '0.4 г', '0.4 г'),
(41, 1, 38, '', '', '1 г', '1 г'),
(42, 1, 39, '', '', '2 г', '2 г'),
(43, 1, 40, '', '', '3 г', '3 г'),
(44, 1, 41, '', '', '1.4 г', '1.4 г'),
(45, 1, 42, '', '', '250 г', '250 г'),
(46, 1, 43, '', '', '45 мл', '45 мл'),
(47, 1, 44, '', '', '3 мл', '3 мл'),
(48, 1, 45, '', '', '40 г', '40 г'),
(49, 1, 46, '', '', 'Стандарт', 'Стандарт'),
(50, 1, 47, '', '', 'Екстра', 'Екстра');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
