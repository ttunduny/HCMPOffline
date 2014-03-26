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
      <div class="panel-body" style="overflow-x: scroll">
        <div style="/*border: 1px solid #036;*/ ;" id="container"></div>
      </div>
    </div>
	</div>
	
	
</div>


</div>
<script>
	
	$(function () {
        $('#container').highcharts({
            chart: {
            	zoomType:'x',
                type: 'column'
            },
            title: {
                text: 'Stacked column chart'
            },
            xAxis: {
                categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas','Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas','Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas','Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas','Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total fruit consumption'
                }
            },
            tooltip: {
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                shared: true
            },
            plotOptions: {
                column: {
                    stacking: 'percent'
                }
            },
                series: [{
                name: 'John',
                data: [5, 3, 4, 7, 2,5, 3, 4, 7, 2,5, 3, 4, 7, 2,5, 3, 4, 7, 2,3, 4, 4, 2, 5]
            }, {
                name: 'Jane',
                data: [5, 3, 4, 7, 2,2, 2, 3, 2, 1,3, 4, 4, 2, 5,3, 4, 4, 2, 5,4, 2, 5,2, 2]
            }, {
                name: 'Joe',
                data: [3, 4, 4, 2, 5,2, 2, 3, 2, 1,2, 2, 3, 2, 1,5, 3, 4, 7, 2,2, 3, 2, 1,5]
            }]
        });
    });
</script>