<?php
	if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	class Evaluation extends MY_CONTROLLER{
	public function index(){
		$data['sidebar'] = "shared_files/report_templates/side_bar_v";
		$data['content_view'] = "facility/facility_reports/reports_v";
		$view = 'shared_files/template/template';
		$this -> load -> view($view, $data);
	}
	
	}
	?>