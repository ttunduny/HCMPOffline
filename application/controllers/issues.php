<?php
/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
   class issues extends MY_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library(array('hcmp_functions','form_validation'));
		$this->load->database();
	}
/*
|--------------------------------------------------------------------------
| facility issuing to service points
|--------------------------------------------------------------------------
|1. load the view/ determine if its a redistribution/ internal issue 
|2. check if the facility has commodity data 
|4. save the data in the facility stock, facility transaction , issues table
*/
	public function index($checker=NULL) 
	{
		    $facility_code=$this -> session -> userdata('facility_id'); 
			switch ($checker):		
				case 'internal':					
					$data['content_view'] = "facility/facility_issues/facility_issues_service_points_v";
					$data['title'] = "Issues to service points";
					$data['banner_text'] = "Issues to service points";			
					break;
					case 'external':		
						$data['donate_destination'] = "facility";				
						$data['content_view'] = "facility/facility_issues/facility_redistribute_items_v";						
						$data['subcounties']=districts::getAll();
						$data['banner_text'] = "Redistribute Commodities";
						$data['title'] ="Redistribute Commodities";						
					break;	
					case 'store_external':		
						$this ->district_store();						
					break;	
					case 'district_store':	
						$district_id = $this -> session -> userdata('district_id');	
						$dist = districts::get_district_name_($district_id);	
						$data['district_id'] = $this -> session -> userdata('district_id');
						$data['district_data'] = districts::get_district_name_($district_id);
						$data['content_view'] = "facility/facility_issues/facility_redistribute_items_v";
						$data['donate_destination'] = "district";
						$data['subcounties']=districts::getAll();
						$data['banner_text'] = "Redistribute Commodities";
						$data['title'] ="Redistribute Commodities";						
					break;						
					default;								
			endswitch;			
		$data['service_point']=service_points::get_all_active($facility_code);		
		$data['commodities'] = facility_stocks::get_distinct_stocks_for_this_facility($facility_code,1);
	    $data['facility_stock_data']=json_encode(facility_stocks::get_distinct_stocks_for_this_facility($facility_code,"batch_data"));	
     	$this -> load -> view("shared_files/template/template", $data);
	}

	public function store_home(){
		$view = 'shared_files/template/template';
		    $data['content_view'] = "subcounty/subcounty_drug_store_home";	
			$data['district_dashboard_notifications']=$this->get_district_dashboard_notifications_graph_data();
			$data['title'] = "System Home";
		$data['banner_text'] = "Home";
		$this -> load -> view($view, $data);
	}

	public function get_district_dashboard_notifications_graph_data()
    {
    //format the graph here
    $facility_code=$this -> session -> userdata('facility_id');
    $district_id = $this -> session -> userdata('district_id');	
    $district_stock_=facility_stocks::get_district_stock_amc($district_id);
    //echo("<pre>");print_r($district_stock_);echo "</pre>";exit;
	$district_stock_count=count($district_stock_);
    $graph_data=array();
	$graph_data=array_merge($graph_data,array("graph_id"=>'container'));
	$graph_data=array_merge($graph_data,array("graph_title"=>'District Store Stock level'));
	$graph_data=array_merge($graph_data,array("graph_type"=>'bar'));
	$graph_data=array_merge($graph_data,array("graph_yaxis_title"=>'Total stock level  (values in packs)'));
	$graph_data=array_merge($graph_data,array("graph_categories"=>array()));
	$graph_data=array_merge($graph_data,array("series_data"=>array("Current Balance"=>array())));
	$graph_data['stacking']='normal';
	foreach($district_stock_ as $district_stock_):
		$graph_data['graph_categories']=array_merge($graph_data['graph_categories'],array($district_stock_['commodity_name']));	
		$graph_data['series_data']['Current Balance']=array_merge($graph_data['series_data']['Current Balance'],array((float) $district_stock_['pack_balance']));	

	endforeach;
	//create the graph here

	$district_stock_data=$this->hcmp_functions->create_high_chart_graph($graph_data);
	$loading_icon=base_url('assets/img/no-record-found.png'); 
	$district_stock_data=($district_stock_count>0)? $district_stock_data : "$('#container').html('<img src=$loading_icon>');" ;
	
    //get potential expiries info here
    // echo "<pre>";print_r($district_id);echo "</pre>";exit;
    $potential_expiries_=count(Facility_stocks::drug_store_commodity_expiries($district_id));
    //get actual Expiries info here
    $actual_expiries=count(Facility_stocks::drug_store_commodity_expiries($district_id));
	//get items they have been donated for
	$facility_donations=redistribution_data::get_all_active_drug_store($district_id,"to-me")->count();
	//get stocks from v1
	$stocks_from_v1=0;
	return array('district_stock_count'=>$district_stock_count,
	'district_stock_graph'=>$district_stock_data,
	'potential_expiries'=>$potential_expiries_,
	'actual_expiries'=>$actual_expiries,
	'facility_donations'=>$facility_donations,
	'facility_donations_pending'=>$facility_donations_pending,
	'stocks_from_v1'=>$stocks_from_v1
	);	
    }

	public function district_store(){
		$district_id = $this -> session -> userdata('district_id');	
						$dist = districts::get_district_name_($district_id);	
						$data['district_id'] = $this -> session -> userdata('district_id');
						$data['district_data'] = districts::get_district_name_($district_id);
						$data['content_view'] = "subcounty/subcounty_drug_store";
						$data['donate_destination'] = "district";
						$data['subcounties']=districts::getAll();
						$data['banner_text'] = "Redistribute Commodities";
						$data['title'] ="Redistribute Commodities";		
						$data['service_point']=service_points::get_all_active($facility_code);		
		$data['commodities'] = facility_stocks::get_distinct_stocks_for_this_district_store($district_id,1);
	    $data['facility_stock_data']=json_encode(facility_stocks::get_distinct_stocks_for_this_district_store($district_id,"batch_data"));	
     	$this -> load -> view("shared_files/template/template", $data);
	}
	// facility internal issue
	public function internal_issue()
	{
		//security check
		if($this->input->post('service_point')):
		$facility_code=$this -> session -> userdata('facility_id');
		$service_points=array_values($this->input->post('service_point'));
		
		$commodity_id=array_values($this->input->post('desc'));
		$commodity_balance_before=array_values($this->input->post('commodity_balance'));
		$facility_stock_id=array_values($this->input->post('facility_stock_id'));
		$batch_no=array_values($this->input->post('batch_no'));
		$expiry_date=array_values($this->input->post('expiry_date'));
		$commodity_unit_of_issue=array_values($this->input->post('commodity_unit_of_issue'));
		$quantity_issued=array_values($this->input->post('quantity_issued'));
		$clone_datepicker_normal_limit_today=array_values($this->input->post('clone_datepicker_normal_limit_today'));
		$total_units=array_values($this->input->post('total_units'));
		$total_items=count($facility_stock_id);
	    print_r($total_units);
        for($i=0;$i<$total_items;$i++)://compute the actual stock
       $total_items_issues=($commodity_unit_of_issue[$i]=='Pack_Size')? 
        $quantity_issued[$i]*$total_units[$i] : $quantity_issued[$i]; 
     //prepare the issues data
    
	                 $mydata = array('facility_code' => $facility_code,	 
	                 's11_No'=>'internal issue', 'batch_no' => $batch_no[$i] ,'commodity_id' => $commodity_id[$i],
				     'expiry_date' => date('y-m-d',strtotime($expiry_date[$i])),'qty_issued'=> $total_items_issues ,
				     'issued_to'=>$service_points[$i],'balance_as_of'=>$commodity_balance_before[$i], 
				     'date_issued'=>date('y-m-d',strtotime($clone_datepicker_normal_limit_today[$i])),'issued_by'=>$this -> session -> userdata('user_id'));				
			
			// update the issues table 
			facility_issues::update_issues_table($mydata); 
            // reduce the stock levels 
			$a = Doctrine_Manager::getInstance()->getCurrentConnection();
			$a->execute("UPDATE `facility_stocks` SET `current_balance` = `current_balance`-$total_items_issues where id='$facility_stock_id[$i]'");
            //update the transaction table here 

			$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute(" UPDATE `facility_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
			`closing_stock`=`closing_stock`-$total_items_issues
            WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code='$facility_code';");		
         
	endfor;

			$user = $this -> session -> userdata('user_id');
			$user_action = "issue";
			Log::log_user_action($user, $user_action);
		 	$this->session->set_flashdata('system_success_message', "You have issued $total_items item(s)");
			redirect();
	endif;
	redirect();		
	}
	public function district_store_issue()
		{
			//security check
			if($this->input->post('mfl')):
			$facility_code=$this -> session -> userdata('facility_id');
			$district_id = $this -> session -> userdata('district_id');	
			$service_point=array_values($this->input->post('mfl'));
			$commodity_id=array_values($this->input->post('desc'));
			$commodity_balance_before=array_values($this->input->post('commodity_balance'));
			$facility_stock_id=array_values($this->input->post('facility_stock_id'));
			$batch_no=array_values($this->input->post('batch_no'));
			$expiry_date=array_values($this->input->post('expiry_date'));
			$commodity_unit_of_issue=array_values($this->input->post('commodity_unit_of_issue'));
			$quantity_issued=array_values($this->input->post('quantity_issued'));
			$clone_datepicker_normal_limit_today=array_values($this->input->post('clone_datepicker_normal_limit_today'));
			$manufacture=array_values($this->input->post('manufacture'));
			$total_units=array_values($this->input->post('total_units'));
			$total_items=count($facility_stock_id);
			$data_array_issues_table=array();
			$data_array_redistribution_table=array();

			// echo "<pre>";print_r($commodity_id);echo "</pre>";exit;
			$commodity_ids=facility_stocks::get_district_store_commodities($district_id);
			$comm_count = count($commodity_ids);
			//echo "<pre>";print_r($commodity_ids);echo "</pre>";exit;

			        for($i=0;$i<$total_items;$i++)://compute the actual stock
			        
			 //checks if commodity id is existent 
	for ($j=0; $j < $comm_count ; $j++) { 
	if ($commodity_id = $commodity_ids[$j]['commodity_id']) {
		$b = Doctrine_Manager::getInstance()->getCurrentConnection();
		$b->execute("UPDATE `drug_store` SET `qty_issued` = `qty_issued`+$quantity_issued[$i] where commodity_id='$commodity_id[$i]'");
	}
	else{
		 $this->db->insert_batch('drug_store', $data_array_issues_table); 
	}

}
        $total_items_issues=($commodity_unit_of_issue[$i]=='Pack_Size')? 
        $quantity_issued[$i]*$total_units[$i] : $quantity_issued[$i]; 
		
     //prepare the issues data
     $facility_name=isset($service_point[$i]) ? Facilities::get_facility_name2($service_point[$i]) : null;
	 $facility_name=isset($facility_name)? $facility_name['facility_name']: 'N/A';
	                 $mydata = array('facility_code' => $facility_code,	
	                 'district_id' => $district_id, 
	                 's11_No'=>'(-ve Adj) Stock Deduction', 'batch_no' => $batch_no[$i] ,'commodity_id' => $commodity_id[$i],
				     'expiry_date' => date('y-m-d',strtotime($expiry_date[$i])),'qty_issued'=> $total_items_issues ,
				     'issued_to'=>"inter-facility donation:".$facility_name,'balance_as_of'=>$commodity_balance_before[$i], 
				     'date_issued'=>date('y-m-d',strtotime($clone_datepicker_normal_limit_today[$i])),'issued_by'=>$this -> session -> userdata('user_id'));
					 
					  $mydata_2 = array('manufacturer'=>$manufacture[$i],
					  	'district_id' => $district_id,
					  'source_facility_code' => $facility_code,	 
	                 'batch_no' => $batch_no[$i] ,'commodity_id' => $commodity_id[$i],
				     'expiry_date' => date('y-m-d',strtotime($expiry_date[$i])),'quantity_sent'=> $total_items_issues ,
				     'receive_facility_code'=>$service_point[$i],'facility_stock_ref_id'=>$facility_stock_id[$i], 
				     'date_sent'=>date('y-m-d'),'sender_id'=>$this -> session -> userdata('user_id'));				
			// update the issues table 
			array_push($data_array_issues_table,$mydata); 
			array_push($data_array_redistribution_table,$mydata_2); 
            // reduce the stock levels 
			$a = Doctrine_Manager::getInstance()->getCurrentConnection();
			$a->execute("UPDATE `facility_stocks` SET `current_balance` = `current_balance`-$total_items_issues where id='$facility_stock_id[$i]'");
            //update the transaction table here 
			$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
			`closing_stock`=`closing_stock`-$total_items_issues
            WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code='$facility_code';");		
endfor;
		$user = $this -> session -> userdata('user_id');
		 $user_action = "redistribute";
		 
		 

		 Log::log_user_action($user, $user_action);
        
		 $this->db->insert_batch('redistribution_data', $data_array_redistribution_table); 
         $this->session->set_flashdata('system_success_message', "You have issued $total_items item(s)");
		 redirect();
endif;
redirect();		
	}

	public function district_store_external_issue()
		{
			//security check
			if($this->input->post('mfl')):
			$facility_code=$this -> session -> userdata('facility_id');
			$service_point=array_values($this->input->post('mfl'));
			$commodity_id=array_values($this->input->post('desc'));
			$commodity_balance_before=array_values($this->input->post('commodity_balance'));
			$facility_stock_id=array_values($this->input->post('facility_stock_id'));
			$batch_no=array_values($this->input->post('batch_no'));
			$expiry_date=array_values($this->input->post('expiry_date'));
			$commodity_unit_of_issue=array_values($this->input->post('commodity_unit_of_issue'));
			$quantity_issued=array_values($this->input->post('quantity_issued'));
			$clone_datepicker_normal_limit_today=array_values($this->input->post('clone_datepicker_normal_limit_today'));
			$manufacture=array_values($this->input->post('manufacture'));

			$total_units=array_values($this->input->post('total_units'));
			$total_items=count($facility_stock_id);
			$data_array_issues_table=array();
			$data_array_redistribution_table=array();
			        for($i=0;$i<$total_items;$i++)://compute the actual stock
			        
        $total_items_issues=($commodity_unit_of_issue[$i]=='Pack_Size')? 
        $quantity_issued[$i]*$total_units[$i] : $quantity_issued[$i]; 
		
     //prepare the issues data
     $facility_name=isset($service_point[$i]) ? Facilities::get_facility_name2($service_point[$i]) : null;
	 $facility_name=isset($facility_name)? $facility_name['facility_name']: 'N/A';
	                 $mydata = array('facility_code' => $facility_code,	 
	                 's11_No'=>'(-ve Adj) Stock Deduction', 'batch_no' => $batch_no[$i] ,'commodity_id' => $commodity_id[$i],
				     'expiry_date' => date('y-m-d',strtotime($expiry_date[$i])),'qty_issued'=> $total_items_issues ,
				     'issued_to'=>"inter-facility donation:".$facility_name,'balance_as_of'=>$commodity_balance_before[$i], 
				     'date_issued'=>date('y-m-d',strtotime($clone_datepicker_normal_limit_today[$i])),'issued_by'=>$this -> session -> userdata('user_id'));
					 
					  $mydata_2 = array('manufacturer'=>$manufacture[$i],
					  'source_facility_code' => $facility_code,	 
	                 'batch_no' => $batch_no[$i] ,'commodity_id' => $commodity_id[$i],
				     'expiry_date' => date('y-m-d',strtotime($expiry_date[$i])),'quantity_sent'=> $total_items_issues ,
				     'receive_facility_code'=>$service_point[$i],'facility_stock_ref_id'=>$facility_stock_id[$i], 
				     'date_sent'=>date('y-m-d'),'sender_id'=>$this -> session -> userdata('user_id'));				
			// update the issues table 
			array_push($data_array_issues_table,$mydata); 
			array_push($data_array_redistribution_table,$mydata_2); 
            // reduce the stock levels 
			$c = Doctrine_Manager::getInstance()->getCurrentConnection();
			$c->execute("UPDATE `drug_store` SET `qty_issued` = `qty_issued`-$quantity_issued[$i] where commodity_id='$commodity_id[$i]'");
            //update the transaction table here 
			$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
			`closing_stock`=`closing_stock`-$total_items_issues
            WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code='$facility_code';");		
endfor;
		$user = $this -> session -> userdata('user_id');
		 $user_action = "redistribute";
		 Log::log_user_action($user, $user_action);
         $this->db->insert_batch('facility_issues', $data_array_issues_table); 
		 $this->db->insert_batch('redistribution_data', $data_array_redistribution_table); 
         $this->session->set_flashdata('system_success_message', "You have issued $total_items item(s)");
		 redirect();
endif;
redirect();		
	}



		public function external_issue()
		{
			//security check
			if($this->input->post('mfl')):
			$facility_code=$this -> session -> userdata('facility_id');
			$service_point=array_values($this->input->post('mfl'));
			$commodity_id=array_values($this->input->post('desc'));
			$commodity_balance_before=array_values($this->input->post('commodity_balance'));
			$facility_stock_id=array_values($this->input->post('facility_stock_id'));
			$batch_no=array_values($this->input->post('batch_no'));
			$expiry_date=array_values($this->input->post('expiry_date'));
			$commodity_unit_of_issue=array_values($this->input->post('commodity_unit_of_issue'));
			$quantity_issued=array_values($this->input->post('quantity_issued'));
			$clone_datepicker_normal_limit_today=array_values($this->input->post('clone_datepicker_normal_limit_today'));
			$manufacture=array_values($this->input->post('manufacture'));

			$total_units=array_values($this->input->post('total_units'));
			$total_items=count($facility_stock_id);
			$data_array_issues_table=array();
			$data_array_redistribution_table=array();
			        for($i=0;$i<$total_items;$i++)://compute the actual stock
			        
        $total_items_issues=($commodity_unit_of_issue[$i]=='Pack_Size')? 
        $quantity_issued[$i]*$total_units[$i] : $quantity_issued[$i]; 
		
     //prepare the issues data
     $facility_name=isset($service_point[$i]) ? Facilities::get_facility_name2($service_point[$i]) : null;
	 $facility_name=isset($facility_name)? $facility_name['facility_name']: 'N/A';
	                 $mydata = array('facility_code' => $facility_code,	 
	                 's11_No'=>'(-ve Adj) Stock Deduction', 'batch_no' => $batch_no[$i] ,'commodity_id' => $commodity_id[$i],
				     'expiry_date' => date('y-m-d',strtotime($expiry_date[$i])),'qty_issued'=> $total_items_issues ,
				     'issued_to'=>"inter-facility donation:".$facility_name,'balance_as_of'=>$commodity_balance_before[$i], 
				     'date_issued'=>date('y-m-d',strtotime($clone_datepicker_normal_limit_today[$i])),'issued_by'=>$this -> session -> userdata('user_id'));
					 
					  $mydata_2 = array('manufacturer'=>$manufacture[$i],
					  'source_facility_code' => $facility_code,	 
	                 'batch_no' => $batch_no[$i] ,'commodity_id' => $commodity_id[$i],
				     'expiry_date' => date('y-m-d',strtotime($expiry_date[$i])),'quantity_sent'=> $total_items_issues ,
				     'receive_facility_code'=>$service_point[$i],'facility_stock_ref_id'=>$facility_stock_id[$i], 
				     'date_sent'=>date('y-m-d'),'sender_id'=>$this -> session -> userdata('user_id'));				
			// update the issues table 
			array_push($data_array_issues_table,$mydata); 
			array_push($data_array_redistribution_table,$mydata_2); 
            // reduce the stock levels 
			$a = Doctrine_Manager::getInstance()->getCurrentConnection();
			$a->execute("UPDATE `facility_stocks` SET `current_balance` = `current_balance`-$total_items_issues where id='$facility_stock_id[$i]'");
            //update the transaction table here 
			$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
			`closing_stock`=`closing_stock`-$total_items_issues
            WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code='$facility_code';");		
endfor;
		$user = $this -> session -> userdata('user_id');
		 $user_action = "redistribute";
		 Log::log_user_action($user, $user_action);
         $this->db->insert_batch('facility_issues', $data_array_issues_table); 
		 $this->db->insert_batch('redistribution_data', $data_array_redistribution_table); 
         $this->session->set_flashdata('system_success_message', "You have issued $total_items item(s)");
		 redirect();
endif;
redirect();		
	}//confirm the external issue
	public function confirm_external_issue($editable=null){
	$facility_code=$this -> session -> userdata('facility_id');
	$data['title'] ="Confirm Redistribution";	
	$data['banner_text'] = "Confirm Redistribution";
	$data['redistribution_data']=redistribution_data::get_all_active($facility_code,$editable);	
	$data['editable']=$editable;
	$data['content_view'] = "facility/facility_issues/facility_redistribute_items_confirmation_v";
	$this -> load -> view("shared_files/template/template", $data);		
	}
	// get_all_active_drug_store
	public function confirm_store_external_issue($editable_=null){
	$district_id = $this -> session -> userdata('district_id');
	$data['title'] ="Confirm Redistribution";	
	$data['banner_text'] = "Confirm Redistribution";
	$data['redistribution_data']=redistribution_data::get_all_active_drug_store($district_id,$editable_);	
	$data['editable']=$editable_;
	$data['content_view'] = "facility/facility_issues/facility_redistribute_items_confirmation_v";
	$this -> load -> view("shared_files/template/template", $data);		
	}

public function add_service_points(){
	$facility_code=$this -> session -> userdata('facility_id');
	$data['title'] ="Facility Service Points";	
	$data['banner_text'] = "Facility Service Points";
	$data['service_point']=service_points::get_all_active($facility_code,'all');	
	$data['content_view'] = "facility/facility_issues/add_service_points_v";
	$this -> load -> view("shared_files/template/template", $data);	
}// save service points 
public function save_service_points(){
//security check
if($this->input->post('service_point')):
$service_point_name=$this->input->post('service_point');
$service_for_all_facilities=0;
$date_of_entry=date('y-m-d H:i:s');// check if the user is super admin so that to set the item to all people 
if($this -> session -> userdata('user_indicator')=='super_admin'){$service_for_all_facilities=1;}
foreach($service_point_name as $service_point_name):
$myarray=array('facility_code'=>$this -> session -> userdata('facility_id'),
'service_point_name'=>$service_point_name,
'for_all_facilities'=>$service_for_all_facilities,
'date_added'=>$date_of_entry,
'added_by'=>$this -> session -> userdata('user_id'));
//update the service points 
service_points::update_service_points($myarray); 
endforeach;
$this->session->set_flashdata('system_success_message', "service points Have Been Updated"); 
redirect('issues/add_service_points');	
endif;	
redirect();
}
//update the service point incase smthin changes
public function update_service_point(){
//security check
if($this->input->post('id')):
$service_point_id=$this->input->post('id');
$service_point_name=$this->input->post('name');
$service_status=$this->input->post('status');
$service_for_all_facilities=$this->input->post('all_facilities');
service_points::edit_service_point($service_point_id,$service_point_name,
$service_for_all_facilities,$this -> session -> userdata('user_id'),$service_status);
$this->session->set_flashdata('system_success_message', "service points Have Been Updated"); redirect('issues/add_service_points');		
endif;	
redirect();
}
}

