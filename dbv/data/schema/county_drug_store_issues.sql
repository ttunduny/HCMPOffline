CREATE TABLE `county_drug_store_issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `county_id` int(11) NOT NULL,
  `commodity_id` int(5) NOT NULL,
  `s11_No` varchar(50) NOT NULL,
  `batch_no` int(20) NOT NULL,
  `expiry_date` varchar(100) NOT NULL,
  `balance_as_of` int(11) NOT NULL,
  `adjustmentpve` int(11) NOT NULL,
  `adjustmentnve` int(11) NOT NULL,
  `qty_issued` int(11) NOT NULL,
  `date_issued` date NOT NULL,
  `issued_to` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `issued_by` int(12) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1