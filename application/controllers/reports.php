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
		$data['banner_text'] = "Reports";
		$this -> load -> view($view, $data);
	}

	/*
	 |--------------------------------------------------------------------------
	 | SHARED REPORTS
	 |--------------------------------------------------------------------------
	 */
	// get the commodity listing here
	public function commodity_listing() {
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
		$data['facility_stock_data'] = facility_stocks::get_distinct_stocks_for_this_facility($facility_code, 'batch_data', 'show_all');
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
		$facility_stock_data = facility_order_details::get_order_details($order_id);
		$excel_data = array('doc_creator' => $facility_details[0]['facility_name'], 
		'doc_title' => 'facility order template ', 'file_name' => $facility_details[0]['facility_name'].'facility order template');
		$row_data = array();
		$column_data = array("Product Code","Product Category","Item description(Name/form/strength)","Order unit size", "Price","Quantity Ordered","Total");
		$excel_data['column_data'] = $column_data;
		foreach ($facility_stock_data as $facility_stock_data_item) :
		$total=$facility_stock_data_item["unit_cost"]*$facility_stock_data_item["quantity_ordered_pack"];
		$total=number_format($total, 2, '.', ',');
		array_push($row_data, array($facility_stock_data_item["commodity_code"], 
		$facility_stock_data_item["sub_category_name"], 
		$facility_stock_data_item["commodity_code"], 
		$facility_stock_data_item["unit_size"], 
		$facility_stock_data_item["unit_cost"],
		$facility_stock_data_item["quantity_ordered_pack"],$total)); //
		endforeach;
		$excel_data['row_data'] = $row_data;

		$this -> hcmp_functions -> create_excel($excel_data);
	}

    public function aggragate_order_new_sorf($order_id){
    $order_id_array=explode("_", $order_id);
	$facility_name=array();
	foreach($order_id_array as $single_order_id){
		if($single_order_id>0):
	 $test=facility_orders::get_order_($single_order_id);
		foreach($test as $test_){
		foreach($test_->facility_detail as $facility_data){
		array_push($facility_name,"$facility_data->facility_name",'');
		}		
		}
		endif;
	 }
	    array_push($facility_name ,"TOTAL");
        $stock_data=Commodities::get_all_from_supllier(1);
		$from_stock_data=count($stock_data);
		$excel_data = array('doc_creator' => "HCMP", 'doc_title' => 'test ', 'file_name' => 'test');
		$row_data = array(array("Product Code","Product Category","Item description(Name/form/strength)","Order unit size", "Price"));
		$column_data = array("","","FACILITY NAME","","");
		$column_data=array_merge($column_data ,$facility_name);
		$excel_data['column_data'] = $column_data;
		for($i=0;$i<$from_stock_data;$i++):
		array_push($row_data,
		 array($stock_data[$i]["commodity_code"],
		 $stock_data[$i]["sub_category_name"],
		 $stock_data[$i]["commodity_name"], 
		 $stock_data[$i]["unit_size"], 
		 $stock_data[$i]["unit_cost"]));
		endfor;
		$excel_data['row_data'] = $row_data;
      
		$this -> hcmp_functions -> create_excel($excel_data);    	
    }

}
?>