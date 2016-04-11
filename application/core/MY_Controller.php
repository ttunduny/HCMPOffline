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

} 