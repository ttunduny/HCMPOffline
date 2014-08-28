<?php
$year = date("Y");
$county_id = $this -> session -> userdata('county_id');
$district_id =  $this -> session -> userdata('district_id');

		  $identifier = $this -> session -> userdata('user_indicator');
		
        switch ($identifier):
			case 'district':
			$link=	base_url('reports/order_listing/subcounty/true');
			$link2=	base_url('reports/order_listing/subcounty');
			break;
			case 'county':
			$link=	base_url('reports/order_listing/county/true');
			$link2=	base_url('reports/order_listing/county');
			break;
			 endswitch;
			
?>

<div class="row" style="margin-left: 1%">
	<div class="col-md-4">
		<div class="row">			
			
		</div>

	</div>
  <div class="col-md-8">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Analysis <span class="glyphicon glyphicon-stats" style=""></span><span class="glyphicon glyphicon-align-left" style="margin-left: 1%"></span></h3>
      </div>
      <div class="panel-body" style="overflow-y: auto">
   <a href="<?php echo base_url("reports/mapping"); ?>"> <label>Roll out status:  <?php  $total=0;
   $total_=$county_dashboard_notifications['facility_roll_out_status'][0]['targetted'];
     $total=round((@$county_dashboard_notifications['facility_roll_out_status'][0]['using_hcmp']/$total_*100),1);
     echo ' Using HCMP '.$county_dashboard_notifications['facility_roll_out_status'][0]['using_hcmp']
     .' /  Targeted for roll out '.$county_dashboard_notifications['facility_roll_out_status'][0]['targetted']?></label>
    <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $total ?>%;">
        <?php echo $total."%" ?>
    </div>
      </div>
      </a> 
      <div id="facility_monitoring"></div>
    </div>
  </div>  
	</div>	
	<script>
	     ajax_request_replace_div_content('reports/monitoring',"#facility_monitoring");
	</script>