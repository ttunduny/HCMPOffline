<?php
/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Stock extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('hcmp_functions','form_validation'));
		 
	}
	public function index(){
		
	}	
/*
|--------------------------------------------------------------------------
| update facility stock on first run
|--------------------------------------------------------------------------
|1. load the view
|2. check if the user has any temp data
|3. auto save the data
|4. save the data in the facility stock, facility transaction , issues table
*/
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
        $facility_code=$this -> session -> userdata('facility_id'); 
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
endif; }// get the temp data load it up incase the user had autosaved the data
  public function get_temp_stock_data_json(){
//security check	
if($this->input->is_ajax_request()):
	   $facility_code=$this -> session -> userdata('facility_id'); 
		$result=facility_stocks_temp::get_temp_stock($facility_code);
		echo json_encode($result);
endif;
	}//delete the temp data here
 public  function delete_temp_autosave(){
 //security check	
 if($this->input->is_ajax_request()):
		    $facility_code=$this -> session -> userdata('facility_id');      
			$commodity_id=$this->input->post('commodity_id');			
			$commodity_batch_no=$this->input->post('commodity_batch_no');	
			//delete the record from the db
			facility_stocks_temp::delete_facility_temp($commodity_id, $commodity_batch_no,$facility_code);
			echo "SUCCESS DELETE BATCH NO: $commodity_batch_no";
 endif;
}// finally add the stock here, the final step to the first step of new facilities getting on board
    public function add_stock_level()
{ // $facility_code=$this -> session -> userdata('news');  //security check 
if($this->input->post('commodity_id')):
	    $facility_code=$this -> session -> userdata('facility_id'); 
	     $commodity_id=$this->input->post('desc');
		 $expiry_date=$this->input->post('clone_datepicker');
		 $batch_no=$this->input->post('commodity_batch_no');
		 $manu=$this->input->post('commodity_manufacture');
		 $total_unit_count=$this->input->post('commodity_total_units');		
		 $source_of_item=$this->input->post('source_of_item');
         $count=count($commodity_id);
		 $commodity_id_array=array();
		 $date_of_entry=date('y-m-d H:i:s');
         //collect n set the data in the array
		for($i=0;$i<$count;$i++):
			$mydata=array('facility_code'=>$facility_code,
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'manufacture'=>$manu[$i],
			'expiry_date'=> date('y-m-d', strtotime($expiry_date[$i])),
			'initial_quantity'=>$total_unit_count[$i],
			'current_balance'=>$total_unit_count[$i],
			'source_of_commodity'=>$source_of_item[$i],
			'date_added'=>$date_of_entry );
			//update the facility stock table
			facility_stocks::update_facility_stock($mydata);			
			//check	
			$facility_has_commodity=facility_transaction_table::get_if_commodity_is_in_table($facility_code,$commodity_id[$i]);			
if($facility_has_commodity>0): //update the opening balance for the transaction table 
		   	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET `opening_balance` =`opening_balance`+$total_unit_count[$i]
                                          WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code=$facility_code");
            // update the closing stock for the transaction table                             
           $inserttransaction1 = Doctrine_Manager::getInstance()->getCurrentConnection();
		   $inserttransaction1->execute("UPDATE `facility_transaction_table` SET closing_stock = (SELECT SUM(current_balance)
			 FROM facility_stock WHERE commodity_id = '$commodity_id[$i]' and status='1' and facility_code='$facility_code')
             WHERE `commodity_id`=$commodity_id[$i] and status='1' and facility_code ='$facility_code'"); 
			 //merge the commodity ids.
			 $commodity_id_array=array_merge($commodity_id_array, array($commodity_id[$i]=>$commodity_id[$i]));                                                      		   
else:       //get the data to send to the facility_transaction_table
		   	$mydata2=array('facility_code'=>$facility_code,
			'commodity_id'=>$commodity_id[$i],
			'opening_balance'=>$total_unit_count[$i],
			'total_issues'=>0,
			'total_receipts'=>0,
			'adjustmentpve'=>0,
			'adjustmentnve'=>0,
			'date_added'=>$date_of_entry,
			'closing_stock'=>$total_unit_count[$i],
			'status'=>$this -> session -> userdata('user_id'));	//send the data to the facility_transaction_table		
			facility_transaction_table::update_facility_table($mydata2);			
			//merge the commodity ids.
			 $commodity_id_array=array_merge($commodity_id_array, array($commodity_id[$i]=>$commodity_id[$i]));
endif;			
endfor;		
          foreach ($commodity_id_array as $commodity_id_data):
            //get the closing stock of the given item           
            $facility_stock=facility_stocks::get_facility_commodity_total($facility_code,$commodity_id_data)->toArray();	
            // save this infor in the issues table
			$mydata=array('facility_code'=>$facility_code,
			's11_No' => 'initial stock update',
			'commodity_id'=>$commodity_id_data,
			'batch_no'=>"N/A",
			'expiry_date'=> "N/A",
			'balance_as_of'=>$facility_stock[0]['commodity_balance'],
			'date_issued' => date('y-m-d'),
			'issued_to' => 'N/A',
			'issued_by' =>$this -> session -> userdata('user_id') ); //$this -> session -> userdata('identity')
			 // update the issues table 
			 facility_issues::update_issues_table($mydata); 
endforeach;    	
            //delete the record from the db
		    facility_stocks_temp::delete_facility_temp(null, null,$facility_code);
          //set the notifications
		  //$this->hcmp_functions->send_stock_update_sms();
		  $this->session->set_flashdata('system_success_message', "Stock Levels Have Been Updated");
		  //redirect('stock/stock_level');			  
endif;
}/////////////////////////////////END OF UPDATING STOCKS ON FIRST RUN//////////////////////////////////////////
public function facility_stock_data(){///////////////////GET FACILITY STOCK DATA/////////////////////////////
                $facility_code=$this -> session -> userdata('facility_id');
				$data['facility_stock_data']=facility_stocks::get_distinct_stocks_for_this_facility($facility_code,'batch_data');
				$data['title'] = "Facility Stock";
     			$data['content_view'] = "facility/facility_stock_data/facility_stock_data_v";
				$data['banner_text'] = "Facility Stock";
				$this -> load -> view("shared_files/template/template", $data);	
}////EDITING FACILITY STOCK DATA
public function edit_facility_stock_data(){
//security check
if($this->input->post('id')):
$facility_code=$this -> session -> userdata('facility_id');
$stock_id=$this->input->post('id');
$expiry_date=$this->input->post('expiry_date');
$batch_no=$this->input->post('batch_no');
$delete=$this->input->post('delete');
$manufacturer=$this->input->post('manufacturer');
$commodity_id=$this->input->post('commodity_id');
$commodity_balance_units=$this->input->post('commodity_balance_units');
for($key=0;$key<count($stock_id);$key++):
	if($delete[$key]==1):
		//check the total stock balance of the commodity
		$facility_stock=facility_stocks::get_facility_commodity_total($facility_code, $commodity_id[$key]);
		$commodity_balance=($commodity_balance_units[$key]*-1);
	    $inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->execute("update facility_transaction_table t 
		 set  t. `closing_stock`=`closing_stock`-$commodity_balance_units[$key],`adjustmentnve`=$commodity_balance 
		 where t.facility_code='$facility_code' and t.commodity_id=$commodity_id[$key] and t.status=1");
		 // prepare the data to save
		 $commodity_balance=($commodity_balance_units[$key]*-1);
		 	$mydata=array('facility_code'=>$facility_code,
			's11_No' => 'Deleted Commodity',
			'commodity_id'=>$commodity_id[$key],
			'batch_no'=>$batch_no[$key],
			'expiry_date'=>date('y-m-d',strtotime(str_replace(",", " ",$expiry_date[$key]))),
			'balance_as_of'=>$facility_stock[0]['commodity_balance'],
			'adjustmentnve'=> $commodity_balance,
			'date_issued' => date('y-m-d'),
			'issued_to' => 'N/A',
			'issued_by' =>$this -> session -> userdata('user_id') );
			 // update the issues table 
			 facility_issues::update_issues_table($mydata); 
		 //delete the record
          $inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->execute("delete from facility_stocks where id=$stock_id[$key]"); 
	 else:

		 $myobj = Doctrine::getTable('facility_stocks')->find($stock_id[$key]);
         $myobj->batch_no=$batch_no[$key] ;
		 $myobj->manufacture=$manufacturer[$key];
		 $myobj->expiry_date=date('y-m-d',strtotime(str_replace(",", " ",$expiry_date[$key])));
         $myobj->save(); 	
	 endif;
endfor;
$this->session->set_flashdata('system_success_message', "Facility Stock data has Been Updated"); 
redirect('stock/facility_stock_data');	
endif;	
redirect();
}
}

?>