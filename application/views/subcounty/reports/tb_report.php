

<div class="container" style="width: 96%; margin: auto;">
<div class="table-responsive " style="height:400px; overflow-y: auto;">
	<!-- <form action="tb_data/save_data" name="" class="form-control" method="POST"> -->
	<?php $attributes = array('class'=>'form-control','id'=>'tb_form','name'=>'tb_form_'); echo form_open('divisional_reports/save_tb_data'),$att ?>
	<input type="hidden" name="table[facility_code][]" value= "<?php echo $facility_code ?>">
<table width="x0%" class="table table-bordered table-condensed table-responsive row-fluid table-condensed">
<!-- width="98%" border="0" class="row-fluid table table-hover table-bordered table-update" -->
	<tbody>
		<tr>
		<th>Facility Information</th>
	<table width="x0%" class="table table-bordered table-condensed table-responsive row-fluid table-condensed">
			
			<td>Facility Name:</td>
			<td colspan="4"><input type= 'text' name="facility_name" disabled="" class="form-control disabled" value="<?php echo $facility_name; ?>"></td>


		</tr>
<!-- second row -->
		<tr>
		<div class="input-group">
			<td>Facility Type: </td>
			<td ><input type="text" name="dispensary" disabled class="form-control" value="<?php echo $facility_type_; ?>" ></td>
			
			<td>District/Region:</td>
			<td><input type= 'text' name="district_name" disabled class="form-control" value="<?php echo $district_region_name; ?>"></td>

			</div>
		</tr>

		<!-- fourth -->
		<tr>
			<td>Beginning Date (of Reporting Period): </td>
			<td><input type="date"   name="table[beginning_date][]" value="" class='form-control'></td>
		
			<td>Ending Date (of Reporting Period): </td>
			<td><input type="date"   name="table[ending_date][]" value="" class='form-control'></td>
		</table>
		</tr>
		<tr>
		<!-- use colspan on a td -->
			<table width="98%" border="0" class="row-fluid table table-hover table-bordered table-update">
				<thead>
				<tr>
					<th>Commodity</th>
					<th>Unit</th>
					<th>Beginning Balance (at the start of the month)</th>
					<th>Received This Month</th>
					<th>Quantity Dispensed</th>
					<th>Positive Adjustment</th>
					<th>Negative Adjustment</th>
					<th>Losses</th>
					<th>Physical Count</th>
					<th colspan="2">Earliest Expiry Date (6 months)</th>
					<th>Quantity Needed</th>
				</tr>
				</thead>
				<tr>
					<td colspan="12" class=""><div class = "alert alert-info">TB drugs</div></td>
				</tr>
