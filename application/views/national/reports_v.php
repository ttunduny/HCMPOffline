<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">   
    <!-- Bootstrap core CSS -->  
    <link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
    
    <link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/normalize.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/dashboard.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/jquery-ui-1.10.4.custom.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/font-awesome.min.css'?>" type="text/css" rel="stylesheet"/>
    <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
    <link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
    
    <script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
    <title>HCMP | <?php echo $title;?></title>

<style>
	.active-panel{
    	border-left: 6px solid #36BB24;
    }
    body {
padding-top: 4.5%;
}

.modal-content,.form-control
{
  border-radius: 0 !important;
}
#radioBtn .notActive{
    color: #3276b1;
    background-color: #fff;
}
.main_criteria #radioBtn .active{
    color: white;
    background-color: #3c763d;
    border-color: #3c763d;
}
</style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </script></head>
  <body screen_capture_injected="true" style="">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header" id="st-trigger-effects">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url().'national';?>" >HCMP</a>

        </div>
        <div class="navbar-header" >
  
            <a href="<?php echo base_url().'national';?>">   
            <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" class="img-responsive " alt="Responsive image" id="logo" ></a>
            
        </div>
        
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url().'national';?>">Home</a></li>
            <li class="active"><a href="<?php echo base_url().'national/reports';?>">Reports</a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Welcome, Guest</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-log-in" style="margin-right: 2%;"></span> Login</a></li>
                            
                            <li class="divider"></li>
                        </ul>
                    </li>
          </ul>
          
                                        
        </div><!--/.nav-collapse -->

      </div>
    </div>
	
	<div class="container jumbotron" style="min-height: 600px;/*border: 1px solid #000;*/" id="main-content">
	
    <div class="container" style="margin-top: 2%">
	 <div class="row">
		
        <div class="form-group main_criteria">
    		<div class="col-md-7">
    			<div class="input-group">
    				<div id="radioBtn" class="btn-group">
    					<a class="btn btn-primary btn-md active " data-toggle="criteria" data-title="exp">Expiries</a>
    					<a class="btn btn-primary btn-md notActive" data-toggle="criteria" data-title="cons">Consumption</a>
    					<a class="btn btn-primary btn-md notActive" data-toggle="criteria" data-title="stock">Stock Level</a>
    					<a class="btn btn-primary btn-md notActive" data-toggle="criteria" data-title="orders">Orders</a>
    				</div>
    				<input type="hidden" name="" id="">
    			</div>
    		</div>
    	</div>
       
	</div>
	
	</div>
	<div class="container " style="max-width: 960px;/*border: 1px solid #000;*/">
		
		<div class="row expiries" style="margin-top: 2%">
			
			  <div class="container">
    <div class="row">
		
        <div class="form-group">
    		
    		<div class="col-md-12">
    			<label for="" class="control-label text-right">Select Expiry option</label>
    			<div class="input-group">
    				<div id="radioBtn" class="btn-group">
    					<a class="btn btn-primary btn-sm active" data-toggle="Expiry" data-title="actual">Actual</a>
    					<a class="btn btn-primary btn-sm notActive" data-toggle="Expiry" data-title="potential">Potential</a>
    				</div>
    				<input type="hidden" name="happy" id="happy">
    			</div>
    		</div>
    	</div>
       
	</div>
    
			</div>
			  
			  		  
			  
		</div>
		
		<div class="row commodity_c" style="margin-top: 2%">
			
			  <div class="container">
    <div class="row">
		
        <div class="form-group">
    		
    		<div class="col-md-12">
    			<label for="" class="control-label text-right">Select Consumption option</label>
    			<div class="input-group">
    				<div id="radioBtn" class="btn-group">
    					<a class="btn btn-primary btn-sm active" data-toggle="Consumption" data-title="All">All Commodities</a>
    					<a class="btn btn-primary btn-sm notActive" data-toggle="Consumption" data-title="tracer">Tracer Commodity</a>
    					<a class="btn btn-primary btn-sm notActive" data-toggle="Consumption" data-title="specific">Specify Commodity</a>
    				</div>
    				<input type="hidden" name="happy" id="happy">
    			</div>
    		</div>
    	</div>
       
	</div>
    
			</div>
			  		  
			  
		</div>
		
		<div class="row stock" style="margin-top: 2%">
			
			  <div class="container">
		
		<div class="row">
		
        <div class="form-group">
    		
    		<div class="col-md-12">
    			<label for="" class="control-label text-right">View Stock in?</label>
    			<div class="input-group">
    				<div id="radioBtn" class="btn-group">
    					<a class="btn btn-primary btn-sm active" data-toggle="stock" data-title="mos">M.O.S</a>
    					<a class="btn btn-primary btn-sm notActive" data-toggle="stock" data-title="stock">Actual</a>
    				</div>
    				<input type="hidden" name="happy" id="happy">
    			</div>
    		</div>
    	</div>
       
	</div>
		</div>
       
	</div>
		
	
		<div class="row" style="margin-top: 2%">
			  <div class="col-xs-6">
			  	<label for="county">County</label>
			    <select class="form-control input-md"> 
			    	<option>Select County</option>
			    	<?php
							foreach ($county as $value => $county_list) :
									 $c_id = $county_list['id'];
									$c_name = $county_list['county'];
								    echo "<option value='$c_id'>$c_name</option>";
							endforeach;
					?>
			    	</select>
			  </div>
			  <div class="col-xs-6">
			  	<label for="county">Sub-County</label>
			    <select class="form-control input-md"> 
			    	<option>Select Sub-County</option>
			    	<?php
							foreach ($sub_county as $value => $sub_county_list) :
									 $sub_cid = $sub_county_list['id'];
									$d_name = $sub_county_list['district'];
								    echo "<option value='$sub_cid'>$d_name</option>";
							endforeach;
					?>
			    	</select>
			  </div>
			  
		</div>





