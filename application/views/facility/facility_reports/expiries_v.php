 <h1 class="page-header" style="margin: 0;font-size: 1.6em;">Expiries</h1>
 <div class="filter" style="width=device; height:auto; ">

 </div>

<div class="well">
  <div style="min-height: 400px;">
    <table class="table table-bordered table-hover">
  
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
  
      
    <tbody>
    
    <?php   

        foreach ($report as $potential_exp ) { 

          foreach($potential_exp->Code as $stock_commodity){
               
                $name=$stock_commodity->commodity_name;
                $commodity_code=$stock_commodity->commodity_code;
                $unitS=$stock_commodity->unit_size; 
                $unitC=$stock_commodity->unit_cost;
                $total_units=$stock_commodity->total_commodity_units;
                $calculated=$potential_exp->current_balance;
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