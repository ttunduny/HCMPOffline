 <h1 class="page-header" style="margin: 0;font-size: 1.6em;">Expiries</h1>
 <div class="filter" style="width=device; height:auto; ">

 </div>

<div class="well">
  <div style="min-height: 400px;">
    <table  class="table table-hover table-bordered table-update" id="exp_datatable" >
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

        foreach ($expiry_data as $potential_exp ) { 

                $potential_exp[''];
                $formatdate = new DateTime($potential_exp['expiry_date']);
                $formated_date= $formatdate->format('d M Y');
                $total_units=$potential_exp['total_commodity_units'];
                $calculated=$potential_exp['current_balance'];
                $expired_packs=round($calculated/$total_units);
                $total_exp_cost=  $expired_packs*$potential_exp['unit_cost'];  
                
              
        
                ?>
        
            <tr>
              
              <td><?php echo $potential_exp['commodity_code']; ;?> </td>
              <td><?php echo $potential_exp['commodity_name'];?> </td>
              <td><?php echo $potential_exp['batch_no'];?> </td>
              <td><?php echo $potential_exp['manufacture'];?> </td>
              <td><?php echo $formated_date;?> </td>
              <td><?php echo $potential_exp['unit_size'];?> </td>
              <td><?php echo $expired_packs;?> </td>
              <td><?php echo $potential_exp['unit_cost'];?> </td>
              <td><?php echo $total_exp_cost;?> </td>
              
              
              
              
            </tr>
          <?php
                }
                      

          ?>  
     
    
   </tbody>
</table>
  </div>
	
</div>
<script type="text/javascript">
$(document).ready(function() {
	
	$('#datatable').dataTable( {
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