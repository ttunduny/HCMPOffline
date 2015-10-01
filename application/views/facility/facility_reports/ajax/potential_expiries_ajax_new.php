<div style="min-height: 400px;" id="reports_display">
   <table  class="table table-hover table-bordered table-update" id="potential_exp_datatable2" >
  <thead style="background-color: white">
  <tr>
    <th>Commodity Description</th>
    <th>Commodity Code </th>
    <th>Batch No Affected</th>
    <th>Manufacturer</th>
    <th>Expiry Date</th>
    <th># Days to Expiry</th>
    <th>Unit size</th>
    <th>Stock Expired (Packs)</th>
    <th>Stock Expired (Units)</th>
    <th>Unit Cost (KSH)</th>
    <th>Total Cost(KSH)</th>
  </tr>
  </thead>
      
    <tbody>
      <?php 
      $total_cost = 0;
      foreach ($report_data as $data) {
        $pack_balance = round($data['current_balance']/$data['total_commodity_units'],1);
        $seconds_diff = strtotime($data['expiry_date'])-strtotime(date("Y-m-d"));
        $total = $data['unit_cost']*$pack_balance;
        $total_cost = $total_cost + $total;
        ?>
          <tr>
            <td><?php echo $data['commodity_name']; ?></td>
            <td><?php echo $data['commodity_code']; ?></td>
            <td><?php echo $data['batch_no']; ?></td>
            <td><?php echo $data['manufacture']; ?></td>
            <td><?php echo $data['expiry_date']; ?></td>
            <td><?php echo floor($seconds_diff/3600/24);?></td>
            <td><?php echo $data['unit_size']; ?></td>
            <td><?php echo $pack_balance; ?></td>
            <td><?php echo $data['current_balance']; ?></td>
            <td><?php echo $data['unit_cost']; ?></td>
            <td><?php echo number_format($total, 2, '.', ','); ?></td>
          </tr>
      <?php } ?>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><b>Total Cost</b></td>
        <td><?php echo number_format($total_cost, 2, '.', ','); ?></td>
      </tr>
   </tbody>
</table>
  </div>
  <script>
      $(document).ready(function () {
	$('.dataTables_filter label input').addClass('form-control');
	$('.dataTables_length label select').addClass('form-control');
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
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
        }
      ],
      "sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
    }
  }); 

});
    </script>