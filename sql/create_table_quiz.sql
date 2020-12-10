CREATE TABLE `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice1` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice2` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice3` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice4` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ans` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci