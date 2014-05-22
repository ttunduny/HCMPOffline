    <table>
    <tr>
    <div id="chartsspace">
		<div id="facilityheader"><h2>FACILITY INFORMATION</h2></div>
		<div id="container1" style="width:50%; height:100%;"></div>
		<div id="container2" style="width:50%; height:100%;"></div>
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
    </div>

<script>
	$(function () { 
    $('#container1').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Facility Type Evaluated'
        },
        xAxis: {
            categories: ['Apples', 'Bananas', 'Oranges']
        },
        yAxis: {
            title: {
                text: 'Fruit eaten'
            }
        },
        series: [{
            name: 'Richard',
            data: [1, 0, 4]
        }, {
            name: 'Karsan',
            data: [5, 7, 3]
        }]
    });
});
$(function () { 
    $('#container2').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Personel Trained'
        },
        xAxis: {
            categories: ['Apples', 'Bananas', 'Oranges']
        },
        yAxis: {
            title: {
                text: 'Fruit eaten'
            }
        },
        series: [{
            name: 'Adima',
            data: [1, 0, 4]
        }, {
            name: 'Mesa',
            data: [5, 7, 3]
        }]
    });
});

//THIS IS CONTAINER 2

$(function () { 
    $('#container3').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Bar Graph One'
        },
        xAxis: {
            categories: ['Apples', 'Bananas', 'Oranges']
        },
        yAxis: {
            title: {
                text: 'Fruit eaten'
            }
        },
        series: [{
            name: 'Jane',
            data: [1, 0, 4]
        }, {
            name: 'John',
            data: [5, 7, 3]
        }]
    });
});

//THIS IS CONTAINER 3

$(function () { 
    $('#container4').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Bar Graph Two'
        },
        xAxis: {
            categories: ['Apples', 'Bananas', 'Oranges']
        },
        yAxis: {
            title: {
                text: 'Fruit eaten'
            }
        },
        series: [{
            name: 'Jane',
            data: [1, 0, 4]
        }, {
            name: 'John',
            data: [5, 7, 3]
        }]
    });
});

</script>

