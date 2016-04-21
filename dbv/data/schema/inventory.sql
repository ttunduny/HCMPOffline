CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(45) DEFAULT NULL,
  `county` int(11) DEFAULT NULL,
  `subcounty` int(11) DEFAULT NULL,
  `facility_code` int(11) DEFAULT NULL,
  `added_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1