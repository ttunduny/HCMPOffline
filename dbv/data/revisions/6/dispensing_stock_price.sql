CREATE TABLE `hcmp_rtk`.`dispensing_stock_prices` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `facility_id` INT NOT NULL COMMENT '',
  `commodity_id` INT NOT NULL COMMENT '',
  `commodity_name` VARCHAR(200) NOT NULL COMMENT '',
  `price` INT NOT NULL COMMENT '',
  `price_per` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '');
