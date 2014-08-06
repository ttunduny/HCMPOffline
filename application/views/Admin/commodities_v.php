<style>
	
	
</style>


<div class="container-fluid">
	
	<div class="row" style="margin-top: 1%;">
		<div class="col-md-12">
			
			<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#home" data-toggle="tab">Commodity List</a></li>
  <li><a href="#profile" data-toggle="tab">Graphs & Statistics</a></li>
  <li><a href="#messages" data-toggle="tab">Commodity Settings</a></li>
</ul>

<div class="tab-content" style="margin-top: 5px;">
  <div class="tab-pane active" id="home">
  	 <?php 
  	 $this -> load -> view('shared_files/commodities/commodity_list_v');
  	 ?>
  	
  </div>
  <div class="tab-pane" id="profile">stats</div>
  <div class="tab-pane" id="messages">settings</div>
  
  </div>

		</div>
	</div>
	
	
</div>




<script>
	
	$(document).ready(function () {
		
		$('#myTab a').click(function (e) {
 		 e.preventDefault()
  			$(this).tab('show')
})
		
	});
	
	
</script>