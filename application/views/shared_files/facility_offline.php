<?php //echo "<pre>";print_r($facilities);echo "</pre>";exit; ?>
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
	.list-bubble{
		display: table;
		list-style: none;
		margin: 0 0 20px 0;
		padding: 0;
		position: relative;
		width: 100%;
	}
	.list-bubble ul li{
		display: table-cell;
	    text-align: center;
	    width: 1%;
	}
	.selected{
		color: #88bbc8;
	}
		
	.stepwizard-step p {
	    margin-top: 10px;
	}

	.stepwizard-row {
	    display: table-row;
	}

	.stepwizard {
	    display: table;
	    width: 100%;
	    position: relative;
	}

	.stepwizard-step button[disabled] {
	    opacity: 1 !important;
	    filter: alpha(opacity=100) !important;
	}

	.stepwizard-row:before {
	    top: 20px;
	    bottom: 0;
	    position: absolute;
	    content: " ";
	    width: 66%;
	    margin:0 16%;
	    height: 1px;
	    background-color: #ccc;
	    z-order: 0;

	}

	.stepwizard-step {
	    display: table-cell;
	    text-align: center;
	    position: relative;
	}

	.btn-circle {
	    width: 40px;
	    height: 40px;
	    text-align: center;
	    padding: 7px auto;
	    font-size: 15px;
	    line-height: 1.428571429;
	    border-radius: 20px!important;
	}
	.btn{
		opacity: 1!important;
	}
	.customiser{
		background: #fff!important;
		color:#000!important;
	    border: 3px solid #5293C2;
	}
	.uncustomiser-green{
		/*background: #fff!important;*/
		color:#fff!important;
	    border: 3px solid #47A447;
	}
	.uncustomiser-blue{
		/*background: #fff!important;*/
		color:#fff!important;
	    border: 3px solid #5293C2;
	}
	.bold{
		font-weight: bold!important;
	}

