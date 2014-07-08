<?php
/**
 * @author Mureithi
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}


	public function index() {
		$data['title'] = "Commodities";
		$this -> load -> view("", $data);
	}
	
	public function manage_commodities() {
		$data['title'] = "Commodities";
		$data['content_view'] = "Admin/commodities_v";
		$data['commodity_list'] = commodity_sub_category::get_all();
		$this -> load -> view("shared_files/template/dashboard_v", $data);
	}
	public function commodities_upload() {
		
	}
	
	public function manage_users() {
		$permissions='super_permissions';
		$data['title'] = "Users";
		$data['content_view'] = "Admin/users_v";
		$data['listing']= Users::get_user_list_all();
		$data['counts']=Users::get_users_count();
		$data['counties']=Counties::getAll();
		$data['user_types']=Access_level::get_access_levels($permissions);
		$this -> load -> view("shared_files/template/dashboard_v", $data);
	}
	
}