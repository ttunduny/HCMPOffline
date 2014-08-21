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
	        ->fetchAll("SELECT distinct c.id, c.kenya_map_id as county_fusion_map_id,  
	        c.county as county_name from counties c, user u where 
	        c.id = u.`county_id` and (u.usertype_id = 2)");// change  !!!!!!!!!!!!!
        $county_name = array();
        $map = array();
        $datas = array();
        $status = '';
        foreach ($counties as $county) {
            $countyMap = (int)$county['county_fusion_map_id'];
            $countyName = $county['county_name'];
            array_push($county_name,array($county['id']=>$countyName));
            $datas[] = array('id' => $countyMap, 
            'value' => $countyName, 
            'color' => 'FFCC99', 
            'tooltext' => $countyName , "baseFontColor" => "000000", 
            "link" => "Javascript:run('" .$county['id']. "^" .$countyName. "')");
        }
        $map = array("baseFontColor" => "000000", "canvasBorderColor" => "ffffff", 
        "hoverColor" => "aaaaaa", "fillcolor" => "F7F7F7", "numbersuffix" => "M", 
        "includevalueinlabels" => "1", "labelsepchar" => ":", "baseFontSize" => "9",
        "borderColor" => "333333 ","showBevel" => "0", 'showShadow' => "0");
        $styles = array("showBorder" => 0);
        $finalMap = array('map' => $map, 'data' => $datas, 'styles' => $styles);
		$data['title'] = "National Dashboard";
        $data['maps'] = json_encode($finalMap);
        $data['counties']=$county_name;
		
        $this -> load -> view("national/dashboard",$data);
    } 


	public function facility_breakdown_pie()
	{
		
		$this -> load -> view("national/ajax/pie_template");
		
	}
	
	public function mos_graph()
	{
		
		$this -> load -> view("national/ajax/bar_template");
		
	}
	public function roll_out()
	{
		
		$this -> load -> view("national/ajax/doughnut_template");
		
	}
    
}   
    

?>