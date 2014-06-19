<style>
.stat_item {
		height: 48px;
		padding: 2px 20px;
		color: #fff;
		text-align: center;
		font-size: 1.5em;
		-webkit-box-shadow: 3px 0px 5px 0px rgba(51, 50, 50, 0.59);
-moz-box-shadow:    3px 0px 5px 0px rgba(51, 50, 50, 0.59);
box-shadow:         3px 0px 5px 0px rgba(51, 50, 50, 0.59);
	}	
</style>



<div class="row" style="padding-top: 1%" >
	
	<div class="col-md-2">
					<div class="color_g stat_item">
						<span class="glyphicon glyphicon-user"></span>
                  	Users
                            
                   </div>
	</div>
	
	<div class="col-md-2">
					<div class="color_e stat_item">
						<span class="glyphicon glyphicon-shopping-cart"></span>
                 	 Orders
                            
                   </div>
	</div>
	
	<div class="col-md-2">
					<div class="color_f stat_item">
						<span class="glyphicon glyphicon-usd"></span>
                 	 
                        Order total Ksh    
                   </div>
	</div>
	
	<div class="col-md-2">
					<div class="color_c stat_item">
						<span class="glyphicon glyphicon-map-marker"></span>
                  
                     Counties       
                   </div>
	</div>
	<div class="col-md-2">
					<div class="color_b stat_item">
						<span class="glyphicon glyphicon-pushpin"></span>
                  
                    xyz      
                   </div>
	</div>
	<div class="col-md-2">
					<div class="color_a stat_item">
					<span class="glyphicon glyphicon-dashboard"></span>
                  
                    qwe      
                   </div>
	</div>
	
</div>

<div class="row" style="margin-top: 1%" >


<div class="col-md-7" style="height:300px;border: 0px solid #036;" id="container">



</div>
<div class="col-md-5" style="height:300px;border: 0px solid #036;">



</div>

</div>

<script>
$(document).ready(function () {
	
	$(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Browser market shares at a specific website, 2014'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                    ['Firefox',   45.0],
                    ['IE',       26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]
                ]
            }]
        });
    });
    
});
	
	

    
     });
	
</script>