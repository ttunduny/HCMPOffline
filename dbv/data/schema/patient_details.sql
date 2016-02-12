CREATE TABLE `patient_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` int(11) NOT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `home_address` varchar(65) NOT NULL,
  `work_address` varchar(65) DEFAULT NULL,
  `patient_number` varchar(65) NOT NULL,
  `system_patient_number` varchar(45) DEFAULT NULL,
  `facility_code` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1