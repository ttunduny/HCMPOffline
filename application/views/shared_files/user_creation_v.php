<style type="text/css">
.color_g {
background: #ac193d;
color:white;

}
.color_b {
background: #008299;
color:white;

}
.color_d {
background: #27ae60;
color:white;

}
.color_f {
background: #e67e22;
color:white;
}
.stat_item {
height: 36px;
padding: 0 20px;
color: #fff;
text-align: center;
font-size: 1.5em;
}
.panel{
	border-radius: 0;
}
.panel-body {
padding: 8px;
}
</style>

<div class="container-fluid">
<div class="page_content">
				<div class="container-fluid">
					<div class="" style="width:65%;margin:auto;">
					<div class="row ">
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="stat_item color_g">
										<span class="glyphicon glyphicon-user"></span>
										<span>47 Inactive </span>

									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="stat_item color_d">
										<i class="ion-chatbubble-working"></i>
										<span>153 Active</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-body">		
									<div class="stat_item color_b">
										<i class="ion-android-social"></i>
										<span>4 Requests</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="stat_item color_f">
										<i class="ion-ios7-email-outline"></i>
										<span>8 Deactivated</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">

					<div class="col-md-2" style="padding-left: 0;">
						<button class="btn btn-primary add" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span>Add User</button>
						

					</div>
					<div class="col-md-10" style="border: 1px solid #ddd;padding-top: 1%; ">

						<table  class="table table-hover table-bordered table-update" id="datatable"  >
  <thead style="background-color: white">
  <tr>
    <th>Name</th>
    <th>Email </th>
    <th>Phone No</th>
    <th>Health Facility</th>
    <th>User Type</th>
    <th>Status</th>
    
  </tr>
  </thead>
      
    <tbody>
    
     
            <tr>                          
              <td>asdasds </td>
              <td>asdsasd</td>
              <td> asdasd</td>
              <td>sadasdas</td>
              <td>sdasdddsqdweqw</td>
              <td>sdasdddsqdweqw</td>
              
            </tr>
             <tr>                          
              <td>asdasds </td>
              <td>asdsasd</td>
              <td> asdasd</td>
              <td>sadasdas</td>
              <td>sdasdddsqdweqw</td>
              <td>sdasdddsqdweqw</td>
              
            </tr>
            
   </tbody>
</table>

					</div>

				</div>	
					</div>
				</div>
			</div>
</div>
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add User</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
      $(document).ready(function () {
	$('.dataTables_filter label input').addClass('form-control');
	$('.dataTables_length label select').addClass('form-control');
$('#datatable').dataTable( {
     "sDom": "T lfrtip",
       "sScrollY": "320px",   
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



});
    </script>