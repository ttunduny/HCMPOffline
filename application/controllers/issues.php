<?php
/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
   class issues extends MY_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library(array('hcmp_functions','form_validation'));
	}
/*
|--------------------------------------------------------------------------
| facility issuing to service points
|--------------------------------------------------------------------------
|1. load the view/ determine if its a redistribution/ internal issue 
|2. check if the facility has commodity data 
|4. save the data in the facility stock, facility transaction , issues table
*/
	public function index($checker=NULL) {
		//$facility=$this -> session -> userdata('news'); uncomment this
         $facility_code=17401;
			switch ($checker):		
				case 'internal':					
					$data['content_view'] = "facility/facility_issues/facility_issues_service_points_v";
					$data['title'] = "Issues to service points";
					$data['banner_text'] = "Issues to service points";			
					break;
					case 'external':						
						$data['content_view'] = "facility/facility_data/facility_issues/IssueExternal_v";						
						$data['subcounties']=subcounties::get_all_active();
						$data['banner_text'] = "Redistribute Commodities";
						$data['title'] ="Redistribute Commodities";						
					break;									
					default;								
			endswitch;			
		$data['service_point']=service_points::get_all_active($facility_code);		
		$data['commodities'] = facility_stocks::get_distinct_stocks_for_this_facility($facility_code,1);
	    $data['facility_stock_data']=json_encode(facility_stocks::get_distinct_stocks_for_this_facility($facility_code,"batch_data"));	
     	$this -> load -> view("shared_files/template/template", $data);	
		
	}



			}

