<div class="row" style="margin-top: 1%;border:1px ridge;">
  <div class="col-md-12">     
    <ul class="nav nav-tabs" id="myTab">
      <li class="active"><a href="#issues" data-toggle="tab">Issues</a></li>
      <li ><a href="#reversed_issues" data-toggle="tab">Reversed Issues</a></li>
      <li><a href="#redistributions" data-toggle="tab">Redistributions</a></li>        
      <li><a href="#reversed_redistributions" data-toggle="tab">Reversed Redistributions</a></li>        
    </ul>

    <div class="tab-content" style="margin-top: 5px;padding:2%; margin-left:1%;">
      <div class="tab-pane active" id="issues">            
        
      </div>
      <div class="tab-pane" id="reversed_issues">            
        <div id="test"></div>
      </div>
      <div class="tab-pane" id="redistributions">          
      </div>
      <div class="tab-pane" id="reversed_redistributions">          
      </div>
    </div>
    </div>
  </div>


<div class="modal fade" id="issueDetailsModal" style="margin-top:2%; overflow:scroll;min-width:2000px;">
  <div class="modal-dialog">s
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Issue Details</h4>
      </div>
      <div class="modal-body" style="font-size:14px;text-align:centre">
      <center>
        <!-- <center><img src="<?php echo base_url().'assets/img/Alert_resized.png'?>" style="height:150px;width:150px;"></center><br/> -->
        <p>The following are the details of the Selected Issue</p>
        <table  id="confirm_issue_reversal_table" class="display table table-bordered confirm_deactivate_table" cellspacing="0" width="100%">
          <thead>
            <tr><th>Facility Name</th><th>Facility Code</th><th>Commodity Name</th><th>Batch Number</th><th>Quantity Issued</th><th>Date of Issue</th></tr>
          </thead>
          <tbody></tbody>
        </table>
       
        </center>
      </div>
      <div class="modal-footer">
        <button type="button"  id="btnNoCancel"  class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnYesReverse" class="btn btn-danger" id="btn-ok">Reverse Issue</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="reversed_issueDetailsModal" style="margin-top:2%; overflow:scroll;min-width:2000px;">
  <div class="modal-dialog">s
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Reversal Details</h4>
      </div>
      <div class="modal-body" style="font-size:14px;text-align:centre">
      <center>
        <!-- <center><img src="<?php echo base_url().'assets/img/Alert_resized.png'?>" style="height:150px;width:150px;"></center><br/> -->
        <p>The following are the details of the Selected Reversal</p>
        <table  id="confirm_issue_undo_reversal_table" class="display table table-bordered confirm_deactivate_table" cellspacing="0" width="100%">
          <thead>
            <tr><th>Facility Name</th><th>Facility Code</th><th>Commodity Name</th><th>Batch Number</th><th>Quantity Issued</th><th>Date of Issue</th></tr>
          </thead>
          <tbody></tbody>
        </table>
       
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
   .modal-backdrop.in { z-index: auto;}
</style>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    load_reversal_table();    
    $(document).on('click', '#myTab li:eq(0) #issues_tbl button .status_btn', function(ev){        
        $("#confirm_issue_reversal_table > tbody").html("");
        var parameters = $(this).data('id');
        $('#issueDetailsModal').data('id', parameters).modal('show');
        var base_url = "<?php echo base_url() . 'admin/reverse_issue/'; ?>";
        var url = base_url+parameters+'/view';     
        $.ajax({
          url: url,
          dataType: 'json',
          success: function(s){     
           $.each(s, function( index, value ) {
             var row = $("<tr><td>" + value[0] + "</td><td>" + value[1] + "</td><td>"+value[2]+"</td><td>"+value[3]+"</td><td>"+value[4]+"</td><td>"+value[5]+"</td></tr>");
             $("#confirm_issue_reversal_table").append(row);
          });      
          },
          error: function(e){
            console.log(e.responseText);
          }
        });
    });
    // $(document).on('click', '#reversed_issues_tbl button .reverse_status_btn', function(ev){        
    //     $("#reversed_issueDetailsModal > tbody").html("");
    //     var parameters = $(this).data('id');
    //     $('#reversed_issueDetailsModal').data('id', parameters).modal('show');
    //     var base_url = "<?php echo base_url() . 'admin/undo_reverse_issue/'; ?>";
    //     var url = base_url+parameters+'/view';     
    //     $.ajax({
    //       url: url,
    //       dataType: 'json',
    //       success: function(s){     
    //        $.each(s, function( index, value ) {
    //          var row = $("<tr><td>" + value[0] + "</td><td>" + value[1] + "</td><td>"+value[2]+"</td><td>"+value[3]+"</td><td>"+value[4]+"</td><td>"+value[5]+"</td></tr>");
    //          $("#confirm_issue_undo_reversal_table").append(row);
    //       });      
    //       },
    //       error: function(e){
    //         console.log(e.responseText);
    //       }
    //     });
    // });
    // $("#myTab").on("tabsactivate", function( event, ui ) {
    //    if ( ui.newPanel.selector=="#reverse_issue" ){
    //         alert("tab 2 selected");
    //     }      
    // });
    $('#myTab li:eq(1) a').click(function (e) {
      e.preventDefault();
      load_reversed_table();
    })

    $('#reverse_issue').click(function(e){
      load_reversal_table();
    });
    $('#issues_tbl').DataTable( {
      "paging":   true,
      "ordering": true,
      "info":     true
    });
    
    $('#btnYesReverse').click(function() {
      $('#issueDetailsModal').modal('hide');
    });
    $('#btnYesReverse').click(function() {
        // handle deletion here
        var parameters = $('#issueDetailsModal').data('id');
        var base_url = "<?php echo base_url() . 'admin/reverse_issue/'; ?>";
        var url = base_url+parameters+'/reverse';  
        $('#issueDetailsModal').modal('hide');
        window.location.href = url;
       
    });
    function load_reversal_table(){
      var base_url_main = "<?php echo base_url() . 'admin/get_reversal_table/'; ?>";      
      $.get(base_url_main, function(data){
        $("#issues").html(data);        
      });
    }

    function load_reversed_table(){
      var base_url_main = "<?php echo base_url() . 'admin/get_reversed_table/'; ?>";      
      $.get(base_url_main, function(data){
        $("#reversed_issues").html(data);        
      });
      // $('#test').html('Works');
    }

  });
</script>
