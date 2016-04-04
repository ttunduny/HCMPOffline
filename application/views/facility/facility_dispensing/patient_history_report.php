<?php 	
//Pick values from the seesion 	
$facility_code=$this -> session -> userdata('facility_id');
$district_id=$this -> session -> userdata('district_id');
$county_id =$this -> session -> userdata('county_id'); 

?>
<style>
	.input-small{
		width: 100px !important;
	}
	.input-small_{
		width: 230px !important;
	}
</style>
<div class="row-fluid">
	
<h1 class="page-header" style="margin: 0;font-size: 1.6em;">Patient History</h1>
<div class="alert alert-info" style="width: 100%">
	<b>Proceed to Search for Patients Below </b>
</div>

<div class="col-md-12" style="padding-left: 1%; right:0; float:right; margin-bottom:5px;margin-left:1%;">
	<input type="text" class="form-control" id="patient_number" name="patient_number" placeholder="Enter the Patient Number or First Name or Last Name" style="width:29%;float:left;" />
	<button class="btn btn-primary" id="find_patient">
		<span class="glyphicon glyphicon-search"></span>Find
	</button>
</div>
<div class="col-md-12">
	
<div class="clearfix" style="border:1px solid #ccc;padding:1px;">
	<div class="col-md-4 search_container" style="padding:0 1%;height:100%;background-color:#428bca;border:1px ridge #e3e3e3;float:left;color:#ffffff">
		<h4>Search Results</h4>
		<!-- <textarea id="search_results" disabled="disabled" style="width:96%;height:80%;color:black;"></textarea> -->
		<table class="table table-bordered" id="search_results">
			<thead>
				<th>Name</th>
				<th>Patient No.</th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
<div class="col-md-8" id="history_table">
	<table class="table table-bordered row-fluid datatable">
		<thead>
			<th>Patient Name</th>
			<th>Commodity Name</th>
			<th>Units Dispensed</th>

		</thead>

		<tbody>
				
		</tbody>
	</table>
</div>
</div>

<!-- <div class='graph-section' id='graph-section'></div> -->

