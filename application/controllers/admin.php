<?php
/**
 * @author Mureithi
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}


	public function index() {
		$data['title'] = "Commodities";
		$this -> load -> view("", $data);
	}
	
	public function manage_commodities() {
		$data['title'] = "Commodities";
		$data['content_view'] = "Admin/commodities_v";
		$data['commodity_list'] = commodity_sub_category::get_all();
		$this -> load -> view("shared_files/template/dashboard_v", $data);
	}
	public function commodities_upload() {
		
	}
	
	public function manage_users() {
		$permissions='super_permissions';
		$data['title'] = "Users";
		$data['content_view'] = "Admin/users_v";
		$data['listing']= Users::get_user_list_all();
		// echo "<pre>";print_r($data['listing']);echo "</pre>";exit;
		$data['counts']=Users::get_users_count();
		$data['counties']=Counties::getAll();
		$data['facilities']=Facilities::getAll();
		$data['sub_counties']=Districts::getAll();
		$data['user_types']=Access_level::get_access_levels($permissions);
		$this -> load -> view("shared_files/template/dashboard_v", $data);
	}
//manage facilities
	public function manage_facilities() {
		$permissions='super_permissions';
		$data['title'] = "Users";
		$data['content_view'] = "Admin/facilities_v";
		$data['facilities_listing']= Users::get_facilities_list_all();
		$data['facilities_listing_active']= Users::get_facilities_list_all_active(1);
		$data['facilities_listing_inactive']= Users::get_facilities_list_all_active(0);
		$data['active_count']= Facilities::get_all_facilities_active_no();
		$data['facility_count']=Facilities::get_all_facilities_no();
		$data['counties']=Counties::getAll();
		$data['facilities']=Facilities::getAll();
		$data['sub_counties']=Districts::getAll();
		$data['user_types']=Access_level::get_access_levels($permissions);
		$this -> load -> view("shared_files/template/dashboard_v", $data);
	}

	public function report_management() {
		$permissions='super_permissions';
		$data['title'] = "Users";
		$data['content_view'] = "Admin/report_management_v";
		$data['listing']= Users::get_user_list_all();
		$data['counts']=Users::get_users_count();
		$data['facilities_listing']= Users::get_facilities_list_all();
		$data['users_listing_active']= Users::get_user_list_all();
		$data['facilities_listing_inactive']= Users::get_facilities_list_all_active(0);
		$data['active_count']= Facilities::get_all_facilities_active_no();
		$data['facility_count']=Facilities::get_all_facilities_no();
		$data['counties']=Counties::getAll();
		$data['facilities']=Facilities::getAll();
		$data['sub_counties']=Districts::getAll();
		$data['user_types']=Access_level::get_access_levels($permissions);
		$this -> load -> view("shared_files/template/dashboard_v", $data);
	}

	public function tester(){

	}

	public function deactivate_facility(){
		$le_facility = $_POST['ndata'];
		$le_status = $_POST['status'];
		//echo "This  ".$le_status;exit;
		//something
		$double_tap = Users::deactivate_facility($le_facility,$le_status);
		//echo "Success";
	}

	public function edit_user(){
		
		$identifier = $this -> session -> userdata('user_indicator');

		$fname = $_POST['fname_edit'];
		$lname = $_POST['lname_edit'];
		$status = $_POST['status'];
		$telephone_edit= $_POST['telephone_edit'];
		$email_edit = $_POST['email_edit'];
		$username_edit = $_POST['username_edit'];
		$facility_id_edit_district = $_POST['facility_id_edit_district'];
		$user_type_edit_district = $_POST['user_type_edit_district'];
		$district_name_edit = $_POST['district_name_edit'];
		$facility_id_edit= $_POST['facility_id_edit'];
		$user_id= $_POST['user_id'];
		$county = $_POST['county_edit'];
		
		if ($status=="true") {
			
			$status=1;
			
		} elseif($status=="false") {
			
			$status=0;
		}
		
		
		//update user
			$update_user = Doctrine_Manager::getInstance()->getCurrentConnection();
			$update_user->execute("UPDATE `user` SET fname ='$fname' ,lname ='$lname',email ='$email_edit',usertype_id =$user_type_edit_district,telephone ='$telephone_edit',
									district ='$district_name_edit',facility ='$facility_id_edit',
									-- status ='$status',
									county_id ='$county'
                                  	WHERE `id`= '$user_id'");
		
	}

	public function change_status(){
		$user_id = $_POST['user_id'];
		$status = $_POST['status'];

		// echo $status. " " . $member_id;exit;
		// echo "UPDATE `user` SET status = '$status' WHERE `id`= '$user_id'";exit;
		$update_user = Doctrine_Manager::getInstance()->getCurrentConnection();
			$update_user->execute("UPDATE `user` SET status = '$status' WHERE `id`= '$user_id'");
			echo $update_user." success";
	}

	public function update_stock_prices(){
	$inputFileName = 'print_docs/excel/excel_template/KEMSA Customer Order Form.xls';
	
	// echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


	$commodities = commodities::get_all_2();
	$system_commodity_details = array();
	$excel_commodity_details = array();
	$ate_hwat = array();
	$temp = array();
	$keys_na_si_alishia = array();

	// echo "<pre>";print_r($commodities);echo "</pre>";exit;

	foreach ($commodities as $commodity) {
		$system_commodity_details[] = array(
			'id'=> $commodity['id'],
			'commodity_code'=> $commodity['commodity_code'],
			'commodity_name'=> $commodity['commodity_name']
			);
	}//end of foreach


	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	$sheet = $objPHPExcel->getSheet(0); 
	$highestRow = $sheet->getHighestRow(); 
    $highestColumn = $sheet->getHighestColumn();

	// echo "<pre>";print_r($sheetData);echo "</pre>";exit;

	for ($row=17; $row < $highestRow; $row++) { 
	$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE); 
	$excel_commodity_details[] = array(
		'commodity_name' => $rowData[0][3], 
		'price' => $rowData[0][6],
		'commodity_code' => $rowData[0][2]
		);
	}
	// echo "<pre>";print_r($excel_commodity_details);echo "</pre>";exit;

	// echo "<pre>";print_r($system_commodity_details);echo "</pre>";exit;
	
	$synthesised = array();
	$unsynthesised = array();
	foreach ($excel_commodity_details as $excels) {
		foreach ($system_commodity_details as $systems) {
			if ($excels['commodity_name'] == $systems['commodity_name']){
				$synthesised[] = array(
					'id' => $systems['id'], 
					'commodity_name' => $excels['name'], 
					'new_unit_price' => $excels['price'],
					'commodity_code'=> $excels['commodity_code']
					);
			}
		}

	}//end of foreach

	// echo "<pre>";print_r($synthesised);echo "</pre>";exit;

	$counter = 0;
	foreach ($synthesised as $synthesis) {
		if (isset($synthesis['commodity_code']) && $synthesis['commodity_code'] != '') {
		$details = array(
			'commodity_code' => $synthesis['commodity_code'], 
			);
		$this->db->where('commodity_name',$synthesis['commodity_name']);
		$result=$this->db->update('commodities',$details);
		$counter = $counter + 1;
		echo "<pre>Commodity: ".$synthesis['id']."  ".$synthesis['commodity_name']." Price: ".$synthesis['new_unit_price']." updated successfully</pre>";
		}
	}
	$handler = array('unit_cost' => 0);
	$this->db->where('unit_cost','N/A');
	$result=$this->db->update('commodities',$handler);
	echo "Total Queries: ".$counter;
	}//end of function
	
}