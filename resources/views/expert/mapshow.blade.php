<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blockage::CRflood</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.css') }}">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>     
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
			  height: 500px;
			  display: block;
              margin: auto;
              text-align: left;
              font-size: 14px;
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
                font-size: 14px;
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
          <div class="container-fluid dashboard-content" style="margin-bottom:-40px;">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- ============================================================== -->
                    <!-- icon fontawesome solid  -->
                    <!-- ============================================================== -->
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title"><a href="{{ asset('/') }}">หน้าหลัก </a> &raquo;  แผนที่สิ่งกีดขวาง : {{$data[0]->blk_code}}</h3>
                        <h3 class="card-subtitle">ตำแหน่งที่ตั้ง : {{$location[0]->blk_village}} ต.{{$location[0]->blk_tumbol}} อ.{{$location[0]->blk_district}} จ.{{$location[0]->blk_province}}</h3>
                        
                      </div>
                        <!-- The four columns -->
                        <div class="card-body" >
                            <div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom: 20px;">
                                <div id="map" style="width: 80%;" align="center"></div>
                                <br>
                                <center><img  src="{{ asset('images/logo/manual.png') }}" width=80%></center>
                            </div>
                                
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end icon fontawesome solid  -->
                    <!-- ============================================================== -->
                    
                </div>
            </div>
            
        </div>
        @include('includes.foot')

    </div> {{--main --}}
        
    <script src= "{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/L.Control.Layers.Tree.css')}}" crossorigin=""/>
    <script src="{{ asset('/js/L.Control.Layers.Tree.js')}}"></script>

    <script type="text/javascript">

        var stations1 = new L.LayerGroup();  
          
        var x = {{$location[0]->blk_start_location->getLat()}} ;
        var y = {{$location[0]->blk_start_location->getLng()}};

        var mbAttr = 'CRFlood ',
           mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidmFucGFueWEiLCJhIjoiY2loZWl5ZnJ4MGxnNHRwbHp5bmY4ZnNxOCJ9.IooQB0jYS_4QZvIq7gkjeQ';
                                                                          
        osm = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                                    maxZoom: 20,
                                    subdomains:['mt0','mt1','mt2','mt3'], attribution: mbAttr
                                });
        osmBw = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
                                    maxZoom: 20,
                                    subdomains:['mt0','mt1','mt2','mt3'], attribution: mbAttr
                                });

        var map = L.map('map', {
            layers: [osm,stations1],
            center: [x,y],
            zoom: 15,
        });

  
        var pin = L.icon({
                    iconUrl: '{{ asset('images/logo/pin.png') }}',
                    iconRetinaUrl:'{{ asset('images/logo/pin.png') }}',
                    iconSize: [25, 41],
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

        var pinR = L.icon({
                    iconUrl: '{{ asset('images/logo/pinr2.png') }}',
                    iconRetinaUrl:'{{ asset('images/logo/pinr2.png') }}',
                    iconSize: [60, 60],
                    iconAnchor: [5, 30],
                    popupAnchor: [10, -20]
                 });

        var pinMOR = L.icon({
                    iconUrl: '{{ asset('images/logo/pinr2.png') }}',
                    iconRetinaUrl:'{{ asset('images/logo/pinr2.png') }}',
                    iconSize: [30, 30],
                    iconAnchor: [5, 30],
                    popupAnchor: [0, 0]
                 });
        var a = '{{$location[0]->blk_district}}';
        var amp=['{{$location[0]->blk_district}}'];
        
        function addPin(ampName,i,mo){
            $.getJSON("{{ asset('form/getDamage') }}/"+amp[i], 
                function (data){
						 for (i=0;i<data.length;i++){
                            // for (i=0;i<1;i++){
                            
                            var lo =data[i].geometry.coordinates+ '';
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
                            if(data[i].blk_id=='{{$data[0]->blk_id}}'){
                                // alert("{{$data[0]->blk_id}}");
                                if(mo==0){
                                    L.marker([x,y],{icon: pinMOR}).addTo(ampName).bindPopup(text+text1+text2+text3);  
                                }else{
                                    L.marker([x,y],{icon: pinR}).addTo(ampName).bindPopup(text+text1+text2+text3);  
                            }

                            }else{
                                if(mo==0){
                                    L.marker([x,y],{icon: pinMO}).addTo(ampName).bindPopup(text+text1+text2+text3);  
                                }else{
                                    L.marker([x,y],{icon: pin}).addTo(ampName).bindPopup(text+text1+text2+text3);  
                            }

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

     
        var baseTree = {
            label: 'BaseLayers',
            noShow: true,
            children: [  {label: ' แผนที่ภูมิประเทศ (Streets)', layer: osm},
                         {label: ' แผนที่ภาพถ่ายผ่านดาวเทียม (Satellite)', layer: osmBw},
                     ]
        };
        // var overlays = {
        //     label: ' อำเภอ',
        //     selectAllCheckbox: true,
        //     children: [
        //         { label:" "+amp[0],layer: stations1,}
        //     ]
        // };

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

        
        // L.control.layers(baseTree, overlays).addTo(map).collapseTree().expandSelected();


    </script>
   
</body>
</html>