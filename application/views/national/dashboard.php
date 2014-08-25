<html lang="en">
	
	<head>
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
    <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
    
     
    <title>HCMP | National</title>
<script>
   paceOptions = {
  ajax: false, // disabled
  document: true, // 
  eventLag: true,
  restartOnPushState: false,
  elements:{
  	selectors:['body']
  } // 
  
};
 
    function load(time){
      var x = new XMLHttpRequest()
      x.open('GET', document.URL , true);
      x.send();
    };
    setTimeout(function(){
      Pace.ignore(function(){
        load(3100);
      });
    },4500);

    Pace.on('hide', function(){
   //   console.log('done');
    });

    var url="<?php echo base_url(); ?>";
    </script>
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

h4{
	
	padding:4px;
	color:black;
	background:white;
	text-align:center;
	margin:0;	
	font-size:15px;
}

.stat_item {
		height: 36px;
		padding: 2px 5px;
		color: #fff;
		text-align: center;
		font-size: 1em;
		
	}	
	
	#notify .col-md-2,.col-md-1{
		padding:3px;
	}
	#notify {
		margin-bottom: 5px;
	}
	.tile{
		box-shadow:  0px 1px 5px 0px #d3d3d3;
	}
	.tile h4{
		padding: 5px;
		background-color:#528f42;
		color: white;
	}
	</style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </script>
  
  </head>
  
  <body screen_capture_injected="true" style="background-color: whitesmoke;">
  	
  	<div class="container-fluid navbar-default navbar-fixed-top" role="navigation" style="background-color:white">
        <div class="container-fluid">
            <div class="navbar-header" id="st-trigger-effects">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand " href="<?php echo base_url().'national';?>" >HCMP</a>

        </div>
        <div class="navbar-header" >
  
            <a href="<?php echo base_url().'national';?>">   
            <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" class="img-responsive " alt="Responsive image" id="logo" ></a>
            
        </div>
        
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo base_url().'national';?>">Home</a></li>
            <li class=""><a href="<?php echo base_url().'national/reports';?>">Reports</a></li>
            <li class=""><a href="<?php echo base_url().'national/search';?>">Search</a></li>
            <li class="" style="background: #144d6e; color: white;"><a style="background: #144d6e; color: white;" href="<?php echo base_url().'home';?>"><span class="glyphicon glyphicon-user"></span>Log in</a></li>
                        
                    </li>
          </ul>
          
                                        
        </div><!--/.nav-collapse -->

      </div>
    </div>
    
   <div class="container-fluid">

<div class="row-fluid">
	
	<div class="col-md-4 " style="padding-right: 0">
		<div class="row-fluid" style="" id="notify" >
		<div class="col-md-6">
					<div class="color_g stat_item">
						<span class="glyphicon glyphicon-user"></span>
                  	HCW Trained <br/> 132
                            
                   </div>
		</div>
	<div class="col-md-6">
					<div class="color_e stat_item">
						<span class="glyphicon "></span>
                 	Facilities Rolled Out <br/> 2312
                            
                   </div>
	</div>
	
	
	</div>
	
	
	<div class="row-fluid" style="" id="" >
		<div class="col-md-12 " style="">
			<div class="tile" id="map" style="max-height: 500px;">
						
					</div>
			<div style="width:130px;margin-left:30%;padding:2%">
            <div style="display:inline-block;width:10px;height:10px;background:#FFCC99">
                
            </div>
            <div style="width:80px;display:inline-block;margin-left:5px;font-size:120%">
            	Using HCMP
            	</div>
            </div>
					<script>
					var map= new FusionMaps ("assets/FusionMaps/FCMap_KenyaCounty.swf","KenyaMap","100%","100%","0","0");
					map.setJSONData(<?php echo $maps; ?>);
					
    				map.render("map");
    				
                    </script>
						
		</div>
	
	</div>
	
	</div>
	
	<div class="col-md-8 " style="padding-left: 0;style="padding-right: 0"">
		
		<div class="row-fluid">
			<div class="col-md-6" style="border: 0px solid #036;">
				
				<div class="tile" id="" style="height: 50px;border: 0px solid #036;">
					<h4>M</h4>
				</div>
				
				<div class="tile" id="facility_breakdown" style="height: 370px;border: 0px solid #036;">
					
				</div>
				
			</div>
			
			<div class="col-md-6" style="border: 0px solid #036;">
				<div class="tile" id="filter" style="height: 100px">
					<h4>M</h4>
				</div>
				<div class="tile" id="mos" style="height: 420px">
					
				</div>
			</div>
		</div>
		
		
	</div>
	
	
	
</div>

<div class="row-fluid">
		
		<div class="col-md-6" style="border: 0px solid #036;">
			<div class="tile" id="" style="height: 100px;border: 0px solid #036;">
				<h4>M</h4>	
				</div>
			<div class="tile" id="consumption" style="height: 450px">
				
			</div>
			
		</div>
		<div class="col-md-6" style="border: 0px solid #036;">
			<div class="tile" id="" style="height: 100px;border: 0px solid #036;">
					<h4>M</h4>
				</div>
			<div class="tile" id="actual_ex" style="height: 450px">
				
			</div>
			
		</div>
		
	</div>
	
	<div class="row-fluid"style="margin-top: 12px;">
		
		
		<div class="col-md-6" style="border: 0px solid #036;">
			<div class="tile" id="" style="height: 100px;border: 0px solid #036;">
				<h4>M</h4>	
				</div>
			<div class="tile" id="potential_ex" style="height: 450px">
				
			</div>
			
		</div>
		<div class="col-md-6" style="border: 0px solid #036;">
			<div class="tile" id="" style="height: 100px;border: 0px solid #036;">
				<h4>M</h4>	
				</div>
			<div class="tile" id="orders" style="height: 450px">
				
			</div>
			
		</div>
	</div>
</div>
   	
   
   
   
   <script>
   
   ajax_fill_data('Kenya/facility_breakdown_pie',"#facility_breakdown");
   ajax_fill_data('Kenya/mos_graph',"#mos");
   ajax_fill_data('Kenya/roll_out',"#roll_out");
   ajax_fill_data('Kenya/consumption',"#consumption");
   ajax_fill_data('Kenya/actual_expiries/NULL/NULL/NULL/NULL/NULL',"#actual_ex");
   ajax_fill_data('Kenya/potential_expiries',"#potential_ex");
   ajax_fill_data('Kenya/orders',"#orders");
   
   function ajax_fill_data(function_url,div){
        var function_url =url+function_url;
        var loading_icon=url+"assets/img/Preloader_1.gif";
        $.ajax({
        type: "POST",
        url: function_url,
        beforeSend: function() {
        $(div).html("<img style='margin:40% 50% 0 50%;' src="+loading_icon+">");
        },
        success: function(msg) {
        $(div).html(msg);
        }
        });
        }   
         
</script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
    var url='<?php echo base_url(); ?>';
    </script>
  <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
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
</body></html>