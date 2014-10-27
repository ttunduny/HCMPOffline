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
    <link href="<?php echo base_url().'assets/css/tabs.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/tabstyles.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
      <script src="<?php echo base_url('assets/scripts/cbpFWTabs.js')?>" type="text/javascript"></script>
    
     
    <title>HCMP | National</title>
    <STYLE TYPE="text/css">
     a:hover{
    text-decoration: none;
}

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
    
    width: 74%;
  }
  .stat_item{

    height:100px;
  }
  .figure_up{
    font-size: 32px;
    float:left;
    margin:0 3px 0 10px;

      }
      .figure_count{
    font-size: 28px;
    margin:0 3px 0 60px;

      }
  .figure_low{
    font-size: 14px;
    margin:12px 3px 0 0;

      }

 .stat_item .row {
    
    margin-left:0 ; 
     }
.view_more{

}
    </STYLE>
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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </script>
  
  </head>
  
  <body screen_capture_injected="true" style="background-color: white;">
  	
  	
    
   <div class="container-fluid  navbar-fixed-top">

<div class="collapse navbar-collapse navbar-left">
  <div class="navbar-header" >
  
            <a href="<?php echo base_url().'national';?>">   
            <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" class="img-responsive " alt="Responsive image" id="logo" ></a>
            
        </div>

</div>

<div class="collapse navbar-collapse navbar-right">

   <div class="tabs tabs-style-underline" style="width:600px;">
          <nav >
            
            <ul>

              <li><a href="" class=""><span>Home</span></a></li>
              <li><a href="<?php echo base_url().'national/reports';?>" class=""><span>Reports</span></a></li>
              <li><a href="" class=""><span>Search</span></a></li>
              <li><a href="" class=""><span>Log In</span></a></li>
            </ul>
          </nav>
      
        </div><!-- /tabs -->
</div>

<div class="container-fluid" style="margin-top:4.8%;">
  <div class="row-fluid">
    <div class="col-md-3">
      
      <div class="tile" id="map" style="max-height: 400px;">
            
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

    <div class="col-md-8">
      
      <div class="row">
        
    <div class="col-md-3">

      <div class="color_b stat_item">
       <div class="row">

        <div class=" figure_up">

          <span class="glyphicon glyphicon-home"></span>
          <span class=" figure_count"> 81</span>
         
        </div>
       
          </div>
           <div class="row">

        <div class=" figure_low">

         Facilities Rolled Out
        </div>
        <div class="panel-footer" style="background-color:white;color:black;">
           View More...
        <span class=" view_more glyphicon glyphicon-circle-arrow-right"></span>

        </div>
       
       
          </div>
         
            
                            
        </div>

    </div>

    <div class="col-md-3">

      <div class="color_e stat_item">
            <div class="row">

        <div class=" figure_up">

          <span class="glyphicon glyphicon-user"></span>
          <span class=" figure_count"> 429</span>
         
        </div>
       
          </div>
           <div class="row">

        <div class=" figure_low">

         Trained HCW
        </div>
        View More...
        <span class=" view_more glyphicon glyphicon-circle-arrow-right"></span>
       
          </div>
                            
                   </div>
      
    </div>
    <div class="col-md-3">

      <div class="color_a stat_item">
           <div class="row">

        <div class=" figure_up">

          <span class="glyphicon glyphicon-shopping-cart"></span>
          <span class=" figure_count"> 25</span>
         
        </div>
       
          </div>
           <div class="row">

        <div class=" figure_low">

         Facilities Have Stock-outs
        </div>
         View More...
        <span class=" view_more glyphicon glyphicon-circle-arrow-right"></span>
       
          </div>   
        </div>
      
    </div>

      </div>

    </div>


    
  </div><!--end first row-->

  <div></div>
</div>



	

	</div>
	
	
  <script>
      (function() {

        [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
          new CBPFWTabs( el );
        });

      })();
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
    var url='<?php echo base_url(); ?>';
    </script>
  <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/scripts/cbpFWTabs.js')?>" type="text/javascript"></script>
 <!--  <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
    <!-- Bootstrap core JavaScript===================== --> 
  <script src="<?php echo base_url().'assets/scripts/jquery-ui-1.10.4.custom.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/highcharts.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/exporting.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/jquery.floatThead.min.js'?>" type="text/javascript"></script>  
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url().'assets/scripts/hcmp_shared_functions.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
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