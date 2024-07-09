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
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.css')}}">
    
    <!-- leaflet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" crossorigin=""/>
    <script src='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.2.0/leaflet-omnivore.min.js'></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet-src.js" crossorigin=""></script>

    <style type="text/css">
        html, body, #map {
            height: 100%;
            width: 100vw;
        }
    	#map{

			  font-family: Mitr, sans-serif;
			  height: 700px;
			  display: block;
              margin: auto;
              text-align: left;
              font-size:15px;
			}
		#map.table {
		    font-family: 'Mitr', sans-serif;
		    width: 100%;
		}#map.tr {
		    padding: 15px;
		    text-align: right;
		}#map.td {
		    padding: 15px;
		    text-align: right;
        }
        select{
            width: 100%;
            height: 40px;
        }
        button.btn {
            width: 100%;
        }
        @media only screen and (max-width:480px) {
            #map{
                height: 450px;
            }
            table{
                font-size: 2vw;
            }
            select{
            width: 100%;
            height: 40px;
            }
            button.btn{
            width: 100%;
            }
            .btn-sm{
                font-size: 2vw;
            }
          
            
        }

    </style>
        
</head>
<body>
    <div class="dashboard-main-wrapper">
       
        @include('includes.headmenu') 
        <div id="app">

            @yield('content')
        
        </div>
        {{-- @guest
                                
        @if (Route::has('login'))
            @include('includes.headmenu')         
        @endif
           @include('includes.head')
           @include('includes.header')
        @else
               
        @endguest --}}
        {{-- @include('includes.header') --}}
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
      
                <div class="container-fluid dashboard-content" style="margin-bottom:-40px;">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- icon fontawesome solid  -->
                            <!-- ============================================================== -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">ระบบข้อมูลของสิ่งกีดขวางทางน้ำในลำน้ำคูคลองและถนน  และวิธีการแก้ไขปัญหาการกีดขวางทางน้ำแต่ละแห่งในพื้นที่ของจังหวัดเชียงราย
                                        </h3>
                                    <h3 class="card-subtitle">สำนักงานป้องกันและบรรเทาสาธารณภัยจังหวัดเชียงรายร่วมกับมหาวิทยาลัยเชียงใหม่ </h3>
                                    
                                </div>
                                <div class="card-body" >
                                    {{-- <a href="#tableData">หน้าแรก </a> --}}
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom: 20px;">
                                        <div id="map" style="width: 100%;" align="center"></div>
                                        <br>
                                        <center><img  src="{{ asset('images/logo/manual.png') }}" width=80%></center>
                                    </div>
                                    <br><br>
                                    <!-- ============================================================== -->
                                            <!-- basic table  -->
                                            <!-- ============================================================== -->
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">ตารางแสดงข้อมูลสิ่งกีดขวางทางน้ำในลำน้ำคูคลองและถนน  </h3>                                                       
                                                        
                                                            
                                                    </div>
                                                    <div class="card-header">
                                                        <form id="amp" name="amp" action="/#tableData" method="get"> 
                                                            <div class="row justify-content-end">
                                                                {{-- <div class="col-md-7"></div> --}}
                                                                <div class="col-md-3">
                                                                    <h4 class="card-title">
                                                                    <select id='blk_district' name='blk_district' >
                                                                        <option value='0'>- - เลือกอำเภอ - -</option>
                                                                        @foreach($districtData['data'] as $village)
                                                                        <option value='{{ $village->vill_district }}'>{{ $village->vill_district  }}</option>
                                                                        @endforeach
                                    
                                                                    </select>
                                                                    </h4>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <h4 class="card-title">
                                                                        <select id="blk_tumbolCR" name="blk_tumbolCR" >
                                                                            <option value='0'>- - เลือกตำบล - -</option>
                                                                            
                                                                        </select>
                                                                    </h4>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="submit" class="btn btn-outline-dark "  style="float: right;"> ค้นหา </button>
                                                                </div>
                                                                
                                                            </div>
                                                            {{-- <table align="right" width=30%>
                                                                <tr>
                                                                    <td style="padding-left:20px;">
                                                                        <h3 class="card-title">
                                                                        <select id='blk_district' name='blk_district' required>
                                                                            <option value='0'>- - เลือกอำเภอ - -</option>
                                                                            @foreach($districtData['data'] as $village)
                                                                            <option value='{{ $village->vill_district }}'>{{ $village->vill_district  }}</option>
                                                                            @endforeach
                                        
                                                                        </select></h3>
                                                                    </td>
                                                                    <td >
                                                                        <h3 class="card-title">
                                                                            <select id="blk_tumbolCR" name="blk_tumbolCR" required>
                                                                                <option value='0'>- - เลือกตำบล - -</option>
                                                                                
                                                                            </select>
                                                                        </h3>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" align="right">
                                                                        <button type="submit" class="btn btn-outline-dark " > ค้นหา </button>
                                                                    </td>
                                                                </tr>
                                                                
                                                            </table> --}}
                                                            
                                                        </form>
                                                        

                                                    </div>
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
                                                                    
                                                                                
                                                                                <td class="btn1">
                                                                                    <div class="btn-group ml-auto">
                                                                                        <a href='{{ asset('/report/pdf/') }}/{{$data[$i]->blk_id}}' target="_blank">  <button class="btn btn-sm btn-outline-light" ><i class="fas fa-eye"></i> รายงาน</button> </a>
                                                                                        <a href='{{ asset('/report/photo/') }}/{{$data[$i]->blk_id}}' target="_blank">  <button class="btn btn-sm btn-outline-light"><i class="fas fa-images"></i> ภาพประกอบ</button> </a>
                                                                                        <a href='{{ asset('/map/') }}/{{$data[$i]->blk_id}}' target="_blank">  <button class="btn btn-sm btn-outline-light"><i class="fas fa-map-pin"></i> ตำแหน่ง</button> </a>
                                                                                    </div>
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
                                            <!-- ============================================================== -->
                                            <!-- end basic table  -->
                                            <!-- ============================================================== -->
                                  
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end icon fontawesome solid  -->
                            <!-- ============================================================== -->
                            
                        </div>
                    </div>
                    
                </div>
                @include('includes.foot')
      
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->

       
    </div>
    
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script> 
    <script src="{{ asset('/js/data-table.js') }}"></script> 
    <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script> 
    <script src="{{ asset('/js/dataTables.bootstrap4.min.js') }}"></script> 
   
   
    <script src="{{ asset('js/chooseLocation_table.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.touch-punch.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/L.Control.Layers.Tree.css')}}" crossorigin=""/>
    <script src="{{ asset('/js/L.Control.Layers.Tree.js')}}"></script>


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
            var stations11 = new L.LayerGroup();
            var stations12 = new L.LayerGroup();
            var stations13 = new L.LayerGroup();
            var stations14 = new L.LayerGroup();
            var stations15 = new L.LayerGroup();
            var stations16 = new L.LayerGroup();
            var stations17 = new L.LayerGroup();
            var stations18 = new L.LayerGroup();
            var borders = new L.LayerGroup();
            
            
            
    }		

    {//---- Basemap Load
            
            var mbAttr = 'CRFlood ',
                mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidmFucGFueWEiLCJhIjoiY2loZWl5ZnJ4MGxnNHRwbHp5bmY4ZnNxOCJ9.IooQB0jYS_4QZvIq7gkjeQ';
            
            var osm = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                                    maxZoom: 20,
                                    subdomains:['mt0','mt1','mt2','mt3'], attribution: mbAttr
                                });
                osmBw = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
                                    maxZoom: 20,
                                    subdomains:['mt0','mt1','mt2','mt3'], attribution: mbAttr
                                });


    }
    //----------------- การแสดงผลเริ่มต้น 
    {//--------borders, stations, rivers, 
            

                var x = 19.815755 ;
                var y = 99.9995964;
                
                var map = L.map('map', {
                    center: [x,y],
                    zoom: 9,
                    layers: [borders,stations1,stations2,stations3,stations4,stations5,stations6,stations7,stations8,stations9,stations10,stations11,stations12,stations13,stations14,stations15,stations16,stations17,stations18,osm]
                });

            var runLayer = omnivore.kml('{{ asset('kml/CR_18Amphoe_bound.kml') }}')
                            .on('ready', function() {
                            this.setStyle({
                            color: "#715b40",
                            fillOpacity: 0,
                            weight: 2
                            });
            }).addTo(borders); 

            var pin = L.icon({
                    iconUrl: '{{ asset('images/logo/pin.png') }}',
                    iconRetinaUrl:'{{ asset('images/logo/pin.png') }}',
                    iconSize: [20, 36],
                    iconAnchor: [5, 30],
                     popupAnchor: [0, 0]
                 });

            var pinMO = L.icon({
                    iconUrl: '{{ asset('images/logo/pin.png') }}',
                    iconRetinaUrl:'{{ asset('images/logo/pin.png') }}',
                    iconSize: [10, 16],
                    iconAnchor: [5, 30],
                     popupAnchor: [0, 0]
                 });
           
               
            var amp=["เชียงของ","เชียงแสน","เวียงแก่น","เวียงชัย","เวียงเชียงรุ้ง","แม่จัน","แม่สาย","แม่ฟ้าหลวง","ดอยหลวง","เมืองเชียงราย",
                    "ป่าแดด","แม่ลาว","แม่สรวย","เวียงป่าเป้า","พญาเม็งราย","เทิง","พาน","ขุนตาล"];
            
            function addPin(ampName,i,mo){
                $.getJSON("{{ asset('form/getDamage') }}/"+amp[i], 
					function (data){
						 for (i=0;i<data.length;i++){
                            // for (i=0;i<1;i++){
                            
                            var lo =data[i].geometry.coordinates+ '';;
							var x=lo.split(',')[1];
                            var y=lo.split(',')[0];
                           
                           // alert (x);
                           var text ="<font style=\"font-family: 'Mitr';\" size=\"3\"COLOR=#1AA90A > รหัส :<a href='{{ asset('/report/pdf') }}/"+data[i].blk_id+"' target=\"_blank\"> " + data[i].blk_code + "</font><br>";
                        
                            text1 = "<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 > ลำน้ำ : "+ data[i].river+ "</font><br>";
                            text2 = "<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 >ที่ตั้ง : "+ data[i].location +" ต."+ data[i].tambol +" อ."+ data[i].district +"</font><br>";
                            text3 = "<br><table align=\"center\"><tr><td width=47%><a href='{{ asset('/report/pdf') }}/"+data[i].blk_id+"' target=\"_blank\"> " + "<button class=\"btn btn-sm btn-outline-light\"><i class=\"fas fa-eye\"></i> รายงาน</button> </a></td> <td  width=6%></td><td  width=47%><a href='{{ asset('/report/photo') }}/"+data[i].blk_id+"' target=\"_blank\"> " + "<button class=\"btn btn-sm btn-outline-light\"><i class=\"fas fa-images\"></i> ภาพประกอบ</button> </a></td></tr></table>";
                            
                            // text3 = "<a href='{{ asset('/report/pdf') }}/"+data[i].blk_id+"' target=\"_blank\"> " + "<i class=\"fas fa-eye\"></i> รายงาน</a>";
                            // text3="fff";
                            // alert(mo);
                            if(mo==0){
                                L.marker([x,y],{icon: pinMO}).addTo(ampName).bindPopup(text+text1+text2+text3);  
                            }else{
                                L.marker([x,y],{icon: pin}).addTo(ampName).bindPopup(text+text1+text2+text3);  
                            }
                                                   
                       
						}//end for
					}
										
				);
                
            }
            var mx = window.matchMedia("(max-width: 700px)");
            // x=x.matches;
            
            if(mx.matches){
                mo=0;
                // alert(x.matches);
            }else{
                mo=1;
            }
            addPin(stations1,0,mo);
            addPin(stations2,1,mo);
            addPin(stations3,2,mo);
            addPin(stations4,3,mo);
            addPin(stations5,4,mo);
            addPin(stations6,5,mo);
            addPin(stations7,6,mo);
            addPin(stations8,7,mo);
            addPin(stations9,8,mo);
            addPin(stations10,9,mo);
            addPin(stations11,10,mo);
            addPin(stations12,11,mo);
            addPin(stations13,12,mo);
            addPin(stations14,13,mo);
            addPin(stations15,14,mo);
            addPin(stations16,15,mo);
            addPin(stations17,16,mo);
            addPin(stations18,17,mo);
             

       }

    //   L.marker([20.050,99.2485],{icon: ref}).addTo(stations10);

    {//------- Base Map Option	
        var baseTree = {
                label: 'BaseLayers',
                noShow: true,
                children: [  {label: ' แผนที่ภูมิประเทศ (Streets)', layer: osm},
                             {label: ' แผนที่ภาพถ่ายผ่านดาวเทียม (Satellite)', layer: osmBw},
                         ]
            };
            var overlays = {
                label: ' อำเภอ',
                selectAllCheckbox: true,
                children: [
                    { label:" "+amp[0],layer: stations1,},
                    { label:" "+amp[1],layer: stations2,},
                    { label:" "+amp[2],layer: stations3,},
                    { label:" "+amp[3],layer: stations4,},
                    { label:" "+amp[4],layer: stations5,},
                    { label:" "+amp[5],layer: stations6,},
                    { label:" "+amp[6],layer: stations7,},
                    { label:" "+amp[7],layer: stations8,},
                    { label:" "+amp[8],layer: stations9,},
                    { label:" "+amp[9],layer: stations10},
                    { label:" "+amp[10],layer: stations11},
                    { label:" "+amp[11],layer: stations12},
                    { label:" "+amp[12],layer: stations13},
                    { label:" "+amp[13],layer: stations14},
                    { label:" "+amp[14],layer: stations15},
                    { label:" "+amp[15],layer: stations16},
                    { label:" "+amp[16],layer: stations17},
                    { label:" "+amp[17],layer: stations18},
                ]
            };

        var ctl = L.control.layers.tree(baseTree, null,
            // {
            //     // namedToggle: true,
            //     // collapseAll: 'Collapse all',
            //     // expandAll: 'Expand all',
            //     // collapsed: false,
            //     collapsed: false,
            //     collapseAll: '',
            //     expandAll: '',
            // }
            );
    

        ctl.addTo(map).collapseTree().expandSelected();

        ctl.setOverlayTree(overlays).collapseTree().expandSelected();	
        
    }


               
                            
            
</script>
    

</body>
</html>
