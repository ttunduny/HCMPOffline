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
    <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/font-awesome.min.css'?>" type="text/css" rel="stylesheet"/>
    <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
    <link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
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
#overview{
	padding-right:0;
}
#overview h4{
	
	padding:6px;
	font:#000;
	background:#fff;
	text-align:center;
	margin:0;
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
	
	<div class="container-fluid" style="" id="main-content">
	<div class="row">
		
		<div class="col-md-4">
			
			<div class="row">
				<div class="col-md-12" style="border: 1px solid #000;height: 620px">
					<div id="map" ></div>
				<script>
					var map= new FusionMaps ("assets/FusionMaps/FCMap_KenyaCounty.swf","KenyaMap","100%","100%","0","0");
					map.setJSONData(<?php echo $maps; ?>);
					
    				map.render("map");
    				
                    </script>
				
					</div>
				
			</div>
			
			</div>
		<div class="col-md-8">
			
			<div class="row">
				<div class="col-md-6" style="border: 1px solid #000;height: 200px" id="overview">
					<h4>Facility Overview</h4>
				</div>
				<div class="col-md-6" style="border: 1px solid #000;height: 200px" id="info">
					<h4>Facility Infor</h4>
					
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12" style="border: 1px solid #000;height: 420px">
					
					
       
				</div>
			</div>
			
		</div>
	</div>
			
    
    </div> <!-- /container -->
    
    

    
    <script>
         //auto run
         var url ='<?php echo base_url()?>';
         $('#potential_').on('shown.bs.tab', function (e) {
         $('#potential').html('');
         });
         $('#actual_').on('shown.bs.tab', function (e) {
         $('#actual').html('');
         });

      $('.county-name').html("National "+" &nbsp;");
      ajax_request_replace_div_content('national/expiry/NULL/NULL/NULL/NULL/NULL',"#actual"); 
      ajax_request_replace_div_content('national/potential/NULL/NULL/NULL/NULL/NULL',"#potential"); 
      ajax_request_replace_div_content('national/facility_over_view/',"#facilities_rolled_out");
      ajax_request_replace_div_content('national/hcw/',"#hcw_trained");
      ajax_request_replace_div_content('national/stock_level_mos/NULL/NULL/NULL/NULL',"#mos");
      ajax_request_replace_div_content('national/consumption/NULL/NULL/NULL/NULL',"#consumption");
      ajax_request_replace_div_content('national/get_facility_infor/NULL/NULL/NULL/NULL',"#facilities");
      ajax_request_replace_div_content('national/order/NULL/NULL/NULL/NULL/NULL',"#orders");
      ajax_request_replace_div_content('national/get_lead_infor/NULL/NULL/NULL/NULL/NULL',"#lead_infor");
      
        $(".ecounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var year = $("#eyear").val();
        var county = $("#ecounty_filter").val();
       // var district=$(this).closest("tr").find("#ecounty_filter").val();
       // var facility=$(this).closest("tr").find("#ecounty_filter").val();
           ajax_request_replace_div_content('national/expiry/'+year+'/'+county+'/NULL/NULL/NULL',"#actual");
        });
        
        $(".asubcounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var year=$("#asubcountyyear").val();
        var county_id=$('#county_id').val();
        var district=$("#asubcounty_filter").val();
        var facility=$("#asubcounty_facility_filter").val();
        ajax_request_replace_div_content('national/expiry/'+year+'/'+county_id+'/'+district+'/'+facility+'/NULL',"#actual");
        });
        /////potential
        $(".pcounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var county=$("#pcounty_filter").val();
        ajax_request_replace_div_content('national/potential/'+county+'/NULL/NULL/NULL',"#potential");
        });
        
        $(".psubcounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var county_id=$('#county_id').val();
        var district=$("#psubcounty_filter").val();
        var facility=$("#psubcounty_facility_filter").val();
        ajax_request_replace_div_content('national/potential/'+county_id+'/'+district+'/'+facility+'/NULL',"#potential");
        });
     
         $(".subcounty").click(function(){
            /*
             * when clicked, this object should populate facility names to facility dropdown list.
             * Initially it sets a default value to the facility drop down list then ajax is used 
             * is to retrieve the district names using the 'dropdown()' method used above.
             */
            json_obj = {"url":"<?php echo site_url("orders/getFacilities");?>",}
            var baseUrl = json_obj.url;
            var id = $(this).attr("value");
            $('.subcounty').val(id);
            dropdown(baseUrl,"district="+id,".facility");
 
          
        });

      
    function run(data){
        var county_data=data.split('^');
        $('.county-name').html(county_data[1]+"&nbsp;County &nbsp;");
        ajax_request_replace_div_content('national/facility_over_view/'+county_data[0],"#facilities_rolled_out");
        ajax_request_replace_div_content('national/hcw/'+county_data[0],"#hcw_trained");
        $('.county').val(county_data[0]);
        $('#county_id').val(county_data[0]);
        json_obj={"url":"<?php echo site_url("orders/getDistrict");?>",}
        var baseUrl=json_obj.url;
        dropdown(baseUrl,"county="+county_data[0],".subcounty");
        ajax_request_replace_div_content('national/expiry/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#actual");
        ajax_request_replace_div_content('national/potential/'+county_data[0]+'/NULL/NULL/NULL/NULL',"#potential"); 
        ajax_request_replace_div_content('national/stock_level_mos/'+county_data[0]+'/NULL/NULL/NULL/ALL',"#mos");
        ajax_request_replace_div_content('national/consumption/'+county_data[0]+'/NULL/NULL/NULL',"#consumption");
        ajax_request_replace_div_content('national/get_facility_infor/'+county_data[0]+'/NULL/NULL/NULL',"#facilities");
        ajax_request_replace_div_content('national/order/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#orders");
        ajax_request_replace_div_content('national/get_lead_infor/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#lead_infor");
    }
            function dropdown(baseUrl,post,identifier){
            /*
             * ajax is used here to retrieve values from the server side and set them in dropdown list.
             * the 'baseUrl' is the target ajax url, 'post' contains the a POST varible with data and
             * 'identifier' is the id of the dropdown list to be populated by values from the server side
             */
            $.ajax({
              type: "POST",
              url: baseUrl,
              data: post,
              success: function(msg){
                    var values=msg.split("_")
                    var dropdown="<option value='NULL'>All</option>";
                    for (var i=0; i < values.length-1; i++) {
                        var id_value=values[i].split("*")
                        dropdown+="<option value="+id_value[0]+">";
                        dropdown+=id_value[1];
                        dropdown+="</option>";
                    };
                    $(identifier).html(dropdown);
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                   if(textStatus == 'timeout') {}
               }
            }).done(function( msg ) {
            });
        }
       function ajax_request_replace_div_content(function_url,div){
        var function_url =url+function_url;
        var loading_icon=url+"assets/img/loader2.gif";
        $.ajax({
        type: "POST",
        url: function_url,
        beforeSend: function() {
        $(div).html("<img style='margin-left:20%;' src="+loading_icon+">");
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