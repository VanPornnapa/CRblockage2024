
<!doctype html>
<html>
  <head>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <style>
        #container {
        height: 800px; 
        min-width: 900px; 
        max-width: 1200px; 
        margin: 0 auto; 
        }
        .loading {
            margin-top: 10em;
            text-align: center;
            color: gray;
        }
        .a {
            color: hotpink;
        }
    </style>
    <!-- <script src="https://code.highcharts.com/maps/highmaps.js"></script> -->
    <!-- <script src="https://code.highcharts.com/maps/modules/exporting.js"></script> -->
    <!-- <script src="https://code.highcharts.com/mapdata/countries/th/th-all.js"></script> -->
    <script src="{{ asset('js/rain/highmap.js') }}"></script>
    <script src="{{ asset('js/rain/thai-all.js') }}"></script>
    
  </head>
  <body>
    <div id="container"></div>
    <script>
        var data = [
        ['th-pr', 47],
        ['th-py', 48],
        ['th-mh', 33],
        ['th-cr', 37],
        ['th-cm', 45],
        ['th-ln', 59],
        ['th-na', 70],
        ['th-lg', 71],
    ];

    // Create the chart
    Highcharts.mapChart('container', {
        chart: {
            map: 'countries/th/th-all',
            style: {
                fontFamily: 'Mitr'
            }
        },

        title: {
            text: 'แผนที่ประเทศไทย'
        },

        // subtitle: {
        //     text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/th/th-all.js">Thailand</a>'
        // },

        // mapNavigation: {
        //     enabled: true,
        //     buttonOptions: {
        //         verticalAlign: 'bottom'
        //     }
        // },

        colorAxis: {
            min: 0
        },
        drilldown: {
            activeAxisLabelStyle: {
                cursor: 'default',
                color: '#3E576F',
                fontWeight: 'normal',
                textDecoration: 'none'
            },
            activeDataLabelStyle: {
                cursor: 'default',
                color: '#3E576F',
                fontWeight: 'normal',
                textDecoration: 'none'
            }
        },

        series: [{
            data: data,
            name: 'จังหวัด',
            states: {
                hover: {
                    color: '#BADA55'
                }
            },
            // dataLabels: {
            //     enabled: true,
            //     format: '{point.name}'
            // }
            dataLabels: {
                enabled: true,
                color: '#FFFFFF',
                formatter: function () {
                    if (this.point.value) {
                        return this.point.name;
                    }
                }
            },
            tooltip: {
                headerFormat: '',
                pointFormat: '{point.name}'
            }
        }]
    });
    </script>
  </body>
</html>