<div class="leftpanel">
<h3 class="accordion" id="leftpanel"><span> Evaluation Forms Analysis</span></h3>
</div>
<div class="dash_main" style="overflow: auto">
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
                    <label style=" font-weight:bold">Facility Type Evaluated </label>
                    <div id="chart_1"></div></td>
                            
                    <td>
                        <label style=" font-weight:bold">Personel Trained</label>
                      <div id="chart_2"></div></td>
                    
 </tr>
    
    <tr class="accordion"><td colspan="4">2. TRAINING EVALUATION</td></tr>
        <tr>
                <td>
                    <label style=" font-weight:bold">Appropriate Resources During Training</label>
                    <div id="chart_3"></div>
                    </td>           
                    <td>
                        <label style=" font-weight:bold">Satisfaction Level</label>
                     <div id="chart_4"></div>
                    </td>
    </tr>
        <tr>
                                
                    <td>
                    <p>Was the training carried out in agreement to the agreed date and time?</p></td><td> <?php 
                    
                    $statusY="#7ada33";
                    $statusN="#e93939";
                    
                    
                    $yes=0;
                    foreach($sheduled_training as $data):
                    $total_responses=$data['total'];
                    if($data['agreed_time']==1):
                    
                    $yes=$data['actual'];
                    endif;
                    
                    endforeach;
                    
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=@round((($yes-$total_responses)/$total_responses)*100);
                                    
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=100-$percentageY;
                                    
                    echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
                    <div class='bar' style='float:right; width:$percentageN%;background:$statusN'>NO ".$percentageN ."% </div></div></div></td>"; 
                      ?>
                    </tr>
                    <tr>
                    <td>
                    <p >Were you given the appropriate feedback and encouragement during the training by the coordinator?</p></td><td><?php 
                    $total_responses=0;
                    $yes=0;
                    foreach($feedback_training as $data):
                    $total_responses=$data['total'];
                    if($data['feedback']==1):
                    
                    $yes=$data['actual'];
                    endif;
                    
                    endforeach;
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=100-$percentageY;
                                    
                    echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
                    <div class='bar' style='float:right; width:$percentageN%;background:$statusN'>NO ".$percentageN ."% </div></div></div></td>"; 
                      ?>    
                      </td> 
                    </tr>
                    
                    <tr>
                        <td>
                    <p>Did the District Pharmacist or District Coordinator carry out further supervision visits to support you in the use of the tool?</p></td>
                    
                    <td>     <?php
                        $total_responses=0;
                    $yes=0;
                    foreach($pharm_supervision as $data):
                    $total_responses=$data['total'];
                    if($data['pharm_supervision']==1):
                    
                    $yes=$data['actual'];
                    endif;
                    
                    endforeach;
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=100-$percentageY;
                    
                    echo  "<p>District Pharmacist  </p><div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
                    <div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div>"; 
                      ?></p></td>   
                      <td>
                       <?php 
                    $total_responses=0;
                    $yes=0;
                    foreach($coord_supervision as $data):
                    $total_responses=$data['total'];
                    if($data['coord_supervision']==1):
                    
                    $yes=$data['actual'];
                    endif;
                    
                    endforeach;
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=100-$percentageY;
                    
                    echo  "<p>District Coordinator</p><div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
                    <div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div>"; 
                      ?>
                      </td> 
                    </tr>
                        <tr>
                            <td>
                    <p>Did you identify any requirements during training that needed to be addressed?</p></td><td><?php
                        $total_responses=0;
                    $yes=0; 
                    foreach($req_id as $data):
                    $total_responses=$data['total'];
                    if($data['req_id']==1):
                    
                    $yes=$data['actual'];
                    endif;
                    
                    endforeach;
                    
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=100-$percentageY;
                                    
                    echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
                    <div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
                      ?>
                    
                    </tr>
                    
                    <tr>
                        <td>
                    <p>Have the requirements been addressed?</p></td><td><?php
                        $total_responses=0;
                    $yes=0; 
                    foreach($req_addr as $data):
                    $total_responses=$data['total'];
                    if($data['req_addr']==1):
                    
                    $yes=$data['actual'];
                    endif;
                    
                    endforeach;
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=100-$percentageY;
                                    
                    echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
                    <div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
                      ?>
                      </td> 
                    </tr>
                    <tr>
                        <td>
                    <p>Did you find the training useful?</p></td><td><?php
                        $total_responses=0;
                    $yes=0; 
                    
                    foreach($train_useful as $data):
                    $total_responses=$data['total'];
                    if($data['train_useful']==1):
                    
                    $yes=$data['actual'];
                    endif;
                    
                    endforeach;
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=100-$percentageY;
                                    
                    echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
                    <div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
                      ?>    
                      </td> 
                    </tr>

        <tr class="accordion"><td colspan="4">3. WEB TOOL EVALUATION</td></tr>
           <tr>
            <td>
                <label style=" font-weight:bold">How frequently do you use the system in commodity management</label>
                     <div id="chart_5"></div>
            </td>
            <td>
            <label style=" font-weight:bold">Comfort level in using the syste</label>
                     <div id="chart_6"></div>   
            </td>
           </tr>
                     <tr>
                        <td>
                    <p > Does the web tool improve commodity management in your facility?</td><td> <?php
                        $total_responses=0;
                    $yes=0; 
                    
                    foreach($improvement as $data):
                    $total_responses=$data['total'];
                    if($data['improvement']==1):
                    
                    $yes=$data['actual'];
                    endif;
                    
                    endforeach;
                    
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=100-$percentageY;
                                    
                    echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
                    <div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
                      ?>
                      </td> 
                    </tr>
                    
                    <tr>
                        <td>
                    <p >Is the tool easy to use and understand?</p></td><td><?php
                        $total_responses=0;
                    $yes=0; 
                    
                    foreach($ease_of_use as $data):
                    $total_responses=$data['total'];
                    if($data['ease_of_use']==1):
                    
                    $yes=$data['actual'];
                    endif;
                    
                    endforeach;
                    
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=100-$percentageY;
                                    
                    echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
                    <div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
                      ?>
                      </td> 
                    </tr>
                    <tr>
                        <td>
                    <p >Does it meet your expectations in commodity management?</p></td><td><?php
                        $total_responses=0;
                    $yes=0; 
                
                    foreach($meet_expect as $data):
                    $total_responses=$data['total'];
                    if($data['meet_expect']==1):
                    
                    $yes=$data['actual'];
                    endif;
                    
                    endforeach;
                
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=100-$percentageY;
                                    
                    echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
                    <div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
                      ?>
                      </td> 
                    </tr>
                    <tr>
                        <td>
                    <p >Would you be willing to re-train facility staff on the use and importance of the tool?</p></td><td><?php
                        $total_responses=0;
                    $yes=0; 
                    
                    foreach($retrain as $data):
                    $total_responses=$data['total'];
                    if($data['retrain']==1):
                    
                    $yes=$data['actual'];
                    endif;
                    
                    endforeach;
                    
                    $percentageY=@round(($yes/$total_responses)*100);
                    $percentageN=100-$percentageY;
                                    
                    echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
                    <div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
                      ?>    </p>
                      </td> 
                    </tr>
                    </table>

</div>