<!-- tb packs -->
				<tr>
					<td>TB Patient Packs Category</td>
					<td>Packs</td>
					<td><input type="text"   name="table[1][]" value="" class='form-control' class=""></td>
					<td><input type="text"   name="table[1][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[1][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[1][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[1][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[1][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[1][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[1][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[1][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[1][]" value="" class='form-control'></td>

				</tr>

				<!-- r/h/z/e 150 -->
				<tr>
					<td>R/H/Z/E 150/75/400/275 mg</td>
					<td>Tablets</td>
					<td><input type="text"   name="table[2][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[2][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[2][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[2][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[2][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[2][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[2][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[2][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[2][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[2][]" value="" class='form-control'></td>
				</tr>

				<!-- R/H/Z/E 150/75/275 mg -->
				<tr>
					<td>R/H/Z/E 150/75/275 mg</td>
					<td>Tablets</td>
					<td><input type="text"   name="table[3][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[3][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[3][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[3][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[3][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[3][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[3][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[3][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[3][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[3][]" value="" class='form-control'></td>
				</tr>

				<!-- Streptomycin Injection -->
				<tr>
					<td>Streptomycin Injection 1Gm</td>
					<td>Vials</td>
					<td><input type="text"   name="table[4][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[4][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[4][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[4][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[4][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[4][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[4][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[4][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[4][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[4][]" value="" class='form-control'></td>
				</tr>

				<!-- R/H 150/75 mg  -->
				<tr>
					<td>R/H 150/75 mg </td>
					<td>Tablets</td>
					<td><input type="text"   name="table[5][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[5][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[5][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[5][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[5][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[5][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[5][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[5][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[5][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[5][]" value="" class='form-control'></td>
				</tr>

				<!-- R/H/Z 60/30/150 mg  -->
				<tr>
					<td>R/H/Z 60/30/150 mg  </td>
					<td>Tablets</td>
					<td><input type="text"   name="table[6][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[6][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[6][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[6][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[6][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[6][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[6][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[6][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[6][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[6][]" value="" class='form-control'></td>
				</tr>

				<!-- R/H 60/30 mg  -->
				<tr>
					<td>R/H 60/30 mg </td>
					<td>Tablets</td>
					<td><input type="text"   name="table[7][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[7][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[7][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[7][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[7][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[7][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[7][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[7][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[7][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[7][]" value="" class='form-control'></td>
				</tr>

				<!-- 60mg -->
				<tr>
					<td>R/H 60/60 mg </td>
					<td>Tablets</td>
					<td><input type="text"   name="table[8][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[8][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[8][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[8][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[8][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[8][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[8][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[8][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[8][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[8][]" value="" class='form-control'></td>
				</tr>

				<!-- Ethambutol 400 mg  -->
				<tr>
					<td>Ethambutol 400 mg</td>
					<td>Tablets</td>
					<td><input type="text"   name="table[9][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[9][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[9][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[9][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[9][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[9][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[9][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[9][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[9][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[9][]" value="" class='form-control'></td>
				</tr>

				<!-- H, 300 mg -->
				<tr>
					<td>H, 300 mg</td>
					<td>Tablets</td>
					<td><input type="text"   name="table[10][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[10][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[10][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[10][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[10][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[10][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[10][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[10][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[10][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[10][]" value="" class='form-control'></td>
				</tr>

				<!-- H,x0mg -->
				<tr>
					<td>H, x0 mg</td>
					<td>Tablets</td>
					<td><input type="text"   name="table[11][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[11][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[11][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[11][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[11][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[11][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[11][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[11][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[11][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[11][]" value="" class='form-control'></td>
				</tr>

				<!-- Rifabutin 150mg  -->
				<tr>
					<td>Rifabutin 150mg </td>
					<td>Tablets</td>
					<td><input type="text"   name="table[12][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[12][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[12][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[12][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[12][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[12][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[12][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[12][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[12][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[12][]" value="" class='form-control'></td>
				</tr>

				<!-- Pyrazinamide 500mg -->
				<tr>
					<td>Pyrazinamide 500mg</td>
					<td>Tablets</td>
					<td><input type="text"   name="table[13][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[13][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[13][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[13][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[13][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[13][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[13][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[13][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[13][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[13][]" value="" class='form-control'></td>
				</tr>

				<!-- Rifampicin 600mg -->
				<tr>
					<td>Rifampicin 600mg</td>
					<td>Tablets</td>
					<td><input type="text"   name="table[14][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[14][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[14][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[14][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[14][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[14][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[14][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[14][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[14][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[14][]" value="" class='form-control'></td>
				</tr>

				<!-- Pyridoxine 50mg -->
				<tr>
					<td>Pyridoxine 50mg</td>
					<td>Tablets</td>
					<td><input type="text"   name="table[15][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[15][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[15][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[15][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[15][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[15][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[15][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[15][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[15][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[15][]" value="" class='form-control'></td>
				</tr>

				<!-- Co-trimoxazole 960 Mg -->
				<tr>
					<td>Co-trimoxazole 960 Mg</td>
					<td>Tablets</td>
					<td><input type="text"   name="table[16][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[16][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[16][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[16][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[16][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[16][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[16][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[16][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[16][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[16][]" value="" class='form-control'></td>
				</tr>

				<!-- Co-trimoxazole, 480  mg -->
				<tr>
					<td>Co-trimoxazole, 480  mg</td>
					<td>Tablets</td>
					<td><input type="text"   name="table[17][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[17][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[17][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[17][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[17][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[17][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[17][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[17][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[17][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[17][]" value="" class='form-control'></td>
				</tr>

				<!-- Co-trimoxazole suspension, 240 mg/5ml -->
				<tr>
					<td>Co-trimoxazole suspension, 240 mg/5ml</td>
					<td>Bottles</td>
					<td><input type="text"   name="table[18][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[18][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[18][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[18][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[18][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[18][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[18][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[18][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[18][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[18][]" value="" class='form-control'></td>
				</tr>  

				<!-- Dapsone x0mg -->
				<tr>
					<td>Dapsone x0mg</td>
					<td>Tablets</td>
					<td><input type="text"   name="table[19][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[19][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[19][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[19][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[19][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[19][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[19][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[19][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[19][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[19][]" value="" class='form-control'></td>
				</tr> 

				<tr>
					<td>
								<div class="container-fluid">
