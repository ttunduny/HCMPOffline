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
END