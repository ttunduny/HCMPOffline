 <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
 <script src="<?php echo base_url().'assets/datatable/dataTables.bootstrap.js'?>" type="text/javascript"></script>
 <script src="<?php echo base_url().'assets/datatable/dataTables.bootstrapPagination.js'?>" type="text/javascript"></script>
 <style>
 	.input-small{
 		width: 55px !important;
 	}
 
 </style>
 <div class="container" style="width: 96%; margin: auto;">
 <!-- Modal -->
<div class="modal fade"  id="add_item_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 50%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">HCMP</h4>
      </div>
      <div class="modal-body" >
       <table class="table-update" width="100%">
					<thead>
					<tr>
						<th>Description</th>
						<th>Commodity Code</th>
						<th>Order Unit Size</th>
						<th>Order Unit Cost (Ksh)</th>					   	    
					</tr>
					</thead>
					<tbody>
						<tr>
						<td>
        <select id="desc" name="desc" class="form-control">
    <option value="0">--Select Commodity Name--</option>
 <?php	foreach($facility_commodity_list as $commodity):
						     $commodity_id=$commodity['commodity_id'];
							 $commodity_code=$commodity['commodity_code'];							
							 $sub_category_name=$commodity['sub_category_name'];
							 $unit_size=$commodity['unit_size'];
							 $unit_cost=$commodity['unit_cost'];
							 $total_commodity_units=$commodity['total_commodity_units'];
							 $commodity_name= $commodity['commodity_name'];?>					
						<option <?php echo 'special_data="'.$commodity_id.'^'.$unit_cost.'^'.$unit_size.
	'^'.$sub_category_name.'^'.$commodity_code.'^'.$total_commodity_units.'" value="'.$commodity_id.'">'.$commodity_name ;?></option>				
		<?php endforeach;?>
	</select></td>
	<td><input readonly="readonly" class="form-control" type="text" name="commodity_code"   /></td>
						<td><input class="form-control" readonly="readonly" type="text" name="unit_size"  /></td>
						<td><input class="form-control" readonly="readonly" type="text" name="unit_cost"   />
						<input type="hidden" name="cat_name"  /><input type="hidden" name="total_commodity_units"   /></td>
						</tr>
					</tbody>
					</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add_item"><span class="glyphicon glyphicon-plus"></span>Add</button>
      </div>
    </div>
  </div>
</div>
<span  class='label label-info'>Enter Order Quantity and Comment,
Order Quantity= (Monthly Consumption * 4) - Closing Stock</span>
<div class="row" style="padding-left: 1%;">
	<div class="col-md-2">
	<b>*select ordering frequency</b> <select class="form-control" name="order_period" id="order_period">
 	<option>Quaterly</option>	
 	<option>Monthly</option>
 	</select> 	
	</div>
	<div class="col-md-2">
     <b>*Oder Form Number:</b> <input type="text" class="form-control input_text" name="order_no" id="order_no" required="required"/>
	</div>
<div class="col-md-2">
	 <b>*Bed Capacity:</b><input type="text" class="form-control  input_text" name="bed_capacity" id="bed_capacity" required="required"/>
</div>	
<div class="col-md-2">
	 <b>*Number of Patients (in/out patients):</b><input type="text" class="form-control input_text" name="workload" id="workload" required="required"/>
</div>
<div class="col-md-2">
<b>Total Order Value</b>
<input type="text" class="form-control" name="total_order_value" readonly="readonly" value="0"/>					
</div>
<div class="col-md-2">
<b>Drawing Rights Available Balance :</b>
<input type="text" class="form-control" name="total_order_balance_value" readonly="readonly" value="<?php echo $drawing_rights; ?>"/>						
</div>
</div>
<table width="50%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
<thead>
<tr style="background-color: white">
						<th>Category</th>
						<th>Description</th>
						<th>Commodity&nbsp;Code</th>
						<th>Order Unit Size</th>
						<th>Order Unit Cost (Ksh)</th>
						<th>Opening Balance</th>
						<th>Total Receipts</th>
					    <th>Total issues</th>
					    <th>Adjustments(-ve)</th>
					    <th>Adjustments(+ve)</th>
					    <th>Losses</th>
					    <th>Closing Stock</th>
					    <th>No days out of stock</th>
					    <th>AMC</th>
					    <th>Suggested Order Quantity</th>
					    <th>Order Quantity</th>
					    <th>Actual Units</th>
					    <th>Order Cost</th>	
					    <th>Comment (if any)</th>				    
	</tr>
