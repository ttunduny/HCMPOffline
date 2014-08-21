 <script>
   $(function () {
   	
    $('#mos').highcharts({
        chart: {
            type: 'bar'
        },
        
        title: {
            text: 'MOS'
        },
        subtitle: {
            text: 'Source: HCMP'
        },
        xAxis: {
            categories: ['Afrsadasdasdadasica', 'Ameasdasdasdaqwerica', 'Aseqweqqewia', 'Eweqweqqwurope', 'Oceqweqeqeweweqeania', 'cwqeewqeeqweqeqeac', 'Oceasqweqweqeecnia', 'Ocewwwwwwwwaniqwea'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' millions'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
         colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Year 1800',
            data: [107, 31, 635, 203, 50,90,17,88]
        }]
    });
});
</script>


