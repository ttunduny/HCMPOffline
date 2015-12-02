<style type="text/css">
	.panel-body,span:hover,.status_item:hover
	{ 
		cursor: pointer !important; 
	}
	.panel {
		border-radius: 0;
	}
	.panel-body {
		padding: 8px;
	}
	#addModal .modal-dialog {
		width: 54%;
	}
	.borderless{
		border-radius: 0px;	
	}
	.form-group{
		margin-bottom: 10px;
	}
</style>

 <script>
 function alertify_exec(user_id){
 	if (user_id != '') {
    	// message = "The Password for User ID: "+user_id+" <?php echo ucfirst($fname).' '.ucfirst($lname); ?> has been reset to : 123456";
    	message = "The password for <?php echo $username; ?> has been reset to : 123456";

    	alertify.set({ delay: 10000 });
    	alertify.success(message, null);
 	}else{
 		message = "No action has been taken";

    	alertify.set({ delay: 10000 });
    	alertify.success(message, null);
 	}
 	
 }
 </script>

<?php 
// $pwd_reset = 1;
	if (isset($pwd_reset) && $pwd_reset == 1) {
		// echo $reset_user_id;exit;
		echo "
		<script>alertify_exec(".$reset_user_id.");</script>
		";
	}
 ?>
<div class="container-fluid">
	<div class="page_content">
		<div class="" style="width:65%;margin:auto;">
				<div class="row ">
					<div class="col-md-3">
						
					</div>
					<?php $x = array();
					foreach ($counts as $key) {
						$x[] = $key['count'];
					}
					?>
					<!--
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-body" id="active">
								<div class="stat_item color_d">
									<span class="glyphicon glyphicon-user"></span>
									<span><?php echo($x[1]);?>Active</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-body" id="inactive">
								<div class="stat_item color_g">
									<span class="glyphicon glyphicon-user"></span>
									<span><?php echo($x[0]); ?>Inactive</span>
								</div>
							</div>
						</div>
					</div>
					-->
					<div class="col-md-3">
						
					</div>
				</div>
			</div>
		<div class="container-fluid">
			
			<div class="row">

				<div class="col-md-1" style="padding-left: 0; right:0; float:right; margin-bottom:5px;">
					<button class="btn btn-primary add" data-toggle="modal" data-target="#addModal" id="add_new">
						<span class="glyphicon glyphicon-plus"></span>Add Patient
					</button>
						<a href="add_multiple_patients" style="margin: 5px 0;">Add Multiple Patients</a>
				</div>


				</div>
				<div class="col-md-12 dt" style="border: 1px solid #ddd;padding-top: 1%; " id="test">

					<table  class="table table-hover table-bordered table-update" id="datatable"  >
						<thead style="background-color: white">
							<tr>
								<th>Names</th>
								<th>Username </th>
								<th>Phone No</th>
								<th>Sub-County</th>
								<th>Health Facility</th>
								<th>User Type</th>
								<th>Status (Checked means Active)</th>
								<th>Password</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>

							<?php
							foreach ($listing as $list ) {
							?>
							<tr class="edit_tr" >
								<td class="fname" ><?php echo ucfirst($list['fname'])." ".ucfirst($list['lname']);?></td>
								<!-- <td class="lname"><?php echo $list['lname']; ?>	</td> -->
								<td class="email" data-attr="<?php echo $list['user_id']; ?>"><?php echo $list['email'];?></td>
								<td class="phone"><?php echo $list['telephone']; ?></td>
								<td class="district" data-attr="<?php echo $list['district_id']; ?>"><?php echo $list['district']; ?></td>
								<td class="facility_name" data-attr="<?php echo $list['facility_code']; ?>"><?php echo $list['facility_name']; ?></td>
								<td class="level" data-attr="<?php echo $list['level_id']; ?>"><?php echo $list['level']; ?></td>
								<td style="width:20px;" >
								<?php if ($list['status']==1) {?>
								<input type="checkbox" name="status-checkbox" id="status_switch_change" data-attr="<?php echo $list['user_id']; ?>" class="small-status-switch" checked = "checked" style="border-radius:0px!important;">
								<?php }else{ ?>
								<input type="checkbox" name="status-checkbox" id="status_switch_change" data-attr="<?php echo $list['user_id']; ?>" class="small-status-switch" style="border-radius:0px!important;">
								<?php } ?> 
								<td>
									<!-- <div class="btn btn-primary btn-xs" id="reset_pwd"  data-attr="<?php echo $list['user_id']; ?>">
									<span class="glyphicon glyphicon-edit"></span>Reset Password
									</div> -->
									<a href="#" class="btn btn-primary btn-xs reset_pwd" name="reset_pwd"  id="reset_pwd" data-attr="<?php echo $list['user_id']; ?>" data-name="<?php echo $list['email']; ?>">
									<!-- <a href="<?php //echo base_url().'user/reset_pass_to_default/'.$list['user_id']; ?>" class="btn btn-primary btn-xs" name="reset_pwd" class="reset_pwd" id="reset_pwd" data-attr="<?php echo $list['user_id']; ?>"> -->
									<span class="glyphicon glyphicon-edit"></span>Reset Password
									 </a>	 
								</td>

								<td>
								<button class="btn btn-primary btn-xs edit " data-toggle="modal" data-target="#myModal" id="<?php echo $list['user_id']; ?>" data-target="#">
									<span class="glyphicon glyphicon-edit"></span>Edit
								</button>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>

				</div>

			</div>
		</div>
	</div>
</div>
</div>
<!-- Modal add user -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="myform">
	<div class="modal-dialog editable" >
		<div class="modal-content">
			<div class="modal-header" style="">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel" style="text-align: center;line-height: 1">Add Patient</h4>
			</div>
			<div class="row" style="margin:auto" id="error_msg">
				<div class=" col-md-12">
					<div class="form-group">

					</div>
				</div>

			</div>
			<div class="modal-body" style="padding:0">
				<div class="row" style="margin:auto">
					<div class="col-md-12 ">
					<center>
						<form role="form">

							<fieldset class = "col-md-12">
							<center>
							
								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">First Name <span style="color:#e60000"> * <i>required</i></span></span>
									<input type="text" required="required" name="first_name" id="first_name" class="form-control " placeholder="Enter First Name" >
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">Last Name <span style="color:#e60000"> * <i>required</i></span></span>
									<input type="text" name="last_name" required="required" id="last_name" class="form-control " placeholder="Last Name" >
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">Date of Birth <span style="color:#e60000"> * <i>required</i></span></span>
									<input type="text" name="dob" id="dob" required="required" class="form-control datepicker" placeholder="e.g dd/mm/yyyy" tabindex="6">
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">Gender <span style="color:#e60000"> * <i>required</i></span></span>
									<select id="gender" name="gender" required="required" class="form-control ">
										<option value="0">Select Gender</option>
										<option value="1">Male</option>
										<option value="2">Female</option>
									</select>									
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">Phone Number <span style="color:#e60000"> * <i>required</i></span></span>
									<input type="telephone" name="telephone" required="required" id="telephone" class="form-control " placeholder="Enter Phone Number eg, 254" tabindex="5">
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">Email <span style="color:green">(optional)</span></span>
									<input type="email" name="email" id="email" required="required" class="form-control " placeholder="email@domain.com" tabindex="6">
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">Residential Address <span style="color:#e60000"> * <i>required</i></span></span>
									<input type="text" name="physical_address" id="physical_address" required="required" class="form-control " placeholder="Enter Residential Address" tabindex="6">
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">Work Address <span style="color:green">(optional)</span></span>
									<input type="text" name="work_address" id="work_address" required="required" class="form-control " placeholder="Enter Work Address" tabindex="6">
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">Patient Number <span style="color:#e60000">* <i>required</i></span></span>
									<input type="text" name="patient_number" id="patient_number" required="required" class="form-control " placeholder="Enter the Patient Number" tabindex="6">
								</div>								
								<div class="row" style="margin:auto" id="processing">
									<div class=" col-md-12">
										<div class="form-group">
										</div>
									</div>
								</div>
								</center>

							</fieldset>

						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default borderless" data-dismiss="modal">
					Close
				</button>
				
				<button class="btn btn-primary borderless" id="create_new_patient">
					Save changes
				</button>
			</div>
		</div>
	</div>
</div><!-- end Modal new user -->


<script>
$(document).ready(function () {
 
   
$("#create_new_patient").click(function() {

      var first_name = $('#first_name').val();
      var last_name = $('#last_name').val();
      var dob = $('#dob').val();
      var gender = $('#gender').val();
      var telephone = $('#telephone').val();
      var email = $('#email').val();
      var physical_address = $('#physical_address').val();
      var work_address = $('#work_address').val();
      var patient_number = $('#patient_number').val();      
      var url = "<?php echo base_url()."dispensing/save_patient";?>";
      var loading_icon="<?php echo base_url().'assets/img/Preloader_4.gif' ?>";

	   if(first_name==""||last_name==""||telephone==""||dob==""||gender=="0"||physical_address==""||patient_number==""){
			alert('Please make sure you have filled in all required  fields.');
			return;
		}
		$.ajax({
	        type: "POST",
	        url: url,
	        data:{'first_name': first_name,
          		'last_name': last_name,
          		'dob': dob,
          		'gender': gender,
          		'email': email,
          		'physical_address': physical_address,
          		'work_address': work_address,
          		'patient_number': patient_number,
          		'telephone': telephone},
	        dataType: "html",
	         async: !1,
	        beforeSend: function() {
		        var message = confirm("Are you sure you want to proceed?");
		        if (message){
		            $('.modal-body').html("<img style='margin:30% 0 20% 42%;' src="+loading_icon+">");
		        } else {
		            return false;
		        }           
	          },
	        success: function(msg) {
	        setTimeout(function () {
	          	$('.modal-body').html("<div class='bg-warning' style='height:30px'>"+
								"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"+
								"<h3>Success!!! A new patient was added to the system. Please Close to continue</h3></div>")
								
				$('.modal-footer').html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>")
					
	        }, 4000);
	            
	                  
          },
	        error: function() {
	            alert('Error occured');
	        }
	    });
	});
	
    });

    </script>