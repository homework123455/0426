-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `addstock`;
CREATE TABLE `addstock` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` int(99) NOT NULL,
  `supply_id` int(99) NOT NULL,
  `good_id` int(99) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `addstock` (`id`, `value`, `supply_id`, `good_id`, `created_at`, `updated_at`) VALUES
(19,	17,	23,	20,	'2019-06-05 09:21:28',	'2019-06-05 09:21:28'),
(20,	44,	24,	21,	'2019-06-05 09:21:13',	'2019-06-05 09:21:13'),
(21,	50,	25,	22,	'2019-05-30 13:22:19',	'2019-05-30 13:22:19'),
(22,	49,	26,	23,	'2019-06-05 09:08:50',	'2019-06-05 09:08:50'),
(23,	41,	27,	24,	'2019-06-05 09:13:37',	'2019-06-05 09:13:37'),
(24,	47,	28,	25,	'2019-06-05 09:14:45',	'2019-06-05 09:14:45'),
(25,	47,	29,	26,	'2019-06-05 09:23:57',	'2019-06-05 09:23:57'),
(26,	49,	30,	27,	'2019-06-05 09:15:09',	'2019-06-05 09:15:09'),
(27,	41,	31,	28,	'2019-06-05 09:23:58',	'2019-06-05 09:23:58'),
(28,	49,	32,	29,	'2019-06-05 09:13:23',	'2019-06-05 09:13:23'),
(29,	50,	33,	30,	'2019-05-30 14:37:21',	'2019-05-30 14:37:21'),
(30,	50,	34,	31,	'2019-05-30 14:51:14',	'2019-05-30 14:51:14');

DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `maintaince_id` int(11) NOT NULL,
  `problem` text COLLATE utf8_unicode_ci NOT NULL,
  `tool` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applications_id_index` (`id`),
  KEY `applications_user_id_index` (`user_id`),
  KEY `applications_maintaince_id_index` (`maintaince_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `users_id` int(10) unsigned DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `cost` int(255) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `product_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `carts` (`users_id`, `id`, `photo`, `product`, `cost`, `qty`, `product_id`, `total`) VALUES
(26,	1,	'/uploads/2019-05-30/20190530213607418.jpg',	'UCL FINALE MADRID頂級訓練球',	900,	5,	23,	4500);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'羽球類',	'2019-02-22 08:53:24',	'2019-05-19 12:30:31'),
(2,	'籃球類',	'2019-02-22 08:53:24',	'2019-02-22 08:53:24'),
(7,	'排球類',	'2019-02-22 08:53:24',	'2019-02-22 08:53:24'),
(9,	'網球類',	'2019-02-20 08:53:24',	'2019-02-20 08:53:24'),
(10,	'泳具類',	'2019-02-20 09:53:24',	'2019-02-20 09:53:24'),
(15,	'足球類',	'2019-05-30 13:33:54',	'2019-05-30 13:33:54');

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supervisor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `departments` (`id`, `name`, `supervisor`, `created_at`, `updated_at`) VALUES
(1,	'資管系',	2,	NULL,	NULL),
(2,	'流管系',	3,	NULL,	NULL),
(3,	'企管系',	4,	NULL,	NULL),
(4,	'機械系',	5,	NULL,	NULL),
(5,	'工管系',	6,	NULL,	NULL),
(6,	'文創系',	7,	NULL,	NULL),
(7,	'電子系',	8,	NULL,	NULL),
(8,	'應英系',	9,	NULL,	NULL),
(9,	'休管系',	10,	NULL,	NULL);

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `details3` varchar(500) CHARACTER SET utf8 NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details2` varchar(500) CHARACTER SET utf8 NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `save_stock` int(11) NOT NULL,
  `goods_name1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `goods` (`id`, `name`, `photo4`, `photo3`, `category`, `details3`, `details`, `details2`, `price`, `stock`, `save_stock`, `goods_name1`, `photo1`, `photo2`, `created_at`, `updated_at`, `status`, `value`, `supplier_id`) VALUES
