<?php //echo "<pre>"; print_r($commodities); echo "</pre>"; exit; ?>
<style type="text/css">
.row div p, row-fluid div p{
	padding: 10px;
}
form-control{
	font-size: 12px !important;
}
</style>
<div class="container-fluid" style="">
	<div class="container" style="margin: auto; widht:100%; ">
		<div class="row">
			<div class="col-md-6" id=""><p class="bg-info"><span class="badge">0</span> Select the Commodity to issue, Enter the Service Point and Quanitity you wish to issue and select the Batch No</p></div>
			<div class="col-md-5" id=""><p class="text-danger"><span class="danger">NB</span> Available Batch Stock is for a specific 
			batch, Total Balance is the total for the commodity</p></div>
		</div>
	</div>
	<div class="table-responsive" style="min-height:300px; overflow-y:auto;">
	<?php
		$att = array("name" => "myform", "id" => "myform"); echo form_open("issues/county_store_external_issue");
	?>
	<table width="100%" class="table table-hover table-bordered table-update" id="subcounty_issues_table">
		<thead style="background-color: white;">
			<tr> 
				<th>Select Subcounty</th>
				<th>Select Facility</th>
				<th>Supplier</th>
				<th>Unit Size</th>
				<th>Batch&nbsp;No</th>
				<th>Expiry Date</th>
				<th>Issue Date</th>
				<th>Available Batch Stock</th>
				<th>Issue Type</th>
				<th>Issued Quantity</th>
				<th>Total Balance</th>
				<th>Action</th>			
			</tr>
		</thead>
		<tbody>
			<tr row_id='0'>
				<td>
					<select name="district[0]" class="form-control input-small district">
						<?php
						if(isset($donate_destination) && $donate_destination == "subcounty"){
							echo '<option value="' . $district_id . '">'. $district_data['district_name'] . '</option>';
						}
						else{
							echo '<option value="0">---Select Subcounty---</option>';
							foreach ($subcounties as $districts) {
								$id = $district -> id;
								$name = $district -> name;
								echo '<option value="' . $id . '">' . $name . '</option>';
							}
						}
						?>
					</select>
				</td>
				<?php
				if(isset($donate_destination) && $donate_destination == "subcounty"){
					echo '<td>
					<select name="mfl[0]" class="form-control input-small">
						<option value="0">District Store</option>
					</select>
					</td>';
				} 
				else{
					echo '<td>
					<select name="mfl[0]" class="form-control input-small facility">
						<option value="0">--Select Facility</option>
					</select>
					</td>';
				}
				?>
				<td>
					<select class="form-control input-small service desc" name="desc[0]">
						<option special_data="0" value="0" selected="selected">-Select Commodity-</option>
						<?php 
						foreach ($commmodities as $commodities) {
							$commodity_name = $commodities['commodity_name'];
							$commodity_id = $commodities['commodity_id'];
							$unit = $commodities['unit_size'];
							$source_name = $commodities['source_name'];
							$total_commodity_units = $commodities['total_commodity_units'];
							$store_commodity_balance = $commodities['store_commodity_balance'];
							echo "<option special_data='$commodity_id^$unit^$source_name^$total_commodity_units^$store_commodity_balance' value='$commodity_id'>$commodity_name</option>";
						}
						?>
					</select>
				</td>
				<td>
					<input type="hidden" id="0" name="commodity_id[0]" value="" class="commodity_id" />
					<input type="hidden" id="0" name="total_units[0]" value="" class="total_units" />
					<input type="hidden" id="0" name="store_commodity_balance[0]" value="" class="store_commodity_balance" />
					<input type="hidden" id="0" name="facility_stock_id[0]" value="" class="facility_stock_id" />
					<input type="hidden" id="0" name="manufacture[0]" value="" class="manufacture" /> </td>
					<td><input  type="text" class="form-control input-small unit_size" readonly="readonly"/></td>
					<td><select class="form-control big batch_no big" name="batch_no[0]"></select></td>
					<td><input type='text' class='form-control input-small expiry_date' value="" name='expiry_date[0]' readonly="readonly"  /></td>
					<td><input class='form-control input-small clone_datepicker_normal_limit_today' type="text" name="clone_datepicker_normal_limit_today[0]"  value="" required="required" /></td>
					<td><input class='form-control input-small available_stock' type="text" name="available_stock[0]" readonly="readonly" /></td>
					<td><select class="form-control commodity_unit_of_issue big" name="commodity_unit_of_issue[]">
							<option value="Pack_Size">Pack Size</option>
							<option value="Unit_Size">Unit Size</option>
						</select>
					</td>
						<td><input class='form-control big quantity_issued' type="text" value="0"  name="quantity_issued[0]"  required="required"/></td>
						<td><input class='form-control big input-small balance' type="text" value="" readonly="readonly" /></td>
						<td><button type="button" class="remove btn btn-danger btn-xs">
								<span class="glyphicon glyphicon-minus"></span>Remove Row
							</button>
						</td>
			</tr>
		</tbody>
	</table>
	</div>
	<hr />
	<div class="container-fluid">
	<div style="float: right">
	<button type="button" class="add btn btn-primary">
		<span class="glyphicon glyphicon-plus"></span>Add Row
	</button>
	<button class=" save btn btn-success">
		<span class="glyphicon glyphicon-open"></span>Save
	</button>
	</div>
	</div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
	$(document).ready(function(){
		var facility_stock_data = <?php echo $facility_stock_data; ?>
		var $table = $('table');
		$table.floatThead({
			scrollingTop: 100,
			zIndex: 1001,
			scrollContainer: function($table){ return $table.closest('.table-responsive');}
		});
		$('.district').on("change", function(){
			var locator = $('option:selected',this);
			json_obj = {"url":"<?php echo site_url("reports/get_facilities");?>"}
			var baseUrl = json_obj.url;
			var id = $(this).val();
			var dropdown;
			$.ajax({
				type: "POST",
				url: baseUrl,
				data: "district=" + id,
				success: function(msg){
					var values = msg.split("_");
					var txtbox;
					for(var i = 0; i < values.length - 1; i++){
						var id_value = values[i].split("*");
						dropdown += "<option value=" + id_value[0] + ">";
						dropdown += id_value[1];						
						dropdown += "</option>";	
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
			       if(textStatus == 'timeout') {}
			   	}
			}).done(function( msg ) {			
				locator.closest("tr").find(".facility").html(dropdown);
			});	
		});
		$('.desc').on('change',function(){
			var row_id = $(this).closest("tr").index();
			var locator = $('option:selected', this);
			var data = $('option:selected', this).attr('special_data');
			var data_array = data.split("^");

			locator.closest("tr").find(".unit_size").val(data_array[1]);
			locator.closest("tr").find(".supplier_name").val(data_array[2]);
	     	locator.closest("tr").find(".commodity_id").val(data_array[0]);
	     	locator.closest("tr").find(".available_stock").val("");
	     	locator.closest("tr").find(".total_units").val(data_array[3]);
	     	locator.closest("tr").find(".expiry_date").val("");
	     	locator.closest("tr").find(".quantity_issued").val("0");
	     	locator.closest("tr").find(".clone_datepicker_normal_limit_today").val("");	

	     	var commodity_id=data_array[0];
			var stock_data=extract_data(data_array[0],commodity_id,'batch_data');
            var dropdown="<option special_data=''>--select Batch--</option>"+stock_data[0];
            var facility_stock_id=stock_data[1];
            var total_stock_bal=data_array[4];
            var total_issues_for_this_item=0; 
            var total_issues_for_this_batch=0;

            $("input[name^=commodity_id]").each(function(index, value) {
			 	var row_id_= $(this).closest("tr").index(); 
			 	var facility_stock_id_ = $(this).closest("tr").find(".facility_stock_id").val();  
                if($(this).val() == commodity_id){
                	total_issues_for_this_item = parseInt(calculate_actual_stock(data_array[3],$(this).closest("tr").find(".commodity_unit_of_issue").val(),
    				$(this).closest("tr").find(".quantity_issued").val(),'return',''))+total_issues_for_this_item;
               	} 
                if(facility_stock_id_== facility_stock_id && row_id_< row_id){                 	
                    total_issues_for_this_batch = parseInt(calculate_actual_stock(data_array[3],$(this).closest("tr").find(".commodity_unit_of_issue").val(),
    				$(this).closest("tr").find(".quantity_issued").val(),'return','')) + total_issues_for_this_batch; 
    			}      
			});

			var remaining_items = total_stock_bal - total_issues_for_this_item;
		    locator.closest("tr").find(".manufacture").val(stock_data[4]);
		    locator.closest("tr").find(".facility_stock_id").val(stock_data[1]);	        
			locator.closest("tr").find(".batch_no").html(dropdown);
			locator.closest("tr").find(".expiry_date").val(""+stock_data[3]+"" );
			locator.closest("tr").find(".balance").val(remaining_items);
			locator.closest("tr").find(".available_stock").val(stock_data[2]-total_issues_for_this_batch);		
			locator.closest("tr").find(".commodity_id").val(commodity_id);
			locator.closest("tr").find(".store_commodity_balance").val(remaining_items);	
		});

		$(".quantity_issued").on('keyup',function () {
        	var bal = parseInt($(this).closest("tr").find(".available_stock").val());
        	var bal1 = parseInt($(this).closest("tr").find(".store_commodity_balance").val());
        	var selector_object = $(this);
        	var data = $('option:selected', selector_object.closest("tr").find('.desc')).attr('special_data');
	       	var data_array = data.split("^");
        	var remainder1 = bal1 - parseInt(calculate_actual_stock(data_array[3],selector_object.closest("tr").find(".commodity_unit_of_issue").val(),
    		selector_object.val(),'return',selector_object));
    		var remainder = bal - parseInt(calculate_actual_stock(data_array[3],selector_object.closest("tr").find(".commodity_unit_of_issue").val(),
    		selector_object.val(),'return',selector_object));
        	var form_data = check_if_the_form_has_been_filled_correctly(selector_object);
        	var alert_message = '';
        	if (remainder < 0) { alert_message += "<li>Can not issue beyond available stock</li>"; }
			if (selector_object.val() < 0) { alert_message += "<li>Issued value must be above 0</li>"; }
		    if (selector_object.val().indexOf('.') > - 1) { alert_message += "<li>Decimals are not allowed.</li>" ;}		
			if (isNaN(selector_object.val())) { alert_message += "<li>Enter only numbers</li>"; }				
			if(isNaN(alert_message) || isNaN(form_data[0])){
				//reset the text field and the message dialog box 
			    selector_object.val("");
			    var notification = '<ol>' + alert_message + form_data[0] + '</ol>&nbsp;&nbsp;&nbsp;&nbsp;' ;
			    //hcmp custom message dialog
			    dialog_box(notification,'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
			    //This event is fired immediately when the hide instance method has been called.
			    $('#communication_dialog').on('hide.bs.modal', function (e) { 
			    	selector_object.focus();	
			    })
			    selector_object.closest("tr").find(".balance").val(selector_object.closest("tr").find(".store_commodity_balance").val());
			    return;  
			}
			//Balance
   			selector_object.closest("tr").find(".balance").val(remainder1);	
        });
		
		$(".add").click(function() {
		    var selector_object = $('#subcounty_issues_table tr:last');
		    var form_data = check_if_the_form_has_been_filled_correctly(selector_object);
		    if(isNaN(form_data[0])){
		      	var notification='<ol>'+form_data[0]+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;';
		        //hcmp custom message dialog
		      	dialog_box(notification,'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
		       	return;
		    }// set the balance here
			//set the quantities to readonly  $("#dropdown").prop("disabled", true);
			selector_object.closest("tr").find(".quantity_issued").attr('readonly','readonly');
			selector_object.closest("tr").find(".batch_no").attr("disabled", true);
			selector_object.closest("tr").find(".commodity_unit_of_issue").attr("disabled", true);
			selector_object.closest("tr").find(".desc").attr("disabled", true);				
			//reset the values of current element 
			clone_the_last_row_of_the_table();
		});	

		$('.batch_no').on('change',function(){
			var row_id=$(this).closest("tr").index();
		    var locator=$('option:selected', this);
			var data =$('option:selected', this).attr('special_data'); 
	       	var data_array=data.split("^");	
	       	if(data_array[0]!=''){
	       		alert(data_array[4]);
		       	var new_date=$.datepicker.formatDate('d M yy', new Date(data_array[0]));
		       	var total_issues=0;
		      	var total_stock_bal=data_array[1];	
	            var commodity_stock_id_old=parseInt($("input[name='commodity_id["+row_id+"]']").val());
	            var facility_stock_id_current=parseInt(data_array[2]);
            	
            	$("input[name='facility_stock_id["+row_id+"]']").val(data_array[2]);     	
		        /* Check for all commodities that have the same id as the current item selected
		         * then sum up all the issues above the given item
		         * use this value to reduce the value of the total value of the commodity*/	        
		        $("input[name^=facility_stock_id]").each(function(index, value) {  	
                 	var row_id_=$(this).closest("tr").index();                 
                 	var total_current_issues=$(this).closest("tr").find(".quantity_issued").val();              
                  	if($(this).val()==facility_stock_id_current && row_id_<row_id){
                   		total_issues=parseInt(calculate_actual_stock(data_array[3],$(this).closest("tr").find(".commodity_unit_of_issue").val(),
    					total_current_issues,'return',''))+total_issues;                 
                  	}                
		        });
			        locator.closest("tr").find(".available_stock").val(total_stock_bal-total_issues);
			        locator.closest("tr").find(".expiry_date").val(""+new_date+"");	        		
				    locator.closest("tr").find(".quantity_issued").val("0");
				    locator.closest("tr").find(".balance").val(locator.closest("tr").find(".store_commodity_balance").val());
				    locator.closest("tr").find(".manufacture").val(data_array[5]);
			    }
			    else{
				    locator.closest("tr").find(".expiry_date").val("");
				    locator.closest("tr").find(".balance").val("");
				    locator.closest("tr").find(".available_stock").val("0");
				    locator.closest("tr").find(".quantity_issued").val("0");	
				    //locator.closest("tr").find(".manufacture").val(data_array[5]);
			    }		
      });
	});
</script>