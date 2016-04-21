CREATE TABLE `email_listing_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `facility_code` varchar(45) DEFAULT NULL,
  `sub_county` varchar(45) DEFAULT NULL,
  `county` varchar(45) DEFAULT NULL,
  `usertype` varchar(45) DEFAULT NULL,
  `date_uploaded` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
