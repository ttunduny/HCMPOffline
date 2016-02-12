<style>
 	.input-small{
 		width: 60px !important;
 	}

	.big{ width: 100px !important; }
	.row div p{
	padding:10px;
}
</style>

<div class="container" style="width: 96%; margin: auto;">
	
	<div class="row">
		<div class="col-md-6"><p class="text-danger">*Enter the Sub-County, Facility and Enter the New Quantity</p></div>
		
	</div>
	
 <?php $att=array("name"=>'myform','id'=>'myform'); echo form_open('stock/update_stock_level_external_edit',$att); ?>
 <table width="98%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="redistribution_edit">
	<thead>
		<tr>
			<!-- <th>To be Hidden</th> -->
			<th>Sub-County</th>
			<th>Facility</th>
			<th>Commodity Name</th>
			<th>Commodity Code</th>
			<th>Date Sent</th>
			<th>Unit Size</th>
			<th>Batch No</th>
			<th>Expiry Date</th>
			<th>Manufacturer</th>
			<th>Issue Type</th>	
			<th>Available Batch Stock</th>
			<th>Quantity Sent</th>
			<th>New Quantity</th>
			<th>New Quantity(units)</th>			
			<th>Action</th>			
		</tr>
	</thead>
	<tbody>
		<?php $edit=($editable!='to-me') ? "readonly='readonly'": null;			
		// echo "<pre>";
		// print_r($redistribution_data);die;		
		foreach($redistribution_data as $key => $value){
			$id = $value['id'];
			$manufacturer = $value['manufacturer'];
			$source_facility_code = $value['source_facility_code'];
			$receive_facility_code = $value['receive_facility_code'];
			$commodity_id = $value['commodity_id'];
			$quantity_sent = $value['quantity_sent'];
			$sender_id = $value['sender_id'];
			$batch_no = $value['batch_no'];
			$expiry_date = $value['expiry_date'];
			$facility_stock_ref_id = $value['facility_stock_ref_id'];
			$date_sent = $value['date_sent'];
			$source_district_id = $value['source_district_id'];
			$commodity_name = $value['commodity_name'];
			$current_balance = $value['current_balance'];
			$commodity_code = $value['commodity_code'];
			$district_name = $value['district_name'];
			$receiver_district_id = $value['receiver_district_id'];
			$total_commodity_units = $value['total_commodity_units'];
			$packs=round($quantity_sent/$total_commodity_units,1);	
			$receiving_facility=$value['receiving_facility'];	
			$units = $quantity_sent;
			$unit_size = $value['unit_size'];	
			$date=date('d My',strtotime($expiry_date));
			$date_sent=date('d M Y',strtotime($date_sent));				
			$option_subcounty = '<option value='.$receiver_district_id.'>'.$district_name.'</option>';
			$option_subcounty .= '<option value=\'2\'>District Store</option>';
			foreach ($subcounties as $district) {
					$district_id=$district->id;
					$new_district_name=$district->district;		
					$option_subcounty.= '<option value="'.$district_id.'"> '.$new_district_name.'</option>';					
			}

			$option_facility = '<option value='.$receive_facility_code.'>'.$receiving_facility.'</option>';
			
				// foreach ($subcounties as $district) {
				// 		$id=$district->id;
				// 		$name=$district->district;		
				// 		$option_subcounty.= '<option value="'.$id.'"> '.$name.'</option>';					
				// }
		
			// }
		echo "<tr>
		<input type='hidden' name='source_of_item[]' class='source_of_item' value='$source_of_item'>
		<input type='hidden' name='service_point[]' class='service_point' value='$receive_facility_code'>
		<input type='hidden' name='total_commodity_units[]' class='total_commodity_units' value='$total_commodity_units'>
		<input type='hidden' name='commodity_id[]' class='commodity_id' value='$commodity_id'>
		<input type='hidden' name='facility_stock_id[]' class='facility_stock_id' value='$facility_stock_ref_id'>
		<input type='hidden' name='redistribution_id[]' class='redistribution_id' value='$id'>
		
		<td>
			<select class='form-control  sub_county ' name='sub_county[]'>".$option_subcounty."			
			</select>
		</td>
		<td><select class='form-control  facility_name ' name='facility_name[]' style=\"width:100%\">".$option_facility." 			
			</select></td>
		<td>$commodity_name</td>
		<td>$commodity_code</td>
		<td>$date_sent</td>
		<td>$unit_size</td>
		<td><input type='text' 
		name='commodity_batch_no[]' class='form-control input-small commodity_batch_no' value='$batch_no' $edit></td>
		<td><input type='text' 
		name='clone_datepicker[]' class=' form-control big clone_datepicker' value='$date' $edit></td>
		<td><input type='text' 
		name='commodity_manufacture[]' class='form-control input-small  commodity_manufacture' value='$manufacturer' $edit></td>
		<td><select class='form-control  commodity_unit_of_issue ' name='commodity_unit_of_issue[]'>
			<option value='Pack_Size'>Pack Size</option>
			<option value='Unit_Size'>Unit Size</option>
			</select></td>
		<td><input class='form-control big available_quantity' readonly='readonly' name='available_quantity[]' type='text' value='$current_balance'></td>
		<td><input class='form-control big old_quantity' readonly='readonly' name='old_quantity[]' type='text' value='$units'></td>
		<td><input class='form-control big quantity' name='quantity[]' type='text' value='0'></td>
		
		<td><input class='form-control big commodity_total_units' readonly='readonly'  type='text'  name='commodity_total_units[]' value='0'/></td>		
		<td><input type='submit' class='btn-danger delete_object form-control' style='width:100%''  data-id='$id' id='btn_$id' data-attr='$id' data-value='$id' value='Delete'></td>		

		</tr>";			
		}
		//readonly='readonly'
		?>

