<div class="panel-group " id="accordion" style="padding: 0;">
    <div class="panel panel-default <?php echo $active_panel=='expiries'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseone" id="expiries" ><span class="glyphicon glyphicon-trash">
                </span>Expiries</a>
            </h4>
        </div>
        <div id="collapseone" class="panel-collapse collapse <?php echo $active_panel=='expiries'? 'in': null; ?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url().'reports' ?>">Potential Expiries</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?php echo base_url().'reports/expiries' ?>">Expired</a> <span class="label label-info"></span>
                        </td>
                    </tr>
                    
                </table>

            </div>
        </div>
    </div>
    <!--Divisional Reports Accordion-->
    <div class="panel panel-default <?php echo $active_panel=='divisional'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-parent="#accordion" href="<?php echo base_url("divisional_reports/program_reports"); ?>" id="divisional_reports"><span class="glyphicon glyphicon-folder-open">
                </span>Divisional Reports</a>
            </h4>
        </div>
    </div>
    <div class="panel panel-default <?php echo $active_panel=='statistics'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" id="facility_statistics"><span class="glyphicon glyphicon-screenshot">
                </span>Facility Statistics</a>
            </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse <?php echo $active_panel=='statistics'? 'in': null; ?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="glyphicon"></span><a href="<?php echo base_url().'reports/load_expiries'?>" >Expiries</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon"></span><a href="<?php echo base_url().'reports/order_report'?>" >Orders</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon"></span><a href="<?php echo base_url().'reports/consumption'?>" >Consumption</a>
                        </td>
                    </tr>
                    
               </table>
            </div>
        </div>
    </div>
    <div class="panel panel-default <?php echo $active_panel=='other'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" id="other_reports"><span class="glyphicon glyphicon-file">
                </span>Other Reports</a>
            </h4>
        </div>
        <div id="collapseFive" class="panel-collapse collapse <?php echo $active_panel=='other'? 'in': null; ?>">
            <div class="panel-body">
                <table class="table">
                  	 <tr>
                        <td>
                            <span class="glyphicon ">
                            </span><a href="<?php echo base_url().'reports/stock_control' ?>">Stock Control Card</a>
                        </td>
                    </tr>

                    <tr>
                      <!--  <td>
                            <span class="glyphicon">
                            </span><a href="<?php echo base_url().'reports/commodities_issue' ?>">Commodities Issued</a>
                      </td>-->
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon"></span><a href="<?php echo base_url().'reports/get_facility_mapping_data'?>" >User Statistics</a>
                        </td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
    
</div>
