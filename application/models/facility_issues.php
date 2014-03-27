<?php
/**
 * @author Kariuki
 */
class facility_issues extends Doctrine_Record {
		
	public function setTableDefinition()
	{
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('facility_code', 'int'); 
		$this -> hasColumn('s11_No', 'int'); 
		$this -> hasColumn('commodity_id', 'int'); 
	    $this -> hasColumn('batch_no', 'varchar',20); 
		$this -> hasColumn('expiry_date', 'date'); 
		$this -> hasColumn('qty_issued', 'int');
		$this -> hasColumn('balance_as_of', 'int'); 
		$this -> hasColumn('adjustmentpve', 'int');
		$this -> hasColumn('adjustmentnve', 'int');
		$this -> hasColumn('date_issued', 'date'); 
		$this -> hasColumn('issued_to', 'varchar', 200);
		$this -> hasColumn('issued_by', 'int', 12);
		$this -> hasColumn('status', 'int');
			
	}
	public function setUp() {
		$this -> setTableName('facility_issues');		
		$this -> hasMany('commodities as commodity_detail', array('local' => 'commodity_id', 'foreign' => 'id'));
	
	}//get all the data from the db
	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("facility_issues");
		$commodities = $query -> execute();
		return $commodities;
	}
	
   ////dumbing data into the issues table
	public static function update_issues_table($data_array){
		$o = new facility_issues();
	    $o->fromArray($data_array);
		$o->save();
		return TRUE;
	}

	
	
}