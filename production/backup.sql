

CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime DEFAULT NULL,
  `description` text,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activity_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=905 DEFAULT CHARSET=utf8;

INSERT INTO activity VALUES("1","2020-01-14 14:47:08","Login - \'admin\'","1");
INSERT INTO activity VALUES("2","2020-01-14 14:55:51","Customer - updated:CHARITH MOTOR TRADERS - PILIYANDALA","1");
INSERT INTO activity VALUES("3","2020-01-14 15:00:32","Invoice (Invoice:OF20011400001)- saved ","1");
INSERT INTO activity VALUES("4","2020-01-14 15:05:34","Customer - updated:NEW LEYLAND MOTORS HOMAGAMA","1");
INSERT INTO activity VALUES("5","2020-01-14 15:10:07","Product - saved : SAM500","1");
INSERT INTO activity VALUES("6","2020-01-14 15:12:42","GRN - saved:1","1");
INSERT INTO activity VALUES("7","2020-01-14 15:17:56","Invoice (Invoice:OF20011400002)- saved ","1");
INSERT INTO activity VALUES("8","2020-01-14 15:20:31","Customer - updated:RANJITH MOTORS -COLOMBO 14","1");
INSERT INTO activity VALUES("9","2020-01-14 15:25:00","Invoice (Invoice:OF20011400003)- saved ","1");
INSERT INTO activity VALUES("10","2020-01-14 15:27:02","Customer - updated:SAMUDAYA MOTORS -HORANA","1");
INSERT INTO activity VALUES("11","2020-01-14 15:32:27","Invoice (Invoice:OF20011400004)- saved ","1");
INSERT INTO activity VALUES("12","2020-01-14 15:39:03","Invoice (Invoice:OF20011400005)- saved ","1");
INSERT INTO activity VALUES("13","2020-01-14 15:41:30","Invoice (Invoice:OF20011400006)- saved ","1");
INSERT INTO activity VALUES("14","2020-01-14 16:43:43","Login - \'admin\'","1");
INSERT INTO activity VALUES("15","2020-01-14 16:51:28","Login - \'admin\'","1");
INSERT INTO activity VALUES("16","2020-01-14 17:43:07","Login - \'admin\'","1");
INSERT INTO activity VALUES("17","2020-01-14 18:10:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("18","2020-01-14 18:23:33","Login - \'admin\'","1");
INSERT INTO activity VALUES("19","2020-01-14 18:25:33","Login - \'admin\'","1");
INSERT INTO activity VALUES("20","2020-01-16 10:31:27","Login - \'admin\'","1");
INSERT INTO activity VALUES("23","2020-01-16 11:19:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("25","2020-01-16 12:09:08","Customer - saved:UDARA MOTOR STORES","1");
INSERT INTO activity VALUES("26","2020-01-16 12:09:09","Logout - \'admin\'","1");
INSERT INTO activity VALUES("27","2020-01-16 12:09:27","Login - \'admin\'","1");
INSERT INTO activity VALUES("28","2020-01-16 12:38:06","Customer - updated:UDARA MOTOR STORES","1");
INSERT INTO activity VALUES("29","2020-01-16 12:45:25","Invoice (Invoice:OF20011600007)- saved ","1");
INSERT INTO activity VALUES("30","2020-01-16 12:48:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("31","2020-01-16 13:03:24","Login - \'admin\'","1");
INSERT INTO activity VALUES("32","2020-01-16 13:13:24","Customer - saved:K.N.PERERA AND SOONS-PANADURA.","1");
INSERT INTO activity VALUES("33","2020-01-16 13:16:33","Customer - updated:K.N.PERERA AND SOONS-PANADURA.","1");
INSERT INTO activity VALUES("34","2020-01-16 13:21:00","Invoice (Invoice:OF20011600008)- saved ","1");
INSERT INTO activity VALUES("35","2020-01-16 13:32:54","Customer - updated:SAYUMI MOTORS - THANGALLE","1");
INSERT INTO activity VALUES("36","2020-01-16 13:42:18","Login - \'admin\'","1");
INSERT INTO activity VALUES("37","2020-01-16 13:44:02","Login - \'admin\'","1");
INSERT INTO activity VALUES("38","2020-01-16 13:52:30","Login - \'admin\'","1");
INSERT INTO activity VALUES("39","2020-01-16 13:52:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("40","2020-01-16 13:54:10","Login - \'admin\'","1");
INSERT INTO activity VALUES("41","2020-01-16 13:56:12","Customer - updated:UDARA MOTOR STORES -GALLE","1");
INSERT INTO activity VALUES("42","2020-01-16 14:00:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("43","2020-01-16 14:46:40","Login - \'admin\'","1");
INSERT INTO activity VALUES("44","2020-01-16 14:50:27","Customer - saved:NEW HAWANA MOTOR STORES - AMBALANGODA","1");
INSERT INTO activity VALUES("45","2020-01-16 16:14:41","Login - \'admin\'","1");
INSERT INTO activity VALUES("46","2020-01-17 15:51:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("47","2020-01-17 16:05:44","Login - \'admin\'","1");
INSERT INTO activity VALUES("48","2020-01-17 16:10:12","Customer - saved:SIRILAKA MOTORS - THALGASWALA.","1");
INSERT INTO activity VALUES("49","2020-01-17 16:13:56","Invoice (Invoice:OF20011700009)- saved ","1");
INSERT INTO activity VALUES("50","2020-01-17 16:16:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("51","2020-01-17 17:37:14","Login - \'admin\'","1");
INSERT INTO activity VALUES("52","2020-01-21 11:25:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("53","2020-01-21 15:28:36","Login - \'admin\'","1");
INSERT INTO activity VALUES("54","2020-01-21 15:34:20","Supplier - saved : MACAS AUTOMOTIVE","1");
INSERT INTO activity VALUES("55","2020-01-21 16:28:27","Logout - \'admin\'","1");
INSERT INTO activity VALUES("56","2020-01-21 16:28:43","Login - \'admin\'","1");
INSERT INTO activity VALUES("57","2020-01-22 06:58:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("58","2020-01-22 07:28:31","GRN - saved:2","1");
INSERT INTO activity VALUES("59","2020-01-22 08:50:27","Login - \'admin\'","1");
INSERT INTO activity VALUES("60","2020-01-22 08:54:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("61","2020-01-22 08:56:45","GRN - saved:3","1");
INSERT INTO activity VALUES("62","2020-01-22 10:44:12","Login - \'admin\'","1");
INSERT INTO activity VALUES("63","2020-01-22 10:45:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("64","2020-01-22 11:26:57","Login - \'admin\'","1");
INSERT INTO activity VALUES("65","2020-01-22 11:31:15","Customer - updated:PATHMA MOTOR STORES - KADAWATHA","1");
INSERT INTO activity VALUES("66","2020-01-22 20:22:49","Login - \'admin\'","1");
INSERT INTO activity VALUES("67","2020-01-23 06:14:17","Login - \'admin\'","1");
INSERT INTO activity VALUES("68","2020-01-23 06:20:54","Customer - updated:WARUNAMAL MOTORS -NARAMALA","1");
INSERT INTO activity VALUES("69","2020-01-23 06:28:31","Invoice (Invoice:OF20012300010)- saved ","1");
INSERT INTO activity VALUES("70","2020-01-23 06:32:36","Customer - updated:NEW RAJARATA MOTORS -KEKIRAWA","1");
INSERT INTO activity VALUES("71","2020-01-23 06:35:48","Invoice (Invoice:OF20012300011)- saved ","1");
INSERT INTO activity VALUES("72","2020-01-23 06:45:06","Customer - updated:SHAN MOTORS -NOCHCHIYAGAMA","1");
INSERT INTO activity VALUES("73","2020-01-23 06:47:13","Invoice (Invoice:OF20012300012)- saved ","1");
INSERT INTO activity VALUES("74","2020-01-23 07:08:05","Login - \'admin\'","1");
INSERT INTO activity VALUES("75","2020-01-23 07:25:17","Login - \'admin\'","1");
INSERT INTO activity VALUES("76","2020-01-23 07:29:22","Customer - updated:OMEGA MOTORS -AMBILIPITIYA","1");
INSERT INTO activity VALUES("77","2020-01-23 07:40:17","Invoice (Invoice:OF20012300013)- saved ","1");
INSERT INTO activity VALUES("78","2020-01-23 07:40:20","Invoice (Invoice:)- saved ","1");
INSERT INTO activity VALUES("79","2020-01-23 07:41:47","Login - \'admin\'","1");
INSERT INTO activity VALUES("80","2020-01-23 07:51:11","Invoice (Invoice:OF20012300014)- saved ","1");
INSERT INTO activity VALUES("81","2020-01-23 07:53:41","Customer - updated:DINUDI MOTOR TRADERS -NAWINNA","1");
INSERT INTO activity VALUES("82","2020-01-23 07:58:38","Invoice (Invoice:OF20012300015)- saved ","1");
INSERT INTO activity VALUES("83","2020-01-23 08:01:19","Customer - updated:KIS MOTORS -WARAKAPOLA","1");
INSERT INTO activity VALUES("84","2020-01-23 08:03:16","Invoice (Invoice:OF20012300016)- saved ","1");
INSERT INTO activity VALUES("85","2020-01-23 08:06:06","Customer - updated:SITHMINA MOTORS MONARAGALA","1");
INSERT INTO activity VALUES("86","2020-01-23 08:16:48","Invoice (Invoice:OF20012300017)- saved ","1");
INSERT INTO activity VALUES("87","2020-01-23 08:19:55","Customer - updated:RAMITHA MOTORS- KANDY","1");
INSERT INTO activity VALUES("88","2020-01-23 08:22:37","Invoice (Invoice:OF20012300018)- saved ","1");
INSERT INTO activity VALUES("89","2020-01-23 08:31:21","Login - \'admin\'","1");
INSERT INTO activity VALUES("90","2020-01-23 08:33:01","Login - \'admin\'","1");
INSERT INTO activity VALUES("91","2020-01-23 08:58:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("92","2020-01-23 10:58:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("93","2020-01-23 11:01:19","Invoice (Invoice:OF20012300019)- saved ","1");
INSERT INTO activity VALUES("94","2020-01-23 11:07:40","Invoice (Invoice:OF20012300020)- saved ","1");
INSERT INTO activity VALUES("95","2020-01-23 11:16:27","Login - \'admin\'","1");
INSERT INTO activity VALUES("96","2020-01-23 11:23:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("97","2020-01-23 11:33:46","Customer - saved:SARATHCHANDRA MOTOR STORES -EMBILIPITIYA.","1");
INSERT INTO activity VALUES("98","2020-01-23 11:38:11","Invoice (Invoice:OF20012300021)- saved ","1");
INSERT INTO activity VALUES("99","2020-01-23 11:47:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("100","2020-01-23 11:54:33","Customer - saved:KEGALLE MOTOR STORES - KEGALLE","1");
INSERT INTO activity VALUES("101","2020-01-23 12:25:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("102","2020-01-23 12:25:46","Login - \'admin\'","1");
INSERT INTO activity VALUES("103","2020-01-23 12:36:51","GRN - saved:4","1");
INSERT INTO activity VALUES("104","2020-01-23 13:57:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("105","2020-01-23 13:58:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("106","2020-01-23 15:23:33","Login - \'admin\'","1");
INSERT INTO activity VALUES("107","2020-01-23 15:25:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("108","2020-01-23 15:31:49","Customer - saved:KUSUM MOTOR STORES -TISSAMAHARAMAYA","1");
INSERT INTO activity VALUES("109","2020-01-23 15:35:11","Invoice (Invoice:OF20012300022)- saved ","1");
INSERT INTO activity VALUES("110","2020-01-23 17:06:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("111","2020-01-24 08:04:38","Login - \'admin\'","1");
INSERT INTO activity VALUES("112","2020-01-24 08:25:57","Login - \'admin\'","1");
INSERT INTO activity VALUES("113","2020-01-24 08:33:05","Invoice (Invoice:OF20012400023)- saved ","1");
INSERT INTO activity VALUES("114","2020-01-24 08:38:00","Login - \'admin\'","1");
INSERT INTO activity VALUES("115","2020-01-24 10:05:00","Login - \'admin\'","1");
INSERT INTO activity VALUES("116","2020-01-24 10:31:55","Customer - saved:WASANTHA MOTORS -MAWANELLA","1");
INSERT INTO activity VALUES("117","2020-01-24 10:35:15","Customer - updated:WASANTHA MOTORS -MAWANELLA","1");
INSERT INTO activity VALUES("118","2020-01-24 11:07:49","Customer - updated:VICTORIA MOTORS -AMPARA","1");
INSERT INTO activity VALUES("119","2020-01-24 12:10:53","Login - \'admin\'","1");
INSERT INTO activity VALUES("120","2020-01-24 12:15:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("121","2020-01-24 12:25:09","Login - \'admin\'","1");
INSERT INTO activity VALUES("122","2020-01-24 12:38:57","Login - \'admin\'","1");
INSERT INTO activity VALUES("123","2020-01-24 12:41:09","Login - \'admin\'","1");
INSERT INTO activity VALUES("124","2020-01-24 12:52:24","Login - \'admin\'","1");
INSERT INTO activity VALUES("125","2020-01-24 13:46:41","Login - \'admin\'","1");
INSERT INTO activity VALUES("126","2020-01-24 17:11:14","Login - \'admin\'","1");
INSERT INTO activity VALUES("127","2020-01-24 17:24:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("128","2020-01-24 18:30:04","Login - \'admin\'","1");
INSERT INTO activity VALUES("129","2020-01-24 22:14:36","Login - \'admin\'","1");
INSERT INTO activity VALUES("130","2020-01-24 22:24:40","Invoice (Invoice:OF20012400024)- saved ","1");
INSERT INTO activity VALUES("131","2020-01-24 22:39:59","Customer - updated:VICTORIA MOTORS -AMPARA","1");
INSERT INTO activity VALUES("132","2020-01-24 23:00:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("133","2020-01-24 23:02:00","Customer - updated:VICTORIA MOTORS -AMPARA","1");
INSERT INTO activity VALUES("134","2020-01-24 23:05:22","Invoice (Invoice:OF20012400025)- saved ","1");
INSERT INTO activity VALUES("135","2020-01-25 08:40:52","Login - \'admin\'","1");
INSERT INTO activity VALUES("136","2020-01-25 10:00:12","Login - \'admin\'","1");
INSERT INTO activity VALUES("137","2020-01-25 10:02:45","Login - \'admin\'","1");
INSERT INTO activity VALUES("138","2020-01-25 10:24:46","Login - \'admin\'","1");
INSERT INTO activity VALUES("139","2020-01-25 10:26:50","Customer - updated:RANJANA TADE CENTER -ATHURUGIRIYA","1");
INSERT INTO activity VALUES("140","2020-01-25 10:30:48","Invoice (Invoice:OF20012500026)- saved ","1");
INSERT INTO activity VALUES("141","2020-01-25 10:53:01","Customer - saved:SISIRA MOTOR STORES - MAKOLA","1");
INSERT INTO activity VALUES("142","2020-01-25 11:02:08","Customer - updated:SISIRA MOTOR STORES - MAKOLA","1");
INSERT INTO activity VALUES("143","2020-01-25 11:06:36","Invoice (Invoice:OF20012500027)- saved ","1");
INSERT INTO activity VALUES("144","2020-01-25 11:08:20","Customer - updated:GUNADASA & COMPANY -NUWARA ELIYA","1");
INSERT INTO activity VALUES("145","2020-01-25 11:10:52","Invoice (Invoice:OF20012500028)- saved ","1");
INSERT INTO activity VALUES("146","2020-01-25 11:13:14","Invoice (Invoice:OF20012500029)- saved ","1");
INSERT INTO activity VALUES("147","2020-01-25 11:50:50","Login - \'admin\'","1");
INSERT INTO activity VALUES("148","2020-01-25 11:54:58","Invoice (Invoice:OF20012500030)- saved ","1");
INSERT INTO activity VALUES("149","2020-01-25 13:42:09","Login - \'admin\'","1");
INSERT INTO activity VALUES("150","2020-01-26 07:37:14","Login - \'admin\'","1");
INSERT INTO activity VALUES("151","2020-01-26 08:59:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("152","2020-01-26 16:26:23","Login - \'admin\'","1");
INSERT INTO activity VALUES("153","2020-01-26 17:41:10","Login - \'admin\'","1");
INSERT INTO activity VALUES("154","2020-01-27 08:20:29","Login - \'admin\'","1");
INSERT INTO activity VALUES("155","2020-01-27 10:39:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("156","2020-01-27 10:45:26","Invoice (Invoice:OF20012700031)- saved ","1");
INSERT INTO activity VALUES("157","2020-01-27 11:18:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("158","2020-01-27 11:47:28","Login - \'admin\'","1");
INSERT INTO activity VALUES("159","2020-01-27 12:02:38","Login - \'admin\'","1");
INSERT INTO activity VALUES("160","2020-01-27 12:05:00","Login - \'admin\'","1");
INSERT INTO activity VALUES("161","2020-01-27 12:06:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("162","2020-01-27 12:07:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("163","2020-01-27 13:01:49","User - deleted : Venura Narenda Silva","1");
INSERT INTO activity VALUES("164","2020-01-27 13:02:11","User - deleted : SELLAPPERUMAGE AJITH SENATH FERNANDO","1");
INSERT INTO activity VALUES("165","2020-01-27 13:02:26","User - deleted : MANINGAMUWA RATHNAYAKA MUDIYANSELAGE DISSAAYAKE GEDARA  UDAYA TRISHANTHA RATHNAYAKA","1");
INSERT INTO activity VALUES("166","2020-01-27 13:02:35","User - deleted : chinthaka Udayasiri","1");
INSERT INTO activity VALUES("167","2020-01-27 13:07:00","User - saved : RASHMI SURANGA KALUTHANTHRI","1");
INSERT INTO activity VALUES("168","2020-01-27 13:17:25","User - saved : W W PRIYNATHA UDAYA BANDARA","1");
INSERT INTO activity VALUES("169","2020-01-27 13:19:17","User - saved : T A NIROSHAN ASAKNA","1");
INSERT INTO activity VALUES("170","2020-01-27 13:20:45","User - saved : M SHIRAN THUSHARA","1");
INSERT INTO activity VALUES("171","2020-01-27 13:22:51","User - saved : OFFICE","1");
INSERT INTO activity VALUES("172","2020-01-27 13:23:03","Login - \'office\'","11");
INSERT INTO activity VALUES("173","2020-01-27 13:23:26","Login - \'priyantha\'","8");
INSERT INTO activity VALUES("174","2020-01-27 13:24:09","Login - \'sales_rep\'","7");
INSERT INTO activity VALUES("175","2020-01-27 13:24:22","Login - \'admin\'","1");
INSERT INTO activity VALUES("176","2020-01-27 13:51:20","Login - \'admin\'","1");
INSERT INTO activity VALUES("177","2020-01-27 13:57:18","Login - \'admin\'","1");
INSERT INTO activity VALUES("178","2020-01-27 14:52:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("179","2020-01-27 16:20:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("180","2020-01-27 19:36:51","Login - \'admin\'","1");
INSERT INTO activity VALUES("181","2020-01-29 08:13:05","Login - \'admin\'","1");
INSERT INTO activity VALUES("182","2020-01-29 08:19:38","Customer - updated:ISURU MOTORS  -HOMAGAMA","1");
INSERT INTO activity VALUES("183","2020-01-29 08:23:49","Invoice (Invoice:OF20012900032)- saved ","1");
INSERT INTO activity VALUES("184","2020-01-29 09:26:24","Login - \'admin\'","1");
INSERT INTO activity VALUES("185","2020-01-29 10:36:16","Login - \'admin\'","1");
INSERT INTO activity VALUES("186","2020-01-29 12:56:47","Login - \'admin\'","1");
INSERT INTO activity VALUES("187","2020-01-29 13:04:19","Login - \'admin\'","1");
INSERT INTO activity VALUES("188","2020-01-29 13:34:18","Customer - updated:SAMUDAYA MOTORS -HORANA","1");
INSERT INTO activity VALUES("189","2020-01-29 14:18:56","Logout - \'admin\'","1");
INSERT INTO activity VALUES("190","2020-01-29 14:19:51","Login - \'admin\'","1");
INSERT INTO activity VALUES("191","2020-01-29 14:44:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("192","2020-01-29 15:22:21","Login - \'admin\'","1");
INSERT INTO activity VALUES("193","2020-01-29 15:45:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("194","2020-01-30 07:53:26","Login - \'admin\'","1");
INSERT INTO activity VALUES("195","2020-01-30 08:01:46","Login - \'admin\'","1");
INSERT INTO activity VALUES("196","2020-01-30 08:07:24","Invoice (Invoice:OF20013000033)- saved ","1");
INSERT INTO activity VALUES("197","2020-01-30 08:27:07","Invoice (Invoice:OF20013000034)- saved ","1");
INSERT INTO activity VALUES("198","2020-01-30 09:20:25","Logout - \'admin\'","1");
INSERT INTO activity VALUES("199","2020-01-30 09:20:47","Login - \'admin\'","1");
INSERT INTO activity VALUES("200","2020-01-30 10:18:10","Login - \'admin\'","1");
INSERT INTO activity VALUES("201","2020-01-30 10:30:03","Invoice (Invoice:OF20013000035)- saved ","1");
INSERT INTO activity VALUES("202","2020-01-30 11:32:38","Login - \'admin\'","1");
INSERT INTO activity VALUES("203","2020-01-30 11:35:46","Login - \'admin\'","1");
INSERT INTO activity VALUES("204","2020-01-30 11:36:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("205","2020-01-30 11:38:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("206","2020-01-30 11:39:11","Login - \'admin\'","1");
INSERT INTO activity VALUES("207","2020-01-30 11:40:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("208","2020-01-31 08:20:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("209","2020-01-31 10:35:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("210","2020-01-31 12:14:54","Login - \'admin\'","1");
INSERT INTO activity VALUES("211","2020-01-31 12:33:29","Invoice (Invoice:OF20013100036)- saved ","1");
INSERT INTO activity VALUES("212","2020-01-31 13:39:11","Login - \'admin\'","1");
INSERT INTO activity VALUES("213","2020-01-31 14:53:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("214","2020-01-31 16:41:38","Login - \'admin\'","1");
INSERT INTO activity VALUES("215","2020-02-01 10:49:46","Login - \'admin\'","1");
INSERT INTO activity VALUES("216","2020-02-01 13:06:11","Login - \'admin\'","1");
INSERT INTO activity VALUES("217","2020-02-02 21:56:22","Login - \'admin\'","1");
INSERT INTO activity VALUES("218","2020-02-02 22:03:14","Customer - updated:RANJITH MOTORS -COLOMBO 14","1");
INSERT INTO activity VALUES("219","2020-02-02 22:06:35","Customer - updated:RANJITH MOTORS -COLOMBO 14","1");
INSERT INTO activity VALUES("220","2020-02-02 22:16:13","Customer - updated:RANJITH MOTORS -COLOMBO 14","1");
INSERT INTO activity VALUES("221","2020-02-02 22:28:02","Invoice (Invoice:OF20020200037)- saved ","1");
INSERT INTO activity VALUES("222","2020-02-03 09:13:08","Login - \'admin\'","1");
INSERT INTO activity VALUES("223","2020-02-03 11:26:41","Login - \'admin\'","1");
INSERT INTO activity VALUES("224","2020-02-03 11:36:36","Invoice (Invoice:OF20020300038)- saved ","1");
INSERT INTO activity VALUES("225","2020-02-03 11:40:54","Customer - saved:DAMITHA MOTORES - COLOMBO -10","1");
INSERT INTO activity VALUES("226","2020-02-03 11:44:58","Customer - saved:INWA AUTO MOTIVES -KADUWELA ,","1");
INSERT INTO activity VALUES("227","2020-02-03 11:47:32","Invoice (Invoice:OF20020300039)- saved ","1");
INSERT INTO activity VALUES("228","2020-02-03 11:49:32","Invoice (Invoice:OF20020300040)- saved ","1");
INSERT INTO activity VALUES("229","2020-02-03 11:49:56","Login - \'admin\'","1");
INSERT INTO activity VALUES("230","2020-02-03 17:25:43","Login - \'admin\'","1");
INSERT INTO activity VALUES("231","2020-02-03 18:07:38","Customer - updated:CHANDANA MOTORS - BELIATTA","1");
INSERT INTO activity VALUES("232","2020-02-05 07:54:14","Login - \'admin\'","1");
INSERT INTO activity VALUES("233","2020-02-05 07:57:31","Customer - updated:CHARITH MOTOR TRADERS - PILIYANDALA","1");
INSERT INTO activity VALUES("234","2020-02-05 08:20:40","Invoice (Invoice:OF20020500041)- saved ","1");
INSERT INTO activity VALUES("235","2020-02-05 09:21:28","Login - \'admin\'","1");
INSERT INTO activity VALUES("236","2020-02-05 09:22:18","Login - \'admin\'","1");
INSERT INTO activity VALUES("237","2020-02-05 10:06:12","Logout - \'admin\'","1");
INSERT INTO activity VALUES("238","2020-02-05 10:06:27","Login - \'admin\'","1");
INSERT INTO activity VALUES("239","2020-02-05 10:57:43","Login - \'admin\'","1");
INSERT INTO activity VALUES("240","2020-02-05 11:38:29","Logout - \'admin\'","1");
INSERT INTO activity VALUES("241","2020-02-05 11:50:22","Login - \'admin\'","1");
INSERT INTO activity VALUES("242","2020-02-05 12:53:39","Login - \'admin\'","1");
INSERT INTO activity VALUES("243","2020-02-05 12:55:59","Customer - updated:SISIRA MOTORS -KANDY","1");
INSERT INTO activity VALUES("244","2020-02-05 14:51:21","Login - \'admin\'","1");
INSERT INTO activity VALUES("245","2020-02-05 15:21:36","Login - \'admin\'","1");
INSERT INTO activity VALUES("246","2020-02-05 15:28:21","Login - \'admin\'","1");
INSERT INTO activity VALUES("247","2020-02-05 15:48:09","Login - \'admin\'","1");
INSERT INTO activity VALUES("248","2020-02-05 15:51:36","Login - \'admin\'","1");
INSERT INTO activity VALUES("249","2020-02-05 15:59:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("250","2020-02-05 16:01:04","Login - \'admin\'","1");
INSERT INTO activity VALUES("251","2020-02-05 16:07:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("252","2020-02-05 16:18:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("253","2020-02-05 16:18:05","Login - \'admin\'","1");
INSERT INTO activity VALUES("254","2020-02-05 16:32:54","Invoice (Invoice:OF20020500042)- saved ","1");
INSERT INTO activity VALUES("255","2020-02-05 16:33:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("256","2020-02-05 16:56:49","Login - \'admin\'","1");
INSERT INTO activity VALUES("257","2020-02-05 17:07:28","Supplier - saved : BANCO PRODUCTS (INDIA) LIMITED","1");
INSERT INTO activity VALUES("258","2020-02-05 17:18:11","Supplier - saved : SOUTH ASIAN AUTOMOBILE PVT LTD","1");
INSERT INTO activity VALUES("259","2020-02-05 21:22:48","Login - \'admin\'","1");
INSERT INTO activity VALUES("260","2020-02-05 21:42:32","GRN - saved:5","1");
INSERT INTO activity VALUES("261","2020-02-05 21:55:37","Product - updated : PAP-1220 LH","1");
INSERT INTO activity VALUES("262","2020-02-05 21:57:43","Product - updated : PAP-1220 LH","1");
INSERT INTO activity VALUES("263","2020-02-05 22:00:14","Product - updated : PAP-1220 LH","1");
INSERT INTO activity VALUES("264","2020-02-05 22:01:07","Product - updated : PAP-1220 LH","1");
INSERT INTO activity VALUES("265","2020-02-05 22:01:49","Product - updated : PAP-1220 LH","1");
INSERT INTO activity VALUES("266","2020-02-06 09:21:51","Login - \'admin\'","1");
INSERT INTO activity VALUES("267","2020-02-06 09:24:39","Customer - updated:SANJEEWA DIESAL MOTORS","1");
INSERT INTO activity VALUES("268","2020-02-06 13:09:45","Login - \'admin\'","1");
INSERT INTO activity VALUES("269","2020-02-06 13:22:29","Login - \'admin\'","1");
INSERT INTO activity VALUES("270","2020-02-06 13:29:07","Login - \'admin\'","1");
INSERT INTO activity VALUES("271","2020-02-06 13:33:01","Invoice (Invoice:OF20020600043)- saved ","1");
INSERT INTO activity VALUES("272","2020-02-06 13:33:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("273","2020-02-06 13:33:38","Login - \'admin\'","1");
INSERT INTO activity VALUES("274","2020-02-06 13:46:48","Login - \'admin\'","1");
INSERT INTO activity VALUES("275","2020-02-06 15:06:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("276","2020-02-06 15:10:12","Customer - updated:LEYLAND MOTORS - OROPPUWATHTA, GALLE","1");
INSERT INTO activity VALUES("277","2020-02-06 15:20:14","Invoice (Invoice:OF20020600044)- saved ","1");
INSERT INTO activity VALUES("278","2020-02-06 15:24:39","Customer - updated:JAYASEKARA MOTORS (PVT) LTD -COLOMBO 10","1");
INSERT INTO activity VALUES("279","2020-02-06 15:41:22","Invoice (Invoice:OF20020600045)- saved ","1");
INSERT INTO activity VALUES("280","2020-02-06 18:22:29","Login - \'admin\'","1");
INSERT INTO activity VALUES("281","2020-02-06 18:24:09","Login - \'admin\'","1");
INSERT INTO activity VALUES("282","2020-02-06 18:25:54","Login - \'admin\'","1");
INSERT INTO activity VALUES("283","2020-02-07 08:58:20","Login - \'admin\'","1");
INSERT INTO activity VALUES("284","2020-02-07 09:01:58","Login - \'admin\'","1");
INSERT INTO activity VALUES("285","2020-02-07 14:38:08","Login - \'admin\'","1");
INSERT INTO activity VALUES("286","2020-02-07 16:25:12","Login - \'admin\'","1");
INSERT INTO activity VALUES("287","2020-02-07 16:30:39","Customer - updated:MALWATTHA AUTO ENTERPRICES- THIHARIYA","1");
INSERT INTO activity VALUES("288","2020-02-07 16:31:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("289","2020-02-07 16:35:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("290","2020-02-07 16:36:07","Login - \'admin\'","1");
INSERT INTO activity VALUES("291","2020-02-07 16:37:01","Login - \'admin\'","1");
INSERT INTO activity VALUES("292","2020-02-07 16:39:30","Invoice (Invoice:OF20020700046)- saved ","1");
INSERT INTO activity VALUES("293","2020-02-07 16:46:44","Customer - saved:SOLANGAARACHCHI MOTORS - KULIYAPITIYA .","1");
INSERT INTO activity VALUES("294","2020-02-07 17:01:38","Invoice (Invoice:OF20020700047)- saved ","1");
INSERT INTO activity VALUES("295","2020-02-07 17:03:30","Customer - updated:HAJA MOTORS -POLONNARUWA","1");
INSERT INTO activity VALUES("296","2020-02-07 17:45:26","Customer - updated:L M PERERA MOTORS -COLOMBO 10","1");
INSERT INTO activity VALUES("297","2020-02-07 17:50:51","Invoice (Invoice:OF20020700048)- saved ","1");
INSERT INTO activity VALUES("298","2020-02-07 17:51:04","Login - \'admin\'","1");
INSERT INTO activity VALUES("299","2020-02-07 18:04:54","Login - \'admin\'","1");
INSERT INTO activity VALUES("300","2020-02-07 18:11:03","Invoice (Invoice:OF20020700049)- saved ","1");
INSERT INTO activity VALUES("301","2020-02-07 18:15:09","Login - \'admin\'","1");
INSERT INTO activity VALUES("302","2020-02-07 18:17:57","Login - \'admin\'","1");
INSERT INTO activity VALUES("303","2020-02-07 18:19:08","Invoice (Invoice:OF20020700050)- saved ","1");
INSERT INTO activity VALUES("304","2020-02-07 18:24:38","Login - \'admin\'","1");
INSERT INTO activity VALUES("305","2020-02-07 18:25:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("306","2020-02-07 18:25:53","Login - \'admin\'","1");
INSERT INTO activity VALUES("307","2020-02-07 18:35:00","Login - \'admin\'","1");
INSERT INTO activity VALUES("308","2020-02-10 09:17:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("309","2020-02-10 14:10:05","Login - \'admin\'","1");
INSERT INTO activity VALUES("310","2020-02-10 14:11:58","Login - \'admin\'","1");
INSERT INTO activity VALUES("311","2020-02-10 14:22:12","Login - \'admin\'","1");
INSERT INTO activity VALUES("312","2020-02-10 14:43:30","Login - \'admin\'","1");
INSERT INTO activity VALUES("313","2020-02-10 18:04:23","Login - \'admin\'","1");
INSERT INTO activity VALUES("314","2020-02-10 20:50:19","Login - \'admin\'","1");
INSERT INTO activity VALUES("315","2020-02-11 08:47:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("316","2020-02-11 11:46:52","Login - \'admin\'","1");
INSERT INTO activity VALUES("317","2020-02-11 15:01:49","Login - \'admin\'","1");
INSERT INTO activity VALUES("318","2020-02-11 15:24:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("319","2020-02-11 15:26:53","Login - \'admin\'","1");
INSERT INTO activity VALUES("320","2020-02-11 15:42:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("321","2020-02-11 16:00:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("322","2020-02-11 16:02:13","GRN - saved:6","1");
INSERT INTO activity VALUES("323","2020-02-11 16:06:46","Invoice (Invoice:OF20021100051)- saved ","1");
INSERT INTO activity VALUES("324","2020-02-11 17:07:26","Login - \'admin\'","1");
INSERT INTO activity VALUES("325","2020-02-12 05:31:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("326","2020-02-12 07:55:57","Login - \'admin\'","1");
INSERT INTO activity VALUES("327","2020-02-12 09:35:45","Login - \'admin\'","1");
INSERT INTO activity VALUES("328","2020-02-12 09:46:56","Customer - updated:SAMUDAYA MOTORS -HORANA","1");
INSERT INTO activity VALUES("329","2020-02-12 09:52:32","Invoice (Invoice:OF20021200052)- saved ","1");
INSERT INTO activity VALUES("330","2020-02-12 09:52:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("331","2020-02-12 10:53:21","Login - \'admin\'","1");
INSERT INTO activity VALUES("332","2020-02-12 11:00:30","Invoice (Invoice:OF20021200053)- saved ","1");
INSERT INTO activity VALUES("333","2020-02-12 11:07:01","Login - \'admin\'","1");
INSERT INTO activity VALUES("334","2020-02-12 14:48:40","Login - \'admin\'","1");
INSERT INTO activity VALUES("335","2020-02-12 15:07:45","Login - \'admin\'","1");
INSERT INTO activity VALUES("336","2020-02-12 15:08:31","Invoice (Invoice:OF20021200054)- saved ","1");
INSERT INTO activity VALUES("337","2020-02-12 17:10:08","Login - \'admin\'","1");
INSERT INTO activity VALUES("338","2020-02-12 20:18:52","Login - \'admin\'","1");
INSERT INTO activity VALUES("339","2020-02-12 20:28:53","Invoice (Invoice:OF20021200055)- saved ","1");
INSERT INTO activity VALUES("340","2020-02-12 20:28:54","Invoice (Invoice:)- saved ","1");
INSERT INTO activity VALUES("341","2020-02-12 20:34:42","Invoice (Invoice:OF20021200056)- saved ","1");
INSERT INTO activity VALUES("342","2020-02-12 20:37:03","Customer - saved:Mr.Rashmie - Assistant Sales Manager","1");
INSERT INTO activity VALUES("343","2020-02-12 20:40:53","Invoice (Invoice:OF20021200057)- saved ","1");
INSERT INTO activity VALUES("344","2020-02-12 20:44:36","Login - \'admin\'","1");
INSERT INTO activity VALUES("345","2020-02-12 20:51:44","Login - \'admin\'","1");
INSERT INTO activity VALUES("346","2020-02-13 09:42:34","Login - \'admin\'","1");
INSERT INTO activity VALUES("347","2020-02-13 09:45:28","Login - \'admin\'","1");
INSERT INTO activity VALUES("348","2020-02-13 10:27:12","Login - \'admin\'","1");
INSERT INTO activity VALUES("349","2020-02-13 16:21:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("350","2020-02-13 17:55:52","Login - \'admin\'","1");
INSERT INTO activity VALUES("351","2020-02-13 18:09:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("352","2020-02-13 18:11:07","Login - \'admin\'","1");
INSERT INTO activity VALUES("353","2020-02-14 15:34:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("354","2020-02-14 15:38:30","Customer - updated:PATHMA MOTOR STORES - KADAWATHA","1");
INSERT INTO activity VALUES("355","2020-02-14 15:40:15","Invoice (Invoice:OF20021400058)- saved ","1");
INSERT INTO activity VALUES("356","2020-02-14 15:43:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("357","2020-02-14 18:04:14","Login - \'admin\'","1");
INSERT INTO activity VALUES("358","2020-02-16 12:42:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("359","2020-02-16 16:27:34","Login - \'admin\'","1");
INSERT INTO activity VALUES("360","2020-02-16 18:56:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("361","2020-02-16 20:10:07","Login - \'admin\'","1");
INSERT INTO activity VALUES("362","2020-02-16 20:43:47","Login - \'admin\'","1");
INSERT INTO activity VALUES("363","2020-02-16 21:10:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("364","2020-02-17 00:15:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("365","2020-02-17 00:37:56","Login - \'admin\'","1");
INSERT INTO activity VALUES("366","2020-02-17 08:40:15","Login - \'admin\'","1");
INSERT INTO activity VALUES("367","2020-02-17 08:41:58","Customer - updated:UDARA MOTORS -WELIWERIYA","1");
INSERT INTO activity VALUES("368","2020-02-17 08:46:15","Invoice (Invoice:OF20021700059)- saved ","1");
INSERT INTO activity VALUES("369","2020-02-17 08:53:54","Login - \'admin\'","1");
INSERT INTO activity VALUES("370","2020-02-17 08:53:58","Login - \'admin\'","1");
INSERT INTO activity VALUES("371","2020-02-17 08:54:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("372","2020-02-17 09:06:56","Login - \'admin\'","1");
INSERT INTO activity VALUES("373","2020-02-17 09:06:56","Login - \'admin\'","1");
INSERT INTO activity VALUES("374","2020-02-17 09:12:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("375","2020-02-17 09:26:08","Login - \'admin\'","1");
INSERT INTO activity VALUES("376","2020-02-17 11:17:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("377","2020-02-17 11:49:50","Login - \'admin\'","1");
INSERT INTO activity VALUES("378","2020-02-17 11:49:51","Login - \'admin\'","1");
INSERT INTO activity VALUES("379","2020-02-17 14:39:36","Login - \'admin\'","1");
INSERT INTO activity VALUES("380","2020-02-17 15:23:26","Login - \'admin\'","1");
INSERT INTO activity VALUES("381","2020-02-17 15:27:53","Invoice (Invoice:OF20021700060)- saved ","1");
INSERT INTO activity VALUES("382","2020-02-17 16:24:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("383","2020-02-17 16:25:52","Invoice (Invoice:OF20021700061)- saved ","1");
INSERT INTO activity VALUES("384","2020-02-17 17:54:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("385","2020-02-17 18:03:28","Invoice (Invoice:OF20021700062)- saved ","1");
INSERT INTO activity VALUES("386","2020-02-17 18:23:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("387","2020-02-18 08:31:19","Login - \'admin\'","1");
INSERT INTO activity VALUES("388","2020-02-18 14:31:47","Login - \'admin\'","1");
INSERT INTO activity VALUES("389","2020-02-18 14:48:30","Login - \'admin\'","1");
INSERT INTO activity VALUES("390","2020-02-18 14:52:23","Login - \'admin\'","1");
INSERT INTO activity VALUES("391","2020-02-18 18:03:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("392","2020-02-18 18:24:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("393","2020-02-18 18:33:07","Login - \'admin\'","1");
INSERT INTO activity VALUES("394","2020-02-18 18:38:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("395","2020-02-19 08:14:41","Login - \'admin\'","1");
INSERT INTO activity VALUES("396","2020-02-19 08:18:07","Login - \'admin\'","1");
INSERT INTO activity VALUES("397","2020-02-19 08:22:56","Login - \'admin\'","1");
INSERT INTO activity VALUES("398","2020-02-19 08:25:40","Customer - saved:SAMUKIRANA MOTORS","1");
INSERT INTO activity VALUES("399","2020-02-19 08:27:33","Customer - saved:NEW RUHUNU MOTORS","1");
INSERT INTO activity VALUES("400","2020-02-19 08:56:39","Customer - updated:SAMUKIRANA MOTORS -URUBOKKA","1");
INSERT INTO activity VALUES("401","2020-02-19 08:57:42","Customer - updated:NEW RUHUNU MOTORS -KABURUPITIYA .","1");
INSERT INTO activity VALUES("402","2020-02-19 08:59:11","Invoice (Invoice:OF20021900063)- saved ","1");
INSERT INTO activity VALUES("403","2020-02-19 09:00:48","Invoice (Invoice:OF20021900064)- saved ","1");
INSERT INTO activity VALUES("404","2020-02-19 11:58:46","Login - \'admin\'","1");
INSERT INTO activity VALUES("405","2020-02-19 12:05:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("406","2020-02-19 15:08:50","Login - \'admin\'","1");
INSERT INTO activity VALUES("407","2020-02-19 15:49:16","Login - \'admin\'","1");
INSERT INTO activity VALUES("408","2020-02-19 15:53:08","Customer - updated:SISIRA MOTORS -KANDY","1");
INSERT INTO activity VALUES("409","2020-02-19 15:55:35","Invoice (Invoice:OF20021900065)- saved ","1");
INSERT INTO activity VALUES("410","2020-02-19 17:56:40","Login - \'admin\'","1");
INSERT INTO activity VALUES("411","2020-02-19 18:33:41","Login - \'admin\'","1");
INSERT INTO activity VALUES("412","2020-02-20 12:47:29","Login - \'admin\'","1");
INSERT INTO activity VALUES("413","2020-02-20 12:47:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("414","2020-02-20 12:52:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("415","2020-02-20 13:02:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("416","2020-02-20 13:20:36","Login - \'admin\'","1");
INSERT INTO activity VALUES("417","2020-02-20 14:36:43","Login - \'admin\'","1");
INSERT INTO activity VALUES("418","2020-02-20 15:35:04","Login - \'admin\'","1");
INSERT INTO activity VALUES("419","2020-02-21 06:59:47","Login - \'admin\'","1");
INSERT INTO activity VALUES("420","2020-02-21 10:01:02","Login - \'admin\'","1");
INSERT INTO activity VALUES("421","2020-02-21 10:09:49","Login - \'admin\'","1");
INSERT INTO activity VALUES("422","2020-02-21 14:58:15","Login - \'admin\'","1");
INSERT INTO activity VALUES("423","2020-02-21 15:10:14","Login - \'admin\'","1");
INSERT INTO activity VALUES("424","2020-02-21 15:49:16","Login - \'admin\'","1");
INSERT INTO activity VALUES("425","2020-02-21 15:50:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("426","2020-02-21 16:03:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("427","2020-02-21 16:19:14","Login - \'admin\'","1");
INSERT INTO activity VALUES("428","2020-02-21 16:26:34","Invoice (Invoice:OF20022100066)- saved ","1");
INSERT INTO activity VALUES("429","2020-02-21 16:59:18","Login - \'admin\'","1");
INSERT INTO activity VALUES("430","2020-02-21 17:06:36","Invoice (Invoice:OF20022100067)- saved ","1");
INSERT INTO activity VALUES("431","2020-02-21 17:36:26","Logout - \'admin\'","1");
INSERT INTO activity VALUES("432","2020-02-21 17:36:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("433","2020-02-21 17:49:00","Login - \'admin\'","1");
INSERT INTO activity VALUES("434","2020-02-21 18:44:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("435","2020-02-21 20:04:10","Login - \'admin\'","1");
INSERT INTO activity VALUES("436","2020-02-21 20:13:27","Login - \'admin\'","1");
INSERT INTO activity VALUES("437","2020-02-21 21:29:56","Login - \'admin\'","1");
INSERT INTO activity VALUES("438","2020-02-21 21:43:25","Login - \'admin\'","1");
INSERT INTO activity VALUES("439","2020-02-22 12:51:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("440","2020-02-22 12:52:11","Login - \'admin\'","1");
INSERT INTO activity VALUES("441","2020-02-24 08:20:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("442","2020-02-24 08:25:51","Invoice (Invoice:OF20022400068)- saved ","1");
INSERT INTO activity VALUES("443","2020-02-24 08:30:45","Customer - updated:PATHINAYAKE MOTORS - MONARAGALA","1");
INSERT INTO activity VALUES("444","2020-02-24 08:34:26","Invoice (Invoice:OF20022400069)- saved ","1");
INSERT INTO activity VALUES("445","2020-02-24 08:37:31","Customer - updated:SG LANKA ENTERPRICES -KADAWATHA","1");
INSERT INTO activity VALUES("446","2020-02-24 08:46:17","Invoice (Invoice:OF20022400070)- saved ","1");
INSERT INTO activity VALUES("447","2020-02-24 08:48:00","Invoice (Invoice:OF20022400071)- saved ","1");
INSERT INTO activity VALUES("448","2020-02-24 08:49:08","Login - \'admin\'","1");
INSERT INTO activity VALUES("449","2020-02-24 08:50:51","Login - \'admin\'","1");
INSERT INTO activity VALUES("450","2020-02-24 09:06:58","Login - \'admin\'","1");
INSERT INTO activity VALUES("451","2020-02-24 10:49:36","Login - \'admin\'","1");
INSERT INTO activity VALUES("452","2020-02-24 12:27:23","Login - \'admin\'","1");
INSERT INTO activity VALUES("453","2020-02-24 12:49:30","Login - \'admin\'","1");
INSERT INTO activity VALUES("454","2020-02-24 13:07:34","Invoice (Invoice:OF20022400072)- saved ","1");
INSERT INTO activity VALUES("455","2020-02-24 13:13:24","Invoice (Invoice:OF20022400073)- saved ","1");
INSERT INTO activity VALUES("456","2020-02-24 13:35:54","Login - \'admin\'","1");
INSERT INTO activity VALUES("457","2020-02-24 14:19:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("458","2020-02-24 14:38:21","Login - \'admin\'","1");
INSERT INTO activity VALUES("459","2020-02-24 14:42:45","Login - \'admin\'","1");
INSERT INTO activity VALUES("460","2020-02-24 16:33:29","Login - \'admin\'","1");
INSERT INTO activity VALUES("461","2020-02-24 17:05:59","Logout - \'admin\'","1");
INSERT INTO activity VALUES("462","2020-02-24 17:06:17","Login - \'admin\'","1");
INSERT INTO activity VALUES("463","2020-02-24 19:27:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("464","2020-02-25 07:06:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("465","2020-02-25 08:42:43","Login - \'admin\'","1");
INSERT INTO activity VALUES("466","2020-02-25 10:12:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("467","2020-02-25 10:17:20","Invoice (Invoice:OF20022500074)- saved ","1");
INSERT INTO activity VALUES("468","2020-02-25 11:35:05","Login - \'admin\'","1");
INSERT INTO activity VALUES("469","2020-02-25 11:39:58","Login - \'admin\'","1");
INSERT INTO activity VALUES("470","2020-02-25 13:32:14","Login - \'admin\'","1");
INSERT INTO activity VALUES("471","2020-02-25 13:36:40","Customer - saved:WP-LH-0873. ...(TATA 2516) LORRY","1");
INSERT INTO activity VALUES("472","2020-02-25 13:38:52","Invoice (Invoice:OF20022500075)- saved ","1");
INSERT INTO activity VALUES("473","2020-02-25 14:57:23","Login - \'admin\'","1");
INSERT INTO activity VALUES("474","2020-02-25 15:00:41","Login - \'admin\'","1");
INSERT INTO activity VALUES("475","2020-02-25 15:16:35","Product Return EXM-3101-0 Qty: 3- Returned ","1");
INSERT INTO activity VALUES("476","2020-02-25 15:16:35","Invoice Return 36 Amount: 34056.75- Returned ","1");
INSERT INTO activity VALUES("477","2020-02-25 16:35:27","Login - \'admin\'","1");
INSERT INTO activity VALUES("478","2020-02-26 07:59:52","Login - \'admin\'","1");
INSERT INTO activity VALUES("479","2020-02-26 09:37:27","Login - \'admin\'","1");
INSERT INTO activity VALUES("480","2020-02-26 11:05:26","Login - \'admin\'","1");
INSERT INTO activity VALUES("481","2020-02-26 11:08:13","Invoice (Invoice:OF20022600076)- saved ","1");
INSERT INTO activity VALUES("482","2020-02-26 11:38:28","Product Return EXM-3101-0 Qty: 3- Returned ","1");
INSERT INTO activity VALUES("483","2020-02-26 11:38:28","Invoice Return 36 Amount: 30651.08- Returned ","1");
INSERT INTO activity VALUES("484","2020-02-26 12:09:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("485","2020-02-26 12:11:54","Customer - updated:PATHIRANA MOTORS - MIDDENIYA","1");
INSERT INTO activity VALUES("486","2020-02-26 12:14:20","Invoice (Invoice:OF20022600077)- saved ","1");
INSERT INTO activity VALUES("487","2020-02-26 12:15:12","Login - \'admin\'","1");
INSERT INTO activity VALUES("488","2020-02-26 12:15:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("489","2020-02-26 12:24:14","Customer - saved:SAMAGI MOTORS AND AUTO SERVICE -BUTTALA .","1");
INSERT INTO activity VALUES("490","2020-02-26 12:32:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("491","2020-02-26 12:35:24","Invoice (Invoice:OF20022600078)- saved ","1");
INSERT INTO activity VALUES("492","2020-02-26 12:35:49","Login - \'admin\'","1");
INSERT INTO activity VALUES("493","2020-02-26 13:15:22","Login - \'admin\'","1");
INSERT INTO activity VALUES("494","2020-02-26 14:34:30","Login - \'admin\'","1");
INSERT INTO activity VALUES("495","2020-02-26 15:03:21","Login - \'admin\'","1");
INSERT INTO activity VALUES("496","2020-02-26 15:44:16","Login - \'admin\'","1");
INSERT INTO activity VALUES("497","2020-02-26 15:45:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("498","2020-02-26 15:49:10","Login - \'admin\'","1");
INSERT INTO activity VALUES("499","2020-02-26 16:26:29","Login - \'admin\'","1");
INSERT INTO activity VALUES("500","2020-02-26 17:29:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("501","2020-02-26 17:40:27","Login - \'admin\'","1");
INSERT INTO activity VALUES("502","2020-02-26 17:55:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("503","2020-02-26 18:05:53","Login - \'admin\'","1");
INSERT INTO activity VALUES("504","2020-02-26 18:11:14","Login - \'admin\'","1");
INSERT INTO activity VALUES("505","2020-02-26 18:14:09","Login - \'admin\'","1");
INSERT INTO activity VALUES("506","2020-02-26 18:16:58","Product Return SM3&4STD-FF-WBR Qty: 2- Returned ","1");
INSERT INTO activity VALUES("507","2020-02-26 18:16:58","Invoice Return 24 Amount: 0.00- Returned ","1");
INSERT INTO activity VALUES("508","2020-02-26 18:20:36","Invoice (Invoice:OF20022600079)- saved ","1");
INSERT INTO activity VALUES("509","2020-02-26 18:49:08","Privilege - updated : for Rep","1");
INSERT INTO activity VALUES("510","2020-02-26 18:49:51","Login - \'shiran\'","10");
INSERT INTO activity VALUES("511","2020-02-27 06:18:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("512","2020-02-27 07:13:53","Login - \'admin\'","1");
INSERT INTO activity VALUES("513","2020-02-27 07:16:35","Payment (Code:1) - saved ","1");
INSERT INTO activity VALUES("514","2020-02-27 08:32:45","Login - \'admin\'","1");
INSERT INTO activity VALUES("515","2020-02-27 08:45:40","Login - \'admin\'","1");
INSERT INTO activity VALUES("516","2020-02-27 09:01:19","Login - \'admin\'","1");
INSERT INTO activity VALUES("517","2020-02-27 09:06:19","Login - \'admin\'","1");
INSERT INTO activity VALUES("518","2020-02-27 09:14:08","Login - \'admin\'","1");
INSERT INTO activity VALUES("519","2020-02-27 10:53:01","Login - \'shiran\'","10");
INSERT INTO activity VALUES("520","2020-02-27 10:54:38","Login - \'admin\'","1");
INSERT INTO activity VALUES("521","2020-02-27 10:58:14","Login - \'admin\'","1");
INSERT INTO activity VALUES("522","2020-02-27 11:09:21","Login - \'shiran\'","10");
INSERT INTO activity VALUES("523","2020-02-27 11:14:40","Invoice (Invoice:OF20022700080)- saved ","1");
INSERT INTO activity VALUES("524","2020-02-27 11:14:43","Invoice (Invoice:)- saved ","1");
INSERT INTO activity VALUES("525","2020-02-27 11:16:20","Invoice - deleted:OF20022700080","1");
INSERT INTO activity VALUES("526","2020-02-27 11:26:15","Login - \'niroshan\'","9");
INSERT INTO activity VALUES("527","2020-02-27 11:46:32","Login - \'shiran\'","10");
INSERT INTO activity VALUES("528","2020-02-27 11:46:51","Login - \'asanga\'","9");
INSERT INTO activity VALUES("529","2020-02-27 11:49:22","Login - \'asanga\'","9");
INSERT INTO activity VALUES("530","2020-02-27 11:51:17","Login - \'asanga\'","9");
INSERT INTO activity VALUES("531","2020-02-27 11:52:56","Login - \'asanga\'","9");
INSERT INTO activity VALUES("532","2020-02-27 11:53:21","Login - \'asanga\'","9");
INSERT INTO activity VALUES("533","2020-02-27 11:53:54","Login - \'asanga\'","9");
INSERT INTO activity VALUES("534","2020-02-27 12:15:02","Login - \'asanga\'","9");
INSERT INTO activity VALUES("535","2020-02-27 12:15:57","Login - \'shiran\'","10");
INSERT INTO activity VALUES("536","2020-02-27 12:16:35","Login - \'admin\'","1");
INSERT INTO activity VALUES("537","2020-02-27 12:17:40","Deliverer - saved : 2","1");
INSERT INTO activity VALUES("538","2020-02-27 12:18:12","Deliverer - saved : 3","1");
INSERT INTO activity VALUES("539","2020-02-27 12:18:55","Deliverer - saved : 4","1");
INSERT INTO activity VALUES("540","2020-02-27 12:19:17","Login - \'asanga\'","9");
INSERT INTO activity VALUES("541","2020-02-27 12:22:49","Login - \'shiran\'","10");
INSERT INTO activity VALUES("542","2020-02-27 12:24:00","Login - \'asanga\'","9");
INSERT INTO activity VALUES("543","2020-02-27 12:37:11","Login - \'asanga\'","9");
INSERT INTO activity VALUES("544","2020-02-27 12:56:02","Login - \'asanga\'","9");
INSERT INTO activity VALUES("545","2020-02-27 13:00:16","Login - \'asanga\'","9");
INSERT INTO activity VALUES("546","2020-02-27 13:38:46","Login - \'admin\'","1");
INSERT INTO activity VALUES("547","2020-02-27 17:16:29","Login - \'admin\'","1");
INSERT INTO activity VALUES("548","2020-02-27 17:52:24","Logout - \'admin\'","1");
INSERT INTO activity VALUES("549","2020-02-27 20:14:52","Login - \'admin\'","1");
INSERT INTO activity VALUES("550","2020-02-27 20:55:55","Logout - \'admin\'","1");
INSERT INTO activity VALUES("551","2020-02-27 20:56:02","Login - \'admin\'","1");
INSERT INTO activity VALUES("552","2020-02-27 21:34:44","Logout - \'admin\'","1");
INSERT INTO activity VALUES("553","2020-02-27 21:34:50","Login - \'admin\'","1");
INSERT INTO activity VALUES("554","2020-02-28 08:58:54","Login - \'admin\'","1");
INSERT INTO activity VALUES("555","2020-02-28 09:00:08","Customer - updated:SITHMINA MOTORS MONARAGALA","1");
INSERT INTO activity VALUES("556","2020-02-28 09:05:57","Customer - updated:SITHMINA MOTORS MONARAGALA","1");
INSERT INTO activity VALUES("557","2020-02-28 09:06:48","Login - \'admin\'","1");
INSERT INTO activity VALUES("558","2020-02-28 14:56:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("559","2020-02-28 15:25:28","Login - \'admin\'","1");
INSERT INTO activity VALUES("560","2020-02-28 15:40:22","Login - \'admin\'","1");
INSERT INTO activity VALUES("561","2020-02-28 15:58:53","Login - \'admin\'","1");
INSERT INTO activity VALUES("562","2020-02-28 16:00:58","Customer - updated:RANJITH MOTORS -COLOMBO 14","1");
INSERT INTO activity VALUES("563","2020-02-28 16:04:41","Payment (Code:2) - saved ","1");
INSERT INTO activity VALUES("564","2020-02-28 16:05:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("565","2020-02-28 16:10:08","Login - \'admin\'","1");
INSERT INTO activity VALUES("566","2020-02-28 16:19:09","Payment (Code:3) - saved ","1");
INSERT INTO activity VALUES("567","2020-02-28 16:25:59","Payment (Code:4) - saved ","1");
INSERT INTO activity VALUES("568","2020-02-28 17:27:11","Login - \'admin\'","1");
INSERT INTO activity VALUES("569","2020-02-28 17:29:42","Payment (Code:5) - saved ","1");
INSERT INTO activity VALUES("570","2020-02-28 17:33:34","Login - \'admin\'","1");
INSERT INTO activity VALUES("571","2020-02-28 17:34:43","Payment (Code:6) - saved ","1");
INSERT INTO activity VALUES("572","2020-02-28 18:21:51","Login - \'admin\'","1");
INSERT INTO activity VALUES("573","2020-02-28 19:18:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("574","2020-02-29 07:13:07","Login - \'admin\'","1");
INSERT INTO activity VALUES("575","2020-02-29 13:23:36","Login - \'asanga\'","9");
INSERT INTO activity VALUES("576","2020-02-29 13:30:53","Login - \'asanga\'","9");
INSERT INTO activity VALUES("577","2020-03-01 09:38:11","Login - \'asanga\'","9");
INSERT INTO activity VALUES("578","2020-03-01 09:43:02","Login - \'asanga\'","9");
INSERT INTO activity VALUES("579","2020-03-01 09:49:49","Invoice (Invoice:As20030100001)- saved ","9");
INSERT INTO activity VALUES("580","2020-03-01 09:54:38","Login - \'asanga\'","9");
INSERT INTO activity VALUES("581","2020-03-01 10:02:51","Login - \'asanga\'","9");
INSERT INTO activity VALUES("582","2020-03-01 10:02:52","Login - \'asanga\'","9");
INSERT INTO activity VALUES("583","2020-03-01 10:10:41","Login - \'asanga\'","9");
INSERT INTO activity VALUES("584","2020-03-01 10:10:41","Login - \'asanga\'","9");
INSERT INTO activity VALUES("585","2020-03-02 08:44:02","Login - \'admin\'","1");
INSERT INTO activity VALUES("586","2020-03-02 09:05:51","Login - \'admin\'","1");
INSERT INTO activity VALUES("587","2020-03-02 10:07:46","Login - \'admin\'","1");
INSERT INTO activity VALUES("588","2020-03-02 10:26:18","Login - \'admin\'","1");
INSERT INTO activity VALUES("589","2020-03-02 11:41:19","Login - \'admin\'","1");
INSERT INTO activity VALUES("590","2020-03-02 15:04:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("591","2020-03-02 15:30:39","Login - \'admin\'","1");
INSERT INTO activity VALUES("592","2020-03-02 16:20:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("593","2020-03-02 16:22:35","Payment (Code:7) - saved ","1");
INSERT INTO activity VALUES("594","2020-03-02 16:30:07","Login - \'admin\'","1");
INSERT INTO activity VALUES("595","2020-03-02 17:14:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("596","2020-03-02 17:33:17","Payment (Code:8) - saved ","1");
INSERT INTO activity VALUES("597","2020-03-02 18:47:41","Login - \'shiran\'","10");
INSERT INTO activity VALUES("598","2020-03-02 19:57:00","Login - \'shiran\'","10");
INSERT INTO activity VALUES("599","2020-03-03 08:34:04","Login - \'admin\'","1");
INSERT INTO activity VALUES("600","2020-03-03 08:56:46","Login - \'admin\'","1");
INSERT INTO activity VALUES("601","2020-03-03 08:57:54","Customer - updated:SAMANALA MOTORS  -WALASMULLA","1");
INSERT INTO activity VALUES("602","2020-03-03 09:11:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("603","2020-03-03 09:12:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("604","2020-03-03 09:14:51","Login - \'shiran\'","10");
INSERT INTO activity VALUES("605","2020-03-03 09:17:49","Login - \'admin\'","1");
INSERT INTO activity VALUES("606","2020-03-03 09:35:45","Invoice (Invoice:Sh20030300001)- saved ","10");
INSERT INTO activity VALUES("607","2020-03-03 09:35:58","Invoice (Invoice:)- saved ","10");
INSERT INTO activity VALUES("608","2020-03-03 09:36:38","Invoice (Invoice:)- saved ","10");
INSERT INTO activity VALUES("609","2020-03-03 09:36:38","Invoice (Invoice:)- saved ","10");
INSERT INTO activity VALUES("610","2020-03-03 09:36:45","Invoice (Invoice:)- saved ","10");
INSERT INTO activity VALUES("611","2020-03-03 09:36:46","Invoice (Invoice:)- saved ","10");
INSERT INTO activity VALUES("612","2020-03-03 09:38:21","Login - \'admin\'","1");
INSERT INTO activity VALUES("613","2020-03-03 09:47:00","Login - \'admin\'","1");
INSERT INTO activity VALUES("614","2020-03-03 09:55:23","Login - \'admin\'","1");
INSERT INTO activity VALUES("615","2020-03-03 10:01:18","Login - \'admin\'","1");
INSERT INTO activity VALUES("616","2020-03-03 10:02:46","Invoice - deleted:","1");
INSERT INTO activity VALUES("617","2020-03-03 10:03:16","Invoice - deleted:","1");
INSERT INTO activity VALUES("618","2020-03-03 10:03:26","Invoice - deleted:","1");
INSERT INTO activity VALUES("619","2020-03-03 10:03:35","Invoice - deleted:","1");
INSERT INTO activity VALUES("620","2020-03-03 10:03:47","Invoice - deleted:","1");
INSERT INTO activity VALUES("621","2020-03-03 10:04:00","Invoice - deleted:","1");
INSERT INTO activity VALUES("622","2020-03-03 10:04:12","Invoice - deleted:","1");
INSERT INTO activity VALUES("623","2020-03-03 10:05:05","Login - \'shiran\'","10");
INSERT INTO activity VALUES("624","2020-03-03 10:08:29","Invoice (Invoice:Sh20030300002)- saved ","10");
INSERT INTO activity VALUES("625","2020-03-03 10:08:32","Invoice (Invoice:)- saved ","10");
INSERT INTO activity VALUES("626","2020-03-03 10:12:36","Invoice (Invoice:Sh20030300003)- saved ","10");
INSERT INTO activity VALUES("627","2020-03-03 10:15:23","Login - \'admin\'","1");
INSERT INTO activity VALUES("628","2020-03-03 10:16:02","Invoice - deleted:","1");
INSERT INTO activity VALUES("629","2020-03-03 10:25:28","Invoice - deleted:Sh20030300001","1");
INSERT INTO activity VALUES("630","2020-03-03 10:26:02","Invoice (Invoice:Sh20030300004)- saved ","10");
INSERT INTO activity VALUES("631","2020-03-03 10:26:05","Invoice (Invoice:)- saved ","10");
INSERT INTO activity VALUES("632","2020-03-03 10:34:11","Login - \'admin\'","1");
INSERT INTO activity VALUES("633","2020-03-03 10:39:53","Payment (Code:9) - saved ","1");
INSERT INTO activity VALUES("634","2020-03-03 10:40:09","Login - \'admin\'","1");
INSERT INTO activity VALUES("635","2020-03-03 11:09:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("636","2020-03-03 11:19:58","Login - \'admin\'","1");
INSERT INTO activity VALUES("637","2020-03-03 11:36:41","Login - \'admin\'","1");
INSERT INTO activity VALUES("638","2020-03-03 12:14:18","Login - \'shiran\'","10");
INSERT INTO activity VALUES("639","2020-03-03 12:21:44","Login - \'admin\'","1");
INSERT INTO activity VALUES("640","2020-03-03 12:37:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("641","2020-03-03 12:37:30","Invoice - deleted:Sh20030300004","1");
INSERT INTO activity VALUES("642","2020-03-03 12:56:01","Login - \'admin\'","1");
INSERT INTO activity VALUES("643","2020-03-03 13:55:25","Login - \'asanga\'","9");
INSERT INTO activity VALUES("644","2020-03-03 14:01:33","Login - \'asanga\'","9");
INSERT INTO activity VALUES("645","2020-03-03 14:23:49","Login - \'admin\'","1");
INSERT INTO activity VALUES("646","2020-03-03 14:27:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("647","2020-03-03 14:52:22","Login - \'admin\'","1");
INSERT INTO activity VALUES("648","2020-03-03 14:53:29","Customer - updated:AIN MOTORS","1");
INSERT INTO activity VALUES("649","2020-03-03 15:59:21","Login - \'admin\'","1");
INSERT INTO activity VALUES("650","2020-03-03 15:59:47","Invoice - deleted:","1");
INSERT INTO activity VALUES("651","2020-03-03 16:02:35","Login - \'asanga\'","9");
INSERT INTO activity VALUES("652","2020-03-03 16:07:12","Invoice (Invoice:As20030300002)- saved ","9");
INSERT INTO activity VALUES("653","2020-03-03 16:08:15","Login - \'admin\'","1");
INSERT INTO activity VALUES("654","2020-03-03 16:12:49","Login - \'admin\'","1");
INSERT INTO activity VALUES("655","2020-03-03 16:41:09","Login - \'asanga\'","9");
INSERT INTO activity VALUES("656","2020-03-03 16:43:43","Invoice (Invoice:As20030300003)- saved ","9");
INSERT INTO activity VALUES("657","2020-03-03 16:47:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("658","2020-03-03 16:51:53","Login - \'admin\'","1");
INSERT INTO activity VALUES("659","2020-03-03 16:53:13","Customer - updated:KUMARA MOTOR TRADERS -KURUNEGALA","1");
INSERT INTO activity VALUES("660","2020-03-03 16:57:21","Invoice (Invoice:Ra20030300001)- saved ","1");
INSERT INTO activity VALUES("661","2020-03-03 17:14:46","Login - \'shiran\'","10");
INSERT INTO activity VALUES("662","2020-03-03 17:25:53","Login - \'admin\'","1");
INSERT INTO activity VALUES("663","2020-03-03 17:33:03","Customer - updated:PATHINAYEKA MOTORS - MATARA","1");
INSERT INTO activity VALUES("664","2020-03-03 17:55:18","Login - \'admin\'","1");
INSERT INTO activity VALUES("665","2020-03-03 20:41:07","Login - \'shiran\'","10");
INSERT INTO activity VALUES("666","2020-03-03 20:58:51","Login - \'shiran\'","10");
INSERT INTO activity VALUES("667","2020-03-03 21:18:26","Product Return 8220542080-ALU Qty: 45- Returned ","10");
INSERT INTO activity VALUES("668","2020-03-04 08:33:53","Login - \'shiran\'","10");
INSERT INTO activity VALUES("669","2020-03-04 08:36:32","Login - \'admin\'","1");
INSERT INTO activity VALUES("670","2020-03-04 08:41:02","Invoice (Invoice:Sh20030400003)- saved ","10");
INSERT INTO activity VALUES("671","2020-03-04 08:41:53","Login - \'admin\'","1");
INSERT INTO activity VALUES("672","2020-03-04 08:47:33","Invoice - deleted:OF20021700059","1");
INSERT INTO activity VALUES("673","2020-03-04 08:48:16","Invoice - deleted:OF20021700060","1");
INSERT INTO activity VALUES("674","2020-03-04 08:53:27","Login - \'admin\'","1");
INSERT INTO activity VALUES("675","2020-03-04 08:54:53","Invoice - deleted:OF20021900063","1");
INSERT INTO activity VALUES("676","2020-03-04 08:55:20","Invoice - deleted:OF20021900064","1");
INSERT INTO activity VALUES("677","2020-03-04 08:55:47","Invoice - deleted:OF20021900065","1");
INSERT INTO activity VALUES("678","2020-03-04 08:56:33","Invoice - deleted:OF20022100066","1");
INSERT INTO activity VALUES("679","2020-03-04 08:57:56","Invoice - deleted:OF20022100067","1");
INSERT INTO activity VALUES("680","2020-03-04 08:58:21","Invoice - deleted:OF20022500074","1");
INSERT INTO activity VALUES("681","2020-03-04 08:58:35","Invoice - deleted:OF20022500075","1");
INSERT INTO activity VALUES("682","2020-03-04 08:59:10","Invoice - deleted:OF20022600076","1");
INSERT INTO activity VALUES("683","2020-03-04 09:00:40","Invoice - deleted:OF20022600079","1");
INSERT INTO activity VALUES("684","2020-03-04 09:01:03","Invoice - deleted:Ra20030300001","1");
INSERT INTO activity VALUES("685","2020-03-04 09:33:28","Login - \'admin\'","1");
INSERT INTO activity VALUES("686","2020-03-04 09:46:19","Login - \'admin\'","1");
INSERT INTO activity VALUES("687","2020-03-04 09:57:57","Payment (Code:10) - saved ","1");
INSERT INTO activity VALUES("688","2020-03-04 10:24:01","Login - \'admin\'","1");
INSERT INTO activity VALUES("689","2020-03-04 10:28:04","Logout - \'admin\'","1");
INSERT INTO activity VALUES("690","2020-03-04 10:28:10","Login - \'admin\'","1");
INSERT INTO activity VALUES("691","2020-03-04 10:32:31","Payment (Code:11) - saved ","1");
INSERT INTO activity VALUES("692","2020-03-04 10:40:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("693","2020-03-04 11:59:51","Login - \'shiran\'","10");
INSERT INTO activity VALUES("694","2020-03-04 12:04:51","Invoice (Invoice:Sh20030400004)- saved ","10");
INSERT INTO activity VALUES("695","2020-03-04 12:04:54","Invoice (Invoice:)- saved ","10");
INSERT INTO activity VALUES("696","2020-03-04 14:47:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("697","2020-03-04 16:22:16","Login - \'admin\'","1");
INSERT INTO activity VALUES("698","2020-03-04 17:35:00","Login - \'admin\'","1");
INSERT INTO activity VALUES("699","2020-03-05 09:35:58","Login - \'admin\'","1");
INSERT INTO activity VALUES("700","2020-03-05 11:24:19","Login - \'asanga\'","9");
INSERT INTO activity VALUES("701","2020-03-05 11:34:53","Invoice (Invoice:As20030500004)- saved ","9");
INSERT INTO activity VALUES("702","2020-03-05 14:40:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("703","2020-03-05 16:33:54","Login - \'admin\'","1");
INSERT INTO activity VALUES("704","2020-03-06 08:45:26","Login - \'asanga\'","9");
INSERT INTO activity VALUES("705","2020-03-06 08:47:26","Login - \'admin\'","1");
INSERT INTO activity VALUES("706","2020-03-06 08:51:00","Login - \'admin\'","1");
INSERT INTO activity VALUES("707","2020-03-06 08:51:01","Login - \'admin\'","1");
INSERT INTO activity VALUES("708","2020-03-06 08:52:15","Customer - updated:SUNBEAM MOTORS -COLOMBO 14","1");
INSERT INTO activity VALUES("709","2020-03-06 08:52:42","Login - \'asanga\'","9");
INSERT INTO activity VALUES("710","2020-03-06 08:55:20","Invoice (Invoice:As20030600005)- saved ","9");
INSERT INTO activity VALUES("711","2020-03-06 08:56:29","Login - \'admin\'","1");
INSERT INTO activity VALUES("712","2020-03-06 08:59:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("713","2020-03-06 09:00:34","Login - \'admin\'","1");
INSERT INTO activity VALUES("714","2020-03-06 10:42:43","Login - \'admin\'","1");
INSERT INTO activity VALUES("715","2020-03-06 10:50:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("716","2020-03-06 11:05:18","Login - \'asanga\'","9");
INSERT INTO activity VALUES("717","2020-03-06 11:20:10","Login - \'asanga\'","9");
INSERT INTO activity VALUES("718","2020-03-06 11:53:49","Login - \'asanga\'","9");
INSERT INTO activity VALUES("719","2020-03-06 12:02:40","Invoice (Invoice:As20030600006)- saved ","9");
INSERT INTO activity VALUES("720","2020-03-06 12:05:52","Login - \'admin\'","1");
INSERT INTO activity VALUES("721","2020-03-06 13:11:15","Login - \'admin\'","1");
INSERT INTO activity VALUES("722","2020-03-06 13:12:10","Login - \'admin\'","1");
INSERT INTO activity VALUES("723","2020-03-06 15:51:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("724","2020-03-06 15:51:12","Login - \'admin\'","1");
INSERT INTO activity VALUES("725","2020-03-06 15:51:18","Login - \'admin\'","1");
INSERT INTO activity VALUES("726","2020-03-06 15:52:58","Login - \'admin\'","1");
INSERT INTO activity VALUES("727","2020-03-06 15:56:07","Login - \'asanga\'","9");
INSERT INTO activity VALUES("728","2020-03-06 15:56:48","Login - \'admin\'","1");
INSERT INTO activity VALUES("729","2020-03-06 16:01:48","Invoice (Invoice:Ra20030600001)- saved ","1");
INSERT INTO activity VALUES("730","2020-03-06 16:05:12","Login - \'admin\'","1");
INSERT INTO activity VALUES("731","2020-03-06 16:06:10","Login - \'admin\'","1");
INSERT INTO activity VALUES("732","2020-03-06 16:10:49","Login - \'admin\'","1");
INSERT INTO activity VALUES("733","2020-03-06 16:55:00","Login - \'asanga\'","9");
INSERT INTO activity VALUES("734","2020-03-06 16:58:42","Invoice (Invoice:As20030600007)- saved ","9");
INSERT INTO activity VALUES("735","2020-03-07 09:38:00","Login - \'admin\'","1");
INSERT INTO activity VALUES("736","2020-03-07 10:30:29","Login - \'admin\'","1");
INSERT INTO activity VALUES("737","2020-03-07 10:35:34","Login - \'admin\'","1");
INSERT INTO activity VALUES("738","2020-03-07 12:29:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("739","2020-03-07 12:39:47","Login - \'admin\'","1");
INSERT INTO activity VALUES("740","2020-03-07 13:21:47","Login - \'admin\'","1");
INSERT INTO activity VALUES("741","2020-03-07 13:24:41","Login - \'asanga\'","9");
INSERT INTO activity VALUES("742","2020-03-07 13:51:11","Login - \'shiran\'","10");
INSERT INTO activity VALUES("743","2020-03-07 14:51:27","Login - \'admin\'","1");
INSERT INTO activity VALUES("744","2020-03-07 14:52:20","Login - \'admin\'","1");
INSERT INTO activity VALUES("745","2020-03-07 14:54:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("746","2020-03-07 15:20:17","Login - \'admin\'","1");
INSERT INTO activity VALUES("747","2020-03-09 10:57:58","Login - \'admin\'","1");
INSERT INTO activity VALUES("748","2020-03-09 11:04:15","Login - \'admin\'","1");
INSERT INTO activity VALUES("749","2020-03-09 14:24:54","Login - \'admin\'","1");
INSERT INTO activity VALUES("750","2020-03-09 14:26:27","Logout - \'admin\'","1");
INSERT INTO activity VALUES("751","2020-03-09 14:26:35","Login - \'admin\'","1");
INSERT INTO activity VALUES("752","2020-03-09 15:58:02","Login - \'admin\'","1");
INSERT INTO activity VALUES("753","2020-03-09 16:28:47","Login - \'sales_rep\'","7");
INSERT INTO activity VALUES("754","2020-03-09 16:29:26","User - password changed : RASHMI SURANGA KALUTHANTHRI","7");
INSERT INTO activity VALUES("755","2020-03-09 16:29:42","Login - \'sales_rep\'","7");
INSERT INTO activity VALUES("756","2020-03-09 16:54:02","Login - \'admin\'","1");
INSERT INTO activity VALUES("757","2020-03-09 16:55:46","Login - \'admin\'","1");
INSERT INTO activity VALUES("758","2020-03-09 21:54:30","Login - \'admin\'","1");
INSERT INTO activity VALUES("759","2020-03-10 09:35:15","Login - \'shiran\'","10");
INSERT INTO activity VALUES("760","2020-03-10 11:14:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("761","2020-03-10 11:52:14","Login - \'admin\'","1");
INSERT INTO activity VALUES("762","2020-03-10 11:53:47","Login - \'admin\'","1");
INSERT INTO activity VALUES("763","2020-03-10 13:58:49","Login - \'admin\'","1");
INSERT INTO activity VALUES("764","2020-03-10 14:44:34","Login - \'admin\'","1");
INSERT INTO activity VALUES("765","2020-03-10 15:11:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("766","2020-03-11 10:35:26","Login - \'asanga\'","9");
INSERT INTO activity VALUES("767","2020-03-11 15:01:18","Login - \'shiran\'","10");
INSERT INTO activity VALUES("768","2020-03-11 20:26:03","Login - \'asanga\'","9");
INSERT INTO activity VALUES("769","2020-03-12 09:28:30","Login - \'admin\'","1");
INSERT INTO activity VALUES("770","2020-03-12 11:58:46","Login - \'admin\'","1");
INSERT INTO activity VALUES("771","2020-03-12 12:04:42","Login - \'asanga\'","9");
INSERT INTO activity VALUES("772","2020-03-12 12:10:25","Invoice (Invoice:AS20031200008)- saved ","9");
INSERT INTO activity VALUES("773","2020-03-12 16:29:44","Login - \'admin\'","1");
INSERT INTO activity VALUES("774","2020-03-12 16:31:34","Login - \'admin\'","1");
INSERT INTO activity VALUES("775","2020-03-12 16:34:36","Customer - updated:THILANKA MOTORS -GAMPOLA","1");
INSERT INTO activity VALUES("776","2020-03-12 16:38:21","Login - \'admin\'","1");
INSERT INTO activity VALUES("777","2020-03-13 07:32:39","Login - \'admin\'","1");
INSERT INTO activity VALUES("778","2020-03-13 07:34:06","Customer - updated:THILANKA MOTORS -GAMPOLA","1");
INSERT INTO activity VALUES("779","2020-03-13 07:39:57","Login - \'shiran\'","10");
INSERT INTO activity VALUES("780","2020-03-13 07:40:40","Invoice (Invoice:RA20031300002)- saved ","1");
INSERT INTO activity VALUES("781","2020-03-13 10:58:26","Login - \'admin\'","1");
INSERT INTO activity VALUES("782","2020-03-13 13:33:47","Login - \'admin\'","1");
INSERT INTO activity VALUES("783","2020-03-13 13:57:39","Login - \'admin\'","1");
INSERT INTO activity VALUES("784","2020-03-13 15:21:34","Login - \'admin\'","1");
INSERT INTO activity VALUES("785","2020-03-13 15:32:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("786","2020-03-13 16:30:38","Login - \'admin\'","1");
INSERT INTO activity VALUES("787","2020-03-13 16:40:20","Login - \'asanga\'","9");
INSERT INTO activity VALUES("788","2020-03-14 08:37:35","Login - \'admin\'","1");
INSERT INTO activity VALUES("789","2020-03-14 08:47:07","Login - \'admin\'","1");
INSERT INTO activity VALUES("790","2020-03-14 09:26:04","Login - \'admin\'","1");
INSERT INTO activity VALUES("791","2020-03-14 09:29:37","Login - \'admin\'","1");
INSERT INTO activity VALUES("792","2020-03-14 18:18:24","Login - \'asanga\'","9");
INSERT INTO activity VALUES("793","2020-03-15 13:21:58","Login - \'admin\'","1");
INSERT INTO activity VALUES("794","2020-03-15 13:30:37","Payment (Code:12) - saved ","1");
INSERT INTO activity VALUES("795","2020-03-16 08:09:18","Login - \'admin\'","1");
INSERT INTO activity VALUES("796","2020-03-16 09:33:31","Login - \'admin\'","1");
INSERT INTO activity VALUES("797","2020-03-16 10:42:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("798","2020-03-16 10:43:39","Login - \'admin\'","1");
INSERT INTO activity VALUES("799","2020-03-16 10:48:19","Product Return EXM-312-0 Qty: 2- Returned ","1");
INSERT INTO activity VALUES("800","2020-03-16 11:26:24","Login - \'admin\'","1");
INSERT INTO activity VALUES("801","2020-03-16 11:40:43","Login - \'admin\'","1");
INSERT INTO activity VALUES("802","2020-03-16 12:38:12","Login - \'admin\'","1");
INSERT INTO activity VALUES("803","2020-03-16 15:45:44","Login - \'admin\'","1");
INSERT INTO activity VALUES("804","2020-03-16 15:52:49","Customer - updated:SAMUDAYA MOTORS -HORANA","1");
INSERT INTO activity VALUES("805","2020-03-16 16:06:19","Invoice (Invoice:RA20031600003)- saved ","1");
INSERT INTO activity VALUES("806","2020-03-16 16:46:01","Login - \'admin\'","1");
INSERT INTO activity VALUES("807","2020-03-16 17:06:13","Login - \'admin\'","1");
INSERT INTO activity VALUES("808","2020-03-16 17:23:24","Login - \'admin\'","1");
INSERT INTO activity VALUES("809","2020-03-17 06:06:04","Login - \'admin\'","1");
INSERT INTO activity VALUES("810","2020-03-17 08:43:06","Login - \'admin\'","1");
INSERT INTO activity VALUES("811","2020-03-17 09:45:23","Login - \'admin\'","1");
INSERT INTO activity VALUES("812","2020-03-17 10:06:10","Login - \'admin\'","1");
INSERT INTO activity VALUES("813","2020-03-17 10:18:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("814","2020-03-17 10:20:33","Cheque Status Changed:Bank Of Ceylon-224408 - Done","1");
INSERT INTO activity VALUES("815","2020-03-17 10:20:46","Cheque Status Changed:Bank Of Ceylon-224408 - Done","1");
INSERT INTO activity VALUES("816","2020-03-17 10:20:47","Cheque Status Changed:Bank Of Ceylon-224408 - ","1");
INSERT INTO activity VALUES("817","2020-03-17 10:21:05","Cheque Status Changed:People\'s Bank-003544 - Done","1");
INSERT INTO activity VALUES("818","2020-03-17 10:21:14","Cheque Status Changed:People\'s Bank-003545 - Done","1");
INSERT INTO activity VALUES("819","2020-03-17 10:21:21","Cheque Status Changed:People\'s Bank-599948 - Done","1");
INSERT INTO activity VALUES("820","2020-03-17 10:21:28","Cheque Status Changed:People\'s Bank-593904 - Done","1");
INSERT INTO activity VALUES("821","2020-03-17 10:21:36","Cheque Status Changed:Seylan Bank PLC-383632 - Done","1");
INSERT INTO activity VALUES("822","2020-03-17 10:21:47","Cheque Status Changed:Sampath Bank PLC-266379 - Done","1");
INSERT INTO activity VALUES("823","2020-03-17 10:21:54","Cheque Status Changed:Sampath Bank PLC-266380 - Done","1");
INSERT INTO activity VALUES("824","2020-03-17 10:22:01","Cheque Status Changed:Sampath Bank PLC-266389 - Done","1");
INSERT INTO activity VALUES("825","2020-03-17 10:22:07","Cheque Status Changed:National Development Bank PLC-016110 - Done","1");
INSERT INTO activity VALUES("826","2020-03-17 10:23:35","Login - \'admin\'","1");
INSERT INTO activity VALUES("827","2020-03-17 10:25:41","Login - \'asanga\'","9");
INSERT INTO activity VALUES("828","2020-03-17 11:29:11","Login - \'admin\'","1");
INSERT INTO activity VALUES("829","2020-03-17 12:16:02","Login - \'admin\'","1");
INSERT INTO activity VALUES("830","2020-03-17 12:22:08","Invoice (Invoice:RA20031700004)- saved ","1");
INSERT INTO activity VALUES("831","2020-03-17 12:23:15","Login - \'admin\'","1");
INSERT INTO activity VALUES("832","2020-03-17 12:38:59","Login - \'asanga\'","9");
INSERT INTO activity VALUES("833","2020-03-17 12:42:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("834","2020-03-17 12:49:20","Login - \'admin\'","1");
INSERT INTO activity VALUES("835","2020-03-17 12:50:28","Login - \'admin\'","1");
INSERT INTO activity VALUES("836","2020-03-17 12:52:03","Customer - updated:INTER OCEAN LAKSHMAN  TRADERS - COLOMBO 14","1");
INSERT INTO activity VALUES("837","2020-03-17 12:54:13","Invoice (Invoice:AS20031700009)- saved ","1");
INSERT INTO activity VALUES("838","2020-03-17 12:54:16","Invoice (Invoice:)- saved ","1");
INSERT INTO activity VALUES("839","2020-03-17 12:55:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("840","2020-03-17 14:04:35","Login - \'admin\'","1");
INSERT INTO activity VALUES("841","2020-03-17 14:42:20","Login - \'asanga\'","9");
INSERT INTO activity VALUES("842","2020-03-17 14:46:32","Invoice (Invoice:RA20031700005)- saved ","9");
INSERT INTO activity VALUES("843","2020-03-17 14:47:44","Login - \'admin\'","1");
INSERT INTO activity VALUES("844","2020-03-17 15:07:15","Login - \'asanga\'","9");
INSERT INTO activity VALUES("845","2020-03-17 15:13:57","Login - \'asanga\'","9");
INSERT INTO activity VALUES("846","2020-03-17 15:16:36","Login - \'admin\'","1");
INSERT INTO activity VALUES("847","2020-03-17 15:18:09","Login - \'admin\'","1");
INSERT INTO activity VALUES("848","2020-03-17 15:25:12","Customer - saved:NAVIMANA MOTORS -GALLE .","1");
INSERT INTO activity VALUES("849","2020-03-17 15:38:20","Customer - saved:LAHIRU MOTORS - BULATHSINHALA .","1");
INSERT INTO activity VALUES("850","2020-03-17 18:03:24","Login - \'asanga\'","9");
INSERT INTO activity VALUES("851","2020-03-17 18:20:46","Login - \'asanga\'","9");
INSERT INTO activity VALUES("852","2020-03-17 18:41:57","Login - \'admin\'","1");
INSERT INTO activity VALUES("853","2020-03-18 08:16:25","Login - \'shiran\'","10");
INSERT INTO activity VALUES("854","2020-03-18 08:41:21","Invoice (Invoice:SH20031800005)- saved ","10");
INSERT INTO activity VALUES("855","2020-03-18 08:45:03","Invoice (Invoice:SH20031800006)- saved ","10");
INSERT INTO activity VALUES("856","2020-03-18 09:01:34","Login - \'shiran\'","10");
INSERT INTO activity VALUES("857","2020-03-18 09:22:57","Login - \'shiran\'","10");
INSERT INTO activity VALUES("858","2020-03-18 10:12:40","Login - \'admin\'","1");
INSERT INTO activity VALUES("859","2020-03-18 10:28:12","Login - \'admin\'","1");
INSERT INTO activity VALUES("860","2020-03-18 10:45:12","Login - \'admin\'","1");
INSERT INTO activity VALUES("861","2020-03-18 10:47:00","Customer - updated:NAVIMANA MOTORS -GALLE .","1");
INSERT INTO activity VALUES("862","2020-03-18 10:48:02","Customer - updated:SIRILAKA MOTORS - THALGASWALA.","1");
INSERT INTO activity VALUES("863","2020-03-18 10:53:03","Login - \'shiran\'","10");
INSERT INTO activity VALUES("864","2020-03-18 11:03:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("865","2020-03-18 11:05:39","Customer - updated:NIRIELLA MOTORS PVT LTD - GALLE","1");
INSERT INTO activity VALUES("866","2020-03-18 11:17:09","Login - \'admin\'","1");
INSERT INTO activity VALUES("867","2020-03-18 11:30:03","Login - \'admin\'","1");
INSERT INTO activity VALUES("868","2020-03-18 11:51:16","Login - \'admin\'","1");
INSERT INTO activity VALUES("869","2020-03-18 12:06:31","Product Return 8231112070- ALU Qty: 2- Returned ","1");
INSERT INTO activity VALUES("870","2020-03-18 12:06:31","Invoice Return 46 Amount: 17256.00- Returned ","1");
INSERT INTO activity VALUES("871","2020-03-18 13:51:33","Login - \'admin\'","1");
INSERT INTO activity VALUES("872","2020-03-18 13:59:02","Login - \'admin\'","1");
INSERT INTO activity VALUES("873","2020-03-18 16:25:54","Login - \'priyantha\'","8");
INSERT INTO activity VALUES("874","2020-03-19 08:23:24","Login - \'admin\'","1");
INSERT INTO activity VALUES("875","2020-03-19 08:24:33","Invoice - deleted:","1");
INSERT INTO activity VALUES("876","2020-03-19 11:35:28","Login - \'priyantha\'","8");
INSERT INTO activity VALUES("877","2020-03-19 11:47:34","Login - \'admin\'","1");
INSERT INTO activity VALUES("878","2020-03-19 11:49:20","Customer - updated:AUTO FAIR -ALAWWA","1");
INSERT INTO activity VALUES("879","2020-03-19 12:04:19","Invoice (Invoice:RA20031900006)- saved ","8");
INSERT INTO activity VALUES("880","2020-03-19 12:12:42","Login - \'admin\'","1");
INSERT INTO activity VALUES("881","2020-03-19 21:08:16","Login - \'admin\'","1");
INSERT INTO activity VALUES("882","2020-03-19 22:14:26","Login - \'admin\'","1");
INSERT INTO activity VALUES("883","2020-03-22 13:43:38","Login - \'admin\'","1");
INSERT INTO activity VALUES("884","2020-03-30 08:21:17","Login - \'admin\'","1");
INSERT INTO activity VALUES("885","2020-04-01 13:09:44","Login - \'admin\'","1");
INSERT INTO activity VALUES("886","2020-04-05 22:29:58","Login - \'admin\'","1");
INSERT INTO activity VALUES("887","2020-04-06 09:55:20","Login - \'admin\'","1");
INSERT INTO activity VALUES("888","2020-04-08 00:34:10","Login - \'admin\'","1");
INSERT INTO activity VALUES("889","2020-04-08 17:53:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("890","2020-04-09 12:43:23","Login - \'admin\'","1");
INSERT INTO activity VALUES("891","2020-04-09 13:29:30","Login - \'admin\'","1");
INSERT INTO activity VALUES("892","2020-04-09 14:05:52","Logout - \'admin\'","1");
INSERT INTO activity VALUES("893","2020-04-09 14:05:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("894","2020-04-19 08:52:28","Login - \'admin\'","1");
INSERT INTO activity VALUES("895","2020-04-20 08:44:59","Login - \'admin\'","1");
INSERT INTO activity VALUES("896","2020-04-20 09:14:55","Login - \'admin\'","1");
INSERT INTO activity VALUES("897","2020-04-20 11:02:28","Login - \'priyantha\'","8");
INSERT INTO activity VALUES("898","2020-04-20 17:39:48","Login - \'admin\'","1");
INSERT INTO activity VALUES("899","2020-04-21 10:14:36","Login - \'admin\'","1");
INSERT INTO activity VALUES("900","2020-04-21 12:13:15","Login - \'admin\'","1");
INSERT INTO activity VALUES("901","2020-04-21 13:06:56","Login - \'admin\'","1");
INSERT INTO activity VALUES("902","2020-04-21 14:44:16","Login - \'admin\'","1");
INSERT INTO activity VALUES("903","2020-04-21 15:11:01","Login - \'admin\'","1");
INSERT INTO activity VALUES("904","2020-04-21 15:58:13","Login - \'admin\'","1");





CREATE TABLE `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

INSERT INTO bank VALUES("1","Bank Of Ceylon");
INSERT INTO bank VALUES("2","Amana Bank");
INSERT INTO bank VALUES("3","Bank of China Limited");
INSERT INTO bank VALUES("4","Cargills Bank Ltd");
INSERT INTO bank VALUES("5","Citibank N.A.");
INSERT INTO bank VALUES("6","Commercial Bank of Ceylon PLC");
INSERT INTO bank VALUES("7","Deutsche Bank AG");
INSERT INTO bank VALUES("8","DFCC Bank PLC");
INSERT INTO bank VALUES("9","Habib Bank Ltd");
INSERT INTO bank VALUES("10","Hatton National Bank PLC");
INSERT INTO bank VALUES("11","ICICI Bank Ltd");
INSERT INTO bank VALUES("12","Indian Bank");
INSERT INTO bank VALUES("13","Indian Overseas Bank");
INSERT INTO bank VALUES("14","MCB Bank Ltd");
INSERT INTO bank VALUES("15","National Development Bank PLC");
INSERT INTO bank VALUES("16","Nations Trust Bank PLC");
INSERT INTO bank VALUES("17","Pan Asia Banking Corporation PLC");
INSERT INTO bank VALUES("18","People\'s Bank");
INSERT INTO bank VALUES("19","Public Bank Berhad");
INSERT INTO bank VALUES("20","Sampath Bank PLC");
INSERT INTO bank VALUES("21","Seylan Bank PLC");
INSERT INTO bank VALUES("22","Standard Chartered Bank");
INSERT INTO bank VALUES("23","State Bank of India");
INSERT INTO bank VALUES("24","The Hong Kong and Shanghai Banking Corporatio");
INSERT INTO bank VALUES("25","Union Bank of Colombo PLC");





CREATE TABLE `batch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `mfd` date DEFAULT NULL,
  `exp` date DEFAULT NULL,
  `cost` decimal(12,2) DEFAULT NULL,
  `retail_price` decimal(12,2) DEFAULT NULL,
  `wholesale_price` decimal(12,2) DEFAULT NULL,
  `avl_qty` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_batch_product1_idx` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8;

INSERT INTO batch VALUES("1","1","1","","","2697.64","4754.60","0.00","0");
INSERT INTO batch VALUES("2","2","2","","","2229.32","4724.00","0.00","0");
INSERT INTO batch VALUES("3","3","3","","","6665.63","6665.63","0.00","0");
INSERT INTO batch VALUES("4","4","4","","","6185.80","11500.00","0.00","0");
INSERT INTO batch VALUES("5","5","5","","","7609.96","13750.00","0.00","0");
INSERT INTO batch VALUES("6","6","6","","","6600.95","11139.11","0.00","0");
INSERT INTO batch VALUES("7","7","7","","","4791.00","10686.00","0.00","0");
INSERT INTO batch VALUES("8","8","8","","","4653.91","7853.47","0.00","0");
INSERT INTO batch VALUES("9","9","9","","","5873.23","11483.00","0.00","0");
INSERT INTO batch VALUES("10","10","10","","","7028.35","12607.00","0.00","0");
INSERT INTO batch VALUES("11","11","11","","","6971.37","12607.00","0.00","0");
INSERT INTO batch VALUES("12","12","12","","","310.34","531.12","0.00","0");
INSERT INTO batch VALUES("13","13","13","","","2158.94","4950.00","0.00","0");
INSERT INTO batch VALUES("14","14","14","","","74.31","126.00","0.00","0");
INSERT INTO batch VALUES("15","15","15","","","430.22","726.00","0.00","0");
INSERT INTO batch VALUES("16","16","16","","","410.66","693.00","0.00","0");
INSERT INTO batch VALUES("17","17","17","","","121.44","205.00","0.00","0");
INSERT INTO batch VALUES("18","18","18","","","144.71","245.00","0.00","0");
INSERT INTO batch VALUES("19","19","19","","","226.84","383.00","0.00","0");
INSERT INTO batch VALUES("20","20","20","","","1486.20","2508.00","0.00","0");
INSERT INTO batch VALUES("21","21","21","","","1880.05","3172.58","0.00","0");
INSERT INTO batch VALUES("22","22","22","","","703.99","1188.00","0.00","0");
INSERT INTO batch VALUES("23","23","23","","","39.11","120.00","0.00","0");
INSERT INTO batch VALUES("24","24","24","","","58.67","99.00","0.00","0");
INSERT INTO batch VALUES("25","25","25","","","348.08","588.00","0.00","0");
INSERT INTO batch VALUES("26","26","26","","","293.33","495.00","0.00","0");
INSERT INTO batch VALUES("27","27","27","","","879.99","1485.00","0.00","0");
INSERT INTO batch VALUES("28","28","28","","","419.49","708.00","0.00","0");
INSERT INTO batch VALUES("29","29","29","","","758.74","1281.00","0.00","0");
INSERT INTO batch VALUES("30","30","30","","","1368.87","2310.00","0.00","0");
INSERT INTO batch VALUES("31","31","31","","","723.55","258.00","0.00","0");
INSERT INTO batch VALUES("32","32","32","","","879.99","1221.00","0.00","0");
INSERT INTO batch VALUES("33","33","33","","","879.99","1485.00","0.00","0");
INSERT INTO batch VALUES("34","34","34","","","391.11","660.00","0.00","0");
INSERT INTO batch VALUES("35","35","35","","","2248.86","3795.00","0.00","0");
INSERT INTO batch VALUES("36","36","36","","","547.55","924.00","0.00","0");
INSERT INTO batch VALUES("37","37","37","","","136.89","231.00","0.00","0");
INSERT INTO batch VALUES("38","38","38","","","78.22","132.00","0.00","0");
INSERT INTO batch VALUES("39","39","39","","","254.22","430.00","0.00","0");
INSERT INTO batch VALUES("40","40","40","","","230.10","521.43","0.00","0");
INSERT INTO batch VALUES("41","41","41","","","1113.68","3571.43","0.00","0");
INSERT INTO batch VALUES("42","42","42","","","253.11","664.29","0.00","0");
INSERT INTO batch VALUES("43","43","43","","","264.92","778.57","0.00","0");
INSERT INTO batch VALUES("44","44","44","","","115.05","375.10","0.00","0");
INSERT INTO batch VALUES("45","45","45","","","172.58","276.09","0.00","0");
INSERT INTO batch VALUES("46","46","46","","","115.05","264.22","0.00","0");
INSERT INTO batch VALUES("47","47","47","","","2158.34","5335.17","0.00","0");
INSERT INTO batch VALUES("48","48","48","","","1564.68","5500.00","0.00","0");
INSERT INTO batch VALUES("49","49","49","","","1403.61","3100.00","0.00","0");
INSERT INTO batch VALUES("50","50","50","","","3209.90","6574.33","0.00","0");
INSERT INTO batch VALUES("51","51","51","","","115.05","280.00","0.00","0");
INSERT INTO batch VALUES("52","52","52","","","236.72","255.00","0.00","0");
INSERT INTO batch VALUES("53","53","53","","","250.25","300.00","0.00","0");
INSERT INTO batch VALUES("54","54","54","","","272.79","300.00","0.00","0");
INSERT INTO batch VALUES("55","55","55","","","272.79","280.00","0.00","0");
INSERT INTO batch VALUES("56","56","56","","","128.51","175.00","0.00","0");
INSERT INTO batch VALUES("57","57","57","","","128.51","170.00","0.00","0");
INSERT INTO batch VALUES("58","58","58","","","105.96","150.00","0.00","0");
INSERT INTO batch VALUES("59","59","59","","","1115.98","1435.00","0.00","0");
INSERT INTO batch VALUES("60","60","60","","","1115.98","1435.00","0.00","0");
INSERT INTO batch VALUES("61","61","61","","","288.58","300.00","0.00","0");
INSERT INTO batch VALUES("62","62","62","","","953.65","1150.00","0.00","0");
INSERT INTO batch VALUES("63","63","63","","","2791.07","3300.00","0.00","0");
INSERT INTO batch VALUES("64","64","64","","","2791.07","3300.00","0.00","0");
INSERT INTO batch VALUES("65","65","65","","","133.02","200.00","0.00","0");
INSERT INTO batch VALUES("66","66","66","","","356.21","380.00","0.00","0");
INSERT INTO batch VALUES("67","67","67","","","356.21","380.00","0.00","0");
INSERT INTO batch VALUES("68","68","68","","","1167.83","1170.00","0.00","0");
INSERT INTO batch VALUES("69","69","69","","","394.54","580.00","0.00","0");
INSERT INTO batch VALUES("70","70","70","","","536.57","750.00","0.00","0");
INSERT INTO batch VALUES("71","71","71","","","557.91","850.00","0.00","0");
INSERT INTO batch VALUES("72","72","72","","","136.01","306.00","0.00","0");
INSERT INTO batch VALUES("73","73","73","","","152.75","257.77","0.00","0");
INSERT INTO batch VALUES("74","74","74","","","140.31","215.00","0.00","0");
INSERT INTO batch VALUES("75","75","75","","","58.46","90.00","0.00","0");
INSERT INTO batch VALUES("76","76","76","","","277.14","445.00","0.00","0");
INSERT INTO batch VALUES("77","77","77","","","853.74","1440.69","0.00","0");
INSERT INTO batch VALUES("78","78","78","","","2559.05","4320.00","0.00","0");
INSERT INTO batch VALUES("79","79","79","","","1910.45","3223.89","0.00","0");
INSERT INTO batch VALUES("80","80","80","","","2326.86","3500.00","0.00","0");
INSERT INTO batch VALUES("81","81","81","","","374.56","632.07","0.00","0");
INSERT INTO batch VALUES("82","82","82","","","374.56","632.07","0.00","0");
INSERT INTO batch VALUES("83","83","83","","","188.33","317.80","0.00","0");
INSERT INTO batch VALUES("84","84","84","","","527.84","795.00","0.00","0");
INSERT INTO batch VALUES("85","85","85","","","2326.86","3495.00","0.00","0");
INSERT INTO batch VALUES("86","86","86","","","666.49","1125.00","0.00","0");
INSERT INTO batch VALUES("87","87","87","","","232.19","350.00","0.00","0");
INSERT INTO batch VALUES("88","88","88","","","3101.93","4670.00","0.00","0");
INSERT INTO batch VALUES("89","89","89","","","418.50","706.22","0.00","0");
INSERT INTO batch VALUES("90","90","90","","","248.53","490.82","0.00","0");
INSERT INTO batch VALUES("91","91","91","","","2354.06","3972.48","0.00","0");
INSERT INTO batch VALUES("92","92","92","","","0.00","386.00","0.00","0");
INSERT INTO batch VALUES("93","93","93","","","0.00","1670.00","0.00","0");
INSERT INTO batch VALUES("94","94","94","","","0.00","306.00","0.00","0");
INSERT INTO batch VALUES("95","95","95","","","0.00","980.00","0.00","0");
INSERT INTO batch VALUES("96","96","96","","","0.00","650.00","0.00","0");
INSERT INTO batch VALUES("97","97","97","","","0.00","121.00","0.00","0");
INSERT INTO batch VALUES("98","98","98","","","0.00","306.00","0.00","0");
INSERT INTO batch VALUES("99","99","99","","","0.00","525.00","0.00","0");
INSERT INTO batch VALUES("100","100","100","","","0.00","585.00","0.00","0");
INSERT INTO batch VALUES("101","101","101","","","0.00","760.00","0.00","0");
INSERT INTO batch VALUES("102","102","102","","","0.00","306.00","0.00","0");
INSERT INTO batch VALUES("103","103","103","","","0.00","288.00","0.00","0");
INSERT INTO batch VALUES("104","104","104","","","0.00","6690.00","0.00","0");
INSERT INTO batch VALUES("105","105","105","","","0.00","27960.00","0.00","0");
INSERT INTO batch VALUES("106","106","106","","","0.00","203.00","0.00","0");
INSERT INTO batch VALUES("107","107","107","","","0.00","695.00","0.00","0");
INSERT INTO batch VALUES("108","108","108","","","0.00","83.00","0.00","0");
INSERT INTO batch VALUES("109","109","109","","","0.00","1796.00","0.00","0");
INSERT INTO batch VALUES("110","110","110","","","0.00","780.00","0.00","0");
INSERT INTO batch VALUES("111","111","111","","","0.00","0.00","0.00","0");
INSERT INTO batch VALUES("112","112","112","","","0.00","120.00","0.00","0");
INSERT INTO batch VALUES("113","113","113","","","0.00","250.00","0.00","0");
INSERT INTO batch VALUES("114","114","114","","","0.00","650.00","0.00","0");
INSERT INTO batch VALUES("115","115","115","","","0.00","135.00","0.00","0");
INSERT INTO batch VALUES("116","116","116","","","0.00","0.00","0.00","0");
INSERT INTO batch VALUES("117","117","117","","","0.00","560.00","0.00","0");
INSERT INTO batch VALUES("118","118","118","","","0.00","0.00","0.00","0");
INSERT INTO batch VALUES("119","119","119","","","0.00","1100.00","0.00","0");
INSERT INTO batch VALUES("120","120","120","","","0.00","0.00","0.00","0");
INSERT INTO batch VALUES("121","121","121","","","0.00","1385.00","0.00","0");
INSERT INTO batch VALUES("122","122","122","","","0.00","1900.00","0.00","0");
INSERT INTO batch VALUES("123","123","123","","","0.00","38.00","0.00","0");
INSERT INTO batch VALUES("124","124","124","","","0.00","20.00","0.00","0");
INSERT INTO batch VALUES("125","125","125","","","0.00","190.00","0.00","0");
INSERT INTO batch VALUES("126","126","126","","","0.00","91.00","0.00","0");
INSERT INTO batch VALUES("127","127","127","","","0.00","40.00","0.00","0");
INSERT INTO batch VALUES("128","128","128","","","0.00","125.00","0.00","0");
INSERT INTO batch VALUES("129","129","129","","","0.00","90.00","0.00","0");
INSERT INTO batch VALUES("130","130","130","","","0.00","650.00","0.00","0");
INSERT INTO batch VALUES("131","131","131","","","0.00","35.00","0.00","0");
INSERT INTO batch VALUES("132","132","132","","","0.00","45.00","0.00","0");
INSERT INTO batch VALUES("133","133","133","","","0.00","60.00","0.00","0");
INSERT INTO batch VALUES("134","134","134","","","0.00","507.00","0.00","0");
INSERT INTO batch VALUES("135","135","135","","","0.00","70.00","0.00","0");
INSERT INTO batch VALUES("136","136","136","","","0.00","325.00","0.00","0");
INSERT INTO batch VALUES("137","137","137","","","0.00","35.00","0.00","0");
INSERT INTO batch VALUES("138","138","138","","","0.00","167.00","0.00","0");
INSERT INTO batch VALUES("139","139","139","","","0.00","45.00","0.00","0");
INSERT INTO batch VALUES("140","140","140","","","0.00","170.00","0.00","0");
INSERT INTO batch VALUES("141","141","141","","","0.00","165.00","0.00","0");
INSERT INTO batch VALUES("143","142","143","","","218.60","485.00","0.00","0");
INSERT INTO batch VALUES("144","143","144","","","4245.41","9807.00","0.00","0");
INSERT INTO batch VALUES("145","144","145","","","1395.75","3500.00","0.00","0");
INSERT INTO batch VALUES("146","145","146","","","2093.63","5000.00","0.00","0");
INSERT INTO batch VALUES("147","146","147","","","1046.81","2950.00","0.00","0");
INSERT INTO batch VALUES("148","147","148","","","1861.00","4500.00","0.00","0");
INSERT INTO batch VALUES("149","150","151","","","4187.25","9673.00","0.00","0");
INSERT INTO batch VALUES("150","187","149","","","4187.25","9673.00","0.00","0");
INSERT INTO batch VALUES("151","149","150","","","4885.13","11285.00","0.00","0");
INSERT INTO batch VALUES("152","151","152","","","4536.19","10480.00","0.00","0");
INSERT INTO batch VALUES("153","152","153","","","3954.63","9250.00","0.00","0");
INSERT INTO batch VALUES("154","153","154","","","8839.75","20420.00","0.00","0");
INSERT INTO batch VALUES("155","155","156","","","1512.06","3900.00","0.00","0");
INSERT INTO batch VALUES("156","154","155","","","1628.38","4200.00","0.00","0");
INSERT INTO batch VALUES("157","156","157","","","465.25","1400.00","0.00","0");
INSERT INTO batch VALUES("158","157","158","","","6048.25","13972.00","0.00","0");
INSERT INTO batch VALUES("159","158","159","","","9072.38","20960.00","0.00","0");
INSERT INTO batch VALUES("160","159","160","","","4187.25","9673.00","0.00","0");
INSERT INTO batch VALUES("161","160","161","","","4187.25","9673.00","0.00","0");
INSERT INTO batch VALUES("162","161","162","","","3605.69","8500.00","0.00","0");
INSERT INTO batch VALUES("163","162","163","","","3954.63","9250.00","0.00","0");
INSERT INTO batch VALUES("164","163","164","","","7444.00","17196.00","0.00","0");
INSERT INTO batch VALUES("165","164","165","","","7560.31","17465.00","0.00","0");
INSERT INTO batch VALUES("166","165","166","","","4187.25","9673.00","0.00","0");
INSERT INTO batch VALUES("167","166","167","","","7909.25","18271.00","0.00","0");
INSERT INTO batch VALUES("168","167","168","","","7909.25","18271.00","0.00","0");
INSERT INTO batch VALUES("169","168","169","","","17912.13","41378.00","0.00","0");
INSERT INTO batch VALUES("170","169","170","","","7909.25","18271.00","0.00","0");
INSERT INTO batch VALUES("171","170","171","","","8839.75","20420.00","0.00","0");
INSERT INTO batch VALUES("172","171","172","","","4652.50","10748.00","0.00","0");
INSERT INTO batch VALUES("173","172","173","","","2093.63","5100.00","0.00","0");
INSERT INTO batch VALUES("174","173","174","","","2558.88","6250.00","0.00","0");
INSERT INTO batch VALUES("175","174","175","","","6746.13","15900.00","0.00","0");
INSERT INTO batch VALUES("176","175","176","","","3722.00","8900.00","0.00","0");
INSERT INTO batch VALUES("177","176","177","","","3722.00","8900.00","0.00","0");
INSERT INTO batch VALUES("178","177","178","","","5815.63","13435.00","0.00","0");
INSERT INTO batch VALUES("179","178","179","","","3954.63","9400.00","0.00","0");
INSERT INTO batch VALUES("180","160","180","","","4187.25","9673.00","0.00","0");
INSERT INTO batch VALUES("181","188","182","","","232.63","537.36","0.00","0");
INSERT INTO batch VALUES("182","189","181","","","232.63","537.36","0.00","0");
INSERT INTO batch VALUES("183","190","183","","","5728.16","10950.00","0.00","0");
INSERT INTO batch VALUES("184","191","184","","","16675.30","32017.00","0.00","0");
INSERT INTO batch VALUES("185","192","185","","","17502.71","33606.00","0.00","0");
INSERT INTO batch VALUES("186","193","186","","","5616.78","10785.00","0.00","0");
INSERT INTO batch VALUES("187","194","187","","","6651.03","12770.00","0.00","0");
INSERT INTO batch VALUES("188","195","188","","","35612.50","67500.00","0.00","0");
INSERT INTO batch VALUES("189","196","189","","","39778.88","76376.00","0.00","0");
INSERT INTO batch VALUES("190","197","190","","","6460.09","13400.00","0.00","0");
INSERT INTO batch VALUES("191","198","191","","","20685.02","39716.00","0.00","0");
INSERT INTO batch VALUES("192","199","192","","","7001.80","13443.00","0.00","0");
INSERT INTO batch VALUES("193","200","193","","","8910.47","17109.00","0.00","0");
INSERT INTO batch VALUES("194","202","195","","","10183.39","19553.00","0.00","0");
INSERT INTO batch VALUES("195","203","196","","","6959.70","13186.00","0.00","0");
INSERT INTO batch VALUES("196","204","197","","","10683.75","20100.00","0.00","0");
INSERT INTO batch VALUES("197","205","198","","","30775.25","65950.00","0.00","0");
INSERT INTO batch VALUES("198","201","199","","","7955.78","15276.00","0.00","0");
INSERT INTO batch VALUES("199","206","199","","","2254.50","2500.00","0.00","0");
INSERT INTO batch VALUES("200","207","200","","","2254.50","2500.00","0.00","0");





CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO brand VALUES("1","SRMT");
INSERT INTO brand VALUES("2","ATC");
INSERT INTO brand VALUES("3","LEY PARTS ");
INSERT INTO brand VALUES("4","PRAKASH ");
INSERT INTO brand VALUES("5","SWISS ");
INSERT INTO brand VALUES("6","M & M");
INSERT INTO brand VALUES("7","HD SPICDER ");
INSERT INTO brand VALUES("8","LION GASKET ");





CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO category VALUES("1","General Category");





CREATE TABLE `cheque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(11) NOT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `cheque_no` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cheque_status_id` int(11) NOT NULL,
  `branch` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cheque_cheque_status1_idx` (`cheque_status_id`),
  KEY `fk_cheque_bank1_idx` (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO cheque VALUES("1","1","2089.80","224408","2020-05-28","2","");
INSERT INTO cheque VALUES("2","18","100000.00","003544","2020-06-05","2","");
INSERT INTO cheque VALUES("3","18","108425.00","003545","2020-06-09","2","");
INSERT INTO cheque VALUES("4","18","39744.90","599948","2020-05-27","2","");
INSERT INTO cheque VALUES("6","18","6375.00","593904","2020-05-20","2","");
INSERT INTO cheque VALUES("7","21","11474.00","383632","2020-06-18","2","");
INSERT INTO cheque VALUES("9","20","80153.20","266379","2020-06-10","2","");
INSERT INTO cheque VALUES("10","20","209175.90","266380","2020-06-25","2","");
INSERT INTO cheque VALUES("11","20","239004.54","266389","2020-06-24","2","");
INSERT INTO cheque VALUES("12","15","32498.00","016110","2020-07-05","2","");





CREATE TABLE `cheque_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO cheque_status VALUES("1","Pending");
INSERT INTO cheque_status VALUES("2","Done");
INSERT INTO cheque_status VALUES("3","Canceled");
INSERT INTO cheque_status VALUES("4","Returned");





CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `period` float DEFAULT NULL,
  `code_image` varchar(100) DEFAULT NULL,
  `stock_insurance` varchar(500) DEFAULT NULL,
  `stock_insurance_image` varchar(500) DEFAULT NULL,
  `stock_mortgaged` varchar(500) DEFAULT NULL,
  `bank_gurantee` varchar(500) DEFAULT NULL,
  `bank_gurantee_image` varchar(500) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `prop_name_email` varchar(500) DEFAULT NULL,
  `prop_id` varchar(500) DEFAULT NULL,
  `prop_tel` varchar(500) DEFAULT NULL,
  `intro_a` varchar(500) DEFAULT NULL,
  `intro_b` varchar(500) DEFAULT NULL,
  `po_name_designation` varchar(500) DEFAULT NULL,
  `bank_name` varchar(500) DEFAULT NULL,
  `month_purchase` float DEFAULT NULL,
  `balance_increase` float DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `id_image` varchar(100) DEFAULT NULL,
  `status_by` int(11) DEFAULT NULL,
  `birthday` varchar(200) DEFAULT NULL,
  `account_number` varchar(200) DEFAULT NULL,
  `allocated_rep` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_customer_route1_idx` (`route_id`),
  KEY `status_by` (`status_by`)
) ENGINE=InnoDB AUTO_INCREMENT=311 DEFAULT CHARSET=utf8;

INSERT INTO customer VALUES("1","....Cash....","001","1","","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("2","AMILA MOTORS - KOTTAWA","A01","1","NO.144/1,
HIGHLEVEL ROAD,
KOTTAWA.","0112844571","test@test.com","45000","0","5e1136c588b32.jpg","11550","5e1136c5ae1d9.jpg","Information On Stock Mortgaged to the bank :","","5e1136c6b6794.jpg","0112844571","","905465783V","","","","","","0","0","1","1","5e1136c7adff1.png","0","","","1");
INSERT INTO customer VALUES("3","A.M.A. MOTORS -PUTTALAM","A02","1","NO.03,
COLOMBO ROAD,
PUTTALAM.","032-2267733","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("4","ANRITA MOTORS - KOCHCHIKADE","A03","1","NO.79,
CHILLAW ROAD,
KOCHCHIKADE.","031-2277490","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("5","AZMIA MOTORS -PUTTALAM","A04","1","NO.07,
COLOMBO ROAD,
PUTTALAM.


","032-2265359","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("6","AUTO FAIR -ALAWWA","A05","1","COLOMBO ROAD,
ALAWWA.","037-2278735","","100000","0","","","","","","","","","","","","","","","0","100000","1","1","","0","","","1");
INSERT INTO customer VALUES("7","A.M.S. MOTORS- COLOMBO","A06","1","NO.276/6C,
PRADEEPA MAWATHA,
MALIGAWATTA ROAD
COLOMBO-10.","0112444358","","0","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("8","BHANUKA MOTORS -HORANA","B01","1","NO.147,
PANADURA ROAD,
HORANA.","034-2261564","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("9","A.M.S MOTORS MAHIYANGANAYA","A06","1","NO.02,
KANDY ROAD,
MAHIYANGANAYA.","055-2258420","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("10","BORALASSA MOTORS -MEDIRIGIRIYA","B02","1","MAIN STREET,
MEDIRIGIRIYA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("11","BHUDDIKA TYRE CENTER -RIKILLAGASKEDA","B03","1","RAGALA ROAD,
RIKILLAGASKADA.
","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("12","CEYLON MOTOR HOUSE MALABE","C01","1","NO.892/8,
ATHURUGIRIYA,
MALABE.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("13","CHARITH MOTOR TRADERS - PILIYANDALA","C02","1","NO.35,
COLOMBO ROAD,
PILIYANDALA.","011-2606044","","100000","300000","","","","","","","","","","","","","","","0","300000","1","1","","0","","","1");
INSERT INTO customer VALUES("14","COLOMBAGE MOTORS -WENNAPPUWA","C03","1","No 79,
CHILLAW RD,
WENNAPPUWA.","031-2254577","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("15","DEEPTHI MOTORS - ANURADHAPURA","D01","1","334/110, 
MAIN STREET,
ANURADHAPURA.","025-0000770","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("16","DAMINDA MOTORS -MELSIRIPURA","D02","1","DAMBULLA ROAD,
MELSIRIPURA.","037-2550180","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("17","FASCO LANKA AUTO (PVT)LTD - HANWELLA","F01","1","NO.28,
CROSS ROAD,HANWELLA","036-2252899","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("18","FIAT MAMA MOTORS -GAMPOLA","F02","1","NO.93D,
NUWARAELIYA ROAD,
MAHARA,
GAMPOLA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("19","GUNADASA & COMPANY -NUWARA ELIYA","G01","1","NO.40/5D,
LAWSON STREET,
NUWARAELIYA.","052-2222486","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("20","GALEWELA MOTORS -GALEWELA","G02","1","NO.59J/L,
KURUNEGALA ROAD,
GALEWELA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("21","HARSHANI MOTORS -BADULLA","H01","1","NO.59,
KOKAWATHTA ROAD,
BADULLA.","055-2230700","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("22","HASITHA MOTORS -PANADURA","H02","1","NO.438/B,2B,
DESHASEWA ROAD,
PANADURA.","038-4283046","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("23","HAJA MOTORS -POLONNARUWA","H03","1","MAIN STREET, 
KADURUWELA,
POLONNARUWA.","027-2225090","","500000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("24","HERO MOTORS -BANDARAWELA","H04","1","NO.52,
MAIN STREET,
BANDARAWELA.","057-4926949","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("25","HPL MOTORS -BADULLA","H05","1","NO.21,
KUMARASINGHE ROAD,
BADULLA.","055-4922704","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("26","HELANS MOTORS -KELANIYA","H06","1","NO.1/14,
EKSATH MAWATHA
KELANIYA.","011-2986249","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("27","JANATHA ENTERPRICES -KANDY","J01","1","NO.127/E,
DS SENANAYAKE ROAD,
KANDY.","081-2232298","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("28","JANITH MOTORS -KENDAKETIYA","J02","1","NO.33,
MAHIYANGANAYA ROAD,
BIBILA.
","077-3049589","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("29","JW AUTO SPARES -KEGALLE","J03","1","NO.242/A,
RANWALA,
KEGLLE.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("30","KIS MOTORS -WARAKAPOLA","K01","1","MIRIGAMA JUNCTION,
KANDY ROAD,
WARAKAPOLA.","077-6341854","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("31","KUGAN MOTORS -VAUNIYA","K02","1","NO.52,
2ND CROSS STREET,
VAVUNIYA.","024-2221845","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("32","KUMUDU MOTORS -DABULLA","K03","1","NO.76/7,
ANURADHAPURA ROAD,
DAMBULUGAMA JUNCTION,
DAMBULLA.","071-6202071","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("33","K.K.A.R. KUMARASINGHE  -DEHIOWITA","K04","1","LANKA SURVICE STATION,
DEHIOWITA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("34","KANDY MOTORS -HATTON","K05","1","NO.56,
DIKOYA RD, 
HATTON.","051-2222691","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("35","KALARANI MOTORS -KALAOYA","K06","1","SALIYAWEWA JUNCTION
KALAOYA","077-9703579","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("36","LANKA MOTORS- COLOMBO","L01","1","NO.261,
PANCHOKAWATTA ROAD, 
COLOMBO 10.","011-2434603 ","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("37","LUCKY AUTO SPARE(PVT)LTD KADUWELA","L02","1","NO.477/1,
AWISSAWELLA ROAD,
KADUWELA.","011-24988584","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("38","LUCKY AUTO HOUSE HANWELLA","L03","1","NO.137/1,
MAIN STREET,
HANWELLA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("39","L&L MOTORS - HIGURAKGODA","L04","1","NO.36,
CENTRAL STREET,
HIGURAKGODA.","027-2246391","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("40","M.A. MOTORS -MAHIYANGANAYA","M01","1","NO.778,
PALAN JUNCTION,
MAHIYANGANAYA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("41","MANGALA MOTORS -GIRIULLA","M02","1","NEGAMBO ROAD,
GIRIULLA.","037-2288062","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("42","NAUSHAD MOTORS -MATALE","N01","1","NO.56,
MAIN STREET,
MATALE.","066-2222478","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("43","NALIN MOTORS -AVISSAWELLA","N02","1","COLOMBO ROAD,
AWISSAWELLA.","036-2234499","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("44","NEEL AUTO ENGINEERING (PVT)LTD -PERADENIYA","N03","1","NO.128/5,
KEHELWALA,KIRIBATKUMBURA,
PERADENIYA.","081-2388555","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("45","NEW LEYLAND MOTORS HOMAGAMA","N04","1","HIGHLEVEL ROAD,
HOMAGAMA.","011-2892589","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("46","NEW LEYLAND MOTORS DICKHETEMMA","N05","1","32/6/4,HENEWATTA,
MEEGODA,
DICKHETAMMA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("47","NEW RAJARATA MOTORS -KEKIRAWA","N06","1","NO.141,
MAIN STREET,
KEKIRAWA.","025-4992020","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("48","NEW INDIKA MOTORS -GOKERALLA","N07","1","DAMBULLA ROAD
NAKATHTHA,
GOKARELLA.","037-2250619","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("49","NEW UNION MOTORS -KANDY","N08","1","NO.33,
KING STREET, 
KANDY","081-2223570","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("50","NIROSHAN MOTORS -CHILLAW","N09","1","COLOMBO ROAD,
MAIKKULAMA,
CHILLAW.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("51","NIROSHA ENTERPRICES -MELSIRIPURA","N10","1","AMBANPOLA,
MELSIRIPURA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("52","NEW CROWN MOTORS -MANIKHINNA","N11","1","NO.23B,
KARALLIYADDA ROAD,
MANIKHINNA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("53","ORIENT MOTORS ALAWWA","O01","1","NO.65,
COLOMBO ROAD,
ALAWWA.","037-2278618","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("54","PATHINAYAKE MOTORS - MONARAGALA","P01","1","NO.141,
WELLAWAYA ROAD,
MONARAGALA.","055-2276762","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","P01","1");
INSERT INTO customer VALUES("55","OMEGA MOTORS -AMBILIPITIYA","O02","1","MORAKETIYA ROAD,
AMBILIPITIYA","045-5719490","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("56","PADHMAN MOTORS -BATTICALA","P02","1","NO.569/D,
TRINCO ROAD,
BATTICOLOA.","065-2222040","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("57","PERIANNAN PASUPATHI -MATALE","P03","1","NO.53A,
DIKKIRIYA ROAD,
ALUWIHARAYA,
MATALE.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("58","RAM MOTORS -VAUNIYA","R01","1","MAIN STREET,
VAVUNIYA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("59","RAJAPAKSHA TRAVELS -THALATUOYA","R02","1","GURUDENIYA ROAD,
THALATUOYA.","081-2404526","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("60","RANJANA TADE CENTER -ATHURUGIRIYA","R03","1","NO.127/3,
KADUWELA ROAD,
ATHURUGIRIYA.","011-4866407","","300000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("61","RATHNAYAKE MOTORS -GIRIULLA","R04","1","NO.67,
NEGAMBO ROAD,
GIRIULLA","037-2288429","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("62","RAMAKRISHNA MOTORS -BATTICOLA","R05","1","NO.174,
TRINCO ROAD,
BATTICOLOA.","065-2222326","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("63","RAVINDU MOTORS- AVISSAWELLA","R06","1","NO.08,
COLOMBO ROAD,
AWISSAWELLA.","036-2222628","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("64","RAVINU OIL MART- RATHNAPURA","R07","1","PITA RAWUN ROAD 
RATHNAPURA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("65","RANJITH MOTORS -COLOMBO 14","R08","1","NO.30,
SIRIMAWO BANDARANAYAKE ROAD,
COLOMBO 14,","011-4617879/011-2333323","","300000","0","","","","","","","","","","","","","","PEOPLES BANK","0","0","1","1","","0","","002306400","1");
INSERT INTO customer VALUES("66","RANSILU MOTORS -SANDALANKAWA","R09","1","NEGAMBO ROAD,
SANDALANKAWA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("67","RUHUNU MOTORS -MONARAGALA","R10","1","NO.219,
WELLAWAYA ROAD,
MONARAGALA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("68","SAMARU MOTORS -WELIMADA","S01","1","NO.50,
BADULLA ROAD,
WELIMADA","057-2244506","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("69","SANDARU AUTO ENTERPRICES -COLOMBO 14","S02","1","NO.133,
SIRIMAWOBANDARANAYAKE ROAD,
COLOMBO 14.
","011-2335666","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("70","SAMEERA MOTORS THALAWAKELE","S03","1","NO.123,
NUWARA ELIYA ROAD,
THALAWAKALE.","052-2258462","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("71","SAMUDAYA MOTORS -HORANA","S04","1","NO.230,
RATHNAPURA ROAD,
HORANA.","034-4929713/034-2260015","","1200000","0","","","","","","","","","","","","","","","0","1200000","1","1","","0","","","7");
INSERT INTO customer VALUES("72","SAHIRA MOTORS","S05","1","GALGAMUWA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("73","SAHAN MOTORS -CHILLAW","S06","1","NO.93,
PUTTALAM ROAD, 
CHILLAW.","032-2221927","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("74","SASIS MOTORS -BATTICOLA","S07","1","NO.562/10
TRINCO ROAD,
BATTICOLOA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("75","SHAN MOTORS -NOCHCHIYAGAMA","S08","1","MAIN STREET,
NOCCHIYAGAMA.","025-2257525","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("76","SEEDEVI MOTORS -ANURADHAPURA","S09","1","NO.561/18,MAITRHIPALA SENANAYAKA MAWATHA,
ANURADHAPURA.","025-2235323/025-2234971","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("77","SETHSIRI MOTORS -NOCHCHIYAGAMA","S10","1","PUTTALAM ROAD,
NOCCHIYAGAMA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("78","SHAKTHI MOTORS TREDERS-ANURADHAPURA","S11","1","NO- 561/B/13,NEW SUPER MARKET,
ANURADHAPURA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("79","SENADEERA MOTORS -HETTIPOLA","S12","1","HETTIPOLA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("80","SENURA MOTORS -PANNALA","S13","1","NO.104,
NEGAMBO ROAD,
PANNALA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("81","SAINULDEENS MOTORS - MATALE","S14","1","NO.40,
MAIN STREET,
MATALE.","066-2223781","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("82","SG LANKA ENTERPRICES -KADAWATHA","S15","1","NO.158/8A,
KANDY ROAD,
KADAWATHA.","060-2192477/011-2923477","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","S15","1");
INSERT INTO customer VALUES("83","SMR MOTORS -THELDENIYA","S16","1","MAHIYANGANAYA ROAD,
THELDENIYA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("84","SNH MOTORS -HEDENIYA","S17","1","NO.229/H,
KURUNEGALA ROAD,
HEDENIYA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("85","SISIRA MOTORS -KANDY","S18","1","NO.44,
D.S.SENANAYAKE ROAD,
KANDY.","081-2238799","","125000","0","","","","","","","","","","","","","","","0","200000","1","1","","0","","S18","1");
INSERT INTO customer VALUES("86","SILVA MOTORS ALAWWA","S19","1","COLOMBO ROAD,
ALAWWA.","032-2278315","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("87","SITHMINA MOTORS MONARAGALA","S20","1","POTUVIL ROAD,
MONARAGALA.","055-7402649","","100000","0","","","","","","","","","","","","","","PEOPLES BANK","0","100000","1","1","","0","","8063602001","1");
INSERT INTO customer VALUES("88","SITHMINA MOTORS MAHIYANGANAYA","S21","1","KANDY ROAD,
BRIDGE JUNCTION,WEERAGANTHOTA,
MAHIYANGANAYA,
","055-2257705","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("89","SUNCITY MOTORS -GALGAMUWA","S22","1","MAIN STREET,
GALGAMUWA.","0771812852","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("90","SUMEDHA MOTORSV -PERADENIYA","S23","1","NO.306,
GAMPOLA ROAD,
PERADENIYA.","81-4930419","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("91","SUPER LINE HOLDINGS - NAWINNA","S24","1","NO.411/B,
HIGH LEVEL ROAD,
NAVINNA,
MAHARAGAMA.","011-28035514","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("92","SUNIL TYRE & WHEEL ALIGNMENT CENTER- HORANA","S25","1","RATHNAPURA ROAD,
MUNAGAMA,
HORANA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("93","THUSHARA AUTO PARTS -MEEGODA","T01","1","635/B,
PADUKKA ROAD,
MEEGODA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("94","TATA LEYLAND MOTORS -MAHARAGAMA","T02","1","HIGH LEVEL RD,
MAHARAGAMA","0112-841269","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("95","THARANIKA MOTORS JAFFNA","T03","1","NO.141,
MANIPAY ROAD,
JAFFNA.","021-22229482","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("96","THARANIKA MOTORS KILINOCCHI","T04","1","A9 ROAD,
KARADIPOKKU,
KILINOCCHIYA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("97","THUSITHA TYRE HOUSE -DALADAGAMA","T05","1","DALADAGAMA","037-2273591","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("98","TR ENGINEERING COMPANY -BANDARAWELA","T06","1","NO.338,
BADULLA ROAD,
BANDARAWELA.","057-2230976","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("99","UPUL MOTORS -CHINABAY","U01","1","05TH MAIL POST,
KANDY ROAD,
CHINA BAY.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("100","VIJEY MOTORS -DIGANA","V01","1","NO.39,
THELDENIYA ROAD,
GONAWALA,
DIGANA.","077-9403517","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("101","VICTORIA MOTORS -AMPARA","V02","1","C570/1, 
KALMUNAI ROAD,
AMPARA.","063-2222145","","300000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("102","VADIVEL NAGULESWARAN -KALUTARA","V03","1","NO.25/1A,
MOUSQUE ROAD,
HENATIYANGALA,
KALUTHARA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("103","WARIYAPOLA MOTORS -THABUTHEGAMA","W01","1","NO.111
THAMBUTTEGAMA.","060-2931063","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("104","WANAGURU SERVICE STATION","W02","1","NO.433,
ATHURUGIRIYA ROAD,
HOKANDARA NORTH,
HOKANDARA.","011-3140301","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("105","WARUNAMAL MOTORS -NARAMALA","W03","1","NO.185,
KULIYAPITIYA ROAD,
NARAMMALA.","037-2249094","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("106","WIJAYAMINI MOTORS -DIULAPITIYA","W04","1","NO.30,
NEGAMBO ROAD,
DIULAPITIYA.","031-2246236","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("131","RAMASINGHE MOTORS -AMBILIPITIYA","R11","1","MIDDENIYA ROAD,
NEW TOWN,
AMBILIPITIYA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("132","RAMITHA MOTORS- KANDY","R11","1","NO14A,
GURUDENIYA ROAD,
KANDY","0812406835","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("133","SILVA MOTOR HOUSE KULIYAPITIYA","S26","1","NO.223,
HETTIPOLA ROAD,
KULIYAPITIYA.","037-2282286","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("134","SM MOTORS- THIHARIYA","S25","1","NO.142/1
KANDY ROAD
THIHARIYA","033-2288313","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("135","AMS MOTORS COLOMBO- COLOMBO","A07","1","NO276
PRADDEPA MAWATHA
COLOMBO14","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("136","INDUMINI MOROTS -AMBILIPITIYA","I08","1","AMBILIPITIYA","047-4927565","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("137","RUWAN MOTORS - GALGAMUWA","R11","1","GALGAMUWA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("138","SD MOTORS -MATALE","S26","1","178/3
KANDY RD,
MATALE","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("139","SUNBEAM MOTORS -COLOMBO 14","S31","1","NO.100A
JETHAWANA ROAD
COLOMBO 14","","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("140","L M PERERA MOTORS -COLOMBO 10","L05","1","NO.152,
PANCHIKAWATTE RD
COLOMBO 10","","","300000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("141","G.MUTHUMALA MOTOR STORE -COLOMBO","G03","1","COLOMBO","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("142","HLW ENGINEERING -BALNGODA","H07","1","NO.44
MAIN STREET
BALANGODA","045-2287159","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("143","DINAL MOTORS - KURUNAGALA","D03","1","DAMBULLA ROAD
POLATTHAPITIYA
KURUNEGALA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("144","NEW ARUNA MOTORS  -KULIYAPITIYA","N11","1","HETTIOLA ROAD,
KARANNIPOLA,
KULIYAPITIYA.","077-3115836","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("145","DHARMASIRI MOTORS -MINUWANGODA","D04","1","N0.165
COLOMBO RD,GALLOWA,
MINUWANGODA.","076-8336148","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("146","SAKURA ENTERPRICES -MINUWANGODA","S27","1","NO122,COLOMBO RD,
AMBAGAHAWATTA,
MINUWANGODA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("147","NEW ARALIYA MOTORS -MARADAGAHAMULLA","N12","1","NO.76, 
MIRIGAMA RD,
MARADAGAHAMULA.
","031-2247225","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("148","KURERA MOTORS -DANKOTUWA","K07","1","141/A,
PANNALA RD,
DANKOTUWA.","031-2259915","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("149","LAKSIRI MOTORS -KOTUGODA","L05","1","NO.44,
MINUWANGODA RD,
KOTUGODA.","011-2297138","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("150","ANURADHA AUTO CENTER -KATANA","A06","1","BADALGAMA RD,
DELGASHANDIYA,
KATANA.","031-2240278","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("151","DARSHANA MOTORS -SEEDUWA","D05","1","443, NEGAMBO RD,
SEEDUWA","011-2229922","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("152","S.S. MOTORS -JAELA","S28","1","NO.42,
MINUWANGODA RD,
JA ELA.","011-2228081","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("153","INTER OCEAN LAKSHMAN  TRADERS - COLOMBO 14","I01","1","NO.120,
LAYARD S BROADWAY,
COLOMBO.","011-2330283","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("154","SRIRAAM AUTO MOBILE (PVT)LTD -COLOMBO","S29","1","NO.18,
PRINCE OF WALES AVENUE,
COLOMBO 14.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("155","JAYASIRI MOTORS MAWANELLA","AC001","1","NO. 148,  MAIN  STREET,
MAWANELLA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("156","S.S MOTORS AND HARDWARE -WATTALA","AC002","1","34/1/1,NEGAMBO ROAD,OLLIYAMULLA
WATTALA
","0775948244","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("157","WALPOLA MOTORS PVT LTD -COLOMBO","AC003","1","NO 260 SRI SANGARAJA MW
COLOMBO 10
","0112330321","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("158","JAYANATH MOTOR SUPPLIERS -COLOMBO 10","AC004","1","NO 130 /A
M.M ROAD
PANCHIKAWATTA ROAD
COLOMBO 10
","0112 386348","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("159","UNION MOTORS -COLOMBO 14","AC005","1","12A PRINCE OF WALVES 
COLOMBO 14

","0777 395894","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("160","M.H MOTORS -KURUNEGALA","AC006","1","180/04
PUTTHALAM ROAD
KURUNAGALA
","037 22 25063","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("161","NEW SANJEEWA AUTO SPARE -KURUNEGALA","AC007","1","NO 93
PUTTHALAMA ROAD
KURUNGALA
","037 22 22762","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("162","NEW GENUINE MOTORS -KADURUWELA","AC008","1","Opp . Police Station
Kaduruwela ","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("163","BANDULA TRADING COMPANY -COLOMBO 14","B4","1","PRINCE OF WALVES AVE, COLOMBO 14","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("164","PANAPITIYA & SONS -COLOMBO 14","P04","1","102, LAYARDSBRODWAY, COLOMBO 14","0112-431852","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("165","DHARMARANJITH MOTOR STORE -KADUWELA","D06","1","77/1, AWISSAWELLA RPAD, KADUWELA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("166","SAMAN MOTOR TRADERS -COLOMBO 14","S30","1","153/1, SRIMAVO BANDARANAYAKE MAWATHA, COLOMBO 14","0714255111","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("167","MALWATTHA AUTO ENTERPRICES- THIHARIYA","M03","1","NO.195,  KANDY ROAD, THIHARIYA,MALWATHTHA","","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("168","KUMARA MOTOR TRADERS -KURUNEGALA","K07","1","53, PUTTALAM RD,
KURUNEGALA.","071-3039453","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("169","MADHUSHAN MOTORS -BANDARAWELA","M04","1","74, MAIN STREET,
BANDARAWELA.","072-5710074","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("170","THILANKA MOTORS -GAMPOLA","T07","1","51, STATION RD,
GAMPOLA.","","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("171","PATHMA MOTOR HOUSE -ANURADHSAPURA","P05","1","WILLIAM BULDING,
MAITRIPALA SENANAYAKE RD
ANURADHAPURA.","025-2222471","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("172","ASIRI MOTORS-AMPARA","A07","1","B612, KANDY RD,
AMPARA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("173","WESTERN MOTOR STORES -COLOMBO 10","W06","1","NO.07, ABEYSINGHARAMA RD,
COLOMBO 10.","0112-447263","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("174","LAKNA TACTORS & MOTOR STORE","L06","1","SAW MILL JUNCTION,
KADURUWELA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("175","CITY MOTORS -KALMUNAI","C04","1","163/A,
MAIN STREET,
KALMUNAI.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("176","THAYA MOTOR STORES -BATTICOLA","T08","1","NO.278,
TRINCO RD,
BATTICOLOA.","065-2224411","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("177","SHIFA TRADING -COLOMBO 12","S31","1","NO, 73-2-1,
princess geat,
COLOMBO 12.","077-3144445","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("178","DINUDI MOTOR TRADERS -NAWINNA","D07","1","NO.411,
HIGHLEVEL RD,
NAVINNA, MAHARAGAMA.","0112-801885","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("179","SAMPLE (NADUN )","S31","1","","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("180","JAYANATH MOTOR SUPPLIERS -COLOMBO 10","J4","1","N0 130/1 
MOHIDEEN MASID ROAD
CLOMBO 10","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("181","MATALE RADIATOR HOUSE -MATALE","M1","1","N0 3/2 
MEEWATTA KUBURA ROAD
MATALE","0094 773 082457","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("182","SUKREEVA HARDWARE & MOTORS","S31","1","NO 11/5
STANLEY ROAD
JAFFNA","0703448475","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("183","CHAMEE & BROTHERS MADAWACHCHIYA","C05","1","NO 68
KANDY ROAD
MADAWACHCHIYA","025224511","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("184","LAKSIRI AUTO SPARES -MATHUGAMA","L7","1","NO 74/B
Neboda Raod 
Mathugama ","034 2247836","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("185","PAMODHI MOTORS - PASYALA","P06","1","KANDY ROAD 
BATALEEYA
PASYALA","0771778803","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("186","MAHANUWARA MOTORS -KADURUWELA","M06","1","NO 819 SAW MILL JUNCTION
KADURUWELA","0272223516","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("187","HAWAI MOTORS -COLOMBO 14","H08","1","NO 12B
SRIMAVO BANDARANAYAKE MW
COLOMBO 14","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("188","UDARA MOTORS -WELIWERIYA","w/k 7222","1","NO. 432/A,
NEW KANDY ROAD,
WELIWERIYA.","0334925935","udaraleylandmotors@gmail.com","100000","120","","-","","-","-","","---","G.M SAMAYAWARDANA ,NO 516/28 , BANDARAWATHTHA , WELIWERIYA","600440870V","033-2255116","TRISHANTHA","","G.M SAMAYAWARDANA -PROPRIETOR\'S","SEYLAN  BANK  -WALIWERIYA","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("189","JAYASEKARA MOTORS (PVT) LTD -COLOMBO 10","J5","1","NO. 201,PANCHIKAWATHTA ROAD, COLOMBO 10.","011-2446779","","300000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("190","SOUTH ASIAN AUTOMOBILES PVT LTD ","S26","1","NO 332/29
LESSLISS LAND 
MUNAGAMA
HORANA ","0115883811","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("191","SANDALI OIL MART & MOTORS","S36","1","BARAWAKUMBUKA 
ABILIPITIYA","047 3220777 ","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("192","JAYANTHA SERVICE CENTER -SOORIYAWEWA","J6","1","HAMBANTHOTA ROAD 
SOORIYAWEWA","047 22 88460","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("193","MAHESH MOTORS  -SOORIYAWEWA","M07","1","NOO D 23/61
PADANGALA ROAD 
SURIYAWAWA","071 6795935","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("194","MENUKA TYRE HOUSE  -THALATUOYA","M08","1","THALATHUOYA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("195","DEEPTHI MOTORS DAMBULLA","D07","1","MAIN STREET DAMBULLA ","066-2284385","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("196","RORO ENTERPRICES -KOTUGODA","R13","1","NO 36/B MINUWANGODA ROAD KOTUGODA ","0777371777","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("197","ISURU MOTORS & TYRE CENTER","I02","1","KURUNAGALA ROAD 
GALGAMUWA","037 2263403","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("198","DEVINDI MOTORS  -DIULAPITIYA","D09","1","NO 71/16
DIWULAPITIYA PLAZZA
COLOMBO ROAD
DIWULAPITIYA
( IN FRONT OF CENTERAL FINANCE )","072 5277307","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("199","SIRIWARDANA MOTORS STORES (PVT) LTD","S37","1","NO 1/243
MAIN STREET
KALUTHARA","034 2223082","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("200","YOGESH MOTOR SPARE -NUWARAELIYA","y1","1","NO.01,
PARK ROAD,

NUWARA ELIYA.
","052-2229840","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("201","SUHADA MOTORS PVT LTD -AKURESSA","S38","1","NO. 172,D.C WANIGASEKARA MW, AKURESSA.
","041-2284377","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("202","NIRIELLA MOTORS PVT LTD - GALLE","N13","1","NO.21,NEW STREET , GALL","091-2222588","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("203","DINURA AUTO CARE -MATARA","D10","1","LABEEMA, KAMBURUGAMUWA, MATARA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("204","PATHINAYEKA MOTORS - MATARA","P7","1","NO. 308,NEW TANGALLE ROAD, KOTUWAGODA,MATARA.","0777602268","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("205","HATHARASINGHA MOTORS -MATARA","H9","1","NO. 91/1,ANAGARIKA DHARMAPALA MW, MATHARA.","041-2238342","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("206","SUPREME OIL& AUTO APSRE -BADDEGAMA","S39","1","GALLE ROAD, GOTHATUWA JUNCTION, BADDEGAMA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("207","PERERA MOTORS -KALUTARA SOUTH","P8","1","NO. 140, MAIN STREET, KALUTARA SOUTH.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("208","GAMAGE MOTORS -WELIGAMA","G4","1","NO. 520, MATARA ROAD,PALENA, WELIGAMA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("209","FORT MOTORS -GALLE","F3","1","NO.97/8J,HIDEYATH SHOPPING COMPLX, H.K EDMAND MW, GALLE.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("210","F.D MOTORS -HAMBANTOTA","F04","1","NO 29 
TIHISSA ROAD
HAMBANTHOTA","0771125097","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("211","DEMO AUTO SERVICE - AMBALANTOTOA","D09","1","NO 177
TANGALLE ROAD
TAWALUWILLA AMBALATHOTA","047 2225417","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("212","SAYUMI MOTORS - THANGALLE","0","1","NO 149
WEERAKATIYA JUNCTION
TISSA ROAD
TANGALLE","","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("213","CHANDANA MOTORS - BELIATTA","C05","1","NO 125
WALASMULLA ROAD
BELLIATTHA","047 2251372","","200000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("214","SAMANALA MOTORS  -WALASMULLA","S41","1","NO 157
MIDDENIYA ROAD
WALASMULLA","","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("215","SURASA MOTORS- MATARA","S42","1","NO.55,NEW THANGALLA ROAD, MATARA.","077-3459370","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("216","THASIRU AUTO SERVICE -RANNA","T10","1","NO. 246/2,WADIGALA ,RANNA.","071-4882600/047-2226511","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("217","RISHNA AUTO ENGINEERING & SERVICE STATION","R14","1","NO. 68/2,RASSAGALA ROAD, BALANGODA.","077-9180021","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("218","ANJULA MOTORS -PALATUWA","A08","1","MALIMBADA,PALATUWA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("219","SAMAGI MOTORS &OIL MART -ELPITIYA","S43","1","NEW ROAD, ELPITIYA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("220","MANAHARA TRADERS-DODARA","M9","1","NO.39,LIGHT HOUSE RD, DODARA","041-2222104","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("221","SANJEEWA DIESAL MOTORS","S44","1","ALUTHGAMA RD, BADUGAMA, MATHUGAMA","034-2249450","","200000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("222","AGALAWATTA MOTORS -AGLAWATTA","A9","1","NO. 38/A, HORANA RD, AGALAWATTA.","034-2247743","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("223","KUMARA MOTORS  -MATHUGAMA","K08","1","NO. 194, KALUTRA RD, POLGAHAWATTA , MATHUGAMA.","034-3749261/0773711556","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("224","AYESHA MOTORS & ENTERPRICES","A10","1","NO. 30, KAMARANKAWA, MAPALANA,  KAMBURUPITIYA. ","041-2294347","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("225","GOLD AUTO SERVICE  -AMBALNTOTA","G05","1"," K.H. SAMANPRIYA, NO. NO. 56/B, BELIGALGODA ROAD, AMBALANTOTA","071-5267188","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("226","K&T MOTORS - SEEDUWA","K09","1","NO 443
NEGAMBO ROAD,SEEDUWA



NO. 268/3, NEGAMBO RD, WELIGAMPITIYA, JA ELA","0763528030","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("227","AUTO MART SERVICE CENTER -KURUWITA","A11","1","HIGGASHENA, KURUWITA.","045-2764650","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("228","SAVONTA SERVICE CENTER -GETAHETTA","S45","1","NO. 255/B1,RATHNAPURA RD, GETAHETTA.","036-2233677","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("229","MINRO AUTO SERVICE- KERIELLA","M10","1","IDANGODA, KIRIELLA.","045-2265027","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("230","NETHMINI AUTO PARTS EHALIYAGODA","N14","1","NO. 223,MAIN STREET,EHALIYAGODA.","036-2257540","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("231","REFCON ENGINEERS -DOMPE","R15","1","NO. 295,
TEMPLE JUNCTION,
DOMPE","0721283355/0716556696","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("232","K.T.N. MOTORS(PVT) LTD -MATHUGAMA","K 10","1","NO. 152,
ALUTHGAMA RD, 
MATHUGAMA.","034-04939957","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("233","MAHINDA MOTORS - makola","M 09","1","NO. 247/B/1,
MAKOLA SOUTH,
MAKOLA.","0772278341","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("234","HOUSE OF LEYLAND -MATHUGAMA","H10","1","NO.61A,
ALUTHGAMA RD,
MATHUGAMA.","034-2243686","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("235","VIDUNI AUTO PARTS - WATTALA","2018","1","NO.129/B,
OLD NEGAMBO RD,
WATTALA.","+94112980064","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("236","","2019","1","","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("237","W.S AMANDA MOTORS & FISHING TACKLE -AMBALANGODA","2020","1","NO. 175, MAIN STREET, AMBALANGODA.","091-2255334","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("238","M.N. MOTORS - KURUWITA","2021","1","NO. 63/B, COLOMBO RD, KURUWITA.","045-2262028","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("239","LEYLAND MOTORS - OROPPUWATHTA, GALLE","L20","1","NO.16,
GNANOBASHA MW,
OROPPUWATTHA,
GALLE","091-2227610","","200000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("240","CHANDIMA IMPORTS (PVT) LTD -BELIATTHA","C6","1","DAMMULLA,BELIATTA.","047-2243622","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("241","NITTO MOTORS -DICWELLA","N15","1","NO.71 ,G,BELIATTA RD, DICKWELLA.","041-2255309 / BRANCH- TANGALLE- 0472241309","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("242","ISURU MOTORS  -HOMAGAMA","I 02","1","NO. 238/3.

HIGHLEVEL ROAD,
KANDALANDA,
HOMAGAMA.","0112 748 474","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("243","UNO MOTORS -HANWELLA","H2","1","NO. 211/9
IHALA HANWELLA,
HANWELLA.","036-2251620","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("244","VACOBA MOTOR HOUSE -DELGODA","V2","1","NO. 360/3,
NEW KANDY ROAD, 
DELGODA.","0112403760","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("245","KARIES AUTO MOTORS  -KULIYAPITIYA","K3","1","NO. 575,
MADAMPE ROAD, 
MEEGAHAKOTUWA,
KULIYAPITIYA.


","037-2283929","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("246","NEW LEYLAND MOTORS -MALWANA","L2","1","NO. 584/2,
WALGAMA, 
MALWANA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("247","PATHMA MOTOR STORES - KADAWATHA","P5","1","NO.175/1A,
RAGAMA ROAD,
KADAWATHA","0112925666/4819231/4878113","","200000","0","","","","","","","","","","","","","","","0","200000","1","1","","0","","","1");
INSERT INTO customer VALUES("248","JAYANTHA TRANSPORT SERVICE -WEWELDENIYA","J5","1","PAHALAGAMA, 
WEWALDENIYA.
","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("249","INDIKA MOTORS -KEKIRAWA","I5","1","NO. 308,
KEKIRAWA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("250","DAVID MOTOR HOUSE -AVISSAWELLA","D10","1","NO.257,
COLOMBO ROAD,
KIRIWADALA
AWISSAWELLA.","077-6314119/071-3604654","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("251","RANJEEWA MOTOR STORE -INGIRIYA","R10","1","NO. 20/1,
PANADURA ROAD,
EDURAGALA,
INGIRIYA.","034-2269113","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("252","JAGATH GARAJE -MATHUGAMA","J5","1","NO.44/1
BANDARANAYEKA MW,
MATHUGAMA.","076-7111848/034-2247908","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("253","RUHUNU MOTOR STORES - ELPITIYA","R3","1","NO.17,B,
AMBALANGODA ROAD ,
ELPITIYA.","091-2291335","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("254","LANKA MOTORS  -PUTTALAM","L21","1","PUTTALAMA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("255","NEW DILRUKSHI MOTOR TRADERS- GAMPAHA","N11","1","103,B,
MINUWANGODA ROAD , 
WEEDIYAWATTA ,
UDUGAMPOLA ,
 GAMPAHA.","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("256","KUMARA MOTORS - MAKOLA","k10","1","NO. 186, MAKOLA SOUTH, MAKOLA.
","011-2963632","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("257","ISURA ENTERPRISES - MASPOTHA","I1","1","NO .94,
NEAR THE MAHAKELIYA SCHOOL
RANDENIYA JUNCTION ,MASPOTHA,
WARIYAPOLA. ","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("258","SAMPLE - NILANTHA ","S38","1","","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("259","CITY AUTO MOBILE - THALAKIRIYAGAMA","C15","1","KURUNEGALA ROAD, 
PAHALA WEWA ,
THALAKIRIYAGAMA.","077-6367660","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("260","PATHIRANA MOTORS - MIDDENIYA","12","1","PATHIRANA BUILDING , 
KATUWANA ROAD, 
MIDDENIYA.","071-8050561/047-4937182","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","12","1");
INSERT INTO customer VALUES("261","SAMEENA AUTO SERVICE -EMBILIPITIYA","13","1","NO. 132, RATHNAPURA ROAD, UDAGAMA, EMBILIPITIYA.","047-2262415/0474545142","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("262","MANGALA MOTORS - MORATUWA","14","1","NO. 254, NEW GALL ROAD, MORATUWA","0115781555","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("263","S.R MOTORS","15","1","NO 3/292
UDUMULLA
MULLERIYAWA","0712932706","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("264","AIN MOTORS","16","1","NO 460/5
ABULGAMA ROAD
PANAGODA
HOMAGAMA","0112 173029","","100000","0","","","","","","","","","","","","","","","0","0","1","1","","0","","","1");
INSERT INTO customer VALUES("265","CHANDRA ENGINEERS","17","1","NO 102
PILLAWA ATTHA
BOLLAGALA
KALANIYA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("266","LLEYDS GROUP OF COMPANY","18","1","NO 31
SIRIMAVO BANDARANAYAKE MW
COLOMBO 14","0112471239","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("267","T.D SIRISENA & CO.PVT .LTD","19","1","NO 249/C
PANCHIKAWATTHA ROAD
COLOMBO 10","0094 11 243 8281","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("268","HEMALEE MOTOR CO. (PVT) LTD","20","1","NO 65
SIRIMAVO BANDARANAYAKE MAWATHA 
COLOMBO 14","012 385 743 / 0112 380996","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("269","JAYASEKARA BEARINGS","21","1","NO 231/10B
PANCHIKAWATTA ROAD
COLOMBO 10","0112431310","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("270","UJITHA MOTORS","22","1","4TH MILE POST
KANDY ROAD
CHINA BAY ","0094 26 2242012","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("271","PREMARATNE & CO","23","1","NO 283
PANCHIKAWATTA ROAD
COLOMBO 10","0094 112 436155","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("272","MANNAR MOTOR PARTS & HARDWARES","24","1","CONVENT ROAD , MANNAR","0094-775250042","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("273","NILANTHA MOTOR TRADERS -MAWANALLA","25","1","NO 426 
ANWARAMA , MAWANALLA","035-5633511 , 035-2248242","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("274","AMILA MOTORS -ANAMADUWA","26","1","PUTHTHALAM ROAD
ANAMADUWA","032-2263123","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("275","NAVEEN ENTERPRISES -(MR.RUBBY)","27","1","M/G/S/5
SRI SANGARAJA MAWATHA 
COLOMBO 10","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("276","MORIL MOTOR SPARES","28","1","NO 243
PAHALA WIDIYA
BADULLA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("277","AE MOTORS","29","1","NO 180 
BADULLA ROAD
BIBILE","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("278","CR LANKA AUTO MART","30","1","NO 80/A
NEW HUNUPITIYA ROAD
Wewelduwa 
Kelaniya ","0113059213","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("279","MANGALA MOTORS","31","1","NO 267/A 
HOSPITAL ROAD 
ANGODA JUNCTION
ANGODA","0112-567079","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("280","SIDANTHA ENTERPRISES","32","1","NO 72/19, 
SRI SANGARAJA MW
COLOMBO 10","0112-458035","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("281","SOUTH ASIAN AUTOMOBILES(PVT)LTD - LH 0873","33","1","HORANA","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("282","VARSHA MOTORS","34","1","NO 227
PANCHIKAWATTHA ROAD
COLOMBO 10","0112-470441","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("283","RATHNAWEERA AUTO CARE","35","1","MORAKATIYA ROAD
EMBILIPITIYA","047 22 61613","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("284","DAKSHINA LANKA DISTRIBUTERS","36","1","482C
SRI SUDASHINARAMA MW
KALAMULLA
KALUTARA SOUTH","034-3301332/2224347","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("285","LH0873","37","1","332/29
LESSLISS LAND 
MUNAGMA 
HORNA ","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("286","DOLPHIN AUTO RADIATORS ","38","1","PANCHIKAWATTHA ROAD 
COLOMBO 10","","","","","","","","","","","","","","","","","","","","","","1","","0","","","1");
INSERT INTO customer VALUES("288","Paper Board One","Business","1","No.25, Vijayamawatha,Madamulla","0714698713","c.inomal@gmail.com","1000000","3","5c8c0d80d0962.png","Business","5c8c0d81021b6.jpg","Business","Business","5c8c0d811ab1d.PNG","0714698713","c.inomal@gmail.com","903190205v","0714698713","a","b","Business","Duane L. Whitmore","0","150000","1","1","","0","","","1");
INSERT INTO customer VALUES("292","UDARA MOTOR STORES -GALLE","0","1","NO - 59, SEA STREET, GALLE.","091-2222002","","100000","0","","","","","","","","","","0771176060","","","","","0","100000","1","0","","0","","","1");
INSERT INTO customer VALUES("293","K.N.PERERA AND SOONS-PANADURA.","0","1","NO-230, OLD ROAD, GORAKAPOLA, PANADURA.","0382297485","","100000","0","","","","","","","0382297485","","","0712444589-","","","","","0","0","1","0","","0","","","1");
INSERT INTO customer VALUES("294","NEW HAWANA MOTOR STORES - AMBALANGODA","0","1","NO,252, MAIN STREET, AMBALANGODA.","077-1031526","","100000","0","","","","","","","","","","","","","","","0","0","1","0","","0","","","1");
INSERT INTO customer VALUES("295","SIRILAKA MOTORS - THALGASWALA.","0","1","NEW SHOPING COMPLEX, THALGASWALA.","091-3080530","","100000","0","","","","","","","","","","0722224782 - 0720720900","","","","","0","100000","1","0","","0","","","1");
INSERT INTO customer VALUES("296","SARATHCHANDRA MOTOR STORES -EMBILIPITIYA.","0","1","MORAKETIYA ROAD, EMBILIPITIYA .","","","100000","0","","","","","","","","","","","","","","","0","0","1","0","","0","","","1");
INSERT INTO customer VALUES("297","KEGALLE MOTOR STORES - KEGALLE","0","1","NO, 50 ,MAIN STREET ,KEGALLE.","","","100000","0","","","","","","","","","","077-5537519","","","","","0","0","1","0","","0","","","1");
INSERT INTO customer VALUES("298","KUSUM MOTOR STORES -TISSAMAHARAMAYA","0","1","NO -157/159 ,TISSAMAHARAMAYA.","047-2237212","","100000","0","","","","","","","","","","","","","","","0","0","1","0","","0","","","1");
INSERT INTO customer VALUES("299","WASANTHA MOTORS -MAWANELLA","O","1","NO ,164/ C, NEW KENDAY ROAD, NAIWALA ,MAWANELLA .","035-7200075","","100000","0","","","","","","","","","","0777-308197","","","","","0","0","1","0","","0","","","1");
INSERT INTO customer VALUES("300","SISIRA MOTOR STORES - MAKOLA","V02","1","NO - GALPOTTA JUNTION ,MOKOLA .","0112 -909628","","100000","0","","","","","","","","","","0775 - 015564","","","","","0","0","1","0","","0","","","1");
INSERT INTO customer VALUES("301","DAMITHA MOTORES - COLOMBO -10","0","1","NO -107 ,PANCHIKAWATTA ROAD ,COLOMBO -10.","0112 323337","","100000","0","","","","","","","","","","0777-495096","","","","","0","0","1","0","","","","","1");
INSERT INTO customer VALUES("302","INWA AUTO MOTIVES -KADUWELA ,","0","1","NO -156 / 3 / H  ,NEW KENDAY ROAD ,BANDARAWATTA ,BIYAGAMA ,","0112 - 489406","","100000","0","","","","","","","","","","0776 -558555","","","","","0","0","1","0","","","","","1");
INSERT INTO customer VALUES("303","SOLANGAARACHCHI MOTORS - KULIYAPITIYA .","0","1","MADAMPE ROAD , MEEGAHAKOTUWA ,KULIYAPITIYA .","037 - 2281821","","100000","0","","","","","","","","","","","","","","","0","0","1","0","","","","","1");
INSERT INTO customer VALUES("304","Mr.Rashmie - Assistant Sales Manager","0","1","OFFICE","0703963615","","25000","0","","0","","0","0","","0","0","0","0","0","","","0","0","0","1","0","","","","","1");
INSERT INTO customer VALUES("305","SAMUKIRANA MOTORS -URUBOKKA","0","1","CO-OPERATIVE SOCIETY LTD, URUBOKKA.","0142272267","","100000","0","","","","","","","","","","","","","","","0","0","1","0","","","","0","1");
INSERT INTO customer VALUES("306","NEW RUHUNU MOTORS -KABURUPITIYA .","0","1","NO-06, SUPER MARKET, KABURUPITIYA.","0773666868","","100000","0","","","","","","","","","","","","","","","0","0","1","0","","","","0","1");
INSERT INTO customer VALUES("307","WP-LH-0873. ...(TATA 2516) LORRY","0","1","NO.332/29 .LESSLISS LAND .MUNAGAMA ,HORANA,","","","25000","0","","","","","","","","","","","","","","","0","0","1","0","","","","","1");
INSERT INTO customer VALUES("308","SAMAGI MOTORS AND AUTO SERVICE -BUTTALA .","0","1","NO,145 ,BADALKUBURA ROAD ,BUTTALA .","055-22 73888 .","","100000","0","","","","","","","055 -22 73800","","","","","","","","0","0","1","0","","","","","1");
INSERT INTO customer VALUES("309","NAVIMANA MOTORS -GALLE .",".","1","NO - 06 , SUPERMARKET COMPLEX ,WELEEN SQUARE ,GALLE .","091 - 2222325","","100000","0","","","","","","","","","","","","","","","0","100000","1","0","","","","","1");
INSERT INTO customer VALUES("310","LAHIRU MOTORS - BULATHSINHALA .","W / G G / 9 /110","1","HORANA ROAD ,BULATHSINHALA .","","","0","0","","","","","","","","","","0772 - 533480","","","","","0","0","1","0","","","","","1");





CREATE TABLE `customer_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_order_status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_customer1_idx` (`customer_id`),
  KEY `fk_order_user1_idx` (`user_id`),
  KEY `fk_customer_order_customer_order_status1_idx` (`customer_order_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `customer_order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `customer_order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_has_product_product1_idx` (`product_id`),
  KEY `fk_order_product_customer_order1_idx` (`customer_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `customer_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO customer_order_status VALUES("1","Pending");
INSERT INTO customer_order_status VALUES("2","Done");





CREATE TABLE `customer_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customer_has_payment_payment1_idx` (`payment_id`),
  KEY `fk_customer_has_payment_customer1_idx` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `daily_expences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` float NOT NULL,
  `exp_date` date NOT NULL,
  `feed_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expence_cat` int(11) NOT NULL,
  `Note` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expence_cat` (`expence_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `deliverer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `number` varchar(45) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_distributer_route1_idx` (`route_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO deliverer VALUES("1","OFFICE","","1");
INSERT INTO deliverer VALUES("2","Asanga","KB5541","1");
INSERT INTO deliverer VALUES("3","Shiran","KO8156","1");
INSERT INTO deliverer VALUES("4","Rashmi","KX3572","1");





CREATE TABLE `deliverer_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `deliverer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_distributer_has_inventory_inventory1_idx` (`inventory_id`),
  KEY `fk_deliverer_inventory_deliverer1_idx` (`deliverer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8;

INSERT INTO deliverer_inventory VALUES("1","1","8","1");
INSERT INTO deliverer_inventory VALUES("2","2","19","1");
INSERT INTO deliverer_inventory VALUES("3","3","9","1");
INSERT INTO deliverer_inventory VALUES("4","4","12","1");
INSERT INTO deliverer_inventory VALUES("5","5","3","1");
INSERT INTO deliverer_inventory VALUES("6","6","9","1");
INSERT INTO deliverer_inventory VALUES("7","7","18","1");
INSERT INTO deliverer_inventory VALUES("8","8","5","1");
INSERT INTO deliverer_inventory VALUES("9","9","9","1");
INSERT INTO deliverer_inventory VALUES("10","10","9","1");
INSERT INTO deliverer_inventory VALUES("11","11","16","1");
INSERT INTO deliverer_inventory VALUES("12","12","24","1");
INSERT INTO deliverer_inventory VALUES("13","13","5","1");
INSERT INTO deliverer_inventory VALUES("14","14","3","1");
INSERT INTO deliverer_inventory VALUES("15","15","14","1");
INSERT INTO deliverer_inventory VALUES("16","16","49","1");
INSERT INTO deliverer_inventory VALUES("17","17","27","1");
INSERT INTO deliverer_inventory VALUES("18","18","282","1");
INSERT INTO deliverer_inventory VALUES("19","19","28","1");
INSERT INTO deliverer_inventory VALUES("20","20","7","1");
INSERT INTO deliverer_inventory VALUES("21","21","1","1");
INSERT INTO deliverer_inventory VALUES("22","22","7","1");
INSERT INTO deliverer_inventory VALUES("23","23","40","1");
INSERT INTO deliverer_inventory VALUES("24","24","10","1");
INSERT INTO deliverer_inventory VALUES("25","25","52","1");
INSERT INTO deliverer_inventory VALUES("26","26","15","1");
INSERT INTO deliverer_inventory VALUES("27","27","2","1");
INSERT INTO deliverer_inventory VALUES("28","28","18","1");
INSERT INTO deliverer_inventory VALUES("29","29","2","1");
INSERT INTO deliverer_inventory VALUES("30","30","4","1");
INSERT INTO deliverer_inventory VALUES("31","31","3","1");
INSERT INTO deliverer_inventory VALUES("32","32","4","1");
INSERT INTO deliverer_inventory VALUES("33","33","4","1");
INSERT INTO deliverer_inventory VALUES("34","34","7","1");
INSERT INTO deliverer_inventory VALUES("35","35","1","1");
INSERT INTO deliverer_inventory VALUES("36","36","1","1");
INSERT INTO deliverer_inventory VALUES("37","37","23","1");
INSERT INTO deliverer_inventory VALUES("38","38","26","1");
INSERT INTO deliverer_inventory VALUES("39","39","1","1");
INSERT INTO deliverer_inventory VALUES("40","40","12","1");
INSERT INTO deliverer_inventory VALUES("41","41","17","1");
INSERT INTO deliverer_inventory VALUES("42","42","22","1");
INSERT INTO deliverer_inventory VALUES("43","43","2","1");
INSERT INTO deliverer_inventory VALUES("44","44","167","1");
INSERT INTO deliverer_inventory VALUES("45","45","173","1");
INSERT INTO deliverer_inventory VALUES("46","46","262","1");
INSERT INTO deliverer_inventory VALUES("47","47","48","1");
INSERT INTO deliverer_inventory VALUES("48","48","59","1");
INSERT INTO deliverer_inventory VALUES("49","49","5","1");
INSERT INTO deliverer_inventory VALUES("50","50","1","1");
INSERT INTO deliverer_inventory VALUES("51","51","208","1");
INSERT INTO deliverer_inventory VALUES("52","52","42","1");
INSERT INTO deliverer_inventory VALUES("53","53","28","1");
INSERT INTO deliverer_inventory VALUES("54","54","28","1");
INSERT INTO deliverer_inventory VALUES("55","55","11","1");
INSERT INTO deliverer_inventory VALUES("56","56","22","1");
INSERT INTO deliverer_inventory VALUES("57","57","1","1");
INSERT INTO deliverer_inventory VALUES("58","58","14","1");
INSERT INTO deliverer_inventory VALUES("59","59","3","1");
INSERT INTO deliverer_inventory VALUES("60","60","2","1");
INSERT INTO deliverer_inventory VALUES("61","61","7","1");
INSERT INTO deliverer_inventory VALUES("62","62","4","1");
INSERT INTO deliverer_inventory VALUES("63","63","5","1");
INSERT INTO deliverer_inventory VALUES("64","64","5","1");
INSERT INTO deliverer_inventory VALUES("65","65","11","1");
INSERT INTO deliverer_inventory VALUES("66","66","1","1");
INSERT INTO deliverer_inventory VALUES("67","67","2","1");
INSERT INTO deliverer_inventory VALUES("68","68","1","1");
INSERT INTO deliverer_inventory VALUES("69","69","5","1");
INSERT INTO deliverer_inventory VALUES("70","70","6","1");
INSERT INTO deliverer_inventory VALUES("71","71","3","1");
INSERT INTO deliverer_inventory VALUES("72","72","21","1");
INSERT INTO deliverer_inventory VALUES("73","73","1","1");
INSERT INTO deliverer_inventory VALUES("74","74","5","1");
INSERT INTO deliverer_inventory VALUES("75","75","7","1");
INSERT INTO deliverer_inventory VALUES("76","76","5","1");
INSERT INTO deliverer_inventory VALUES("77","77","2","1");
INSERT INTO deliverer_inventory VALUES("78","78","1","1");
INSERT INTO deliverer_inventory VALUES("79","79","2","1");
INSERT INTO deliverer_inventory VALUES("80","80","1","1");
INSERT INTO deliverer_inventory VALUES("81","81","30","1");
INSERT INTO deliverer_inventory VALUES("82","82","33","1");
INSERT INTO deliverer_inventory VALUES("83","83","14","1");
INSERT INTO deliverer_inventory VALUES("84","84","5","1");
INSERT INTO deliverer_inventory VALUES("85","85","3","1");
INSERT INTO deliverer_inventory VALUES("86","86","1","1");
INSERT INTO deliverer_inventory VALUES("87","87","1","1");
INSERT INTO deliverer_inventory VALUES("88","88","1","1");
INSERT INTO deliverer_inventory VALUES("89","89","20","1");
INSERT INTO deliverer_inventory VALUES("90","90","1","1");
INSERT INTO deliverer_inventory VALUES("91","91","3","1");
INSERT INTO deliverer_inventory VALUES("92","92","10","1");
INSERT INTO deliverer_inventory VALUES("93","93","2","1");
INSERT INTO deliverer_inventory VALUES("94","94","1","1");
INSERT INTO deliverer_inventory VALUES("95","95","2","1");
INSERT INTO deliverer_inventory VALUES("96","96","1","1");
INSERT INTO deliverer_inventory VALUES("97","97","1","1");
INSERT INTO deliverer_inventory VALUES("98","98","1","1");
INSERT INTO deliverer_inventory VALUES("99","99","10","1");
INSERT INTO deliverer_inventory VALUES("100","100","9","1");
INSERT INTO deliverer_inventory VALUES("101","101","4","1");
INSERT INTO deliverer_inventory VALUES("102","102","1","1");
INSERT INTO deliverer_inventory VALUES("103","103","2","1");
INSERT INTO deliverer_inventory VALUES("104","104","2","1");
INSERT INTO deliverer_inventory VALUES("105","105","2","1");
INSERT INTO deliverer_inventory VALUES("106","106","9","1");
INSERT INTO deliverer_inventory VALUES("107","107","3","1");
INSERT INTO deliverer_inventory VALUES("108","108","5","1");
INSERT INTO deliverer_inventory VALUES("109","109","4","1");
INSERT INTO deliverer_inventory VALUES("110","110","2","1");
INSERT INTO deliverer_inventory VALUES("111","111","1","1");
INSERT INTO deliverer_inventory VALUES("112","112","1","1");
INSERT INTO deliverer_inventory VALUES("113","113","6","1");
INSERT INTO deliverer_inventory VALUES("114","114","4","1");
INSERT INTO deliverer_inventory VALUES("115","115","2","1");
INSERT INTO deliverer_inventory VALUES("116","116","1","1");
INSERT INTO deliverer_inventory VALUES("117","117","7","1");
INSERT INTO deliverer_inventory VALUES("118","118","1","1");
INSERT INTO deliverer_inventory VALUES("119","119","5","1");
INSERT INTO deliverer_inventory VALUES("120","120","30","1");
INSERT INTO deliverer_inventory VALUES("121","121","5","1");
INSERT INTO deliverer_inventory VALUES("122","122","1","1");
INSERT INTO deliverer_inventory VALUES("123","123","14","1");
INSERT INTO deliverer_inventory VALUES("124","124","200","1");
INSERT INTO deliverer_inventory VALUES("125","125","29","1");
INSERT INTO deliverer_inventory VALUES("126","126","183","1");
INSERT INTO deliverer_inventory VALUES("127","127","416","1");
INSERT INTO deliverer_inventory VALUES("128","128","21","1");
INSERT INTO deliverer_inventory VALUES("129","129","1","1");
INSERT INTO deliverer_inventory VALUES("130","130","1","1");
INSERT INTO deliverer_inventory VALUES("131","131","890","1");
INSERT INTO deliverer_inventory VALUES("132","132","376","1");
INSERT INTO deliverer_inventory VALUES("133","133","1","1");
INSERT INTO deliverer_inventory VALUES("134","134","7","1");
INSERT INTO deliverer_inventory VALUES("135","135","1","1");
INSERT INTO deliverer_inventory VALUES("136","136","5","1");
INSERT INTO deliverer_inventory VALUES("137","137","975","1");
INSERT INTO deliverer_inventory VALUES("138","138","1","1");
INSERT INTO deliverer_inventory VALUES("139","139","10","1");
INSERT INTO deliverer_inventory VALUES("140","140","1","1");
INSERT INTO deliverer_inventory VALUES("141","141","7","1");
INSERT INTO deliverer_inventory VALUES("142","142","28","1");
INSERT INTO deliverer_inventory VALUES("143","143","117","1");
INSERT INTO deliverer_inventory VALUES("144","144","52","1");
INSERT INTO deliverer_inventory VALUES("145","145","10","1");
INSERT INTO deliverer_inventory VALUES("146","146","20","1");
INSERT INTO deliverer_inventory VALUES("147","147","10","1");
INSERT INTO deliverer_inventory VALUES("148","148","150","1");
INSERT INTO deliverer_inventory VALUES("149","149","5","1");
INSERT INTO deliverer_inventory VALUES("150","150","25","1");
INSERT INTO deliverer_inventory VALUES("151","151","40","1");
INSERT INTO deliverer_inventory VALUES("152","152","10","1");
INSERT INTO deliverer_inventory VALUES("153","153","50","1");
INSERT INTO deliverer_inventory VALUES("154","154","20","1");
INSERT INTO deliverer_inventory VALUES("155","155","10","1");
INSERT INTO deliverer_inventory VALUES("156","156","100","1");
INSERT INTO deliverer_inventory VALUES("157","157","5","1");
INSERT INTO deliverer_inventory VALUES("158","158","5","1");
INSERT INTO deliverer_inventory VALUES("159","159","40","1");
INSERT INTO deliverer_inventory VALUES("160","160","1","1");
INSERT INTO deliverer_inventory VALUES("161","161","20","1");
INSERT INTO deliverer_inventory VALUES("162","162","40","1");
INSERT INTO deliverer_inventory VALUES("163","163","15","1");
INSERT INTO deliverer_inventory VALUES("164","164","19","1");
INSERT INTO deliverer_inventory VALUES("165","165","22","1");
INSERT INTO deliverer_inventory VALUES("166","166","4","1");
INSERT INTO deliverer_inventory VALUES("167","167","20","1");
INSERT INTO deliverer_inventory VALUES("168","168","15","1");
INSERT INTO deliverer_inventory VALUES("169","169","10","1");
INSERT INTO deliverer_inventory VALUES("170","170","5","1");
INSERT INTO deliverer_inventory VALUES("171","171","20","1");
INSERT INTO deliverer_inventory VALUES("172","172","5","1");
INSERT INTO deliverer_inventory VALUES("173","173","2","1");
INSERT INTO deliverer_inventory VALUES("174","174","2","1");
INSERT INTO deliverer_inventory VALUES("175","175","5","1");
INSERT INTO deliverer_inventory VALUES("176","176","5","1");
INSERT INTO deliverer_inventory VALUES("177","177","5","1");
INSERT INTO deliverer_inventory VALUES("178","178","5","1");
INSERT INTO deliverer_inventory VALUES("179","179","10","1");
INSERT INTO deliverer_inventory VALUES("180","180","9","1");
INSERT INTO deliverer_inventory VALUES("181","181","100","1");
INSERT INTO deliverer_inventory VALUES("182","182","10","1");
INSERT INTO deliverer_inventory VALUES("183","183","5","1");
INSERT INTO deliverer_inventory VALUES("184","184","14","1");
INSERT INTO deliverer_inventory VALUES("185","185","10","1");
INSERT INTO deliverer_inventory VALUES("186","186","16","1");
INSERT INTO deliverer_inventory VALUES("187","187","5","1");
INSERT INTO deliverer_inventory VALUES("188","188","22","1");
INSERT INTO deliverer_inventory VALUES("189","189","3","1");
INSERT INTO deliverer_inventory VALUES("190","190","20","1");
INSERT INTO deliverer_inventory VALUES("191","191","32","1");
INSERT INTO deliverer_inventory VALUES("192","192","25","1");
INSERT INTO deliverer_inventory VALUES("193","193","25","1");
INSERT INTO deliverer_inventory VALUES("194","194","10","1");
INSERT INTO deliverer_inventory VALUES("195","195","3","1");
INSERT INTO deliverer_inventory VALUES("196","196","32","1");
INSERT INTO deliverer_inventory VALUES("197","197","2","1");
INSERT INTO deliverer_inventory VALUES("198","198","2","1");
INSERT INTO deliverer_inventory VALUES("199","181","1","3");
INSERT INTO deliverer_inventory VALUES("200","183","45","3");
INSERT INTO deliverer_inventory VALUES("201","196","2","4");





CREATE TABLE `deliverer_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `deliverer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_distributer_has_user_user1_idx` (`user_id`),
  KEY `fk_deliverer_user_deliverer1_idx` (`deliverer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO deliverer_user VALUES("1","1","1");
INSERT INTO deliverer_user VALUES("2","9","2");
INSERT INTO deliverer_user VALUES("3","10","3");
INSERT INTO deliverer_user VALUES("4","7","4");





CREATE TABLE `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO designation VALUES("1","Manager");
INSERT INTO designation VALUES("2","Rep");
INSERT INTO designation VALUES("3","Driver");
INSERT INTO designation VALUES("4","Office Assistance");
INSERT INTO designation VALUES("5","Sales Manager");





CREATE TABLE `emp_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_type` varchar(500) NOT NULL,
  `amount` float NOT NULL,
  `salary_date` date NOT NULL,
  `feed_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emp_id` int(11) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `expence_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `grn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `purchase_order_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `grn_type_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grn_purchase_order1_idx` (`purchase_order_id`),
  KEY `fk_grn_user1_idx` (`user_id`),
  KEY `fk_grn_grn_type1_idx` (`grn_type_id`),
  KEY `fk_grn_supplier1_idx` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO grn VALUES("1","1","2020-01-14 15:10:18","","1","1","1");
INSERT INTO grn VALUES("2","2","2020-01-22 06:59:35","","1","1","2");
INSERT INTO grn VALUES("3","3","2020-01-22 08:55:27","","1","1","2");
INSERT INTO grn VALUES("4","4","2020-01-23 12:33:08","","1","1","2");
INSERT INTO grn VALUES("5","5","2020-02-05 21:23:08","","1","1","3");
INSERT INTO grn VALUES("6","6","2020-02-11 16:00:50","","1","1","4");





CREATE TABLE `grn_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grn_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `volume` decimal(10,3) DEFAULT NULL,
  `unit_price` decimal(12,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grn_has_material_material1_idx` (`material_id`),
  KEY `fk_grn_has_material_grn1_idx` (`grn_id`),
  KEY `fk_grn_material_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `grn_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grn_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grn_has_product_grn1_idx` (`grn_id`),
  KEY `fk_grn_product_batch1_idx` (`batch_id`),
  KEY `fk_grn_product_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

INSERT INTO grn_product VALUES("1","1","28","1","143");
INSERT INTO grn_product VALUES("2","2","100","1","144");
INSERT INTO grn_product VALUES("3","2","50","1","145");
INSERT INTO grn_product VALUES("4","2","10","1","146");
INSERT INTO grn_product VALUES("5","2","20","1","147");
INSERT INTO grn_product VALUES("6","2","10","1","148");
INSERT INTO grn_product VALUES("7","2","150","1","149");
INSERT INTO grn_product VALUES("8","2","5","1","150");
INSERT INTO grn_product VALUES("9","2","25","1","151");
INSERT INTO grn_product VALUES("10","2","40","1","152");
INSERT INTO grn_product VALUES("11","2","10","1","153");
INSERT INTO grn_product VALUES("12","2","50","1","154");
INSERT INTO grn_product VALUES("13","2","20","1","155");
INSERT INTO grn_product VALUES("14","2","10","1","156");
INSERT INTO grn_product VALUES("15","2","100","1","157");
INSERT INTO grn_product VALUES("16","2","5","1","158");
INSERT INTO grn_product VALUES("17","2","5","1","159");
INSERT INTO grn_product VALUES("18","2","40","1","160");
INSERT INTO grn_product VALUES("19","2","1","1","161");
INSERT INTO grn_product VALUES("20","2","20","1","162");
INSERT INTO grn_product VALUES("21","2","40","1","163");
INSERT INTO grn_product VALUES("22","2","15","1","164");
INSERT INTO grn_product VALUES("23","2","10","1","165");
INSERT INTO grn_product VALUES("24","2","20","1","166");
INSERT INTO grn_product VALUES("25","2","4","1","167");
INSERT INTO grn_product VALUES("26","2","20","1","168");
INSERT INTO grn_product VALUES("27","2","15","1","169");
INSERT INTO grn_product VALUES("28","2","10","1","170");
INSERT INTO grn_product VALUES("29","2","5","1","171");
INSERT INTO grn_product VALUES("30","2","20","1","172");
INSERT INTO grn_product VALUES("31","2","5","1","173");
INSERT INTO grn_product VALUES("32","2","2","1","174");
INSERT INTO grn_product VALUES("33","2","2","1","175");
INSERT INTO grn_product VALUES("34","2","5","1","176");
INSERT INTO grn_product VALUES("35","2","5","1","177");
INSERT INTO grn_product VALUES("36","2","5","1","178");
INSERT INTO grn_product VALUES("37","2","5","1","179");
INSERT INTO grn_product VALUES("38","3","9","1","180");
INSERT INTO grn_product VALUES("39","4","6","1","181");
INSERT INTO grn_product VALUES("40","4","6","1","182");
INSERT INTO grn_product VALUES("41","5","100","1","183");
INSERT INTO grn_product VALUES("42","5","10","1","184");
INSERT INTO grn_product VALUES("43","5","5","1","185");
INSERT INTO grn_product VALUES("44","5","10","1","186");
INSERT INTO grn_product VALUES("45","5","10","1","187");
INSERT INTO grn_product VALUES("46","5","16","1","188");
INSERT INTO grn_product VALUES("47","5","5","1","189");
INSERT INTO grn_product VALUES("48","5","22","1","190");
INSERT INTO grn_product VALUES("49","5","3","1","191");
INSERT INTO grn_product VALUES("50","5","20","1","192");
INSERT INTO grn_product VALUES("51","5","30","1","193");
INSERT INTO grn_product VALUES("52","5","25","1","194");
INSERT INTO grn_product VALUES("53","5","25","1","195");
INSERT INTO grn_product VALUES("54","5","10","1","196");
INSERT INTO grn_product VALUES("55","5","3","1","197");
INSERT INTO grn_product VALUES("56","5","32","1","198");
INSERT INTO grn_product VALUES("57","6","2","1","199");
INSERT INTO grn_product VALUES("58","6","2","1","200");





CREATE TABLE `grn_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO grn_type VALUES("1","Product");
INSERT INTO grn_type VALUES("2","Material");





CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inventory_product1_idx` (`product_id`),
  KEY `fk_inventory_batch1_idx` (`batch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8;

INSERT INTO inventory VALUES("1","8","1","1");
INSERT INTO inventory VALUES("2","19","2","2");
INSERT INTO inventory VALUES("3","9","3","3");
INSERT INTO inventory VALUES("4","12","4","4");
INSERT INTO inventory VALUES("5","3","5","5");
INSERT INTO inventory VALUES("6","9","6","6");
INSERT INTO inventory VALUES("7","18","7","7");
INSERT INTO inventory VALUES("8","5","8","8");
INSERT INTO inventory VALUES("9","9","9","9");
INSERT INTO inventory VALUES("10","8","10","10");
INSERT INTO inventory VALUES("11","15","11","11");
INSERT INTO inventory VALUES("12","24","12","12");
INSERT INTO inventory VALUES("13","5","13","13");
INSERT INTO inventory VALUES("14","3","14","14");
INSERT INTO inventory VALUES("15","14","15","15");
INSERT INTO inventory VALUES("16","49","16","16");
INSERT INTO inventory VALUES("17","27","17","17");
INSERT INTO inventory VALUES("18","282","18","18");
INSERT INTO inventory VALUES("19","28","19","19");
INSERT INTO inventory VALUES("20","7","20","20");
INSERT INTO inventory VALUES("21","1","21","21");
INSERT INTO inventory VALUES("22","7","22","22");
INSERT INTO inventory VALUES("23","40","23","23");
INSERT INTO inventory VALUES("24","10","24","24");
INSERT INTO inventory VALUES("25","52","25","25");
INSERT INTO inventory VALUES("26","15","26","26");
INSERT INTO inventory VALUES("27","2","27","27");
INSERT INTO inventory VALUES("28","18","28","28");
INSERT INTO inventory VALUES("29","2","29","29");
INSERT INTO inventory VALUES("30","4","30","30");
INSERT INTO inventory VALUES("31","3","31","31");
INSERT INTO inventory VALUES("32","4","32","32");
INSERT INTO inventory VALUES("33","4","33","33");
INSERT INTO inventory VALUES("34","7","34","34");
INSERT INTO inventory VALUES("35","1","35","35");
INSERT INTO inventory VALUES("36","1","36","36");
INSERT INTO inventory VALUES("37","23","37","37");
INSERT INTO inventory VALUES("38","26","38","38");
INSERT INTO inventory VALUES("39","1","39","39");
INSERT INTO inventory VALUES("40","4","40","40");
INSERT INTO inventory VALUES("41","17","41","41");
INSERT INTO inventory VALUES("42","16","42","42");
INSERT INTO inventory VALUES("43","0","43","43");
INSERT INTO inventory VALUES("44","155","44","44");
INSERT INTO inventory VALUES("45","160","45","45");
INSERT INTO inventory VALUES("46","68","46","46");
INSERT INTO inventory VALUES("47","48","47","47");
INSERT INTO inventory VALUES("48","57","48","48");
INSERT INTO inventory VALUES("49","5","49","49");
INSERT INTO inventory VALUES("50","1","50","50");
INSERT INTO inventory VALUES("51","13","51","51");
INSERT INTO inventory VALUES("52","22","52","52");
INSERT INTO inventory VALUES("53","28","53","53");
INSERT INTO inventory VALUES("54","28","54","54");
INSERT INTO inventory VALUES("55","11","55","55");
INSERT INTO inventory VALUES("56","22","56","56");
INSERT INTO inventory VALUES("57","1","57","57");
INSERT INTO inventory VALUES("58","14","58","58");
INSERT INTO inventory VALUES("59","1","59","59");
INSERT INTO inventory VALUES("60","0","60","60");
INSERT INTO inventory VALUES("61","5","61","61");
INSERT INTO inventory VALUES("62","4","62","62");
INSERT INTO inventory VALUES("63","2","63","63");
INSERT INTO inventory VALUES("64","0","64","64");
INSERT INTO inventory VALUES("65","11","65","65");
INSERT INTO inventory VALUES("66","0","66","66");
INSERT INTO inventory VALUES("67","0","67","67");
INSERT INTO inventory VALUES("68","1","68","68");
INSERT INTO inventory VALUES("69","5","69","69");
INSERT INTO inventory VALUES("70","6","70","70");
INSERT INTO inventory VALUES("71","3","71","71");
INSERT INTO inventory VALUES("72","21","72","72");
INSERT INTO inventory VALUES("73","1","73","73");
INSERT INTO inventory VALUES("74","5","74","74");
INSERT INTO inventory VALUES("75","7","75","75");
INSERT INTO inventory VALUES("76","5","76","76");
INSERT INTO inventory VALUES("77","2","77","77");
INSERT INTO inventory VALUES("78","1","78","78");
INSERT INTO inventory VALUES("79","2","79","79");
INSERT INTO inventory VALUES("80","1","80","80");
INSERT INTO inventory VALUES("81","30","81","81");
INSERT INTO inventory VALUES("82","33","82","82");
INSERT INTO inventory VALUES("83","14","83","83");
INSERT INTO inventory VALUES("84","5","84","84");
INSERT INTO inventory VALUES("85","3","85","85");
INSERT INTO inventory VALUES("86","1","86","86");
INSERT INTO inventory VALUES("87","1","87","87");
INSERT INTO inventory VALUES("88","1","88","88");
INSERT INTO inventory VALUES("89","20","89","89");
INSERT INTO inventory VALUES("90","1","90","90");
INSERT INTO inventory VALUES("91","3","91","91");
INSERT INTO inventory VALUES("92","10","92","92");
INSERT INTO inventory VALUES("93","2","93","93");
INSERT INTO inventory VALUES("94","1","94","94");
INSERT INTO inventory VALUES("95","2","95","95");
INSERT INTO inventory VALUES("96","1","96","96");
INSERT INTO inventory VALUES("97","1","97","97");
INSERT INTO inventory VALUES("98","1","98","98");
INSERT INTO inventory VALUES("99","10","99","99");
INSERT INTO inventory VALUES("100","9","100","100");
INSERT INTO inventory VALUES("101","4","101","101");
INSERT INTO inventory VALUES("102","1","102","102");
INSERT INTO inventory VALUES("103","2","103","103");
INSERT INTO inventory VALUES("104","2","104","104");
INSERT INTO inventory VALUES("105","2","105","105");
INSERT INTO inventory VALUES("106","9","106","106");
INSERT INTO inventory VALUES("107","3","107","107");
INSERT INTO inventory VALUES("108","5","108","108");
INSERT INTO inventory VALUES("109","4","109","109");
INSERT INTO inventory VALUES("110","2","110","110");
INSERT INTO inventory VALUES("111","1","111","111");
INSERT INTO inventory VALUES("112","1","112","112");
INSERT INTO inventory VALUES("113","6","113","113");
INSERT INTO inventory VALUES("114","4","114","114");
INSERT INTO inventory VALUES("115","2","115","115");
INSERT INTO inventory VALUES("116","1","116","116");
INSERT INTO inventory VALUES("117","7","117","117");
INSERT INTO inventory VALUES("118","1","118","118");
INSERT INTO inventory VALUES("119","5","119","119");
INSERT INTO inventory VALUES("120","30","120","120");
INSERT INTO inventory VALUES("121","5","121","121");
INSERT INTO inventory VALUES("122","1","122","122");
INSERT INTO inventory VALUES("123","14","123","123");
INSERT INTO inventory VALUES("124","200","124","124");
INSERT INTO inventory VALUES("125","29","125","125");
INSERT INTO inventory VALUES("126","183","126","126");
INSERT INTO inventory VALUES("127","416","127","127");
INSERT INTO inventory VALUES("128","21","128","128");
INSERT INTO inventory VALUES("129","1","129","129");
INSERT INTO inventory VALUES("130","1","130","130");
INSERT INTO inventory VALUES("131","890","131","131");
INSERT INTO inventory VALUES("132","376","132","132");
INSERT INTO inventory VALUES("133","1","133","133");
INSERT INTO inventory VALUES("134","7","134","134");
INSERT INTO inventory VALUES("135","1","135","135");
INSERT INTO inventory VALUES("136","5","136","136");
INSERT INTO inventory VALUES("137","975","137","137");
INSERT INTO inventory VALUES("138","1","138","138");
INSERT INTO inventory VALUES("139","10","139","139");
INSERT INTO inventory VALUES("140","1","140","140");
INSERT INTO inventory VALUES("141","7","141","141");
INSERT INTO inventory VALUES("142","0","142","143");
INSERT INTO inventory VALUES("143","34","143","144");
INSERT INTO inventory VALUES("144","50","144","145");
INSERT INTO inventory VALUES("145","10","145","146");
INSERT INTO inventory VALUES("146","0","146","147");
INSERT INTO inventory VALUES("147","8","147","148");
INSERT INTO inventory VALUES("148","145","150","149");
INSERT INTO inventory VALUES("149","0","187","150");
INSERT INTO inventory VALUES("150","14","149","151");
INSERT INTO inventory VALUES("151","36","151","152");
INSERT INTO inventory VALUES("152","10","152","153");
INSERT INTO inventory VALUES("153","40","153","154");
INSERT INTO inventory VALUES("154","9","155","155");
INSERT INTO inventory VALUES("155","1","154","156");
INSERT INTO inventory VALUES("156","70","156","157");
INSERT INTO inventory VALUES("157","4","157","158");
INSERT INTO inventory VALUES("158","4","158","159");
INSERT INTO inventory VALUES("159","36","159","160");
INSERT INTO inventory VALUES("160","5","160","161");
INSERT INTO inventory VALUES("161","14","161","162");
INSERT INTO inventory VALUES("162","25","162","163");
INSERT INTO inventory VALUES("163","8","163","164");
INSERT INTO inventory VALUES("164","3","164","165");
INSERT INTO inventory VALUES("165","16","165","166");
INSERT INTO inventory VALUES("166","3","166","167");
INSERT INTO inventory VALUES("167","17","167","168");
INSERT INTO inventory VALUES("168","9","168","169");
INSERT INTO inventory VALUES("169","10","169","170");
INSERT INTO inventory VALUES("170","5","170","171");
INSERT INTO inventory VALUES("171","20","171","172");
INSERT INTO inventory VALUES("172","0","172","173");
INSERT INTO inventory VALUES("173","2","173","174");
INSERT INTO inventory VALUES("174","0","174","175");
INSERT INTO inventory VALUES("175","0","175","176");
INSERT INTO inventory VALUES("176","0","176","177");
INSERT INTO inventory VALUES("177","0","177","178");
INSERT INTO inventory VALUES("178","3","178","179");
INSERT INTO inventory VALUES("179","2","188","181");
INSERT INTO inventory VALUES("180","6","189","182");
INSERT INTO inventory VALUES("181","64","190","183");
INSERT INTO inventory VALUES("182","5","191","184");
INSERT INTO inventory VALUES("183","49","192","185");
INSERT INTO inventory VALUES("184","2","193","186");
INSERT INTO inventory VALUES("185","4","194","187");
INSERT INTO inventory VALUES("186","16","195","188");
INSERT INTO inventory VALUES("187","5","196","189");
INSERT INTO inventory VALUES("188","16","197","190");
INSERT INTO inventory VALUES("189","2","198","191");
INSERT INTO inventory VALUES("190","19","199","192");
INSERT INTO inventory VALUES("191","22","200","193");
INSERT INTO inventory VALUES("192","24","202","194");
INSERT INTO inventory VALUES("193","25","203","195");
INSERT INTO inventory VALUES("194","10","204","196");
INSERT INTO inventory VALUES("195","3","205","197");
INSERT INTO inventory VALUES("196","31","201","198");
INSERT INTO inventory VALUES("197","0","206","199");
INSERT INTO inventory VALUES("198","0","207","200");





CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(500) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `reurn_invoice_id` int(11) DEFAULT NULL,
  `invoice_status_id` int(11) NOT NULL,
  `gross_amount` decimal(12,2) DEFAULT NULL,
  `net_amount` decimal(12,2) DEFAULT NULL,
  `balance` decimal(12,2) DEFAULT NULL,
  `customer_order_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `invoice_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_condition_id` int(11) NOT NULL,
  `deliverer_id` int(11) DEFAULT NULL,
  `invoice_method` varchar(200) DEFAULT NULL,
  `is_printed` int(11) NOT NULL DEFAULT '0',
  `GpsLocation` varchar(750) DEFAULT NULL,
  `inv_status` int(11) NOT NULL DEFAULT '1',
  `discount_approval` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_invoice_customer1_idx` (`customer_id`),
  KEY `fk_invoice_invoice1_idx` (`reurn_invoice_id`),
  KEY `fk_invoice_invoice_status1_idx` (`invoice_status_id`),
  KEY `fk_invoice_customer_order1_idx` (`customer_order_id`),
  KEY `fk_invoice_invoice_type1_idx` (`invoice_type_id`),
  KEY `fk_invoice_user1_idx` (`user_id`),
  KEY `fk_invoice_invoice_condition1_idx` (`invoice_condition_id`),
  KEY `fk_invoice_deliverer1_idx` (`deliverer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

INSERT INTO invoice VALUES("1","OF20011400001","2020-01-14 15:00:32","","1","21768.80","17415.04","17415.04","","13","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("2","OF20011400002","2020-01-14 15:17:56","","1","10864.00","10864.00","10864.00","","45","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("3","OF20011400003","2020-01-14 15:25:00","","1","10884.40","8707.52","8707.52","","65","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("4","OF20011400004","2020-01-14 15:32:27","","2","15467.26","12373.81","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("5","OF20011400005","2020-01-14 15:39:02","","2","20560.00","20560.00","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("6","OF20011400006","2020-01-14 15:41:30","","2","17649.80","17649.80","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("7","OF20011600007","2020-01-16 12:45:25","","1","6980.00","6980.00","6980.00","","292","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("8","OF20011600008","2020-01-16 13:21:00","","1","2870.00","2870.00","2870.00","","293","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("9","OF20011700009","2020-01-17 16:13:56","","1","2870.00","2870.00","2870.00","","295","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("10","OF20012300010","2020-01-23 06:28:31","","1","229586.50","206627.85","206627.85","","105","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("11","OF20012300011","2020-01-23 06:35:48","","1","12749.10","12749.10","12749.10","","47","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("12","OF20012300012","2020-01-23 06:47:13","","2","6374.55","6374.55","0.00","","75","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("13","OF20012300013","2020-01-23 07:40:17","","1","5460.00","5460.00","5460.00","","55","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("14","","2020-01-23 07:40:20","","2","","","","","","1","1","1","","","1","","1","0");
INSERT INTO invoice VALUES("15","OF20012300014","2020-01-23 07:51:11","","1","5070.00","5070.00","5070.00","","55","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("16","OF20012300015","2020-01-23 07:58:38","","1","12574.90","12574.90","12574.90","","178","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("17","OF20012300016","2020-01-23 08:03:16","","1","5785.00","5785.00","5785.00","","30","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("18","OF20012300017","2020-01-23 08:16:48","","2","37531.00","33777.90","0.00","","87","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("19","OF20012300018","2020-01-23 08:22:37","","1","5525.00","5525.00","5525.00","","132","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("20","OF20012300019","2020-01-23 11:01:19","","1","9945.00","9945.00","9945.00","","247","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("21","OF20012300020","2020-01-23 11:07:40","","2","6630.00","5967.00","0.00","","87","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("22","OF20012300021","2020-01-23 11:38:11","","1","12749.10","11474.19","11474.19","","296","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("23","OF20012300022","2020-01-23 15:35:11","","2","12749.10","11474.19","0.00","","298","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("24","OF20012400023","2020-01-24 08:33:05","","2","0.00","0.00","0.00","","87","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("25","OF20012400024","2020-01-24 22:24:40","","1","71259.50","64133.55","64133.55","","101","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("26","OF20012400025","2020-01-24 23:05:22","","1","59215.00","53293.50","53293.50","","101","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("27","OF20012500026","2020-01-25 10:30:48","","1","12749.10","12749.10","12749.10","","60","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("28","OF20012500027","2020-01-25 11:06:36","","1","2612.26","2089.80","0.00","","300","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("29","OF20012500028","2020-01-25 11:10:52","","1","12574.90","12574.90","12574.90","","19","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("30","OF20012500029","2020-01-25 11:13:14","","1","6287.45","6287.45","6287.45","","299","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("31","OF20012500030","2020-01-25 11:54:58","","1","38073.10","38073.10","38073.10","","19","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("32","OF20012700031","2020-01-27 10:45:26","","1","13061.28","10449.02","10449.02","","178","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("33","OF20012900032","2020-01-29 08:23:49","","1","4353.76","3483.01","3483.01","","242","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("34","OF20013000033","2020-01-30 08:07:24","","2","68113.50","61302.15","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("35","OF20013000034","2020-01-30 08:27:07","","2","138525.40","124672.86","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("36","OF20013000035","2020-01-30 10:30:02","","2","85842.25","77258.03","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("37","OF20013100036","2020-01-31 12:33:29","","2","5100.00","5100.00","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("38","OF20020200037","2020-02-02 22:28:02","","2","231583.30","208424.97","0.00","","65","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("39","OF20020300038","2020-02-03 11:36:36","","1","12574.90","12574.90","12574.90","","178","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("40","OF20020300039","2020-02-03 11:47:32","","1","12749.10","12749.10","12749.10","","302","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("41","OF20020300040","2020-02-03 11:49:32","","1","12749.10","12749.10","12749.10","","301","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("42","OF20020500041","2020-02-05 08:20:40","","1","49381.80","44443.62","44443.62","","13","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("43","OF20020500042","2020-02-05 16:32:54","","1","13200.00","13200.00","13200.00","","85","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("44","OF20020600043","2020-02-06 13:33:01","","2","43800.00","39420.00","0.00","","221","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("45","OF20020600044","2020-02-06 15:20:14","","1","6251.42","5001.14","5001.14","","239","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("46","OF20020600045","2020-02-06 15:41:22","","1","41125.95","41125.95","23869.95","","189","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("47","OF20020700046","2020-02-07 16:39:30","","1","17256.00","17256.00","17256.00","","167","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("48","OF20020700047","2020-02-07 17:01:38","","1","17355.00","17355.00","17355.00","","303","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("49","OF20020700048","2020-02-07 17:50:51","","1","8707.52","6966.02","6966.02","","140","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("50","OF20020700049","2020-02-07 18:11:03","","2","75029.60","67526.64","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("51","OF20020700050","2020-02-07 18:19:08","","2","52304.80","52304.80","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("52","OF20021100051","2020-02-11 16:06:46","","2","10000.00","10000.00","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("53","OF20021200052","2020-02-12 09:52:32","","2","87600.00","65700.00","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("54","OF20021200053","2020-02-12 11:00:30","","2","48303.45","43473.10","0.00","","71","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("55","OF20021200054","2020-02-12 15:08:31","","1","106352.00","95716.80","95716.80","","85","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("56","OF20021200055","2020-02-12 20:28:53","","2","0.00","0.00","0.00","","293","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("58","OF20021200056","2020-02-12 20:34:42","","2","0.00","0.00","0.00","","293","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("59","OF20021200057","2020-02-12 20:40:53","","1","9956.09","9956.09","9956.09","","304","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("60","OF20021400058","2020-02-14 15:40:15","","1","87600.00","65700.00","65700.00","","247","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("63","OF20021700061","2020-02-17 16:25:52","","1","12749.10","12749.10","12749.10","","178","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("64","OF20021700062","2020-02-17 18:03:28","","1","130636.35","130636.35","130636.35","","23","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("70","OF20022400068","2020-02-24 08:25:51","","1","25613.60","25613.60","25613.60","","87","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("71","OF20022400069","2020-02-24 08:34:26","","1","25613.60","25613.60","25613.60","","54","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("72","OF20022400070","2020-02-24 08:46:17","","1","13687.20","13687.20","13687.20","","247","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("73","OF20022400071","2020-02-24 08:48:00","","1","13687.20","13687.20","13687.20","","82","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("74","OF20022400072","2020-02-24 13:07:34","","1","33404.80","33404.80","33404.80","","23","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("75","OF20022400073","2020-02-24 13:13:23","","1","18862.35","18862.35","18862.35","","23","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("79","OF20022600077","2020-02-26 12:14:20","","1","12749.10","12749.10","12749.10","","260","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("80","OF20022600078","2020-02-26 12:35:24","","1","12749.10","12749.10","12749.10","","308","1","1","1","1","1","1","","1","0");
INSERT INTO invoice VALUES("84","As20030100001","2020-03-01 09:49:49","","1","27374.40","27374.40","27374.40","","82","1","9","1","2","1","1","","1","0");
INSERT INTO invoice VALUES("91","Sh20030300002","2020-03-03 10:08:29","","1","18844.00","18844.00","18844.00","","214","1","10","1","3","1","1","","1","0");
INSERT INTO invoice VALUES("93","Sh20030300003","2020-03-03 10:12:36","","1","26280.00","19502.39","19502.39","","214","1","10","1","3","1","1","","1","1");
INSERT INTO invoice VALUES("96","As20030300002","2020-03-03 16:07:12","","1","27374.40","27374.40","27374.40","","264","1","9","1","2","1","1","","1","0");
INSERT INTO invoice VALUES("97","As20030300003","2020-03-03 16:43:43","","1","4400.00","3520.00","3520.00","","300","1","9","1","2","1","1","","1","1");
INSERT INTO invoice VALUES("99","Sh20030400003","2020-03-04 08:41:02","","1","24407.20","24407.20","24407.20","","204","1","10","1","3","1","1","","1","0");
INSERT INTO invoice VALUES("100","Sh20030400004","2020-03-04 12:04:51","","1","480.00","384.00","384.00","","292","1","10","1","3","1","0","","1","0");
INSERT INTO invoice VALUES("102","As20030500004","2020-03-05 11:34:53","","1","11876.15","11876.15","11876.15","","178","1","9","1","2","1","1","","1","0");
INSERT INTO invoice VALUES("103","As20030600005","2020-03-06 08:55:20","","1","8760.00","6500.80","6500.80","","139","1","9","1","2","1","1","","1","1");
INSERT INTO invoice VALUES("104","As20030600006","2020-03-06 12:02:40","","1","76964.00","69267.60","69267.60","","247","1","9","1","2","1","1","","1","1");
INSERT INTO invoice VALUES("105","Ra20030600001","2020-03-06 16:01:48","","1","13624.00","12261.60","12261.60","","71","1","1","1","4","1","1","","1","1");
INSERT INTO invoice VALUES("106","As20030600007","2020-03-06 16:58:42","","1","1306.13","1044.90","1044.90","","300","1","9","1","2","1","1","","1","1");
INSERT INTO invoice VALUES("107","AS20031200008","2020-03-12 12:10:25","","1","3188.59","2550.87","2550.87","","303","1","9","1","2","1","1","","1","1");
INSERT INTO invoice VALUES("108","RA20031300002","2020-03-13 07:40:40","","1","10720.00","10720.00","10720.00","","170","1","1","1","4","1","1","","1","0");
INSERT INTO invoice VALUES("109","RA20031600003","2020-03-16 16:06:19","","1","94149.90","84734.91","84734.91","","71","1","1","1","4","1","1","","1","1");
INSERT INTO invoice VALUES("110","RA20031700004","2020-03-17 12:22:08","","1","10884.40","8707.52","8707.52","","71","1","1","1","4","1","1","","1","1");
INSERT INTO invoice VALUES("111","AS20031700009","2020-03-17 12:54:13","","1","31772.80","30184.16","30184.16","","153","1","1","1","2","1","1","","1","1");
INSERT INTO invoice VALUES("112","","2020-03-17 12:54:16","","2","","","","","","1","1","1","","","0","","1","0");
INSERT INTO invoice VALUES("113","RA20031700005","2020-03-17 14:46:32","","1","26546.00","23891.40","23891.40","","71","1","9","1","4","1","1","","1","1");
INSERT INTO invoice VALUES("114","SH20031800005","2020-03-18 08:41:21","","1","26280.00","19502.39","19502.39","","260","1","10","1","3","1","1","","1","1");
INSERT INTO invoice VALUES("115","SH20031800006","2020-03-18 08:45:03","","1","8760.00","6500.80","6500.80","","295","1","10","1","3","1","1","","1","1");
INSERT INTO invoice VALUES("116","RA20031900006","2020-03-19 12:04:19","","1","17324.55","17324.55","17324.55","","6","1","8","1","4","1","1","","1","0");





CREATE TABLE `invoice_condition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO invoice_condition VALUES("1","New");
INSERT INTO invoice_condition VALUES("2","Return");





CREATE TABLE `invoice_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `unit_discount` decimal(12,2) DEFAULT NULL,
  `gross_amount` decimal(12,2) DEFAULT NULL,
  `net_amount` decimal(12,2) DEFAULT NULL,
  `freeissue` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_invoice_product_invoice1_idx` (`invoice_id`),
  KEY `fk_invoice_product_inventory1_idx` (`inventory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;

INSERT INTO invoice_inventory VALUES("1","1","46","50","264.22","20.00","13211.00","12211.00","0");
INSERT INTO invoice_inventory VALUES("2","1","51","50","280.00","20.00","14000.00","13000.00","0");
INSERT INTO invoice_inventory VALUES("3","2","142","28","485.00","20.00","13580.00","13020.00","0");
INSERT INTO invoice_inventory VALUES("4","3","46","25","264.22","20.00","6605.50","6105.50","0");
INSERT INTO invoice_inventory VALUES("5","3","51","25","280.00","20.00","7000.00","6500.00","0");
INSERT INTO invoice_inventory VALUES("6","4","51","25","280.00","20.00","7000.00","6500.00","0");
INSERT INTO invoice_inventory VALUES("7","4","46","25","264.22","20.00","6605.50","6105.50","0");
INSERT INTO invoice_inventory VALUES("8","4","40","8","521.43","20.00","4171.44","4011.44","0");
INSERT INTO invoice_inventory VALUES("9","4","43","2","778.57","20.00","1557.14","1517.14","0");
INSERT INTO invoice_inventory VALUES("10","5","63","3","3300.00","0.00","9900.00","9900.00","0");
INSERT INTO invoice_inventory VALUES("11","5","64","3","3300.00","0.00","9900.00","9900.00","0");
INSERT INTO invoice_inventory VALUES("12","5","66","1","380.00","0.00","380.00","380.00","0");
INSERT INTO invoice_inventory VALUES("13","5","67","1","380.00","0.00","380.00","380.00","0");
INSERT INTO invoice_inventory VALUES("14","6","10","1","12607.00","30.00","12607.00","12577.00","0");
INSERT INTO invoice_inventory VALUES("15","6","11","1","12607.00","30.00","12607.00","12577.00","0");
INSERT INTO invoice_inventory VALUES("16","7","63","1","3300.00","0.00","3300.00","3300.00","0");
INSERT INTO invoice_inventory VALUES("17","7","64","1","3300.00","0.00","3300.00","3300.00","0");
INSERT INTO invoice_inventory VALUES("18","7","67","1","380.00","0.00","380.00","380.00","0");
INSERT INTO invoice_inventory VALUES("19","8","59","1","1435.00","0.00","1435.00","1435.00","0");
INSERT INTO invoice_inventory VALUES("20","8","60","1","1435.00","0.00","1435.00","1435.00","0");
INSERT INTO invoice_inventory VALUES("21","9","59","1","1435.00","0.00","1435.00","1435.00","0");
INSERT INTO invoice_inventory VALUES("22","9","60","1","1435.00","0.00","1435.00","1435.00","0");
INSERT INTO invoice_inventory VALUES("23","10","143","30","9807.00","35.00","294210.00","293160.00","0");
INSERT INTO invoice_inventory VALUES("24","10","146","20","2950.00","35.00","59000.00","58300.00","0");
INSERT INTO invoice_inventory VALUES("25","11","143","2","9807.00","35.00","19614.00","19544.00","0");
INSERT INTO invoice_inventory VALUES("26","12","143","1","9807.00","35.00","9807.00","9772.00","0");
INSERT INTO invoice_inventory VALUES("27","13","155","2","4200.00","35.00","8400.00","8330.00","0");
INSERT INTO invoice_inventory VALUES("28","15","154","2","3900.00","35.00","7800.00","7730.00","0");
INSERT INTO invoice_inventory VALUES("29","16","165","2","9673.00","35.00","19346.00","19276.00","0");
INSERT INTO invoice_inventory VALUES("30","17","175","1","8900.00","35.00","8900.00","8865.00","0");
INSERT INTO invoice_inventory VALUES("31","18","155","2","4200.00","35.00","8400.00","8330.00","0");
INSERT INTO invoice_inventory VALUES("32","18","153","2","20420.00","35.00","40840.00","40770.00","0");
INSERT INTO invoice_inventory VALUES("33","18","161","1","8500.00","35.00","8500.00","8465.00","0");
INSERT INTO invoice_inventory VALUES("34","19","161","1","8500.00","35.00","8500.00","8465.00","0");
INSERT INTO invoice_inventory VALUES("35","20","172","3","5100.00","35.00","15300.00","15195.00","0");
INSERT INTO invoice_inventory VALUES("36","21","172","2","5100.00","35.00","10200.00","10130.00","0");
INSERT INTO invoice_inventory VALUES("37","22","143","2","9807.00","35.00","19614.00","19544.00","0");
INSERT INTO invoice_inventory VALUES("38","23","143","2","9807.00","35.00","19614.00","19544.00","0");
INSERT INTO invoice_inventory VALUES("39","24","179","4","537.36","100.00","2149.44","1749.44","0");
INSERT INTO invoice_inventory VALUES("40","25","150","6","11285.00","35.00","67710.00","67500.00","0");
INSERT INTO invoice_inventory VALUES("41","25","151","4","10480.00","35.00","41920.00","41780.00","0");
INSERT INTO invoice_inventory VALUES("42","26","175","4","8900.00","35.00","35600.00","35460.00","0");
INSERT INTO invoice_inventory VALUES("43","26","162","6","9250.00","35.00","55500.00","55290.00","0");
INSERT INTO invoice_inventory VALUES("44","27","143","2","9807.00","35.00","19614.00","19544.00","0");
INSERT INTO invoice_inventory VALUES("45","28","46","6","264.22","20.00","1585.32","1465.32","0");
INSERT INTO invoice_inventory VALUES("46","28","51","6","280.00","20.00","1680.00","1560.00","0");
INSERT INTO invoice_inventory VALUES("47","29","149","2","9673.00","35.00","19346.00","19276.00","0");
INSERT INTO invoice_inventory VALUES("48","30","149","1","9673.00","35.00","9673.00","9638.00","0");
INSERT INTO invoice_inventory VALUES("49","31","163","1","17196.00","35.00","17196.00","17161.00","0");
INSERT INTO invoice_inventory VALUES("50","31","168","1","41378.00","35.00","41378.00","41343.00","0");
INSERT INTO invoice_inventory VALUES("51","32","51","30","280.00","20.00","8400.00","7800.00","0");
INSERT INTO invoice_inventory VALUES("52","32","46","30","264.22","20.00","7926.60","7326.60","0");
INSERT INTO invoice_inventory VALUES("53","33","46","10","264.22","20.00","2642.20","2442.20","0");
INSERT INTO invoice_inventory VALUES("54","33","51","10","280.00","20.00","2800.00","2600.00","0");
INSERT INTO invoice_inventory VALUES("55","34","148","5","9673.00","35.00","48365.00","48190.00","0");
INSERT INTO invoice_inventory VALUES("56","34","150","5","11285.00","35.00","56425.00","56250.00","0");
INSERT INTO invoice_inventory VALUES("57","35","149","2","9673.00","35.00","19346.00","19276.00","0");
INSERT INTO invoice_inventory VALUES("58","35","147","2","4500.00","35.00","9000.00","8930.00","0");
INSERT INTO invoice_inventory VALUES("59","35","143","5","9807.00","35.00","49035.00","48860.00","0");
INSERT INTO invoice_inventory VALUES("60","35","153","2","20420.00","35.00","40840.00","40770.00","0");
INSERT INTO invoice_inventory VALUES("61","35","156","5","1400.00","35.00","7000.00","6825.00","0");
INSERT INTO invoice_inventory VALUES("62","35","161","2","8500.00","35.00","17000.00","16930.00","0");
INSERT INTO invoice_inventory VALUES("63","35","162","2","9250.00","35.00","18500.00","18430.00","0");
INSERT INTO invoice_inventory VALUES("64","35","164","3","17465.00","35.00","52395.00","52290.00","0");
INSERT INTO invoice_inventory VALUES("65","36","164","3","17465.00","35.00","52395.00","52290.00","0");
INSERT INTO invoice_inventory VALUES("66","36","155","5","4200.00","35.00","21000.00","20825.00","0");
INSERT INTO invoice_inventory VALUES("67","36","174","2","15900.00","35.00","31800.00","31730.00","0");
INSERT INTO invoice_inventory VALUES("68","36","177","2","13435.00","35.00","26870.00","26800.00","0");
INSERT INTO invoice_inventory VALUES("69","37","52","20","255.00","0.00","5100.00","5100.00","0");
INSERT INTO invoice_inventory VALUES("70","38","143","10","9807.00","35.00","98070.00","97720.00","0");
INSERT INTO invoice_inventory VALUES("71","38","164","3","17465.00","35.00","52395.00","52290.00","0");
INSERT INTO invoice_inventory VALUES("72","38","177","3","13435.00","35.00","40305.00","40200.00","0");
INSERT INTO invoice_inventory VALUES("73","38","168","4","41378.00","35.00","165512.00","165372.00","0");
INSERT INTO invoice_inventory VALUES("74","39","160","2","9673.00","35.00","19346.00","19276.00","0");
INSERT INTO invoice_inventory VALUES("75","40","143","2","9807.00","35.00","19614.00","19544.00","0");
INSERT INTO invoice_inventory VALUES("76","41","143","2","9807.00","35.00","19614.00","19544.00","0");
INSERT INTO invoice_inventory VALUES("77","42","164","1","17465.00","35.00","17465.00","17430.00","0");
INSERT INTO invoice_inventory VALUES("78","42","143","1","9807.00","35.00","9807.00","9772.00","0");
INSERT INTO invoice_inventory VALUES("79","42","178","2","9400.00","35.00","18800.00","18730.00","0");
INSERT INTO invoice_inventory VALUES("80","42","154","3","3900.00","35.00","11700.00","11595.00","0");
INSERT INTO invoice_inventory VALUES("81","42","156","13","1400.00","35.00","18200.00","17745.00","0");
INSERT INTO invoice_inventory VALUES("82","43","63","2","3300.00","0.00","6600.00","6600.00","0");
INSERT INTO invoice_inventory VALUES("83","43","64","2","3300.00","0.00","6600.00","6600.00","0");
INSERT INTO invoice_inventory VALUES("84","44","181","5","10950.00","20.00","54750.00","54650.00","0");
INSERT INTO invoice_inventory VALUES("85","45","44","12","375.10","20.00","4501.20","4261.20","0");
INSERT INTO invoice_inventory VALUES("86","45","45","12","276.09","20.00","3313.08","3073.08","0");
INSERT INTO invoice_inventory VALUES("87","46","184","2","10785.00","20.00","21570.00","21530.00","0");
INSERT INTO invoice_inventory VALUES("88","46","176","2","8900.00","35.00","17800.00","17730.00","0");
INSERT INTO invoice_inventory VALUES("89","46","165","1","9673.00","35.00","9673.00","9638.00","0");
INSERT INTO invoice_inventory VALUES("90","46","162","1","9250.00","35.00","9250.00","9215.00","0");
INSERT INTO invoice_inventory VALUES("91","47","184","2","10785.00","20.00","21570.00","21530.00","0");
INSERT INTO invoice_inventory VALUES("92","48","176","3","8900.00","35.00","26700.00","26595.00","0");
INSERT INTO invoice_inventory VALUES("93","49","46","20","264.22","20.00","5284.40","4884.40","0");
INSERT INTO invoice_inventory VALUES("94","49","51","20","280.00","20.00","5600.00","5200.00","0");
INSERT INTO invoice_inventory VALUES("95","50","182","1","32017.00","20.00","32017.00","31997.00","0");
INSERT INTO invoice_inventory VALUES("96","50","184","2","10785.00","20.00","21570.00","21530.00","0");
INSERT INTO invoice_inventory VALUES("97","50","188","3","13400.00","20.00","40200.00","40140.00","0");
INSERT INTO invoice_inventory VALUES("98","51","190","1","13443.00","20.00","13443.00","13423.00","0");
INSERT INTO invoice_inventory VALUES("99","51","191","1","17109.00","20.00","17109.00","17089.00","0");
INSERT INTO invoice_inventory VALUES("100","51","196","1","15276.00","20.00","15276.00","15256.00","0");
INSERT INTO invoice_inventory VALUES("101","51","192","1","19553.00","20.00","19553.00","19533.00","0");
INSERT INTO invoice_inventory VALUES("102","52","197","2","2500.00","0.00","5000.00","5000.00","0");
INSERT INTO invoice_inventory VALUES("103","52","198","2","2500.00","0.00","5000.00","5000.00","0");
INSERT INTO invoice_inventory VALUES("104","53","181","10","10950.00","20.00","109500.00","109300.00","0");
INSERT INTO invoice_inventory VALUES("105","54","154","5","3900.00","35.00","19500.00","19325.00","0");
INSERT INTO invoice_inventory VALUES("106","54","167","3","18271.00","35.00","54813.00","54708.00","0");
INSERT INTO invoice_inventory VALUES("107","55","181","2","10950.00","20.00","21900.00","21860.00","0");
INSERT INTO invoice_inventory VALUES("108","55","182","2","32017.00","20.00","64034.00","63994.00","0");
INSERT INTO invoice_inventory VALUES("109","55","188","1","13400.00","20.00","13400.00","13380.00","0");
INSERT INTO invoice_inventory VALUES("110","55","183","1","33606.00","20.00","33606.00","33586.00","0");
INSERT INTO invoice_inventory VALUES("111","56","179","1","537.36","100.00","537.36","437.36","0");
INSERT INTO invoice_inventory VALUES("112","58","179","1","537.36","100.00","537.36","437.36","0");
INSERT INTO invoice_inventory VALUES("113","59","48","1","5500.00","0.00","5500.00","5500.00","0");
INSERT INTO invoice_inventory VALUES("114","59","51","1","280.00","0.00","280.00","280.00","0");
INSERT INTO invoice_inventory VALUES("115","59","45","1","276.09","0.00","276.09","276.09","0");
INSERT INTO invoice_inventory VALUES("116","59","154","1","3900.00","0.00","3900.00","3900.00","0");
INSERT INTO invoice_inventory VALUES("117","60","181","10","10950.00","20.00","109500.00","109300.00","0");
INSERT INTO invoice_inventory VALUES("121","63","143","2","9807.00","35.00","19614.00","19544.00","0");
INSERT INTO invoice_inventory VALUES("122","64","153","4","20420.00","35.00","81680.00","81540.00","0");
INSERT INTO invoice_inventory VALUES("123","64","159","4","9673.00","35.00","38692.00","38552.00","0");
INSERT INTO invoice_inventory VALUES("124","64","163","3","17196.00","35.00","51588.00","51483.00","0");
INSERT INTO invoice_inventory VALUES("125","64","165","3","9673.00","35.00","29019.00","28914.00","0");
INSERT INTO invoice_inventory VALUES("131","70","182","1","32017.00","20.00","32017.00","31997.00","0");
INSERT INTO invoice_inventory VALUES("132","71","182","1","32017.00","20.00","32017.00","31997.00","0");
INSERT INTO invoice_inventory VALUES("133","72","191","1","17109.00","20.00","17109.00","17089.00","0");
INSERT INTO invoice_inventory VALUES("134","73","191","1","17109.00","20.00","17109.00","17089.00","0");
INSERT INTO invoice_inventory VALUES("135","74","161","2","8500.00","35.00","17000.00","16930.00","0");
INSERT INTO invoice_inventory VALUES("136","74","163","2","17196.00","35.00","34392.00","34322.00","0");
INSERT INTO invoice_inventory VALUES("137","75","160","3","9673.00","35.00","29019.00","28914.00","0");
INSERT INTO invoice_inventory VALUES("141","79","143","2","9807.00","35.00","19614.00","19544.00","0");
INSERT INTO invoice_inventory VALUES("142","80","143","2","9807.00","35.00","19614.00","19544.00","0");
INSERT INTO invoice_inventory VALUES("145","84","191","2","17109.00","20.00","34218.00","34178.00","0");
INSERT INTO invoice_inventory VALUES("146","91","184","1","10785.00","20.00","10785.00","10765.00","0");
INSERT INTO invoice_inventory VALUES("147","91","185","1","12770.00","20.00","12770.00","12750.00","0");
INSERT INTO invoice_inventory VALUES("148","93","181","3","10950.00","20.00","32850.00","32790.00","0");
INSERT INTO invoice_inventory VALUES("150","96","191","2","17109.00","20.00","34218.00","34178.00","0");
INSERT INTO invoice_inventory VALUES("151","97","48","1","5500.00","20.00","5500.00","5480.00","0");
INSERT INTO invoice_inventory VALUES("153","99","188","1","13400.00","20.00","13400.00","13380.00","0");
INSERT INTO invoice_inventory VALUES("154","99","191","1","17109.00","20.00","17109.00","17089.00","0");
INSERT INTO invoice_inventory VALUES("155","100","61","2","300.00","20.00","600.00","560.00","0");
INSERT INTO invoice_inventory VALUES("156","102","166","1","18271.00","35.00","18271.00","18236.00","0");
INSERT INTO invoice_inventory VALUES("157","103","181","1","10950.00","20.00","10950.00","10930.00","0");
INSERT INTO invoice_inventory VALUES("158","104","184","3","10785.00","20.00","32355.00","32295.00","0");
INSERT INTO invoice_inventory VALUES("159","104","185","5","12770.00","20.00","63850.00","63750.00","0");
INSERT INTO invoice_inventory VALUES("160","105","158","1","20960.00","35.00","20960.00","20925.00","0");
INSERT INTO invoice_inventory VALUES("161","106","46","3","264.22","20.00","792.66","732.66","0");
INSERT INTO invoice_inventory VALUES("162","106","51","3","280.00","20.00","840.00","780.00","0");
INSERT INTO invoice_inventory VALUES("163","107","42","6","664.29","20.00","3985.74","3865.74","0");
INSERT INTO invoice_inventory VALUES("164","108","188","1","13400.00","20.00","13400.00","13380.00","0");
INSERT INTO invoice_inventory VALUES("165","109","156","12","1400.00","35.00","16800.00","16380.00","0");
INSERT INTO invoice_inventory VALUES("166","109","162","6","9250.00","35.00","55500.00","55290.00","0");
INSERT INTO invoice_inventory VALUES("167","109","157","1","13972.00","35.00","13972.00","13937.00","0");
INSERT INTO invoice_inventory VALUES("168","109","163","1","17196.00","35.00","17196.00","17161.00","0");
INSERT INTO invoice_inventory VALUES("169","109","168","1","41378.00","35.00","41378.00","41343.00","0");
INSERT INTO invoice_inventory VALUES("170","110","46","25","264.22","20.00","6605.50","6105.50","0");
INSERT INTO invoice_inventory VALUES("171","110","51","25","280.00","20.00","7000.00","6500.00","0");
INSERT INTO invoice_inventory VALUES("172","111","189","1","39716.00","20.00","39716.00","39696.00","0");
INSERT INTO invoice_inventory VALUES("173","113","153","2","20420.00","35.00","40840.00","40770.00","0");
INSERT INTO invoice_inventory VALUES("174","114","181","3","10950.00","20.00","32850.00","32790.00","0");
INSERT INTO invoice_inventory VALUES("175","115","181","1","10950.00","20.00","10950.00","10930.00","0");
INSERT INTO invoice_inventory VALUES("176","116","181","1","10950.00","0.00","10950.00","10950.00","0");
INSERT INTO invoice_inventory VALUES("177","116","143","1","9807.00","35.00","9807.00","9772.00","0");





CREATE TABLE `invoice_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime DEFAULT NULL,
  `invoice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` text,
  `deliverer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_return_invoice1_idx` (`invoice_id`),
  KEY `fk_return_user1_idx` (`user_id`),
  KEY `fk_invoice_return_deliverer1_idx` (`deliverer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `invoice_return_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_return_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `return_reason_id` int(11) NOT NULL,
  `unit_price` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_return_has_inventory_inventory1_idx` (`inventory_id`),
  KEY `fk_product_return_inventory_invoice_return1_idx` (`invoice_return_id`),
  KEY `fk_invoice_return_inventory_return_reason1_idx` (`return_reason_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `invoice_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO invoice_status VALUES("1","Pending");
INSERT INTO invoice_status VALUES("2","Done");





CREATE TABLE `invoice_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO invoice_type VALUES("1","Normal");
INSERT INTO invoice_type VALUES("2","Retail");





CREATE TABLE `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `material_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) NOT NULL,
  `volume` decimal(10,3) DEFAULT NULL,
  `grn_material_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_material_stock_material1_idx` (`material_id`),
  KEY `fk_material_stock_grn_material1_idx` (`grn_material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

INSERT INTO module VALUES("1","User");
INSERT INTO module VALUES("2","Privilege");
INSERT INTO module VALUES("3","Designation");
INSERT INTO module VALUES("4","Target");
INSERT INTO module VALUES("5","Category");
INSERT INTO module VALUES("6","Product");
INSERT INTO module VALUES("7","Batch");
INSERT INTO module VALUES("8","Material");
INSERT INTO module VALUES("11","Supplier");
INSERT INTO module VALUES("12","Customer");
INSERT INTO module VALUES("13","Route");
INSERT INTO module VALUES("14","ProductPO");
INSERT INTO module VALUES("15","MaterialPO");
INSERT INTO module VALUES("16","ProductGRN");
INSERT INTO module VALUES("17","MaterialGRN");
INSERT INTO module VALUES("18","Invoice");
INSERT INTO module VALUES("19","Payment");
INSERT INTO module VALUES("20","Return");
INSERT INTO module VALUES("21","Deliverer");
INSERT INTO module VALUES("22","DelivererInventory");
INSERT INTO module VALUES("24","Inventory");
INSERT INTO module VALUES("25","Cheque");
INSERT INTO module VALUES("26","Role");





CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `payment_method_id` int(11) NOT NULL,
  `payment_status_id` int(11) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_payment_payment_method1_idx` (`payment_method_id`),
  KEY `fk_invoice_payment_user1_idx` (`user_id`),
  KEY `fk_payment_payment_status1_idx` (`payment_status_id`),
  KEY `fk_payment_payment_type1_idx` (`payment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO payment VALUES("1","1","2","2","2020-02-27 07:16:35","2089.80","1","1");
INSERT INTO payment VALUES("2","2","2","2","2020-02-28 16:04:41","100000.00","1","1");
INSERT INTO payment VALUES("3","3","2","2","2020-02-28 16:19:09","108425.00","1","1");
INSERT INTO payment VALUES("4","4","2","2","2020-02-28 16:25:58","39744.90","1","1");
INSERT INTO payment VALUES("6","6","2","2","2020-02-28 17:34:43","6375.00","1","1");
INSERT INTO payment VALUES("7","7","2","2","2020-03-02 16:22:35","11474.00","1","1");
INSERT INTO payment VALUES("9","9","2","2","2020-03-03 10:39:52","80153.20","1","1");
INSERT INTO payment VALUES("10","10","2","2","2020-03-04 09:57:57","209175.90","1","1");
INSERT INTO payment VALUES("11","11","2","2","2020-03-04 10:32:30","239004.54","1","1");
INSERT INTO payment VALUES("12","12","2","2","2020-03-15 13:30:37","32498.00","1","1");





CREATE TABLE `payment_cheque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `cheque_id` int(11) NOT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_payment_has_cheque_cheque1_idx` (`cheque_id`),
  KEY `fk_invoice_payment_has_cheque_invoice_payment1_idx` (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO payment_cheque VALUES("1","1","1","2089.80");
INSERT INTO payment_cheque VALUES("2","2","2","100000.00");
INSERT INTO payment_cheque VALUES("3","3","3","108425.00");
INSERT INTO payment_cheque VALUES("4","4","4","39744.90");
INSERT INTO payment_cheque VALUES("6","6","6","6375.00");
INSERT INTO payment_cheque VALUES("7","7","7","11474.00");
INSERT INTO payment_cheque VALUES("9","9","9","80153.20");
INSERT INTO payment_cheque VALUES("10","10","10","209175.90");
INSERT INTO payment_cheque VALUES("11","11","11","239004.54");
INSERT INTO payment_cheque VALUES("12","12","12","32498.00");





CREATE TABLE `payment_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_invoice_payment1_idx` (`payment_id`),
  KEY `fk_payment_invoice_invoice1_idx` (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

INSERT INTO payment_invoice VALUES("1","1","28","2089.80");
INSERT INTO payment_invoice VALUES("2","2","38","208424.97");
INSERT INTO payment_invoice VALUES("3","3","38","108424.97");
INSERT INTO payment_invoice VALUES("4","4","18","33777.90");
INSERT INTO payment_invoice VALUES("5","4","21","5967.00");
INSERT INTO payment_invoice VALUES("7","6","12","6374.55");
INSERT INTO payment_invoice VALUES("8","7","23","11474.19");
INSERT INTO payment_invoice VALUES("10","9","34","61302.15");
INSERT INTO payment_invoice VALUES("11","9","37","5100.00");
INSERT INTO payment_invoice VALUES("12","9","4","12373.81");
INSERT INTO payment_invoice VALUES("13","9","6","17649.80");
INSERT INTO payment_invoice VALUES("14","10","6","16272.56");
INSERT INTO payment_invoice VALUES("15","10","5","20560.00");
INSERT INTO payment_invoice VALUES("16","10","36","46606.95");
INSERT INTO payment_invoice VALUES("17","10","35","124672.86");
INSERT INTO payment_invoice VALUES("18","11","50","67526.64");
INSERT INTO payment_invoice VALUES("19","11","51","52304.80");
INSERT INTO payment_invoice VALUES("20","11","52","10000.00");
INSERT INTO payment_invoice VALUES("21","11","53","65700.00");
INSERT INTO payment_invoice VALUES("22","11","54","43473.10");
INSERT INTO payment_invoice VALUES("23","12","44","39420.00");





CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO payment_method VALUES("1","Cash");
INSERT INTO payment_method VALUES("2","Cheque");





CREATE TABLE `payment_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO payment_status VALUES("1","Pending");
INSERT INTO payment_status VALUES("2","Done");
INSERT INTO payment_status VALUES("3","Canceled");





CREATE TABLE `payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO payment_type VALUES("1","Invoice Payment");
INSERT INTO payment_type VALUES("2","Customer Payment");





CREATE TABLE `privilege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `view` tinyint(1) DEFAULT NULL,
  `ins` tinyint(1) DEFAULT NULL,
  `upd` tinyint(1) DEFAULT NULL,
  `del` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_role_has_module_module1_idx` (`module_id`),
  KEY `fk_role_has_module_role1_idx` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;

INSERT INTO privilege VALUES("1","1","1","1","1","1","1");
INSERT INTO privilege VALUES("2","1","2","1","1","1","1");
INSERT INTO privilege VALUES("3","1","3","1","1","1","1");
INSERT INTO privilege VALUES("4","1","4","1","1","1","1");
INSERT INTO privilege VALUES("5","1","5","1","1","1","1");
INSERT INTO privilege VALUES("6","1","6","1","1","1","1");
INSERT INTO privilege VALUES("7","1","7","1","1","1","1");
INSERT INTO privilege VALUES("8","1","8","1","1","1","1");
INSERT INTO privilege VALUES("11","1","11","1","1","1","1");
INSERT INTO privilege VALUES("12","1","12","1","1","1","1");
INSERT INTO privilege VALUES("13","1","13","1","1","1","1");
INSERT INTO privilege VALUES("14","1","14","1","1","1","1");
INSERT INTO privilege VALUES("15","1","15","1","1","1","1");
INSERT INTO privilege VALUES("16","1","16","1","1","1","1");
INSERT INTO privilege VALUES("17","1","17","1","1","1","1");
INSERT INTO privilege VALUES("18","1","18","1","1","1","1");
INSERT INTO privilege VALUES("19","1","19","1","1","1","1");
INSERT INTO privilege VALUES("20","1","20","1","1","1","1");
INSERT INTO privilege VALUES("21","1","21","1","1","1","1");
INSERT INTO privilege VALUES("22","1","22","1","1","1","1");
INSERT INTO privilege VALUES("24","1","24","1","1","1","1");
INSERT INTO privilege VALUES("25","1","25","1","1","1","1");
INSERT INTO privilege VALUES("26","1","26","1","1","1","1");
INSERT INTO privilege VALUES("27","2","1","0","0","0","0");
INSERT INTO privilege VALUES("28","2","2","0","0","0","0");
INSERT INTO privilege VALUES("29","2","3","0","0","0","0");
INSERT INTO privilege VALUES("30","2","4","0","0","0","0");
INSERT INTO privilege VALUES("31","2","5","0","0","0","0");
INSERT INTO privilege VALUES("32","2","6","0","0","0","0");
INSERT INTO privilege VALUES("33","2","7","0","0","0","0");
INSERT INTO privilege VALUES("34","2","8","0","0","0","0");
INSERT INTO privilege VALUES("37","2","11","0","0","0","0");
INSERT INTO privilege VALUES("38","2","12","0","0","0","0");
INSERT INTO privilege VALUES("39","2","13","0","0","0","0");
INSERT INTO privilege VALUES("40","2","14","0","0","0","0");
INSERT INTO privilege VALUES("41","2","15","0","0","0","0");
INSERT INTO privilege VALUES("42","2","16","0","0","0","0");
INSERT INTO privilege VALUES("43","2","17","0","0","0","0");
INSERT INTO privilege VALUES("44","2","18","1","1","1","0");
INSERT INTO privilege VALUES("45","2","19","1","1","1","0");
INSERT INTO privilege VALUES("46","2","20","1","1","1","0");
INSERT INTO privilege VALUES("47","2","21","0","0","0","0");
INSERT INTO privilege VALUES("48","2","22","0","0","0","0");
INSERT INTO privilege VALUES("50","2","24","1","0","0","0");
INSERT INTO privilege VALUES("51","2","25","0","0","0","0");
INSERT INTO privilege VALUES("52","2","26","0","0","0","0");
INSERT INTO privilege VALUES("53","4","1","0","0","0","0");
INSERT INTO privilege VALUES("54","4","2","1","1","1","1");
INSERT INTO privilege VALUES("55","4","3","0","0","0","0");
INSERT INTO privilege VALUES("56","4","4","0","0","0","0");
INSERT INTO privilege VALUES("57","4","5","0","0","0","0");
INSERT INTO privilege VALUES("58","4","6","0","0","0","0");
INSERT INTO privilege VALUES("59","4","7","0","0","0","0");
INSERT INTO privilege VALUES("60","4","8","0","0","0","0");
INSERT INTO privilege VALUES("63","4","11","0","0","0","0");
INSERT INTO privilege VALUES("64","4","12","0","0","0","0");
INSERT INTO privilege VALUES("65","4","13","0","0","0","0");
INSERT INTO privilege VALUES("66","4","14","0","0","0","0");
INSERT INTO privilege VALUES("67","4","15","0","0","0","0");
INSERT INTO privilege VALUES("68","4","16","0","0","0","0");
INSERT INTO privilege VALUES("69","4","17","0","0","0","0");
INSERT INTO privilege VALUES("70","4","18","0","0","0","0");
INSERT INTO privilege VALUES("71","4","19","0","0","0","0");
INSERT INTO privilege VALUES("72","4","20","0","0","0","0");
INSERT INTO privilege VALUES("73","4","21","0","0","0","0");
INSERT INTO privilege VALUES("74","4","22","0","0","0","0");
INSERT INTO privilege VALUES("76","4","24","0","0","0","0");
INSERT INTO privilege VALUES("77","4","25","0","0","0","0");
INSERT INTO privilege VALUES("78","4","26","0","0","0","0");
INSERT INTO privilege VALUES("79","5","1","0","0","0","0");
INSERT INTO privilege VALUES("80","5","2","0","0","0","0");
INSERT INTO privilege VALUES("81","5","3","0","0","0","0");
INSERT INTO privilege VALUES("82","5","4","0","0","0","0");
INSERT INTO privilege VALUES("83","5","5","0","0","0","0");
INSERT INTO privilege VALUES("84","5","6","0","0","0","0");
INSERT INTO privilege VALUES("85","5","7","0","0","0","0");
INSERT INTO privilege VALUES("86","5","8","0","0","0","0");
INSERT INTO privilege VALUES("89","5","11","0","0","0","0");
INSERT INTO privilege VALUES("90","5","12","0","0","0","0");
INSERT INTO privilege VALUES("91","5","13","0","0","0","0");
INSERT INTO privilege VALUES("92","5","14","0","0","0","0");
INSERT INTO privilege VALUES("93","5","15","0","0","0","0");
INSERT INTO privilege VALUES("94","5","16","0","0","0","0");
INSERT INTO privilege VALUES("95","5","17","0","0","0","0");
INSERT INTO privilege VALUES("96","5","18","1","1","1","1");
INSERT INTO privilege VALUES("97","5","19","0","0","0","0");
INSERT INTO privilege VALUES("98","5","20","0","0","0","0");
INSERT INTO privilege VALUES("99","5","21","0","0","0","0");
INSERT INTO privilege VALUES("100","5","22","0","0","0","0");
INSERT INTO privilege VALUES("102","5","24","0","0","0","0");
INSERT INTO privilege VALUES("103","5","25","0","0","0","0");
INSERT INTO privilege VALUES("104","5","26","0","0","0","0");
INSERT INTO privilege VALUES("105","8","1","1","1","1","1");
INSERT INTO privilege VALUES("106","8","2","1","1","1","1");
INSERT INTO privilege VALUES("107","8","3","1","1","1","1");
INSERT INTO privilege VALUES("108","8","4","1","1","1","1");
INSERT INTO privilege VALUES("109","8","5","1","1","1","1");
INSERT INTO privilege VALUES("110","8","6","1","1","1","1");
INSERT INTO privilege VALUES("111","8","7","1","1","1","1");
INSERT INTO privilege VALUES("112","8","8","1","1","1","1");
INSERT INTO privilege VALUES("115","8","11","1","1","1","1");
INSERT INTO privilege VALUES("116","8","12","1","1","1","1");
INSERT INTO privilege VALUES("117","8","13","1","1","1","1");
INSERT INTO privilege VALUES("118","8","14","1","1","1","1");
INSERT INTO privilege VALUES("119","8","15","1","1","1","1");
INSERT INTO privilege VALUES("120","8","16","1","1","1","1");
INSERT INTO privilege VALUES("121","8","17","1","1","1","1");
INSERT INTO privilege VALUES("122","8","18","0","1","1","1");
INSERT INTO privilege VALUES("123","8","19","1","1","1","1");
INSERT INTO privilege VALUES("124","8","20","1","1","1","1");
INSERT INTO privilege VALUES("125","8","21","1","1","1","1");
INSERT INTO privilege VALUES("126","8","22","1","1","1","1");
INSERT INTO privilege VALUES("128","8","24","1","1","1","1");
INSERT INTO privilege VALUES("129","8","25","1","1","1","1");
INSERT INTO privilege VALUES("130","8","26","1","1","1","1");





CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `roq` int(11) DEFAULT NULL,
  `max_qty` int(11) DEFAULT NULL,
  `min_qty` int(11) DEFAULT NULL,
  `brand` varchar(500) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `vehicle_application` varchar(500) DEFAULT NULL,
  `unit_model` int(11) DEFAULT NULL,
  `bar_code` varchar(500) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `discount_limit` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_product_category_idx` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8;

INSERT INTO product VALUES("1","RLL1510","1","","","","SRMT","CROSS HOLDER TUSKER","","1","","","30");
INSERT INTO product VALUES("2","RTB815TWTRCP","1","","","","SRMT","K.P.U. STD CHROME WITH TW & TR BEARINGS TATA (16.00MM)","","1","","","30");
INSERT INTO product VALUES("3","RTB871TWTRCP","1","","","","SRMT","K.P.U.O/S-1 WITH TW & TR TATA 407 TURBO (25.1MM)","","1","","","30");
INSERT INTO product VALUES("4","RTB922TWTRCP","1","","","","SRMT","K.P.U. STD. WITH TW & TR BEARINGS TATA 909 (32.00M","","1","","","30");
INSERT INTO product VALUES("5","RLL103TWCP","1","","","","SRMT","K.P.U STD CHROME WITH TW LEY CARGO 909 (36.41MM)","","1","","","30");
INSERT INTO product VALUES("6","RLL104TWCP","1","","","","SRMT","K.P.U. O/S-1 CHROME WITH LEY CARGO 909 (36.48MM)","","1","","","30");
INSERT INTO product VALUES("7","RLL110TWCP","1","","","","SRMT","K.P.U.STD CHROME WITH TW (31.26MM) LEY STAG BUS","","1","","","30");
INSERT INTO product VALUES("8","RLL113TWCP","1","","","","SRMT","K.P.U.O/S-1 CHROME WITH TW LEY CARGO 709 (31.34MM)","","1","","","30");
INSERT INTO product VALUES("9","RTB923TWTRCP","1","","","","SRMT","K.P.U. O/S-1. WITH TW & TR BEARINGS TATA 909 (32.1MM)","","1","","","30");
INSERT INTO product VALUES("10","RLL546N","1","","","","SRMT","K.P.U. O/S-7 GREASE LUBRICATE","","1","","","30");
INSERT INTO product VALUES("11","RLL545N","1","","","","SRMT","K.P.U. O/S-6 GREASE LUBRICATE","","1","","","30");
INSERT INTO product VALUES("12","RLL148","1","","","","SRMT","SPRING PIN FRONT & REAR LEYLAND VIKING","","1","","","30");
INSERT INTO product VALUES("13","RTB816TWTRCP","1","","","","SRMT","K.P.U. O/S-1 CHROME WITH TR BEARINGS TATA (16.20MM","","1","","","30");
INSERT INTO product VALUES("14","CATC0051","1","","","","ATC","C/BEARING LUBRICATING PIPE (OUTER)","","1","","","10");
INSERT INTO product VALUES("15","CATC0106","1","","","","ATC","C/FROCK BRACKET 370/400M","","1","","","10");
INSERT INTO product VALUES("16","CATC0107","1","","","","ATC","C/FROCK BRACKET2214/2516M","","1","","","10");
INSERT INTO product VALUES("17","CATC0108","1","","","","ATC","C/FROCK PIN (PLAN TYPE)","","1","","","10");
INSERT INTO product VALUES("18","CATC0112","1","","","","ATC","C/FORK BALL PIN 2214/2516M EURO-II","","1","","","10");
INSERT INTO product VALUES("19","CATC0123","1","","","","ATC","C/ROD SHOKET CAMP 2214/EURO-II","","1","","","10");
INSERT INTO product VALUES("20","SPATC1514","1","","","","ATC","SPEED CHNG LEVR HOUS  EU -II(STAIGHT )","","1","","","10");
INSERT INTO product VALUES("21","FATC3019","1","","","","ATC","TIE ROD SOCKET CAMP TUSKER(RIGHT SIDE)","","1","","","10");
INSERT INTO product VALUES("22","RATC3502","1","","","","ATC","REAR HUB DIST PIECE TUSKER MKII","","1","","","10");
INSERT INTO product VALUES("23","CHATC6529","1","","","","ATC","TAPPRT COVER CAP HINO ENG (NYLONE)","","1","","","10");
INSERT INTO product VALUES("24","CHATC6577","1","","","","ATC","ROCKER LEAVER SET SCREW WITH NUT HINO","","1","","","10");
INSERT INTO product VALUES("25","EATC7089","1","","","","ATC","ALTERNATOR LINC BOLT ASSY HINO 2214","","1","","","10");
INSERT INTO product VALUES("26","EATC7090","1","","","","ATC","ALTERNATOR LINC BOLT ASSY3416/3516","","1","","","10");
INSERT INTO product VALUES("27","SCATC7521","1","","","","ATC","EXHAUST  MENIFOLD MOUTH SUPER COMET","","1","","","10");
INSERT INTO product VALUES("28","CATC0024","1","","","","ATC","CL. WITHDRAWEL  PLT W/ LINER  4F","","1","","","10");
INSERT INTO product VALUES("29","GATC0518","1","","","","ATC","GEAR BOX  MAIN DRIVE RETAINER 370/400M","","1","","","10");
INSERT INTO product VALUES("30","ZATC1005","1","","","","ATC","SELECTOR SHAFT LEAVER (OLD MODLE)","","1","","","10");
INSERT INTO product VALUES("31","ZATC1033","1","","","","ATC","GEAR BOXTRACTION BAR ROD","","1","","","10");
INSERT INTO product VALUES("32","ZATC1035","1","","","","ATC","TRACTION BAR BALL JOINT SET(SET OF 2- PCS)  INNER ","","1","","","10");
INSERT INTO product VALUES("33","ZATC1036","1","","","","ATC","REACTION TUBE BALL JOINT SET(SET OF 2 PCS)(OUTER )","","1","","","10");
INSERT INTO product VALUES("34","WATC4567","1","","","","ATC","WATER RAIL  DIFFLECTOR  PLATE 402/412M (STRAIGHT )","","1","","","10");
INSERT INTO product VALUES("35","CHATC6594","1","","","","ATC","TURBO OIL PIPE (SPRING TYPE) (STEEL)  ","","1","","","10");
INSERT INTO product VALUES("36","CATC0034","1","","","","ATC","CL.BEARING HOUSING2214/2516M.EURO-I","","1","","","10");
INSERT INTO product VALUES("37","CATC0038","1","","","","ATC","CL.BEARING COVER 370/400/2214/2516M. EURO I/II","","1","","","10");
INSERT INTO product VALUES("38","CATC0037","1","","","","ATC","CL.BEARING HOUSING CIRCLIP 370/400/2214.EURO I/II","","1","","","10");
INSERT INTO product VALUES("39","OIATC8005","1","","","","ATC","TANK JELLY W/NUT & WASHER - TUSKER ","","1","","","10");
INSERT INTO product VALUES("40","SAM100","1","","","","LEY PARTS ","F4000100","","1","","","20");
INSERT INTO product VALUES("41","SAM700","1","","","","LEY PARTS ","FHJ00700","","1","","","20");
INSERT INTO product VALUES("42","SAM540","1","","","","LEY PARTS ","P3101540","","1","","","20");
INSERT INTO product VALUES("43","SAM000","1","","","","LEY PARTS ","X4001000","","1","","","20");
INSERT INTO product VALUES("44","SAM700-1","1","","","","LEY PARTS ","F4000700","","1","","","20");
INSERT INTO product VALUES("45","SAM800","1","","","","LEY PARTS ","F4000800","","1","","","20");
INSERT INTO product VALUES("46","SAM400","1","","","","LEY PARTS ","F4000400","","1","","","20");
INSERT INTO product VALUES("47","SAM-5100","1","","","","LEY PARTS ","F8835100","","1","","","20");
INSERT INTO product VALUES("48","SAM-5000","1","","","","LEY PARTS ","F7A05000","","1","","","20");
INSERT INTO product VALUES("49","SAM1200","1","","","","LEY PARTS ","F7B01200","","1","","","20");
INSERT INTO product VALUES("50","SAM6251","1","","","","LEY PARTS ","P0996251","","1","","","20");
INSERT INTO product VALUES("51","SAM500","1","","","","LEY PARTS ","F4000500","","1","","","20");
INSERT INTO product VALUES("52","PAP-1302","1","","","","PRAKASH ","TAIL LAMP LENS 4CHAMBER LEY: N/M  ","","1","","","0");
INSERT INTO product VALUES("53","PAP-1352","1","","","","PRAKASH ","SIDE LAMP ASSY LEY:COMMET  ","","1","","","0");
INSERT INTO product VALUES("54","PAP-1355(LH)","1","","","","PRAKASH ","SIDE LAMP ASSY LEY.E-COMET  ","","1","","","0");
INSERT INTO product VALUES("55","PAP-1355(RH)","1","","","","PRAKASH ","SIDE LAMP ASSY LEY.E-COMET  ","","1","","","0");
INSERT INTO product VALUES("56","PAP-1401","1","","","","PRAKASH ","SIDE LAMP LENS LEY:COMET  ","","1","","","0");
INSERT INTO product VALUES("57","PAP-1402","1","","","","PRAKASH ","FRONT INIDCATOR  LEY:CARGO","","1","","","0");
INSERT INTO product VALUES("58","PAP-1403","1","","","","PRAKASH ","FRONT INDICATOR G45 LENS ","","1","","","0");
INSERT INTO product VALUES("59","PAP-1451(LH)","1","","","","PRAKASH ","HEAD LAMP ASSY LEY:CARGO  ","","1","","","0");
INSERT INTO product VALUES("60","PAP-1451(RH)","1","","","","PRAKASH ","HEAD LAMP ASSY LEY:CARGO  ","","1","","","0");
INSERT INTO product VALUES("61","PAP-1604(RH)","1","","","","PRAKASH ","SIDE LAMP ASSY MAHI:BOLERO  ","","1","","","0");
INSERT INTO product VALUES("62","PAP-1701(R)","1","","","","PRAKASH ","HEAD LAMP ASSY (ROUND FULL KIT ) LEYLAND  ","","1","","","0");
INSERT INTO product VALUES("63","PAP-1715(LH)","1","","","","PRAKASH ","HEAD LAMP ASSY MAHI:MAXIMO  ","","1","","","0");
INSERT INTO product VALUES("64","PAP-1715(RH)","1","","","","PRAKASH ","HEAD LAMP ASSY MAHI:MAXIMO  W/O MOTOR ","","1","","","0");
INSERT INTO product VALUES("65","PAP-2270(MULITY COLOR)","1","","","","PRAKASH ","HEAD LAMP ASSY MAHI:MAXIMO  W/O MOTOR ","","1","","","0");
INSERT INTO product VALUES("66","PAP-2601N(RH)","1","","","","PRAKASH ","TAIL LAMP MAHI:MAXIMO  ","","1","","","0");
INSERT INTO product VALUES("67","PAP-2601N(LH)","1","","","","PRAKASH ","TAIL LAMP MAHI:MAXIMO  ","","1","","","0");
INSERT INTO product VALUES("68","PAP-1201(LH)","1","","","","PRAKASH ","HEAD LAMP ASSY TATA 1312/1313/1210","","1","","","0");
INSERT INTO product VALUES("69","PAP-1016","1","","","","PRAKASH ","4 CHAMBER SUPER ACE/MAXXIMO/PIYAJIO","","1","","","0");
INSERT INTO product VALUES("70","PAP-1253","1","","","","PRAKASH ","4 CHAMBER COMPLETE ASSY ","","1","","","0");
INSERT INTO product VALUES("71","M0900A","1","","","","SWISS ","STARTER RELAY 4ST 24V","","1","","","10");
INSERT INTO product VALUES("72","M12904","1","","","","SWISS ","12V HONE  RELAY 5 PIN","","1","","","10");
INSERT INTO product VALUES("73","M12904A","1","","","","SWISS ","HONE RELAY 24V TELCO (F","","1","","","10");
INSERT INTO product VALUES("74","M12906A","1","","","","SWISS ","HONE RELAY 24V-40AMP (F","","1","","","10");
INSERT INTO product VALUES("75","M21100C","1","","","","SWISS ","ALT  CARBON BRUSH M&M CHAMPION","","1","","","10");
INSERT INTO product VALUES("76","M21215R","1","","","","SWISS ","ALT REG IC 207 TATA SUMO NEW MODEL (3","","1","","","10");
INSERT INTO product VALUES("77","M21506R","1","","","","SWISS ","ALT REG TC 24 LEY HINO 24 IC  ","","1","","","10");
INSERT INTO product VALUES("78","M21513S","1","","","","SWISS ","ALT STATOR TATA 12V  LP1510/LP01313/","","1","","","10");
INSERT INTO product VALUES("79","M21515S","1","","","","SWISS ","ALT STATOR TATA 12V LP1312/LP1313T/608/HINO","","1","","","10");
INSERT INTO product VALUES("80","M21518T","1","","","","SWISS ","LEY HINO ALT ROTOR","","1","","","10");
INSERT INTO product VALUES("81","M21708RP","1","","","","SWISS ","ALT REC PLT ASHOK LEY COMET TR","","1","","","10");
INSERT INTO product VALUES("82","M21709RP","1","","","","SWISS ","ALT REC PLT ASHOK LEY COMET TR","","1","","","10");
INSERT INTO product VALUES("83","M21710RP","1","","","","SWISS ","ALT REC PLT ASHOK LEY COMET","","1","","","10");
INSERT INTO product VALUES("84","M31503C","1","","","","SWISS ","SELF CARBON BRUSH TATA 1210 /1313/909","","1","","","10");
INSERT INTO product VALUES("85","M31506F","1","","","","SWISS ","F.COIL TATA 713/1210/1612/2213","","1","","","10");
INSERT INTO product VALUES("86","M31507D","1","","","","SWISS ","MOTOR BENDIX TC 9TH-SHORT","","1","","","10");
INSERT INTO product VALUES("87","M31510B","1","","","","SWISS ","C.BRUSH HOLD ASSY. FOR STARTER","","1","","","10");
INSERT INTO product VALUES("88","M31511F","1","","","","SWISS ","F.COIL TC 6BT ENG (L-26258081)","","1","","","10");
INSERT INTO product VALUES("89","M31701C","1","","","","SWISS ","SELF CARBON BRUSH 370/400 LEY","","1","","","10");
INSERT INTO product VALUES("90","M32202B","1","","","","SWISS ","CARBON BRUSH HOLD SAY.MAHINDRA BOLLERO","","1","","","10");
INSERT INTO product VALUES("91","M31502F","1","","","","SWISS ","FIELD COIL TATA CUMMINS 6BT 24V / LEYLAND HINO 24V","","1","","","10");
INSERT INTO product VALUES("92","0302AB0060N","1","","","","M & M","OVER RING LINER","","1","","","10");
INSERT INTO product VALUES("93","0312BAU00490N","1","","","","M & M","MAIN BEARING KIT","","1","","","10");
INSERT INTO product VALUES("94","0401BA3530N","1","","","","M & M","BUSH SILENT BLOCK","","1","","","10");
INSERT INTO product VALUES("95","0502DA1620N","1","","","","M & M","DIFF BEVEL FORGED SIDE","","1","","","10");
INSERT INTO product VALUES("96","0602BAB03210N","1","","","","M & M","CYL WHEEL MAJOR KIT","","1","","","10");
INSERT INTO product VALUES("97","0602BAB04110N","1","","","","M & M","SHOE RETURN SPRING","","1","","","10");
INSERT INTO product VALUES("98","0606AA1101N","1","","","","M & M","MASTER CYL MAJOR KIT","","1","","","10");
INSERT INTO product VALUES("99","0802CA0381N","1","","","","M & M","MASTER CYL MINOR KIT","","1","","","10");
INSERT INTO product VALUES("100","0802CA1441N","1","","","","M & M","CLUTCH SLAVE CYL MINOR KIT","","1","","","10");
INSERT INTO product VALUES("101","0802CAA03600N","1","","","","M & M","CLUTCH MASTER CYL MINOR KIT","","1","","","10");
INSERT INTO product VALUES("102","1402AAA06121N","1","","","","M & M","REC ARAPNGMENT","","1","","","10");
INSERT INTO product VALUES("103","7932580561","1","","","","M & M","THRUST WASHER LOWER","","1","","","10");
INSERT INTO product VALUES("104","28417","1","","","","M & M","WIPER LINKAGE KIT","","1","","","10");
INSERT INTO product VALUES("105","69259","1","","","","M & M","WIPER MOTOR LINK TYPE(OPT)","","1","","","10");
INSERT INTO product VALUES("106","77591","1","","","","M & M","RUBBER INSULATOR EXHAUST","","1","","","10");
INSERT INTO product VALUES("107","84092","1","","","","M & M","5 BEARING FRONT & CENTER","","1","","","10");
INSERT INTO product VALUES("108","97964","1","","","","M & M","BUSHING","","1","","","10");
INSERT INTO product VALUES("109","99806","1","","","","M & M","TIE ROD SHOKET ASSY RHM 18","","1","","","10");
INSERT INTO product VALUES("110","0304FAU00030N","1","","","","M & M","FAN RADIATOR","","1","","","10");
INSERT INTO product VALUES("111","S1331","1","","","","HD SPICDER ","DIFF CASE BOLT","","1","","","10");
INSERT INTO product VALUES("112","S162","1","","","","HD SPICDER ","CLUTCH SPRING PLATE","","1","","","10");
INSERT INTO product VALUES("113","S219","1","","","","HD SPICDER ","BUSH SELECTOR L/L","","1","","","10");
INSERT INTO product VALUES("114","S328","1","","","","HD SPICDER ","BOLT & NUT-IDLER GEA","","1","","","10");
INSERT INTO product VALUES("115","S347","1","","","","HD SPICDER ","JAW END PIN & NUT . ROUND","","1","","","10");
INSERT INTO product VALUES("116","S347A","1","","","","HD SPICDER ","JAW END PIN & NUT . SQUA","","1","","","10");
INSERT INTO product VALUES("117","S364","1","","","","HD SPICDER ","ADJUSTING PLATE-INJ PUM","","1","","","10");
INSERT INTO product VALUES("118","S519","1","","","","HD SPICDER ","THRUST WASHER KIT 6X4","","1","","","10");
INSERT INTO product VALUES("119","S720","1","","","","HD SPICDER ","SPEEDO GEAR","","1","","","10");
INSERT INTO product VALUES("120","S796","1","","","","HD SPICDER ","INLET PACKING-TURBO","","1","","","10");
INSERT INTO product VALUES("121","S831","1","","","","HD SPICDER ","TH. WASHER SET-SX39","","1","","","10");
INSERT INTO product VALUES("122","S928","1","","","","HD SPICDER ","DIESEAL FILTER TOP","","1","","","10");
INSERT INTO product VALUES("123","S930","1","","","","HD SPICDER ","PACKING AXEL SHAFT - TUSK","","1","","","10");
INSERT INTO product VALUES("124","S937","1","","","","HD SPICDER ","SHIM THICK-RR HUB TUSK","","1","","","10");
INSERT INTO product VALUES("125","S956","1","","","","HD SPICDER ","NUT-G/B MAIN SHAFT-BIG","","1","","","10");
INSERT INTO product VALUES("126","S967","1","","","","HD SPICDER ","SHACKLE WASHER-2MM","","1","","","10");
INSERT INTO product VALUES("127","LG126A","1","","","","LION GASKET ","REAR AXLE GASKET 85/M H ER","","1","","","10");
INSERT INTO product VALUES("128","LG132","1","","","","LION GASKET ","DIFF COVER GSKT 2416 OE TYP","","1","","","10");
INSERT INTO product VALUES("129","LG196A","1","","","","LION GASKET ","G.BOX KIT TATA 709 H","","1","","","10");
INSERT INTO product VALUES("130","LG197A","1","","","","LION GASKET ","AIR CAMP F/G SET 709 77MM","","1","","","10");
INSERT INTO product VALUES("131","LG211","1","","","","LION GASKET ","REAR AXEL GSKT 370H","","1","","","10");
INSERT INTO product VALUES("132","LG2110","1","","","","LION GASKET ","REAR AXEL GSKT TC H","","1","","","10");
INSERT INTO product VALUES("133","LG2118","1","","","","LION GASKET ","TURBO GSKT TC","","1","","","10");
INSERT INTO product VALUES("134","LG2135","1","","","","LION GASKET ","V. COVER TAPPRT 1613","","1","","","10");
INSERT INTO product VALUES("135","LG2143","1","","","","LION GASKET ","TURBO GSKT 709 II","","1","","","10");
INSERT INTO product VALUES("136","LG2166","1","","","","LION GASKET ","EX. MANIFOLD GSKT SET HINO","","1","","","10");
INSERT INTO product VALUES("137","LG218B","1","","","","LION GASKET ","FRONT HUB 1.5MM EP","","1","","","10");
INSERT INTO product VALUES("138","LG2211","1","","","","LION GASKET ","V.COVER TAPPET MARSHAL MDI","","1","","","10");
INSERT INTO product VALUES("139","LG240","1","","","","LION GASKET ","REAR AXEL GSKT MII EP","","1","","","10");
INSERT INTO product VALUES("140","LG994","1","","","","LION GASKET ","V.COVER TAPPET TATA-SUMO","","1","","","10");
INSERT INTO product VALUES("141","LG995","1","","","","LION GASKET ","OIL PAN CHAMBER SUMO RCC","","1","","","10");
INSERT INTO product VALUES("142","SAM500","1","0","0","0","3","LINE FILTER","","1","","","0");
INSERT INTO product VALUES("143","EXM-171-KIT-WRB","1","","","","MASCAS ","CL.SET TATA ACE / MAGIC WITH RELEASE BEARING","","","","","1");
INSERT INTO product VALUES("144","EXM-1701-0","1","","","","MASCAS ","CL.DISC TATA ACE /MAGIC","","","","","1");
INSERT INTO product VALUES("145","EXM-1700-0","1","","","","MASCAS ","DIA COVER ASSY TATA ACE /MAGIC","","","","","1");
INSERT INTO product VALUES("146","EXM-1604","1","","","","MASCAS ","CL.DISC MAHENDRA MAXIM AF","","","","","1");
INSERT INTO product VALUES("147","EXM-160-0","1","","","","MASCAS ","DIA COVER ASSY SUZUKI CAR 800","","","","","1");
INSERT INTO product VALUES("148","EXM-2420-0","1","","","","MASCAS ","DIA COVER ASSY 240 DIA MAHENDRA BOLLERO","","","","","1");
INSERT INTO product VALUES("149","EXM-357-0","1","","","","MASCAS ","CL DISC LEY 14\" TAURUS 2516 AF THICK","","","","","1");
INSERT INTO product VALUES("150","EXM-357-0-M","1","","","","MASCAS ","CL.DISC LEY 14\" TAURUS 2516 ASB THICK WHITE","","","","","1");
INSERT INTO product VALUES("151","EXM-358-0","1","","","","MASCAS ","CL.DISC LEY 14\" HINO 110/130 PS ENG AF THIN ","","","","","1");
INSERT INTO product VALUES("152","EXM-358-0-M","1","","","","MASCAS ","CL.DISC LEY 14\" HINO 110/130 PS ENG ASB  THIN WHIT","","","","","1");
INSERT INTO product VALUES("153","EXM-356-0","1","","","","MASCAS ","CL.DISC 14\" CHEETA /COMET/TUSKER TIPPER 6 FAN TYPE","","","","","1");
INSERT INTO product VALUES("154","EXLK-3520-0","1","","","","MASCAS ","CL. FINGER KIT TUSKAR ,2214-4 LEVER","","","","","1");
INSERT INTO product VALUES("155","EXSK-3520-0","1","","","","MASCAS ","CL.SPRING KIT TUSKAR,2214 -4 LEVER ","","","","","1");
INSERT INTO product VALUES("156","EXM-3520-14-R","1","","","","MASCAS ","WIDRAW PLATE W/RIVER  -4 FINGER ","","","","","1");
INSERT INTO product VALUES("157","EXM-394-0","1","","","","MASCAS ","CL.DISC LEY 15\" 2516/3516/4018 TURBO AF THICK ","","","","","1");
INSERT INTO product VALUES("158","EXM-383-0","1","","","","MASCAS ","CL.DISC LEY 15\" TAURUS 2516 TIPPER 1.5 SPLINE FAN TYPE","","","","","1");
INSERT INTO product VALUES("159","EXM-312-0-44","1","","","","MASCAS ","CL.DISC 310 DIA  LEY CARGO AF LONG HUB 44MM","","","","","1");
INSERT INTO product VALUES("160","EXM-312-0-36","1","","","","MASCAS ","CL.DISC 310 DIA  LEY CARGO AF SHORT HUB 36MM","","","","","1");
INSERT INTO product VALUES("161","EXM-311-0-HL-M","1","","","","MASCAS ","CL.DISC 310 DIA GB 40 TATA 1312/1512 TC HIGH LOAD ASB","","","","","1");
INSERT INTO product VALUES("162","EXM-311-0-HL","1","","","","MASCAS ","CL.DISC 310 DIA GB 40 TATA 1312,2213 AF","","","","","1");
INSERT INTO product VALUES("163","EXM-331-0","1","","","","MASCAS ","CL.DISC 330 TATA 1613 TURBO / 1510 TC-6 PDDLE ","","","","","1");
INSERT INTO product VALUES("164","EXM-3101-0","1","","","","MASCAS ","DIA COVER ASSY TATA 1210/1312/1513 -GB 40","","","","","1");
INSERT INTO product VALUES("165","EXM-312-0","1","","","","MASCAS ","CL.DISC 310 DIA LEY CARGO AF","","","","","1");
INSERT INTO product VALUES("166","EXM-3103-0","1","","","","MASCAS ","DIA COVER ASSY 310 DIA LEY CARGO","","","","","1");
INSERT INTO product VALUES("167","EXM-354-0","1","","","","MASCAS ","CL.DISC 352 TATA 2515/2516/3515 FAN TYPE (1.75 SPLINE GB 60)","","","","","1");
INSERT INTO product VALUES("168","EXM-352-0-WBC","1","","","","MASCAS ","CONVENTIONAL COVER ASSY TATA 2516/2516/3515 (GB60 W BAERING )","","","","","1");
INSERT INTO product VALUES("169","EXM-353-0","1","","","","MASCAS ","CL.DISC 352 TATA 2515/2516/3515 FAN TYPE (1.50 SPLINE GB 50)","","","","","1");
INSERT INTO product VALUES("170","EXM-3303-0","1","","","","MASCAS ","CONVENTIONAL COVER ASSY TATA 1613 TURBO/1510 TC/TIPPER MODEL","","","","","1");
INSERT INTO product VALUES("171","EXM-332-0","1","","","","MASCAS ","CL.DISC TATA 1613 TC/1510 TC /TIPPER MODELS / 1616 BSIIII AF","","","","","1");
INSERT INTO product VALUES("172","EXLK-352-0","1","","","","MASCAS ","CL. FINGER KIT TATA 2515/2516/3615 GB50/60 WITH BEARING ","","","","","1");
INSERT INTO product VALUES("173","EXM-2151-0","1","","","","MASCAS ","CL.DISC LEY DOST AF","","","","","1");
INSERT INTO product VALUES("174","EXM-2151-KIT","1","","","","MASCAS ","CL.SET LEY DOST","","","","","1");
INSERT INTO product VALUES("175","EXM-281-0","1","","","","MASCAS ","CL.DISC GB 27 TATA 609 / 709 AF","","","","","1");
INSERT INTO product VALUES("176","EXM-2806-0","1","","","","MASCAS ","CL. DISC GB 27 TATA 609 / 709 AF - 4MM","","","","","1");
INSERT INTO product VALUES("177","EXM-2802-0","1","","","","MASCAS ","DIA COVER ASSY TATA 709 TURBO","","","","","1");
INSERT INTO product VALUES("178","EXM-2400-0","1","","","","MASCAS ","DIA COVER ASSY GB 18 TATA 407 TURBO","","","","","1");
INSERT INTO product VALUES("179","EXM-3520-0","1","","","","MASCAS ","CONVENTIONAL COVER ASSY LEY TUSKER 14\" ","","","","","1");
INSERT INTO product VALUES("180","EXM-3100-0","1","","","","MASCAS ","CONVENTIONAL COVER ASSY  TATA 1210/1312/1510","","","","","1");
INSERT INTO product VALUES("181","EXM-3520-28","1","","","","MASCAS ","BACK PLATE  14\" LEY  TUSKER  2214 - 4 LEVER","","","","","1");
INSERT INTO product VALUES("182","EXM-3520-28","1","","","","MASCAS ","FACE PLATE 14\" LEY  TUSKER 2214 - 4 LEVER ","","","","","1");
INSERT INTO product VALUES("183","EXM -3520-14","1","","","","MASCAS ","WIDARW PALTE  LEYLAND TUSKER  2214 - 4 LEVER ","","","","","1");
INSERT INTO product VALUES("184","EXM-3102-0","1","","","","MASCAS ","DIA COVER ASSY 310 GB 40 TATA ","","","","","1");
INSERT INTO product VALUES("185","EXM-3521-28","1","","","","MASCAS ","FACE PLATE 14\" LEY  HINO - 3 LEVER ","","","","","1");
INSERT INTO product VALUES("186","EXM-3800-0","1","","","","MASCAS ","CONVENTIONAL COVER ASSY LEY 2516/3516/4018","","","","","1");
INSERT INTO product VALUES("187","EXM-2420-0","1","","","","MASCAS ","DIA COVER ASSY 240 DIA MAHENDRA BOLLERO","","","","","1");
INSERT INTO product VALUES("188","SM3&4STD-FF-WBR","1","","","","MASCAS","BRAKE LINING ASB FF COMET  7\' ( 177.8) REAR WITH BRASS RIVET ","","","","","0");
INSERT INTO product VALUES("189","SM3&4STD-AF-WBR","1","","","","MASCAS","BRAKE LINING AF COMET  7\' ( 177.8) REAR WITH BRASS RIVET ","","","","","0");
INSERT INTO product VALUES("190","8220202080 -ALU","1","","","","BANCO","TATA ACE RADIATOR ","","1","","","0");
INSERT INTO product VALUES("191","8220512070-ALU","1","","","","BANCO","207 DI RADIATOR ","","1","","","0");
INSERT INTO product VALUES("192","8220542080-ALU","1","","","","BANCO","TATA 1613  TURBO RADIATOR ","","1","","","0");
INSERT INTO product VALUES("193","8231112070- ALU","1","","","","BANCO","MARUTI CAR 800 RADIATOR ","","1","","","0");
INSERT INTO product VALUES("194","8231132080-ALU","1","","","","BANCO","MARUTI ALTO LX/VX/WAGON RADIATOR","","1","","","0");
INSERT INTO product VALUES("195","8360732080-ALU","1","","","","BANCO","LEYLAND HINO  RADITOR","","1","","","0");
INSERT INTO product VALUES("196","8360752080-ALU","1","","","","BANCO","LEYLAND HINO TURBO RADIATOR","","1","","","0");
INSERT INTO product VALUES("197","8580122080-ALU","1","","","","BANCO","MAHENDRA MAXXIMO ","","1","","","0");
INSERT INTO product VALUES("198","8220632080-ALU","1","","","","BANCO","TATA 4018  RADIATOR ","","1","","","0");
INSERT INTO product VALUES("199","8220552100-RT","1","","","","BANCO","RADIATOR TANK TATA 2516 -PLASTIC ","","1","","","0");
INSERT INTO product VALUES("200","8360702100-RTM ","1","","","","BANCO","RADIATOR TANK LEYLAND 6DTI METAL TANK","","1","","","0");
INSERT INTO product VALUES("201","8360732100-RTP","1","","","","BANCO","RADIATOR TANK LEYLAND 2214 -PLASTIC ","","1","","","0");
INSERT INTO product VALUES("202","8360742100-RTM ","1","","","","BANCO","RADIATOR TANK LEYLAND 3518/4018 H6 DTI /ETI BSII","","1","","","0");
INSERT INTO product VALUES("203","8220632010-ALU ","1","","","","BANCO","RADITAOR TANK 4018 PLASTIC ","","1","","","0");
INSERT INTO product VALUES("204","8580332070-ALU ","1","","","","BANCO","RADIATOR BOLLERO MAXI TRUCK ","","1","","","0");
INSERT INTO product VALUES("205","8220632010-CAC","1","","","","BANCO","RADIATOR COOLER  TATA  4018 ","","1","","","0");
INSERT INTO product VALUES("206","PAP-1220 LH","1","10","50","30","ASSY","TATA 207 HEAD LIGHT ASSY (GLASS TYPE)","","1","","","0");
INSERT INTO product VALUES("207","PAP-1220 RH","1","","","","ASSY","TATA 207  HEAD LIGHT ASSY (GLASS TYPE)","","1","","","0");





CREATE TABLE `product_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` varchar(45) DEFAULT NULL,
  `note` text,
  `user_id` int(11) NOT NULL,
  `deliverer_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `return_invoice` varchar(500) DEFAULT NULL,
  `return_number` varchar(200) DEFAULT NULL,
  `approved_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_return_user1_idx` (`user_id`),
  KEY `fk_product_return_deliverer1_idx` (`deliverer_id`),
  KEY `fk_product_return_customer1_idx` (`customer_id`),
  KEY `fk_product_return_invoice1_idx` (`invoice_id`),
  KEY `approved_by` (`approved_by`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO product_return VALUES("1","2020-02-25 03:14:07","TWICE INVOICE TO SAMUDAYA MOTORS","1","1","0","0","","11550","11550");
INSERT INTO product_return VALUES("2","2020-02-26 06:06:00","WRONGLY INVOICE ","1","1","0","0","","2","2");
INSERT INTO product_return VALUES("3","2020-03-03 09:08:18","
19102500002-     wp026101-10521/=   6828/=                         wp026102- 17947/=  11665/=  18504/=
","10","3","0","0","","568","568");
INSERT INTO product_return VALUES("4","2020-03-16 10:46:24","710","1","1","0","0","","2","2");
INSERT INTO product_return VALUES("5","2020-03-18 12:04:30","MISSING TWO ITEMS IN STOCK","1","1","0","0","","OF20020600045","0");





CREATE TABLE `product_return_batch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_return_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `return_reason_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `unit_price` decimal(12,2) DEFAULT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `additional_discount` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_product_return_has_batch_batch1_idx` (`batch_id`),
  KEY `fk_product_return_has_batch_product_return1_idx` (`product_return_id`),
  KEY `fk_product_return_batch_return_reason1_idx` (`return_reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO product_return_batch VALUES("1","1","165","1","3","17465.00","35","10");
INSERT INTO product_return_batch VALUES("2","2","181","1","2","537.36","100","0");
INSERT INTO product_return_batch VALUES("3","3","185","1","45","0.00","0","0");
INSERT INTO product_return_batch VALUES("4","4","166","1","2","9673.00","35","0");
INSERT INTO product_return_batch VALUES("5","5","186","2","2","10785.00","20","0");





CREATE TABLE `product_return_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_return_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `return_amount` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_product_return_has_invoice_invoice1_idx` (`invoice_id`),
  KEY `fk_product_return_has_invoice_product_return1_idx` (`product_return_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO product_return_invoice VALUES("1","1","36","30651.08");
INSERT INTO product_return_invoice VALUES("2","2","24","0");
INSERT INTO product_return_invoice VALUES("3","5","46","17256");





CREATE TABLE `production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text,
  `production_status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_production_production_status1_idx` (`production_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `production_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `production_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `volume` decimal(10,3) DEFAULT NULL,
  `wastage` decimal(10,3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recipie_material_material1_idx` (`material_id`),
  KEY `fk_recipie_material_production1_idx` (`production_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `production_material_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `production_id` int(11) NOT NULL,
  `material_stock_id` int(11) NOT NULL,
  `volume` decimal(10,3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_production_has_material_stock_material_stock1_idx` (`material_stock_id`),
  KEY `fk_production_has_material_stock_production1_idx` (`production_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `production_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `production_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_production_has_product_production1_idx` (`production_id`),
  KEY `fk_production_product_batch1_idx` (`batch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `production_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO production_status VALUES("1","Pending");
INSERT INTO production_status VALUES("2","Done");
INSERT INTO production_status VALUES("3","Canceled");





CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_order_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase_order_status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchase_order_supplier1_idx` (`supplier_id`),
  KEY `fk_purchase_order_purchase_order_type1_idx` (`purchase_order_type_id`),
  KEY `fk_purchase_order_user1_idx` (`user_id`),
  KEY `fk_purchase_order_purchase_order_status1_idx` (`purchase_order_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `purchase_order_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `volume` decimal(10,3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchase_order_has_material_material1_idx` (`material_id`),
  KEY `fk_purchase_order_has_material_purchase_order1_idx` (`purchase_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `purchase_order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchase_order_has_product_product1_idx` (`product_id`),
  KEY `fk_purchase_order_has_product_purchase_order1_idx` (`purchase_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `purchase_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO purchase_order_status VALUES("1","Pending");
INSERT INTO purchase_order_status VALUES("2","Done");





CREATE TABLE `purchase_order_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO purchase_order_type VALUES("1","Product");
INSERT INTO purchase_order_type VALUES("2","Material");





CREATE TABLE `return_reason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO return_reason VALUES("1","Customer Return");
INSERT INTO return_reason VALUES("2","Re Stock");
INSERT INTO return_reason VALUES("3","Damage");
INSERT INTO return_reason VALUES("4","Expire");





CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO role VALUES("1","Manager");
INSERT INTO role VALUES("2","Rep");
INSERT INTO role VALUES("3","Driver");
INSERT INTO role VALUES("4","Data Entry Operetor");
INSERT INTO role VALUES("5","Admin");
INSERT INTO role VALUES("7","Office Assistance");
INSERT INTO role VALUES("8","Director");
INSERT INTO role VALUES("9","Sales Manager");





CREATE TABLE `route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO route VALUES("1","Test Town One");





CREATE TABLE `stock_adj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `current_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO stock_adj VALUES("1","142","1","1","2020-02-18 08:58:58");
INSERT INTO stock_adj VALUES("2","142","-1","1","2020-02-18 08:59:22");





CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO supplier VALUES("1","Supplier One","Address","c.inomal@gmail.com","0712963614");
INSERT INTO supplier VALUES("2","MACAS AUTOMOTIVE","PLOT NO 117 , DLF INDUSTRIAL AREA,PHASE -1 FARIDABAD  121003 HARYANA INDIA","sales@macasautomotive.co","0777191784");
INSERT INTO supplier VALUES("3","BANCO PRODUCTS (INDIA) LIMITED","BIL-391 410 NEAR BHAILI RAILWAY STATION , PADRA ROAD, DIST VADODARA,GUJARAT STATE INDIA","visahl@bancoindia.com","0342261364");
INSERT INTO supplier VALUES("4","SOUTH ASIAN AUTOMOBILE PVT LTD","NO 332/29  LESSLISS LAND MUNAGAMA HORANA","southasianam@gmail.com","0342261364");





CREATE TABLE `target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `target_month_id` int(11) NOT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_target_user1_idx` (`user_id`),
  KEY `fk_target_target_month1_idx` (`target_month_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `target_month` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO unit VALUES("1","General");





CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation_id` int(11) NOT NULL,
  `user_status_id` int(11) NOT NULL,
  `name` varchar(400) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` text,
  `dob` date DEFAULT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `nic` varchar(400) DEFAULT NULL,
  `address` varchar(400) DEFAULT NULL,
  `image` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_designation1_idx` (`designation_id`),
  KEY `fk_user_user_status1_idx` (`user_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO user VALUES("1","1","1","K.O.V Kumarasinghe","admin","$2y$10$ZDUyNDYzYjYzM2VjZTNmMOkH2c0VKNI5.N43XGEQCXPHwSqInqNTW","1982-01-12","0777 191784","southasianam@gmail.com","823361270V","No 332/29 Lessliss Land , Munagma , Horana ","5c769c878d73b.jpg");
INSERT INTO user VALUES("5","4","1","Pradeepika Chandanie","pradeepika","$2y$10$ZDUyNDYzYjYzM2VjZTNmMOkgf4jyhXFLn7OyW6EQjkgj9k6t2iCoS","1982-07-27","0115883810","pradeepika@system.com","827094196V","No 209 /U1 Tea Projects , Iliba , Horana","5c88859c504ca.jpg");
INSERT INTO user VALUES("7","5","1","RASHMI SURANGA KALUTHANTHRI","sales_rep","$2y$10$ZDUyNDYzYjYzM2VjZTNmMO9tW3jmXKUDZGiopbw0B3PJzmDJ/2n66","1979-01-14","0703963615","test@test.com","790143523V","Address","5e2e931cdbecb.jpg");
INSERT INTO user VALUES("8","2","1","W W PRIYNATHA UDAYA BANDARA","priyantha","$2y$10$ZDUyNDYzYjYzM2VjZTNmMO9tW3jmXKUDZGiopbw0B3PJzmDJ/2n66","1980-02-28","0715400415","test@test.com","800591856V","address","5e2e958d9858e.jpg");
INSERT INTO user VALUES("9","2","1","T A NIROSHAN ASAKGA","asanga","$2y$10$ZDUyNDYzYjYzM2VjZTNmMO9tW3jmXKUDZGiopbw0B3PJzmDJ/2n66","1977-11-07","0712963614","test@test.com","773121290","address","");
INSERT INTO user VALUES("10","2","1","M SHIRAN THUSHARA","shiran","$2y$10$ZDUyNDYzYjYzM2VjZTNmMO9tW3jmXKUDZGiopbw0B3PJzmDJ/2n66","1981-05-18","0703763619","test@test.com","811393193V","address","5e2e965546b04.jpg");
INSERT INTO user VALUES("11","1","1","OFFICE","office","$2y$10$ZDUyNDYzYjYzM2VjZTNmMObY7p/DRefUTpGeiuPOJVohK135FH5di","1990-11-14","0714698713","test@test.com","903190205V","address","5e2e96d382e9c.jpg");





CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_has_role_role1_idx` (`role_id`),
  KEY `fk_user_role_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO user_role VALUES("1","1","1");
INSERT INTO user_role VALUES("5","7","5");
INSERT INTO user_role VALUES("7","9","7");
INSERT INTO user_role VALUES("8","2","8");
INSERT INTO user_role VALUES("9","2","9");
INSERT INTO user_role VALUES("10","2","10");
INSERT INTO user_role VALUES("11","1","11");





CREATE TABLE `user_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO user_status VALUES("1","Active");
INSERT INTO user_status VALUES("2","Deactive");





CREATE TABLE `written_cheque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cheque_number` varchar(200) NOT NULL,
  `amount` float NOT NULL,
  `bank_name` varchar(500) NOT NULL,
  `cheque_date` date NOT NULL,
  `feed_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




