-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 18 2016 г., 16:10
-- Версия сервера: 5.5.47-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `loglist`
--

CREATE TABLE IF NOT EXISTS `loglist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `message` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `loglist`
--

INSERT INTO `loglist` (`id`, `date`, `message`) VALUES
(1, '2016-04-18 16:07:17', 'Page was updated'),
(2, '2016-04-18 16:07:38', 'Page was updated'),
(3, '2016-04-18 16:07:42', 'Page was updated'),
(4, '2016-04-18 16:08:21', 'Page was updated'),
(5, '2016-04-18 16:08:24', 'Page was updated'),
(6, '2016-04-18 16:08:33', 'Page was updated'),
(7, '2016-04-18 16:08:34', 'Page was updated'),
(8, '2016-04-18 16:08:35', 'Page was updated'),
(9, '2016-04-18 16:08:37', 'Page was updated'),
(10, '2016-04-18 16:08:37', 'Page was updated');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
