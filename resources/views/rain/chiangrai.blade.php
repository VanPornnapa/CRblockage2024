<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IDF Curve::CRflood</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.css') }}">
    <style>
        #container {
            height: 700px; 
            width: 100%; 
            margin: 0 auto; 
        }
        .loading {
            margin-top: 10em;
            text-align: center;
            color: gray;
        }
        @media only screen and (max-width:600px) {
            #container {
                height: 500px; 
                width: 100%; 
                margin: 0 auto; 
            }
        }
    </style>
    <script src="{{ asset('js/rain/highmap.js') }}"></script>
    <script src="{{ asset('js/rain/chiangrai.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    /* Style the input field */
        #myInput {
            padding: 10px;
            margin-top: -6px;
            border: 0;
            border-radius: 0;
        }
    </style>

     
</head>
<body>

    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
                <nav class="navbar navbar-expand-lg bg-white fixed-top">
                    <a class="navbar-brand" href="{{ url('/mapthai/chiangrai') }}">Intensity-Duration-Frequency Curve (IDF Curve)</a>
                   
                </nav>
        </div>
        <div class="container-fluid dashboard-content" style="margin-bottom:-40px;">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- ============================================================== -->
                    <!-- icon fontawesome solid  -->
                    <!-- ============================================================== -->
                    <div class="card">
                           
                            <div class="card-header">
                                <h3 class="card-title">กราฟความเข้มฝน-ช่วงเวลา-ความถี่การเกิด (IDF curve) ของจังหวัดเชียงราย </h3>
                                
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" align="center">
                                    <h5 class="card-subtitle" style="margin-left:20px;"> กดที่ชื่ออำเภอในแผนที่หรือสืบค้น (ค้นหา อำเภอ) เพื่อแสดงรูป IDF curve รายอำเภอของจังหวัดเชียงราย </h5>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6" >
                                    <br>
                                    <div class="dropdown" >
                                
                                        <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown" style="margin= 5px;">ค้นหา อำเภอ
                                            <span class="caret"></span>
                                        </button>
                                            <ul class="dropdown-menu">
                                                <input class="selectpicker" id="myInput" type="text" placeholder="ค้นหา..">
                                                <li><a href="{{ url('/mapthai/chiangrai/เมืองเชียงราย') }}">&nbsp; &nbsp;เมืองเชียงราย</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/ขุนตาล') }}">&nbsp; &nbsp;ขุนตาล</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เชียงของ') }}">&nbsp; &nbsp;เชียงของ</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เชียงแสน') }}">&nbsp; &nbsp;เชียงแสน</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เวียงแก่น') }}">&nbsp; &nbsp;เวียงแก่น</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เวียงเชียงรุ้ง') }}">&nbsp; &nbsp;เวียงเชียงรุ้ง</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เวียงป่าเป้า') }}">&nbsp; &nbsp;เวียงป่าเป้า</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/แม่จัน') }}">&nbsp; &nbsp;แม่จัน</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/แม่ลาว') }}">&nbsp; &nbsp;แม่ลาว</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/แม่สรวย') }}">&nbsp; &nbsp;แม่สรวย</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/แม่สาย') }}">&nbsp; &nbsp;แม่สาย</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/แม่ฟ้าหลวง') }}">&nbsp; &nbsp;แม่ฟ้าหลวง</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/ดอยหลวง') }}">&nbsp; &nbsp;ดอยหลวง</a></li>
                                              
                                                <li><a href="{{ url('/mapthai/chiangrai/ป่าแดด') }}">&nbsp; &nbsp;ป่าแดด</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/พาน') }}">&nbsp; &nbsp;พาน</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เทิง') }}">&nbsp; &nbsp;เทิง</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/พญาเม็งราย') }}">&nbsp; &nbsp;พญาเม็งราย</a></li>
                                            </ul>
                                    </div>
                                </div>
                            </div>
                            
                        
                        <div class="card-body" >
                            <div class="row justify-content-center" >
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div id="container"></div>  
                                </div>    
                                  
                            </div>
                        </div>

                        <div class="row justify-content-end">
                                <div class="col-3" style="margin:-40px 20px 0 0;text-align:right;">
                                    <h5 class="card-subtitle" > update 2020 </h5>
                                </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end icon fontawesome solid  -->
                    <!-- ============================================================== -->
                   
                </div>
            </div>
            
        </div>

        <div class="footer">
                <div class="row justify-content-md-center" align="center">
                    <div class="col-md-8" style="margin-top: 10px;">
                       <a href="https://cendim.eng.cmu.ac.th/">
                            <img src="{{ asset('images/logo/footer/cendim.jpg') }}" width="15%">
                            ศูนย์วิจัยด้านการจัดการภัยพิบัติทางธรรมชาติ มหาวิทยาลัยเชียงใหม่ (CENDiM)
                       </a>
                    </div>
                
                </div>        
        </div>
  
    </div>


<script src= "{{ asset('js/app.js') }}"></script> 
<script>
        var data = [
            ['th-wc', 1],
            ['th-ck', 1],
            ['th-mc',1],
            ['th-cs',1],
            ['th-ms',1],
            ['th-wk',1],
            ['th-mfl',1],
            ['th-wcr',1],
            ['th-dl',1],
            ['th-ml',1],
            ['th-msu',1],
            ['th-mcr',1],
            ['th-pm',1],
            ['th-t',1],
            ['th-wpp',1],

            ['th-p',10],
            ['th-pd',10],
            ['th-kt',10],

        ];

        // Create the chart
        Highcharts.mapChart('container', {
            chart: {
                map: 'countries/th/th-all',
                style: {
                    fontFamily: 'Mitr'
                },
                transform: 'translate(10,3) scale(0.95)',
            },

            title: {
                enabled: false,
                // text: 'กราฟความเข้มฝน-ช่วงเวลา-ความถี่การเกิด (IDF curve) ของจังหวัดเชียงราย'
            },
            subtitle: {
                // text: 'กดที่ชื่ออำเภอในแผนที่หรือสืบค้น เพื่อแสดงรูป IDF curve รายอำเภอ'
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
                name: 'อำเภอ',
                states: {
                    hover: {
                        color: '#0033cc'
                    }
                },
                // dataLabels: {
                //     enabled: true,
                //     format: '{point.name}'
                // }
                dataLabels: {
                    enabled: true,
                    color: '#000000',
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
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".dropdown-menu li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>


</body>
</html>