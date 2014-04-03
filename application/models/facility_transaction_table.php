<?php
/**
 * @author Kariuki
 */
class facility_transaction_table extends Doctrine_Record {
		
	public function setTableDefinition()
	{
				$this->hasColumn('id', 'int');
				$this->hasColumn('facility_code', 'int');
				$this->hasColumn('commodity_id', 'int');
				$this->hasColumn('opening_balance', 'int');
				$this->hasColumn('total_receipts', 'int');
				$this->hasColumn('total_issues', 'int');
				$this->hasColumn('closing_stock', 'int');
				$this->hasColumn('days_out_of_stock', 'int');
				$this->hasColumn('date_added', 'date');
				$this->hasColumn('date_modified', 'date');
				$this->hasColumn('adjustmentpve', 'int');
				$this->hasColumn('adjustmentnve', 'int');
				$this->hasColumn('losses', 'int');
				$this->hasColumn('quantity_ordered', 'int');
				$this->hasColumn('comment', 'varchar', 100);
				$this->hasColumn('status', 'int');	
			
	}

	public function setUp() {
		$this -> setTableName('facility_transaction_table');	
		$this -> hasMany('commodities as commodity_detail', array('local' => 'commodity_id', 'foreign' => 'id'));
		
	}//get the data from the table
	 public static function get_all($facility_code){
        $query = Doctrine_Query::create() -> select("*") -> from("facility_transaction_table")->where("facility_code=$facility_code and status=1");
        $commodities = $query -> execute();
        return $commodities;
    }//save bulk data here 
	public static function update_facility_table($data_array){
		$o = new facility_transaction_table();
	    $o->fromArray($data_array);
		$o->save();		
		return TRUE;
	}//get if a facility has a given item
	public static function get_if_commodity_is_in_table($facility_code,$commodity_id){
		
	$query = Doctrine_Query::create() -> select("*") -> from("facility_transaction_table")
	->where("facility_code='$facility_code' and commodity_id='$commodity_id' and status='1'");
	$commodities = $query -> execute();
	$commodities = $commodities -> count();
	return $commodities;		}

    public static function get_commodities_for_ordering($facility_code){
	 	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("SELECT * from `facility_stock_movement_order_summary` where facility_code= '$facility_code'");
        return $inserttransaction ;
		
	 }
	
	
}
?>