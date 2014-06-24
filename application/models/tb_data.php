<?php 
class Tb_data extends Doctrine_Record 
{
		public function setTableDefinition() {
		$this -> hasColumn('id', 'int',11);
		$this -> hasColumn('facility_code', 'int',11);	
		$this -> hasColumn('beginning_date', 'date');	
		$this -> hasColumn('currently_recieved', 'int',11);
		$this -> hasColumn('ending_date', 'date');
		$this -> hasColumn('beginning_balance', 'int',11);
		$this -> hasColumn('quantity_dispensed', 'int',11);
		$this -> hasColumn('positive_adjustment', 'int',11);
		$this -> hasColumn('negative_adjustment', 'int',11);
		$this -> hasColumn('losses', 'int',11);
		$this -> hasColumn('physical_count', 'int',11);
		$this -> hasColumn('earliest_expiry', 'date');
		$this -> hasColumn('quantity_needed', 'int',11);
		$this -> hasColumn('report_date', 'timestamp');
		$this -> hasColumn('user_id', 'int',11);
		$this -> hasColumn('report_id', 'int',11);
	}

	public function setUp() {
		$this -> setTableName('tuberculosis_data');
	}

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
   	 	date_format(Report_Date, '%M %Y')as report_date, 
   	 	report_date as report_timestamp, report_id, 
   	 	facility_code as facility_code 
   	 	from tuberculosis_data 
   	 	where facility_code = $facility_id 
   	 	order by Report_Date desc"); 
		return $query;
			
	}

	public static function get_facility_report($report_id, $facility_id)
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
   	 	->fetchAll("select * 
   	 	from tuberculosis_data 
   	 	where report_id = $report_id AND facility_code = $facility_id 
   	 	order by Report_Date desc"); 
		return $query;
			
	}

}

 ?>
