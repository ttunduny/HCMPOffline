<style>
  .patient-data{
    margin:5px 0;
  }  
</style>

<div class="container-fluid" style="">
  <div class="row row-offcanvas row-offcanvas-right" id="sidebar" >
    <p class="pull-left visible-xs">
      <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Click to view Side Menu</button>
    </p>

    <div class="col-sm-3 col-md-2 sidebar-offcanvas"  id="bar" role="navigation" style="margin-left:0.5%; padding-top: 0.5%">
     <?php $this -> load -> view($sidebar);?>
   </div>

   <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 " style="padding:0;border-radius: 0; ">
    <h1 class="page-header" style="margin: 0;font-size: 1.6em;"></h1>
    <div class="well clearfix clear" style="background-color:#ffffff">
      <div style="height: 100%;" id="notification">
        <div class="patient-select">
          <select class="form-control patient_select">
            <option value="0">Select Patient</option>
            <?php foreach ($patients as $key) {?>
              <option value="<?php echo $key['id'];?>"><?php echo $key['patient_names']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class=" patient-data well col-md-12">
          <div id="patient_info" class="col-md-6">
          <h3>Kindly select patient</h3>
          </div>

          <div class="col-md-6">
          <h4>Dispense to Patient</h4>
            <select class="form-control">
              <option value="0">Select Commodities</option>
              <?php foreach ($commodities as $key) {
                echo '<option value="'.$key['commodity_id'].'" data-facility-stock-id = "'.$key['facility_stock_id'].'">'.$key['commodity_name'].'</option>';
              } ?>
            </select>

            <div id="" class="col-md-12">
              Kindly
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<script>

$(document).ready(function () {
    $('[data-toggle=offcanvas]').click(function () {
      $('.row-offcanvas').toggleClass('active')
    });


    $(window).resize(function() {
      if (($(window).width() < 768))
      {
        $( ".col-md-2,.col-md-10" ).css( "position", "" );
      };
    });
    $('#dataTables_filter label input').addClass('form-control');
    $('#dataTables_length label select').addClass('form-control');
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
    } ); 
    
    $(".patient_select").change(function(){
      // alert("I work");
      var id = $(this).val();
      console.log(id);
       $.ajax({
        type:"POST",
        url:"<?php echo base_url().'dispensing/get_patient_data'; ?>",
        data:{
          id:id
        },
        beforeSend :function(){
        },success :function(msg){
          // console.log(msg);
          $('#patient_info').html(msg);
        }
       });
    });

    
  });
</script>