<style type="text/css">
.row div p,.row-fluid div p{
	padding:10px;

}
.form-control {

font-size: 12px !important;
}
</style>
<link href="<?php echo base_url().'assets/bower_components/intro.js/introjs.css'?>" type="text/css" rel="stylesheet"/>
<div class="container-fluid" style="">

	<div class="row">
		<div class="col-md-6" id=""><p class="bg-info"><span class="badge ">1</span>
		<strong>Add multiple Users Below <?php echo $facility_banner_text; ?></strong></p></div>
		<div class="col-md-6" id="">

	</div>
	</div>
	
		
	<hr />
	<center>
	<div style="width:94%">
<div class="table-responsive" style="min-height:300px; overflow-y: auto;">
 <?php $att=array("name"=>'myform','id'=>'myform','method'=>'post','enctype'=>'application/x-www-form-urlencoded'); echo form_open('user/users_create_multiple',$att); ?>
<table  class="table table-hover table-bordered table-update" id="add_multiple_users_table"> 
	<thead style="background-color: white">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Phone Number</th>
			<th>Email</th>
			<th>User Name</th>
			<th>User Type</th>
			<?php

			$identifier = $this -> session -> userdata('user_indicator');

			if ($identifier=='county') {
			?>
			<!-- <th>Subcounty Name</th> -->
			<?php } ?>
			<!-- <th>Facility Name</th>	  -->
			<th>Action</th>   
		</tr>
	</thead>
					<tbody>
						<tr row_id='0'>
						<td>
						<input type="text" required="required" name="first_name[0]" id="first_name" class="form-control first_name" placeholder="Enter First Name" >
						</td>
						<td>
						<input type="text" name="last_name[0]" required="required" id="last_name" class="form-control last_name" placeholder="Last Name" >
						</td>
						<td>
						<input type="telephone" name="telephone[0]" required="required" id="telephone" class="form-control telephone" placeholder="254 XXX XXX XXX" tabindex="5">
						</td>
						<td>
						<input type="email" name="email[0]" id="email" required="required" class="form-control email" placeholder="email@domain.com" tabindex="6">
						</td>
						<td>
						<input type="email" name="username[0]" id="username" required="required" class="form-control username" placeholder="email@domain.com" tabindex="5" disabled="disabled">
						</td>
						<td>
						<div class="input-group form-group u_mgt">
									<select class="form-control user_type" id="user_type" name="user_type[0]" required="required">
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
						</td>
						<!-- <td> -->
							<?php

									$identifier = $this -> session -> userdata('user_indicator');

									if ($identifier=='district') {
									?>
									<div class="input-group form-group u_mgt">
									<input type="hidden" class="form-control facility_id" id="facility_id" name="facility_id[0]"/>
										
									</div>


									<?php }elseif ($identifier=='county') { ?>
									<div class="input-group form-group u_mgt">
										<input type="hidden" class="form-control district_name" id="district_name" name="district_name[0]"/>										
									</div>
									<!-- </td> -->
									<!-- <td> -->
									<div class="input-group form-group u_mgt">
										<input type="hidden" class="form-control facility_id" id="facility_id" name="facility_id[0]"/>										

									</div>

								<?php }elseif ($identifier=='facility_admin') {
									//code if facility admin
									
								?>
								<div class="input-group form-group u_mgt">
										<select class="form-control user_type" id="user_type" name="user_type[0]" required="required">
													<option value=''>Select User type</option>
													<?php
													foreach ($user_types as $user_type) :
														$display_id = $user_type ['id'];
														$name = $user_type ['level'];
														echo "<option value='$display_id'>$name</option>";
													endforeach;
													?>
										</select>
								</div>
								<?php }?>
						<!-- </td> -->
						<td>
							<button type="button" class="remove btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span>row</button>
							<button type="button" id="step7" class="add btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>row</button>
						</td>
			</tr>
		           </tbody>
		           </table>
</div>
</div>
</center>
<hr />
<div class="container-fluid">
<div style="float: right">
<button class="btn btn-primary borderless" id="create_new">
					Save Users
				</button>
