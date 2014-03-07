<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>HCMP |<?php echo $title;?> </title>    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
    <link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/normalize.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/jquery-ui-1.10.4.custom.min.css'?>" type="text/css" rel="stylesheet"/>
	<script src="<?php echo base_url().'assets/scripts/jquery-1.8.0.js'?>" type="text/javascript"></script>
	
	<!-- <link href="<?php echo base_url().'assets/metro-bootstrap/docs/font-awesome.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/metro-bootstrap/css/metro-bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>    	
    </style>
  </head>  
  <body style="" screen_capture_injected="true">
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container" style="margin: auto;padding: 0;width: 99%">
      	<div class="row">
      		<div class="col-md-3">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img style="display:inline-block;" src="<?php echo base_url();?>assets/img/coat_of_arms-resized1.png" class="img-responsive " alt="Responsive image">

				<div id="" style="display:inline-block;">
					<span style="font-size: 0.95em;font-weight: bold; ">Ministry of Health</span><br />
					<span style="font-size: 0.85em;">Health Commodities Management Platform (HCMP)</span>	
				</div>
        </div>
        </div>
        <div class="col-md-2">
        	<div style="margin: auto;"></div>
        	
        	</div>
        <div class="col-md-6">
        <div class="navbar-collapse collapse" id="navigate">
          
          <ul class="nav navbar-nav navbar-right" >   
            <?php
    // foreach ($menu as $key) {
	//echo "<li><a href='$key->menu_url'>$key->menu_text</a></li>";
//}?>
          </ul>
          </div>
          </div>
          
          <div class="col-md-1" style="" >
          	<div >
          	
          	</div>
          </div>
          </div>
        </div><!--/.nav-collapse -->
      </div>
    <div class="container" style="margin-top:4.5%;padding: 0;width: 98%">
<!----------- HCMP MODAL dialog Box for all uses--------->
<div class="modal fade" id="communication_dialog" tabindex="-1" role="dialog"
 aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">HCMP: Notification Message</h4>
      </div>
      <div class="modal-body">   
      </div>
      <div class="modal-footer">         
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
     
    <?php $this -> load -> view($content_view);?>
    </div> <!-- /container -->
    <?php $this -> load -> view("shared_files/template/footer");?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?php echo base_url().'assets/scripts/jquery-ui-1.10.4.custom.min.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/boot-strap3/js/alert.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/jquery.floatThead.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/hcmp_shared_functions.js'?>" type="text/javascript"></script>
    <!-- Placed at the end of the document so the pages load faster -->

<div id="window-resizer-tooltip"><a href="#" title="Edit settings" style="background-image: url(chrome-extension://kkelicaakdanhinjdeammmilcgefonfh/images/icon_19.png);"></a><span class="tooltipTitle">Window size: </span><span class="tooltipWidth" id="winWidth"></span> x <span class="tooltipHeight" id="winHeight"></span><br><span class="tooltipTitle">Viewport size: </span><span class="tooltipWidth" id="vpWidth"></span> x <span class="tooltipHeight" id="vpHeight"></span></div></body>

</html>
