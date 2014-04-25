<div class="container-fluid" style="">
      <div class="row row-offcanvas row-offcanvas-right" id="sidebar" >
        <p class="pull-left visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Click to view Side Menu</button>
          </p>
        <div class="col-sm-3 col-md-2 sidebar-offcanvas"  id="bar" role="navigation" style="margin-left:0.5%">
      <?php $this -> load -> view($sidebar);?>
        </div>
        
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 " style="padding:0;border-radius: 0 ">
         <?php 
         $this -> load -> view($report_view);
         	?>
         	<div class='graph-section' id="graph-section"></div>
			
         
        </div>
      </div>
    </div>
<script>

      $(document).ready(function () {
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });
  
 	$(window).resize(function() 
 	{
	    if (($(window).width() < 768))
	    {
	        $( ".col-md-2,.col-md-10" ).css( "position", "" );
	    };
	});
	
	$(function() 
	{
		$("#consumption").click(function()
		{
			var url = "<?php echo base_url().'reports/consumption_data/'?>";	
			ajax_request_special(url,'.graph-section');	
		});	    
	         
	   function ajax_request_special(url,checker)
	   {
	   	var url = url;
		var checker = checker;
		var loading_icon = "<?php echo base_url().'assets/img/loadfill.gif' ?>";
		 $.ajax({
		 		type: "POST",
	          	url: url,
	          	beforeSend: function() 
	          	{
	          		if(checker==".graph-section")
	          		{
	          			$(".graph-section").html("<img style='margin-left:20%;' src="+loading_icon+">");	
	          		}else
	          		{
	          	 		$('.graph-section').html("");	
	          		}
	
	          	},
	          success: function(msg) 
	          {
	          	if(checker==".graph-section")
	          	{
	          		$(".graph-section").html(""); 	
	          		$(".graph-section").html(msg); 
	          
	          	}
	          
	
	          }
	        }); 
		}
	});	  
$('#exp_datatable,#potential_exp_datatable,#potential_exp_datatable2').dataTable( {
     "sDom": "T lfrtip",
  
       "sScrollY": "377px",
       
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
            "oTableTools": {
                 "aButtons": [
        "copy",
        "print",
        {
          "sExtends":    "collection",
          "aButtons":    [ "csv", "xls", "pdf" ]
        }
      ],
      "sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
    }
  } ); 
    

});
    </script>