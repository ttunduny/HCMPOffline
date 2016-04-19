<style>
	.modal-backdrop {
	  /*z-index: 1040!important;*/
	}
	.modal{
		/*z-index: 1050!important;*/
	}
	#modal-dialog-excel{
		/*z-index: 1500!important;*/
	}
	.float-right{
		float: right;
	}
	.margin-right{
		margin-right: 2px;
	}
</style>
<div class="row">
   <div class="col-md-12" style="padding-left: 0; float:right; right:0;clear:both;  margin-bottom:5px;">
        <a id="upload_excel" href="#modal-dialog-excel" class="btn btn-sm btn-primary float-right margin-right" data-toggle="modal">Upload inventory excel</a>
        <a  class="btn btn-sm btn-primary float-right margin-right" href="<?php echo base_url().'Admin/download_inventory_excel'; ?>">Download template for upload</a>
	</div> 
</div>
<div class="row col-md-12 datatable">
	<table class="table table-bordered">
		<thead>
			<th>Phone No</th>
			<th>County</th>
			<th>Subcounty</th>
			<th>Date Uploaded</th>
		</thead>
		<tbody>
			<?php foreach ($inventory_data as $data): ?>
				<tr>
					<td><?php echo $data['phone']; ?></td>
					<td><?php echo $data['county']; ?></td>
					<td><?php echo $data['district']; ?></td>
					<td><?php echo date('M-d-Y',strtotime($data['added_on'])); ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<div class="modal fade" id="modal-dialog-excel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Upload SMS inventory excel</h4>
            </div>
            <div class="modal-body">
                <?php $attr = array('id'=>'upload_form','class'=>''); echo form_open_multipart('Admin/upload_inventory_excel',$attr); ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Choose file:</td>
                            <td><input type="file" name="inventory_excel" size="20" required="required"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><button id="submit_upload" class="btn btn-success m-r-5" type="submit" value='upload' name="submit"><i class="fa fa-upload"></i> Upload</button></td>
                        </tr>
                    </tbody>
                </table>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
	$('#upload_excel').click(function () {
     $('#modal-dialog-excel').appendTo("body").modal('show');
})
</script>