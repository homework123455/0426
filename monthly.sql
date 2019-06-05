-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `monthly`;
CREATE TABLE `monthly` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `earn` int(11) NOT NULL,
  `trade` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `monthly` (`id`, `good_id`, `month`, `earn`, `trade`, `created_at`, `updated_at`) VALUES
(1,	20,	4,	12000,	20,	'2019-06-05 17:45:10',	'0000-00-00 00:00:00'),
(2,	21,	4,	5000,	15,	'2019-06-05 17:45:14',	'0000-00-00 00:00:00'),
(3,	22,	4,	5525,	10,	'2019-06-05 17:45:17',	'0000-00-00 00:00:00'),
(4,	23,	4,	3250,	5,	'2019-06-05 17:45:21',	'0000-00-00 00:00:00'),
(5,	24,	4,	5570,	15,	'2019-06-05 17:45:24',	'0000-00-00 00:00:00'),
(6,	25,	4,	11250,	25,	'2019-06-05 17:45:27',	'0000-00-00 00:00:00'),
(7,	26,	4,	3000,	5,	'2019-06-05 17:45:30',	'0000-00-00 00:00:00');

-- 2019-06-05 17:46:45
