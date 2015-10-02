<?php //echo "<pre>"; print_r($commodity_list);echo "</pre>";exit;?>
<div class="container" style="width: 96%; margin: auto;">
 <table width="98%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
	<thead>
		<tr>
			<!-- <th>Category</th> -->
			<th>Commodity Name</th>
			<th>Commodity Code</th>
			<th>Unit Size</th>
			<th>Unit Cost(2014)</th>
			<th>Supplier</th>
		</tr>
	</thead>
	<tbody>
<?php 
    foreach($commodity_list as $commodity_list):
	
			echo "<tr>					
					<td>".$commodity_list['commodity_name']."</td>
					<td>".$commodity_list['commodity_code']."</td>
					<td>".$commodity_list['unit_size']."</td>
					<td>".$commodity_list['unit_cost']."</td>
					<td>".$commodity_list['commodity_source']."</td>
			      </tr>";
		
	endforeach;
 ?>
</tbody>
</table>  
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