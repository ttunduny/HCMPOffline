<?php
/**
 * @author Kariuki
 */
class facility_stocks extends Doctrine_Record {
		
	public function setTableDefinition()
	{
		        $this->hasColumn('id', 'int');
				$this->hasColumn('facility_code', 'int');
				$this->hasColumn('commodity_id', 'int');
				$this->hasColumn('batch_no', 'varchar',50);
				$this->hasColumn('manufacture', 'varchar',100);
				$this->hasColumn('initial_quantity', 'int');
				$this->hasColumn('current_balance', 'int');
				$this->hasColumn('source_of_commodity', 'int');
				$this->hasColumn('expiry_date', 'date');
				$this->hasColumn('date_added', 'date');
				$this->hasColumn('date_modified', 'date');
				$this->hasColumn('status', 'int');	
	}

	public function setUp() {
		$this -> setTableName('facility_stocks');		
		$this -> hasMany('commodities as commodity_detail', array('local' => 'commodity_id', 'foreign' => 'id'));
	}
	public static function get_all_active($facility_code) {
		$query = Doctrine_Query::create() -> select("*") -> from("facility_stocks")->where("facility_code=$facility_code and status=1");
		$commodities = $query -> execute();
		return $commodities;
	}//save the data on to the table 
	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("facility_stocks");
		$commodities = $query -> execute();
		return $commodities;
	}//save the data on to the table 
   public static function update_facility_stock($data_array){
		$o = new facility_stocks();
	    $o->fromArray($data_array);
		$o->save();		
		return TRUE;
	}// get the total balance of a specific item within a balance
	public static function get_facility_commodity_total($facility_code,$commodity_id){
	$query = Doctrine_Query::create() -> select("sum(current_balance) as commodity_balance") 
	-> from("facility_stocks") -> where("facility_code='$facility_code' and commodity_id=$commodity_id")->andwhere("status='1'");	
		$stocks= $query -> execute();
		return $stocks;	
	}// get all facility stock commodity id, options check if the user wants batch data or commodity grouped data and return the total 
	public static function get_distinct_stocks_for_this_facility($facility_code,$checker=null){
$addition=isset($checker)? ($checker=='batch_data')? 'and fs.current_balance>0 group by fs.batch_no,c.id order by fs.expiry_date asc' 
: 'and fs.current_balance>0 group by c.id order by c.commodity_name asc' : null ;

$stocks = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("SELECT DISTINCT c.id as commodity_id, fs.id as facility_stock_id,fs.expiry_date,c.commodity_name,
c.unit_size,sum(fs.current_balance) as commodity_balance,c.total_commodity_units,
c_s.source_name, fs.batch_no, c_s.id from facility_stocks fs, commodities c, commodity_source c_s
 where fs.facility_code ='$facility_code' and fs.expiry_date >= NOW() 
 and c.id=fs.commodity_id and fs.status='1' $addition   
");
        return $stocks ;
}
	
	
	
}
