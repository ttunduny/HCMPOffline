<?php

class redistribution_data extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('source_facility_code', 'int');
		$this -> hasColumn('receive_facility_code', 'int');
		$this -> hasColumn('commodity_id', 'int');
		$this -> hasColumn('quantity_sent',  'int');
		$this -> hasColumn('quantity_received',  'int');
		$this -> hasColumn('source_of_item',  'int');
		$this -> hasColumn('total_units',  'int');
		$this -> hasColumn('manufacturer', 'varchar', 100);
		$this -> hasColumn('batch_no', 'varchar', 100);
		$this -> hasColumn('expiry_date', 'date');
		$this -> hasColumn('status', 'int');
	}

	public function setUp() {
		$this -> setTableName('redistribution_data');
	}

	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("redistribution_data");
		$redistribution_data = $query -> execute();
		return $redistribution_data;
	}
	public static function get_all_active($facility_code,$option=null) {
		$query = Doctrine_Query::create() -> select("*") -> from("redistribution_data") -> where("source_facility_code=$facility_code and status=0");
		$redistribution_data = $query -> execute();
		return $redistribution_data;
	}
	
}
?>
