<div class="container" style="width: 96%; margin: auto;">

<div class="row">
	
	<div class="col-md-4">
		<div class="row">
			
			<div class="col-md-12">
				
				<div class="panel panel-success">
      				<div class="panel-heading">
        		<h3 class="panel-title">Notification <span class="glyphicon glyphicon-bell"></span> </h3>
      		</div>
      <div class="panel-body">
      	
      		
      	<div style="height:auto; margin-bottom: 2px" class="warning message ">
        	
        	<h5><span class="badge">2</span>Orders Pending Approval by District Pharmacist</h5> 
        	<p>
			<a class="link" href="">   Order(s) Pending.</a> 
			</p>
        </div>
        
        <div style="height:auto; margin-bottom: 2px" class="warning message ">
        	
        	 <h5> <span class="badge">42</span> Expired Commodities</h5>
        	<p>
			<a class="link" href=""> Expired Commodities awaiting decommisioning.</a> 
			</p> 
        </div>
        
        
        
      </div>
      
    </div>
			</div>
		</div>
	
	<div class="row">
			
			<div class="col-md-12">
				
				<div class="panel panel-success">
      				<div class="panel-heading">
        		<h3 class="panel-title">Actions <span class="glyphicon glyphicon-list-alt"></span></h3>
      		</div>
      <div class="panel-body">
        <div style="height:auto; margin-bottom: 2px" class="issue message ">
        	<a href=""><h5>Issue Commodities to service points</h5></a>
        	 
        </div>

         <div style="height:auto; margin-bottom: 2px;color: #428bca !important;" class="order message " id="order_tab">
            <h5>Orders</h5>
             
        </div>
         <div style="height:auto; margin-bottom: 2px" class="" id="order_hide">
            <a href="<?php echo base_url().'reports/facility_transaction_data/1'; ?>"><h5>KEMSA</h5></a>
            <a href=""><h5>MEDS</h5></a>
             
        </div>

        
        <div style="height:auto; margin-bottom: 2px" class="distribute message ">
        	<a href=""><h5>Redistribute Commodities to other facilities</h5></a>
        	 
        </div>
        
 		<div style="height:auto; margin-bottom: 2px" class="distribute message ">
        	<a href=""><h5>Receive Commodities From Other Sources</h5></a>
        	 
        </div>        
         <div style="height:auto; margin-bottom: 2px" class="order message ">
        	<a href=""><h5>Redistribute Commodities to other facilities</h5></a>
        	 
        </div>
         <div style="height:auto; margin-bottom: 2px" class="delivery message ">
        	<a href=""><h5>Update order delivery</h5></a>
        	 
        </div>
        
        <div style="height:auto; margin-bottom: 2px" class="reports message ">
            <a href=""><h5>Reports</h5></a>
             
        </div>
        
      </div>
      
    </div>
			</div>
		</div>
		
	</div>
	
	<div class="col-md-8">
		
		<div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Graph <span class="glyphicon glyphicon-stats" style=""></span><span class="glyphicon glyphicon-align-left" style="margin-left: 1%"></span></h3>
      </div>
      <div class="panel-body" style="overflow-y: auto">
        <div style="/*border: 1px solid #036;*/ ;" id="container"></div>
      </div>
    </div>
	</div>
	
	
</div>


</div>
<script>

	
   $(document).ready(function() {
       $('#order_hide').hide() 

       $('#order_tab').click(function(event) {
           /* Act on the event */
           $('#order_hide').toggle('slow')
       }); 

	
       <?php echo $facility_dashboard_notifications['faciliy_stock_graph'] ?>

    });
</script>