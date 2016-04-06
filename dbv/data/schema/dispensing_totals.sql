CREATE TABLE `dispensing_totals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` varchar(45) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `isdeleted` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1