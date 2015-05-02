<style>
 	.input-small{
 		width: 55px !important;
 	}
 	.row-fluid div p{
	padding:10px;
}
.table-bordered {
border: 0px ;
}
.modal-dialog {
		
		width: 55%;
	}
 </style>
 <div class="container-fluid" style="width: 100%; margin: auto;">

<?php $identifier = $this -> session -> userdata('user_indicator');
 $att=array("name"=>'myform','id'=>'myform'); echo form_open('orders/update_order_facility',$att); 
 //echo "<pre>"; print_r($facility_order);echo "<pre>";exit;
//?>
<div class="row-fluid">
		<div class="col-md-8">
			<div class="col-md-3">
				<p class="bg-info">
			<span  class='' style="display: inline">
				<strong>Fill the Order Quantity to complete order </strong>
			</p>
			</div>
			<div class="col-md-9">
				<p class="bg-info" style="margin-top: 2%">
			<strong>Suggested Order Quantity (Quarterly)  = ((Average Monthly Consumption *
				 <span id="month" style="display: inline"> 3</span>) - Closing Stock) + AMC</span></strong>
				</p>
			</div>
			
		</div>
		<div class="col-md-2">
			<b>*Order Frequency</b><input  type="text" class="form-control input-large commodity_code" readonly="readonly" value="Quarterly" />
		</div>
		<div class="col-md-2">
			<b>Total Order Value(KSH)</b>
<input type="text" class="form-control" name="total_order_value" id="total_order_value" readonly="readonly" value="0"/>	
<input type="hidden" id="actual_drawing_rights" name="drawing_rights" value="<?php echo $drawing_rights; ?>" />		
		</div>
		
	</div>
<?php $order_number=$order_details[0]['id']; echo "<input type='hidden' name='order_number' value='$order_number'/>
<input type='hidden' name='rejected' value='$rejected'/>
<input type='hidden' name='rejected_admin' id='rejected_admin' value='0'/>
<input type='hidden' name='approved_admin' id='approved_admin' value='0'/>"; ?>
<table width="100%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
<thead>
<tr style="background-color: white">
						<!--<th>Category</th>-->
						<th>Description</th>
						<!--<th>Commodity&nbsp;Code</th>-->
						<th>Order Unit Size</th>
						<th>Order Unit Cost (Ksh)</th>
						<th>Opening Balance (Units)</th>
						<th>Total Receipts (Units)</th>
					    <th>Total issues (Units)</th>
					    <th>Adj(-ve) (Units)</th>
					    <th>Adj(+ve) (Units)</th>
					    <th>Losses (Units)</th>
					    <th>Closing Stock (Units)</th>
					    <th>No Days Out Of Stock</th>
					    <th>AMC (Packs)</th>
					    <th>Suggested Order Qty (Packs)</th>
					    <th>Facility Order Qty (Packs)</th>
					    <th>SCP Order Qty  (Packs)</th>
					    <th>CP Order Qty  (Packs)</th>
					    
					    <th>Actual Order Qty (Units)</th>
					    <th>Order Cost(Ksh)</th>	
					    <!--<th>Comment</th>	-->					    
	</tr>
