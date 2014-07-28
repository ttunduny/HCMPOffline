
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/bootstrap-typeahead.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/tagmanager.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Scripts/css/tagmanager.css">



<style type="text/css">
  
  #content{
   margin-top: -130px;   
   width: 85%;
   margin-left: 10%;
  }
</style>
   
<div class="tabbable tabs-left" style="font-size:147%;">
  <ul class="nav nav-tabs">
   <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_admin'; ?>">Users</a></li>
   <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_admin_messages'; ?>">Messages</a></li>
   <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_admin_settings'; ?>">Settings</a></li> 
   <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_logs'; ?>">Activity Logs</a></li> 
 </ul>
</div>

<div id="content">
    <h1>MESSAGES </h1>
    
    <a href="#Add_New" role="button" class="btn" data-toggle="modal">New Message</a> 
    <a href="#Draft_Messages" role="button" class="btn" data-toggle="modal">Draft Messages</a>  

    <!-- New Message-->
    <div id="Add_New" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     
        <div class="modal-header">          
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h2 id="myModalLabel">Create Message</h2>

        </div>
        <div class="modal-body">
            <p></p>
            <form id="compose" name="compose">       
                <table id="compose_table" >
                  <tr>
                    <label>To:</label>
                  </tr><br/>
                  <tr>
                    <input type="email" id="receipients" name="receipients" placeholder="Enter Email Separated by Comma" style="width:96%" data-items="5" class="tm-input" multiple/>                                                                                                                                                                                     
                      
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
    </div>
</div>



<script type="text/javascript">
    $(function() {   

        var mySource = <?php echo $emails; ?>;
        //var mySource = ['All DMLTs','Pending Sub-Counties','All SCMLTs','Pending Counties'];

       
       $('#receipients').typeahead({
            source: mySource,
            display: 'name',            
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
        }); 
    });
</script>

