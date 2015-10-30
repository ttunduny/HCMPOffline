<?php
/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class issues extends MY_Controller {
	function __construct() {
		parent::__construct();

		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
		$this -> load -> database();
	}

	/*
	 |--------------------------------------------------------------------------
	 | facility issuing to service points
	 |--------------------------------------------------------------------------
	 |1. load the view/ determine if its a redistribution/ internal issue
	 |2. check if the facility has commodity data
	 |4. save the data in the facility stock, facility transaction , issues table
	 */
	public function index($checker = NULL) {
	 	$facility_code = $this -> session -> userdata('facility_id');
	 	switch ($checker) :
	 	case 'internal' :
	 	$data['content_view'] = "facility/facility_issues/facility_issues_service_points_v";
	 	$data['title'] = "Issues to service points";
	 	$data['banner_text'] = "Issues to service points";
	 	$data['district_store'] = 0;
	 	break;
	 	case 'external' :
	 	$data['content_view'] = "facility/facility_issues/facility_redistribute_items_v";
	 	$data['subcounties'] = districts::getAll();
	 	$data['banner_text'] = "Redistribute Commodities";
	 	$data['title'] = "Redistribute Commodities";
	 	$data['district_store'] = 0;
	 	break;
	 	case 'district_store':	
	 	$district_id = $this -> session -> userdata('district_id');
	 	$dist = districts::get_district_name_($district_id);
	 	$data['district_id'] = $this -> session -> userdata('district_id');
	 	$data['district_data'] = districts::get_district_name_($district_id);
	 	$data['content_view'] = "subcounty/drug_store/drug_store_recieve_items_v";
	 	$data['donate_destination'] = "district";
	 	$data['subcounties']=districts::getAll();
	 	$data['banner_text'] = "Redistribute Commodities";
	 	$data['title'] ="Redistribute Commodities";						
	 	$data['district_store'] = 1;
					//$data['store_commodities'] = drug_store_issues::get_commodities_for_district($district_id);
	 	break;	
	 	default :
	 	endswitch;
	 	$data['service_point'] = service_points::get_all_active($facility_code);
	 	$data['commodities'] = facility_stocks::get_distinct_stocks_for_this_facility($facility_code, 1);

	 	$data_ = facility_stocks::get_distinct_stocks_for_this_facility($facility_code, "batch_data");
	 	foreach ($data_ as $key => $data_1) {
	 		$data_[$key]['commodity_name'] = preg_replace('/[^A-Za-z0-9\-]/', ' ', $data_1['commodity_name']);
	 	}
	 	$data['facility_stock_data'] = json_encode($data_);
		// echo "<pre>";print_r($data_);echo "</pre>";//exit;
		// echo "<pre>";print_r($data['commodities']);echo "</pre>";exit;
		// echo $district_id;exit;
	 	$this -> load -> view("shared_files/template/template", $data);
	 }



	public function generate_issue_excel()
	{
		$this -> hcmp_functions -> clone_facility_issues_sp_template('download_file');
	
	}
	public function county_store_home()
	 {
	 	$county_id = $this -> session -> userdata('county_id');

	 	$data['content_view'] = "county/county_drug_store_home";
	 	// echo "I get here";exit;
	 	$data['county_dashboard_notifications'] = $this -> get_county_dashboard_notifications_graph_data();
	 	// echo "<pre>";print_r($data['county_dashboard_notifications']);exit;
	 	$data['title'] = "County Store Home";
	 	$data['banner_text'] = "Drug Store";

	 	$this-> load -> view("shared_files/template/template", $data);
	 }

	 /* Function For Donations to Districts*/
	public function county_store()
	 {
	 	$county_id = $this -> session -> userdata('county_id');
	 	$data['county_id'] = $this -> session -> userdata('county_id');
	 	// echo "<pre>";print_r($this->session->all_userdata());exit;
	 	$data['county_data'] = counties::get_county_info($county_id);
	 	$county = counties::get_county_name($county_id);
	 	$data['county_id'] = $county_id;
	 	// $data['county_data'] = $county;
	 	$data['content_view'] = "county/county_drug_store";
	 	$data['donate_destination'] = "facility";
	 	$data['subcounties'] = districts::getAll();
	 	$data['banner_text'] = "Redistribute Commodities To Facilities";
	 	$data['title'] = "Redistribute Commodities";
	 	$data['commodities'] = facility_stocks::get_distinct_stocks_for_this_county_store($county_id);

	 	$data['facility_stock_data'] = json_encode(facility_stocks::get_distinct_stocks_for_this_county_store($county_id,"batch_data"));
	 	$this -> load -> view("shared_files/template/template", $data);
	 }

	public function county_store_facilities()
	 {
	 	$county_id = $this -> session -> userdata('county_id');

	 }

	public function county_store_internal()
	 {
	 	$county_id = $this -> session -> userdata('county_id');
	 	$county = counties::get_county_name($county_id);
	 	$data['county_id'] = $county_id;
	 	$data['county_data'] = $county;
	 	$data['content_view'] = "county/drug_store/drug_store_internal";
	 	$data['donate_destination'] = "county";
	 	$data['counties'] = counties::getAll();
	 	$data['banner_text'] = "Redistribute Commodities To Counties";
	 	$data['title'] = "Redistribute Commodities";

	 	$data['commodities'] = "";
	 	$data['county_stock_data'] = "";
	 	echo "<pre>"; print_r($data); echo "</pre>";
	 	$this -> load -> view("shared_files/template/template", $data);
	 }

	public function store_home(){
	 	$district_id = $this -> session -> userdata('district_id');	
		// echo $district_id;exit;
		//$data['expiry_data'] = Facility_stocks::drug_store_commodity_expiries($district_id);
		// echo "<pre>";print_r($data['expiry_data']);echo "</pre>";exit;

	 	$data['content_view'] = "subcounty/subcounty_drug_store_home";	
	 	$data['district_dashboard_notifications']=$this->get_district_dashboard_notifications_graph_data();
		//echo $district_id;exit;
	 	$data['title'] = "Drug Store Home";
	 	$data['banner_text'] = "Drug Store";
	 	$this -> load -> view("shared_files/template/template", $data);
	 }

	public function district_store(){
	 	$district_id = $this -> session -> userdata('district_id');	
	 	$dist = districts::get_district_name_($district_id);	
	 	$data['district_id'] = $this -> session -> userdata('district_id');
	 	$data['district_data'] = districts::get_district_name_($district_id);
	 	$data['content_view'] = "subcounty/subcounty_drug_store";
	 	$data['donate_destination'] = "facility";
	 	$data['subcounties']=districts::getAll();
	 	$data['banner_text'] = "Redistribute Commodities to Facilities";
	 	$data['title'] ="Redistribute Commodities";		
		//$data['service_point']=service_points::get_all_active($facility_code);		
	 	$data['commodities'] = facility_stocks::get_distinct_stocks_for_this_district_store($district_id,1);
		// echo "<pre>";print_r($data['commodities']);echo "</pre>";exit;
	 	$data['facility_stock_data']=json_encode(facility_stocks::get_distinct_stocks_for_this_district_store($district_id,"batch_data"));	
	 	$this -> load -> view("shared_files/template/template", $data);

	 }

	public function district_store_internal(){
	//THIS FUNCTION VANISHES WHEN A COLLINS RELATED PULL GOES DOWN
	//#collins_repo #my_function_my_choice #hahahaha # this was some random thing so that i can commit this function. Cheers
	 	$district_id = $this -> session -> userdata('district_id');	
	 	$dist = districts::get_district_name_($district_id);	
	 	$data['district_id'] = $this -> session -> userdata('district_id');
	 	$data['district_data'] = districts::get_district_name_($district_id);
	 	$data['content_view'] = "subcounty/drug_store/drug_store_internal";
	 	$data['donate_destination'] = "facility";
	 	$data['subcounties']=districts::getAll();
	 	$data['banner_text'] = "Redistribute Commodities to District Stores";
	 	$data['title'] ="Redistribute Commodities";		
		//$data['service_point']=service_points::get_all_active($facility_code);		
	 	$data['commodities'] = facility_stocks::get_distinct_stocks_for_this_district_store($district_id,1);
		// echo "<pre>";print_r($data['commodities']);echo "</pre>";exit;
	 	$data['facility_stock_data']=json_encode(facility_stocks::get_distinct_stocks_for_this_district_store($district_id,"batch_data"));	
	 	$this -> load -> view("shared_files/template/template", $data);

	 }

	public function district_store_internal_issue()
	 {
			// echo "<pre>";print_r($this -> input -> post());echo "</pre>";exit;
			//security check
	 	$facility_code = $this -> session -> userdata('facility_id');
	 	$district_id = $this -> session -> userdata('district_id');
			$service_point = 2;//predefined since 2 is the official code for all district stores
			$destined_district = array_values($this->input->post('district'));
			$commodity_id = array_values($this -> input -> post('desc'));
			$commodity_balance_before = array_values($this -> input -> post('commodity_balance'));
			$facility_stock_id = array_values($this -> input -> post('facility_stock_id'));
			$batch_no = array_values($this -> input -> post('batch_no'));
			$expiry_date = array_values($this -> input -> post('expiry_date'));
			$commodity_unit_of_issue = array_values($this -> input -> post('commodity_unit_of_issue'));
			$quantity_issued = array_values($this -> input -> post('quantity_issued'));
			$clone_datepicker_normal_limit_today = array_values($this -> input -> post('clone_datepicker_normal_limit_today'));
			$manufacture = array_values($this -> input -> post('manufacture'));

			$total_units = array_values($this -> input -> post('total_units'));
			$total_items = count($facility_stock_id);
			//var_dump($total_units);exit;
			$data_array_issues_table = array();
			$data_array_redistribution_table = array();

			$new_transaction_entry = array();
			$new_drug_store_entry = array();

			$digested_expiry = $expiry_date[0] ;
			for ($i = 0; $i < $total_items; $i++) ://compute the actual stock

			$total_items_issues = ($commodity_unit_of_issue[$i] == 'Pack_Size') ? $quantity_issued[$i] * $total_units[$i] : $quantity_issued[$i];
			$mydata = array('facility_code' => $facility_code, 's11_No' => '(-ve Adj) Stock Deduction', 'batch_no' => $batch_no[$i], 'commodity_id' => $commodity_id[$i], 'expiry_date' => date('y-m-d', strtotime($expiry_date[$i])), 'qty_issued' => $total_items_issues, 'issued_to' => "inter-facility donation:" . $facility_name, 'balance_as_of' => $commodity_balance_before[$i], 'date_issued' => date('y-m-d', strtotime($clone_datepicker_normal_limit_today[$i])), 'issued_by' => $this -> session -> userdata('user_id'));

			$mydata_2 = array('manufacturer' => $manufacture[$i],'source_district_id'=> $district_id, 'source_facility_code' => $facility_code, 'batch_no' => $batch_no[$i], 'commodity_id' => $commodity_id[$i], 'expiry_date' => date('y-m-d', strtotime($expiry_date[$i])), 'quantity_sent' => $total_items_issues, 'receive_facility_code' => $service_point[$i], 'facility_stock_ref_id' => $facility_stock_id[$i], 'date_sent' => date('y-m-d'), 'sender_id' => $this -> session -> userdata('user_id'));
				// update the issues table
			array_push($data_array_issues_table, $mydata);
			array_push($data_array_redistribution_table, $mydata_2);
			$existence = drug_store_issues::check_internal_transaction_existence($commodity_id[$i],$destined_district[$i]);
			$store_existence = drug_store_issues::check_drug_existence($commodity_id[$i],$district_id);
					// echo "<pre>"; print_r($existence);echo "</pre>";;exit;
			if ($existence[0]['present'] >= 0) {
				$update_transactions = Doctrine_Manager::getInstance() -> getCurrentConnection();
				$update_transactions -> execute("UPDATE `drug_store_internal_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
					`closing_stock`=`closing_stock`-$total_items_issues
					WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and district_id='$district_id'"
					);
		            // echo $update_transactions;exit;
			}else{
				$new_entry_details = array(
					'district_id'=>$destined_district[$i],
					'commodity_id'=>$commodity_id[$i],
					'opening_balance'=>$total_items_issues,
					'total_issues'=> $total_items_issues,
					'closing_stock'=>$total_items_issues,
					'status'=> 1
					);

				array_push($new_transaction_entry, $new_entry_details);
				$data = $this->db->insert_batch('drug_store_internal_transaction_table',$new_transaction_entry);

			}
			if ($store_existence[0]['present'] >= 1) {
				$update_totals = Doctrine_Manager::getInstance() -> getCurrentConnection();
				$update_totals -> execute("UPDATE `drug_store_totals` SET `total_balance` = `total_balance`-$total_items_issues
					WHERE `commodity_id`= '$commodity_id[$i]' and district_id='$district_id';");
		            // echo $update_totals;exit;
			}else{
				$new_entry_details = array(
					'district_id'=>$district_id,
					'commodity_id'=>$commodity_id[$i],
					'total_balance'=>$total_items_issues,
					'expiry_date'=>$expiry_date[$i]
					);

				array_push($new_drug_store_entry, $new_entry_details);
				$data = $this->db->insert_batch('drug_store_totals',$new_drug_store_entry);
			}

			endfor;

			$user = $this -> session -> userdata('user_id');
			$user_action = "redistribute";
			//updates the log table accordingly based on the action carried out by the user involved
			$update = Doctrine_Manager::getInstance()->getCurrentConnection();
			$update -> execute("update log set $user_action = 1  
				where `user_id`= $user 
				AND action = 'Logged In' 
				and UNIX_TIMESTAMP( `end_time_of_event`) = 0");
			
			// $this -> db -> insert_batch('facility_issues', $data_array_issues_table);
			// $this -> db -> insert_batch('redistribution_data', $data_array_redistribution_table);
			$this -> session -> set_flashdata('system_success_message', "You have issued $total_items item(s)");
			redirect(home);
		// redirect(home);		
	}//district store internal issue

	public function get_county_dashboard_notifications_graph_data()
	{
		$county_id = $this -> session -> userdata('county_id');
		$county_stock = facility_stocks::get_county_stock_amc($county_id);
		// echo "<pre> Here";print_r($county_stock);exit;
		$county_stock_count = count($county_stock);
		$graph_id = "container";
		$graph_data = array();
		$graph_data = array_merge($graph_data, array("graph_id" => $graph_id));
		$graph_data = array_merge($graph_data, array("graph_title" => "County Store Stock Level"));
		$graph_data = array_merge($graph_data, array("graph_type" => "bar"));
		$graph_data = array_merge($graph_data, array("graph_yaxis_title" => "Total Stock Level"));
		$graph_data = array_merge($graph_data, array("graph_categories" => array()));
		$graph_data = array_merge($graph_data, array("series_data" => array("Current Pack Balance" => array(), "Current Unit Balance" => array())));
		$graph_data['stacking'] = 'normal';
		
		foreach($county_stock as $county_stock):
			$graph_data['graph_categories'] = array_merge($graph_data['graph_categories'], array($county_stock['commodity_name']));
		$graph_data['series_data']['Current Pack Balance'] = array_merge($graph_data['series_data']['Current Pack Balance'],array((float) $county_stock['pack_balance']));
		$graph_data['series_data']['Current Unit Balance'] = array_merge($graph_data['series_data']['Current Unit Balance'],array((float) $county_stock['commodity_balance']));
		endforeach;
		
		$county_stock_data = $this -> hcmp_functions -> create_high_chart_graph($graph_data);
		//echo "<pre>"; print_r($county_stock_data); echo "</pre>"; exit;
		$loading_icon = base_url('assets/img/no-record-found.png');
		$county_stock_data = ($county_stock_count > 0) ? $county_stock_data : "$('#container').html('<img src=$loading_icon>');";

		$actual_expiries = count(facility_stocks::county_drug_store_act_expiries($county_id));
		$potential_expiries = count(facility_stocks::county_drug_store_pte_expiries($county_id));
		// echo "<pre> This";print_r($actual_expiries);exit;
		$county_donations = count(redistribution_data::get_all_active_drug_store_county($county_id));
		//$real_county_donations = county(redistribution_data::get_all_active_drug_store($county_id, "to-me"));
		return array(
			"county_stock_count" => $county_stock_count,
			"county_stock_graph" => $county_stock_data,
			"potential_expiries" => $potential_expiries,
			"actual_expiries" => $actual_expiries,
			"county_donations" => $county_donations
			);
	}

	public function get_district_dashboard_notifications_graph_data()
	{
     //format the graph here
     //$facility_code=$this -> session -> userdata('facility_id');
		$district_id = $this -> session -> userdata('district_id');
		$district_stock_=facility_stocks::get_district_stock_amc($district_id);
		$district_stock_count=count($district_stock_);
		$graph_data=array();
		$graph_data=array_merge($graph_data,array("graph_id"=>'container'));
		$graph_data=array_merge($graph_data,array("graph_title"=>'District Store Stock level'));
		$graph_data=array_merge($graph_data,array("graph_type"=>'bar'));
		$graph_data=array_merge($graph_data,array("graph_yaxis_title"=>'Total stock level  (values in packs)'));
		$graph_data=array_merge($graph_data,array("graph_categories"=>array()));
		$graph_data=array_merge($graph_data,array("series_data"=>array("Current Pack Balance"=>array(),"Current Unit Balance"=>array())));
		$graph_data['stacking']='normal';
		foreach($district_stock_ as $district_stock_):
			$graph_data['graph_categories']=array_merge($graph_data['graph_categories'],array($district_stock_['commodity_name']));	
		$graph_data['series_data']['Current Pack Balance']=array_merge($graph_data['series_data']['Current Pack Balance'],array((float) $district_stock_['pack_balance']));	
		$graph_data['series_data']['Current Unit Balance']=array_merge($graph_data['series_data']['Current Unit Balance'],array((float) $district_stock_['commodity_balance']));	
			// $graph_data['series_data'] = array_merge($graph_data['series_data'], array("Potential Expiries" => $series_data2, "Actual Expiries" => $series_data));

		endforeach;
 	//create the graph here
    //echo "I WORK";exit;

		$district_stock_data=$this->hcmp_functions->create_high_chart_graph($graph_data);
		$loading_icon=base_url('assets/img/no-record-found.png'); 
		$district_stock_data=($district_stock_count>0)? $district_stock_data : "$('#container').html('<img src=$loading_icon>');" ;

     //get potential expiries info here
		$potential_expiries_=count(Facility_stocks::drug_store_commodity_expiries($district_id));
     //get actual Expiries info here
		$actual_expiries=count(Facility_stocks::drug_store_commodity_expiries($district_id));
 	//get items they have been donated for
		$facility_donations=redistribution_data::get_all_active_drug_store($district_id,"to-me")->count();
    // echo "<pre>";print_r($facility_donations);echo "</pre>";exit;
    //seth
 	//get stocks from v1
		$stocks_from_v1=0;
		return array('district_stock_count'=>$district_stock_count,
			'district_stock_graph'=>$district_stock_data,
			'potential_expiries'=>$potential_expiries_,
			'actual_expiries'=>$actual_expiries,
			'facility_donations'=>$facility_donations,
			'stocks_from_v1'=>$stocks_from_v1
			);	
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

		$commodity_ids=facility_stocks::get_district_store_commodities($district_id);
		
		$commodity_total = facility_stocks::get_district_store_total_commodities($district_id);

		$comm_count = count($commodity_total);
		// echo "<pre>";print_r($commodity_total);echo "</pre>";exit;

		// insertion of data to totals table
		$totals_data =array();
		$totals_data_ =array();
		
		
		// update the issues table 
		        for($i=0;$i<$total_items;$i++)://compute the actual stock

		        $updated_ckecker = 1;
		        foreach ($commodity_total as $comm) {
		        	if (in_array(($district_id), $comm)){
		        		if (in_array(($commodity_id[$i]), $comm)){
		        			$b = Doctrine_Manager::getInstance()->getCurrentConnection();
		        			$b->execute("UPDATE `drug_store_totals` SET `total_amount` = `total_amount`+$quantity_issued[$i] where commodity_id ='$commodity_id[$i]' and district_id = '$district_id'");
		        			$updated_ckecker = 2;
		        		}
		    }//end of dist if
		}

		switch ($updated_ckecker) {
			case 1:
			$totals_data =array();
			$totals_data_ =array();

			$totals_data_ = array(
				'district_id'=>$district_id,
				'commodity_id' => $commodity_id[$i],
				'total_amount' => $quantity_issued[$i]
				);
			array_push($totals_data,$totals_data_);
			$this->db->insert_batch('drug_store_totals', $totals_data);
			break;
			case 2:
			break;
			default:
			break;
		}
		
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
				//updates the log table accordingly based on the action carried out by the user involved
		$update = Doctrine_Manager::getInstance()->getCurrentConnection();
		$update -> execute("update log set $user_action = 1  
			where `user_id`= $user 
			AND action = 'Logged In' 
			and UNIX_TIMESTAMP( `end_time_of_event`) = 0");
		$this->db->insert_batch('facility_issues', $data_array_issues_table); 
		$this->db->insert_batch('redistribution_data', $data_array_redistribution_table); 
		$this->session->set_flashdata('system_success_message', "You have issued $total_items item(s)");
		redirect();
		endif;
		redirect();	
	}//confirm distribution to district store

	public function county_store_external_issue(){//karsan
			// echo "<pre>";print_r($this -> input -> post());echo "</pre>";exit;
			//security check
			if ($this -> input -> post('mfl')) :
			$facility_code = $this -> session -> userdata('facility_id');
			$district_id = $this -> session -> userdata('district_id');
			$county_id = $this -> session -> userdata('county_id');
			$service_point = array_values($this -> input -> post('mfl'));
			$commodity_id = array_values($this -> input -> post('desc'));
			$commodity_balance_before = array_values($this -> input -> post('commodity_balance'));
			$facility_stock_id = array_values($this -> input -> post('facility_stock_id'));
			$batch_no = array_values($this -> input -> post('batch_no'));
			$expiry_date = array_values($this -> input -> post('expiry_date'));
			$commodity_unit_of_issue = array_values($this -> input -> post('commodity_unit_of_issue'));
			$quantity_issued = array_values($this -> input -> post('quantity_issued'));
			$clone_datepicker_normal_limit_today = array_values($this -> input -> post('clone_datepicker_normal_limit_today'));
			$manufacture = array_values($this -> input -> post('manufacture'));

			$total_units = array_values($this -> input -> post('total_units'));
			$total_items = count($facility_stock_id);
			//var_dump($total_units);exit;
			$data_array_issues_table = array();
			$data_array_redistribution_table = array();

			$new_transaction_entry = array();
			$digested_expiry = $expiry_date[0] ;
			for ($i = 0; $i < $total_items; $i++) ://compute the actual stock

			$total_items_issues = ($commodity_unit_of_issue[$i] == 'Pack_Size') ? $quantity_issued[$i] * $total_units[$i] : $quantity_issued[$i];

				//prepare the issues data
			$facility_name = isset($service_point[$i]) ? Facilities::get_facility_name2($service_point[$i]) : null;
			$facility_name = isset($facility_name) ? $facility_name['facility_name'] : 'N/A';
			$mydata = array('facility_code' => $facility_code, 's11_No' => '(-ve Adj) Stock Deduction', 'batch_no' => $batch_no[$i], 'commodity_id' => $commodity_id[$i], 'expiry_date' => date('y-m-d', strtotime($expiry_date[$i])), 'qty_issued' => $total_items_issues, 'issued_to' => "inter-facility donation:" . $facility_name, 'balance_as_of' => $commodity_balance_before[$i], 'date_issued' => date('y-m-d', strtotime($clone_datepicker_normal_limit_today[$i])), 'issued_by' => $this -> session -> userdata('user_id'));

			$mydata_2 = array('manufacturer' => $manufacture[$i],'source_district_id'=> $district_id, 'source_facility_code' => 2, 'batch_no' => $batch_no[$i], 'commodity_id' => $commodity_id[$i], 'expiry_date' => date('y-m-d', strtotime($expiry_date[$i])), 'quantity_sent' => $total_items_issues, 'receive_facility_code' => $service_point[$i], 'facility_stock_ref_id' => $facility_stock_id[$i], 'date_sent' => date('y-m-d'), 'sender_id' => $this -> session -> userdata('user_id'));
				// update the issues table
			array_push($data_array_issues_table, $mydata);
			array_push($data_array_redistribution_table, $mydata_2);
				// reduce the stock levels
				//var_dump($mydata);exit;

				// $a = Doctrine_Manager::getInstance() -> getCurrentConnection();
				// $a -> execute("UPDATE `facility_stocks` SET `current_balance` = `current_balance`+$total_items_issues where id='$facility_stock_id[$i]'");
				//update the transaction table here
			$inserttransaction = Doctrine_Manager::getInstance() -> getCurrentConnection();
			$inserttransaction -> execute("UPDATE `facility_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
				`closing_stock`=`closing_stock`-$total_items_issues
				WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code='$facility_code';");

			$existence = drug_store_issues::check_transaction_existence_county($commodity_id[$i],$service_point[$i]);
					// echo "<pre>"; print_r($existence);echo "</pre>";exit;
			if ($existence[0]['present'] >= 0) {
				$update_transactions = Doctrine_Manager::getInstance() -> getCurrentConnection();
				$update_transactions -> execute("UPDATE `county_drug_store_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
					`closing_stock`=`closing_stock`-$total_items_issues
					WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code='$service_point[$i]'"
					);
		            // echo $update_transactions;exit;
			}else{
				$new_entry_details = array(
					'facility_code'=>$service_point[$i],
					'commodity_id'=>$commodity_id[$i],
					'opening_balance'=>$total_items_issues,
					'total_issues'=> $total_items_issues,
					'closing_stock'=>$total_items_issues,
					'status'=> 1
					);

				array_push($new_transaction_entry, $new_entry_details);
				$data = $this->db->insert_batch('county_drug_store_transaction_table',$new_transaction_entry);
					// echo $data;exit;
				}//end of existence update/entry if

				$update_totals = Doctrine_Manager::getInstance() -> getCurrentConnection();
				$update_totals -> execute("UPDATE `county_drug_store_totals` SET `total_balance` = `total_balance`-$total_items_issues
					WHERE `commodity_id`= '$commodity_id[$i]' AND `county_id` ='$district_id'");
			//echo $update_totals;exit;

				endfor;

				$user = $this -> session -> userdata('user_id');
				$user_action = "redistribute";
			//updates the log table accordingly based on the action carried out by the user involved
				$update = Doctrine_Manager::getInstance()->getCurrentConnection();
				$update -> execute("update log set $user_action = 1  
					where `user_id`= $user 
					AND action = 'Logged In' 
					and UNIX_TIMESTAMP( `end_time_of_event`) = 0");

			// $this -> db -> insert_batch('facility_issues', $data_array_issues_table);
				$this -> db -> insert_batch('redistribution_data', $data_array_redistribution_table);
				$this -> session -> set_flashdata('system_success_message', "You have issued $total_items item(s)");
				redirect(home);
				endif;
		// redirect(home);		
	}//district store external issue
	public function district_store_external_issue()
		{//karsan
			// echo "<pre>";print_r($this -> input -> post());echo "</pre>";exit;
			//security check
			if ($this -> input -> post('mfl')) :
				$facility_code = $this -> session -> userdata('facility_id');
			$district_id = $this -> session -> userdata('district_id');
			$service_point = array_values($this -> input -> post('mfl'));
			$commodity_id = array_values($this -> input -> post('desc'));
			$commodity_balance_before = array_values($this -> input -> post('commodity_balance'));
			$facility_stock_id = array_values($this -> input -> post('facility_stock_id'));
			$batch_no = array_values($this -> input -> post('batch_no'));
			$expiry_date = array_values($this -> input -> post('expiry_date'));
			$commodity_unit_of_issue = array_values($this -> input -> post('commodity_unit_of_issue'));
			$quantity_issued = array_values($this -> input -> post('quantity_issued'));
			$clone_datepicker_normal_limit_today = array_values($this -> input -> post('clone_datepicker_normal_limit_today'));
			$manufacture = array_values($this -> input -> post('manufacture'));

			$total_units = array_values($this -> input -> post('total_units'));
			$total_items = count($facility_stock_id);
			//var_dump($total_units);exit;
			$data_array_issues_table = array();
			$data_array_redistribution_table = array();

			$new_transaction_entry = array();
			$digested_expiry = $expiry_date[0] ;
			for ($i = 0; $i < $total_items; $i++) ://compute the actual stock

			$total_items_issues = ($commodity_unit_of_issue[$i] == 'Pack_Size') ? $quantity_issued[$i] * $total_units[$i] : $quantity_issued[$i];

				//prepare the issues data
			$facility_name = isset($service_point[$i]) ? Facilities::get_facility_name2($service_point[$i]) : null;
			$facility_name = isset($facility_name) ? $facility_name['facility_name'] : 'N/A';
			$mydata = array('facility_code' => $facility_code, 's11_No' => '(-ve Adj) Stock Deduction', 'batch_no' => $batch_no[$i], 'commodity_id' => $commodity_id[$i], 'expiry_date' => date('y-m-d', strtotime($expiry_date[$i])), 'qty_issued' => $total_items_issues, 'issued_to' => "inter-facility donation:" . $facility_name, 'balance_as_of' => $commodity_balance_before[$i], 'date_issued' => date('y-m-d', strtotime($clone_datepicker_normal_limit_today[$i])), 'issued_by' => $this -> session -> userdata('user_id'));

			$mydata_2 = array('manufacturer' => $manufacture[$i],'source_district_id'=> $district_id, 'source_facility_code' => 2, 'batch_no' => $batch_no[$i], 'commodity_id' => $commodity_id[$i], 'expiry_date' => date('y-m-d', strtotime($expiry_date[$i])), 'quantity_sent' => $total_items_issues, 'receive_facility_code' => $service_point[$i], 'facility_stock_ref_id' => $facility_stock_id[$i], 'date_sent' => date('y-m-d'), 'sender_id' => $this -> session -> userdata('user_id'));
				// update the issues table
			array_push($data_array_issues_table, $mydata);
			array_push($data_array_redistribution_table, $mydata_2);
				// reduce the stock levels
				//var_dump($mydata);exit;

				// $a = Doctrine_Manager::getInstance() -> getCurrentConnection();
				// $a -> execute("UPDATE `facility_stocks` SET `current_balance` = `current_balance`+$total_items_issues where id='$facility_stock_id[$i]'");
				//update the transaction table here
			$inserttransaction = Doctrine_Manager::getInstance() -> getCurrentConnection();
			$inserttransaction -> execute("UPDATE `facility_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
				`closing_stock`=`closing_stock`-$total_items_issues
				WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code='$facility_code';");

			$existence = drug_store_issues::check_transaction_existence($commodity_id[$i],$service_point[$i]);
					// echo "<pre>"; print_r($existence);echo "</pre>";;exit;
			if ($existence[0]['present'] >= 0) {
				$update_transactions = Doctrine_Manager::getInstance() -> getCurrentConnection();
				$update_transactions -> execute("UPDATE `drug_store_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
					`closing_stock`=`closing_stock`-$total_items_issues
					WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code='$service_point[$i]'"
					);
		            // echo $update_transactions;exit;
			}else{
				$new_entry_details = array(
					'facility_code'=>$service_point[$i],
					'commodity_id'=>$commodity_id[$i],
					'opening_balance'=>$total_items_issues,
					'total_issues'=> $total_items_issues,
					'closing_stock'=>$total_items_issues,
					'status'=> 1
					);

				array_push($new_transaction_entry, $new_entry_details);
				$data = $this->db->insert_batch('drug_store_transaction_table',$new_transaction_entry);
					// echo $data;exit;
				}//end of existence update/entry if

				$update_totals = Doctrine_Manager::getInstance() -> getCurrentConnection();
				$update_totals -> execute("UPDATE `drug_store_totals` SET `total_balance` = `total_balance`-$total_items_issues
					WHERE `commodity_id`= '$commodity_id[$i]' AND `district_id` ='$district_id'");
			//echo $update_totals;exit;

				endfor;

				$user = $this -> session -> userdata('user_id');
				$user_action = "redistribute";
			//updates the log table accordingly based on the action carried out by the user involved
				$update = Doctrine_Manager::getInstance()->getCurrentConnection();
				$update -> execute("update log set $user_action = 1  
					where `user_id`= $user 
					AND action = 'Logged In' 
					and UNIX_TIMESTAMP( `end_time_of_event`) = 0");

			// $this -> db -> insert_batch('facility_issues', $data_array_issues_table);
				$this -> db -> insert_batch('redistribution_data', $data_array_redistribution_table);
				$this -> session -> set_flashdata('system_success_message', "You have issued $total_items item(s)");
				redirect(home);
				endif;
		// redirect(home);		
	}//district store external issue


	public function district_store_drug_recieval()
	{
			//security check
		if ($this -> input -> post('mfl')) :
			$facility_code = $this -> session -> userdata('facility_id');
		$district_id = $this -> session -> userdata('district_id');
		$service_point = array_values($this -> input -> post('mfl'));
		$commodity_id = array_values($this -> input -> post('desc'));
		$commodity_balance_before = array_values($this -> input -> post('commodity_balance'));
		$facility_stock_id = array_values($this -> input -> post('facility_stock_id'));
		$batch_no = array_values($this -> input -> post('batch_no'));
		$expiry_date = array_values($this -> input -> post('expiry_date'));
		$commodity_unit_of_issue = array_values($this -> input -> post('commodity_unit_of_issue'));
		$quantity_issued = array_values($this -> input -> post('quantity_issued'));
		$clone_datepicker_normal_limit_today = array_values($this -> input -> post('clone_datepicker_normal_limit_today'));
		$manufacture = array_values($this -> input -> post('manufacture'));

		$total_units = array_values($this -> input -> post('total_units'));
		$total_items = count($facility_stock_id);
			//var_dump($total_units);exit;
		$data_array_issues_table = array();
		$data_array_redistribution_table = array();

		$new_drug_store_entry = array();
		$digested_expiry = $expiry_date[0] ;
			for ($i = 0; $i < $total_items; $i++) ://compute the actual stock

			$total_items_issues = ($commodity_unit_of_issue[$i] == 'Pack_Size') ? $quantity_issued[$i] * $total_units[$i] : $quantity_issued[$i];

				//prepare the issues data
			$facility_name = isset($service_point[$i]) ? Facilities::get_facility_name2($service_point[$i]) : null;
			$facility_name = isset($facility_name) ? $facility_name['facility_name'] : 'N/A';
			$mydata = array('facility_code' => $facility_code, 's11_No' => '(-ve Adj) Stock Deduction', 'batch_no' => $batch_no[$i], 'commodity_id' => $commodity_id[$i], 'expiry_date' => date('y-m-d', strtotime($expiry_date[$i])), 'qty_issued' => $total_items_issues, 'issued_to' => "inter-facility donation:" . $facility_name, 'balance_as_of' => $commodity_balance_before[$i], 'date_issued' => date('y-m-d', strtotime($clone_datepicker_normal_limit_today[$i])), 'issued_by' => $this -> session -> userdata('user_id'));

			$mydata_2 = array('manufacturer' => $manufacture[$i],'source_district_id'=> $district_id, 'source_facility_code' => $facility_code, 'batch_no' => $batch_no[$i], 'commodity_id' => $commodity_id[$i], 'expiry_date' => date('y-m-d', strtotime($expiry_date[$i])), 'quantity_sent' => $total_items_issues, 'receive_facility_code' => $service_point[$i], 'facility_stock_ref_id' => $facility_stock_id[$i], 'date_sent' => date('y-m-d'), 'sender_id' => $this -> session -> userdata('user_id'));
				// update the issues table
			array_push($data_array_issues_table, $mydata);
			array_push($data_array_redistribution_table, $mydata_2);
				// reduce the stock levels
				//var_dump($mydata);exit;
			$a = Doctrine_Manager::getInstance() -> getCurrentConnection();
			$a -> execute("UPDATE `facility_stocks` SET `current_balance` = `current_balance`-$total_items_issues where id='$facility_stock_id[$i]'");
				//update the transaction table here
			$inserttransaction = Doctrine_Manager::getInstance() -> getCurrentConnection();
			$inserttransaction -> execute("UPDATE `facility_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
				`closing_stock`=`closing_stock`-$total_items_issues
				WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code='$facility_code';");

			$existence = drug_store_issues::check_drug_existence($commodity_id[$i],$district_id);
					// echo "<pre>"; print_r($existence);echo "</pre>";;exit;
			if ($existence[0]['present'] >= 0) {
				$update_totals = Doctrine_Manager::getInstance() -> getCurrentConnection();
				$update_totals -> execute("UPDATE `drug_store_totals` SET `total_balance` = `total_balance`+$total_items_issues
					WHERE `commodity_id`= '$commodity_id[$i]' and district_id='$district_id';");
		            //echo $update_totals;exit;
			}else{
				$new_entry_details = array(
					'district_id'=>$district_id,
					'commodity_id'=>$commodity_id[$i],
					'total_balance'=>$total_items_issues,
					'expiry_date'=>$digested_expiry
					);

				array_push($new_drug_store_entry, $new_entry_details);
				$data = $this->db->insert_batch('drug_store_totals',$new_drug_store_entry);
					//echo $data;exit;
				}//end of existence update/entry if
				endfor;

				$user = $this -> session -> userdata('user_id');
				$user_action = "redistribute";
			//updates the log table accordingly based on the action carried out by the user involved
				$update = Doctrine_Manager::getInstance()->getCurrentConnection();
				$update -> execute("update log set $user_action = 1  
					where `user_id`= $user 
					AND action = 'Logged In' 
					and UNIX_TIMESTAMP( `end_time_of_event`) = 0");

				$this -> db -> insert_batch('facility_issues', $data_array_issues_table);
				$this -> db -> insert_batch('redistribution_data', $data_array_redistribution_table);
				$this -> session -> set_flashdata('system_success_message', "You have issued $total_items item(s)");
				redirect(home);
				endif;
		// redirect(home);		
	}//district store external issue


	public function tester(){
		$district_id = $this -> session -> userdata('district_id');
		$sth = drug_store_issues::get_commodities_for_district($district_id);
		echo"<pre>"; print_r($sth); echo "</pre>";
	}

	public function confirm_store_external_issue($editable_ = NULL){
		//seth
		$district_id = $this -> session -> userdata('district_id');
		$data['title'] ="Confirm Redistribution";	
		$data['banner_text'] = "Confirm Redistribution";
		$data['redistribution_data']=redistribution_data::get_all_active_drug_store($district_id,$editable_);
		// echo "<pre>";print_r($data['redistribution_data']);echo "</pre>";exit;
		$data['editable']=$editable_;
		$data['content_view'] = "subcounty/drug_store/drug_store_redistribute_items_confirmation_v";
		$this -> load -> view("shared_files/template/template", $data);		
	}

	public function county_confirm_store_external_issue($editable_ = null){
		$county_id = $this -> session -> userdata('county_id');
		$data['title'] = "Confirm Redistribution";
		$data['banner_text'] = "Confirm Redistribution";
		$data['redistribution_data'] = redistribution_data::get_all_active_drug_store_county($county_id);
		$data['editable'] = $editable_;

		$data['content_view'] = "county/drug_store/drug_store_redistribute_items_confirmation_v";
		$this -> load -> view("shared_files/template/template", $data);
	}

	// facility internal issue
	public function internal_issue() {
		//security check
		if ($this -> input -> post('service_point')) :
			$facility_code = $this -> session -> userdata('facility_id');
		$service_points = array_values($this -> input -> post('service_point'));

		$commodity_id = array_values($this -> input -> post('desc'));
		$commodity_balance_before = array_values($this -> input -> post('commodity_balance'));
		$facility_stock_id = array_values($this -> input -> post('facility_stock_id'));
		$batch_no = array_values($this -> input -> post('batch_no'));
		$expiry_date = array_values($this -> input -> post('expiry_date'));
		$commodity_unit_of_issue = array_values($this -> input -> post('commodity_unit_of_issue'));
		$quantity_issued = array_values($this -> input -> post('quantity_issued'));
		$clone_datepicker_normal_limit_today = array_values($this -> input -> post('clone_datepicker_normal_limit_today'));
		$total_units = array_values($this -> input -> post('total_units'));
		$total_items = count($facility_stock_id);
			//print_r($total_units);
			for ($i = 0; $i < $total_items; $i++) ://compute the actual stock
			$total_items_issues = ($commodity_unit_of_issue[$i] == 'Pack_Size') ? $quantity_issued[$i] * $total_units[$i] : $quantity_issued[$i];
				//prepare the issues data

			$mydata = array('facility_code' => $facility_code, 's11_No' => 'internal issue', 'batch_no' => $batch_no[$i], 'commodity_id' => $commodity_id[$i], 'expiry_date' => date('y-m-d', strtotime($expiry_date[$i])), 'qty_issued' => $total_items_issues, 'issued_to' => $service_points[$i], 'balance_as_of' => $commodity_balance_before[$i], 'date_issued' => date('y-m-d', strtotime($clone_datepicker_normal_limit_today[$i])), 'issued_by' => $this -> session -> userdata('user_id'));

				// update the issues table
			facility_issues::update_issues_table($mydata);
				// reduce the stock levels
			$a = Doctrine_Manager::getInstance() -> getCurrentConnection();
			$a -> execute("UPDATE `facility_stocks` SET `current_balance` = `current_balance`-$total_items_issues where id='$facility_stock_id[$i]'");
				//update the transaction table here

			$inserttransaction = Doctrine_Manager::getInstance() -> getCurrentConnection();
			$inserttransaction -> execute(" UPDATE `facility_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
				`closing_stock`=`closing_stock`-$total_items_issues
				WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code='$facility_code';");

			endfor;

			//updates the log tables with the action
			$user = $this -> session -> userdata('user_id');
			$user_action = "issued";
			//updates the log table accordingly based on the action carried out by the user involved
			$update = Doctrine_Manager::getInstance()->getCurrentConnection();
			$update -> execute("update log set $user_action = 1  
				where `user_id`= $user 
				AND action = 'Logged In' 
				and UNIX_TIMESTAMP( `end_time_of_event`) = 0");
			$this -> session -> set_flashdata('system_success_message', "You have issued $total_items item(s)");
			redirect(home);
			endif;
			redirect(home);
		}

		public function external_issue() {
		//security check
			if ($this -> input -> post('mfl')) :
				$facility_code = $this -> session -> userdata('facility_id');
			$district_id = $this -> session -> userdata('district_id');
			$service_point = array_values($this -> input -> post('mfl'));
			$commodity_id = array_values($this -> input -> post('desc'));
			$commodity_balance_before = array_values($this -> input -> post('commodity_balance'));
			$facility_stock_id = array_values($this -> input -> post('facility_stock_id'));
			$batch_no = array_values($this -> input -> post('batch_no'));
			$expiry_date = array_values($this -> input -> post('expiry_date'));
			$commodity_unit_of_issue = array_values($this -> input -> post('commodity_unit_of_issue'));
			$quantity_issued = array_values($this -> input -> post('quantity_issued'));
			$clone_datepicker_normal_limit_today = array_values($this -> input -> post('clone_datepicker_normal_limit_today'));
			$manufacture = array_values($this -> input -> post('manufacture'));

			$total_units = array_values($this -> input -> post('total_units'));
			$total_items = count($facility_stock_id);
			//var_dump($total_units);exit;
			$data_array_issues_table = array();
			$data_array_redistribution_table = array();
			
			//loops through the data collected from the forms first
			for ($i = 0; $i < $total_items; $i++) :
				//compute the actual stock

				$total_items_issues = ($commodity_unit_of_issue[$i] == 'Pack_Size') ? $quantity_issued[$i] * $total_units[$i] : $quantity_issued[$i];

				//prepare the issues data
			$facility_name = isset($service_point[$i]) ? Facilities::get_facility_name2($service_point[$i]) : null;
			$facility_name = isset($facility_name) ? $facility_name['facility_name'] : 'N/A';
			$mydata = array('facility_code' => $facility_code, 's11_No' => '(-ve Adj) Stock Deduction', 'batch_no' => $batch_no[$i], 'commodity_id' => $commodity_id[$i], 'expiry_date' => date('y-m-d', strtotime($expiry_date[$i])), 'qty_issued' => $total_items_issues, 'issued_to' => "inter-facility donation:" . $facility_name, 'balance_as_of' => $commodity_balance_before[$i], 'date_issued' => date('y-m-d', strtotime($clone_datepicker_normal_limit_today[$i])), 'issued_by' => $this -> session -> userdata('user_id'));

			$mydata_2 = array('manufacturer' => $manufacture[$i],'source_district_id'=> $district_id, 'source_facility_code' => $facility_code, 'batch_no' => $batch_no[$i], 'commodity_id' => $commodity_id[$i], 'expiry_date' => date('y-m-d', strtotime($expiry_date[$i])), 'quantity_sent' => $total_items_issues, 'receive_facility_code' => $service_point[$i], 'facility_stock_ref_id' => $facility_stock_id[$i], 'date_sent' => date('y-m-d'), 'sender_id' => $this -> session -> userdata('user_id'));
				// update the issues table
			array_push($data_array_issues_table, $mydata);
			array_push($data_array_redistribution_table, $mydata_2);
				// reduce the stock levels
				//var_dump($mydata);exit;
			$a = Doctrine_Manager::getInstance() -> getCurrentConnection();
			$a -> execute("UPDATE `facility_stocks` SET `current_balance` = `current_balance`-$total_items_issues where id='$facility_stock_id[$i]'");
				//update the transaction table here
			$inserttransaction = Doctrine_Manager::getInstance() -> getCurrentConnection();
			$inserttransaction -> execute("UPDATE `facility_transaction_table` SET `total_issues` = `total_issues`+$total_items_issues,
				`closing_stock`=`closing_stock`-$total_items_issues
				WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code='$facility_code';");
			endfor;
			
			$user = $this -> session -> userdata('user_id');
			$user_action = "redistribute";
			//updates the log table accordingly based on the action carried out by the user involved
			$update = Doctrine_Manager::getInstance()->getCurrentConnection();
			$update -> execute("update log set $user_action = 1  
				where `user_id`= $user 
				AND action = 'Logged In' 
				and UNIX_TIMESTAMP( `end_time_of_event`) = 0");
			
			$send_sms = $this->hcmp_functions ->send_system_text($user_action);
			
			
			
			$this -> db -> insert_batch('facility_issues', $data_array_issues_table);
			$this -> db -> insert_batch('redistribution_data', $data_array_redistribution_table);
			$this -> session -> set_flashdata('system_success_message', "You have issued $total_items item(s)");
			// redirect(home);
			endif;
			redirect(home);
	}//confirm the external issue

	public function confirm_external_issue($editable = null) {
		$facility_code = $this -> session -> userdata('facility_id');		
		$data['title'] = "Confirm Redistribution";
		$data['banner_text'] = "Confirm Redistribution";
		$data['redistribution_data'] = redistribution_data::get_all_active($facility_code, $editable);
		$data['editable'] = $editable;
		$data['content_view'] = "facility/facility_issues/facility_redistribute_items_confirmation_v";
		$this -> load -> view("shared_files/template/template", $data);
	}

	public function delete_redistribution($id){
		$redistribution_data = redistribution_data::get_one($id);
		foreach ($redistribution_data as $key => $value) {
			$quantity_sent = intval($value['quantity_sent']);
			$stock_id = $value['stock_id'];
			$stock_data = facility_stocks::get_facilty_stock_id($stock_id);			
			foreach ($stock_data as $keys => $values) {
				$current_balance = intval($values['current_balance']);
				$new_balance = $current_balance+$quantity_sent;
				$update_array = array('id'=>$stock_id,'current_balance'=>$new_balance);
				$inserttransaction = Doctrine_Manager::getInstance() -> getCurrentConnection();
				$inserttransaction -> execute("UPDATE `facility_stocks` SET `current_balance` = '$new_balance' WHERE id= '$stock_id'");
				$inserttransaction -> execute("UPDATE `redistribution_data` SET `status` = '5' WHERE id= '$id'");
				$this -> session -> set_flashdata('system_success_message', "The Issue has been Deleted");
				redirect('issues/confirm_external_issue_edit');
			}

		}
	}

	public function confirm_external_issue_edit($editable = null) {
		$facility_code = $this -> session -> userdata('facility_id');
		$subcounty_id = $this -> session -> userdata('district_id');		
		$data['title'] = "Edit Redistribution";
		$data['banner_text'] = "Edit Redistribution";
		$data['redistribution_data'] = redistribution_data::get_all_active_edit($facility_code, $editable);
		// $data['redistribution_data'] = redistribution_data::get_all_active($facility_code, $editable);
		$districts_data = districts::get_district_name($subcounty_id);
		$district_name = '';
		foreach ($districts_data as $value) {
			$district_name = $value->district;
		}
		$data['district_name']=$district_name;		
		$data['district_id']=$subcounty_id;		
		$data['editable'] = $editable;
		$data['subcounties'] = districts::getAll();
		$data['content_view'] = "facility/facility_issues/facility_redistribute_items_confirmation_edit_v";
		$this -> load -> view("shared_files/template/template", $data);
	}

	public function add_service_points() {
		$facility_code = $this -> session -> userdata('facility_id');
		$data['title'] = "Facility Service Points";
		$data['banner_text'] = "Facility Service Points";
		$data['service_point'] = service_points::get_all_active($facility_code, 'all');
		$data['content_view'] = "facility/facility_issues/add_service_points_v";
		$this -> load -> view("shared_files/template/template", $data);
	}// save service points

	public function save_service_points() {
		//security check
		if ($this -> input -> post('service_point')) :
			$service_point_name = $this -> input -> post('service_point');
		$service_for_all_facilities = 0;
		$date_of_entry = date('y-m-d H:i:s');
			// check if the user is super admin so that to set the item to all people
		if ($this -> session -> userdata('user_indicator') == 'super_admin') {$service_for_all_facilities = 1;
		}
		foreach ($service_point_name as $service_point_name) :
			$myarray = array('facility_code' => $this -> session -> userdata('facility_id'), 'service_point_name' => $service_point_name, 'for_all_facilities' => $service_for_all_facilities, 'date_added' => $date_of_entry, 'added_by' => $this -> session -> userdata('user_id'));
				//update the service points
		service_points::update_service_points($myarray);
		endforeach;
		$this -> session -> set_flashdata('system_success_message', "service points Have Been Updated");
		redirect('issues/add_service_points');
		endif;
		redirect(home);
	}

	//update the service point incase smthin changes
	public function update_service_point() {
		//security check
		if ($this -> input -> post('id')) :
			$service_point_id = $this -> input -> post('id');
		$service_point_name = $this -> input -> post('name');
		$service_status = $this -> input -> post('status');
		$service_for_all_facilities = $this -> input -> post('all_facilities');
		service_points::edit_service_point($service_point_id, $service_point_name, $service_for_all_facilities, $this -> session -> userdata('user_id'), $service_status);
		$this -> session -> set_flashdata('system_success_message', "service points Have Been Updated");
		redirect('issues/add_service_points');
		endif;
		redirect(home);
	}

}
