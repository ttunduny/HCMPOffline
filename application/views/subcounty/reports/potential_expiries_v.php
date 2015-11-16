
  <div style="min-height: 400px;" id="reports_display">
    <table  class="table table-hover table-bordered table-update" id="potential_exp_datatable" >
  <thead style="background-color: white">
  <tr>
    <th>Commodity Description</th>
    <th>Commodity Code </th>
    <th>Batch No Affected</th>
    <!-- <th>Manufacturer</th> -->
    <th>Expiry Date</th>
    <th># Days to Expiry</th>
    <th>Unit size</th>
    <!-- <th>Stock Expired (Packs)</th> -->
    <!-- <th>Stock Expired (Units)</th> -->
    <th>Unit Cost (KSH)</th>
    <th>Total Cost(KSH)</th>
  </tr>
  </thead>
      
    <tbody>
    
    <?php   
       $total=0;        
        foreach ($report_data as $key=>$potential_exp ) { 

          // foreach($potential_exp->Code as $potential_exp){
               
                $name=$potential_exp['commodity_name'];
                $commodity_code=$potential_exp['commodity_code'];
                $unitS=$potential_exp['unit_size']; 
                $unitC=$potential_exp['unit_cost'];
                $total_units=$potential_exp['total_commodity_units'];
                $calculated=$potential_exp['current_balance'];
                $total_cost=$potential_exp['total_cost'];                
                // $expired_packs=round($calculated/$total_units,1);
                // $total_exp_cost=  $expired_packs*$unitC;             
                $formatdate = new DateTime($potential_exp['expiry_date']);
                $formated_date= $formatdate->format('d M Y');
				        $ts1 = strtotime(date('d M Y'));
                $ts2 = strtotime(date($potential_exp->expiry_date));
                $seconds_diff = $ts2 - $ts1;
				$total_cost=$total+ $total_cost;
                ?>       
            <tr>
              <td><?php  echo $name;?> </td>
              <td><?php  echo $commodity_code;?> </td>
              <td><?php  echo $potential_exp['batch_no'];?></td>
              <!-- <td><?php  //echo $potential_exp['manufacture'];?> </td> -->
              <td><?php  echo $formated_date;?> </td>
              <td><?php  echo $potential_exp['days_to_expire'];?> </td>
              <td><?php  echo $unitS;?></td>
              <!-- <td><?php  echo $expired_packs; ?></td> -->
              <!-- <td><?php  echo $calculated; ?></td> -->
              <td><?php  echo $unitC;?></td>
              <td><?php  echo number_format($total_cost, 2, '.', ',');?></td>
            </tr>
          <?php } echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        
          <td>Total</td>
          <td>".number_format($total_cost, 2, '.', ',')."</td></tr>";
          ?>  
     
    
   </tbody>
</table>
  </div>
	
