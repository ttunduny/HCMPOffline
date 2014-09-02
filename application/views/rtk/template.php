<html lang="en"><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">   
        <!-- Bootstrap core CSS -->   
        <link rel="icon" href="<?php echo base_url() . 'assets/img/coat_of_arms.png' ?>" type="image/x-icon" />
        <link href="<?php echo base_url() . 'assets/css/style.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/dashboard.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/boot-strap3/css/bootstrap.min.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/boot-strap3/css/bootstrap-responsive.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/normalize.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/jquery-ui-1.10.4.custom.min.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/font-awesome.min.css' ?>" type="text/css" rel="stylesheet"/>
        <script src="<?php echo base_url() . 'assets/scripts/jquery-1.8.0.js' ?>" type="text/javascript"></script>
        <link href="<?php echo base_url() . 'assets/datatable/TableTools.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/datatable/dataTables.bootstrap.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/font-awesome.min.css' ?>" type="text/css" rel="stylesheet"/>
        <script src="<?php echo base_url() . 'assets/scripts/jquery.js' ?>" type="text/javascript"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
        <script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>


        <title>HCMP | <?php echo $title; ?></title>

        <style>
            .active-panel{
                border-left: 6px solid #36BB24;
            }
        </style>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </script>
    </head>
<body screen_capture_injected="true" style="">

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img style="display:inline-block;" src="<?php echo base_url(); ?>assets/img/coat_of_arms-resized1.png" class="img-responsive " alt="Responsive image">
                <div id="" style="display:inline-block;">
                    <span style="font-size: 0.95em;font-weight: bold; ">Ministry of Health</span><br />
                    <span style="font-size: 0.85em;">Health Commodities Management Platform (HCMP)</span>	
                </div>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right" >
                    <li><a class="" href="<?php echo site_url() . 'Home'; ?>" >HOME</a> </li>   
                    <?php
//Retrieve all accessible menus/submenus from the session
                    $menus = $this->session->userdata('menus');
                    $sub_menus = $this->session->userdata('sub_menus');
