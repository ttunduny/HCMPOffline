<?php
/*
@author Karsan
*/
class  MY_Controller  extends  CI_Controller  {

    function __construct()
    {
        parent::__construct(); 
        ini_set("memory_limit","300M");
		ini_set('upload_max_filesize', '100M');
		ini_set('post_max_size', '100M'); 
		// $this->load->model('git_updater_model');
		
    }
    /*GENERIC CLASSES FOR GITHUB UPDATES TO LOCAL MACHINES FROM GITHUB REPOSITORY*/
    public function system_update_status()
	{
		$hash = $this->get_hash();
		$local_hash = $this->github_update_status_local();
		if ($hash != $local_hash) {
			$status = 1;
		}else{
			$status = 0;
		}
		// echo $hash;exit;

		return $status;
	}

	public function get_hash(){
		// echo "I WAS HERE";
		$res = $this->github_updater->get_hash();
		// echo "<pre>"; print_r($res);
		return $res;
	}

	public function github_update_status_local(){
		$hash = $this->get_hash();
		$local_hash = git_updater_model::get_latest_hash();
		$actual_hash = $local_hash[0]['hash_value'];

		return $actual_hash;
	}
	/*END OF GENERIC FUNCTION(S) FOR GITHUB UPDATES*/

	/*GENERIC FUNCTION FOR GENERATING THE SYSTEM'S FORMAT FOR NAMING DYNAMICALLY GENERATED FILES*/
	/*SIMPLE BUT NECESSARY FOR REFERENCE WHEN READING THESE FILES FOR PROCESSING*/
	public function generate_filestamp()
	{
		$file_name_header = date("Dd_Hms");//sample output: Sun10_220434. Sunday,10th,22:04:34
		return $file_name_header;
	}
	/*END OF FILESTAMP GENERATION FUNCTION(S)*/

	/*GENERIC DATABASE FUNCTIONS*/
	public function get_all_tables()
	{
		$all_tables = $this->db->list_tables();
		return $all_tables;
	}

	public function get_column_by_type($table_name,$type)
	    {
	    	$fields = $this->db->field_data($table_name);
			// echo "<pre>";print_r($fields);
			foreach ($fields as $key => $value) {
				$db_type = '';
				$db_type = $value->type;
				// echo $db_type
				if ($db_type == $type){
					$column = $value->name;
				}
			}
			// exit;
			return $column;
		}

	public function add_timestamps_to_all_tables()
	{
		$all_tables = $this->get_all_tables();
		$modified_tables = array();

		foreach ($all_tables as $key => $value) {
			$existent_column = $this->get_column_by_type($value,'timestamp');
			if (empty($existent_column)) {
				$addition = $this->db->query("ALTER TABLE $value ADD COLUMN `added_on` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP");
				$modified_tables[$value] = $addition;
			}
			// echo $value.' '.$existent_column."<pre>";
		}
		echo "Successful timestamp addition.<\br> Modified tables are as follows with their respective query status'<pre>";print_r($modified_tables);exit;
		// ALTER TABLE `hcmp_rtk`.`selected_service_points`
		// ADD COLUMN `added_on` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

	}
	/*END OF GENERIC DATABASE FUNCTIONS*/

	/*FTP*/
	public function ftp_upload($file_path,$file_name)
	{
		ob_end_clean();
		$this->load->library('ftp');

		$config['hostname'] = '41.89.6.209';
		$config['username'] = 'hcmp_ftp';
		$config['password'] = 'Hcmp_FTP@#2016';
		$config['debug']	= TRUE;

		$this->ftp->connect($config);

		$status = $this->ftp->upload($file_path,$file_name);

		$this->ftp->close();

		return $status;
		// echo "<pre>"; print_r($status);
	}
	/*END OF FTP*/

	/*CREATING ZIP FILES*/
	
	/*END OF CREATING ZIP FILES*/
} 