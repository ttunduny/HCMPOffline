<script>
	$(document).ready(function() {
		<?php echo @$graph_data_daily; ?>
		<?php echo @$graph_data_monthly; ?>
	});
</script>
<div id="dialog"></div>
	<div class="alert alert-info" >
  <b>Below is the project status in the county</b>
</div>
	 <div id="temp"></div>
	<?php echo $data ?>
	<div>
	
	<div id="container"  style="height:60%; width: 50%; margin: 0 auto; float: left">
	</div>
	<div id="container_monthly"  style="height:60%; width: 50%; margin: 0 auto;float: left"></div>	
	</div>

