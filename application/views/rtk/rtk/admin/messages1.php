
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tagsinput/bootstrap-typeahead.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tagsinput/tagmanager.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tagsinput/typeahead.bundle.js"></script>
<link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'assets/css/jquery-ui.css'?>" type="text/css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url().'assets/css/pace-theme-flash.css'?>" />

<script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/scripts/typehead/handlebars.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'assets/scripts/validator.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'assets/scripts/waypoints.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'assets/scripts/waypoints-sticky.min.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/scripts/typehead/typeahead.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tagsinput/tagmanager.css">

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
  .tt-dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    list-style: none;
    font-size: 14px;
    background-color: #ffffff;
    border: 1px solid #cccccc;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
    background-clip: padding-box;
  }
  .tt-suggestion > p {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: normal;
    line-height: 1.428571429;
    color: #333333;
    white-space: nowrap;
  }
  .tt-suggestion > p:hover,
  .tt-suggestion > p:focus,
  .tt-suggestion.tt-cursor p {
    color: #ffffff;
    text-decoration: none;
    outline: 0;
    background-color: #428bca;
  }
  .typeahead {width: 400px;}
  .query-title{border-bottom:inset; font-weight:bold}

  .input-small{
    width: 100px !important;
  }
  .input-small_{
    width: 230px !important;
  }
  .panel-success>.panel-heading {
    color: white;
    background-color: #528f42;
    border-color: #528f42;
    border-radius:0;

  }
  .navbar-default {
    background-color: white;
    border-color: #e7e7e7;
  }
  .modal-content
  {
    border-radius: 0 !important;
  }
  #navigate ul {
   text-align: left;
   display: inline;
   margin: 0;
   padding: 13px 4px 17px 0;
   list-style: none;
 }
/*
 * For National Outlook only as it doesnt display properly
 */
 #navigate ul li {
   display: inline-block;
   margin-right: -4px;
   position: relative;
   padding: 13px 18px;
   background: #29527b; /* Old browsers */
   cursor: pointer;
   -webkit-transition: all 0.2s;
   -moz-transition: all 0.2s;
   -ms-transition: all 0.2s;
   -o-transition: all 0.2s;
   transition: all 0.2s;
 }
 </style>


 <style type="text/css">

 #content{
   margin-top: -130px;   
   width: 85%;
   margin-left: 10%;
 }
 </style>

<!--div class="tabbable tabs-left" style="font-size:147%;">
  <ul class="nav nav-tabs">
   <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_admin'; ?>">Users</a></li>
   <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_admin_messages'; ?>">Messages</a></li>
   <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_admin_settings'; ?>">Settings</a></li> 
   <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_logs'; ?>">Activity Logs</a></li> 
 </ul>
</div-->

<div id="content">
  <h1>MESSAGES </h1>
  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#Add_New">New Message</button>        
  <a href="#Draft_Messages" role="button" class="btn" data-toggle="modal">Draft Messages</a>  

  <!-- New Message-->
  <!--div class="modal fade" id="Add_New" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Create Message</h4>
        </div>
        <div class="modal-body">
          <p></p>
          <form id="compose" name="compose">       
            <table id="compose_table" >
              <tr>
                <label>To:</label>
              </tr><br/>
              <tr>  
                <!input type="text" id="receipients" name="receipients" class="form-control" placeholder="Enter Email Separated by Comma"style="width:200px" class="tm-input" multiple/>                     
                <div id="multiple-datasets">
                  <input class="typeahead form-control" type="text" placeholder="facility" data-provide="typeahead">
                </div>


              </tr><br/>    
              <tr>
                <label>Subject:</label>
              </tr><br/>
              <tr>                   
                <input id="subject" type="text" style="width:96%" />   
                <tr>
                  <label>Message:</label>
                </tr><br/>
                <tr>    
                  <textarea id="message" style="width:96%;" rows="10"></textarea>

                </tr> <br/>

              </table>
            </form>
          </div>        
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button id="save_message_btn" class="btn btn-primary">Send Message</button>
          </div>
        </div-->
        <div id="multiple-datasets">
          <input class="typeahead form-control" type="text" placeholder="facility" data-provide="typeahead">
        </div>
      </div>



      <script type="text/javascript">
      $(function() {   

       // var mySource = <?php echo $emails; ?>;
        /*var mySource = ['All DMLTs','Pending Sub-Counties','All SCMLTs','Pending Counties'];


        $('#receipients').typeahead({
          source: mySource,
            //display: 'email',            
          });


        //$('#receipients').tagsinput('items');
        var receipients = $(".tm-input").tagsManager({               
          replace:false,                              
          onlyTagList: true,  
          
        });



        
        $('#save_message_btn').click(function() {         


          var receipients = $( "form[name=compose]").serialize();        
          var subject = $( "#subject").val();
          var message = $( "#message").val(); 

          $.post("<?php echo base_url() . 'rtk_management/rtk_send_message'; ?>", {
            message: message,
            subject: subject,
            receipients: receipients,            
          }).done(function(data) {
            alert("Data Loaded: " + data);
            $('Add_New').modal('hide');
            window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_admin_messages'; ?>";
          });
        }); */
      });
</script>

