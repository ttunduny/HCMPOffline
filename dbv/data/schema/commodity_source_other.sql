CREATE TABLE `commodity_source_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `source_name_UNIQUE` (`source_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1