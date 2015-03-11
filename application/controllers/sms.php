<?php
/**
 * @author Collins
 * 
 */
ob_start();
class sms extends MY_Controller {
	var $test_mode = true;
	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url', 'file', 'download'));
		$this -> load -> library(array('hcmp_functions', 'form_validation', 'email', 'mpdf/mpdf'));

	}

	/*
	 |--------------------------------------------------------------------------|
	 | SMS	SECTION																	|
	 |--------------------------------------------------------------------------|
	 */

	//Test for sending emails
	public function send_email_test() {
		$this -> hcmp_functions -> send_email();
	}

	//Checks if there are potential expiries in the system
	public function check_potential_expiries() {
		$year = date("Y");
		$potential_expiries = Facility_stocks::get_potential_expiries_sms();
		$total_potential = count($potential_expiries);

		if ($total_potential > 0) {
			$total_facilitites = count($potential_expiries);

			$total_commodities = "";

			foreach ($potential_expiries as $potential) {
				$facility_code = $potential['facility_code'];
				$data = Users::getUsers($facility_code) -> toArray();
				//Filter the array to remove empty sections of the array
				$data = array_filter($data);
				if (!empty($data)) {
					foreach ($data as $users) {
						$user_type = $users['usertype_id'];

						switch ($user_type) {
							//Facility Admin
							case 2 :
								$message = $potential['total'] . " commodities will expire within 3 months. HCMP";
								break;
							//Sub County Head
							case 3 :
								$message = $total_facilitites . " facilities have commodities that will expire within 3 months. HCMP";
								break;
							//County Head
							case 10 :
								$message = "There are " . $total_potential . " potential expiries in the county. HCMP";
								break;
							//For test purposes only
							case 5 :
								$message = "Test SMS. HCMP";
								break;
						}

						$phone = $this -> get_facility_phone_numbers($facility_code);
						$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
						$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);
					}
				} else {
					//DO Nothing
					//Array is empty
				}

			}

		} else {
			//No Potential Expiries

		}

	}

	//Stock out SMSes
	//will be called once a week by the system automatically
	public function stock_out_sms() {
		$stock_outs = Facility_stocks::get_stock_outs_sms();
		$total_stock_outs = count($stock_outs);
		if ($total_stock_outs > 0) {
			$total_facilitites = count($stock_outs);
			$total_commodities = "";

			foreach ($stock_outs as $stock_outs_) {
				$facility_code = $stock_outs_['facility_code'];
				$data = Users::getUsers($facility_code) -> toArray();
				//Filter the array to remove empty sections of the array
				$data = array_filter($data);
				if (!empty($data)) {
					$total_subcounties = count($data['']);
					foreach ($data as $users) {
						$user_type = $users['usertype_id'];

						switch ($user_type) {
							//Facility Admin
							case 2 :
								$message = $stock_outs_['total'] . " commodities are out of stock.";
								break;
							//Sub County Head
							case 3 :
								$message = $total_facilitites . " facilities have a total number of " . $total_stock_outs . " stock outs.";
								break;
							//County Head
							case 10 :
								$message = "There are " . $total_stock_outs . " stock outs in the county";
								break;
							//For test purposes only
							case 5 :
								$message = "To Me";
								break;
						}

						$phone = $this -> get_facility_phone_numbers($facility_code);
						$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
						$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);
					}
				} else {
					//DO Nothing
					//Array is empty
				}

			}

		} else {
			//No Stock Outs

		}
	}

	//For Orders
	//Called when an order is placed by a particular facility
	public function send_order_sms() {
		$facility_code = $this -> session -> userdata('facility_id');
		$facility_name = Facilities::get_facility_name2($facility_code);
		$facility_name = $facility_name['facility_name'];
		$data = Users::getUsers($facility_code) -> toArray();
		foreach ($data as $users) {
			$user_type = $users['usertype_id'];

			switch ($user_type) {
				//Facility Admin
				case 2 :
					$message = "An  order has been placed by " . $facility_name;
					break;
				//Sub County Head
				case 3 :
					$message = $facility_name . " has placed an order";
					break;
				//County Head
				case 10 :
					$message = "An  order has been placed by " . $facility_name;
					break;
				//For test purposes only
				case 5 :
					$message = "Test order sms. Placed by " . $facility_name;
					break;
			}

			$phone = $this -> get_facility_phone_numbers($facility_code);
			$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
			$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);
		}

	}

	//When stock is updated by a particular facility
	public function send_stock_update_sms() {
		$facility_code = $this -> session -> userdata('facility_id');
		$facility_name = Facilities::get_facility_name2($facility_code);
		$facility_name = $facility_name['facility_name'];
		$data = Users::getUsers($facility_code) -> toArray();

		foreach ($data as $users) {
			$user_type = $users['usertype_id'];

			switch ($user_type) {
				//Facility Admin
				case 2 :
					$message = "Stock has been updated for " . $facility_name;
					break;
				//Sub County Head
				case 3 :
					$message = $facility_name . " has updated its stock";
					break;
				//County Head
				case 10 :
					$message = "Stock has been updated for " . $facility_name;
					break;
				//For test purposes only
				case 5 :
					$message = "Stock has been updated for " . $facility_name;
					break;
			}

			$phone = $this -> get_facility_phone_numbers($facility_code);
			$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
			$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);
		}

	}

	//Called when an order is rejected or approved bt the DPP
	//Accepts two parameters $facility code and status of the order
	public function send_order_approval_sms($facility_code, $status) {
		//$facility_code = $this -> session -> userdata('facility_id');
		$facility_name = Facilities::get_facility_name2($facility_code);
		$facility_name = $facility_name['facility_name'];
		$data = Users::getUsers($facility_code) -> toArray();

		$message = ($status == 1) ? $facility_name . "'s order has been rejected. HCMP" : $facility_name . "'s order has been approved. HCMP";

		$data = Users::getUsers($facility_code) -> toArray();
		$phone = $this -> get_facility_phone_numbers($facility_code);
		$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);

		$this -> send_sms(substr($phone, 0, -1), $message);

	}

	public function order_update_sms($facility_code, $status) {
		//$facility_code = $this -> session -> userdata('facility_id');
		$facility_name = Facilities::get_facility_name2($facility_code);
		$facility_name = $facility_name['facility_name'];
		$data = Users::getUsers($facility_code) -> toArray();
		$message = $facility_name . " has updated its order";

		$phone = $this -> get_facility_phone_numbers($facility_code);
		$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
		$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);

	}

	public function send_stock_donate_sms($facility_code, $facility_code2) {
		//Facility code the mfl code for the facility donating drugs
		//Facility code 2 is for the facility recieving the commodities
		$facility_name = Facilities::get_facility_name2($facility_code);
		$facility_name = $facility_name['facility_name'];
		$facility_name2 = Facilities::get_facility_name2($facility_code2);
		$facility_name2 = $facility_name2['facility_name'];
		$data = Users::getUsers($facility_code) -> toArray();
		$data2 = Users::getUsers($facility_code) -> toArray();

		$message = $facility_name . " has donated commodirties to " . $facility_name2;

		$phone = $this -> get_facility_phone_numbers($facility_code);
		$phone .= $this -> get_facility_phone_numbers($facility_code2);
		$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
		$phone .= $this -> get_ddp_phone_numbers($data2[0]['district']);

		$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);

	}

	/*public function update_stock_out_table()
	 {

	 $in = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
	 select stock_date,facility_code,
	 kemsa_code from facility_stock
	 where `balance`=0 and `status`=1 and quantity>0
	 group by kemsa_code,facility_code");

	 $jay = count($in);

	 for($i=0;$i<$jay;$i++)
	 {
	 Doctrine_Manager::getInstance()->getCurrentConnection()->execute("
	 insert into facility_stock_out_tracker
	 set facility_id='".$in[$i]['facility_code']."', drug_id='".$in[$i]['kemsa_code']."',
	 `start_date`='".$in[$i]['stock_date']."', status='stocked out' ");

	 }
	 }
	 */

	/*
	 |--------------------------------------------------------------------------|
	 | EMAIL REPORTS SECTION															|
	 |--------------------------------------------------------------------------|
	 */

	//gets the emails of the respective DPPs in charge
	public function get_ddp_email($district_id) {
		$data = Users::get_dpp_emails($district_id);
		$user_email = "";
		foreach ($data as $info) {
			
			$user_email .= $info -> email . ',';

		}
		return $user_email;
	}
	public function get_ddp_email_county($county_id) {
		$data = Users::get_dpp_emails_county_level($county_id);
		$user_email = "";
		foreach ($data as $info) {
			
			$user_email .= $info -> email . ',';

		}
		return $user_email;
	}
	public function get_county_email($county_id) {
		$data = Users::get_county_emails($county_id);
		$user_email = "";
		foreach ($data as $info) {
			$user_email .= $info -> email . ',';

		}
		return $user_email;
	}
