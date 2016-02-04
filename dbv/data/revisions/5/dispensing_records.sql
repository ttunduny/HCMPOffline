ALTER TABLE `hcmp_rtk`.`dispensing_records` 
ADD COLUMN `facility_code` VARCHAR(45) NULL COMMENT '' AFTER `patient_id`;