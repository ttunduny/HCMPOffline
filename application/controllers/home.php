<?php
/**
 * @author Kariuki & Mureithi
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

		/**
		 * [$identifier description]
		 * saves value of user type
		 * @var [varchar]
		 */
			$identifier = $this -> session -> userdata('user_indicator');

		switch ($identifier) {
			case moh :
				$data['content_view'] = "";
				$view = 'shared_files/template/dashboard_template_v';
				break;
			case facility_admin :
				$data['content_view'] = "";
				$view = 'shared_files/template/template';
				break;
			case district :
				$data['content_view'] = "";
				$view = 'shared_files/template/dashboard_template_v';
				break;
			case moh_user :
				$data['content_view'] = "";
				break;
			case facility :
				$data['content_view'] = "facility/facility_home_v";
				$view = 'shared_files/template/template';
				break;
			case district_tech :
				$data['content_view'] = "";
				break;
			case rtk_manager :
				$data['content_view'] = "";
				break;
			case super_admin :
				$data['content_view'] = "";
				break;
			case allocation_committee :
				$data['content_view'] = "";
				break;
		}

		$data['title'] = "System Home";
		$data['banner_text'] = "Home";
		$this -> load -> view($view, $data);
	}

	public function get_facilities() {
		//for ajax
		$district = $_POST['district'];
		$facilities = Facilities::getFacilities($district);
		$list = "";
		foreach ($facilities as $facilities) {
			$list .= $facilities -> facility_code;
			$list .= "*";
			$list .= $facilities -> facility_name;
			$list .= "_";
		}
		echo $list;
	}

}
