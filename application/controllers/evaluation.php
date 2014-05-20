
<?php 
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	class Evaluation extends MY_Controller
	{
		function __construct() 
	{
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
		//$this->index();
	}
	
	public function index() 
	{
	$county_id = $this -> session -> userdata('county_id');

	$data['sidebar'] = "shared_files/report_templates/side_bar_v";
	$data['content_view'] = "facility/facility_reports/reports_v";
	$data['report_view'] = "facility/facility_reports/analysis_new";
	$view = 'shared_files/template/template';
	// $this->get_district_evaluation_form_results();
	$this -> load -> view($view, $data);
	}

	public function get_district_evaluation_form_results() {
		$district_id = $this -> session -> userdata('district_id');
		$data['district_id'] = $district_id;
		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['banner_text'] = "Facility Training Evaluation Results";
		$data['title'] = "Facility Training Evaluation Results";

		$data['sheduled_training'] = high_stock::get_sheduled_training($district_id);
		$data['feedback_training'] = high_stock::get_feedback_training($district_id);
		$data['pharm_supervision'] = high_stock::get_pharm_supervision($district_id);
		$data['coord_supervision'] = high_stock::get_coord_supervision($district_id);

		$data['req_id'] = high_stock::get_req_id($district_id);
		$data['req_addr'] = high_stock::get_req_addr($district_id);
		$data['retrain'] = high_stock::get_retrain($district_id);

		$data['improvement'] = high_stock::get_improvement($district_id);
		$data['ease_of_use'] = high_stock::get_ease_of_use($district_id);
		$data['meet_expect'] = high_stock::get_meet_expect($district_id);
		$data['train_useful'] = high_stock::get_train_useful($district_id);
		$data['coverage_data'] = high_stock::get_district_coverage_data($district_id);

		$this -> load -> view("template", $data);

	}

}
 
	// public function get_county_evaluation_form_results() {
	// 	$district_id = $this -> session -> userdata('district_id');
	// 	$data['district_id'] = $district_id;
	// 	$data['content_view'] = "facility/facility_reports/reports_v";
	// 	$data['banner_text'] = "Facility Training Evaluation Results";
	// 	$data['title'] = "Facility Training Evaluation Results";

	// 	$data['sheduled_training'] = high_stock::get_sheduled_training($district_id);
	// 	$data['feedback_training'] = high_stock::get_feedback_training($district_id);
	// 	$data['pharm_supervision'] = high_stock::get_pharm_supervision($district_id);
	// 	$data['coord_supervision'] = high_stock::get_coord_supervision($district_id);
	// }
 ?>
