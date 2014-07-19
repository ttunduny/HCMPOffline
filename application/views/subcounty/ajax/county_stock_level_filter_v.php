<div class="alert alert-info" style="width: 100%">
  <b>Below are the Stocking Levels in the County </b> :Select filter Options
</div>

<ul class='nav nav-tabs'>
	  <li class="active"><a href="#tracer" data-toggle="tab">Tracer Items <?php echo " ($number_of_tracer_items)"; ?></a></li>
      <li class=""><a href="#division" data-toggle="tab">Program Commodities</a></li>
      <!--<li class=""><a href="#cat" data-toggle="tab">Categories</a></li>-->
      <li class=""><a href="#county" data-toggle="tab">County View</a></li>
      <li class=""><a href="#subcounty" data-toggle="tab">Sub County View</a></li>
</ul>
    <div id="myTabContent" class="tab-content">
 
      <div  id="tracer" class="tab-pane fade active in">
              <br>
          <form class="form-inline" role="form">
    <select id="tracer_district_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Sub-county</option>
<?php
foreach($district_data as $district_):
        $district_id=$district_->id;
        $district_name=$district_->district;    
        echo "<option value='$district_id'>$district_name</option>";
endforeach;
?>
</select> 

<select id="tracer_facility_filter" class="form-control col-md-3">
<option value="NULL">Select facility</option>
</select>	
<select id="tracer_plot_value_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Plot value</option>
<option value="packs">Packs</option>
<option value="units">Units</option>
<option value="ksh">KSH</option>
<option value="mos">Months of stock</option>
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-success tracer-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success tracer-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
</div>
          </form>
      </div>
      <div  id="division" class="tab-pane fade">
      <br>
      <form class="form-inline" role="form">
	      	<select id="division_district_filter" class="form-control col-md-2">
				<option selected="selected" value="NULL">Select Sub-county</option>
				<?php
				foreach($district_data as $district_):
				        $district_id=$district_->id;
				        $district_name=$district_->district;    
				        echo "<option value='$district_id'>$district_name</option>";
				endforeach;
				?>
			</select>
			<select id="division_facility_filter" class="form-control col-md-3">
				<option value="NULL">Select Facility</option>
			</select>  
		    <select id="division_name_filter" class="form-control col-md-2">
				<option selected="selected" value="NULL">Select Division</option>
				<?php
				foreach($division_commodities as $division_):
				        $division_id=$division_->id;
				        $division_name=$division_->division_name;    
				        echo "<option value='$division_id'>$division_name</option>";
				endforeach;
				?>
			</select>
			<select id="division_plot_value_filter" class="form-control col-md-2">
				<option selected="selected" value="NULL">Select Plot value</option>
				<option value="packs">Packs</option>
				<option value="units">Units</option>
				<option value="ksh">KSH</option>
				<option value="mos">Months of stock</option>
			</select>
			<div class="col-md-1">
				<button class="btn btn-sm btn-success division-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
			</div>
			<div class="col-md-1">
				<button class="btn btn-sm btn-success division-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
			</div>
      </form>
      </div>
  <!-- <div  id="cat" class="tab-pane fade">
<br>
<div class="filter row">
<form class="form-inline" role="form">
       	<select id="category_filter" class="form-control col-md-3">
<option value="NULL">Select Commodity Category</option>
<?php
foreach($categories as $data):
		$commodity_name=$data->sub_category_name;	
		$commodity_id=$data->id;
		echo "<option value='$commodity_id'>$commodity_name</option>";
endforeach;
?>
</select> 
	<select id="category_district_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Sub-county</option>
<?php
foreach($district_data as $district_):
		$district_id=$district_->id;
		$district_name=$district_->district;	
		echo "<option value='$district_id'>$district_name</option>";
endforeach;
?>
</select> 
<select id="category_facility_filter" class="form-control col-md-3">
<option value="NULL">Select facility</option>
</select>	
<select id="category_plot_value_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Plot value</option>
<option value="packs">Packs</option>
<option value="units">Units</option>
<option value="ksh">KSH</option>
<option value="mos">Months Of Stock</option>
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-success category-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success category-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
</div>	
   </form>
      </div>
   
   </div>-->
      <div  id="county" class="tab-pane fade in">
      	<br>
