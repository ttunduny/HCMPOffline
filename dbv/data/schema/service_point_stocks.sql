CREATE TABLE `service_point_stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) DEFAULT NULL,
  `service_point_id` int(11) DEFAULT NULL,
  `commodity_id` int(11) DEFAULT NULL,
  `current_balance` int(11) DEFAULT NULL,
  `batch_no` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1