</div>
</div>
</form>
<?php //echo form_close();?>
<script>
$(document).ready(function() {	
		var no_of_facilities = '<?php echo $no_of_facilities;?>';
		var district_name = '<?php echo $district_name;?>';
		var district_id = '<?php echo $district_id;?>';
		var facility_code = '<?php echo $facility_code;?>';
		if(no_of_facilities==1)
		{
			$('.facility_id').val(facility_code);
			$('.district_name').val(district_id);
		}
		var count_rows=0;
$("#create_new").click(function(){
	$("#myform").submit();
});

 var $table = $('table');
//float the headers
  $table.floatThead({ 
	 scrollingTop: 100,
	 zIndex: 1001,
	 scrollContainer: function($table){ return $table.closest('.table-responsive'); }
	});	

        $(".add").click(function() {
        var selector_object=$('#add_multiple_users_table tr:last');
        var form_data=check_if_the_form_has_been_filled_correctly(selector_object);
        if(isNaN(form_data[0])){
        var notification='<ol>'+form_data[0]+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;';
           //hcmp custom message dialog
           hcmp_message_box(title='HCMP error message',notification,message_type='error')
       // dialog_box(notification,'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
        return;   }// set the balance here
			//reset the values of current element */
		  clone_the_last_row_of_the_table();
		});	/////batch no change event

		$('.remove').on('click',function(){
			var row_id=$(this).closest("tr").index();
            var count_rows=$('#add_multiple_users_table tr').length;
            count_rows--;
	       //finally remove the row 
	       if(count_rows==1){
	       	 clone_the_last_row_of_the_table();
	       	 $(this).parent().parent().remove(); 
	       }else{
	       	$(this).parent().parent().remove(); 
	       }	         
      });
    // validate the form
	$("#myform").validate();
      /************save the data here*******************/
	$('.save').button().click(function() {
		var selector_object=$('#add_multiple_users_table tr:last');
        var form_data=check_if_the_form_has_been_filled_correctly(selector_object);
        if(isNaN(form_data[0])){
        var notification='<ol>'+form_data[0]+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;';
           //hcmp custom message dialog
           hcmp_message_box(title='HCMP error message',notification,message_type='error')
       // dialog_box(notification,'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
        return; }
    $("input[name^=commodity_id]").each(function() {
                	$(this).closest("tr").find(".batch_no").removeAttr('disabled'); 
                	$(this).closest("tr").find(".commodity_unit_of_issue").removeAttr('disabled'); 	
                	$(this).closest("tr").find(".desc").removeAttr('disabled');  	
                	$(this).closest("tr").find(".commodity_unit_of_issue").removeAttr('disabled');	
                	});
    // save the form
    
    confirm_if_the_user_wants_to_save_the_form("#myform");
     });
     /************************* form validation ************/
        function clone_the_last_row_of_the_table(){
            var last_row = $('#add_multiple_users_table tr:last');
            var cloned_object = last_row.clone(true);
            var table_row = cloned_object.attr("row_id");
            var next_table_row = parseInt(table_row) + 1;    
            var blank_value = "";       
		    cloned_object.attr("row_id", next_table_row);
			cloned_object.find(".first_name").attr('name','first_name['+next_table_row+']'); 
			cloned_object.find(".last_name").attr('name','last_name['+next_table_row+']'); 
			cloned_object.find(".telephone").attr('name','telephone['+next_table_row+']');
			cloned_object.find(".email").attr('name','email['+next_table_row+']');
			// cloned_object.find(".commodity_id").attr('id',next_table_row); 
			cloned_object.find(".username").attr('name','username['+next_table_row+']'); 	
			cloned_object.find(".user_type").attr('name','user_type['+next_table_row+']'); 
			cloned_object.find(".facility_id").attr('name','facility_id['+next_table_row+']'); 
			cloned_object.find(".user_type").attr('name','user_type['+next_table_row+']'); 
            cloned_object.find("input").val(blank_value);
            cloned_object.find("label.error").remove();             
			cloned_object.insertAfter('#add_multiple_users_table tr:last');	
        }
		function check_if_the_form_has_been_filled_correctly(selector_object){
		var alert_message='';
		var service_point=selector_object.closest("tr").find(".service_point").val();
		var commodity_id=selector_object.closest("tr").find(".desc").val();
		var issue_date=selector_object.closest("tr").find(".clone_datepicker_normal_limit_today").val();
		var issue_quantity=selector_object.closest("tr").find(".quantity_issued").val();
		//set the message here
		if (service_point==0) {alert_message+="<li>Select a Service Point</li>";}
	    if (commodity_id==0) {alert_message+="<li>Select a commodity first</li>";}
	    if (issue_date==0) {alert_message+="<li>Indicate the date of the issue</li>";}	
	    if (issue_quantity==0) {alert_message+="<li>Indicate how much you want to issue</li>";}	    
	    return[alert_message,service_point,commodity_id,issue_quantity,issue_date];	
		}//extract facility_data  from the json object 		
		function extract_data(commodity_id_,commodity_stock_row_id,type_of_drop_down){
			var row_id=0; var dropdown='';var facility_stock_id_='';  var total_stock_bal=0; var expiry_date='';
			$.each(facility_stock_data, function(i, jsondata) {
			var commodity_id=facility_stock_data[i]['commodity_id'];
			if(parseInt(commodity_id)==commodity_id_){
				if(type_of_drop_down=='batch_data'){//check if the user option is to create a batch combobox
					if(row_id==0){//if the row is 0, create a selected default value
					var facility_stock_id=facility_stock_data[i]['facility_stock_id'];	
			  		dropdown+="<option selected='selected'"+
			  		 "special_data="+facility_stock_data[i]['expiry_date']+
			  		 "^"+facility_stock_data[i]['commodity_balance']+
			  		 "^"+facility_stock_data[i]['facility_stock_id']+
			  		 "^"+facility_stock_data[i]['commodity_balance']+">";
			  				 expiry_date=$.datepicker.formatDate('d M yy', new Date(facility_stock_data[i]['expiry_date']));
			  				 bal=facility_stock_data[i]['commodity_balance'];
			  				 facility_stock_id_=facility_stock_data[i]['facility_stock_id'];
			  				 total_stock_bal=facility_stock_data[i]['commodity_balance'];
			  				 drug_id_current=commodity_id_;			  				 
			  			}else{
			  		dropdown+="<option "+
			  		 "special_data="+facility_stock_data[i]['expiry_date']+
			  		 "^"+facility_stock_data[i]['commodity_balance']+
			  		 "^"+facility_stock_data[i]['facility_stock_id']+
			  		 "^"+facility_stock_data[i]['commodity_balance']+">";	 
			  			total_stock_bal=facility_stock_data[i]['commodity_balance'];}			  			
						dropdown+=facility_stock_data[i]['batch_no'];						
						dropdown+="</option>";}
			row_id++; //auto-increment the checker
			}
				});
			return 	[dropdown,facility_stock_id_,total_stock_bal,expiry_date];
		}
		 $('.toolt').tooltip({
        placement: 'left'
    }); 
	});	


