<style>
	.row div p{
	padding:10px;
}
</style>
<div class="container" style="width: 96%; margin: auto;">
    
    <div class="row">
		<div class="col-md-6" style="text-transform: capitalize;"><p class="bg-info"><span class="">The Last Stock Update was as at : <?php
    echo date('j M, Y',strtotime($last_issued_data['last_seen'])). ", $last_issued_data[days_] day(s) ago, $last_issued_data[fname] 
    $last_issued_data[lname]" ?></span></p></div>
		
	</div>
	
    
	<?php
	if ($source == "KEMSA") {
	 echo form_open('orders/facility_order/1'); 
	}elseif ($source == "MEDS") {
	 echo form_open('orders/facility_order/2'); 
	}
	 ?>
 <table width="100%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
	<thead>
		<tr>
                        
                        <th>Commodity&nbsp;Name</th>
                        <th>Commodity&nbsp;Code</th>
                        <th>Unit&nbsp;Size</th>
                        <th>Opening&nbsp;Bal(Units)</th>
                        <th>Total&nbsp;Receipts(Units)</th>
                        <th>Total&nbsp;Issues(Units)</th>
                        <th>Adj(-ve)(Units)</th>
                        <th>Adj(+ve)(Units)</th>
                        <th>Losses(Units)</th>
                        <th>Closing Bal(Units)</th>
                        <th>Days Out Of Stock</th>   
                        
		</tr>
	</thead>
	<tbody>
<?php 

foreach ($facility_stock_data as $facility_stock_data) {
	foreach ($facility_stock_data->commodity_detail as $item) {
		$closing_stock=$facility_stock_data->closing_stock;
		foreach ($item->sub_category_data as $sub_category) {
	
}?>
	<tr>
		<td> <?php echo $item->commodity_name ; ?> </td>
		<td><?php echo $item->commodity_code ; ?></td>
		<td><?php echo $item->unit_size ; ?></td>
		<td><?php echo $facility_stock_data->opening_balance; ?></td>
		<td><?php echo $facility_stock_data->total_receipts; ?></td>
		<td><?php echo $facility_stock_data->total_issues; ?></td>
		<td><?php echo $facility_stock_data->adjustmentnve; ?></td>
		<td><?php echo $facility_stock_data->adjustmentpve; ?></td>
		<td><?php echo $facility_stock_data->losses; ?></td>
		
		<td><?php  echo $closing_stock; ?></td>
		<td><?php 
		      
								
								if ((int)$closing_stock <= 0) {
								      $date_mod = $facility_stock_data->date_modified;
									  
										  $now = time(); 
									      $my_date = strtotime($date_mod);
									       $datediff = $now - $my_date;
									     
										 echo '<label style="color:red;">'.floor($datediff/(60*60*24)).'</label>';
									
								} else{
									echo "0";
								}
		 ?>
		 </td>
		</tr>
	<?php		
}
}

    
 ?>
</tbody>
</table> 
<hr />
<div class="container-fluid">
<div style="float: right">
<?php
	if ($source == "KEMSA") {
	echo '<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-open"></span>Proceed to Order from KEMSA</button></div>';
	}elseif ($source == "MEDS") {
	echo '<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-open"></span>Proceed to Order from MEDS</button></div>';
	}
	 ?>
<?php echo form_close();?>
</div>
</div>
<script>
$(document).ready(function() {
	//datatables settings 
	$('#example').dataTable( {
		 "sDom": "T lfrtip",
	     "sScrollY": "377px",
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
	} );
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');
});
</script>