<div class="row" style="margin-top: 2%">
			  <div class="col-xs-6">
			  	<label for="county">Facility</label>
			    <select class="form-control input-md" id="facility_id"> 
			    	<option>Select Facility</option>
			    	
			    	</select>
			  </div>
			  <div class="col-xs-6">
			  	<label for="county">Commodity</label>
			    <select class="form-control input-md" id="commodity"> 
			    	<option>Select Commodity</option>
			    	<?php
							foreach ($commodities as $value => $commodity) :
									 $c_id = $commodity['id'];
									$c_name = $commodity['commodity_name'];
								    echo "<option value='$c_id'>$c_name</option>";
							endforeach;
					?>
			    	</select>
			  </div>
			  
		</div>



<div class="row" style="margin-top: 2%">
			  <div class="col-xs-3">
			  	<label for="From">From</label>
			   <input class="form-control" type="text" placeholder="From" id="expfrom">
			  </div>
			  
			  <div class="col-xs-3">
			  	<label for="To">To</label>
			   <input class="form-control" type="text" placeholder="To" id="expto">
			  </div>
			  
			  <div class="col-xs-6">
			  	<label for="county">From</label>
			   		<select class="form-control input-md" id="interval"> 
			    	<option>Select Interval</option>
			    	<option>2 Months</option>
			    	<option>6 Months</option>
			    	<option>1 Year</option>
			    	
			    	</select>
			  </div>
			  
			  
		</div>
		<div class="modal-footer">
				<button type="button" class="btn btn-success" >
				<span class="glyphicon glyphicon-th-list"></span>	View
				</button>
				<button type="button" class="btn btn-danger edit_user">
				<span class="glyphicon glyphicon-file"></span>	Generate
				</button>
			</div>
		
	</div> <!-- /container -->

    </div> <!-- /container -->
    
    

    
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
    var url='<?php echo base_url(); ?>';
     $(document).ready(function () {
     	
     	$(".stock").hide('');
     	
    $('#radioBtn a').on('click', function(){
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
    $('#'+tog).prop('value', sel);
    
    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
})
    $( "#expfrom,#expto" ).datepicker();
});