</style>
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
					<div class="col-md-3">
						
					</div>
				</div>
			</div>
		<div class="container-fluid">
			<?php //echo "<pre>";print_r($facilities);die;?>
			<div class="row">

			<div class="col-md-12">
				<div class="stepwizard">
				    <div class="stepwizard-row setup-panel col-md-12">
				        <div class="stepwizard-step col-md-4">
				            <a href="#step-1" id="step-1" type="button" class="btn btn-success btn-circle uncustomiser-green">1</a>
				            <p id="step-1-p" class="bold">Step 1</br>Select and activate a facility</p>
				        </div>
				        <div class="stepwizard-step col-md-4">
				            <a href="#step-2" id="step-2" type="button" class="btn btn-default btn-circle customiser" disabled="disabled">2</a>
				            <p id="step-2-p">Step 2</br>User Management</p>
				        </div>
				        <div class="stepwizard-step col-md-4">
				            <a href="#step-3" id="step-3" type="button" class="btn btn-default btn-circle customiser" disabled="disabled">3</a>
				            <p id="step-3-p">Step 3</br>Download facility database and installer</p>
				        </div>
				        <!-- <div class="stepwizard-step col-md-3">
				            <a href="#step-4" id="step-4" type="button" class="btn btn-default btn-circle customiser" disabled="disabled">4</a>
				            <p>Step 4</br>Congratulations!</p>
				        </div> -->
				    </div>
				</div>
			</div>
				<!-- <div class="col-md-1" style="padding-left: 0; right:0; float:right; margin-bottom:5px;">
					<button class="btn btn-primary add" data-toggle="modal" data-target="#addModal" id="add_new">
						<span class="glyphicon glyphicon-plus"></span>Add Facility
					</button>
				</div> -->


				<div class="col-md-12">
				<center><b>
				Once a facility is selected,you will not be able to go to previous steps. Refresh the page to restart the process.</div>
				</b></center>
				<div class="col-md-12" style="border-top:1px solid #ddd;border-bottom:1px solid #ddd;padding-top: 1%; " id="test">
				<center>
				<div class="col-md-2 col-md-offset-2">
					<span style="font-size: 16px">Select facility: </span>
				</div>
				<div class="col-md-8">
					<select id="facility_select" class="form-control" style="width:30%;margin-left: 1%;margin-bottom: 2%;float: left;">

						<?php 
							foreach ($facilities as $key => $value) {
								$id = $value['id'];
								$facility_code = $value['facility_code'];
								$name = $value['facility_name'];
								$status = $value['using_hcmp'];
								$full_name = $name.'-'.$facility_code;?>
								<option value="<?php echo $facility_code;?>" status="<?php echo $status;?>"><?php echo $full_name;?></option>
						<?php	}

						?>
					</select>
					<button id="filter_facility" class="form-control btn btn-success" style="width:20%;margin-bottom: 2%;float: left">Get Details</button>
				</div>
				</center>
				</div>
				<div id="details_list"  class="col-md-12 dt" style="padding-top: 2%;">		
					<div id="step_1">
					<center>
						<h3>Step 1 </h3>
						<div id="activate">
							<p style=";color:#000;font-size:16px;">
								<span class="glyphicon glyphicon-remove"></span></br>
								<span style="">This facility has not been activated. Do you wish to activate it? </span>
								<br/>
								<button id="btn_activate_facility" class="btn btn-danger" style="width:auto">Yes, Activate
								</button>							
							</p>
							<br/>
							<span style="margin-top: 1%"></span>
						</div>
						<div id="activated">
						<!-- <i class="fa fa-check"></i> -->
						<span class="glyphicon glyphicon-ok"></span>
							<p style="font-size:16px;">
								<span> The selected facility is active</span>
								<br/>
								<button id="step1_advance" class="step2 btn btn-success">Proceed to Step 2</button>							
							</p>
							<br/>
							<span style="margin-top: 1%"></span>
						</div>	
					</div>
					</center>
					<!-- Step two, Adding Users -->
					<div id="step_2">
					<center>
						<h3>Step 2: Users </h3>
						<div id="active_users">
							<p style="color:#000;font-size:16px;">
								<span>The following users are present in the selected facility</span></br>
								<button id="reset_pass" class="btn btn-danger">Reset Passwords
								</button>
								<button id="add_user_active" class="add_user btn btn-primary" data-toggle="modal" data-target="#addModal">Add User</button>							
							</p>
							<br/>
							<table id="users_table" class="table table-hover table-bordered table-update">
								<tr><th>Full Name</th><th>Date Created</th></tr>
							</table>
							<br/>
							<button id="step2a_advance" class="step3 btn btn-success">Proceed to Step 3</button>						
							<!-- <button id="download_zip" class="download_zip btn btn-success">Proceed to Step 3</button>						 -->
						</div>

						<div id="no_users">
							<p style="color:#000;font-size:16px;">
								<span>You have no Users</span>
								<button id="add_user_inactive" class="add_user btn btn-primary" data-toggle="modal" data-target="#addModal">Add User</button>							
							</p>
							<br/>																			
							
						</div>
						
					</center>
					</div>

					<!-- Step 3 Download Data -->

					<div id="step_3">
					<center>
						<h3>Step 3: Download database </h3>						
						<p style="color:#000;font-size:16px;">
							<span>
							Click the button below to download the facility's database.</br>
							Users added in step two will be included in the database and will be usable after setup 
							</span>													
						</p>
						<br/>							
						<br/>
						<button id="step3_advance" class="make_db btn btn-primary">Download Database</button>						
					</center>
					</div>
					<div id="step_4">
					<center>
						<h3>Step 4: Download Database Installer File </h3>						
						<p style="color:#000;font-size:16px;">
							<span>
							You can now download additional required files for setup. </br>
							Copy both downloaded files in to the HCMP setup folder. 
							</span>													
						</p>
						<br/>							
						<br/>
						<button id="step4_advance" class="make_bat btn btn-primary" style="">Download additional files and complete setup</button>		
					</center>
					</div>

					<div id="step_5">
						<center>
						<h3>Step 3: Download required files </h3>						
						<p style="color:#000;font-size:16px;">
							<span>
							Clicking the button below will dowload a zip file that will contain the database and an installer for the selected facility</br>
							Unzip the folder and run the installer found in the file and the database will be installed on the computer 
							</span>													
						</p>
						<br/>							
						<br/>
						<button id="step5_advance" class="make_zip btn btn-primary">Download facility data</button>						
					</center>
					</div>

					<div id="success">
					<center>
						<span style="font-size:60px;" class="glyphicon glyphicon-thumbs-up"></span>
						<h4>Congratulations!</h4>
						<h4>You have successfully downloaded the required zip file for the above facility's data.</br>Extract it when you are ready and click on the install database file to install the database.</h4>
					</div>
					</center>
				</div>			
			</div>
		</div>
	</div>
</div>
</div>
<!-- <div id="users_none">						

