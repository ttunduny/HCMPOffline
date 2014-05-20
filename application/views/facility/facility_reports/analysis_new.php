
<style type="text/css" title="currentStyle">    
 p{
 	font-size: 14px;
 }
.leftpanel{
width: 17%;
height:auto;
float: left;
padding-left: 1em;
}

 .dash_main{
    width: 80%;
    min-height: 100%;
    height:600px;
    float: left;
       -webkit-box-shadow: 2px 2px 6px #888;
	box-shadow: 2px 2px 6px 2px #888; 
    margin-left:0.75em;
    margin-bottom:0em;
    
    }
    .accordion {
margin: 0;
padding:5%;
height:15px;
border-top:#f0f0f0 1px solid;
background: #cccccc;
font:normal 1.3em 'Trebuchet MS',Arial,Sans-Serif;
text-decoration:none;
text-transform:uppercase;
background: #29527b; /* Old browsers */
border-radius: 0.5em;
color: #fff; }

</style>

<!-- <div class="dash_main" style="overflow: auto"> -->
	<div class='label label-info'>The below analysis is retrieved from  <?php echo $coverage_data['total_evaluation'] ?>  
		out of <?php echo $coverage_data['total_facilities'] ?> facilities that underwent the Evaluation process. – 
		Coverage <?php
		$total=0;
		$total=@round(($coverage_data['total_evaluation']/$coverage_data['total_facilities'])*100);
		 echo $total ?>%</div>
		 <table width="100%" class="table table-bordered">
	<tr class="accordion"><td colspan="4">1. FACILITY INFORMATION</td></tr>
	<tr>
    			<td>
      				<!-- <label style=" font-weight:bold">Facility Type Evaluated </label> -->
      				<div id="chart_1" style="width:100%; height:200px;" ></div></td>
      				<td>
    					<!-- <label style=" font-weight:bold">Personel Trained</label> -->
      				  <div id="chart_2" style="width:100%; height:200px;" ></div></td>
    </tr>
    				
	 </tr>
	 <tr class="accordion"><td colspan="4">2. TRAINING EVALUATION</td></tr>
	  	<tr>
    			<td>
    				<!-- <label style=" font-weight:bold">Appropriate Resources During Training</label> -->
      				<div id="chart_3" style="width:100%; height:200px;"></div>
            	  	</td>			
    				<td>
    					<!-- <label style=" font-weight:bold">Satisfaction Level</label> -->
      				 <div id="chart_4" style="width:100%; height:200px;"></div>
    				</td>
    				</tr>
  	  	<tr>
    			 				
    				<td>
    				<p>Was the training carried out in agreement to the agreed date and time?</p></td>
    				<td>
    				<?php 
    				$statusY="#7ada33";
					$statusN="#e93939";

    				$percentageY=50;
					// $percentageN=100-$percentageY;
					$percentageN=50;
    			echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>

    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>NO ".$percentageN."% </div></div>"; 
    					 ?>
    				</td>

	</tr>	

	<tr>
	<td>
		<p >Were you given the appropriate feedback and encouragement during the training by the coordinator?</p>
	</td>
	<td>
		<?php
		echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>NO ".$percentageN ."% </div></div>"; 
		 ?>
	</td>
	</tr>

	<tr>
	<td>
		<p>Did the District Pharmacist or District Coordinator carry out further supervision visits to support you in the use of the tool?</p>
	</td>
	<td>
		<?php 
		echo  "<p>District Pharmacist  </p><div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div>"; 
		 ?>
	</td>
	</tr>

	<tr>
	<td>
		<p>Did you identify any requirements during training that needed to be addressed?</p>
	</td>
	<td>
		<?php 
			echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
    				  
		 ?>
	</td>
	</tr>

	<tr>
	<td>
		<p>Have the requirements been addressed?</p>
	</td>
	<td>
		<?php 
			echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
		 ?>
	</td>
	</tr>

	<tr>
	<td>
		<p>Did you find the training useful?</p>
	</td>
	<td>
		<?php 
			echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
		 ?>
	</td>
	</tr>
	<tr class="accordion"><td colspan="4">3. WEB TOOL EVALUATION</td></tr>
	<tr>
	       	<td>
	       		<label style=" font-weight:bold">How frequently do you use the system in commodity management
	       		</label>
      				 <div id="chart_5" style="width:100%; height:200px;"></div>
	       	</td>
	       	<td>
	       		<div id="chart_6" style="width:100%; height:200px;"></div>
	       	</td>
	</tr>
	<tr>
	<td>
		<p >Is the tool easy to use and understand?</p>
	</td>
	<td>
		<?php 
			echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>";
		 ?>
	</td>
	</tr>
	<tr>
	<td>
		<p >Does it meet your expectations in commodity management?</p>
	</td>
	<td>
		<?php 
		echo  "<div class='progress'><div class='bar'  style='float:left; width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    		<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>";
		 ?>
	</td>
	</tr>
	<tr>
	<td>
		<p >Would you be willing to re-train facility staff on the use and importance of the tool?</p>
	</td>
	<td>
		<?php 
			echo  "
			<div class='progress'>
			<div class='bar' style='float:left; width:$percentageY%; background:$statusY'>YES ".$percentageY ."% </div>
    		<div class='bar' style='float:right; width:$percentageN%; background:$statusN'>NO".$percentageN ."% </div>
    			
    			</div>";
		 ?>
	</td>
	<td>
		
	</td>
	</tr>
	</table>
<!-- </div> -->


<!-- 		<div id="facilityheader"><h2>FACILITY INFORMATION</h2></div>
		<div id="container1"></div>
		<div id="container2"></div>
	</tr>
    <tr>
        <div id="trainingheader"><h2>TRAINING EVALUATION</h2></div>

        <div id="container3" style="width:50%; height:100%;"></div>
		<div id="container4" style="width:50%; height:100%;"></div>
	</tr>
    <tr>
    <p>Was the training carried out in agreement to the agreed date and time?</p>
    </tr>
    <tr>
    <p>Were you given the appropriate feedback and encouragement during the training by the coordinator?</p>
	</tr>
    <tr>
    <p>Did the District Pharmacist or District Coordinator carry out further supervision visits to support you in the use of the tool?</p>
    </tr>
    <tr>
    <p>Did you identify any requirements during training that needed to be adressed?</p>
    </tr>
    <tr>
    <p>Have the requirements been adressed?</p>
    </tr>
    <tr>
    <p>Did you find the training useful?</p>
    </tr>
    </table>
    </div> -->
    
<script>
	$(function () { 
    $('#chart_1').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Facility Type Evaluated'
        },
        xAxis: {
            categories: ['FBO', 'Other Public Institutions', 'GOK']
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        series: [{
            name: 'Facility Type',
            data: [
            ['FBO',2],
            ['Other Public Institutions',1],
            ['GOK',88],
            ]
        }]
    });
});
$(function () { 
    $('#chart_2').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Personel Trained'
        },
        xAxis: {
            categories: ['Facility Deputy','Nurse','Facility Head','Pharmacy Technologist','Store Manager','Head']
        },
        yAxis: {
            title: {
                text: 'Fruit eaten'
            }
        },
        series: [{
            name: 'Personel Trained',
            data: [
            ['Facility Deputy', 40],
            ['Nurse', 20],
            ['Facility Head', 10],
            ['Pharmacy Technologist',10],
            ['Store Manager',10],
            ['Head',10]
            ]
        }]
    });
});

