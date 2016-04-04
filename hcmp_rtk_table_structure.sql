-- MySQL dump 10.13  Distrib 5.6.27, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: hcmp_rtk
-- ------------------------------------------------------
-- Server version	5.6.27-0ubuntu1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `access_level`
--

DROP TABLE IF EXISTS `access_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  `user_indicator` varchar(50) NOT NULL,
  `moh_permissions` int(11) NOT NULL,
  `district_permissions` int(11) NOT NULL,
  `county_permissions` int(11) NOT NULL,
  `facilityadmin_permissions` int(11) NOT NULL,
  `facility_permissions` int(11) NOT NULL,
  `super_permissions` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_member_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_member_id` int(11) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `commodities`
--

DROP TABLE IF EXISTS `commodities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `commodity_code` varchar(20) DEFAULT NULL,
  `commodity_name` text CHARACTER SET utf8,
  `unit_size` varchar(100) DEFAULT NULL,
  `unit_cost` varchar(100) DEFAULT NULL,
  `commodity_sub_category_id` int(11) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_commodity_units` int(11) NOT NULL,
  `commodity_source_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '1',
  `tracer_item` int(11) NOT NULL DEFAULT '0',
  `commodity_division` int(11) NOT NULL DEFAULT '1',
  `commodity_strength` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3543 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `commodity_category`
--

DROP TABLE IF EXISTS `commodity_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` text,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `commodity_division_details`
--

DROP TABLE IF EXISTS `commodity_division_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_division_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `division_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `commodity_source`
--

DROP TABLE IF EXISTS `commodity_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(100) NOT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `commodity_source_other`
--

