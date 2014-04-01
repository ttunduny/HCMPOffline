<div class="row container" style="width: 95%; margin: auto;">
<div class="col-md-2" style="border: 1px solid #DDD;">
<div class="table-responsive" style="height:100%; overflow-y: auto;">
<span class='label label-info'>Orders Summary</span>
<table  class="table table-hover table-bordered">
<thead style="background-color: white">
<tr><th>Service Point Name</th><th>Action</th></tr>
</thead>
<tbody>

</tbody>
</table>
</div>
 </div>
<div class="col-md-10" style="border: 1px solid #DDD;">
	<ul id="myTab" class="nav nav-tabs">
      <li class=""><a href="#Rejected" data-toggle="tab">Rejected Orders</a></li>
      <li class=""><a href="#Approval" data-toggle="tab">Pending Approval</a></li>
      <li class=""><a href="#Delivery" data-toggle="tab">Pending Delivery</a></li>
      <li class=""><a href="#Delivered" data-toggle="tab">Delivered</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade active in" id="Rejected">
 <table cellpadding="0" cellspacing="0" width="100%" border="0" 
 class="row-fluid table table-hover table-bordered table-update my"  id="test1">
	<thead>
		<tr>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>HCMP Order No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
</tbody>
</table> 
      </div>
      <div class="tab-pane fade" id="Approval">
        <table width="100%" border="0" 
        class="row-fluid table table-hover table-bordered table-update"  id="test2">
	<thead>
		<tr>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>HCMP Order No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
</tbody>
</table> 
      </div>
      <div class="tab-pane fade" id="Delivery">
       <table width="100%" border="0" 
       class="row-fluid table table-hover table-bordered table-update"  id="test3">
	<thead>
		<tr>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>HCMP Order No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
</tbody>
</table> 
      </div>
      <div class="tab-pane fade" id="Delivered">
        <table cellpadding="0" cellspacing="0" width="50%" border="0" 
        class="row-fluid table table-hover table-bordered table-update"  id="test4">
	<thead>
		<tr>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>HCMP Order No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
</tbody>
</table> 
      </div>
    </div>
 	

  </div>
  </div>
<script>
/* Table initialisation */
$(document).ready(function() {
	//datatables settings 
	$("#test1").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
	     
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
		$("#test2").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
		$("#test3").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
		$("#test4").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
	$('.dataTables_filter label input').addClass('form-control');
	$('.dataTables_length label select').addClass('form-control');

} );
</script>