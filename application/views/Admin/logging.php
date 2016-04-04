<?php //echo "<pre>";print_r($currently_logged_in_county);exit; ?>
<div class="container-fluid">
	<div class="page_content">
		<ul class="nav nav-tabs">
		<!-- <li class="active"><a href="#">Currently Logged In</a></li> -->
			<?php if($currently == "currently"):?>
					<li class="active"><a  data-toggle="tab" href="#all_users">All Currently Logged In</a></li>
			<?php endif; ?>
					<li	class = "<?php $activestat = ($active == 'county')? 'active':NULL; echo $activestat;?>" ><a data-toggle="tab"  href="#county_users">County Users</a></li>
					<li	class = "<?php $activestat = ($active == 'subcounty')? 'active':NULL; echo $activestat;?>" ><a data-toggle="tab"  href="#subcounty_users">Subcounty Users</a></li>
					<li	class = "<?php $activestat = ($active == 'facility')? 'active':NULL; echo $activestat;?>" ><a data-toggle="tab"  href="#facility_users">Facility Users</a></li> 
				<!-- <li><a  data-toggle="tab" href="#past_logs">Previous Records</a></li> -->
			</ul>
			<div class="tab-content">
			<?php if($currently == "currently"):?>
				<div id="all_users" class="tab-pane fade in active">
					<div class="row">
						<table class="table table-bordered" id="currently">
							<thead>
								<!-- <th>User ID</th> -->
								<th>Login State</th>
								<th>Time of Login</th>
								<th>Names</th>
								<th>Username</th>
								<th>County</th>
								<th>User Type</th>
							</thead>

							<tbody>
							<?php foreach ($all_users as $key): ?>
								<?php //print_r($key); ?>
								<tr>
									<!-- <td><?php //$value['id']; ?></td> -->
									<td><?php echo $key['action']; ?></td>
									<td><?php echo $key['start_time_of_event']; ?></td>
									<td><?php echo $key['fname'] .' '.$key['lname']; ?></td>
									<td><?php echo $key['username']; ?></td>
									<td><?php echo $key['county']; ?></td>
									<td><?php echo $key['level']; ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div><!-- END OF ALL USERS -->
			<?php endif; ?>
				<div id="county_users" class="tab-pane fade in <?php $activestat = ($active == 'county')? 'active':NULL; echo $activestat;?>">
					<div class="row">
						<table class="table table-bordered" id="datatable">
							<thead>
								<tr>
									<!-- <th>User ID</th> -->
									<th>Time of Login</th>
									<th>Login State</th>
									<th>Names</th>
									<th>Username</th>
									<th>County</th>
									<th>User Type</th>
								</tr>
							</thead>

							<tbody>
							<?php foreach ($county_users as $key): ?>
								<?php //print_r($key); ?>
								<tr>
									<!-- <td><?php //$value['id']; ?></td> -->
									<td><?php echo $key['start_time_of_event']; ?></td>
									<td><?php echo $key['action']; ?></td>
									<td><?php echo $key['fname'] .' '.$key['lname']; ?></td>
									<td><?php echo $key['username']; ?></td>
									<td><?php echo $key['county']; ?></td>
									<td><?php echo $key['level']; ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div><!-- END OF COUNTY USERS -->

				<div id="subcounty_users" class="tab-pane fade in">
					<div class="row">
						<table class="table table-bordered" id="datatable">
							<thead>
								<tr>
									<!-- <th>User ID</th> -->
									<th>Time of Login</th>
									<th>Login State</th>
									<th>Names</th>
									<th>Username</th>
									<th>County</th>
									<th>User Type</th>
								</tr>
							</thead>

							<tbody>
							<?php foreach ($subcounty_users as $key): ?>
								<?php //print_r($key); ?>
								<tr>
									<!-- <td><?php //$value['id']; ?></td> -->
									<td><?php echo $key['start_time_of_event']; ?></td>
									<td><?php echo $key['action']; ?></td>
									<td><?php echo $key['fname'] .' '.$key['lname']; ?></td>
									<td><?php echo $key['username']; ?></td>
									<td><?php echo $key['county']; ?></td>
									<td><?php echo $key['level']; ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div><!-- END OF SUBCOUNTY USERS -->

				<div id="facility_users" class="tab-pane fade in">
					<div class="row">
						<table class="table table-bordered" id="datatable">
							<thead>
								<tr>
									<!-- <th>User ID</th> -->
									<th>Time of Login</th>
									<th>Login State</th>
									<th>Names</th>
									<th>Username</th>
									<th>County</th>
									<th>User Type</th>
								</tr>
							</thead>

							<tbody>
							<?php foreach ($facility_users as $key): ?>
								<?php //print_r($key); ?>
								<tr>
									<!-- <td><?php //$value['id']; ?></td> -->
									<td><?php echo $key['start_time_of_event']; ?></td>
									<td><?php echo $key['action']; ?></td>
									<td><?php echo $key['fname'] .' '.$key['lname']; ?></td>
									<td><?php echo $key['username']; ?></td>
									<td><?php echo $key['county']; ?></td>
									<td><?php echo $key['level']; ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div><!-- END OF FACILITY USERS -->
			<!-- </div> -->
		</div><!-- END OF PAGE CONTENT DIV  -->
	</div>

	<script>
	/*$('table').DataTable();
		 $('table').dataTable( {
	      "sDom": "T lfrtip",
	          "sScrollY": "320px",   
	            "sPaginationType": "bootstrap",
	            "oLanguage": {"sLengthMenu": "_MENU_ Records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records",},
	            "oTableTools": {"aButtons": ["copy","print",{"sExtends":"collection","sButtonText": 'Save',"aButtons":[ "csv", "xls", "pdf" ]}],"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"}
      
      } ); */
	</script>