//Getting the bcc emails 
	public function get_bcc_notifications() {
		$bcc_emails = "collinsojenge@gmail.com,kelvinmwas@gmail.com,smutheu@clintonhealthaccess.org,
						jhungu@clintonhealthaccess.org,gmacharia@clintonhealthacces.org,tngugi@clintonhealthaccess.org,
						bwariari@clintonhealthaccess.org,amwaura@clintonhealthaccess.org,eongute@clintonhealthaccess.org,
						rkihoto@clintonhealthaccess.org,teddyodera@gmail.com,ericmurugami@yahoo.co.uk,
						raykiprono@gmail.com,margie.dora@gmail.com,amostum5@gmail.com,muirurisk@gmail.com,
						valwacu@gmail.com,odiwuorybrian@gmail.com,mwakiojoy@gmail.com,emgitar@yahoo.com,ronohb@gmail.com,
						kevgithuka@gmail.com,kiganyastephenthua@gmail.com,";
		
		return $bcc_emails;
	}

	//gets the emails of users in the facility
	public function get_facility_email($facility_code) {
		$data = Users::get_user_emails($facility_code);
		$user_email = "";
		foreach ($data as $info) {
			
			$user_email .= $info -> email . ',';

		}
		return $user_email;
	}

	public function send_stock_decommission_email($message, $subject, $attach_file) {
		$facility_code = $this -> session -> userdata('facility_id');
		$data = Users::getUsers($facility_code) -> toArray();
		$email_address = $this -> get_facility_email($facility_code);
		$email_address .= $this -> get_ddp_email($data[0]['district']);

		$this -> send_email(substr($email_address, 0, -1), $message, $subject, $attach_file);

	}
	/*
	 |--------------------------------------------------------------------------|
	 | EMAIL DAILY/WEEKLY/MONTHLY REPORTS SECTION															|
	 |--------------------------------------------------------------------------|
	 */
	 public function facility_overview_report()
	 {
	 	//get all the facilities rolled out
	 	$facilities = Facilities::get_all_facilities_on_HCMP();
		//Start buliding the excel file
		$excel_data = array();
		$excel_data = array('doc_creator' => 'HCMP', 'doc_title' => 'facility overview monthly report ', 'file_name' => 'facility overview monthly report');
		$row_data = array();
		//contains the columns in the excel sheet
		$column_data = array("County","Sub County", "MFL","Facility Name","Level","Type","Owner","Date of Activation");
		$excel_data['column_data'] = $column_data;
		//Loop through the data picked form the database and assign each row to the $row_data variable 
		//$row_data is used to dump the data into rows for the excel
		foreach ($facilities as $facilities) :
			array_push($row_data, array($facilities["county"],
										$facilities["sub_county"],
										$facilities["facility_code"],
										$facilities["facility_name"],
										$facilities["level"],
										$facilities["type"],
										$facilities["owner"],
										$facilities["date_of_activation"]));
		endforeach;

		
		$excel_data['row_data'] = $row_data;
		$excel_data['report_type'] = "download_file";
		$excel_data['file_name'] = "Facility Overview Report";
		
		$excel_data['excel_title'] = "Facilities Rolled on HCMP as at".date("Js F Y");

		$subject = "Facility Overview Report";
		
		$message = "Good Morning,</br>
				<p>Find attached an excel sheet with the breakdown of facilities using HCMP
				You may log onto health-cmp.or.ke to confirm.</p>
				<p>----</p>
				<p>HCMP</p>
				<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
		//used the same report type as for ORS
		//they have the same number of columns
		$report_type = "ors_report";
		//create the excel sheet here
		$this-> create_excel($excel_data,$report_type);
		exit;
		//where the excel sheet is stored before being attached
		$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
		
		//the email of the receipients
		//$email_address = "collinsojenge@gmail.com";
		//function for sending the actual email
		//$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);

		
	 }
	 
	public function expiries_report() {
		//Set the current year
		$year = date("Y");
		$picurl = base_url() . 'assets/img/coat_of_arms-resized1.png';
		//get the facilities in the district
		$counties = Facilities::get_counties_all_using_HCMP();

		foreach ($counties as $counties) {
			//holds the dat for the entire county
			//once it is done executing for one county it is reset to zero
			$county_total = array();
			//Used to store the total cost of all expiries
			$county_expiries_total = 0;
			//pick the county nae and county ID accordingly
			$county_id = $counties['county'];
			$county_name = $counties['county_name'];

			//Get all the ddistricts in that  particular county
			$districts = Facilities::get_all_using_HCMP($county_id);
			//holds the data for all the districts in a particular county
			$district_total = array();

			foreach ($districts as $districts) {
				
				//Used to store the total cost of all expiries
				$sub_county_expiries_total = 0;
				
				$district_id = $districts['district'];
				$district_name = $districts['name'];
				//get all facilities in that district
				$facilities = Facilities::getFacilities_for_email($district_id);
				//holds all the data for all facilities in a particular district
				$facility_total = array();

				foreach ($facilities as $facilities_) :
					//holds the total value of expiries for that particular facility in that district
					$facility_potential_expiries_total = 0;
					//$facility_potential_expiries = array();
					$facility_code = $facilities_ -> facility_code;
					$facility_name = Facilities::get_facility_name2($facility_code);
					$facility_name = $facility_name['facility_name'];

					//get potential expiries in that particular facility
					$facility_expiries = Facility_stocks::All_expiries_email($facility_code);

					//push the result into another array that will be used by the distrct
					(array_key_exists($facility_name, $facility_total)) ? $facility_total[$facility_name] = array_merge($facility_total[$facility_name], array($facility_expiries)) : $facility_total = array_merge($facility_total, array($facility_name => array($facility_expiries)));
					//Start buliding the excel file
					$excel_data = array();
					$excel_data = array('doc_creator' => $facility_name, 'doc_title' => 'facility expiries monthly report ', 'file_name' => 'facility weekly report');
					$row_data = array();
					
					$column_data = array("Commodity Name","Unit Size", "Quantity (packs)","Quantity (units)","Unit Cost(KSH)","Total Expired(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
					
					$excel_data['column_data'] = $column_data;

					foreach ($facility_expiries as $facility_expiries) :
						array_push($row_data, array($facility_expiries["commodity_name"],$facility_expiries["unit_size"],$facility_expiries["packs"],$facility_expiries["units"],$facility_expiries["unit_cost"],$facility_expiries["total"],$facility_expiries["expiry_date"],$facility_expiries["source_name"],$facility_expiries["date_added"],$facility_expiries["manufacture"],$facility_expiries["facility_name"],$facility_expiries["facility_code"],$facility_expiries["subcounty"],$facility_expiries["county"]));
						$facility_potential_expiries_total = $facility_potential_expiries_total + $facility_expiries["total"];
					endforeach;

					if (empty($row_data)) {
						//do nothing
					} else {
						$excel_data['row_data'] = $row_data;
						$excel_data['report_type'] = "download_file";
						$excel_data['file_name'] = $facility_name . "_Expiries_Report";
						$excel_data['excel_title'] = "Expiries Report for ".$facility_name." for the month of ".date("F Y");

						$subject = "Expiries: " . $facility_name;
						
						$message = "Dear ".$facility_name." facility,</br>
								<p>Find attached an excel sheet with the ".$facility_name." breakdown of Expiries.
								You may log onto health-cmp.or.ke to decommission them.</p>
								<p>----</p>
								<p>HCMP</p>
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
						//create the excel here
						$report_type = "expiries";
						//holds the total figure for the expiries
						$total_figure = $facility_potential_expiries_total;
						//excel is created by php excel here
						$this-> create_excel($excel_data,$report_type,$total_figure);
						//where the excel sheet is stored before being attached
						$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						
						//the email of the receipients
						$email_address = $this->get_facility_email($facility_code);
						//function for sending the actual email
						$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);

					}

					//End foreach for facility
				endforeach;

				(array_key_exists($district_name, $district_total)) ? $district_total[$district_name] = array_merge($district_total[$district_name], array($facility_total)) : $district_total = array_merge($district_total, array($district_name => array($facility_total)));
				//Building the excel sheet to be sent to the district admin
				$excel_data = array();
				$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'district expiries weekly report ', 'file_name' => 'district weekly report');
				$row_data = array();
				$column_data = array("Commodity Name","Unit Size", "Quantity (packs)","Quantity (units)","Unit Cost(KSH)","Total Expired(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
				$excel_data['column_data'] = $column_data;

				foreach ($facility_total as $facility_total_1) :
					foreach ($facility_total_1 as $facility_total_2) :
						foreach ($facility_total_2 as $facility_total1) :
							array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["packs"],$facility_total1["units"],$facility_total1["unit_cost"],$facility_total1["total"],$facility_total1["expiry_date"],$facility_total1["source_name"],$facility_total1["date_added"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["subcounty"],$facility_total1["county"]));
							$sub_county_expiries_total = $sub_county_expiries_total + $facility_total1["total"];
						endforeach;
					endforeach;
				endforeach;

				if (empty($row_data)) {
					//do nothing
				} else {

					$excel_data['row_data'] = $row_data;
					$excel_data['report_type'] = "download_file";
					$excel_data['file_name'] = $district_name . "_Weekly_District_Expiries_Report";
					$excel_data['excel_title'] = "Expiries Report for ".$district_name." Sub County for the month of ".date("F Y");
					
					//tyoe of report created
					$report_type = "expiries";
					//holds the total cost
					$total_figure = $sub_county_expiries_total;
					//creates the excel sheet
					$this-> create_excel($excel_data,$report_type,$total_figure);
					//path of the excel sheet
					$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					//creating the email subject and message body
					$subject = "Expiries: " . $district_name . " Sub County (Next 3 Months)";
					$message = "Dear ".$district_name." Sub County,
								<p>Find attached an excel sheet with the ".$district_name." Sub County breakdown of Expiries.
								You may log onto health-cmp.or.ke to decommission them.</p>
								<p>----</p>
								<p>HCMP</p>
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
					
					//email address to receive
					$email_address = $this -> get_ddp_email($district_id);
					$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
				}

			}

			//Building the excel sheet to be sent to the district admin
			$excel_data = array();
			$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'county expiries weekly report ', 'file_name' => 'district report');
			$row_data = array();
			$column_data = array("Commodity Name","Unit Size", "Quantity (packs)","Quantity (units)","Unit Cost(KSH)","Total Expired(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
			$excel_data['column_data'] = $column_data;

			foreach ($district_total as $facility_total_1) :
				foreach ($facility_total_1 as $facility_total_2) :
					foreach ($facility_total_2 as $facility_total_3) :
						foreach ($facility_total_3 as $facility_total_4) :
							foreach ($facility_total_4 as $facility_total1) :
								array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["packs"],$facility_total1["units"],$facility_total1["unit_cost"],$facility_total1["total"],$facility_total1["expiry_date"],$facility_total1["source_name"],$facility_total1["date_added"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["subcounty"],$facility_total1["county"]));
								$county_expiries_total = $county_expiries_total + $facility_total1["total"];
							endforeach;
						endforeach;
					endforeach;
				endforeach;
			endforeach;

			if (empty($row_data)) {
				//do nothing
			} else {
				$excel_data['row_data'] = $row_data;
				$excel_data['report_type'] = "download_file";
				$excel_data['file_name'] = $county_name . "_Weekly_County_Expiries_Report";
				$excel_data['excel_title'] = "Expiries Report for ".$county_name." County for the month of ".date("F Y");
					
				//create the excel here
				$report_type = "expiries";
				$total_figure = $county_expiries_total;
				$this-> create_excel($excel_data,$report_type,$total_figure);
				//Where the excel sheet will be saved before being attached
				$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
				
				//Start creating the email Subject and message body here
				$subject = "Expiries: " . $county_name . " County (Next 3 Months)";
				$message = "Dear ".$county_name." County,
							<p>Find attached an excel sheet with the ".$county_name." County's breakdown of Expiries.
							You may log onto health-cmp.or.ke to decommission them.</p>
							<p>----</p>
							<p>HCMP</p>
							<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
					
				$email_address = $this -> get_ddp_email_county($county_id);
				$bcc = $this -> get_bcc_notifications();
				$cc = $this -> get_county_email($county_id);
				
				$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler, $bcc, $cc);
			}

		}

	}
