<style>
  thead{
    /*font-size: 10px;*/
  }
  .download_btn{
    margin: 10px 72.5%;
  }
  .btndef{
    width: 292px;
  }
</style>
<div class="container" style="width: 96%; margin: auto;">
<div class="col-md-12">
      <div class="page-error">
        <!-- <div class="error-details col-sm-6 download_btn">
          <a class="btn btn-default btn-primary btndef" href="<?php echo base_url().'reports/system_usage_graph'; ?>">View Graph</a>
        </div> -->
        <div class="error-details col-sm-6 download_btn">
          <a class="btn btn-default btn-primary btndef" href="<?php echo base_url().'reports/monitoring'; ?>">Download System Usage Statistics</a>
        </div>
    </div>

  </div>

 <table width="98%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">

      <thead>
        <tr>
          <th>Facility Name</th>
          <th>Facility Code</th>
          <th>Sub County</th>
          <th>County</th>
          <th>Date Last Logged In</th>
          <th>Days From Last Logged In</th>
          <th>Date Last Issued</th>
          <th>Days From Last Issue</th>
          <th>Date Last Redistributed</th>
          <th>Days From Last Redistribution</th>
          <th>Date Last Ordered</th>
          <th>Days From Last Order</th>
          <th>Date Last Decommissioned</th>
          <th>Days From Last Decommission</th>
          <th>Date Last Added Stock</th>
          <th>Days From Last Stock Addition</th>
        </tr>  
      </thead>                 
      <tbody>
        <?php 
        foreach ($temporary_system_usage as $key => $value) {?>
        <tr>
          <td><?php echo $value[0];?></td>
          <td><?php echo $value[1];?></td>
          <td><?php echo $value[2];?></td>
          <td><?php echo $value[3];?></td>
          <td><?php echo $value[4];?></td>
          <td><?php echo $value[5];?></td>
          <td><?php echo $value[6];?></td>
          <td><?php echo $value[7];?></td>
          <td><?php echo $value[8];?></td>
          <td><?php echo $value[9];?></td>
          <td><?php echo $value[10];?></td>
          <td><?php echo $value[11];?></td>
          <td><?php echo $value[12];?></td>
          <td><?php echo $value[13];?></td>
          <td><?php echo $value[14];?></td>
          <td><?php echo $value[15];?></td>
        </tr>
        <?php  }
        ?>
      </tbody>
    </table>
  </div>

  <script>
    $(document).ready(function() {
  //datatables settings 
  // alert("I work");return;
  $('#example').dataTable( {
     "sDom": "T lfrtip",
       "sScrollY": "377px",
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
  $('#example_filter label input').addClass('form-control');
  $('#example_length label select').addClass('form-control');
});
</script>




