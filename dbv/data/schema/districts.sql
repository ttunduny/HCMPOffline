CREATE TABLE `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district` varchar(50) NOT NULL,
  `county` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_districts_county` (`county`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1