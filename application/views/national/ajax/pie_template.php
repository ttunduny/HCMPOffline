 <script>
    $(function () {

    $(document).ready(function () {

        // Build the chart
        $('#facility_breakdown').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Health Facilities In Numbers'
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
                name: 'In Numbers',
                data: [ ['Public',   <?php echo $public ;?>], 
		                ['Private', <?php echo $private ;?>],
		                ['Faith-Based',  <?php echo $fbo ;?>], 
		                ['Others',    <?php echo $other;?>] 
                
                 ]
                
            }]
        });
    });

});
</script>


