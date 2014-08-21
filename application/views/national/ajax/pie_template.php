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
                name: 'In Numbers',
                data: [
                    ['Public',   45.0],
                    ['Private',       26.8],
                    {
                        name: 'Faith based	',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Others',    8.5]
                    
                ]
            }]
        });
    });

});
</script>


