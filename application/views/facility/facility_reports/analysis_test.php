<?php 

class analysis_test extends MY_Controller
{
	
	function __construct() 
	{
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
		$this->create_high_chart_graph();
		
	}
}

public function create_high_chart_graph($graph_data=null)
  {
  	$high_chart='';
  	if(isset($graph_data)):
		$graph_id=$graph_data['graph_id'];
		$graph_title=$graph_data['graph_title'];
		$graph_type=$graph_data['graph_type'];
		$graph_categories=json_encode($graph_data['graph_categories']);
		//echo json_encode($graph_data['graph_categories']);
		$graph_yaxis_title=$graph_data['graph_yaxis_title'];
		$graph_series_data=$graph_data['series_data'];
		//$new_array=$graph_series_data;
		//return ($graph_series_data[0]); key		
		//$size_of_graph=sizeof($graph_series_data[key($graph_series_data)])*200;
		//set up the graph here
		$high_chart .="
		$('#$graph_id').highcharts({
		    chart: { zoomType:'x', type: '$graph_type'},
            credits: { enabled:false},
            title: {text: '$graph_title'},
            yAxis: { min: 0, title: {text: '$graph_yaxis_title' }},
            subtitle: {text: 'Source: HCMP', x: -20 },
            xAxis: { categories: $graph_categories },
            tooltip: { crosshairs: [true,true] },
            series: [";			 
		    foreach($graph_series_data as $key=>$raw_data):
					$temp_array=array();
					$high_chart .="{ name: '$key', data:";					 
					  foreach($raw_data as $key_data):
						$temp_array=array_merge($temp_array,array((int)$key_data));
						endforeach;
					  $high_chart .= json_encode($temp_array)."},";				  
				   endforeach;
	     $high_chart .="]  })";

	endif;
	return $high_chart; 	
  }
 ?>