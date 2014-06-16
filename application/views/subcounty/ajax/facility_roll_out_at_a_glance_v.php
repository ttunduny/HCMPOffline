<div id="dialog"></div>
	<div class="alert alert-info" >
  <b>Below is the project status in the county</b>
</div>
	 <div id="temp"></div>
	<?php echo $data ?>
	<div style="padding-top: 25px;">
<div class="filter" >
<h5>
	<select name="year" id="year_filter" style="width: 7.8em;">
		<option value="0">Select Year</option>
		<option value="2014">2014</option>
		<option value="2013">2013</option>
</select>
	<select name="month" id="month_filter" >
			<option value="null" selected="selected">Select month</option>
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
 
	<button class="btn btn-small btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	
	</h5>
</div>
	<div>
	<div id="container"  style="height:60%; width: 50%; margin: 0 auto; float: left">
	</div>
	<div id="container_monthly"  style="height:60%; width: 50%; margin: 0 auto;float: left"></div>	
	</div>
	<div id="log_data_graph"  style="height:60%; width: 50%; margin: 0 auto;float: left"></div>	
	</div>
	</div>
<script>
$(document).ready(function() {
	<?php echo @$graph_data_daily; ?>
	<?php echo @$graph_data_monthly; ?>
	
	$(".ajax_call1").click( function (){
		
		$('.modal-dialog').addClass("modal-lg");
		var body_content='<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<thead><tr><th>District Name</th><th>MFL No</th><th>Facility Name</th><th>Date Activated</th></tr></thead>'+
		'<tbody>'+			   	    
		'<?php	foreach($get_facility_data as $detail):
			     $facility_district = $detail['district'];
				 $facility_code = $detail['facility_code'];							
				 $facility_name = $detail['facility_name'];
				 $facility_activation_date = $detail['date'];
				 ;?>'+'<tr><td>'+'<?php echo $facility_district ;?>'+'</td>'
				 +'<td>'+'<?php echo $facility_code ;?>'+'</td>'
				 +'<td>'+'<?php echo $facility_name ;?>'+'</td>'
				 +'<td>'+'<?php echo $facility_activation_date ;?>'+'</td>'
				 +'</td></tr>'+'<?php endforeach;?>'
				 +'</tbody></table>';
        //hcmp custom message dialog
    dialog_box(body_content,'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
    $('#communication_dialog').on('hidden.bs.modal', function (e) {  $('.modal-dialog').removeClass("modal-lg");
    $('.modal-body').html(''); refreshDatePickers();	})    
   
    });
	$(".ajax_call2").click(function(){
			
		var url = "<?php echo base_url().'reports/get_district_drill_down_detail'?>";
		// this is the data from the function
		var id  = $(this).attr("id"); 				
        var date1=$(this).attr("date"); 
        var  date=encodeURI(date1);
      
	    ajax_request_special_(url+"/"+id+"/"+date, date1);	
	    
	    });

    function ajax_request_special_(url,date){
	var url = url;
	 $.ajax({
          type: "POST",
          url: url,
          success: function(msg) {
          	$('.modal-dialog').addClass("modal-lg");
          	var body_content = msg;
          	dialog_box(body_content,'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
           	 $('#communication_dialog').on('hidden.bs.modal', function (e) {  $('.modal-dialog').removeClass("modal-lg");
   			 $('.modal-body').html(''); })
         
          }
        }); 
}
	$("#filter").click(function(){
				var url = "<?php echo base_url().'reports/get_sub_county_facility_mapping_data/'?>"+
				        $("#year_filter").val()+
				        "/"+$("#month_filter").val();
        	ajax_supply(url,'#container');
        	ajax_supply(url,'#container_monthly');
		
          });

		
		function ajax_supply (url,div)
		{

	    var url = url;
	    var loading_icon = "<?php echo base_url().'assets/img/loadfill.gif' ?>";
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
 	});
</script>
