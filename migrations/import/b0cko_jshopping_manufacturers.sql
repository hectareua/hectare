-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: hectare.mysql.ukraine.com.ua
-- Generation Time: Sep 28, 2016 at 12:35 PM
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
-- Table structure for table `b0cko_jshopping_manufacturers`
--

CREATE TABLE IF NOT EXISTS `b0cko_jshopping_manufacturers` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_url` varchar(255) NOT NULL,
  `manufacturer_logo` varchar(255) NOT NULL,
  `manufacturer_publish` tinyint(1) NOT NULL,
  `products_page` int(11) NOT NULL,
  `products_row` int(11) NOT NULL,
  `ordering` int(6) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `alias_en-GB` varchar(255) NOT NULL,
  `short_description_en-GB` text NOT NULL,
  `description_en-GB` text NOT NULL,
  `meta_title_en-GB` varchar(255) NOT NULL,
  `meta_description_en-GB` text NOT NULL,
  `meta_keyword_en-GB` text NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `alias_ru-RU` varchar(255) NOT NULL,
  `short_description_ru-RU` text NOT NULL,
  `description_ru-RU` text NOT NULL,
  `meta_title_ru-RU` varchar(255) NOT NULL,
  `meta_description_ru-RU` text NOT NULL,
  `meta_keyword_ru-RU` text NOT NULL,
  `name_uk-UA` varchar(255) NOT NULL,
  `alias_uk-UA` varchar(255) NOT NULL,
  `short_description_uk-UA` text NOT NULL,
  `description_uk-UA` text NOT NULL,
  `meta_title_uk-UA` varchar(255) NOT NULL,
  `meta_description_uk-UA` text NOT NULL,
  `meta_keyword_uk-UA` text NOT NULL,
  PRIMARY KEY (`manufacturer_id`),
  KEY `manufacturer_publish` (`manufacturer_publish`),
  KEY `products_page` (`products_page`),
  KEY `products_row` (`products_row`),
  KEY `ordering` (`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `b0cko_jshopping_manufacturers`
--

