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
-- Table structure for table `b0cko_jshopping_attr`
--

CREATE TABLE IF NOT EXISTS `b0cko_jshopping_attr` (
  `attr_id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_ordering` int(11) NOT NULL,
  `attr_type` tinyint(1) NOT NULL,
  `independent` tinyint(1) NOT NULL,
  `allcats` tinyint(1) NOT NULL DEFAULT '1',
  `cats` text NOT NULL,
  `group` tinyint(4) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `description_en-GB` text NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `description_ru-RU` text NOT NULL,
  `name_uk-UA` varchar(255) NOT NULL,
  `description_uk-UA` text NOT NULL,
  PRIMARY KEY (`attr_id`),
  KEY `group` (`group`),
  KEY `attr_ordering` (`attr_ordering`),
  KEY `attr_type` (`attr_type`),
  KEY `independent` (`independent`),
  KEY `allcats` (`allcats`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `b0cko_jshopping_attr`
--

INSERT INTO `b0cko_jshopping_attr` (`attr_id`, `attr_ordering`, `attr_type`, `independent`, `allcats`, `cats`, `group`, `name_en-GB`, `description_en-GB`, `name_ru-RU`, `description_ru-RU`, `name_uk-UA`, `description_uk-UA`) VALUES
(1, 1, 1, 0, 1, 'a:15:{i:0;s:1:"1";i:1;s:1:"4";i:2;s:1:"5";i:3;s:1:"6";i:4;s:1:"7";i:5;s:1:"8";i:6;s:1:"9";i:7;s:2:"10";i:8;s:2:"11";i:9;s:2:"12";i:10;s:1:"3";i:11;s:1:"2";i:12;s:2:"16";i:13;s:2:"17";i:14;s:2:"18";}', 1, '', '', 'Объем', '', 'Об''єм', ''),
(2, 2, 1, 0, 0, 'a:1:{i:0;s:2:"14";}', 0, '', '', 'Год производства', '', 'Рік виробництва', ''),
(3, 3, 1, 0, 1, 'a:0:{}', 0, '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