//THIS IS CONTAINER 2

$(function () { 
    $('#chart_3').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Appropriate Resources During Training'
        },
        xAxis: {
            categories: ['Computers', 'Modems', 'Bundles','Manuals']
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        series: [{
            name: 'Appropriate Resources in %',
            data: [
            ['Computers',50], 
            ['Modems',70], 
            ['Bundles',30], 
            ['Manuals',40]
            ]
        }]
    });
});

//THIS IS CONTAINER 3

$(function () { 
    $('#chart_4').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'System Use Satisfaction Level'
        },
        xAxis: {
            categories: ['Satisfied']
        },
        yAxis: {
            title: {
                text: 'Indefferent'
            }
        },
        series: [{
            name: 'Satisfaction Level',
            data: [
            ['Satisfied',87],
            ['Indefferent',23]]

      	}
        ]
    });
});

$(function () { 
    $('#chart_5').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Appropriate Resources During Training'
        },
        xAxis: {
            categories: ['Daily', 'Once a week', 'Once every 2 weeks','Never']
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        series: [{
            name: 'Frequency of Use',
            data: [
            ['Daily',50], 
            ['Once a week',70], 
            ['Once every 2 weeks',30], 
            ['Never',40]
            ]
        }]
    });
});

$(function () { 
    $('#chart_6').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Comfort Level in Using the System'
        },
        xAxis: {
            categories: ['Issue Commodities','Order Commodities','Update Order','Generate Reports',]
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        series: [{
            name: 'Comfort Level',
            data: [
            ['Issue Commodities',50], 
            ['Order Commodities',70], 
            ['Update Order',30], 
            ['Generate Reports',40]
            ]
        }]
    });
});
</script>


