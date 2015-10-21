<?php
/**
 * @author Collins
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Divisional_Reports extends MY_Controller 
{
	function __construct() 
	{
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}
	
	public function index()
	{
		$this -> program_reports();
	}
	//used for both the subcounty and county level program reports
	 public function program_reports()
	 {
	 	$malaria_report_data = '';
	 	$user_indicator = $this -> session -> userdata('user_indicator');
	 	switch ($user_indicator) 
	 	{
	 		case facility_admin :   
	 		case facility :
				$facility_id = $this -> session -> userdata('facility_id');
				
				$report_malaria = Malaria_Data::get_facility_report_details($facility_id);
				$report_RH = RH_Drugs_Data::get_facility_report_details($facility_id) ;
				$report_TB = tb_data::get_facility_report_details($facility_id);
				$facility_details = Facilities::get_facility_name2($facility_id);
				$facility_mfl = $facility_id;
				$facility_name = $facility_details['facility_name'];

				// $malaria_report_data = '<tr><td>'.$facility_name.'</td><td>'.$facility_mfl.'</td><td>HCMP</td><td><a href = "'.base_url().'divisional_reports/malaria_report" class = "btn btn-primary btn-sm">View Malaria Report</a></td></tr>';

						
				if ((!empty($report_RH))&&(!empty($report_malaria))&&(!empty($report_TB)))
				{
				$report_RH_report[$index] = $report_RH;
					$report_malaria_report[$index] = $report_malaria;
					$report_tuberculosis_report[$index] = $report_TB;
				
				}else{
					
				}
				$data['fac_mfl'] = $facility_mfl;
				$data['mal_report_data'] = $this->createmalariareport($facility_mfl);
				$data['page_header'] = "Program Reports";	
				$data['malaria'] = $report_malaria_report;
				$data['RH'] = $report_RH_report;
				$data['TB'] = $report_tuberculosis_report;
				$data['title'] = "Facility Program Reports";
				$data['banner_text'] = "Facility Program Reports";
				$data['report_view'] = "subcounty/reports/program_reports_v";
				$data['sidebar'] = "shared_files/report_templates/side_bar_v";
				$data['active_panel'] = "program_reports";
				
			break;
			case district :
				$district_id = $this -> session -> userdata('district_id');
				$facilities = Facilities::get_district_facilities($district_id);
				$index = 0;
				foreach ($facilities as $ids)
				{
					$facility_id = $ids['facility_code'];
					$report_malaria = Malaria_Data::get_facility_report_details($facility_id);
					$report_RH = RH_Drugs_Data::get_facility_report_details($facility_id) ;
					$report_TB = tb_data::get_facility_report_details($facility_id);
					$facility_details = Facilities::get_facility_name2($facility_id);
					$facility_mfl = $facility_id;
					$facility_name = $facility_details['facility_name'];
					$malaria_report_data .= '<option value = "'.$facility_mfl.'">'.$facility_name.'</option>';
					if ((!empty($report_RH))&&(!empty($report_malaria)))
					{
						$report_RH_report[$index] = $report_RH;
						$report_malaria_report[$index] = $report_malaria;
						$report_tuberculosis[$index] = $report_TB;
						
					}else{
						
					}
					
					$index++;
				}
				$data['mal_report_data'] = $malaria_report_data;
				$data['page_header'] = "Program Reports";
				$data['title'] = "District Program Reports";
				$data['banner_text'] = "District Program Reports";
				$data['sidebar'] = "shared_files/report_templates/side_bar_sub_county_v";
				
			break;
			case county:
			 $county_id = $this -> session -> userdata('county_id');
			 // $facilities = Facilities::get_all_facilities_in_county($county_id);
			 $subcounties = Counties::get_subcounties_in_county($county_id);
			 $subcounties_listing = '';
			 foreach ($subcounties as $key => $value) {
			 	$subcounties_listing .= '<option value = "'.$value['id'].'">'.$value['district'].'</option>';
			 }
			 $index = 0;
			 // foreach ($facilities as $ids)
			 // {
				// $facility_id = $ids['facilities'];
				// $report_malaria = Malaria_Data::get_facility_report_details($facility_id);
				// $report_RH = RH_Drugs_Data::get_facility_report_details($facility_id) ;
				// $report_TB = tb_data::get_facility_report_details($facility_id);

				// $facility_details = Facilities::get_facility_name2($facility_id);
				// $facility_mfl = $facility_id;
				// $facility_name = $facility_details['facility_name'];
				// $malaria_report_data .= '<option value = "'.$facility_mfl.'">'.$facility_name.'</option>';
				// if ((!empty($report_RH))&&(!empty($report_malaria)))
				// {
				// 	$report_RH_report[$index] = $report_RH;
				// 	$report_malaria_report[$index] = $report_malaria;
				// 	$report_tuberculosis[$index] = $report_TB;
					
				// }else{
					
				// }
				
				// $index++;
			 // }
			 $data['sub_counties'] = $subcounties_listing;
			 $data['mal_report_data'] = $malaria_report_data;
			 $data['page_header'] = "Program Reports";	
			 $data['title'] = "County Program Reports";
			 $data['banner_text'] = " County Program Reports";
			 $data['sidebar'] = "shared_files/report_templates/side_bar_sub_county_v";
			 
		 break;
		}
		
 		$data['malaria'] = $report_malaria_report;
		$data['RH'] = $report_RH_report;
		$data['TB'] = $report_tuberculosis_report;
		$data['report_view'] = "subcounty/reports/program_reports_v";	
 		$data['active_panel']='divisional';
		if($this->input->is_ajax_request()):
			return $this -> load -> view("subcounty/reports/program_reports_v", $data);
		endif;
		$data['content_view'] = "facility/facility_reports/reports_v";
		$this -> load -> view('shared_files/template/template', $data);
		
	 }
	//for loading the malaria reports
	public function view_malaria_report()
	{
		//Used to pick the kemsa code and assign it to elements displayed on the report
		$malaria_name =  Malaria_Drugs::getName();
		$malaria_array = array();
		$counter = 0;
		
		foreach ($malaria_name as $drug)
		{
			$malaria_drugs = array();
			$malaria_drugs = $drug;
			$malaria_array[$counter] = $malaria_drugs;
			$counter++;
			
		}
		$user_id = $this -> session -> userdata('user_id');
		$data['user_data'] = Malaria_Data::getall($user_id);
		$data['malaria_data'] = $malaria_array;
		$data['drug_rows'] = Malaria_Drugs::getName();
		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['report_view']="facility/facility_reports/view_malaria_reports_v";
		$data['sidebar'] = "shared_files/report_templates/side_bar_v";
		$data['report_title'] =	"Divisional Malaria Reports";
		$view = 'shared_files/template/template';
		$this -> load -> view($view, $data);
		
	}

	public function generate_antimalarial_graph_ajax($county_id){
		$subcounties = Counties::get_subcounties_in_county($county_id);	
		$county_dets = Counties::get_county_name($county_id);
		foreach ($county_dets as $value) {			
			$county_name = $value;
		}	
		
		$subcounties_listing = array();
		$sub_counties_graph = array();
		$sub_counties_names= array();
		foreach ($subcounties as $key => $value) {
		 	$subcounty_id = $value['id'];
		 	$subcounty_name = $value['district'];		 	
		 	$antimalarial_data =  Malaria_Data::get_sub_county_antimalaria($subcounty_id);
		 	if(count($antimalarial_data>0)){
		 		$b6 = ($antimalarial_data[0]['quantity']!='') ? $antimalarial_data[0]['quantity'] : 0 ;
		 		$b12 = ($antimalarial_data[1]['quantity']!='') ? $antimalarial_data[1]['quantity'] : 0 ;
		 		$b18 = ($antimalarial_data[2]['qusantity']!='') ? $antimalarial_data[2]['quantity'] : 0 ;
		 		$b24 = ($antimalarial_data[3]['quantity']!='') ? $antimalarial_data[3]['quantity'] : 0 ;
		 	}
		 	$b6 = intval($b6);
		 	$b12 = intval($b12);
		 	$b18 = intval($b18);
		 	$b24 = intval($b24);
			$sub_counties_names_list= array('Blister of 6','Blister of 12','Blister of 18','Blister of 24');
		 	array_push($sub_counties_names, $sub_counties_names_list);
		 	array_push($sub_counties_graph, $subcounty_name);

		 	$bdata = array('Blister of 6'=>$b6,'Blister of 12'=>$b12,'Blister of 18'=>$b18,'Blister of 24'=>$b24);
		 	// $bdata = array($b6,$b12,$b18,$b24);
		 	$subcounties_listing[] = array('id'=>$subcounty_id,'name'=>$subcounty_name,'data'=>$bdata);
		}
		// $sub_counties_names= array('Blister of 6','Blister of 12','Blister of 18','Blister of 24');
		// echo "<pre>";
		// print_r($subcounties_listing);die;
		// $data['count_records'] = count($sub_counties_graph);
		// $sub_counties_graph = json_encode($sub_counties_graph);
		// $data['sub_counties'] = str_replace('"', "'", $sub_counties_graph);
		$graph_data = array();
		$graph_data = array_merge($graph_data, array("graph_id" => 'graph-section'));
		$graph_data = array_merge($graph_data, array("graph_title" => $county_name.' County Antimalarial Stocks'));
		$graph_data = array_merge($graph_data, array("graph_type" => 'bar'));
		$graph_data = array_merge($graph_data, array("graph_yaxis_title" => 'Quantity in Packs'));
		$graph_data = array_merge($graph_data, array("graph_categories" => array()));
		$graph_data = array_merge($graph_data, array("series_data" => array($subcounties_listing)));
		foreach ($subcounties_listing as $subcounties_graph_listing) :
			$graph_data['graph_categories'] = $sub_counties_graph;
			$graph_data['series_data']['Quantity'] =  array($subcounties_graph_listing['data']);
		endforeach;
		// foreach ($subcounties_listing as $subcounties_graph_listing) :			
			// echo "<pre>";
			// print_r($graph_data['series_data']);die;
		// 	$graph_data['graph_categories'] = $sub_counties_names;
		// 	$graph_data['series_data']= array($subcounties_graph_listing['data']);
		// endforeach;
		// echo "<pre>";
		// print_r($graph_data);die;
		$data['high_graph'] = $this -> hcmp_functions -> create_high_chart_graph($graph_data);
		// $data['sub_counties'] = $sub_counties_graph);
		// echo $data['high_graph'];die;
		// print_r($data['sub_counties']);die;
		// $data['graph_title'] = $county_name.' County Antimalarial Stocks';
		
		// // echo $data['graph_title'];die;
		// $data['report_view'] = "subcounty/reports/program_reports_v_titus";	 		
		// $data['content_view'] = "facility/facility_reports/reports_v";
		// // $data['subcounties_listing']=json_encode($subcounties_listing);
		// $data['sidebar'] = "shared_files/report_templates/side_bar_v";
		// // $data['report_title'] =	"Divisional Malaria Reports";
		// $this -> load -> view('shared_files/template/template', $data);
		return $this -> load -> view("shared_files/report_templates/high_charts_template_v", $data);
		
	}
	public function generate_antimalarial_graph($county_id){
		
		
		$data['county_id'] = $county_id;	 		
		$data['report_view'] = "subcounty/reports/program_reports_v_titus";	 		
		$data['content_view'] = "facility/facility_reports/reports_v";		
		$data['sidebar'] = "shared_files/report_templates/side_bar_v";
		$data['report_title'] =	"Divisional Malaria Reports";
		$this -> load -> view('shared_files/template/template', $data);
		// return $this -> load -> view("shared_files/report_templates/high_charts_template_v", $data);
		
	}
	public function malaria_report($facility = NULL)
	{
		//Used to pick the kemsa code and assign it to elements displayed on the report
		$malariatable = '';
		$user_indicator = $this->session->userdata('user_indicator');
		switch ($user_indicator) {
			case facility_admin :
			case facility:
				$facility = $this -> session -> userdata('facility_id');
				break;
			
			default:
				// echo "Nothing!!!";die;
				break;
		}
		$malaria_name =  Malaria_Drugs::getName();
		$malaria_array = array();
		$counter = 0;
		$user_id = $this -> session -> userdata('user_id');
		$user_names = Users::get_user_names($user_id);
		$data['user_data'] = Malaria_Data::getall($user_id);
		$data['user_names'] = ($user_names[0]['fname']." ".$user_names[0]['lname']);

		$data['malaria_data'] = $this->createmalariareport($facility);
		$data['drug_rows'] = Malaria_Drugs::getName();
		
		
		$facility_info = tb_data::get_facility_name($facility);
		$data['facility_code'] = $facility;
		$data['facility_name'] = ($facility_info['facility_name']);

		$data['title'] = "Malaria Report";
		// $data['banner_text'] = "Facility Malaria Commodities Order";
		$content_view = "facility/facility_reports/facility_reports_malaria_reports_v";
		// $data['sidebar'] = "shared_files/report_templates/side_bar_v";
		
		// $view = 'shared_files/template/template';
		echo $this -> load -> view($content_view, $data);
	}
	
	//for loading the TB report
public function tb_report(){
		$facility = $this -> session -> userdata('facility_id');
		$user_id = $this -> session -> userdata('user_id');
		$user_names = Users::get_user_names($user_id);
		$data['user_names'] = ($user_names[0]['fname']." ".$user_names[0]['lname']);
		
		$facility_info = tb_data::get_facility_name($facility);
		$facility_district = $facility_info['district'];
		$district_name_ = Districts::get_district_name_($facility_district);
		$district_name = $this -> session -> userdata('district');
		
		$data['facility_code'] = $facility_info['facility_code']; 
		$data['district_region_name'] = $district_name_['district'];
		$data['facility_name'] = ($facility_info['facility_name']);
		$data['facility_type_'] = ($facility_info['owner']);


	    $data['title'] = "Tuberculosis Report";
		$data['banner_text'] = "Facility Tuberculosis & Leprosy Commodities";
		$data['graph_data'] = $faciliy_expiry_data;
		$data['content_view'] = "facility/facility_reports/tb_report";
		$view = 'shared_files/template/template';
		$this -> load -> view($view, $data);
	}

// for loading TB form with data
public function view_tb_report()
	{
		//Used to pick the kemsa code and assign it to elements displayed on the report
		$facility = $this -> session -> userdata('facility_id');
		/*echo "<pre>";
		print_r(tb_data::getall($facility));
		echo "</pre>";exit;*/
		$facility = $this -> session -> userdata('facility_id');
		$user_id = $this -> session -> userdata('user_id');
		$user_names = Users::get_user_names($user_id);
		$data['user_names'] = ($user_names[0]['fname']." ".$user_names[0]['lname']);
		
		$facility_info = tb_data::get_facility_name($facility);
		$facility_district = $facility_info['district'];
		$district_name_ = Districts::get_district_name_($facility_district);
		$district_name = $this -> session -> userdata('district');
		
		$data['facility_code'] = $facility_info['facility_code']; 
		$data['district_region_name'] = $district_name_['district'];
		$data['facility_name'] = ($facility_info['facility_name']);
		$data['facility_type_'] = ($facility_info['owner']);


		$data['report_data'] = tb_data::getall($facility);

		$data['title'] = "Tuberculosis Report Update";
		$data['banner_text'] = "Facility Tuberculosis & Leprosy Commodities";
		$data['content_view'] = "facility/facility_reports/edit_tb_report";
		$view = 'shared_files/template/template';
		$this -> load -> view($view, $data);
		
	}

