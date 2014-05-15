<style type="text/css">
	.color_g {
		background: #ac193d;
		color: white;
	}
	.color_b {
		background: #008299;
		color: white;
	}
	.color_d {
		background: #27ae60;
		color: white;
	}
	.color_f {
		background: #e67e22;
		color: white;
	}
	.stat_item {
		height: 36px;
		padding: 0 20px;
		color: #fff;
		text-align: center;
		font-size: 1.5em;
	}
	.status_item {

		padding: auto;
		color: #fff;
		text-align: center;
	}
	.panel {
		border-radius: 0;
	}
	.panel-body {
		padding: 8px;
	}
	#addModal .modal-dialog {
		width: 50%;
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
								<div class="stat_item ">
									<span class="glyphicon glyphicon-user"></span>
									<span> </span>

								</div>
							</div>
						</div>
					</div>
					<?php $x = array();
					foreach ($counts as $key) {

						$x[] = $key['count'];

					}
					?>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="stat_item color_d">
									<i class="ion-chatbubble-working"></i>
									<span><?php echo($x[1])-1;?>
										Active</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="stat_item color_g">
									<i class="ion-android-social"></i>
									<span><?php echo($x[0]); ?>
										Inactive</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="stat_item ">

									<span></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">

				<div class="col-md-2" style="padding-left: 0;">
					<button class="btn btn-primary add" data-toggle="modal" data-target="#addModal">
						<span class="glyphicon glyphicon-plus"></span>Add User
					</button>

				</div>
				<div class="col-md-10 dt" style="border: 1px solid #ddd;padding-top: 1%; " id="test">

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
								<td class="fname" ><?php echo $list['fname']; ?>
								</td>
								<td class="lname"><?php echo $list['lname'];
									;
								?>
								</td>
								<td class="email"><?php echo $list['email'];
									;
								?>
								</td>
								<td class="phone"><?php echo $list['telephone']; ?>
								</td>
								<td class="district" data-attr="<?php echo $list['district_id']; ?>"><?php echo $list['district']; ?>
								</td>
								<td class="facility_name" data-attr="<?php echo $list['facility_code']; ?>"><?php echo $list['facility_name']; ?>
								</td>
								<td class="level" data-attr="<?php echo $list['level_id']; ?>"><?php echo $list['level']; ?>
								</td>
								<td>
								<?php

