<!-- Button to trigger modal -->
<link rel="stylesheet" type="text/css" href="http://tableclothjs.com/assets/css/tablecloth.css">
<script src="http://tableclothjs.com/assets/js/jquery.tablesorter.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.metadata.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.tablecloth.js"></script>

<script src="http://localhost/HCMP/scripts/bootstrap-typeahead.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>



<button type="button" class="btn btn-default" data-toggle="modal" data-target="#Add_DMLT">Add SCMLT</button>
<br/>
<div class="modal fade" id="Add_DMLT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add SCMLT</h4>
      </div>
      <div class="modal-body">        
        <p></p>
        <form id="add_dmlt_form"> 
            <table>
                <tr>    
                    <td>First Name</td>
                    <td><input class="form-control" id="first_name" type="text" name="first_name" /></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input class="form-control" id="last_name" type="text" name="last_name" /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input class="form-control" id="email" type="text" name="email" /></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input class="form-control" id="phone" type="text" name="phone" />
                        <input class="form-control" id="county" type="hidden" name="county" value="<?php echo $countyid; ?>" /></td>
                </tr>
                <tr>
                    <td>Sub-County</td>
                    <td>
                        <select id="district" class="form-control">
                            <option> -- Select Sub County --</option>
                            <?php foreach ($districts as $dists) { ?>
                                <option value="<?php echo $dists['id']; ?>"><?php echo$dists['district']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </table>
        </form>

       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="save_dmlt" class="btn btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<table id="users_table" class="data-table">
    <thead>
    <th style="width: 10px;">Delete</th>
    <th>Name</th>
    <th>email</th>
    <th>Phone</th>
    <th>Main Sub County</th>
    <th>Other Sub Counties</th>

<!--		<th>Action</th>-->
</thead>
<tbody>
    <?php foreach ($users as $row) { ?>
        <tr>
            <td><a href="<?php echo '../delete_user/'.$row['id'].'/'.$row['district_id'].'/county_user'; ?>" title="Delete <?php echo $row['fname'] . ' ' . $row['lname']; ?>"><span style="color: #DD6A6A;">[x]</span></a></td>
            <td><a href="#user_<?php echo $row['id']; ?>"><?php echo $row['fname'] . ' ' . $row['lname']; ?></a></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['telephone']; ?></td>
            <td><?php echo $row['district']; ?></td>
            <td>
                <a href="#" data-target="dmlt_district_<?php echo $row['id']; ?>" role="button"  data-toggle="modal">Add  Sub-County</a>
                <div id="districts_dmlt_<?php echo $row['id']; ?>"> </div>
                <script type="text/javascript">
                $(function(){
                  $( "#districts_dmlt_<?php echo $row['id']; ?>" ).load( "<?php echo base_url();?>rtk_management/show_dmlt_districts/<?php echo $row['id']; ?>" );
                });
                </script>

                <div id="dmlt_district_<?php echo $row['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                    <div class="modal-body">
                        <h2 id="myModalLabel"> Add  Subcounty to <?php echo $row['fname'] . ' ' . $row['lname']; ?></h2>
                        <hr />
                        <form id="add_dmlt_district_form" method="POST" action="<?php echo base_url() . 'rtk_management/dmlt_district_action'; ?>">
                            
                            <input name="dmlt_id" id="dmlt_id" type="hidden" value="<?php echo $row['id']; ?>"/>
                            <input name="action" id="action" type="hidden" value="add"/>
                            
                            <select name="dmlt_district" id="dmlt_district">
                                <option> -- Select District --</option>
                                <?php foreach ($districts as $dists) { ?>
                                    <option value="<?php echo $dists['id']; ?>"><?php echo $dists['district']; ?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        <input id="add_dmlt_district" type="submit" class="btn btn-primary" value="Save changes"/>
                        </form>
                    </div>

                </div>
            </td>
        </tr>
    <?php } ?>
</tbody>
</table>

<?php
/*
  echo "<pre>";
  print_r($users);
  echo "</pre>";
 */
?>
<script type="text/javascript">
    $(function() {
        $('#save_dmlt').click(function() {
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var phone = $('#phone').val();
            var district = $('#district').val();
            var county = $('#county').val();
            var email = $('#email').val();

            $.post("<?php echo base_url() . 'rtk_management/create_DMLT'; ?>", {
                first_name: first_name,
                last_name: last_name,
                email: email,
                phone: phone,
                district: district,
                county: county
            }).done(function(data) {
                alert("Data Loaded: " + data);
                $('#Add_DMLT').modal('hide');
                window.location = "<?php echo base_url() . 'rtk_management/county_admin/users'; ?>";
            });
        });
        $('#users_table').tablecloth({theme: "paper",         
          bordered: true,
          condensed: true,
          striped: true,
          sortable: true,
          clean: true,
          cleanElements: "th td",
          customClass: "my-table"
        });

        
        /*
         $('#add_dmlt_district').click(function() {
         var dmlt_id = $(this).closest('div: #dmlt_id').val();
         var dmlt_district = $(this).closest('div: #dmlt_district').val();
         alert(dmlt_id);
         alert(dmlt_district);
         
         //            var dmlt_id = $('#dmlt_id').val();
         //            var dmlt_district = $('#dmlt_district').val();
         
         $.post("<?php echo base_url() . 'rtk_management/dmlt_district_actions'; ?>", {
         action: 'add',
         dmlt_district: dmlt_district,
         dmlt_id: dmlt_id
         }).done(function(data) {
         alert("Data Loaded: " + data);
         $('#Add_DMLT').modal('hide');
         window.location = "<?php echo base_url() . 'rtk_management/county_admin/users'; ?>";
         });
         });
         
         
         */
    });
</script>
<style type="text/css">
table{
    font-size: 13px;
}
</style>