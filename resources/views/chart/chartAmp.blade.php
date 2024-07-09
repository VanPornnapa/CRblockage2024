<!DOCTYPE html>
<html>
<head>
    <title>Laravel 6 Highcharts Example - ItSolutionStuff.com</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
</head>
   
<body>

<div id="container"></div>
</body>
  
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
var pieColors = (function () {
    var colors = [],
        base = Highcharts.getOptions().colors[0],
        i;

    for (i = 0; i < 10; i += 1) {
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
    }
    return colors;
}());

    var users =  <?php echo json_encode($countNum) ?>;
    // alert (users);
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'สาเหตุการกีดขว้างทางน้ำ'
        },
        subtitle: {
            text: 'ในพื้นที่จังหวัดเชียงราย'
        },
         xAxis: {
            categories: ['สาเหตุจากธรรมชาติ', 'สาเหตุจากมุนษย์']
        },
        tooltip: {
             pointFormat: '<b>{point.percentage:.1f}%</b>'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: pieColors,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -80,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
    
        series: [{
            name: '',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});
</script>
</html>