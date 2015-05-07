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
    <link href="<?php echo base_url().'assets/bower_components/semantic/packaged/css/semantic.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/tab-style/css/demo.css'?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/tab-style/css/tabs.css'?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/tab-style/css/tabstyles.css'?>" />
    <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/bower_components/semantic/packaged/javascript/semantic.js'?>" type="text/javascript"></script>
     
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
a ,u {
	text-decoration: none !important;
}
	.active-panel{
    	border-left: 6px solid #36BB24;
    }
    body {
padding-top: 1%;
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
		background:white;
	}
	.tile h4{
		padding: 5px;
		background-color:#528f42;
		color: white;
	}
	.btn{
		border-radius: 0;
	}
	.modal-dialog {
		
		width: 76%;
	}
	</style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </script>
  
  </head>
  
  <body screen_capture_injected="true" style="background-color: white;">
  	
<div class="container-fluid">
	
		<div class="tabs tabs-style-bar navbar-fixed-top">
	
					<nav>
						<ul><div style="margin: 13 6 0 0;">Ministry of Health</div>
							<a href="<?php echo base_url().'national';?>" style="margin-right: 60">   
           						 <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" class="img-responsive " alt="Responsive image" id="logo" ></a></li>
							<li><a href="#hcmp" class="icon icon-graph1"><span>HCMP</span></a>
							<li><a href="#rtk" class="icon icon-display"><span>RTK</span></a></li>
							<li><a href="<?php echo base_url().'home';?>" class="icon icon-user"><span>System Log in</span></a></li>
							<li><a href="#section-underline-5" class="icon icon-config"><span>Settings</span></a></li>
						</ul>
					</nav>
					
					<div class="content-wrap">
						
							<!-- BEGIN HCMP CONTENT -->
						<section id="hcmp" class="row-fluid">
							
							<div class="row-fluid" style="max-height: 460px">							
							
							
						<div id="" class="col-lg-4" style="margin-top: 1%;">
							
							<div class="tile"  style="max-height: 460px;">
							<div id="map" style="max-height: 400px;"></div>	
						<script>
					var map= new FusionMaps ("assets/FusionMaps/FCMap_KenyaCounty.swf","KenyaMap","100%","100%","0","0");
					map.setJSONData(<?php echo $maps; ?>);
					
    				map.render("map");
    				
                    </script>
                   		 <div class="row-fluid">
                   		 	<div class="col-lg-1">
                   		 		<div style="display:inline-block;width:14px;height:12px;background:#528f42">
				                
				            </div>
                   		 	</div>
                   		 	<div class="col-lg-4">
                   		 		Using HCMP
                   		 	</div>
                   		 	<div class="col-lg-3">
                   		 	</div>
                   		 	<div class="col-lg-4">
                   		 		<a href="" data-toggle="modal" data-target="#facilitystatsModal">
                   		 		More data
                   		 		</a>
                   		 	</div>
				             
				            
				            </div>
							</div>
							
			
					
						
						
						</div>
						
						<div id="" class=" tile col-lg-6" style="margin-top: 1%;">
							<div class="" style="height: 50px;">
								
									<button class="btn btn-sm btn-success"><span class="icon icon-display"></span>More</button>
								
							</div>
							<div class="" id="mos" style="height:370px ">
					
							</div>
						</div>
						
						<div id="" class="col-lg-2 tile" style="margin-top: 1%;height: 420px">
							
							<div class="" id="" style="height: ">
							<div class="row" style="">
								
								<div class="col-xs-1"></div>
								<div class="col-xs-10">
									<!--<a href="" data-toggle="modal" data-target="#facilitystatsModal">
									<!--	<div class="">
											<span class="glyphicon glyphicon-user"></span>
					                  	Facilities with Stockouts <br/> <span id="hcw_trained"></span>
					                            
					                </div>
					                   </a>-->
								</div>
								<div class="col-xs-1"></div>
								
							</div>
							<div class="row" >
								<div class="col-xs-1"></div>
								<div class="col-xs-10">
									<!--<a href="" class="" data-toggle="modal" data-target="#Modal">
											<div class="">
												<span class="glyphicon "></span>
						                 	Facilities Rolled Out <br/><span id="facilities_rolled_out"></span> 
						                            
						                   </div>
						                   </a>-->
								</div>
								<div class="col-xs-1"></div>
										
							</div>
							</div>
						</div>
						
						
							</div>
							
							<div class="ui horizontal divider">
								<i class="fa fa-bar-chart-o"></i>
								 </div>
							
							<div class="row-fluid" style=" margin-top:1.2%;min-height: 400px">
								
								
							</div>
							
						</section>
						<!-- /END HCMP CONTENT -->
						
						
						
						
						
						
						
						
						
						
						
						
						<section id="rtk" class="row-fluid">
							<div id="" class="col-lg-3">
							<p>RTK dash</p>
							
						</div>
							
						</section>
						
						
						
						<section id="section-underline-3"><p>Log in</p></section>
						<section id="section-underline-5"><p>Settings</p></section>
					</div><!-- /content -->
					
				</div><!-- /tabs -->
				
				
				
				
		</div>
   	
  <!-- Modal -->
<div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Facility Statistics</h4>
      </div>
      <div class="modal-body">
       <div class="">
       	
       </div>
       <div id="mosmodalgraph">
       	
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal stockmosModal -->

  <!-- Modal -->
<div class="modal fade" id="consumptionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal consumptionModal -->

 <!-- Modal -->
<div class="modal fade" id="facilitystatsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      	<div class="row-fluid filters" style="height: 40px;">
      		<section class="col-lg-6">
      				<div class="ui selection dropdown">
					  <input type="hidden" name="gender">
					  <div class="default text">Select County</div>
					  <i class="dropdown icon"></i>
					  <div class="menu">
					  	<?php
							foreach($county as $data):
							    $county_id=$data["id"];
								$county_name=$data["county"];
							      echo "<div class='item' data-value='$county_id'>$county_name</div>";
							    
							endforeach;
						?>
					    <div class="item" data-value="1">Nairobi</div>
					    <div class="item" data-value="0">Kirinyaga</div>
					  </div>
					</div>
					<div class="ui green button"><i class="fa fa-filter"></i> Filter</div>
      		</section>
      		<section class="col-lg-6">
      			
      		</section>
      	</div>
      	
      	<div class="row-fluid">
      		<section class="col-lg-5 pie" style="height: 70px;border: 1px solid #036;">
      			
      		</section>
      		<section class="col-lg-7 tabledata" style="height: 70px;border: 1px solid #036;">
      			
      		</section>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal orderModal -->
   
   
   
   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url().'assets/tab-style/js/cbpFWTabs.js'?>"></script>
		<script>
		$('.ui.dropdown')
  .dropdown()
;
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>
		
		<script>
    var url='<?php echo base_url(); ?>';
     $(document).ready(function () {
     	
     	});
		
	</script>	
    <script>
    var url='<?php echo base_url(); ?>';
    </script>
  		<script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
		<!--  <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
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

</body>

</html>