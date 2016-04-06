CREATE TABLE `git_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash_value` varchar(150) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1