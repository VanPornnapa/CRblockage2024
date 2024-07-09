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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.css')}}">
    <!-- leaflet -->
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    {{-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" type="text/css"> --}}

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        .button {
            background-color: #5969ff; /* Green */
            border: none;
            color: white;
            text-align: top;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            /* cursor: pointer; */
            height:28px;
        }
        .button1 {padding: -10px;}
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
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- icon fontawesome solid  -->
                            <!-- ============================================================== -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">ระบบข้อมูลของสิ่งกีดขวางทางน้ำในลำน้ำคูคลองและถนน  และวิธีการแก้ไขปัญหาการกีดขวางทางน้ำแต่ละแห่งในพื้นที่ของจังหวัดเชียงราย</h3>
                                    <h3 class="card-subtitle">สำนักงานป้องกันและบรรเทาสาธารณภัยจังหวัดเชียงรายร่วมกับมหาวิทยาลัยเชียงใหม่ </h3>
                                </div>
                                <div class="card-body">
                                        {{-- @include('form.map') --}}
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div id="map" style="width: 100%; height: 700px" align="center"></div>
                                        </div>
                                           
                                        
                                  
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end icon fontawesome solid  -->
                            <!-- ============================================================== -->
                         
                        </div>
                    </div>

                     <!-- ============================================================== -->
                                            <!-- basic table  -->
                                            <!-- ============================================================== -->
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="card">
                                                     <div class="card-header">
                                                        <h3 class="card-title">ตารางแสดงข้อมูลสิ่งกีดขวางทางน้ำในลำน้ำคูคลองและถนน  </h3>                                                       
                                                        
                                                            
                                                    </div>
                                                    <div class="card-body">
                                                         <form id="amp" name="amp" action="/#tableData" method="get">

                                                            <table align="right" width=40%>
                                                                <tr>
                                                                    <td style="padding-left:20px;">
                                                                        <h4 class="card-title">
                                                                        <select id='blk_district' name='blk_district' style="height:1.8em;" required>
                                                                            <option value='0'>- - เลือกอำเภอ - -</option>
                                                                            @foreach($districtData['data'] as $village)
                                                                            <option value='{{ $village->vill_district }}'>{{ $village->vill_district  }}</option>
                                                                            @endforeach
                                        
                                                                        </select></h4>
                                                                    </td>
                                                                    <td >
                                                                        <h4 class="card-title">
                                                                            <select id="blk_tumbol" name="blk_tumbol" required>
                                                                                <option value='0'>-- เลือกตำบล --</option>
                                                                            </select>
                                                                        </h4>
                                                                    </td>
                                                                    <td>
                                                                        <h4 class="card-title">    
                                                                            <button type="submit" class=" button button1 " > ค้นหา </button>
                                                                        </h4>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </form>
                                                        <div id="tableData">
                                                            <div class="card-body">
		                                                        <div class="table-responsive">
		                                                            <table class="table table-striped table-bordered first" width=90% align="center">
		                                                                <thead>
		                                                                    <tr>
		                                                                        <th>#</th>
		                                                                        <th>รหัส</th>
		                                                                        <th>ลำน้ำ</th>
		                                                                        <th>หมู่บ้าน</th>
		                                                                        <th>ตำบล</th>
		                                                                        <th>อำเภอ</th>
		                                                                        <th></th>
		                                                                    </tr>
		                                                                </thead>
		                                                                <tbody>
		                                                                    <?php for($i = 0;$i < count($data);$i++){?>
		                                                                        <tr align="center">
		                                                                            <td >{{$i+1}}</td>
		                                                                            <td data-label="รหัส"> <a href='{{ asset('/report/pdf/') }}/{{$data[$i]->blk_id}}' > {{$data[$i]->blk_code}} </a></td>
		                                                                            <td align="left" data-label="ลำน้ำ">{{$data[$i]->river_name}}, {{$data[$i]->river_main}} </td>
		                                                                            <td align="left" data-label="หมู่บ้าน">{{$data[$i]->blk_village}} </td>
		                                                                            <td align="left" data-label="ตำบล">ต.{{$data[$i]->blk_tumbol}}</td>
		                                                                            <td data-label="อำเภอ">อ.{{$data[$i]->blk_district}}</td>
		                                                                  
		                                                                            
		                                                                            <td data-label="">
		                                                                                    {{-- <div class="btn-group ml-auto">
		                                                                                      
		                                                                                        <a href='{{ asset('/reportBlockage') }}/{{$data[$i]->blk_id}}' > <button class="btn btn-sm btn-outline-light"><i class="fas fa-eye"></i>  รายละเอียด</button> </a>
		                                                                                   </div> --}}
		                                                                                    <div class="btn-group ml-auto">
		                                                                                       <a href='{{ asset('/report/pdf/') }}/{{$data[$i]->blk_id}}' >  <button class="btn btn-sm btn-outline-light"><i class="fas fa-edit"></i> รายงาน</button> </a>
		                                                                                        
		                                                                                    </div>
		                                                                            </td>
		                                                                            </td>                                   
		                                                                        </tr>
		                                                                    <?php }?>
		                                                                   
		                                                                </tbody>
		                                                              
		                                                            </table>
		                                                        </div>
		                                                    </div>
		                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ============================================================== -->
                                            <!-- end basic table  -->
                                            <!-- ============================================================== -->
                </div>

            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->


    </div>
   	<script src="{{ asset('js/chooseLocation.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main-js.js') }}"></script>
    <script src="{{ asset('js/leaflet.js') }}"></script>
    <script src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('/js/data-table.js') }}"></script> 
    <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script> 
    <script src="{{ asset('/js/dataTables.bootstrap4.min.js') }}"></script> 
    <script src="{{ asset('js/SliderControl.js') }}"></script>
    <script>
        var sliderControl = null;

        var myMap = L.map('map').setView([19.865755, 99.9695964], 9);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {}).addTo(myMap);
        //Fetch some data from a GeoJSON file
        $.getJSON("{{ asset('form/getBlockageMap') }}", function(json) {
            var testlayer = L.geoJson(json,{
                    onEachFeature: function(feature,layer){

                    // var text ="<font style=\"font-family: 'Mitr';\" size=\"3\"COLOR=#1AA90A > รหัส :<a href='{{ asset('/reportBlockage') }}/"+feature.properties.blk_id+"' > " + feature.properties.blk_code + "</font><br>";
                    var text ="<font style=\"font-family: 'Mitr';\" size=\"3\"COLOR=#1AA90A > รหัส :<a href='{{ asset('/report/pdf/') }}/"+feature.properties.blk_id+"' > " + feature.properties.blk_code + "</font><br>";

                //  var text ="<font style=\"font-family: 'Mitr';\" size=\"3\"COLOR=#1AA90A > รหัส :"+feature.properties.blk_id+" " + feature.properties.blk_code + "</font><br>";
                        text1 = "<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 > ลำน้ำ : "+ feature.properties.river+ "</font><br>";
                        text2 = "<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 >ที่ตั้ง : "+ feature.properties.location +" ต."+ feature.properties.tambol +" อ."+ feature.properties.district +"</font><br>";
                        layer.bindPopup(text+text1+text2);
                    }
                });

                

            //For a Range-Slider use the range property:
            var sliderControl = L.control.sliderControl({position: "bottomleft", layer: testlayer, timeAttribute: 'time'});

            //Make sure to add the slider to the map ;-)
            myMap.addControl(sliderControl);
            //And initialize the slider
            sliderControl.startSlider();
        });
    </script>

</body>
</html>
