-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Ноя 28 2011 г., 10:04
-- Версия сервера: 5.0.51
-- Версия PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- База данных: `blog`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `tbl_comment`
-- 

CREATE TABLE `tbl_comment` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `root` int(11) default NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Дамп данных таблицы `tbl_comment`
-- 

INSERT INTO `tbl_comment` VALUES (1, 1, 1, 12, 1, 1, 2, NULL, 1322305280);
INSERT INTO `tbl_comment` VALUES (2, 1, 2, 11, 2, 1, 1, 'Всем привет', 1322305331);
INSERT INTO `tbl_comment` VALUES (3, 1, 3, 8, 3, 1, 1, 'И тебе привет!', 1322305367);
INSERT INTO `tbl_comment` VALUES (4, 1, 4, 7, 4, 1, 1, 'Как тут у вас дела?!', 1322305386);
INSERT INTO `tbl_comment` VALUES (5, 1, 5, 6, 5, 1, 1, 'Все отлично! Не ссы!', 1322305417);
INSERT INTO `tbl_comment` VALUES (6, 1, 9, 10, 3, 1, 1, 'О чем базар?', 1322305471);
INSERT INTO `tbl_comment` VALUES (7, 7, 1, 6, 1, 2, 2, NULL, 1322305511);
INSERT INTO `tbl_comment` VALUES (8, 7, 2, 5, 2, 2, 1, 'Тут тоже всем привет!', 1322305623);
INSERT INTO `tbl_comment` VALUES (9, 7, 3, 4, 3, 2, 2, 'Здарово коль не шутишь!', 1322305699);

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

INSERT INTO `tbl_lookup` VALUES (1, 'Черновик', 1, 'PostStatus', 1);
INSERT INTO `tbl_lookup` VALUES (2, 'Опубликован', 2, 'PostStatus', 2);
INSERT INTO `tbl_lookup` VALUES (3, 'Архив', 3, 'PostStatus', 3);
INSERT INTO `tbl_lookup` VALUES (4, 'Pending Approval', 1, 'CommentStatus', 1);
INSERT INTO `tbl_lookup` VALUES (5, 'Approved', 2, 'CommentStatus', 2);

-- --------------------------------------------------------

-- 
-- Структура таблицы `tbl_page`
-- 

CREATE TABLE `tbl_page` (
  `id` tinyint(2) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(200) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `tbl_page`
-- 

INSERT INTO `tbl_page` VALUES (1, 'О нас', 'o_nas', 'О нас', 'О нас', 'О нас', '<p>Здарово! Я еще не до конца определился, что это будет. Но скорее всего это будет личный блог. Такого УГ в рунете валом, почему бы не пополнить счет еще одним образцом?! (:</p>\r\n<p><img title="Yii Framework" src="http://localhost/blog/upload/images/logo.png" alt="Yii Framework" width="173" height="40" /></p>', 1321963029);
INSERT INTO `tbl_page` VALUES (2, 'Контакты', 'kontakti', 'Контакты', 'Контакты', 'Контакты', '<p>Twitter: AlexATI</p>', 1322058793);

-- --------------------------------------------------------

-- 
-- Структура таблицы `tbl_post`
-- 

CREATE TABLE `tbl_post` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `short_content` text NOT NULL,
  `tags` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `rating` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `tbl_post`
-- 

INSERT INTO `tbl_post` VALUES (1, 2, 'Yii blog', '<p><img src="http://localhost/blog/upload/images/logo.png" alt="" width="173" height="40" /></p>\r\n<p>Новый блог на Yii</p>\r\n<!--cut--> \r\n<ul>\r\n<li>RBAC</li>\r\n<li>Config</li>\r\n<li>Rating post</li>\r\n<li>Comments Nested Set</li>\r\n</ul>', '<p><img src="http://localhost/blog/upload/images/logo.png" alt="" width="173" height="40" /></p>\r\n<p>Новый блог на Yii</p>\r\n', 'yii, blog', 2, 0, 1322305280, 1322338885);
INSERT INTO `tbl_post` VALUES (2, 2, 'Yii blog 2', '<p><img src="http://localhost/blog/upload/avatars/admin/19_11_2011_13_02_26_admin.jpg" alt="" width="50" height="50" /></p>\r\n<p>Новый блог на Yii</p>\r\n<!--cut--> \r\n<ul>\r\n<li>RBAC</li>\r\n<li>Config</li>\r\n<li>Rating post</li>\r\n<li>Comments Nested Set</li>\r\n</ul>', '<p><img src="http://localhost/blog/upload/avatars/admin/19_11_2011_13_02_26_admin.jpg" alt="" width="50" height="50" /></p>\r\n<p>Новый блог на Yii</p>\r\n', 'blog, yii', 2, 0, 1322305511, 1322338894);

-- --------------------------------------------------------

-- 
-- Структура таблицы `tbl_post_rating`
-- 

CREATE TABLE `tbl_post_rating` (
  `id` int(11) NOT NULL auto_increment,
  `rating` float NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `rating` (`rating`,`post_id`,`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Дамп данных таблицы `tbl_post_rating`
-- 

INSERT INTO `tbl_post_rating` VALUES (1, 4, 2, 2);
INSERT INTO `tbl_post_rating` VALUES (2, 4, 1, 1);
INSERT INTO `tbl_post_rating` VALUES (3, 5, 2, 1);
INSERT INTO `tbl_post_rating` VALUES (4, 4.5, 1, 2);

-- --------------------------------------------------------

-- 
-- Структура таблицы `tbl_tag`
-- 

CREATE TABLE `tbl_tag` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(128) collate utf8_unicode_ci NOT NULL,
  `frequency` int(11) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `tbl_tag`
-- 

INSERT INTO `tbl_tag` VALUES (1, 'yii', 2);
INSERT INTO `tbl_tag` VALUES (2, 'blog', 2);

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
