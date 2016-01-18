CREATE TABLE `dispensing_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(15) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `units_dispensed` int(11) DEFAULT NULL,
  `unit_price` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1