CREATE TABLE `hcmp_rtk`.`service_point_stock_physical` (
  `id` INT(11) NOT NULL,
  `facility_id` INT(11) NOT NULL,
  `service_point_id` INT(11) NOT NULL,
  `commodity_id` INT(11) NOT NULL,
  `batch_no` VARCHAR(45) NOT NULL,
  `type_of_adjustment` VARCHAR(45) NOT NULL,
  `count_difference` INT(11) NOT NULL,
  `reason` VARCHAR(200) NOT NULL,
  `date_of_recording` DATETIME NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`));
