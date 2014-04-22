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
		$this -> load -> database();
	}
	public function index(){
		
	}	
/*
|--------------------------------------------------------------------------
| update facility stock 
|--------------------------------------------------------------------------
|1. load the view
|2. check if the user has any temp data
|3. auto save the data
|4. save the data in the facility stock, facility transaction , issues table
*/
	 public function facility_stock_first_run($checker){
	 	$which_view_to_load=($checker=='first_run')?"facility/facility_stock_data/update_facility_stock_on_first_run_v" :
		"facility/facility_stock_data/update_facility_stock_v";
	    $data['title'] = "Update Stock Level";
     	$data['content_view'] = $which_view_to_load;
		$data['banner_text'] = "Update Stock Level";
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
			'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
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
			'status'=>1);	//send the data to the facility_transaction_table		
			facility_transaction_table::update_facility_table($mydata2);			
endif;			
endfor;		  //get the closing stock of the given item  
          $facility_stock_=facility_stocks::get_facility_commodity_total($facility_code,null, $date_of_entry)->toArray();
          foreach ($facility_stock_ as $facility_stock_):
            // save this infor in the issues table
			$mydata=array('facility_code'=>$facility_code,
			's11_No' => 'initial stock update',
			'commodity_id'=>$facility_stock_['commodity_id'],
			'batch_no'=>"N/A",
			'expiry_date'=> "N/A",
			'balance_as_of'=>$facility_stock_['commodity_balance'],
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
		  redirect('reports/facility_stock_data');			  
endif;
} /*
|--------------------------------------------------------------------------
| End of update facility stock on first run
|--------------------------------------------------------------------------
 Next section ADDING MORE FACILITY STOCK HERE
*/
public function add_more_stock_level(){
	if($this->input->post('desc')):		
	    $facility_code=$this -> session -> userdata('facility_id'); 
	     $commodity_id=$this->input->post('desc');
		 $expiry_date=$this->input->post('clone_datepicker');
		 $batch_no=$this->input->post('commodity_batch_no');
		 $manu=$this->input->post('commodity_manufacture');
		 $total_unit_count=$this->input->post('commodity_total_units');		
		 $source_of_item=$this->input->post('source_of_item');
         $count=count($commodity_id);
		 $date_of_entry=date('y-m-d H:i:s');
         //collect n set the data in the array
		for($i=0;$i<$count;$i++):
			$mydata=array('facility_code'=>$facility_code,
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'manufacture'=>$manu[$i],
			'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
			'initial_quantity'=>$total_unit_count[$i],
			'current_balance'=>$total_unit_count[$i],
			'source_of_commodity'=>$source_of_item[$i],
			'date_added'=>$date_of_entry );
			//update the facility stock table
			facility_stocks::update_facility_stock($mydata);
			 //get the closing stock of the given item           
            $facility_stock=facility_stocks::get_facility_commodity_total($facility_code,$commodity_id[$i])->toArray();	
            // save this infor in the issues table
            $total_unit_count_=$total_unit_count[$i]*-1;
			$mydata=array('facility_code'=>$facility_code,
			's11_No' => 'stock addition',
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
			'balance_as_of'=>$facility_stock[0]['commodity_balance'],
			'date_issued' => date('y-m-d'),
			'issued_to' => 'N/A',
			'qty_issued' => $total_unit_count_,
			'issued_by' =>$this -> session -> userdata('user_id') ); //$this -> session -> userdata('identity')
			 // update the issues table 
			 facility_issues::update_issues_table($mydata);
			 
			 //check	
			$facility_has_commodity=facility_transaction_table::get_if_commodity_is_in_table($facility_code,$commodity_id[$i]);
					
          if($facility_has_commodity>0): //update the opening balance for the transaction table 
		   	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET `opening_balance` =`opening_balance`+$total_unit_count[$i]
                                          WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code=$facility_code");                                                  		   
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
			'status'=>1);	//send the data to the facility_transaction_table		
			facility_transaction_table::update_facility_table($mydata2);			
endif;			
										
endfor;	
            //delete the record from the db
		    facility_stocks_temp::delete_facility_temp(null, null,$facility_code);
          //set the notifications
		  //$this->hcmp_functions->send_stock_update_sms();
		  $this->session->set_flashdata('system_success_message', "Stock Levels Have Been Updated");
		  redirect('reports/facility_stock_data');			  
