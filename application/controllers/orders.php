<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
 /**
 * @author Kariuki
 */
class orders extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('hcmp_functions','form_validation'));
	}
	public function index() {
		//$this -> load -> view("shared_files/login_pages/login_v");
	}
	public function facility_order(){
		$facility_code=$this -> session -> userdata('facility_id'); 
		$data['content_view'] = "facility/facility_orders/facility_order_from_kemsa_v";
	    $data['title'] = "Facility New Order";
		$data['banner_text'] =  "Facility New Order";
		$data['drawing_rights'] =  100;
		$data['order_details']=$data['facility_order'] = Facility_Transaction_Table::get_commodities_for_ordering($facility_code);
		$data['facility_commodity_list']=Commodities::get_facility_commodities($facility_code);
		$this -> load -> view('shared_files/template/template', $data);	
	}
	
	
}
