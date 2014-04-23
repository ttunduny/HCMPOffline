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
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
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

		$this -> load -> view("shared_files/login_pages/forgotpassword_v");

	}

	public function password_recovery(){
		
		$email=$_POST['username'];

		
		
		$myresult= Users::check_user_exist($email);
		

		if(count($myresult) > 0)

		{

  //generate random code
  	$range=microtime(true) ;
   	$rand = rand(0, $range);
   	//encrypt code
   	$save_code= md5($rand );

   	//retrieve user details to be used 
		
		foreach ($myresult as $key => $value) {

			$Usersname= $value["fname"]." ".$value["lname"];
			$email_address=$value["email"];
			$user_id=$value["id"];
			
		}
   		//log the password recovery requests as a code
		$Logthis=new Log_monitor();
		$Logthis->user_id=$user_id;
		$Logthis->log_activity=4;
		$Logthis->forgetpw_code=$save_code;
		//$Logthis->save();

		
		
		//Send Code to User
		$subject="Request For Password Reset";
		$message="<html><body>
		<div style='border-color: #666; margin:auto;'>	
		Hi ".$Usersname.", </br>
		<p>
		You (HCMP Account - ".$email_address." - )  recently requested for a password reset.</br>
		If you made this request this is your reset code.</br></p> 
		<p>
		<strong style='font-size:20px;'>". $rand ."</strong>
		</p>
		<p>
		<strong style='font-size:16px;'>This code will expire in 3 Days</strong>
		</p>
		<p>
		If you didn't request for a password reset,your account might have been hijacked. </br>
		To get back into your account, you'll need to reset your password or contact your administrator.
		</p>
		<p>
		Yours sincerely,</br>
		</p>
		<p>
		The HCMP team.</br>
		</p>
		This email can't receive replies. </br> For more information, Contact your Administrator.
		</body></html>";

			//exit;


		//$this->hcmp_functions ->send_email($email_address,$message,$subject,$attach_file=NULL,$bcc_email=NULL,$cc_email=NULL);
			
			$data['user_email'] = $email_address;
			$data['popup'] = "successpopup";
			$data['title'] = "Password Recovery";
			$this -> load -> view("shared_files/login_pages/enter_reset_code_v", $data);
		}

	else
		{

   			$data['popup'] = "error_no_exist";
			$data['title'] = "Password Recovery";
			$this -> load -> view("shared_files/login_pages/forgotpassword_v", $data);

		}

	
			
	}

	public function confirm_code() {

		$reset_code=$_POST['code'];
		$email=$_POST['username'];
		$code=md5($reset_code);

		$userdetail_result= Users::check_user_exist($email);

		foreach ($userdetail_result as $key => $value) {

			$user_id=$value["id"];
			
		}

		$user_code_check_result= Log_monitor::check_code_exist($code,$user_id);



		if(count($user_code_check_result) > 0)

		{

			echo "code correct";
		}else{
			echo "code wrong";

		}

		//$this -> load -> view("shared_files/login_pages/forgotpassword_v");

	}

}
