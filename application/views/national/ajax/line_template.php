 <script>
   $(function () {
    $('#roll_out').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Roll Out Summary'
        },
        subtitle: {
            text: 'Source:HCMP'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Roll Out',
            data: [
                ['Rolled Out', 181],
                ['Targeted', 300]
               
            ]
        }]
    });
});
</script>


