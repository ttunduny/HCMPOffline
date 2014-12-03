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


	
}   
    

?>