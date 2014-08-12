<form name="approvals" action="<?php echo $formaction;?>" method="post">
		<table>
			<th width="1500px"><div class="notice">
			Please approve <?php echo strtoupper($labname);?>&nbsp;'s KIT Consumption for <?php echo $left;?> Platform for <?php echo $monthname.' '.$approve_year;?>.</div></th>
			<tr ><th><input type="submit" name="display_approval" value="Display for Approval" style="width:400px" class="button" />
			<input type="hidden" name="left" value="<?php echo $approve_left;?>" />
			<input type="hidden" name="lab" value="<?php echo $approve_lab;?>" />
			<input type="hidden" name="lastmonth" value="<?php echo $approve_lastmonth;?>" />
			<input type="hidden" name="year" value="<?php echo $approve_year;?>" />
			</th></tr>
		</table>
</form>