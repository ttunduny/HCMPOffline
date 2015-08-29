<center>
<div id="navigate" style="width:92%;height:50px;">
	<button type="button" class="btn btn-primary send_email borderless" style="float:right;margin-top:2%;">
		Email Weekly Log Summary
	</button>
</div>
<br/><br/>
<div style="width:92%">
<table id="sms_usage" class="table table-hover table-bordered table-update">
	<thead>
		<tr>
			<th ><b>Facility Name</b></th>
			<th ><b>Facility Code</b></th>
			<th ><b>Sub-County</b></th>
			<th ><b>County</b></th>
			<th ><b>Date Last Logged In</b></th>
			<th ><b>Days from Last Login</b></th>
			<th ><b>Date Last Issued</b></th>
			<th ><b>Days from Last Issue</b></th>
			<th ><b>Date Last Redistributed</b></th>
			<th ><b>Days From last Redistributed</b></th>
			<th ><b>Date Last ordered</b></th>
			<th ><b>Days From Last order</b></th>
			<th ><b>Date Last Decommissioned</b></th>
			<th ><b>Days From Last Decommissioned</b></th>
			<th ><b>Date Last Seen</b></th>
			<th ><b>Days From Last Seen</b></th>
		</tr> 
	</thead>
	<tbody>
		<?php 
			$count = count($row_data);
			for ($i=0; $i < $count; $i++) { 
				$facility_name =  $row_data[$i][0];
				$facility_code =  $row_data[$i][1];
				$sub_county =  $row_data[$i][2];
				$county =  $row_data[$i][3];
				$date_last_login =  $row_data[$i][4];
				$days_from_last_login =  $row_data[$i][5];
				$date_last_issue =  $row_data[$i][6];
				$days_from_last_issue =  $row_data[$i][7];
				$date_last_redistribed =  $row_data[$i][8];
				$days_from_last_redistribution =  $row_data[$i][9];
				$date_last_ordered =  $row_data[$i][10];
				$days_from_last_order =  $row_data[$i][11];
				$date_last_decommissioned =  $row_data[$i][12];
				$days_from_last_decommission =  $row_data[$i][13];
				$date_last_received_order=  $row_data[$i][14];
				$days_from_last_order_received =  $row_data[$i][15];?>
				<tr>
					<td><?php echo $facility_name;?></td>
					<td><?php echo $facility_code;?></td>
					<td><?php echo $sub_county;?></td>
					<td><?php echo $county;?></td>
					<td><?php echo $date_last_login;?></td>
					<td><?php echo $days_from_last_login;?></td>
					<td><?php echo $date_last_issue;?></td>
					<td><?php echo $days_from_last_issue;?></td>
					<td><?php echo $date_last_redistribed;?></td>
					<td><?php echo $days_from_last_redistribution;?></td>
					<td><?php echo $date_last_ordered;?></td>
					<td><?php echo $days_from_last_order;?></td>
					<td><?php echo $date_last_decommissioned;?></td>
					<td><?php echo $days_from_last_decommission;?></td>
					<td><?php echo $date_last_received_order;?></td>
					<td><?php echo $days_from_last_order_received;?></td>
				</tr>
			<?php }
			// echo "<pre>";
			// print_r($row_data);die;
		?>
	</tbody>
	</table>
</div>
</center>

<script>
      $(document).ready(function () {
      	
		$('#sms_usage').dataTable({
		 	"paging":   false,
	        "ordering": false,
	        "info":     false
        }); 

        $('.send_email').click(function(e){
        	e.preventDefault();
        	var url = "<?php echo base_url(); ?>sms/log_summary_weekly";
        	window.location.href = url;
        });
	});
</script>