DROP TABLE IF EXISTS `commodity_source_other`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_source_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `source_name_UNIQUE` (`source_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `commodity_source_other_prices`
--

DROP TABLE IF EXISTS `commodity_source_other_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_source_other_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `batch_no` varchar(20) NOT NULL,
  `other_source_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `commodity_sub_category`
--

DROP TABLE IF EXISTS `commodity_sub_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_sub_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `commodity_category_id` int(11) DEFAULT NULL,
  `sub_category_name` text,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `counties`
--

DROP TABLE IF EXISTS `counties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `counties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `county` varchar(30) NOT NULL,
  `kenya_map_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `county_drug_store_issues`
--

DROP TABLE IF EXISTS `county_drug_store_issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `county_drug_store_issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `county_id` int(11) NOT NULL,
  `commodity_id` int(5) NOT NULL,
  `s11_No` varchar(50) NOT NULL,
  `batch_no` int(20) NOT NULL,
  `expiry_date` varchar(100) NOT NULL,
  `balance_as_of` int(11) NOT NULL,
  `adjustmentpve` int(11) NOT NULL,
  `adjustmentnve` int(11) NOT NULL,
  `qty_issued` int(11) NOT NULL,
  `date_issued` date NOT NULL,
  `issued_to` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `issued_by` int(12) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `county_drug_store_totals`
--

DROP TABLE IF EXISTS `county_drug_store_totals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `county_drug_store_totals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `county_id` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `expiry_date` varchar(30) NOT NULL,
  `total_balance` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `county_drug_store_transaction_table`
--

DROP TABLE IF EXISTS `county_drug_store_transaction_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `county_drug_store_transaction_table` (
  `id` int(11) NOT NULL,
  `facility_code` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `opening_balance` int(11) NOT NULL DEFAULT '0',
  `total_receipts` int(11) NOT NULL DEFAULT '0',
  `total_issues` int(11) NOT NULL DEFAULT '0',
  `closing_stock` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `days_out_of_stock` int(11) NOT NULL DEFAULT '0',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `adjustmentpve` int(11) NOT NULL DEFAULT '0',
  `adjustmentnve` int(11) NOT NULL DEFAULT '0',
  `losses` int(11) NOT NULL DEFAULT '0',
  `quantity_ordered` int(11) NOT NULL DEFAULT '0',
  `comment` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dispensing_records`
--

DROP TABLE IF EXISTS `dispensing_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dispensing_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `facility_code` varchar(45) DEFAULT NULL,
  `commodity_id` int(11) NOT NULL,
  `units_dispensed` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dispensing_totals`
--

DROP TABLE IF EXISTS `dispensing_totals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dispensing_totals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` varchar(45) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `isdeleted` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district` varchar(50) NOT NULL,
  `county` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_districts_county` (`county`)
) ENGINE=MyISAM AUTO_INCREMENT=303 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drug_commodity_map`
--

DROP TABLE IF EXISTS `drug_commodity_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drug_commodity_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `old_name` varchar(100) NOT NULL,
  `old_code` varchar(50) NOT NULL,
  `old_total_units` int(11) NOT NULL,
  `old_id` int(11) NOT NULL,
  `new_name` varchar(100) NOT NULL,
  `new_code` varchar(50) NOT NULL,
  `new_total_units` int(11) NOT NULL,
  `new_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `as_of` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `unit_size_` varchar(50) NOT NULL,
  `new_price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drug_store_issues`
--

DROP TABLE IF EXISTS `drug_store_issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drug_store_issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(5) NOT NULL,
  `district_id` int(11) NOT NULL,
  `commodity_id` int(5) NOT NULL,
  `s11_No` varchar(50) NOT NULL,
  `batch_no` int(20) NOT NULL,
  `expiry_date` varchar(100) NOT NULL,
  `balance_as_of` int(11) NOT NULL,
  `adjustmentpve` int(11) NOT NULL,
  `adjustmentnve` int(11) NOT NULL,
  `qty_issued` int(11) NOT NULL,
  `date_issued` date NOT NULL,
  `issued_to` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `issued_by` int(12) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_drug_store_issues_facility_code` (`facility_code`),
  KEY `idx_drug_store_issues_district_id` (`district_id`),
  KEY `idx_drug_store_issues_commodity_id` (`commodity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drug_store_totals`
--

DROP TABLE IF EXISTS `drug_store_totals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drug_store_totals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `expiry_date` varchar(30) NOT NULL,
  `total_balance` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_drug_store_totals_commodity_id` (`commodity_id`),
  KEY `idx_drug_store_totals_district_id` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drug_store_transaction_table`
--

DROP TABLE IF EXISTS `drug_store_transaction_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drug_store_transaction_table` (
  `id` int(11) NOT NULL,
  `facility_code` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `opening_balance` int(11) NOT NULL DEFAULT '0',
  `total_receipts` int(11) NOT NULL DEFAULT '0',
  `total_issues` int(11) NOT NULL DEFAULT '0',
  `closing_stock` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `days_out_of_stock` int(11) NOT NULL DEFAULT '0',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `adjustmentpve` int(11) NOT NULL DEFAULT '0',
  `adjustmentnve` int(11) NOT NULL DEFAULT '0',
  `losses` int(11) NOT NULL DEFAULT '0',
  `quantity_ordered` int(11) NOT NULL DEFAULT '0',
  `comment` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  KEY `idx_drug_store_transaction_table_id` (`id`),
  KEY `idx_drug_store_transaction_table_facility_code` (`facility_code`),
  KEY `idx_drug_store_transaction_table_commodity_id` (`commodity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_listing`
--

DROP TABLE IF EXISTS `email_listing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_listing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) DEFAULT NULL,
  `bcc` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) DEFAULT NULL,
  `facility_name` varchar(100) DEFAULT NULL,
  `district` int(11) DEFAULT NULL,
  `partner` int(11) NOT NULL DEFAULT '0',
  `drawing_rights` int(50) DEFAULT NULL,
  `owner` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  `rtk_enabled` int(11) DEFAULT NULL,
  `cd4_enabled` tinyint(4) DEFAULT NULL,
  `drawing_rights_balance` int(11) DEFAULT NULL,
  `using_hcmp` int(11) DEFAULT NULL,
  `date_of_activation` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `zone` varchar(6) DEFAULT NULL,
  `contactperson` varchar(50) DEFAULT NULL,
  `cellphone` int(15) DEFAULT NULL,
  `targetted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_facilities_facility_code` (`facility_code`),
  KEY `idx_facilities_district` (`district`)
) ENGINE=MyISAM AUTO_INCREMENT=19065 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_amc`
--

DROP TABLE IF EXISTS `facility_amc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_amc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `commodity_id` int(5) NOT NULL,
  `amc` varchar(6) NOT NULL,
  `last_update` varchar(15) NOT NULL,
  `latest` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `facility_code` (`facility_code`)
) ENGINE=InnoDB AUTO_INCREMENT=36253 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_amc1`
--

DROP TABLE IF EXISTS `facility_amc1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_amc1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `commodity_id` int(5) NOT NULL,
  `amc` varchar(6) NOT NULL,
  `last_update` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `facility_code` (`facility_code`)
) ENGINE=InnoDB AUTO_INCREMENT=926 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_evaluation`
--

DROP TABLE IF EXISTS `facility_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `fhead_no` int(11) NOT NULL,
  `fdep_no` int(11) NOT NULL,
  `nurse_no` int(11) NOT NULL,
  `sman_no` int(11) NOT NULL,
  `ptech_no` int(11) NOT NULL,
  `trainer` varchar(50) NOT NULL,
  `comp_avail` int(11) NOT NULL,
  `modem_avail` int(11) NOT NULL,
  `bundles_avail` int(11) NOT NULL,
  `manuals_avail` int(11) NOT NULL,
  `satisfaction_lvl` int(11) NOT NULL,
  `agreed_time` int(11) NOT NULL,
  `feedback` int(11) NOT NULL,
  `pharm_supervision` int(11) NOT NULL,
  `coord_supervision` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `req_spec` varchar(150) NOT NULL,
  `req_addr` int(11) NOT NULL,
  `train_remarks` varchar(150) NOT NULL,
  `train_recommend` int(11) NOT NULL,
  `train_useful` int(11) NOT NULL,
  `comf_issue` int(11) NOT NULL,
  `comf_order` int(11) NOT NULL,
  `comf_update` int(11) NOT NULL,
  `comf_gen` int(11) NOT NULL,
  `use_freq` int(11) NOT NULL,
  `freq_spec` int(11) NOT NULL,
  `improvement` int(11) NOT NULL,
  `ease_of_use` int(11) NOT NULL,
  `meet_expect` int(11) NOT NULL,
  `expect_suggest` varchar(150) NOT NULL,
  `retrain` int(11) NOT NULL,
  `assessor` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_impact_evaluation`
--

DROP TABLE IF EXISTS `facility_impact_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_impact_evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `no_of_personnel` varchar(30) NOT NULL,
  `no_still_using_tool` varchar(30) NOT NULL,
  `cadres_of_users` varchar(255) NOT NULL,
  `no_of_times_a_week` int(10) NOT NULL,
  `does_physical_count_tally` int(2) NOT NULL,
  `amount_of_commodities_stocked` varchar(30) NOT NULL,
  `duration_of_stockout` varchar(30) NOT NULL,
  `amount_of_expired_commodities` varchar(30) NOT NULL,
  `amount_of_overstocked_commodities` varchar(30) NOT NULL,
  `adequate_storage` int(2) NOT NULL,
  `date_of_last_order` date NOT NULL,
  `quarter_served` varchar(30) NOT NULL,
  `discrepancies` int(2) NOT NULL,
  `reasons_for_discrepancies` varchar(255) NOT NULL,
  `date_of_delivery` date NOT NULL,
  `general_challenges` varchar(255) NOT NULL,
  `report_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_issues`
