<?php
/**
 * @author Kariuki
 */
class Hcmp_functions extends MY_Controller {
	
	var $test_mode=true;
	
		function __construct() {
		parent::__construct();
		$this -> load -> helper(array('url','file'));
		$this -> load -> library(array('phpexcel/phpexcel','mpdf/mpdf'));
	}

	
public function send_stock_update_sms(){
       $facility_name = $this -> session -> userdata('full_name');
	   $facility_code=$this -> session -> userdata('news');
	   $data=User::getUsers($facility_code)->toArray();

	   $message= "Stock level for ".$facility_name." have been updated. HCMP";
       
	   $phone=$this->get_facility_phone_numbers($facility_code);
	   $phone .=$this->get_ddp_phone_numbers($data[0]['district']);

	   
	   $this->send_sms(substr($phone,0,-1),$message);

	}

public function send_order_sms(){
	

       $facility_name = $this -> session -> userdata('full_name');
	   $facility_code=$this -> session -> userdata('news');
	   $data=User::getUsers($facility_code)->toArray();

	   $message= $facility_name." has submitted an order. HCMP";
       
	   $phone=$this->get_facility_phone_numbers($facility_code);
	   $phone .=$this->get_ddp_phone_numbers($data[0]['district']);

	   
	   $this->send_sms(substr($phone,0,-1),$message);

	}
public function send_order_approval_sms($facility_code,$status){

	  
       
       $message=($status==1)?$facility_name." order has been rejected. HCMP":
       $facility_name." order has been approved. HCMP";
 
        $data=User::getUsers($facility_code)->toArray();
	   $phone=$this->get_facility_phone_numbers($facility_code);
	   $phone .=$this->get_ddp_phone_numbers($data[0]['district']);

	   
	   $this->send_sms(substr($phone,0,-1),$message);

	}

public function send_stock_decommission_email($message,$subject,$attach_file){
	
	   $facility_code=$this -> session -> userdata('news');
	   
	   $data=User::getUsers($facility_code)->toArray();
	   
	   $email_address=$this->get_facility_email($facility_code);
	   
	   $email_address .=$this->get_ddp_email($data[0]['district']);

	   
	   $this->send_email(substr($email_address,0,-1),$message,$subject,$attach_file);
	   
	 
	}
public function get_facility_phone_numbers($facility_code){
	$data=User::get_user_info($facility_code);
	$phone=""; 
	foreach ($data as $info) {

			$telephone =preg_replace('(^0+)', "254",$info->telephone);

		    $phone .=$telephone.'+';	
		}
	return $phone;
}
public function get_facility_email($facility_code){
	$data=User::get_user_info($facility_code);
	$user_email=""; 
	foreach ($data as $info) {

			$user_email .=$info->email.',';

		   	
		}
	return $user_email;
}

public function get_ddp_phone_numbers($district_id){
	$data=User::get_dpp_details($district_id);
	$phone=""; 
	
	foreach ($data as $info) {
			$telephone =preg_replace('(^0+)', "254",$info->telephone);
		    $phone .=$telephone.'+';	
		}
	return $phone;
}
public function get_ddp_email($district_id){
	$data=User::get_dpp_details($district_id);
	$user_email=""; 
	foreach ($data as $info) {

			$user_email .=$info->email.',';
		}
	return $user_email;
}
public function send_stock_donate_sms(){
		
       $facility_name = $this -> session -> userdata('full_name');
	   $facility_code=$this -> session -> userdata('news');
	   $data=User::getUsers($facility_code)->toArray();

	   //$message= "Stock level for ".$facility_name." has been updated. HCMP";
       
	   $phone=$this->get_facility_phone_numbers($facility_code);
	   $phone .=$this->get_ddp_phone_numbers($data[0]['district']);
	    $message= $facility_name." have been donated commodities. HCMP";		
		$this->send_sms(substr($phone,0,-1),$message);
		
		

	}


public function send_sms($phones,$message) {
	
   $message=urlencode($message);
   //$spam_sms='254726534272+254720167245';	
   $spam_sms='254720167245+254726534272+254726416795+254725227833+'.$phones;
//  $spam_sms='254726534272';
 	# code...
 	
 	$phone_numbers=explode("+", $spam_sms);
	
	//foreach($phone_numbers as $key=>$user_no):
  //  break;
	//file("http://41.57.109.242:13000/cgi-bin/sendsms?username=clinton&password=ch41sms&to=$user_no&text=$message");
		
	//endforeach;
 		
	}
public function send_order_submission_email($message,$subject,$attach_file){
	 
      $cc_email=($this->test_mode)?'kariukijackson@gmail.com': 'anganga.pmo@gmail.com,sochola06@yahoo.com';
	 
		
	   $facility_code=$this -> session -> userdata('news');
	   
	   $data=User::getUsers($facility_code)->toArray();
	   
	   $email_address=$this->get_facility_email($facility_code);
	   
	   $email_address .=$this->get_ddp_email($data[0]['district']);
		
		
		return $this->send_email(substr($email_address,0,-1),$message, $subject,$attach_file,null,$cc_email);
	
}
public function send_order_approval_email($message,$subject,$attach_file,$facility_code,$reject_order=null){
	  
 $cc_email=($this->test_mode)?'kariukijackson@gmail.com': 'anganga.pmo@gmail.com,sochola06@yahoo.com';
	   
	  
 $data=User::getUsers($facility_code)->toArray();
  if($reject_order==1):
	  $email_address=$this->get_facility_email($facility_code);
	  $cc_email .=$this->get_ddp_email($data[0]['district']);
	  
	  else:
		  
		  $email_address=($this->test_mode)?'kariukijackson@gmail.com': 'shamim.kuppuswamy@kemsa.co.ke,
samuel.wataku@kemsa.co.ke,
jmunyu@kemsa.co.ke,
imugada@kemsa.co.ke,
laban.okune@kemsa.co.ke,
samuel.wataku@kemsa.co.ke,'; 

	  $cc_email .=$this->get_ddp_email($data[0]['district']);
	   $cc_email .=$this->get_facility_email($facility_code); 
  endif;
	  

		return $this->send_email(substr($email_address,0,-1),$message, $subject,$attach_file,null,substr($cc_email,0,-1));
	
}
public function send_order_delivery_email($message,$subject,$attach_file=null){

$cc_email=($this->test_mode)?'kariukijackson@gmail.com': 'anganga.pmo@gmail.com,sochola06@yahoo.com';

	   $facility_code=$this -> session -> userdata('news');
	   
	   $data=User::getUsers($facility_code)->toArray();
	   
	   $cc_email .=$this->get_facility_email($facility_code);
	   
		
		
	return $this->send_email(substr($this->get_ddp_email($data[0]['district']),0,-1),$message,$subject,null,null,substr($cc_email,0,-1));
	
}
/*****************************************Email function for HCMP, all the deafult email addresses and email content have been set ***************/

public function send_email($email_address,$message,$subject,$attach_file=NULL,$bcc_email=NULL,$cc_email=NULL){
  
		$mail_list=($this->test_mode)?'kariukijackson@gmail.com,kariukijackson@ymail.com': ',
  		kariukijackson@gmail.com,
  		kelvinmwas@gmail.com,';
			
		$fromm='hcmpkenya@gmail.com';
		$messages=$message;
  		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'hcmpkenya@gmail.com';
        $config['smtp_pass']    = 'healthkenya';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not  
		$this->load->library('email', $config);

        $this->email->initialize($config);
		
  		$this->email->set_newline("\r\n");
  		$this->email->from($fromm,'Health Commodities Management Platform'); // change it to yours
  		$this->email->to($email_address); // change it to yours
  		
  		isset($cc_email)? $this->email->cc($cc_email): //
  		
  		(isset($bcc_email))?
  		$this->email->bcc($mail_list.$bcc_email)
  		
  		:
  		$this->email->bcc(substr($mail_list,0,-1))

		;
  		
		 (isset($attach_file))? $this->email->attach($attach_file) :	'';
			
  		$this->email->subject($subject);
 		$this->email->message($messages);
 
  if($this->email->send())
 {
return TRUE;
 }
 else
{
 return FALSE;

 
}

}
/**************************************** creating excel sheet for the system *************************/
	public function create_excel($excel_data=NUll) {
		
 //check if the excel data has been set if not exit the excel generation    
     
if(count($excel_data)>0):
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel -> getProperties() -> setCreator("HCMP");
		$objPHPExcel -> getProperties() -> setLastModifiedBy($excel_data['doc_creator']);
		$objPHPExcel -> getProperties() -> setTitle($excel_data['doc_title']);
		$objPHPExcel -> getProperties() -> setSubject($excel_data['doc_title']);
		$objPHPExcel -> getProperties() -> setDescription("");

		$objPHPExcel -> setActiveSheetIndex(0);

		$rowExec = 1;

		//Looping through the cells
		$column = 0;

		foreach ($excel_data['column_data'] as $column_data) {
			$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $column_data);
			$objPHPExcel -> getActiveSheet() -> getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($column)) -> setAutoSize(true);
			//$objPHPExcel->getActiveSheet()->getStyle($column, $rowExec)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($column, $rowExec)->getFont()->setBold(true);
			$column++;
		}		
		$rowExec = 2;
				
		foreach ($excel_data['row_data'] as $row_data) {
		$column = 0;
        foreach($row_data as $cell){
         //Looping through the cells per facility
		$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $cell);
				
		$column++;	
         }
        $rowExec++;
		}

		//	echo date('H:i:s') . " Rename sheet\n";
		$objPHPExcel -> getActiveSheet() -> setTitle('Simple');

		// Save Excel 2007 file
		//echo date('H:i:s') . " Write to Excel2007 format\n";
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

		// We'll be outputting an excel file
		header('Content-type: application/vnd.ms-excel');

		// It will be called file.xls
		header("Content-Disposition: attachment; filename=".$excel_data['file_name'].".xls");

		// Write file to the browser
		$objWriter -> save('php://output');
		// Echo done
