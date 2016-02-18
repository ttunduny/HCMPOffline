<?php
/**
 * @author Mureithi
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');


/**This controller is responsible for sending the data to the main server**/
class Client_sync extends MY_Controller {


	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		// $this -> load -> library(array('hcmp_functions', 'form_validation'));
	}


	function index(){
		$data['title'] = "System Database Updates";
		// $data['last_sync'] = $current_time =date('Y-m-d H:i:s');//this is wrong. last sync is to be gotten from database
		$data['last_sync'] = 
		$data['banner_text'] = "System Database Management";		
		$template = 'shared_files/template/template';			
		$data['content_view'] = 'facility/facility_db';			
		
		$this -> load -> view($template, $data);

	}


	function get_facility_issues($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_issues WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_commodity_source_other_prices($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  commodity_source_other_prices WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_dispensing_stock_prices($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  dispensing_stock_prices WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_drug_store_issues($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  drug_store_issues WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_drug_store_transaction_table($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  drug_store_transaction_table WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_facilities($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facilities WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_facility_amc($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_amc WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}
	
	function get_facility_amc1($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_amc1 WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}
	
	function get_facility_stocks_temp($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_stocks_temp WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_facility_transaction_table($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_transaction_table WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_facility_user_log($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_user_log WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_malaria_data($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  malaria_data WHERE facility_id ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_patient_details($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  patient_details WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_reversals($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  reversals WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}


	function get_rh_drugs_data($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  rh_drugs_data WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_service_point_stocks($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  service_point_stocks WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}


	function get_facility_evaluation($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_evaluation WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_facility_impact_evaluation($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_impact_evaluation WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_facility_monthly_stock($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_monthly_stock WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_facility_orders($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_orders WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_facility_stock_out_tracker($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_stock_out_tracker WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}

	function get_facility_stocks($facility_code,$last_sync_time){		
		$sql = " SELECT * FROM  facility_stocks WHERE facility_code ='$facility_code' and last_updated > '$last_sync_time'";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll($sql);
		return $result;
	}
	


	

}



?>