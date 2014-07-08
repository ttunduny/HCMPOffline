<style>
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
		
	
</style>


<div class="container-fluid">
	
	<div class="row" style="margin-top: 1%;">
		<div class="col-md-12">
			
			<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span>User Settings</a></li>
  <li><a href="#profile" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Graphs & Statistics</a></li>
</ul>

<div class="tab-content" style="margin-top: 5px;">
  <div class="tab-pane active" id="home">
  	 <?php 
  	 $this -> load -> view('Admin/user_listing_v');
  	 ?>
  	
  </div>
  <div class="tab-pane" id="profile">stats</div>
</div>

		</div>
	</div>
	
	
</div>




<script>
	
	$(document).ready(function () {
		
		$("#sub_county").hide(); 
		$("#facility_name").hide();
		
		$('#myTab a').click(function (e) {
 		 e.preventDefault()
  			$(this).tab('show')
})

$('#add_new').click(function () {
	
 		 $('#addModal').appendTo("body").modal('show');
})

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
  $('div.dataTables_filter input').addClass('form-control search');
  $('div.dataTables_length select').addClass('form-control');

		
		oTable = $('#datatable').dataTable();
			
			$('#active').click(function () {
				
				oTable.fnFilter('active');
			})
			
			$('#inactive').click(function () {
				
				oTable.fnFilter('deactivated');
		
			})
			
			
			$("#county").change(function() {
    var option_value=$(this).val();
    
    if(option_value=='NULL'){
    $("#sub_county").hide('slow'); 
    }
    else{
var drop_down='';
 var hcmp_county_api = "<?php echo base_url(); ?>reports/get_sub_county_json_data/"+$("#county").val();
  $.getJSON( hcmp_county_api ,function( json ) {
     $("#sub_county").html('<option value="NULL" selected="selected">Select Sub County</option>');
      $.each(json, function( key, val ) {
        drop_down +="<option value='"+json[key]["id"]+"'>"+json[key]["district"]+"</option>"; 
      });
      $("#sub_county").append(drop_down);
    });
    $("#sub_county").show('slow');   
    }
    
    }); 
    
    $("#sub_county").change(function() {
    var option_value=$(this).val();
    
    if(option_value=='NULL'){
    $("#facility_name").hide('slow'); 
    }
    else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json/"+$("#sub_county").val();
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#facility_name").html('<option value="NULL" selected="selected">Select Facility</option>');
      $.each(json, function( key, val ) {
        drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>"; 
      });
      $("#facility_name").append(drop_down);
    });
    $("#facility_name").show('slow'); 
  // console.log(hcmp_facility_api)  
    }
    }); 
    
    $("#create_new").click(function() {

      var first_name = $('#first_name').val()
      var last_name = $('#last_name').val()
      var telephone = $('#telephone').val()
      var email = $('#email').val()
      var username = $('#username').val()
      var facility_id = $('#facility_name').val()
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
     var loading_icon="<?php echo base_url().'assets/img/Preloader_4.gif' ?>";
     $.ajax({
          type: "POST",
          data:{ 'first_name': $('#first_name').val(),'last_name': $('#last_name').val(),
          'telephone': $('#telephone').val(),'email': $('#email').val(),
          'username': $('#username').val(),'facility_id': $('#facility_id').val(),
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
         
        setTimeout(function () {
          	$('.modal-body').html("<div class='bg-warning' style='height:30px'>"+
							"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"+
							"<h3>Success!!! A new user was added to the system. Please Close to continue</h3></div>")
							
			$('.modal-footer').html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>")
				
        }, 4000);
            
                  
          }
        }); 
        $('#myModal').on('hidden.bs.modal', function () {
				$("#datatable").hide().fadeIn('fast');
				 location.reload();
			})
}
		
		$("#user_type").change(function() {
	
      		var type = $('#user_type').val()
      		
      		if (type==10){
            $('#username').val($('#county option:selected').text()+'@hcmp.com')
        } 
           
    	});	
	});
	
	
</script>