--

DROP TABLE IF EXISTS `facility_issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(5) NOT NULL,
  `commodity_id` int(5) NOT NULL,
  `s11_No` varchar(50) NOT NULL,
  `batch_no` varchar(20) NOT NULL,
  `expiry_date` varchar(100) NOT NULL,
  `balance_as_of` int(11) NOT NULL DEFAULT '0',
  `adjustmentpve` int(11) NOT NULL DEFAULT '0',
  `adjustmentnve` int(11) NOT NULL DEFAULT '0',
  `qty_issued` int(11) NOT NULL,
  `date_issued` date NOT NULL,
  `issued_to` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `issued_by` int(12) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_facility_issues_facility_code` (`facility_code`),
  KEY `idx_facility_issues_commodity_id` (`commodity_id`),
  KEY `idx_facility_issues_batch_no` (`batch_no`),
  KEY `idx_facility_issues_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=521275 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_monthly_stock`
--

DROP TABLE IF EXISTS `facility_monthly_stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_monthly_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commodity_id` int(11) NOT NULL,
  `facility_code` int(11) NOT NULL,
  `consumption_level` int(11) NOT NULL,
  `selected_option` varchar(50) NOT NULL,
  `total_units` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_facility_monthly_stock_commodity_id` (`commodity_id`),
  KEY `idx_facility_monthly_stock_facility_code` (`facility_code`)
) ENGINE=InnoDB AUTO_INCREMENT=145618 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_order_details`
--

