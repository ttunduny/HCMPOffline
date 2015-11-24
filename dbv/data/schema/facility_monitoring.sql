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

END