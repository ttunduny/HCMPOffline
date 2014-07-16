<html>
<div class="container" style="width: 96%; margin: auto;">
<div class="input-group">
		<table width="x0%" class="table table-bordered table-condensed row-fluid">
		<tr>

		<td>
			<label>Facility Name: </label>
			<input type="text" requiredname="facility_name" class="form-control" disabled value="<?php echo $facility_name; ?>">
		</td>			
		
		<td class="col-xs-2">
		<label>Facility Code: </label>
			<input type="text" requiredname="facility_code: " class="form-control" disabled value="<?php echo $facility_code; ?>">
		</td>
		</div>
		


		<div class="input-group">
			<td class="col-xs-4">
			<label>Facility Type: </label>
			<input type="text" requiredname="dispensary" disabled class="form-control" value="<?php echo $facility_type_; ?>" >
			</td>
			
			<td class="col-xs-2">
			<label>District/Region:</label>
			<input type= 'text' name="district_name" disabled class="form-control" value="<?php echo $district_region_name; ?>">
			</td>
			</div>
			</tr>
			</table>
	</div>

<table width="x0%" class="table table-bordered table-condensed row-fluid">
<tbody>
<?php $attributes = array('class'=>'form-control','id'=>'tb_form','name'=>'tb_form_'); echo form_open('divisional_reports/save_tb_data'),$att ?>
	<div class="input-group">
		<tr>
		<thead>
			<th>Commodity</th>
			<th>Batch No</th>
			<th>Expiry Date</th>
			<th colspan="12">Year: 2013</th>
			<th colspan="12">Year: 2014</th>
			<th colspan="12">Year: 2015</th>
		</thead>
		</tr>

		<tr>
			<thead>
				<th></th>
				<th></th>
				<th></th>
				<!-- 2013 -->
				<th>J</th>
				<th>F</th>
				<th>M</th>
				<th>A</th>
				<th>M</th>
				<th>J</th>
				<th>J</th>
				<th>A</th>
				<th>S</th>
				<th>O</th>
				<th>N</th>
				<th>D</th>
				<!-- 2014 -->
				<th>J</th>
				<th>F</th>
				<th>M</th>
				<th>A</th>
				<th>M</th>
				<th>J</th>
				<th>J</th>
				<th>A</th>
				<th>S</th>
				<th>O</th>
				<th>N</th>
				<th>D</th>
				<!-- 2015 -->
				<th>J</th>
				<th>F</th>
				<th>M</th>
				<th>A</th>
				<th>M</th>
				<th>J</th>
				<th>J</th>
				<th>A</th>
				<th>S</th>
				<th>O</th>
				<th>N</th>
				<th>D</th>
			</thead>
		</tr>

					<?php
					$date = date('d M Y');
foreach($expiry_data as $data):

$commodity = $data['commodity_name'];
$batch = $data['batch_no'];

	echo '
		<tr>
		<td>'.$commodity.'</td>
		<td>'.$batch.'</td>
		<td>
			<input type="text" required class="form-control clone_datepicker_normal_limit_today" required name="" value="'.$date.'"/>
		</td>

		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>


		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>


		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		<td><input type="checkbox"></td>
		</tr>
	

	';
endforeach;
?>


	</div>
	</form>
</tbody>

</table>
</div>
</html>