</thead>
<tbody>
								<?php $count=0; $thr=true; 
								$j=count($facility_order);
								for($i=0;$i<$j;$i++){?>
						<tr>
							<td><?php echo $facility_order[$i]['sub_category_name'];?></td>
							<?php 
							      $price=$facility_order[$i]['unit_cost'];
								  $price=str_replace(",", '',$price);
							      echo form_hidden('commodity_code['.$i.']', $facility_order[$i]['commodity_code']).
								   form_hidden('total_commodity_units['.$i.']', $facility_order[$i]['total_commodity_units']).
							       form_hidden('commodity_id['.$i.']', $facility_order[$i]['commodity_id']).
							       form_hidden('commodity_name['.$i.']', $facility_order[$i]['commodity_name']).
							       form_hidden('price['.$i.']'  , $price).
							       form_hidden('unit_size['.$i.']'  ,$facility_order[$i]['unit_size']).
								   form_hidden('historical['.$i.']'  ,$facility_order[$i]['historical']).
								   form_hidden('closing_stock_['.$i.']'  ,$facility_order[$i]['closing_stock']); 
							      ?>
							<td><?php echo $facility_order[$i]['commodity_name']?></td>
							<td><?php echo $facility_order[$i]['commodity_code'];?></td>
							<td><?php echo $facility_order[$i]['unit_size']?> </td>
							<td><?php echo $facility_order[$i]['unit_cost']; ?> </td>
							<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="open['.$i.']"'; ?>  value="<?php echo $facility_order[$i]['opening_balance'];?>" /></td>
							<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="receipts['.$i.']"'; ?>  value="<?php echo $facility_order[$i]['total_receipts'];?>" /></td>
							<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="issues['.$i.']"'; ?>  value="<?php echo $facility_order[$i]['total_issues'];?>" /></td>
				<td><input  class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="adjustmentnve['.$i.']"'; ?> value="<?php echo $facility_order[$i]['adjustmentnve']?>" /></td>
				<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="aadjustmentpve['.$i.']"'; ?> value="<?php echo $facility_order[$i]['adjustmentpve']?>" /></td>
							<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="losses['.$i.']"'; ?> value="<?php echo $facility_order[$i]['losses'] ?>" /></td>
							<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="closing['.$i.']"'; ?> value="<?php echo $facility_order[$i]['closing_stock'];?>" /></td>
							<td><input class="form-control input-small" readonly="readonly" type="text"<?php echo 'name="days['.$i.']"'; ?> value="<?php echo $facility_order[$i]['days_out_of_stock'];?>" /></td>
							<td><input class="form-control input-small" readonly="readonly" type="text" value="<?php echo $facility_order[$i]['historical'];?>"/></td>
							<td><input class="form-control input-small" readonly="readonly"type="text" <?php echo 'name="suggested['.$i.']"';?> value=""/></td>
							<td><input class="form-control input-small" id="quantity[]"type="text" <?php echo 'name="quantity['.$i.']"';?> value="<?php $qty=$facility_order[$i]['quantity_ordered'];
							if($qty>0){echo $qty;} else echo 0;?>"/></td>
							<td><input class="form-control input-small" readonly="readonly" type="text" <?php echo 'name="actual_quantity['.$i.']"';?> value="0"/></td>
							<td><?php echo '<input type="text" class="form-control input-small" name="cost['.$i.']" value="0" readonly="yes"   />';?></td>
							<td><input class="form-control input-small" type="text" <?php echo 'name="comment['.$i.']"' ?>  value="N/A" /></td>
			       			</tr>						
						<?php $i++;  } echo form_close()."<script>var count=".$i."</script>"	?>
