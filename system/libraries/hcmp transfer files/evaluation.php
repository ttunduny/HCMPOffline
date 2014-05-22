<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Evaluation extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));

		// $this->index();
	}

	public function index() {

		$county_id = $this -> session -> userdata('county_id');
		$graph_data =$data= array();
		$data['sidebar'] = "shared_files/report_templates/side_bar_sub_county_v";
		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['report_view'] = "facility/facility_reports/analysis_new";

		$data['county_id'] = $county_id;
		$data['banner_text'] = "Facility Training Evaluation Results";
		$data['title'] = "Facility Training Evaluation Results";

		$facility_evaluation = evaluation_data::get_facility_type($county_id);	    
		//creating the first pie chart
		$graph_data = array_merge($graph_data, array("graph_id" => 'chart_1'));
		$graph_data = array_merge($graph_data, array("graph_title" => 'Facility Type Evaluated'));
		$graph_data = array_merge($graph_data, array("graph_type" => 'pie'));
		$graph_data = array_merge($graph_data, array("graph_yaxis_title" => 'Total Facilities'));
		$graph_data = array_merge($graph_data, array("graph_categories" => array('FBO', 'Other Public Institutions', 'GOK')));
		$graph_data = array_merge($graph_data, array("series_data" => array("Facility Type" =>
		 array(array('FBO',(int)$facility_evaluation[0]['total']),
		 array('Other Public Institutions',(int)$facility_evaluation[2]['total']),
		 array('GOK',(int)$facility_evaluation[1]['total'])))));		
        $data['facility_evaluation']=$this->hcmp_functions->create_high_chart_graph($graph_data);
        
		$data['get_personel_trained'] = evaluation_data::get_personel_trained($county_id);
		$data['get_training_resource'] = evaluation_data::get_training_resource($county_id);
		// end of chart data

		$data['scheduled_training'] = evaluation_data::get_sheduled_training($county_id);
		$data['facility_total'] = evaluation_data::get_sheduled_training($county_id);
		$data['feedback_training'] = evaluation_data::get_feedback_training($county_id);
		$data['pharm_supervision'] = evaluation_data::get_pharm_supervision($county_id);
		$data['coord_supervision'] = evaluation_data::get_coord_supervision($county_id);

		// handled
		$data['req_id'] = evaluation_data::get_req_id($county_id);
		$data['req_addr'] = evaluation_data::get_req_addr($county_id);
		$data['retrain'] = evaluation_data::get_retrain($county_id);
		// handled

		$data['get_use_freq'] = evaluation_data::get_use_freq($county_id);
		$data['improvement'] = evaluation_data::get_improvement($county_id);
		$data['ease_of_use'] = evaluation_data::get_ease_of_use($county_id);
		$data['meet_expect'] = evaluation_data::get_meet_expect($county_id);
		$data['train_useful'] = evaluation_data::get_train_useful($county_id);
		$data['coverage_data'] = evaluation_data::get_district_coverage_data($county_id);

		$view = 'shared_files/template/template';

		// $views = 'facility/facility_reports/analysis_new';
		// $this-> load ->view($views,$dataa);
		$this -> load -> view($view, $data);

	}

}

// public function get_county_evaluation_form_results() {
// 	$county_id = $this -> session -> userdata('district_id');
// 	$data['district_id'] = $county_id;
// 	$data['content_view'] = "facility/facility_reports/reports_v";
// 	$data['banner_text'] = "Facility Training Evaluation Results";
// 	$data['title'] = "Facility Training Evaluation Results";

// 	$data['sheduled_training'] = evaluation_data::get_sheduled_training($county_id);
// 	$data['feedback_training'] = evaluation_data::get_feedback_training($county_id);
// 	$data['pharm_supervision'] = evaluation_data::get_pharm_supervision($county_id);
// 	$data['coord_supervision'] = evaluation_data::get_coord_supervision($county_id);
// }
?>
