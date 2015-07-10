<div class="container" style="width: 96%; margin: auto;">
 <table width="98%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
	<thead>
		<tr>
			<th>Sub County</th>
			<th>MFL</th>
			<th>Facility Name</th>
			<th>Owner</th>
			<th>Type</th>
			<th>Date of Activation</th>
			

		</tr>
	</thead>
	<tbody>
<?php 
    foreach($facility_list as $facilities):
    	$activation_date = ($facilities['date_of_activation']!=0) ? date('j M, Y', strtotime($facilities['date_of_activation'])) : "Inactive";
    	$telephone = ($facilities['cellphone']>0) ? "+254".$facilities['cellphone'] : "No Data Available";
		$contactperson = ($facilities['contactperson']!=null) ? $facilities['contactperson'] : "No Data Available";
			echo  "<tr>
						<td>".$facilities['district']."</td>
						<td>".$facilities['facility_code']."</td>
						<td>".$facilities['facility_name']."</td>
						<td>".$facilities['owner']."</td>
						<td>".$facilities['type']."</td>
						<td>".$activation_date."</td>
						
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