<div class="filter row">
<form class="form-inline" role="form">
<select id="county_commodity_filter" class="form-control col-md-3">
<option value="NULL">Select Commodity</option>
<?php
foreach($c_data as $data):
		$commodity_name=$data['commodity_name'];	
		$commodity_id=$data['id'];
		echo "<option value='$commodity_id'>$commodity_name</option>";
endforeach;
?>
</select>		
<select id="county_plot_value_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Plot value</option>
<option value="packs">Packs</option>
<option value="units">Units</option>
<option value="ksh">KSH</option>
<option value="mos">Months Of Stock</option>
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-success county-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success county-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
</div>
</form>
</div>
</div>
      <div  id="subcounty" class="tab-pane fade in">
      	<br>
<div class="filter row">
<form class="form-inline" role="form">
<select id="subcounty_commodity_filter" class="form-control col-md-3">
<option value="NULL">Select Commodity</option>
<?php
foreach($c_data as $data):
		$commodity_name=$data['commodity_name'];	
		$commodity_id=$data['id'];
		echo "<option value='$commodity_id'>$commodity_name</option>";
endforeach;
?>
</select>	
	<select id="subcounty_district_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Sub-county</option>
<?php
foreach($district_data as $district_):
		$district_id=$district_->id;
		$district_name=$district_->district;	
		echo "<option value='$district_id'>$district_name</option>";
endforeach;
?>
</select> 
<select id="subcounty_facility_filter" class="form-control col-md-3">
<option value="NULL">Select facility</option>
</select>	
<select id="subcounty_plot_value_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Plot value</option>
<option value="packs">Packs</option>
<option value="units">Units</option>
<option value="ksh">KSH</option>
<option value="mos">Months Of Stock</option>
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-success subcounty-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success subcounty-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
</div>
</form>
</div>
</div>
</div>
<div class="graph_content" id="graph_default">	
	
</div>

