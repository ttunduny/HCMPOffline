<span  class='label label-info' >Please note this is a one off activity</span><br>
<span class='label label-info' >Stock level as of <?php $today= ( date('d M Y')); //get today's date in full?>
<input type="hidden" name="datepicker" readonly="readonly" value="<?php echo $today;?>"/><?php echo $today;?> To Add facility stock data, first do physical stock count</span>
<br />
<br />
<?php $att=array("name"=>'myform','id'=>'myform');
echo form_open('stock/add_stock_first_run',$att); ?>
<div class="wrapper small"></div>
<div class="table-responsive">
<table  class="table table-hover table-bordered table-update"  id="facility_stock_table">
	<thead style="background-color: white">
		<tr>
			<th style="text-align:center; font-size: 14px"><b>Description</b></th>
			<th style="text-align:center; font-size: 14px"><b>Source</b></th>
			<th style="text-align:center; font-size: 14px"><b>Unit Size</b></th>
			<th style="text-align:center; font-size: 14px"><b>Unit of Issue</b></th>
			<th style="text-align:center; font-size: 14px"><b>Batch No</b></th>
			<th style="text-align:center; font-size: 14px"><b>Source of Item</b></th>
			<th style="text-align:center; font-size: 14px"><b>Manufacturer</b></th>
			<th style="text-align:center; font-size: 14px"><b>Expiry Date</b></th>
			<th style="text-align:center; font-size: 14px"><b>Stock Level</b></th>
			<th style="text-align:center; font-size: 14px"><b>Total Unit Count</b></th>
			<th style="text-align:center; font-size: 14px"><b>Options</b></th>
		</tr>
	</thead>
	    <tbody>
		<tr drug_row="1">
			<td><input type="hidden" id="desc_hidden" class="desc_hidden"  name="desc_hidden"/>	
				<input type="hidden" class="commodity_id" value=""  name="commodity_id[]"/>
			<select  name="desc[]" class="form-control desc">
				<option special_data="0" value="0">-Select One--</option>
				<?php
				foreach ($commodities as $commodities) {
					
					$id=$commodities->id;
					$commodities_name=$commodities->commodity_name;
					$unit_size=$commodities->unit_size;
					$commodity_code=$commodities->commodity_code;
					
					foreach($commodities->supplier_name as $supplier_name):
					$name=$supplier_name->source_name;
					endforeach;
					
					echo "<option special_data='" . $id."^".$name."^".$commodity_code."^".$unit_size . "' value='$id'>".$commodities_name."</option>" ;
				}
				?>
			</select></td>
			<td><input type="text" class="form-control input-small commodity_code" id="disabledTextInput" name="commodity_code[]" disabled/></td>
			<td><input type="text" class="form-control input-small unit_size" id="disabledTextInput"  name="commodity_unit_size[]" disabled/></td>
			<td>
			<select name="commodity_unit_of_issue[]" class="form-control commodity_unit_of_issue input-small">
			<option value="Pack_Size">Pack Size</option>
			<option value="Unit_Size">Unit Size</option>
			</select>	
			</td>
			<td><input class='form-control input-small commodity_batch_no' name='commodity_batch_no[]' type='text'/></td>
			<td><select class="form-control input-small"></select></td>
			<td><input id='commodity_manufacture' class="form-control commodity_manufacture input-small" 
			name='commodity_manufacture[]' type='text' value="" /></td>
			<td><input  class='form-control input-small commodity_expiry_date'  name='commodity_expiry_date[]' type='text' /></td>
			<td><input id='commodity_available_stock' name='commodity_available_stock[]' 
				type='text' class="form-control input-small input-small commodity_available_stock" /></td>
			<td>
		<input class='form-control input-small input-small commodity_total_units' id='commodity_total_units' 
		disabled  type='text' name='commodity_total_units[]' value=''  /></td>
			<td width="20">
			<button type="button" class="add btn btn-primary btn-xs">Add Row</button>
           <button type="button" class="remove btn btn-danger btn-xs" style="display:none;">Remove Row</button>
			</td>
		</tr>
	</tbody>
</table>

<?php echo form_close();?>
</div>

<button class="btn btn-primary"  id="save" >Save</button>

