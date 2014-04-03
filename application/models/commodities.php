<?php
/**
 * @author Kariuki
 */
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
		$this -> hasMany('commodity_sub_category as sub_category_data', array('local' => 'commodity_sub_category_id', 'foreign' => 'id'));
	}

	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("commodities")->where("status=1");
		$commodities = $query -> execute();
		return $commodities;
	}
	public static function get_facility_commodities($facility_code){
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT commodity_name, commodity_code, c.id AS commodity_id, unit_size, unit_cost, total_commodity_units, sub_category_name
FROM commodities c, commodity_sub_category c_s_c
WHERE c.commodity_sub_category_id = c_s_c.id
AND c.id
IN (
SELECT commodity_id
FROM facility_monthly_stock f_m_s
WHERE f_m_s.facility_code =$facility_code
group by commodity_id
)"); 
return $inserttransaction;
	}

}
?>