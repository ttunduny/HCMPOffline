<?php
/**
 * @author Kariuki
 */
class service_points extends Doctrine_Record {
		
	public function setTableDefinition()
	{
		        $this->hasColumn('id', 'int');
				$this->hasColumn('facility_code', 'int');
				$this->hasColumn('service_point_name', 'varchar',100);
				$this->hasColumn('for_all_facilities', 'int');
				$this->hasColumn('date_added', 'date');
				$this->hasColumn('date_modified', 'date');
				$this->hasColumn('added_by', 'int');
				$this->hasColumn('status', 'int');	
	}

	public function setUp() {
		$this -> setTableName('service_points');		
		$this -> hasMany('facilities as facility_details', array('local' => 'facility_code', 'foreign' => 'id'));
	}
   public static function get_all_active($facility_code) {
		$query = Doctrine_Query::create() -> select("*") -> from("service_points")->where("status=1 and (for_all_facilities=1 or facility_code=$facility_code )");
		$service_points = $query -> execute();
		return $service_points;
	}//save the data on to the table 
	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("service_points");
		$service_points = $query -> execute();
		return $service_points;
	}//save the data on to the table 
   public static function update_service_points($data_array){
		$o = new service_points();
	    $o->fromArray($data_array);
		$o->save();		
		return TRUE;
	}
	
	
}
