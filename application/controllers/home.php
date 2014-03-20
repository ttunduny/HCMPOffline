<?php
/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}

	

	public function index() {

		$identifier = $this -> session -> userdata('user_indicator');

		if ($identifier == 'moh') {
			$data['content_view'] = "";
			$view='shared_files/template/dashboard_template_v';
		}
		if ($identifier == 'facility_admin') {
			$data['content_view'] = "";
			$view='shared_files/template/template';
		}
		if ($identifier == 'district') {
			$data['content_view'] = "";
			$view='shared_files/template/dashboard_template_v';
		}

		if ($identifier == 'moh_user') {
			$data['content_view'] = "";
		}

		if ($identifier == 'facility') {
			$data['content_view'] = "facility/facility_home_v";
			$view='shared_files/template/template';
		}

		if ($identifier == 'district_tech') {
			$data['content_view'] = "";
		}

		if ($identifier == 'rtk_manager') {
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
		$this -> load -> view($view, $data);
	}

	
		public function get_facilities(){
		//for ajax
		$district=$_POST['district'];
		$facilities=Facilities::getFacilities($district);
		$list="";
		foreach ($facilities as $facilities) {
			$list.=$facilities->facility_code;
			$list.="*";
			$list.=$facilities->facility_name;
			$list.="_";
		}
		echo $list;
	}
	
	
}
