<?php //echo "<pre>";print_r($currently_logged_in_county);exit; ?>
<div class="container-fluid">
	<div class="page_content">
		<ul class="nav nav-tabs">
		<!-- <li class="active"><a href="#">Currently Logged In</a></li> -->
			<li class="dropdown active">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Currently Logged In
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a data-toggle="tab"  href="#county_users">All Users</a></li>
						<li><a data-toggle="tab"  href="#subcounty_users">Subcounty Users</a></li>
						<li><a data-toggle="tab"  href="#facility_users">Facility Users</a></li> 
					</ul>
				</li>
				<li><a href="#">Previous Records</a></li>
			</ul>
			<div class="tab-content">
			<div id="county_users" class="tab-pane fade in active">
				<div class="row">
					<table class="table table-bordered">
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
						<?php foreach ($currently_logged_in_county as $key): ?>
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
			</div><!-- END OF COUNTY USERS -->

			<div id="subcounty_users" class="tab-pane fade in">
				<div class="row">
					<table class="table table-bordered">
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
						<?php foreach ($currently_logged_in_subcounty as $key): ?>
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
			</div><!-- END OF COUNTY USERS -->

			<div id="facility_users" class="tab-pane fade in">
				<div class="row">
					<table class="table table-bordered">
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
						<?php foreach ($currently_logged_in_facility as $key): ?>
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
			</div><!-- END OF COUNTY USERS -->
			</div>
		</div><!-- END OF PAGE CONTENT DIV  -->
	</div>




