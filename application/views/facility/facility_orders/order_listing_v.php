<?php 
$theader='<table width="100%" border="0" class="row-fluid table table-hover table-bordered"  id="example">
					<thead style="font-weight:800 ">
						<tr style="background-color: white"> 
							<td>Actual Date</td>
							<td>HCMP Order No</td>
							<td>Sub- County</td>
							<td>Health Facility</td>
							<td>MFL</td>
							<td>Date Ordered</td>
							<td>Source</td>
							<td>Order Value(Ksh)</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>';
					$theader2='<table width="100%" border="0" class="row-fluid table table-hover table-bordered"  id="example2">
					<thead style="font-weight:800 ">
						<tr style="background-color: white"> 
							<td>Actual Date</td>
							<td>HCMP Order No</td>
							<td>Sub- County</td>
							<td>Health Facility</td>
							<td>MFL</td>
							<td>Date Ordered</td>
							<td>Source</td>
							<td>Order Value(Ksh)</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>';
					$theader3='<table width="100%" border="0" class="row-fluid table table-hover table-bordered"  id="example3">
					<thead style="font-weight:800 ">
						<tr style="background-color: white"> 
							<td>Actual Date</td>
							<td>HCMP Order No</td>
							<td>Sub- County</td>
							<td>Health Facility</td>
							<td>MFL</td>
							<td>Date Ordered</td>
							<td>Source</td>
							<td>Order Value(Ksh)</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>';
					$theader4='<table width="100%" border="0" class="row-fluid table table-hover table-bordered"  id="example4">
					<thead style="font-weight:800 ">
						<tr style="background-color: white"> 
							<td>Actual Date</td>
							<td>HCMP Order No</td>
							<td>Sub- County</td>
							<td>Health Facility</td>
							<td>MFL</td>
							<td>Date Ordered</td>
							<td>Source</td>
							<td>Order Value(Ksh)</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>';
					$theader5='<table width="100%" border="0" class="row-fluid table table-hover table-bordered"  id="example5">
					<thead style="font-weight:800 ">
						<tr style="background-color: white"> 
							<td>Actual Date</td>
							<td>HCMP Order No</td>
							<td>Sub- County</td>
							<td>Health Facility</td>
							<td>MFL</td>
							<td>Date Ordered</td>
							<td>Source</td>
							<td>Order Value(Ksh)</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>';
					
		(int)$rejected_orders='';
		(int)$pending_orders='';
		(int)$pending_all_count='';
		(int)$pending_cty_count='';
		(int)$approved_orders='';
		(int)$delivered_orders='';
		$pending_all_count=$order_counts['pending'];
		$pending_cty_count=$order_counts['pending_cty'];
		$approved_orders=$order_counts['approved'];
		$delivered_orders=$order_counts['delivered'];
		$rejected_orders=$order_counts['rejected'];
		$pending_orders=$pending_all_count+$pending_cty_count;
		// echo "This ".$pending_orders;exit;
		$identifier = $this -> session -> userdata('user_indicator');
?>
<style>
	.badge:hover {
  color: #ffffff;
  text-decoration: none;
  cursor: pointer;
}
.badge-error {
  background-color: #b94a48;
}
.badge-error:hover {
  background-color: #953b39;
}
.badge-warning {
  background-color: #f89406;
}
.badge-warning:hover {
  background-color: #c67605;
}
.badge-success {
  background-color: #468847;
}
.badge-success:hover {
  background-color: #356635;
}
.badge-info {
  background-color: #3a87ad;
}
.badge-info:hover {
  background-color: #2d6987;
}
.badge-inverse {
  background-color: #333333;
}
.badge-inverse:hover {
  background-color: #1a1a1a;
}
</style>
 
<div class="row">
	<div class="col-md-6" style="text-transform: capitalize;margin-left:1.5%;margin-top:2%;">
		<p class="bg-info" style="height:30px;padding:5px;">
			<span class="">
				<span class="badge badge-info">Note</span> MEDS orders are downloadable under the Approved Orders Tab for sending
			</span>
		</p>
	</div>
	
