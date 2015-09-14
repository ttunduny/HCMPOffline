<?php //echo "<pre>";print_r($facility_commodity_list);echo "</pre>";exit; ?>
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
	<hr />
<div class="table-responsive" style="min-height:300px; overflow-y: auto;">
 <?php //$att=array("name"=>'myform','id'=>'myform'); echo form_open('issues/internal_issue',$att); ?>
<?php  $att=array("name"=>'myform','id'=>'myform'); echo form_open('orders/facility_new_order/2',$att); //?>
<div class="row" style="padding-left: 1%;margin-bottom: 5px;">
	<div class="col-md-3">
		
	<b>*Order Frequency</b><input  type="text" class="form-control input-large commodity_code" readonly="readonly" value="Quarterly" /> 
	</div>
	<div class="col-md-2">
     <b>*Order No:</b> <input type="text" class="form-control input_text" name="order_no" id="order_no" id="order_no" required="required"/>
	</div>
<div class="col-md-2">
	 <b>*In-patient Bed Days:</b><input type="text" class="form-control  input_text" name="bed_capacity" id="bed_capacity" required="required"/>
</div>	
<div class="col-md-2">
	 <b>*Total OPD Visits & Revisits:</b><input type="text" class="form-control input_text" name="workload" id="workload" required="required"/>
</div>

<div class="">

<input type="hidden" class="form-control" name="total_order_balance_value" 
id="total_order_balance_value" readonly="readonly" value="<?php echo $drawing_rights; ?>"/>	
<input name="facility_code" type="hidden" value="<?php echo isset($facility_code)? $facility_code :$this -> session -> userdata('facility_id'); ?>" />					
</div>
</div>

<table  class="table table-hover table-bordered table-update" id="facility_meds_table" >
<thead>
<tr style="background-color: white">
						<th>Description</th>
						<th>Commodity&nbsp;Code</th>
						<th>Order Unit Size</th>
						<th>Opening Balance</th>
						<th>Total Receipts</th>
					    <th>Total issues</th>
					    <th>Adjustments(-ve)</th>
					    <th>Adjustments(+ve)</th>
					    <th>Losses</th>
					    <th>Closing Stock</th>
					    <th>Order Quantity</th>
					    <th>Actual Quantity</th>
					    <th>Action</th>
	</tr>
</thead>
					<tbody>
						<tr row_id='0'>
							<td>
								<select class="form-control input-small commodities" data-code="default" name="commodities[0]" id="commodities" style="width:150px !important;" >
							    <option special_data="0" value="0" selected="selected" style="width:auto !important;">Select Commodity</option>
											<?php 											
									foreach ($facility_commodity_list as $fcl) :
										$commodity_name = $fcl['commodity_name'];
										$unit_size = $fcl['unit_size'];
										$commodity_name_unit = $commodity_name.' ('.$unit_size.')';
										$commodity_name = ($commodity_name=='') ? $commodity_name : $commodity_name_unit;
										echo '<option value="'.$fcl['commodity_id'].'" data-code="'.$fcl['commodity_code'].'" data-name="'.$fcl['commodity_name'].'" data-u-size="'.$fcl['unit_size'].'" style="width:auto !important;">'.$commodity_name.'</option>';						
												endforeach;
									?> 		
								</select>
							</td>
							<td id="step1">
								<input type="hidden" name="commodity_id[0]" class="commodity_id" value="">
								<input type="hidden" name="commodity_name[0]" class="commodity_name" value="">
								<input class='form-control input-small commodity_code' type="text" id="commodity_code[0]" name="commodity_code[0]" value="" class="commodity_id" readonly/>
							</td>

							<td id="step1">
								<input class='form-control input-small unit_size' name="unit_size" type="text" id="unit_size[0]" name="unit_size[0]" value="" class="unit_size" readonly/>
							</td>

							<td id="step2">
								<input class='form-control input-small opening_balance' type="text" id="open[0]" name="open[0]" value="" class="opening_balance"/>
							</td>

							<td id="step2">
								
								<input class='form-control input-small total_reciepts' type="text" id="" name="total_reciepts[0]" value="" class="total_reciepts"/>
							</td>

							<td>
								<input class='form-control input-small total_issues' type="text" id="" name="issues[0]" value="" class="total_issues"/>
							</td>

							<td>
								<input class='form-control input-small adjustmentnve' type="text" id="" name="adjustmentnve[0]" value="" class="adjustmentnve"/>
							</td>

							<td>
								<input class='form-control input-small adjustmentpve' type="text" id="" name="adjustmentpve[0]" value="" class="adjustmentpve"/>
							</td>

							<td>
								<input class='form-control input-small losses' type="text" id="" name="losses[0]" value="" class="losses"/>
							</td>

							<td>
								<input class='form-control input-small closing' type="text" id="" name="closing[0]" value="" class="closing"/>
							</td>

							<td>
							<input class="form-control input-small quantity" type="text" name="quantity[0]" value=""/>
							</td>
							<td><input class="form-control input-small actual_quantity" readonly="readonly" type="text" name="actual_quantity[0]" value=""/></td>

							<td style="width:50px !important;" id="step8" >
								<button type="button" class="remove btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span>row</button>
								<button type="button" id="step7" class="add btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>row</button>
							</td>
				</tr>
		           </tbody>
		           </table>
