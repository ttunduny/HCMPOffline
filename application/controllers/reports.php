<?php
/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Reports extends MY_Controller 
{
	function __construct() 
	{
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}
	public function index() 
	{
		$identifier = $this -> session -> userdata('user_indicator');
		$facility_code = $this -> session -> userdata('facility_id');

		switch ($identifier) 
		{
			case moh :
				$data['content_view'] = "";
				$view = 'shared_files/template/dashboard_template_v';
				break;
			case facility_admin :
				$data['content_view'] = "";
				$view = 'shared_files/template/template';
				break;
			case district :
				$data['content_view'] = "";
				$view = 'shared_files/template/dashboard_template_v';
				break;
			case moh_user :
				$data['content_view'] = "";
				break;
			case facility :
				$data['content_view'] = "facility/facility_reports/reports_v";
				$view = 'shared_files/template/template';
				$data['report_view'] = "facility/facility_reports/potential_expiries_v";
				$data['report_data'] = Facility_stocks::potential_expiries($facility_code);

				break;
			case district_tech :
				$data['content_view'] = "";
				break;
			case rtk_manager :
				$data['content_view'] = "";
				break;
			case super_admin :
				$data['content_view'] = "";
				break;
			case allocation_committee :
				$data['content_view'] = "";
				break;
		}

		$data['title'] = "Reports";
	//$data['banner_text'] = "Reports";
		$data['sidebar'] = "shared_files/report_templates/side_bar_v";
		$this -> load -> view($view, $data);
	}
	/*
	 |--------------------------------------------------------------------------
	 | SHARED REPORTS
	 |--------------------------------------------------------------------------
	 */
	// get the commodity listing here
	public function commodity_listing() 
	{
		$data['title'] = "Commodity Listing";
		$data['banner_text'] = "Commodity Listing";
		$data['content_view'] = "shared_files/commodities/commodity_list_v";
		$data['commodity_list'] = commodity_sub_category::get_all();
		$this -> load -> view('shared_files/template/template', $data);
	}
/*
	 |--------------------------------------------------------------------------
	 | FACILITY REPORTS
	 |--------------------------------------------------------------------------
	 */
	 ///////////////////GET FACILITY STOCK DATA/////////////////////////////	 
	public function facility_stock_data() {
		$facility_code = $this -> session -> userdata('facility_id');
		$data['facility_stock_data'] = facility_stocks::get_distinct_stocks_for_this_facility($facility_code, 'batch_data');
		$data['title'] = "Facility Stock";
		$data['content_view'] = "facility/facility_reports/facility_stock_data_v";
		$data['banner_text'] = "Facility Stock";
		$this -> load -> view("shared_files/template/template", $data);



	}	
	// get the facility transaction data for ordering or quick analysis
	public function facility_transaction_data() {
		$facility_code = $this -> session -> userdata('facility_id');
		$data['facility_stock_data'] = facility_transaction_table::get_all($facility_code);
		$data['title'] = "Facility Stock Summary";
		$data['content_view'] = "facility/facility_reports/facility_transaction_data_v";
		$data['banner_text'] = "Facility Stock Summary";
		$this -> load -> view("shared_files/template/template", $data);
	}
	///////GET THE ITEMS A FACILITY HAS STOCKED OUT ON 
	public function facility_stocked_out_items(){
		$facility_code = $this -> session -> userdata('facility_id');
		$data['facility_stock_data'] =facility_stocks::get_items_that_have_stock_out_in_facility($facility_code);
		$data['title'] = "Facility Stock Out Summary";
		$data['content_view'] = "facility/facility_reports/facility_stocked_out_items_v";
		$data['banner_text'] = "Facility Stock Out Summary";
		$this -> load -> view("shared_files/template/template", $data);
	}
	 public function order_listing(){
		/*		
    	$data['order_counts']=Counties::get_county_order_details("","", $facility_c);
		$data['delivered']=Counties::get_county_received("","", $facility_c);
		$data['pending']=Counties::get_pending_county("","", $facility_c);
		$data['approved']=Counties::get_approved_county("","", $facility_c);
		$data['rejected']=Counties::get_rejected_county("","", $facility_c);
    	$data['content_view'] = "facility/facility_issues/facility_issues_service_points_v";
		$data['title'] = "Order Listing";
		$data['banner_text'] = "Order Listing";	*/
		$data['title'] = "Facility Orders";
		$data['banner_text'] =  "Facility Orders";
		$data['content_view'] = "facility/facility_orders/order_listing_v";
		$this -> load -> view('shared_files/template/template', $data);
    }

	public function expiries() {

		$facility_code = $this -> session -> userdata('facility_id');

		$data['title'] = "Expiries";
		$data['banner_text'] = "Expiries";
		$data['sidebar'] = "shared_files/report_templates/side_bar_v";
		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['expiry_data'] = Facility_stocks::All_expiries($facility_code);
		$data['report_view'] = "facility/facility_reports/expiries_v";

		$this -> load -> view("shared_files/template/template", $data);

	}

	public function potential_exp_process() {

		$facility_code = $this -> session -> userdata('facility_id');
		$interval = $_POST['option_selected'];
		$data['report_data'] = Facility_stocks::specify_period_potential_expiry($facility_code, $interval);
		$this -> load -> view("facility/facility_reports/ajax/potential_expiries_ajax", $data);

	}

	public function stock_control() {

		$facility_code = $this -> session -> userdata('facility_id');

		$data['title'] = "Bin Card";
		$data['banner_text'] = "Bin Card";
		$data['sidebar'] = "shared_files/report_templates/side_bar_v";
		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['commodities']=Commodities::get_facility_commodities($facility_code);
		$data['report_view'] = "facility/facility_reports/bin_card_v";
		$this -> load -> view("shared_files/template/template", $data);

	}
	public function stock_control_ajax() {

		$facility_code = $this -> session -> userdata('facility_id');
		$commodity_id = $_POST['commodity_select'];
		$to = $_POST['to'];
		$from = $_POST['from'];			
		$data['bin_card'] = Facility_issues::get_bin_card($facility_code,$commodity_id,$from,$to);
		$count_records=count(Facility_issues::get_bin_card($facility_code,$commodity_id,$from,$to));
		
		if ($count_records<=0) {

			echo ' <div class="" id="reports_display" style="min-height: 350px;" >
            <div style="margin:auto; text-align: center">
                
                <h2> Please Filter above</h2>
                <h3>
                  If you have selected filters above and you still see this message, You have no Records
                </h3>
                
                </div>
            </div>
            ';
		}else{
		$this -> load -> view("facility/facility_reports/ajax/bin_card_ajax", $data);
		}

	}
	//Gets the consumption data for a particular facility
	public function view_consumption()
	{
		$data['report_view']="facility/facility_reports/consumption_report_v";
		$data['report_title'] =	"Divisional Malaria Reports";
	}
	//Gets the consumption data for a particular facility
	//Only the facility that is logged in
	public function consumption_data() 
	{
		$county_id = $this -> session -> userdata('county_id');
		$facility_id = $this -> session -> userdata('facility_id');
		$county_name = counties::get_county_name($county_id);
		$facility_name = Facilities::get_facility_name2($facility_code);
		
			
		$data['c_data'] = Commodities::get_facility_commodities($facility_id);
		$data['content_view']="facility/facility_reports/reports_v";
		$data['report_view']="facility/facility_reports/ajax/consumption_stats_ajax";
		$view = 'shared_files/template/template';
		$this -> load -> view($view, $data);
				
				
	}
	public function consumption_stats_graph() 
	{
		$county_id = $this -> session -> userdata('county_id');
		$facilities_filter = $this -> session -> userdata('facility_id');
		$facility_name = Facilities::get_facility_name2($facility_code);
		
		$commodity_filter = $_POST['commodity_filter'];
		$commodity_name = Commodities::get_commodity_name($commodity_filter);
		$year_filter = $_POST['year_filter'];
		$plot_value_filter = $_POST['plot_value_filter'];
		
		//Holds all the months of the year
		$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		
		$consumption_data = Facility_stocks::get_facility_drug_consumption_level($facilities_filter, $county_id, $commodity_filter, $year_filter, $plot_value_filter);
		//print_r($consumption_data);
		//exit;
		
		//Build the line graph showing the expiries graph
		$graph_data = array();
		$graph_data = array_merge($graph_data,array("graph_id"=>'graph-section'));
		$graph_data = array_merge($graph_data,array("graph_title"=>'Expired Commodities in '.$facility_name[0]['facility_name']));
		$graph_data = array_merge($graph_data,array("graph_type"=>'line'));
		$graph_data = array_merge($graph_data,array("graph_yaxis_title"=>'Total Expired Commodities  (values in '.$plot_value_filter.')'));
		$graph_data = array_merge($graph_data,array("graph_categories"=>array()));
		$graph_data = array_merge($graph_data,array("series_data"=>array("Current Balance"=>array())));
		//$graph_data['graph_categories'] = array_merge($graph_data['graph_categories'],$);	
		
		foreach($consumption_data as $facility_stock_expired):
			$graph_data['graph_categories'] = array_merge($graph_data['graph_categories'],array($consumption_data['Name']));	
			$graph_data['series_data']['Current Balance'] = array_merge($graph_data['series_data']['Current Balance'],array($facility_stock_expired['total']));	
		endforeach;
			
		//create the graph here
		$faciliy_stock_data = $this->hcmp_functions->create_high_chart_graph($graph_data);
	
		$loading_icon = base_url().'assests/img/no-record-found.png'; 
		$faciliy_stock_data = isset($faciliy_stock_data)? $faciliy_stock_data : "$('#graph_content').html('<img src=$loading_icon>')'" ;
   
   		$data['graph_data'] =	$faciliy_stock_data;
   		//$data['content_view'] = "facility/facility_reports/reports_v";
		$data['report_view'] = "facility/facility_reports/ajax/graph_data_v";
		$view = 'shared_files/template/template';
		$this -> load -> view($view, $data);
		
		
	/*	
		$data['commodity_name'] = $commodity_name;
		$data['plot_value_filter'] = json_encode($plot_value_filter);
		$data['arrayto_graph'] = json_encode($arrayto_graph);
		$data['montharray'] = json_encode($mymontharray);
		$this -> load -> view("facility/facility_reports/ajax/consumption_graph_v", $data);*/

	}
	public function load_facility_cost_of_expiries() 
	{
		$facility_code = $this -> session -> userdata('facility_id'); 
		$county_id = $this -> session -> userdata('county_id');
		$facility_name = Facilities::get_facility_name2($facility_code);
		
		$expired_commodities = Facility_stocks::get_facility_expiries($facility_code);
		//Holds all the months of the year
		$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		//Build the line graph showing the expiries graph
		$graph_data = array();
		$graph_data = array_merge($graph_data,array("graph_id"=>'graph-section'));
		$graph_data = array_merge($graph_data,array("graph_title"=>'Expired Commodities in '.$facility_name[0]['facility_name']));
		$graph_data = array_merge($graph_data,array("graph_type"=>'line'));
		$graph_data = array_merge($graph_data,array("graph_yaxis_title"=>'Total Expired Commodities  (values in packs)'));
		$graph_data = array_merge($graph_data,array("graph_categories"=>array()));
		$graph_data = array_merge($graph_data,array("series_data"=>array("Current Balance"=>array())));
		$graph_data['graph_categories'] = array_merge($graph_data['graph_categories'],$months);	
		
		foreach($expired_commodities as $facility_stock_expired):
			//$graph_data['graph_categories'] = array_merge($graph_data['graph_categories'],array($facility_stock_expired['commodity_name']));	
			$graph_data['series_data']['Current Balance'] = array_merge($graph_data['series_data']['Current Balance'],array($facility_stock_expired['current_balance']));	
		endforeach;
			
		//create the graph here
		$faciliy_stock_data = $this->hcmp_functions->create_high_chart_graph($graph_data);
	
		$loading_icon = base_url().'assests/img/no-record-found.png'; 
		$faciliy_stock_data = isset($faciliy_stock_data)? $faciliy_stock_data : "$('#graph_content').html('<img src=$loading_icon>')'" ;
   
   		$data['graph_data'] =	$faciliy_stock_data;
   		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['report_view'] = "facility/facility_reports/ajax/facility_expiry_filter_v";
		$view = 'shared_files/template/template';
		$this -> load -> view($view, $data);
		
	}
	public function get_facility_expiries($year = null, $month = null,$option = null)
	{
		$facility_code = $this -> session -> userdata('facility_id'); 
		$county_id = $this -> session -> userdata('county_id');
		$facility_name = Facilities::get_facility_name2($facility_code);
		
		$year = (isset($year)) ? $year: date("Y");
		$month = (isset($month)) ? $month:date("m");
		$option = (isset($option)) ? $option: "Packs" ;
	
		$expired_commodities = Facility_stocks::get_filtered_facility_expiries($facility_code, $year, $month, $option);
		//print_r($expired_commodities);
		//exit;
		
		$graph_data = array();
		$graph_data = array_merge($graph_data,array("graph_id"=>'graph-section'));
		$graph_data = array_merge($graph_data,array("graph_title"=>'Expired Commodities in '.$facility_name[0]['facility_name']));
		$graph_data = array_merge($graph_data,array("graph_type"=>'column'));
		$graph_data = array_merge($graph_data,array("graph_yaxis_title"=>'Total Expired Commodities  (values in '.$option.')'));
		$graph_data = array_merge($graph_data,array("graph_categories"=>array()));
		$graph_data = array_merge($graph_data,array("series_data"=>array("Expired Commodities"=>array())));
		//$graph_data['graph_categories'] = array_merge($graph_data['graph_categories'],$month);	
		
		foreach($expired_commodities as $facility_stock_expired):
			$graph_data['graph_categories'] = array_merge($graph_data['graph_categories'],array($facility_stock_expired['Month']));	
			$graph_data['series_data']['Expired Commodities'] = array_merge($graph_data['series_data']['Expired Commodities'],array($facility_stock_expired['total']));	
		endforeach;
			
		//create the graph here
		$faciliy_stock_data = $this->hcmp_functions->create_high_chart_graph($graph_data);
	
		$loading_icon = base_url().'assests/img/no-record-found.png'; 
		$faciliy_stock_data = isset($faciliy_stock_data)? $faciliy_stock_data : "$('#graph_content').html('<img src=$loading_icon>')'" ;
   
   		$data['graph_data'] =	$faciliy_stock_data;
   		$this -> load -> view("facility/facility_reports/ajax/graph_data_v", $data);
		
		
	}
	
	

}
?>