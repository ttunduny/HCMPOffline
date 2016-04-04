CREATE TABLE `recepients` (
  `recepient_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone_no` varchar(30) NOT NULL,
  `sms_status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT '1',
  `district_id` int(11) DEFAULT NULL,
  `county_id` int(11) DEFAULT NULL,
  `fault_index` int(11) DEFAULT '0',
  PRIMARY KEY (`recepient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1