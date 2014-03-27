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
	}// set up the facility stock here
	public function set_facility_stock_data_amc($facility_code){
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT c.id as commodity_id, c.commodity_code, c.commodity_name, c.unit_size, 
    c.commodity_sub_category_id, c_s_c.sub_category_name, c.total_commodity_units, 
    c.commodity_source_id, c_s.source_name, ifnull( f_m_s.consumption_level, 0 ) AS consumption_level, 
    ifnull( f_m_s.selected_option, null ) AS selected_option, ifnull( f_m_s.total_units, 0 ) AS total_units
FROM commodity_sub_category c_s_c, commodity_source c_s, commodities c
LEFT JOIN facility_monthly_stock f_m_s ON f_m_s.commodity_id = c.id
AND f_m_s.facility_code =$facility_code
WHERE c.commodity_source_id = c_s.id
AND c.status =1
AND c.commodity_sub_category_id = c_s_c.id"); 
return $inserttransaction;	
	}

}
?>