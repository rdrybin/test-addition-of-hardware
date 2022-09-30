-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 30 2022 г., 16:06
-- Версия сервера: 5.7.33
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_er`
--

-- --------------------------------------------------------

--
-- Структура таблицы `hardware`
--

CREATE TABLE `hardware` (
  `id` int(10) NOT NULL,
  `type_id` int(10) NOT NULL,
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `hardware`
--

INSERT INTO `hardware` (`id`, `type_id`, `serial`) VALUES
(1, 3, '7ASDFG-AAA'),
(2, 3, '7AAAAA@AAA'),
(3, 3, '7AAAAA_AAA'),
(4, 3, '7AAAAA-998'),
(17, 2, '777SD9@9as'),
(18, 2, '777SD9-Aas'),
(19, 2, '777SD9_7as'),
(26, 1, 'XXAAAAAXAA'),
(27, 1, '91SDFGCABB'),
(28, 1, 'DDDDDDDDDD'),
(35, 1, 'SSSSSSSSSS'),
(57, 1, 'FFFFFFFFFF'),
(67, 1, 'GGGGGGGGGG'),
(74, 1, 'LLLLLLLLLL'),
(76, 1, 'LLLLLLLLDL'),
(82, 1, 'LLLLLDLLDL'),
(83, 1, 'GGGGGGGDGG'),
(84, 1, 'DDDDDDFDDD'),
(85, 1, 'LLDLLDLLDL'),
(86, 1, 'GKKKKKKKKK'),
(87, 1, 'DDDDDDFDDF'),
(88, 1, 'GKKKKFKKKK'),
(89, 3, '7AAAAA-993');

-- --------------------------------------------------------

--
-- Структура таблицы `hardware_type`
--

CREATE TABLE `hardware_type` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serail_mask` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `hardware_type`
--

INSERT INTO `hardware_type` (`id`, `name`, `serail_mask`) VALUES
(1, 'TP-Link TL-WR74', 'XXAAAAAXAA'),
(2, 'D-Link DIR-300', 'NXXAAXZXaa'),
(3, 'D-Link DIR-300 S', 'NXXAAXZXXX');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `hardware`
--
ALTER TABLE `hardware`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_serial` (`serial`);

--
-- Индексы таблицы `hardware_type`
--
ALTER TABLE `hardware_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `hardware`
--
ALTER TABLE `hardware`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT для таблицы `hardware_type`
--
ALTER TABLE `hardware_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
