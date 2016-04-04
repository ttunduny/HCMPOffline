CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_member_id` int(11) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1