$('.email').keyup(function(e) {
  var row_id  =   $(this).closest('tr').attr('row_id')
  var username = 'username['+row_id+']';
  var email =  $(this).closest('.email').val();
  $("input[name='"+username+"'").val(email);
   // $('.username').val(email)

   
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

</script>
 <script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
              {
                element: '#step1',
                intro: "Select <i>Service point</i> <b>here.</b> ."
              },
              {
                element: '#step2',
                intro: "Select, <i>Commodity</i> <b>here.</b>This will populate the batch no. ",
                position: 'right'
              },
              {
                element: '#step3',
                intro: "Select, <i>Batch No</i> <b>here.</b>This will populate the Expiry date. ",
                position: 'right'
              },
              {
                element: '#step4',
                intro: "Select, <i>Issue date</i> <b>here.</b> ",
                position: 'right'
              },
              {
                element: '#step5',
                intro: "Select, <i>Issue type</i> <b>here.</b> ",
                position: 'right'
              },
              {
                element: '#step6',
                intro: 'Enter, <i>Issue Quantity</i> <b>here.</b>',
                position: 'bottom'
              },
              {
                element: '#step7',
                intro: "<span style='font-family: Tahoma'>Click here to Issue more commodities</span>",
                position: 'left'
              },
              {
                element: '#step8',
                intro: "<span style='font-family: Tahoma'>Click here to remove commodities</span>",
                position: 'left'
              },
              {
                element: '#step9',
                intro: "<span style='font-family: Tahoma'>Click here to Complete  activity</span> ",
                position: 'left'
              }
            ]
          });

          intro.start();
      }
    </script>
   <script src="<?php echo base_url().'assets/bower_components/intro.js/intro.js'?>" type="text/javascript"></script>