$('#radioBtn a').click( function () {
			var criteria= $(this).attr('data-title')
				//alert (criteria);
						if(criteria=="exp"){
						
						$(".commodity_c").show('slow');
						$(".expiries").show('slow');
						$(".stock").hide('slow');
						$("#commodity").attr("disabled", false);
						 
						}else if(criteria=="cons"){
							$(".commodity_c").show('slow');
							$(".stock").hide('slow');	
							$(".expiries").hide('slow');
							$("#commodity,#interval").attr("disabled", 'disabled');
								
						}else if(criteria=="stock"){
							$(".commodity_c").show('slow');
							$(".stock").show('slow');								
							$(".expiries").hide('slow');
							$("#to,#from,#interval").attr("disabled", 'disabled');	
							}
							else if(criteria=="orders"){
							$(".stock").hide('slow');	
							$(".expiries").hide('slow');
							$(".commodity_c").hide('slow');
							
								
							}
							else if(criteria=="actual"){
								
							$("#interval").attr("disabled", 'disabled');
															
							}
							else if(criteria=="potential"){
								
							$("#interval").attr("disabled", false);
								
							}
							else if(criteria=="All"){
								
							$("#interval").attr("disabled", 'disabled');
							$("#commodity").attr("disabled", 'disabled');
								
							}
							else if(criteria=="tracer"){
								
							$("#interval").attr("disabled", 'disabled');
							$("#commodity").attr("disabled", 'disabled');	
							}
							else if(criteria=="specific"){
								
							$("#interval").attr("disabled", 'disabled');
							$("#commodity").attr("disabled", false);
								
							}

			})
			
						
			var drop_down='';
	 var facility_select = "<?php echo base_url(); ?>national/facilities_json/";
  	$.getJSON( facility_select ,function( json ) {
     $("#facility_id").html('<option value="NULL" selected="selected">Select Facility</option>');
      $.each(json, function( key, val ) {
        drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>"; 
      });
      $("#facility_id").append(drop_down);
    });
    
    
    </script>
    	 <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
    <!-- Bootstrap core JavaScript===================== --> 
  <script src="<?php echo base_url().'assets/scripts/jquery-ui-1.10.4.custom.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/highcharts.js'?>" type="text/javascript"></script>
   <script src="<?php echo base_url().'assets/scripts/exporting.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/jquery.floatThead.min.js'?>" type="text/javascript"></script>  
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url().'assets/scripts/hcmp_shared_functions.js'?>" type="text/javascript"></script>
    <!--Datatables==========================  -->
  <script src="<?php echo base_url().'assets/datatable/jquery.dataTables.min.js'?>" type="text/javascript"></script>    
  <script src="<?php echo base_url().'assets/datatable/dataTables.bootstrap.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/TableTools.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/ZeroClipboard.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/dataTables.bootstrapPagination.js'?>" type="text/javascript"></script>
  <!-- validation ===================== -->
  <script src="<?php echo base_url().'assets/scripts/jquery.validate.min.js'?>" type="text/javascript"></script>
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/loadingbar.css'?>" />
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/elusive-webfont.css'?>" />
<div id="window-resizer-tooltip" style="display: none;"><a href="#" title="Edit settings" style="background-image: url(chrome-extension://kkelicaakdanhinjdeammmilcgefonfh/images/icon_19.png);"></a><span class="tooltipTitle">Window size: </span><span class="tooltipWidth" id="winWidth">1366</span> x <span class="tooltipHeight" id="winHeight">768</span><br><span class="tooltipTitle">Viewport size: </span><span class="tooltipWidth" id="vpWidth">1366</span> x <span class="tooltipHeight" id="vpHeight">449</span></div></body></html>