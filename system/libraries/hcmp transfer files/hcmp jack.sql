-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2014 at 12:50 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hcmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_describe` varchar(100) NOT NULL,
  `menu_text` varchar(100) NOT NULL,
  `menu_url` varchar(100) NOT NULL,
  `user_group` int(10) NOT NULL,
  `parent_status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_describe`, `menu_text`, `menu_url`, `user_group`, `parent_status`) VALUES
(7, 'facility_order', 'ORDER', 'reports/order_listing/facility', 5, 0),
(8, 'sub_county_order', 'ORDERS', 'reports/order_listing/subcounty', 3, 0),
(9, 'facility_issues', 'ISSUES', 'issues/index/internal', 5, 1),
(10, 'facility_reports', 'REPORTS', 'reports', 5, 0),
(11, 'sub_county_reports', 'REPORTS', 'reports', 3, 1),
(12, 'facility_admin_settings', 'SETTINGS', '', 2, 0),
(13, 'facility_user_admin', 'SETTINGS', '', 5, 1),
(14, 'sub_county_reports', 'FACILITY MAPPING', 'reports/mapping', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE IF NOT EXISTS `sub_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subm_text` varchar(100) NOT NULL,
  `subm_url` varchar(100) NOT NULL,
  `parent_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `subm_text`, `subm_url`, `parent_id`) VALUES
(1, 'Redistribute Items', 'issues/index/external', 9),
(2, 'Receive redistributed Items', 'issues/confirm_external_issue', 9),
(3, 'User manual', '', 13),
(4, 'KEMSA', 'reports/facility_transaction_data/1', 7),
(5, 'Add facility stock data', 'stock/facility_stock_first_run/1', 13),
(6, 'Edit facility stock data', 'reports/facility_stock_data', 13),
(7, 'Set up facility stock', 'stock/set_up_facility_stock', 13),
(8, 'Order Listing', 'reports/order_listing/facility', 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