(20,	'TK-F F',	'/uploads/2019-05-30/20190530212147638.jpg',	'/uploads/2019-05-30/20190530212147698.jpg',	1,	'對於喜好進攻拍的球友而言，最令人關心的莫過於球拍的攻擊效果如何？THRUSTER F 集結高強韌材料PYROFIL所打造的創新框型設計和及高抗扭極細中管，殺球力量比一般進攻拍大幅提升20%，落點更精確，完美展現如獵鷹一般快、狠、準的攻擊姿態，實現強勁攻掠、所向披靡的擊球快感。',	'中管材質\r\n高強韌碳纖維(High Resilient Modulus Graphite)+百洛碳素纖維 (PYROFIL) + 6.4 SHAFT  \r\n拍框材質\r\n高強韌碳纖維(High Resilient Modulus Graphite)+百洛碳素纖維(PYROFIL) +HARD CORED TECHNOLOGY\r\n穿線磅數\r\n≦32 lbs (14.5Kg) \r\n≦ 31lbs (14Kg)\r\n球拍重量 / 握柄尺寸\r\n3U / G5 \r\n4U / G5',	'中管是傳遞力量的重要關鍵，THRUSTER F 全球拍使用PYROFIL百洛碳素纖維，透過VICTOR抗扭系統的高強韌材料組合及全新疊層設計概念，成功打造THRUSTER F抗扭更強的6.4mm細中管。經實驗證實，THRUSTER F中管抗扭可提升15.7%，達到更穩定精準的攻擊表現。',	750,	70,	100,	'',	'/uploads/2019-05-30/20190530212147156.jpg',	'/uploads/2019-05-30/20190530212147980.jpg',	'2019-05-30 13:07:35',	'2019-06-05 08:57:52',	'正常供貨中',	12,	4),
(21,	'JS-12F J',	'/uploads/2019-05-30/20190530211656923.png',	'/uploads/2019-05-30/20190530211656507.png',	1,	'Hard Cored Technology 強芯填充技術\r\n取自軍用螺旋漿的聚合物材質，與碳纖維組成三明治結構，提升手感穩定度和準確性。\r\n\r\nPrrofil 百洛碳素纖維\r\n運用日本三菱化學技術所研發而成的碳纖維複合材料，其強硬與輕量化特點，可提升良好減震效果與操控感。',	'中管材質\r\n高強韌碳纖維 + 百洛碳素纖維 + 特氏樹脂系統 + 6.8 SHAFT     \r\n拍框材質\r\n高強韌碳纖維 + 特氏樹脂系統 + 強芯填充技術\r\n穿線磅數\r\n≦30 lbs\r\n≦29 lbs\r\n球拍重量 / 握柄尺寸\r\n3U / G5\r\n4U / G5',	'全新材料「TERS特氏樹脂系統」  打造彈韌穩定新境界\r\n採用美國航太等級材料「TERS特氏樹脂系統」，無孔洞緊致結構，為拍框帶來彈韌性，並達到減震效果；同時強化中管柔軟度與彈性，極大化揮拍動力傳導效能，在快速連續攻防中，為使用者維持穩定紮實的操控手感，達成全方位的強攻速守。',	500,	100,	100,	'',	'/uploads/2019-05-30/20190530211656872.jpg',	'/uploads/2019-05-30/20190530211656994.jpg',	'2019-05-30 13:16:56',	'2019-06-05 09:16:50',	'正常供貨中',	48,	4),
(22,	'TK-F C',	'/uploads/2019-05-30/20190530212030447.jpg',	'/uploads/2019-05-30/20190530212030722.jpg',	1,	'[拍框] 變異三力結構\r\n透過拍框【TRI-FORMATION變異三力結構】設計，使得揮拍更加順暢。',	'中管材質\r\n高強韌碳纖維 + 百洛碳素纖維 + 6.4 SHAFT       \r\n拍框材質\r\n高強韌碳纖維 +百洛碳素纖維 +強芯填充技術\r\n穿線磅數\r\n≦31lbs(14Kg)\r\n球拍重量 / 握柄尺寸\r\n4U/G5',	'[拍面積] 加大的拍面積加大甜區；小平頭與72孔扎實強勁的回球\r\nTHRUSTER F CLAW的打感在平抽擋等小發力和長球殺球大發力時的擊球感不盡相同，平抽擋時手感快彈，持球時間偏短，出球快且帶有力量；若是發力擊球、全力跳殺時，馬上又能感受到小平頭搭配72孔所帶來的扎實回饋，落點精確且威力不減。',	750,	110,	100,	'',	'/uploads/2019-05-30/20190530212030264.jpg',	'/uploads/2019-05-30/20190530212030256.jpg',	'2019-05-30 13:20:30',	'2019-05-30 13:22:19',	'正常供貨中',	50,	4),
(23,	'UCL FINALE MADRID頂級訓練球',	'/uploads/2019-05-30/20190530213607311.jpg',	'/uploads/2019-05-30/20190530213607646.jpg',	15,	'它具有高質量性能的無縫表面和帶紋理的外塗層，可增強其飛行和觸感。充滿活力的設計靈感來自馬德里決賽的場地。國際足聯的標誌證實了它的質量。',	'100％TPU封面\r\n丁基膀胱\r\nTSBE技術可實現無縫表面，具有更好的觸感和更低的吸水率\r\nFIFA質量認證\r\n歐洲冠軍聯賽標誌\r\n',	'隨著歐洲冠軍聯賽的升溫，明星相互碰撞。這個訓練足球是本賽季淘汰賽階段和決賽中使用的比賽用球的複製品。',	900,	100,	100,	'',	'/uploads/2019-05-30/20190530213607418.jpg',	'/uploads/2019-05-30/20190530213607733.jpg',	'2019-05-30 13:36:07',	'2019-05-30 13:36:38',	'正常供貨中',	50,	4),
(24,	'UCL FINALE MADRID CAPITANO BALL',	'/uploads/2019-05-30/20190530213933584.jpg',	'/uploads/2019-05-30/20190530213933836.jpg',	15,	'其耐磨的TPU外殼採用機器縫合，經久耐用。充滿活力的設計靈感來自馬德里決賽的場地',	'100％TPU封面\r\n丁基膀胱\r\n機縫表面\r\n歐洲冠軍聯賽標誌',	'隨著歐洲冠軍聯賽的升溫，明星相互碰撞。這款足球球專為爭球而設，是本賽季淘汰賽階段和決賽中使用的比賽用球的複製品',	1200,	100,	100,	'',	'/uploads/2019-05-30/20190530213933596.jpg',	'/uploads/2019-05-30/20190530213933724.jpg',	'2019-05-30 13:39:33',	'2019-06-05 09:16:50',	'正常供貨中',	33,	4),
(25,	'SPALDING 斯伯丁 NBA 隊徽球 勇士 Warriors 籃球 7號',	'/uploads/2019-05-30/20190530220128519.jpg',	'/uploads/2019-05-30/20190530220128935.jpg',	2,	'我們的籃球在超過30000場NBA賽事中使用，\r\n世界每一個角落的NBA球迷們都能在許多經典畫面中看到Spalding',	'尺寸	7號\r\n材質	柔軟橡膠',	'有別於傳統橡膠，\r\n以雙層極度柔軟的橡膠製成，\r\n絕佳的觸感搭配深不見底的溝槽，\r\n提供籃球愛好者一流的手感，\r\n增進場上絕佳表現。',	1200,	100,	100,	'',	'/uploads/2019-05-30/20190530220128672.jpg',	'/uploads/2019-05-30/20190530220128143.jpg',	'2019-05-30 13:55:58',	'2019-06-05 09:16:58',	'正常供貨中',	49,	5),
(26,	'SPALDING 斯伯丁 SGT 深溝柔軟膠系列 星際藍 Rubber 籃球 7號',	'/uploads/2019-05-30/20190530215908516.jpg',	'/uploads/2019-05-30/20190530215908353.jpg',	2,	'我們的籃球在超過30000場NBA賽事中使用，\r\n世界每一個角落的NBA球迷們都能在許多經典畫面中看到Spalding',	'尺寸	7號\r\n材質	柔軟橡膠\r\n適合場地	室外',	'有別於傳統橡膠，\r\n以雙層極度柔軟的橡膠製成， \r\n絕佳的觸感搭配深不見底的溝槽，\r\n提供籃球愛好者一流的手感，\r\n增進場上絕佳表現。\r\n適合所有室外場地。',	750,	100,	100,	'',	'/uploads/2019-05-30/20190530215908399.jpg',	'/uploads/2019-05-30/20190530215908662.jpg',	'2019-05-30 13:59:08',	'2019-05-30 13:59:32',	'正常供貨中',	50,	5),
(27,	'SPALDING 斯伯丁 NBA 球員球 快艇 保羅 Paul 橡膠 籃球 7號',	'/uploads/2019-05-30/20190530220507630.jpg',	'/uploads/2019-05-30/20190530220507990.jpg',	2,	'我們的籃球在超過30000場NBA賽事中使用，\r\n世界每一個角落的NBA球迷們都能在許多經典畫面中看到Spalding',	'尺寸	7號\r\n材質	橡膠',	'有別於傳統橡膠，\r\n以雙層極度柔軟的橡膠製成，\r\n絕佳的觸感搭配深不見底的溝槽，\r\n提供籃球愛好者一流的手感，\r\n增進場上絕佳表現。',	450,	100,	100,	'',	'/uploads/2019-05-30/20190530220507725.jpg',	'/uploads/2019-05-30/20190530220507144.jpg',	'2019-05-30 14:05:07',	'2019-06-05 09:17:06',	'正常供貨中',	49,	5),
(28,	'Speedo 成人 進階型泳鏡 Cyclone II 黑灰',	'/uploads/2019-05-30/20190530221357327.jpg',	'/uploads/2019-05-30/20190530221357976.jpg',	10,	'Speedo致力於研發泳裝及配件等與科技的結合，\r\n因此被公認為世界泳裝品牌',	'超柔軟墊片提供絕佳配戴舒適感',	'100%抗UV，所有鏡面都是使用高級複合塑料，\r\n皆能抵抗紫外線',	600,	100,	100,	'',	'/uploads/2019-05-30/20190530221357849.jpg',	'/uploads/2019-05-30/20190530221357646.jpg',	'2019-05-30 14:13:57',	'2019-06-05 08:57:52',	'正常供貨中',	36,	5),
(29,	'Speedo 兒童合成泳帽 Pace 黑豹',	'/uploads/2019-05-30/20190530221733264.jpg',	'/uploads/2019-05-30/20190530221733173.jpg',	10,	'Speedo致力於研發泳裝及配件等與科技的結合，\r\n因此被公認為世界泳裝品牌',	'內層	聚酯纖維 彈性纖維\r\n外層	聚氨酯',	'表皮PU塗層，有效防水＆保暖\r\n內層彈性舒適布料，不易夾頭髮\r\n三片式剪裁，更舒適服貼、好戴',	525,	100,	100,	'',	'/uploads/2019-05-30/20190530221733496.jpg',	'/uploads/2019-05-30/20190530221733693.jpg',	'2019-05-30 14:17:33',	'2019-05-30 14:18:00',	'正常供貨中',	50,	5),
(30,	'【conti】頂級超世代橡膠排球990',	'/uploads/2019-05-30/20190530224206308.jpg',	'/uploads/2019-05-30/20190530224206948.jpg',	7,	'讓喜歡排球也變成一種流行時尚\r\n\r\n並為排球人提供更好的服務\r\n\r\n所有人都可以更容易、更快樂地享受排球',	'◆ 台灣技術研發\r\n◆ 獨特中胎設計\r\n◆ 超軟橡膠\r\n◆ 大小：5號球',	'維持一貫獨特超軟橡膠材質，有別於一般纏紗排球設計。\r\n創新貼布中胎可提升球體圓周一致性與氣密性，觸感、舒適性都將超越你對橡膠排球的定義。\r\n\r\n使用前請將產品充氣在適當球壓，標準球壓範圍為3-3.5Ibs.\r\n請將球舉到約200-220cm，落地回彈高度在胸口至腹部之間的位置(120-130cm)，即為建議的充氣壓力。',	525,	100,	100,	'',	'/uploads/2019-05-30/20190530224206164.png',	'/uploads/2019-05-30/20190530224206682.jpg',	'2019-05-30 14:36:53',	'2019-05-30 14:42:06',	'正常供貨中',	50,	6),
(31,	'HEAD Graphene 360 Speed PRO 網球拍+線',	'/uploads/2019-05-30/20190530225052444.jpg',	'/uploads/2019-05-30/20190530225052371.jpg',	9,	'全新Radical系列 \r\nAndy Murray強力推薦款 \r\n革命性Graphene 360科技 \r\n更高的穩定性和優化的能量傳輸 ',	'成分：碳纖維 \r\n拍面：100平方英吋 \r\n重量(未穿線)：310g \r\n平衡(未穿線)：315mm \r\n長度：685mm \r\n線床密度：18/20 ',	'由Novak Djokovic親自推薦，SPEED PRO模型是為高級錦標賽玩家創建的，他們需要對快節奏的遊戲進行更多控制。新的Graphene 360​​技術提供更高的穩定性和優化的能量傳輸，以獲得更大的動力，從而提高球速。即使是最快的來回對抽，18/20穿線模式也能提供更高的控制力。 SPEED料遵循新的不對稱設計標識，在軸區域採用大膽的黑白色塊。通過頭部真正獨特的透明碳纖維完成，球拍看起來就像它的表現一樣美觀',	7500,	100,	100,	'',	'/uploads/2019-05-30/20190530225052947.jpg',	'/uploads/2019-05-30/20190530225052690.jpg',	'2019-05-30 14:50:52',	'2019-05-30 14:51:14',	'正常供貨中',	50,	6);