INSERT INTO `b0cko_jshopping_manufacturers` (`manufacturer_id`, `manufacturer_url`, `manufacturer_logo`, `manufacturer_publish`, `products_page`, `products_row`, `ordering`, `name_en-GB`, `alias_en-GB`, `short_description_en-GB`, `description_en-GB`, `meta_title_en-GB`, `meta_description_en-GB`, `meta_keyword_en-GB`, `name_ru-RU`, `alias_ru-RU`, `short_description_ru-RU`, `description_ru-RU`, `meta_title_ru-RU`, `meta_description_ru-RU`, `meta_keyword_ru-RU`, `name_uk-UA`, `alias_uk-UA`, `short_description_uk-UA`, `description_uk-UA`, `meta_title_uk-UA`, `meta_description_uk-UA`, `meta_keyword_uk-UA`) VALUES
(1, '', '', 1, 16, 4, 1, '', '', '', '', '', '', '', 'Укравіт', '', '', '', '', '', '', 'Укравіт', '', '', '', '', '', ''),
(2, '', '', 1, 16, 4, 2, '', '', '', '', '', '', '', 'Sungenta', '', '', '', '', '', '', 'Sungenta', '', '', '', '', '', ''),
(3, '', '', 1, 16, 4, 3, '', '', '', '', '', '', '', 'August', '', '', '', '', '', '', 'August', '', '', '', '', '', ''),
(4, '', '', 1, 16, 4, 4, '', '', '', '', '', '', '', 'Кемілайн Агро', '', '', '', '', '', '', 'Кемілайн Агро', '', '', '', '', '', ''),
(5, '', '', 1, 16, 4, 5, '', '', '', '', '', '', '', 'DuPont', '', '', '', '', '', '', 'DuPont', '', '', '', '', '', ''),
(6, '', '', 1, 16, 4, 6, '', '', '', '', '', '', '', 'Nufarm', '', '', '', '', '', '', 'Nufarm', '', '', '', '', '', ''),
(7, '', '', 1, 16, 4, 7, '', '', '', '', '', '', '', 'BASF', '', '', '', '', '', '', 'BASF', '', '', '', '', '', ''),
(8, '', '', 1, 16, 4, 8, '', '', '', '', '', '', '', 'Bayer', '', '', '', '', '', '', 'Bayer', '', '', '', '', '', ''),
(9, '', '', 1, 16, 4, 9, '', '', '', '', '', '', '', 'Альфа Химгруп', '', '', '', '', '', '', 'Альфа Хімгруп', '', '', '', '', '', ''),
(10, '', '', 1, 16, 4, 10, '', '', '', '', '', '', '', 'Щелково Агрохим', '', '', '', '', '', '', 'Щелково Агрохім', '', '', '', '', '', ''),
(11, '', '', 1, 16, 4, 11, '', '', '', '', '', '', '', 'Rosco', '', '', '', '', '', '', 'Rosco', '', '', '', '', '', ''),
(12, '', '', 1, 16, 4, 12, '', '', '', '', '', '', '', 'ADAMA', '', '', '', '', '', '', 'ADAMA', '', '', '', '', '', ''),
(13, '', '', 1, 16, 4, 13, '', '', '', '', '', '', '', 'Shtefes', '', '', '', '', '', '', 'Shtefes', '', '', '', '', '', ''),
(14, '', '', 1, 16, 4, 14, '', '', '', '', '', '', '', 'Долина', '', '', '', '', '', '', 'Долина', '', '', '', '', '', ''),
(15, '', '', 1, 16, 4, 15, '', '', '', '', '', '', '', 'Summit agro', '', '', '', '', '', '', 'Summit agro', '', '', '', '', '', ''),
(16, '', '', 1, 16, 4, 16, '', '', '', '', '', '', '', 'Вассма', '', '', '', '', '', '', 'Вассма', '', '', '', '', '', ''),
(17, '', '1_sait_start_04.jpg', 1, 16, 4, 17, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'АСП (АгроСпецПроект)', '', '', '', '', '', ''),
(18, '', '', 1, 16, 4, 18, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'ВНІС', '', '', '', '', '', ''),
(19, '', '', 1, 16, 4, 19, '', '', '', '', '', '', '', 'Нови Сад (СЕРБІЯ)', '', '', '', '', '', '', 'Нові Сад( СЕРБІЯ)', '', '', '', '', '', ''),
(20, '', '', 1, 16, 4, 20, '', '', '', '', '', '', '', 'ЕВРАЛИС СЕМАНС / EURALIS SEMENCES (ФРАНЦИЯ)', '', '', '', '', '', '', 'ЕВРАЛИС СЕМАНС / EURALIS SEMENCES (ФРАНЦИЯ)', '', '', '', '', '', ''),
(21, '', '', 1, 16, 4, 21, '', '', '', '', '', '', '', 'ТОВ НВФ «Семагро»', '', '', '', '', '', '', 'ТОВ НВФ «Семагро»', '', '', '', '', '', ''),
(22, '', '', 1, 16, 4, 22, '', '', '', '', '', '', '', 'Doktor Tarsa (DRT).', '', '', '', '', '', '', 'Doktor Tarsa (DRT)', '', '', '', '', '', ''),
(23, '', '', 1, 16, 4, 23, '', '', '', '', '', '', '', 'Институт ЗГ УААН', '', '', '', '', '', '', 'Інститут ЗГ УААН', '', '', '', '', '', ''),
(24, '', 'logo3.jpg', 1, 16, 4, 24, '', '', '', '', '', '', '', 'Rangoli', '', '', '<p>Компания «Ранголи» была основана в 2008 году.</p>\r\n<p>Один из ключевых направлений - это производство и поставка химических средств защиты растений и агрохимикатов для сельского хозяйства. Компания уже несколько лет обеспечивает сельскохозяйственное производство высококачественными и эффективными гербицидами, десикантами, инсектицидами, фунгицидами и др. За это время работы на рынке «Ранголи» зарекомендовала себя как высококлассный производитель и надежный партнер, завоевав доверие целого ряда ведущих сельхозпредприятий. Основное производство компании расположено в Китае, обеспечивает низкую стоимость продукции, и одновременно дает возможность использовать достижения международных компаний в области производства агрохимикатов.</p>\r\n<p>Производство и поставка целого спектра медицинских средств - второй важное направление деятельности компании «Ранголи». Наши медицинские препараты - одни из самых качественных в мире, поскольку производятся на самых современных заводах с использованием новейших технологий. Все препараты сертифицированы для использования в Украине и прошли контроль качества</p>\r\n<p>Компания «Ранголи» - это надежный партнер производителей сельскохозяйственной продукции. Мы постоянно расширяем сеть партнерских организаций по всей территории стран СНГ, ища новых партнеров в области поставок пшеницы, овса, кукурузы, семян подсолнечника, рапса, сои и др. Мы организуем доставку зерновых культур во все уголки мира и гарантируем, что состав предлагаемого нами зерна соответствует всем европейским стандартам качества. Работая с нами, вы всегда можете рассчитывать на высокое качество обслуживания, оперативность и надежность. Наши специалисты проконсультируют вас относительно применения, оптимизации и использования всех препаратов и предложат наиболее выгодные условия поставки. Воспользовавшись услугами компании «Ранголи» впервые, вы сможете убедиться сами - работать с нами выгодно и удобно.</p>', '', '', '', 'Rangoli', '', '', '<p class="MsoNormal"><span style="font-family: Arial, sans-serif; color: #666666; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">Компанія «Ранголі» була заснована у 2008 році.</span></p>\r\n<p class="MsoNormal"><span style="font-size: 12.0pt; line-height: 115%; font-family: ''Arial'',''sans-serif''; mso-fareast-font-family: ''Times New Roman''; color: #666666; mso-fareast-language: RU;">Один із ключових напрямків — це виробництво та поставка хімічних засобів захисту рослин та агрохімікатів для сільського господарства. Компанія вже протягом кількох років забезпечує сільськогосподарське виробництво високоякісними та ефективними гербіцидами, десикантами, інсектицидами, фунгіцидами та ін. За цей час роботи на ринку  «Ранголі» зарекомендувала себе як висококласний виробник та надійний партнер, завоювавши довіру цілої низки провідних сільгосппідприємств. Основне виробництво компанії розташоване в Китаї, що забезпечує низьку вартість продукції, і водночас надає можливість використовувати досягнення міжнародних компаній в галузі виробництва агрохімікатів.</span></p>\r\n<p class="MsoNormal" style="margin-bottom: 15pt; text-align: justify; line-height: 17.25pt; vertical-align: baseline; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;"><span style="font-size: 12.0pt; font-family: ''Arial'',''sans-serif''; mso-fareast-font-family: ''Times New Roman''; color: #666666; mso-fareast-language: RU;">Виробництво і постачання цілого спектру медичних засобів — другий важливий напрямок діяльності компанії «Ранголі». Наші медичні препарати — одні з найбільш якісних  у світі, оскільки виробляються на найсучасніших заводах з використанням новітніх технологій. Усі препарати сертифіковані для використання в Україні і пройшли контроль якості</span></p>\r\n<p> </p>\r\n<p class="MsoNormal" style="margin-bottom: 15pt; text-align: justify; line-height: 17.25pt; vertical-align: baseline; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;"><span style="font-size: 12.0pt; font-family: ''Arial'',''sans-serif''; mso-fareast-font-family: ''Times New Roman''; color: #666666; mso-fareast-language: RU;">Компанія «Ранголі» — це надійний партнер виробників сільськогосподарської продукції. Ми постійно розширюємо мережу партнерських організацій по всій території країн СНД, шукаючи нових партнерів у галузі постачання пшениці, вівса, кукурудзи, соняшникового насіння, рапсу, сої тощо. Ми організовуємо доставку зернових культур у всі куточки світу і гарантуємо, що склад пропонованого нами зерна відповідає всім європейським стандартам якості. Працюючи з нами, ви завжди можете розраховувати на високу якість обслуговування, оперативність та надійність. Наші спеціалісти проконсультують вас відносно застосування, оптимізації та використання всіх препаратів і запропонують найбільш вигідні умови постачання. Скориставшись послугами компанії «Ранголі» вперше, ви зможете впевнитися самі — працювати з нами вигідно та зручно.</span></p>', '', '', ''),
(25, '', '', 1, 16, 6, 25, '', '', '', '', '', '', '', 'ГЕРМЕС', '', '', '', '', '', '', 'ГЕРМЕС', '', '', '', '', '', ''),
(26, '', '', 1, 16, 6, 26, '', '', '', '', '', '', '', 'Итал Тайгер', '', '', '', '', '', '', 'Итал Тайгер', '', '', '', '', '', ''),
(27, '', '', 1, 16, 6, 27, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Best', '', '', '', '', '', ''),
(28, '', '', 1, 16, 6, 28, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Україна', '', '', '', '', '', ''),
(29, '', '', 1, 16, 6, 29, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Швейцарія', '', '', '', '', '', ''),
(30, '', '', 1, 16, 6, 30, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Bros', '', '', '', '', '', ''),
(31, '', '', 1, 16, 6, 31, '', '', '', '', '', '', '', 'VERANDA', '', '', '', '', '', '', 'VERANDA', '', '', '', '', '', ''),
(32, '', '', 1, 16, 6, 32, '', '', '', '', '', '', '', 'Природная', '', '', '', '', '', '', 'Природна', '', '', '', '', '', ''),
(33, '', '', 1, 16, 6, 33, '', '', '', '', '', '', '', 'Вырасти свое', '', '', '', '', '', '', 'Вирости своє', '', '', '', '', '', ''),
(34, '', '', 1, 16, 6, 34, '', '', '', '', '', '', '', 'Herba', '', '', '', '', '', '', 'Herba', '', '', '', '', '', ''),
(35, '', '', 1, 16, 6, 35, '', '', '', '', '', '', '', 'SeedEra', '', '', '', '', '', '', 'SeedEra', '', '', '', '', '', ''),
(36, '', '', 1, 16, 6, 36, '', '', '', '', '', '', '', 'Юг Агролидео', '', '', '', '', '', '', 'Юг Агролідер', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
