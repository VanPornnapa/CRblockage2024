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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.css')}}">
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
                    <div class="row" >
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">แผนที่แสดงตำแหน่งการกีดขวางทางน้ำพื้นที่ของจังหวัดเชียงใหม่</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                               
                                <div class="card-body">
                                        {{-- @include('form.map') --}}
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div id="map" style="width: 100%; height: 650px" align="center"></div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <center><img src="{{ asset('images/logo/descreption_pin2.png') }}" width="40%"></center>
                                        </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="row">
                                    <!-- ============================================================== -->
                                    <!-- basic table  -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>ตารางแสดงจำนวนจุดกีดขวางทางน้ำ จำแนกตามระดับการกีดขวาง</h3>
                                            </div>
                                            
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="example2" class="table table-striped table-bordered" style="width:80%" align="center">
                                                        <thead>
                                                            <tr>
                                                                <th> <b>อำเภอ </b></th>
                                                                <th > <b>ระดับการกีดขวางมาก</b></th>
                                                                <th>amp</th>
                                                                <th><b>ระดับการกีดขวางปานกลาง</b></th>
                                                                <th><b>ระดับการกีดขวางน้อย</b></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>--</td>
                                                                <td align="center">{{$ampL1}}</td>
                                                                <td>รวม 3 อำเภอ</td>
                                                                <td align="center">{{$ampL2}}</td>
                                                                <td align="center">{{$ampL3}}</td>
                                                            </tr>
                                                            <?php for($i=0;$i<count($data);$i++){?>
                                                                <tr>
                                                                    <td >{{ $data[$i]->amp}}</td>
                                                                    <td align="center">{{ $data[$i]->level1}}</td>
                                                                    <td >อำเภอ</td>
                                                                    <td align="center" >{{ $data[$i]->level2}}</td>
                                                                    <td align="center">{{ $data[$i]->level3}}</td>
                                                                </tr>
                                                            <?php }?>

                                                            
                                                        
                                                        </tbody>
                                                    </table>
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


