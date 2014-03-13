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
		    $facility_code=$this -> session -> userdata('facility_id'); 
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
	}//add service points
public function add_service_points(){
	$facility_code=$this -> session -> userdata('facility_id');
	$data['title'] ="Facility Service Points";	
	$data['banner_text'] = "Facility Service Points";
	$data['service_point']=service_points::get_all_active($facility_code,'all');	
	$data['content_view'] = "facility/facility_issues/add_service_points_v";
	$this -> load -> view("shared_files/template/template", $data);	
}// save service points 
public function save_service_points(){
//security check
if($this->input->post('service_point')):
$service_point_name=$this->input->post('service_point');
$service_for_all_facilities=0;
$date_of_entry=date('y-m-d H:i:s');
if($this -> session -> userdata('user_indicator')=='super_admin'){$service_for_all_facilities=1;}
foreach($service_point_name as $service_point_name):
$myarray=array('facility_code'=>$this -> session -> userdata('facility_id'),
'service_point_name'=>$service_point_name,
'for_all_facilities'=>$service_for_all_facilities,
'date_added'=>$date_of_entry,
'added_by'=>$this -> session -> userdata('user_id'));
service_points::update_service_points($myarray); 
endforeach;
$this->session->set_flashdata('system_success_message', "service points Have Been Updated"); 
redirect('issues/add_service_points');	
endif;	
redirect();
}
//update the service point incase smthin changes
public function update_service_point(){
//security check
if($this->input->post('id')):
$service_point_id=$this->input->post('id');
$service_point_name=$this->input->post('name');
$service_status=$this->input->post('status');
$service_for_all_facilities=$this->input->post('all_facilities');
service_points::edit_service_point($service_point_id,$service_point_name,
$service_for_all_facilities,$this -> session -> userdata('user_id'),$service_status);
$this->session->set_flashdata('system_success_message', "service points Have Been Updated"); redirect('issues/add_service_points');		
endif;	
redirect();
}
}

