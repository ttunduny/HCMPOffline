<?php 
/**
 * @author Karsan
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Synchronization extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	function index(){
		$data['title'] = "System Database Updates";
		$time = sync_model::get_latest_timestamp();
		$sync_data = sync_model::get_sync_data();
		$update_status = $this->system_update_status();
		// echo "<pre>";print_r($sync_data);exit;
		$data['sync_data'] = $sync_data;
		$data['update_status'] = $update_status;
		// echo $status;exit;
		$data['last_sync'] = $time;
		$data['banner_text'] = "Database Synchronization";		
		$template = 'shared_files/template/template';			
		$data['content_view'] = 'facility/facility_db';			
		
		$this -> load -> view($template, $data);

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

	public function sync(){
		$facility_code = $this->session->userdata('facility_id');
		// echo $facility_code;exit;
	    $all_tables = $this->db->list_tables();
	    // $tables_to_be_ignored = array('commodities','commodity_division_details','facilities');//add tables to be ignored by database sync

	    foreach ($tables_to_be_ignored as $key => $value) {
		    if(($key = array_search($value, $all_tables)) !== false) {
		    	unset($all_tables[$key]);
		    }
		}
		$all_tables = array_values($all_tables);//index reset
	    // echo "<pre>";print_r($all_tables);exit;

	    $latest_sync_time = sync_model::get_latest_timestamp();
	    // echo "<pre>";print_r($latest_sync_time);exit;
	    $final_data_from_table = array();
	    $table_count = count($all_tables);

		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
	    $data_from_table['facility_code'] = $facility_code;
		ini_set("memory_limit","200M");
	    foreach ($all_tables as $key => $table_name) {
		    $data_from_table[$table_name] = Sync_model::get_new_data($table_name,$latest_sync_time);
	   		// echo "<pre>";print_r($data_from_table);
        }
	          

		// echo "<pre>";print_r($data_from_table);exit;
		$write_to_file = $this->receive_data($facility_code,$data_from_table);
		echo $write_to_file;exit;
	        // var_dump($data_from_table);
	}

	public function receive_data($facility_code,$data)
	{
		// ini_set("memory_limit","900M");
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);

		$stringify = print_r($data,true);
		$filestamp = $this->generate_filestamp();

		$file = 'sync_files/'.$filestamp.'_'.$facility_code.'.txt';

		$fp = fopen($file, 'w');

		fwrite($fp, $stringify);

		// fwrite($fp, $data);
		// fclose($fp);
		chmod($file, 0777); 

		echo "success";
	}

	public function convert_time()
	{
	    echo date("Dd_Hms");
		
	}

}
?>