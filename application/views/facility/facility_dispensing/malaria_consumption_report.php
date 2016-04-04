<?php 	
//Pick values from the seesion 	
$facility_code=$this -> session -> userdata('facility_id');
$district_id=$this -> session -> userdata('district_id');
$county_id =$this -> session -> userdata('county_id'); 

?>
<style>
	.input-small{
		width: 100px !important;
	}
	.input-small_{
		width: 230px !important;
	}
</style>
<div class="row-fluid">
	
<h1 class="page-header" style="margin: 0;font-size: 1.6em;">Category Commodities Consumption</h1>
<div class="alert alert-info" style="width: 100%">
	<b>Proceed to Filter for Commodity Consumption by Category </b>
</div>

<div class="col-md-12" style="padding-left: 1%; right:0; float:right; margin-bottom:5px;margin-left:1%;">
	<select id="commodity_id" class="form-control" style="width:30%;float:left">
		<option value="">Select Commodity Category</option>
			<?php
			foreach($categories as $data):
				$commodity_name=$data->sub_category_name;	
				$commodity_id=$data->id;
				echo "<option value='$commodity_id'>$commodity_name</option>";
			endforeach;
			?>
	</select>
	
	<input type="text" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" id="from" placeholder="From">
	<input type="text" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" id="to" placeholder="To">

	<button class="btn btn-success" id="filter_consumption" style="float:left">
		<span class="glyphicon glyphicon-search"></span>Filter
	</button>
</div>
<div class="col-md-12">
	
<div id="graph_consumption" class="clearfix" style="border:1px solid #ccc;padding:1px;min-height:250px;height:auto;">	

</div>

<div id="graph_consumption_by_age" class="clearfix" style="border:1px solid #ccc;padding:1px;min-height:250px;margin-top:2%;height:auto;">	

</div>
<!-- <div class='graph-section' id='graph-section'></div> -->

<script>
	$(document).ready(function() 
	{

		var search_table = $('#search_results,.datatable').dataTable( {
	   "sDom": "T lfrtip",
	     "sScrollY": "150px",
	     "sScrollX": "100%",
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
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],

			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
		}
	} );

	$('#filter_consumption').click(function () {
		var category_id = $('#commodity_id').val();
		if(category_id==''){
			swal("Kindly select a Category to Filter");				
			return;
		}else{
			update_consumption_table(category_id);      
			generate_graph(category_id);      
		}		
    });

	function update_consumption_table(category_id){
		var from =$("#from").val();
        var to =$("#to").val();

        if(from==''){from="NULL";}
        if(to==''){to="NULL";}
			
		from = encodeURI(from);
		to = encodeURI(to);		
  		var url = "<?php echo base_url()."dispensing/consumption_ajax";?>";
  		var new_url = url+'/'+category_id;      
		$.ajax({
        type: "POST",
        url: new_url,
        data:{'from':from,'to':to},       
        success: function(msg) {
        	// console.log(msg);return;
      	$('#graph_consumption').html(msg);
      	$('#ajax_commodity_table').dataTable();
       		
      	},
        error: function() {
            alert('Error occured');
        }
    });

    }//end of update history table

     function generate_graph(category_id){
		var from =$("#from").val();
        var to =$("#to").val();

        if(from==''){from="NULL";}
        if(to==''){to="NULL";}
			
		from = encodeURI(from);
		to = encodeURI(to);		
  		var purl = "<?php echo base_url()."dispensing/get_consumption_chart_ajax";?>";      
  		var url = purl+'/'+category_id;
		$.ajax({
        type: "POST",
        url: url,
        data:{'commodity_id': null,'from':from,'to':to},       
        success: function(msg) {
        	// console.log(msg);return;
      	$('#graph_consumption_by_age').html(msg);
      	// $('#ajax_commodity_table').dataTable();
       		
      	},
        error: function() {
            alert('Error occured');
        }
    	});
	}
	});
</script>