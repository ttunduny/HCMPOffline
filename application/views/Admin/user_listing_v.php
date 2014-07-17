
<div class="container">
	
	<?php $x = array();
					foreach ($counts as $key) {
						$x[] = $key['count'];
					}
					?>

<div class="row" style="padding-top: 0.5%;padding-bottom: 0.5%" >
	
	<div class="col-md-2">
					
	</div>
	
	<div class="col-md-2">
					
	</div>
	
	<div class="col-md-2">
			<div class="color_b stat_item" id="active">
						<span class="glyphicon glyphicon-user"></span>
                  	
                     <?php echo($x[1]);?>   
                     Active    
                   </div>		
	</div>
	
	<div class="col-md-2">
					<div class="color_g stat_item" id="inactive">
						<span class="glyphicon glyphicon-pushpin"></span>
                  
                    <?php echo($x[0]);?> 
                    Inactive   
                   </div>
	</div>
	<div class="col-md-2">
					
	</div>
	<div class="col-md-2">
					
	</div>
	
</div>

</div>
<div class="container-fluid">
	<div class="page_content">
		
		<div class="container-fluid">
			
			<div class="row">

				<div class="col-md-1" style="padding-left: 0;">
					<button class="btn btn-primary add" data-toggle="modal" data-target="#addModal" id="add_new">
						<span class="glyphicon glyphicon-plus"></span>Add User
					</button>
				</div>
				<div class="col-md-11 dt" style="border: 1px solid #ddd;padding-top: 1%; " id="test">

					<table  class="table table-hover table-bordered table-update" id="datatable"  >
						<thead style="background-color: white">
							<tr>
								<th>First name</th>
								<th>Last name</th>
								<th>Email </th>
								<th>Phone No</th>
								<th>Sub-County</th>
								<th>Health Facility</th>
								<th>User Type</th>
								<th>Status</th>
								<th>Action</th>

							</tr>
						</thead>

						<tbody>

							<?php
							foreach ($listing as $list ) {
							?>
							<tr class="edit_tr" >
								<td class="fname" ><?php echo $list['fname']; ?></td>
								<td class="lname"><?php echo $list['lname']; ?>	</td>
								<td class="email" data-attr="<?php echo $list['user_id']; ?>"><?php echo $list['email'];?></td>
								<td class="phone"><?php echo $list['telephone']; ?></td>
								<td class="district" data-attr="<?php echo $list['district_id']; ?>"><?php echo $list['district']; ?></td>
								<td class="facility_name" data-attr="<?php echo $list['facility_code']; ?>"><?php echo $list['facility_name']; ?></td>
								<td class="level" data-attr="<?php echo $list['level_id']; ?>"><?php echo $list['level']; ?></td>
								<td >
								<?php
									if ($list['status']==1) {
								?>
								<div class="status_item color_d" data-attr="true">
									<span>Active</span>
								</div>
								<?php }else{ ?>

								<div class=" status_item color_g" data-attr="false">
									<span>Deactivated</span>
								</div> <?php } ?> </td>
								<td>
								<button class="btn btn-primary btn-xs edit " data-toggle="modal" data-target="#myModal" id="<?php echo $list['user_id']; ?>" data-target="#">
									<span class="glyphicon glyphicon-edit"></span>Edit
								</button></td>

							</tr>
							<?php } ?>
						</tbody>
					</table>

				</div>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="myform">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header" style="padding-bottom:2px;background: #27ae60;color: white">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel" style="text-align: center;line-height: 1">New User</h4>
			</div>
			<div class="row" style="margin:auto" id="error_msg">
				<div class=" col-md-12">
					<div class="form-group">

					</div>
				</div>

			</div>
			<div class="modal-body" style="padding-top:0">
				<div class="row" style="margin:auto">
					<div class="col-md-12 ">
						<form role="form">

							<fieldset>
								<legend style="font-size:1.5em">
									User details
								</legend>
								<div class="row" >

									<div class="col-md-6">
										<div class="form-group">
											<input type="text" required="required" name="first_name" id="first_name" class="form-control " placeholder="First Name" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" name="last_name" required="required" id="last_name" class="form-control " placeholder="Last Name" >
										</div>
									</div>
								</div>

								<div class="row">
									<div class=" col-md-6">
										<div class="form-group">
											<input type="telephone" name="telephone" required="required" id="telephone" class="form-control " placeholder="telephone eg, 254" tabindex="5">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="email" name="email" id="email" required="required" class="form-control" placeholder="email e.g email@domain.com" tabindex="6">
										</div>
									</div>
								</div>
								<div class="row">
									<div class=" col-md-6">
										<div class="form-group">
											<input type="email" name="username" id="username" required="required" class="form-control " placeholder="username e.g email@domain.com" tabindex="5" readonly>
										</div>
									</div>
									<div class="col-md-6">
										
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend style="font-size:1.5em">
									Other details
								</legend>
								<div class="row" >
									

									<div class="col-md-6">
										<div class="form-group">

											<select class="form-control" id="county" name="county" required="required">
												<option value=''>Select County</option>
														<?php
												foreach ($counties as $county) :
													$id = $county -> id;
													$name = $county -> county;
													echo "<option value='$id'>$name</option>";
												endforeach;
												?>
												
											</select>

										</div>
									</div>
									<div class="row" style="margin:auto">
										<div class=" col-md-6">
											<div class="form-group">
												<select class="form-control " id="sub_county" name="sub_county" required="required">
													<option value=''>Select Sub County</option>
													
												</select>
											</div>
										</div>
										<div class="col-md-6">

										</div>
									</div>

									
									<div class="col-md-6">
										<div class="form-group">

											<select class="form-control " id="facility_name" name="facility_name" required="required">
													<option value=''>Select Facility</option>
													
											</select>

										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											
										</div>
									</div>
								</div>
								<div class="row" >
									<div class=" col-md-6">
										<div class="form-group">
											<select class="form-control " id="user_type" name="user_type" required="required">
												<option value=''>Select User Type</option>
												<?php
													foreach ($user_types as $user_type) :
														$id = $user_type -> id;
														$type_name = $user_type -> level;
														echo "<option value='$id'>$type_name</option>";
													endforeach;
													?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
									</div>
								</div>
								

								<div class="row" style="margin:auto" id="processing">
									<div class=" col-md-12">
										<div class="form-group">
										</div>
									</div>
								</div>
							</fieldset>

						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
				<button type="button" class="btn btn-primary" id="create_new">
					Save changes
				</button>
			</div>
		</div>
	</div>
</div><!-- end Modal new user -->



	