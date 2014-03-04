<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Stock extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('Hcmp_functions','form_validation'));
	}
	
	/* adding stocks the first time a facility is about to use the tool STEP 1*/
	
	public function facility_stock_first_run(){
	
	    $data['title'] = "Update Stock Level on First Run";
     	$data['content_view'] = "facility/facility_stock_data/update_facility_stock_on_first_run_v";
		$data['banner_text'] = "Update Stock Level on First Run";
		$data['commodities'] = Commodities::get_all();
		$data['commodity_source']=commodity_source::get_all();
		$this -> load -> view("shared_files/template/template", $data);	
		
	}	//auto save the data here
	public function autosave_update_stock(){
//security check	  
if($this->input->is_ajax_request()):	
	 // $facility_code=$this -> session -> userdata('news'); 
	    $facility_code=17401; //I HAVE TO CHANGE HERE
	    $commodity_id=$this->input->post('commodity_id');
        $unit_size=$this->input->post('unit_size');
		$expiry_date=$this->input->post('expiry_date');
		$batch_no=$this->input->post('batch_no');
		$manu=$this->input->post('manuf');
		$stock_level=$this->input->post('stock_level');
		$total_unit_count=$this->input->post('total_units_count');		
        $unit_issue=$this->input->post('unit_issue');		
		$total_units=$this->input->post('total_units');
		$source_of_item=$this->input->post('source_of_item');
		$supplier=$this->input->post('supplier');
		//get the data
		$does_facility_have_this_drug_in_temp_table=facility_stocks_temp::check_if_facility_has_drug_in_temp($commodity_id, $facility_code,$batch_no);
if($does_facility_have_this_drug_in_temp_table>0):
		//send the data to the db	
		facility_stocks_temp::update_facility_temp_data($expiry_date,$batch_no,$manu,
		$stock_level,$total_unit_count,$commodity_id,$facility_code,$unit_issue,$total_units,$source_of_item,$supplier);			
		echo "UPDATE SUCCESS BATCH NO: $batch_no ";			
else:
		$mydata=array('facility_code'=>$facility_code,
			'commodity_id'=>$commodity_id,
			'batch_no'=>$batch_no,
			'manu'=>$manu,
			'expiry_date'=> $expiry_date,
			'stock_level'=>$stock_level,
			'total_unit_count'=>$total_unit_count,
			'unit_size'=>$unit_size,
			'unit_issue'=> $unit_issue,
			'total_units'=>$total_units,
			'source_of_item'=>$source_of_item,
			'supplier'=>$supplier);
			//save the data
			 facility_stocks_temp::update_temp($mydata);			
	        echo "SUCCESS UPDATE BATCH NO: $batch_no";
endif;
endif;
	
}// get the temp data load it up incase the user had autosaved the data
  public function get_temp_stock_data_json(){
//security check	
if($this->input->is_ajax_request()):
		// $facility_code=$this -> session -> userdata('news'); 
	    $facility_code=17401; //I HAVE TO CHANGE HERE
		$result=facility_stocks_temp::get_temp_stock($facility_code);
		echo json_encode($result);
endif;
	}//delete the temp data here
 public  function delete_temp_autosave(){
 //security check	
 if($this->input->is_ajax_request()):
		    // $facility_code=$this -> session -> userdata('news'); 
	        $facility_code=17401; //I HAVE TO CHANGE HERE
			$commodity_id=$this->input->post('commodity_id');			
			$commodity_batch_no=$this->input->post('commodity_batch_no');	
			//delete the record from the db
			facility_stocks_temp::delete_facility_temp($commodity_id, $commodity_batch_no,$facility_code);
			echo "SUCCESS DELETE BATCH NO: $commodity_batch_no";
 endif;
}
}

?>