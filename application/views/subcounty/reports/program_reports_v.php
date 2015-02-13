<style type="text/css">
	.well{
		background-color: white;
	}

	.page-header{
		border:none;
	}
</style>
<?php   $identifier = $this -> session -> userdata('user_indicator');
		$countyname = $this -> session -> userdata('county_name');
		// $malaria_report_data='';
		$RH_report_details='';
		$TB_report_details='';
		$link_new_report_malaria = base_url('divisional_reports/malaria_report');
		$link_TB = base_url('divisional_reports/tb_report');
		$link_new_report_RH = base_url('divisional_reports/RH_report');
		
	foreach($malaria as $malaria_details1):
		foreach($malaria_details1 as $malaria_details):
			$facilityname = Facilities::get_facility_name2($malaria_details['facility_code']);
			$facility = $facilityname['facility_name'];
			$user = Users::get_user_names($malaria_details['user']);
			$username = $user[0]['fname']." ".$user[0]['lname'];
			$report_date = $malaria_details['report_date'];
			//Dowwnload links
			$link = base_url('reports/get_facility_report_pdf/'.$malaria_details['report_id'].'/'.$malaria_details['facility_code'].'/malaria');	
			$link_excel = base_url('reports/create_excel_facility_program_report/'.$malaria_details['report_id'].'/'.$malaria_details['facility_code'].'/malaria');
		    
		    /*$malaria_report_data .= <<<HTML_DATA
           <tr>           
				<td>$facility</td>          
 				<td>$username</td>
           		<td>$report_date</td>
           		<td colspan = '2'>
           			<a href='$link' target="_blank">
		           	<button  type="button" class="btn btn-xs btn-primary">
		           	<span class="glyphicon glyphicon-save"></span>Download Report pdf</button></a>

		           	<a href='$link_excel' target="_blank">
           			<button  type="button" class="btn btn-xs btn-primary">
           			<span class="glyphicon glyphicon-save"></span>Download Report excel</button></a> 
		           	
           		</td>
           </tr>
           
HTML_DATA;*/
//echo $link;
			endforeach;	
			endforeach;	
			
			foreach($RH as $RH_details1):
				foreach($RH_details1 as $RH_details):
					
			$facilityname = Facilities::get_facility_name2($RH_details['facility_code']);
			$facility = $facilityname['facility_name'];
			
			$user = Users::get_user_names($RH_details['user']);
			$username = $user[0]['fname']." ".$user[0]['lname'];
			$report_date = $RH_details['report_date'];
			$link = base_url('reports/get_facility_report_pdf/'.$RH_details['report_id'].'/'.$RH_details['facility_code'].'/RH');	
			$link_excel = base_url('reports/create_excel_facility_program_report/'.$RH_details['report_id'].'/'.$RH_details['facility_code'].'/RH');
		    
		    
		    $RH_report_details .= <<<HTML_DATA
            <tr>           
				<td>$facility</td>          
 				<td>$username</td>
           		<td>$report_date</td>
           		<td colspan = '2'>
           			<a href='$link' target="_blank">
		           	<button  type="button" class="btn btn-xs btn-primary">
		           	<span class="glyphicon glyphicon-save"></span>Download Report pdf</button></a>
		           	<a href='$link_excel' target="_blank">
           			<button  type="button" class="btn btn-xs btn-primary">
           			<span class="glyphicon glyphicon-save"></span>Download Report excel</button></a>
		           
           		</td>
           </tr>
HTML_DATA;
			endforeach;
			endforeach;
		foreach($TB as $TB_details1):
			foreach($TB_details1 as $TB_details):
				$facilityname = Facilities::get_facility_name2($TB_details['facility_code']);
				$facility = $facilityname['facility_name'];
				$user = Users::get_user_names($TB_details['user']);
				$username = $user[0]['fname']." ".$user[0]['lname'];
				$report_date = $TB_details['report_date'];
				$link = base_url('reports/get_facility_report_pdf/'.$TB_details['report_id'].'/'.$TB_details['facility_code'].'/TB');	
				$link_excel = base_url('reports/create_excel_facility_program_report/'.$TB_details['report_id'].'/'.$TB_details['facility_code'].'/TB');

			    
			    $TB_report_details .= <<<HTML_DATA
	            <tr>           
					<td>$facility</td>          
	 				<td>$username</td>
	           		<td>$report_date</td>
	           		<td colspan = '2'>

           			<a href='$link' target="_blank">
		           	<button  type="button" class="btn btn-xs btn-primary">
		           	<span class="glyphicon glyphicon-save"></span>Download Report pdf</button></a>
		           	<a href='$link_excel' target="_blank">
           			<button  type="button" class="btn btn-xs btn-primary">

           			<span class="glyphicon glyphicon-save"></span>Download Report excel</button></a>
		            
           		</td>
           </tr>
HTML_DATA;
			 endforeach;
			endforeach;
		?>
<h1 class="page-header" style="margin: 0;font-size: 1.6em;"><?php echo $page_header; ?></h1>
<div class="row container" style="width: 100%; margin: auto; background-color: white;">
<div class="" style="background-color: white;">
	<ul class='nav nav-tabs'>
      <li class="active"><a href="#Malaria" data-toggle="tab">Malaria</a></li>
      <li class=""><a href="#RH" data-toggle="tab">Reproductive Health</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
 		<div  id="Malaria" class="tab-pane fade active in">
	        <table width="100%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="test1">
			<thead>				
				<tr>
					<?php $user_indicator = $this -> session -> userdata('user_indicator');

						switch ($user_indicator) {
							case facility_admin:
							case facility:
					?>
						<th>Drug Name</th>
						<th>Order Unit Size</th>
						<th>Order Unit Cost (Ksh)</th>
						<th>Opening Balance (Units)</th>
						<th>Total Receipts (Units)</th>
					    <th>Total issues (Units)</th>
					    <th>Adjustments(-ve) (Units)</th>
					    <th>Adjustments(+ve) (Units)</th>
					    <th>Losses (Units)</th>
					    <th>No days out of stock</th>
					    <th>Closing Stock(Units)</th>
					<?php break;
					default: ?>
						<th>Facility Name</th>
						<th>MFL Code</th>
						<th>Prepared By</th>
						<th>Action</th>
					<?php 
					break; } ?>
				</tr>
				
			</thead>
			<tbody>
				<?php 
				
				echo $mal_report_data; 
					
				?>
				
			</tbody>
			
			</table> 
						
		    
      </div>
     <div class="tab-pane fade" id="RH">
        <table cellpadding="0" cellspacing="0" width="100%" border="0" class="row-fluid table table-bordered"  id="test2">
		<thead>
			<tr>
				<th>Facility Name</th>
				<th>MFL Code</th>
				<th>Prepared By</th>
				<th>Action</th>			
			</tr>
		</thead>
		<tbody>
			<?php 
			
			echo $RH_report_details; 
			
			?>

		</tbody>
		</table> 

		
		           	
      </div>
    </div>
 	</div>
  </div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#test1').dataTable({
			"sDom": "T lfrtip",
	     "sScrollY": "310px",
	     "sScrollX": "100%",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
			      "oTableTools": {
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],

			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
		}
		});
		$('#test2').dataTable({
			"sDom": "T lfrtip",
	     "sScrollY": "310px",
	     "sScrollX": "100%",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
			      "oTableTools": {
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],

			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
		}
		});
	});
</script>
