
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 " style="padding:0;border-radius: 0;margin-top: -2% ">
<div class="">
<div style="height:100%;width:100%;margin: 0 auto;" id="graph-section"></div>
</div>
</div>

<script>
  $(document).ready(function () {
  	//default 
	 
	  ajax_request_replace_div_content('divisional_reports/generate_antimalarial_graph_ajax/1',"#graph-section");	 

	// $('#graph-section').highcharts({ 
	// 	chart: { zoomType:'x', type: 'bar' },
	// 	credits: { enabled:false}, 
	// 	title: {text: 'Nairobi County Antimalarial Stocks'}, 
	// 	yAxis: { min: 0, title: {text: 'Quantity in Packs' }},
	// 	 subtitle: {text: 'Source: HCMP', x: -20 },
	// 	  xAxis: { categories: ["Dagoretti","Embakasi","Kamukunji","Ruaraka","Langata","Makadara","Kasarani","Starehe","Westlands"] },
	// 	  colors:'' , tooltip: { crosshairs: [true,true] }, scrollbar: { enabled: true }, plotOptions: {
	// 	   series: { pointWidth: 18, stacking: '', dataLabels: { enabled: false, rotation: -45, color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black' } } }, 
	// 	   series: [{ "id":"1","name":"Dagoretti","data":[12,21,0,18]},{"id":"2","name":"Embakasi","data":[2,1,0,6]},{"id":"3","name":"Kamukunji","data":[8,6,0,7]},{"id":"4","name":"Ruaraka","data":[15,22,0,24]},{"id":"5","name":"Langata","data":[11,10,0,13]},{"id":"6","name":"Makadara","data":[16,12,0,18]},{"id":"7","name":"Kasarani","data":[19,28,0,26]},{"id":"8","name":"Starehe","data":[18,18,0,19]},{"id":"9","name":"Westlands","data":[26,25,0,25]},] });
	 
	 
	});
</script>