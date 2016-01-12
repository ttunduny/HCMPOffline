CREATE TABLE `facility_stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `batch_no` varchar(20) NOT NULL,
  `manufacture` varchar(50) NOT NULL,
  `initial_quantity` int(11) NOT NULL,
  `current_balance` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `source_of_commodity` int(11) NOT NULL,
  `status` int(5) DEFAULT '1',
  `expiry_date` date NOT NULL,
  `other_source_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_facility_stocks_facility_code` (`facility_code`),
  KEY `idx_facility_stocks_commodity_id` (`commodity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1