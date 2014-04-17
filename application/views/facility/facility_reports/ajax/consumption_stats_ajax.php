<style>
	.filter
	{
		width: 98%;
		height:7em;
		margin:auto;	
	}
	.graph_content
	{
		width: 99%;
		height:400px;
		-webkit-box-shadow: 1px 1px 1px 1px #DDD3ED;
		box-shadow: 1px 1px 1px 1px #DDD3ED;
		margin:auto;	
	}
</style>
<div class="panel-heading">
   <h3 class="panel-title">Please Select filter Options Below <span class="glyphicon glyphicon-cog"></span> </h3>
</div>

<div class="filter" id="">
<h2>
	
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
</select> 
	<button class="btn btn-small btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	
	</h2>
</div>

<div class="graph_content ">
	
</div>

<script>
	
	$(document).ready(function() 
	{
		$('#filter').click(function() 
			{
		    	var fcommodity = $("#commodity_filter").val();
		    	var year = $("#year_filter").val();
		    	var plot_value_filter =$("#plot_value_filter").val();
		    	   	   	
				if (fcommodity==0) 
				{
					alert("Please select Commodity.");
					return;
				}
				if (year==0) 
				{
					alert("Please select Year.");
					return;
				}
				if (plot_value_filter==0) 
				{
					alert("Please select Plot value.");
					return;
				}
         	var div = ".graph_content";
			var url = "<?php echo base_url()."reports/consumption_stats_graph"?>";		
			ajax_supply (url,div);
		
			 
		});
		function ajax_supply (url,div)
		{
			var url = url;
			var loading_icon="<?php echo base_url().'assets/img/loadfill.gif' ?>";
	 		$.ajax(
	 			{
	 				type: "POST",
			        data: 
			           {
				           	facilityname:$('#commodity_filter option:selected').html(),
				           	commodity_filter: $("#commodity_filter").val(),
				           	year_filter: $("#year_filter").val(),
				           	plot_value_filter: $("#plot_value_filter").val()
			           	},
		          url: url,
		          beforeSend: function() 
		          {
		          	$(div).html("");
		            $(div).html("<img style='margin-left:20%;margin-top:2%;' src="+loading_icon+">");
		            
		          },
		          success: function(msg) 
		          {
		          	$(div).html("");
		            $(div).html(msg);           
		          }
		        });
         
}
		
	
  });
</script>