</div>			
<section class="row-fluid">
	<div class="col-lg-12" style="margin:1%;">
		<div class="col-lg-1"><span class="badge badge-success">Please Note that</span></div>
		<div class="col-lg-1"></div>
		<div class="col-lg-5">
			<span class="badge badge-info">No</span>
			<span class="glyphicon glyphicon-arrow-left"></span>
  	&nbsp; Indicates Order numbers for the mentioned category 
		</div>
		<div class="col-lg-5">
			<button class="btn btn-success btn-xs floppy-save"><span class="glyphicon glyphicon-floppy-save"></span>Download KEMSA template</button>
		</div>
		
	</div>
	<div class="col-md-12" >
		
<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li role="presentation" >
  	<a href="#rejected" aria-controls="home" role="tab" data-toggle="tab">
  		<span class="badge badge-info"><?php echo $rejected_orders;?></span>
  	&nbsp;	 Rejected Orders
  	
  	</a>
  	</li>
  <li role="presentation" class="active">
  	<a href="#pending" aria-controls="profile" role="tab" data-toggle="tab">
  	<span class="badge badge-info"><?php echo $pending_orders;?></span>
  	&nbsp; Pending Approval 
  	
  	</a>
  	</li>
  <li role="presentation">
  	<a href="#pending_delivery" aria-controls="messages" role="tab" data-toggle="tab">
  		<span class="badge badge-info"><?php echo $approved_orders;?></span>	&nbsp; 
  		Pending Delivery 
  	
  	</a>
  	</li>
  <li role="presentation">
  	<a href="#delivered" aria-controls="settings" role="tab" data-toggle="tab">
  		<span class="badge badge-info"><?php echo $delivered_orders;?></span>
  		&nbsp; Delivered 
  	
  	</a>
  	</li>
</ul>

