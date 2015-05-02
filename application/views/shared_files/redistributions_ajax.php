<?php if(isset($stats_data)){ echo $stats_data;}
echo $table; ?>
<script>
    $(document).ready(function() {
	//datatables settings 
	$('#delivered').dataTable( {
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
	} );
	$('#pending').dataTable( {
	   "sDom": "T lfrtip",
	     
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
	$('#districtstore').dataTable( {
	   "sDom": "T lfrtip",
	     
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
	$('.dataTables_filter label input').addClass('form-control');
	$('.dataTables_length label select').addClass('form-control');
});
</script>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Delivered
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      	<table id="delivered" class="row-fluid table table-hover table-bordered table-update">
      		<thead style="background-color: white">
							<tr style="">
								<th>From</th>
								<th>To </th>
								<th>Commodity Name</th>
								<th>Unit Size</th>
								<th>Batch No</th>
								<th>Expiry Date</th>
								<th>Manufacturer</th>
								<th>Quantity Sent (Pack(Units))</th>
								<th>Quantity Received (Pack(Units))</th>
								<th>Date Sent </th>
								<th>Date Received</th>

							</tr>
						</thead>
						<tbody>
							<?php 
							foreach ($donations as $key => $value) {
								//print_r( $value);
								if ($value['status'] == 1) {
									$total_units = $value['total_commodity_units'];
									$sent_units = $value['quantity_sent'];
									$received_units = $value['quantity_received'];
									$total_sent = round(($sent_units / $total_units), 1);
									$total_received = round(($received_units / $total_units), 1);
									$date_received = strtotime($value['date_received']) ? date('d M, Y', strtotime($value['date_received'])) : "N/A";
									?>
								<tr class="" style="">
								<td class="" ><?php echo $value['source_facility_name']; ?></td>
								<td class="" ><?php echo $value['receiver_facility_name']; ?></td>
								<td class="" ><?php echo $value['commodity_name']; ?></td>
								<td class="" ><?php echo $value['unit_size']; ?></td>
								<td class="" ><?php echo $value['batch_no']; ?></td>
								<td class="" ><?php echo date('d M, Y', strtotime($value['expiry_date'])); ?></td>
								<td class="" ><?php echo $value['manufacturer']; ?></td>
								<td class="" ><?php echo $total_sent."($sent_units)"; ?></td>
								<td class="" ><?php echo $total_received."($received_units)"; ?></td>
								<td class="" ><?php echo date('d M, Y', strtotime($value['date_sent'])); ?></td>
								<td class="" ><?php echo $date_received; ?></td>
								</tr>
									<?php
								} else {
									
								}
								
							}
							
							?>
							
							
						</tbody>
      	</table>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Pending
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
      	<table id="pending" class="table table-hover table-bordered table-update" style="width: 100%">
      		<thead style="background-color: white">
							<tr style="">
								<th>From</th>
								<th>To </th>
								<th>Commodity Name</th>
								<th>Unit Size</th>
								<th>Batch No</th>
								<th>Expiry Date</th>
								<th>Manufacturer</th>
								<th>Quantity Sent (Pack(Units))</th>
								<th>Quantity Received (Pack(Units))</th>
								<th>Date Sent </th>
								<th>Date Received</th>

							</tr>
						</thead>
						<tbody>
							<?php 
							foreach ($donations as $key => $values) {
								//print_r( $value);
								if ($values['status'] == 0 && $values['receiver_facility_name']!='') {
									$total_units = $values['total_commodity_units'];
									$sent_units = $values['quantity_sent'];
									$received_units = $values['quantity_received'];
									$total_sent = round(($sent_units / $total_units), 1);
									$total_received = round(($received_units / $total_units), 1);
									$date_received = strtotime($values['date_received']) ? date('d M, Y', strtotime($values['date_received'])) : "N/A";
									?>
								<tr class="" style="">
								<td class="" ><?php echo $values['source_facility_name']; ?></td>
								<td class="" ><?php echo $values['receiver_facility_name']; ?></td>
								<td class="" ><?php echo $values['commodity_name']; ?></td>
								<td class="" ><?php echo $values['unit_size']; ?></td>
								<td class="" ><?php echo $values['batch_no']; ?></td>
								<td class="" ><?php echo date('d M, Y', strtotime($values['expiry_date'])); ?></td>
								<td class="" ><?php echo $values['manufacturer']; ?></td>
								<td class="" ><?php echo $total_sent."($sent_units)"; ?></td>
								<td class="" ><?php echo $total_received."($received_units)"; ?></td>
								<td class="" ><?php echo date('d M, Y', strtotime($values['date_sent'])); ?></td>
								<td class="" ><?php echo $date_received; ?></td>
								</tr>
									<?php
								} else {?>
									
									
									
								<?php }
								
							}
							
							?>
							
							
						</tbody>
      	</table>
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          None HCMP Redistributions
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
      	<table id="districtstore" class="table table-hover table-bordered table-update" style="width: 100%">
      		<thead style="background-color: white">
							<tr style="">
								<th>From</th>
								<th>To </th>
								<th>Commodity Name</th>
								<th>Unit Size</th>
								<th>Batch No</th>
								<th>Expiry Date</th>
								<th>Manufacturer</th>
								<th>Quantity Sent (Pack(Units))</th>
								<th>Quantity Received (Pack(Units))</th>
								<th>Date Sent </th>
								<th>Date Received</th>

							</tr>
						</thead>
						<tbody>
							<?php 
							foreach ($donations as $key => $val) {
								//print_r( $value);
								if ($val['status'] == 0 && $val['receiver_facility_name']=='') {
									$total_units = $val['total_commodity_units'];
									$sent_units = $val['quantity_sent'];
									$received_units = $val['quantity_received'];
									$total_sent = round(($sent_units / $total_units), 1);
									$total_received = round(($received_units / $total_units), 1);
									$date_received = strtotime($val['date_received']) ? date('d M, Y', strtotime($val['date_received'])) : "N/A";
									?>
								<tr class="" style="">
								<td class="" ><?php echo $val['source_facility_name']; ?></td>
								<td class="" >District Store</td>
								<td class="" ><?php echo $val['commodity_name']; ?></td>
								<td class="" ><?php echo $val['unit_size']; ?></td>
								<td class="" ><?php echo $val['batch_no']; ?></td>
								<td class="" ><?php echo date('d M, Y', strtotime($val['expiry_date'])); ?></td>
								<td class="" ><?php echo $val['manufacturer']; ?></td>
								<td class="" ><?php echo $total_sent."($sent_units)"; ?></td>
								<td class="" ><?php echo $total_received."($received_units)"; ?></td>
								<td class="" ><?php echo date('d M, Y', strtotime($val['date_sent'])); ?></td>
								<td class="" ><?php echo $date_received; ?></td>
								</tr>
									<?php
								} else {?>
									
									
									
								<?php }
								
							}
							
							?>
							
							
						</tbody>
      	</table>
      </div>
    </div>
  </div>
  
</div>