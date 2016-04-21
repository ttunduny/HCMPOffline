<div class="container-fluid">
	<div class="page_content">
		<div class="container-fluid">
			
			<div class="col-md-12">
			<?php if (isset($update_status)&&$update_status!=''): ?>
				<div class="col-md-12" style="margin:10px 0;">
					<center>
						<i class="glyphicon glyphicon-floppy-remove" style="font-size: 40px"></i>
						<p style="font-size: 20px;">You require a system update before synchronizing your data</p>

						<a class="btn btn-primary" href="<?php echo base_url().'git_updater/admin_updates_home' ?>" style="width:200px;">Update system</a>	

					</center>
				</div>
			<?php else: ?>
				<div class="btn col-md-8" style="margin:10px 0;">
				<?php if (isset($sync_status) && $sync_status ==1): ?>
				<p class="col-md-12">You have succesfully synchronized your data with the live server. Your data will be visible on the main system within <b>24 hours</b></p></br>
				<?php endif ?>

					<?php if (!empty($sync_data)&&$sync_data!=''): ?>
						<p class="col-md-12">Your last sync was on <b><?php echo date('F, m Y H:i:s',strtotime($last_sync));?></b></p>
						<table class="table table-bordered">
							<thead>
								<th>Past database synchronizations</th>
							</thead>
							<tbody>
								<?php foreach ($sync_data as $key): ?>
									<tr>
										<td><?php echo date('F, m Y H:i:s',strtotime($key['last_sync'])); ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					<?php else: ?>
						<p style="font-size: 20px;">This must be your first time synchronizing your data,feel free to do so</p>
						</br>
						<i class="glyphicon glyphicon-hand-right" style="font-size: 40px"></i>
					<?php endif ?>
				</div>		
				<div class="col-md-4">
				<a class="btn btn-success col-md-12" href="<?php echo base_url().'synchronization/sync' ?>" style="margin:37px 0;">Synchronize data now</a>	
				
				</div>

			<?php endif ?>

			</div>
		</div>
	</div>
</div>