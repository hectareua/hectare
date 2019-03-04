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
-- Table structure for table `b0cko_jshopping_products_extra_fields`
--

CREATE TABLE IF NOT EXISTS `b0cko_jshopping_products_extra_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `allcats` tinyint(1) NOT NULL,
  `cats` text NOT NULL,
  `type` tinyint(1) NOT NULL,
  `multilist` tinyint(1) NOT NULL,
  `group` tinyint(4) NOT NULL,
  `ordering` int(6) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `description_en-GB` text NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `description_ru-RU` text NOT NULL,
  `name_uk-UA` varchar(255) NOT NULL,
  `description_uk-UA` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group` (`group`),
  KEY `allcats` (`allcats`),
  KEY `type` (`type`),
  KEY `multilist` (`multilist`),
  KEY `group_2` (`group`),
  KEY `ordering` (`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `b0cko_jshopping_products_extra_fields`
--

INSERT INTO `b0cko_jshopping_products_extra_fields` (`id`, `allcats`, `cats`, `type`, `multilist`, `group`, `ordering`, `name_en-GB`, `description_en-GB`, `name_ru-RU`, `description_ru-RU`, `name_uk-UA`, `description_uk-UA`) VALUES
(1, 0, 'a:1:{i:0;s:1:"4";}', 0, 0, 1, 1, '', '', 'Спектр гербицидной активности ', '', 'Спектр гербіцидной  активности ', ''),
(2, 0, 'a:2:{i:0;s:1:"4";i:1;s:1:"5";}', 0, 0, 1, 2, '', '', 'Обрабатываемые культуры', '', 'Обробляємі культури', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