<button class="form-control btn btn-success make_db" style="width:20%;float;left;margin-left:6%;margin-top: 2%;margin-bottom: 2%">
		DOWNLOAD FACILITY DATA
</button>
</div>

<div id="users_all">
	<p style="margin-top:0%;margin-left:6%;color:#000;font-size:16px;margin-bottom: 3%">
		<span style="float: left;">The Following users are in your Facility</span>
		<button id="reset_pass" class="form-control btn btn-danger" style="width:10%;float: left;margin-left:1%;">Reset Passwords
		</button>							
	</p>
	<br/>
	<table id="users_table" class="table table-hover table-bordered table-update" style="margin-left: 6%;width: 90%;margin-top: 1%;float: left;">
		<tr><th>Full Name</th><th>Date Created</th><th>Last Login</th></tr>
	</table>
	<br/>
	<button class="form-control btn btn-success make_db" style="width:20%;float;left;margin-left:6%;margin-top: 2%;margin-bottom: 2%">
			DOWNLOAD FACILITY DATA
	</button>
</div> -->

<script>
   $(document).ready(function () {
   	hideAll();
   	function hideAll(){
		$("#activate").hide();
	   	$("#activated").hide();
	   	$("#active_users").hide();
	   	$("#no_users").hide();
	   	$("#step_1").hide();
	   	$("#step_2").hide();
	   	$("#step_3").hide();	   	
	   	$("#step_4").hide();	   	
	   	$("#step_5").hide();	   	
	   	$("#success").hide();	   	
   	}

   	function activateFacility(){
   		var facility_code = $("#facility_select").val();
	  	var facility_name = $("#facility_select").text();
	  	var status = $("#facility_select").find(':selected').attr('status');
	  	if(status==0){
	  		$("#activate").show();
	  		$("#activated").hide();
	  	}else{
	  		$("#activate").hide();	  		
	  		var base_url = "<?php echo base_url() . 'facility_activation/get_facility_stats/'; ?>";
		    var url = base_url+facility_code;				
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){
					// console.log(s);
					var count = s.number;
					var users = s.list;
					if(count==0){
						$("#users_none").show();
					}else{
						$.each(users, function( index, value ) {
							// console.log(value);
							
	                       var row = $("<tr><td>" + value[0] + "</td><td>" + value[1] + "</td></tr>");
	                       // $("#users_table").append(row);
	                    });
						$("#activate").hide();	                    
						// $("#users_none").hide();	                    
						// $("#users_all").show();	                    
					}
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
			$("#activated").show();
	  	}
   	}

   	function getUsers(){
   		var facility_code = $("#facility_select").val();
	  	var facility_name = $("#facility_select").text();	  	
  		var base_url = "<?php echo base_url() . 'facility_activation/get_facility_stats/'; ?>";
  		var reset_url = "<?php echo base_url().'user/reset_pass_to_default/' ?>";
	    var url = base_url+facility_code;				
		$.ajax({
			url: url,
			dataType: 'json',
			success: function(s){				
				var count = s.number;
				var users = s.list;
				if(count==0){
					$("#no_users").show();
				}else{
					$.each(users, function( index, value ) {
						console.log(value[0]);
		               	var row = $("<tr><td>" + value[1] + "</td><td>" + value[2]+"</td></tr>");
		               	// var row = $("<tr><td>" + value[1] + "</td><td>" + value[2]+"</td><td><a href=\""+reset_url+value[0]+"\" class=\"btn btn-primary btn-xs reset_pwd\" id=\"reset_pwd\"><span class=\"glyphicon glyphicon-edit\"></span>Reset Password</a></td></tr>");
		               $("#users_table").append(row);
		            });
					$("#active_users").show();	                    			
				}			
			},
			error: function(e){
				console.log(e.responseText);
			}
		});	
   	}
   	function loadStep1(){
   		hideAll();   		
	   	$("#step_1").show();   	
   		$("#step-2").removeClass("btn-primary");
   		$("#step-3").removeClass("btn-primary");
   		$("#step-4").removeClass("btn-primary");

   		activateFacility();
   	}
   	
   	function loadStep2(){
   		hideAll();   	   	
   		getUsers();
   		// alert("Ni mimi");
   		$("#step-1").removeClass("btn-success");
   		$("#step-1").removeClass("uncustomiser-green");
   		$("#step-1").addClass("uncustomiser-blue");
   		$("#step-1").addClass("btn-primary");
   		$("#step-1-p").removeClass("bold");

   		$("#step-2-p").addClass("bold");
   		$("#step-2").removeClass("customiser");
   		$("#step-2").addClass("uncustomiser-green");
   		$("#step-2").addClass("btn-success");

   		$("#step_2").show();   		
   	}

   	function loadStep3(){
   		hideAll();

   		$("#step-2").removeClass("btn-success");
   		$("#step-2").removeClass("uncustomiser-green");
   		$("#step-2").addClass("uncustomiser-blue");
   		$("#step-2").addClass("btn-primary");
   		$("#step-2-p").removeClass("bold");

   		$("#step-3-p").addClass("bold");
   		$("#step-3").removeClass("customiser");
   		$("#step-3").addClass("uncustomiser-green");
   		$("#step-3").addClass("btn-success");

   		// $("#step-2").removeClass("btn-success");
   		// $("#step-2").removeClass("customiser");
   		// $("#step-2").addClass("uncustomiser");
   		$("#step-3").addClass("btn-primary");
   		// $("#step-3").addClass("uncustomiser");
	   	$("#step_3").show();   		   		
   	}

	function loadStep4(){
   		hideAll();   		
   		$("#step-4").addClass("btn-primary");
   		$("#step-4").addClass("uncustomiser");
	   	$("#step_4").show();   		   		
   	}

   	function loadStep5(){
   		hideAll();   		
   		$("#step-2").removeClass("btn-success");
   		$("#step-2").removeClass("uncustomiser-green");
   		$("#step-2").addClass("uncustomiser-blue");
   		$("#step-2").addClass("btn-primary");
   		$("#step-2-p").removeClass("bold");

   		$("#step-3-p").addClass("bold");
   		$("#step-3").removeClass("customiser");
   		$("#step-3").addClass("uncustomiser-green");
   		$("#step-3").addClass("btn-success");

   		// $("#step-3").addClass("btn-primary");
	   	$("#step_5").show();   		   		
   	}

   	function loadSuccess(){
   		hideAll();   		
   		$("#step-3").removeClass("btn-success");
   		$("#step-3").removeClass("uncustomiser-green");
   		$("#step-3").addClass("uncustomiser-blue");
   		$("#step-3").addClass("btn-primary");
		$("#step-3-p").removeClass("bold");
   		// $("#success").addClass("btn-primary");
	   	$("#success").show();   		   		
   	}
	$('#filter_facility').click(function() {	    
	  	loadStep1();
	  	$(this).attr('disabled','disabled');
	  	$(this).addClass('disabled');
	  	$("#facility_select").attr('disabled','disabled');

	});

	$('#step1_advance').click(function() {	    
	  	loadStep2();	  	
	});

	// $('.step3').click(function() {	    
	//   	loadStep3();	  	
	// });

	$('.step3').click(function() {	    
	  	loadStep5();	  	
	});

	$('.download_zip').click(function() {	    
	  	loadSuccess();	  	
	});

	$('#reset_pass').click(function() {
	    // handle deletion here
	  	var facility_code = $("#facility_select").val();
	  	var my_message = '';
  		var base_url = "<?php echo base_url() . 'user/reset_multiple_pass/'; ?>";
	    var url = base_url+facility_code;			    
		$.ajax({
			url: url,
			dataType: 'json',
			success: function(s){				
				my_message = "User passwords reset successfully";				
				alertify.set({ delay: 10000 });
          		alertify.success(my_message, null);
			},
			error: function(e){
				console.log(e.responseText);
			}
		});
	  	
	});

	$("#add_user_inactive").click(function(){
		$("#addModal").show();
	})

	
	$('#facility_select').change(function(){
	  	hideAll();
	});

	$('.make_db').click(function(e){//checkpoint
		var base_url = "<?php echo base_url() . 'dumper/dump_db/'; ?>";
	  	var facility_code = $("#facility_select").val();		
		var url = base_url+facility_code+'/hcmp_rtk';				
		window.open(url); 
		loadStep4();
	});

	$('.make_bat').click(function(e){
		var base_url = "<?php echo base_url() . 'dumper/gen_bat/'; ?>";
	  	var facility_code = $("#facility_select").val();		
		var url = base_url+facility_code+'/hcmp_rtk';				
		window.open(url); 
		// loadStep4();
	});

	$('.make_zip').click(function(e){//create complete zip for download
		var base_url = "<?php echo base_url() . 'dumper/create_zip/'; ?>";
	  	var facility_code = $("#facility_select").val();		
		var url = base_url+facility_code+'/hcmp_rtk';				
		window.open(url); 
		loadSuccess();
	});

	$("#btn_activate_facility").click(function(){
		var facility_code = $("#facility_select").val();
		$('#confirmActivateModal').data('id', facility_code).modal('show');
	});
	
	$('#btnNoActivate').click(function() {
	    message_denial = "No action has been taken";
		alertify.set({ delay: 10000 });
	 	alertify.success(message_denial, null);       
	  	$('#confirmActivateModal').modal('hide');
	  	 return false;
	});
	$('#btnNoDeactivate').click(function() {
	    message_denial = "No action has been taken";
    	alertify.set({ delay: 10000 });
     	alertify.success(message_denial, null);       
	  	$('#confirmDeActivateModal').modal('hide');
	  	 return false;
	});
	
	$('#btnYesActivate').click(function() {
	    // handle deletion here
	  	var facility_code = $('#confirmActivateModal').data('id');
	  	change_status_new(facility_code,0,1);
	  	$('#confirmActivateModal').modal('hide');
	});
	$('#btnYesActivateNoUsers').click(function() {
	    // handle deletion here
	  	var facility_code = $('#confirmActivateModal').data('id');
	  	change_status_new(facility_code,0,0);
	  	$('#confirmActivateModal').modal('hide');
	  	$("#facility_select").find(':selected').attr('status','1');
	  	loadStep1();
	  	// window.location.reload(true);
	});
	$('#btnYesDeactivate').click(function() {
	    // handle deletion here
	  	var facility_code = $('#confirmDeActivateModal').data('id');
	  	change_status_new(facility_code,1,0);
	  	$('#confirmDeActivateModal').modal('hide');
	});

	$(".dataTable").on('click','.status_btn',function(event) {
	    if ( $(this).hasClass("activate") ) {
	       var id = $(this).data('id');
	   	   // alert(id);
	    	$('#confirmActivateModal').data('id', id).modal('show');
	    } else if ( $(this).hasClass("deactivate") ) {
	        $("#confirm_deactivate_table > tbody").html("");
		    var facility_code = $(this).data('id');
		    $('#confirmDeActivateModal').data('id', facility_code).modal('show');
		    var base_url = "<?php echo base_url() . 'facility_activation/get_facility_user_data/'; ?>";
		    var url = base_url+facility_code;
				
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){
				// console.log(s);
				 $.each(s, function( index, value ) {
                       var row = $("<tr><td>" + value[0] + "</td><td>" + value[1] + "</td><td>"+value[2]+"</td></tr>");
                       $("#confirm_deactivate_table").append(row);
                    });
				
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
	    }
	});

	 //make sure email==username  for edits
  $('#email_edit').keyup(function() {
  	var email = $('#email_edit').val();
   	$('#username_edit').val(email);
   	$('#username').val(email);
   	
   	$.ajax({
      type: "POST",
      dataType: "json",
      url: "<?php echo base_url()."user/check_user_json";?>", //Relative or absolute path to response.php file
      data:{ 'email': $('#email_edit').val()},
      success: function(data) {
        if(data.response=='false'){
        	$('.err').html(data.msg);
			$( '.err' ).addClass( "alert-danger alert-dismissable" );
			$(".edit_user,#create_new").attr("disabled", "disabled");
		}else if(data.response=='true'){
			$(".err").empty();
			$(".err").removeClass("alert-danger alert-dismissable");
			$( '.err' ).addClass( "alert-success alert-dismissable" );
			$(".edit_user,#create_new").attr("disabled", false);
			$('.err').html(data.msg);
		}
      }
    });
    return false;
	});

  $('#email').keyup(function() {

  var email = $('#email').val()

   $('#username').val(email)
   
   $.ajax({
      type: "POST",
      dataType: "json",
      url: "<?php echo base_url()."user/check_user_json";?>", //Relative or absolute path to response.php file
      data:{ 'email': $('#email').val()},
      success: function(data) {
        if(data.response=='false'){
						
						 $('#err').html(data.msg);
							$( '#err' ).addClass( "alert-danger alert-dismissable" );
							$(".edit_user,#create_new").attr("disabled", "disabled");
							}else if(data.response=='true'){
								
								$("#err").empty();
								$("#err").removeClass("alert-danger alert-dismissable");
								$( '#err' ).addClass( "alert-success alert-dismissable" );
								$(".edit_user,#create_new").attr("disabled", false);
								$('#err').html(data.msg);
								
								
							}
      }
    });
    return false;
  });

  $('#email').bind('input change paste keyup mouseup',function() {
  	// var email = $('#email').val();   	   	
   	
   	$.ajax({
      type: "POST",
      dataType: "json",
      url: "<?php echo base_url()."user/check_user_json";?>", //Relative or absolute path to response.php file
      data:{ 'email': $('#email').val()},
      beforeSend: function(){
        	$('#processing').html('Checking Email...');

      },
      success: function(data) {
      	// console.log(data);
        if(data.response=='false'){
        	$('#processing').html(data.msg);
			$( '#processing' ).addClass( "alert-danger alert-dismissable" );
			$("#create_new").attr("disabled", "disabled");
		}else if(data.response=='true'){
			$("#processingr").val('');
			$("#processing").removeClass("alert-danger alert-dismissable");
			$('#processing' ).addClass( "alert-success alert-dismissable" );
			$("#create_new").attr("disabled", false);
			$('#processing').html(data.msg);
		}
      }
    });
    return false;
	});

$("#create_new").click(function() {

      var first_name = $('#first_name').val();
      var last_name = $('#last_name').val();
      var telephone = $('#telephone').val();
      var email = $('#email').val();
      var username = $('#username').val();
      var facility_id = $('#facility_select').val();
      var district_name = '<?php echo $district_id ?>';
      var user_type = $('#user_type').val();
   	if(first_name==""||last_name==""||telephone==""||email==""||user_type=="NULL"||district_name=="NULL"){
		alert('Please make sure you have selected all relevant fields.');
	return;
	}

      var div="#processing";
      var url = "<?php echo base_url()."user/addnew_user_offline";?>";
      ajax_post_process (url,div);
      loadStep2();
    });

function ajax_post_process (url,div){
    var url =url;

     //alert(url);
    // return;
     var loading_icon="<?php echo base_url().'assets/img/Preloader_4.gif' ?>";
     var facility_code = $("#facility_select").val();
     // alert(facility_code);
     $.ajax({
          type: "POST",
          data:{ 'first_name': $('#first_name').val(),'last_name': $('#last_name').val(),
          'telephone': $('#telephone').val(),'email': $('#email').val(),
          'username': $('#username').val(),'facility_id': facility_code,
          'district_name': $('#district_name').val(),'user_type': $('#user_type').val()},
          url: url,
          beforeSend: function() {
           
            var message = confirm("Are you sure you want to proceed?");
        if (message){
            $('.modal-body').html("<img style='margin:30% 0 20% 42%;' src="+loading_icon+">");
        } else {
            return false;
        }
           
          },
          success: function(msg) {
          	
          	//$('.modal-body').html(msg);return;
         
        setTimeout(function () {
          	$('.modal-body').html("<div class='bg-warning' style='height:30px'>"+
							"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"+
							"<h3 style='font-size:12px'>Success!!! A new user was added to the system. Please Close to continue</h3></div>")
							
			$('.modal-footer').html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>")
				
        }, 4000);
            
                  
          }
        }); 
        
}


	function change_status_new(facility_code,stati,add_users){//seth      
      message = "";
     
      var loading_icon="<?php echo base_url().'assets/img/Preloader_4.gif' ?>";
      // alert(stati);

      $.ajax({
          type:"POST",
          data:{
            'facility_code': facility_code,
            'status': stati
        },

      url:"<?php echo base_url()."facility_activation/change_status_new";?>",

      beforeSend: function() {
       
    	},
        success: function(msg){            	
          var data = jQuery.parseJSON(msg);
          using_hcmp = data.using_hcmp;
          date = data.date_of_activation;
          // var date = jQuery.parseJSON(msg.date_of_activation);
          if(using_hcmp==1){
        	message_after = "Facility: "+ facility_code +" has been Activated";
        	// $('#chkbx_'+facility_code).removeAttr('checked');	        	
        	// $('#chkbx_'+facility_code).addAttr('checked');	        	
        	$('#chkbx_'+facility_code).prop('checked' ,true);
        	$('#date_'+facility_code).html(date);
        	$('#btn_'+facility_code).html('Deactivate');
        	$('#btn_'+facility_code).attr('data-value','1');
        	$('#btn_'+facility_code).removeClass('btn-success');
        	$('#btn_'+facility_code).addClass('btn-danger');
        	$('#btn_'+facility_code).removeClass('activate');
        	$('#btn_'+facility_code).addClass('deactivate');
        	if(add_users==1){
        		var base_url = "<?php echo base_url().'user/user_create_multiple/' ?>";
   				window.location.href = base_url+facility_code;	      
        	}
        	  	
          }else{
          	message_after = "Facility: "+ facility_code +" has been Deactivated";
        	$('#chkbx_'+facility_code).removeAttr('checked');	        	
        	// $('#chkbx_'+facility_code).addAttr('checked');
        	// $('#chkbx_'+facility_code).prop('checked' ,false);	        	
        	$('#date_'+facility_code).html('Not Active');	 
        	$('#btn_'+facility_code).html('Activate');
        	$('#btn_'+facility_code).attr('data-value','0');
        	$('#btn_'+facility_code).removeClass('deactivate');
        	$('#btn_'+facility_code).addClass('activate');	  
        	$('#btn_'+facility_code).removeClass('btn-danger');	        	      	
        	$('#btn_'+facility_code).addClass('btn-success ');
        	

          }
          alertify.set({ delay: 10000 });
          alertify.success(message_after, null);
        }

      });
    }//end of change status function
		function initialize_checkboxes(){
			$('#btnNoActivate').click(function() {
		    message_denial = "No action has been taken";
        	alertify.set({ delay: 10000 });
         	alertify.success(message_denial, null);       
		  	$('#confirmActivateModal').modal('hide');
		  	 return false;
		});
		$('#btnNoDeactivate').click(function() {
		    message_denial = "No action has been taken";
        	alertify.set({ delay: 10000 });
         	alertify.success(message_denial, null);       
		  	$('#confirmDeActivateModal').modal('hide');
		  	 return false;
		});
		$('#btnYesActivate').click(function() {
		    // handle deletion here
		  	var facility_code = $('#confirmActivateModal').data('id');
		  	change_status_new(facility_code,0,0);
		  	$('#confirmActivateModal').modal('hide');
		});
		$('#btnYesDeactivate').click(function() {
		    // handle deletion here
		  	var facility_code = $('#confirmDeActivateModal').data('id');
		  	change_status_new(facility_code,1,0);
		  	$('#confirmDeActivateModal').modal('hide');
		});
   		$('.deactivate').on('click', function(e) {
		    e.preventDefault();
		    var facility_code = $(this).data('id');
		    $('#confirmDeActivateModal').data('id', facility_code).modal('show');
		    var base_url = "<?php echo base_url() . 'facility_activation/get_facility_user_data/'; ?>";
		    var url = base_url+facility_code;
		    var oTable = $('.confirm_deactivate_table').dataTable(
			{	
				retrieve: true,
    			paging: false,
				"bPaginate":false, 
			    "bFilter": false,
			    "bSearchable":false,
			    "bInfo":false
			});				
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){
				// console.log(s);
				// alert(s);
				oTable.fnClearTable();
				for(var i = 0; i < s.length; i++) {
					oTable.fnAddData([
					s[i][0],
					s[i][1],
					s[i][2]
					]);
					} // End For
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		    
		});

		$('.activate').on('click', function(e) {
		    e.preventDefault();
		    var id = $(this).data('id');
		    $('#confirmActivateModal').data('id', id).modal('show');
		});
		}

		$('.modal').on('hidden.bs.modal', function(e)
    { 
        $(this).removeData();
    }) ;
		
	
	
				
	

    function change_status(facility_code,stati,checked){//seth
      // alert(checked);return;
      message = "";
      if (stati == 0) {
        message_after = "Facility: "+ facility_code +" has been Deactivated";
      }else{
        message_after = "Facility: "+ facility_code +" has been Activated";

      };
      var loading_icon="<?php echo base_url().'assets/img/Preloader_4.gif' ?>";
      // alert(stati);

      $.ajax({
          type:"POST",
          data:{
            'facility_code': facility_code,
            'status': stati
        },

          url:"<?php echo base_url()."facility_activation/change_status";?>",

          beforeSend: function() {
            //$(div).html("");
            // alert($('#email_recieve_edit').prop('checked'));return;
            var answer = confirm("Are you sure you want to proceed?");
            if (answer){
                $('.modal-body').html("<img style='margin:30% 0 20% 42%;' src="+loading_icon+">");
            } else {
            	message_denial = "No action has been taken";
            	alertify.set({ delay: 10000 });
             	alertify.success(message_denial, null);
            	if (checked == "checked") {
            		// alert("im checked");
            		$('input[data-attr="'+facility_code+'"]').prop('checked' ,false);
            	}else{
            		// alert("im unchecked");
            		$('input[data-attr="'+facility_code+'"]').prop('checked' ,true);


            	};
                return false;
            }},
            success: function(msg){
            	// alert(msg);return;
              alertify.set({ delay: 10000 });
              alertify.success(message_after, null);
            }

        });
    }//end of change status function
			
			});
    </script>

