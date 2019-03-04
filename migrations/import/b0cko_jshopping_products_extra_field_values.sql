-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: hectare.mysql.ukraine.com.ua
-- Generation Time: Sep 28, 2016 at 12:36 PM
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
-- Table structure for table `b0cko_jshopping_products_extra_field_values`
--

CREATE TABLE IF NOT EXISTS `b0cko_jshopping_products_extra_field_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `ordering` int(6) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `name_uk-UA` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`),
  KEY `ordering` (`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `b0cko_jshopping_products_extra_field_values`
--

INSERT INTO `b0cko_jshopping_products_extra_field_values` (`id`, `field_id`, `ordering`, `name_en-GB`, `name_ru-RU`, `name_uk-UA`) VALUES
(1, 1, 2, '', 'Високий', 'Високий'),
(2, 1, 3, '', 'Низкий ', 'Низький'),
(3, 1, 1, '', 'Очень высокий', 'Дуже високий'),
(4, 2, 1, '', 'Сельхоз', 'Сільхоз'),
(5, 2, 2, '', 'Другие', 'Інші');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
