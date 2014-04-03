<?php
class RH_Drugs_Data extends Doctrine_Record 
{
	public function setTableDefinition() 
	{
		$this -> hasColumn('id', 'int',11);
		$this -> hasColumn('facility_id', 'int',11);
		$this -> hasColumn('user_id', 'int',11);
		$this -> hasColumn('Report_Date', 'date');
		$this -> hasColumn('Beginning_Balance', 'varchar',30);
		$this -> hasColumn('Received_This_Month', 'varchar',30);
		$this -> hasColumn('Dispensed', 'varchar',30);
		$this -> hasColumn('Losses', 'varchar',30);
		$this -> hasColumn('Adjustments', 'varchar',30);
		$this -> hasColumn('Ending_Balance', 'varchar',30);
		$this -> hasColumn('Quantity_Requested', 'varchar',30);
		
		
			
	}

	public function setUp() 
	{
		
		$this -> setTableName('rh_drugs_data');
		//$this -> hasOne('kemsa_id as Code', array('local' => 'kemsa_code', 'foreign' => 'kemsa_code'));
		//$this -> hasOne('user_id as id', array('local' => 'user_id', 'foreign' => 'user_id'));
		
				
	}
	public static function get_user_data($id)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("rh_drugs_data")->where("user_id='$id'");
		$userdata = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $userdata[0];
			
	}
	public static function getall($id)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("rh_drugs_data")-> where("user_id = '$id' ")->groupBy("Report_Date");
		$all_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $all_data;
			
	}
	public static function getall_time($time)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("rh_drugs_data")-> where("Report_Date = '$time' ");
		$all_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $all_data;
			
	}
	/*public static function get_malariareport($id, $to_date, $from_date)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("malaria_data")-> where("facility_id = '$id' and to_date < = '$to_date' and from_date >= '$from_date' ");
		$all_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $all_data;
			
	}
	public static function getreports() 
	{
		
		$from = $_POST['frommalariareport'];
		$to = $_POST['tomalariareport'];
		$facility_Code = $_POST['facilitycode'];
		$convertfrom = date('y-m-d',strtotime($from ));
		$convertto = date('y-m-d',strtotime($to ));
		
		$query = Doctrine_Query::create() -> select("*") 
		-> from("malaria_data")-> where("from_date >='$convertfrom' AND to_date <='$convertto'");
		$stocktake = $query ->execute();
		return $stocktake;
	}
	 * */
	
	 
}