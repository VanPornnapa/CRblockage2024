<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blockage::CRflood</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.css') }}">
    <!-- leaflet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/leaflet.groupedlayercontrol.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}"> --}}
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.2.0/leaflet-omnivore.min.js'></script>
    
    {{-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" /> --}}
    {{-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" type="text/css"> --}}
    
    <style type="text/css">
    	#map{

			  font-family: Mitr, sans-serif;
			  height: 550px;
			  display: block;
              margin: auto;
              text-align: left;
			}
		#map.table {
		    font-family: 'Mitr', sans-serif;
		    width: 100%;
		}#map.tr {
		    padding: 15px;
		    text-align: right;
		}}#map.td {
		    padding: 15px;
		    text-align: right;
		}

    </style>
        
</head>
   
<body>
    
    <div class="dashboard-main-wrapper">
        @include('includes.head')
        @include('includes.header')
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">กราฟแสดงสัดส่วนสิ่งกีดขว้างลำน้ำ จังหวัดเชียงราย</h2>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="dashboard-short-list">
                    <div class="row" >
                            <div class="col-2" style="background-color:#fff;">
                                <div class="card" style="margin-top:20px;">
                                    <table>
                                        <tr>
                                            <select>
                                                <option value="0">ทั้งหมด</option>
                                                <option value="เชียงของ">เชียงของ</option>
                                                <option value="เชียงแสน">เชียงแสน</option>
                                                <option value="เวียงแก่น">เวียงแก่น</option>
                                                <option value="เวียงชัย">เวียงชัย</option>
                                                <option value="เวียงเชียงรุ้ง">เวียงเชียงรุ้ง</option>
                                                <option value="แม่จัน">แม่จัน</option>
                                                <option value="แม่สาย">แม่สาย</option>
                                                <option value="แม่ฟ้าหลวง">แม่ฟ้าหลวง</option>
                                                <option value="ดอยหลวง">ดอยหลวง</option>
                                            </select>
                                        </tr>
                                    </table>
                                    <div class="row" style="background-color:#fff;margin:20px 20px 0 20px;">
                                        <h4> ข้อมูลจำนวนสิ่งกีดขว้าง </h4>
                                    </div>
                                    <div class="row" style="background-color:#fff;" >
                                        
                                        {{-- <table align="center" width="80%">
                                            <tr>
                                                <td colspan="3"><b>สาเหตุ</b></td>
                                            </tr>
                                            <tr>
                                                <td width="50%">ธรรมชาติ</td>
                                                <td width="5%">:</td>
                                            <td width="45%" align="center">{{$countNum[0][1]}} ({{number_format($countNum[0][1]/($countNum[0][1]+$countNum[1][1])*100,2)}}%)</td>
                                            </tr>
                                            <tr>
                                                <td>มนุษย์</td>
                                                <td>:</td>
                                                <td align="center">{{$countNum[1][1] }} ({{number_format($countNum[0][1]/($countNum[0][1]+$countNum[1][1])*100,2)}}%)</td>
                                            </tr>
                                        </table> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9" style="margin-left:20px;">
                                <div class="row" style="background-color:#fff;">
                                    <div class="col-md-12 col-md-offset-2 text-center">
                                        <div id="container" ></div>
                                        <div id="bar" ></div>
                                    </div>
                                </div>
                            </div>
                                    
                         </div>
                 </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->


    </div>


  
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">

    var users =  <?php echo json_encode($countbar) ?>;
    // alert (users);
    Highcharts.chart('container', {
        chart: {
            type: 'column',
            style: {
                fontFamily: 'Mitr|Prompt'
            },
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 0,
                depth: 100,
                viewDistance: 25
            }
        },
        title: {
            text: 'สาเหตุการกีดขว้างทางน้ำ'
        },
        subtitle: {
            text: 'ในพื้นที่จังหวัดเชียงราย'
        },
        xAxis: {
            type: 'category',
            labels: {
            rotation: -35,
            style: {
                fontSize: '13px',
                fontFamily: 'Mitr|Prompt'
            }
        }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0"></td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
             column: {
                depth: 25
            }

        },
    
        series: [{
            name: '',
            data: users,
            dataLabels: {
                enabled: true,
                rotation: 0,
                color: '#FFFFFF',
                align: 'center',
                format: '{point.y:.0f}', // one decimal
                y: 25, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Mitr|Prompt'
                }
            }
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
</body>
</html>