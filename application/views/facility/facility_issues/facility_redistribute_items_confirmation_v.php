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
	   <div class="col-md-12" style="padding-left: 0; float:right; right:0;clear:both;  margin-bottom:5px;">	
	 		<a id="upload_excel" href="#modal-dialog-excel" class="btn btn-sm btn-primary float-right margin-right" data-toggle="modal">Upload Redistribution Receivals excel</a>
	        <a  class="btn btn-sm btn-primary float-right margin-right" href="<?php echo base_url().'admin/download_redistribution_receival_excel'; ?>">Download Redistribution Receivals template for upload</a>
	        
		</div> 
	</div>
	
	
 <?php $att=array("name"=>'myform','id'=>'myform'); echo form_open('issues/confirm_offline_issue',$att); ?>
 <table width="98%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
	<thead>
		<tr>
			<th>From</th>			
			<th>Commodity Name</th>
			<th>Commodity Code</th>
			<th>Batch Number</th>
			<th>Date Received</th>						
			<th>Expiry Date</th>
			<th>Manufacturer</th>			
			<th>Quantity Received (Units)</th>
			<th>Quantity Received (Packs)</th>			
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($redistribution_data as $key => $value) {
				$sending_facility = $value['facility_name'];				
				$commodity_name = $value['commodity_name'];
				$commodity_code = $value['commodity_code'];
				$commodity_id = $value['commodity_id'];
				$batch_no = $value['batch_no'];
				$manufacturer = $value['manufacturer'];
				$expiry_date = $value['expiry_date'];
				$date_received = $value['date_received'];
				$quantity_received = $value['quantity_received'];
				$unit_size = $value['total_commodity_units'];
				$unit_size = ($unit_size!=0) ? $unit_size : 1 ;
				$quantity_packs = intval($quantity_received)/intval($unit_size);
		echo "<tr>
		<td>				
		<input type='hidden' name='manufacturer[]' class='manufacturer' value='$manufacturer'>				
		<input type='hidden' name='total_commodity_units[]' class='total_commodity_units' value='$quantity_received'>
		<input type='hidden' name='commodity_id[]' class='commodity_id' value='$commodity_id'>
		<input type='hidden' name='expiry_date[]' class='expiry_date' value='$expiry_date'>
		<input type='hidden' name='commodity_name[]' class='commodity_name' value='$commodity_name'>
		<input type='hidden' name='batch_no[]' class='batch_no' value='$batch_no'>
		$sending_facility</td>
		<td>$commodity_name</td>
		<td>$commodity_code</td>
		<td>$batch_no</td>
		<td>$date_received</td>
		<td>$expiry_date</td>
		<td>$manufacturer</td>
		<td>$quantity_received</td>
		<td>$quantity_packs</td>		
		</tr>";			
		}
		
		?>

</tbody>
</table> 

<?php echo form_close();?> 
<div id="confirm_actions" class="container-fluid" style="margin-top:5%; width:100%;height:50px;">

	
	<!-- <div style="float: right">
		<button class="btn btn-success save form-input" ><span class="glyphicon glyphicon-open"></span>Update</button>
	</div>
 -->
 	
 	<?php
 	if (count($redistribution_data)>0) {?>
 		
 	<div style="float: right">
 		<a href="<?php echo base_url().'issues/confirm_offline_issue';?>">
			<button class="btn btn-success save form-input" ><span class="glyphicon glyphicon-open"></span>Update</button>
		</a>	
	</div>

	<?php 
 	} ?>

</div>

<!-- <hr /> -->

 
 
<script>
$(document).ready(function() {
	//datatables settings 
	$('#example').dataTable( {
		 "sDom": "T lfrtip",
	     "sScrollY": "377px",
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
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');
	
		//compute the order totals here
	$(".quantity").on('keyup', function (){
	var selector_object=$(this);
	var user_input=$(this).val();
	var total_units=$(this).closest("tr").find(".total_commodity_units").val();
	var pack_unit_option=$(this).closest("tr").find(".commodity_unit_of_issue").val();
	var donated_items=$(this).closest("tr").find(".commodity_total_units").val();
	//var total_units=calculate_actual_stock (total_units,pack_unit_option,user_input,"return",selector_object,null);
	// check the user input value here
	var alert_message='';
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
 
   calculate_actual_stock (total_units,pack_unit_option,user_input,".actual_quantity",selector_object,null);
	});
	
	$(".commodity_unit_of_issue").on('change', function (){
	$(this).closest("tr").find(".quantity").val("");
	$(this).closest("tr").find(".actual_quantity").val("");	
	})
	
	/************save the data here*******************/
	$('.save').button().click(function() {

    // save the form
    confirm_if_the_user_wants_to_save_the_form("#myform");
     });
});
</script>


<div class="modal fade" id="modal-dialog-excel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Upload report listing excel</h4>
            </div>
            <div class="modal-body">
                <?php $attr = array('id'=>'upload_form','class'=>''); echo form_open_multipart('issues/upload_redistribution_excel',$attr); ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Choose file:</td>
                            <td><input type="file" name="redistribution_excel" size="20" required="required"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><button id="submit_upload" class="btn btn-success m-r-5" type="submit" value='upload' name="submit"><i class="fa fa-upload"></i> Upload</button></td>
                        </tr>
                    </tbody>
                </table>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>

	$('#upload_excel').click(function () {
     	$('#modal-dialog-excel').appendTo("body").modal('show');
	})

	
</script>