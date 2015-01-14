<?php
/**
 * @author Collins
 * for the analysis for the global presentation
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Analysis extends MY_Controller 
{
	function __construct() 
	{
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}
	
	
	public function potential_expiries_analysis()
	{
		//Set the current year
		$year = date("Y");
		$county_total = array();
		$excel_data = array();
		$excel_data = array('doc_creator' =>"HCMP", 'doc_title' => $commodity_name['commodity_name'].' stock level report ', 'file_name' => 'stock level report');
		$row_data = array();
		$column_data = array("County","Sub-County","Facility Code", 
							"Facility Name","Commodity Name","Unit Size","Unit Cost(KES)",
							"Supplier","Manufacturer","Batch Number","Expiry Date",
							"Stock at Hand (units)","Stock at Hand (packs)","Total Cost");
		$excel_data['column_data'] = $column_data;
		//the commodities variable will hold the values for the three commodities ie ORS and Zinc
			
		$commodities = array(51,36,267);
		
		foreach($commodities as $commodity):
			$commodity_stock_level = array();
			//holds the data for the entire county
			//once it is done executing for one commodity it will reset to zero
			$commodity_total = array();
			
			//pick the commodity names and details
			//$commodity_name = Commodities::get_commodity_name($commodities);
			//get the stock level for that commodity
			$commodity_stock_level = Facility_stocks::get_commodity_stock_level($commodity);
			
			if($commodity == 51 ):
				//change the stock level for ORS 100 to match the one for 100 by dividing it by two
				//Start buliding the excel file
				foreach ($commodity_stock_level as $commodity_stock_level) :
					$commodity_name = "ORS sachet (for 500ml) low osmolality (50)";
					$commodity_stock_level_units = (($commodity_stock_level["balance_units"])/2);
					$commodity_stock_level_packs = ($commodity_stock_level_units/50);
					$commodity_cost = 204;
					$commodity_size = "50s";
					$commodity_total_cost = $commodity_cost*$commodity_stock_level_units;
		
					
					array_push($row_data, 
								array($commodity_stock_level["county"],
								$commodity_stock_level["subcounty"],
								$commodity_stock_level["facility_code"], 
								$commodity_stock_level["facility_name"],
								$commodity_name,
								$commodity_size,
								$commodity_cost,
								$commodity_stock_level["supplier"],
								$commodity_stock_level["manufacture"],
								$commodity_stock_level["batch_no"],
								$commodity_stock_level["expiry_date"],
								$commodity_stock_level_units,
								$commodity_stock_level_packs));
					
				endforeach;
				
			else:
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
			
			endif;
			
			
			
		endforeach;
		
		$excel_data['row_data'] = $row_data;
		$excel_data['report_type'] = "download_file";
		$excel_data['file_name'] = "Potential Expiries Report";
		$excel_data['excel_title'] = "Potential Expiries Report for Zinc sulphate Tablets  20mg and ORS sachet (for 500ml) low osmolality (100) & (50) as at ".date("jS F Y");
	
		$report_type = "ors_report";
		$this ->create_excel($excel_data,$report_type);
		
		//path for windows
		//$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
		//path for Mac
		$handler = "/Applications/XAMPP/xamppfiles/htdocs/hcmp/print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
	
		
			
	}
	
	//for the total orders generated
	public function orders()
	{
		$excel_data = array('doc_creator' => "HCMP", 'doc_title' => "$year $title Order Cost", 'file_name' => "$year $title Order Cost (KSH)");
		$row_data = array();
		$column_data = array("Date of Order Placement", "Date of Order Approval", "Total Order Cost (Ksh)", "Date of Delivery", "Lead Time (Order Placement to Delivery)", "Supplier", "Facility Name", "Facility Code", "Sub-County", "County");
		$excel_data['column_data'] = $column_data;
		//echo  ; exit;
		$facility_stock_data = Doctrine_Manager::getInstance() -> getCurrentConnection() -> 
		fetchAll("SELECT 
				    c.county,
				    d.district AS sub_county,
				    f.facility_name,
				    f.facility_code,
				    DATE_FORMAT(`order_date`, '%d %b %y') AS order_date,
				    DATE_FORMAT(`approval_date`, '%d %b %y') AS approval_date,
				    DATE_FORMAT(`deliver_date`, '%d %b %y') AS delivery_date,
				    DATEDIFF(`approval_date`, `order_date`) AS tat_order_approval,
				    DATEDIFF(`deliver_date`, `approval_date`) AS tat_approval_deliver,
				    DATEDIFF(`deliver_date`, `order_date`) AS tat_order_delivery,
				    SUM(o.`order_total`) AS total
				FROM
				    facility_orders o,
				    facilities f,
				    districts d,
				    counties c
				WHERE
				    f.facility_code = o.facility_code
				        AND f.district = d.id
				        AND c.id = d.county
				        AND YEAR(o.`order_date`) = 2014
				GROUP BY o.id
				ORDER BY c.county ASC , d.district ASC , f.facility_name ASC
				        ");
		//array_push($row_data, array("The orders below were placed $year $title"));
		foreach ($facility_stock_data as $facility_stock_data_item) :
			array_push($row_data, array($facility_stock_data_item["order_date"], $facility_stock_data_item["approval_date"], $facility_stock_data_item["total"], $facility_stock_data_item["delivery_date"], $facility_stock_data_item["tat_order_delivery"], "KEMSA", $facility_stock_data_item["facility_name"], $facility_stock_data_item["facility_code"], $facility_stock_data_item["sub_county"], $facility_stock_data_item["county"]));
		endforeach;
		$excel_data['row_data'] = $row_data;

		$this -> hcmp_functions -> create_excel($excel_data);
		
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
			//$objPHPExcel->getActiveSheet()->getStyle('K')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
			
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
			//$objWriter->save("./print_docs/excel/excel_files/".$excel_data['file_name'].'.xls');
			//For Mac
			$objWriter->save("/Applications/XAMPP/xamppfiles/htdocs/hcmp/print_docs/excel/excel_files/".$excel_data['file_name'].'.xls');
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
 

}