endif;	
}
/*
|--------------------------------------------------------------------------
| End of more_stock_level
|--------------------------------------------------------------------------
 Next section ADDING MORE FACILITY STOCK Inter-facility donation
*/
        public function add_more_stock_level_external(){
	    if($this->input->post('facility_stock_id')):	
		 $facility_stock_id=$this->input->post('facility_stock_id');
	     $facility_code=$this -> session -> userdata('facility_id'); 
	     $commodity_id=$this->input->post('commodity_id');
		 $expiry_date=$this->input->post('clone_datepicker');
		 $batch_no=$this->input->post('commodity_batch_no');
		 $manu=$this->input->post('commodity_manufacture');
		 $total_unit_count=$this->input->post('actual_quantity');				 
		 $service_point=$this->input->post('service_point');
		 $source_of_item=$this->input->post('source_of_item');
         $count=count($commodity_id);
		 $date_of_entry=date('y-m-d H:i:s');
         //collect n set the data in the array
		for($i=0;$i<$count;$i++):

		   if($total_unit_count[$i]>0)://check if the balance is more than 0 ie they recieved something
           if($this -> session -> userdata('user_indicator')=='district'):	
           //check if the user is district if so the facility which was given the item is not using HCMP		
		   else:				   
			$mydata=array('facility_code'=>$facility_code,
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'manufacture'=>$manu[$i],
			'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
			'initial_quantity'=>$total_unit_count[$i],
			'current_balance'=>$total_unit_count[$i],
			'source_of_commodity'=>$source_of_item[$i],
			'date_added'=>$date_of_entry );
			//update the facility stock table
			facility_stocks::update_facility_stock($mydata);
			 //get the closing stock of the given item           
            $facility_stock=facility_stocks::get_facility_commodity_total($facility_code,$commodity_id[$i])->toArray();	
            // save this infor in the issues table
            $total_unit_count_=$total_unit_count[$i]*-1;
			$mydata=array('facility_code'=>$facility_code,
			's11_No' => '(+ve Adj) Stock Addition',
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
			'balance_as_of'=>$facility_stock[0]['commodity_balance'],
			'date_issued' => date('y-m-d'),
			'issued_to'=>"inter-facility donation: MFL NO ".$service_point[$i],
			'qty_issued' => $total_unit_count_,
			'issued_by' =>$this -> session -> userdata('user_id') ); //$this -> session -> userdata('identity')
			 // update the issues table 
			facility_issues::update_issues_table($mydata);			 
			 //check	
			$facility_has_commodity=facility_transaction_table::get_if_commodity_is_in_table($facility_code,$commodity_id[$i]);
					
          if($facility_has_commodity>0): //update the opening balance for the transaction table 
		   	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET `opening_balance` =`opening_balance`+$total_unit_count[$i]
                                          WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code=$facility_code");                                                 		   
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
			'status'=>1);	//send the data to the facility_transaction_table		
			facility_transaction_table::update_facility_table($mydata2);			
endif;		
endif;	
	//update the redistribution data
	$myobj = Doctrine::getTable('redistribution_data')->find($facility_stock_id[$i]);
    $myobj->quantity_received=$total_unit_count[$i];
    $myobj->receiver_id=$this -> session -> userdata('user_id');
    $myobj->date_received=date('y-m-d');
    $myobj->status=1;
    $myobj->save();
    endif;						
endfor;	     
          //set the notifications
		  //$this->hcmp_functions->send_stock_update_sms();
		  $this->session->set_flashdata('system_success_message', "Stock Levels Have Been Updated");
		  redirect('reports/facility_stock_data');			  