<div style="float: right">
<button type="submit" class="save btn btn-sm btn-success" id="save_data"><span class="glyphicon glyphicon-open"></span>Save</button></div>
</div>
					</td>
				</tr>
				
				<tr><td colspan="12" class=""><div class = "alert alert-info">Leprosy Drugs</div></td></tr>
				<!-- MB Adult Blister  -->
				<tr>
					<td>MB Adult Blister </td>
					<td>Packs</td>
					<td><input type="text"   name="table[20][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[20][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[20][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[20][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[20][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[20][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[20][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[20][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[20][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[20][]" value="" class='form-control'></td>
				</tr>

				<!-- MB Child Blister Packs -->
				<tr>
					<td>MB Child Blister Packs</td>
					<td>Packs</td>
					<td><input type="text"   name="table[21][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[21][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[21][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[21][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[21][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[21][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[21][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[21][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[21][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[21][]" value="" class='form-control'></td>
				</tr>

				<!-- PB Adult Blister Packs -->
				<tr>
					<td>PB Adult Blister Packs</td>
					<td>Packs</td>
					<td><input type="text"   name="table[22][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[22][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[22][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[22][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[22][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[22][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[22][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[22][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[22][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[22][]" value="" class='form-control'></td>
				</tr>

				<!-- PB Child Blister Packs -->
				<tr>
					<td>PB Child Blister Packs</td>
					<td>Packs</td>
					<td><input type="text"   name="table[23][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[23][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[23][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[23][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[23][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[23][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[23][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[23][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[23][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[23][]" value="" class='form-control'></td>
				</tr>

				<tr><td colspan="12" class=""><div class = "alert alert-info">MDR TB drugs</div></td></tr>

				<!-- Capreomycin 1gm vial -->
				<tr>
					<td>Capreomycin 1gm vial</td>
					<td>Vial</td>
					<td><input type="text"   name="table[24][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[24][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[24][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[24][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[24][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[24][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[24][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[24][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[24][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[24][]" value="" class='form-control'></td>
				</tr>

				<!-- Cycloserine 250mg  -->
				<tr>
					<td>Cycloserine 250mg </td>
					<td>Tablet</td>
					<td><input type="text"   name="table[25][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[25][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[25][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[25][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[25][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[25][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[25][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[25][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[25][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[25][]" value="" class='form-control'></td>
				</tr>

				<!-- Kanamycin 1gm vial  -->
				<tr>
					<td>Kanamycin 1gm vial </td>
					<td>Vial</td>
					<td><input type="text"   name="table[26][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[26][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[26][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[26][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[26][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[26][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[26][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[26][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[26][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[26][]" value="" class='form-control'></td>
				</tr>

				<!-- Levofloxacin 250mg   -->
				<tr>
					<td>Levofloxacin 250mg  </td>
					<td>Tablets</td>
					<td><input type="text"   name="table[27][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[27][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[27][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[27][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[27][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[27][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[27][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[27][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[27][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[27][]" value="" class='form-control'></td>
				</tr>

				<!-- Levofloxacin 500mg   -->
				<tr>
					<td>Levofloxacin 500mg  </td>
					<td>Tablets</td>
					<td><input type="text"   name="table[28][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[28][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[28][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[28][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[28][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[28][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[28][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[28][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[28][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[28][]" value="" class='form-control'></td>
				</tr>

				<!-- Para-aminosalicylic acid 4mg    -->
				<tr>
					<td>Para-aminosalicylic acid 4mg   </td>
					<td>Satchets</td>
					<td><input type="text"   name="table[29][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[29][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[29][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[29][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[29][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[29][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[29][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[29][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[29][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[29][]" value="" class='form-control'></td>
				</tr>

				<!-- Prothionamide 250mg    -->
				<tr>
					<td>Prothionamide 250mg   </td>
					<td>Tablets</td>
					<td><input type="text"   name="table[30][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[30][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[30][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[30][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[30][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[30][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[30][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[30][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[30][]" value="" class='form-control'></td>
					<td><input type="text"   name="table[30][]" value="" class='form-control'></td>
				</tr>
			</table>
		</tr>

		<tr>
		<td>
		<table class="table table-bordered ">
		<tr>
			<th>Collection or Reporting tool</th>
			<th colspan="2">DAR</th>
			<th>CDRR</th>
		</tr>
		<tr>
			<th>Reporting Tool</th>
			<th>50 page</th>
			<th>x0 page</th>
			<th>FCDRR</th>
		</tr>
		<tr>
			<th>Quantity Requested</th>
			<td><input type="text"   name="50pg" value="" class='form-control'></td>
			<td><input type="text"   name="x0pg" value="" class='form-control'></td>
			<td><input type="text"   name="FCDRR" value="" class='form-control'></td>
		</tr>
			</table>
			</td>
		</tr>
