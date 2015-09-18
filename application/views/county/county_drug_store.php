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
		
	});
</script>