public function save_tb_data(){
	$values = $this->input->post();

	    $beginning_date = $values['table']['beginning_date'][0];
	    $ending_date = $values['table']['ending_date'][0];


	$user_id = $this -> session -> userdata('user_id');
	$facility = $this -> session -> userdata('facility_id');
	$report_id = rand(0, 10000000000);

	// SAVING data
	$save_time = date('Y-m-d H:i:s');
		$data = array();
		$data_ = array();


		for ($i=1; $i < 31; $i++) {//30 drugs thus loop limitation 
		$data = array( 
		'facility_code'=>$facility, 
		'beginning_date'=>$beginning_date,
		'ending_date'=>$ending_date, 
		'beginning_balance'=>$values['table'][$i][1], 
		'currently_recieved'=>$values['table'][$i][2], 
		'quantity_dispensed'=>$values['table'][$i][3], 
		'positive_adjustment'=>$values['table'][$i][4], 
		'negative_adjustment'=>$values['table'][$i][5], 
		'losses'=>$values['table'][$i][6],
		'physical_count'=>$values['table'][$i][7],
		'earliest_expiry'=>$values['table'][$i][8],
		'quantity_needed'=>$values['table'][$i][9],
		'report_date' => $save_time,
		'user_id' =>$user_id,
		'report_id' =>$report_id,
		);
		$this->db->insert('tuberculosis_data',$data);
		}
	$data_ = array(
			'quantity_requested_50' => $values['qtt'],
			'quantity_requested_x0' => $values['x0pg'],
			'FCDRR' => $values['FCDRR'],
			'adult_new' => $values['summary_adult_new'],
			'adult_retreatment' => $values['summary_adult_retreatment'],
			'adult_leprosy' => $values['summary_adult_leprosy'],
			'adult_MDR' => $values['summary_adult_mdr'],
			'adult_IPT' => $values['summary_adult_ipt'],
			'adult_Rifabetia' => $values['summary_adult_rifabetia'],
			'adult_CPT' => $values['summary_adult_cpt'],
			'children_new' => $values['summary_children_new'],
			'children_retreatment' => $values['summary_children_retreatment'],
			'children_leprosy' => $values['summary_children_leprosy'],
			'children_MDR' => $values['summary_children_mdr'],
			'children_IPT' => $values['summary_children_ipt'],
			'children_rifabetia' => $values['summary_children_rifabetia'],
			'children_CPT' => $values['summary_children_cpt'],

			'rhze_beginning_balance' => $values['rhzeB'],
			'rhze_in_supply_box' => $values['rhzeC'],
			'rhze_out_supply_box' => $values['rhzeD'],
			'rhze_withdrawn' => $values['rhzeE'],
			'rhze_ending_balance' => $values['rhzeF'],

			'rh_beginning_balance' => $values['rhB'],
			'rh_in_supply_box' => $values['rhC'] ,
			'rh_out_supply_box' => $values['rhD'],
			'rh_withdrawn' => $values['rhE'],
			'rh_ending_balance' => $values['rhF'],
			'report_id' => $report_id,
			'report_date' => $save_time
			);
$this->db->insert('tuberculosis_report_info',$data_);
	echo "Success";
		exit;
	// END OF SAVING data

	foreach ($values as $key => $value) {
		$no = count($values['table']);
		
}
}

	//For the RH Report
	public function RH_report($facility = NULL)
	{
		//Used to pick the kemsa code and assign it to elements displayed on the report
		$rhtable = '';
		if($facility == NULL){$facility = $this -> session -> userdata('facility_id');}
		$user_id = $this -> session -> userdata('user_id');
		$facility_info = tb_data::get_facility_name($facility);
		$district_name_ = Districts::get_district_name_($facility_district);
		$district_name = $this -> session -> userdata('district');

		$data['facility_code'] = $facility_info['facility_code']; 
		$data['district_region_name'] = $district_name_['district'];
		$data['facility_name'] = ($facility_info['facility_name']);
		$data['facility_type_'] = ($facility_info['owner']);

		
		$data['rh_data'] = $this->createrhreport($facility);

		$data['content_view'] = "facility/facility_reports/facility_reports_RH_reports_v";
		$data['sidebar'] = "shared_files/report_templates/side_bar_v";
		$data['title'] = "RH Report";
		$data['banner_text'] = "Facility RH Commodities Order";

		// $view = 'shared_files/template/template';
		$this -> load -> view($data['content_view'], $data);
		
	}
	 
	public function view_RH_report()
	{
				
		$user_id = $this -> session -> userdata('user_id');
		
		$data['user_data'] = RH_Drugs_Data::getall($user_id);
		$data['malaria_data'] = $malaria_array;
		$data['drug_rows'] = Malaria_Drugs::getName();
		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['report_view']="facility/facility_reports/view_reproductive_health_reports_v";
		$data['sidebar'] = "shared_files/report_templates/side_bar_v";
		
		$data['report_title'] =	"Divisional Reproductive Health Reports";
		$view = 'shared_files/template/template';
		$this -> load -> view($view, $data);
		
	}
	//save the data entered by the user
	public function save_malaria_report()
	{
		$facility = $this -> session -> userdata('facility_id');
		$user_id = $this -> session -> userdata('user_id');
		//Get the values posted by the form
		$Beginning_Balance = $this->input->post('Beginning_Balance');
		$report_id = rand(0, 10000000000);
		for($x=0; $x<count($Beginning_Balance); $x++)
		{
			
			$Quantity_Received = $this->input->post('Quantity_Received');
			$Quantity_Dispensed = $this->input->post('Quantity_Dispensed');
			$Losses_Excluding_Expiries = $this->input->post('Losses_Excluding_Expiries');
			$Positive_Adj = $this->input->post('Positive_Adjustments');
			$Negative_Adj = $this->input->post('Negative_Adjustments');
			$Physical_Count = $this->input->post('Physical_Count');
			$Expired_Drugs = $this->input->post('Expired_Drugs');
			$Days_Out_Stock = $this->input->post('Days_Out_Stock');
			$Total = $this->input->post('Total');
			$kemsa = $this->input->post('kemsa');
			$save_time = date('Y-m-d H:i:s');
			
		
		  	$dbData[$x]= array('Beginning_Balance'=>$Beginning_Balance[$x],
		  	'Quantity_Received'=>$Quantity_Received[$x],//column names
		  	'Quantity_Dispensed'=> $Quantity_Dispensed[$x],
		  	'Losses_Excluding_Expiries'=>$Losses_Excluding_Expiries[$x],
		  	'Positive_Adjustments'=>$Positive_Adj[$x],
		  	'Negative_Adjustments'=>$Negative_Adj[$x],
		  	'Physical_Count'=>$Physical_Count[$x],
		  	'Expired_Drugs'=>$Expired_Drugs[$x],
		  	'Days_Out_Stock'=>$Days_Out_Stock[$x],
			'Report_Total'=>$Total[$x],
			'user_id'=>$user_id,
			'Kemsa_Code'=>$kemsa[$x],
			'Report_Date'=>$save_time,
			'facility_id'=>$facility,
			'report_id'=>$report_id);
		  }

		$this->db->insert_batch('malaria_data',$dbData);
		
		$this->program_reports();
	}
	public function save_RH_report()
	{
		$facility = isset($facility_code)? $facility_code :$this -> session -> userdata('news');
		$user_id = $this -> session -> userdata('user_id');
		//Get the values posted by the form
		$Beginning_Balance = $this->input->post('Beginning_Balance');
		$report_id = rand(0, 10000000000);
		
		for($x=0; $x<count($Beginning_Balance); $x++)
		
		{
			$Beginning_Balance = $this->input->post('Beginning_Balance');
			$Received_This_Month = $this->input->post('Received_This_Month');
			$Dispensed = $this->input->post('Dispensed');
			$Losses = $this->input->post('Losses');
			$Adjustments = $this->input->post('Adjustments');
			$Ending_Balance = $this->input->post('Ending_Balance');
			$Quantity_Requested = $this->input->post('Quantity_Requested');
			$save_time = date('Y-m-d H:i:s');
			
			$dbData[$x]= array(
		  	'Beginning_Balance'=>$Beginning_Balance[$x],
		  	'Received_This_Month'=>$Received_This_Month[$x],
		  	'Dispensed'=> $Dispensed[$x],
		  	'Losses'=>$Losses[$x],
		  	'Adjustments'=>$Adjustments[$x],
		  	'Ending_Balance'=>$Ending_Balance[$x],
		  	'Quantity_Requested'=>$Quantity_Requested[$x],
			'Report_Date'=> $save_time,
			'report_id'=> $report_id);
						
		  }

		$this->db->insert_batch('rh_drugs_data',$dbData);
		$this->index();
	}
	public function edit_report($time)
	{
		
		$time = urldecode($time);
		$malaria_name =  Malaria_Drugs::getName();
		$malaria_array = array();
		$facility = isset($facility_code)? $facility_code :$this -> session -> userdata('news');
		$district = isset($district_id)? $facility_code :$this -> session -> userdata('district');
		$facility_detail = Facilities::get_facility_name_($facility);
		$user_id = $this -> session -> userdata('user_id');
		$facility_detail = Facilities::get_facility_name_($facility);
		$district = $facility_detail['district'];
		$data['drug_rows'] = Malaria_Drugs::getName();
		$data['malaria_data'] = $malaria_array;
		$data['facility_data'] = $facility_detail;
		$data['where_time'] = $time;
		$data['records'] = Malaria_Data::getall_time($time);
		$data['facility_data'] = $facility_detail;
		$data['user_data'] = Malaria_Data::getall($user_id);
		
		$data['content_view'] = "facility/facility_reports/test_edit_report_v";
		$view = 'shared_files/template/template';
		
		$this -> load -> view($view, $data);
	}
	
	
	//To Generate the Reports for the users
	//Its provisional
	
	public function malaria_report_pdf($report_type)
	{
		$report_name="Malaria Commodities Report";
		$title="Health Commodities Management Platform Report";
		$html_data1 ='';

		$html_data1="<table border=1>
		<thead>
					<tr row_id='0'>
						<th>Drug Name</th>
						<th>Beginning Balance</th>
						<th>Quantity Received</th>
						<th>Quantity Dispensed</th>
						<th>Losses Excluding Expiries</th>
						<th>Positive Adjustments</th>
						<th>Negative Adjustments</th>
						<th>Physical Count</th>
						<th>Expired Drugs</th>
						<th>Stock Out Days</th>
						<th>Total</th>
								    
					</tr>
					</thead>
					<tbody>
					<tr>
						<th>Artemether/lumefantrine tab 12</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th>Artemether/lumefantrine tab 18</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th>Artemether/lumefantrine tab 24</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th>Artemether/lumefantrine tab 6</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th>Artesunate Injection</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th>Quinine Injection</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th>Sulfadoxine</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					
					";
		$html_data1 .='</tbody></table>';
		$html_data = $html_data1;
		
		switch ($report_type) 
		{
			case 'excel':
				$this->generate_malaria_report_excel($report_name,$title,$html_data);
				break;
			case 'pdf':
				$this->generate_malaria_report_pdf($report_name,$title,$html_data);
				break;
		}


	}
	public function generate_malaria_report_pdf($report_name,$title,$html_data)
	{
		$current_year = date('Y');
		$current_month = date('F');
		$facility_code=$this -> session -> userdata('news');
		$facility_name_array=Facilities::get_facility_name($facility_code)->toArray();
		$facility_name=$facility_name_array['facility_name'];
				
			/********************************************setting the report title*********************/
			
		$html_title="<div ALIGN=CENTER><img src='".base_url()."assets/img/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 14px; display: block; font-weight: bold; '>
       Ministry of Public Health and Sanitation/Ministry of Medical Services</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 12px; display: block; font-weight: bold;'>".$current_month." ".$current_year."</h2>
       <hr />   ";
		

		$css_path=base_url().'assets/css/style.css';
		
		/**********************************initializing the report **********************/
            $this->load->library('mpdf');
            $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
			//$stylesheet = file_get_contents("$css_path");
			//$this->mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
            $this->mpdf->SetTitle($title);
            $this->mpdf->WriteHTML($html_title);
            $this->mpdf->simpleTables = true;
            $this->mpdf->WriteHTML('<br/>');
            $this->mpdf->WriteHTML($html_data);
			$reportname = $report_name.".pdf";
            $this->mpdf->Output($reportname,'D');

	}
	public function generate_malaria_report_excel($report_name,$title,$html_data)
	{
		$data = $html_data;
 		$filename=$report_name;                      
          header("Content-type: application/excel");
          header("Content-Disposition: attachment; filename=$filename.xls");
          echo "$data"; 
		
	}
	public function sub_county_program_reports()
	 {
	 	$user_indicator = $district_id=$this -> session -> userdata('user_indicator');
	 	switch ($user_indicator) 
	 	{
			case district :
				$district_id = $this -> session -> userdata('district_id');
				$facilities = Facilities::get_district_facilities($district_id);
				$index = 0;
					foreach ($facilities as $ids)
					{
						$facility_id = $ids['facility_code'];
						$report_malaria = Malaria_Data::get_facility_report_details($facility_id);
						$report_RH = RH_Drugs_Data::get_facility_report_details($facility_id) ;
						
						if ((!empty($report_RH))&&(!empty($report_malaria)))
						{
							$report_RH_report[$index] = $report_RH;
							$report_malaria_report[$index] = $report_malaria;
							
						}else{
							
						}
						
						$index++;
					}
					
				$data['malaria'] = $report_malaria_report;
				$data['RH'] = $report_RH_report;
				$data['title'] = "Program Reports";
				$data['banner_text'] = "Program Reports";
				$data['report_view'] = "subcounty/reports/program_reports_v";
				
			break;
			case county:
			 $county_id = $this -> session -> userdata('county_id');
				
			break;
		}
 		
 		
		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['sidebar'] = "shared_files/report_templates/side_bar_sub_county_v";
		$this -> load -> view('shared_files/template/template', $data);
		
	 }

	public function createmalariareport($facility)
	{
		$malariatable = '';
		$items = Facility_Transaction_Table::get_commodities_for_ordering_report($facility, 4);
		if ($items) {
			foreach ($items as $key => $value) {
				$coloring = '';
				$negative = '';
				if($value['adjustmentnve'] < 0)
				{
					$coloring = 'style = "color: red"';
					$number = explode('-', $value['adjustmentnve']);
					$negative = $number[1];
				}
				else if($value['adjustmentnve'] == 0)
				{
					$coloring = 'style = "color: red"';
					$negative = 0;
				}
				else
				{
					$negative = $value['adjustmentnve'];
				}

				$malariatable .= '<tr>';
				$malariatable .= '<td>'.$value['commodity_name'].'</td>';
				$malariatable .= '<td>'.$value['unit_size'].'</td>';
				$malariatable .= '<td>'.$value['unit_cost'].'</td>';
				$malariatable .= '<td>'.$value['opening_balance'].'</td>';
				$malariatable .= '<td>'.$value['total_receipts'].'</td>';
				$malariatable .= '<td>'.$value['total_issues'].'</td>';
				$malariatable .= '<td '.$coloring.'>'.$negative.'</td>';
				$malariatable .= '<td style = "color: green;">'.$value['adjustmentpve'].'</td>';
				$malariatable .= '<td>'.$value['losses'].'</td>';
				$malariatable .= '<td>'.$value['days_out_of_stock'].'</td>';
				$malariatable .= '<td>'.$value['closing_stock'].'</td>';
				$malariatable .= '</tr>';
			}
		}

		return $malariatable;
	}
	
	public function createrhreport($facility)
	{
		$rhtable = '';
		$items = Facility_Transaction_Table::get_commodities_for_ordering_report($facility, 3);

		if ($items) {
			foreach ($items as $key => $value) {

				$coloring = '';
				$negative = '';
				if($value['adjustmentnve'] < 0)
				{
					$coloring = 'style = "color: red"';
					$number = explode('-', $value['adjustmentnve']);
					$negative = $number[1];
				}
				else if($value['adjustmentnve'] == 0)
				{
					$coloring = 'style = "color: red"';
					$negative = 0;
				}
				else
				{
					$negative = $value['adjustmentnve'];
				}

				$rhtable .= '<tr>';
				$rhtable .= '<td>'.$value['commodity_name'].'</td>';
				$rhtable .= '<td>'.$value['unit_size'].'</td>';
				$rhtable .= '<td>'.$value['unit_cost'].'</td>';
				$rhtable .= '<td>'.$value['opening_balance'].'</td>';
				$rhtable .= '<td>'.$value['total_receipts'].'</td>';
				$rhtable .= '<td>'.$value['total_issues'].'</td>';
				$rhtable .= '<td '.$coloring.'>'.$negative.'</td>';
				$rhtable .= '<td>'.$value['adjustmentpve'].'</td>';
				$rhtable .= '<td>'.$value['losses'].'</td>';
				$rhtable .= '<td>'.$value['days_out_of_stock'].'</td>';
				$rhtable .= '<td>'.$value['closing_stock'].'</td>';
				$rhtable .= '</tr>';
			}
		}
		
		return $rhtable;
	}
	public function createfacilitiessubcounty($sub_county, $type = NULL)
	{
		$facilities = Facilities::getFacilities_json($sub_county);

		$facility_listing = '';
		
		foreach ($facilities as $key => $value) {
			$facility_listing .= '<option value = "'.$value['facility_code'] .'">'.$value['facility_name'].'</option>';
		}

		switch ($type) {
			case 'ajax':
				echo $facility_listing;
				break;
			default:
				return $facility_listing;
				break;
		}
	}

	public function pdfreport($report_type, $facility_code)
	{
		$facility_information = $report_data = $heading = $report_title = $data = '';
		$facility_name = Facilities::get_facility_name2($facility_code);
		$facility_obj = Facilities::get_facility_district_county_level($facility_code);
		$facility_information = '<table class = "data-table"><thead><tr><th>Facility Code</th><th>Facility Name</th><th>County</th><th>District</th><th>Type</th></tr></thead>
		<tbody><tr><td>' . $facility_code .'</td><td>' .$facility_name .'</td><td>'.$facility_obj['county'].'</td><td>'.$facility_obj['district'].'</td><td>'.$facility_obj['type'].'</td></tr></tbody>';
		$facility_information .= '</table>';

		switch ($report_type) {
			case 'malaria':
				$heading = '<th>Drug Name</th>';
				$report_title = 'Malaria Program Report For: ' . $facility_name;
				$file_name = $facility_name . ' Malaria Report';
				$data = $this->createmalariareport($facility_code);
				break;

			case 'rh';
				$heading = '<th>Contraceptive</th>';
				$report_title = 'Reproductive Health Program Report For: ' . $facility_name;
				$file_name = $facility_name . ' RH Report';
				$data = $this->createrhreport($facility_code);
				break;
			default:
				break;
		}
		$report_table = '<table class = "data-table">
	<thead>
		<tr>'.$heading.'
			<th>Unit Size</th>
			<th>Unit Cost (Ksh)</th>
			<th>Opening Balance (Units)</th>
			<th>Total Receipts (Units)</th>
		    <th>Total issues (Units)</th>
		    <th>Adjustments(-ve) (Units)</th>
		    <th>Adjustments(+ve) (Units)</th>
		    <th>Losses (Units)</th>
		    <th>No days out of stock</th>
		    <th>Closing Stock(Units)</th>					    
		</tr>
	</thead>';
		if (!$data) {
			$data = '<tr><td colspan = "11"><center>There is no report for this facility</center></td></tr>';
		}
		$report_table .= $data;
		$report_table .= '</table>';
		$pdf_data['pdf_title'] = $report_title;
		$pdf_data['file_name'] = $file_name;
		$pdf_data['pdf_html_body'] = $facility_information . $report_table;
		$this->hcmp_functions->create_pdf($pdf_data);
	}
}