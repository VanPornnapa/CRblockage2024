<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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
			  height: 750px;
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
        #ref.img{
                width: 100%;
            }

        
        @media only screen and (max-width:480px) {
            #map{
                height: 450px;
            }
            #ref.img{
                width: 50%;
            }
            #example2.table{
                font-size: 2vw;
            }
        }
        * {box-sizing: border-box}
         /* Style tab links */
        .tablink {
            background-color: #ccc;
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            font-size: 17px;
            width: 25%;
        }

        .tablink:hover {
            background-color: #000;
        }

        /* Style the tab content (and add height:100% for full page content) */
        .tabcontent {
            display: none;
            padding: 100px 20px;
            display: none;
            padding: 20px 20px;
            border: 2px solid #ccc;
            border-top: none;
            width: 100%;
        }

        #sum {background-color: #fff;border: 1px solid #ccc;}
        #phase1 {background-color:  #fff;border: 1px solid #ccc;}
        #Contact {background-color:  #fff;border: 1px solid #ccc;}


    </style>
        
</head>
<body>
    <div class="dashboard-main-wrapper">
        @include('includes.headmenu')
      
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        
                <div class="container-fluid dashboard-content">
                    
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                    <div class="card-header"> 
                                        <h2 class="pageheader-title">แผนที่แสดงตำแหน่งการกีดขวางทางน้ำจำแนกตามระดับความเสี่ยง พื้นที่ของจังหวัดเชียงราย</h2>
                                    </div>
                                <div class="card-body">
                                        {{-- @include('form.map') --}}
                                        <div class="row">
                                            <div class="col-xs-10 col-sm-10 col-md-10">
                                                    <div id="map" style="width: 100%; " align="center"></div>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-2" align=center>
                                                <img class="ref" src="{{ asset('images/logo/descreption_pin4.png') }}" width=80% >
                                            </div>
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
                                                <font style="font-size: 1vw">ตารางแสดงจำนวนจุดกีดขวางทางน้ำ จำแนกตามระดับความเสี่ยงจากการกีดขวางทางน้ำ</font>
                                            </div>
                                            
                                            <div class="card-body">
                                            <div class="row">
                                                <button class="tablink" onclick="openPage('sum', this, 'gray')" id="defaultOpen">รวม</button>
                                                <button class="tablink" onclick="openPage('phase1', this, 'gray')" >ระยะที่ 1</button>
                                                <button class="tablink" onclick="openPage('Contact', this, 'gray')">ระยะที่ 2</button>


                                                <div id="sum" class="tabcontent">
                                                <div class="table-responsive">
                                                    <table id="example6" class="table table-striped table-bordered" style="width:80%" align="center">
                                                        <thead>
                                                                <tr>
                                                                    <th> <b>อำเภอ </b></th>
                                                                    <th > <b>ระดับความเสี่ยงมาก</b></th>
                                                                    <th>amp</th>
                                                                    <th><b>ระดับความเสี่ยงปานกลาง</b></th>
                                                                    <th><b>ระดับความเสี่ยงต่ำ</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>--</td>
                                                                    <td align="center">{{$sum3}}</td>
                                                                    <td>รวม 18 อำเภอ</td>
                                                                    <td align="center">{{$sum2}}</td>
                                                                    <td align="center">{{$sum1}}</td>
                                                                </tr>
                                                            <?php for($i=0;$i<count($result);$i++){?>
                                                                <tr>
                                                                    <td >{{ $result[$i]['amp']}}</td>
                                                                    <td align="center">{{ $result[$i]['level3']}}</td>
                                                                    <td >อำเภอ</td>
                                                                    <td align="center" >{{ $result[$i]['level2']}}</td>
                                                                    <td align="center">{{ $result[$i]['level1']}}</td>
                                                                </tr>
                                                            <?php }?>

                                                            
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                                </div>

                                                <div id="phase1" class="tabcontent">
                                                    <div class="table-responsive">
                                                        <table id="example2" class="table table-striped table-bordered" style="width:80%" align="center">
                                                            <thead>
                                                                <tr>
                                                                    <th> <b>อำเภอ </b></th>
                                                                    <th > <b>ระดับความเสี่ยงมาก</b></th>
                                                                    <th>amp</th>
                                                                    <th><b>ระดับความเสี่ยงปานกลาง</b></th>
                                                                    <th><b>ระดับความเสี่ยงต่ำ</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>--</td>
                                                                    <td align="center">{{$phase1_3}}</td>
                                                                    <td>รวม 9 อำเภอ ระยะ 1 </td>
                                                                    <td align="center">{{$phase1_2}}</td>
                                                                    <td align="center">{{$phase1_1}}</td>
                                                                </tr>
                                                                <?php for($i=0;$i<9;$i++){?>
                                                                    <tr>
                                                                        <td >{{ $result[$i]['amp']}}</td>
                                                                        <td align="center">{{ $result[$i]['level3']}}</td>
                                                                        <td >อำเภอ</td>
                                                                        <td align="center" >{{ $result[$i]['level2']}}</td>
                                                                        <td align="center">{{ $result[$i]['level1']}}</td>
                                                                    </tr>
                                                                <?php }?>

                                                                
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>          
                                                </div>

                                                <div id="Contact" class="tabcontent">
                                                    <div class="table-responsive">
                                                            <table id="example5" class="table table-striped table-bordered" style="width:80%" align="center">
                                                                <thead>
                                                                    <tr>
                                                                        <th> <b>อำเภอ </b></th>
                                                                        <th > <b>ระดับความเสี่ยงมาก</b></th>
                                                                        <th>amp</th>
                                                                        <th><b>ระดับความเสี่ยงปานกลาง</b></th>
                                                                        <th><b>ระดับความเสี่ยงต่ำ</b></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>--</td>
                                                                        <td align="center">{{$phase2_3}}</td>
                                                                        <td>รวม 9 อำเภอ ระยะ2 </td>
                                                                        <td align="center">{{$phase2_2}}</td>
                                                                        <td align="center">{{$phase2_1}}</td>
                                                                    </tr>
                                                                    <?php for($i=9;$i<count($result);$i++){?>
                                                                        <tr>
                                                                            <td >{{ $result[$i]['amp']}}</td>
                                                                            <td align="center">{{ $result[$i]['level3']}}</td>
                                                                            <td >อำเภอ</td>
                                                                            <td align="center" >{{ $result[$i]['level2']}}</td>
                                                                            <td align="center">{{ $result[$i]['level1']}}</td>
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

                   
        

        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->

        @include('includes.foot')
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
                var stations15= new L.LayerGroup();
                var stations16 = new L.LayerGroup();
                var stations17 = new L.LayerGroup();
                var stations18 = new L.LayerGroup();

                var borders = new L.LayerGroup();
                
        }       

        {//---- Basemap Load
                
            var mbAttr = 'CRFlood ',
            mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidmFucGFueWEiLCJhIjoiY2loZWl5ZnJ4MGxnNHRwbHp5bmY4ZnNxOCJ9.IooQB0jYS_4QZvIq7gkjeQ';
                // var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                //                         maxZoom: 20,
                //                         subdomains:['mt0','mt1','mt2','mt3'], attribution: mbAttr
                //                     });
                //     googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
                //                             maxZoom: 20,
                //                             subdomains:['mt0','mt1','mt2','mt3'], attribution: mbAttr
                //                         });
                //     googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
                //                             maxZoom: 20,
                //                             subdomains:['mt0','mt1','mt2','mt3'], attribution: mbAttr
                //                         });
                //     grayscale   = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr});

            osm = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
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
                

                    var x = 19.801755 ;
                    var y = 99.9995964;
                    
                    var map = L.map('map', {
                    center: [x,y],
                    zoom: 9,
                    layers: [borders,stations1,stations2,stations3,stations4,stations5,stations6,stations7,stations8,stations9,stations10,stations11,stations12,stations13,stations14,stations15,stations16,stations17,stations18,osm]
                });

                var runLayer = omnivore.kml('{{ asset('kml/CR_18Amphoe_bound.kml') }}')
                            .on('ready', function() {
                            this.setStyle({
                            color: "#466DF3",
                            fillOpacity: 0,
                            weight: 3
                            });
                }).addTo(borders); 
            

                var lavel1 = L.icon({
                        iconUrl: '{{ asset('images/logo/pin1.png') }}',
                        iconRetinaUrl:'{{ asset('images/logo/pin1.png') }}',
                        iconSize: [22, 22],
                        iconAnchor: [5, 30],
                        popupAnchor: [0, 0]
                    });
                var lavel2 = L.icon({
                        iconUrl: '{{ asset('images/logo/pin2.png') }}',
                        iconRetinaUrl:'{{ asset('images/logo/pin2.png') }}',
                        iconSize: [24, 24],
                        iconAnchor: [15, 20],
                        popupAnchor: [0, 0]
                    });
                var lavel3 = L.icon({
                        iconUrl: '{{ asset('images/logo/pin3.png') }}',
                        iconRetinaUrl:'{{ asset('images/logo/pin3.png') }}',
                        iconSize: [26, 26],
                        iconAnchor: [5, 5],
                        popupAnchor: [0, 0]
                    });
                
                
                var ref = L.icon({
                        iconUrl: '{{ asset('images/logo/descreption_pin3.png') }}',
                        iconRetinaUrl:'{{ asset('images/logo/descreption_pin3.png') }}',
                        iconSize: [150, 220],
                        iconAnchor: [25, 35],
                        popupAnchor: [0, 0]
                });
            
                
                
                
                // var amp=["เชียงของ","เชียงแสน","เวียงแก่น","เวียงชัย","เวียงเชียงรุ้ง","แม่จัน","แม่สาย","แม่ฟ้าหลวง","ดอยหลวง"];
                var amp=["เชียงของ","เชียงแสน","เวียงแก่น","เวียงชัย","เวียงเชียงรุ้ง","แม่จัน","แม่สาย","แม่ฟ้าหลวง","ดอยหลวง",
                            "เมืองเชียงราย","ป่าแดด","แม่ลาว","แม่สรวย","เวียงป่าเป้า","พญาเม็งราย","เทิง","พาน","ขุนตาล"];
                function addPin(ampName,i){
                    $.getJSON("{{ asset('form/getDamage') }}/"+amp[i], 
                        function (data){
                            for (i=0;i<data.length;i++){
                                
                                var lo =data[i].geometry.coordinates+ '';;
                                var x=lo.split(',')[1];
                                var y=lo.split(',')[0];
                            
                            // alert (x);
                            var text ="<font style=\"font-family: 'Mitr';\" size=\"3\"COLOR=#1AA90A > รหัส :<a href='{{ asset('/report/pdf') }}/"+data[i].blk_id+"' > " + data[i].blk_code + "</font><br>";
                            
                                text1 = "<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 > ลำน้ำ : "+ data[i].river+ "</font><br>";
                                text2 = "<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 >ที่ตั้ง : "+ data[i].location +" ต."+ data[i].tambol +" อ."+ data[i].district +"</font><br>";
                                text3 = "<br><table align=\"center\"><tr><td width=50%><a href='{{ asset('/report/pdf') }}/"+data[i].blk_id+"' target=\"_blank\"> " + "<button class=\"btn btn-sm btn-outline-light\"><i class=\"fas fa-eye\"></i> รายงาน</button> </a></td> <td  width=2s%></td><td  width=48%><a href='{{ asset('/report/photo') }}/"+data[i].blk_id+"' target=\"_blank\"> " + "<button class=\"btn btn-sm btn-outline-light\"><i class=\"fas fa-images\"></i> ภาพประกอบ</button> </a></td></tr></table>";
                                                    
                            if(data[i].level=="น้อย"){
                                    L.marker([x,y],{icon: lavel1}).addTo(ampName).bindPopup(text+text1+text2+text3);
                            }else if(data[i].level=="ปานกลาง"){
                                    L.marker([x,y],{icon: lavel2}).addTo(ampName).bindPopup(text+text1+text2+text3);
                            }else if(data[i].level=="มาก"){
                                    L.marker([x,y],{icon: lavel3}).addTo(ampName).bindPopup(text+text1+text2+text3);
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
                addPin(stations10,9);
                addPin(stations11,10);
                addPin(stations12,11);
                addPin(stations13,12);
                addPin(stations14,13);
                addPin(stations15,14);
                addPin(stations16,15);
                addPin(stations17,16);
                addPin(stations18,17);
                

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

    <script>
        function openPage(pageName,elmnt,color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(pageName).style.display = "block";
                elmnt.style.backgroundColor = color;
        }

         // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>

</body>
</html>