public function weekly_potential_expiries_report() {
		//Set the current year
		$year = date("Y");
		$picurl = base_url() . 'assets/img/coat_of_arms-resized1.png';
		//get the facilities in the district
		//$counties = Facilities::get_Taita();
		$counties = Facilities::get_counties_all_using_HCMP();
		
		foreach ($counties as $counties) {
			//holds the data for the entire county
			//once it is done executing for one county it is reset to zero
			$county_total = array();
			//pick the county name and county ID accordingly
			$county_id = $counties['county'];
			$county_name = $counties['county_name'];

			//Get all the districts in that  particular county
			$districts = Facilities::get_all_using_HCMP($county_id);
			//holds the data for all the districts in a particular county
			//echo "<pre>";print_r($districts);exit;
			$district_total = array();

			foreach ($districts as $districts) {

				$district_id = $districts['district'];
				$district_name = $districts['name'];
				//get all facilities in that district
				$facilities = Facilities::getFacilities_for_email($district_id);
				//holds all the data for all facilities in a particular district
				
				$facility_total = array();
				
				foreach ($facilities as $facilities_) :
					
					//holds the total value of expiries for that particular facility in that district
					$facility_potential_expiries_total = 0;
					//$facility_potential_expiries = array();
					$facility_code = $facilities_ -> facility_code;
					$facility_name = Facilities::get_facility_name2($facility_code);
					$facility_name = $facility_name['facility_name'];

					//get potential expiries in that particular facility
					$facility_potential_expiries = Facility_stocks::potential_expiries_email($facility_code);
					//echo "<pre>";print_r($facility_potential_expiries);exit;
					//push the result into another array that will be used by the distrct
					(array_key_exists($facility_name, $facility_total)) ? $facility_total[$facility_name] = array_merge($facility_total[$facility_name], array($facility_potential_expiries)) : $facility_total = array_merge($facility_total, array($facility_name => array($facility_potential_expiries)));
					//Start buliding the excel file
					$excel_data = array();
					$excel_data = array('doc_creator' => $facility_name, 'doc_title' => 'facility potential expiries weekly report ', 'file_name' => 'facility weekly report');
					$row_data = array();
					$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
					$excel_data['column_data'] = $column_data;

					foreach ($facility_potential_expiries as $facility_potential_expiries) :
						array_push($row_data, array($facility_potential_expiries["commodity_name"],$facility_potential_expiries["unit_size"],$facility_potential_expiries["units"], $facility_potential_expiries["packs"],$facility_potential_expiries["unit_cost"],$facility_potential_expiries["total_ksh"],$facility_potential_expiries["expiry_date"],$facility_potential_expiries["source_name"],$facility_potential_expiries["date_added"],$facility_potential_expiries["manufacture"],$facility_potential_expiries["facility_name"],$facility_potential_expiries["facility_code"],$facility_potential_expiries["subcounty"],$facility_potential_expiries["county"]));
						$facility_potential_expiries_total += $facility_potential_expiries["total_ksh"];
					endforeach;

					if (empty($row_data)) {
						//do nothing
					} else {
						$excel_data['row_data'] = $row_data;
						$excel_data['report_type'] = "download_file";
						$excel_data['file_name'] = $facility_name . "_Potential_Expiries_Report";
						$excel_data['excel_title'] = "Potential Expiries Report for ".$facility_name." as at ".date("jS F Y");

						$subject = "Potential Expiries: " . $facility_name . " (Next 3 Months)";
						
						$message = "Dear ".$facility_name.",
								<p>Find attached an excel sheet with the ".$facility_name." breakdown of the Potential Expiries.
								Kindly sensitize the need to re-distribute these short expiry commodities.</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
					
						$report_type = "potential_expiries";
						$this ->create_excel($excel_data,$report_type);
						
						$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						
						$email_address = $this->get_facility_email($facility_code);
						
						$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
						
					}

					//End foreach for facility
				endforeach;

				(array_key_exists($district_name, $district_total)) ? $district_total[$district_name] = array_merge($district_total[$district_name], array($facility_total)) : $district_total = array_merge($district_total, array($district_name => array($facility_total)));
				//Building the excel sheet to be sent to the district admin
				$excel_data = array();
				$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'district potential expiries weekly report ', 'file_name' => 'district weekly report');
				$row_data = array();
				$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
				$excel_data['column_data'] = $column_data;

				foreach ($facility_total as $facility_total_1) :
					foreach ($facility_total_1 as $facility_total_2) :
						foreach ($facility_total_2 as $facility_total1) :
							array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["units"], $facility_total1["packs"],$facility_total1["unit_cost"],$facility_total1["total_ksh"],$facility_total1["expiry_date"],$facility_total1["source_name"],$facility_total1["date_added"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["subcounty"],$facility_total1["county"]));
						
						endforeach;
					endforeach;
				endforeach;

				if (empty($row_data)) {
					//do nothing
				} else {

					$excel_data['row_data'] = $row_data;
					$excel_data['report_type'] = "download_file";
					$excel_data['file_name'] = $district_name . "_Weekly_Sub_County_Potential_Expiries_Report";
					$excel_data['excel_title'] = "Potential Expiries Report for ".$district_name." Sub County as at ".date("jS F Y");
					
					//Create the excel file here
					$report_type = "potential_expiries";
					$this ->create_excel($excel_data,$report_type);
					
					$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					$subject = "Potential Expiries: " . $district_name . " Sub County (Next 3 Months)";
					
					$message = "<p>Dear ".$district_name." Sub County,</p>
								<p>Find attached an excel sheet with the ".$district_name." Sub County's breakdown of Potential Expiries.
								Kindly sensitize the need to re-distribute these short expiry commodities.</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
					$email_address = $this -> get_ddp_email($district_id);
					$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
					
				}

			}

			//Building the excel sheet to be sent to the district admin
			$excel_data = array();
			$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'district potential expiries weekly report ', 'file_name' => 'district weekly report');
			$row_data = array();
			$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
			$excel_data['column_data'] = $column_data;

			foreach ($district_total as $facility_total_1) :
				foreach ($facility_total_1 as $facility_total_2) :
					foreach ($facility_total_2 as $facility_total_3) :
						foreach ($facility_total_3 as $facility_total_4) :
							foreach ($facility_total_4 as $facility_total1) :
								array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["units"], $facility_total1["packs"],$facility_total1["unit_cost"],$facility_total1["total_ksh"],$facility_total1["expiry_date"],$facility_total1["source_name"],$facility_total1["date_added"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["subcounty"],$facility_total1["county"]));
						
							endforeach;
						endforeach;
					endforeach;
				endforeach;
			endforeach;

			if (empty($row_data)) {
				//do nothing
			} else {
				$excel_data['row_data'] = $row_data;
				$excel_data['report_type'] = "download_file";
				$excel_data['file_name'] = $county_name . "_Weekly_County_Potential_Expiries_Report";
				$excel_data['excel_title'] = "Potential Expiries Report for ".$county_name." County as at ".date("jS F Y");
				
				//create the excel file
				$report_type = "potential_expiries";
				$this ->create_excel($excel_data,$report_type);
				
				$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
				$subject = "Potential Expiries: " . $county_name . " County (Next 3 Months)";
				
				$message = "<p>Dear ".$county_name." County,</p>
							<p>Find attached an excel sheet with the ".$county_name." County's breakdown of Potential Expiries.
							Kindly sensitize the need to re-distribute these short expiry commodities.</p>
							<p>You may log onto health-cmp.or.ke for follow up.</p>
							
							<p>----</p>
							
							<p>HCMP</p>
							
							<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
				$email_address = $this -> get_ddp_email_county($county_id);
				
				$bcc = $this -> get_bcc_notifications();
				$cc = $this -> get_county_email($county_id);
				
				$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler,$bcc,$cc);				
			}

		}

	}


	public function weekly_stockouts_report() {
		//Set the current year
		$year = date("Y");
		//get the facilities in the district
		//$counties = Facilities::get_Taita();
		//$counties = Facilities::get_counties_all_using_HCMP();
		$counties = Facilities::get_Taita();
		foreach ($counties as $counties) {
			//holds the dat for the entire county
			//once it is done executing for one county it is reset to zero
			$county_total = array();
			//pick the county nae and county ID accordingly
			$county_id = $counties['county'];
			$county_name = $counties['county_name'];

			//Get all the ddistricts in that  particular county
			$districts = Facilities::get_all_using_HCMP($county_id);
			//echo "<pre>";print_r($districts);exit;
				
			//holds the data for all the districts in a particular county
			$district_total = array();

			foreach ($districts as $districts) {

				$district_id = $districts['district'];
				$district_name = $districts['name'];
				//get all facilities in that district
				$facilities = Facilities::getFacilities_for_email($district_id);
				//holds all the data for all facilities in a particular district
				$facility_total = array();

				foreach ($facilities as $facilities_) :
					//holds the total value of expiries for that particular facility in that district
					$facility_potential_expiries_total = 0;
					//$facility_potential_expiries = array();
					$facility_code = $facilities_ -> facility_code;
					$facility_name = Facilities::get_facility_name2($facility_code);
					$facility_name = $facility_name['facility_name'];
					
					$facility_potential_expiries = Facility_stocks::get_stock_outs_for_email($facility_code);
					
					//get potential expiries in that particular facility
					//push the result into another array that will be used by the distrct
					(array_key_exists($facility_name, $facility_total)) ? $facility_total[$facility_name] = array_merge($facility_total[$facility_name], array($facility_potential_expiries)) : $facility_total = array_merge($facility_total, array($facility_name => array($facility_potential_expiries)));
					//Start building the excel file
					$excel_data = array();
					$excel_data = array('doc_creator' => $facility_name, 'doc_title' => 'facility stokouts weekly report ', 'file_name' => 'facility weekly report');
					$row_data = array();
					$column_data = array("Commodity Name","Unit Size","Unit Cost(KSH)","Quantity Available (Units)","Quantity Available (Packs)","Supplier","Manufacturer","Facility Name","Subcounty","County");
					$excel_data['column_data'] = $column_data;

					foreach ($facility_potential_expiries as $facility_potential_expiries) :
						array_push($row_data, array($facility_potential_expiries["commodity_name"],$facility_potential_expiries["unit_size"],$facility_potential_expiries["unit_cost"],$facility_potential_expiries["current_balance"],$facility_potential_expiries["current_balance_packs"],$facility_potential_expiries["source_name"],$facility_potential_expiries["manufacture"],$facility_potential_expiries["facility_name"],$facility_potential_expiries["district"],$facility_potential_expiries["county"]));
						//$facility_potential_expiries_total = $facility_potential_expiries_total + $facility_potential_expiries[""]
					endforeach;
					if (empty($row_data)) {
						//do nothing
					} else {
						
						$excel_data['row_data'] = $row_data;
						$excel_data['report_type'] = "download_file";
						$excel_data['file_name'] = $facility_name . "_Stock_Outs_Report";
						$excel_data['excel_title'] = "Stock Outs Report for ".$facility_name." as at ".date("jS F Y");
						
						$message = "<p>Dear ".$facility_name.",</p>
								<p>Find attached an excel sheet with the ".$facility_name." breakdown of commodities with Low Stock Levels.
								You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
						//Create the excel here
						$report_type = "stockouts";
						$this ->create_excel($excel_data,$report_type);
						//For Mac
						//$handler = "/Applications/XAMPP/xamppfiles/htdocs/hcmp/print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						//For Windows
						$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						$subject = "Stock Outs Report: " . $facility_name;
						
						$email_address = $this -> get_facility_email($facility_code);
						$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
						
					}

					//End foreach for facility
				endforeach;

				(array_key_exists($district_name, $district_total)) ? $district_total[$district_name] = array_merge($district_total[$district_name], array($facility_total)) : $district_total = array_merge($district_total, array($district_name => array($facility_total)));
				//Building the excel sheet to be sent to the district admin
				$excel_data = array();
				$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'district stock outs weekly report ', 'file_name' => 'district weekly report');
				$row_data = array();
				$column_data = array("Commodity Name","Unit Size","Unit Cost(KSH)","Quantity Available (Units)","Quantity Available (Packs)","Supplier","Manufacturer","Facility Name","Subcounty","County");
				$excel_data['column_data'] = $column_data;

				foreach ($facility_total as $facility_total_1) :
					foreach ($facility_total_1 as $facility_total_2) :
						foreach ($facility_total_2 as $facility_total1) :
							array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["unit_cost"],$facility_total1["current_balance"],$facility_total1["current_balance_packs"],$facility_total1["source_name"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["district"],$facility_total1["county"]));
							
						endforeach;
					endforeach;
				endforeach;
				if (empty($row_data)) {
					//do nothing
				} else {
					$excel_data['row_data'] = $row_data;
					$excel_data['report_type'] = "download_file";
					$excel_data['file_name'] = $district_name . "_Weekly_Sub_County_Stock_Outs_Report";
					$excel_data['excel_title'] = "Stock Outs Report for ".$district_name." Sub County as at ".date("jS F Y");
						
					$report_type = "stockouts";
					$this ->create_excel($excel_data,$report_type);
					//For Mac
					//$handler = "/Applications/XAMPP/xamppfiles/htdocs/hcmp/print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					//For Windows
					$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					
					$subject = "Stock Outs: " . $district_name . " Sub County";
					
					$message = "Dear ".$district_name." Sub County,
								<p>Find attached an excel sheet with the ".$district_name." Sub County breakdown of Stock Outs in the Sub County.
								You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
					$email_address = $this -> get_ddp_email($district_id);
					$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);

				}

			}

			//Building the excel sheet to be sent to the district admin
			$excel_data = array();
			$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'county stock outs weekly report ', 'file_name' => 'district weekly report');
			$row_data = array();
			$column_data = array("Commodity Name","Unit Size","Unit Cost(KSH)","Quantity Available (Units)","Quantity Available (Packs)","Supplier","Manufacturer","Facility Name","Subcounty","County");
			$excel_data['column_data'] = $column_data;

			foreach ($district_total as $facility_total_1) :
				foreach ($facility_total_1 as $facility_total_2) :
					foreach ($facility_total_2 as $facility_total_3) :
						foreach ($facility_total_3 as $facility_total_4) :
							foreach ($facility_total_4 as $facility_total1) :
								array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["unit_cost"],$facility_total1["current_balance"],$facility_total1["current_balance_packs"],$facility_total1["source_name"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["district"],$facility_total1["county"]));
							
							endforeach;
						endforeach;
					endforeach;
				endforeach;
			endforeach;
			if (empty($row_data)) {
				//do nothing
			} else {
				$excel_data['row_data'] = $row_data;
				$excel_data['report_type'] = "download_file";
				$excel_data['file_name'] = $county_name . "_Weekly_County_Stock_Outs_Report";
				$excel_data['excel_title'] = "Stock Outs Report for ".$county_name." County as at ".date("jS F Y");
					
				$report_type = "stockouts";
				$this ->create_excel($excel_data,$report_type);
				//For Mac
				//$handler = "/Applications/XAMPP/xamppfiles/htdocs/hcmp/print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
				//For Windows
				$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					
				$subject = "Stock Outs: " . $county_name . " County";
				
				$message = "Dear ".$county_name." County,
							<p>Find attached an excel sheet with the ".$county_name." County breakdown of Stock Outs in the county.
							You may log onto health-cmp.or.ke for follow up.</p>
							
							<p>----</p>
							
							<p>HCMP</p>
							
							<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
				$email_address = $this -> get_ddp_email_county($county_id);
				$bcc = $this -> get_bcc_notifications();
				$cc = $this -> get_county_email($county_id);
					
				$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler,$bcc,$cc);
				
			}

		}

	}
	
	//Consumption Report
	public function consumption_report() {
		//Set the current year
		$year = date("Y");
		$picurl = base_url() . 'assets/img/coat_of_arms-resized1.png';
		//get the facilities in the district
		$counties = Facilities::get_counties_all_using_HCMP();

		foreach ($counties as $counties) {
			//holds the data for the entire county
			//once it is done executing for one county it is reset to zero
			$county_total = array();
			//pick the county nae and county ID accordingly
			$county_id = $counties['county'];
			$county_name = $counties['county_name'];

			//Get all the districts in that  particular county
			$districts = Facilities::get_all_using_HCMP($county_id);
			//holds the data for all the districts in a particular county
			$district_total = array();

			foreach ($districts as $districts) {

				$district_id = $districts['district'];
				$district_name = $districts['name'];
				//get all facilities in that district
				$facilities = Facilities::getFacilities_for_email($district_id);
				//holds all the data for all facilities in a particular district
				$facility_total = array();

				foreach ($facilities as $facilities_) :
					//holds the total value of expiries for that particular facility in that district
					$facility_potential_expiries_total = 0;
					//$facility_potential_expiries = array();
					$facility_code = $facilities_ -> facility_code;
					$facility_name = Facilities::get_facility_name2($facility_code);
					$facility_name = $facility_name['facility_name'];

					//get potential expiries in that particular facility
					$facility_consumption = facility_issues::get_consumption_report_facility($facility_code);

					//push the result into another array that will be used by the distrct
					(array_key_exists($facility_name, $facility_total)) ? $facility_total[$facility_name] = array_merge($facility_total[$facility_name], array($facility_consumption)) : $facility_total = array_merge($facility_total, array($facility_name => array($facility_consumption)));
					//Start buliding the excel file
					$excel_data = array();
					$excel_data = array('doc_creator' => $facility_name, 'doc_title' => 'facility consumption report ', 'file_name' => 'facility consumption report');
					$row_data = array();
					$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
					$excel_data['column_data'] = $column_data;

					foreach ($facility_consumption as $facility_consumption) :
						array_push($row_data, array($facility_consumption["commodity_name"],$facility_consumption["unit_size"],$facility_consumption["total_units"], $facility_consumption["total_packs"],$facility_consumption["unit_cost"],$facility_consumption["total_cost"],$facility_consumption["source_name"],$facility_consumption["facility_name"],$facility_consumption["facility_code"],$facility_consumption["district"],$facility_consumption["county"]));
						$facility_potential_expiries_total += $facility_consumption["total_cost"];
					endforeach;

					if (empty($row_data)) {
						//do nothing
					} else {
						$excel_data['row_data'] = $row_data;
						$excel_data['report_type'] = "download_file";
						$excel_data['file_name'] = $facility_name . "_Consumption_Report";
						$excel_data['excel_title'] = "Consumption Report for ".$facility_name." for the month of ".date("F Y");

						$subject = "Consumption: " . $facility_name;
						
						$message = "Dear ".$facility_name.",
								<p>Find attached an excel sheet with the ".$facility_name." breakdown of the Consumption.
								</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
						$report_type = "consumption";
						$this ->create_excel($excel_data,$report_type);
						$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						
						$email_address = $this->get_facility_email($facility_code);
						$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);

					}

					//End foreach for facility
				endforeach;

				(array_key_exists($district_name, $district_total)) ? $district_total[$district_name] = array_merge($district_total[$district_name], array($facility_total)) : $district_total = array_merge($district_total, array($district_name => array($facility_total)));
				//Building the excel sheet to be sent to the district admin
				$excel_data = array();
				$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'sub county consumption report ', 'file_name' => 'sub county consumption report');
				$row_data = array();
				$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
				$excel_data['column_data'] = $column_data;

				foreach ($facility_total as $facility_total_1) :
					foreach ($facility_total_1 as $facility_total_2) :
						foreach ($facility_total_2 as $facility_total1) :
							array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["total_units"], $facility_total1["total_packs"],$facility_total1["unit_cost"],$facility_total1["total_cost"],$facility_total1["source_name"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["district"],$facility_total1["county"]));
						
						endforeach;
					endforeach;
				endforeach;

				if (empty($row_data)) {
					//do nothing
				} else {

					$excel_data['row_data'] = $row_data;
					$excel_data['report_type'] = "download_file";
					$excel_data['file_name'] = $district_name . "_Weekly_Sub_County_Consumption_Report";
					$excel_data['excel_title'] = "Consumption Report for ".$district_name." Sub County for the month of ".date("F Y");
					
					//Create the excel file here
					$report_type = "consumption";
					$this ->create_excel($excel_data,$report_type);
					//exit;
					
					$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					$subject = "Consumption: " . $district_name . " Sub County";
					
					$message = "<p>Dear ".$district_name." Sub County,</p>
								<p>Find attached an excel sheet with the ".$district_name." Sub County's breakdown of Consumption.
								</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
					$email_address = $this -> get_ddp_email($district_id);
					$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
				}

			}

			//Building the excel sheet to be sent to the County Admin
			$excel_data = array();
			$excel_data = array('doc_creator' => $county_name, 'doc_title' => 'county consumption report ', 'file_name' => 'county consumption report');
			$row_data = array();
			$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
			$excel_data['column_data'] = $column_data;

			foreach ($district_total as $facility_total_1) :
				foreach ($facility_total_1 as $facility_total_2) :
					foreach ($facility_total_2 as $facility_total_3) :
						foreach ($facility_total_3 as $facility_total_4) :
							foreach ($facility_total_4 as $facility_total1) :
								array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["total_units"], $facility_total1["total_packs"],$facility_total1["unit_cost"],$facility_total1["total_cost"],$facility_total1["source_name"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["district"],$facility_total1["county"]));
						
							endforeach;
						endforeach;
					endforeach;
				endforeach;
			endforeach;

			if (empty($row_data)) {
				//do nothing
			} else {
				$excel_data['row_data'] = $row_data;
				$excel_data['report_type'] = "download_file";
				$excel_data['file_name'] = $county_name . "_County_Consumption_Report";
				$excel_data['excel_title'] = "Consumption Report for ".$county_name." County for the month of ".date("F Y");
				
				//create the excel file
				$report_type = "consumption";
				$this ->create_excel($excel_data,$report_type);
				
				$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
				$subject = "Consumption: " . $county_name . " County";
				//exit;
				$message = "<p>Dear ".$county_name." County,</p>
							<p>Find attached an excel sheet with the ".$county_name." County's breakdown of Consumption.
							</p>
							<p>You may log onto health-cmp.or.ke for follow up.</p>
							
							<p>----</p>
							
							<p>HCMP</p>
							
							<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
				$email_address = $this -> get_ddp_email_county($county_id);
				$bcc = $this -> get_bcc_notifications();
				$cc = $this -> get_county_email($county_id);
				
				$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler, $bcc, $cc);
			}

		}

	}
	
	//Stock Levels Report
	public function stock_levels_report() {
		//Set the current year
		$year = date("Y");
		$picurl = base_url() . 'assets/img/coat_of_arms-resized1.png';
		//get the facilities in the district
		$counties = Facilities::get_counties_all_using_HCMP();

		foreach ($counties as $counties) {
			//holds the data for the entire county
			//once it is done executing for one county it is reset to zero
			$county_total = array();
			//pick the county nae and county ID accordingly
			$county_id = $counties['county'];
			$county_name = $counties['county_name'];

			//Get all the districts in that  particular county
			$districts = Facilities::get_all_using_HCMP($county_id);
			//holds the data for all the districts in a particular county
			$district_total = array();

			foreach ($districts as $districts) {

				$district_id = $districts['district'];
				$district_name = $districts['name'];
				//get all facilities in that district
				$facilities = Facilities::getFacilities_for_email($district_id);
				//holds all the data for all facilities in a particular district
				$facility_total = array();

				foreach ($facilities as $facilities_) :
					//holds the total value of expiries for that particular facility in that district
					$facility_potential_expiries_total = 0;
					//$facility_potential_expiries = array();
					$facility_code = $facilities_ -> facility_code;
					$facility_name = Facilities::get_facility_name2($facility_code);
					$facility_name = $facility_name['facility_name'];

					//get the stocking levels in that particular facility
					
					$facility_consumption = facility_issues::get_consumption_report_facility($facility_code);

					//push the result into another array that will be used by the distrct
					(array_key_exists($facility_name, $facility_total)) ? $facility_total[$facility_name] = array_merge($facility_total[$facility_name], array($facility_consumption)) : $facility_total = array_merge($facility_total, array($facility_name => array($facility_consumption)));
					//Start buliding the excel file
					$excel_data = array();
					$excel_data = array('doc_creator' => $facility_name, 'doc_title' => 'facility stock level report ', 'file_name' => 'facility stock level report');
					$row_data = array();
					$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
					$excel_data['column_data'] = $column_data;

					foreach ($facility_consumption as $facility_consumption) :
						array_push($row_data, array($facility_consumption["commodity_name"],$facility_consumption["unit_size"],$facility_consumption["total_units"], $facility_consumption["total_packs"],$facility_consumption["unit_cost"],$facility_consumption["total_cost"],$facility_consumption["source_name"],$facility_consumption["facility_name"],$facility_consumption["facility_code"],$facility_consumption["district"],$facility_consumption["county"]));
						$facility_potential_expiries_total += $facility_consumption["total_cost"];
					endforeach;

					if (empty($row_data)) {
						//do nothing
					} else {
						$excel_data['row_data'] = $row_data;
						$excel_data['report_type'] = "download_file";
						$excel_data['file_name'] = $facility_name . "_Stock_Level_Report";
						$excel_data['excel_title'] = "Stock Levels Report for ".$facility_name." for the month as at ".date("jS F Y");

						$subject = "Stock Levels: " . $facility_name;
						
						$message = "Dear ".$facility_name.",
								<p>Find attached an excel sheet with the ".$facility_name." breakdown of Stock Levels.
								</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
						$report_type = "stock_level";
						$this ->create_excel($excel_data,$report_type);
						$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						
						//$email_address = $this->get_facility_email($facility_code);
						//$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);

					}

					//End foreach for facility
				endforeach;

				(array_key_exists($district_name, $district_total)) ? $district_total[$district_name] = array_merge($district_total[$district_name], array($facility_total)) : $district_total = array_merge($district_total, array($district_name => array($facility_total)));
				//Building the excel sheet to be sent to the district admin
				$excel_data = array();
				$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'sub county stock level report ', 'file_name' => 'sub county stock level report');
				$row_data = array();
				$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
				$excel_data['column_data'] = $column_data;

				foreach ($facility_total as $facility_total_1) :
					foreach ($facility_total_1 as $facility_total_2) :
						foreach ($facility_total_2 as $facility_total1) :
							array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["total_units"], $facility_total1["total_packs"],$facility_total1["unit_cost"],$facility_total1["total_cost"],$facility_total1["source_name"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["district"],$facility_total1["county"]));
						
						endforeach;
					endforeach;
				endforeach;

				if (empty($row_data)) {
					//do nothing
				} else {

					$excel_data['row_data'] = $row_data;
					$excel_data['report_type'] = "download_file";
					$excel_data['file_name'] = $district_name . "_Sub_County_Stock_Level_Report";
					$excel_data['excel_title'] = "Stock Levels Report for ".$district_name." Sub County as at ".date("jS F Y");
					
					//Create the excel file here
					$report_type = "stock_level";
					$this ->create_excel($excel_data,$report_type);
					//exit;
					
					$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					$subject = "Stock Levels: " . $district_name . " Sub County";
					
					$message = "<p>Dear ".$district_name." Sub County,</p>
								<p>Find attached an excel sheet with the ".$district_name." Sub County's breakdown of Stock Levels.
								</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
					//$email_address = $this -> get_ddp_email($district_id);
					//$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
				}

			}

			//Building the excel sheet to be sent to the County Admin
			$excel_data = array();
			$excel_data = array('doc_creator' => $county_name, 'doc_title' => 'county stock levels report ', 'file_name' => 'county stock levels report');
			$row_data = array();
			$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
			$excel_data['column_data'] = $column_data;

			foreach ($district_total as $facility_total_1) :
				foreach ($facility_total_1 as $facility_total_2) :
					foreach ($facility_total_2 as $facility_total_3) :
						foreach ($facility_total_3 as $facility_total_4) :
							foreach ($facility_total_4 as $facility_total1) :
								array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["total_units"], $facility_total1["total_packs"],$facility_total1["unit_cost"],$facility_total1["total_cost"],$facility_total1["source_name"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["district"],$facility_total1["county"]));
						
							endforeach;
						endforeach;
					endforeach;
				endforeach;
			endforeach;

			if (empty($row_data)) {
				//do nothing
			} else {
				$excel_data['row_data'] = $row_data;
				$excel_data['report_type'] = "download_file";
				$excel_data['file_name'] = $county_name . "_County_Stock_Level_Report";
				$excel_data['excel_title'] = "Stock Level Report for ".$county_name." County as at ".date("jS F Y");
				
				//create the excel file
				$report_type = "stock_level";
				$this ->create_excel($excel_data,$report_type);
				
				$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
				$subject = "Stock Level: " . $county_name . " County";
				//exit;
				$message = "<p>Dear ".$county_name." County,</p>
							<p>Find attached an excel sheet with the ".$county_name." County's breakdown of Stock Level.
							</p>
							<p>You may log onto health-cmp.or.ke for follow up.</p>
							
							<p>----</p>
							
							<p>HCMP</p>
							
							<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
				//$email_address = $this -> get_county_email($county_id);
				//$email_address = "smutheu@clintonhealthaccess.org,kelvinmwas@gmail.com,collinsojenge@gmail.com";
				$bcc = $this -> get_bcc_notifications();
				if ($county_id == 1):
					$cc_email = $this -> get_bcc_notifications();
					//$cc_email = "";
				else:
					$cc_email = "";
				endif;

			$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler, $bcc, $cc_email);
			}

		}

	}
