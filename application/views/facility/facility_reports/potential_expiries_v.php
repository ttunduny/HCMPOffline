 <h1 class="page-header" style="margin: 0;font-size: 1.6em;">Potential Expiries</h1>
 <div class="filter" style="width=device; height:auto; ">
<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-primary  btn-xs">
    <input type="radio" name="options" id="3months" class="optioncheck" value="3"> 3 Months
  </label>
  <label class="btn btn-primary btn-xs">
    <input type="radio" name="options" id="6months" checked="checked" class="optioncheck" value="6"> 6 Months
  </label>
  <label class="btn btn-primary btn-xs">
    <input type="radio" name="options" id="1year" class="optioncheck" value="12"> 1 Year
  </label>
</div>
 </div>

<div class="well">
  <div style="min-height: 400px;" id="reports_display">
    <table  class="table table-hover table-bordered table-update" id="potential_exp_datatable" >
  <thead style="background-color: white">
  <tr>
    <th>Commodity Code </th>
    <th>Commodity Description</th>
    <th>Batch No Affected</th>
    <th>Manufacturer</th>
    <th>Expiry Date</th>
    <th>Unit size</th>
    <th>Stock Expired (Packs)</th>
    <th>Unit Cost (KSH)</th>
    <th>Total Cost(KSH)</th>
  </tr>
  </thead>
      
    <tbody>
    
    <?php   

        foreach ($report_data as $potential_exp ) { 

          foreach($potential_exp->Code as $stock_commodity){
               
                $name=$stock_commodity->commodity_name;
                $commodity_code=$stock_commodity->commodity_code;
                $unitS=$stock_commodity->unit_size; 
                $unitC=$stock_commodity->unit_cost;
                $total_units=$stock_commodity->total_commodity_units;
                $calculated=$potential_exp->initial_quantity;
                $expired_packs=round($calculated/$total_units);
                $total_exp_cost=  $expired_packs*$unitC;             
                $formatdate = new DateTime($potential_exp->expiry_date);
                $formated_date= $formatdate->format('d M Y');
              
        
                ?>
        
            <tr>
              
              <td><?php echo $commodity_code;?> </td>
                <td><?php echo $name;?> </td>
              <td><?php echo  $potential_exp->batch_no;?></td>
              <td><?php echo $potential_exp->manufacture;?> </td>
              <td><?php echo $formated_date;?> </td>
              <td><?php  echo $unitS;?></td>
              <td><?php  echo $expired_packs; ?></td>
              <td><?php  echo $unitC;?></td>
              <td><?php  echo $total_exp_cost;?></td>
              
              
              
            </tr>
          <?php
                }
                        }

          ?>  
     
    
   </tbody>
</table>
  </div>
	
</div>
<script type="text/javascript">
$(document).ready(function() {

  $('.btn').button()

//  $(".optioncheck").click(function(){
   //   var url = "<?php echo base_url().'raw_data/stockchtml'?>";
     // var data=" ";
     // alert(data);
         // ajax_request (url);
  //  });

  

 $(".optioncheck").click(function() {
      
      var div="#reports_display";
      var url = "<?php echo base_url()."reports/potential_exp_process"?>";
      var data= $(this).val();
     
      ajax_post_process_data (url,div,data);
   
     
    });

   function ajax_post_process_data (url,div,data){
    var url =url;
     var loading_icon="<?php echo base_url().'assets/img/loader.gif' ?>";
     $.ajax({
          type: "POST",
          data:{'option_selected': data},
          url: url,
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin:20% 0 20% 30%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $(div).html("");
           $(div).html(msg);           
          }
        }); 
}
 

});


</script>