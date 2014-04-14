<?php 
		$identifier = $this -> session -> userdata('user_indicator');
		$rejected_data='';
		$delivery_data='';
		$pending_data='';
		$approved_data='';
				
		foreach($delivered as $delivered_details):
			
			$order_id= $delivered_details['id'];                       
$mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['order_date'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['order_total'];
			$order_total=number_format($order_total, 2, '.', ',');
			/*$delivery_total=$delivered_details['total_delivered'];
			$delivery_total=number_format($delivery_total, 2, '.', ',');
			$fill_rate=$delivered_details['fill_rate'];
			 *            <td>$delivery_total</td>
           <td>$fill_rate %</td>
           <td></td>*/
			$link=base_url('orders/get_facility_sorf/'.$delivered_details['id'].'/'.$mfl);	
			$link2=base_url().'order_management/update_order/'.$delivered_details['id'];			
		    $delivery_data .= <<<HTML_DATA
           <tr>
           
	<td>$order_id</td>          
 <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>
           <td><a href='$link' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order</button></a>|  
                <span ><a href='$link'>View</a></span></td>
           </tr>
HTML_DATA;
			
			endforeach;			
			foreach($pending as $delivered_details):			
			$order_id= $delivered_details['id'];                       
$mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['order_date'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['order_total'];
			$order_total=number_format($order_total, 2, '.', ',');

			$link=base_url('orders/get_facility_sorf/'.$delivered_details['id'].'/'.$mfl);	
			$link2=base_url('orders/update_facility_order/'.$delivered_details['id']);			
		    $pending_data .= <<<HTML_DATA
            <tr>
           
	<td>$order_id</td>          
 <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>          
           <td><a href='$link' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order</button></a> 
           <a href='$link2' ><button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span>Edit Order</button></a>
           <a id="$delivered_details[id]" href="#"class="delete"> 
		<button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-circle"></span>Delete</button></a></td>
           </tr>
HTML_DATA;
			
			endforeach;
			
			foreach($rejected as $delivered_details):
			
			$order_id= $delivered_details['id'];                       
$mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['order_date'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['order_total'];
			$order_total=number_format($order_total, 2, '.', ',');
	
			$order_total=number_format($order_total, 2, '.', ',');
			$link=base_url('orders/get_facility_sorf/'.$delivered_details['id'].'/'.$mfl);	
			$link2=base_url('orders/update_facility_order/'.$delivered_details['id']."/rejected");
		    $rejected_data .= <<<HTML_DATA
            <tr>        
	<td>$order_id</td>          
 <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>          
          <td><a href='$link' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order</button></a>      
              <a href='$link2' ><button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span>Edit Order</button></a>
              <a id="$delivered_details[id]" href="#"class="delete"> 
		<button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-circle"></span>Delete</button></a></td>
           </tr>
HTML_DATA;
			
			endforeach;
			
				foreach($approved as $delivered_details):
			
			$order_id= $delivered_details['id'];                       
$mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['order_date'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['order_total'];
			$order_total=number_format($order_total, 2, '.', ',');
	        $aggregate_data=($identifier==='district')? "<td><input type='checkbox' name='delete[$count]' value='$order_id' /></td>": null;
			$link=base_url().'order_management/update_order/'.$delivered_details['id']; 
			$link2=base_url('orders/update_facility_order/'.$delivered_details['id']."/0/readonly");			
		    $approved_data .= <<<HTML_DATA
            <tr>
           
	<td>$order_id</td>          
 <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>
           <td><a href='$link' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order</button></a>         
            <a href='$link2'>
            <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-zoom-in"></span>View Order</button></a>
           </td>
           $aggregate_data
           </tr>
HTML_DATA;
			
			endforeach;
		$rejected_orders=0;
		$pending_orders=0;
		$approved_orders=0;
		$delivered_orders=0;
	//	foreach ($order_counts as $item) {
		    $rejected_orders=(array_key_exists('rejected', $order_counts) && $order_counts['rejected']>0)? $order_counts['rejected']: 0;
			$pending_orders=(array_key_exists('pending', $order_counts) && $order_counts['pending']>0)? $order_counts['pending']: 0;
			$approved_orders=(array_key_exists('approved', $order_counts) && $order_counts['approved']>0)? $order_counts['approved']: 0;
			$delivered_orders=(array_key_exists('delivered', $order_counts) && $order_counts['delivered']>0)? $order_counts['delivered']: 0;

		//} 
		?>
		<style>
			dataTables_scrollHeadInner {
width: 500px !important;
}

  table{
  	width: 100% !important;
  }
		</style>
<div class="row container" style="width: 95%; margin: auto;">
<div class="col-md-2" style="border: 1px solid #DDD;">
<div class="table-responsive" style="height:100%; overflow-y: auto;">
<span class='label label-info'>Orders Summary</span>
<table>
 <tr><td>Rejected Orders</td><td><?php echo $rejected_orders; ?></td></tr>
		<tr><td>Pending Approval</td><td><?php echo $pending_orders; ?></td></tr>
		<tr><td>Pending Delivery</td><td><?php echo $approved_orders; ?></td></tr>
		<tr><td>Delivered</td><td><?php echo $delivered_orders; ?></td></tr>
</table>
</div>
 </div>
<div class="col-md-10" style="border: 1px solid #DDD;">
	<ul id="myTab" class="nav nav-tabs">
      <li class=""><a href="#Rejected" data-toggle="tab">Rejected Orders</a></li>
      <li class=""><a href="#Approval" data-toggle="tab">Pending Approval</a></li>
      <li class=""><a href="#Delivery" data-toggle="tab">Pending Delivery</a></li>
      <li class=""><a href="#Delivered" data-toggle="tab">Delivered</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade active in" id="Rejected">
 <table cellpadding="0" cellspacing="0" width="100%" border="0" 
 class="row-fluid table table-hover table-bordered table-update my"  id="test1">
	<thead>
		<tr>
			<th>HCMP Order No.</th>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $rejected_data; ?>
</tbody>
</table> 
      </div>
      <div class="tab-pane fade" id="Approval">
      	<br />
        <table width="100%" border="0" 
        class="row-fluid table table-hover table-bordered table-update"  id="test2" style="margin-top: 50px">
	<thead>
		<tr>
			<th>HCMP Order No.</th>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $pending_data; ?>
</tbody>
</table> 
      </div>
      <div class="tab-pane fade" id="Delivery">
       <table width="100%" border="0" 
       class="row-fluid table table-hover table-bordered table-update"  id="test3">
	<thead>
		<tr>
			<th>HCMP Order No.</th>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
			<?php echo ($identifier==='district')? "<th>Aggregate</th>": null;   ?>
		</tr>
	</thead>
	<tbody>
		<?php echo $approved_data; ?>
</tbody>
</table> 
<?php if($identifier==='district'): ?>
<hr />
<div class="container-fluid">
<div style="float: right">
<button class="btn btn-success aggregate-orders" style="margin-right: -30px"><span class="glyphicon glyphicon-th-list"></span>Aggregate Orders</button></div>
<?php endif; ?>
</div>
      </div>
      <div class="tab-pane fade" id="Delivered">
        <table cellpadding="0" cellspacing="0" width="50%" border="0" 
        class="row-fluid table table-hover table-bordered table-update"  id="test4">
	<thead>
		<tr>
			<th>HCMP Order No.</th>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $delivery_data; ?>
</tbody>
</table> 
      </div>
    </div>
 	

  </div>
  </div>
<script>
/* Table initialisation */
$(document).ready(function() {
	//datatables settings 
	$("#test1").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
	     
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
		$("#test2").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
		$("#test3").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
		$("#test4").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
	$('.dataTables_filter label input').addClass('form-control');
	$('.dataTables_length label select').addClass('form-control');
	$(".delete").live('click', function() {
	id= $(this).attr("id");
		 //hcmp custom message dialog
    dialog_box("The order will be deleted and cannot be recovered!. Are you sure?",
    '<button type="button" class="btn btn-danger delete-dem-order" data-dismiss="modal">Delete</button>'
    +'<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>');
    
    $(".delete-dem-order").live('click', function() {
   window.location="<?php echo site_url('orders/delete_facility_order');?>/"+id;	
    });
	});	
	$(".aggregate-orders").live('click', function() {
	var addition="";
	var url="<?php echo base_url("reports/aggragate_order_new_sorf");?>/";
	var aggragate=false;
	$("input[type=checkbox]").each(function(index, element){
     if(element.checked){
     aggragate=true;
     addition +=$(this).val()+"_";
     } 
     });
     if(aggragate){
     window.open(url+addition,'_blank');
     }else{
     //hcmp custom message dialog
    dialog_box("First Select orders you want to aggragate",
    '<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>');	
     }
     
	});

} );
</script>