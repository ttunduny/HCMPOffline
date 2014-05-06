<?php
/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Reports extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}

	public function index() {
		$identifier = $this -> session -> userdata('user_indicator');

		switch ($identifier) {
			case moh :
				$data['content_view'] = "";
				$view = 'shared_files/template/dashboard_template_v';
				break;
			case district :
				$county_id = $this -> session -> userdata('county_id');
	            $data['district_data'] = districts::getDistrict($county_id);
	            $data['c_data'] = Commodities::get_all_2();
				$data['banner_text'] = "Stocking Levels";
				$data['title'] = "Stocking Levels";
				$data['content_view'] = "facility/facility_reports/reports_v";
				$view = 'shared_files/template/template';
				$data['report_view'] = "subcounty/reports/county_stock_level_filter_v";
				$data['sidebar'] = "shared_files/report_templates/side_bar_sub_county_v";		
				break;
			case moh_user :
				$data['content_view'] = "";
				break;
			case facility_admin :
			case facility :
				$facility_code = $this -> session -> userdata('facility_id');
				$data['content_view'] = "facility/facility_reports/reports_v";
				$data['facility_code'] = $facility_code;
				$view = 'shared_files/template/template';
				$data['report_view'] = "facility/facility_reports/potential_expiries_v";
				$data['sidebar'] = "shared_files/report_templates/side_bar_v";
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


	
	public function get_facilities() {
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
     /*
	|--------------------------------------------------------------------------
	 | FACILITY REPORTS
	 |--------------------------------------------------------------------------
	 */
	///////////////////GET FACILITY STOCK DATA/////////////////////////////
	public function facility_stock_data() {
		$facility_code = $this -> session -> userdata('facility_id');
		$data['facility_stock_data'] = facility_stocks::get_distinct_stocks_for_this_facility($facility_code,"batch_data",'all');
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
    public function order_delivery($order_id) {
    	$test= $this -> hcmp_functions -> create_order_delivery_color_coded_table($order_id);
		$data['content_view'] = "facility/facility_orders/view_order_delivery_details_v";
		$data['table']=$test['table'];
		$data['order_id']=$order_id;
		$data['title'] = "Facility Order delivery Report";
		$data['banner_text'] = "Facility Order delivery Report";
		$this -> load -> view('shared_files/template/template', $data);
	}
	public function download_order_delivery($order_id) {
    	$test= $this -> hcmp_functions -> create_order_delivery_color_coded_table($order_id);
		$file_name = $test['facility_name'] . '_facility_order_no_' .$order_id. "_date_created_" .$test['date_ordered'];
		$pdf_data = array("pdf_title" => "Order Report For $test[facility_name]", 'pdf_html_body' => $test['table'], 'pdf_view_option' => 'view_file', 'file_name' => $file_name);
		$this -> hcmp_functions -> create_pdf($pdf_data);
	}
	public function order_listing($for,$report=null) {
		$facility_code =null ;	
		$district_id=null;
		$county_id=null;
		if($for=='facility'):
		$facility_code = $this -> session -> userdata('facility_id');
		$template="shared_files/template/template";		
		$desc='Facility Orders';
		elseif($for=='subcounty'):
		$template="shared_files/template/dashboard_template_v";
		$district_id=$this -> session -> userdata('district_id');
		$desc='Subcounty Orders';
		elseif($for=='county'):
		$template="shared_files/template/dashboard_template_v";
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
		$data['facilities']=($for=='subcounty') ? Facilities::get_facilities_all_per_district($this -> session -> userdata('county_id')) : array();
		if($report=='true'):
		$data['title'] = "Order Listing";
		$data['banner_text'] = "Order Listing";
		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['report_view'] = "facility/facility_orders/order_listing_v";
		$data['sidebar'] = "shared_files/report_templates/side_bar_sub_county_v";
		else:
		$data['title'] = $desc;
		$data['banner_text'] = $desc;

		
		$data['content_view'] = "facility/facility_orders/order_listing_v";	
		endif;
		
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

	public function expiries($facility_code=null) {
        $facility_code=isset($facility_code) ? $facility_code: $this -> session -> userdata('facility_id');
		$facility_name=Facilities::get_facility_name_($facility_code)->toArray();
		$data['facility_name']=$facility_name[0]['facility_name'];
		$data['title'] = "Expiries";
		$data['banner_text'] = "Expiries";
		$data['sidebar'] = (!$this -> session -> userdata('facility_id')) ? "shared_files/report_templates/side_bar_sub_county_v": "shared_files/report_templates/side_bar_v" ;
		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['expiry_data'] = Facility_stocks::All_expiries($facility_code);
		$data['report_view'] = "facility/facility_reports/expiries_v";

		$this -> load -> view("shared_files/template/template", $data);

	}

	public function potential_exp_process($facility_code=null) {
        $facility_code=isset($facility_code) ? $facility_code: $this -> session -> userdata('facility_id');
		$facility_name=Facilities::get_facility_name_($facility_code)->toArray();
		$data['facility_name']=$facility_name[0]['facility_name'];;
		$interval = $_POST['option_selected'];
		$data['report_data'] = Facility_stocks::specify_period_potential_expiry($facility_code, $interval);
		$this -> load -> view("facility/facility_reports/ajax/potential_expiries_ajax", $data);

	}
	public function potential_exp_process_subcounty($facility_code=null) {
        $facility_code=isset($facility_code) ? $facility_code: $this -> session -> userdata('facility_id');
		$facility_name=Facilities::get_facility_name_($facility_code)->toArray();
		$data['facility_name']=$facility_name[0]['facility_name'];
		$data['facility_code']=$facility_code;
		$data['title'] = "Potential Expiries";
		$data['banner_text'] = "Potential Expiries";
		$data['content_view'] = "facility/facility_reports/reports_v";
		$view = 'shared_files/template/template';
		$data['report_view'] = "facility/facility_reports/potential_expiries_v";
		$data['sidebar'] = (!$this -> session -> userdata('facility_id')) ? "shared_files/report_templates/side_bar_sub_county_v": "shared_files/report_templates/side_bar_v" ;
		$data['report_data'] = Facility_stocks::potential_expiries($facility_code);
        $this -> load -> view($view, $data);
	}

	public function stock_control($facility_code=null) {
		$facility_code=isset($facility_code) ? $facility_code: $this -> session -> userdata('facility_id');
		$facility_name=Facilities::get_facility_name_($facility_code)->toArray();
		$data['facility_name']=$facility_name[0]['facility_name'];
		$data['title'] = "Bin Card";
		$data['banner_text'] = "Bin Card";
		$data['sidebar'] = (!$this -> session -> userdata('facility_id')) ? "shared_files/report_templates/side_bar_sub_county_v": "shared_files/report_templates/side_bar_v" ;
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
	public function get_facility_json_data($district_id) {
		echo json_encode(facilities::get_facilities_which_are_online($district_id));
	}
	      /*
	 |--------------------------------------------------------------------------
	 | COUNTY SUB-COUNTY dashboard
	 |--------------------------------------------------------------------------
	 */
	 public function expiries_dashboard(){
	$county_id = $this -> session -> userdata('county_id');
	$data['district_data'] = districts::getDistrict($county_id);
	return $this -> load -> view("subcounty/ajax/county_expiry_filter_v", $data);	
	 }
	 public function get_county_cost_of_expiries_new($year = null, $month = null, $district_id = null, $option = null, $facility_code = null,$report_type=null) {
	 	//reset the values here
	 	$year=($year=="NULL") ? null :$year;
	 	$month=($month=="NULL") ? null :$month;
	 	$district_id=($district_id=="NULL") ? null :$district_id;
	 	$option=($optionr=="NULL") ? null :$option;
	 	$facility_code=($facility_code=="NULL") ? null :$facility_code;
		$option=($option=="NULL" || $option=="null") ? null :$option;
		//set up the variables 
		$year=isset($year)? $year :date("Y");		
		$county_id = $this -> session -> userdata('county_id');
		$district_id_checker = $this -> session -> userdata('district_id');
		$county_name = counties::get_county_name($county_id);
		$category_data = array();
		$series_data =$series_data_ = array();		
		$temp_array =$temp_array_ = array();
		$graph_data=array();
		$graph_type='';
		$title='';
        //months
		$months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');		
		$month_=isset($month) ?$months[(int) $month-1] : null ;
        //check if the district is set
		$district_data = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : null;
		$district_name_ = (isset($district_data)) ? " :" . $district_data[0]['district'] . " subcounty" : null;
		$option_new = isset($option) ? $option : "ksh";
		$facility_code_ = isset($facility_code) ? facilities::get_facility_name_($facility_code) -> toArray() : null;
		$facility_name=$facility_code_[0]['facility_name'];
		$title=isset($facility_code) && isset($district_id)? "$district_name_ : $facility_name" :( 
	 isset($district_id) && !isset($facility_code) ?  "$district_name_": "$county_name[county] county") ;
        //get the expiry for the entire year either for a facility sub-county or county      
		if ($year==date("Y") && !isset($month)) {
		$category_data = array_merge($category_data, $months);
		$commodity_array = Facility_stocks::get_county_cost_of_exipries_new($facility_code,$district_id,
		$county_id, $year, null,$option ,"all");       
		foreach ($commodity_array as $data) :
		$temp_array = array_merge($temp_array, array($data["cal_month"] => $data['total']));
		endforeach;
		foreach ($months as $key => $data) :
		$val = (array_key_exists($data, $temp_array)) ? (int)$temp_array[$data] : (int)0;
		$series_data = array_merge($series_data, array($val));
		array_push($series_data_, array($data,$val));
		endforeach;
		$graph_type='spline';
		}
        //get the expiry for a specific month base on the set parameters
		if (isset($month) && $month>0) {
		$commodity_array = Facility_stocks::get_county_cost_of_exipries_new($facility_code,$district_id,
		$county_id, $year, $month,$option ,"all_");
		foreach ($commodity_array as $data) :
		$series_data  = array_merge($series_data , array($data["name"] => $data['total']));
		$category_data=array_merge($category_data, array($data["name"]));
		array_push($series_data_, array($data["name"], $data['total']));
		endforeach;
        $graph_type='column';
		}
		
		if($report_type=="csv_data"):
		$excel_data = array('doc_creator' =>$this -> session -> userdata('full_name'), 'doc_title' => "stock expired in $commodity_name $title $month_ $year", 'file_name' => "Stock_expired_$commodity_name_$title_$month_$year");
		$row_data = array(array("stock expired in $title $month_ $year","stock expired in $option_new"));
		$column_data = array("");
		$excel_data['column_data'] = $column_data;
		$row_data=array_merge($row_data,$series_data_);
		$excel_data['row_data'] = $row_data;
		$this -> hcmp_functions -> create_excel($excel_data);
		else:   
	    $graph_data=array_merge($graph_data,array("graph_id"=>'dem_graph_'));
	    $graph_data=array_merge($graph_data,array("graph_title"=>"stock expired in $title $month_ $year"));
	    $graph_data=array_merge($graph_data,array("graph_type"=>$graph_type));
	    $graph_data=array_merge($graph_data,array("graph_yaxis_title"=>"stock expired in $option_new"));
	    $graph_data=array_merge($graph_data,array("graph_categories"=>$category_data ));
	    $graph_data=array_merge($graph_data,array("series_data"=>array('total'=>$series_data)));
		$data = array();
		$data['high_graph'] = $this->hcmp_functions->create_high_chart_graph($graph_data);
		return $this -> load -> view("shared_files/report_templates/high_charts_template_v", $data);
		endif;
	}
         public function stock_level_dashboard(){
	     $county_id = $this -> session -> userdata('county_id');
	     $data['district_data'] = districts::getDistrict($county_id);
	     $data['c_data'] = Commodities::get_all_2();
	     return $this -> load -> view("subcounty/ajax/county_stock_level_filter_v", $data);	
	    }
     	public function get_county_stock_level_new($commodity_id = null, $category_id = null, $district_id = null, $facility_code=null, $option = null,$report_type=null) {
     	//reset the values here
     	$commodity_id=($commodity_id=="NULL") ? null :$commodity_id;
		$category_id=($category_id=="NULL") ? null :$category_id;
	 	$district_id=($district_id=="NULL") ? null :$district_id;
	 	$option=($optionr=="NULL") ? null :$option;
	 	$facility_code=($facility_code=="NULL") ? null :$facility_code;
		$option=($option=="NULL" || $option=="null") ? null :$option;	
     	//setting up the data
		$county_id = $this -> session -> userdata('county_id');
		$county_name = counties::get_county_name($county_id);
		$category_data =$series_data = $series_data_ =  $graph_data=$data =array();
		$title='';	
		$year=date('Y');
		$month_=date('M d');
        //check if the district is set
		$district_data = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : null;
		$district_name_ = (isset($district_data)) ? " :" . $district_data[0]['district'] . " subcounty" : null;
		$option_new = isset($option) ? $option : "ksh";
		$facility_code_ = isset($facility_code) ? facilities::get_facility_name_($facility_code) -> toArray() : null;
		$facility_name=$facility_code_[0]['facility_name'];
		$commodity_name=(isset($commodity_id))? Commodities::get_details($commodity_id)->toArray() : null;
		$category_name_=@$commodity_name[0]['commodity_name'];
		$commodity_name=isset($category_name_)? " for ".$category_name_ : null;
		$title=isset($facility_code) && isset($district_id)? "$district_name_ : $facility_name" :( 
	 isset($district_id) && !isset($facility_code) ?  "$district_name_": "$county_name[county] county") ;
		$commodity_array = facility_stocks::get_county_drug_stock_level_new($facility_code,$district_id,$county_id,
		 $category_id, $commodity_id,  $option_new,$report_type);
        foreach ($commodity_array as $data) :
		if($report_type=="table_data"):
		if($commodity_id>0):
		array_push($series_data , array($data['district'],$data["facility_name"],$data["facility_code"], $data['total']));
		else:
		array_push($series_data , array($data["name"], $data['total']));
		endif;						
		else:
		$series_data  = array_merge($series_data , array($data["name"] => $data['total']));
		$series_data_  = array_merge($series_data_ , array($data["name"],$data['total']));
		$category_data=array_merge($category_data, array($data["name"]));
		endif;
		endforeach;
		
		if($report_type=="table_data"):
		if($commodity_id>0):
		$category_data=array(array("Sub-county","Facility Name","Mfl","TOTAL ".$option_new));
		else:
		array_push($category_data, array("Stock level $commodity_name $title $month_ $year","stocks worth in $option_new"));
		endif;	
        $graph_data=array_merge($graph_data,array("table_id"=>'dem_graph_'));
	    $graph_data=array_merge($graph_data,array("table_header"=>$category_data ));
	    $graph_data=array_merge($graph_data,array("table_body"=>$series_data));
				
		$data['table'] = $this->hcmp_functions->create_data_table($graph_data);
		$data['table_id'] ="dem_graph_";
		return $this -> load -> view("shared_files/report_templates/data_table_template_v", $data);
		
		elseif($report_type=="csv_data"):
		$excel_data = array('doc_creator' =>$this -> session -> userdata('full_name'), 'doc_title' => "Stock level $commodity_name $title $month_ $year", 'file_name' => "Stock_level_$commodity_name_$title_$month_$year");
		$row_data = array(array("Stock level $commodity_name $title $month_ $year",$option_new));
		$column_data = array("");
		$excel_data['column_data'] = $column_data;
		array_push($row_data,$series_data_); 
		$excel_data['row_data'] = $row_data;
		$this -> hcmp_functions -> create_excel($excel_data);
		else:
        $graph_type='column';			
        $graph_data=array_merge($graph_data,array("graph_id"=>'dem_graph_'));
	    $graph_data=array_merge($graph_data,array("graph_title"=>"Stock level $commodity_name $title $month_ $year"));
	    $graph_data=array_merge($graph_data,array("graph_type"=>$graph_type));
	    $graph_data=array_merge($graph_data,array("graph_yaxis_title"=>"Commodity Stock level in $option_new"));
	    $graph_data=array_merge($graph_data,array("graph_categories"=>$category_data ));
	    $graph_data=array_merge($graph_data,array("series_data"=>array('total'=>$series_data)));
		$data['high_graph'] = $this->hcmp_functions->create_high_chart_graph($graph_data);
		return $this -> load -> view("shared_files/report_templates/high_charts_template_v", $data);
		endif;
	}
        public function consumption_data_dashboard() {
		$county_id = $this -> session -> userdata('county_id');
		$county_name = counties::get_county_name($county_id);
		$data['c_data'] = Commodities::get_all_2();
		$data['district_data'] = districts::getDistrict($county_id);
		return $this -> load -> view("subcounty/ajax/county_consumption_data_filter_v", $data);
	}
	    public function consumption_stats_graph($commodity_id = null, $district_id = null, $facility_code=null, $option = null,$from=null,$to=null,$report_type=null) {
	    //reset the values here
     	$commodity_id=($commodity_id=="NULL") ? null :$commodity_id;
	 	$district_id=($district_id=="NULL") ? null :$district_id;
	 	$facility_code=($facility_code=="NULL") ? null :$facility_code;
		$option=($option=="NULL" || $option=="null") ? null :$option;
		$from=($from=="NULL") ? strtotime(date('d-m-y')) :strtotime(urldecode($from));	
		$to=($to=="NULL") ? strtotime(date('d-m-y')) : strtotime(urldecode($to));		
		$county_id = $this -> session -> userdata('county_id');
		$county_name = counties::get_county_name($county_id);
		$category_data=$series_data = $graph_data= $series_data_=array();
		//check if the district is set
		$district_data = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : null;
		$district_name_ = (isset($district_data)) ? " :" . $district_data[0]['district'] . " subcounty" : null;
		$option_new = isset($option) ? $option : "ksh";
		$facility_code_ = isset($facility_code) ? facilities::get_facility_name_($facility_code) -> toArray() : null;
		$facility_name=$facility_code_[0]['facility_name'];
		$commodity_name=(isset($commodity_id))? Commodities::get_details($commodity_id)->toArray() : null;
		$category_name_=@$commodity_name[0]['commodity_name'];
		$commodity_name=isset($category_name_)? " for ".$category_name_ : null;
		$title=isset($facility_code) && isset($district_id)? "$district_name_ : $facility_name" :( 
	    $district_id>0 && !isset($facility_code) ?  "$district_name_": "$county_name[county] county") ;
		$time= "between ".date('j M y', $from)." and ".date('j M y', $to);
		$consumption_data = Facility_stocks::get_county_consumption_level_new($facility_code,$district_id, $county_id, $commodity_id, $option,$from, $to,$report_type);
		foreach ($consumption_data as $data):
	    if($report_type=="table_data"):
		if($commodity_id>0):
		array_push($series_data , array($data['district'],$data["facility_name"],$data["facility_code"], $data['total']));
		else:
		array_push($series_data , array($data["name"], $data['total']));
		endif;						
		else:
		$series_data  = array_merge($series_data , array($data['total']));
		$series_data_=array_merge($series_data_ , array(array($data["name"],$data['total'])));
		$category_data=array_merge($category_data, array($data["name"]));
		endif;
		//
		endforeach;
		
		if($report_type=="csv_data"):
		$excel_data = array('doc_creator' =>$this -> session -> userdata('full_name'), 'doc_title' 
		=> "Consumption level $commodity_name $title $time", 'file_name' => "consumption_level_$commodity_name_$title_$time");
		$row_data = array(array("Consumption level in $commodity_name $title $time","Consumption level in $option_new"));
		$column_data = array("");
		$excel_data['column_data'] = $column_data;
		$row_data=array_merge($row_data,$series_data_);
		$excel_data['row_data'] = $row_data;;
		$this -> hcmp_functions -> create_excel($excel_data);
		elseif($report_type=="table_data"):
		if($commodity_id>0):
		$category_data=array(array("Sub-county","Facility Name","Mfl","TOTAL ".$option_new));
		else:
		array_push($category_data, array("Consumption level $commodity_name $title $time","stocks worth in $option_new"));
		endif;	
        $graph_data=array_merge($graph_data,array("table_id"=>'dem_graph_'));
	    $graph_data=array_merge($graph_data,array("table_header"=>$category_data ));
	    $graph_data=array_merge($graph_data,array("table_body"=>$series_data));
				
		$data['table'] = $this->hcmp_functions->create_data_table($graph_data);
		$data['table_id'] ="dem_graph_";
		return $this -> load -> view("shared_files/report_templates/data_table_template_v", $data);
		else: 
        $graph_type='column';			
        $graph_data=array_merge($graph_data,array("graph_id"=>'dem_graph_'));
	    $graph_data=array_merge($graph_data,array("graph_title"=>"Consumption level $commodity_name $title $time"));
	    $graph_data=array_merge($graph_data,array("graph_type"=>$graph_type));
	    $graph_data=array_merge($graph_data,array("graph_yaxis_title"=>"Commodity Consumption level in $option_new"));
	    $graph_data=array_merge($graph_data,array("graph_categories"=>$category_data ));
	    $graph_data=array_merge($graph_data,array("series_data"=>array('total'=>$series_data)));
		$data = array();
		$data['high_graph'] = $this->hcmp_functions->create_high_chart_graph($graph_data);
		return $this -> load -> view("shared_files/report_templates/high_charts_template_v", $data);
        endif;
	}
        public function notification_dashboard() {

		return $this -> load -> view("subcounty/ajax/county_notification_v", $data);
	}
    /*
	 |--------------------------------------------------------------------------
	 | COUNTY SUB-COUNTY reports
	 |--------------------------------------------------------------------------
	 */
		public function county_expiries() {
        $county_id=$this -> session -> userdata('county_id');
		$data['title'] = "Expired Products";
		$data['banner_text'] = "Expired Products";
		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['report_view'] = "subcounty/reports/county_expiries_v";
		$data['sidebar'] = "shared_files/report_templates/side_bar_sub_county_v";
		$this -> load -> view("shared_files/template/template", $data);
	}
		public function county_consumption() {
        $county_id=$this -> session -> userdata('county_id');
	    $data['district_data'] = districts::getDistrict($county_id);
	    $data['c_data'] = Commodities::get_all_2();
		$data['title'] = "Consumption";
		$data['banner_text'] = "Consumption";
		$data['content_view'] = "facility/facility_reports/reports_v";
		$data['report_view'] = "subcounty/reports/county_consumption_data_filter_v";
		$data['sidebar'] = "shared_files/report_templates/side_bar_sub_county_v";
		$this -> load -> view("shared_files/template/template", $data);
	}
	     public function actual_expiries_reports($county_id,$year){
		 $expiries_array=Facility_stocks::get_county_expiries($county_id,$year);
		 $graph_data=$series_data=array();
		 $total_expiry=0;
		 foreach($expiries_array as $facility_expiry_data):
	     $district=$facility_expiry_data['district'];
		 $name=$facility_expiry_data['facility_name'];
		 $mfl=$facility_expiry_data['facility_code'];
		 $total=$facility_expiry_data['total'];	 
		 $total_expiry=$total_expiry+$total;
		 $year=date('Y');
		 $total=number_format($total, 2, '.', ',');
		 $district_id=$facility_expiry_data['district_id'];
		 $link=base_url("reports/expiries/$mfl");
	     array_push($series_data, array($district,$name,$mfl,$total,'<a href="'.$link.'">
         <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-zoom-in"></span>View</button></a>'));

	    endforeach;
		$total_expiry=number_format($total_expiry, 2, '.', ',');
	    array_push($series_data, array("","","Total for $year",$total_expiry,''));
	   
		$category_data=array(array("Sub-county","Facility Name","Mfl","TOTAL (ksh)",''));

        $graph_data=array_merge($graph_data,array("table_id"=>'dem_graph_'));
	    $graph_data=array_merge($graph_data,array("table_header"=>$category_data ));
	    $graph_data=array_merge($graph_data,array("table_body"=>$series_data));
				
		$data['table'] = $this->hcmp_functions->create_data_table($graph_data);
		$data['table_id'] ="dem_graph_";
		return $this -> load -> view("shared_files/report_templates/data_table_template_v", $data);
		}
	     public function potential_expiries_reports($county_id,$year){
		 $expiries_array=Facility_stocks::get_potential_expiry_summary($county_id,$year);
		 $graph_data=$series_data=array();
		 $total_expiry=0;
		 foreach($expiries_array as $facility_expiry_data):
	     $district=$facility_expiry_data['district'];
		 $name=$facility_expiry_data['facility_name'];
		 $mfl=$facility_expiry_data['facility_code'];
		 $total=$facility_expiry_data['total'];	 
		 $total_expiry=$total_expiry+$total;
		 $total=number_format($total, 2, '.', ',');
		 $district_id=$facility_expiry_data['district_id'];
		 $link=base_url("reports/potential_exp_process_subcounty/$mfl");
	    array_push($series_data, array($district,$name,$mfl,$total,'<a href="'.$link.'">
         <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-zoom-in"></span>View</button></a>'));
	    endforeach;
		$total_expiry=number_format($total_expiry, 2, '.', ',');
	    array_push($series_data, array("","","Total for the next $year months",$total_expiry,''));
	   
		$category_data=array(array("Sub-county","Facility Name","Mfl","TOTAL (ksh)",''));

        $graph_data=array_merge($graph_data,array("table_id"=>'dem_graph_1'));
	    $graph_data=array_merge($graph_data,array("table_header"=>$category_data ));
	    $graph_data=array_merge($graph_data,array("table_body"=>$series_data));
				
		$data['table'] = $this->hcmp_functions->create_data_table($graph_data);
		$data['table_id'] ="dem_graph_1";
		return $this -> load -> view("shared_files/report_templates/data_table_template_v", $data);
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