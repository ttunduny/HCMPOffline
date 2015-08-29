<div class="alert alert-info">
  <b>Below are the potential expiries in the County </b> :Select filter Options
</div>
<div class="filter row">
<form class="form-inline" role="form">
<select id="county_year_filter" class="form-control col-md-2">
	<option value="NULL" selected="selected">Select Period</option>
	<option value="3">3 Months</option>
	<option value="6">6 Months</option>
	<option value="12">12 Months (1 Year)</option>
</select>
<select id="county_district_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Sub-county</option>
<?php
	foreach($district_data as $district_):
			$district_id=$district_->id;
			$district_name=$district_->district;	
			echo "<option value='$district_id'>$district_name</option>";
	endforeach;
?>
</select>
<select id="facility_filter" class="form-control col-md-2">
	<option value="NULL">Select facility</option>
</select>
<select id="county_plot_value_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Plot value</option>
<option value="packs">Packs</option>
<option value="units">Units</option>
<!--<option value="ksh">KSH</option>-->
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-small btn-success county-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button>
</div> 
<div class="col-md-1">
<button class="btn btn-sm btn-success county-table-data"><span class="glyphicon glyphicon-th-list"></span>Table Data</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success county-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
</div>
</form>
</div>
<div class="graph_content" id="dem_graph_">	
	 <div style="min-height: 400px;" id="reports_display">
    <table  class="table table-hover table-bordered table-update" id="potential_exp_datatable" >
  <thead style="background-color: white">
  <tr>
    <th>Commodity Description</th>
    <th>Commodity Code </th>
    <th>Batch No Affected</th>
    <!-- <th>Manufacturer</th> -->
    <th>Expiry Date</th>
    <th># Days to Expiry</th>
    <th>Unit size</th>
    <!-- <th>Stock Expired (Packs)</th> -->
    <!-- <th>Stock Expired (Units)</th> -->
    <th>Unit Cost (KSH)</th>
    <th>Total Cost(KSH)</th>
  </tr>
  </thead>
      
    <tbody>
    
    <?php   
       $total=0;        
        foreach ($report_data as $key=>$potential_exp ) { 

          // foreach($potential_exp->Code as $potential_exp){
               
                $name=$potential_exp['commodity_name'];
                $commodity_code=$potential_exp['commodity_code'];
                $unitS=$potential_exp['unit_size']; 
                $unitC=$potential_exp['unit_cost'];
                $total_units=$potential_exp['total_commodity_units'];
                $calculated=$potential_exp['current_balance'];
                $total_cost=$potential_exp['total_cost'];                
                // $expired_packs=round($calculated/$total_units,1);
                // $total_exp_cost=  $expired_packs*$unitC;             
                $formatdate = new DateTime($potential_exp['expiry_date']);
                $formated_date= $formatdate->format('d M Y');
				$ts1 = strtotime(date('d M Y'));
                $ts2 = strtotime(date($potential_exp['expiry_date']));
                $seconds_diff = $ts2 - $ts1;
				$total=$total+ $total_cost;
                ?>       
            <tr>
              <td><?php  echo $name;?> </td>
              <td><?php  echo $commodity_code;?> </td>
              <td><?php  echo $potential_exp['batch_no'];?></td>
              <!-- <td><?php  //echo $potential_exp['manufacture'];?> </td> -->
              <td><?php  echo $formated_date;?> </td>
              <td><?php  echo floor($seconds_diff/3600/24);?> </td>
              <td><?php  echo $unitS;?></td>
              <!-- <td><?php  echo $expired_packs; ?></td> -->
              <!-- <td><?php  echo $calculated; ?></td> -->
              <td><?php  echo $unitC;?></td>
              <td><?php  echo number_format($total_cost, 2, '.', ',');?></td>
            </tr>
          <?php } echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>               
          <td>Total</td>
          <td>".number_format($total, 2, '.', ',')."</td></tr>";
          ?>  
     
    
   </tbody>