</thead>
<tbody>
								<?php 
								 $count=0; $thr=true;
								$j=count($facility_order);
								for($i=0;$i<$j;$i++){?>
						<tr>
							<!--<td><?php echo $facility_order[$i]['sub_category_name'];?></td>-->
							<?php 
							      $price=$facility_order[$i]['unit_cost'];
								  $price=str_replace(",", '',$price);
							      echo 
					 form_input(array('name' => 'facility_order_details_id['.$i.']', 'type'=>'hidden',
					 'id' =>'test','value'=>$facility_order[$i]['id'])).
					 form_input(array('name' => 'commodity_code['.$i.']', 'type'=>'hidden',
					 'id' =>'test','value'=>$facility_order[$i]['commodity_code'],'class'=>'commodity_code')).
					 form_input(array('name' => 'total_commodity_units['.$i.']', 'type'=>'hidden',
					 'id' =>'test','value'=>$facility_order[$i]['total_commodity_units'],'class'=>'total_commodity_units')).
					 form_input(array('name' => 'commodity_id['.$i.']', 'type'=>'hidden',
					 'id' =>'test','value'=>$facility_order[$i]['commodity_id'],'class'=>'commodity_id')).
					 form_input(array('name' => 'commodity_name['.$i.']', 'type'=>'hidden',
					 'id' =>'test','value'=>$facility_order[$i]['commodity_name'],'class'=>'commodity_name')).
					 form_input(array('name' => 'price['.$i.']', 'type'=>'hidden',
					 'id' =>'test','value'=>$price,'class'=>'commodity_name')).
					form_input(array('name' => 'unit_size['.$i.']', 'type'=>'hidden',
					 'id' =>'test','value'=>$facility_order[$i]['unit_size'],'class'=>'unit_size')).
					 form_input(array('name' => 'unit_cost['.$i.']', 'type'=>'hidden',
					 'id' =>'test','value'=>$facility_order[$i]['unit_cost'],'class'=>'unit_cost'));?>
							<td><?php echo $facility_order[$i]['commodity_name']?></td>
							<!--<td><?php echo $facility_order[$i]['commodity_code'];?></td>-->
							<td><?php echo $facility_order[$i]['unit_size']?> </td>
							<td><?php echo $facility_order[$i]['unit_cost']; ?> </td>
							<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="open['.$i.']"'; ?>  value="<?php echo $facility_order[$i]['opening_balance'];?>" /></td>
							<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="receipts['.$i.']"'; ?>  value="<?php echo $facility_order[$i]['total_receipts'];?>" /></td>
							<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="issues['.$i.']"'; ?>  value="<?php echo $facility_order[$i]['total_issues'];?>" /></td>
				<td><input  class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="adjustmentnve['.$i.']"'; ?> value="<?php echo $facility_order[$i]['adjustmentnve']?>" /></td>
				<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="adjustmentpve['.$i.']"'; ?> value="<?php echo $facility_order[$i]['adjustmentpve']?>" /></td>
							<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="losses['.$i.']"'; ?> value="<?php echo $facility_order[$i]['losses'] ?>" /></td>
							
							<td><input class="form-control input-small closing" readonly="readonly" type="text"<?php echo 'name="closing['.$i.']"'; ?> value="<?php echo $facility_order[$i]['closing_stock'];?>" /></td>
							<td>
								<input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="days['.$i.']"'; ?> 
								value="<?php 
								$closing_stock=$facility_order[$i]['closing_stock'];
								$days=$facility_order[$i]['historical'];
								if ((int)$closing_stock <= 0 && (int)$days = 0) {
								      $date_mod = $facility_order[$i]['date_modified'];
									  
										  $now = time(); 
									      $my_date = strtotime($date_mod);
									       $datediff = $now - $my_date;
									     echo floor($datediff/(60*60*24));
									
								} else{
									echo "0";
								}?>" />
								
								</td>
							<td><input class="form-control input-small amc" readonly="readonly" type="text" <?php echo 'name="amc['.$i.']"'; ?> value="<?php echo $facility_order[$i]['historical'];?>" /></td>
							<td><input style="background-color: #B2EFB2;" class="form-control input-small suggested" readonly="readonly" type="text" name="suggested[<?php echo $i ;?>]" value=""/></td>
							
							<td><input style="background-color: #B2EFB2;" class="form-control input-small" readonly="readonly" type="text" name="facility_quantity[<?php echo $i;?>]"  value="<?php $qty=$facility_order[$i]['quantity_ordered_pack'];if($qty>0){echo $qty;} else echo 0;?>"/></td>
							
							<td><input style="background-color: #B2EFB2;" class="form-control input-small " readonly="readonly" type="text" name="cty_qty[<?php echo $i ;?>]"  value="<?php echo $facility_order[$i]['scp_qty'];?>"/></td>
							<td><input style="background-color: " class="form-control input-small quantity" type="text" name="quantity[<?php echo $i ;?>]"  value="<?php $qty=$facility_order[$i]['scp_qty'];if($qty>=0){echo $qty;} else {echo 0;}?>"/></td>
							
							<td><input class="form-control input-small actual_quantity" readonly="readonly" type="text" name="actual_quantity[<?php echo $i ;?>]" value="0"/></td>
							<td><?php echo '<input type="text" class="form-control input-small cost" name="cost['.$i.']" value="0" readonly="yes"   />';?></td>
							<!--<td><input class="form-control input-small" type="text" name="comment[<?php echo $i ;?>]" value="N/A" /></td>-->
			       			</tr>					
						<?php } $i=$i-1; echo form_close()."<script>var count=".$i."</script>"	?>
