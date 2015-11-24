CREATE TABLE `drug_store_totals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `expiry_date` varchar(30) NOT NULL,
  `total_balance` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_drug_store_totals_commodity_id` (`commodity_id`),
  KEY `idx_drug_store_totals_district_id` (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1