DROP TABLE IF EXISTS `facility_order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number_id` int(11) NOT NULL,
  `commodity_id` varchar(20) NOT NULL,
  `quantity_ordered_pack` int(11) NOT NULL,
  `quantity_ordered_unit` int(11) NOT NULL,
  `scp_qty_units` int(11) NOT NULL,
  `scp_qty_packs` int(11) NOT NULL,
  `cty_qty_units` int(11) NOT NULL,
  `cty_qty_packs` int(11) NOT NULL,
  `quantity_recieved_pack` varchar(100) NOT NULL DEFAULT '0',
  `price` varchar(20) NOT NULL,
  `o_balance` int(11) NOT NULL,
  `t_receipts` int(11) NOT NULL,
  `t_issues` int(11) NOT NULL,
  `adjustpve` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL DEFAULT 'N/A',
  `c_stock` int(11) NOT NULL,
  `s_quantity` int(11) NOT NULL DEFAULT '0',
  `amc` int(11) NOT NULL DEFAULT '0',
  `status` int(5) DEFAULT '1',
  `adjustnve` int(11) NOT NULL,
  `expiry_date` varchar(50) NOT NULL,
  `batch_no` varchar(50) NOT NULL,
  `maun` varchar(100) NOT NULL,
  `quantity_recieved_unit` int(11) NOT NULL,
  `quantity_recieved` int(11) NOT NULL DEFAULT '0',
  `source` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_facility_order_details_commodity_id` (`commodity_id`),
  KEY `idx_facility_order_details_source` (`source`)
) ENGINE=InnoDB AUTO_INCREMENT=66878 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_order_details_rejects`
--

DROP TABLE IF EXISTS `facility_order_details_rejects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_order_details_rejects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_order_details_id` int(11) NOT NULL,
  `status` int(5) DEFAULT '1',
  `reason` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_order_status`
--

DROP TABLE IF EXISTS `facility_order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_desc` varchar(50) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_orders`
--

DROP TABLE IF EXISTS `facility_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` date NOT NULL,
  `approval_date` date DEFAULT NULL,
  `approval_county` date DEFAULT NULL,
  `dispatch_date` date DEFAULT NULL,
  `deliver_date` date DEFAULT NULL,
  `dispatch_update_date` date NOT NULL,
  `facility_code` int(5) NOT NULL,
  `order_no` int(11) DEFAULT NULL,
  `workload` int(11) NOT NULL DEFAULT '0',
  `bed_capacity` int(11) NOT NULL DEFAULT '0',
  `kemsa_order_id` int(11) DEFAULT NULL,
  `order_total` varchar(100) DEFAULT NULL,
  `reciever_id` int(50) DEFAULT NULL,
  `drawing_rights` varchar(11) NOT NULL,
  `ordered_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `dispatch_by` varchar(255) DEFAULT NULL,
  `warehouse` varchar(255) DEFAULT NULL,
  `source` int(11) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  `deliver_total` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_facility_orders_approval_county` (`approval_county`),
  KEY `idx_facility_orders_facility_code` (`facility_code`),
  KEY `idx_facility_orders_source` (`source`)
) ENGINE=InnoDB AUTO_INCREMENT=684 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_stock_out_tracker`
--

DROP TABLE IF EXISTS `facility_stock_out_tracker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_stock_out_tracker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `commodity_status` varchar(20) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_facility_stock_out_tracker_facility_code` (`facility_code`),
  KEY `idx_facility_stock_out_tracker_commodity_id` (`commodity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_stock_status`
--

DROP TABLE IF EXISTS `facility_stock_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_stock_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_desc` varchar(20) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_stocks`
--