endif;	
}
 /*
|--------------------------------------------------------------------------
| End of ADDING MORE FACILITY STOCK Inter-facility donation
|--------------------------------------------------------------------------
 Next section update_facility_stock_from_kemsa_order
*/
  public function update_facility_stock_from_kemsa_order(){	
	$facility_code=$this -> session -> userdata('facility_id');
	$date_of_entry = date("y-m-d h:i:s");
	$facility_stock_array=$facility_transaction_array=
	$facility_order_details_push_array=$facility_order_details_array=
	$facility_issues_array=array();
	//products
	$commodity_id=$this->input->post('commodity_id');
	$commodity_code=$this->input->post('commodity_code');
	$batch_no=$this->input->post('batch_no');
	$expiry_date=$this->input->post('expiry_date');
	$actual_quantity=$this->input->post('actual_quantity');
	$manu=$this->input->post('manu');
	$cost=$this->input->post('cost');
	$price=$this->input->post('price_bought');
	$order_details_id=$this->input->post('order_details_id');
	//delivery details $order
	$hcmp_order_id=$this->input->post('hcmp_order_id');
	$warehouse=$this->input->post('warehouse');
	$dispatch_date=date('y-m-d',strtotime($this->input->post('dispatch_date')));
	$deliver_date=date('y-m-d',strtotime($this->input->post('deliver_date')));
	$dnote=$this->input->post('dno');
	$kemsa_order_no=$this->input->post('kemsa_order_no');
    $actual_order_total=$this->input->post('actual_order_total');
	$j=count($commodity_id);		
	for($i=0;$i<$j;$i++){
	$mydata=array('facility_code'=>$facility_code,
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'manufacture'=>$manu[$i],
			'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
			'initial_quantity'=>$actual_quantity[$i],
			'current_balance'=>$actual_quantity[$i],
			'source_of_commodity'=>1,
			'date_added'=>$date_of_entry );
	        array_push($facility_stock_array,$mydata);	//insert batch for facility_stocks 
	        $facility_stock=facility_stocks::get_facility_commodity_total($facility_code,$commodity_id[$i])->toArray();				
			$mydata_2=array('facility_code'=>$facility,
			's11_No' => 'Delivery From KEMSA',
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'expiry_date'=>date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
			'balance_as_of'=>$facility_stock[0]['balance'],
			'date_issued' => date('y-m-d'),
			'qty_issued' => $actual_quantity[$i],
			'issued_to' => 'N/A',
			'issued_by' => $this -> session -> userdata('user_id'));  
			 array_push($facility_issues_array,$mydata_2);	//insert batch for facility_issues	
	}
   	$this -> db -> insert_batch('facility_stocks', $mydata);
	$this -> db -> insert_batch('facility_issues', $mydata_2);
/*step one move all the closing stock of existing stock to be the new opening balance and compute the total items from kemsa***/
$get_delivered_items = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("select f_t_t.`closing_stock`,ifnull(f_s.`current_balance`,0) as current_balance ,f_s.commodity_id
from facility_transaction_table f_t_t 
left join  facility_stocks f_s on f_s.facility_code= f_t_t.facility_code 
and f_s.commodity_id=f_t_t.commodity_id and f_s.date_added='$date_of_entry'  
and f_s.status=1
where  f_t_t.facility_code=$facility_code and f_t_t.status=1   
group by f_s.commodity_id");
$step_1_size=count( $get_delivered_items);
/******************* step two get items that the facility does not have the in the transaction table ideally pushed items**/
$get_pushed_items = Doctrine_Manager::getInstance()->getCurrentConnection()
      ->fetchAll("SELECT ifnull(f_s.`current_balance`,0) AS current_balance, f_s.commodity_id
FROM facility_stocks f_s
WHERE f_s.current_balance >0
AND f_s.status =  '1'
AND f_s.facility_code ='$facility_code'
AND f_s.commodity_id NOT 
IN (SELECT commodity_id
FROM facility_transaction_table
WHERE facility_code ='$facility_code'
AND status ='1')
GROUP BY f_s.commodity_id");
$step_2_size=count($get_pushed_items);	  
//setting previous cycle's values to 0 then updating a fresh
		$q = Doctrine_Manager::getInstance()->getCurrentConnection();	
		$q->execute("UPDATE `facility_transaction_table` SET status =0 WHERE `facility_code`= '$facility'");  
//package all the items which existed into one array and save for step one
			for($i=0;$i<$step_1_size;$i++){
            $closing_stock=$get_delivered_items[$i]['closing_stock']+$get_delivered_items[$i]['current_balance'];
			$order_details_table_id='';
			$mydata_3=array('facility_code'=>$facility_code,
			'commodity_id'=>$get_delivered_items[$i]['commodity_id'],
			'opening_balance'=>$get_delivered_items[$i]['closing_stock'],
			'total_issues'=>0,
			'total_receipts'=>$get_delivered_items[$i]['current_balance'],
			'adjustmentpve'=>0,
			'adjustmentnve'=>0,
			'date_added'=>$date_of_entry,
			'closing_stock'=>$closing_stock,
			'status'=>1);
			$order_details_table_id=@$order_details_id[array_search($get_delivered_items[$i]['commodity_id'], $commodity_id)];
			if($order_details_table_id>0){
			$mydata_4=array('id'=>$order_details_table_id,
			'quantity_recieved'=>$get_delivered_items[$i]['current_balance']);	
			array_push($facility_order_details_array,$mydata_4);	
			}		
            array_push($facility_transaction_array,$mydata_3);	
			}
//package all the items which did not exist into one array and save for step two
			for($i=0;$i<$step_2_size;$i++){
            $closing_stock=$get_pushed_items[$i]['current_balance'];
			$order_details_table_id='';
			$mydata_5=array('facility_code'=>$facility_code,
			'commodity_id'=>$get_pushed_items[$i]['commodity_id'],
			'opening_balance'=>0,
			'total_issues'=>0,
			'total_receipts'=> $closing_stock,
			'adjustmentpve'=>0,
			'adjustmentnve'=>0,
			'date_added'=>$date_of_entry,
			'closing_stock'=>$closing_stock,
			'status'=>1);
			$index=array_search($get_pushed_items[$i]['commodity_id'], $commodity_id);
			if($order_details_table_id>0){
			$mydata_6= array("commodity_id" =>$get_pushed_items[$i]['commodity_id'], 'quantity_ordered_pack' =>0, 
			'quantity_ordered_unit' =>0, 'quantity_recieved' => $closing_stock, 'price' => $price[$index], 
			'o_balance' =>0, 't_receipts' => 0, 't_issues' => 0, 'adjustpve' =>0,
			 'adjustnve' =>0, 'losses' =>0, 'days' => 0, 'c_stock' =>0, 
			 'comment' =>'N/A', 's_quantity' =>0, 'amc' => 0, 'order_number_id' =>$hcmp_order_id);
			array_push($facility_order_details_push_array,$mydata_6);	
			}		
            array_push($facility_transaction_array,$mydata_5);	
			}
	    $this -> db -> insert_batch('facility_transaction_table', $facility_transaction_array);
		$this -> db -> update_batch('facility_order_details', $facility_order_details_array,'id');
		if(count($facility_order_details_push_array)>0){
		$this -> db -> insert_batch('facility_order_details', $facility_order_details_push_array);	
		}//update the order table here	    
		$state=Doctrine::getTable('facility_orders')->findOneById($hcmp_order_id);
		$state->deliver_date=$deliver_date;
		$state->reciever_id=$this -> session -> userdata('user_id');
		$state->dispatch_update_date=date('y-m-d');
		$state->dispatch_date=$dispatch_date;
		$state->deliver_total=$actual_order_total;
		$state->warehouse=$warehouse;
		$state->status=4;
		$state->save();//get the color coded table
        $order_details=$this -> hcmp_functions -> create_order_delivery_color_coded_table($hcmp_order_id);
		$message_1="<br>The Order Made for $order_details[facility_name] on  $order_details[date_ordered] has been received at the facility on. $order_details[date_received]
		<br>
		Total ordered value(ksh) =$order_details[order_total]
		<br>
		Total recieved order value(ksh)=$order_details[actual_order_total]
		<br>
		Order Lead Time (from placement – receipt) = $order_details[lead_time]  days
		<br>
		<br>
		<br>".$order_details['table'];				
		$subject='Order Report For '.$order_details['facility_name'];
		//$this->hcmp_functions ->send_order_delivery_email($message_1,$subject,null);
		$this->session->set_flashdata('system_success_message', 'Stock details have been Updated');
		redirect('reports/facility_stock_data');	
  	
  }
 /*
|--------------------------------------------------------------------------
| End of update_facility_stock_from_kemsa_order
|--------------------------------------------------------------------------
 Next section Edit facility stock
*/
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
redirect('reports/facility_stock_data');	
endif;	
redirect();
}
}

?>