<div class="modal fade" id="confirmActivateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Activation</h4>
      </div>
      <div class="modal-body" style="font-size:14px;text-align:centre">
        <p>This facility will now be active and users will be able to submit data. <p/>
        <p>Confirm Activation?</p>
      </div>
      <div class="modal-footer">
        <button type="button"  id="btnYesActivateNoUsers" class="btn btn-success" data-dismiss="modal">Activate</button>
        <button type="button"  id="btnNoActivate" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <!-- <button type="button" id="btnYesActivate" class="btn btn-primary" id="btn-ok">Activate adding Users</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="confirmDeActivateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Deactivation</h4>
      </div>
      <div class="modal-body" style="font-size:14px;text-align:centre">
      <center>
      	<!-- <center><img src="<?php echo base_url().'assets/img/Alert_resized.png'?>" style="height:150px;width:150px;"></center><br/> -->
        <p>The following users are currently active under this facility. Deactivation of the facility will render them unable to use the system.</p>
        <table  id="confirm_deactivate_table" class="display table table-bordered confirm_deactivate_table" cellspacing="0" width="100%">
        	<thead>
        		<tr><th>User Details</th><th>Date Activated</th><th>Date Last Logged In</th></tr>
        	</thead>
        	<tbody></tbody>
        </table>
         <br/>Are you sure you want to deactivate this facility?</p>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button"  id="btnNoDeactivate"  class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnYesDeactivate" class="btn btn-danger" id="btn-ok">Yes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal add user -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="myform">
	<div class="modal-dialog editable" >
		<div class="modal-content">
			<div class="modal-header" style="">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel" style="text-align: center;line-height: 1">Add User</h4>
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
							<!--
								<legend style="font-size:1.5em">
									Add User
								</legend>
								-->

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">First Name</span>
									<input type="text" required="required" name="first_name" id="first_name" class="form-control " placeholder="Enter First Name" >
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">Last Name</span>
									<input type="text" name="last_name" required="required" id="last_name" class="form-control " placeholder="Last Name" >
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">Phone Number</span>
									<input type="telephone" name="telephone" required="required" id="telephone" class="form-control " placeholder="Enter Phone Number eg, 254" tabindex="5">
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">Email</span>
									<input type="email" name="email" id="email" required="required" class="form-control " placeholder="email@domain.com" tabindex="6">
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">User Name</span>
									<input type="email" name="username" id="username" required="required" class="form-control " placeholder="email@domain.com" tabindex="5" readonly>
								</div>

								<div class="input-group form-group u_mgt">
									<span class="input-group-addon sponsor">User Type</span>
									<select class="form-control " id="user_type" name="user_type" required="required">
												<option value='NULL'>Select User type</option>
												<?php
												foreach ($user_types as $user_types) :
													$id = $user_types ['id'];
													$type_name = $user_types ['level'];
													echo "<option value='$id'>$type_name</option>";
												endforeach;
												?>
									</select>
								</div>
									<?php

									$identifier = $this -> session -> userdata('user_indicator');
									
									if ($identifier=='district') {
									?>
									


									<?php }elseif ($identifier=='county') { ?>
									<div class="input-group form-group u_mgt">
										<span class="input-group-addon sponsor">Subcounty Name</span>
										<select class="form-control " id="district_name" required="required">
											<option value=''>Select Sub-County</option>

											<?php
											foreach ($district_data as $district_) :
												$district_id = $district_ ['id'];
												$district_name = $district_ ['district'];
												echo "<option value='$district_id'>$district_name</option>";
											endforeach;
											?>
										</select>
									</div>

									<div class="input-group form-group u_mgt">
										<span class="input-group-addon sponsor">Facility Name</span>
										<select class="form-control " id="facility_id" required="required">
												<option value="">Select Facility</option>
												
										</select>

									</div>

								<?php }?>
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
				
				<button class="btn btn-primary borderless" id="create_new">
					Save changes
				</button>
			</div>
		</div>
	</div>
</div><!-- end Modal new user -->