</table>
  </div>
</div>
<script>
	 $(function () { 
<?php echo $default_expiries; ?>
});

	$(document).ready(function() {
		    window.onload = function(){
    // var url_ = 'reports/potential_exp_process/NULL/NULL';  
    // var url_ = 'reports/get_county_cost_of_expiries_new/NULL/NULL/NULL/NULL/NULL';  
		// ajax_request_replace_div_content(url_,'.graph_content');	
  }
		// reports/get_county_cost_of_expiries_new/NULL/NULL/NULL/NULL/NULL
        //setting up the report
		$("#facility_filter").hide();
		$("#county_district_filter").change(function() {
		var option_value=$(this).val();	
		if(option_value=='NULL'){ $("#facility_filter").hide('slow');	}
		else{			
	     var drop_down='';
 		 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+$("#county_district_filter").val();
 		 $.getJSON( hcmp_facility_api ,function( json ) {
    	 $("#facility_filter").html('<option value="NULL" selected="selected">--select facility--</option>');
     	 $.each(json, function( key, val ) {
      		drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>";	
     	 });
    	 $("#facility_filter").append(drop_down);
   		});
		$("#facility_filter").show('slow');		
		}
		});
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          $('.graph_content').html('');
          })
		
	    $(".county-filter").on('click',function(e) {
		e.preventDefault();	
		//$year = null, $month = null, $district_id = null, $option = null, $facility_code = null,$report_type=null)
        //var url_ = 'reports/potential_expiries_dashboard_ajax/'+$("#county_year_filter").val()+"/"+$("#county_district_filter").val()+"/"+$("#county_plot_value_filter").val()+"/"+$("#facility_filter").val()+"/table";  
        var url_ = 'reports/potential_exp_process_sub_county_titus/'+$("#county_district_filter").val()+"/"+$("#facility_filter").val()+"/"+$("#county_plot_value_filter").val()+"/"+$("#county_year_filter").val();  
		// alert(url_);
		ajax_request_replace_div_content(url_,'.graph_content');		
          });
          
        //for viewing the table data
      	$(".county-table-data").on('click',function(e) {
		e.preventDefault();	
		//$year = null,$district_id = null, $option = null, $facility_code = null,$report_type=null)
        var url_ = 'reports/get_county_cost_of_expiries_dashboard/'+$("#county_year_filter").val()+"/"+$("#county_district_filter").val()+"/"+$("#county_plot_value_filter").val()+"/"+$("#facility_filter").val()+"/table";  
		
		ajax_request_replace_div_content(url_,'.graph_content');		
          });
		//For CSV downloads
		$(".county-download").on('click',function(e) {
		e.preventDefault();			  
        var url_ = 'reports/get_county_cost_of_expiries_dashboard/'+$("#county_year_filter").val()+"/"+$("#county_district_filter").val()+"/"+$("#county_plot_value_filter").val()+"/"+$("#facility_filter").val()+"/csv_data";  
		window.open(url+url_ ,'_blank');
         });	
         
        $(".subcounty-filter").on('click',function(e) {
		e.preventDefault();	
        var url_ = 'reports/get_county_cost_of_expiries_new/'+
        $("#year_filter").val()+"/"+$("#month_filter").val()+ "/"+$("#district_filter").val()+"/"+$("#plot_value_filter").val()+"/"+$("#facility_filter").val();  
		ajax_request_replace_div_content(url_,'.graph_content');		
          });
          
         $(".subcounty-download").on('click',function(e) {
		e.preventDefault();	
        var url_ = 'reports/get_county_cost_of_expiries_new/'+
        $("#year_filter").val()+"/"+$("#month_filter").val()+ "/"+$("#district_filter").val()+"/"+$("#plot_value_filter").val()+"/"+$("#facility_filter").val()+"/csv_data";	 
		 window.open(url+url_ ,'_blank');		
          }); 

		});

</script>