//Loop through all menus to display them in the top panel menu section
                    foreach ($menus as $menu) {
                        ?>
                        <li class="">
                            <a href="<?php echo site_url($menu['menu_url']); ?>" id="sub" class=""><?php echo $menu['menu_text']; ?></a>           	
                            <ul  class="dropdown-menu" style="min-width: 0">           		
                                <?php
                                foreach ($sub_menus as $sub_menu) {
                                    if ($menu['menu_id'] == $sub_menu['menu_id']) {
                                        ?>

                                        <li><a style="background: whitesmoke;color: black !important" class="" href="<?php echo $sub_menu['submenu_url'] ?>">
                                                <?php echo $sub_menu['submenu_text'] ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>

                        <?php
                    }
                    ?>
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" ></span><?php echo $this->session->userdata('full_name'); ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                           <li><a style="background: whitesmoke;color: black !important" href="" data-toggle="modal" data-target="#changepassModal"><span class="glyphicon glyphicon-pencil" style="margin-right: 2%; "></span>Change password</a></li>               
                            <!--li><a style="background: whitesmoke;color: black !important" href="#" data-toggle="modal" data-target="#Change_Password"><span class="glyphicon glyphicon-pencil" style="margin-right: 2%;"></span>Change password</a></li-->                
                            <li><a style="background: whitesmoke;color: black !important" href="<?php echo site_url("user/logout"); ?>" ><span class="glyphicon glyphicon-off" style="margin-right: 2%;"></span>Log out</a></li>               
                        </ul>
                    </li>
                </ul>         
            </div>
        </div>

    </div>   
    <div class="container-fluid" style="margin-top: 2%;">
        <div class="" style="padding:0;border-radius: 0;margin-top: -2% ">
            <h1 class="page-header" style="margin: 0;font-size: 1.3em;"><?php echo $banner_text; ?></h1>
            <?php $this->load->view($content_view); ?>
        </div>
    </div>
    <div id="footer">
        <div class="container">
            <p class="text-muted"> Government of Kenya &copy <?php echo date('Y'); ?>. All Rights Reserved</p>
        </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
       /* var url = '<?php echo base_url(); ?>';
        $('#change_password_table').tablecloth({theme: "paper",         
              bordered: true,
              condensed: true,
              striped: true,
              sortable: true,
              clean: true,
              cleanElements: "th td",
              customClass: "my-table"
            });
        $('#change_password_btn').click(function() {         
          var old_pass = $('#old_pass').val();
          var new_pass = $('#new_pass').val();
          var confirm_pass = $('#confirm_pass').val();
          var user_id = $('#user_id').val();          

          $.post("<?php echo base_url() . 'user/change_password'; ?>", {
            old_pass: old_pass,
            new_pass: new_pass,            
            confirm_pass: confirm_pass,
            user_id :user_id,            
          }).done(function(data) {
            alert(data);
            $('Change_Password').modal('hide');
            //window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_admin_settings'; ?>";
          });
        }); */
    </script>
    <script src="<?php echo base_url() . 'assets/datatable/jquery.dataTables.min.js' ?>" type="text/javascript"></script>	
    <script src="<?php echo base_url() . 'assets/datatable/dataTables.bootstrap.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/datatable/TableTools.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/datatable/ZeroClipboard.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/datatable/dataTables.bootstrapPagination.js' ?>" type="text/javascript"></script>

    <script src="<?php echo base_url() . 'assets/scripts/jquery-ui-1.10.4.custom.min.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/scripts/highcharts.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/scripts/exporting.js' ?>" type="text/javascript"></script>  
    <script src="<?php echo base_url() . 'assets/boot-strap3/js/bootstrap.min.js' ?>" type="text/javascript"></script>	
    <script type="text/javascript" src="<?php echo base_url() . 'assets/scripts/jquery.loadingbar.js' ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/loadingbar.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/elusive-webfont.css' ?>" />
    <div id="window-resizer-tooltip" style="display: none;"><a href="#" title="Edit settings" style="background-image: url(chrome-extension://kkelicaakdanhinjdeammmilcgefonfh/images/icon_19.png);"></a><span class="tooltipTitle">Window size: </span><span class="tooltipWidth" id="winWidth">1366</span> x <span class="tooltipHeight" id="winHeight">768</span><br><span class="tooltipTitle">Viewport size: </span><span class="tooltipWidth" id="vpWidth">1366</span> x <span class="tooltipHeight" id="vpHeight">449</span></div></body></html>

    <!-- Modal -->
<div class="modal fade" id="changepassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 35%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
        
      <div class="modal-body">
        <div id="login" >

    <div class= "row">
        <div class="col-md-11" >    
  <div class="form-group" style="margin-top: 2.3em;">
    <label for="exampleInputpassword1">Old\Current Password </label>
    
    <input type="password" class="form-control input-lg" name="current_password" id="current_password" placeholder="Current Password" required="required">
    
  </div>
  </div>
  <div class="col-md-1" style="padding-left: 0;"></div>
  </div>

    <div class= "row">
        <div class="col-md-11" >    
  <div class="form-group" style="margin-bottom: 2em;">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" class="form-control input-lg" name="new_password" id="new_password" placeholder="New Password" required="required">
  </div>
  </div>
  <div class="col-md-1" style="padding-left: 0;"><span class="error" id="result" style="margin-top: 50% !important;"></span></div>
  </div>

    <div class="row">
    <div class="col-md-11" >    
  <div class="form-group" >
    <label for="exampleInputPassword1">Confirm New Password</label>
    <input type="password" class="form-control input-lg" name="new_password_confirm" id="new_password_confirm" placeholder="Confirm Password" required="required">
  </div>
  </div>
  <div class="col-md-1" style="padding-left: 0;"><span class="error" id="confirmerror" style="padding-top: 60%;"></span></div>
  
  </div>
  <div class="row">
    <div class="col-md-12">
        <div class="form-group" >
    <div id="new_error"></div>
  </div>
    </div>
  </div>
  
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success" id="change">Save changes</button>
        
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        
        $('#new_password').keyup(function() {
            $('#result').html(checkStrength($('#new_password').val()))
        })
        
        $('#new_password_confirm').keyup(function() {
            var newps = $('#new_password').val()
            var newpsconfirm = $('#new_password_confirm').val()
            
            if(newps!= newpsconfirm){
                        
                         $('#confirmerror').html('Your passwords dont match');
                             $('#change').prop('disabled', true);
                            }else{
                                $('#change').prop('disabled', false);
                                $("#confirmerror").empty();
                                $('#confirmerror').html('Your passwords match');
                                $('#confirmerror').addClass('successtext')
                                
                                
                            }
        })
        function checkStrength(password) {

            //initial strength
            var strength = 0

            //if the password length is less than 6, return message.
            if (password.length < 6) {
                $('#result').removeClass()
                $('#result').addClass('short')
                return 'Too short'
            }

            //length is ok, lets continue.

            //if length is 8 characters or more, increase strength value
            if (password.length > 7)
                strength += 1

            //if password contains both lower and uppercase characters, increase strength value
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))
                strength += 1

            //if it has numbers and characters, increase strength value
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))
                strength += 1

            //if it has one special character, increase strength value
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))
                strength += 1

            //if it has two special characters, increase strength value
            if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/))
                strength += 1

            //now we have calculated strength value, we can return messages

            //if value is less than 2
            if (strength < 2) {
                $('#result').removeClass()
                $('#result').addClass('weak')
                $("#result").css("color","#BE2E21")
                return 'Weak'
            } else if (strength == 2) {
                $('#result').removeClass()
                $('#result').addClass('good')
                $("#result").css("color","#006633")
                
                return 'Good'
            } else {
                $('#result').removeClass()
                $('#result').addClass('strong')
                $("#result").css("color","#003300")
                return 'Strong'
            }
        }
        
        
        $('#change').click(function(){
            var url = "<?php echo base_url()."user/save_new_password";?>";
            
             $.ajax({
                type: $('#change').attr('method'),

                    url:url,
                    type: "POST",
                    async:false,
                    cache:"false",
                    data:{ 'current_password': $('#current_password').val(),'new_password_confirm': $('#new_password_confirm').val()},
                    dataType:'json',
                    beforeSend:function(){
                         $("#new_error").html("Processing...");
                    },
                    complete:function(){
                        
                    },
                    success: function(data){
                        console.log($('#current_password').val())
                        console.log(data)
                        //return;
                        //response = jQuery.parseJSON(data);
                    if(data.response=='false'){
                        
                         $('#new_error').html(data.msg);
                            $( "#current_password" ).focus();
                            }else if(data.response=='true'){
                                $("#new_error").empty();
                                $("#current_password").val('');
                                $("#new_password_confirm").val('');
                                $("#new_password").val('');
                                
                                $('#new_error').html('Your Password has been Changed Successfully. You will Be Redirected Shortly');
                                window.location = "<?php echo base_url() . 'home_controller'; ?>";
                                
                            }

                        }
    
                            
    });

    return false;
    });
        
 });
 
        </script>
