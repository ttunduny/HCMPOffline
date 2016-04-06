<div class="container-fluid">
	<div class="page_content">
	This is the status checker
	</div>
</div>

<script>
		setInterval(function(){
		var status = Offline.state;
		 if (status == 'up') {
    		$('#online-notification').show();
		 }else{
    		$('#online-notification').hide();
		 	alert(status); 
		 }
		}, 3000);
</script>