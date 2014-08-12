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
  <script src="<?php echo base_url().'assets/tagsinput/typeahead.jquery.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/tagsinput/bloodhound.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
  



<style type="text/css">
  
  #content{
   margin-top: -130px;   
   width: 85%;
   margin-left: 10%;
  }
</style>
   

<div id="content">
    <h1>MESSAGES </h1>
    <div id="message">
      <input class="typeahead form-control" type="text" placeholder="facility" data-provide="typeahead">

    </div>

  </div>
    



<script type="text/javascript">
    $(function() {   


      var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;
                // an array that will be populated with substring matches
                matches = [];
                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');
                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    // the typeahead jQuery plugin expects suggestions to a
                    // JavaScript object, refer to typeahead docs for more info
                    matches.push({ value: str });
                }
                });
                cb(matches);
            };
            };
            
            
        var messages = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('messages'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '../assets/scripts/typehead/json/messages.json'
        });
        
        messages.initialize();        

        $('.typeahead').typeahead({
        highlight: true
        },
        {
        name: 'category',
        displayKey: 'value',
        source: messages.ttAdapter(),
        templates: {
            header: '<h5 class="query-title">Facilities</h5>'
        }
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

