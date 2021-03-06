-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 23 2020 г., 19:10
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kurswork`
--

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_zach` double DEFAULT NULL,
  `kurs` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id`, `name`, `tel`, `num_zach`, `kurs`) VALUES
(1, 'Иван Иванов', '89999999999', 12345, 1),
(2, 'Перт Пертов', '87543686687', 8687468676, 2),
(3, 'Блинов Тимофей Платонович', '7(495)271-26-46', 528168204, 3),
(4, 'Корнейчук Йоханес Фёдорович', '7(495)638-66-27', 406463530, 4),
(5, 'Чумак Ждан Борисович', '7(495)577-17-23', 269330118, 1),
(6, 'Орехов Харитон Борисович', '7(495)007-25-43', 825243510, 1),
(7, 'Палий Чарльз Викторович', '7(495)250-99-66', 314453484, 2),
(8, 'Орехова Софья Максимовна', '7(495)043-67-03', 855291680, 2),
(9, 'Третьякова Полина Петровна', '7(495)804-53-80', 631846431, 3),
(10, 'Прохорова Янина Сергеевна', '7(495)885-33-81', 648768182, 3),
(11, 'Дзюба Розалина Богдановна', '7(495)325-38-10', 319813155, 4),
(12, 'Токар Искра Даниловна', '7(495)635-34-85', 488306828, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

CREATE TABLE `subject` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `mark` int(11) UNSIGNED DEFAULT NULL,
  `student_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subject`
--

INSERT INTO `subject` (`id`, `name`, `date`, `mark`, `student_id`) VALUES
(1, 'Математика', '2020-06-10', 3, 2),
(2, 'Математика', '2020-06-10', 5, 7),
(3, 'Математика', '2020-06-10', 4, 8),
(4, 'Иностранный язык', '2020-06-01', 4, 1),
(5, 'Иностранный язык', '2020-06-01', 4, 5),
(6, 'Иностранный язык', '2020-06-01', 5, 6),
(7, 'Базы Данных', '2020-06-24', 5, 3),
(8, 'Базы Данных', '2020-06-24', 4, 9),
(9, 'Базы Данных', '2020-06-24', 5, 10),
(10, 'Теория устойчивости', '2020-06-19', 5, 4),
(11, 'Теория устойчивости', '2020-06-19', 4, 10),
(12, 'Теория устойчивости', '2020-06-19', 5, 11),
(13, 'Математика', '2020-06-22', 2, 11),
(14, 'Математика', '2020-06-22', 5, 5),
(15, 'Математика', '2020-06-02', 5, 4),
(16, 'Иностранный язык', '2020-06-14', 5, 1),
(17, 'Иностранный язык', '2020-06-23', 4, 1),
(18, 'Теория устойчивости', '2020-06-03', 2, 2),
(19, 'Базы Данных', '2020-06-15', 3, 4),
(20, 'Базы Данных', '2020-06-13', 4, 6),
(21, 'Базы Данных', '2020-06-02', 3, 9),
(22, 'Базы Данных', '2020-06-02', 3, 9);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_subject_student` (`student_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `c_fk_subject_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
