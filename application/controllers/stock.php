<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Stock extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('Hcmp_functions','form_validation'));
	}
	
	/* adding stocks the first time a facility is about to use the tool*/
	
	public function facility_stock_first_run(){
	
	    $data['title'] = "Update Stock Level on First Run";
     	$data['content_view'] = "facility/facility_stock_data/update_facility_stock_on_first_run_v";
		$data['banner_text'] = "Update Stock Level on First Run";
		$data['commodities'] = Commodities::get_all();
		$this -> load -> view("shared_files/template/template", $data);	
		
	}
}

?>