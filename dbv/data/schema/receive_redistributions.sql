CREATE TABLE `receive_redistributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` varchar(45) DEFAULT NULL,
  `sending_facility` varchar(45) DEFAULT NULL,
  `commodity_id` varchar(45) DEFAULT NULL,
  `batch_no` varchar(45) DEFAULT NULL,
  `manufacturer` varchar(45) DEFAULT NULL,
  `quantity_received` int(11) DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
