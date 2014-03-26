<?php /**
 * @author Kariuki & Mureithi
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}

	public function index() {
		$identifier = $this -> session -> userdata('user_indicator');
        switch ($identifier):
			case 'moh':
			$view = 'shared_files/template/dashboard_template_v';	
			break;
			case 'facility_admin' || 'facility':
			$view = 'shared_files/template/template';
		    $data['content_view'] = "facility/facility_home_v";	
			$data['facility_dashboard_notifications']=$this->get_facility_dashboard_notifications_graph_data();
			break;
			case 'district':
			$view = 'shared_files/template/dashboard_template_v';
			break;
			case 'moh_user':
			$view = '';
			break;
			case 'district_tech':
			$view = '';
			break;
			case 'rtk_manager':
			$view = '';
			break;
			case 'super_admin':
			$view = '';
			break;
			case 'allocation_committee':
			$view = '';
			break;	
        endswitch;

		$data['title'] = "System Home";
		$data['banner_text'] = "Home";
		$this -> load -> view($view, $data);
	}
    public function get_facility_dashboard_notifications_graph_data(){
    //format the graph here
    $facility_code=$this -> session -> userdata('facility_id'); 
    $facility_stock_=facility_stocks::get_distinct_stocks_for_this_facility($facility_code);
    $graph_data=array();
	$graph_data=array_merge($graph_data,array("graph_id"=>'container'));
	$graph_data=array_merge($graph_data,array("graph_title"=>'Facility stock level'));
	$graph_data=array_merge($graph_data,array("graph_type"=>'column'));
	$graph_data=array_merge($graph_data,array("graph_yaxis_title"=>'Total stock level  (values in packs)'));
	$graph_data=array_merge($graph_data,array("graph_categories"=>array()));
	$graph_data=array_merge($graph_data,array("series_data"=>array("Current Balance"=>array())));
	foreach($facility_stock_ as $facility_stock_):
	$graph_data['graph_categories']=array_merge($graph_data['graph_categories'],array($facility_stock_['commodity_name']));	
	$graph_data['series_data']['Current Balance']=array_merge($graph_data['series_data']['Current Balance'],array($facility_stock_['pack_balance']));	
	endforeach;
	//create the graph here
	$faciliy_stock_data=$this->hcmp_functions->create_high_chart_graph($graph_data);
	$loading_icon=base_url().'assests/img/no-record-found.png'; 
	$faciliy_stock_data=isset($faciliy_stock_data)? $faciliy_stock_data : "$('#container').html('<img src=$loading_icon>')'" ;

	return array('faciliy_stock_graph'=>$faciliy_stock_data);	
    }
	public function get_facilities() {
		//for ajax
		$district = $_POST['district'];
		$facilities = Facilities::getFacilities($district);
		$list = "";
		foreach ($facilities as $facilities) {
			$list .= $facilities -> facility_code;
			$list .= "*";
			$list .= $facilities -> facility_name;
			$list .= "_";
		}
		echo $list;
	}

}