<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="rejected">
  	<?php
    	echo $theader;
    	?>
    </tbody>
   </table>
  </div>
  <div role="tabpanel" class="tab-pane" id="pending">
  	<div class="row" style="margin: 1%;">
  		<div class="col-md-12">
  			<ul class="nav nav-tabs" role="tablist" id="myTab">
			  <li role="presentation" class="active">
			  	<a href="#a" aria-controls="home" role="tab" data-toggle="tab">
			  		<span class="badge badge-info"><?php echo $pending_all_count;?></span>
			  	&nbsp; Pending at Sub-County
  				
  				</a>
			  	</li>
			  <li role="presentation">
			  	<a href="#b" aria-controls="profile" role="tab" data-toggle="tab">
			  		<span class="badge badge-info"><?php echo $pending_cty_count;?></span>
			&nbsp;	Pending at County 
			  	
			  	
			  	</a>
			  	</li>
			  
			</ul>
			 <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="a">
    	<?php
    	echo $theader2;
	// echo "<pre>";	print_r($pending_all);
		foreach ($pending_all as $key => $value) {
			
			$link=base_url('orders/get_facility_sorf/'.$value['id'].'/'.$mfl);
			$link_excel=base_url('reports/create_excel_facility_order_template/'.$value['id'].'/NULL/'.$value['source']);
	
			if ($identifier==='county') {
				$link2=base_url('orders/order_last_phase/'.$value['id']);
			}elseif($identifier==='district'){
				$link2=base_url('orders/update_order_subc/'.$value['id']);
			} else  {
				$link2=base_url('orders/update_facility_order/'.$value['id']);	
			}
			?>
			
		<tr>
			<td><?php echo $value['order_date']; ?></td>
			<td><?php echo $value['id']; ?></td>
			<td><?php echo $value['district']; ?></td>
			<td><?php echo $value['facility_name']; ?></td>
			<td><?php echo $value['facility_code']; ?></td>
			<td><?php echo $value['mwaka']; ?></td>
			<td><?php 
			if ($value['source'] == 2) {
				echo "MEDS";
			}elseif ($value['source'] == 1) {
				echo "KEMSA";
			}
			?></td>
			<td><?php echo number_format($value['order_total'], 2, '.', ','); ?></td>
			<td>
			<!--	<a href='<?php echo $link; ?>' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order pdf</button></a>-->
            <a href='<?php echo $link_excel; ?>' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order excel</button></a>
           <a href='<?php echo $link2; ?>' ><button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span><?php echo $pending_button_text=($identifier==='district'||$identifier==='county')? "Approve Order": "Edit Order"; ?></button></a>
           <a id="<?php echo $value['id']; ?>" href="#"class="delete">
           	
           	<?php  if ($identifier !== 'facility' ||$identifier==='facility_admin') {
				   
			    ?> 
		<button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-circle"></span>Delete</button></a></td>
		<?php } ?>
		</tr>	
		<?php
			}
    	?>
    </tbody>
   </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="b">
    	<?php
    	echo $theader3;
	//echo "<pre>";	print_r($pending_cty);
		foreach ($pending_cty as $key => $value) {
			$link=base_url('orders/get_facility_sorf/'.$value['id'].'/'.$mfl);
			$link_excel=base_url('reports/create_excel_facility_order_template/'.$value['id'].'/NULL/'.$value['source']);
	
			
			
			?>
		<tr>
			<td><?php echo $value['order_date']; ?></td>
			<td><?php echo $value['id']; ?></td>
			<td><?php echo $value['district']; ?></td>
			<td><?php echo $value['facility_name']; ?></td>
			<td><?php echo $value['facility_code']; ?></td>
			<td><?php echo $value['mwaka']; ?></td>
			<td><?php 
			if ($value['source'] == 2) {
				echo "MEDS";
			}elseif ($value['source'] == 1) {
				echo "KEMSA";
			}
			?></td>
			<td><?php echo number_format($value['order_total'], 2, '.', ','); ?></td>
			<td>
				<!--<a href='<?php echo $link; ?>' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order pdf</button></a>-->
            <a href='<?php echo $link_excel; ?>' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order excel</button></a>
           <?php 
           		if ($identifier=='county') { 
           			$link2=base_url('orders/order_last_phase/'.$value['id']."/");
           			?>
           			<a href='<?php echo $link2; ?>' >
           	<button type="button" class="btn btn-xs btn-success">
           	<span class="glyphicon glyphicon-pencil"></span>
          	Approve Order
           	</button>
           	 <a id="<?php echo $value['id']; ?>" href="#"class="delete"> 
		<button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-circle"></span>Delete</button></a>
           			</a>
					   
				  <?php } else if ($identifier=='district') {
				  	$link2=base_url('orders/update_order_subc/'.$value['id']."/");
				  	?>
				  	
				  	<a href='<?php echo $link2; ?>' >
           	<button type="button" class="btn btn-xs btn-success">
           	<span class="glyphicon glyphicon-pencil"></span>
           	 	Edit Order 
           	</button>
           	</a>
					   
			<?php	   }
				   
           
           
            ?>
           
           
          </td>
		</tr>	
		<?php
			}
    	?>
    	
    	</tbody>
   </table>
    </div>
    
  </div>
  		</div>
  	</div>
  	
  </div>
  <div role="tabpanel" class="tab-pane" id="pending_delivery">
  	
  	<?php
    	echo $theader4;
    	// echo "<pre>";print_r($approved);
		foreach ($approved as $key => $value) {
			$link=base_url('orders/get_facility_sorf/'.$value['id'].'/'.$mfl); 
			$link_excel=base_url('reports/create_excel_facility_order_template/'.$value['id'].'/NULL/'.$value['source']);
			$link2=base_url('orders/update_facility_order/'.$value['id']."/0/readonly");
			$link3=base_url('orders/update_order_delivery/'.$value['id']);
			$link4=base_url('orders/update_meds_order_delivery/'.$value['id']);
			
			?>
		<tr>
			<td><?php echo $value['order_date']; ?></td>
			<td><?php echo $value['id']; ?></td>
			<td><?php echo $value['district']; ?></td>
			<td><?php echo $value['facility_name']; ?></td>
			<td><?php echo $value['facility_code']; ?></td>
			<td><?php echo $value['mwaka']; ?></td>
			<td><?php 
			if ($value['source'] == 2) {
				echo "MEDS";
			}elseif ($value['source'] == 1) {
				echo "KEMSA";
			}
			?></td>
			<td><?php echo number_format($value['order_total'], 2, '.', ','); ?></td>
			<td><?php  if ($identifier==='facility' ||$identifier==='facility_admin') {
				
			 ?>
			<?php 
				if($value['source'] == 2){?>
				<a href='<?php echo $link4; ?>' target="_blank">
	           	<button  type="button" class="btn btn-xs btn-success">
	           	<span class="glyphicon glyphicon-save"></span>&nbsp;&nbsp;Receive &nbsp;Order  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</button></a>
				<a href='<?php echo $link_excel; ?>' target="_blank">
	           	<button  type="button" class="btn btn-xs btn-primary">
	           	<span class="glyphicon glyphicon-save"></span>Download Order excel</button></a>
			<?php }else{ ?>
				<a href='<?php echo $link3; ?>' target="_blank">
				<button type="button" class="btn btn-xs btn-success">
				<span class="glyphicon glyphicon-zoom-in"></span>&nbsp;&nbsp;Update &nbsp;Order  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</button></a>
			<?php }
			?>
			<!-- 	<a href='<?php echo $link3; ?>' target="_blank">
				<button type="button" class="btn btn-xs btn-success">
				<span class="glyphicon glyphicon-zoom-in"></span>Update Order</button></a> -->
				
            <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-zoom-in"></span>View Order</button></a>
            </td>
		</tr>	
		<?php
			}else{?>
			<!--<a href='<?php echo $link; ?>' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order pdf</button></a>-->
           <a href='<?php echo $link_excel; ?>' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order excel</button></a>
           
          <!-- <a href='<?php echo $link2; ?>' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Report</button></a>-->
            </td>
		</tr>		
			
    	<?php } }?>
    	
    </tbody>
   </table>
  	
  </div>
  <div role="tabpanel" class="tab-pane" id="delivered">
  	<?php
  			
    	echo $theader5;
		foreach ($delivered as $key => $value) {
			$mfl=$value['facility_name'];
			$link=base_url('orders/get_facility_sorf/'.$value['id'].'/'.$mfl);	
			$link_excel=base_url('reports/create_excel_facility_order_template/'.$value['id'].'/NULL/'.$value['source']);
			$link2=base_url().'reports/order_delivery/'.$value['id'];//view the order			
			if ($value['source'] == 2) {
				$link3='#';
			}elseif ($value['source'] == 1) {
				$link3=base_url().'reports/download_order_delivery/'.$value['id'];
			}			
			//$link3=base_url().'reports/download_order_delivery/'.$value['id'];
			?>
		<tr>
			<td><?php echo $value['order_date']; ?></td>
			<td><?php echo $value['id']; ?></td>
			<td><?php echo $value['district']; ?></td>
			<td><?php echo $value['facility_name']; ?></td>
			<td><?php echo $value['facility_code']; ?></td>
			<td><?php echo $value['mwaka']; ?></td>
			<td><?php 
			if ($value['source'] == 2) {
				echo "MEDS";
			}elseif ($value['source'] == 1) {
				echo "KEMSA";
			}
			?></td>
			<td><?php echo number_format($value['order_total'], 2, '.', ','); ?></td>
			<td>
				<!--<a href='<?php echo $link;?>' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order pdf</button></a>-->
           <a href='<?php echo  $link_excel; ?>' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order excel</button></a>
           <?php 
			if ($value['source'] == 2) {
				
			}elseif ($value['source'] == 1) {?>
				<a href='<?php echo $link3; ?>' target="_blank">
	         	<button  type="button" class="btn btn-xs btn-primary">
				<span class="glyphicon glyphicon-save"></span>Fill rate Report</button></a></td>
			<?php }
			?>
          
		</tr>	
		<?php
			}
    	?>
    </tbody>
   </table>
  </div>
