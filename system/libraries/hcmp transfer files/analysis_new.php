<?php 
 function calculate_percentage($val1,$val2){
            $percentage = ($val2/$val1)*100;
            return @round($percentage);
        }
 ?>

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
		  <div id="chart_2" style="width:100%; height:200px;" ></div>
        </td>
    </tr>
    				
	 </tr>
	 <tr class="accordion"><td colspan="4">2. TRAINING EVALUATION</td></tr>
	  	<tr>
    			<td>
                <?php 
                $fbo1 = $facility_evaluation[0]['total'];
                $opi1 = $facility_evaluation[2]['total'];
                $gok1 = $facility_evaluation[1]['total'];

                $totals = $fbo1 + $opi1 + $gok1;
                 
                
                $fbo = ($fbo1/$totals)*100;
                $opi = ($opi1/$totals)*100;
                $gok = ($gok1/$totals)*100;

                // second chart

                $fhead1 = $get_personel_trained[0]['fhead'];
                $fdep1 = $get_personel_trained[0]['fdep'];
                $nurse1 = $get_personel_trained[0]['nurse'];
                $store_manager1 = $get_personel_trained[0]['sman'];
                $pharm_tech1 = $get_personel_trained[0]['ptech'];

                $totals1 = $fhead1 +$fdep1+$nurse1+$store_manager1+$pharm_tech1;

                $fhead = ($fhead1/$totals1)*100;
                $fdep = ($fdep1/$totals1)*100;
                $nurse = ($nurse1/$totals1)*100;
                $store_manager = ($store_manager1/$totals1)*100;
                $pharm_tech = ($pharm_tech1/$totals1)*100;

                // print_r($get_personel_trained[0]['nurse']);
                // print_r($get_training_resource[0]);
                // print_r($get_training_resource[0]['comp']);

                $comp1 = $get_training_resource[0]['comp'];
                $modem1 = $get_training_resource[0]['modem'];
                $bundles1 = $get_training_resource[0]['bundles'];
                $manual1 = $get_training_resource[0]['manual'];

                $totals11 = $comp1 +$modem1+$bundles1+$manual1;

                $comp = ($comp1/$totals11)*100;
                $modem = ($modem1/$totals11)*100;
                $bundles = ($bundles1/$totals11)*100;
                $manual = ($manual1/$totals11)*100;

                // print_r($get_use_freq[0]);
                // echo "<br>";
                // print_r($get_use_freq[1]);
                // echo "<br>";
                // print_r($get_use_freq[2]);
                // exit;

                 ?>
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
       
       
        // print_r($scheduled_training);
        // $scheduled_total= $scheduled_training[0]['total'];
        // $scheduled_agreed = $scheduled_training[0]['actual'];
        // $total_facilities = $facility_total[0]['total'];

    				$percentageY= calculate_percentage($scheduled_training[0]['actual'],$scheduled_training[0]['total']);
					// $percentageN=100-$percentageY;
					$percentageN=100 - $percentageY;
    			echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'> YES ".$percentageY ."% </div>

    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'> NO ".$percentageN."% </div></div>"; 
    					 ?>
    				</td>

	</tr>	

	<tr>
	<td>
		<p >Were you given the appropriate feedback and encouragement during the training by the coordinator?</p>
	</td>
	<td>
		<?php

        $percentageY= calculate_percentage($feedback_training[0]['actual'],$feedback_training[0]['total']);
                    // $percentageN=100-$percentageY;
                    $percentageN=100 - $percentageY;
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
        // print_r($pharm_supervision);
        // print_r($pharm_supervision[1]['actual']);
        // print_r($pharm_supervision[1]['total']);
        // exit;
        $percentageY= calculate_percentage($pharm_supervision[1]['total'],$pharm_supervision[1]['actual']);
                    // $percentageN=100-$percentageY;
                    $percentageN=100 - $percentageY;
		echo  "<p>District Pharmacist  </p><div class='progress'><div class='bar'  style='float:left;width:$percentageY%; clear:none; background:$statusY'>YES ".$percentageY ."% </div>
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
        // print_r($req_id);
        // exit;
        $percentageY= calculate_percentage($req_id[1]['total'],$req_id[1]['actual']);
                    // $percentageN=100-$percentageY;
                    $percentageN=100 - $percentageY;
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
         $percentageY= calculate_percentage($req_addr[1]['total'],$req_addr[1]['actual']);
                    // $percentageN=100-$percentageY;
                    $percentageN=100 - $percentageY;
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
        // print_r($train_useful);

        // exit;
        // $percentageY= calculate_percentage($train_useful[1]['total'],$train_useful[1]['actual']);
        //             // $percentageN=100-$percentageY;
        //             $percentageN=100 - $percentageY;
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
        // print_r($req_addr);
        $percentageY= calculate_percentage($req_addr[0]['total'],$req_addr[1]['actual']);
                    // $percentageN=100-$percentageY;
                    $percentageN=100 - $percentageY;
			echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'> NO".$percentageN ."% </div></div></div></td>";
		 ?>
	</td>
	</tr>
	<tr>
	<td>
		<p >Does it meet your expectations in commodity management?</p>
	</td>
	<td>
		<?php 
        $percentageY= calculate_percentage($meet_expect[0]['total'],$meet_expect[1]['actual']);
                    // $percentageN=100-$percentageY;
                    $percentageN=100 - $percentageY;
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
        $percentageY= calculate_percentage($retrain[0]['total'],$retrain[0]['actual']);
                    // $percentageN=100-$percentageY;
                    $percentageN=100 - $percentageY;
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
	<tr>
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
            ['FBO',<?php echo $fbo ?>],
            ['Other Public Institutions',<?php echo $opi ?>],
            ['GOK',<?php echo $gok ?>],
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
                text: ''
            }
        },
        series: [{
            name: 'Personel Trained',
            data: [
            ['Facility Deputy', <?php echo $fdep ?>],
            ['Nurse', <?php echo $nurse ?>],
            ['Facility Head', <?php echo $fhead ?>],
            ['Pharmacy Technologist',<?php echo $pharm_tech ?>],
            ['Store Manager',<?php echo $store_manager ?>],
            ['Head',<?php echo $fdep ?>]
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
            ['Computers',<?php echo $comp  ?>], 
            ['Modems',<?php echo $modem  ?>], 
            ['Bundles',<?php echo $bundles ?>], 
            ['Manuals',<?php echo $manual ?>]
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
            text: ''
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


