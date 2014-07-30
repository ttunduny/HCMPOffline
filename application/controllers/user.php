<?php
/**
 * @author Kariuki
 */
 session_start();
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}


	public function index() {
		$data['title'] = "Login";
		$this -> load -> view("shared_files/login_pages/login_v", $data);
	}

	private function _submit_validate() {

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
            $banner_name = '';
			$access_level = Access_level::get_access_level_name($access_typeid);

			$user_indicator = $access_level['user_indicator'];
            
            if ($user_indicator  == 'district') :
             //get county name
            $district_name = districts::get_district_name_($district_id);
            $banner_name = $district_name['district'];
            elseif ($user_indicator  == 'county') :            
            //get county name
            $county_name = Counties::get_county_name($county_id);
            $banner_name = $county_name['county'];
            elseif ($user_indicator  == 'facility' || $user_indicator == 'facility_admin') :
             //get county name
            $facility_name = Facilities::get_facility_name2($facility_id);
            $banner_name = $facility_name['facility_name'];
            endif;
   
			$session_data = array('county_id' => $county_id, 'phone_no' => $phone,
			'user_email' => $user_email, 'user_id' => $user_id, 'user_indicator' => $user_indicator,
			'fname' => $fname, 'lname' => $lname, 'facility_id' => $facility_id,
			'district_id' => $district_id, 'user_type_id' => 
			$access_typeid,'full_name' => $fullname,
			'banner_name'=>$banner_name);

			$this -> session -> set_userdata($session_data);
			
			//get menu items
			$menu_items = Menu::getByUsertype($access_typeid);
			//Create array that will hold all the accessible menus in the session
			$menus = array();
			$menuids = array();
			$counter = 0;
			foreach ($menu_items as $menu_item) {
				$menus[$counter] = array("menu_text" => $menu_item -> menu_text, "menu_url" => $menu_item -> menu_url, "menu_id" => $menu_item -> id, "parent_status" => $menu_item -> parent_status);
				$counter++;
				$menuids[] = $menu_item -> id;

			}
			
			$sub_menus = array();
			foreach ($menuids as $parentid) {

				$sub_items = Sub_menu::getByparent((int)$parentid);

				foreach ($sub_items as $item) {
					$sub_menus[] = array("submenu_text" => $item -> subm_text, "submenu_url" => $item -> subm_url, "menu_id" => $item -> parent_id);

				}

			}
            	
			//Save this menus array in the session
			$this -> session -> set_userdata("menus" ,$menus);
			//Save this sub menus array in the session
		    $_SESSION["submenus"]= $sub_menus; 
		
			//creating a new log value
			Log::update_log_out_action($this -> session -> userdata('user_id'));
		
			$u1 = new Log();
			$action = 'Logged In';
			$u1->user_id = $this -> session -> userdata('user_id');
			$u1->action = $action;
			$u1->save();
			
			redirect('home');
		} else {
			$data['popup'] = "errorpopup";
			$data['title'] = "Login";
			$this -> load -> view("shared_files/login_pages/login_v", $data);
		}
	}

	public function logout() {

		Log::update_log_out_action($this -> session -> userdata('user_id'));

		$this -> session -> sess_destroy(); session_destroy();
		$data['title'] = "Login";
		$this -> load -> view("shared_files/login_pages/login_v", $data);
	}

	public function forgot_password() {

		$this -> load -> view("shared_files/login_pages/forgotpassword_v");

	}

	public function password_recovery() {

		$email = $_POST['username'];

		//check if user exists and is activated

		$myresult = Users::check_user_exist($email);

		//get user details
		if (count($myresult) > 0) {
			foreach ($myresult as $key => $value) {

				$user_id = $value["id"];
				$Usersname = $value["fname"] . " " . $value["lname"];
				$email_address = $value["email"];

			}

			//check if user requested for a password recovery in last 3 days.

			$check_code_request = Log_monitor::check_code_request($user_id);

			if (count($check_code_request) > 0) {
				$data['user_email'] = $email_address;
				$data['popup'] = "request_valid";
				$data['title'] = "Password Recovery";
				$this -> load -> view("shared_files/login_pages/enter_reset_code_v", $data);

			} else {

				//generate random code
				$range = microtime(true);
				$rand = rand(0, $range);
				//encrypt code
				$save_code = md5($rand);
				$result='http://' . $_SERVER['SERVER_NAME'] .'/HCMPv2/assets/img/coat_of_arms-resized1.png';
				
				//Send Code to User
				$subject = "Request For Password Reset";
				$message = '<html>
				<style>
#outlook a{padding:0}body{width:100%!important;min-width:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}.ExternalClass{width:100%}.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td{line-height:100%}#backgroundTable{margin:0;padding:0;width:100%!important;line-height:100%!important}img{outline:0;text-decoration:none;-ms-interpolation-mode:bicubic;width:auto;max-width:100%;float:left;clear:both;display:block}center{width:100%;min-width:580px}a img{border:none}table{border-spacing:0;border-collapse:collapse}td{word-break:break-word;-webkit-hyphens:auto;-moz-hyphens:auto;hyphens:auto;border-collapse:collapse!important}table,td,tr{padding:0;vertical-align:top;text-align:left}hr{color:#d9d9d9;background-color:#d9d9d9;height:1px;border:none}table.body{height:100%;width:100%}table.container{width:580px;margin:0 auto;text-align:inherit}table.row{padding:0;width:100%;position:relative}table.container table.row{display:block}td.wrapper{padding:10px 20px 0 0;position:relative}table.column,table.columns{margin:0 auto}table.column td,table.columns td{padding:0 0 10px}table.column td.sub-column,table.column td.sub-columns,table.columns td.sub-column,table.columns td.sub-columns{padding-right:10px}td.sub-column,td.sub-columns{min-width:0}table.container td.last,table.row td.last{padding-right:0}table.one{width:30px}table.two{width:80px}table.three{width:130px}table.four{width:180px}table.five{width:230px}table.six{width:280px}table.seven{width:330px}table.eight{width:380px}table.nine{width:430px}table.ten{width:480px}table.eleven{width:530px}table.twelve{width:580px}table.one center{min-width:30px}table.two center{min-width:80px}table.three center{min-width:130px}table.four center{min-width:180px}table.five center{min-width:230px}table.six center{min-width:280px}table.seven center{min-width:330px}table.eight center{min-width:380px}table.nine center{min-width:430px}table.ten center{min-width:480px}table.eleven center{min-width:530px}table.twelve center{min-width:580px}table.one .panel center{min-width:10px}table.two .panel center{min-width:60px}table.three .panel center{min-width:110px}table.four .panel center{min-width:160px}table.five .panel center{min-width:210px}table.six .panel center{min-width:260px}table.seven .panel center{min-width:310px}table.eight .panel center{min-width:360px}table.nine .panel center{min-width:410px}table.ten .panel center{min-width:460px}table.eleven .panel center{min-width:510px}table.twelve .panel center{min-width:560px}.body .column td.one,.body .columns td.one{width:8.333333%}.body .column td.two,.body .columns td.two{width:16.666666%}.body .column td.three,.body .columns td.three{width:25%}.body .column td.four,.body .columns td.four{width:33.333333%}.body .column td.five,.body .columns td.five{width:41.666666%}.body .column td.six,.body .columns td.six{width:50%}.body .column td.seven,.body .columns td.seven{width:58.333333%}.body .column td.eight,.body .columns td.eight{width:66.666666%}.body .column td.nine,.body .columns td.nine{width:75%}.body .column td.ten,.body .columns td.ten{width:83.333333%}.body .column td.eleven,.body .columns td.eleven{width:91.666666%}.body .column td.twelve,.body .columns td.twelve{width:100%}td.offset-by-one{padding-left:50px}td.offset-by-two{padding-left:100px}td.offset-by-three{padding-left:150px}td.offset-by-four{padding-left:200px}td.offset-by-five{padding-left:250px}td.offset-by-six{padding-left:300px}td.offset-by-seven{padding-left:350px}td.offset-by-eight{padding-left:400px}td.offset-by-nine{padding-left:450px}td.offset-by-ten{padding-left:500px}td.offset-by-eleven{padding-left:550px}td.expander{visibility:hidden;width:0;padding:0!important}table.column .text-pad,table.columns .text-pad{padding-left:10px;padding-right:10px}table.column .left-text-pad,table.column .text-pad-left,table.columns .left-text-pad,table.columns .text-pad-left{padding-left:10px}table.column .right-text-pad,table.column .text-pad-right,table.columns .right-text-pad,table.columns .text-pad-right{padding-right:10px}.block-grid{width:100%;max-width:580px}.block-grid td{display:inline-block;padding:10px}.two-up td{width:270px}.three-up td{width:173px}.four-up td{width:125px}.five-up td{width:96px}.six-up td{width:76px}.seven-up td{width:62px}.eight-up td{width:52px}h1.center,h2.center,h3.center,h4.center,h5.center,h6.center,table.center,td.center{text-align:center}span.center{display:block;width:100%;text-align:center}img.center{margin:0 auto;float:none}.hide-for-desktop,.show-for-small{display:none}body,h1,h2,h3,h4,h5,h6,p,table.body,td{color:#222;font-family:Helvetica,Arial,sans-serif;font-weight:400;padding:0;margin:0;text-align:left;line-height:1.3}h1,h2,h3,h4,h5,h6{word-break:normal}h1{font-size:40px}h2{font-size:36px}h3{font-size:32px}h4{font-size:28px}h5{font-size:24px}h6{font-size:20px}body,p,table.body,td{font-size:14px;line-height:19px}p.lead,p.lede,p.leed{font-size:18px;line-height:21px}p{margin-bottom:10px}small{font-size:10px}a{color:#2ba6cb;text-decoration:none}a:active,a:hover{color:#2795b6!important}a:visited{color:#2ba6cb!important}h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{color:#2ba6cb}h1 a:active,h1 a:visited,h2 a:active,h2 a:visited,h3 a:active,h3 a:visited,h4 a:active,h4 a:visited,h5 a:active,h5 a:visited,h6 a:active,h6 a:visited{color:#2ba6cb!important}.panel{background:#f2f2f2;border:1px solid #d9d9d9;padding:10px!important}.sub-grid table{width:100%}.sub-grid td.sub-columns{padding-bottom:0}table.button,table.large-button,table.medium-button,table.small-button,table.tiny-button{width:100%;overflow:hidden}table.button td,table.large-button td,table.medium-button td,table.small-button td,table.tiny-button td{display:block;width:auto!important;text-align:center;background:#2ba6cb;border:1px solid #2284a1;color:#fff;padding:8px 0}table.tiny-button td{padding:5px 0 4px}table.small-button td{padding:8px 0 7px}table.medium-button td{padding:12px 0 10px}table.large-button td{padding:21px 0 18px}table.button td a,table.large-button td a,table.medium-button td a,table.small-button td a,table.tiny-button td a{font-weight:700;text-decoration:none;font-family:Helvetica,Arial,sans-serif;color:#fff;font-size:16px}table.tiny-button td a{font-size:12px;font-weight:400}table.small-button td a{font-size:16px}table.medium-button td a{font-size:20px}table.large-button td a{font-size:24px}table.button:active td,table.button:hover td,table.button:visited td{background:#2795b6!important}table.button:active td a,table.button:hover td a,table.button:visited td a{color:#fff!important}table.button:hover td,table.large-button:hover td,table.medium-button:hover td,table.small-button:hover td,table.tiny-button:hover td{background:#2795b6!important}table.button td a:visited,table.button:active td a,table.button:hover td a,table.large-button td a:visited,table.large-button:active td a,table.large-button:hover td a,table.medium-button td a:visited,table.medium-button:active td a,table.medium-button:hover td a,table.small-button td a:visited,table.small-button:active td a,table.small-button:hover td a,table.tiny-button td a:visited,table.tiny-button:active td a,table.tiny-button:hover td a{color:#fff!important}table.secondary td{background:#e9e9e9;border-color:#d0d0d0;color:#555}table.secondary td a{color:#555}table.secondary:hover td{background:#d0d0d0!important;color:#555}table.secondary td a:visited,table.secondary:active td a,table.secondary:hover td a{color:#555!important}table.success td{background:#5da423;border-color:#457a1a}table.success:hover td{background:#457a1a!important}table.alert td{background:#c60f13;border-color:#970b0e}table.alert:hover td{background:#970b0e!important}table.radius td{-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}table.round td{-webkit-border-radius:500px;-moz-border-radius:500px;border-radius:500px}body.outlook p{display:inline!important}@media only screen and (max-width:600px){table[class=body] img{width:auto!important;height:auto!important}table[class=body] center{min-width:0!important}table[class=body] .container{width:95%!important}table[class=body] .row{width:100%!important;display:block!important}table[class=body] .wrapper{display:block!important;padding-right:0!important}table[class=body] .column,table[class=body] .columns{table-layout:fixed!important;float:none!important;width:100%!important;padding-right:0!important;padding-left:0!important;display:block!important}table[class=body] .wrapper.first .column,table[class=body] .wrapper.first .columns{display:table!important}table[class=body] table.column td,table[class=body] table.columns td{width:100%!important}table[class=body] .column td.one,table[class=body] .columns td.one{width:8.333333%!important}table[class=body] .column td.two,table[class=body] .columns td.two{width:16.666666%!important}table[class=body] .column td.three,table[class=body] .columns td.three{width:25%!important}table[class=body] .column td.four,table[class=body] .columns td.four{width:33.333333%!important}table[class=body] .column td.five,table[class=body] .columns td.five{width:41.666666%!important}table[class=body] .column td.six,table[class=body] .columns td.six{width:50%!important}table[class=body] .column td.seven,table[class=body] .columns td.seven{width:58.333333%!important}table[class=body] .column td.eight,table[class=body] .columns td.eight{width:66.666666%!important}table[class=body] .column td.nine,table[class=body] .columns td.nine{width:75%!important}table[class=body] .column td.ten,table[class=body] .columns td.ten{width:83.333333%!important}table[class=body] .column td.eleven,table[class=body] .columns td.eleven{width:91.666666%!important}table[class=body] .column td.twelve,table[class=body] .columns td.twelve{width:100%!important}table[class=body] td.offset-by-eight,table[class=body] td.offset-by-eleven,table[class=body] td.offset-by-five,table[class=body] td.offset-by-four,table[class=body] td.offset-by-nine,table[class=body] td.offset-by-one,table[class=body] td.offset-by-seven,table[class=body] td.offset-by-six,table[class=body] td.offset-by-ten,table[class=body] td.offset-by-three,table[class=body] td.offset-by-two{padding-left:0!important}table[class=body] table.columns td.expander{width:1px!important}table[class=body] .right-text-pad,table[class=body] .text-pad-right{padding-left:10px!important}table[class=body] .left-text-pad,table[class=body] .text-pad-left{padding-right:10px!important}table[class=body] .hide-for-small,table[class=body] .show-for-desktop{display:none!important}table[class=body] .hide-for-desktop,table[class=body] .show-for-small{display:inherit!important}}table.facebook td{background:#3b5998;border-color:#2d4473}table.facebook:hover td{background:#2d4473!important}table.twitter td{background:#00acee;border-color:#0087bb}table.twitter:hover td{background:#0087bb!important}table.google-plus td{background-color:#DB4A39;border-color:#C00}table.google-plus:hover td{background:#C00!important}.template-label{color:#000;font-weight:700;font-size:11px}.callout .wrapper{padding-bottom:20px}.callout .panel{background:#ECF8FF;border-color:#b9e5ff}.header{background:#F0F2F3}.footer .wrapper{background:#ebebeb}.footer h5{padding-bottom:10px}table.columns .text-pad{padding-left:10px;padding-right:10px}table.columns .left-text-pad{padding-left:10px}table.columns .right-text-pad{padding-right:10px}@media only screen and (max-width:600px){table[class=body] .right-text-pad{padding-left:10px!important}table[class=body] .left-text-pad{padding-right:10px!important}}

  </style><body>
		<table class="body">
		<tr>
			<td class="center" align="center" valign="top">
        <center>

          <table class="row header">
            <tr>
              <td class="center" align="center">
                <center>

                  <table class="container">
                    <tr>
                      <td class="wrapper last">

                        <table class="twelve columns">
                          <tr>
                            <td class="six sub-columns">
                              <img src="'.$result.'">
                              <h6 style="margin:15 0 0 10;">HCMP</h6>
                            </td>
                            <td class="six sub-columns last" style="text-align:right; vertical-align:middle;">
                              <span class="template-label"></span>
                            </td>
                            <td class="expander"></td>
                          </tr>
                        </table>

                      </td>
                    </tr>
                  </table>

                </center>
              </td>
            </tr>
          </table>

          <table class="container">
            <tr>
              <td>

                <table class="row">
                  <tr>
                    <td class="wrapper last">

                      <table class="twelve columns">
                        <tr>
                          <td>
                          Hi ' . $Usersname . ', </br>
		<p>
		HCMP account username '.$email_address.'.You recently requested for a password reset.</br>
		If you made this request ,this is your reset code.</br></p> 
	
		<table class="twelve columns">
                        <tr>
                          <td class="panel">
                            <p><strong style="font-size:20px;">' . $rand . '</strong> <a href="#"></a></p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
                      
		</p>
		<p>
		<strong style="font-size:16px;">This code will expire in 3 Days.</strong>
		</p>
		<p>
		If you did not request for a password reset,your account might have been hijacked. </br>
		To get back into your account, you will need to reset your password or contact your administrator.
		</p>
						  
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>

                <table class="row callout">
                  <tr>
                    <td class="wrapper last">

                      

                    </td>
                  </tr>
                </table>

                <table class="row footer">
                  <tr>
                    <td class="wrapper">

                    </td>
                    <td class="wrapper last">

                      <table class="six columns">
                        <tr>
                          <td class="last right-text-pad">
                            <h5>Contact Info:</h5>
                            <p>Phone: +254720xxxxxx</p>
                            <p>Email: <a href="mailto:admin@hcmp.com">admin@hcmp.com</a></p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>


                <table class="row">
                  <tr>
                    <td class="wrapper last">

                      <table class="twelve columns">
                        <tr>
                          <td align="center">
                            <center>
                              <p style="text-align:center;"><a href="#">Terms</a> | <a href="#">Privacy</a> | <a href="#">Unsubscribe</a></p>
                            </center>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>

              <!-- container end below -->
              </td>
            </tr>
          </table>

        </center>
			</td>
		</tr>
	</table>
		</body></html>';

				//exit;

				$this -> hcmp_functions -> send_email($email_address, $message, $subject, $attach_file = NULL, $bcc_email = NULL, $cc_email = NULL);

				//log the password recovery requests as a code
				$Logthis = new Log_monitor();
				$Logthis -> user_id = $user_id;
				$Logthis -> log_activity = 4;
				$Logthis -> forgetpw_code = $save_code;
				$Logthis -> status = 1;
				$Logthis -> save();

				//deactivate user

				Users::set_deactivate_for_recovery($user_id);

				$data['user_email'] = $email_address;
				$data['popup'] = "success";
				$data['title'] = "Password Recovery";
				$this -> load -> view("shared_files/login_pages/enter_reset_code_v", $data);

			}
		} else {

			$data['popup'] = "error_no_exist";
			$data['title'] = "Password Recovery";
			$this -> load -> view("shared_files/login_pages/forgotpassword_v", $data);

		}

	}

	public function confirm_code() {

		$reset_code = $_POST['code'];
		$email = $_POST['username'];
		$code = md5($reset_code);

		//get user details

		$userdetail_result = Users::check_user_exist($email);
		
		foreach ($userdetail_result as $key => $value) {

			$user_id = $value["id"];

		}
		//check if user requested for a password recovery

		$user_code_check_result = Log_monitor::check_code_exist($code, $user_id);
		
		

		if (count($user_code_check_result) > 0) {

			//echo "code correct";
			$data['user_email'] = $email;
			$data['popup'] = "success";
			$data['title'] = "Password Recovery";
			$this -> load -> view("shared_files/login_pages/recover_password_v.php", $data);

		} else {

			$data['user_email'] = $email;
			$data['popup'] = "error";
			$data['title'] = "Password Recovery";
			$this -> load -> view("shared_files/login_pages/enter_reset_code_v", $data);

		}

	}

	public function change_pw_recovery() {

		$email = $_POST['username'];
		$new_pass = $_POST['new_password'];
		$new_password_confirm = $_POST['new_password_confirm'];

		if ($new_pass != $new_password_confirm || $new_pass = "" || $new_password_confirm = "") {
			$data['user_email'] = $email;
			$data['popup'] = "error_nomatch";
			$data['title'] = "Password Recovery";
			$this -> load -> view("shared_files/login_pages/recover_password_v.php", $data);
		} else {
			//get user details
			$new_password_confirm = $_POST['new_password_confirm'];

			$userdetail_result = Users::check_user_exist($email);

			foreach ($userdetail_result as $key => $value) {

				$user_id = $value["id"];

			}

			Users::reset_password($user_id, $new_password_confirm);
			Log_monitor::deactivate_code($user_id);
			$data['user_email'] = $email;
			$data['popup'] = "passwordchange";
			$data['title'] = "Login";
			$this -> load -> view("shared_files/login_pages/login_v.php", $data);

		}

	}

	public function user_create() {

		//get user details in session

		$identifier = $this -> session -> userdata('user_indicator');
		$user_type_id = $this -> session -> userdata('user_type_id');
		$district = $this -> session -> userdata('district_id');
		$county = $this -> session -> userdata('county_id');
		$facility = $this -> session -> userdata('facility_id');
		

		//query to get user listing by type of user

		switch ($identifier):
			case 'moh':
			$permissions='moh_permissions';
			$template = 'shared_files/template/dashboard_template_v';
			break;
			case 'facility_admin':
			$permissions='facilityadmin_permissions';
			$data['listing']= Users::get_user_list_facility($facility);		
			$template = 'shared_files/template/template';
			break;
			case 'district':
			$permissions='district_permissions';
			$data['listing']= Users::get_user_list_district($district);
			$data['facilities']=Facilities::getFacilities($district);
			$data['counts']=Users::get_users_district($district);
			$template = 'shared_files/template/template';
			break;
			case 'moh_user':
			$data['listing']= Users::get_user_list($user_type_id);	
			$template = 'shared_files/template/dashboard_template_v';
			break;
			case 'district_tech':
			$data['listing']= Users::get_user_list($user_type_id);	
			$template = 'shared_files/template/template';
			break;
			case 'rtk_manager':
			$data['listing']= Users::get_user_list($user_type_id);	
			$template = 'shared_files/template/template';
			break;
			case 'super_admin':
			$permissions='super_permissions';
			$data['title'] = "Users";
			$data['content_view'] = "Admin/users_v";
			$data['listing']= Users::get_user_list_all();
			$data['counts']=Users::get_users_count();
			$data['counties']=Counties::getAll();	
			$template = 'shared_files/template/dashboard_v';
			break;
			case 'allocation_committee':
			$data['listing']= Users::get_user_list($user_type_id);	
			$template = 'shared_files/template/template';
			break;	
			case 'county':
			$permissions='county_permissions';
			$data['listing']= Users::get_user_list_county($county);	
			$data['district_data'] = districts::getDistrict($county);
			$data['counts']=Users::get_users_county($county);
			$template = 'shared_files/template/template';
			
			break;	
        endswitch;

        $data['title'] = "User Management";
		$data['user_types']=Access_level::get_access_levels($permissions);	
		$data['banner_text'] = "User Management";
		$data['content_view'] = "shared_files/user_creation_v";
		$this -> load -> view($template, $data);
	}

		public function get_user_type_json()	{
			
			$identifier = $this -> session -> userdata('user_indicator');	
			if ($identifier=="county") {
				$permissions='county_permissions';	
			} elseif($identifier=="facility_admin") {
					$permissions='facilityadmin_permissions';
			}else{
				$permissions='district_permissions';
			}
					
					
			echo json_encode(Access_level::get_access_levels($permissions));
		
		}
		
		public function check_user_json()	{
			
			$test_email=$_POST['email'];
			$mycount=count(Users::check_if_email($test_email));
			if ($mycount > 0) {
				
				$response = array('msg' => 'Username Exists.Try again','response'=> 'false');
				echo json_encode($response);
				
			} else {
				$response = array('msg' => 'Username accepted','response'=> 'true');
				echo json_encode($response);
			}
							
			
		}
		

	public function addnew_user(){

		$identifier = $this -> session -> userdata('user_indicator');

		$fname = $_POST['first_name'];
		$lname = $_POST['last_name'];
		$telephone = $_POST['telephone'];
		$email_address = $_POST['email'];
		$username = $_POST['username'];
		$facility_id = $_POST['facility_id'];
		$district_code = ($_POST['district_name']=='NULL')? 0: $_POST['district_name'];
		$user_type = $_POST['user_type'];
		$full_name= $fname .''.$lname; 
		$county=$_POST['county'];
		switch ($identifier):
			case 'moh':
			
			break;
			case 'facility_admin':
			
			break;
			case 'district':
				
			$district_code=$this -> session -> userdata('district_id');
			
			break;
			case 'super_admin':
			
			case 'county':
			
			
			break;	
        endswitch;
		
		switch ($user_type):
			case 10:
			$savethis =  new Users();
				$savethis -> fname = $fname;
				$savethis -> lname = $lname;
				$savethis -> email = $email_address;
				$savethis -> username = $username;
				$savethis -> password = "123456";
				$savethis -> activation = $save_activation_code ;
				$savethis -> usertype_id = $user_type;
				$savethis -> telephone = $telephone;
				$savethis -> district = $district_code;
				$savethis -> facility = $facility_id;
				$savethis -> status = 1;
				$savethis -> county_id = $county;
				$savethis -> save(); exit;
			break;

        endswitch;

		//Generate a activation code
		
				$range = microtime(true);
				$activation = rand(0, $range);
				//encrypt code to be saved
				$save_activation_code = md5($activation);
			$result='http://' . $_SERVER['SERVER_NAME'] .'/HCMPv2/assets/img/coat_of_arms-resized1.png';
			
			$phone=$telephone;
			$message='Hi, your activation code is '.$activation;
			$this -> hcmp_functions -> send_sms($phones,$message);
		//Send registered user email with password and validation link
		//
		
	    $full_name = $fname.' '.$lname;
		$link = base_url().'user/activation/'.$activation;
		$site_url=base_url();
		$sms_code=$activation;
		
		$subject = "Account Activation";
				 $message = '<html>
				<style> #outlook a{padding:0}body{width:100%!important;min-width:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}.ExternalClass{width:100%}.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td{line-height:100%}#backgroundTable{margin:0;padding:0;width:100%!important;line-height:100%!important}img{outline:0;text-decoration:none;-ms-interpolation-mode:bicubic;width:auto;max-width:100%;float:left;clear:both;display:block}center{width:100%;min-width:580px}a img{border:none}table{border-spacing:0;border-collapse:collapse}td{word-break:break-word;-webkit-hyphens:auto;-moz-hyphens:auto;hyphens:auto;border-collapse:collapse!important}table,td,tr{padding:0;vertical-align:top;text-align:left}hr{color:#d9d9d9;background-color:#d9d9d9;height:1px;border:none}table.body{height:100%;width:100%}table.container{width:580px;margin:0 auto;text-align:inherit}table.row{padding:0;width:100%;position:relative}table.container table.row{display:block}td.wrapper{padding:10px 20px 0 0;position:relative}table.column,table.columns{margin:0 auto}table.column td,table.columns td{padding:0 0 10px}table.column td.sub-column,table.column td.sub-columns,table.columns td.sub-column,table.columns td.sub-columns{padding-right:10px}td.sub-column,td.sub-columns{min-width:0}table.container td.last,table.row td.last{padding-right:0}table.one{width:30px}table.two{width:80px}table.three{width:130px}table.four{width:180px}table.five{width:230px}table.six{width:280px}table.seven{width:330px}table.eight{width:380px}table.nine{width:430px}table.ten{width:480px}table.eleven{width:530px}table.twelve{width:580px}table.one center{min-width:30px}table.two center{min-width:80px}table.three center{min-width:130px}table.four center{min-width:180px}table.five center{min-width:230px}table.six center{min-width:280px}table.seven center{min-width:330px}table.eight center{min-width:380px}table.nine center{min-width:430px}table.ten center{min-width:480px}table.eleven center{min-width:530px}table.twelve center{min-width:580px}table.one .panel center{min-width:10px}table.two .panel center{min-width:60px}table.three .panel center{min-width:110px}table.four .panel center{min-width:160px}table.five .panel center{min-width:210px}table.six .panel center{min-width:260px}table.seven .panel center{min-width:310px}table.eight .panel center{min-width:360px}table.nine .panel center{min-width:410px}table.ten .panel center{min-width:460px}table.eleven .panel center{min-width:510px}table.twelve .panel center{min-width:560px}.body .column td.one,.body .columns td.one{width:8.333333%}.body .column td.two,.body .columns td.two{width:16.666666%}.body .column td.three,.body .columns td.three{width:25%}.body .column td.four,.body .columns td.four{width:33.333333%}.body .column td.five,.body .columns td.five{width:41.666666%}.body .column td.six,.body .columns td.six{width:50%}.body .column td.seven,.body .columns td.seven{width:58.333333%}.body .column td.eight,.body .columns td.eight{width:66.666666%}.body .column td.nine,.body .columns td.nine{width:75%}.body .column td.ten,.body .columns td.ten{width:83.333333%}.body .column td.eleven,.body .columns td.eleven{width:91.666666%}.body .column td.twelve,.body .columns td.twelve{width:100%}td.offset-by-one{padding-left:50px}td.offset-by-two{padding-left:100px}td.offset-by-three{padding-left:150px}td.offset-by-four{padding-left:200px}td.offset-by-five{padding-left:250px}td.offset-by-six{padding-left:300px}td.offset-by-seven{padding-left:350px}td.offset-by-eight{padding-left:400px}td.offset-by-nine{padding-left:450px}td.offset-by-ten{padding-left:500px}td.offset-by-eleven{padding-left:550px}td.expander{visibility:hidden;width:0;padding:0!important}table.column .text-pad,table.columns .text-pad{padding-left:10px;padding-right:10px}table.column .left-text-pad,table.column .text-pad-left,table.columns .left-text-pad,table.columns .text-pad-left{padding-left:10px}table.column .right-text-pad,table.column .text-pad-right,table.columns .right-text-pad,table.columns .text-pad-right{padding-right:10px}.block-grid{width:100%;max-width:580px}.block-grid td{display:inline-block;padding:10px}.two-up td{width:270px}.three-up td{width:173px}.four-up td{width:125px}.five-up td{width:96px}.six-up td{width:76px}.seven-up td{width:62px}.eight-up td{width:52px}h1.center,h2.center,h3.center,h4.center,h5.center,h6.center,table.center,td.center{text-align:center}span.center{display:block;width:100%;text-align:center}img.center{margin:0 auto;float:none}.hide-for-desktop,.show-for-small{display:none}body,h1,h2,h3,h4,h5,h6,p,table.body,td{color:#222;font-family:Helvetica,Arial,sans-serif;font-weight:400;padding:0;margin:0;text-align:left;line-height:1.3}h1,h2,h3,h4,h5,h6{word-break:normal}h1{font-size:40px}h2{font-size:36px}h3{font-size:32px}h4{font-size:28px}h5{font-size:24px}h6{font-size:20px}body,p,table.body,td{font-size:14px;line-height:19px}p.lead,p.lede,p.leed{font-size:18px;line-height:21px}p{margin-bottom:10px}small{font-size:10px}a{color:#2ba6cb;text-decoration:none}a:active,a:hover{color:#2795b6!important}a:visited{color:#2ba6cb!important}h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{color:#2ba6cb}h1 a:active,h1 a:visited,h2 a:active,h2 a:visited,h3 a:active,h3 a:visited,h4 a:active,h4 a:visited,h5 a:active,h5 a:visited,h6 a:active,h6 a:visited{color:#2ba6cb!important}.panel{background:#f2f2f2;border:1px solid #d9d9d9;padding:10px!important}.sub-grid table{width:100%}.sub-grid td.sub-columns{padding-bottom:0}table.button,table.large-button,table.medium-button,table.small-button,table.tiny-button{width:100%;overflow:hidden}table.button td,table.large-button td,table.medium-button td,table.small-button td,table.tiny-button td{display:block;width:auto!important;text-align:center;background:#2ba6cb;border:1px solid #2284a1;color:#fff;padding:8px 0}table.tiny-button td{padding:5px 0 4px}table.small-button td{padding:8px 0 7px}table.medium-button td{padding:12px 0 10px}table.large-button td{padding:21px 0 18px}table.button td a,table.large-button td a,table.medium-button td a,table.small-button td a,table.tiny-button td a{font-weight:700;text-decoration:none;font-family:Helvetica,Arial,sans-serif;color:#fff;font-size:16px}table.tiny-button td a{font-size:12px;font-weight:400}table.small-button td a{font-size:16px}table.medium-button td a{font-size:20px}table.large-button td a{font-size:24px}table.button:active td,table.button:hover td,table.button:visited td{background:#2795b6!important}table.button:active td a,table.button:hover td a,table.button:visited td a{color:#fff!important}table.button:hover td,table.large-button:hover td,table.medium-button:hover td,table.small-button:hover td,table.tiny-button:hover td{background:#2795b6!important}table.button td a:visited,table.button:active td a,table.button:hover td a,table.large-button td a:visited,table.large-button:active td a,table.large-button:hover td a,table.medium-button td a:visited,table.medium-button:active td a,table.medium-button:hover td a,table.small-button td a:visited,table.small-button:active td a,table.small-button:hover td a,table.tiny-button td a:visited,table.tiny-button:active td a,table.tiny-button:hover td a{color:#fff!important}table.secondary td{background:#e9e9e9;border-color:#d0d0d0;color:#555}table.secondary td a{color:#555}table.secondary:hover td{background:#d0d0d0!important;color:#555}table.secondary td a:visited,table.secondary:active td a,table.secondary:hover td a{color:#555!important}table.success td{background:#5da423;border-color:#457a1a}table.success:hover td{background:#457a1a!important}table.alert td{background:#c60f13;border-color:#970b0e}table.alert:hover td{background:#970b0e!important}table.radius td{-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}table.round td{-webkit-border-radius:500px;-moz-border-radius:500px;border-radius:500px}body.outlook p{display:inline!important}@media only screen and (max-width:600px){table[class=body] img{width:auto!important;height:auto!important}table[class=body] center{min-width:0!important}table[class=body] .container{width:95%!important}table[class=body] .row{width:100%!important;display:block!important}table[class=body] .wrapper{display:block!important;padding-right:0!important}table[class=body] .column,table[class=body] .columns{table-layout:fixed!important;float:none!important;width:100%!important;padding-right:0!important;padding-left:0!important;display:block!important}table[class=body] .wrapper.first .column,table[class=body] .wrapper.first .columns{display:table!important}table[class=body] table.column td,table[class=body] table.columns td{width:100%!important}table[class=body] .column td.one,table[class=body] .columns td.one{width:8.333333%!important}table[class=body] .column td.two,table[class=body] .columns td.two{width:16.666666%!important}table[class=body] .column td.three,table[class=body] .columns td.three{width:25%!important}table[class=body] .column td.four,table[class=body] .columns td.four{width:33.333333%!important}table[class=body] .column td.five,table[class=body] .columns td.five{width:41.666666%!important}table[class=body] .column td.six,table[class=body] .columns td.six{width:50%!important}table[class=body] .column td.seven,table[class=body] .columns td.seven{width:58.333333%!important}table[class=body] .column td.eight,table[class=body] .columns td.eight{width:66.666666%!important}table[class=body] .column td.nine,table[class=body] .columns td.nine{width:75%!important}table[class=body] .column td.ten,table[class=body] .columns td.ten{width:83.333333%!important}table[class=body] .column td.eleven,table[class=body] .columns td.eleven{width:91.666666%!important}table[class=body] .column td.twelve,table[class=body] .columns td.twelve{width:100%!important}table[class=body] td.offset-by-eight,table[class=body] td.offset-by-eleven,table[class=body] td.offset-by-five,table[class=body] td.offset-by-four,table[class=body] td.offset-by-nine,table[class=body] td.offset-by-one,table[class=body] td.offset-by-seven,table[class=body] td.offset-by-six,table[class=body] td.offset-by-ten,table[class=body] td.offset-by-three,table[class=body] td.offset-by-two{padding-left:0!important}table[class=body] table.columns td.expander{width:1px!important}table[class=body] .right-text-pad,table[class=body] .text-pad-right{padding-left:10px!important}table[class=body] .left-text-pad,table[class=body] .text-pad-left{padding-right:10px!important}table[class=body] .hide-for-small,table[class=body] .show-for-desktop{display:none!important}table[class=body] .hide-for-desktop,table[class=body] .show-for-small{display:inherit!important}}</style> <style> table.facebook td{background:#3b5998;border-color:#2d4473}table.facebook:hover td{background:#2d4473!important}table.twitter td{background:#00acee;border-color:#0087bb}table.twitter:hover td{background:#0087bb!important}table.google-plus td{background-color:#DB4A39;border-color:#C00}table.google-plus:hover td{background:#C00!important}.template-label{color:#fff;font-weight:700;font-size:11px}.callout .wrapper{padding-bottom:20px}.callout .panel{background:#ECF8FF;border-color:#b9e5ff}.header{background:#999}.footer .wrapper{background:#ebebeb}.footer h5{padding-bottom:10px}table.columns .text-pad{padding-left:10px;padding-right:10px}table.columns .left-text-pad{padding-left:10px}table.columns .right-text-pad{padding-right:10px}@media only screen and (max-width:600px){table[class=body] .right-text-pad{padding-left:10px!important}table[class=body] .left-text-pad{padding-right:10px!important}}</style><body>
		<table class="body">
		<tr>
			<td class="center" align="center" valign="top">
        <center>

          <table class="row header">
            <tr>
              <td class="center" align="center">
                <center>

                  <table class="container">
                    <tr>
                      <td class="wrapper last">

                        <table class="twelve columns">
                          <tr>
                            <td class="six sub-columns">
                              <img src="'.$result.'">
                              <h6 style="margin:15 0 0 10;">HCMP</h6>
                            </td>
                            <td class="six sub-columns last" style="text-align:right; vertical-align:middle;">
                              <span class="template-label"></span>
                            </td>
                            <td class="expander"></td>
                          </tr>
                        </table>

                      </td>
                    </tr>
                  </table>

                </center>
              </td>
            </tr>
          </table>

          <table class="container">
            <tr>
              <td>

                <table class="row">
                  <tr>
                    <td class="wrapper last">

                      <table class="twelve columns">
                        <tr>
                          <td>
                          Hi ' .  $full_name . ', </br>
		<p>
		Your HCMP Account - ' . $email_address . ' -  was recently created.</br>
		Before your account can be activated , you must complete one of the following steps to complete your registration.</br></p> 
	
		<p>
		Step 1. Follow the link below
		<p>
		<p>
		You will only need to visit this URL once to activate your account.</br></p> 
		
		<table class="twelve columns">
                        <tr>
                          <td class="panel">
                            <p><strong style="font-size:14px;">' . $link . '</strong> <a href="#"></a></p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
         <p>
		Step 2. You have received an activation code via sms.Use the code to activate you account on the site.
		<p>           
					  <table class="twelve columns">
                        <tr>
                          <td class="panel">
                            <p><strong style="font-size:14px;">' . $site_url. '</strong> <a href="#"></a></p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
		</p>
		<p>
		Please note - you must complete one of the two steps to become a registered member.</br></p>
		
								  
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>

                <table class="row callout">
                  <tr>
                    <td class="wrapper last">

                      

                    </td>
                  </tr>
                </table>

                <table class="row footer">
                  <tr>
                    <td class="wrapper">

                    </td>
                    <td class="wrapper last">

                      <table class="six columns">
                        <tr>
                          <td class="last right-text-pad">
                            <h5>Contact Info:</h5>
                            <p>Phone: +254xxxxxxxx</p>
                            <p>Email: <a href="mailto:hcmpkenya@gmail.com">hcmpkenya@gmail.com</a></p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>


                <table class="row">
                  <tr>
                    <td class="wrapper last">

                      <table class="twelve columns">
                        <tr>
                          <td align="center">
                            <center>
                              <p style="text-align:center;"><a href="#">Terms</a> | <a href="#">Privacy</a> | <a href="#">Unsubscribe</a></p>
                            </center>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>

              <!-- container end below -->
              </td>
            </tr>
          </table>

        </center>
			</td>
		</tr>
	</table>
		</body></html>';

				
				
				$this -> hcmp_functions -> send_email($email_address, $message, $subject, $attach_file = NULL, $bcc_email = NULL, $cc_email = NULL);

				//exit;

		//save user
				$savethis =  new Users();
				$savethis -> fname = $fname;
				$savethis -> lname = $lname;
				$savethis -> email = $email_address;
				$savethis -> username = $username;
				$savethis -> password = "";
				$savethis -> activation = $save_activation_code ;
				$savethis -> usertype_id = $user_type;
				$savethis -> telephone = $telephone;
				$savethis -> district = $district_code;
				$savethis -> facility = $facility_id;
				$savethis -> status = 0;
				$savethis -> county_id = $county;
				$savethis -> save();
		


	}
	
	public function edit_user(){
		$county = $this -> session -> userdata('county_id');
		$identifier = $this -> session -> userdata('user_indicator');

		$fname = $_POST['fname_edit'];
		$lname = $_POST['lname_edit'];
		$status = $_POST['status'];
		$telephone_edit= $_POST['telephone_edit'];
		$email_edit = $_POST['email_edit'];
		$username_edit = $_POST['username_edit'];
		$user_type_edit_district = $_POST['user_type_edit_district'];
		$district_name_edit = $_POST['district_name_edit'];
		
		$user_id= $_POST['user_id'];
		
		if ($status=="true") {
			
			$status=1;
			
		} elseif($status=="false") {
			
			$status=0;
		}
		if ($identifier=="district") {
			
			$facility_id_edit = $_POST['facility_id_edit_district'];
			
		} elseif($identifier=="county") {
			
			$facility_id_edit= $_POST['facility_id_edit'];
		}
		
		
		//update user
			$update_user = Doctrine_Manager::getInstance()->getCurrentConnection();
			$update_user->execute("UPDATE `user` SET fname ='$fname' ,lname ='$lname',email ='$email_edit',usertype_id =$user_type_edit_district,telephone ='$telephone_edit',
									district ='$district_name_edit',facility ='$facility_id_edit',status ='$status',county_id ='$county'
                                  	WHERE `id`= '$user_id'");
		
	}
		public function activation($myurl){
			
			$myurl=$this->uri->segment(3);
			$cipher= md5($myurl);
						
			//query to find match 
			Users::check_activation($cipher);
			$restrict= count(Users::check_activation($cipher));
			
			
			if ($restrict==0) {
				
    				$this -> load -> view('shared_files/404');
				}else {
					$this -> load -> view('shared_files/activation');
				}
	
		}
		
		public function activation_final_phase(){
			
			$email = $_POST['username'];
			$password = $_POST['new_password'];
			
			
			//confirm user exists and is inactive
			
			$data=Users::check_user_exist_activate($email);
			foreach ($data as $key => $value) {					
				
				$user_id=$value->id;
			}
			
			$new_password_confirm=$password ;
			
			Users::reset_password($user_id, $new_password_confirm);
			
			
		}


		public function save_new_password() {
			
		$id=$this -> session -> userdata('user_id');		
		$old_password=$_POST['current_password'];
		$new_passw=$_POST['new_password_confirm'];
		$salt = '#*seCrEt!@-*%';
		//retrieve password and compare
		
		$getdata=Users::getuserby_id($id);
		$db_password=$getdata[0]['password'];
		//echo "</br>";
		$captured_password=( md5($salt . $old_password));
		//exit;
		// $valid_old_password = $this -> correct_current_password($db_password,$captured_password);
		 
		 if ($db_password != $captured_password) {
			$response = array('msg' => '<div class="bg-danger">Your current password does not match.Please try again</div>','response'=> 'false');
			 
			echo json_encode($response);
			//echo "Dont match";
		} else {
			
			$salt = '#*seCrEt!@-*%';
		
			$new_password=( md5($salt . $new_passw));						
			$updatep = Doctrine_Manager::getInstance()->getCurrentConnection();			
//update password
			$updatep->execute("UPDATE user SET password='$new_password'  WHERE id='$id'; ");
			$response = array('msg' => 'Success!!! Your password has been changed. Exit to continue','response'=> 'true');
			echo json_encode($response);
		}
		
		

	}

		public function sms_activate(){
	
			$this -> load -> view("shared_files/sms_activation_v");
		}
		
		
		public function sms_activation(){
	
			
			$phone = $_POST['phone_n'];
			$actication_code= $_POST['a_code'];
			$new_pass = $_POST['new_password'];
			$write_new = $_POST['new_password_confirm'];
			$code = md5($actication_code);
			$exist_active=Users::check_db_activation($phone,$code);
			$count=count($exist_active);
			$new_password_confirm=$write_new;
			
		
		    if ($new_pass != $write_new || $new_pass = "" || $write_new = ""||$phone="") {
			$data['popup'] = "error_nomatch";
			$data['title'] = "Password Recovery";
			$this -> load -> view("shared_files/sms_activation_v", $data);
			
		} else {
				foreach ($exist_active as $key => $value) {

				$user_id = $value["id"];
				$activation_db = $value["activation"];

			}
			
			
			if ($count>0 && $activation_db=$code) {
				//update as activated
				
				Users::reset_password($user_id, $new_password_confirm);
				$data['popup'] = "activation";
				$data['title'] = "Password Recovery";
				$this -> load -> view("shared_files/login_pages/login_v", $data);
				
			} else {
				
				$data['popup'] = "error_nomatch";
				$data['title'] = "Password Recovery";
				$this -> load -> view("shared_files/sms_activation_v", $data);
			}
			
			

		}
			

			
		}

}
