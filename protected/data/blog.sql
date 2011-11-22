-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Ноя 21 2011 г., 23:29
-- Версия сервера: 5.0.51
-- Версия PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- База данных: `blog`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `tbl_core_config`
-- 

CREATE TABLE `tbl_core_config` (
  `id` int(11) NOT NULL auto_increment,
  `group` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `tbl_core_config`
-- 

INSERT INTO `tbl_core_config` VALUES (1, 'core', 'name', 'Тестовый Блог');
INSERT INTO `tbl_core_config` VALUES (2, 'core', 'language', 'ru');

-- --------------------------------------------------------

-- 
-- Структура таблицы `tbl_lookup`
-- 

CREATE TABLE `tbl_lookup` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(128) collate utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) collate utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- 
-- Дамп данных таблицы `tbl_lookup`
-- 

INSERT INTO `tbl_lookup` VALUES (1, 'Draft', 1, 'PostStatus', 1);
INSERT INTO `tbl_lookup` VALUES (2, 'Published', 2, 'PostStatus', 2);
INSERT INTO `tbl_lookup` VALUES (3, 'Archived', 3, 'PostStatus', 3);
INSERT INTO `tbl_lookup` VALUES (4, 'Pending Approval', 1, 'CommentStatus', 1);
INSERT INTO `tbl_lookup` VALUES (5, 'Approved', 2, 'CommentStatus', 2);

-- --------------------------------------------------------

-- 
-- Структура таблицы `tbl_pages`
-- 

CREATE TABLE `tbl_pages` (
  `id` tinyint(2) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(200) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `tbl_pages`
-- 

INSERT INTO `tbl_pages` VALUES (1, 'О нас', 'o_nas', 'О нас', 'О нас', 'О нас', '<p>Здарово! Я еще не до конца определился, что это будет. Но скорее всего это будет личный блог. Такого УГ в рунете валом, почему бы не пополнить счет еще одним образцом?! (:</p>\r\n<p><img title="Yii Framework" src="http://localhost/game/upload/images/logo.png" alt="Yii Framework" width="173" height="40" /></p>', 1321699864);

-- --------------------------------------------------------

-- 
-- Структура таблицы `tbl_user`
-- 

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL auto_increment,
  `group_id` int(11) NOT NULL default '0',
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(128) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `tbl_user`
-- 

INSERT INTO `tbl_user` VALUES (1, 2, 'admin', '4d7a85863bf3861a5523407eab522010', 'administrator', 1321448929);
INSERT INTO `tbl_user` VALUES (2, 1, 'ATI', '4d7a85863bf3861a5523407eab522010', 'moderator', 1321467751);

-- --------------------------------------------------------

-- 
-- Структура таблицы `tbl_user_group`
-- 

CREATE TABLE `tbl_user_group` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `level` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `tbl_user_group`
-- 

INSERT INTO `tbl_user_group` VALUES (1, 'Тестовики', 'administrators', 1);
INSERT INTO `tbl_user_group` VALUES (2, 'Команда Тестеров', 'tester_team', 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `tbl_user_profile`
-- 

CREATE TABLE `tbl_user_profile` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `level` tinyint(3) NOT NULL,
  `last_login` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `tbl_user_profile`
-- 

INSERT INTO `tbl_user_profile` VALUES (1, 1, 'Alexander', 'Stanovoy', 'soccer007@mail.ru', '', '1988-07-13', '19_11_2011_13_02_26_admin.jpg', 1, 1321449007);
INSERT INTO `tbl_user_profile` VALUES (2, 2, '', '', 'ati@mail.ru', '', '1988-07-13', '19_11_2011_13_00_56_ATI.gif', 0, 0);
