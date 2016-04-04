<?php
class Commodity_source extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('source_name', 'varchar', 20);
		$this -> hasColumn('status', 'int');
	}

	public function setUp() {
		$this -> setTableName('commodity_source');
		$this -> hasMany('Commodities as supplier_name', array('local' => 'id', 'foreign' => 'commodity_source_id'));
	}

	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("commodity_source");
		$commodity_source = $query -> execute();
		return $commodity_source;
	}
	public static function get_all_id($id) {
		$query = Doctrine_Query::create() -> select("*") -> from("commodity_source")->where("id=$id");
		$commodity_source = $query -> execute();
		return $commodity_source;
	}

	public static function get_all_other_source_names(){
		$name_data = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
			SELECT * FROM commodity_source_other");
		return $name_data;
	}

	public static function check_name_exists($source_name){
		$source_name = str_replace("%20", " ", $source_name);
		$name_exists = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
			SELECT * FROM commodity_source_other WHERE source_name = '$source_name'");
		if($name_exists) return true;
		else return false;
	}

	public static function find_source_id($source_name){
		$source_name = str_replace("%20", " ", $source_name);
		$id = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
			SELECT id FROM commodity_source_other WHERE source_name = '$source_name'
			");
		$found_id = 0;
		foreach ($id as $key => $value) {
			$found_id = $value['id'];
		}
		return $found_id;
	}
}
?>