<script>
	$(document).ready(function() 
	{

		var search_table = $('#search_results,.datatable').dataTable( {
	   "sDom": "T lfrtip",
	     "sScrollY": "150px",
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

			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
		}
	} );
function clear_dets(){
	var p_no = "";
	var name = "";
	var gender = "";
	var dob = "";
	var names_and_no = "";
	var patient_id = "";

	$('#name').val(name);
	$('#dob').val(dob);
	$('#gender').val(gender);
	$('#p_no').val(p_no);
	$('#p_no').attr('data-patient-id', patient_id);
	$( ".form_patient_id" ).remove();
}

function populate_dets(patient_number){
  	var url = "<?php echo base_url()."dispensing/get_patient_detail";?>";      

	$.ajax({
        type: "POST",
        url: url,
        data:{'patient_number': patient_number},
        dataType: "html",       
        success: function(msg) {
        	console.log(msg);  
	       	var patient_details = JSON.parse(msg);

	       	var p_no = patient_details[0][0];
	       	var name = patient_details[0][1];
	       	var gender = patient_details[0][2];
	       	var dob = patient_details[0][3];
	       	var names_and_no = patient_details[0][4];
	       	var patient_id = patient_details[0][5];	       	
	       	$('#name').val(name);
	       	$('#dob').val(dob);
	       	$('#gender').val(gender);
	       	$('#p_no').val(p_no);
	       	$('#p_no').attr('data-patient-id', patient_id);
	       	// $('#search_results').val(names_and_no);
	       		// $('#search_results').html("<tr><td>"+name+"</td><td>"+p_no+"</td></tr>");
		    $('#dispense_form').append("<input type=\"hidden\" value="+patient_id+" name=\"form_patient_id\" class=\"form_patient_id\">");

	       		 // var search_table = $('#search_results').DataTable().ajax.reload();
	       			// search_table.ajax.reload();
        	

      	},
        error: function() {
            alert('Error occured');
        }
    });

}
$("#find_patient").click(function() {
	  // clear_dets();
	  var patient_number = $('#patient_number').val();
	  var url = "<?php echo base_url()."dispensing/get_patient_detail";?>";      
	  var loading_icon="<?php echo base_url().'assets/img/Preloader_4.gif' ?>";      
   if(patient_number==""){
		swal("Incomplete Data!", "Kindly make sure you have filled in all required  fields");				

		// alert('Please make sure you have filled in all required  fields.');
		return;
	}
	$('#search_results').html("	");
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
        	console.log(msg);
        	if (msg == 0) {
	       		$('#search_results').html("<tr><td colspan = 2> There are no records partaining to your search </td></tr>");

	       		var patient_details = JSON.parse(msg);
	       		// console.log(patient_details);
	       		var p_no = "";
	       		var name = "";
	       		var gender = "";
	       		// var dob = "";
	       		var names_and_no = "";
	       		var patient_id = "";

	       		$('#name').val(name);
	       		$('#dob').val(dob);
	       		$('#gender').val(gender);
	       		$('#p_no').val(p_no);
	       		$('#p_no').attr('data-patient-id', patient_id);
	       		$( ".form_patient_id" ).remove();
        	}else{
	       		var patient_details = JSON.parse(msg);
	       		global_details = JSON.parse(msg);

	       		for (var i = 0; i < patient_details.length; i++) {
	       			var p_no = patient_details[i][0];
		       		var name = patient_details[i][1];
		       		var gender = patient_details[i][2];
		       		var dob = patient_details[i][3];
		       		var names_and_no = patient_details[4];
		       		var patient_id = patient_details[5];
		       		// $('#name').val(name);
		       		// $('#dob').val(dob);
		       		// $('#gender').val(gender);
		       		// $('#p_no').val(p_no);
		       		// $('#p_no').attr('data-patient-id', patient_id);
		       		// $('#search_results').val(names_and_no);
		       		$('#search_results').append("<tr class='clickable-row' data-href='"+p_no+"'><td>"+name+"</td><td>"+p_no+"</td><input type=\"hidden\" value="+i+" class=\"form_patient_row\"></tr>");
		       		// $('#search_results').append("<tr class='clickable-row' data-href='"+p_no+"'><td>"+name+"</td><td>"+p_no+"</td></tr>");
			    	$('#dispense_form').append("<input type=\"hidden\" value="+patient_id+" name=\"form_patient_id\" class=\"form_patient_id\">");
	       			// Things[i]
	       		};
	      
        	};

      	},
        error: function() {
            alert('Error occured');
        }
    });
	$(".search_container").on("click", "table tr", function() {
		var patient_number = $(this).attr('data-href');
		if(patient_number=='undefined'){
			return false;
		}else{
			update_history_table(patient_number);
		}
		// alert(patient_number);
		// var row_id = $(this).find('.form_patient_row').val();	
		// var p_no = global_details[row_id][0];
		// var name = global_details[row_id][1];
		// var gender = global_details[row_id][2];
		// var dob = global_details[row_id][3];
		// // var names_and_no = global_details[4];
		// // var patient_id = global_details[5];
		// $('#name').val(name);
		// $('#dob').val(dob);
		// $('#dispense_form').append("<input type=\"hidden\" value="+p_no+" name=\"form_patient_id\" class=\"form_patient_id\">");
		// $('#gender').val(gender);
		// $('#p_no').val(p_no);
		// $('#p_no').attr('data-patient-id', patient_id);
		$(this).addClass('active');
	} );

	function update_history_table(patient_id){
		// alert("Currently alerting you" + patient_id);
  		var url = "<?php echo base_url()."dispensing/patient_history_ajax";?>";      

		$.ajax({
        type: "POST",
        url: url,
        data:{'patient_id': patient_id},
        // dataType: "html",
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
        	// console.log(msg);return;
      	$('#history_table').html(msg);
      	$('#ajax_history_table').dataTable();
       		 // var search_table = $('#search_results').DataTable().ajax.reload();
       			// search_table.ajax.reload();
       		
      	},
        error: function() {
            alert('Error occured');
        }
    });

    }//end of update history table

});
	});
</script>