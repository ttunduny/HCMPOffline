<?php
/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Reports extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('hcmp_functions','form_validation'));
	}
	public function index() {

		//$this -> load -> view("shared_files/login_pages/login_v");
	}
/*
|--------------------------------------------------------------------------
| SHARED REPORTS 
|--------------------------------------------------------------------------
*/
// get the commodity listing here
	public function commodity_listing(){
		$data['title'] = "Commodity Listing";
		$data['banner_text'] = "Commodity Listing";
		$data['content_view'] = "shared_files/commodities/commodity_list_v";
		$data['commodity_list']=commodity_sub_category::get_all();
		$this -> load -> view('shared_files/template/template', $data);
	}
/*
|--------------------------------------------------------------------------
| FACILITY REPORTS 
|--------------------------------------------------------------------------
*/
public function facility_stock_data(){///////////////////GET FACILITY STOCK DATA/////////////////////////////
                $facility_code=$this -> session -> userdata('facility_id');
				$data['facility_stock_data']=facility_stocks::get_distinct_stocks_for_this_facility($facility_code,'batch_data');
				$data['title'] = "Facility Stock";
     			$data['content_view'] = "facility/facility_reports/facility_stock_data_v";
				$data['banner_text'] = "Facility Stock";
				$this -> load -> view("shared_files/template/template", $data);	
}

    public function facility_transaction_data(){// get the facility transaction data for ordering or quick analysis 
    	        $facility_code=$this -> session -> userdata('facility_id');
				$data['facility_stock_data']=facility_transaction_table::get_all($facility_code);
				$data['title'] = "Facility Stock Summary";
     			$data['content_view'] = "facility/facility_reports/facility_transaction_data_v";
				$data['banner_text'] = "Facility Stock Summary";
				$this -> load -> view("shared_files/template/template", $data);	
    }
	
}

?>