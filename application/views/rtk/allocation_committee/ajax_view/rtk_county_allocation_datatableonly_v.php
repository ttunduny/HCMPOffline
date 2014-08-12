<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.tablecloth.js"></script>


<script type="text/javascript">

    $(document).ready(function() {

        /* Build the DataTable with third column using our custom sort functions */

        $('#example').dataTable({
            "bStateSave": true,
            "iDisplayLength": 10,
            "aaSorting": [[11, "desc"]],
            "bPaginate": false,
        });

        $("#allocate").button().click(function() {

        	var loading = '<div id="loading"> &nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif"><span style="font-size: 13px;color: #92CA8F;margin-left:100px; font-family: calibri;">Saving Allocations</span></div>';
        	$('#allocation-response').html(loading);

      	

            var data = $('#myform').serialize();
            $.post(
                    '../rtk_allocation_data/',
                    {data: data},
            function(response) {
                $('#allocation-response').html(response);
                $('#allocation-response').addClass('alert alert-success');
               location.reload(true);
//                $( "#loading" ).hide();
            }
            );


        });

        $('.navtbl li a').click(function(e) {
            var $this = $(this);
            var thistext = $(this).text();
            $('.nav li').removeClass('active');
            $this.parent().addClass('active');
            $(".dataTables_filter label input").focus();
            $('.dataTables_filter label input').val(thistext).trigger($.Event("keyup", {keyCode: 13}));

            e.preventDefault();
        });
        $("table").tablecloth({theme: "paper"});


    });
</script>

<style>
    @import "<?php echo base_url(); ?>assets/datatable/media/css/jquery.dataTables.css";
    @import "http://tableclothjs.com/assets/css/tablecloth.css";

    .alerts{
        width:95%;
        height:auto;
        background: #E3E4FA;	
        padding-bottom: 2px;
        padding-left: 2px;
        margin-left:0.5em;
        -webkit-box-shadow: 0 8px 6px -6px black;
        -moz-box-shadow: 0 8px 6px -6px black;
        box-shadow: 0 8px 6px -6px black;
    }
    .user2{
        width: 40px;
    }
    #example{
        width: 100% !important;
    }    
    .nav{
        margin-bottom: 0px;
    } 
    table{
        font-size: 13px;
        text-align: center;
        width: 100%;
    }
    table:tr{
        height: 10px;
        

    }
</style> 

<div style="width:100%;font-size: 15px;background: #F8F8F8;padding: 10px 10px 10px 10px;border-bottom: solid 1px #ccc;">
    <ul class="navtbl nav nav-pills">

        <?php foreach ($districts_in_county as $value) { ?>
            <li class=""><a href="#"><?php echo $value['district']; ?></a></li>
        <?php } ?>
            <li class="disabled" style=""><a href="#">&nbsp;</a></li>     
            <li class="disabled" style="border-left: solid 0.1em #ccc;"><a href="#">&nbsp;</a></li>

            <li class=""><a href="#">Old-Algorithm</a></li>
            <li class=""><a href="#">New-Algorithm</a></li>
       <a class="pull-right" href="../county_allocation/<?php echo $county_id;?>" style="line-height: 20px;margin: 8px 26px 0px 0px;text-decoration: none;color: #0088cc;">View <?php echo $countyname;?>  Allocations</a> 

    </ul>
</div>
<div style="height:411px;overflow:scroll;">
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('rtk_management/rtk_allocation_data/' . $county_id, $attributes);
    ?>

    <table id="example" style="width:96%">
        <thead>
            <tr>
                <th colspan="3">Facility Details</th>
                <th rowspan="2"><br/><b>Commodity</b></th>
                <th colspan="5">Quantity(tests)</th>
              
                <th rowspan="2"><b>Qty to allocate</b>(Kits)</th>
                <th rowspan="2"><b>Qty Issued<br />(From KEMSA)</b></th>
                <th rowspan="2"><b>Status</b></th>
            </tr>
            <tr>
                <th><b>MFL</b></th>
                <th><b>Facility Name</b></th>
                <th><b>Sub-County</b></th>
                <th><b>Received</b></th>
                <th><b> Consumed</b></th>
                <th><b>End balance<br />Physical Count</b></th>
                <th><b>Qty Requested <br />for Re-Supply</b></th>
                  <th rowspan="1"><b>AMC </b></th>
            </tr>
        </thead>
        <tbody><?php echo $table_body; ?></tbody>
    </table>
    <br />
<div id="clear">&nbsp;</div>
    <div>
<input class="pull-left" type="button" id="allocate" value="Allocate" style="background: #F8F7F7; padding: 7px;margin: 8px 0px 5px 19px;color: #0088cc;font-family: calibri;font-size: 18px;border: 1px solid #ccc;">
<div id="allocation-response"></div>
</div>
<?php echo form_close(); ?>	
</div>