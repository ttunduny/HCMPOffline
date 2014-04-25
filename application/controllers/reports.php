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

		switch ($identifier) {
			case moh :
				$data['content_view'] = "";
				$view = 'shared_files/template/dashboard_template_v';
				break;
			case district :
				$data['content_view'] = "";
				$view = 'shared_files/template/dashboard_template_v';
				break;
			case moh_user :
				$data['content_view'] = "";
				break;
			case facility_admin :
			case facility :
				$facility_code = $this -> session -> userdata('facility_id');
				$data['content_view'] = "facility/facility_reports/reports_v";
				$data['report_view'] = "facility/facility_reports/potential_expiries_v";
				$data['report_data'] = Facility_stocks::potential_expiries($facility_code);
				
				$view = 'shared_files/template/template';
				
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
=======

	/*
	 |--------------------------------------------------------------------------
=======

    /*
	|--------------------------------------------------------------------------
	 | FACILITY REPORTS
	 |--------------------------------------------------------------------------
	 */
	///////////////////GET FACILITY STOCK DATA/////////////////////////////
	public function facility_evaluation_report()
	{
		$facility_code = $this -> session -> userdata('facility_id');
		
		$data['facilities'] = Facilities::get_facility_name($facility_code);
		$data['title'] = "Facility Evaluation Form";
		$data['content_view'] = "facility/facility_reports/facility_evaluation";
		$data['banner_text'] = "Facility Evaluation Form";
		$this -> load -> view("shared_files/template/template", $data);
		
		
	}
	public function save_facility_evaluation() 
	{
		$facility_code = $this -> session -> userdata('news');
		$current_user = $this -> session -> userdata('identity');
		$date = date('y-m-d');
		$data_array = $_POST['data_array'];
		$dataarray = explode("|", $data_array);
		$f_headno = $dataarray[0];
		$f_depheadno = $dataarray[1];
		$nurse_no = $dataarray[2];
		$store_mgrno = $dataarray[3];
		$p_techno = $dataarray[4];
		$trainer = $dataarray[5];
		$comp_avail = $dataarray[6];
		$modem_avail = $dataarray[7];
		$bundles_avail = $dataarray[8];
		$manuals_avail = $dataarray[9];
		$satisfaction_lvl = $dataarray[10];
		$agreed_time = $dataarray[11];
		$feedback = $dataarray[12];
		$pharm_supervision = $dataarray[13];
		$coord_supervision = $dataarray[14];
		$req_id = $dataarray[15];
		$req_spec = $dataarray[16];
		$req_addr = $dataarray[17];
		$train_remarks = $dataarray[18];
		$train_recommend = $dataarray[19];
		$train_useful = $dataarray[20];
		$comf_issue = $dataarray[21];
		$comf_order = $dataarray[22];
		$comf_update = $dataarray[23];
		$comf_gen = $dataarray[24];
		$use_freq = $dataarray[25];
		$freq_spec = $dataarray[26];
		$improvement = $dataarray[27];
		$ease_of_use = $dataarray[28];
		$meet_expect = $dataarray[29];
		$expect_suggest = $dataarray[30];
		$retrain = $dataarray[31];

		$mydata = array('facility_code' => $facility_code, 'assessor' => $current_user, 'date' => $date, 'fhead_no' => $f_headno, 'fdep_no' => $f_depheadno, 'nurse_no' => $nurse_no, 'sman_no' => $store_mgrno, 'ptech_no' => $p_techno, 'trainer' => $trainer, 'comp_avail' => $comp_avail, 'modem_avail' => $modem_avail, 'bundles_avail' => $bundles_avail, 'manuals_avail' => $manuals_avail, 'satisfaction_lvl' => $satisfaction_lvl, 'agreed_time' => $agreed_time, 'feedback' => $feedback, 'pharm_supervision' => $pharm_supervision, 'coord_supervision' => $coord_supervision, 'req_id' => $req_id, 'req_spec' => $req_spec, 'req_addr' => $req_addr, 'train_remarks' => $train_remarks, 'train_recommend' => $train_recommend, 'train_useful' => $train_useful, 'comf_issue' => $comf_issue, 'comf_order' => $comf_order, 'comf_update' => $comf_update, 'comf_gen' => $comf_gen, 'use_freq' => $use_freq, 'freq_spec' => $freq_spec, 'improvement' => $improvement, 'ease_of_use' => $ease_of_use, 'meet_expect' => $meet_expect, 'expect_suggest' => $expect_suggest, 'retrain' => $retrain);

		echo Facility_Evaluation::save_facility_evaluation($mydata);

	}
	
	public function facility_stock_data() 
	{
		$facility_code = $this -> session -> userdata('facility_id');
		$data['facility_stock_data'] = facility_stocks::get_distinct_stocks_for_this_facility($facility_code, 'batch_data_', 'show_all');
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
	public function facility_stocked_out_items() {
		$facility_code = $this -> session -> userdata('facility_id');
		$data['facility_stock_data'] = facility_stocks::get_items_that_have_stock_out_in_facility($facility_code);
		$data['title'] = "Facility Stock Out Summary";
		$data['content_view'] = "facility/facility_reports/facility_stocked_out_items_v";
		$data['banner_text'] = "Facility Stock Out Summary";
		$this -> load -> view("shared_files/template/template", $data);
	}

	public function order_listing($for) {
		$facility_code =null ;	
		$district_id=null;
		$county_id=null;
		if($for=='facility'):
		$facility_code = $this -> session -> userdata('facility_id');		
		$desc='Facility Orders';
		elseif($for=='subcounty'):
		$district_id=$this -> session -> userdata('district_id');
		$desc='Subcounty Orders';
		elseif($for=='county'):
		$county_id=$this -> session -> userdata('county_id');
		$desc='County Orders';
		endif;		
		//get order information from the db
		$facility_order_count_ = facility_orders::get_facility_order_summary_count($facility_code, $district_id, $county_id);
		$facility_order_count = array();
		foreach ($facility_order_count_ as $facility_order_count_) {
		$facility_order_count[$facility_order_count_['status']] = $facility_order_count_['total'];
		}
		$data['order_counts'] = $facility_order_count;
		$data['delivered'] = facility_orders::get_order_details($facility_code, $district_id, $county_id, "delivered");
		$data['pending'] = facility_orders::get_order_details($facility_code, $district_id, $county_id, "pending");
		$data['approved'] = facility_orders::get_order_details($facility_code, $district_id, $county_id, "approved");
		$data['rejected'] = facility_orders::get_order_details($facility_code, $district_id, $county_id, "rejected");
		$data['facilities']=($for=='subcounty') ? Facilities::getFacilities($district_id) : array();
		$data['title'] = $desc;
		$data['banner_text'] = $desc;
		$data['content_view'] = "facility/facility_orders/order_listing_v";
		$this -> load -> view('shared_files/template/template', $data);
	}

	public function create_excel_facility_stock_template() {
		$facility_code = $this -> session -> userdata('facility_id');
		$facility_details = Facilities::get_facility_name_($facility_code) -> toArray();
		$facility_stock_data = Commodities::get_facility_commodities($facility_code, 'sub category data');
		$excel_data = array('doc_creator' => $facility_details[0]['facility_name'], 'doc_title' => 'facility stock list template ', 'file_name' => 'facility stock list template');
		$row_data = array();
		$column_data = array("item HCMP code", "Description", "Supplier", "Commodity Code", "Unit Size", "Batch No", "Manufacturer", "Expiry Date", "Stock Level (Pack)", "Stock Level (Units)");
		$excel_data['column_data'] = $column_data;
		foreach ($facility_stock_data as $facility_stock_data_item) :
		array_push($row_data, array($facility_stock_data_item["commodity_id"], $facility_stock_data_item["commodity_name"], $facility_stock_data_item["source_name"], $facility_stock_data_item["commodity_code"], $facility_stock_data_item["unit_size"], "", "", "", "", ""));
		endforeach;
		$excel_data['row_data'] = $row_data;

		$this -> hcmp_functions -> create_excel($excel_data);
	}
    
	public function create_excel_facility_order_template($order_id,$facility_code) {
		$facility_details = Facilities::get_facility_name_($facility_code) -> toArray();
		$facility_stock_data_item = facility_order_details::get_order_details($order_id);
		$excel_data = array('doc_creator' => $facility_details[0]['facility_name'], 
		'doc_title' => 'facility order template ', 'file_name' => $facility_details[0]['facility_name'].'facility order template');
		$row_data = array();
		$column_data = array("Product Code","Item description(Name/form/strength)","Order unit size", "Price","Quantity Ordered","Total");
		$excel_data['column_data'] = $column_data;
		$from_stock_data=count($facility_stock_data_item);
		for($i=0;$i<$from_stock_data;$i++):
		if ($i==0) {		
		array_push($row_data, array($facility_stock_data_item[$i]["sub_category_name"],"","", "",  ""));}      	
        else if( $facility_stock_data_item[$i]['sub_category_name']!=$facility_stock_data_item[$i-1]['sub_category_name']){
       	 array_push($row_data,array($facility_stock_data_item[$i]["sub_category_name"],"","", "",  ""));
       	 }	
		$total=$facility_stock_data_item["unit_cost"]*$facility_stock_data_item["quantity_ordered_pack"];
		$total=number_format($total, 2, '.', ',');
		array_push($row_data, array($facility_stock_data_item[$i]["commodity_code"], 
		$facility_stock_data_item[$i]["commodity_name"], 
		$facility_stock_data_item[$i]["unit_size"], 
		$facility_stock_data_item[$i]["unit_cost"],
		$facility_stock_data_item[$i]["quantity_ordered_pack"],$total)); //
		endfor;
		$excel_data['row_data'] = $row_data;

		$this -> hcmp_functions -> create_excel($excel_data);
	}

    public function aggragate_order_new_sorf($order_id){
    $order_id_array=explode("_", $order_id);
	$facility_name=array();
	$order_id=array();
	$order_total=array("","","","");
	$order_total_all=0;
	$order_total_all_items=0;
	foreach($order_id_array as $single_order_id){//get the facility names from the orders 
		if($single_order_id>0):
	    $test=facility_orders::get_order_($single_order_id);
	    $order_id=array_merge($order_id,array($single_order_id));
		foreach($test as $test_){
		$order_total=array_merge($order_total,array("",$test_->order_total));
		$order_total_all=$order_total_all+$test_->order_total;
		foreach($test_->facility_detail as $facility_data){
		array_push($facility_name,"$facility_data->facility_name",'');
		}		
		}
		endif;
	 }
	    array_push($order_total,$order_total_all);
	    array_push($facility_name ,"TOTAL");//combine all of them
        $stock_data=Commodities::get_all_from_supllier(1);
		$from_stock_data=count($stock_data);//get items from a supplier 
		$excel_data = array('doc_creator' => "HCMP", 'doc_title' => 'test ', 'file_name' => 'test');
		$row_data = array(array("Product Code","Item description(Name/form/strength)","Order unit size", "Price"));
		foreach($order_id as $order_id_){
		array_push($row_data[0],"Quantity  to Order","Total");	//push this to go with each facility
		}		
		$column_data = array("","","FACILITY NAME","");
		$column_data=array_merge($column_data ,$facility_name);
		$excel_data['column_data'] = $column_data;
		for($i=0;$i<$from_stock_data;$i++):
		$total_all=0;
	    $temp_array=array();
	    $temp_array_=array();
		if ($i==0) {//push the first sub category		
		array_push($row_data,
		 array($stock_data[$i]["sub_category_name"],"","", "",  ""));
			   }      	
        else if( $stock_data[$i]['sub_category_name']!=$stock_data[$i-1]['sub_category_name']){//push the first sub category
       	 array_push($row_data,array($stock_data[$i]["sub_category_name"],"","", "",  ""));
       	 }
		foreach($order_id as $order_id_){
		$total=facility_order_details::get_order_details_from_order($order_id_,$stock_data[$i]["commodity_id"]);
			    
		if(count($total)==0){
		 array_push($temp_array,0,0);
		}else{
		$total_=$total[0]['total']*str_replace(",", '',$stock_data[$i]["unit_cost"]);
		array_push($temp_array,$total[0]['total'],$total_);
		$total_all=$total_all+$total_;
		$order_total_all_items=$order_total_all_items+$total_;
		}
		}	
        $temp_array_= array($stock_data[$i]["commodity_code"],
		 $stock_data[$i]["commodity_name"], 
		 $stock_data[$i]["unit_size"], 
		 $stock_data[$i]["unit_cost"]);
		 $temp_array_=array_merge($temp_array_,$temp_array);
		 array_push($temp_array_,$total_all);
		 array_push($row_data,$temp_array_);
		endfor;

        array_push($row_data,$order_total);
		$excel_data['row_data'] = $row_data;
      
		$this -> hcmp_functions -> create_excel($excel_data);    	
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
                
                <h2> No records</h2>
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
	
	

	public function bin_card_pdf() {

		$facility_code = $this -> session -> userdata('facility_id');

		$commodity_id = 1;
		$to = '2014-01-14';
		$from = '2014-04-14';			
		$data['bin_card'] = Facility_issues::get_bin_card($facility_code,$commodity_id,$from,$to);


		
		$this -> hcmp_functions -> create_pdf($pdf_data);  
		

	}

}
?>