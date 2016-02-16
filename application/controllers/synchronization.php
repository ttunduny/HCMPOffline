<?php 
/**
 * @author Karsan
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Synchronization extends MY_Controller {

	function __construct() {
		parent::__construct();
		//this comment is for you nigga
		//erase it 
		//hahaha
	}

	public function synchronize_data(){
		$time = sync_model::get_latest_timestamp();
		// $time = $this->last_sync_time();
		echo "<pre>"; print_r($time); echo "</pre>";
	}

	public function last_sync_time(){
		$time = sync_model::get_latest_timestamp();
		return $time[0]['last_sync_date'];
	}

	public function tester(){
		$data['content_view'] = "testers/sync";
		$template = 'shared_files/template/template';
		$this -> load -> view($template, $data);

	}
}

 ?>