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

	public static function get_bin_card($facility_code,$commodity_id,$from,$to){

		$convertfrom=date('Y-m-d',strtotime($from ));
		$convertto=date('Y-m-d',strtotime($to ));

	$transaction = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT f.date_issued,f.expiry_date,f.batch_no,c.unit_size,f.s11_No,f.balance_as_of,f.adjustmentnve,
f.adjustmentpve,f.qty_issued,u.fname,u.lname, f. issued_to as service_point_name 
FROM hcmp.facility_issues f INNER JOIN hcmp.commodities c 
ON c.id=f.commodity_id  INNER JOIN hcmp.user u 
ON f.issued_by = u.id WHERE f.facility_code=17401 
AND f.status =1 AND f.commodity_id=1 
AND f.date_issued BETWEEN '$convertfrom' 
AND '$convertto' 
ORDER BY f.date_issued ASC"); 

			return $transaction;	
	}
	
}