<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/main-js.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>	
<script src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('js/leaflet.groupedlayercontrol.js') }}"></script>
{{-- <script src="{{ asset('js/leaflet.js') }}"></script> 20.1865755, 99.9695964--}}
<script>

    {//--- Layer Declarations
            var stations1 = new L.LayerGroup();
            var stations2 = new L.LayerGroup();
            var stations3 = new L.LayerGroup();
            var stations4 = new L.LayerGroup();
            var stations5 = new L.LayerGroup();
            var stations6 = new L.LayerGroup();
            var stations7 = new L.LayerGroup();
            var stations8 = new L.LayerGroup();
            var stations9 = new L.LayerGroup();
            var stations10 = new L.LayerGroup();
            var borders = new L.LayerGroup();
            
            
            
    }		

    {//---- Basemap Load
            
            var mbAttr = 'CRFlood ',
                mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidmFucGFueWEiLCJhIjoiY2loZWl5ZnJ4MGxnNHRwbHp5bmY4ZnNxOCJ9.IooQB0jYS_4QZvIq7gkjeQ';
            var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr}),
                streets  = L.tileLayer(mbUrl, {id: 'mapbox.streets',   attribution: mbAttr});
                dark  = L.tileLayer(mbUrl, {id: 'mapbox.dark',   attribution: mbAttr});
                bright  = L.tileLayer(mbUrl, {id: 'mapbox.bright',   attribution: mbAttr});
                satellite  = L.tileLayer(mbUrl, {id: 'mapbox.satellite',   attribution: mbAttr});
                basic=L.tileLayer(mbUrl, {id: 'mapbox.Basic',   attribution: mbAttr});
                base=L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: mbAttr});

    }
    //----------------- การแสดงผลเริ่มต้น 
    {//--------borders, stations, rivers, 
            

                var x = 19.85755 ;
                var y = 99.1995964;
                
                var map = L.map('map', {
                center: [x,y],
                zoom: 10,
                layers: [borders,stations1,stations2,stations3,stations4,stations5,stations6,stations7,stations8,stations9,stations10,base]
            });

            var runLayer = omnivore.kml('{{ asset('kml/mapfang.kml') }}')
						.on('ready', function() {
						this.setStyle({
						color: "#466DF3",
						weight: 3
						});
			}).addTo(borders); 

            var lavel1 = L.icon({
                    iconUrl: '{{ asset('images/logo/pin1.png') }}',
                    iconRetinaUrl:'{{ asset('images/logo/pin1.png') }}',
                    iconSize: [24, 24],
                    iconAnchor: [0, 35],
                     popupAnchor: [0, 0]
                 });
            var lavel2 = L.icon({
                    iconUrl: '{{ asset('images/logo/pin2.png') }}',
                    iconRetinaUrl:'{{ asset('images/logo/pin2.png') }}',
                    iconSize: [28, 28],
                    iconAnchor: [30, 20],
                     popupAnchor: [0, 0]
                 });
            var lavel3 = L.icon({
                    iconUrl: '{{ asset('images/logo/pin3.png') }}',
                    iconRetinaUrl:'{{ asset('images/logo/pin3.png') }}',
                    iconSize: [30, 30],
                    iconAnchor: [25, 35],
                     popupAnchor: [0, 0]
                 });
          
               
            var amp=["ฝาง","ไชยปราการ","แม่อาย"];
           
            function addPin(ampName,i){
                $.getJSON("{{ asset('form/getDamage') }}/"+amp[i], 
					function (data){
						for (i=0;i<data.length;i++){
                            
                            var lo =data[i].geometry.coordinates+ '';;
							var x=lo.split(',')[1];
                            var y=lo.split(',')[0];
                           
                           // alert (x);
                           var text ="<font style=\"font-family: 'Mitr';\" size=\"3\"COLOR=#1AA90A > รหัส :<a href='{{ asset('/reportBlockage') }}/"+data[i].blk_id+"' > " + data[i].blk_code + "</font><br>";
                        
                            text1 = "<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 > ลำน้ำ : "+ data[i].river+ "</font><br>";
                            text2 = "<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 >ที่ตั้ง : "+ data[i].location +" ต."+ data[i].tambol +" อ."+ data[i].district +"</font><br>";

                           if(data[i].level=="1-30%"){
                                L.marker([x,y],{icon: lavel1}).addTo(ampName).bindPopup(text+text1+text2);
                           }else if(data[i].level=="30-70%"){
                                L.marker([x,y],{icon: lavel2}).addTo(ampName).bindPopup(text+text1+text2);
                           }else if(data[i].level=="มากกว่า 70%"){
                                L.marker([x,y],{icon: lavel3}).addTo(ampName).bindPopup(text+text1+text2);
                           }
						}//end for
                    }
                    
                    
										
				);
                
            }

            addPin(stations1,0);
            addPin(stations2,1);
            addPin(stations3,2);
            addPin(stations4,3);
            addPin(stations5,4);
            addPin(stations6,5);
            addPin(stations7,6);
            addPin(stations8,7);
            addPin(stations9,8);
             

       }

    //    L.marker([20.050,99.2485],{icon: ref}).addTo(stations10);

     {//------- Base Map Option		
        var baseLayers = {
                    "แผนที่เทาขาว (Grayscale)": grayscale,
                    "แผนที่ภูมิประเทศ (Streets)": streets,
                    "แผนที่ภาพถ่ายผ่านดาวเทียม (Satellite)": satellite,
                    "แผนที่สีเข้ม (dark)": dark,
                    "แผนที่พื้นฐาน":base
                };

                var overlays = {
                    "อ.ฝาง":stations1,
                    "อ.ไชยปราการ":stations2,
                    "อ.แม่อาย":stations3 
                }

                

                L.control.layers(baseLayers, overlays).addTo(map);
    }

    // // Overlay layers are grouped
    // var groupedOverlays = {
    //   "Landmarks": {
    //     "Cities": stations,
    //     "Restaurants":station_rid
    //   },
    //   "Random": {
    //     "Dogs": rivers,
    //     "Cats": borders
    //   }
    // };
    // // Use the custom grouped layer control, not "L.control.layers"
    // L.control.groupedLayers(ExampleData.Basemaps, groupedOverlays).addTo(map);

               
                            
            
</script>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
{{-- <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script> --}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/js/data-table.js') }}"></script>

</body>
</html>
