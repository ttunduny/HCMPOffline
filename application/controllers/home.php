<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('Hcmp_functions','form_validation'));
	}

	public function index() {

		$this -> load -> view("shared_files/login_pages/login_v");
	}


	public function home() {

		$data['title'] = "Facility Home";
		$data['content_view'] = "facility/facility_home_v";
		$data['banner_text'] = "Facility Home";
		$data['menu'] = Menu::getAll();
		
		$this -> load -> view("shared_files/template/template", $data);
	}
}
