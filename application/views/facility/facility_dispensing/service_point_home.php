<?php //echo "<pre>"; print_r($service_point_dashboard_notifications); echo "</pre>"; exit; ?>
<div class="container" style="width: 96%; margin:auto;">
	<div class="row">
		<!-- Notifications & Actions -->
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-success" id="notify">
						<div class="panel-heading">
							<h3 class="panel-title">Notification <span class="glyphicon glyphicon-bell"></span></h3>
						</div>
						<div class="panel-body">
						<?php if($service_point_dashboard_notifications['actual_expiries'] > 0): ?>
							<div style="height: auto; margin-bottom:2px; " class="warning message">
								<!--<h5>Expired Commodities</h5>-->
								<p>
									<a class="link" href="<?php echo base_url('dispensing/service_point_expiries'); ?>">
										<span class="badge"><?php echo $service_point_dashboard_notifications['actual_expiries'] ?></span>
										Expired Commodities Awaiting Decommissioning
									</a>
								</p>
							</div>
						<?php else: ?>
							<div style="height:auto; margin-bottom: 2px" class="warning message ">   
						      <p><span class="glyphicon glyphicon-info-sign"></span>There are no Expired Commodities</p>
						    </div>
						<?php endif; //actualExpiries?>
						<?php if($service_point_dashboard_notifications['potential_expiries']> 0): ?>
							<div style="height: auto; margin-bottom: 2px;" class="warning message">
								<p>
									<a class="link" href="<?php echo base_url('dispensing/service_point_potential'); ?>">
										<span class="badge"><?php echo $service_point_dashboard_notifications['potential_expiries']; ?></span>
										Commodities Expiring in the next 6 months
									</a>
								</p>
							</div>
						<?php else: ?>
						      <div style="height:auto; margin-bottom: 2px" class="warning message ">   
						      	<p><span class="glyphicon glyphicon-info-sign"></span>There are no Potential Expiries (6 Month Interval)</p>
						      </div>
						<?php endif; //pteExpiries?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-success" id="actions">
						<div class="panel-heading">
							<h3 class="panel-title">Action <span class="glyphicon glyphicon-list-alt"></span></h3>
						</div>
					</div>
					<div class="panel-body">
						<?php $service_pointStockCount = 10; if($service_pointStockCount > 0): ?>
						<div style="height: auto; margin-bottom: 2px; " class="distribute message">
							<a href="<?php echo base_url('issues/service_point_store'); ?>"><h5>Dispense Commodities To Patients</h5></a>
						</div>
						<div style="height: auto; margin-bottom: 2px; " class="distribute message">
							<a href="<?php echo base_url('dispensing/patients'); ?>"><h5>Patient Management</h5></a>
						</div>
						<div style="height: auto; margin-bottom: 2px; " class="distribute message">
							<a href="<?php echo base_url('reports/service_point_store_reports'); ?>"><h5>Reports</h5></a>
						</div>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- -->
		<!-- Graph -->
		<div class="col-md-8">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Graph<span class="glyphicon glyphicon-stats"></span><span class="glyphicon glyphicon-align-left" style="margin-left:1%;"></span></h3>
				</div>
				<div class="panel-body" style="overflow-y: auto;">
					<div style="" id="sp_graph"><?php //echo "<pre>"; print_r($service_point_dashboard_notifications); echo "</pre>"; ?></div>
				</div>
			</div>
		</div>
		<!-- -->
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		<?php echo $service_point_dashboard_notifications['service_point_stock_graph'] ?>
	});
</script>