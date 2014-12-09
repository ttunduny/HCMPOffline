<?php
/*
 * @author Kariuki & Mureithi
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Kenya extends MY_Controller 
{
    function __construct() 
    {
        parent::__construct();
        $this -> load -> helper(array('form', 'url','file'));
       // $this -> load -> library(array('form_validation','PHPExcel/PHPExcel'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
    }
    public function index() {
        $counties = $q = Doctrine_Manager::getInstance()
	        ->getCurrentConnection()
	        ->fetchAll("SELECT c.kenya_map_id as county_fusion_map_id,c.county,count(c.county) as facility_no FROM facilities f 
						INNER JOIN districts d ON f.district=d.id
						INNER JOIN counties c ON d.county=c.id
						where using_hcmp =1 group by c.county");// change  !!!!!!!!!!!!!
	        
	        //get facilities rolled out per county in Nos
	        
        $county_name = array();
        $map = array();
        $datas = array();
        $status = '';
        foreach ($counties as $county) {
            $countyMap = (int)$county['county_fusion_map_id'];
            $countyName = $county['county_name'];
			$facility_No = $county['facility_no'];
            array_push($county_name,array($county['id']=>$countyName));
            $datas[] = array('id' => $countyMap, 
            'value' => $countyName, 
            'value' => $facility_No,
            'color' => '528f42', 
            'tooltext' => $countyName,
            "baseFontColor" => "000000", 
            "link" => "Javascript:run('" .$county['id']. "^" .$countyName. "')");
        }
       
        $map = array( "showlabels"=>'0' , "baseFontColor" => "000000", "canvasBorderColor" => "ffffff", 
        "hoverColor" => "feab3a", "fillcolor" => "F8F8FF", "numbersuffix" => " Facilities", 
        "includevalueinlabels" => "1", "labelsepchar" => ":", "baseFontSize" => "9",
        "borderColor" => "333333 ","showBevel" => "0", 'showShadow' => "0",'showTooltip'=>"1");
        $styles = array("showBorder" => 0 , 'animation'=>"_xScale");
        $finalMap = array('map' => $map, 'data' => $datas, 'styles' => $styles);
		//echo json_encode($finalMap);
		 //var_dump($map);
		 
		$data['county'] = Counties::getAll();
		$data['title'] = "National Dashboard";
		$data['commodities'] = Commodities::get_all();
        $data['maps'] = json_encode($finalMap);
        $data['counties']=$county_name;
		
        $this -> load -> view("national/national_home_v",$data);
    } 

		public function statistics_table($county_id=null, $district_id=null){
			
			$district_id=($district_id=="NULL") ? null :$district_id;
			$county_id=($county_id=="NULL") ? null :$county_id;
			
			$and_data =($district_id>0) ?" AND d.id = '$district_id'" : null;
	    	$and_data .=($county_id>0) ?" AND c.id='$county_id'" : null;
	    	
	    	$group_by =($district_id>0 && isset($county_id) && !isset($facility_code)) ?" ,d.id" : null;
		    $group_by .=($county_id>0 && !isset($district_id)) ?" ,c_.id" : null;
					
			$facilities = $q = Doctrine_Manager::getInstance() ->getCurrentConnection()->fetchAll(
			"SELECT * FROM hcmp_rtk.facilities  f 
				INNER JOIN districts d ON f.district=d.id
				INNER JOIN counties c ON d.county=c.id
				 where using_hcmp =1 $and_data");
				 
			$data['facilities'] = $facilities;
			$this -> load -> view('national/ajax/ajax_table', $data);
			
	
	
}

		public function statistics_pie($county_id=null, $district_id=null,$filtertype=null)
	{
		
		$district_id=($district_id=="NULL") ? null :$district_id;
    $graph_type=($graph_type=="NULL") ? null :$graph_type;
    $county_id=($county_id=="NULL") ? null :$county_id;
    $and =($district_id>0) ?" AND d.id = '$district_id'" : null;
    $and.=($county_id>0) ?" AND c.id='$county_id'" : null;
    $and =isset( $and) ?  $and:null;
    
   if ($filtertype=='activation'||$filtertype=='NULL') {
   	
	$active_inactive= Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll(" SELECT count(f.using_hcmp) as total FROM facilities  f 
					INNER JOIN districts d ON f.district=d.id INNER JOIN counties c ON d.county=c.id $and  group by f.using_hcmp");
					
					$temp[]=array('Active',(int)$active_inactive[1]['total']);
					$temp[]=array('Inactive',(int)$active_inactive[0]['total']);
					$data['temp'] = json_encode($temp);
       
   }elseif ($filtertype=='owner') {
   	
	$fbo= Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll(" SELECT count(*) as total
FROM  `facilities` f, districts d, counties c  
WHERE  f.district=d.id and d.county=c.id   $and  and (f.`owner` LIKE  '%fbo%' or f.`owner` LIKE  '%faith%' 
or f.`owner` LIKE  '%christian%' or f.`owner` LIKE  '%catholic%' or f.`owner` LIKE  '%muslim%' 
or f.`owner` LIKE  '%episcopal%' or f.`owner` LIKE  '%cbo%') ");

   $private= Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll(" SELECT count(*) as total 
FROM  `facilities` f, districts d, counties c  
WHERE  f.district=d.id and d.county=c.id   $and  and (f.`owner` LIKE  '%private%' or f.`owner` LIKE  '%non%' or  f.`owner` LIKE  '%ngo%'
or  f.`owner` LIKE  '%company%' or f.`owner` LIKE  '%armed%') ");

   $public= Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll("SELECT count(*) as total
FROM  `facilities` f, districts d, counties c
WHERE  f.district=d.id and d.county=c.id   $and  and (f.`owner` LIKE  '%gok%' or f.`owner` LIKE  '%moh%' or f.`owner` LIKE  '%ministry%'
or f.`owner` LIKE  '%community%' or f.`owner` LIKE  '%public%' or f.`owner` LIKE  '%local%' or f.`owner` LIKE  '%g.o.k%' ) ");

$using_hcmp = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll(" SELECT count(f.id) as total, sum(f.`using_hcmp`) as using_hcmp
      from facilities f, districts d, 
      counties c where f.district=d.id 
      and d.county=c.id 
      $and
      ");

     $other=$using_hcmp[0]['total']-$public[0]['total']-$private[0]['total']-$fbo[0]['total'];
      
     // $pie_data = array('Private' => $private[0]['total'],'Public' =>$public[0]['total'],'Faith-Based' =>$fbo[0]['total'],'Others' =>$other);
		
		$data['private'] = json_encode((int)$private[0]['total']);
		$data['public'] = json_encode((int)$public[0]['total']);
		$data['fbo'] = json_encode((int)$fbo[0]['total']);
		$data['other'] = json_encode((int)$other);
		
		$temp[]=array('public',(int)$public[0]['total']);
		$temp[]=array('private',(int)$private[0]['total']);
		$temp[]=array('fbo',(int)$fbo[0]['total']);
		$temp[]=array('Others',(int)$other);
		
						 	
		$data['temp'] = json_encode($temp);
       
   }elseif ($filtertype=='level') {
   	
	$level= Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll(" SELECT f.level,count(f.level) as total  FROM hcmp_rtk.facilities  f 
					INNER JOIN districts d ON f.district=d.id INNER JOIN counties c ON d.county=c.id WHERE `level` LIKE '%level%' $and group by f.level");
					//var_dump($level);exit;
					$temp[]=array('Level 2',(int)$level[0]['total']);
					$temp[]=array('Level 3',(int)$level[1]['total']);
					$temp[]=array('Level 4',(int)$level[2]['total']);
					$temp[]=array('Level 5',(int)$level[3]['total']);
					$temp[]=array('Level 6',(int)$level[4]['total']);
					$data['temp'] = json_encode($temp);
       
   }
    $data['colors'] = "['#feab3a', '#4b0082', '#008b8b', '#a52a2a', '#6AF9C4']";
	$this -> load -> view("national/ajax/pie_template",$data);	
	}


public function mos_graph($county_id=null, $district_id=null,$commodity_id=null,$graph_type=null,$div=null)
			{
				
				$district_id=($district_id=="NULL") ? null :$district_id;
	    $graph_type=($graph_type=="NULL") ? null :$graph_type;
	    $facility_code=($facility_code=="NULL") ? null :$facility_code;
	    $county_id=($county_id=="NULL") ? null :$county_id;
		$commodity_id=($commodity_id=="ALL" || $commodity_id=="NULL") ? null :$commodity_id;
	
	    $and_data =($district_id>0) ?" AND d1.id = '$district_id'" : null;
	    $and_data .=($facility_code>0) ?" AND f.facility_code = '$facility_code'" : null;
	    $and_data .=($county_id>0) ?" AND c.id='$county_id'" : null;
	    $and_data =isset( $and_data) ?  $and_data:null;
	    $and_data .=isset($commodity_id) ? "AND d.id =$commodity_id" : "AND d.tracer_item =1";
	    
	    $group_by =($district_id>0 && isset($county_id) && !isset($facility_code)) ?" ,d.id" : null;
	    $group_by .=($facility_code>0 && isset($district_id)) ?"  ,f.facility_code" : null;
	    $group_by .=($county_id>0 && !isset($district_id)) ?" ,c_.id" : null;
	    $group_by =isset( $group_by) ?  $group_by: " ,c_.id";
    
    	$title='';
		
		if(isset($county_id)):
		    $county_name = counties::get_county_name($county_id);   
		    $name=$county_name[0]['county'] ;
		    $title="$name County" ;
	    elseif(isset($district_id)):
		    $district_data = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : null;
		    $district_name_ = (isset($district_data)) ? " :" . $district_data[0]['district'] . " Subcounty" : null;
		    $title = isset($facility_code) && isset($district_id)? "$district_name_ : $facility_name" :
		    		(isset($district_id) && !isset($facility_code) ?  "$district_name_": "$name County") ;
	    elseif(isset($facility_code)):
		    $facility_code_ = isset($facility_code) ? facilities::get_facility_name_($facility_code): null;
		    $title=$facility_code_['facility_name'];
	    else:
	    	$title="National";
	    endif;
		
		//if( $graph_type!="excel"):
		
    $commodity_array = Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll("SELECT d.commodity_name, avg(ft.total_issues) as total_issues , avg(ft.total_issues)/3 as avg_per_month,
(avg(ft.total_issues)/3)/d.total_commodity_units as amc_packs_per_month,
avg(fs.current_balance) as avg_balance,
(avg(fs.current_balance))/d.total_commodity_units as avg_pack_balance,
((avg(fs.current_balance))/(avg(ft.total_issues)/3))/d.total_commodity_units as mos,
d.total_commodity_units,ft.date_added FROM hcmp_rtk.facility_transaction_table ft 
INNER JOIN facility_stocks fs ON ft.facility_code=fs.facility_code
INNER JOIN commodities d ON ft.commodity_id=d.id
AND ft.date_added >= DATE_ADD(now(),INTERVAL -3 MONTH)
			        $and_data
			group by d.id
		
		"); 
		 //var_dump($div)	;exit;
		$category_data = array();
        $series_data =$series_data_ = array();      
        $temp_array =$temp_array_ = array();
        $graph_data=array();
        $graph_type='';
        $arrayseries = array();
		$arrayseries2 = array();
        foreach ($commodity_array as $data) :
			$arrayseries[] = (int)$data['amc_packs_per_month'];
			$arrayseries2[] = (int)$data['mos'];
        //$series_data = array_merge($series_data, array($data["drug_name"] => (int)$data['total']));
        $category_data = array_merge($category_data, array($data["commodity_name"]));
        endforeach;
        //var_dump($category_data);exit;
 		//var_dump($series_data);exit;
 		
        $data['graph_type'] = 'column';
        $data['graph_title'] = "$title Stock Level in Months of Stock (MOS)";
        $data['graph_yaxis_title'] = "MOS";
        $data['graph_id'] = $div;
        $data['legend'] = "M.O.S";
        $data['colors'] = "['#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']";
        $data['category_data'] = json_encode($category_data);
        $data['series_data'] =  json_encode($arrayseries);
		$data['series_data2'] =  json_encode($arrayseries2);
				
		$this -> load -> view("national/ajax/threashhold_v",$data);
				
			}


	
}   
    

?>