public function test_sms(){
	
	$phones='254723722204';
	$message='test from system live server';
	
	$this -> hcmp_functions -> send_sms($phones,$message);
}
	
/*CHAI REPORTS for ORS AND ZINC FOR THE ENTIRE COUNTRY*/
public function ors_zinc_report() {
		//Set the current year
		$year = date("Y");
		$county_total = array();
		$excel_data = array();
		$excel_data = array('doc_creator' =>"HCMP", 'doc_title' => ' stock level report ', 'file_name' => 'stock level report');
		$row_data = array();
		$column_data = array("County","Sub-County","Facility Code", 
							"Facility Name","Commodity Name","Unit Size","Unit Cost(KES)",
							"Supplier","Manufacturer","Batch Number","Expiry Date",
							"Stock at Hand (units)","Stock at Hand (packs)","AMC (units)","AMC (packs)","Stock at Hand MOS(packs)");
		$excel_data['column_data'] = $column_data;
		//the commodities variable will hold the values for the three commodities ie ORS and Zinc
		$commodities = array(51,267,36);
		foreach ($commodities as $commodities):
			$commodity_stock_level = array();
			//holds the data for the entire county
			//once it is done executing for one commodity it will reset to zero
			$commodity_total = array();
			
			//pick the commodity names and details
			//$commodity_name = Commodities::get_commodity_name($commodities);
			//get the stock level for that commodity
			$commodity_stock_level = Facility_stocks::get_commodity_stock_level($commodities);
			//echo "<pre>";print_r($commodity_stock_level);exit;
			//Start buliding the excel file
			foreach ($commodity_stock_level as $commodity_stock_level) :
				array_push($row_data, 
							array($commodity_stock_level["county"],
							$commodity_stock_level["subcounty"],
							$commodity_stock_level["facility_code"], 
							$commodity_stock_level["facility_name"],
							$commodity_stock_level["commodity_name"],
							$commodity_stock_level["unit_size"],
							$commodity_stock_level["unit_cost"],
							$commodity_stock_level["supplier"],
							$commodity_stock_level["manufacture"],
							$commodity_stock_level["batch_no"],
							$commodity_stock_level["expiry_date"],
							$commodity_stock_level["balance_units"],
							$commodity_stock_level["balance_packs"],
							$commodity_stock_level["amc_units"],
							$commodity_stock_level["amc"],
							$commodity_stock_level["mos"]));
				
			endforeach;
			
			//Switch statement to build on the remaining part of the message body
			//get the number of facilities stocked out on a specific commodity
			$no_of_stock_outs = Facility_stocks::facilities_stocked_specific_commodity($commodities);
			
			//get the number of facilities reporting on a specific commodity
			$no_of_facilities_reporting = Facility_stocks::facilities_reporting_on_a_specific_commodity($commodities);
			//get the number of batches expiring within 3 months
			$no_of_batches = Facility_stocks::batches_expiring_specific_commodities($commodities);
			//echo "<pre>";print_r($no_of_stock_outs);exit;
	
			switch($commodities):
				case 51:
					$message_body .= "<p>Number of Facilities Reporting on ORS Satchets (100):". $no_of_facilities_reporting."</p>";
					$message_body .= "<p>Number of Facilities Stocked out on ORS Satchets (100): ".$no_of_stock_outs."</p>";
					$message_body .= "<p>Number of ORS (100) Batches expiring in the next 3 months: ".$no_of_batches."</p>";
					break;
				case 267:
					$message_body .= "<p>Number of Facilities Reporting on ORS Satchets (50):". $no_of_facilities_reporting."</p>";
					$message_body .= "<p>Number of Facilities Stocked out on ORS Satchets (50): ".$no_of_stock_outs."</p>";
					$message_body .= "<p>Number of ORS (50) Batches expiring in the next 3 months:  ".$no_of_batches."</p>";
					break;
				case 36:
					$message_body .= "<p>Number of Facilities Reporting on Zinc Sulphate 20mg:". $no_of_facilities_reporting."</p>";
					$message_body .= "<p>Number of Facilities Stocked out on Zinc Sulphate 20mg:".$no_of_stock_outs."</p>";
					$message_body .= "<p>Number of Zinc Sulphate Batches expiring in the next 3 months:".$no_of_batches."</p>";
					break;
				
					
					
			endswitch;
			
			//array_push($county_total,array($row_data));				
	endforeach;
			
	
	$excel_data['row_data'] = $row_data;
	$excel_data['report_type'] = "download_file";
	$excel_data['file_name'] = "Stock_Level_Report";
	$excel_data['excel_title'] = "Stock Level Report for Zinc sulphate Tablets  20mg and ORS sachet (for 500ml) low osmolality (100) & (50) as at ".date("jS F Y");
	
	//Start the email section of the report
	//Get the number of facilities using HCMP
	$no_of_facilities = Facilities::get_all_on_HCMP();
	
	
	$subject = "Daily Stock Level Report: Zinc sulphate Tablets  20mg and ORS sachet (for 500ml) low osmolality ";
				
	$message = "Good Morning,
				<p>Find attached an excel sheet with a Stock Level Report for 
				Zinc Sulphate 20mg and ORS sachet (for 500ml) low osmolality (100 & 50) as at ".date("jS F Y")."</p>";
	$message .="<p>Number of facilities using HCMP: ".$no_of_facilities."</p>";
	$message .= $message_body;
	$message .="
				
				
				<p>You may log onto health-cmp.or.ke for follow up.</p>
				
				<p>----</p>
				
				<p>HCMP</p>
				
				<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
	//echo $message;exit;	
	$report_type = "ors_report";
	$this ->create_excel($excel_data,$report_type);
	
	//path for windows
	$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
	
	//path for Mac
	//$handler = "/Applications/XAMPP/xamppfiles/htdocs/hcmp/print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
	$email_address = "smutheu@clintonhealthaccess.org,bwariari@clintonhealthaccess.org,amwaura@clintonhealthaccess.org,rkihoto@clintonhealthaccess.org";
	$bcc = "collinsojneg@gmail.com,kelvinmwas@gmail.com,nmaingi@strathmore.edu";
	
	$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler,$bcc);

	}

