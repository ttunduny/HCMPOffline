<?php

$month = $this->session->userdata('Month');
if ($month == '') {
    $month = date('mY', time());
}
$year = substr($month, -4);
$month = substr_replace($month, "", -4);
$monthyear = $year . '-' . $month . '-1';
$englishdate = date('F, Y', strtotime($monthyear));
?>
<script type="text/javascript">

$(document).ready(function() {

    $('#example_main').dataTable({
        "bPaginate": true,
        "aaSorting": [[3, "asc"]]
    });
    $.fn.slideFadeToggle = function(speed, easing, callback) {
        return this.animate({
            opacity: 'toggle',
            height: 'toggle'
        }, speed, easing, callback);
    };


        //       $(".alert").fadeIn(400);
        $(".notif").delay(20000).slideUp(1000);
        $("#tablediv").delay(15000).css( "height", '450px');
        $(".dataTables_filter").delay(15000).css( "color", '#ccc');



$("#dpp_stats").click(function(event)
        {
            $("dash_main").load("<?php echo base_url(); ?>rtk_management/summary_tab_display/" + <?php // echo $countyid; ?> + "/<?php echo $year; ?>/<?php echo $month; ?>/");

        });
    });

function loadcountysummary(county) {
//            $(".dash_main").load("http://localhost/HCMP/rtk_management/rtk_reporting_by_county/" + county);
}

</script>
<style type="text/css">
    body > div.container-fluid > div > h1{margin-left: 230px;}
</style>

                        <script type="text/javascript">

                        $(function() {

                            $('#switch_district').change(function() {
                                var value = $('#switch_district').val();
                                var path = "<?php echo base_url() . 'rtk_management/switch_district/'; ?>" + value + "/dpp";
//              alert (path);
window.location.href = path;
});
                        });
                        </script>
    <?php 
    if ($this->session->userdata('switched_as') == 'dpp') {
      ?>
      <div id="fixed-topbar" style="position: fixed; top: 104px;background: #708BA5; width: 100%;padding: 7px 1px 0px 13px;border-bottom: 1px solid #ccc;border-bottom: 1px solid #ccc;border-radius: 4px 0px 0px 4px;">
        <span class="lead" style="color: #ccc;">Switch back to RTK Manager</span>&nbsp;&nbsp;
        <a href="<?php echo base_url(); ?>rtk_management/switch_district/0/rtk_manager/0/home_controller/0//" class="btn btn-primary" id="switch_idenity" style="margin-top: -10px;">Go</a>
      </div>
      <?php }?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
      <div class="leftpanel">
    <div class="sidebar">
        <?php
        $option = '';
        $id = $this->session->userdata('user_id');
        $q = 'SELECT * from dmlt_districts,districts 
                                where dmlt_districts.district=districts.id
                                and dmlt_districts.dmlt=' . $id;
        $res = $this->db->query($q);
        foreach ($res->result_array() as $key => $value) {
            $option .= '<option value = "' . $value['id'] . '">' . $value['district'] . '</option>';
        }
        ?>
        <span style="" class="label label-info">Switch districts</span>
        <br />
        <br />
        <select id="switch_district">
            <option>-- Select District --</option>
            <?php echo $option; ?>
        </select>
        <br />
        <div class="panel-group " id="accordion" style="padding: 0;">
            <div class="panel panel-default active-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="<?php echo site_url('rtk_management/rtk_allocation'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-bullhorn">
                            </span>Home</a>
                    </h4>
                </div>
            </div>
            <div class="panel panel-default active-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="<?php echo site_url('rtk_management/rtk_allocation'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-stats">
                            </span>Statistics</a>
                    </h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="<?php echo site_url('rtk_management/rtk_orders'); ?>" href="#collapseTwo" id="stocking_levels"><span class="glyphicon glyphicon-sort-by-attributes">
                            </span>Orders</a>
                    </h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="<?php echo site_url('rtk_management/rtk_allocation'); ?>" href="#collapseThree" id="expiries"><span class="glyphicon glyphicon-trash">
                            </span>Allocation</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>     
      <div class="dash_main" id = "dash_main">
        <?php
$district = $this->session->userdata('district1');
$district_name = Districts::get_district_name($district)->toArray();
$d_name = $district_name[0]['district'];
?>
<div id="notification">View all Allocations for <?php echo $d_name; ?> district below</div><br>
<?php if (count($lab_order_list) > 0) : ?>
            <table width="100%" id="example" class="data-table">
                <thead>
                    <th><b>Month</b></th>
                    <th><b>MFL Code</b></th>
                    <th><b>Facility Name</b></th>
                    <th><b>Commodity</b></th>
                    <th><b>(AMC)</b></th> 
                    <th><b>End Balance</b></th>
                    <th><b>Quantity Requested</b></th>
                    <th><b>Quantity Allocated</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    foreach ($lab_order_list as $order) {
                       $month_text = $order['order_date'];
                       $month_text = substr($month_text, 0,7);
                       $month = date('F-Y', strtotime($month_text));
                    ?>
                        <tr>
                            <td><?php echo $month;?></td>
                            <td><?php echo $order['facility_code'];?></td>
                            <td><?php echo $order['facility_name'];?></td>
                            <td><?php echo $order['commodity_name'];?></td>
                            <td><?php echo $order['amc'];?></td>
                            <td><?php echo $order['closing_stock'];?></td>
                            <td><?php echo $order['q_requested'];?></td>
                            <td><?php echo $order['allocated'];?></td>
                        </tr>
                        
                        <?php
                         $count++;
                    }
                    ?>
                </tbody>
            </table>
             <?php
        else :?>
            <table width="100%" id="example" class="data-table">
                <thead>
                    <th><b>MFL Code</b></th>
                    <th><b>Facility Name</b></th>
                    <th><b>Commodity</b></th>
                    <th><b>(AMC)</b></th> 
                    <th><b>End Balance</b></th>
                    <th><b>Quantity Requested</b></th>
                    <th><b>Quantity Allocated</b></th>
                    </tr>
                </thead>
                <tbody>                   
                    <tr><td colspan="7"><center>No Records Found</center></td></tr>
                      
                </tbody>
            </table>
        <?php endif;
        ?>
 </div></div>

      <link rel="stylesheet" type="text/css" href="http://tableclothjs.com/assets/css/tablecloth.css">


                <script src="http://tableclothjs.com/assets/js/jquery.tablesorter.js"></script>
                <script src="http://tableclothjs.com/assets/js/jquery.metadata.js"></script>
                <script src="http://tableclothjs.com/assets/js/jquery.tablecloth.js"></script>
                <script type="text/javascript">
                $(document).ready(function() {
                    $("table").tablecloth({theme: "paper"});
                });


                </script>
    </div>
  </div>