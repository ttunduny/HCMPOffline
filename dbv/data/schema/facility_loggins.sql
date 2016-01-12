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

END