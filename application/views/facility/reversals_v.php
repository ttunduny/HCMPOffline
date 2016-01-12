<div class="row" style="margin-top: 1%;margin-left:2%;width:88%;">
  <div class="col-md-12">     
    <ul class="nav nav-tabs" id="myTab">
      <li class="active"><a href="#issues" data-toggle="tab">Current Issues</a></li>
      <li ><a href="#reversed_issues" data-toggle="tab">Reversed Issues</a></li>    
    </ul>

    <div class="tab-content" style="margin-top: 5px;padding:2%; margin-left:1%;">
      <div class="tab-pane active" id="issues">            
        <table id="issues_tbl"  class="stripe display bordered table-responsive table table-hover table-bordered table-update" cellspacing="2" width="100%" style="font-size:12px;">
          <thead>
            <tr>
              <td>Commodity Name</td>
              <td>Batch Number</td>
              <td>Quantity Issues (Units)</td>
              <td>Date of Issue</td>
              <td>Issued To</td>
              <td>Name of Issuer</td>
              <td>Issue Created On</td>              
              <td>Action</td>              
            </tr>
          </thead>

        </table>
      </div>
      <div class="tab-pane" id="reversed_issues">            
        <table id="reversed_tbl"  class="stripe display bordered table-responsive table table-hover table-bordered table-update" cellspacing="2" width="100%" style="font-size:12px;">
        <thead>
          <tr>
            <td>Commodity Name</td>
            <td>Batch Number</td>
            <td>Quantity Issues (Units)</td>
            <td>Issued To</td>
            <td>Date of Reversal</td>
            <td>Person Reversing</td>    
          </tr>
        </thead>

        </table>
      </div>     
    </div>
    </div>
  </div>


<div class="modal fade" id="issueReverseConfirm" style="margin-top:10%; overflow:scroll;min-width:2000px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Issue Reversal</h4>
      </div>
      <div class="modal-body" style="font-size:16px;text-align:centre">
      <center>
        <center><!--img src="<?php echo base_url().'assets/img/Alert_resized.png'?>" style="height:150px;width:150px;"></center><br/> -->
        <p>You are about to Reverse an Issue. This cannot be Undone. Do you want to proceed?</p>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button"  id="btnNoCancel"  class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnYesReverse" class="btn btn-danger" id="btn-ok">Reverse Issue</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<style type="text/css">
   /*.modal-backdrop.in { z-index: auto;}*/
</style>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    load_reversal_table();       
    $(".dataTable").on('click','.status_btn',function(event) {
      var parameters = $(this).data('id');
      $('#issueReverseConfirm').data('id', parameters).modal('show');       
    });
    $('#myTab li:eq(0) a').click(function (e) {
      e.preventDefault();
      load_reversal_table();
    });
    $('#myTab li:eq(1) a').click(function (e) {
      e.preventDefault();
      load_reversed_table();
    });
    $('#btnYesReverse').click(function() {
        // handle deletion here
        var parameters = $('#issueReverseConfirm').data('id');
        var base_url = "<?php echo base_url() . 'issues/reverse_issue/'; ?>";
        var url = base_url+parameters;  
        $('#issueReverseConfirm').modal('hide');
        window.location.href = url;
       
    });
    function load_reversal_table(){
      var base_url_main = "<?php echo base_url() . 'issues/get_reversal_table/'; ?>"; var base_url = "<?php echo base_url() . 'facility_activation/get_facility_user_data/'; ?>";      
      var oTable = $('#issues_tbl').dataTable(
      { 
        retrieve: true,
        paging: true,
        "bPaginate":true, 
        "bFilter": true,
        "bSearchable":true,
        "bInfo":true
      });       
      $.ajax({
        url: base_url_main,
        dataType: 'json',
        success: function(s){
        oTable.fnClearTable();
        for(var i = 0; i < s.length; i++) {
          oTable.fnAddData([
          s[i][0],
          s[i][1],
          s[i][2],
          s[i][3],
          s[i][4],
          s[i][5],
          s[i][6],
          s[i][7]
          ]);
          } // End For
        },
        error: function(e){
          console.log(e.responseText);
        }
      });
    }
    function load_reversed_table(){
      var base_url_main = "<?php echo base_url() . 'issues/get_reversed_table/'; ?>";      
      // $.get(base_url_main, function(data){
      //   $("#reversed_issues").html(data);        
      // });
      var oTable = $('#reversed_tbl').dataTable(
      { 
        retrieve: true,
        paging: true,
        "bPaginate":true, 
        "bFilter": true,
        "bSearchable":true,
        "bInfo":true
      });       
      $.ajax({
        url: base_url_main,
        dataType: 'json',
        success: function(s){
        oTable.fnClearTable();
        for(var i = 0; i < s.length; i++) {
          oTable.fnAddData([
          s[i][0],
          s[i][1],
          s[i][2],
          s[i][3],
          s[i][4],
          s[i][5]
          ]);
          } // End For
        },
        error: function(e){
          console.log(e.responseText);
        }
      });
    }

  });
</script>