<script>
	 $(function () { 
<?php echo $default_graph; ?>
});
	$(document).ready(function() {

		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          $('.graph_content').html('');
          
          })
		$("#subcounty_facility_filter,#category_facility_filter,#tracer_facility_filter,#division_commodity_filter,#division_facility_filter").hide();
		$("#subcounty_district_filter").change(function() {
		var option_value=$(this).val();
		
		if(option_value=='NULL'){
			$("#subcounty_facility_filter").hide('slow');	
		}
		else{
			var drop_down='';
		 	var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+option_value;
		  	$.getJSON( hcmp_facility_api ,function( json ) {
		     	$("#subcounty_facility_filter").html('<option value="NULL" selected="selected">--select facility--</option>');
		      	$.each(json, function( key, val ) {
			      	drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>";	
			      });
			      $("#subcounty_facility_filter").append(drop_down);
			    });
				$("#subcounty_facility_filter").show('slow');		
		}
		});	
		$("#category_district_filter").change(function() {
		var option_value=$(this).val();
		if(option_value=='NULL'){
		$("#category_facility_filter").hide('slow');	
		}
		else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+option_value;
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#facility_filter").html('<option value="NULL" selected="selected">--select facility--</option>');
      $.each(json, function( key, val ) {
      	drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>";	
      });
      $("#category_facility_filter").append(drop_down);
    });
		$("#category_facility_filter").show('slow');		
		}
		});			

		$("#tracer_district_filter").change(function() {
		var option_value=$(this).val();
		if(option_value=='NULL'){
		$("#tracer_facility_filter").hide('slow');	
		}
		else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+option_value;
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#tracer_facility_filter").html('<option value="NULL" selected="selected">--select facility--</option>');
      $.each(json, function( key, val ) {
      	drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>";	
      });
      $("#tracer_facility_filter").append(drop_down);
    });
		$("#tracer_facility_filter").show('slow');		
		}
		});		
		
		//Divion District filter
		$("#division_district_filter").change(function() {
		var option_value=$(this).val();
		if(option_value=='NULL'){
		$("#division_facility_filter").hide('slow');	
		}
		else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+option_value;
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#division_facility_filter").html('<option value="NULL" selected="selected">--Select Facility--</option>');
      $.each(json, function( key, val ) {
      	drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>";	
      });
      $("#division_facility_filter").append(drop_down);
    });
		$("#division_facility_filter").show('slow');		
		}
		});	
		//Tracer Filter Button
		$(".tracer-filter").button().click(function(e) {
        e.preventDefault();
        var url_ = "reports/get_county_stock_level_new/"+"NULL/"+"NULL/"+
        $("#tracer_district_filter").val()+"/"+
        $("#tracer_facility_filter").val()+"/"+
        $("#tracer_plot_value_filter").val()+
        "/NULL";
        ajax_request_replace_div_content(url_,'.graph_content');    
          });
          
          //Division button filter
          $(".division-filter").button().click(function(e) {
	        e.preventDefault();
	        var url_ = "reports/get_division_commodities_data/"+
	        $("#division_district_filter").val()+"/"+
	        $("#division_facility_filter").val()+"/"+
	        $("#division_name_filter").val()+"/"+
	        $("#division_plot_value_filter").val()+
	        "/NULL";
	        
	        ajax_request_replace_div_content(url_,'.graph_content');    
          });
          
         $(".tracer-download").button().click(function(e) {
        e.preventDefault(); 
        var url_ = "reports/get_county_stock_level_new/"+"NULL/"+"NULL/"+
        $("#tracer_district_filter").val()+"/NULL/"+$("#tracer_plot_value_filter").val()+"/csv_data";   
         window.open(url+url_ ,'_blank');   
          });
          
          $(".division-download").button().click(function(e) {
        e.preventDefault(); 
        var url_ = "reports/get_division_commodities_data/"+
		$("#division_name_filter").val()+"/"+$("#division_district_filter").val()+"/"+$("#division_facility_filter").val()+"/"+$("#division_plot_value_filter").val()+"/csv_data";   
         window.open(url+url_ ,'_blank');   
          });
   
		$(".county-filter").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
$("#county_commodity_filter").val()+"/NULL/NULL/NULL/"+$("#county_plot_value_filter").val();	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });
          
         $(".county-download").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
$("#county_commodity_filter").val()+"/NULL/NULL/NULL/"+$("#county_plot_value_filter").val()+"/csv_data";	
		 window.open(url+url_ ,'_blank');	
          });
          
         $(".subcounty-filter").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
$("#subcounty_commodity_filter").val()+"/NULL/"+$("#subcounty_district_filter").val()+"/"+ $("#subcounty_facility_filter").val()+"/"+$("#subcounty_plot_value_filter").val();	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });
        $(".subcounty-download").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
$("#subcounty_commodity_filter").val()+"/NULL/"+$("#subcounty_district_filter").val()+"/"+ $("#subcounty_facility_filter").val()+"/"+$("#subcounty_plot_value_filter").val()+"/csv_data";	
		 window.open(url+url_ ,'_blank');	
          });
          
$(".category-filter").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
"NULL/"+$("#category_filter").val()+"/"+$("#category_district_filter").val()+"/"+ $("#category_facility_filter").val()+"/"+$("#category_plot_value_filter").val();	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });
          
        $(".category-download").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
"NULL/"+$("#category_filter").val()+"/"+$("#category_district_filter").val()+"/"+ $("#category_facility_filter").val()+"/"+$("#category_plot_value_filter").val()+"/csv_data";	
		 window.open(url+url_ ,'_blank');	
          });
          
$(".general_stock_info").on(function(e)
	 {	
	 	e.preventDefault();	
        var url_ = 'evaluation/analysis/'+$("#sub_county_filter").val();

		ajax_request_replace_div_content(url_,'.graphs');		
           });
	
          		
		});
</script>