if ($list['status']==1) {

								?>
								<div class="status_item color_d">
									<span>Active</span>
								</div>
								<?php }else{ ?>

								<div class=" status_item color_g">
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
</div>
<!-- Modal add user -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="myform">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h5>Add <small>New user</small></h5>
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

							<hr class="colorgraph">

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
											<input type="email" name="email" id="email" required="required" class="form-control " placeholder="email@domain.com" tabindex="6">
										</div>
									</div>
								</div>
								<div class="row">
									<div class=" col-md-6">
										<div class="form-group">
											<input type="email" name="username" id="username" required="required" class="form-control " placeholder="email@domain.com" tabindex="5" readonly>
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
									<?php

									$identifier = $this -> session -> userdata('user_indicator');

									if ($identifier=='district') {
									?>

									<div class="col-md-6">
										<div class="form-group">

											<select class="form-control " id="facility_id" required="required">
												<option value=''>Select Facility</option>

												<?php
												foreach ($facilities as $facilities) :
													$id = $facilities -> facility_code;
													$facility_name = $facilities -> facility_name;
													echo "<option value='$id'>$facility_name</option>";
												endforeach;
												?>
											</select>

										</div>
									</div>
									<div class="row" style="margin:auto">
										<div class=" col-md-6">
											<div class="form-group">
												<select class="form-control " id="user_type" name="user_type" required="required">
													<option value=''>Select User type</option>
													<?php
													foreach ($user_types as $user_types) :
														$id = $user_types -> id;
														$type_name = $user_types -> level;
														echo "<option value='$id'>$type_name</option>";
													endforeach;
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6">

										</div>
									</div>

									<?php }elseif ($identifier=='county') { ?>
									<div class="col-md-6">
										<div class="form-group">

											<select class="form-control " id="district_name" required="required">
												<option value=''>Select Sub-County</option>

												<?php
												foreach ($district_data as $district_) :
													$district_id = $district_ -> id;
													$district_name = $district_ -> district;
													echo "<option value='$district_id'>$district_name</option>";
												endforeach;
												?>
											</select>

										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<select class="form-control " id="facility_id" required="required">
												<option value="">Select Facility</option>
												<option value=""></option>
												
												

											</select>
										</div>
									</div>
								</div>
								<div class="row" >
									<div class=" col-md-6">
										<div class="form-group">
											<select class="form-control " id="user_type" name="user_type" required="required">
												<option value=''>Select User type</option>
												<?php
												foreach ($user_types as $user_types) :
													$id = $user_types -> id;
													$type_name = $user_types -> level;
													echo "<option value='$id'>$type_name</option>";
												endforeach;
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">

									</div>
								</div>

								<?php }elseif ($identifier=='facility_admin') {
	//code if facility admin
	}
								?>

								<div class="row" style="margin:auto" id="processing">
									<div class=" col-md-12">
										<div class="form-group">

										</div>
									</div>

								</div>

							</fieldset>

							<hr class="colorgraph">

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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				<div id="contents">

					<form role="form">

						<hr class="colorgraph">

						<fieldset>
							<legend style="font-size:1.5em">
								User details
							</legend>
							<div class="row" >

								<div class="col-md-6">
									<label> First Name </label>
									<div class="form-group">
										<input type="text" required="required" name="fname_edit" id="fname_edit" class="form-control " placeholder="First Name" >
									</div>
								</div>
								<div class="col-md-6">
									<label> Last Name </label>
									<div class="form-group">
										<input type="text" name="lname_edit" required="required" id="lname_edit" class="form-control " placeholder="Last Name" >
									</div>
								</div>
							</div>

							<div class="row">
								<div class=" col-md-6">
									<label> Phone No </label>
									<div class="form-group">
										<input type="telephone" name="telephone_edit" required="required" id="telephone_edit" class="form-control " placeholder="telephone eg, 254" tabindex="5">
									</div>
								</div>
								<div class="col-md-6">
									<label> Email </label>
									<div class="form-group">
										<input type="email" name="email_edit" id="email_edit" required="required" class="form-control " placeholder="email@domain.com" tabindex="6">
									</div>
								</div>
							</div>
							<div class="row">
								<div class=" col-md-6">
									<label> User Name </label>
									<div class="form-group">
										<input type="email" name="username_edit" id="username_edit" required="required" class="form-control " placeholder="email@domain.com" tabindex="5" readonly>
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
									<?php

									$identifier = $this -> session -> userdata('user_indicator');

									if ($identifier=='district') {
									?>

									<div class="col-md-6">
										<div class="form-group">

											<select class="form-control " id="facility_id_edit" required="required">
												<option value=''>Select Facility</option>

												<?php
												foreach ($facilities as $facility) :
													$id = $facility -> facility_code;
													$facility_name = $facility -> facility_name;
													echo "<option value='$id'>$facility_name</option>";
												endforeach;
												?>
											</select>

										</div>
									</div>
									<div class="row" style="margin:auto">
										<div class=" col-md-6">
											<div class="form-group">
												<select class="form-control " id="user_type_edit" name="user_type_edit" required="required">
													<option value=''>Select User type</option>
													<?php
													foreach ($user_types as $user_type) :
														$type_id = $user_type -> id;
														$t_name = $user_type -> level;
														echo "<option value='$type_id'>$t_name</option>";
													endforeach;
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6">

										</div>
									</div>

									<?php }elseif ($identifier=='county') { ?>
									<div class="col-md-6">
										<div class="form-group">

											<select class="form-control " id="district_name_edit" required="required">
												<option value=''>Select Sub-County</option>

												<?php
												foreach ($district_data as $district) :
													$d_id = $district -> id;
													$d_name = $district -> district;
													echo "<option value='$d_id'>$d_name</option>";
												endforeach;
												?>
											</select>

										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<select class="form-control " id="facility_id_edit" required="required">
												
											</select>
										</div>
									</div>
								</div>
								<div class="row" >
									<div class=" col-md-6">
										<div class="form-group">
											<select class="form-control " id="user_type_edit" name="user_type_edit" required="required">
												<option value=''>Select User type</option>
												<?php
												foreach ($user_type as $user_types) :
													$id = $user_types -> id;
													$type_name = $user_types -> level;
													echo "<option value='$id'>$type_name</option>";
												endforeach;
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">

									</div>
								</div>

								<?php }elseif ($identifier=='facility_admin') {
	//code if facility admin
	}
								?>

								<div class="row" style="margin:auto" id="processing">
									<div class=" col-md-12">
										<div class="form-group">

										</div>
									</div>

								</div>

							</fieldset>
						<hr class="colorgraph">

					</form>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
				<button type="button" class="btn btn-primary">
					Save changes
				</button>
			</div>
		</div>
	</div>
</div><!-- end Modal edit user -->
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

$("#district_name").change(function() {
    var option_value=$(this).val();
    
    if(option_value=='NULL'){
    $("#facility_name").hide('slow'); 
    }
    else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+$("#district_name").val();
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#facility_id").html('<option value="NULL" selected="selected">Select Facility</option>');
      $.each(json, function( key, val ) {
        drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>"; 
      });
      $("#facility_id").append(drop_down);
    });
    $("#facility_id").show('slow');   
    }
    }); 
    
    
    $("#district_name_edit").change(function() {
    var option_value=$(this).val();
    
    if(option_value=='NULL'){
    $("#facility_name_edit").hide('slow'); 
    }
    else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+$("#district_name_edit").val();
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#facility_id_edit").html('<option value="NULL" selected="selected">Select Facility</option>');
      $.each(json, function( key, val ) {
        drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>"; 
      });
      $("#facility_id_edit").append(drop_down);
    });
    $("#facility_id_edit").show('slow');   
    }
    }); 
    
    
