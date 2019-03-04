-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: hectare.mysql.ukraine.com.ua
-- Generation Time: Sep 28, 2016 at 12:32 PM
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
-- Table structure for table `b0cko_assets`
--

CREATE TABLE IF NOT EXISTS `b0cko_assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `b0cko_assets`
--

INSERT INTO `b0cko_assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES
(123, 71, 155, 156, 3, 'com_content.article.14', 'Застосування гербіцидів у городі', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(124, 71, 157, 158, 3, 'com_content.article.15', 'Що таке гербіциди', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(143, 71, 159, 160, 3, 'com_content.article.19', 'Шкода і користь гербіцидів', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(145, 71, 161, 162, 3, 'com_content.article.21', 'Фунгіциди - помічники в боротьбі з інфекціями рослин', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(147, 71, 163, 164, 3, 'com_content.article.23', 'Фунгіциди - засоби боротьби із захворюваннями рослин', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(149, 71, 165, 166, 3, 'com_content.article.25', 'Види і дія інсектицидів', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(151, 71, 167, 168, 3, 'com_content.article.27', 'Боротьба з комахами - шкідниками', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(153, 71, 169, 170, 3, 'com_content.article.29', 'Для чого використовуються протруйники насіння і що це таке?', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(155, 71, 171, 172, 3, 'com_content.article.31', 'Способи обробки насіння протруйниками', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(157, 71, 173, 174, 3, 'com_content.article.33', 'Родентициди - прекрасні засоби у боротьбі з гризунами.', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(159, 71, 175, 176, 3, 'com_content.article.35', 'Родентициди - надійний захист для посівів, дерев, чагарників.', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(161, 71, 177, 178, 3, 'com_content.article.37', 'Застосування фумігантів.', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(163, 71, 179, 180, 3, 'com_content.article.39', 'Фумігація - надійний захист від шкідників і захворювань.', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(165, 71, 181, 182, 3, 'com_content.article.41', 'Використання десикант дикват.', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(167, 71, 183, 184, 3, 'com_content.article.43', 'Використання мікродобрива Авангард - запорука високого врожаю.', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(169, 71, 185, 186, 3, 'com_content.article.45', 'Селітра - прекрасне добриво для будь-яких рослин.', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(171, 71, 187, 188, 3, 'com_content.article.47', 'Навіщо потрібні регулятори росту рослин', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(173, 71, 189, 190, 3, 'com_content.article.49', 'Застосування регуляторів росту в саду', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(175, 71, 191, 192, 3, 'com_content.article.51', 'Використання десикантів', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(177, 71, 193, 194, 3, 'com_content.article.53', 'Десиканти - помічники аграрія у зборі врожаю.', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(179, 71, 195, 196, 3, 'com_content.article.55', 'Використання хімічних препаратів на власній ділянці.', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(181, 71, 197, 198, 3, 'com_content.article.57', 'Боротьба з бур''янами - робота для гербіцидів.', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(183, 71, 199, 200, 3, 'com_content.article.59', 'Засоби захисту рослин', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(185, 71, 201, 202, 3, 'com_content.article.61', 'Сучасні засоби захисту рослин.', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(188, 71, 203, 204, 3, 'com_content.article.64', 'Евро-лайтнінг гербіцид', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(192, 71, 205, 206, 3, 'com_content.article.68', 'Гербіцид Раундап', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(194, 71, 207, 208, 3, 'com_content.article.70', 'Гербицід Гранстар', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(196, 71, 209, 210, 3, 'com_content.article.72', 'Гербіцид для соняшника', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(198, 71, 211, 212, 3, 'com_content.article.74', 'Гербіциди для кукурудзи', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(200, 71, 213, 214, 3, 'com_content.article.76', 'Гербіциди суцільної дії', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(202, 71, 215, 216, 3, 'com_content.article.78', 'Грунтові гербіциди', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(204, 71, 217, 218, 3, 'com_content.article.80', 'Гербіциди Укравіт', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(206, 71, 219, 220, 3, 'com_content.article.82', 'Протруйники насіння', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(208, 71, 221, 222, 3, 'com_content.article.84', 'Протруйник Раксил Ультра', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(210, 71, 223, 224, 3, 'com_content.article.86', 'Матадор протруйник', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(212, 71, 225, 226, 3, 'com_content.article.88', 'Сідопрід протруйник', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(215, 71, 227, 228, 3, 'com_content.article.91', 'Фунгіциди для винограду', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(217, 71, 229, 230, 3, 'com_content.article.93', 'Фунгіцид на зернові', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(219, 71, 231, 232, 3, 'com_content.article.95', 'Фумігант Селфос', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(221, 71, 233, 234, 3, 'com_content.article.97', 'Інсектициду Хлорпірівіт', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(223, 71, 235, 236, 3, 'com_content.article.99', 'Фас інсектицид', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(225, 71, 237, 238, 3, 'com_content.article.101', 'АКЦІЯ!!!', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(227, 71, 239, 240, 3, 'com_content.article.103', 'Карбамід', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(229, 71, 241, 242, 3, 'com_content.article.105', 'УкраВіт', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(231, 71, 243, 244, 3, 'com_content.article.107', 'Пестициди в Україні', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(233, 71, 245, 246, 3, 'com_content.article.109', 'Селітра', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(235, 71, 247, 248, 3, 'com_content.article.111', 'Вітаємо з Великоднем!!!', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(236, 71, 249, 250, 3, 'com_content.article.112', 'З Днем Конституції України ', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(238, 71, 251, 252, 3, 'com_content.article.114', 'З Днем Незалежності України!', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