DROP TABLE IF EXISTS `facility_stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `batch_no` varchar(20) NOT NULL,
  `manufacture` varchar(50) NOT NULL,
  `initial_quantity` int(11) NOT NULL,
  `current_balance` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `source_of_commodity` int(11) NOT NULL,
  `status` int(5) DEFAULT '1',
  `expiry_date` date NOT NULL,
  `other_source_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_facility_stocks_facility_code` (`facility_code`),
  KEY `idx_facility_stocks_commodity_id` (`commodity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100351 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_stocks_temp`
--

DROP TABLE IF EXISTS `facility_stocks_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_stocks_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commodity_id` int(11) NOT NULL,
  `unit_size` varchar(50) NOT NULL,
  `batch_no` varchar(50) NOT NULL,
  `manu` varchar(50) NOT NULL,
  `expiry_date` varchar(50) NOT NULL,
  `stock_level` varchar(50) NOT NULL,
  `total_unit_count` int(11) NOT NULL,
  `facility_code` varchar(50) NOT NULL,
  `unit_issue` varchar(20) NOT NULL,
  `total_units` int(11) NOT NULL,
  `source_of_item` int(11) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_facility_stocks_temp_commodity_id` (`commodity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=163792 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `facility_transaction_table`
--

DROP TABLE IF EXISTS `facility_transaction_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facility_transaction_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `commodity_id` varchar(10) NOT NULL,
  `opening_balance` int(11) NOT NULL DEFAULT '0',
  `total_receipts` int(11) NOT NULL DEFAULT '0',
  `total_issues` int(11) NOT NULL DEFAULT '0',
  `closing_stock` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `days_out_of_stock` int(11) NOT NULL DEFAULT '0',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adjustmentpve` int(11) NOT NULL DEFAULT '0',
  `adjustmentnve` int(11) NOT NULL DEFAULT '0',
  `losses` int(11) NOT NULL DEFAULT '0',
  `quantity_ordered` int(11) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `status` int(5) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_facility_transaction_table_facility_code` (`facility_code`),
  KEY `idx_facility_transaction_table_commodity_id` (`commodity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47480 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `facility_user_log`
--

DROP TABLE IF EXISTS `facility_user_log`;
/*!50001 DROP VIEW IF EXISTS `facility_user_log`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `facility_user_log` AS SELECT 
 1 AS `facility_code`,
 1 AS `user_id`,
 1 AS `start_time_of_event`,
 1 AS `end_time_of_event`,
 1 AS `action`,
 1 AS `issued`,
 1 AS `ordered`,
 1 AS `decommissioned`,
 1 AS `redistribute`,
 1 AS `add_stock`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `git_log`
--

DROP TABLE IF EXISTS `git_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `git_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash_value` varchar(150) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `issue_type`
--

DROP TABLE IF EXISTS `issue_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_type_desc` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `start_time_of_event` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action_id` int(11) NOT NULL DEFAULT '0',
  `end_time_of_event` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `issued` int(1) NOT NULL DEFAULT '0',
  `ordered` int(1) NOT NULL DEFAULT '0',
  `decommissioned` int(1) NOT NULL DEFAULT '0',
  `redistribute` int(1) NOT NULL DEFAULT '0',
  `add_stock` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_log_user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=58991 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log_monitor`
--

DROP TABLE IF EXISTS `log_monitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_monitor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `log_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_activity` int(12) NOT NULL,
  `forgetpw_code` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_log_monitor_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `malaria_data`
--

DROP TABLE IF EXISTS `malaria_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `malaria_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Beginning_Balance` varchar(30) NOT NULL,
  `Quantity_Received` varchar(30) NOT NULL,
  `Quantity_Dispensed` varchar(30) NOT NULL,
  `Losses_Excluding_Expiries` varchar(30) NOT NULL,
  `Positive_Adjustments` varchar(30) NOT NULL,
  `Negative_Adjustments` varchar(30) NOT NULL,
  `Physical_Count` varchar(30) NOT NULL,
  `Expired_Drugs` varchar(30) NOT NULL,
  `Days_Out_Stock` int(11) NOT NULL,
  `Report_Total` varchar(30) NOT NULL,
  `Kemsa_Code` varchar(30) NOT NULL,
  `Report_Date` datetime NOT NULL,
  `report_id` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `malaria_drugs`
--

DROP TABLE IF EXISTS `malaria_drugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `malaria_drugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drug_name` text NOT NULL,
  `unit_size` varchar(100) NOT NULL,
  `unit_cost` varchar(20) NOT NULL,
  `drug_category` varchar(10) NOT NULL,
  `kemsa_code` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kemsa_code` (`kemsa_code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_describe` varchar(100) NOT NULL,
  `menu_text` varchar(100) NOT NULL,
  `menu_url` varchar(100) NOT NULL,
  `user_group` int(10) NOT NULL,
  `parent_status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `facility_code` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `patient_details`
--

DROP TABLE IF EXISTS `patient_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` int(11) NOT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `home_address` varchar(65) NOT NULL,
  `work_address` varchar(65) DEFAULT NULL,
  `patient_number` varchar(65) NOT NULL,
  `system_patient_number` varchar(45) DEFAULT NULL,
  `facility_code` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `patient_issues`
--

DROP TABLE IF EXISTS `patient_issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `commodity_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `issue_type_id` int(11) DEFAULT NULL,
  `date_issued` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_names` varchar(150) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `date_issued` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_teams`
--

DROP TABLE IF EXISTS `project_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `system_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rca_county`
--

DROP TABLE IF EXISTS `rca_county`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rca_county` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `rca` int(5) NOT NULL,
  `county` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recepients`
--

DROP TABLE IF EXISTS `recepients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recepients` (
  `recepient_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone_no` varchar(30) NOT NULL,
  `sms_status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT '1',
  `district_id` int(11) DEFAULT NULL,
  `county_id` int(11) DEFAULT NULL,
  `fault_index` int(11) DEFAULT '0',
  PRIMARY KEY (`recepient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1505 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `redistribution_data`
--

DROP TABLE IF EXISTS `redistribution_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redistribution_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_facility_code` int(11) NOT NULL,
  `receive_facility_code` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `quantity_sent` int(11) NOT NULL,
  `quantity_received` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `batch_no` varchar(100) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `facility_stock_ref_id` int(11) NOT NULL,
  `date_sent` date NOT NULL,
  `date_received` date NOT NULL,
  `source_district_id` int(11) DEFAULT NULL COMMENT 'id of the source district',
  PRIMARY KEY (`id`),
  KEY `idx_redistribution_data_source_facility_code` (`source_facility_code`),
  KEY `idx_redistribution_data_receive_facility_code` (`receive_facility_code`),
  KEY `idx_redistribution_data_commodity_id` (`commodity_id`),
  KEY `idx_redistribution_data_source_district_id` (`source_district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4735 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `requisitions`
--

DROP TABLE IF EXISTS `requisitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requisitions` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Requisition ID',
  `lab` int(10) NOT NULL DEFAULT '1',
  `facility` int(10) NOT NULL COMMENT 'Facility Code',
  `request` int(10) NOT NULL,
  `supply` int(10) NOT NULL,
  `comments` varchar(100) DEFAULT NULL COMMENT 'Requisition Comments',
  `datecreated` date NOT NULL COMMENT 'Requisition Date',
  `createdby` varchar(100) NOT NULL COMMENT 'Requisition Date',
  `datemodified` date DEFAULT NULL,
  `approvedby` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `flag` int(1) NOT NULL DEFAULT '1',
  `parentid` int(14) DEFAULT NULL,
  `approvecomments` varchar(1000) DEFAULT NULL,
  `disapprovecomments` varchar(1000) DEFAULT NULL,
  `requisitiondate` date NOT NULL,
  `submitted` int(50) NOT NULL DEFAULT '0',
  `datesubmitted` date DEFAULT NULL,
  `submittedby` varchar(50) DEFAULT NULL,
  `dateapproved` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facility` (`facility`),
  KEY `request` (`request`),
  KEY `requisitiondate` (`requisitiondate`),
  KEY `flag` (`flag`),
  KEY `status` (`status`),
  KEY `datemodified` (`datemodified`),
  KEY `datecreated` (`datecreated`),
  KEY `supply` (`supply`),
  KEY `approvedby` (`approvedby`),
  KEY `createdby` (`createdby`),
  KEY `lab` (`lab`)
) ENGINE=InnoDB AUTO_INCREMENT=1231 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reversals`
--

DROP TABLE IF EXISTS `reversals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reversals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reversed_id` int(11) NOT NULL,
  `facility_code` varchar(45) DEFAULT NULL,
  `s11` varchar(60) DEFAULT NULL,
  `commodity_id` int(11) DEFAULT NULL,
  `batch_no` varchar(45) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `balance_as_of` int(11) DEFAULT NULL,
  `adjustmentpve` int(11) DEFAULT NULL,
  `adjustmentnve` int(11) DEFAULT NULL,
  `qty_issued` int(11) DEFAULT NULL,
  `date_issued` date DEFAULT NULL,
  `issued_to` varchar(60) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `issued_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `reversal_type` int(11) DEFAULT NULL,
  `reversal_time` datetime DEFAULT NULL,
  `reversal_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rh_drugs_data`
--

DROP TABLE IF EXISTS `rh_drugs_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rh_drugs_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Beginning_Balance` varchar(30) NOT NULL,
  `Received_This_Month` varchar(30) NOT NULL,
  `Dispensed` varchar(30) NOT NULL,
  `Losses` varchar(30) NOT NULL,
  `Adjustments` varchar(30) NOT NULL,
  `Ending_Balance` varchar(30) NOT NULL,
  `Quantity_Requested` varchar(30) NOT NULL,
  `Report_Date` date NOT NULL,
  `report_id` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `service_point_stocks`
--

DROP TABLE IF EXISTS `service_point_stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_point_stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) DEFAULT NULL,
  `service_point_id` int(11) DEFAULT NULL,
  `commodity_id` int(11) DEFAULT NULL,
  `current_balance` int(11) DEFAULT NULL,
  `batch_no` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(100) DEFAULT NULL,
  `price` varchar(15) DEFAULT '0',
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `service_points`
--

DROP TABLE IF EXISTS `service_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `service_point_name` varchar(100) NOT NULL,
  `for_all_facilities` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=571 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sub_menu`
--

DROP TABLE IF EXISTS `sub_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subm_text` varchar(100) NOT NULL,
  `subm_url` varchar(100) NOT NULL,
  `parent_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_description` varchar(150) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL,
  `date_due` varchar(20) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `team_positions`
--

DROP TABLE IF EXISTS `team_positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tuberculosis_data`
--

DROP TABLE IF EXISTS `tuberculosis_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tuberculosis_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `beginning_date` date NOT NULL,
  `currently_recieved` int(11) NOT NULL,
  `ending_date` date NOT NULL,
  `beginning_balance` int(11) NOT NULL,
  `quantity_dispensed` int(11) NOT NULL,
  `positive_adjustment` int(11) NOT NULL,
  `negative_adjustment` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `physical_count` int(11) NOT NULL,
  `earliest_expiry` date NOT NULL,
  `quantity_needed` int(11) NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `facility_id` (`facility_code`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activation` varchar(255) NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `county_id` int(11) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `facility` varchar(255) DEFAULT NULL,
  `partner` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `email_recieve` int(1) NOT NULL DEFAULT '1',
  `sms_recieve` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_user_district` (`district`),
  KEY `idx_user_county_id` (`county_id`),
  KEY `idx_user_facility` (`facility`)
) ENGINE=MyISAM AUTO_INCREMENT=2778 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Final view structure for view `facility_user_log`
--

/*!50001 DROP VIEW IF EXISTS `facility_user_log`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `facility_user_log` AS select distinct `u`.`facility` AS `facility_code`,`l`.`user_id` AS `user_id`,`l`.`start_time_of_event` AS `start_time_of_event`,`l`.`end_time_of_event` AS `end_time_of_event`,`l`.`action` AS `action`,`l`.`issued` AS `issued`,`l`.`ordered` AS `ordered`,`l`.`decommissioned` AS `decommissioned`,`l`.`redistribute` AS `redistribute`,`l`.`add_stock` AS `add_stock` from (`user` `u` join `log` `l`) where ((`u`.`id` = `l`.`user_id`) and (`u`.`usertype_id` = '5')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-01 10:12:48
