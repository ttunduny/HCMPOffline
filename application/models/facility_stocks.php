<?php
/**
 * @author Kariuki
 */
class Facility_stocks extends Doctrine_Record {
		
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
		$this -> hasMany('Commodities as Code', array('local' => 'commodity_id', 'foreign' => 'id'));
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
	public static function get_facility_commodity_total($facility_code,$commodity_id=null,$date_added=null){
		$date_checker=isset($date_added)?" and date_added='$date_added'" : null;
		$commodity_id=isset($commodity_id)?"and commodity_id=$commodity_id" : null;
	    $query = Doctrine_Query::create() -> select("commodity_id,sum(current_balance) as commodity_balance") 
	-> from("facility_stocks") -> where("facility_code='$facility_code' $commodity_id  $date_checker and status='1'")->groupBy("commodity_id");	
		$stocks= $query -> execute();
		return $stocks;
	}// get all facility stock commodity id, options check if the user wants batch data or commodity grouped data and return the total 
	
	public static function get_distinct_stocks_for_this_facility($facility_code,$checker=null,$exception=null){
$addition=isset($checker)? ($checker==='batch_data')? 'and fs.current_balance>0 group by fs.id,c.id order by fs.expiry_date asc' 
: 'and fs.current_balance>0 group by fs.commodity_id order by c.commodity_name asc' : null ;
$check_expiry_date=isset($exception)? null: " and fs.expiry_date >= NOW()" ;
$stocks = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("SELECT DISTINCT c.id as commodity_id, fs.id as facility_stock_id,fs.expiry_date,c.commodity_name,c.commodity_code,
c.unit_size,sum(fs.current_balance) as commodity_balance, round((SUM(fs.current_balance ) / c.total_commodity_units) ,1) as pack_balance,
c.total_commodity_units,fs.manufacture,
c_s.source_name, fs.batch_no, c_s.id as source_id from facility_stocks fs, commodities c, commodity_source c_s
 where fs.facility_code ='$facility_code' $check_expiry_date 
 and c.id=fs.commodity_id and fs.status='1' $addition   
");
return $stocks ;
}
	public static function get_facility_expired_stuff($facility_code){
$stocks = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("SELECT  c.id as commodity_id, fs.id as facility_stock_id,fs.expiry_date,c.commodity_name,c.commodity_code,
c.unit_size,c.unit_cost,c.total_commodity_units,fs.manufacture,fs.current_balance,
c_s.source_name, fs.batch_no, c_s.id as source_id from facility_stocks fs, commodities c, commodity_source c_s
 where fs.facility_code ='$facility_code' and fs.expiry_date <= NOW()
 and c.id=fs.commodity_id and fs.status='1' 
");
return $stocks ;		
	}
	  public static function get_items_that_have_stock_out_in_facility($facility_code=null,$district_id=null,$county_id=null){
$where_clause=isset($facility_code)? "f.facility_code=$facility_code ": (isset($district_id)? "d.id=$district_id ": "d.county=$county_id ") ;
$group_by=isset($facility_code)? " order by c.commodity_name asc" : 
(isset($district_id)? " order by f.facility_name asc" : " order by d.district asc" );

$stocks = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("SELECT d.district, f_s.`facility_code` , f.facility_name, c.`id` AS commodity_id,
 c.`commodity_code` , c.`commodity_name`, max( date_modified ) AS last_day, sum(current_balance) as current_balance
FROM facilities f, commodities c, districts d, facility_stocks f_s
WHERE f.facility_code = f_s.facility_code
and $where_clause
AND f_s.commodity_id = c.id
AND f.district = d.id
AND f_s.status =1  
GROUP BY c.id having current_balance=0
$group_by ");
        return $stocks ;	  	
	  }
	
 		public static function potential_expiries($facility_code){
		$query = Doctrine_Query::create() -> select("*") -> from("Facility_stocks") -> where("expiry_date BETWEEN CURDATE()AND DATE_ADD(CURDATE(), INTERVAL 6 MONTH) AND facility_code='$facility_code'");
		
		$stocks= $query -> execute();
		return $stocks;
	}	

	public static function specify_period_potential_expiry($facility_code,$interval){
		$query = Doctrine_Query::create() -> select("*") -> from("Facility_stocks")
		 -> where("expiry_date BETWEEN CURDATE()AND DATE_ADD(CURDATE(), INTERVAL $interval MONTH) AND facility_code='$facility_code' AND current_balance>0");
		
		$stocks= $query -> execute();
		return $stocks;
	}	

	public static function All_expiries($facility_code){
		$stocks = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("select * from  facility_stocks f_s 
		LEFT JOIN  commodities c ON c.id=f_s.commodity_id where facility_code=$facility_code and f_s.status =1
		 and f_s.current_balance>0 and expiry_date <= NOW()");
		        return $stocks ;
	}
	      /////getting cost of exipries county
public static function get_county_cost_of_exipries_new($facility_code=null,$district_id=null,$county_id,
$year=null,$month=null,$option=null,$data_for=null)
 {   switch ($option) :
         case 'ksh':
           $computation ="ifnull((SUM(ROUND(fs.current_balance/ d.total_commodity_units)))*d.unit_cost ,0) AS total";
             break;
         case 'units':
           $computation ="ifnull(CEIL(SUM(fs.current_balance)),0) AS total" ;
             break;
             case 'packs':
           $computation ="ifnull(SUM(ROUND(fs.current_balance/d.total_commodity_units)),0) AS total" ;
             break;
         default:
      $computation ="ifnull((SUM(ROUND(fs.current_balance/ d.total_commodity_units)))*d.unit_cost ,0) AS total";
          break;
     endswitch;		
 	 $selection_for_a_month=isset($facility_code) && isset($district_id)? " d.commodity_name as name," :( 
	 isset($district_id) && !isset($facility_code) ? " f.facility_name as name,": " di.district as name,") ;
	 $select_option=($data_for=='all') ?"date_format( fs.expiry_date, '%b' ) as cal_month," : $selection_for_a_month;
	 $and_data =($district_id>0) ?" AND di.id = '$district_id'" : null;
	 $and_data .=($facility_code>0) ?" AND f.facility_code = '$facility_code'" : null;
	 $and_data .=($county_id>0) ?" AND c.id='$county_id'" : null;
	 $and_data .=($month>0) ? " AND date_format( fs.expiry_date, '%m')=$month"  : null;
	 $and_data .=($year>0) ? " AND DATE_FORMAT( fs.expiry_date,'%Y') =$year"  : null;  	 
	 $group_by_a_month=isset($facility_code) && isset($district_id)? " GROUP BY fs.commodity_id having total>0" :( 
	 isset($district_id) && !isset($facility_code) ?  " GROUP BY f.facility_code having total>0": " GROUP BY d.id having total>0") ;
	 $group_by =($data_for=='all') ?"GROUP BY month(expiry_date) asc":$group_by_a_month;
     	 
     $inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
     ->fetchAll("SELECT $select_option $computation
     FROM facility_stocks fs, facilities f, commodities d, counties c, districts di
     WHERE fs.facility_code = f.facility_code
     AND fs.`expiry_date` <= NOW( )
     AND f.district =di.id
     AND di.county=c.id
     AND d.id = fs.commodity_id
     $and_data
     $group_by
     ");   

 return  $inserttransaction ;
}
 public static function get_county_drug_stock_level_new($facility_code=null,$district_id=null,
 $county_id,$category_id=NULL,$commodity_id=NULL,$option=null){
     $selection_for_a_month=isset($facility_code) && isset($district_id)? " d.commodity_name as name," :( 
	 isset($district_id) && !isset($facility_code) ? " f.facility_name as name,": " di.district as name,") ;
	 
	 switch ($option) :
         case 'ksh':
           $computation ="ifnull((SUM(ROUND(fs.current_balance/ d.total_commodity_units)))*d.unit_cost ,0) AS total";
             break;
         case 'units':
           $computation ="ifnull(CEIL(SUM(fs.current_balance)),0) AS total" ;
             break;
             case 'packs':
           $computation ="ifnull(SUM(ROUND(fs.current_balance/d.total_commodity_units)),0) AS total" ;
             break;
         default:
      $computation ="ifnull((SUM(ROUND(fs.current_balance/ d.total_commodity_units)))*d.unit_cost ,0) AS total";
          break;
     endswitch;		
	 	
     $and_data=(isset($category_id)&& ($category_id>0)) ?"AND d.drug_category = '$category_id'" : null;
     $and_data .=(isset($commodity_id)&& ($commodity_id>0)) ?"AND d.id = '$commodity_id'" : null;
	 $and_data .=(isset($district_id)&& ($district_id>0)) ?"AND di.id = '$district_id'" : null;
	 $and_data .=(isset($facility_code)&& ($facility_code>0)) ?" AND f.facility_code = '$facility_code'" : null;
     $and_data .=($county_id>0) ?" AND di.county='$county_id'" : null;
     $group_by_a_month=isset($facility_code) && isset($district_id)? " GROUP BY fs.commodity_id having total>0" :( 
	 isset($district_id) && !isset($facility_code) ?  " GROUP BY f.facility_code having total>0": " GROUP BY d.id having total>0") ;

	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT  $selection_for_a_month $computation
     FROM facility_stocks fs, facilities f, commodities d,  districts di
     WHERE fs.facility_code = f.facility_code
     AND f.district =di.id
     AND d.id = fs.commodity_id
     AND fs.status=1
     $and_data
      $group_by_a_month
     ");		
     return $inserttransaction ;
}   
  public static function get_county_consumption_level_new($facility_code, $district_id,$county_id,$commodity_id, $option,$from,$to){
  	 $selection_for_a_month=($facility_code=="ALL") && isset($district_id)? " f.facility_name as name," :( 
	 ($commodity_id=="ALL") && isset($facility_code) ? " d.commodity_name as name,": 
	 (isset($county_id) && $district_id=="ALL")? " di.district as name," : 1) ;
	 	
	 if($selection_for_a_month==1){
      $seconds_diff = $to - $from;
	 
      $date_diff=floor($seconds_diff/3600/24);
      $selection_for_a_month=$date_diff<=30? "DATE_FORMAT(fs.date_issued,'%d %b %y') as name,": "DATE_FORMAT(fs.date_issued,'%b %y') as name ," ;	
	 }
     $to=date('Y-m-d',$to);
	  $from=date('Y-m-d',$from);
	 switch ($option) :
         case 'ksh':
           $computation ="ifnull((SUM(ROUND(fs.qty_issued/ d.total_commodity_units)))*d.unit_cost ,0) AS total";
             break;
         case 'units':
           $computation ="ifnull(CEIL(SUM(fs.qty_issued)),0) AS total" ;
             break;
             case 'packs':
           $computation ="ifnull(SUM(ROUND(fs.qty_issued/d.total_commodity_units)),0) AS total" ;
             break;
         default:
      $computation ="ifnull((SUM(ROUND(fs.qty_issued/ d.total_commodity_units)))*d.unit_cost ,0) AS total";
          break;
     endswitch;		
	 	
     $and_data=isset($from) && isset($to) ?"AND fs.date_issued between '$from' and '$to'" : null;
     $and_data .=(isset($commodity_id)&& ($commodity_id>0)) ?"AND d.id = '$commodity_id'" : null;
	 $and_data .=(isset($district_id)&& ($district_id>0)) ?"AND di.id = '$district_id'" : null;
	 $and_data .=(isset($facility_code)&& ($facility_code>0)) ?" AND f.facility_code = '$facility_code'" : null;
     $and_data .=($county_id>0) ?" AND di.county='$county_id'" : null;
	 
     $group_by_a_month=isset($facility_code) && isset($district_id)? " GROUP BY fs.commodity_id having total>0" :( 
	 isset($district_id) && !isset($facility_code) ?  " GROUP BY f.facility_code having total>0": " GROUP BY d.id having total>0") ;
	 
	 $group_by_a_month=($facility_code=="ALL") && isset($district_id)? " GROUP BY f.facility_code having total>0" :( 
	 ($commodity_id=="ALL") && isset($facility_code) ? " GROUP BY fs.commodity_id having total>0": 
	 (isset($county_id) && $district_id==="ALL")? " GROUP BY d.id having total>0" : 1) ;
	 
	 if($group_by_a_month==1){
     $group_by_a_month=$date_diff<=30? "GROUP BY DATE_FORMAT(fs.date_issued,'%d %b %y')": " GROUP BY DATE_FORMAT(fs.date_issued,'%b %y')" ;	
	 }else{}

    // echo ;
	// exit;
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT  $selection_for_a_month $computation
    FROM facility_issues fs, facilities f, commodities d, districts di
    WHERE fs.facility_code = f.facility_code
    AND f.district = di.id
    AND fs.qty_issued >0
    AND d.id = fs.commodity_id
    $and_data
    $group_by_a_month
     ");		
     return $inserttransaction ;
  }     
	
	
}
