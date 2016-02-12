<style>
	.row div p{
	padding:10px;
}
</style>
<div class="test"><div class="container" style="width: 96%; margin: auto;">
	
	<div class="row">
		<div class="col-md-7" id=""><p class="bg-info">
			 Enter the Price for the commodity and click on Save</p>
		</div>		
	</div>
	</div>

</div>
<center>
<div style="max-height:600px; overflow-y:auto; width: 96%">
<form id="update_sp_stock" method="post" action="<?php echo base_url('dispensing/update_service_point_prices')?>">
<table width="100%" class="row-fluid table table-hover table-bordered table-update"  id="example">
<thead>
<tr style="background-color: white">						
						<th>Description</th>
						<th>Commodity&nbsp;Code</th>						
						<th>Unit Size</th>						
					    <th>Unit&nbsp;Price&nbsp;(Ksh)</th>		    
					    		    
</tr>
</thead>
<tbody>
<?php   foreach($commodities as $facility_commodities):
	       $status=$facility_commodities['selected']=='1' ? 'checked="true"'  : null; 	   
		   echo "<tr>
		   <input type='hidden' name='commodity_id[]' class='commodity_id' value='$facility_commodities[commodity_id]'/>	   
		   <td>$facility_commodities[commodity_name]</td>
		   <td>$facility_commodities[commodity_code]</td>	 
		   <td>$facility_commodities[unit_size]</td>
		   <td><input class='form-control input-small price' type='text' name='price[]' value='$facility_commodities[price]' </td>
		   </tr>"; 
       endforeach; 
?>
</tbody>
</table>
</form>
</div> 
</center>
<hr />
<div class="container-fluid">
<div style="float: right">
<button class="save btn btn-success">
<span class="glyphicon glyphicon-open"></span>Save</button></div>
</div>
</div>
<script>
$(document).ready(function() {	
	window.onbeforeunload = function() {
        return "Are you sure you want to leave?";
    }
    
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
		},
        "bPaginate": false} );
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');			
	// $('.quantity').on('keyup',function(){
	// var selector_object=$(this);
	// var num=selector_object.val();	
	// var commodity_unit_of_issue=selector_object.closest("tr").find('.commodity_unit_of_issue').val();
 //    // var actual_unit_size=selector_object.closest("tr").find('.actual_units').val();	
 //    if(num==''){ //check if the user has entered a value or just clearing the textfield   
 //    selector_object.closest("tr").find('.checkbox').prop('checked', false);  
 //    } else{
 //    selector_object.closest("tr").find('.checkbox').prop('checked', true);  	
 //    }  
	// // finally calculate the stock 
 //    // calculate_actual_stock(actual_unit_size,commodity_unit_of_issue,num,".actual_quantity",selector_object);
 //   var data= get_the_data_from_the_form_to_save(selector_object);
 //     //save the data in the db          
	// var url = "<?php echo base_url().'dispensing/save_set_up_service_stock'?>";	  
 //    ajax_simple_post_with_console_response(url, data);	
	// });	
	
	// $(".checkbox").change(function() {
	// var selector_object=$(this);
 //    if(this.checked) {
 //    var data =get_the_data_from_the_form_to_save(selector_object);	
 //     //save the data in the db          
	// var url = "<?php echo base_url().'dispensing/save_set_up_service_stock'?>";	  
 //    ajax_simple_post_with_console_response(url, data);	
 //    } else{
 //    selector_object.closest("tr").find('.actual_units').val(0);
 //    selector_object.closest("tr").find('.quantity').val(0);
 //    var data =get_the_data_from_the_form_to_save(selector_object);	
 //     //save the data in the db          
	// var url = "<?php echo base_url().'dispensing/save_set_up_service_stock/delete'?>";	  
 //    ajax_simple_post_with_console_response(url, data);	  	
 //    }
 //    });
	// function get_the_data_from_the_form_to_save(selector_object){
	// var commodity_id=selector_object.closest("tr").find('.commodity_id').val();		
	// var price=selector_object.closest("tr").find('.price').val();
	// var total_units=selector_object.closest("tr").find('.actual_quantity').val();
	// var data="commodity_id="+commodity_id+" &price="+price+"&total_units="+total_units;
	// return data;
	   	
	// }
	$('.save').button().click(function() {
		$('#update_sp_stock').submit();
		// var saved = [];
  //   		i = 0;

		//  $('.checkbox').each(function() {

  //     if($(this).closest('tr').find('.checkbox').prop('checked')==true){

  //     	 saved[i++] =$(this).closest('tr').find('.checkbox').prop('checked');

  //     }
                 
  //       }); 
		// //window.
		// var size=saved.length;
		// swal({   title: "You have selected "+size+ " commodities.",  
		// 		 text: "Please click cancel to select more, or complete to continue.",  
		// 		 type: "warning",   showCancelButton: true,   confirmButtonColor: "#4cae4c",  
		// 		 confirmButtonText: "Yes, complete!",   closeOnConfirm: false },

		//  function(){  

		//  		 swal({   title: "Success!",   text: "Completed step 1 of 2.",   timer: 2000 , type: "success" });
		//  		 setTimeout(function () {
          	 // window.open("<?php echo base_url('stock/facility_stock_first_run/first_run')?>",'_parent');
				
        // }, 3000);
		 
		  // });
		
	});
})
 
</script>