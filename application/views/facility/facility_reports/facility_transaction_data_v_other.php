<style>
	.row div p{
	padding:10px;
}
</style>
<div class="container" style="width: 96%; margin: auto;">
    
    <div class="row">
		<div class="col-md-15" style="text-transform: capitalize;font-size:14px"><p class="bg-info">
		<span class="">
			You Can Now Submit Orders for other Facilities within your Sub-County.<br/>
			To Submit an Order for another Facility:<br/>
			Select the Facility Name from the Dropdown Below then Click on the Proceed to Order Link<br/>

		</span></p></div>

		<div class="col-md-15" style="text-transform: capitalize;font-size:14px"><p class="">
		<span class="">			
			&nbsp;1. Select the Facility Name from the Dropdown Below

		</span></p></div>
		
	</div>
	
	<div class="row">
		<div class="col-md-6" style="text-transform: capitalize;">
			<select id="other_facility_select" class="form-control">
				<!-- <option value="0">Select a Facility</option> -->
			
			<?php 
				foreach ($facilities as $key => $value) {
					$mfl = $value['facility_code'];
					$facility_name = $value['facility_name'];?>

				<option value="<?php echo $mfl ;?>"><?php echo $facility_name ;?></option>
			<?php }

			?>
			</select>
		</div>
	</div>
	<br/>
	<br/>
	<div class="row">
		<div class="col-md-15" style="text-transform: capitalize;font-size:14px"><p class="">
			<span class="">			
			&nbsp;2. Click on the Button Below
		</span></p></div>
		
	</div>
	<br/>
	<div class="row">
		<div class="col-md-15" style="text-transform: capitalize;font-size:14px"><p class="">
			<span class="">			
			<button id="submit_order" class="btn btn-success" type="submit"><span class="glyphicon glyphicon-open"></span>Proceed to Order from KEMSA</button></div>
		</span></p></div>
		
	</div>
	
    
	
 
<hr />
<div class="container-fluid">
<div style="float: right">
<?php
	// if ($source == "KEMSA") {
	// echo '<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-open"></span>Proceed to Order from KEMSA</button></div>';
	// }elseif ($source == "MEDS") {
	// echo '<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-open"></span>Proceed to Order from MEDS</button></div>';
	// }
	 ?>
<?php echo form_close();?>
</div>
</div>
<script>
$(document).ready(function() {
	//datatables settings 
	$('#submit_order').click(function(e){
		e.preventDefault();
		var mfl = $('#other_facility_select').val();
		var url = '<?php echo base_url(); ?>orders/facility_order/1/'+mfl;
		window.location.href = url;
	});

});
</script>