<?php
/**
 * @author MKM
 *
 */
ob_start();
class Auto_email extends MY_Controller {
	var $test_mode = true;
	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url', 'file', 'download'));
		$this -> load -> library(array('hcmp_functions', 'form_validation', 'email', 'mpdf/mpdf'));

	}

	/*
	 |--------------------------------------------------------------------------|
	 | EMAIL	SECTION																|
	 |--------------------------------------------------------------------------|
	 */
	 
	 public function log_summary_national() {
		$time = date('M , d Y', mktime());
		$data = $q = Doctrine_Manager::getInstance() -> getCurrentConnection() 
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

		$mfl = array();

		foreach ($data as $key) {

			$mfl[] = $key['facility_code'];

		}
		$unique_mfl = array_values(array_unique($mfl));
		$temp = array();
		foreach ($unique_mfl as $key) {

			array_push($temp, array('facility_code' => $key, 'facility_name' => '', 'county' => '', 'district' => '', 'issued' => '', 'issue_event' => 0, 'issue_d' => 0, 'login_event' => 0, 'ordered' => 0, 'ordered_d' => 0, 'ordered_event' => '', 'redistribute' => '', 'redistribute_event' => '', 'redistribute_d' => 0, 'decommissioned' => '', 'decommissioned_event' => '', 'decommissioned_d' => 0, 'receive_event' => '', 'receive_event_d' => 0, 'date_event' => '', 'date_event_d' => 0));

		}
		$multi_dimenetional = array();
		foreach ($data as $row) {
			$multi_dimenetional[$row['facility_name']][] = array('facility_name' => $row['facility_name'], 'facility_code' => $row['facility_code'], 'county' => $row['county'], 'district' => $row['district'], 'issued' => $row['issued'], 'issue_event' => ($row['issue_event']), 'issue_d' => $row['issue_d'], 'login_event' => $row['login_only'], 'ordered' => $row['ordered'], 'ordered_d' => $row['ordered_d'], 'ordered_event' => $row['ordered_event'], 'redistribute' => $row['redistribute'], 'redistribute_event' => $row['redistribute_event'], 'redistribute_d' => $row['redistribute_d'], 'decommissioned' => $row['decommissioned'], 'decommissioned_event' => $row['decommissioned_event'], 'decommissioned_d' => $row['decommissioned_d'], 'receive_event' => $row['receive_event'], 'receive_event_d' => $row['receive_event_d'], 'date_event' => $row['date_event'], 'date_event_d' => $row['date_event_d']);
		}
		$clean_array = array_values($multi_dimenetional);

		$new = call_user_func_array('array_merge_recursive', $multi_dimenetional);

		$temp2 = array();
		foreach ($clean_array as $key => $value) {
			//echo count($value).'<br>';
			$issue_event = array();
			$issue_days = array();
			$login_event = array();
			$ordered = array();
			$ordered_days = array();
			$ordered_event = array();
			$redistribute_days = array();
			$redistribute_event = array();
			$decommission = array();
			$decommission_event = array();
			$decommission_days = array();

			$receive_event = array();
			$receive_days = array();
			$last_event = array();
			$lastseen_days = array();
			foreach ($value as $key_child => $value_child) {

				foreach ($temp as $newkey => $newvalue) {
					if ($newvalue['facility_code'] == $value_child['facility_code']) {
						$facility_name = $value_child['facility_name'];
						$facility_code = $value_child['facility_code'];
						$county = $value_child['county'];
						$district = $value_child['district'];

						$login_event[] = $value_child['login_only'];
						$ordered[] = $value_child['ordered'];

						$issue_event[] = $value_child['issue_event'];
						$issue_days[] = $value_child['issue_d'];

						$ordered_days[] = $value_child['ordered_d'];
						$ordered_event[] = $value_child['ordered_event'];
						$redistribute_days[] = $value_child['redistribute_d'];
						$redistribute_event[] = $value_child['redistribute_event'];
						$decommission[] = $value_child['decommissioned'];
						$decommission_event[] = $value_child['decommissioned_event'];

						$decommission_days[] = $value_child['decommissioned_d'];
						$receive_event[] = $value_child['receive_event'];
						$receive_days[] = $value_child['receive_event_d'];
						$last_event[] = $value_child['date_event'];
						$lastseen_days[] = $value_child['date_event_d'];

					}

				}
			}
			array_push($temp2, array('facility_code' => $facility_code, 'facility_name' => $facility_name, 'county' => $county, 'district' => $district, 'issued' => '', 'issue_event' => max($issue_event), 'issue_d' => min(array_filter($issue_days)), 'login_event' => max($login_event), 'ordered' => 0, 'ordered_d' => min(array_filter($ordered_days)), 'ordered_event' => max($ordered_event), 'redistribute' => '', 'redistribute_event' => max($redistribute_event), 'redistribute_d' => min(array_filter($redistribute_days)), 'decommissioned' => '', 'decommissioned_event' => max($decommission_event), 'decommissioned_d' => min(array_filter($decommission_days)), 'receive_event' => max($receive_event), 'receive_event_d' => min(array_filter($receive_days)), 'date_event' => max($last_event), 'date_event_d' => min($lastseen_days)));
		}

		$excel_data = array('doc_creator' => 'HCMP-Kenya', 'doc_title' => 'HCMP_Facility_Activity_Log_Summary ', 'file_name' => 'HCMP_Facility_Activity_Log_Summary ');
		$row_data = array();
		$column_data = array("Facility Name", "Facility Code", "County", "Sub-County", "Date Last Issued", "Days from last issue", "Date Last Redistributed", "Days From last Redistributed", "Date Last ordered", "Days From Last order", "Date Last Decommissioned", "Days From Last Decommissioned", "Date From Last Received Order", "Days From Last Received Order", "Date Last Seen", "Days From Last Seen");
		$excel_data['column_data'] = $column_data;
		foreach ($temp2 as $key => $value) :
			array_push($row_data, array($value['facility_name'], $value['facility_code'], $value['county'], $value['district'], (date('m-d-Y', strtotime($value['issue_event'])) == '01-01-1970') ? '' : date('m-d-Y', strtotime($value['issue_event'])), ($value['issue_d'] == 0) ? '' : $value['issue_d'], (date('m-d-Y', strtotime($value['redistribute_event'])) == '01-01-1970') ? '' : date('m-d-Y', strtotime($value['redistribute_event'])), ($value['redistribute_d'] == '') ? '' : $value['redistribute_d'], (date('m-d-Y', strtotime($value['ordered_event'])) == '01-01-1970') ? '' : date('m-d-Y', strtotime($value['ordered_event'])), ($value['ordered_d'] == '') ? '' : $value['ordered_d'], (date('m-d-Y', strtotime($value['decommissioned_event'])) == '01-01-1970') ? '' : date('m-d-Y', strtotime($value['decommissioned_event'])), ($value['decommissioned_d'] == '') ? '' : $value['decommissioned_d'], (date('m-d-Y', strtotime($value['receive_event'])) == '01-01-1970') ? '' : date('m-d-Y', strtotime($value['receive_event'])), ($value['receive_event_d'] == '') ? '' : $value['receive_event_d'], (date('m-d-Y', strtotime($value['date_event'])) == '01-01-1970') ? '' : date('m-d-Y', strtotime($value['date_event'])), ($value['date_event_d'] == '') ? '' : $value['date_event_d']));
		endforeach;
		$excel_data['row_data'] = $row_data;
		$excel_data['report_type'] = 'Log Summary';
		$time = date('m-d-Y', date());
		$this -> hcmp_functions -> create_excel($excel_data);

		$message = '';
		$message .= "<style> table {
    border-collapse: collapse; 
}td,th{
	padding: 12px;
	text-align:center;
}
*{margin:0;padding:0}*{font-family:'Helvetica Neue',Helvetica,Helvetica,Arial,sans-serif}img{max-width:100%}.collapse{padding:0}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100%!important;height:100%}a{color:#2BA6CB}.btn{text-decoration:none;color:#FFF;background-color:#666;padding:10px 16px;font-weight:700;margin-right:10px;text-align:center;cursor:pointer;display:inline-block}p.callout{padding:15px;background-color:#ECF8FF;margin-bottom:15px}.callout a{font-weight:700;color:#2BA6CB}table.social{background-color:#ebebeb}.social .soc-btn{padding:3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:700;display:block;text-align:center}a.fb{background-color:#3B5998!important}a.tw{background-color:#1daced!important}a.gp{background-color:#DB4A39!important}a.ms{background-color:#000!important}.sidebar .soc-btn{display:block;width:100%}table.head-wrap{width:100%}.header.container table td.logo{padding:15px}.header.container table td.label{padding:15px 15px 15px 0}table.body-wrap{width:100%}table.footer-wrap{width:100%;clear:both!important}.footer-wrap .container td.content p{border-top:1px solid #d7d7d7;padding-top:15px;font-size:9px;font-weight:500}h1,h2,h3,h4,h5,h6{font-family:HelveticaNeue-Light,'Helvetica Neue Light','Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;line-height:1.1;margin-bottom:15px;color:#000}h1 small,h2 small,h3 small,h4 small,h5 small,h6 small{font-size:60%;color:#6f6f6f;line-height:0;text-transform:none}h1{font-weight:200;font-size:44px}h2{font-weight:200;font-size:37px}h3{font-weight:500;font-size:27px}h4{font-weight:500;font-size:23px}h5{font-weight:900;font-size:17px}h6{font-weight:900;font-size:14px;text-transform:uppercase;color:#444}.collapse{margin:0!important}p,ul{margin-bottom:10px;font-weight:400;font-size:14px;line-height:1.6}p.lead{font-size:17px}p.last{margin-bottom:0}ul li{margin-left:5px;list-style-position:inside}ul.sidebar{background:#ebebeb;display:block;list-style-type:none}ul.sidebar li{display:block;margin:0}ul.sidebar li a{text-decoration:none;color:#666;padding:10px 16px;cursor:pointer;border-bottom:1px solid #777;border-top:1px solid #FFF;display:block;margin:0}ul.sidebar li a.last{border-bottom-width:0}ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p{margin-bottom:0!important}.container{display:block!important;max-width:100%!important;margin:0 auto!important;clear:both!important}.content{padding:15px;max-width:80%px;margin:0 auto;display:block}.content table{width:100%}.column{width:300px;float:left}.column tr td{padding:15px}.column-wrap{padding:0!important;margin:0 auto;max-width:600px!important}.column table{width:100%}.social .column{width:280px;min-width:279px;float:left}.clear{display:block;clear:both}@media only screen and (max-width:600px){a[class=btn]{display:block!important;margin-bottom:10px!important;background-image:none!important;margin-right:0!important}div[class=column]{width:auto!important;float:none!important}table.social div[class=column]{width:auto!important}}</style>";
		$message .= '
		<tr>
		<td colspan="12">
		</tr>
		</tbody>
		</table>';
		$message .= "<!-- BODY -->
<table class='body-wrap'>
	<tr>
		<td></td>
		<td class='container' bgcolor='#FFFFFF'>
			<div class='content'>
			<table>
				<tr>
					<td>
						
						<p class='lead'>Find attached a summary of Facility Activity Log, as at $time</p>
						
						<table class='social' width='100%'>
							<tr>
								<td>
									
									<!-- column 1 -->
									<table align='left' class='column'>
										
									</table><!-- /column 1 -->	
									
									<!-- column 2 -->
									<table align='left' class='column'>
										<tr>
											
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

		$email_address = 'kelvinmwas@gmail.com,smutheu@clintonhealthaccess.org,smutheu@gmail.com,collinsojenge@gmail.com,tngugi@clintonhealthaccess.org,hcmptech@googlegroups.com
		';
		$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);

	}

	public function log_summary_sub_county(){
			
		
	}
	
	public function log_summary_county(){
			
		
	}
	 
}
	