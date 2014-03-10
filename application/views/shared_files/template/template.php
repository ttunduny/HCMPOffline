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
   <div class="navbar navbar-default navbar-fixed-top" id="top_panel">
   <div class="container" style="border-bottom: 2px solid #C0C0C0;width: 100%;">
        <div class="navbar-header " > 
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
        <div class="navbar-collapse collapse" style="font-weight: bold" id="navigate">
          <ul class="nav navbar-nav navbar-right" >
       <li><a href="<?php echo site_url();?>" class=" ">HOME</a> </li>   
<?php
//Retrieve all accessible menus from the session
$menus= $this -> session -> userdata('menus');
//Loop through all menus to display them in the top panel menu section
foreach($menus as $menu){?>
	<li class="" >
            	
            	<a href="<?php echo site_url($menu['menu_url']);?>" class=""><?php echo $menu['menu_text']?></a>
	</li>
<?php
				}
	?>


            <li class="dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" ></span><?php echo $this -> session -> userdata('full_name');?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                
                
                <li><a href="<?php echo site_url("user/change_password");?>"><span class="glyphicon glyphicon-pencil" style="margin-right: 2%"></span>Change password</a></li>
                
                <li><a href="<?php echo site_url("user/logout");?>"><span class="glyphicon glyphicon-off" style="margin-right: 2%"></span>Log out</a></li>
                
              </ul>
            </li>
          </ul>
         </div><!--/.nav-collapse -->
      </div>
      </div>
   
    <div class="container" style="margin-top:5.1%;padding: 0;width: 98%">
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
   <div id="footer">
      <div class="container">
        <p class="text-muted"> Government of Kenya &copy <?php echo date('Y');?>. All Rights Reserved</p>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
  <script src="<?php echo base_url().'assets/scripts/jquery-ui-1.10.4.custom.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
	<!--<script src="<?php echo base_url().'assets/boot-strap3/js/alert.js'?>" type="text/javascript"></script>-->
	<script src="<?php echo base_url().'assets/scripts/jquery.floatThead.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/hcmp_shared_functions.js'?>" type="text/javascript"></script>
    <!-- Placed at the end of the document so the pages load faster -->


</html>
