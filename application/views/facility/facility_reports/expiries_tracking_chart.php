<style type="text/css">
	.button{
		text-align: right;
	}
	.button td {
		border: none;
		
	}
	<?php 
 	$link = base_url('reports/get_facility_report_pdf/'.'1101'.'/'.$facility_code.'/expiries');	
// 	$link_excel = base_url('reports/create_excel_facility_program_report/'.$TB_details['report_id'].'/'.$TB_details['facility_code'].'/TB');

	 ?>
</style>
<html>
<div class="container" style="width: 96%; margin: auto;">
				<div class="button">
           			<a href= <?php echo $link; ?> target="_blank">
		           	<button  type="button" class="btn btn-xs btn-primary">
		           	<span class="glyphicon glyphicon-save"></span>Download Report pdf</button></a>
		        </div>
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
			<th colspan="12" style="text-align: center;">Year: 2014</th>
			<th colspan="12" style="text-align: center;">Year: 2015</th>
			<th colspan="12" style="text-align: center;">Year: 2016</th>
		</thead>
		</tr>

		<tr>
			<thead>

				<th></th>
				<th></th>
				<th></th>
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
				<!-- 2016 -->
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

foreach($expiry_data as $data):
	$month = null;
	$checked = '<td><input type="checkbox"  checked disabled ></td>';
	$unchecked = '<td><input type="checkbox" disabled ></td>';

	//$jan=$feb=$march=$april=$may=$june=$july=$aug=$sept=$oct=$nov=$dec = null;
// $jan=$feb=$march=$april=$may=$june=$july=$aug=$sept=$oct=$nov=$dec = $unchecked;
	$jan14=$feb14=$march14=$april14=$may14=$june14=$july14=$aug14=$sept14=$oct14=$nov14=$dec14 = $unchecked;
	$jan15=$feb15=$march15=$april15=$may15=$june15=$july15=$aug15=$sept15=$oct15=$nov15=$dec15 = $unchecked;
	$jan16=$feb16=$march16=$april16=$may16=$june16=$july16=$aug16=$sept16=$oct16=$nov16=$dec16 = $unchecked;
	$month = $data['expiry_month'];
// echo "<pre>";print_r($data['expiry_month']);echo " blah" .$x. "</pre>";
$commodity = $data['commodity_name'];
$batch = $data['batch_no'];

	echo '
		<tr>
		<td>'.$commodity.'</td>
		<td>'.$batch.'</td>
		<td>
			'.$data['expiry_date'].'			
		</td>';
		switch ($month) {
			// 2014 SWITCH
			case NULL:
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
			
				break;

			case 'January 2014':
			$jan14 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'February 2014':
			$feb14 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'March 2014':
			$march14 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
			
				break;

			case 'April 2014':
			$april14 = $checked;

			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'May 2014':
			$may14 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'June 2014':
			$june14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'July 2014':
			$july14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'August 2014':
			$aug14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'September 2014':
			$sept14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'October 2014':
			$oct14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'November 2014':
			$nov14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'December 2014':
			$dec14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

				// 2015
			case 'January 2015':
			$jan15 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'February 2015':
			$feb15 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'March 2015':
			$march15 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
			
				break;

			case 'April 2015':
			$april15 = $checked;

			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'May 2015':
			$may15 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'June 2015':
			$june15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'July 2015':
			$july15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'August 2015':
			$aug15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'September 2015':
			$sept15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'October 2015':
			$oct15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'November 2015':
			$nov15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'December 2015':
			$dec15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			// 2016
			/*case 'January 2016':
			$jan16 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'February 2016':
			$feb16 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'March 2016':
			$march16 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
			
				break;

			case 'April 2016':
			$april16 = $checked;

			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'May 2016':
			$may16 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'June 2016':
			$june16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'July 2016':
			$july16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'August 2016':
			$aug16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'September 2016':
			$sept16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'October 2016':
			$oct16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'November 2016':
			$nov16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case 'December 2016':
			$dec16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;*/
			
			default:
				
				break;
		}

		echo '</tr>';

endforeach;


?>


	</div>
	</form>
</tbody>

</table>
</div>
</html>