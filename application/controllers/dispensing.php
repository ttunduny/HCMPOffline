<?php
/*
 * @author Karsan
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Dispensing extends MY_Controller {
	function __construct() 
	{
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}

	public function index(){
		$graph_data = $this->get_service_point_graph_data();
		// echo "<pre>";print_r($graph_data);exit;
		$data['service_point_dashboard_notifications'] = $graph_data;
		$facility_code = $this -> session -> userdata('facility_id');
		$data['banner_text'] = "Pharmacy";
		$data['sidebar'] = "facility/facility_dispensing/sidebar_dispensing";
		// $data['report_view'] = "facility/facility_dispensing/dispensing_home_v";
		// $commodities = Commodities::get_all();
		$data['content_view'] = "facility/facility_dispensing/service_point_home";
		$view = 'shared_files/template/template';
		$data['active_panel'] = 'dispensing';
		$data['title'] = "Dispensing";

		$patients = patients::get_all();
		$commodities_in_facility = facility_stocks::get_facility_stock_amc($facility_code);
		$data['commodities'] = 	$commodities_in_facility;
		// echo "<pre>";print_r($commodities_in_facility);exit;

		$data['patients'] = $patients;
		$this -> load -> view($view, $data);		
	}
	public function get_patient_data(){
		$id = $this->input->post('id');
		// all variable names inspired by Game of Thrones
		// Season 2 Episode 4

		$imp = Patients::get_patient_details($id);
		$winterfell = Patients::get_patient_commodity_info($id);

		// echo "<pre>";print_r($winterfell);echo "</pre>";
		$table = NULL;
		$table .= '<h4>Patient Details</h4>

		<p>Name:'.$imp[0]['patient_names'].'</p> <p>Age: '.$imp[0]['age'].'</p>
		<h4>Recent History</h4>
		<table class="table table-bordered">
			<thead>
				<th>Commodity Code</th>
				<th>Commodity Description</th>
				<th>Issue type</th>
				<th>Amount</th>
				<th>Date of Issue</th>
			</thead>

			<tbody>';
				foreach ($winterfell as $key) {
					$table .='<tr>
					<td>'.$key['commodity_code'].'</td>
					<td>'.$key['commodity_name'].'</td>
					<td>'.$key['issue_type_desc'].'</td>
					<td>'.$key['amount'].'</td>
					<td>'.date('Y m d',$key['date_issued']).'</td>
				</tr>';
			}

			$table.='
				</tbody>
				</table>';
		echo $table;
	}

	public function patients(){
		$p_data = Patients::get_all();
		// $p_data = Patients::get_patient_data();		
		$data['patient_data'] = $p_data;
		$facility_code = $this -> session -> userdata('facility_id');
		$data['title'] = "Patient Management";
		$data['banner_text'] = "Patient Management";
		$data['sidebar'] = "facility/facility_dispensing/sidebar_dispensing";
		$view = 'shared_files/template/template';
		$data['content_view'] = 'facility/facility_dispensing/patients_create_v';
		$this->load->view($view,$data);
	}

	public function add_multiple_patients(){		
		$facility_code = $this -> session -> userdata('facility_id');
		$data['title'] = "Patient Management";
		$data['banner_text'] = "Add Multiple Patients";
		$data['sidebar'] = "facility/facility_dispensing/sidebar_dispensing";
		$view = 'shared_files/template/template';
		$data['content_view'] = 'facility/facility_dispensing/patients_multiple_create_v';
		$this->load->view($view,$data);
	}

		
	public function save_patient_multiple(){
		$facility_code = $this -> session -> userdata('facility_id');
		$count = count($this->input->post('first_name'));		
		for ($i=0; $i < $count; $i++) { 
			$patient_number = $this->input->post('patient_number')[$i];
			$dob = date('y-m-d', strtotime($this->input->post('clone_datepicker_normal_limit_today')[$i]));
			$date_created = date('Y-m-d',strtotime('NOW'));
			$data_array = array('firstname' =>$this->input->post('first_name')[$i] ,
								'lastname' =>$this->input->post('last_name')[$i] ,
								'date_of_birth' =>$dob ,
								'gender' =>$this->input->post('gender')[$i] ,
								'telephone' =>$this->input->post('telephone')[$i] ,
								'email' =>$this->input->post('email')[$i] ,
								'home_address' =>$this->input->post('physical_address')[$i] ,
								'work_address' =>$this->input->post('work_address')[$i] ,
								'patient_number' =>$this->input->post('patient_number')[$i],
								'facility_code' =>$facility_code ,
								'date_created' =>$date_created ,
								'status' =>1);		

			$patients = Patients::save_patient($data_array,$patient_number,$date_created,$facility_code);
		}
		redirect('dispensing/add_multiple_patients');
		
	}
	public function save_patient(){
		$facility_code = $this -> session -> userdata('facility_id');
		$patient_number = $this->input->post('patient_number');
		$date_created = date('Y-m-d',strtotime('NOW'));
		$data_array = array('firstname' =>$this->input->post('first_name') ,
							'lastname' =>$this->input->post('last_name') ,
							'date_of_birth' =>$this->input->post('dob') ,
							'gender' =>$this->input->post('gender') ,
							'telephone' =>$this->input->post('telephone') ,
							'email' =>$this->input->post('email') ,
							'home_address' =>$this->input->post('physical_address') ,
							'work_address' =>$this->input->post('work_address') ,
							'patient_number' =>$patient_number,
							'facility_code' =>$facility_code ,
							'date_created' =>$date_created ,
							'status' =>1);		

		$patients = Patients::save_patient($data_array,$patient_number,$date_created,$facility_code);
	}

	public function get_service_point_graph_data(){
		// $graph_id = "container";
		$facility_code = $this -> session -> userdata('facility_id');
		$service_point = 2;//hard coded for pharmacy,until requested for :]

		$service_point_stock = facility_stocks::get_service_point_stocks($facility_code,$service_point);
		$service_point_name = $service_point_stock[0]['service_point_name'];

		// echo "<pre> Here";print_r($service_point_stock);exit;
		$service_point_stock_count = count($service_point_stock);
		$graph_id = "sp_graph";
		$graph_data = array();
		$graph_data = array_merge($graph_data, array("graph_id" => $graph_id));
		$graph_data = array_merge($graph_data, array("graph_title" => "$service_point_name Stock Level"));
		$graph_data = array_merge($graph_data, array("graph_type" => "bar"));
		$graph_data = array_merge($graph_data, array("graph_yaxis_title" => "Total Stock Level"));
		$graph_data = array_merge($graph_data, array("graph_categories" => array()));
		$graph_data = array_merge($graph_data, array("series_data" => array("Current Pack Balance" => array(), "Current Unit Balance" => array())));
		$graph_data['stacking'] = 'normal';

		foreach($service_point_stock as $service_point_stock):
			$pack_balance = $service_point_stock['current_balance']/$service_point_stock['total_commodity_units'];
			$graph_data['graph_categories'] = array_merge($graph_data['graph_categories'], array($service_point_stock['commodity_name']));
			$graph_data['series_data']['Current Pack Balance'] = array_merge($graph_data['series_data']['Current Pack Balance'],array((float) $pack_balance));
			$graph_data['series_data']['Current Unit Balance'] = array_merge($graph_data['series_data']['Current Unit Balance'],array((float) $service_point_stock['total_commodity_units']));
		endforeach;

		$service_point_stock_data = $this -> hcmp_functions -> create_high_chart_graph($graph_data);
				// echo "<pre>"; print_r($service_point_stock_data); echo "</pre>"; exit;
		$loading_icon = base_url('assets/img/no-record-found.png');
		$service_point_stock_data = ($service_point_stock_count > 0) ? $service_point_stock_data : "$('#container').html('<img src=$loading_icon>');";


		$actual_expiries = count(facility_stocks::get_service_point_stocks($facility_code,$service_point,NULL,1));
		$potential_expiries = count(facility_stocks::get_service_point_stocks($facility_code,$service_point,1,NULL));

		// echo "<pre>";print_r($potential_expiries);exit;
		return array(
			"service_point_stock_count" => $service_point_stock_count,
			"service_point_stock_graph" => $service_point_stock_data,
			"service_point_name" => $service_point_name,
			"potential_expiries" => $potential_expiries,
			"actual_expiries" => $actual_expiries
			);
			}//end of service point dashboard notifications graph data function
			//damn that was a long name
	}
?>