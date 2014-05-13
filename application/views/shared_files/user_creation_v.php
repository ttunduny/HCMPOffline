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
.status_item {

padding: auto;
color: #fff;
text-align: center;

}
.panel{
	border-radius: 0;
}
.panel-body {
padding: 8px;
}
#addModal .modal-dialog
{
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
    <th>Action</th>
    
  </tr>
  </thead>
      
    <tbody>
    
     
           <?php   
           $total=0;
        foreach ($listing as $list ) { 
               
                ?>    
            <tr>                          
              <td class="name"><?php echo $list['fname'].' '.$list['lname'];?> </td>
              <td><?php echo $list['email']; ;?> </td>
              <td><?php echo $list['telephone'];?> </td>
              <td><?php echo $list['facility_name'];?> </td>
              <td><?php echo $list['level'];?> </td>
              <td>
                 <?php 

                      if ($list['status']==1) {
                     

                  ?>
                  <div class="status_item color_d">
                        <span>Active</span>
                  </div>
                  <?php

                      }else{ ?>

                      <div class=" status_item color_g">
                        <span>Deactivated</span>
                      </div>

                      <?php } ?>



                </td>
                <td><button class="btn btn-primary btn-xs edit " data-toggle="modal" id="<?php echo $list['user_id'];?>" 
                  data-target="#"><span class="glyphicon glyphicon-edit"></span>Edit</button></td>
              
            </tr>
         <?php
}
         ?>
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
        <h5>Add <small>New user</small></h5>
      </div>
      <div class="modal-body" style="padding-top:0">
       <div class="row" style="margin:auto">
    <div class="col-md-12 ">
    <form role="form">
      
      <hr class="colorgraph">

      <fieldset>
        <legend style="font-size:1.5em">User details</legend>
      <div class="row" >

        <div class="col-md-6">
          <div class="form-group">
                        <input type="text" name="first_name" id="first_name" class="form-control " placeholder="First Name" >
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input type="text" name="last_name" id="last_name" class="form-control " placeholder="Last Name" >
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class=" col-md-6">
          <div class="form-group">
            <input type="telephone" name="telephone" id="telephone" class="form-control " placeholder="telephone eg, 254" tabindex="5">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input type="email" name="email" id="email" class="form-control " placeholder="email@domain.com" tabindex="6">
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-md-6">
          <div class="form-group">
            <input type="email" name="username" id="username" class="form-control " placeholder="email@domain.com" tabindex="5">
          </div>
        </div>
        <div class="col-md-6">
          
        </div>
      </div>
    </fieldset>
    <fieldset>
        <legend style="font-size:1.5em">Other details</legend>
      <div class="row" >
<?php 

$identifier = $this -> session -> userdata('user_indicator');

if ($identifier=='district') {
                ?>

        <div class="col-md-6">
          <div class="form-group">

            <select class="form-control " id="user_type">
              <option>Select Facility</option>

              <?php
foreach($facilities as $facilities):
    $id=$facilities->facility_code;
    $facility_name=$facilities->facility_name;  
    echo "<option value='$id'>$facility_name</option>";
endforeach;
              ?>
            </select>
            
                   </div>
        </div>
        

       <?php }elseif ($identifier=='county') {
        
       ?> 
<div class="col-md-6">
          <div class="form-group">

            <select class="form-control " id="district_name">
              <option>Select Sub-County</option>

             <?php
foreach($district_data as $district_):
    $district_id=$district_->id;
    $district_name=$district_->district;  
    echo "<option value='$district_id'>$district_name</option>";
endforeach;
?>
            </select>
            
                   </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
           <select class="form-control " id="facility_name">
              <option value="NULL">Select Facility</option>

              
            </select>
          </div>
        </div>
         </div>
        
         <?php }elseif ($identifier=='facility_admin') {
        }
       ?> 
<div class="row" style="margin:auto">
      <div class=" col-md-6">
          <div class="form-group">
             <select class="form-control " id="user_type" name="user_type">
              <option>Select User type</option>
 <?php
foreach($user_types as $user_types):
    $id=$user_types->id;
    $type_name=$user_types->level;  
    echo "<option value='$id'>$type_name</option>";
endforeach;
?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          
        </div>
        </div>

     
      
      
    </fieldset>
      
      
      <hr class="colorgraph">
     
    </form>
  </div>
</div>
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

$("#district_name").change(function() {
    var option_value=$(this).val();
    
    if(option_value=='NULL'){
    $("#facility_name").hide('slow'); 
    }
    else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+$("#district_name").val();
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#facility_name").html('<option value="NULL" selected="selected">Select Facility</option>');
      $.each(json, function( key, val ) {
        drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>"; 
      });
      $("#facility_name").append(drop_down);
    });
    $("#facility_name").show('slow');   
    }
    }); 

$(".edit").click(function() {




  });


});
    </script>