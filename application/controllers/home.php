<?php
/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('hcmp_functions','form_validation'));
	}


	public function index() {

		$this -> load -> view("shared_files/login_pages/login_v");
	}


	public function home() {

		
		$identifier = $this -> session -> userdata('user_indicator');
		
		if ($identifier == 'moh') {
			$data['content_view'] = "";
		}
		if ($identifier == 'facility_admin') {
			$data['content_view'] = "";
		}
		if ($identifier == 'district') {
			$data['content_view'] = "";
		}
		
		if ($identifier == 'moh_user') {
			$data['content_view'] = "";
		}
		
		if ($identifier== 'facility') {
			$data['content_view'] = "facility/facility_home_v";
		}
		
		if ($identifier == 'district_tech') {
			$data['content_view'] = "";
		}
		
		if ($identifier== 'rtk_manager') {
			$data['content_view'] = "";
		}
		
		if ($identifier == 'super_admin') {
			$data['content_view'] = "";
		}

		if ($identifier == 'allocation_committee') {
			$data['content_view'] = "";
		}

		
		$data['title'] = "System Home";
		$data['banner'] = "Home";
		$this -> load -> view('shared_files/template/template', $data);
	}
	
	
}
