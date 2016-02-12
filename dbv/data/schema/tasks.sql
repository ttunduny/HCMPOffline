CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_description` varchar(150) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL,
  `date_due` varchar(20) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1