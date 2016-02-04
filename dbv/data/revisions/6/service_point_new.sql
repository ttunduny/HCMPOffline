ALTER TABLE `hcmp_rtk`.`service_point_stocks` 
ADD COLUMN `price` VARCHAR(15) NULL DEFAULT 0 COMMENT '' AFTER `expiry_date`;
