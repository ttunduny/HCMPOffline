<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home_Controller extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	
	public function home() {
		
		if (condition) {
			
		} elseif(condition2) {
			
		}
		
		$data['title'] = "Facility Home";
		$data['content_view'] = "facility_home_v";
		$data['banner_text'] = "Facility Home";
		$data['menu'] = Menu::getAll();		
		$this -> load -> view("template", $data);
	}
	
	public function index($pop_up=NULL,$year=null) {

		$data['title'] = "Home";
		$access_level = $this -> session -> userdata('user_indicator');
		$facility_c=$this -> session -> userdata('news');
		$type_id=$this -> session -> userdata('usertype_id');
		
		if($access_level == "facility" || $access_level =="fac_user"){
		$data['name_facility']=User::getUsers($facility_c);	
			
	/*	$mydate=Dates::getDates();
		
		$compare=$mydate->toArray();
		
		$date2 = date("Y-m-d",time());
			 		
		$date1=$compare['district_dl'];	
		
		
		$x1=strtotime($date1);
		$x2=strtotime($date2);
		
		
		//expired products
			$date= date('Y-m-d');

		$difference=($x1-$x2)/86400;
/*****************************************Notifications********************************************
            $data['percentage_complete'] = Historical_Stock::historical_stock_rate($facility_c);	
            $data['total_drugs']=count(Drug::getAll());  
		    $data['diff']=$difference;			
			$data['exp']=Facility_Stock::get_exp_count($facility_c);
			$data['exp_count']=Facility_Stock::get_potential_count($facility_c);
			$data['stock']=Facility_Stock::count_facility_stock_first($facility_c);
		    $data['pending_orders'] = Ordertbl::get_pending_count($facility_c);
			$data['rejected_orders'] = Ordertbl::get_rejected_count($facility_c);
			$count=Ordertbl::getPending_d($facility_c)->count();
			$data['pending_orders_d'] =$count;
			$data['dispatched'] = NULL;//Ordertbl::get_dispatched_count($facility_c);
			$data['incomplete_order']=Facility_Transaction_Table::get_undated_records($facility_c);
/*************************************************************************************************/			
			$data['menu'] = Menu::getByUsertype($type_id);		
			$data['content_view'] = "facility/dashboard/facility_home_v";
		}
else if($access_level == "super_admin"){
	$data['content_view'] = "super_admin/home_v";
}
else if($access_level == "county_facilitator"){
	  $year=isset($year)?$year : date("Y");
	//$active_logs=Log::get_active_login($option,$option_id);
	$county_id=$this -> session -> userdata('county_id');
	$data['stats']=$this->get_dash_board_stats("county");
	$data['year']=$year;
	$data['content_view'] = "county/county_v_3";
	$data['banner_text'] = "Home";
	$data['link'] = "home";
	$data['coverage_data']=$this->get_county_dash_board_district_coverage();
    $data['max_date']=facility_stock::get_county_max_date($county_id);
	
	
	
	$drug_category=Drug_Category::getAll();
    $category_name='';	

		foreach ($drug_category as $category0) {
			$id=$category0->id;
			$category3=$category0->Category_Name;
		
			 $category_name .="<option value='$id'>$category3;</option>";
		 }
		$data['drug_category']=$category_name;
	

}
/* go to application/controllers/home_controller.php and check for this if statement */

else if($access_level == "dpp"){
		$district=$this->session->userdata('district1');
	    $data['facilities'] = Facilities::get_total_facilities_rtk_in_district($district);
		$facilities = Facilities::get_total_facilities_rtk_in_district($district);
		     // $facilities=Facilities::get_facility_details(6);
		$table_body='';
		foreach($facilities as $facility_detail){

          
            $lastmonth = date('F', strtotime("last day of previous month"));

            $table_body .="<tr><td><a class='ajax_call_1' id='county_facility' name='" . base_url() . "rtk_management/get_rtk_facility_detail/$facility_detail[facility_code]' href='#'>" . $facility_detail["facility_code"] . "</td>";
            $table_body .="<td>" . $facility_detail['facility_name'] . "</td><td>" . $facility_detail['facility_owner'] . "</td>";
            $table_body .="<td>";

            $lab_count = lab_commodity_orders::get_recent_lab_orders($facility_detail['facility_code']);
            $fcdrr_count = rtk_fcdrr_order_details::get_facility_order_count($facility_detail['facility_code']);
            if ($fcdrr_count > 0) {
                $table_body .="<!-- FCDRR <img src='" . base_url() . "/Images/check_mark_resize.png'></img>
                        <a href=" . site_url('rtk_management/update_fcdrr_test/' . $facility_detail['facility_code']) . " class='link'>Edit</a>|-->";
            } else {
                $table_body .="<!--<a href=" . site_url('rtk_management/fcdrr_test/' . $facility_detail['facility_code']) . " class='link'>FCDRR</a>|-->";
            }

            if ($lab_count > 0) {
                //".site_url('rtk_management/get_report/'.$facility_detail['facility_code'])."
                $table_body .="<span class='label label-success'>Submitted  for    $lastmonth </span> <!--<img src='" . base_url() . "/Images/check_mark_resize.png'></img>--><a href=" . site_url('rtk_management/rtk_orders') . " class='link'>View</a></td>";
            } else {
                $table_body .="<span class='label label-important'>  Pending for $lastmonth </span> <a href=" . site_url('rtk_management/get_report/' . $facility_detail['facility_code']) . " class='link'>Report</a></td>";
            }

            $table_body .="</td>";
        }

	$data['table_body']=$table_body;
	$data['content_view'] = "rtk/dpp/dpp_home_with_table";
	$data['banner_text'] = "Home";
	$data['link'] = "home";
		

}

else if($access_level == "rtk_manager"){
	$data['content_view'] = "rtk/home_v";
}

else if($access_level == "allocation_committee"){
$counties=Counties::getAll();
	$table_data="";
	$allocation_rate=0;
	$total_facilities_in_county=1;
	$total_facilities_allocated_in_county=1;
	$total_facilities=0;
	$total_allocated=0;
	
   foreach( $counties as $county_detail){
   	
   	   $countyid=$county_detail->id;
	  // $county_map_id=$county_detail->kenya_map_id;
   	   $countyname=trim($county_detail->county);
   	
	   $county_detail=rtk_stock_status::get_allocation_rate_county($countyid);
	   $total_facilities_in_county=$county_detail['total_facilities_in_county'];
	   $total_facilities_allocated_in_county=$county_detail['total_facilities_allocated_in_county'];

	  $total_facilities=$total_facilities+$total_facilities_in_county;
	  $total_allocated= $total_allocated+ $total_facilities_allocated_in_county;
 
	   $table_data .="<tr><td><a href=".site_url()."rtk_management/allocation_county_detail_zoom/$countyid> $countyname</a> </td><td>$total_facilities_in_county | $total_facilities_allocated_in_county</td></tr>";
	   
	   }
    $table_data .="<tr><td>TOTAL </td><td> $total_facilities | $total_allocated</td><tr>";
 
   
	$data['table_data']=$table_data;
	$data['pop_up']=$pop_up;
	$data['counties']= $counties=Counties::getAll();
	$data['content_view'] = "allocation_committee/home_v";
	
}

else if($access_level == "moh"){
			
		}else if($access_level == "fac_user"){
		$facility_c=$this -> session -> userdata('news');
			$mydate=Dates::getDates();
		
		$compare=$mydate->toArray();
		
		$date2 = date("Y-m-d",time());
			 		
		$date1=$compare['district_dl'];	
		$x1=strtotime($date1);
		$x2=strtotime($date2);
		
		//expired products////
			$date= date('Y-m-d');

		$difference=($x1-$x2)/86400;
/*****************************************Notifications********************************************/		    
		    $data['diff']=$difference;			
			$data['exp']=Facility_Stock::get_exp_count($date,$facility_c);
		
			$data['exp_count']=Facility_Stock::expiries_count($facility_c)->toArray();
			$data['stock']=Facility_Stock::count_facility_stock_first($facility_c);
		    $data['pending_orders'] = Ordertbl::get_pending_count($facility_c);
			$data['dispatched'] = Ordertbl::get_dispatched_count($facility_c);
			$data['content_view'] = "facility_home_v";
			$data['scripts'] = array("FusionCharts/FusionCharts.js"); 
		}
		else if($access_level == "moh_user"){
			
			$data['content_view'] = "moh/moh_user_v";
		}
		else if($access_level == "district"){
			$data['stats']=$this->get_dash_board_stats("district");
			$district =$this -> session -> userdata('district1');
			
	
			$data['pending_orders'] = Ordertbl::get_pending_o_count(null,$district);
			$data['decommisioned'] = Facility_stock::get_decom_count($district);
			$data['drugs_array'] = Drug::getAll();
			$data['facilities']=Facilities::getFacilities($district);
		    $data['active_facilities']=Facility_Issues::get_active_facilities_in_district($district);
			$data['inactive_facilities']=Facility_Issues::get_inactive_facilities_in_district($district);
			$data['content_view'] = "district/district_home_v";
		}
		
		$data['banner_text'] = "Home";
		$data['link'] = "home";
		$this -> load -> view("template/template", $data);

	}
}
