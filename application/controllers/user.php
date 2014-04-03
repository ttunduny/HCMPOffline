<?php
/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class User extends MY_Controller {

	function __construct() 
	{
		parent::__construct();

		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library('form_validation');
	}


	public function index() {
		$data['title'] = "Login";
		$this -> load -> view("shared_files/login_pages/login_v", $data);
	}

	private function _submit_validate() 
	{

		$this -> form_validation -> set_rules('username', 'Username', 'trim|required|callback_authenticate');

		$this -> form_validation -> set_rules('password', 'Password', 'trim|required');

		$this -> form_validation -> set_message('authenticate', 'Invalid login. Please try again.');

		return $this -> form_validation -> run();

	}

	

public function login_submit() {
		
		
		$user = new Users();

		$password = $this -> input -> post('password');
		$username = $this -> input -> post('username');
		$returned_user = $user -> login($username, $password);
		
		//var_dump($returned_user);
		//echo count($returned_user);
		//exit;
		//If user successfully logs in, proceed here
		if ($returned_user) {
			//Create basic data to be saved in the session
		$reply = Users::login($username, $password);
		$user_data = $reply -> toArray();

		$access_typeid = $user_data['usertype_id'];
		$fname = $user_data['fname'];
		$user_id = $user_data['id'];
		$lname = $user_data['lname'];
		$district_id = $user_data['district'];
		$facility_id = $user_data['facility'];
		$phone = $user_data['telephone'];
		$user_email = $user_data['email'];
		$county_id = $user_data['county_id'];
		$fullname = $fname . ' ' . $lname;

		//get county name
		$county_name = Counties::get_county_name($county_id);
		$county_name = $county_name['county'];
		//exit;
		
		$access_level = Access_level::get_access_level_name($access_typeid);
		$user_indicator = $access_level['user_indicator'];

		$session_data = array('county_id' => $county_id, 
		'phone_no' => $phone, 
		'user_email' => $user_email, 
		'user_id' => $user_id, 
		'user_indicator' => $user_indicator, 
		'fname' => $fname, 
		'lname' => $lname, 
		'facility_id' => $facility_id,//facility code 
		'district_id' => $district_id,
		'county_name' => $county_name, 
		'full_name' => $fullname);

		$this -> session -> set_userdata($session_data);

		//get menu items
		$menu_items = Menu::getByUsertype($access_typeid);
		//Create array that will hold all the accessible menus in the session
		$menus = array();
		$menuids = array();
		$counter = 0;
		foreach ($menu_items as $menu_item) {
			$menus[$counter] = array("menu_text" => $menu_item -> menu_text, "menu_url" => $menu_item -> menu_url,"menu_id" => $menu_item -> id,"parent_status" => $menu_item -> parent_status);
			$counter++;
			$menuids[]=$menu_item -> id;
			
			
		}
		$sub_menus = array();
		foreach ($menuids as $parentid) {
			
			$sub_items=Sub_menu::getByparent((int)$parentid);
			
			 foreach ($sub_items as $item) {
			$sub_menus[] = array("submenu_text" => $item -> subm_text, "submenu_url" => $item -> subm_url,"menu_id" => $item -> parent_id);
			
		}
			
		
		}	 
		
			//var_dump($menus);
			//var_dump($sub_menus);
			 //exit;	
		//Save this menus array in the session
		$this -> session -> set_userdata(array("menus" => $menus));
		//Save this sub menus array in the session
		$this -> session -> set_userdata(array("sub_menus" => $sub_menus));
		
		redirect('Home');	
		} else {
			$data['popup'] = "errorpopup";
			$data['title'] = "Login";
			$this -> load -> view("shared_files/login_pages/login_v", $data);
		}
	}

	public function logout() {

		//Log::update_log_out_action($this -> session -> userdata('identity'));

		$this -> session -> sess_destroy();
		$data['title'] = "Login";
		$this -> load -> view("shared_files/login_pages/login_v", $data);
	}

	public function forgot_password() {

		$this -> load -> view("user/forgotpassword_v");

	}

}
