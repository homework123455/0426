-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `suppliersdetail1`;
CREATE TABLE `suppliersdetail1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `suppliersdetail1` (`id`, `name`, `supplier_id`, `value`, `price`, `created_at`, `updated_at`) VALUES
(1,	'30',	6,	50,	1000,	'2019-06-05 16:42:51',	'2019-06-05 16:42:51'),
(2,	'30',	6,	25,	300,	'2019-06-05 16:43:53',	'2019-06-05 16:43:53');

-- 2019-06-05 17:30:34
