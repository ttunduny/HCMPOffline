<?php 
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

<div class="panel-group " id="accordion" style="padding: 0;">
                <!--Dispense-->
                <div class="panel panel-default <?php echo $active_panel=='dispensing'? 'active-panel': null; ?>">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a  data-parent="#accordion" href="<?php echo base_url().'dispensing'; ?>" id="dispensing"><span class="glyphicon glyphicon-retweet">
                            </span>Dispense</a>
                        </h4>
                    </div>
                </div>
                
                <!--Patients-->
                <div class="panel panel-default <?php echo $active_panel=='patients'? 'active-panel': null; ?>">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a  data-parent="#accordion" href="#" id="orders"><span class="glyphicon glyphicon-user">
                            </span>Patients</a>
                        </h4>
                    </div>
                    <div id="collapsec" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <a href="#">Add Patients</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" id="bin_card">View Patients</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div> 
                </div>
                <div class="panel panel-default <?php echo $active_panel=='history'? 'active-panel': null; ?>">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a  data-parent="#accordion" id="donations" href="<?php echo base_url("dispensing/dispensing_history") ?>" ><span class="glyphicon glyphicon-list-alt">
                            </span>History</a>
                        </h4>
                    </div>
                </div>  
                <!--Home-->
                <div class="panel panel-default <?php echo $active_panel=='back_to_home'? 'active-panel': null; ?>">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="<?php echo base_url().'home'; ?>" id="home"><span class="glyphicon glyphicon-arrow-up">
                            </span>Back to Home</a>
                        </h4>
                    </div>
                </div>        
            </div>
<script>
   $("#bin_card").on('click', function() {
	var body_content='<select id="facility_code" name="facility_code" class="form-control"><option value="0">--Select Facility Name--</option>'+
                    '<?php	$facilities=Facilities::get_facilities_online_per_district($this -> session -> userdata('county_id'));
                    foreach($facilities as $facility):
						    $facility_code=$facility['facility_code'];
							 $facility_name= $facility['facility_name']; ?>?>'+					
						'<option <?php echo 'value="'.$facility_code.'">'.preg_replace("/[^A-Za-z0-9 ]/", "",$facility_name );?></option><?php endforeach;?>';
   //hcmp custom message dialog
    dialog_box(body_content,
    '<button type="button" class="btn btn-primary order_for_them" >View Their Bin Card</button>'
    +'<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>'); 
    $(".order_for_them").on('click', function() {
    var facility_code=$('#facility_code').val();
    if(facility_code==0){
    alert("Please select a Facility First");
    	
    }else{
     window.location="<?php echo site_url('reports/stock_control');?>/"+facility_code;		
    }
   	
    });
		
	})


	$(document).ready(function() 
	{
		
		$("#stocking_levels").on('click', function(){
			active_panel(this);
			});
		$("#expiries").on('click', function(){
			active_panel(this);
			});
		$("#consumption").on('click', function(){
			active_panel(this);
			});	
		$("#donations").on('click', function(){
			active_panel(this);
			});
		$("#orders").on('click', function(){
			active_panel(this);
			});	
		$("#program_reports").on('click', function(){
			active_panel(this);
			});	
		$("#system_usage").on('click', function(){
			active_panel(this);
			});
	});
</script>

            
