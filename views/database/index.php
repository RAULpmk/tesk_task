<?php

$this->title = 'Структура БД';
?>

<h1>Структура БД приложения</h1>
<pre>
CREATE DATABASE IF NOT EXISTS `ma-abs_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ma-abs_test`;

CREATE TABLE IF NOT EXISTS `coach` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `middle_name` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `last_name` varchar(30) CHARACTER SET cp1251 DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(10) unsigned NOT NULL,
  `valute_id` varchar(10) NOT NULL DEFAULT '',
  `num_code` varchar(3) NOT NULL DEFAULT '',
  `char_code` varchar(3) NOT NULL DEFAULT '',
  `nominal` smallint(4) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `value` float unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `time` (
  `id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL DEFAULT '0',
  `plan_time` time NOT NULL DEFAULT '00:00:00',
  `fact_time` time NOT NULL DEFAULT '00:00:00',
  `over_time` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;


ALTER TABLE `coach`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `time`
  ADD PRIMARY KEY (`id`), ADD KEY `time_coach_fk` (`coach_id`);

ALTER TABLE `time`
ADD CONSTRAINT `time_coach_fk` FOREIGN KEY (`coach_id`) REFERENCES `coach` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
</pre>