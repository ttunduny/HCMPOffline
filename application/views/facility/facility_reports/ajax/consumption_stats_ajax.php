<div class="filter" id="">
<h5>
<select id="commodity_filter" style="width: 10.8em;">
	<option value="0">Select Commodity</option>
	
	<?php
foreach($c_data as $data):
		$commodity_name = $data['commodity_name'];	
		$commodity_id = $data['commodity_id'];
		echo "<option value='$commodity_id'>$commodity_name</option>";
endforeach;
?>
</select>
<select name="year" id="year_filter" style="width: 7.8em;">
		<option value="0">Select Year</option>
		<option value="2014">2014</option>
		<option value="2013">2013</option>
</select>
<select id="plot_value_filter">
	<option value="0">Select Plot value</option>
	<option value="packs">Packs</option>
	<option value="units">Units</option>
	<option value="ksh">KSH</option>
	<option value="service_point">Per Service Point</option>
</select> 
	<button class="btn btn-small btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	
</h5>
</div>

<div class='graph-section' id='graph-section'></div>
	
</div>
<script>
	$(document).ready(function() 
	{
		<?php echo @$graph_data; ?>
	
			$("#filter").click(function() 
			{
				var url = "reports/filtered_consumption/"+
				        $("#commodity_filter").val()+
				        "/"+$("#year_filter").val()+
				         "/"+$("#plot_value_filter").val();
        
				ajax_request_replace_div_content(url,'.graph-section');
		
          });


		
  });
</script>