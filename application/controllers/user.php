<?php
/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class user extends MY_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	public function index() {

		$data['title'] = "Login";
		$this -> load -> view("login_v", $data);
	}

	public function logout(){

		Log::update_log_out_action($this -> session -> userdata('identity'));
		
		$this->session->sess_destroy();
		$data['title'] = "Login";		
		$this -> load -> view("login_v", $data);
	}
	
	public function forgot_password(){
	$this -> load -> view("forgotpassword_v");
	}

			}

