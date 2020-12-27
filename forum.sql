-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 28 2020 г., 02:02
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
-- База данных: `forum`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `id_theme`, `id_user`, `name_user`, `text`, `date`) VALUES
(1, 1, 8, 'test', 'Тест', '2020-12-28'),
(2, 3, 9, 'Арнольд', 'У меня такая же проблема!!!!!', '2020-12-28');

-- --------------------------------------------------------

--
-- Структура таблицы `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `owner` int(11) NOT NULL,
  `owner_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `checked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `theme`
--

INSERT INTO `theme` (`id`, `name`, `text`, `date`, `owner`, `owner_name`, `checked`) VALUES
(1, 'Тест', 'Тест', '2020-12-28', 8, 'test', 1),
(2, 'Тест', 'Тест', '2020-12-28', 8, 'test', 1),
(3, 'Огурцы', 'Не могу посадить', '2020-12-28', 8, 'test', 1),
(4, 'Тоже огурцы', 'Тоже не могу посадить', '2020-12-28', 9, 'Арнольд', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `last_name` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `last_name`, `password`, `admin`) VALUES
(2, 'sssssss@mail.ru', 'яшка', 'яшкин', '11111111', 0),
(6, 'fffffffff@mail.ru', 'Максим', 'яшкин', '11111', 0),
(8, 'arnold6@mail.ru', 'test', 'test', '555', 0),
(9, 'asdas@mail.ru', 'Арнольд', 'Васильев', '555', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_theme` (`id_theme`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_theme`) REFERENCES `theme` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `theme_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