<script type="text/javascript">
	$(document).ready(function() {
		
 var $table = $('table');
//float the headers
  $table.floatThead({ 
	 scrollingTop: 100,
	 zIndex: 1001,
	 scrollContainer: function($table){
	return $table.closest('.wrapper');
	}
	});
	
	//Check if drugs were temporarily saved
	
		//var link="<?php //echo base_url().'stock_management/getTempStock' ?>";
		$.ajax({
			url : "",
			type : 'POST',
			dataType : 'json',
			success : function(data) {
				var data_count=data.length;
				var x=1;
				var last_row=$('#facility_stock_table tr:last');
				$.each(data, function(i, jsondata) {
					var commodity_id=data[i]['id'];
				
					var commodity_code=data[i]['commodity_code'];
					var description=data[i]['description'];
					var unit_size=data[i]['unit_size'];
					var batch_no=data[i]['batch_no'];
					var commodity_manufacture=data[i]['commodity_manufacture'];
					var commodity_expiry_date=data[i]['commodity_expiry_date'];
					var stock_level=data[i]['stock_level'];
					var unit_count=data[i]['unit_count'];
					var facility_code=data[i]['facility_code'];
					var commodity_id=data[i]['commodity_id'];
				    var unit_issue=data[i]['unit_issue'];
					
					var cloned_object = $('#facility_stock_table tr:last').clone(true);
					var drug_row = cloned_object.attr("drug_row");
					var next_drug_row = parseInt(drug_row) + 1;
					cloned_object.attr("drug_row", next_drug_row);
					cloned_object.find(".remove").show();
					
					var expiry_id = "commodity_expiry_date_" + next_drug_row;
					var comb=commodity_id+"^"+commodity_code+"^"+description+"^"+unit_size;
					comb= $.trim(comb);
					cloned_object.find(".desc").val(commodity_id);
					cloned_object.find(".commodity_code").attr('value',commodity_code);
					cloned_object.find(".unit_size").attr('value',unit_size);
					cloned_object.find(".commodity_batch_no").attr('value',batch_no);
					cloned_object.find(".commodity_manufacture").attr('value',commodity_manufacture);
					cloned_object.find(".commodity_expiry_date").attr('value',commodity_expiry_date);
					cloned_object.find(".commodity_available_stock").attr('value',stock_level);
					cloned_object.find(".commodity_total_units").attr('value',unit_count);
					cloned_object.find(".commodity_unit_of_issue").attr('value',unit_issue);
					cloned_object.find(".commodity_id").attr('value',commodity_id);
					cloned_object.insertAfter('#facility_stock_table tr:last');
					
					if(x==data_count){
						$('#facility_stock_table tbody tr:first').remove();
					}
					x++;
					
				});

			}
		}); 
		
		 ////when the user selects the commodity name
			$(".desc").change(function(){
			var data =$('option:selected', this).attr('special_data'); 

	       	var data_array=data.split("^");
	       	
	       	$(this).closest("tr").find(".unit_size").val(data_array[3]);
	     	$(this).closest("tr").find(".commodity_code").val(data_array[1]);
	     	$(this).closest("tr").find(".commodity_id").val(data_array[0]);

		   });
		   
		////when the user clicks add a row
		  $(".add").click(function() {
			
			var last_row = $('#facility_stock_table tr:last');
			//Get data for the last row
			var last_drug=last_row.find(".desc").val();
			/*
			 * Post temp data
			 */
			//var url = "<?php // echo base_url().'stock_management/autosave_update'?>";
			
			/*var data =$('option:selected', $(this).closest("tr").find('.desc')).attr('special_data'); 
            
	       	var data_array=data.split("^");
			var unit_size=$(this).closest("tr").find('.unit_size').val();
			var batchNo=$(this).closest("tr").find('.batchN').val();
			var manuf=$(this).closest("tr").find('.manuf').val();
			var expiry_date=$(this).closest("tr").find('.my_date').val();
			var stock_level=$(this).closest("tr").find('.a_stock').val();
			var unit_count=$(this).closest("tr").find('.qreceived').val();
			var unitissue=$(this).closest("tr").find('.unitissue').val();
			
			var alert_message='';
			
			if(data==0){
				alert_message +="- Select a commodity first\n";
			}
			
			if(batchNo==""){
				alert_message +="- Indicate batch No of the commodity\n";
			}
			if(manuf==""){
				alert_message +="-Indicate Manufacturer of the commodity\n";
			}
			if(expiry_date==''){
				alert_message +="-Indicate the expiry date of the commodity\n";
			}
			if(stock_level==''){
				alert_message +="-Indicate the stock level of the commodity\n";
			}
			if(isNaN(alert_message)){
				alert(alert_message+' before adding a new row\n');
				return;
			}
						
             if(batchNo!='' && stock_level!=''){									
	          $.ajax({
	          type: "POST",
	          data: "&kemsa_code="+data_array[1]+"&description=N/A&unit_size="
	          +unit_size+" &batch_no="+batchNo+"&manu="+manuf+
	          "&expiry_date="+expiry_date+
	          "&stock_level="+stock_level+
	          "&unit_count="+unit_count+
	          "&unit_issue="+unitissue+
	          "&drug_id="+data_array[0],
	          url: url,
	          beforeSend: function() {
	           // console.log("data to send :"+data);
	          },
	          success: function(msg) {
	            console.log(msg);
	            
	             }
	         });
	       }*/
			/*
			 * Post temp data end
			 */
			
			var cloned_object = $('#facility_stock_table tr:last').clone(true);
			var drug_row = cloned_object.attr("facility_stock_table");
			/*var next_drug_row = parseInt(drug_row) + 1;
			cloned_object.attr("drug_row", next_drug_row);

			//Get New Object id's
			var category_id = "desc_" + next_drug_row;
			var kemsa_code_id = "kemsa_code_" + next_drug_row;
			var unit_size_id = "unit_size_" + next_drug_row;
			var Pack_Size_id = "Pack_Size_" + next_drug_row;
			var batchNo_id = "batchNo_" + next_drug_row;
			var manuf_id = "manuf_" + next_drug_row;
			var my_date_id = "my_date_" + next_drug_row;
			var a_stock_id = "a_stock_" + next_drug_row;
			var qreceived_id = "qreceived_" + next_drug_row;
           
			//Find Old Objects and reset values

			var desc = cloned_object.find(".desc");
			var kemsa_code = cloned_object.find(".kemsa_code");
			var unit_size = cloned_object.find(".unit_size");
			var Unit_Issue_Size = cloned_object.find(".quantity");
			var Pack_Issue_Size = cloned_object.find(".quantity_available");
			var batchNo = cloned_object.find(".batchN");
			var manuf = cloned_object.find(".manuf");
			var my_date = cloned_object.find(".my_date");
			var a_stock = cloned_object.find(".a_stock");
			var qreceived = cloned_object.find(".qreceived");

			desc.attr("value", "0");

			kemsa_code.attr("id", unit_size_id);
			kemsa_code.attr("value", "");

			unit_size.attr("id", kemsa_code_id);
			unit_size.attr("value", "");

			batchNo.attr("id", batchNo_id);
			batchNo.attr("value", "");

			manuf.attr("id", manuf_id);
			manuf.attr("value", "");

			my_date.attr("id", my_date_id);
			my_date.attr("value", "");

			a_stock.attr("id", a_stock_id);
			a_stock.attr("value", "");

			qreceived.attr("id", qreceived_id);
			qreceived.attr("value", "");

			var my_date_selector = "#" + my_date_id;*/

			cloned_object.find(".remove").show();
			cloned_object.insertAfter('#facility_stock_table tr:last');
	
		//	refreshDatePickers();

		});
		
		$('.commodity_available_stock').live('keyup',function(){
  
    var num=$(this).val();
    
    if(!isNaN(num)){
    if(num.indexOf('.') > -1) {	
    alert("Decimals are not allowed.");
    $(this).val(""); $(this).focus();
    return;
     }           
     }                       
    else {
    	
    alert('Enter only numbers');
    $(this).val("");$(this).focus();
    return;
      }

    var commodity_unit_of_issue=$(this).closest("tr").find('.commodity_unit_of_issue').val();

  	if (commodity_unit_of_issue == 'Pack_Size'){
  		//unit_size
  	var actual_unit_size=get_unit_quantity($(this).closest("tr").find('.unit_size').val());	
  	var total_commodity_available_stock=actual_unit_size*num;
 
    $(this).closest("tr").find('.commodity_total_units').val(total_commodity_available_stock);
       }
   else{
	//do this other
	var actual_unit_size=1;

    var total_commodity_available_stock=actual_unit_size*num;
 
    $(this).closest("tr").find('.commodity_total_units').val(total_commodity_available_stock);
    }	
    ///////////////////////////////////////update the record 
           	var url = "<?php echo base_url().'stock_management/autosave_update'?>";
			
			var data =$('option:selected', $(this).closest("tr").find('.desc')).attr('special_data'); 
            
	       	var data_array=data.split("^");
			var unit_size=$(this).closest("tr").find('.unit_size').val();
			var commodity_batch_noo=$(this).closest("tr").find('.commodity_batch_no').val();
			var commodity_manufacture=$(this).closest("tr").find('.commodity_manufacture').val();
			var commodity_expiry_date=$(this).closest("tr").find('.commodity_expiry_date').val();
			var stock_level=$(this).closest("tr").find('.commodity_available_stock').val();
			var unit_count=$(this).closest("tr").find('.commodity_total_units').val();
			var commodity_unit_of_issue=$(this).closest("tr").find('.commodity_unit_of_issue').val();
						
             if($.isNumeric(data_array[0])){
									
	          $.ajax({
	          type: "POST",
	          data: "&commodity_code="+data_array[1]+"&description=N/A&unit_size="
	          +unit_size+" &batch_no="+commodity_batch_noo+"&commodity_manufacture="+commodity_manufacture+
	          "&commodity_expiry_date="+commodity_expiry_date+
	          "&stock_level="+stock_level+
	          "&unit_count="+unit_count+
	          "&unit_issue="+commodity_unit_of_issue+
	          "&commodity_id="+data_array[0],
	          url: url,
	          beforeSend: function() {
	           // console.log("data to send :"+data);
	          },
	          success: function(msg) {
	            console.log(msg);
	            
	             }
	         });
	       }

    });
	
    $('.remove').live('click',function(){
	var data =$('option:selected', $(this).closest("tr").find('.desc')).attr('special_data');            
	

	 if(data!=0){
	var data_array=data.split("^");	
	var commodity_batch_noo=$(this).closest("tr").find('.commodity_batch_no').val();
	
	var facilitycode = "<?php echo  $this -> session -> userdata('news')?>";
	var url = "<?php echo base_url().'stock_management/delete_temp_autosave'?>";

        $.ajax({
          type: "POST",
          data: "drugid="+data_array[0]+"&facilitycode="+facilitycode+"&commodity_batch_noo="+commodity_batch_noo,
          url: url,
          success: function() {
 
          }
        });
       }
 
    $(this).parent().parent().remove();
    
    });
	

json_obj = {
				"url" : "<?php echo base_url().'Images/calendar.gif';?>",
				};
	var baseUrl=json_obj.url;
	

			
//	-- Datepicker		
		
	$(".commodity_expiry_date").datepicker({
					        	beforeShowDay: function(date)
    {
        // getDate() returns the day [ 0 to 31 ]
        if (date.getDate() ==
            getLastDayOfYearAndMonth(date.getFullYear(), date.getMonth()))
        {
            return [true, ''];
        }

        return [false, ''];
    },
					
					dateFormat: 'd M yy', 
					changeMonth: true,
			        changeYear: true,
			        buttonImage: baseUrl,
			       
				});
			
/************save move*******************/
				var $myDialog = $('<div></div>')
    .html('Please confirm the values before saving')
    .dialog({
        autoOpen: false,
        title: 'Confirmation',
        buttons: { "Cancel": function() {
                      $(this).dialog("close");
                      return false;
                },
                "OK": function() { 
                	var checker=0;
                	$("input[name^=commodity_expiry_date]").each(function() {
                		checker=checker+1;
                		
                	});
                	//alert(checker);
                	if(checker=0){
                		alert("Cannot submit an empty form");
                		$(this).dialog("close"); 
                	}
                	else{
                	$(this).dialog("close"); 
                      $('#myform').submit();
                      return true;	
                	}
                	
                      
                 }
        }
});
		$('#save')
		.button()
			.click(function() {
				
			return $myDialog.dialog('open');
		});	
			

    /*********************getting the last day of the month***********/
  function getLastDayOfYearAndMonth(year, month)
{
    return(new Date((new Date(year, month + 1, 1)) - 1)).getDate();
}
   

	function refreshDatePickers() {
		var counter = 0;
		$('.commodity_expiry_date').each(function() {
			var this_id = $(this).attr("id"); // current inputs id
        var new_id = counter +1; // a new id
        $(this).attr("id", new_id); // change to new id
        $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
        $(this).datepicker({ 
        	beforeShowDay: function(date)
    {
        // getDate() returns the day [ 0 to 31 ]
        if (date.getDate() ==
            getLastDayOfYearAndMonth(date.getFullYear(), date.getMonth()))
        {
            return [true, ''];
        }

        return [false, ''];
    },
        	dateFormat: 'd M yy', 
        	        buttonImage: baseUrl,
					changeMonth: true,
			        changeYear: true
				});; // re-init datepicker
				counter++;
		});
		
		
  }
		

	    });
	
	
</script>