DROP TABLE IF EXISTS `lendings`;
CREATE TABLE `lendings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `place_id` int(10) unsigned NOT NULL,
  `lenttime` date NOT NULL,
  `returntime` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lendings_user_id_index` (`user_id`),
  KEY `lendings_asset_id_index` (`place_id`),
  CONSTRAINT `lendings_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `maintainceitems`;
CREATE TABLE `maintainceitems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `maintaince_id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maintainceitems_id_index` (`id`),
  KEY `maintainceitems_maintaince_id_index` (`maintaince_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `maintainces`;
CREATE TABLE `maintainces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `method` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `reason` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maintainces_id_index` (`id`),
  KEY `maintainces_asset_id_index` (`place_id`),
  KEY `maintainces_vendor_id_index` (`vendor_id`),
  CONSTRAINT `maintainces_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `monthly`;
CREATE TABLE `monthly` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `earn` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `photo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content4` varchar(500) CHARACTER SET utf8 NOT NULL,
  `content3` varchar(500) CHARACTER SET utf8 NOT NULL,
  `content2` varchar(500) CHARACTER SET utf8 NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `content1` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcements_id_index` (`id`),
  KEY `announcements_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `news` (`photo`, `content4`, `content3`, `content2`, `id`, `user_id`, `title`, `content1`, `created_at`, `updated_at`) VALUES
('/uploads/2019-05-30/20190530230024188.jpg',	'造成不便，敬請見諒',	'進行例行性維護，',	'維護期間所有服務將關閉',	8,	26,	'20190530-系統維修公告',	'本系統將於2019/05/31上午8:00關閉，預計在上午10:00開放',	'2019-05-30 14:56:35',	'2019-05-30 15:00:24');

DROP TABLE IF EXISTS `news1`;
CREATE TABLE `news1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content1` varchar(255) NOT NULL,
  `content2` varchar(255) NOT NULL,
  `content3` varchar(255) NOT NULL,
  `content4` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `orderback`;
CREATE TABLE `orderback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `reason` char(255) NOT NULL,
  `status` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ph_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` int(10) unsigned DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `reason` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `reason1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vip_check` int(11) DEFAULT NULL,
  `car_money` int(11) DEFAULT NULL,
  `buytime` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`users_id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `name`, `postcode`, `ph_number`, `address`, `created_at`, `updated_at`, `users_id`, `status`, `reason`, `reason1`, `vip_check`, `car_money`, `buytime`) VALUES
(5,	'陳資翰',	'406',	'0936763689',	'台中市北屯區文心路四段',	'2019-06-05 09:08:41',	'2019-06-05 09:16:17',	30,	'已取消',	NULL,	'重複購買商品',	0,	0,	'2019-06-05'),
(6,	'陳資翰',	'406',	'0936763689',	'台中市北屯區文心路四段',	'2019-06-05 09:08:50',	'2019-06-05 09:18:35',	30,	'已出貨',	'惡意取消訂單嫌疑',	'重複購買商品',	1,	0,	'2019-06-05'),
(7,	'陳資翰',	'406',	'0936763689',	'台中市北屯區文心路四段',	'2019-06-05 09:13:23',	'2019-06-05 09:16:45',	30,	'駁回',	'違規次數過多',	NULL,	1,	0,	NULL),
(8,	'陳資翰',	'406',	'0936763689',	'台中市北屯區文心路四段',	'2019-06-05 09:13:37',	'2019-06-05 09:19:02',	30,	'已出貨',	NULL,	NULL,	1,	0,	'2019-06-05'),
(9,	'陳資翰',	'406',	'0936763689',	'台中市北屯區文心路四段',	'2019-06-05 09:14:45',	'2019-06-05 09:19:28',	30,	'已出貨',	NULL,	NULL,	1,	0,	'2019-05-05'),
(10,	'陳資翰',	'406',	'0936763689',	'台中市北屯區文心路四段',	'2019-06-05 09:15:09',	'2019-06-05 09:19:18',	30,	'已出貨',	NULL,	NULL,	1,	1,	'2019-06-05'),
(11,	'陳資翰',	'406',	'0936763689',	'台中市北屯區文心路四段',	'2019-06-05 09:21:28',	'2019-06-05 09:21:41',	30,	'取消審核中',	NULL,	'重複購買商品',	1,	0,	NULL),
(12,	'陳資翰',	'406',	'0936763689',	'台中市北屯區文心路四段',	'2019-06-05 09:23:57',	'2019-06-05 09:23:57',	30,	'未處理',	NULL,	NULL,	1,	0,	NULL);

DROP TABLE IF EXISTS `ordersdetail`;
CREATE TABLE `ordersdetail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orders_id` int(10) unsigned DEFAULT NULL,
  `users_id` int(10) unsigned DEFAULT NULL,
  `product` varchar(255) NOT NULL,
  `product_id` int(10) DEFAULT NULL,
  `supply_id` int(10) DEFAULT NULL,
  `cost` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `status` varchar(50) CHARACTER SET utf8 NOT NULL,
  `backreason` varchar(50) CHARACTER SET utf8 NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `backreason1` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  KEY `orders_id` (`orders_id`),
  CONSTRAINT `ordersdetail_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ordersdetail` (`id`, `orders_id`, `users_id`, `product`, `product_id`, `supply_id`, `cost`, `qty`, `total`, `status`, `backreason`, `updated_at`, `created_at`, `backreason1`) VALUES
(10,	5,	30,	'TK-F F',	20,	23,	750,	1,	750,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	''),
(11,	5,	30,	'JS-12F J',	21,	24,	500,	1,	500,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	''),
(13,	5,	30,	'SPALDING 斯伯丁 NBA 隊徽球 勇士 Warriors 籃球 7號',	25,	28,	1200,	1,	1200,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	''),
(14,	6,	30,	'UCL FINALE MADRID頂級訓練球',	23,	26,	900,	1,	900,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	''),
(16,	6,	30,	'JS-12F J',	21,	24,	500,	1,	500,	'拒絕退貨',	'商品有瑕疵',	'2019-06-05 18:17:55',	'0000-00-00 00:00:00',	'商品毀損'),
(17,	7,	30,	'Speedo 兒童合成泳帽 Pace 黑豹',	29,	32,	525,	1,	525,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	''),
(18,	8,	30,	'UCL FINALE MADRID CAPITANO BALL',	24,	27,	1200,	1,	1200,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	''),
(19,	8,	30,	'JS-12F J',	21,	24,	500,	1,	500,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	''),
(20,	9,	30,	'SPALDING 斯伯丁 NBA 隊徽球 勇士 Warriors 籃球 7號',	25,	28,	1200,	1,	1200,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	''),
(21,	10,	30,	'SPALDING 斯伯丁 NBA 球員球 快艇 保羅 Paul 橡膠 籃球 7號',	27,	30,	450,	1,	450,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	''),
(22,	10,	30,	'JS-12F J',	21,	24,	500,	1,	500,	'已退貨',	'商品有瑕疵',	'2019-06-05 18:16:21',	'0000-00-00 00:00:00',	''),
(23,	11,	30,	'TK-F F',	20,	23,	750,	1,	750,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	''),
(24,	12,	30,	'SPALDING 斯伯丁 SGT 深溝柔軟膠系列 星際藍 Rubber 籃球 7號',	26,	29,	750,	3,	2250,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	''),
(25,	12,	30,	'Speedo 成人 進階型泳鏡 Cyclone II 黑灰',	28,	31,	600,	2,	1200,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('tzehan0412@gmail.com',	'ae43b8d20dff31683527945acde27090d7dccda57e1c34bb320e71035b1eb403',	'2019-06-05 08:00:35');

DROP TABLE IF EXISTS `places`;
CREATE TABLE `places` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `keeper` int(11) NOT NULL,
  `lendable` tinyint(1) NOT NULL,
  `location` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vendor` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `warranty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lendname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `week_id` int(11) DEFAULT NULL,
  `time_id` int(11) DEFAULT NULL,
  `file` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `file1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assets_id_index` (`id`),
  KEY `assets_category_index` (`category`),
  KEY `assets_keeper_index` (`keeper`),
  KEY `assets_warranty_index` (`warranty`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `plants`;
CREATE TABLE `plants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plants_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dust` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cleanup_co2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cleanup_organic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cleanup_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spread` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction_img1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction_img2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `style` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `output` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `goods_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `is_feature` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `previleges`;
CREATE TABLE `previleges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `previleges` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'使用者',	NULL,	NULL),
(2,	'一般管理者',	NULL,	NULL),
(3,	'管理員',	NULL,	NULL),
(4,	'系統管理員',	NULL,	NULL);

