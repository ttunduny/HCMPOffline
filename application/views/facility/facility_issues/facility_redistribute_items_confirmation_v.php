 <div class="container" style="width: 96%; margin: auto;">
 <table width="98%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
	<thead>
		<tr>
			<th>Commodity Name</th>
			<th>Commodity Code</th>
			<th>Unit Size</th>
			<th>Supplier</th>
			<th>Batch No</th>
			<th>Expiry Date</th>
			<th>Manufacturer</th>
			<th>Quantity Sent(units)</th>
			<th>Quantity Sent(packs)</th>
			<th>Issue Type</th>
			<th>Quantity Received</th>
			<th>Total Units</th>
		</tr>
	</thead>
	<tbody>

</tbody>
</table>  
<hr />
<div class="container-fluid">
<div style="float: right">
<button class="btn btn-success" ><span class="glyphicon glyphicon-open"></span>Update</button></div>
</div>
</div>
  
<script>
$(function () {
	//datatables settings 
	$('#example').dataTable( {
		 "sDom": "T<'clear'>lfrtip",
	     "sDom": "<'row-fluid'<'span6'T><'span6'f>r>t<'row-fluid'<'span6'l><'span6'p>>",
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
		"sSwfPath": "<?php echo base_url(); ?>/assets/datatable/media/swf/copy_cvs_xls_pdf.swf"
		}
	} );
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');
});
</script>