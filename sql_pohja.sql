-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 06 2016 г., 08:24
-- Версия сервера: 5.6.24
-- Версия PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `easyleading`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `tyyppi` tinyint(1) NOT NULL DEFAULT '0',
  `yid` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `lastname`, `firstname`, `tyyppi`, `yid`) VALUES
(1, 'Admin', 'Administrator', 0, 0),
(25, 'Yrittalainen', 'Yrittaja 1', 1, 25),
(26, 'Tekijalainen', 'Tyontekija 1', 2, 25);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profiles_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(10) NOT NULL,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_profiles_fields`
--

INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Sukunimi', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'Etunimi', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3),
(4, 'tyyppi', 'Tyyppi', 'BOOL', '0', '0', 3, '', '1==YrittÃ¤jÃ¤;2==TyÃ¶ntekijÃ¤', '', '', '0', '', '', 10, 2),
(5, 'yid', 'Yritys ID', 'INTEGER', '10', '0', 0, '', '', '', '', '0', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES
(1, 'admin', '96e79218965eb72c92a549dd5a330112', 'laptopsr@gmail.com', '6d4583ed2bea110403d7268afafb2783', '2015-04-23 05:14:26', '2016-12-06 06:02:39', 1, 1),
(25, 'yrittaja1', '96e79218965eb72c92a549dd5a330112', 'yrittaja1@fin.fi', '4e51a42f97b14dcafc6ec99e5886a315', '2016-12-01 12:33:13', '2016-12-01 12:34:16', 0, 1),
(26, 'tyontekija1', '96e79218965eb72c92a549dd5a330112', 'tyontekija1@fin.fi', '8040896be66dd672f1ba44a1eb34597c', '2016-12-01 13:34:53', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `viestinta`
--

CREATE TABLE IF NOT EXISTS `viestinta` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `saaja` int(11) NOT NULL,
  `lahettaja` int(11) NOT NULL,
  `teksti` text NOT NULL,
  `is_katsonut` int(1) NOT NULL,
  `otsikko` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `viestinta`
--

INSERT INTO `viestinta` (`id`, `time`, `saaja`, `lahettaja`, `teksti`, `is_katsonut`, `otsikko`) VALUES
(3, '2016-12-01 14:32:35', 26, 25, 'sdfsdfsdfsaf', 0, 'testo test'),
(4, '2016-12-01 14:32:46', 25, 25, ' sdfgdsfgdsfgdsf', 1, 'sdafgsrdagdsfg'),
(5, '2016-12-06 07:05:44', 1, 1, 'testo', 1, 'test');

-- --------------------------------------------------------

--
-- Структура таблицы `yiichat_post`
--

CREATE TABLE IF NOT EXISTS `yiichat_post` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chat_id` char(40) DEFAULT NULL,
  `post_identity` char(40) DEFAULT NULL,
  `owner` char(255) DEFAULT NULL,
  `created` bigint(30) DEFAULT NULL,
  `text` text,
  `data` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `yiichat_post`
--

INSERT INTO `yiichat_post` (`id`, `time`, `chat_id`, `post_identity`, `owner`, `created`, `text`, `data`) VALUES
(2, '2016-12-01 15:52:10', '25', NULL, 'Yrittaja 1 Yrittalainen', NULL, 'test', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tbl_profiles`
--
ALTER TABLE `tbl_profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `tbl_profiles_fields`
--
ALTER TABLE `tbl_profiles_fields`
  ADD PRIMARY KEY (`id`), ADD KEY `varname` (`varname`,`widget`,`visible`);

--
-- Индексы таблицы `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD KEY `status` (`status`), ADD KEY `superuser` (`superuser`);

--
-- Индексы таблицы `viestinta`
--
ALTER TABLE `viestinta`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `yiichat_post`
--
ALTER TABLE `yiichat_post`
  ADD PRIMARY KEY (`id`), ADD KEY `yiichat_chat_id` (`chat_id`), ADD KEY `yiichat_chat_id_identity` (`chat_id`,`post_identity`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tbl_profiles`
--
ALTER TABLE `tbl_profiles`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `tbl_profiles_fields`
--
ALTER TABLE `tbl_profiles_fields`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `viestinta`
--
ALTER TABLE `viestinta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `yiichat_post`
--
ALTER TABLE `yiichat_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbl_profiles`
--
ALTER TABLE `tbl_profiles`
ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
