<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>

<style>
	 .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}
   .page-error .error-number {
      display: block;
      font-size: 158px;
      font-weight: 300;
      line-height: 128px;
      margin-top: 0;
      text-align: center;
      }

    .text-azure {
    color: #00bdcc;
    }

    .page-error {
    text-align: center;
    }
</style>
<div class="container">
  <div class="row">
    <div class="row">
        <div class="col-md-12">
          <div class="page-error">
            
            <div class="error-details col-sm-6 col-sm-offset-3">
              <a class="btn btn-default btn-primary" href="<?php echo base_url().'reports/monitoring'; ?>">Download System Usage Statistics</a>
            </div>
          </div>                
        </div>

      </div>
    </div>
            <br/>            
              <div id="reports_temp" style="width:120%;margin-left:-10%;">      
                  <br/>
                  <table id="system_usage_temp_table" class="data-table table cell-border"  cellspacing="0" width="100%" border="1px">
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
                      <th>Date Last Received Order</th>
                      <th>Days From Last Received Order</th>
                    </tr>                   
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
                  
                  </table>
             
                  

        </div>

        
    </div>

<script>
  $(document).ready(function() {
   $('#system_usage_temp_table').dataTable();
  $('.dataTables_filter label input').addClass('form-control');
  $('.dataTables_length label select').addClass('form-control');
</script