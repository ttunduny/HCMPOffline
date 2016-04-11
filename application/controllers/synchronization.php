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

		
	    $data_from_table['facility_code'] = $facility_code;
		ini_set("memory_limit","200M");
	    foreach ($all_tables as $key => $table_name) {
		    $data_from_table[$table_name] = Sync_model::get_new_data($table_name,$latest_sync_time);
	   		// echo "<pre>";print_r($data_from_table);
        }
	          

		// echo "<pre>";print_r($data_from_table);exit;
		// $write_to_file = $this->receive_data($facility_code,$data_from_table);
		
		// echo FCPATH;exit;
		// echo $write_to_file;exit;
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$stringify = print_r($data_from_table,true);

		$queried_data = http_build_query($data_from_table);

		// echo "<pre>";print_r($queried_data);exit;
		$url = "41.89.6.209/hcmp_demo/synchronization/receive_data/?facility_code=".$facility_code.'?data='.$queried_data;
		
		$local_url = base_url().'synchronization/receive_post';
		$result = $this->post_data($local_url,$data_from_table);
		echo $result;exit;
		// echo $url;exit;
		$ch = curl_init($url);
		$status = curl_exec($ch);
		echo "<pre>";print_r($status);exit;
	        // var_dump($data_from_table);
	}

	public function sample_post()
	{
		$local_directory=dirname(__FILE__).'/local_files/';
		$local_directory = base_url();
		$url = base_url().'synchronization/receive_data_new';
 
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_VERBOSE, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
	    curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_URL,  $url);
		//most importent curl assues @filed as file field
	    $post_array = array(
	        "my_file"=>"@".$local_directory.'sync_data/sample.txt',
	        "upload"=>"Upload"
	    );
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
	    $response = curl_exec($ch);
		echo $response;
		// echo "I work";exit;
	}

	public function receive_data($facility_code,$data)
	{
		// echo "<pre>";print_r($this->input->post());exit;
		// echo "<pre>";print_r($data);exit;
		// ini_set("memory_limit","900M");
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
		$stringify = print_r($data,true);
		$filestamp = $this->generate_filestamp();
		// echo FCPATH."<\br>";
		// echo $_SERVER['DOCUMENT_ROOT']."<br>";
		if(!file_exists(dirname(FCPATH.'sync_files'))): 
		    mkdir(dirname(FCPATH.'sync_files'));
		endif;
		$file = FCPATH.'sync_files/'.$filestamp.'_'.$facility_code.'.txt';
		$file = trim($file);
		$fp = fopen($file, 'w') or die('Cannot open file: '.$file);;

		fwrite($fp, $stringify);

		// fwrite($fp, $data);
		// fclose($fp);
		chmod($file, 0777); 
		// echo $fp;
		// echo "success";
		return $file;
	}

	public function convert_time()
	{
	    echo date("Dd_Hms");
		
	}

	public function post_data($url, $fields)
	{
		$post_field_string = http_build_query($fields, '', '&');
	    
	    $ch = curl_init();
	    
	    curl_setopt($ch, CURLOPT_URL, $url);
	    
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	    
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
	    
	    curl_setopt($ch, CURLOPT_POST, true);
	    
	    $response = curl_exec($ch);
	    
	    curl_close ($ch);
	    
	    return $response;
	}

	public function receive_post(){
		$data = $this->input->post();
		echo "<pre>";print_r($data);
	}

	public function receive_data_new()
	{
		$data = $this->input->post();
		return "i worked";
		echo "<pre>";print_r($data);
	}

}
?>