$("#test").on('click','.edit',function() {
	
var email = $(this).closest('tr').find('.email').html();
var phone = $(this).closest('tr').find('.phone').html();
var district = $(this).closest('tr').find('.district').html();
var fname = $(this).closest('tr').find('.fname').html();
var lname = $(this).closest('tr').find('.lname').html();

var drop_down='';
var facility_id=$(this).closest('tr').find('.facility_name').attr('data-attr');
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+$(this).closest('tr').find('.district').attr('data-attr');
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#facility_id_edit").html('<option value="NULL" selected="selected">Select Facility</option>');
      $.each(json, function( key, val ) {
      	
        drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>"; 
      });
      $("#facility_id_edit").append(drop_down);
      
      $('#facility_id_edit').val(facility_id)
    });
   
$('#email_edit').val(email)
$('#telephone_edit').val(phone)
$('#fname_edit').val(fname)
$('#lname_edit').val(lname)
$('#username_edit').val(email)





$('#user_type_edit').val($(this).closest('tr').find('.level').attr('data-attr'))
$('#district_name_edit').val($(this).closest('tr').find('.district').attr('data-attr'))



  });
  
  $('#email_edit').keyup(function() {

  var email = $('#email_edit').val()

   $('#username_edit').val(email)

    })

$('#email').keyup(function() {

  var email = $('#email').val()

   $('#username').val(email)

    })
    
    
                  
 $("#create_new").click(function() {

      var first_name = $('#first_name').val()
      var last_name = $('#last_name').val()
      var telephone = $('#telephone').val()
      var email = $('#email').val()
      var username = $('#username').val()
      var facility_id = $('#facility_id').val()
      var district_name = $('#district_name').val()
      var user_type = $('#user_type').val()

       
      
      var div="#processing";
      var url = "<?php echo base_url()."user/addnew_user";?>";
      ajax_post_process (url,div);
           
    });

   function ajax_post_process (url,div){
    var url =url;

     //alert(url);
    // return;
     var loading_icon="<?php echo base_url().'assets/img/loader.gif' ?>";
     $.ajax({
          type: "POST",
          data:{ 'first_name': $('#first_name').val(),'last_name': $('#last_name').val(),
          'telephone': $('#telephone').val(),'email': $('#email').val(),
          'username': $('#username').val(),'facility_id': $('#facility_id').val(),
          'district_name': $('#district_name').val(),'user_type': $('#user_type').val()},
          url: url,
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin:20% 0 20% 30%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $(div).html("");
          $(div).html(msg);

          setTimeout(function () {
            window.location="<?php echo base_url()."user/user_create";?>"; 
        }, 3000);
            
                  
          }
        }); 
}

});
    </script>