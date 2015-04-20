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


	public function mos_graph($county_id=null, $district_id=null,$commodity_id=null,$graph_type=null,$div=null)
            {
                
                $district_id=($district_id=="NULL") ? null :$district_id;
        $graph_type=($graph_type=="NULL") ? null :$graph_type;
        $facility_code=($facility_code=="NULL") ? null :$facility_code;
        $county_id=($county_id=="NULL") ? null :$county_id;
        $commodity_id=($commodity_id=="ALL" || $commodity_id=="NULL") ? null :$commodity_id;
    
        $and_data =($district_id>0) ?" AND sc.id = '$district_id'" : null;
        $and_data .=($facility_code>0) ?" AND f.facility_code = '$facility_code'" : null;
        $and_data .=($county_id>0) ?" AND c.id='$county_id'" : null;
        $and_data =isset( $and_data) ?  $and_data:null;
        $and_data .=isset($commodity_id) ? "AND d.id =$commodity_id" : "AND d.tracer_item =1";
        
        $group_by =($district_id>0 && isset($county_id) && !isset($facility_code)) ?" ,c.id" : null;
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
        
        
    $facility_issues_array = Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll("SELECT c.county,c.id,sc.district,sc.id as sc_id,temp.facility_name,temp.facility_code,
d.commodity_name,d.total_commodity_units,d.id as c_id,sum(fi.qty_issued) as total,
sum(fi.qty_issued)/3 as qty_monthly,avg(fi.qty_issued)/(3*d.total_commodity_units) as amc_packs
FROM hcmp_rtk.facility_issues fi 
LEFT JOIN commodities d ON fi.commodity_id=d.id
INNER JOIN( SELECT f.facility_code,f.facility_name,f.district FROM facilities f ) as temp
ON fi.facility_code=temp.facility_code
INNER JOIN districts sc ON temp.district=sc.id
INNER JOIN counties c ON sc.county=c.id
AND fi.date_issued >= DATE_ADD(now(),INTERVAL -3 MONTH)
 $and_data group by d.id
        
        "); 
        
        $facility_stocks_array = Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll("SELECT c.county,c.id,sc.district,sc.id as sc_id,temp.facility_name,temp.facility_code,
d.commodity_name,d.total_commodity_units,d.id as c_id,avg(fs.current_balance) as total_bal_units,
avg(fs.current_balance)/d.total_commodity_units as total_bal_packs
FROM hcmp_rtk.facility_stocks fs 
LEFT JOIN commodities d ON fs.commodity_id=d.id
INNER JOIN( SELECT f.facility_code,f.facility_name,f.district FROM facilities f ) as temp
ON fs.facility_code=temp.facility_code
INNER JOIN districts sc ON temp.district=sc.id
INNER JOIN counties c ON sc.county=c.id
$and_data and fs.status=1 group by d.id  
        
        "); 
        
         //var_dump($facility_issues_array) ;exit;
        $category_data = array();
        $qty_issued_units = array();
        $qty_issued_monthly = array();
        $qty_issued_packs = array();
        
        foreach ($facility_issues_array as $value) {
            $category_data[] = $value['commodity_name'];
            $qty_issued_units[] = $value['total'];
            $qty_issued_monthly[] = $value['qty_monthly'];
            $amc_packs[] = $value['amc_packs'];
        }
        
        $total_stock_units = array();
        $total_stock_packs = array();
        
        foreach ($facility_stocks_array as $value) {
            $total_stock_units[] = $value['total_bal_units'];
            $total_stock_packs[] = $value['total_bal_packs'];
        }
        $new=array();
        foreach ($category_data as $row) {
            for ($i=0; $i <count($category_data) ; $i++) { 
            $new[$i]=$merge_array=array( 'commodity_name'=>$category_data[$i],'qty_issued_monthly'=>$qty_issued_monthly[$i],
                'amc_packs'=>$amc_packs[$i],'total_stock_packs'=>$total_stock_packs[$i],'mos'=>$total_stock_packs[$i]/$amc_packs[$i]
                );
            }   
            
        }
        //echo "<pre>"; print_r($new);echo "</pre>"; exit;
        
        $commodities = array();
        $amc = array();
        $mos = array();
        foreach ($new as $value) {
            $commodities[] = $value['commodity_name'];
            $amc[] = (int)$value['amc_packs'];
            $mos[] = (int)$value['mos'];
        }
        
        
        $data['graph_type'] = 'column';
        $data['graph_title'] = "$title Stock Level in Months of Stock (MOS)";
        $data['graph_yaxis_title'] = "MOS";
        $data['graph_id'] = $div;
        $data['legend'] = "M.O.S";
        $data['colors'] = "['#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']";
        $data['category_data'] = json_encode($commodities);
        $data['series_data'] =  json_encode($mos);
        $data['series_data2'] =  json_encode($amc);
                
        $this -> load -> view("national/ajax/threashhold_v",$data);
                
            }
}   
    

?>