public function create_excel_ors($excel_data=NUll,$report_type = NULL, $total_figure =  NULL) 
{
	$styleArray = array('font' => array('bold' => true),'alignment'=>array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
	$styleArray2 = array('font' => array('bold' => true));
 	//$objWorksheet1 = $objPHPExcel->createSheet();
	//$objWorksheet1->setTitle('Another sheet'); 
    //check if the excel data has been set if not exit the excel generation   
	if(count($excel_data)>0):
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel -> getProperties() -> setCreator("HCMP");
		$objPHPExcel -> getProperties() -> setLastModifiedBy($excel_data['doc_creator']);
		$objPHPExcel -> getProperties() -> setTitle($excel_data['doc_title']);
		$objPHPExcel -> getProperties() -> setSubject($excel_data['doc_title']);
		$objPHPExcel -> getProperties() -> setDescription("");

		$objPHPExcel -> setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
		
		$rowExec = 2;
		$column = 0;
		//Looping through the cells
		
		foreach ($excel_data['column_data'] as $column_data) 
		{
			$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $column_data);
			$objPHPExcel -> getActiveSheet() -> getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($column)) -> setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($column, $rowExec)->getFont()->setBold(true);
			$column++;
		}		
		
		$rowExec = 3;
				
		foreach ($excel_data['row_data'] as $row_data) 
		{
			$column = 0;
	        foreach($row_data as $cell)
	        {
	        	//Looping through the cells per facility
				$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $cell);
				$column++;	
			}
        	
        	$rowExec++;
		}

		$objPHPExcel -> getActiveSheet() -> setTitle('Simple');
		//echo date('H:i:s') . " Write to Excel2007 format\n";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    	// We'll be outputting an excel file
		if(isset($excel_data['report_type']))
		{
			///Applications/XAMPP/xamppfiles/htdocs/hcmp/print_docs/excel/excel_files
			$objWriter->save("./print_docs/excel/excel_files/".$excel_data['file_name'].'.xls');
			//$objWriter->save("/Applications/XAMPP/xamppfiles/htdocs/hcmp/print_docs/excel/excel_files/".$excel_data['file_name'].'.xls');
			//exit;
	   	} else{
	   		// We'll be outputting an excel file
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	        header("Cache-Control: no-store, no-cache, must-revalidate");
	        header("Cache-Control: post-check=0, pre-check=0", false);
	        header("Pragma: no-cache");
			// It will be called file.xls
			header("Content-Disposition: attachment; filename=".$excel_data['file_name'].'.xls');
			// Write file to the browser
	        $objWriter -> save('php://output');
	       $objPHPExcel -> disconnectWorksheets();
	       unset($objPHPExcel);
	   }
		
	endif;
}
 

