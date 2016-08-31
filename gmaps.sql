-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 31 2016 г., 15:12
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `gmaps`
--

-- --------------------------------------------------------

--
-- Структура таблицы `markers`
--

CREATE TABLE IF NOT EXISTS `markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(1, 'Vinsanto, wine bar', 'Pushkinska St, 20\nKiev', 50.444302, 30.517544, 'restaurant'),
(2, 'Museum of History of Kyiv', 'Bohdana Khmel''nyts''koho St, 7\nKiev', 50.445171, 30.517555, 'bar'),
(3, 'Tarasa Shevchenka Blvd', 'Tarasa Shevchenko Blvd, 14\nKyiv', 50.443275, 30.515741, 'bus stop'),
(4, 'Natsionalnyy muzey Tarasa Shevchenka', 'Tarasa Shevchenko Blvd, 12\nKyiv', 50.443455, 30.515333, 'restaurant'),
(5, 'Lesya Ukrainka National Academic', 'Bohdana Khmel''nyts''koho St, 5\nKiev', 50.444672, 30.519073, 'bar'),
(6, 'Barrel Pub', 'Богдана Хмельницького, 3 b\nKiev', 50.444534, 30.519678, 'cafe'),
(7, 'Pechersk District Court of Kyiv', 'Khreschatyk St, 42А\nKiev', 50.444065, 30.520214, 'bar'),
(8, 'Tommy Gun Barbershop', 'Tarasa Shevchenko Blvd, 4Б\nKiev', 50.443012, 30.519018, 'bar'),
(9, 'UniCredit Bank', 'Tarasa Shevchenko Blvd, 2\nKiev', 50.442692, 30.519840, 'restaurant'),
(13, 'Museum of Railway Transport', 'пл. Привокзальная, 1\r\nKiev', 50.438923, 30.487082, 'mus');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `ban` tinyint(4) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created`, `ban`, `role`, `email`) VALUES
(1, 'demo', '$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC', 0, 0, 1, 'demo@demo.com'),
(2, 'admin', '$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC', 0, 0, 2, 'admin@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