</tbody>
</table>  
<hr />
<div class="container-fluid">
<div style="float: right">
<button type="button" class="add btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Add Item</button>
<button class="btn btn-success"><span class="glyphicon glyphicon-open"></span>Save</button></div>
</div>
</div>
<script>
$(document).ready(function() {
var $table = $('#example');
//float the headers
  $table.floatThead({ 
	 scrollingTop: 100,
	 zIndex: 1001,
	 scrollContainer: function($table){ return $table.closest('.col-md-3'); }
	});	
	//datatables settings 
	$('#example').dataTable( {
       "sPaginationType": "bootstrap",
        "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records"},
        "bPaginate": false} );
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');	
	// add commodity data
    $(".add").button().click( function (){
    //reset the values here before opening the modal box
    $('#desc').val(0);
    $('input:text[name=commodity_code]').val("");
	$('input:text[name=unit_size]').val("");
	$('input:text[name=unit_cost]').val("");
	$('input:hidden[name=cat_name]').val("");
	$('input:hidden[name=total_commodity_units]').val("");
	//open the modal box
    $('#add_item_modal').modal('show');	
    });
    // add item modal box
    $("#desc").change( function (){
    var data= $('option:selected', this).attr('special_data');  
				var code_array=data.split("^");
				var commodity_id=code_array[0];
				$('input:text[name=commodity_code]').val(code_array[4]);
				$('input:text[name=unit_size]').val(code_array[2]);
				$('input:text[name=unit_cost]').val(code_array[1]);
				$('input:hidden[name=cat_name]').val(code_array[3]);
				$('input:hidden[name=total_commodity_units]').val(code_array[5]);});
	// add the item to the order list			
	$(".add_item").button().click( function (){
	 var check_if_the_user_has_selected_a_commodity=$('#desc').val();
	 if(check_if_the_user_has_selected_a_commodity==0){
	 	alert("Please select a commodity first");
	 	return;
	 }	
	// add the items here to the order form
	  $("#example" ).dataTable().fnAddData( [ 
         '<input type="hidden" id="drugCode['+new_count+']" name="drugCode['+new_count+']" value="'+$('input:text[name=k_code]').val()+'" />'+
         '<input type="hidden" id="kemsaCode['+new_count+']" name="kemsaCode['+new_count+']" value="'+$('input:hidden[name=drug_id]').val()+'" />'+
         '<input type="hidden" id="drugName['+new_count+']" name="drugName['+new_count+']" value="'+$("#desc option:selected").text()+'" />'+ 
         '<input type="hidden" id="price['+new_count+']" name="price['+new_count+']" value="'+$('input:text[name=o_unit_cost]').val()+'" />'+
         '<input type="hidden" id="unit_size['+new_count+']" name="unit_size['+new_count+']" value="'+$('input:text[name=o_unit_size]').val()+'" />'+
							"" + $('input:hidden[name=cat_1]').val() + "" ,  
							"" + $("#desc option:selected").text() + "" , 
							"" + $('input:text[name=k_code]').val() + "" ,
							"" + $('input:text[name=o_unit_size]').val() + "" ,
							"" + $('input:text[name=o_unit_cost]').val() + "" ,
							'' +'<input class="user2" type="text" name="open['+new_count+']" id="open[]"   value="0"/>',
							'<input class="user2" type="text" name="issues['+new_count+']" id="issues[]"   value="0" />',
							 '<input class="user2" type="text" name="receipts['+new_count+']" id="receipts[]"  value="0" />' ,
							'<input class="user2" type="text" name="adjustments['+new_count+']"  value="0"   />' ,
							'<input class="user2" type="text" name="losses['+new_count+']" value="0"   />' ,
							'<input class="user2" type="text" name="closing['+new_count+']" value="0"   />',
							 '<input class="user2" type="text" name="days['+new_count+']" value="0"   />',
							 '<input class="user2" type="text" name="historical['+new_count+']" value="0"   />',
							 '<input class="user2" type="text" value="0" readonly="yes"  />',
							'<input class="user2" type="text" name="quantity['+new_count+']" value="0"  onkeyup="checker('+new_count+','+txz+')"/>',
							'<input class="user" type="text" id="actual_quantity['+new_count+']" name="actual_quantity['+new_count+']" value="0" readonly="yes" />',
							'<input id="cost[]" class="user" type="text" name="cost['+new_count+']" value="0" readonly="yes" />',
							'<input type="text" class="user2" name="comment['+new_count+']" value="N/A"/>'
		]); 
		
	})			
    
});//

</script>