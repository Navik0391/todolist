-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 25 2020 г., 08:03
-- Версия сервера: 5.7.25
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test-beejee`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bje_task_list`
--

CREATE TABLE `bje_task_list` (
  `task_ID` int(11) UNSIGNED NOT NULL,
  `username` varchar(160) NOT NULL,
  `email` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `edited` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `bje_task_list`
--

INSERT INTO `bje_task_list` (`task_ID`, `username`, `email`, `text`, `edited`, `status`) VALUES
(30, 'test', 'test@test.com', 'test job 2', '1', '1'),
(31, 'test 2', 'test@test.com', '&lt;script&gt;alert(&#039;test&#039;);&lt;/script&gt;', '0', '1'),
(32, 'test 3', 'test@test.com', 'test job 3', '1', '1'),
(33, 'test 4', 'test.4@test.com', 'test job 4', '0', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `bje_user`
--

CREATE TABLE `bje_user` (
  `ID` int(11) NOT NULL,
  `login` varchar(160) NOT NULL,
  `email` varchar(160) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `bje_user`
--

INSERT INTO `bje_user` (`ID`, `login`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$XACXD4XD/XHo7xs8rwmZ0ut2ShRhztfBxAqs/KnvbEKsJpKThMb4W', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bje_task_list`
--
ALTER TABLE `bje_task_list`
  ADD PRIMARY KEY (`task_ID`);

--
-- Индексы таблицы `bje_user`
--
ALTER TABLE `bje_user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bje_task_list`
--
ALTER TABLE `bje_task_list`
  MODIFY `task_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `bje_user`
--
ALTER TABLE `bje_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
