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
        $this -> hasColumn('tracer_item', 'int');
        $this -> hasColumn('commodity_division', 'int');
		$this -> hasColumn('status', 'int');
		
	}

	public function setUp() {
		$this -> setTableName('commodities');
		$this -> hasMany('commodity_source as supplier_name', array('local' => 'commodity_source_id', 'foreign' => 'id'));
		$this -> hasMany('commodity_sub_category as sub_category_data', array('local' => 'commodity_sub_category_id', 'foreign' => 'id'));
		$this -> hasOne('Facility_stocks as facility', array('local' => 'id', 'foreign' => 'commodity_id'));
	}

	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("commodities")->where("status=1")->orderBy('commodity_name','ASC');
		$commodities = $query -> execute();
		
		return $commodities;
	}

	public static function get_all_with_suppliers(){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT c.id,
		c.commodity_code,
		c.commodity_name,
		c.unit_size,
		c.unit_cost,
		c.commodity_sub_category_id,
		c.date_updated,
		c.total_commodity_units,
		c.commodity_source_id,
		c.status,
		c.tracer_item,
		c.commodity_division,
		c.status,
		cs.source_name as commodity_source 
		FROM commodities c,commodity_source cs 
		WHERE c.commodity_source_id = cs.id AND c.status = 1
			");

		return $query;
		/*Karsan*/
		/*DUE TO THE FACT THAT MEDS COMMODITIES DID NOT COME WITH SUB CATEGORY ID's,I HAVE REMOVED THAT PART OF THE QUERY*/
		/*THE UNMODIFIED (WITH SUB CATEGORY) IS AS FOLLOWS. NOTE,UNTIL MEDS COMMODITIES HAVE SUB CATEGORIES,THEY WILL NOT BE INCLUDED IN RESULTS*/
		/*
		SELECT c.id,
		c.commodity_code,
		c.commodity_name,
		c.unit_size,
		c.unit_cost,
		c.commodity_sub_category_id,
		c.date_updated,
		c.total_commodity_units,
		c.commodity_source_id,
		c.status,
		c.tracer_item,
		c.commodity_division,
		c.status,
		cs.source_name as commodity_source,
        csc.sub_category_name AS commodity_sub_category
		FROM commodities c,commodity_source cs ,commodity_sub_category csc
		WHERE c.commodity_source_id = cs.id AND c.status = 1 AND csc.id = c.commodity_sub_category_id
		*/
		/*Karsan*/
	}

    //get the total commodity units of a specific commodity
    public static function get_commodity_unit($commodity_id)
    {
        $units = Doctrine_Manager::getInstance()->getCurrentConnection()
            ->fetchAll("SELECT
                            total_commodity_units
                        FROM
                            commodities
                        WHERE
                            id = $commodity_id");
        return $units;
    }
    
	public static function getAll_json() {
		$query = Doctrine_Query::create() -> select("*") -> from("commodities")->where("status=1");
		$commodities = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $commodities;
	}

	public static function get_all_2() {
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("select * from commodities where status = 1 order by commodity_name asc");	
		
		return $query;
	}
	public static function get_details($commodity_id) {
		$query = Doctrine_Query::create() -> select("*") -> from("commodities")->where("status=1 and id=$commodity_id");
		$commodities = $query -> execute();
		
		return $commodities;
	}

	public static function get_commodity_name($commodity_id) {
		$query =$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll( "select commodity_name from commodities where status=1 and id=$commodity_id");
		return $query;
	}

    public static function get_tracer_items()
    {
    	$query = Doctrine_Query::create() -> select("*") -> from("commodities")->where("status = 1 and tracer_item = 1");
     	$commodities = $query -> execute();
        return $commodities;   
    }
	
public static function get_all_from_supllier($supplier_id = NULL) {
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT c.commodity_name, c.commodity_code, c.id as commodity_id, c.total_commodity_units,
              c.unit_size,c.unit_cost ,c_s.source_name, c_s_c.sub_category_name
               FROM commodities c,commodity_sub_category c_s_c, commodity_source c_s
               WHERE c.commodity_sub_category_id = c_s_c.id
               AND c.commodity_source_id=$supplier_id
               AND c.commodity_sub_category_id = c_s_c.id
               order by c_s_c.id asc,c.commodity_name asc "); 
return $inserttransaction;
	}

	public static function get_all_from_meds($supplier_id = NULL) {
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT c.commodity_name, 
				c.commodity_code, 
				c.id as commodity_id, 
				c.total_commodity_units,
                c.unit_size,c.unit_cost ,c_s.source_name
               FROM commodities c, commodity_source c_s
               WHERE c_s.id = c.commodity_source_id
               AND c.commodity_source_id= $supplier_id
               ORDER BY c.commodity_name asc "); 
return $inserttransaction;
	}

	public static function get_facility_commodities($facility_code,$checker=null){
		$order_by=isset($checker)? " order by c_s_c.sub_category_name asc ": "order by c.commodity_name asc" ;
	// $inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
 //    ->fetchAll("SELECT c.commodity_name, c.commodity_code, c.id as commodity_id,c.unit_size,c.unit_cost as unit_cost,
 //    c.total_commodity_units,
 //    c_s.source_name,c_s.id as supplier_id, c_s_c.sub_category_name
 //               FROM commodities c, commodity_source c_s, commodity_sub_category c_s_c,facility_monthly_stock f_m_s
 //               WHERE f_m_s.commodity_id = c.id
 //               AND c.commodity_sub_category_id = c_s_c.id
 //               AND f_m_s.facility_code =$facility_code
 //               AND c.commodity_source_id = c_s.id $order_by"); 
		$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT c.id,c.commodity_name,c.commodity_code,c.id AS commodity_id,c.unit_size,c.unit_cost AS unit_cost,
				c.total_commodity_units,c_s.source_name,c_s.id AS supplier_id, c_s_c.sub_category_name
				FROM facility_monthly_stock fms,
				commodities c LEFT JOIN  commodity_sub_category c_s_c on c.commodity_sub_category_id = c_s_c.id,commodity_source c_s 
				WHERE fms.facility_code = $facility_code AND fms.commodity_id = c.id AND c.commodity_source_id = c_s.id      
				GROUP BY fms.commodity_id , c.commodity_code $order_by"); 
              
  return $inserttransaction;
	}// set up the facility stock here
	public static function set_facility_stock_data_amc($facility_code){

// 	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
//     ->fetchAll("SELECT c.id as commodity_id, c.commodity_code, c.commodity_name, c.unit_size, 
//     c.commodity_sub_category_id, c_s_c.sub_category_name, c.total_commodity_units, 
//     c.commodity_source_id, c_s.source_name, ifnull( f_m_s.consumption_level, 0 ) AS consumption_level, 
//     ifnull( f_m_s.selected_option, null ) AS selected_option, ifnull( f_m_s.total_units, 0 ) AS total_units
// FROM commodity_sub_category c_s_c, commodity_source c_s, commodities c
// LEFT JOIN facility_monthly_stock f_m_s ON f_m_s.commodity_id = c.id
// AND f_m_s.facility_code =$facility_code
// WHERE c.commodity_source_id = c_s.id
// AND c.status =1
// AND c.commodity_sub_category_id = c_s_c.id"); 
		$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT distinct c.id AS commodity_id,c.commodity_code,c.commodity_name, c.unit_size, c.commodity_sub_category_id,
				    c.total_commodity_units,c.commodity_source_id,IFNULL(f_m_s.consumption_level, 0) AS consumption_level,
				    IFNULL(f_m_s.selected_option, NULL) AS selected_option, IFNULL(f_m_s.total_units, 0) AS total_units, c_s.source_name
				FROM  commodities c  LEFT JOIN  facility_monthly_stock f_m_s ON f_m_s.commodity_id = c.id AND f_m_s.facility_code = $facility_code 
				LEFT JOIN   commodity_sub_category c_s_c ON c.commodity_sub_category_id = c_s_c.id,commodity_source c_s	
				WHERE  c.status = 1  AND c.commodity_source_id = c_s.id"); 

return $inserttransaction;	
	}
	
	public static function get_commodities_not_in_facility($facility_code,$source = NULL){
	
	$getdata = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT c.commodity_name, c.commodity_code, c.id as 
    commodity_id,c.unit_size,c.unit_cost as unit_cost, c.total_commodity_units, c_s_c.sub_category_name FROM commodities c ,commodity_sub_category c_s_c Where c.id NOT IN 
    (SELECT distinct commodity_id FROM facility_transaction_table Where facility_code ='$facility_code') 
    AND c.commodity_sub_category_id = c_s_c.id ORDER BY c.commodity_name ASC
              "); 
              
  return $getdata;
	}

	public static function get_meds_commodities_not_in_facility($facility_code,$source = NULL){
		
	// $getdata = Doctrine_Manager::getInstance()->getCurrentConnection()
 //    ->fetchAll("SELECT 
	// c.commodity_name, 
	// c.commodity_code, c.id as commodity_id,
 //    c.unit_size as unit_size,
 //    c.unit_cost as unit_cost, 
 //    c.commodity_source_id
 //    FROM commodities c ,commodity_source cs
 //    WHERE c.commodity_code NOT IN 
 //    (SELECT distinct commodity_id FROM facility_transaction_table WHERE facility_code = $facility_code) 
 //    AND c.commodity_source_id = $source
 //    GROUP BY c.commodity_code
 //    ORDER BY `c`.`commodity_name` ASC
 //              "); 
		$getdata = Doctrine_Manager::getInstance()->getCurrentConnection()
	    ->fetchAll("SELECT DISTINCT
		c.commodity_name, 
		c.commodity_code, c.id as commodity_id,
	    c.unit_size as unit_size,
	    c.unit_cost as unit_cost, 
	    c.commodity_source_id
	    FROM commodities c ,commodity_source cs
	    WHERE cs.id NOT IN 
	    (SELECT distinct facility_transaction_table.commodity_id FROM facility_transaction_table WHERE facility_transaction_table.facility_code = $facility_code) 
	    GROUP BY c.commodity_code
	    ORDER BY c.commodity_name ASC
              "); 
              
  return $getdata;
	}

	public static function get_id($kemsa,$unit_cost){
		//echo "SELECT * FROM commodities WHERE commodity_code='$kemsa' AND unit_cost =$unit_cost;";echo '<pre>';
	$getdata = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT * FROM commodities WHERE commodity_code='$kemsa' AND unit_cost =$unit_cost;"); 
              
  return $getdata;
	}
	
	public static function get_meds_id($meds,$unit_cost){
		
	$getdata = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT * FROM meds_commodities WHERE commodity_code='$meds' AND unit_price =$unit_cost;"); 
              
  return $getdata;
	}

	public static function get_id_by_code($commodity_code){
		$getdata = Doctrine_Manager::getInstance()->getCurrentConnection()
		    ->fetchAll("SELECT id FROM commodities WHERE commodity_code='$commodity_code'"); 
		              
		  return $getdata;
	}

}
?>