CREATE TABLE `hcmp_rtk`.`dispensing_totals` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `facility_code` VARCHAR(45) NULL COMMENT '',
  `patient_id` INT NULL COMMENT '',
  `date_created` DATETIME NULL COMMENT '',
  `total` INT NULL COMMENT '',
  `isdeleted` INT NULL DEFAULT 1 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '');