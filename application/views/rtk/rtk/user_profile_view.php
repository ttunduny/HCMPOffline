<?php include_once 'ago_time.php'; ?>
<style type="text/css">
    body > div.container-fluid > div > div > div > div:nth-child(1)	{font-size: 120%;word-spacing: 2px;}
    body > div.container-fluid > div > div > div > div:nth-child(1) > div{padding: 10px;}
    body > div.container-fluid > div > div > div > div:nth-child(2){height: 75%;overflow-y: scroll;overflow-x: hidden;margin-left: 10px;}
</style>
<div class="row">
    <div class="col-sm-6 col-md-7">
        <div class="panel pull-left">
            <img src="http://switchontario.ca/Resources/Pictures/profile_image_placeholder.jpg" alt="<?php echo $full_name; ?>" class="img-responsive pull-left">
            <div class="caption">
                <h3><?php echo $full_name; ?> <small></small></h3>
                <p>
                    <span class="label label-success"> &nbsp; <small>ACTIVE</small></span>
                    <br />
                    <span class="glyphicon glyphicon-user"></span><?php echo $user_details[0]['level']; ?>
                    <br />
                    <span class="glyphicon glyphicon-envelope"></span><?php echo $user_details[0]['email']; ?>
                    <br />
                    <span class="glyphicon glyphicon-earphone"></span><?php echo $user_details[0]['telephone']; ?>
                    <br />
                    Create <?php echo $user_details[0]['created_at']; ?>
                    <br />
                    District: <?php
                    foreach ($user_details[2] as $key => $value) {
                        echo '<a href="#">' . $value['district'] . '</a>  ';
                    }
                    ?>
                    <br />

                    County: <?php
                    foreach ($user_details[1] as $key => $value) {
                        echo '<a href="#">' . $value['county'] . '  ';
                    }
                    ?>
                </p>
                <p><a href="#" class="btn btn-primary" role="button">Deactivate</a>
                    <?php if ($user_details[0]['user_indicator'] == 'scmlt') { ?>
                        <!-- Button trigger modal -->
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_county">
                            <span class="glyphicon glyphicon-plus"></span> Add Sub County
                        </button>


                    <div class="modal fade" id="add_county" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Add Sub-County to <?php echo $full_name; ?></h4>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <select>
                                            
                                        </select>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div><?php } elseif ($user_details[0]['user_indicator'] == 'rtk_county_admin') { ?> 
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_county">
                        <span class="glyphicon glyphicon-plus"></span> Add County to <?php echo $full_name; ?>
                    </button>


                    <div class="modal fade" id="add_county" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Add County to <?php echo $full_name; ?></h4>
                                </div>
                                <div class="modal-body">                                  
                                    <form>
                                        <select></select>
                                    </form>
                                </div>

                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                <input type="submit" id="add_rca_county" class="btn btn-primary" value="Save changes" />

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
    <div class="panel pull-left">   
        <?php
        foreach ($user_logs as $logs) {
            $action_clause = '';
            $action_clause = ($logs['action'] == 'ADDFDR') ? 'Added a Report' : $action_clause;
            $action_clause = ($logs['action'] == 'UPDFDR') ? 'Edited a Report' : $action_clause;
            $action_clause = ($logs['action'] == 'ACTFCL') ? 'Activated a Facility' : $action_clause;
            $action_clause = ($logs['action'] == 'DCTFCL') ? 'Deactivated a Facility' : $action_clause;
            $action_clause = ($logs['action'] == 'UPDFCL') ? 'Edited a Facility' : $action_clause;
            $action_clause = ($logs['action'] == 'ADDUSR') ? 'Added  a User' : $action_clause;
            $action_clause = ($logs['action'] == 'UPDUSR') ? 'Edited a User' : $action_clause;
            $link = "";
            $date = date('H:m:s d F, Y', $logs['timestamp']);
            ?>
            <?php
            echo
            '<a href="' . $link . '" title="' . $date . '">'
            . $logs['fname'] . ' '
            . $logs['lname'] . ' '
            . '</a>'
            . $action_clause . ' '
            . '<a href="' . $link . '" title="' . $date . '">'
            . timeAgo($logs['timestamp'])
            . '</a>';
            ?>
            <br />
        <?php } ?>
    </div>

</div>
</div>