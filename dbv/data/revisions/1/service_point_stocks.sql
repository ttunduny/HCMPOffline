ALTER TABLE `hcmp_rtk`.`service_point_stocks` 
ADD COLUMN `status` INT NULL AFTER `expiry_date`;

ALTER TABLE `hcmp_rtk`.`service_point_stocks` 
CHANGE COLUMN `status` `status` INT(11) NULL DEFAULT 1 ;