DROP TABLE IF EXISTS `receives`;
CREATE TABLE `receives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receives_user_id_index` (`user_id`),
  KEY `receives_supply_id_index` (`supply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `report`;
CREATE TABLE `report` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(99) NOT NULL,
  `earn` int(99) NOT NULL DEFAULT '0',
  `trade` int(99) NOT NULL DEFAULT '0',
  `created_at` time NOT NULL,
  `updated_at` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `report` (`id`, `good_id`, `earn`, `trade`, `created_at`, `updated_at`) VALUES
(12,	20,	4500,	18,	'21:07:35',	'16:57:52'),
(13,	21,	200,	2,	'21:16:56',	'17:16:50'),
(14,	22,	0,	0,	'21:20:30',	'21:20:30'),
(15,	23,	0,	0,	'21:36:07',	'21:36:07'),
(16,	24,	6800,	17,	'21:39:33',	'17:16:50'),
(17,	25,	400,	1,	'21:55:58',	'17:16:58'),
(18,	26,	0,	0,	'21:59:08',	'21:59:08'),
(19,	27,	150,	1,	'22:05:07',	'17:17:06'),
(20,	28,	2800,	14,	'22:13:57',	'16:57:52'),
(21,	29,	0,	0,	'22:17:33',	'22:17:33'),
(22,	30,	0,	0,	'22:36:53',	'22:36:53'),
(23,	31,	0,	0,	'22:50:52',	'22:50:52');

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `goods` int(11) NOT NULL,
  `orders` int(11) NOT NULL,
  `prices` int(11) NOT NULL,
  `vip` int(11) NOT NULL,
  `vip_discount` double NOT NULL,
  `low_prices` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  `photo1` varchar(255) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `photo3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `setting` (`id`, `goods`, `orders`, `prices`, `vip`, `vip_discount`, `low_prices`, `updated_at`, `photo1`, `photo2`, `photo3`) VALUES
(1,	2,	3,	70,	1000,	8.5,	500,	'2019-04-23',	'/uploads/2019-04-09/20190409210550905.jpg',	'/uploads/2019-04-09/20190409210550688.jpg',	'/uploads/2019-04-09/20190409210550421.jpg');

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(50) NOT NULL DEFAULT '配合中',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `suppliers` (`id`, `name`, `phone`, `address`, `created_at`, `updated_at`, `status`) VALUES
(4,	'摩曼頓企業股份有限公司',	'04-36118385',	'臺中市北區太平路26之1號1F',	'2019-05-30 13:03:05',	'2019-05-30 13:03:05',	'配合中'),
(5,	'迪卡儂',	'04-24264107',	'台中市北屯區中清路二段1075號',	'2019-05-30 13:48:17',	'2019-05-30 13:48:17',	'配合中'),
(6,	'adidas',	'04 2223 5101',	'台中市台中市北區三民路三段161號B棟9樓',	'2019-06-05 16:27:29',	'2019-06-05 16:27:29',	'配合中');

DROP TABLE IF EXISTS `suppliersdetail`;
CREATE TABLE `suppliersdetail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `checked` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `suppliersdetail` (`id`, `name`, `supplier_id`, `value`, `price`, `created_at`, `updated_at`, `checked`) VALUES
(23,	'20',	4,	70,	500,	'2019-05-30 13:08:15',	'2019-05-30 13:08:15',	0),
(24,	'21',	4,	100,	400,	'2019-05-30 13:17:40',	'2019-05-30 13:17:23',	0),
(25,	'22',	4,	110,	500,	'2019-05-30 13:22:19',	'2019-05-30 13:22:19',	0),
(26,	'23',	4,	100,	600,	'2019-05-30 13:36:38',	'2019-05-30 13:36:38',	0),
(27,	'24',	4,	100,	800,	'2019-05-30 13:40:02',	'2019-05-30 13:40:02',	0),
(28,	'25',	5,	100,	800,	'2019-05-30 13:56:29',	'2019-05-30 13:56:29',	0),
(29,	'26',	5,	100,	500,	'2019-05-30 13:59:32',	'2019-05-30 13:59:32',	0),
(30,	'27',	5,	100,	300,	'2019-05-30 14:05:33',	'2019-05-30 14:05:33',	0),
(31,	'28',	5,	100,	400,	'2019-05-30 14:14:24',	'2019-05-30 14:14:24',	0),
(32,	'29',	5,	100,	350,	'2019-05-30 14:18:00',	'2019-05-30 14:18:00',	0),
(33,	'30',	6,	100,	350,	'2019-05-30 14:37:21',	'2019-05-30 14:37:21',	0),
(34,	'31',	6,	100,	5000,	'2019-05-30 14:51:14',	'2019-05-30 14:51:14',	0);

DROP TABLE IF EXISTS `times`;
CREATE TABLE `times` (
  `id` int(10) unsigned NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `previlege_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `times` int(11) DEFAULT '0',
  `place` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `vip` int(11) DEFAULT '0',
  `vip_time` date DEFAULT NULL,
  `level` int(11) DEFAULT '0',
  `check` int(11) DEFAULT '0',
  `gender` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`address`, `id`, `name`, `email`, `password`, `extension`, `position`, `phone`, `department_id`, `previlege_id`, `remember_token`, `created_at`, `updated_at`, `times`, `place`, `vip`, `vip_time`, `level`, `check`, `gender`) VALUES
('國立勤益科技大學',	26,	'尤盈宜',	'admin123@gmail.com',	'$2y$10$vRr3uA2eVDGdNSFfaJytx.M7fhbIIOlJRKUho7NrM0EzC4wTwjYse',	'',	'管理員',	'0945678912',	1,	3,	'UDEGgSMRx8BGUKigyayfB7TtsLinCMkwZSUHV5d2ufE1k4JJiNe4E13qkLa0',	'2019-01-15 09:10:06',	'2019-06-05 10:18:09',	0,	NULL,	1,	'2019-05-20',	66750,	1,	'女'),
('國立勤益科技大學',	28,	'黃宥領',	'yolin0513@gmail.com',	'$2y$10$ogtzDSWkZD8gFakKjLFzEur2J/M08HQDGDfuRyg90eexF4Uco/Rwu',	NULL,	NULL,	'0975827056',	1,	1,	'cCKhDJvu4V7RtCZjOF2FkKgzUMiW2HOZanVPla2f6enhJQnWtVFd6suyTIMu',	'2019-02-26 12:30:03',	'2019-02-26 12:31:04',	0,	NULL,	NULL,	NULL,	NULL,	0,	'男'),
('國立勤益科技大學',	29,	'陳資翰',	'tzehan0412@gmail.com',	'$2y$10$BYNI4A4/ZoeWprauw5U.Ve5pPWC3jHf9Anv39hAPhlq2cu4EVkOxO',	'',	'',	'0936763689',	1,	3,	'zcmWdrS4SJNm4AzA8Knoh2Fl3EO3QtphV5TIANtHFNEqcFGoHGMsYGn2qgYl',	'2019-05-22 08:19:17',	'2019-05-31 07:04:00',	0,	NULL,	0,	NULL,	900,	0,	'男'),
('台中市北屯區文心路四段',	30,	'陳資翰',	'tzehan870412@gmail.com',	'$2y$10$QzGHlW5UbyzbqtM/1NV6Y.OJ4jelEKZvY8sjvDS64qgTxNuXr33Ce',	'',	NULL,	'0936763689',	1,	1,	'16HyjgKacY4JKnm2sFkvfwrdy2jTkPaKPFcQI5wHeTgLqW40qvf3eK1PuFbC',	'2019-06-05 08:07:06',	'2019-06-05 15:48:11',	0,	NULL,	1,	'2019-06-05',	14125,	1,	'男');

DROP TABLE IF EXISTS `weeks`;
CREATE TABLE `weeks` (
  `id` int(10) unsigned NOT NULL,
  `week` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `weeks` (`id`, `week`) VALUES
(1,	'星期一'),
(2,	'星期二'),
(3,	'星期三'),
(4,	'星期四'),
(5,	'星期五');

DROP TABLE IF EXISTS `wrongs`;
CREATE TABLE `wrongs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `wrongname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `wrongs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- 2019-06-05 16:27:38
