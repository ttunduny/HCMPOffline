<?php 
class Tb_data extends Doctrine_Record 
{

	public static function get_facility_name($facility_code)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("facilities")->where("facility_code='$facility_code'");
		$result = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $result[0];
	}

	public static function get_facility_report_details($facility_id)
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
   	 	->fetchAll("select distinct(user_id) as user, 
   	 				date_format(report_date, '%M %Y')as report_date, 
   	 				report_date as report_timestamp,id, 
   	 				facility_code as facility_code 
   	 				from tuberculosis_data 
   	 				where facility_code = $facility_id 
   	 				order by Report_Date desc"); 
		return $query;
			
	}

}

 ?>
