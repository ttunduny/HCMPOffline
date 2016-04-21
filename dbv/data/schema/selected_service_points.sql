CREATE TABLE `selected_service_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` varchar(45) DEFAULT NULL,
  `service_point_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `added_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1