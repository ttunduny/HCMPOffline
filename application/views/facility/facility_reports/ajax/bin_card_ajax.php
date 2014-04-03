 <div style="min-height: 400px;">
    <table  class="table table-hover table-bordered table-update" id="" >
  <thead style="background-color: white">
  <tr>
    <th>Date of Issue</th>
    <th>Reference No/S11 No</th>
    <th>Commodity Unit Size</th>
    <th>Batch No</th>
    <th>Expiry Date</th>
    <th>Receipts/Opening Bal.</th>
    <th>ADJ</th>
    <th>Issues</th>
    <th>Closing Bal.</th>
    <th>Service Point</th>
    <th>Issuing/Receiving Officer</th>
    
    
  </tr>
  </thead>
      
    <tbody>
    
     <?php   
             foreach ($bin_card as $bin ) { 

                $bin['unit_size'];
                $formatdate = new DateTime($bin['date_issued']);
                $formated_date= $formatdate->format('d M Y');
                $bin['batch_no'];
                $calculated=$bin['current_balance'];
                $bin['balance_as_of'];
                $bin['adjustmentnve'];
                $bin['adjustmentpve'];
                $bin['qty_issued'];
                $bin['fname'];
                $bin['lname'];
                $bin['service_point_name'];  
                
       
                
              
        
                ?>
        
            <tr>
              
              <td><?php //echo $potential_exp['commodity_code']; ;?> </td>
              <td><?php //echo $potential_exp['commodity_code']; ;?> </td>
              <td><?php echo $bin['unit_size'];?> </td>
              <td><?php echo $bin['batch_no'];?> </td>
              <td><?php //echo $potential_exp['manufacture'];?> </td>
              <td><?php// echo $formated_date;?> </td>
              <td><?php// echo $potential_exp['unit_size'];?> </td>
              <td><?php //echo $expired_packs;?> </td>
              <td><?php //echo $potential_exp['unit_cost'];?> </td>
              <td><?php echo $bin['service_point_name']; ?> </td>
              <td><?php echo $bin['fname'].' '.$bin['lname'];?> </td>
              
              
              
              
            </tr>
          <?php
               }
                      

          ?>  
     
    
   </tbody>
</table>
  </div>
  <script type="text/javascript">
$(document).ready(function() {


 $(".optioncheck").change(function() {
      
      var div="#reports_display";
      var url = "<?php echo base_url()."reports/stock_control_ajax"?>";
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