</tbody>
</table>

<hr />
<div class="container-fluid">
<div style="float: right;">
<?php if($option_==='readonly_'):?>
<a target="_blank" href="<?php echo base_url('reports/get_facility_sorf'.$order_number.'/'.$order_details[0]['facility_code']); ?>" >
<button style="margin-left: 130px;" type="button" class="btn btn-primary">
<span class="glyphicon glyphicon-save"></span>Download Order</button>
</a>
<?php else:?>
<?php if($identifier==='county'):	?>
<button type="button" class="reject btn btn-danger"><span class="glyphicon glyphicon-plus"></span>Reject Order</button>
<button type="button" class="approve btn btn-success"><span class="glyphicon glyphicon-open"></span>Approve Order</button>
<button type="button" class="add btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span>Add Item</button></div>
<?php else: ?>
<button type="button" class="add btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Add Item</button>
<button type="button" class="btn btn-success reject_fixed"><span class="glyphicon glyphicon-open"></span>Edit Order</button></div>
<?php endif; endif?>
</div>
</form>  
</div>
<script>
$(document).ready(function() {
	var new_count =count+1;
	var drawing_rights_balance=$('#actual_drawing_rights').val();
	//auto compute the values
	calculate_totals();
	calculate_suggested_value(3);
	//datatables settings 
	$('#example').dataTable( {
       "sPaginationType": "bootstrap",
       "sScrollY": "100%",
	     "sScrollX": "100%",
        "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records"},
        "bPaginate": false} );
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');	
	// add commodity data
    $(".add").button().click( function (){
	var body_content='<table class="table-update"><thead><tr><th>Description</th><th>Commodity Code</th><th>Order Unit Size</th><th>Order Unit Cost (Ksh)</th>'+				   	    
					'</tr></thead><tbody><tr><td>'+
                    '<select name="desc" class="form-control desc"><option value="0">--Select Commodity Name--</option>'+
                    '<?php	foreach($facility_commodity_list as $commodity):
						     $commodity_id=$commodity['commodity_id'];
							 $commodity_code=$commodity['commodity_code'];							
							 $sub_category_name=preg_replace('/[^A-Za-z0-9\-]/', ' ',$commodity['sub_category_name']);
							 $unit_size=preg_replace('/[^A-Za-z0-9\-]/', ' ',$commodity['unit_size']);
							 $unit_cost=$commodity['unit_cost'];
							 $total_commodity_units=$commodity['total_commodity_units'];
							 $commodity_name= preg_replace('/[^A-Za-z0-9\-]/', ' ', $commodity['commodity_name']);?>'+					
						'<option <?php echo 'special_data="'.$commodity_id.'^'.$unit_cost.'^'.$unit_size.
	'^'.$sub_category_name.'^'.$commodity_code.'^'.$total_commodity_units.'" value="'.$commodity_id.'">'.$commodity_name ;?></option><?php endforeach;?>'+
	'</select></td><td><input readonly="readonly" class="form-control" type="text" name="commodity_code"    /></td>'+
						'<td><input class="form-control" readonly="readonly" type="text" name="unit_size"  /></td>'+
						'<td><input class="form-control" readonly="readonly" type="text" name="unit_cost"   />'+
						'<input type="hidden" name="cat_name"/><input type="hidden" name="commodity_id"  />' +
						'<input type="hidden" name="commodity_name_"  /><input type="hidden" name="total_commodity_units_" value=""/></td></tr></tbody></table>';
        //hcmp custom message dialog
    dialog_box(body_content,'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
        '<button type="button" class="btn btn-primary add_item"><span class="glyphicon glyphicon-plus"></span>Add</button>');
    });
    // add item modal box
    $(document.body).on("change", ".desc", function (){
    var data = $('option:selected', this).attr('special_data');  
				var code_array = data.split("^");
				var commodity_id = code_array[0];
				$('input:text[name=commodity_code]').val(code_array[4]);
				$('input:text[name=commodity_id_]').val(commodity_id);
				$('input:text[name=unit_size]').val(code_array[2]);
				$('input:text[name=unit_cost]').val(code_array[1]);
				$('input:hidden[name=cat_name]').val(code_array[3]);
				$('input:hidden[name=commodity_name_]').val($(".desc option:selected").text());
				$('input:hidden[name=total_commodity_units_]').val(code_array[5]);});
	// add the item to the order list			
	$(document.body).on("click", ".add_item", function (){
	 var check_if_the_user_has_selected_a_commodity=$('#desc').val();
//alert(new_count)
	 if(check_if_the_user_has_selected_a_commodity==0){
	 	alert("Please select a commodity first");
	 	return;
	 }

	// add the items here to the order form
	  $("#example" ).dataTable().fnAddData( [ 
  	 '<input type="hidden" class="commodity_name" id="commodity_name['+new_count+']" name="commodity_name['+new_count+']" value="'+$(".desc option:selected").text()+'" />'+
          '<input type="hidden" class="commodity_code" id="commodity_code['+new_count+']" name="commodity_code['+new_count+']" value="'+$('input:text[name=commodity_code]').val()+'" />'+
          '<input type="hidden" class="facility_order_details_id" id="facility_order_details_id['+new_count+']" name="facility_order_details_id['+new_count+']" value="0" />'+
         '<input type="hidden" class="commodity_id" id="commodity_id['+new_count+']" name="commodity_id['+new_count+']" value="'+$(".desc option:selected").val()+'" />'+
         '<input type="hidden" class="total_commodity_units" id="total_commodity_units['+new_count+']" name="total_commodity_units['+new_count+']" value="'+$('input:hidden[name=total_commodity_units_]').val()+'" />'+ 
         '<input type="hidden" class="unit_cost" id="price['+new_count+']" name="price['+new_count+']" value="'+$('input:text[name=unit_cost]').val()+'" />'+
         '<input type="hidden" id="unit_size['+new_count+']" name="unit_size['+new_count+']" value="'+$('input:text[name=unit_size]').val()+'" />'+
							//"" + $('input:hidden[name=cat_name]').val() + "" ,  
							"" + $('input:hidden[name=commodity_name_]').val() + "" , 
							//"" + $('input:text[name=commodity_code]').val() + "" ,
							"" + $('input:text[name=unit_size]').val() + "" ,
							"" + $('input:text[name=unit_cost]').val() + "" ,
						  '' +'<input class="form-control input-small" type="text" name="open['+new_count+']" id="open['+new_count+']"   value="0"/>',
							'<input class="form-control input-small" type="text" name="issues['+new_count+']" id="issues['+new_count+']"   value="0" />',
							'<input class="form-control input-small" type="text" name="receipts['+new_count+']" id="receipts['+new_count+']"  value="0" />' ,
							'<input class="form-control input-small" type="text" name="adjustmentnve['+new_count+']" id="adjustmentnve['+new_count+']"  value="0"   />' ,
                            '<input class="form-control input-small" type="text" name="adjustmentpve['+new_count+']" id="adjustmentpve['+new_count+']"  value="0"   />' ,
							'<input class="form-control input-small" type="text" name="losses['+new_count+']" id="losses['+new_count+']" value="0"   />' ,
							'<input class="form-control input-small" type="text" name="closing['+new_count+']" id="closing['+new_count+']" value="0"   />',
							'<input class="form-control input-small" type="text" name="days['+new_count+']" id="days['+new_count+']" value="0"   />',
							'<input class="form-control input-small" type="text" name="amc['+new_count+']" id="amc['+new_count+']" value="0"   />',
							'<input class="form-control input-small" type="text" value="0" name="suggested['+new_count+']" 	id="suggested['+new_count+']" readonly="yes"  />',
							'<input class="form-control input-small" type="text" value="0" name="cty_qty['+new_count+']" 	id="cty_qty['+new_count+']" readonly="yes"  />',
							'<input class="form-control input-small" type="text" value="0" name="scp_qty['+new_count+']" 	id="scp_qty['+new_count+']" readonly="yes"  />',
							'<input class="form-control input-small quantity" type="text" name="quantity['+new_count+']" id="quantity['+new_count+']" value="0" />',
							'<input class="form-control input-small actual_quantity" type="text" name="actual_quantity['+new_count+']" id="actual_quantity['+new_count+']" value="0" readonly="yes" />',
							'<input class="form-control input-small cost" type="text" name="cost['+new_count+']" id="cost['+new_count+']" value="0" readonly="yes" />'
							//'<input type="text" class="form-control input-small" name="comment['+new_count+']" id="comment['+new_count+']" value="N/A"/>'
		]); 
		new_count=new_count+1;
		$('#communication_dialog').modal('hide');	
	});
	//compute the order totals here
	$(document).on('keyup','.quantity', function (){
		//alert()
	var selector_object=$(this);
	var user_input=$(this).val();
	var total_units=$(this).closest("tr").find(".total_commodity_units").val();
	var unit_cost=$(this).closest("tr").find(".unit_cost").val();
	// check the user input value here
	var alert_message='';
			if (selector_object.val() <0) { alert_message+="<li>Order value must be above 0</li>";}
		    if (selector_object.val().indexOf('.') > -1) {alert_message+="<li>Decimals are not allowed.</li>";}		
			if (isNaN(selector_object.val())){alert_message+="<li>Enter only numbers</li>";}				
			if(isNaN(alert_message)){
	//reset the text field and the message dialog box 
    selector_object.val(""); var notification='<ol>'+alert_message+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;';
    //hcmp custom message dialog
    dialog_box(notification,'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
    //This event is fired immediately when the hide instance method has been called.
    $('#communication_dialog').on('hide.bs.modal', function (e) { selector_object.focus();	})
    calculate_totals();
    $(this).closest("tr").find(".actual_quantity").val("");
	$(this).closest("tr").find(".cost").val("");
    return;   } 
    if(user_input==''){
    	user_input=0;
    }
	
	// set the order total here
	calculate_totals();	
	});
	
	// process all the order into a summary table for the user to confirm before placing the order bed_capacity workload
	$('.approve').on('click','', function (){
	var table_data='<div class="row" style="padding-left:2em"><div class="col-md-6"><h4>Order Summary</h4></div></div>'+
    '<div class="row" style="padding-left:2em"><div class="col-md-6">Total Order Value (Ksh)</div><div class="col-md-6">'+number_format($("#total_order_value").val(), 2, '.', ',')+'</div></div>'+
    '<table class="table table-hover table-bordered table-update">'+
					"<thead><tr>"+
					"<th>Description</th>"+
					"<th>Commodity Code</th>"+
					"<th>Order Quantity</th>"+
					"<th>Unit Cost Ksh</th>"+
					"<th>Total Ksh</th></tr></thead><tbody>";	 	    			
        $("input[name^=cost]").each(function(i) { 
         	//$(document).each('','input[name^=cost]', function (i){
         var C_name=$(this).closest("tr").find(".commodity_name").val()
         //alert(C_name);
         //return;
        table_data +="<tr>" +
							"<td>" +C_name+ "</td>" +
							"<td>" +$(this).closest("tr").find(".commodity_code").val()+ "</td>" +
							"<td>" +$(this).closest("tr").find(".quantity").val()+ "</td>" +	
							"<td>" +number_format($(this).closest("tr").find(".unit_cost").val(), 2, '.', ',')+ "</td>" +	
							"<td>" +number_format($(this).closest("tr").find(".cost").val(), 2, '.', ',')+ "</td>" +													
						"</tr>" 
                    });
         table_data +="</tbody></table>";
    //hcmp custom message dialog
    dialog_box(table_data,'<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>'
    +'<button type="button" class="btn btn-primary" id="save_dem_order" data-dismiss="modal">Save</button>');
	});
      /************save the data here*******************/

	$('#main-content').on('click','#save_dem_order',function() {
     var order_total=$('#total_order_value').val();
     var alert_message='';
     if (order_total==0) {alert_message+="<li>Sorry, you can't submit an Order Value of Zero</li>";}
     
     //put delay timer here
    var img='<img src="<?php echo base_url('assets/img/wait.gif') ?>"/>';
     dialog_box(img+'<h5 style="display: inline-block; font-weight:500;font-size: 18px;padding-left: 2%;"> Please wait as the order is being processed</h5>',
     '');
    	//nxt();
    	$("#myform").submit();
     	
     
     });
     //change ordeing cycle
     $('#main-content').on('change','#order_period',function() {
     var month=$(this).val(); 
     $("#month").html(month);
     calculate_suggested_value(month);
     	
     });
	function calculate_totals(){
	var order_total=0;
	var balance=0
	 $("input[name^=quantity]").each(function() {

	 	if($(this).val()=='')
	 	{ var total=0} 
	 	else{ var total=$(this).val()
	 		}//calculate the balances here
	 	var unit_cost=$(this).closest("tr").find(".unit_cost").val();
	 	var actual_units=parseInt($(this).closest("tr").find(".total_commodity_units").val())*total;
	 	var total_cost=parseInt(total)*parseInt(unit_cost.replace(",", ""));    	
        order_total=(total_cost)+parseInt(order_total); 
	    $(this).closest("tr").find(".actual_quantity").val(actual_units);
	    $(this).closest("tr").find(".cost").val(total_cost);   
     });//check if order total is a NAN
    //calculate the balances here
      balance=parseInt(drawing_rights_balance)-order_total;
     //set the balances here
     $("#total_order_balance_value").val(balance)
     $("#total_order_value").val(order_total);
		
	}
	
	function calculate_suggested_value(month){
		$("input[name^=suggested]").each(function() {
        var amc=parseInt($(this).closest("tr").find(".amc").val());
	 	var closing_stock=parseInt($(this).closest("tr").find(".closing").val());
        var suggested=0;       
        if(closing_stock<0) {closing_stock=0;}
        suggested=((amc*month)-closing_stock)+amc;
        if(suggested<0) {suggested=0;}
        $(this).val(suggested)
     });//check if order total is a NAN
	}	
	$('.approve').on('click', function() {
     $('#approved_admin').val(1);
     save_the_order_form()
     });
     $('.reject').on('click', function() {
     $('#rejected_admin').val(1);
     save_the_order_form()
     });
     $('.reject_fixed').on('click', function() {
     $('#rejected').val(1);
     save_the_order_form()
     });	
    
});

</script>