<!-- patient summary table -->
		<tr>
				<table class="table table-bordered">
				<th colspan="8" class="">Patient Summaries: </th>
					<tr>
						<th></th>
						<th>New</th>
						<th>Retreatment</th>
						<th>Leprosy</th>
						<th>MDR</th>
						<th>IPT</th>
						<th>Rifabetia</th>
						<th>CPT</th>
					</tr>
					<tr>
						<th>Adult</th>
						<td><input type="text"   name="summary_adult_new" value="" class='form-control'></td>
						<td><input type="text"   name="summary_adult_retreatment" value="" class='form-control'></td>
						<td><input type="text"   name="summary_adult_leprosy" value="" class='form-control'></td>
						<td><input type="text"   name="summary_adult_mdr" value="" class='form-control'></td>
						<td><input type="text"   name="summary_adult_ipt" value="" class='form-control'></td>
						<td><input type="text"   name="summary_adult_rifabetia" value="" class='form-control'></td>
						<td><input type="text"   name="summary_adult_cpt" value="" class='form-control'></td>
					</tr>

					<tr>
						<th>Children</th>
						<td><input type="text"   name="summary_children_new" value="" class='form-control'></td>
						<td><input type="text"   name="summary_children_retreatment" value="" class='form-control'></td>
						<td><input type="text"   name="summary_children_leprosy" value="" class='form-control'></td>
						<td><input type="text"   name="summary_children_mdr" value="" class='form-control'></td>
						<td><input type="text"   name="summary_children_ipt" value="" class='form-control'></td>
						<td><input type="text"   name="summary_children_rifabetia" value="" class='form-control'></td>
						<td><input type="text"   name="summary_children_cpt" value="" class='form-control'></td>
					</tr>
				</table>
		</tr>

		<tr>
			<table class="table table-bordered">
			<th colspan="8" class="accordion">Supply Box Commodities</th>
				<tr>
					<th>Commodity</th>
					<th>Beginning Balance</th>
					<th>Amount into Supply Box</th>
					<th>Amount out of Supply Box</th>
					<th>Amount Withdrawn to District Store</th>
					<th>Ending Balance</th>
				</tr>
				<tr>
					<th>A</th>
					<th>B</th>
					<th>C</th>
					<th>D</th>
					<th>E</th>
					<th>F</th>
				</tr>
				<tr>
					<th>RHZE Tablets</th>
					<td><input type="text"   name="rhzeB" value="" class='form-control'></td>
					<td><input type="text"   name="rhzeC" value="" class='form-control'></td>
					<td><input type="text"   name="rhzeD" value="" class='form-control'></td>
					<td><input type="text"   name="rhzeE" value="" class='form-control'></td>
					<td><input type="text"   name="rhzeF" value="" class='form-control'></td>
				</tr>
				<tr>
					<th>RH Tablets</th>
					<td><input type="text"   name="rhB" value="" class='form-control'></td>
					<td><input type="text"   name="rhC" value="" class='form-control'></td>
					<td><input type="text"   name="rhD" value="" class='form-control'></td>
					<td><input type="text"   name="rhE" value="" class='form-control'></td>
					<td><input type="text"   name="rhF" value="" class='form-control'></td>
				</tr>
			</table>
		</tr>
		</table>

</div>
</form>
	</tbody>
</table>
</div>

<script>

      $(document).ready(function () {
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });

  $(window).resize(function() {
    if (($(window).width() < 768))
    {
        $( ".col-md-2,.col-md-x" ).css( "position", "" );
    };
});
 	$('#dataTables_filter label input').addClass('form-control');
	$('#dataTables_length label select').addClass('form-control');
$('#exp_datatable,#potential_exp_datatable,#potential_exp_datatable2').dataTable( {
     "sDom": "T lfrtip",
  
       "sScrollY": "377px",
       
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
    }
  } ); 
    

});
    </script>