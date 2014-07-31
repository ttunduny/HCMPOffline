<div class="col-md-2" style="border-right: solid 1px #ccc;padding-right: 20px;">
    <select id="switch_county" class="form-control" style="max-width: 220px;background-color: #ffffff;border: 1px solid #cccccc;">
        <option>-- Select County --</option>
        <?php echo $option; ?>
    </select>

    <select id="switch_month" class="form-control" style="max-width: 220px;background-color: #ffffff;border: 1px solid #cccccc;">
        <?php 
            for ($i=0; $i <12 ; $i++) {  
                $day = "-$i";
                //$month = date('F Y');
                $month_stamp = mktime(0, 0, 0, $day , 1, date("Y"));
                $month = date("M d, Y", $month_stamp);
                $year = date('Y', strtotime("-$i month")); 
                echo "<option>$month</option>";              
            }
        ?>
    </select>

    <ul class="nav nav-pills nav-stacked" style="font-size:100%">
        <li><a href="<?php echo base_url().'rtk_management/county_home'?>">Summary</a></li>        
        <li><a href="<?php echo base_url().'rtk_management/rca_districts'?>">Sub-Counties</a></li>
        <li><a href="<?php echo base_url().'rtk_management/rca_pending_facilities'?>">Pending Facilities</a></li>
        <li><a href="<?php echo base_url().'rtk_management/rca_facilities_reports' ?>">Reports</a></li>
        <li><a href="<?php echo base_url().'rtk_management/county_admin/users' ?>">Users</a></li>
        <li><a href="<?php echo base_url().'rtk_management/county_admin/facilities' ?>">Facilities</a></li>

    </ul>
</div>