CREATE TABLE `hcmp_rtk`.`facility_rollout_status` (
  `id` INT NOT NULL COMMENT '',
  `status` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '');
INSERT INTO `hcmp_rtk`.`facility_rollout_status` (`id`, `status`) VALUES ('0', 'Not Rolled Out');
INSERT INTO `hcmp_rtk`.`facility_rollout_status` (`id`, `status`) VALUES ('1', 'Rolled Out Online');
INSERT INTO `hcmp_rtk`.`facility_rollout_status` (`id`, `status`) VALUES ('2', 'Rolled Out Offline');