CREATE TABLE `county_drug_store_totals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `county_id` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `expiry_date` varchar(30) NOT NULL,
  `total_balance` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1