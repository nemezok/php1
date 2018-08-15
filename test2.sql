-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 29 2018 г., 15:37
-- Версия сервера: 5.7.11
-- Версия PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test2`
--
CREATE DATABASE IF NOT EXISTS `test2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test2`;

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `ID` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL DEFAULT '+79084742125'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`ID`, `name`, `phone`) VALUES
(1, 'Сергей', '+79084742125'),
(2, 'Андрей', '+79084742125'),
(3, 'Ирина', '+79084742125'),
(4, 'Кристина', '+79084742125'),
(5, 'Марина', '+79084742125'),
(6, 'Кирилл', '+79084742125'),
(7, 'Марат', '+79084742125');

-- --------------------------------------------------------

--
-- Структура таблицы `inspections`
--

CREATE TABLE IF NOT EXISTS `inspections` (
  `ID` bigint(20) NOT NULL,
  `realtor_id` bigint(20) NOT NULL,
  `object_id` bigint(20) NOT NULL,
  `weekday` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `inspections`
--

INSERT INTO `inspections` (`ID`, `realtor_id`, `object_id`, `weekday`, `date`, `time`) VALUES
(1, 1, 1, 3, '2018-07-27', 3),
(2, 2, 2, 5, '2018-07-25', 5),
(3, 2, 2, 6, '2018-07-30', 6),
(4, 4, 4, 2, '2018-07-28', 7),
(5, 1, 2, NULL, '2018-07-26', 1),
(10, 4, 2, NULL, '2018-07-30', 10),
(11, 4, 3, NULL, '2018-08-01', 3),
(12, 4, 2, NULL, '2018-07-31', 1),
(13, 4, 2, NULL, '2018-07-31', 2),
(14, 4, 2, NULL, '2018-07-31', 2),
(15, 4, 2, NULL, '2018-07-31', 2),
(16, 4, 3, NULL, '2018-08-01', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `inspection_clients`
--

CREATE TABLE IF NOT EXISTS `inspection_clients` (
  `ID` bigint(20) NOT NULL,
  `inspection_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `inspection_clients`
--

INSERT INTO `inspection_clients` (`ID`, `inspection_id`, `client_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 1, 7),
(6, 2, 6),
(16, 10, 1),
(17, 10, 2),
(18, 10, 3),
(19, 11, 4),
(20, 11, 2),
(21, 12, 1),
(22, 13, 3),
(23, 14, 3),
(24, 15, 3),
(25, 0, 1),
(26, 0, 2),
(27, 16, 2),
(28, 16, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE IF NOT EXISTS `objects` (
  `ID` bigint(20) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `objects`
--

INSERT INTO `objects` (`ID`, `address`) VALUES
(1, 'Радищева, 175'),
(2, 'Гончарова, 20'),
(3, 'Промышленная, 110'),
(4, 'Шолмова, 24');

-- --------------------------------------------------------

--
-- Структура таблицы `realtors`
--

CREATE TABLE IF NOT EXISTS `realtors` (
  `ID` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `realtors`
--

INSERT INTO `realtors` (`ID`, `name`) VALUES
(1, 'Олег'),
(2, 'Мария'),
(3, 'Юрий'),
(4, 'Наталья');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `inspections`
--
ALTER TABLE `inspections`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `inspection_clients`
--
ALTER TABLE `inspection_clients`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `realtors`
--
ALTER TABLE `realtors`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `inspections`
--
ALTER TABLE `inspections`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `inspection_clients`
--
ALTER TABLE `inspection_clients`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `objects`
--
ALTER TABLE `objects`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `realtors`
--
ALTER TABLE `realtors`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
