<?php 
class Commodity_source_other_prices extends Doctrine_Record{

	public function setTableDefinition(){
		$this -> hasColumn('id','int');
		$this -> hasColumn('facility_code','int');
		$this -> hasColumn('commodity_id', 'int');
		$this -> hasColumn('batch_no', 'varchar', 20);
		$this -> hasColumn('other_source_id', 'int');
		$this -> hasColumn('price','int');
	}

	public function setUp(){
		$this -> setTableName('commodity_source_other_prices');
	}

	public static function update_prices($data_array){
		$o = new Commodity_source_other_prices();
		$o -> fromArray($data_array);
		$o -> save();
		return TRUE;
	}
}
?>