public function create_excel($excel_data=NUll,$report_type = NULL, $total_figure =  NULL) 
{
	$styleArray = array('font' => array('bold' => true),'alignment'=>array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
	$styleArray2 = array('font' => array('bold' => true));
	
 	//check if the excel data has been set if not exit the excel generation   
 	//$objWorksheet1 = $objPHPExcel->createSheet();
	//$objWorksheet1->setTitle('Another sheet'); 
     
	if(count($excel_data)>0):
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel -> getProperties() -> setCreator("HCMP");
		$objPHPExcel -> getProperties() -> setLastModifiedBy($excel_data['doc_creator']);
		$objPHPExcel -> getProperties() -> setTitle($excel_data['doc_title']);
		$objPHPExcel -> getProperties() -> setSubject($excel_data['doc_title']);
		$objPHPExcel -> getProperties() -> setDescription("");

		$objPHPExcel -> setActiveSheetIndex(0);
		
		if($report_type=="expiries"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
			$cell_count = count($excel_data["row_data"]);
			$cell_count2 = $cell_count + 2;
			$cell_count3 = $cell_count + 3;
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$cell_count3, "=SUM(F3:F".$cell_count2.")");
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$cell_count3, "Total Cost of Expiries");
			$objPHPExcel->getActiveSheet()->getStyle('A'.$cell_count3)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$cell_count3)->applyFromArray($styleArray2);
		
		elseif($report_type=="ors_report"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
			
		elseif($report_type=="potential_expiries"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
			
		elseif($report_type=="stockouts"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
			
		elseif($report_type=="order_costs"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
		elseif($report_type=="consumption"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
		elseif($report_type=="stock_level"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
		
		endif;
		
		$rowExec = 2;
		$column = 0;
		//Looping through the cells
		
		foreach ($excel_data['column_data'] as $column_data) 
		{
			$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $column_data);
			$objPHPExcel -> getActiveSheet() -> getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($column)) -> setAutoSize(true);
			//$objPHPExcel->getActiveSheet()->getStyle($column, $rowExec)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($column, $rowExec)->getFont()->setBold(true);
			$column++;
		}		
		
		$rowExec = 3;
				
		foreach ($excel_data['row_data'] as $row_data) 
		{
			$column = 0;
	        foreach($row_data as $cell)
	        {
	        	//Looping through the cells per facility
				$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $cell);
				$column++;	
			}
        	
        	$rowExec++;
		}

		$objPHPExcel -> getActiveSheet() -> setTitle('Simple');
		//echo date('H:i:s') . " Write to Excel2007 format\n";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    	// We'll be outputting an excel file
		if(isset($excel_data['report_type']))
		{
			//For Windows				
			$objWriter->save("./print_docs/excel/excel_files/".$excel_data['file_name'].'.xls');
			//For Mac
			//$objWriter->save("/Applications/XAMPP/xamppfiles/htdocs/hcmp/print_docs/excel/excel_files/".$excel_data['file_name'].'.xls');
			//exit;
	   	} else{
	   		// We'll be outputting an excel file
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	        header("Cache-Control: no-store, no-cache, must-revalidate");
	        header("Cache-Control: post-check=0, pre-check=0", false);
	        header("Pragma: no-cache");
			// It will be called file.xls
			header("Content-Disposition: attachment; filename=".$excel_data['file_name'].'.xls');
			// Write file to the browser
	        $objWriter -> save('php://output');
	       $objPHPExcel -> disconnectWorksheets();
	       unset($objPHPExcel);
	   }
		
	endif;
}
 


	public function create_pdf($pdf_data = NULL, $district_id = NULL, $html_body = NULL) {
		//echo $district_id;
		//exit;
		if (count($pdf_data) > 0) :
			$url = base_url() . 'assets/img/coat_of_arms.png';
			$html_title = "<div align=center><img src='$url' height='70' width='70'style='vertical-align: top;'> </img></div>
		<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
		Ministry of Health</div>
		<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>
		Health Commodities Management Platform</div>
		<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>
		Weekly Reports</div><hr/>";

			$table_style = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
		table.data-table th {border: none;color: #036;text-align: center;border: 1px solid #DDD;border-top: none;max-width: 450px;}
		table.data-table td, table th {padding: 4px;}
		table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
		</style>';
			//$name=$this -> session -> userdata('full_name');

			$this -> mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
			$this -> mpdf -> ignore_invalid_utf8 = true;
			$this -> mpdf -> WriteHTML($html_title);
			$this -> mpdf -> defaultheaderline = 1;
			$this -> mpdf -> simpleTables = true;
			$this -> mpdf -> WriteHTML($table_style . $pdf_data);
			$this -> mpdf -> SetFooter("{DATE D j M Y }|{PAGENO}/{nb}|Prepared by: HCMP");
			//$this -> mpdf -> Output($report_name, 'I');
			//exit;
			$report_name = "Weekly Report.pdf";
			$path = $_SERVER["DOCUMENT_ROOT"];
			$handler = $path . "/HCMPv2/pdf/" . $report_name;
			write_file($handler, $this -> mpdf -> Output($report_name, 'S'));
			//$email_address = "collinsojenge@gmail.com";
			$message = $html_body;
			//echo $html_body;
			//exit;
			$subject = "Weekly Reports";
			//Get the email address of the dpp to whom the email is going to
			$email_address = $this -> get_ddp_email($district_id);
			//$email_address = "collinsojenge@gmail.com";
			$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
		endif;
	}

	function email_sender($report_name) {

		//setting the connection variables
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = stripslashes('hcmpkenya.test@gmail.com');
		$config['smtp_pass'] = stripslashes('verystrongpassword');
		ini_set("SMTP", "ssl://smtp.gmail.com");
		ini_set("smtp_port", "465");
		ini_set("max_execution_time", "50000");

		$emails = "collinsojenge@gmail.com";

		//pulling emails from the DB
		$this -> load -> library('email', $config);
		$path = $_SERVER["DOCUMENT_ROOT"];
		$file = $path . "/HCMPv2/application/assets/pdf/" . $report_name;
		//puts the path where the pdf's are stored

		foreach ($emails as $email) {
			$this -> email -> attach($file);
			$address = $email['email'];
			$this -> email -> set_newline("\r\n");
			$this -> email -> from('hcmpkenya.test@gmail.com', "HCMP Kenya");
			//user variable displays current user logged in from sessions
			$this -> email -> to("$address");
			$this -> email -> subject('Weekly HCMP Report ');
			$this -> email -> message('Please find the Report Attached');

			//success message else show the error
			if ($this -> email -> send()) {
				echo 'Your email was sent, successfully to ' . $address . '<br/>';
				//unlink($file);
				$this -> email -> clear(TRUE);

			} else {
				show_error($this -> email -> print_debugger());
			}

		}
		ob_end_flush();
		unlink($file);
		//delete the attachment after sending to avoid clog up of pdf'ss
	}
public function log_summary_weekly(){
	
		$data = $q = Doctrine_Manager::getInstance()
	        ->getCurrentConnection()
	        ->fetchAll("SELECT *
FROM (SELECT f.facility_name,f.facility_code,c.county,d.district,l.user_id, 
if(l.issued=0 and l.ordered=0 and l.redistribute=0 and l.decommissioned=0 ,max(l.start_time_of_event),null)
 as login_only,
l.issued,if(l.issued=1 and l.redistribute=0 ,max(l.start_time_of_event),null) as issue_event,
l.ordered,DateDiff(now(),if(l.issued=1 and l.redistribute=0 ,max(l.start_time_of_event),null)) as issue_d,
if(l.ordered=1 ,max(l.end_time_of_event),null) as ordered_event,
DateDiff(now(),if(l.ordered=1 ,max(l.start_time_of_event),0)) as ordered_d,
l.redistribute,if(l.redistribute=1 ,max(l.start_time_of_event),null) as redistribute_event,
DateDiff(now(),if(l.redistribute=1 ,max(l.start_time_of_event),0)) as redistribute_d,
l.decommissioned,if(l.decommissioned=1 ,max(l.start_time_of_event),null) as decommissioned_event,
DateDiff(now(),if(l.decommissioned=1 ,max(l.start_time_of_event),0)) as decommissioned_d,
l.add_stock,if(l.add_stock=1 ,max(l.start_time_of_event),null) as receive_event,
DateDiff(now(),if(l.add_stock=1 ,max(l.start_time_of_event),0)) as receive_event_d,
max(l.start_time_of_event) as date_event,
DateDiff(now(),max(l.start_time_of_event)) as date_event_d
 FROM log l
INNER JOIN user u ON l.user_id=u.id
RIGHT JOIN facilities f ON u.facility=f.facility_code
INNER JOIN districts d ON f.district=d.id
INNER JOIN counties c ON d.county=c.id
where  using_hcmp=1 group by l.issued,l.ordered,l.redistribute,l.decommissioned,f.facility_code) AS t
group by issued,ordered,redistribute,decommissioned,facility_code
");
						 
						 $mfl=array();
						 
				foreach ($data as $key) {
						
					$mfl[]=$key['facility_code'];
							 
						 }
						 $unique_mfl=array_values(array_unique($mfl));
						 //echo '<pre>';print_r($data); echo '</pre>';exit;
						 $temp=array();
						 foreach ($unique_mfl as $key ) {
						 	
						 	array_push($temp,array('facility_code'=>$key,
							        'facility_name'=>'',
							        'county'=>'',
							        'district'=>'',
							        'issued'=>'',
							        'issue_event'=>0,
							        'issue_d'=>0,
							        'login_event'=>0,
							        'ordered'=>0,
							        'ordered_d'=>0,
							        'ordered_event'=>'',
							        'redistribute'=>'',
							        'redistribute_event'=>'',
							        'redistribute_d'=>0,
							        'decommissioned'=>'',
							        'decommissioned_event'=>'',
							        'decommissioned_d'=>0,
							        'receive_event'=>'',
							        'receive_event_d'=>0,
								    'date_event'=>'',
								    'date_event_d'=>0
							        ));
							 
						 }
						//echo '<pre>';print_r($temp); echo '</pre>';exit;						 
						 $multi_dimenetional = array();
								foreach ($data  as $row) {
								    $multi_dimenetional[$row['facility_name']][] = array( 'facility_name'=>$row['facility_name'],
								    									'facility_code'=>$row['facility_code'],
								    									'county'=>$row['county'],
								    									'district'=>$row['district'],
								    									  'issued'=>$row['issued'],
								    									  'issue_event'=>($row['issue_event']),
								    									  'issue_d'=>$row['issue_d'],
								    									  'login_event'=>$row['login_only'],
								    									  'ordered'=>$row['ordered'],
								    									  'ordered_d'=>$row['ordered_d'],
								    									  'ordered_event'=>$row['ordered_event'],
								    									  'redistribute'=>$row['redistribute'],
								    									  'redistribute_event'=>$row['redistribute_event'],
								    									  'redistribute_d'=>$row['redistribute_d'],
								    									  'decommissioned'=>$row['decommissioned'],
								    									  'decommissioned_event'=>$row['decommissioned_event'],
								    									  'decommissioned_d'=>$row['decommissioned_d'],
								    									  'receive_event'=>$row['receive_event'],
								    									  'receive_event_d'=>$row['receive_event_d'],
								    									  'date_event'=>$row['date_event'],
								    									  'date_event_d'=>$row['date_event_d']
																	        );
								}
						 //echo '<pre>';print_r(array_values($multi_dimenetional)); echo '</pre>';exit;
						 $clean_array=array_values($multi_dimenetional);
						
							$new=call_user_func_array('array_merge_recursive', $multi_dimenetional);
							//$new=call_user_func_array('array_merge_recursive', $new);
							
						// $this -> hcmp_functions -> create_excel($multi_dimenetional);
						//echo '<pre>';print_r(array_values($clean_array));echo '</pre>';exit;
						
							  
							  $temp2 = array();
						foreach ($clean_array as $key => $value) {
							//echo count($value).'<br>';
							$issue_event=array();
							$issue_days=array();
							$login_event=array();
							$ordered=array();
							$ordered_days=array();
							$ordered_event=array();
							$redistribute_days=array();
							$redistribute_event=array();
							$decommission=array();
							$decommission_event=array();
							$decommission_days=array();
							
							$receive_event=array();
							$receive_days=array();
							$last_event=array();
							$lastseen_days=array();
							foreach ($value as $key_child => $value_child) {
								
								foreach ($temp as $newkey => $newvalue) {
									if ($newvalue['facility_code']==$value_child['facility_code']) {
										$facility_name=$value_child['facility_name'];
										$facility_code=$value_child['facility_code'];
										$county=$value_child['county'];
										$district=$value_child['district'];
										
										$login_event[]=$value_child['login_only'];
										$ordered[]=$value_child['ordered'];
										
										$issue_event[]=$value_child['issue_event'];
										$issue_days[]=$value_child['issue_d'];
										
										$ordered_days[]=$value_child['ordered_d'];
										$ordered_event[]=$value_child['ordered_event'];
										$redistribute_days[]=$value_child['redistribute_d'];
										$redistribute_event[]=$value_child['redistribute_event'];
										$decommission[]=$value_child['decommissioned'];
										$decommission_event[]=$value_child['decommissioned_event'];
										
										$decommission_days[]=$value_child['decommissioned_d'];
										$receive_event[]=$value_child['receive_event'];
										$receive_days[]=$value_child['receive_event_d'];
										$last_event[]=$value_child['date_event'];
										$lastseen_days[]=$value_child['date_event_d'];
																		
							 
									}
									
								}
							}
							array_push($temp2,array('facility_code'=>$facility_code,
							        'facility_name'=>$facility_name,
							        'county'=>$county,
							        'district'=>$district,
							        'issued'=>'',
							        'issue_event'=>max($issue_event),
							        'issue_d'=>min(array_filter($issue_days)),
							        'login_event'=>max($login_event),
							        'ordered'=>0,
							        'ordered_d'=>min(array_filter($ordered_days)),
							        'ordered_event'=>max($ordered_event),
							        'redistribute'=>'',
							        'redistribute_event'=>max($redistribute_event),
							        'redistribute_d'=>min(array_filter($redistribute_days)),
							        'decommissioned'=>'',
							        'decommissioned_event'=>max($decommission_event),
							        'decommissioned_d'=>min(array_filter($decommission_days)),
							        'receive_event'=>max($receive_event),
							        'receive_event_d'=>min(array_filter($receive_days)),
								    'date_event'=>max($last_event),
								    'date_event_d'=>min($lastseen_days)
							        ));

							//echo '<pre>';print_r(min($lastseen_days));echo '</pre>';
						}
						//echo '<pre>';print_r($temp2);echo '</pre>';
						//exit;
						/*foreach ($new as $value) {
							$mfl_code=$value['facility_code'];
							
							foreach($value as $k=>$v){
								// echo $k.'    '.$v;
								if($v!=NULL){
									
									$finalArray[$mfl_code][$k]=$v;
								}
							}
							
						}*/
						//echo '<pre>';print_r(array_values($finalArray));echo '</pre>';exit;
		$excel_data = array('doc_creator' => 'HCMP-Kenya', 'doc_title' => 'HCMP_Facility_Activity_Log_Summary ', 'file_name' => 'HCMP_Facility_Activity_Log_Summary ');
		$row_data = array(); 
		$column_data = array("Facility Name", "Facility Code", "County","Sub-County", "Date Last Issued", "Days from last issue",
		"Date Last Redistributed", "Days From last Redistributed", "Date Last ordered", "Days From Last order", "Date Last Decommissioned",
		 "Days From Last Decommissioned", "Date From Last Received Order", "Days From Last Received Order","Date Last Seen", "Days From Last Seen");
		$excel_data['column_data'] = $column_data;
		foreach ($temp2 as $key => $value) :
		array_push($row_data, 
		array($value['facility_name'],
		$value['facility_code'],
		$value['county'],
		$value['district'],
		(date('m-d-Y',strtotime($value['issue_event']))=='01-01-1970')? '' : date('m-d-Y',strtotime($value['issue_event'])),
		($value['issue_d']==0)? '':$value['issue_d'],
		(date('m-d-Y',strtotime($value['redistribute_event']))=='01-01-1970')? '' : date('m-d-Y',strtotime($value['redistribute_event'])),
		($value['redistribute_d']=='')? '' :$value['redistribute_d'],
		(date('m-d-Y',strtotime($value['ordered_event']))=='01-01-1970')? '' : date('m-d-Y',strtotime($value['ordered_event'])),
		($value['ordered_d']=='')? '' :$value['ordered_d'] ,
		(date('m-d-Y',strtotime($value['decommissioned_event']))=='01-01-1970')? '' : date('m-d-Y',strtotime($value['decommissioned_event'])),
		($value['decommissioned_d']=='')? '':$value['decommissioned_d'],
		(date('m-d-Y',strtotime($value['receive_event']))=='01-01-1970')? '' : date('m-d-Y',strtotime($value['receive_event'])),
		($value['receive_event_d']=='')? '' :$value['receive_event_d'],
		(date('m-d-Y',strtotime($value['date_event']))=='01-01-1970')? '' : date('m-d-Y',strtotime($value['date_event'])),
		($value['date_event_d']=='')? '' :$value['date_event_d']
		));
		endforeach;
		$excel_data['row_data'] = $row_data;
		$excel_data['report_type']='Log Summary';

		$this -> hcmp_functions -> create_excel($excel_data);
		
		$message ='';	
			$message.="<style> table {
    border-collapse: collapse; 
}td,th{
	padding: 12px;
	text-align:center;
}

*{margin:0;padding:0}*{font-family:'Helvetica Neue',Helvetica,Helvetica,Arial,sans-serif}img{max-width:100%}.collapse{padding:0}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100%!important;height:100%}a{color:#2BA6CB}.btn{text-decoration:none;color:#FFF;background-color:#666;padding:10px 16px;font-weight:700;margin-right:10px;text-align:center;cursor:pointer;display:inline-block}p.callout{padding:15px;background-color:#ECF8FF;margin-bottom:15px}.callout a{font-weight:700;color:#2BA6CB}table.social{background-color:#ebebeb}.social .soc-btn{padding:3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:700;display:block;text-align:center}a.fb{background-color:#3B5998!important}a.tw{background-color:#1daced!important}a.gp{background-color:#DB4A39!important}a.ms{background-color:#000!important}.sidebar .soc-btn{display:block;width:100%}table.head-wrap{width:100%}.header.container table td.logo{padding:15px}.header.container table td.label{padding:15px 15px 15px 0}table.body-wrap{width:100%}table.footer-wrap{width:100%;clear:both!important}.footer-wrap .container td.content p{border-top:1px solid #d7d7d7;padding-top:15px;font-size:9px;font-weight:500}h1,h2,h3,h4,h5,h6{font-family:HelveticaNeue-Light,'Helvetica Neue Light','Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;line-height:1.1;margin-bottom:15px;color:#000}h1 small,h2 small,h3 small,h4 small,h5 small,h6 small{font-size:60%;color:#6f6f6f;line-height:0;text-transform:none}h1{font-weight:200;font-size:44px}h2{font-weight:200;font-size:37px}h3{font-weight:500;font-size:27px}h4{font-weight:500;font-size:23px}h5{font-weight:900;font-size:17px}h6{font-weight:900;font-size:14px;text-transform:uppercase;color:#444}.collapse{margin:0!important}p,ul{margin-bottom:10px;font-weight:400;font-size:14px;line-height:1.6}p.lead{font-size:17px}p.last{margin-bottom:0}ul li{margin-left:5px;list-style-position:inside}ul.sidebar{background:#ebebeb;display:block;list-style-type:none}ul.sidebar li{display:block;margin:0}ul.sidebar li a{text-decoration:none;color:#666;padding:10px 16px;cursor:pointer;border-bottom:1px solid #777;border-top:1px solid #FFF;display:block;margin:0}ul.sidebar li a.last{border-bottom-width:0}ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p{margin-bottom:0!important}.container{display:block!important;max-width:100%!important;margin:0 auto!important;clear:both!important}.content{padding:15px;max-width:80%px;margin:0 auto;display:block}.content table{width:100%}.column{width:300px;float:left}.column tr td{padding:15px}.column-wrap{padding:0!important;margin:0 auto;max-width:600px!important}.column table{width:100%}.social .column{width:280px;min-width:279px;float:left}.clear{display:block;clear:both}@media only screen and (max-width:600px){a[class=btn]{display:block!important;margin-bottom:10px!important;background-image:none!important;margin-right:0!important}div[class=column]{width:auto!important;float:none!important}table.social div[class=column]{width:auto!important}}</style>";
			$message .='
		<tr>
		<td colspan="12">
		</tr>
		</tbody>
		</table>'; 
			$message.="<!-- BODY -->
<table class='body-wrap'>
	<tr>
		<td></td>
		<td class='container' bgcolor='#FFFFFF'>

			<div class='content'>
			<table>
				<tr>
					<td>
						<h3>Hello,</h3>
						<p class='lead'>Find attached a summary of Facility Activity Log.</p>
						<p>$body</p>
						<!-- Callout Panel -->
						<p class='callout'>
							<a href='health-cmp.or.ke'>Click here! &raquo;</a> to follow up. 
						</p><!-- /Callout Panel -->					
												
						<!-- social & contact -->
						<table class='social' width='100%'>
							<tr>
								<td>
									
									<!-- column 1 -->
									<table align='left' class='column'>
										
									</table><!-- /column 1 -->	
									
									<!-- column 2 -->
									<table align='left' class='column'>
										<tr>
											<td>				
																			
												<h5 class=''>Contact Info:</h5>												
												<p>Phone: <strong>+254720167245</strong><br/>
                Email: <strong><a href='emailto:hcmpkenya@gmail.com'>hcmpkenya@gmail.com</a></strong></p>
                
											</td>
										</tr>
									</table><!-- /column 2 -->
									
									<span class='clear'></span>	
									
								</td>
							</tr>
						</table><!-- /social & contact -->
						
					</td>
				</tr>
			</table>
			</div><!-- /content -->
									
		</td>
		<td></td>
	</tr>
</table><!-- /BODY -->";	

						$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						$subject = "Weekly Log Summary ";
						
						$email_address = 'kelvinmwas@gmail.com';
						$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
			
            
			
		exit;
					/*echo "<table class='data-table'>
		<thead>
		<tr>
			<th ><b>Facility Name</b></th>
			<th ><b>Facility Code</b></th>
			<th ><b>County</b></th>
			<th ><b>Sub-County</b></th>
			<th ><b>Date Last Issued</b></th>
			<th ><b>Days from last issue</b></th>
			<th ><b>Date Last Redistributed</b></th>
			<th ><b>Days From last Redistributed</b></th>
			<th ><b>Date Last ordered</b></th>
			<th ><b>Days From Last order</b></th>
			<th ><b>Date Last Decommissioned</b></th>
			<th ><b>Days From Last Decommissioned</b></th>
			<th ><b>Date Last Seen</b></th>
			<th ><b>Days From Last Seen</b></th>
		</tr> 
		</thead><tbody>";
       foreach ($finalArray as $key => $value) {
       	
           echo '<tr><td>'.$value['facility_name'].'</td>';
		   echo '<td>'.$value['facility_code'].'</td>';
		   echo '<td>'.$value['county'].'</td>';
		   echo '<td>'.$value['district'].'</td>';
		   echo '<td>'.date('Y-m-d',strtotime($value['issue_event'])).'</td>';
		   echo '<td>'.$value['issue_d'].'</td>';
		   echo '<td>'.$value['redistribute_event'].'</td>';
		   echo '<td>'.$value['redistribute_d'].'</td>';
		   echo '<td>'.$value['ordered_event'].'</td>';
		   echo '<td>'.$value['ordered_d'].'</td>';
		   echo '<td>'.$value['decommissioned_event'].'</td>';
		   echo '<td>'.$value['decommissioned_d'].'</td>';
		   echo '<td>'.$value['date_event'].'</td>';
		   echo '<td>'.$value['date_event_d'].'</td></tr>';
       }
       echo '</tbody></table>';*/
       }
       
       
}