<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home_Controller extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	public function index() {

		$this -> load -> view("login_v");
	}


	public function home() {
		
		
		$data['title'] = "Facility Home";
		$data['content_view'] = "facility_home_v";
		$data['banner_text'] = "Facility Home";
		$data['menu'] = Menu::getAll();
		
		$this -> load -> view("template", $data);
	}
}
