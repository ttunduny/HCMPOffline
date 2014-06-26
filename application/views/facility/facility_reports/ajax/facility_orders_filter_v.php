<div class="filter" id="">
<h5>
<select name="year" id="year_filter" style="width: 7.8em;">
		<option value="0">Select Year</option>
		<option value="2014">2014</option>
		<option value="2013">2013</option>
</select>
<select name="month" id="month_filter" >
			<option value="0" selected="selected">Select month</option>
			<option value="01">Jan</option>
			<option value="02">Feb</option>
			<option value="03">Mar</option>
			<option value="04">Apr</option>
			<option value="05">May</option>
			<option value="06">Jun</option>
			<option value="07">Jul</option>
			<option value="08">Aug</option>
			<option value="09">Sep</option>
			<option value="10">Oct</option>
			<option value="11">Nov</option>
			<option value="12">Dec</option>
</select>
<select id="plot_value_filter">
	<option value="0">Select Plot value</option>
	<option value="packs">Packs</option>
	<option value="units">Units</option>
	<option value="ksh">KSH</option>
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
<<<<<<< HEAD
				var url = "reports/filter_facility_orders/"+
=======
				var url = "<?php echo base_url().'reports/filter_facility_orders/'?>"+
>>>>>>> ad4682fe6d397b35c5d9cd9fe6caad6e4f49b38b
				        $("#year_filter").val()+
				        "/"+$("#month_filter").val()+
				         "/"+$("#plot_value_filter").val();
        
<<<<<<< HEAD
				ajax_request_replace_div_content(url,'.graph-section');
		
          });
	
=======
				ajax_supply(url,'.graph-section');
		
          });

		
		function ajax_supply (url,div)
		{

	    var url = url;
	    var loading_icon = "<?php echo base_url().'assets/img/loader.GIF' ?>";
	    $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() 
          {
             $(div).html("");           
             $(div).html("<img style='margin-top:10%;' src="+loading_icon+">");
           
          },
          success: function(msg) 
          {
            $(div).html("");
            $(div).html(msg);           
          }
        });
         
}
		
		
>>>>>>> ad4682fe6d397b35c5d9cd9fe6caad6e4f49b38b
		
  });
</script>