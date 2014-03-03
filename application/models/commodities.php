<?php

class Commodities extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('commodity_code', 'varchar', 20);
		$this -> hasColumn('commodity_name', 'varchar', 100);
		$this -> hasColumn('unit_size', 'varchar', 100);
		$this -> hasColumn('unit_cost', 'varchar', 100);
		$this -> hasColumn('commodity_sub_category_id', 'int');
		$this -> hasColumn('date_updated', 'date');
		$this -> hasColumn('total_commodity_units', 'int');
		$this -> hasColumn('commodity_source_id', 'int');
		$this -> hasColumn('status', 'int');
	}

	public function setUp() {
		$this -> setTableName('commodities');
		$this -> hasMany('commodity_source as supplier_name', array('local' => 'commodity_source_id', 'foreign' => 'id'));
	}

	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("commodities");
		$commodities = $query -> execute();
		return $commodities;
	}

}
?>