</div>


	</div>
	
	
</section>


<script>
/* Table initialisation */
$(document).ready(function() {
	   	//datatables settings 	//'#pending,#districtstore,#delivered'//tables being assigned data table properties	
	assign_dtb_properties('#example');	
	assign_dtb_properties('#example2');	
	assign_dtb_properties('#example3');
	assign_dtb_properties('#example4');
	assign_dtb_properties('#example5');

	function assign_dtb_properties(designated_table_id){
		$(designated_table_id).dataTable( {	   "sDom": "T lfrtip",
									"aaSorting": [0,'desc'],
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
		                    										}			],
			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"		
		}	} );			
		$('.dataTables_filter label input').addClass('form-control');	
			$('.dataTables_length label select').addClass('form-control');}//end of assign properties function
			
	

	$(function () {
    $('#myTab a:first').tab('show')
  })
    $(".floppy-save").on('click', function(){
    	 window.location="<?php echo site_url('reports/force_file_download')."/?url=print_docs/excel/excel_template/KEMSA Customer Order Form.xlsx"?>";	
    })
    
	$(".order-for").on('click', function() {
	var body_content='<select id="facility_code" name="facility_code" class="form-control"><option value="0">--Select Facility Name--</option>'+
                    '<?php	foreach($facilities as $facility):
						     $facility_code=$facility['facility_code'];
							 $facility_name=$facility['facility_name']; ?>'+					
						'<option <?php echo 'value="'.$facility_code.'">'.preg_replace("/[^A-Za-z0-9 ]/", "",$facility_name) ;?></option><?php endforeach;?>';
   //hcmp custom message dialog
    dialog_box(body_content,
    '<button type="button" class="btn btn-primary order_for_them" >Order For Them</button>'
    +'<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>'); 
    $(".order_for_them").on('click', function() {
    var facility_code=$('#facility_code').val();
    if(facility_code==0){
    alert("Please select a Facility First");
    	
    }else{
     window.location="<?php echo site_url('orders/facility_order_');?>/"+facility_code;		
    }
   	
    });
		
	});
	
	$(".order-for-excel").on('click', function(e) {
                  e.preventDefault(); 
    var body_content='<?php  $att=array("name"=>'myform','id'=>'myform');
    echo form_open_multipart('orders/facility_order_',$att)?>'+
'<input type="file" name="file" id="file" required="required" class="form-control"><br>'+
'<button class="upload">Upload</button>'+
'</form>';
   //hcmp custom message dialog
    dialog_box(body_content,'');        
    });
	$(".delete").on('click', function() {
	id= $(this).attr("id");
		 //hcmp custom message dialog
    dialog_box("The order will be deleted and cannot be recovered!. Are you sure?",
    '<button type="button" class="btn btn-danger delete-dem-order" data-dismiss="modal">Delete</button>'
    +'<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>');    
    $(".delete-dem-order").on('click', function() {
    window.location="<?php     $for=$identifier=='district'? 'subcounty': (($identifier=='facility'||$identifier=='facility_admin')? 'facility':'county'); 
     echo site_url("orders/delete_facility_order/$for");?>/"+id;	
    });
	});	
	$(".aggregate-orders").on('click', function() {
	var addition="";
	var url="<?php echo base_url("reports/aggragate_order_new_sorf");?>/";
	var aggragate=false;
	$("input[type=checkbox]").each(function(index, element){
     if(element.checked){
     aggragate=true; //if an order has been selected set it to true 
     addition +=$(this).val()+"_";
     } 
     });
     if(aggragate){ //check 
     window.open(url+addition,'_blank');
     }else{
     //hcmp custom message dialog
    dialog_box("First Select orders you want to aggragate",
    '<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>');	
     }
     
	});

} );
</script>