endif;
}
/*************/	
/* HCMP PDF creator
/********/	

public function create_pdf($pdf_data=NULL){

if(count($pdf_data)>0):	
$url=base_url().'assets/img/coat_of_arms.png';
$html_title="<div align=center><img src='$url' height='70' width='70'style='vertical-align: top;'> </img></div>
<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>$pdf_data[pdf_title]</div>
<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
Ministry of Health</div>
<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>
Health Commodities Management Platform</div><hr/>";

$table_style='<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: 	#FFF380;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
</style>';
            $name=$this -> session -> userdata('fname');
	        $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
            $this->mpdf->WriteHTML($html_title);
            $this->mpdf->defaultheaderline = 1;  
            $this->mpdf->simpleTables = true;
            $this->mpdf->WriteHTML($table_style.$pdf_data['pdf_html_body']);
			$this->mpdf->SetHTMLFooter("<div style='width:100%'>
			<div style='float:right; width: 30%;'>created by:$name|source: HCMP</div>
			<div style='float:right; width:60%'>{PAGENO} / {nb}</div></div>");
			
	if($pdf_data['pdf_view_option']=='save_file'):
		 //change the pdf to a binary file then use codeigniter write function to write the file as pdf in a specific folder 
		 
		 // $this->mpdf->Output(realpath($path).'arif.pdf','F'); 
		    if(write_file( './pdf/'.$pdf_data['file_name'].'.pdf',$this->mpdf->Output($pdf_data['file_name'],'S'))):return true; else: return false; endif;
	        else:
			//show the pdf on the bowser let the user determine where to save it;
	        $this->mpdf->Output($pdf_data['file_name'],'I');
			exit;
	endif;		

	
endif;
}
/****************************END************************/
 //// /////HCMP Create high chart graph
  public function create_high_chart_graph($graph_data=null){
  	$high_chart='';
  	if(isset($graph_data)):
		$graph_id=$graph_data['graph_id'];
		$graph_title=$graph_data['graph_title'];
		$graph_type=$graph_data['graph_type'];
		$graph_categories=json_encode($graph_data['graph_categories']);
		//echo json_encode($graph_data['graph_categories']);
		$graph_yaxis_title=$graph_data['graph_yaxis_title'];
		$graph_series_data=$graph_data['series_data'];
		//set up the graph here
		$high_chart .="
		$('#$graph_id').highcharts({
		    chart: { zoomType:'x', type: '$graph_type' },
            credits: { enabled:false},
            title: {text: '$graph_title'},
            yAxis: { min: 0, title: {text: '$graph_yaxis_title' }},
            xAxis: { categories: $graph_categories },
            tooltip: { crosshairs: [true,true] },
            series: [";			 
		    foreach($graph_series_data as $key=>$raw_data):
					$temp_array=array();
					$high_chart .="{ name: '$key', data:";					 
					  foreach($raw_data as $key_data):
						$temp_array=array_merge($temp_array,array((int)$key_data));
						endforeach;
					  $high_chart .= json_encode($temp_array)."},";				  
				   endforeach;
	     $high_chart .="]  })";

	endif;
	return $high_chart; 	
  }
/****************************END************************/
}
