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

<div class="container-fluid">
	<div class="page_content">

		<div class="container-fluid">

			<div class="row">

				<div class="col-md-12" style="padding-left: 3%; right:0; float:right; margin-bottom:5px;margin-left:3%;">
					<input type="text" class="form-control" id="patient_number" name="patient_number" placeholder="Enter the Patient Number" style="width:20%;float:left;" />
					<button class="btn btn-primary" id="find_patient">
						<span class="glyphicon glyphicon-search"></span>Find
					</button>
				</div>
				<br/>
				<div style="border:1px solid #ccc;height:auto;width:96%;float:left;;margin-left:3%;">
					<div style="padding-left:1%;width:24%;height:300px;background-color:#428bca;border:1px ridge #e3e3e3;float:left;color:#ffffff">
						<br/>
						Patient Number: <input type="text" id="p_no" disabled="disabled" style="width:80%;float-left;" class="form-control"><br/>
						Name: <input type="text" id="name" disabled="disabled" style="width:80%" class="form-control"><br/>
						DOB: <input type="text" id="dob" disabled="disabled" style="width:80%" class="form-control"><br/>
						Gender: <input type="text" id="gender" disabled="disabled" style="width:80%" class="form-control"><br/>
					</div>
					<div style="padding-left:1%;width:76%;height:300px;background-color:#ffffff;border:1px ridge #e3e3e3;float:left;">
						<br/>
						Drugs: <input type="text" id="p_no" disabled="disabled" style="width:76%;float-left;" class="form-control"><br/>
						Name: <input type="text" id="name" disabled="disabled" style="width:80%" class="form-control"><br/>
						DOB: <input type="text" id="dob" disabled="disabled" style="width:80%" class="form-control"><br/>
						Gender: <input type="text" id="gender" disabled="disabled" style="width:80%" class="form-control"><br/>
					</div>
					<br/>
					<div style="padding-left:1%;width:50%;height:250px;float:left;margin-top:3%">					
						<h4>Diagnosis</h4>
						<textarea style="width:96%;height:90%;overflow:scroll;"></textarea>
					</div>
					<div style="padding-left:1%;width:50%;height:250px;float:left;margin-top:3%">
						<h4>Prescription</h4>
						<textarea style="width:96%;height:90%;overflow:scroll;"></textarea>
					</div>
					<br/>
					<button class="btn btn-success" id="dispense" style="width:20%;height:120%;margin-left:1%;margin-bottom:3%;margin-top:1%">
						Dispense
					</button>
				</div>
			
			</div>

		</div>
	</div>
</div>

<script>
$(document).ready(function () {
 
   
$("#find_patient").click(function() {

  var patient_number = $('#patient_number').val();
  var url = "<?php echo base_url()."dispensing/get_patient_detail";?>";      
  var loading_icon="<?php echo base_url().'assets/img/Preloader_4.gif' ?>";      
   if(patient_number==""){
		alert('Please make sure you have filled in all required  fields.');
		return;
	}
	$.ajax({
        type: "POST",
        url: url,
        data:{'patient_number': patient_number},
        dataType: "html",
        // async: !1,
        // beforeSend: function() {
	       //  var message = confirm("Are you sure you want to proceed?");
	       //  if (message){
	       //      $('.modal-body').html("<img style='margin:30% 0 20% 42%;' src="+loading_icon+">");
	       //  } else {
	       //      return false;
	       //  }           
        //   },
        success: function(msg) {
       		var patient_details = JSON.parse(msg);
       		console.log(patient_details);
       		var p_no = patient_details[0];
       		var name = patient_details[1];
       		var gender = patient_details[2];
       		var dob = patient_details[3];
       		$('#name').val(name);
       		$('#dob').val(dob);
       		$('#gender').val(gender);
       		$('#p_no').val(p_no);
      	},
        error: function() {
            alert('Error occured');
        }
    });
});

});

</script>
<script src="<?php echo base_url().'assets/bower_components/intro.js/intro.js'?>" type="text/javascript"></script>
