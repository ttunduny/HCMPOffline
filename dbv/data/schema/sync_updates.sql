CREATE TABLE `sync_updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_sync` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1