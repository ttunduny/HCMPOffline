CREATE TABLE `patient_issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `commodity_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `issue_type_id` int(11) DEFAULT NULL,
  `date_issued` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1