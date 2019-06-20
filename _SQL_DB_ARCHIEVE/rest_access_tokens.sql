-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Час створення: Чрв 20 2019 р., 18:50
-- Версія сервера: 5.5.28-log
-- Версія PHP: 5.4.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `yii2_rest`
--

-- --------------------------------------------------------

--
-- Структура таблиці `rest_access_tokens`
--

CREATE TABLE IF NOT EXISTS `rest_access_tokens` (
  `rest_tokens` varchar(88) NOT NULL,
  `r_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `rest_access_tokens`
--

INSERT INTO `rest_access_tokens` (`rest_tokens`, `r_user`) VALUES
('gXupcWw8I4u5oiKyFfsMCTVzq_RwWFb-', 4),
('57Wpa-dlg-EonG6kB3myfsEjpo7v8R5b', 4),
('LmToPxeUjgx0sC6CwFljaE2PLfTQu2Fz', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