</tbody>
</table> 
<?php echo form_close();?> 
<div id="confirm_actions" class="container-fluid" style="margin-top:5%; width:100%;height:50px;">
	
	<div style="float: right">
		<button class="btn btn-success save form-input" ><span class="glyphicon glyphicon-open"></span>Update</button>
	</div>

 	
</div>


<div class="modal fade" id="confirmDeleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Deletion</h4>
      </div>
      <center>
      <div class="modal-body" style="font-size:16px;text-align:centre">
        <p>This Record will be Deleted. <p/>
        <p>Do you want to Proceed?</p>
      </div>
      </center>
      <div class="modal-footer">        
        <button type="button"  id="btnNoDelete" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" id="btnYesDelete" class="btn btn-primary" id="btn-ok">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<style type="text/css">

	#redistribution_edit_paginate {
		margin-top: 2%;
		margin-right: 5%;
	}
	#redistribution_edit_info{
		margin-left: 2%;
		margin-top: 2%;
	}
	#redistribution_edit_length > label{
		margin-left: -200px !important; 
	}
</style>
<script>
$(document).ready(function() {
	// $('#confirmDeleteModal').on('hidden.bs.modal', function () {		
	//  	// location.reload();
	// });

	$('#btnNoDelete').click(function() {
	    message_denial = "No action has been taken";
		alertify.set({ delay: 10000 });
	 	alertify.success(message_denial, null);       
	  	$('#confirmDeleteModal').modal('hide');
	  	 return false;
	});
	$('#btnYesDelete').click(function() {
	    // message_denial = "No action has been taken";
		// alertify.set({ delay: 10000 });
	 	// alertify.success(message_denial, null);       
	  	var record_id = $('#confirmDeleteModal').data('id');	  	
	  	var base_url = "<?php echo base_url() . 'issues/delete_redistribution/'; ?>";
	  	var link = base_url+record_id;	  	
	  	$('#confirmDeleteModal').modal('hide');

		window.location.href = link;
	});
		
	$("#redistribution_edit").on('click','.delete_object',function(event) {	
	   event.preventDefault();	    
       var id = $(this).data('id');       
   	   // alert(id);
    	$('#confirmDeleteModal').data('id', id).modal('show');
	    
	});
    $('#redistribution_edit').DataTable( {
        "order": [[ 2, "desc" ]]
    } );

	// $('#example').dataTable( {
	// 	 "sDom": "T lfrtip",
	//      "sScrollY": "377px",
 //                    "sPaginationType": "bootstrap",
 //                    "oLanguage": {
 //                        "sLengthMenu": "_MENU_ Records per page",
 //                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
 //                    },
	// 		      "oTableTools": {
 //                 "aButtons": [
	// 			"copy",
	// 			"print",
	// 			{
	// 				"sExtends":    "collection",
	// 				"sButtonText": 'Save',
	// 				"aButtons":    [ "csv", "xls", "pdf" ]
	// 			}
	// 		],
	// 		"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
	// 	}
	// } );
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');
	 $('.sub_county').on("change", function() {
			/*
			 * when clicked, this object should populate district names to district dropdown list.
			 * Initially it sets default values to the 2 drop down lists(districts and facilities) 
			 * then ajax is used is to retrieve the district names using the 'dropdown()' method that has
			 * 3 arguments(the ajax url, value POSTed and the id of the object to populated)
			 */
	        var locator =$('option:selected', this);
	        var id=$(this).val();
	        if(id=='2'){
	        	var dropdown_dist = "<option value='2'>District Store</option>";
	        	locator.closest("tr").find(".facility_name").html(dropdown_dist);
	        }else{
				json_obj={"url":"<?php echo site_url("reports/get_facilities");?>",}
				var baseUrl=json_obj.url;
				
			    var dropdown;
				$.ajax({
				  type: "POST",
				  url: baseUrl,
				  data: "district="+id,
				  success: function(msg){ 
				  	// alert(msg);return;s
				  		var values=msg.split("_");
				  		var txtbox;
				  		for (var i=0; i < values.length-1; i++) {
				  			var id_value=values[i].split("*");				  					  			
				  			dropdown+="<option value="+id_value[0]+">";
							dropdown+=id_value[1];						
							dropdown+="</option>";	

			  		}	
				  },
				  error: function(XMLHttpRequest, textStatus, errorThrown) {
				       if(textStatus == 'timeout') {}
				   }
				}).done(function( msg ) {			
					locator.closest("tr").find(".facility_name").html(dropdown);
				});
			}

		});	
		//compute the order totals here
	$(".quantity_issued").on('keyup',function (){
        	var bal=parseInt($(this).closest("tr").find(".available_quantity").val());        	
        	var selector_object=$(this);
    var issue=parseInt(calculate_actual_stock(selector_object.closest("tr").find(".quantity").val(),selector_object.closest("tr").find(".commodity_unit_of_issue").val(),
    selector_object.val(),'return',selector_object));
    var remainder=bal-parseInt(calculate_actual_stock(selector_object.closest("tr").find(".quantity").val(),selector_object.closest("tr").find(".commodity_unit_of_issue").val(),
    selector_object.val(),'return',selector_object));        	
        	var alert_message='';
        	if (remainder<0) {alert_message+="<li>Can not issue beyond available stock</li></br>"+
        	"<li>You are trying to issue "+issue+" (Units) from "+$(this).closest("tr").find(".available_quantity").val()+" (Units)</li>";
    
//data_array[4]
}
			if (selector_object.val() <0) { alert_message+="<li>Issued value must be above 0</li>";}
		    if (selector_object.val().indexOf('.') > -1) {alert_message+="<li>Decimals are not allowed.</li>";}		
			if (isNaN(selector_object.val())){alert_message+="<li>Enter only numbers</li>";}				
			if(isNaN(alert_message) || isNaN(form_data[0])){
	//reset the text field and the message dialog box 
    selector_object.val(""); var notification='<ol>'+alert_message+form_data[0]+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;';
    //hcmp custom message dialog
    
    hcmp_message_box(title='HCMP error message',notification,message_type='error')
   // dialog_box(notification,'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
    //This event is fired immediately when the hide instance method has been called.
    $('#communication_dialog').on('hide.bs.modal', function (e) { selector_object.focus();	})
    selector_object.closest("tr").find(".balance").val(selector_object.closest("tr").find(".total_commodity_bal").val());
    // selector_object.closest("tr").find(".balance").val(selector_object.closest("tr").find(".commodity_balance").val());
    return;   }// set the balance here
   	selector_object.closest("tr").find(".balance").val(remainder1);	

    // selector_object.closest("tr").find(".balance").val(selector_object.closest("tr").find(".total_commodity_bal").val());

        });// adding a new row
	$(".quantity").on('keyup', function (){

	var selector_object=$(this);
	var user_input=$(this).val();
	var bal = $(this).closest("tr").find(".available_quantity").val();
	var total_units=$(this).closest("tr").find(".total_commodity_units").val();
	var pack_unit_option=$(this).closest("tr").find(".commodity_unit_of_issue").val();
	var donated_items=$(this).closest("tr").find(".commodity_total_units").val();
	//var total_units=calculate_actual_stock (total_units,pack_unit_option,user_input,"return",selector_object,null);
	// check the user input value here
    var issue=parseInt(calculate_actual_stock(selector_object.closest("tr").find(".quantity").val(),pack_unit_option,user_input,'return',selector_object));
	var remainder=bal-parseInt(calculate_actual_stock(total_units,pack_unit_option,user_input,'return',selector_object));  
	var alert_message='';
	if (remainder<0) {alert_message+="<li>Can not issue beyond available stock</li></br>"+
    	"<li>You are trying to issue "+issue+" (Units) from "+$(this).closest("tr").find(".available_quantity").val()+" (Units)</li>";    	
    	$(this).closest("tr").find(".commodity_total_units").val("0");
    	$(this).closest("tr").find(".quantity").val("0");
	}else{
		calculate_actual_stock (total_units,pack_unit_option,user_input,".commodity_total_units",selector_object,null);
	}     	


			if (selector_object.val() <0) { alert_message+="<li>Value must be above 0</li>";}
		    if (selector_object.val().indexOf('.') > -1) {alert_message+="<li>Decimals are not allowed.</li>";}		
			if (isNaN(selector_object.val())){alert_message+="<li>Enter only numbers</li>";}	
			//if(total_units>donated_items){alert_message+="<li>You cannot receive more than was given to you</li>";}			
			if(isNaN(alert_message)){
	//reset the text field and the message dialog box 
    selector_object.val(""); var notification='<ol>'+alert_message+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;';
    //hcmp custom message dialog
    dialog_box(notification,'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');

    
    //This event is fired immediately when the hide instance method has been called.
    $('#communication_dialog').on('hide.bs.modal', function (e) { selector_object.focus();	})
    selector_object.closest("tr").find(".actual_quantity").val("");
    selector_object.val("");
    return;   } 
 
   	
   
	});
	
	$(".commodity_unit_of_issue").on('change', function (){
	$(this).closest("tr").find(".quantity").val("0");
	$(this).closest("tr").find(".commodity_total_units").val("0");	
	})
	
	/************save the data here*******************/
	$('.save').button().click(function() {

    // save the form
    confirm_if_the_user_wants_to_save_the_form("#myform");
     });
});
</script>