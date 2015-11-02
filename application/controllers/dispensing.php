<?php
/*
 * @author Karsan
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Dispensing extends MY_Controller 
{
	function __construct() 
	{
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
		// echo "<pre>";print_r(Malaria_Data::get_facility_stock_data(13041));die;
	}

	public function index(){
		$facility_code = $this -> session -> userdata('facility_id');
		$data['banner_text'] = "Commodity Dispensing";
		$data['sidebar'] = "facility/facility_dispensing/sidebar_dispensing";
		// $data['report_view'] = "facility/facility_dispensing/";
		// $commodities = Commodities::get_all();
		$data['content_view'] = "facility/facility_dispensing/dispensing_home";
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

	public function dispense_to_patient($patient_id = NULL){
		$commodities = Commodities::get_all();
		
	}

	public function dispensing_history(){
		
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
		$p_data = Patients::get_patient_data();
		$data['patient_data'] = $p_data;
		$data['sidebar'] = "facility/facility_dispensing/sidebar_dispensing";
		$view = 'shared_files/template/template';
		// $data['report_view']
		$this->load->view($view,$data);
	}
}

?>