</div>
<hr />
<div class="container-fluid">
<div style="float: right">
<button class="test btn btn-success test" id="step9"><span class="glyphicon glyphicon-open"></span>Save</button></div>
</div>
</div>
<?php echo form_close();?>
<script>
$(document).ready(function() {	

 var $table = $('table');
//float the headers
  $table.floatThead({ 
	 scrollingTop: 100,
	 zIndex: 1001,
	 scrollContainer: function($table){ return $table.closest('.table-responsive'); }
	});	
//step one load all the facility data here

$('#commodities').change(function(){
	var row_id=$(this).closest("tr").index();
	// var c_id = $(this).data-attr();

	var c_code = $(this).find(':selected').attr("data-code");
	var u_size = $(this).find(':selected').attr("data-u-size");
	var c_id = $(this).find(':selected').val();
	var c_name = $(this).find(':selected').attr("data-name");

	// $(this).find(':selected').data('id')

	// alert(c_code);return;
 	// $(this).closest("tr").find(".commodity_code").val(c_code);
 	$(this).closest("tr").find(".commodity_code").val(c_code);
 	$(this).closest("tr").find(".unit_size").val(u_size);
 	$(this).closest("tr").find(".commodity_id").val(c_id);
 	$(this).closest("tr").find(".commodity_name").val(c_name);

});

        $(".add").click(function() {
        var selector_object=$('#facility_meds_table tr:last');
        var form_data=check_if_the_form_has_been_filled_correctly(selector_object);
        if(isNaN(form_data[0])){
        var notification='<ol>'+form_data[0]+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;';
           //hcmp custom message dialog
           hcmp_message_box(title='HCMP error message',notification,message_type='error')
       // dialog_box(notification,'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
        return;   }// set the balance here
			//set the quantities to readonly  $("#dropdown").prop("disabled", true);
			// selector_object.closest("tr").find(".commodities").attr('readonly','readonly');
			//reset the values of current element */
		  clone_the_last_row_of_the_table();
		});	/////batch no change event

        $(".commodity_unit_of_issue").on('change', function(){
          $(this).closest("tr").find(".quantity_issued").val('0');
          $(this).closest("tr").find(".balance").val($(this).closest("tr").find(".commodity_balance").val());	
        })/// remove the row
		$('.remove').on('click',function(){
			var row_id=$(this).closest("tr").index();
            var count_rows=$('#facility_meds_table tr').length;
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
	$('.test').on('click','', function (){
		var today = $.datepicker.formatDate('d MM, y', new Date());
         // alert(table_data);
    //hcmp custom message dialog
    table_data = "Kindly Confirm the values before proceeding</br>";
    dialog_box(table_data+'<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>'
    +'<button type="button" class="btn btn-primary" id="save_dem_order" data-dismiss="modal">Save</button>');
	});
	function confirm_validation(){
		var rowCount = $('#facility_meds_table tr').length;
		if(('.open').val()==''){
			alert('Please Enter an Opening Balance before Saving');
			return false; 
		}
	}
		
	$('#main-content').on('click','#save_dem_order',function() {
     var order_total=$('#total_order_value').val();
     var workload=$('#workload').val();
     var order_no=$('#order_no').val();
     var bed_capacity=$('#bed_capacity').val();
     var alert_message='';
     // if (order_total==0) {alert_message+="<li>Sorry, you can't submit an Order Value of Zero</li>";}
     if (workload=='') {alert_message+="<li>Indicate Total OPD Visits & Revisits</li>";}
     if (bed_capacity=='') {alert_message+="<li>Indicate In-patient Bed Days</li>";}
     if (order_no=='') {alert_message+="<li>Indicate Order Number</li>";}
     if(isNaN(alert_message)){
     //This event is fired immediately when the hide instance method has been called.
    $('#workload').delay(500).queue(function (nxt){
    // Load up a new modal...
     dialog_box('Fix these items before saving your Order <ol>'+alert_message+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;',
     '<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
    	nxt();
    });
     }else{
     	// var validate = confirm_validation();

    $('#workload').delay(500).queue(function (nxt){
    // Load up a new modal...
    var img='<img src="<?php echo base_url('assets/img/wait.gif') ?>"/>';
     dialog_box(img+'<h5 style="display: inline-block; font-weight:500;font-size: 18px;padding-left: 2%;"> Please wait as the order is being processed</h5>',
     '');
    	nxt();
    	// $("#myform").submit();
    });
     	
     }
     });

	function validate_row_inputs(row_id)
	{
		var opening_balance = $(".opening_balance").attr('name','open['+row_id+']').val(); 
		var quantity_issued = $(".quantity_issued").attr('name','quantity_issued['+row_id+']').val(); 	
		var total_reciepts = $(".total_reciepts").attr('name','total_reciepts['+row_id+']').val(); 
		var total_issues = $(".total_issues").attr('name','total_issues['+row_id+']').val(); 
		var adjustmentnve = $(".adjustmentnve").attr('name','adjustmentnve['+row_id+']').val(); 
		var adjustmentpve = $(".adjustmentpve").attr('name','adjustmentpve['+row_id+']').val();
		var losses = $(".losses").attr('name','losses['+row_id+']').val();
		var closing = $(".closing").attr('name','closing['+row_id+']').val();
		var quantity = $(".quantity").attr('name','quantity['+row_id+']').val();
		alert_message = '';
		var checker = false;
		// var message = 'Please fill in the Following before continuing';
		if ((opening_balance!='')&&(quantity_issued!='')&&(total_reciepts!='')&&(total_issues!='')&&(adjustmentnve!='')&&(adjustmentpve!='')&&(losses!='')&&(closing!='')&&(quantity!='')) {
			// alert_message = '';				
			checker = true;
		}else{
			if (opening_balance=='') {alert_message+="<li>The Opening Balance</li>";}
			if (quantity_issued=='') {alert_message+="<li>The Quantity Issued </li>";}
			if (total_reciepts=='') {alert_message+="<li>The Total Receipts</li>";}
			if (total_issues=='') {alert_message+="<li>The Total Issues</li>";}
			if (adjustmentnve=='') {alert_message+="<li>The Negatve Adjustments</li>";}
			if (adjustmentpve=='') {alert_message+="<li>The Positive Adjustments</li>";}
			if (losses=='') {alert_message+="<li>The Losses</li>";}
			if (closing=='') {alert_message+="<li>The Closing Balance</li>";}
			if (quantity=='') {alert_message+="<li>The Order Quantity</li>";}
			checker =  false;
		}
		
		if(checker==false){

		    $('.quantity').delay(500).queue(function (nxt){
		    // Load up a new modal...
		     dialog_box('Fix these items before saving your Order <ol>'+alert_message+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;',
		     '<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
		    	nxt();
		    });
		    return false;
	     }else{
	     	return true;
					

		}
	}
     /************************* form validation ************/
        function clone_the_last_row_of_the_table(){
            var last_row = $('#facility_meds_table tr:last');
            var cloned_object = last_row.clone(true);
            var table_row = cloned_object.attr("row_id");
            var next_table_row = parseInt(table_row) + 1;    
            var filled_check = validate_row_inputs(last_row);
            if (filled_check==true) {
            	var blank_value = "";       
			    cloned_object.attr("row_id", next_table_row);
				cloned_object.find(".commodity_code").attr('name','commodity_code['+next_table_row+']'); 
				cloned_object.find(".commodity_id").attr('name','commodity_id['+next_table_row+']'); 
				cloned_object.find(".commodity_name").attr('name','commodity_name['+next_table_row+']'); 
				cloned_object.find(".unit_size").attr('name','unit_size['+next_table_row+']');
				cloned_object.find(".opening_balance").attr('name','open['+next_table_row+']'); 
				cloned_object.find(".quantity_issued").attr('name','quantity_issued['+next_table_row+']'); 	
				cloned_object.find(".total_reciepts").attr('name','total_reciepts['+next_table_row+']'); 
				cloned_object.find(".total_issues").attr('name','total_issues['+next_table_row+']'); 
				cloned_object.find(".adjustmentnve").attr('name','adjustmentnve['+next_table_row+']'); 
				cloned_object.find(".adjustmentpve").attr('name','adjustmentpve['+next_table_row+']');
				cloned_object.find(".losses").attr('name','losses['+next_table_row+']');
				cloned_object.find(".closing").attr('name','closing['+next_table_row+']');
				cloned_object.find(".quantity").attr('name','quantity['+next_table_row+']');
				cloned_object.find(".actual_quantity").attr('name','actual_quantity['+next_table_row+']');
				// cloned_object.find(".s11_no").attr('name','s11_no['+next_table_row+']');					
	           // cloned_object.find("input").attr('value',"");     
	            //cloned_object.find(".quantity_issued").attr('value',blank_value); 
	            cloned_object.find("input").val(blank_value);
	            // cloned_object.find(".quantity_issued").val(blank_value);  
	            // cloned_object.find(".quantity_issued").removeAttr('readonly');  
	            // cloned_object.find(".batch_no").removeAttr('disabled');
	            // cloned_object.find(".commodity_unit_of_issue").removeAttr('disabled'); 
	            // cloned_object.find(".desc").removeAttr('disabled');   
	            //cloned_object.find(".commodity_balance").attr('value',"");     
	            // cloned_object.find(".commodity_balance").val(blank_value);        
	            // cloned_object.find(".batch_no").html("");
	            // remove the error class
	            cloned_object.find("label.error").remove();             
				cloned_object.insertAfter('#facility_meds_table tr:last');	
				// refresh_clone_datepicker_normal_limit_today();	
            }
            
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