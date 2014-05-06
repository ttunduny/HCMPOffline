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
		$data['sidebar'] = "shared_files/report_templates/side_bar_v";
		$data['content_view'] = "facility/facility_reports/reports_v";
		$view = 'shared_files/template/template';
		$this -> load -> view($view, $data);
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
	public function malaria_report()
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
		$data['content_view'] = "facility/facility_reports/facility_reports_malaria_reports_v";
		$data['sidebar'] = "shared_files/report_templates/side_bar_v";
		
		$view = 'shared_files/template/template';
		$this -> load -> view($view, $data);
	}
	
	//for loading the TB report
	public function TB_report()
	{
		
	}
	//For the RH Report
	public function RH_report()
	{
		//Used to pick the kemsa code and assign it to elements displayed on the report
		$data['content_view'] = "facility/facility_reports/facility_reports_RH_reports_v";
		$data['sidebar'] = "shared_files/report_templates/side_bar_v";
		
		$view = 'shared_files/template/template';
		$this -> load -> view($view, $data);
		
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
		  	'Quantity_Received'=>$Quantity_Received[$x],
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
		
		$this->view_malaria_report();
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
	
}