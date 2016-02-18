CREATE TABLE `git_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(45) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
