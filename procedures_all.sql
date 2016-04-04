CREATE DATABASE  IF NOT EXISTS `hcmp_rtk` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hcmp_rtk`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 192.168.133.22    Database: hcmp_rtk
-- ------------------------------------------------------
-- Server version	5.5.38-0+wheezy1

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
-- Dumping routines for database 'hcmp_rtk'
--
/*!50003 DROP PROCEDURE IF EXISTS `facility_issues` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `facility_issues`(criteria VARCHAR (45), analysis VARCHAR(45))
BEGIN

CASE criteria 
WHEN 'county' THEN
 SELECT 
				              
				    f.facility_name as 'Facility Name',
				    IFNULL(DATEDIFF(NOW(), MAX(fi.created_at)),0) as 'Days from last issue'
				

				FROM

				    facility_issues fi
         
                 RIGHT JOIN facilities f ON fi.facility_code = f.facility_code
                 JOIN user u ON u.facility = f.facility_code
                 JOIN counties c ON c.id = u.county_id
                  
				WHERE
                        
                        f.using_hcmp = 1
				        AND c.id = analysis
                       

				GROUP BY f.facility_name
                 ORDER BY fi.created_at DESC;
 WHEN 'district' THEN
   SELECT 
				              
				    f.facility_name as 'Facility Name',
				    DATEDIFF(NOW(), MAX(fi.`created_at`)) as 'Days from last issue'

				FROM
				    
				    counties c,
				    facility_issues fi
        
                 
                 RIGHT JOIN facilities f ON fi.facility_code = f.facility_code
                 JOIN districts d ON d.id = f.district
      
				WHERE
						 f.using_hcmp = 1
				        AND d.id= analysis
				GROUP BY f.facility_name
                 ORDER BY fi.created_at DESC;

WHEN 'facility' THEN

SELECT 
				              
				    f.facility_name as 'Facility Name',
				    IFNULL(DATEDIFF(NOW(), MAX(fi.created_at)),0) as 'Days from last issue'
				

				FROM
				    counties c,
				    facility_issues fi
        
                 
                 RIGHT JOIN facilities f ON fi.facility_code = f.facility_code
                 JOIN districts d ON d.id = f.district
				 
                
			     
				
				WHERE
                         f.using_hcmp = 1
				         AND f.facility_code = analysis
				GROUP BY f.facility_name
                 ORDER BY fi.created_at DESC;
END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `facility_loggins` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `facility_loggins`(criteria VARCHAR (45), analysis VARCHAR(45))
BEGIN

CASE criteria 
WHEN 'county' THEN
SELECT 
				              
				    f.facility_name as 'Facility Name',
				    IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0) as 'Days From Last Seen'

				FROM
					counties c,
				    log l
        
                 INNER JOIN user u ON l.user_id=u.id
                 RIGHT JOIN facilities f ON u.facility=f.facility_code
			
				WHERE
                      f.using_hcmp = 1
				      AND c.id = analysis
                      AND u.county_id = c.id

				GROUP BY f.facility_name
                 ORDER BY l.end_time_of_event DESC;

 WHEN 'district' THEN
   SELECT 
				              
				    f.facility_name as 'Facility Name',
				    IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0) as 'Days From Last Seen'

				FROM
				    log l
                 INNER JOIN user u ON l.user_id=u.id
                 RIGHT JOIN facilities f ON u.facility=f.facility_code
				 JOIN districts d ON d.id = f.district
				 JOIN counties c ON c.id = d.county
				 
                    
				WHERE
						l.user_id = u.id 
                        AND u.facility = f.facility_code
				        AND f.using_hcmp = 1
				        AND d.id= analysis
				GROUP BY f.facility_name
                 ORDER BY l.end_time_of_event DESC;


WHEN 'facility' THEN
   SELECT 
				              
				    f.facility_name as 'Facility Name',
				    IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0) as 'Days From Last Seen'

				FROM
				    log l
                 INNER JOIN user u ON l.user_id=u.id
                 RIGHT JOIN facilities f ON u.facility=f.facility_code
				 JOIN districts d ON d.id = f.district
				 JOIN counties c ON c.id = d.county
				 
                    
				WHERE
						fi.facility_code = f.facility_code
				        AND f.using_hcmp = 1
				         AND f.facility_code = analysis
				GROUP BY f.facility_name
                 ORDER BY  l.end_time_of_event DESC;


END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `facility_monitoring` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `facility_monitoring`(criteria VARCHAR (45), analysis VARCHAR(45))
BEGIN
CASE criteria 
WHEN 'facility' THEN
SELECT 
				    f.facility_name as 'Facility Name',
				    f.facility_code as 'Facility Code',
                    c.county as 'County',
                    d.district as 'Sub-County',

                    (CASE
                         WHEN l.issued = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.issued = 0 THEN 0
				     END) AS 'Date Last Issued',
                    
                    (CASE
                         WHEN l.issued = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.issued = 0 THEN 0
				     END) AS 'Days From Last Issue',
                    (CASE
                         WHEN l.redistribute = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.redistribute = 0 THEN 0
				     END) AS 'Date Last Redistributed',
                     
                     (CASE
                         WHEN l.redistribute = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.redistribute = 0 THEN 0
				     END) AS 'Days From Last Redistributed',
                    
                    (CASE
                         WHEN l.ordered = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.ordered = 0 THEN 0
				     END) AS 'Date Last Ordered',
                    (CASE
                         WHEN l.ordered = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.ordered = 0 THEN 0
				     END) AS 'Days From Last Order',

                   
                     (CASE
                         WHEN l.decommissioned = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.decommissioned = 0 THEN 0
				     END) AS 'Date Last Decommissioned',
                     
                     (CASE
                         WHEN l.decommissioned = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.decommissioned = 0 THEN 0
				     END) AS 'Days From Last Decommissioned',

                     (CASE
                         WHEN l.add_stock = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.add_stock = 0 THEN 0
				     END) AS 'Date Last Received Order',
                     
                     (CASE
                         WHEN l.add_stock = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.add_stock = 0 THEN 0
				     END) AS 'Days From Last Received Order',
                     
                    MAX(l.end_time_of_event) as 'Date Last Seen',
				    IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0) as 'Days From Last Seen'
				    
				FROM

                  log l
                 INNER JOIN user u ON l.user_id=u.id
                 RIGHT JOIN facilities f ON u.facility=f.facility_code
				 JOIN districts d ON d.id = f.district
				 JOIN counties c ON c.id = d.county
                 
				WHERE
				        f.using_hcmp = 1
				        AND f.facility_code = analysis;
 WHEN 'district' THEN
      SELECT 
				              
				    f.facility_name as 'Facility Name',
				    f.facility_code as 'Facility Code',
                    c.county as 'County',
                    d.district as 'Sub-County',
                    

                    (CASE
                         WHEN l.issued = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.issued = 0 THEN 0
				     END) AS 'Date Last Issued',
                    
                    (CASE
                         WHEN l.issued = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.issued = 0 THEN 0
				     END) AS 'Days From Last Issue',
                    (CASE
                         WHEN l.redistribute = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.redistribute = 0 THEN 0
				     END) AS 'Date Last Redistributed',
                     
                     (CASE
                         WHEN l.redistribute = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.redistribute = 0 THEN 0
				     END) AS 'Days From Last Redistributed',
                    
                    (CASE
                         WHEN l.ordered = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.ordered = 0 THEN 0
				     END) AS 'Date Last Ordered',
                    (CASE
                         WHEN l.ordered = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.ordered = 0 THEN 0
				     END) AS 'Days From Last Order',

                   
                     (CASE
                         WHEN l.decommissioned = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.decommissioned = 0 THEN 0
				     END) AS 'Date Last Decommissioned',
                     
                     (CASE
                         WHEN l.decommissioned = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.decommissioned = 0 THEN 0
				     END) AS 'Days From Last Decommissioned',

                     (CASE
                         WHEN l.add_stock = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.add_stock = 0 THEN 0
				     END) AS 'Date Last Received Order',
                     
                     (CASE
                         WHEN l.add_stock = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.add_stock = 0 THEN 0
				     END) AS 'Days From Last Received Order',
                     
                    MAX(l.end_time_of_event) as 'Date Last Seen',
				    IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0) as 'Days From Last Seen'

				FROM
				    
				    log l
                 INNER JOIN user u ON l.user_id=u.id
                 RIGHT JOIN facilities f ON u.facility=f.facility_code
				 JOIN districts d ON d.id = f.district
				 JOIN counties c ON c.id = d.county
              
				WHERE
						 f.using_hcmp = 1
				        AND d.id=analysis
         
				GROUP BY f.facility_code, u.id;

WHEN 'county' THEN
  SELECT 
				              
				    f.facility_name as 'Facility Name',
				    f.facility_code as 'Facility Code',
                    c.county as 'County',
                    d.district as 'Sub-County',
                    
                    
                   (CASE
                         WHEN l.issued = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.issued = 0 THEN 0
				     END) AS 'Date Last Issued',
                    
                    (CASE
                         WHEN l.issued = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.issued = 0 THEN 0
				     END) AS 'Days From Last Issue',
                    (CASE
                         WHEN l.redistribute = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.redistribute = 0 THEN 0
				     END) AS 'Date Last Redistributed',
                     
                     (CASE
                         WHEN l.redistribute = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.redistribute = 0 THEN 0
				     END) AS 'Days From Last Redistributed',
                    
                    (CASE
                         WHEN l.ordered = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.ordered = 0 THEN 0
				     END) AS 'Date Last Ordered',
                    (CASE
                         WHEN l.ordered = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.ordered = 0 THEN 0
				     END) AS 'Days From Last Order',

                   
                     (CASE
                         WHEN l.decommissioned = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.decommissioned = 0 THEN 0
				     END) AS 'Date Last Decommissioned',
                     
                     (CASE
                         WHEN l.decommissioned = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.decommissioned = 0 THEN 0
				     END) AS 'Days From Last Decommissioned',

                     (CASE
                         WHEN l.add_stock = 1 THEN MAX(l.end_time_of_event)
                         WHEN l.add_stock = 0 THEN 0
				     END) AS 'Date Last Received Order',
                     
                     (CASE
                         WHEN l.add_stock = 1 THEN IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0)
                         WHEN l.add_stock = 0 THEN 0
				     END) AS 'Days From Last Received Order',
                     
                    MAX(l.end_time_of_event) as 'Date Last Seen',
				    IFNULL(DATEDIFF(NOW(), MAX(l.end_time_of_event)),0) as 'Days From Last Seen'
                   
				
				FROM
				    counties c,
                    districts d,
				    log l
        
                 INNER JOIN user u ON l.user_id=u.id
                 RIGHT JOIN facilities f ON u.facility=f.facility_code
                
                

				WHERE
					
                        f.using_hcmp=1
                        AND f.district = d.id
                        AND c.id = analysis
                        AND c.id = u.county_id
                        
                        
                        

            
				GROUP BY f.facility_code
                    ORDER BY f.facility_name;
END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `facility_monitoring_new` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `facility_monitoring_new`(filter_level VARCHAR (45),filter_id INT (45), filter_type VARCHAR(45))
BEGIN
    CASE filter_level 
WHEN 'county' THEN
    IF (filter_type ='last_issued') THEN 
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND c.id = filter_id
        AND l.issued = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
        
    ELSEIF (filter_type ='last_ordered') THEN
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND c.id = filter_id
        AND l.ordered = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
        
    ELSEIF (filter_type ='last_decommissioned') THEN
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND c.id = filter_id
        AND l.decommissioned = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
        
    ELSEIF (filter_type ='last_redistributed') THEN
     SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND c.id = filter_id
        AND l.redistribute = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
    
    ELSEIF (filter_type ='last_added_stock') THEN
    
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND c.id = filter_id
        AND l.add_stock = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
        ELSE
 SELECT DISTINCT 
 f.facility_code AS facility_code,
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND c.id = filter_id
        GROUP BY facility_code
        ORDER BY last_seen ASC;
        
    END IF;

WHEN 'district' THEN
IF (filter_type ='last_issued') THEN 
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND d.id = filter_id
        AND l.issued = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
        
    ELSEIF (filter_type ='last_ordered') THEN
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND d.id = filter_id
        AND l.ordered = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
        
    ELSEIF (filter_type ='last_decommissioned') THEN
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND d.id = filter_id
        AND l.decommissioned = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
        
    ELSEIF (filter_type ='last_redistributed') THEN
     SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND d.id = filter_id
        AND l.redistribute = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
    
    ELSEIF (filter_type ='last_added_stock') THEN
    
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND d.id = filter_id
        AND l.add_stock = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
ELSE 
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND d.id = filter_id
        GROUP BY facility_code
        ORDER BY last_seen ASC;
    END IF;

WHEN 'all' THEN
IF (filter_type ='last_issued') THEN 
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND l.issued = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
        
    ELSEIF (filter_type ='last_ordered') THEN
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND l.ordered = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
        
    ELSEIF (filter_type ='last_decommissioned') THEN
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND l.decommissioned = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
        
    ELSEIF (filter_type ='last_redistributed') THEN
     SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND l.redistribute = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
    
    ELSEIF (filter_type ='last_added_stock') THEN
    
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        AND l.add_stock = 1
        GROUP BY facility_code
        ORDER BY last_seen ASC;
ELSE 
    SELECT 
    u.id,
    u.username,
    d.district,
    c.county,
    f.facility_name,
    f.facility_code AS facility_code,
    c.county,
    d.district,
    d.id AS district_id,
    c.id AS county_id,
    l.action,
    MAX(l.end_time_of_event) AS last_seen,
    l.issued,
    l.ordered,
    l.decommissioned,
    l.redistribute,
    l.add_stock,
    DATEDIFF(NOW(), MAX(l.end_time_of_event)) AS difference_in_days
FROM
    facilities f,
    districts d,
    counties c,
    user u,
    log l
WHERE
    f.district = d.id AND d.county = c.id
        AND u.facility = f.facility_code
        AND u.id = l.user_id
        AND c.id = d.county
        AND f.using_hcmp = 1
        AND l.action = 'Logged Out'
        GROUP BY facility_code
        ORDER BY last_seen ASC;
    END IF;
END CASE;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `facility_orders` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `facility_orders`(criteria VARCHAR (45), analysis VARCHAR(45))
BEGIN
CASE criteria 
WHEN 'county' THEN
SELECT 
				              
				    f.facility_name as 'Facility Name',
				    IFNULL(DATEDIFF(NOW(), MAX(fo.order_date)),0) as 'Days From Last Order'
				

				FROM
                    
				    facility_orders fo
         
                 RIGHT JOIN facilities f ON fo.facility_code = f.facility_code
                 JOIN user u ON u.facility = f.facility_code
                 JOIN counties c ON c.id = u.county_id
	
				WHERE
                         f.using_hcmp = 1
				        AND c.id = analysis
                        

				GROUP BY f.facility_name
                 ORDER BY f.facility_name DESC;


 WHEN 'district' THEN
   SELECT 
				f.facility_name as 'Facility Name',
			IFNULL(DATEDIFF(NOW(), MAX(fo.order_date)),0) as 'Days From Last Order'
  
				    

				FROM
				    
				    counties c,
				    facility_orders fo
        
                 
                 RIGHT JOIN facilities f ON fo.facility_code = f.facility_code
				   JOIN districts d ON d.id = f.district
                
			     
				
				WHERE
                         f.using_hcmp = 1
				        AND d.id= analysis
				 
                 GROUP BY f.facility_name
                 ORDER BY f.facility_name DESC;


 WHEN 'facility' THEN
   SELECT 
				              
				    f.facility_name as 'Facility Name',
				    IFNULL(DATEDIFF(NOW(), MAX(fo.order_date)),0) as 'Days From Last Order'

				FROM
				   counties c,
				    facility_orders fo
        
                 
                 RIGHT JOIN facilities f ON fo.facility_code = f.facility_code
				   JOIN districts d ON d.id = f.district
                
			     
				
				WHERE
                         f.using_hcmp = 1
				         AND f.facility_code = analysis
				GROUP BY f.facility_name
                 ORDER BY f.facility_name DESC;


END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-11 13:08:14
