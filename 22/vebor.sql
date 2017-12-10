-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 30 2017 г., 22:55
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `vebor`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gotovo`
--

CREATE TABLE IF NOT EXISTS `gotovo` (
  `gotovo_id` int(11) NOT NULL AUTO_INCREMENT,
  `gotovo_name` varchar(255) NOT NULL,
  `gotovo_placeholder` varchar(255) NOT NULL,
  `gotovo_chtoto` varchar(255) NOT NULL,
  PRIMARY KEY (`gotovo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `gotovo`
--

INSERT INTO `gotovo` (`gotovo_id`, `gotovo_name`, `gotovo_placeholder`, `gotovo_chtoto`) VALUES
(1, 'name', 'login', '<input type="text" name="name" placeholder="name" value=""/><br>'),
(2, 'password', 'password', '<input type="password" name="password" placeholder="password" value=""/><br>'),
(3, 'textarea', 'text', '<textarea rows="10" cols="45" name="textarea" placeholder="textarea" value=""></textarea><br>');

-- --------------------------------------------------------

--
-- Структура таблицы `save`
--

CREATE TABLE IF NOT EXISTS `save` (
  `save_id` int(11) NOT NULL AUTO_INCREMENT,
  `save_text` text NOT NULL,
  PRIMARY KEY (`save_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `save`
--

INSERT INTO `save` (`save_id`, `save_text`) VALUES
(1, 'name: yyyyyy  <br/>password: tyuitit  <br/>textarea: yufg,mnhj,  <br/>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
