<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.css') }}">
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Mitr', sans-serif;

        }

        .position-ref {
            position: relative;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .content {
            text-align: left;

        }

        .title {
            font-size: 16px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        input[data-readonly] {
            pointer-events: none;
        }
        .table thead th , .table th{
            text-align: left;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/proj4js.js') }}"></script>
    <script src="{{ asset('js/EPSG32647.js') }}"></script>

    {{-- xxx UTM xxx --}}
    <script type="text/javascript">
    
        var projHash = {};
        function initProj4js() {
          var crsSource = document.getElementById('crsSource');
          var crsDest = document.getElementById('crsDest');
          var optIndex = 0;
        //  console.log(Proj4js.defs);
          for (var def in Proj4js.defs) {
             //def="EPSG:32647";
             
             projHash[def] = new Proj4js.Proj(def);    //create a Proj for each definition
             var label = def+" - "+ (projHash[def].title ? projHash[def].title : '');
             var opt = new Option(label, def);
             crsSource.options[optIndex]= opt;
             var opt = new Option(label, def);
             crsDest.options[optIndex]= opt;
             ++optIndex;
          }  // for
          updateCrs('Source');
          updateCrs('Dest');
        }
        
        function updateCrs(id) {
          // console.log(id);
          var crs = document.getElementById('crs'+id);
          if(id=="Source"){
            // crs.value="WGS84";
            crs.value="EPSG:32647";
          }else{
            crs.value="WGS84";
            // crs.value="EPSG:32647";
          }
        } 
        function transform() {
          var crsSource = document.getElementById('crsSource');
          var projSource = null;
        //   console.log(crsSource.value);
      
          if (crsSource.value) {
            //projSource = projHash["WGS84"];
            projSource = projHash["EPSG:32647"];
          } else {
            alert("Select a source coordinate system");
            return;
          }
      
          var crsDest = document.getElementById('crsDest');
        //   console.log(crsDest.value);
          var projDest = null;
          if (crsDest.value) {
            projDest = projHash["WGS84"];
            // projDest = projHash["EPSG:32647"];
          } else {
            alert("Select a destination coordinate system");
            return;
          }
          
          var pointInputX = document.getElementById('xstart');
          var pointInputY = document.getElementById('ystart');
          var pointInput = pointInputX.value+","+pointInputY.value;
        
          if (pointInputX.value) {
            var pointSource = new Proj4js.Point(pointInput);
            var pointDest = Proj4js.transform(projSource, projDest, pointSource);
            // console.log(pointDest.x);
            document.getElementById('longstart').value = pointDest.x.toFixed(4);
            document.getElementById('latstart').value = pointDest.y.toFixed(4);
          } else {
            alert("Enter source coordinates");
            return;
          }
        }
        // ///////////////////////////////////////////////////////////
        function transformutm() {
          var crsSource = document.getElementById('crsSource');
          var projSource = null;
        //   console.log(crsSource.value);
      
          if (crsSource.value) {
            projSource = projHash["WGS84"];
           // projSource = projHash["EPSG:32647"];
          } else {
            alert("Select a source coordinate system");
            return;
          }
      
          var crsDest = document.getElementById('crsDest');
        //   console.log(crsDest.value);
          var projDest = null;
          if (crsDest.value) {
            //projDest = projHash["WGS84"];
            projDest = projHash["EPSG:32647"];
          } else {
            alert("Select a destination coordinate system");
            return;
          }
          
          var pointInputX = document.getElementById('longstart');
          var pointInputY = document.getElementById('latstart');
          var pointInput = pointInputX.value+","+pointInputY.value;
        
          if (pointInputX.value) {
            var pointSource = new Proj4js.Point(pointInput);
            var pointDest = Proj4js.transform(projSource, projDest, pointSource);
            // console.log(pointDest.x);
            document.getElementById('xstart').value = pointDest.x.toFixed(0);
            document.getElementById('ystart').value = pointDest.y.toFixed(0);
          } else {
            alert("Enter source coordinates");
            return;
          }
        }
    
        // ///////////////////////////////////////////////////////////
        function transformend() {
          var crsSource = document.getElementById('crsSource');
          var projSource = null;
        //   console.log(crsSource.value);
      
          if (crsSource.value) {
            projSource = projHash["EPSG:32647"];
          } else {
            alert("Select a source coordinate system");
            return;
          }
      
          var crsDest = document.getElementById('crsDest');
        //   console.log(crsDest.value);
          var projDest = null;
          if (crsDest.value) {
            projDest = projHash["WGS84"];
          } else {
            alert("Select a destination coordinate system");
            return;
          }
          
          var pointInputX = document.getElementById('xend');
          var pointInputY = document.getElementById('yend');
          var pointInput = pointInputX.value+","+pointInputY.value;
        
          if (pointInputX.value) {
            var pointSource = new Proj4js.Point(pointInput);
            var pointDest = Proj4js.transform(projSource, projDest, pointSource);
            // console.log(pointDest.x);
            document.getElementById('longend').value = pointDest.x.toFixed(4);
            document.getElementById('latend').value = pointDest.y.toFixed(4);
          } else {
            alert("Enter source coordinates");
            return;
          }
        }
        // ///////////////////////////////////////////////////////////
        function transformendutm() {
          var crsSource = document.getElementById('crsSource');
          var projSource = null;
        //   console.log(crsSource.value);
      
          if (crsSource.value) {
            projSource = projHash["WGS84"];
          } else {
            alert("Select a source coordinate system");
            return;
          }
      
          var crsDest = document.getElementById('crsDest');
        //   console.log(crsDest.value);
          var projDest = null;
          if (crsDest.value) {
            projDest = projHash["EPSG:32647"];
          } else {
            alert("Select a destination coordinate system");
            return;
          }
          
          var pointInputX = document.getElementById('longend');
          var pointInputY = document.getElementById('latend');
          var pointInput = pointInputX.value+","+pointInputY.value;
        
          if (pointInputX.value) {
            var pointSource = new Proj4js.Point(pointInput);
            var pointDest = Proj4js.transform(projSource, projDest, pointSource);
            // console.log(pointDest.x);
            document.getElementById('xend').value = pointDest.x.toFixed(0);
            document.getElementById('yend').value = pointDest.y.toFixed(0);
          } else {
            alert("Enter source coordinates");
            return;
          }
        }
        
        </script>
        {{-- xxx UTM xxx --}}
</head>

<body onload="initProj4js(); checkHumStr('{{ $blk_problem_detail[$id]   }}'); loadRadioButton('{{ $uid }}'); loadProjStatus('{{ $blk_project->proj_status }}');">

    <div class="dashboard-main-wrapper">
        @include('includes.head')
        @include('includes.header')
        <div class="dashboard-wrapper">
                
            <div class="flex-center position-ref full-height">
                   

                <div class="content">
                    <div class="title m-b-md">
                        <img src="{{ asset('images/logo/head_form.png') }}" width="100%">
                    </div>
                    <div class="row" style="padding-left:30px;">
                        <h4><a href="{{ asset('/blocker') }}">รายละเอียดแบบสำรวจ </a> &raquo; แก้ไขแบบสำรวจ &raquo; {{ $obj[$id]->blk_code }} </h4>
                        
                    </div>

                    <div class="title m-b-md form-group">
                            <?php
                            $text='edit/'. $obj[$id]->blk_id ;
                        ?>

                        <form action="{{asset($text)}}" method="get" onsubmit="return confirm('แก้ไข เรียบร้อย !!');">
                            <input id="blk_id" name="blk_id" type="hidden" value="{{ $obj[$id]->blk_code }}">
                            <table class="table table-borderless" >
                                <tr  >
                                    <th colspan="3"align="left" >ลำน้ำที่เกิดปัญหาการกีดขวางทางน้ำ</th>
                                </tr>
                                <tr>
                                    <th>ชื่อลำน้ำ : </th>
                                    <td><input type="text" id="river_name" name="river_name" value='{{ $river[$id]->river_name ?? "" }}' placeholder="-- กรอกชื่อ --" required ></td>

                                </tr>
                                <tr>
                                    <th align="right"> เป็นสาขาของแม่น้ำ :</th>
                                    
                                    <td><input type="text" id="river_main" name="river_main" value='{{ $river[$id]->river_main ?? "" }}' placeholder="-- กรอกชื่อ --" required></td>
                                </tr>
                                
                            </table>
                            <br>
                            {{-- 1 ลักษณะทั่วไป--}}
                            <h4><span class="number">1 </span>  ลักษณะทั่วไป  </h4> </td>

                            <table class="table table-borderless">

                                {{-- 1.1 --}}
                                <tr>
                                    <th colspan="2">1.1 ประเภทลำน้ำ : </th>
                                    <td>
                                        <select id="river_type" name="river_type">
                                            <option value="{{ $river[$id]->river_type }}">{{ $river[$id]->river_type }}</option>
                                            <option value="แม่น้ำสายหลัก">แม่น้ำสายหลัก</option>
                                            <option value="แม่น้ำสาขา">แม่น้ำสาขา</option>
                                            <option value="ลำห้วย">ลำห้วย</option>
                                        </select>
                                        <div class="invalid-feedback"></div>


                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2">1.2 ที่ตั้งของช่วงเวลาที่เกิดปัญหา </th>
                                </tr>

                                <tr>
                                    <td align="right">จังหวัด : </td>
                                    <td colspan="2">
                                        <select id="blk_province" name="blk_province" value=''>
                                            <option value="chiangrai">เชียงราย</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>

                                    <td align="right">อำเภอ : </td>
                                    <td colspan="2">

                                        <select id='blk_district' name='blk_district' required onchange="validateForm(this.id)">
                                            <option value='{{ $obj[$id]->blockage_location->blk_district }}'>{{ $obj[$id]->blockage_location->blk_district }}</option>

                                            <!-- Read district -->

                                            @foreach($districtData['data'] as $village)
                                            <option value='{{ $village->vill_district }}'>{{ $village->vill_district  }}</option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback"></div>


                                    </td>
                                </tr>

                                <tr>
                                    <td align="right">ตำบล : </td>
                                    <td colspan="2">
                                        <select id="blk_tumbol" name="blk_tumbol" required onchange="validateForm(this.id)">
                                            <option value='{{ $obj[$id]->blockage_location->blk_tumbol }}'>{{ $obj[$id]->blockage_location->blk_tumbol }}</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">หมู่บ้าน : </td>
                                    <td colspan="2">
                                        <select id="blk_village" name="blk_village" required onchange="validateForm(this.id)">
                                            <option value='{{ $obj[$id]->blockage_location->blk_village }}'>{{ $obj[$id]->blockage_location->blk_village }}</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </td>
                                </tr>
                            </table>

                            {{-- Location --}}
                            <table>
                                    <tr>
                                            <td colspan="2">
                                                <select name="crsSource" id="crsSource" onchange="updateCrs('Source')"  style="visibility:hidden;">
                                                    <option value selected="selected">Select a CRS</option>
                                                </select>
                                            </td>
                                            <td colspan="2">
                                                <select name="crsDest" id="crsDest" onchange="updateCrs('Dest')"  style="visibility:hidden;">
                                                    <option value selected="selected">Select a CRS</option>
                                                </select>
                                            </td>
                                    </tr>
                            </table>
    
                                <table style="margin-left:10px;" class="table table-borderless">
                                    <tr>
                                        <td colspan="5">พิกัดเริ่มต้นของปัญหา : </td>
                                    </tr>
    
                                    <tr>
                                        <td></td>
                                        <td><input type="text" id="xstart" name="xstart" placeholder="UTM Easting" value='{{ $obj[$id]->blockage_location->blk_start_utm->coordinates[1] ?? "" }}'></td>
                                        <td rowspan="2" align="center"><button type="button" onclick="transform()"> >></button>
                                                    <br><button type="button" onclick="transformutm()"> <<</button>
                                        </td>
                                        <td><input type="text" id="latstart" name="latstart" placeholder="Latitude" value='{{ $obj[$id]->blockage_location->blk_start_location->coordinates[1] ?? "" }}'></td>
                                        
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="text" id="ystart" name="ystart" placeholder="UTM Northing" value='{{ $obj[$id]->blockage_location->blk_start_utm->coordinates[0] ?? "" }}'></td>
                                        <td><input type="text" id="longstart" name="longstart" placeholder="Longitude" value='{{ $obj[$id]->blockage_location->blk_start_location->coordinates[0] ?? "" }}'></td>
                                        
                                    </tr>
                                    <tr>
                                        <td></td><td></td>
                                        <td align="center" colspan="2">  <button type="button" onclick="getStLocation()" >Location</button>
                                   </tr>
                                </table>
                                <table style="margin-left:10px;" class="table table-borderless">
    
                                    <tr>
                                        <td colspan="5">พิกัดสิ้นสุดของปัญหา : </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="text" id="xend" name="xend" placeholder="UTM Easting" value='{{ $obj[$id]->blockage_location->blk_end_utm->coordinates[1] ?? "" }}'></td>
                                        <td rowspan="2" align="center"><button type="button" onclick="transformend()"> >></button><br>
                                            <button type="button" onclick="transformendutm()"> <<</button>
                                        </td>
                                        <td><input type="text" id="latend" name="latend" placeholder="Latitude" value='{{ $obj[$id]->blockage_location->blk_end_location->coordinates[1] ?? "" }}'></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="text" id="yend" name="yend" placeholder="UTM Northing" value='{{ $obj[$id]->blockage_location->blk_end_utm->coordinates[0] ?? "" }}'></td>
                                        <td><input type="text" id="longend" name="longend" placeholder="Longitude" value='{{ $obj[$id]->blockage_location->blk_end_location->coordinates[0] ?? "" }}'></td>
                                        
                                    </tr>
                                    <tr>
                                        <td></td><td></td>
                                        <td align="center" colspan="2">  <button type="button" onclick="getFinLocation()" >Location</button>
                                   </tr>
    
                                </table>
                             
                            {{-- 1.3 --}}
                            <table class="table table-form table-borderless">
                                    <tr>
                                        <th colspan="4">1.3 หน้าตัดของลำน้ำเดิมในอดีตก่อนเกิดปัญหา </th>
                                    </tr>
                                    <tr>
                                        <td width="9%"></td>
                                        <td><input type="text" id="cross_width_past" name="past[width]" placeholder="กว้าง (ม.)" value='{{ $blk_crossection_past->width ?? "" }}' ></td>
                                        <td><input type="text" id="cross_depth_past" name="past[depth]" placeholder="ลึก (ม.)" value='{{ $blk_crossection_past->depth ?? "" }}' ></td>
                                        <td><input type="text" id="cross_slope_past" name="past[slop]" placeholder="ความลาดชันตลิ่ง" value='{{ $blk_crossection_past->slop ?? "" }}' ></td>
                                    </tr>
                            </table>
                            {{-- 1.4 --}}
                            <table class="table table-form table-borderless">



                                    <tr>
                                        <th colspan="4">1.4 หน้าตัดของช่วงลำน้ำในปัจจุบันที่เกิดปัญหา </th>
                                    </tr>
                                    <tr>
    
                                        <td style="padiing-left:20px;" colspan="3">1.4.1. หน้าตัดของลำน้ำ<b>ก่อน</b>ถึงช่วงที่เริ่มที่เกิดปัญหา </td>
                                    </tr>
                                    <tr>
                                        <td width="9%"></td>
                                        <td><input type="text" id="cross_width_now" name="current_start[width]" placeholder="กว้าง (ม.)" value='{{ $blk_crossection_current_start->width ?? "" }}'  ></td>
                                        <td><input type="text" id="cross_depth_now" name="current_start[depth]" placeholder="ลึก (ม.)" value='{{ $blk_crossection_current_start->depth ?? "" }}'  ></td>
                                        <td><input type="text" id="cross_slope_now" name="current_start[slop]" placeholder="ความลาดชันตลิ่ง" value='{{ $blk_crossection_current_start->slop ?? "" }}'  ></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="padiing-left:20px;">1.4.2. หน้าตัดของลำน้ำที่<b>แคบที่สุด</b>ในช่วงของลำน้ำที่เกิดปัญหา </td>
                                    </tr>
                                    <tr>
                                        <td width=10%></td>
                                        <td ><input type="checkbox" id="xsection_status" name="current_narrow[type]" value="waterway" /><label for="xsection_status"> ทางน้ำเปิด </label></td>
                                        <td><input type="text" id="cross_width_narrow" name="current_narrow[width]" placeholder="กว้าง (ม.)" value='{{ $blk_crossection_current_narrow->width ?? "" }}' ></td>
                                        <td><input type="text" id="cross_depth_narrow" name="current_narrow[depth]" placeholder="ลึก (ม.)" value='{{ $blk_crossection_current_narrow->depth ?? "" }}' ></td>
                                        <td><input type="text" id="cross_slope_narrow" name="current_narrow[slop]" placeholder="ความลาดชันตลิ่ง" value='{{ $blk_crossection_current_narrow->slop ?? "" }}' ></td>
                                    </tr>

                                    <tr>
                                        <td width=10%></td>
                                        <td ><input type="checkbox" id="bridge" name="current_narrow[type]" value="bridge" /><label for="bridge"> สะพาน </label></td>
                                        <td><input type="text" id="cross_width_bridge" name="current_bridge[width]" placeholder="กว้าง (ม.)" value='{{ $blk_crossection_current_brigde->width ?? "" }}' ></td>
                                        <td><input type="text" id="cross_depth_bridge" name="current_bridge[depth]" placeholder="ลึก (ม.)" value='{{ $blk_crossection_current_brigde->depth ?? "" }}' ></td>
                                        <td><input type="text" id="cross_len_bridge" name="current_bridge[len]" placeholder="ความยาวช่วงตอม่อ (ม.)" value='{{ $blk_crossection_current_brigde->len ?? "" }}' ></td>
                                        <td><input type="text" id="cross_num_bridge" name="current_bridge[num]" placeholder="จำนวนตอม่อ (แถว)" value='{{ $blk_crossection_current_brigde->num ?? "" }}' ></td>
                                    </tr>

                                    <tr>
                                        <td ></td>
                                        <td ><input type="checkbox"  id="culvert_round" value="round" name="current_narrow[culvert][round]" ><label for="culvert_round">ท่อกลม</label></td>
                                        <td><input type="text" id="diameter_culvert" name="current_narrow[culvert][diameter]" placeholder="เส้นผ่าศูนย์กลาง (ม.)" value='{{ $blk_crossection_current_narrow->culvert->diameter ?? "" }}'  ></td>
                                        <td><input type="text" id="num_culvert1" name="current_narrow[culvert][c][num]" step="any" placeholder="จำนวนท่อ (ช่อง)" value='{{ $blk_crossection_current_narrow->culvert->c->num ?? "" }}' > </td>
                                        <td><input type="text" id="len_culvert1" name="current_narrow[culvert][c][len]" step="any" placeholder="ยาว (ม.)" value='{{ $blk_crossection_current_narrow->culvert->c->len ?? "" }}' > </td>
                                    </tr>
                                    <tr>
                                        <td> <input type="hidden" name="current_narrow[type]" value="culvert"></td>
                                        <td ><input type="checkbox" id="culvert_square" value="square" name="current_narrow[culvert][sq]"><label for="culvert_square">ท่อเหลี่ยม</label></td>
                                        <td ><input type="text" id="width_culvert" name="current_narrow[culvert][width]" placeholder="กว้าง (ม.)" value='{{ $blk_crossection_current_narrow->culvert->width ?? "" }}' ></td>
                                        <td ><input type="text" id="high_culvert" name="current_narrow[culvert][high]" placeholder="สูง (ม.)" value='{{ $blk_crossection_current_narrow->culvert->high ?? "" }}'></td>
                                        <td ><input type="text" id="num_culvert2" name="current_narrow[culvert][sq][num]" placeholder="จำนวนท่อ (ช่อง)" step="any" value='{{ $blk_crossection_current_narrow->culvert->sq->num ?? "" }}' ></td>
                                        <td><input type="text" id="len_culvert2" name="current_narrow[culvert][sq][len]" step="any" placeholder="ยาว (ม.)" value='{{ $blk_crossection_current_narrow->culvert->sq->len ?? "" }}' > </td>
                                    </tr>
                                    <tr>
                                        <td> <input type="hidden" name="current_narrow[type]" value="culvert"></td>
                                        <td valign="top"><input type="checkbox" id="xsection_status3" name="current_narrow[type]" value="other" /><label for="xsection_status3">อื่นๆ</label></td>
                                        <td colspan="4"><textarea rows="1" cols="100" id="current_narrow" name="current_narrow[other]" value="oo"> {{ $blk_crossection_current_narrow->other ?? "" }}</textarea></td>
                                    </tr>
                                  
                                        <tr>
                
                                            <td colspan="3" style="padiing-left:20px;">1.4.3. หน้าตัดของลำน้ำ<b>ท้ายน้ำ</b>หลังช่วงที่เกิดปัญหา </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="text" id="cross_width_end" name="current_end[width]" placeholder="กว้าง (ม.)" value='{{ $blk_crossection_current_end->width ?? "" }}' ></td>
                                            <td><input type="text" id="cross_depth_end" name="current_end[depth]" placeholder="ลึก (ม.)" value='{{ $blk_crossection_current_end->depth ?? "" }}' ></td>
                                            <td><input type="text" id="cross_slope_end" name="current_end[slope]" placeholder="ความลาดชันตลิ่ง" value='{{ $blk_crossection_current_end->slope ?? "" }}' ></td>
                                        </tr>
                                    </table>
                            {{-- 1.5 --}}
                            <table class="table table-form table-borderless">
                                    <tr>
                                        <th colspan="3">1.5 ความยาวของช่วงลำน้ำที่เกิดปัญหา </th>
                                    </tr>
                                </table>
                                <table class="table table-form table-borderless" width=80%>
                                    <tr>
                                        <td width=10%></td>
                                        <td width=25%><input type="radio" id="blk_length1"  name="blk_length_type" value="น้อยกว่า 10 เมตร"><label for="blk_length1">น้อยกว่า 10 เมตร. </label></td>
                                    </tr>
                                    <tr>
                                        <td width=10%></td>
                                        <td><input type="radio" id="blk_length2"  name="blk_length_type"  value="10 -1000 เมตร" ><label for="blk_length2"> 10 -1000 เมตร.</label></td>
                                        <td >
                                            <select id="blk_length_lo" name="blk_length_lo" value='{{ $len_prob ?? "" }}'>
                                                <option value="{{$len_prob_value}}">{{$len_prob}}</option>
                                                <option value="10-50 เมตร">10-50 เมตร</option>
                                                <option value="50-100 เมตร">50-100 เมตร</option>
                                                <option value="100-200 เมตร">100-200 เมตร</option>
                                                <option value="200-400 เมตร">200-400 เมตร</option>
                                                <option value="400-600 เมตร">400-600 เมตร</option>
                                                <option value="600-800 เมตร">600-800 เมตร</option>
                                                <option value="800-1000 เมตร">800-1000 เมตร</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width=10%></td>
                                        <td><input type="radio" id="blk_length3"  name="blk_length_type"value="มากกว่า 1 กิโลเมตร"><label for="blk_length3">มากกว่า 1 กิโลเมตร</label></td>
                                        <td><input type="text" id="blk_length_1k"  name="blk_length" placeholder="-- ระบุระยะมากกว่า 1 กม.--" value='{{ $len_morekm ?? "" }}'></td>
                                    </tr>    
                            </table>
                            {{-- 1.5 --}}
                            <table class="table table-form table-borderless">
                                    <tr>
                                        <th width=20%>1.6 การดาดผิวของลำน้ำ </th>
                                        <td width=20%><input type="radio" id="blk_surface1" value="ไม่ดาดผิว" name="blk_surface" ><label for="blk_surface1">ไม่ดาดผิว</label></td>
                                        <td><input type="radio" id="blk_surface2" value="ดาดผิว" name="blk_surface" ><label for="blk_surface2">ดาดผิว</label></td>
                                        <td></td>
                                    </tr>
                                    <tr>
    
                                        <td align="right">วัสดุที่ดาดผิวของลำน้ำ : </td>
                                        <td colspan="2"><input type="text" id="blk_surface_detail" name="blk_surface_detail" placeholder="ระบุวัสดุ" value='{{ $obj[$id]->blk_surface_detail  }}'>
                                         
                                        </td>
    
                                    </tr>
    
                            </table>
                            {{-- 1.7 --}}
                            <table class="table table-form table-borderless">
                                    <tr>
                                        <th width=30%>1.7 ความลาดชันท้องน้ำช่วงที่เกิดปัญหา </th>
                                        <td colspan="2"><input type="text" id="blk_slope_bed" name="blk_slope_bed" placeholder="ระบุความลาดชัน" value="{{$obj[$id]->blk_slope_bed}}">
                                        </td>
    
                                    </tr>
    
                                </table>
                            {{-- 2 ความเสียหาย --}}
                            <h4><span class="number">2</span>ความเสียหายที่เคยเกิดขึ้น</h4>
                            <table class="table table-form table-borderless" >
                                <tr>
                                    <th colspan="6">2.1 ลักษณะของความเสียหาย </th>
                                </tr>
                            </table>
                            <table align="center"  class="table-damages table-borderless" width="80%">
                                <tr>

                                    <td colspan="3"><input type="hidden" name="damage_type[flood]" value="0">
                                                    <input type="checkbox" id="damage_type1"  name="damage_type[flood]" value="1" onclick="damageLevelRadioValidation()"> 
                                                    <label for="damage_type1">น้ำท่วม</label>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td width="5%"></td>
                                    <td ><input type="hidden" name="damage_level[flood]" value="0">
                                        <input type="radio" id="damageflood1" name="damage_level[flood]" value="low" /><label for="damageflood1">น้อย</label></td>
                                    <td><input type="radio" id="damageflood2" name="damage_level[flood]" value="medium" /><label for="damageflood2"> ปานกลาง</label></td>
                                    <td><input type="radio" id="damageflood3" name="damage_level[flood]" value="high" /> <label for="damageflood3">มาก</label></td>
                                </tr>
                                <tr>

                                    <td colspan="3"><input type="hidden" name="damage_type[waste]" value="0">
                                                    <input type='checkbox' id="damage_type2"  name='damage_type[waste]' value="1" onclick="damageLevelRadioValidation()">
                                                    <label for="damage_type2">น้ำเสีย</label>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td width="5%"></td>
                                    <td ><input type="hidden" name="damage_level[waste]" value="0">
                                        <input type="radio" id="damagewaste1" name="damage_level[waste]" value="low" /><label for="damagewaste1">น้อย</label></td>
                                    <td><input type="radio" id="damagewaste2" name="damage_level[waste]" value="medium" /><label for="damagewaste2"> ปานกลาง</label></td>
                                    <td><input type="radio" id="damagewaste3" name="damage_level[waste]" value="high" /> <label for="damagewaste3">มาก</label></td>

                                    {{-- <td><input type="hidden" name="damage_level[waste]" value="0">
                                        <input type="radio" id="damagewaste1" name="damage_level[waste1]" value="low" /><label for="damagewaste1"> น้อย </label></td>
                                    <td><input type="radio" id="damagewaste2" name="damage_level[waste1]" value="medium" /><label for="damagewaste2"> ปานกลาง </label></td>
                                    <td><input type="radio" id="damagewaste3" name="damage_level[waste1]" value="high" /><label for="damagewaste3"> มาก </label></td> --}}
                                </tr>
                                <tr >
                                   <td width="10%"><input type="hidden" name="damage_type[other]" value="0">
                                                    <input type="checkbox" id="damage_type3"  name='damage_type[other]' value="1" onclick="damageLevelRadioValidation()">
                                                    <label for="damage_type3">อื่นๆ </label>
                                    <td colspan="2">
                                        <input type="hidden" name="damage_level[other][detail]" value="NULL">
                                                    <input type="text" name="damage_level[other][detail]" id="damageotherdetail" size="5" placeholder="ระบุ">
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td width="5%"></td>
                                    <td><input type="hidden" name="damage_level[other][level]" value="0">
                                        <input type="radio" id="damageother1" name="damage_level[other][level]" value="low" disabled/>
                                        <label for="damageother1"> น้อย </label>
                                    </td>
                                    <td><input type="radio" id="damageother2" name="damage_level[other][level]" value="medium" disabled/> <label for="damageother2">ปานกลาง </label></td>
                                    <td><input type="radio" id="damageother3" name="damage_level[other][level]" value="high" disabled/> <label for="damageother3">มาก </label></td>
                                </tr>
                            </table>

                            <table class="table table-form table-borderless">

                                <tr>
                                    <th colspan="5">2.2 ความถี่ที่เกิดความเสียหาย </th>
                                </tr>
                            </table>
                            <table align="center" width="80%" class="table table-form table-borderless">
                                <tr>
                                    <td></td>
                                    <td colspan="2"><input type="radio" id="damage_frequency1" value="มากกว่า 4 ปีครั้ง" name="damage_frequency" ><label for="damage_frequency1">มากกว่า 4 ปีครั้ง </label></td>
                                    <td><input type="radio" id="damage_frequency2" value="2-4 ปีครั้ง" name="damage_frequency" ><label for="damage_frequency2">2-4 ปีครั้ง </label></td>
                                    <td><input type="radio" id="damage_frequency3" value="ทุกปี" name="damage_frequency" > <label for="damage_frequency3">ทุกปี </label></td>

                                </tr>
                            </table>
                            <br>
                           {{-- ข้อ 3 สภาพปัญหา --}}
                           <span class="number">3</span>สภาพปัญหา
                           <table  class="table table-form table-borderless">
                               <tr>
                                   <th colspan="6">3.1 สาเหตุการกีดขวางลำน้ำโดย (เลือกได้หลายข้อ) </th>
                               </tr>
                           </table>
                           <table align="center" class="table table-form table-borderless" >
                               {{-- ธรรมชาติ --}}
                               <tr>

                                   <td colspan="2">ธรรมชาติ</td>
                               </tr>
                               <tr>
                                
                                    <?php 
                                        function add($t) {
                                            if($t=='1'){
                                                $text='value=1 checked';
                                            }else{
                                                $text='value=1';
                                            }
                                            return $text;
                                    }?> 
                                        
                                    
                                    <td><input type="checkbox" id="nat_erosion" name="nat_erosion" {{add($blk_problem_detail[$id]->nat_erosion)}}  /> <label for="nat_erosion"> ตลิ่งพัง, การกัดเซาะ </label></td>
                                    <td><input type="checkbox" id="nat_shoal" name="nat_shoal"   {{add ($blk_problem_detail[$id]->nat_shoal)}} /><label for="nat_shoal"> การทับถมของตะกอน (ลำน้ำตื้นเขิน)</label></td>


                               </tr>
                               <tr>

                               <td><input type="checkbox" id="nat_missing" name="nat_missing" {{add($blk_problem_detail[$id]->nat_missing)}} /><label for="nat_missing">ลำน้ำขาดหาย</label></td>
                               <td><input type="checkbox" id="nat_winding" name="nat_winding" {{add($blk_problem_detail[$id]->nat_winding )}} /> <label for="nat_winding">ลักษณะทางกายภาพของล้ำน้ำ </label></td>


                               </tr>
                               <tr>

                               <td><input type="checkbox" id="nat_weed" name="nat_weed" {{add($blk_problem_detail[$id]->nat_weed)}}> <label for="nat_weed"> วัชพืช </label></td>
                               <td><input type="text" id="nat_cause_5_detail" name="nat_weed_detail" placeholder="ระบุวัชพืช" value={{$blk_problem_detail[$id]->nat_weed_detail}}></td>
                               <tr>

                                   <td><input type="checkbox" id="nat_other" name="nat_other" {{add($blk_problem_detail[$id]->nat_other)}} > <label for="nat_other"> อื่นๆ </label></td>
                                   <td><input type="text" id="nat_cause_6_detail" name="nat_other_detail" placeholder="ระบุ" value={{$blk_problem_detail[$id]->nat_other_detail}}></td>
                               </tr>
                               {{-- มนุษย์ --}}
                               <tr>
                                   <td colspan="2">มนุษย์</td>
                               </tr>
                               {{-- สิ่งปลูกสร้าง --}}

                               <tr>

                                   <td colspan="2"><input type="checkbox" id="hum_structure" name="hum_structure" {{add($blk_problem_detail[$id]->hum_structure)}}' onclick="damageLevelRadioValidation()" /><label for="hum_structure">สิ่งปลูกสร้าง</label></td>
                               </tr>
                               <tr>
                                   <td style="padding-left:20px;" colspan="2"><input type="checkbox" id="hum_str_gov" name="hum_str_owner_type" value="ราชการ" onclick="causeOfDamageValidate()"/><label for="hum_str_gov">เป็นส่วนราชการ </label></td>

                               </tr>
                               <?php if($blk_problem_detail[$id]->hum_str_owner_type=="ราชการ"){
                                   $bld_gov=$blk_problem_detail[$id]->hum_stc_bld_num;
                                   $fence_gov=$blk_problem_detail[$id]->hum_stc_fence_num;
                                   $other_gov=$blk_problem_detail[$id]->hum_str_other ;
                                   $bld_bu=null;
                                   $fence_bu=null;
                                   $other_bu=null ;
                               }else {
                                   $bld_bu=$blk_problem_detail[$id]->hum_stc_bld_bu_num;
                                   $fence_bu=$blk_problem_detail[$id]->hum_stc_fence_bu_num;
                                   $other_bu=$blk_problem_detail[$id]->hum_str_other_bu ;
                                   $bld_gov=null;
                                   $fence_gov=null;
                                   $other_gov=null ;
                               }?>
                               <tr>
                                   <td colspan="3">
                                       <table align="center" class="table table-form table-borderless">
                                           <tr>

                                               <td >ส่วนของอาคาร</td><td> <input type="text" id="hum_stc_bld_num" name="hum_stc_bld_num" placeholder="ระบุ (หลัง)" value='{{ $bld_gov }}' ></td>
                                               <td >รั้ว</td><td><input type="text" id="hum_stc_fence_num" name="hum_stc_fence_num" placeholder="ระบุ  (หลัง)" value='{{ $fence_gov}}'></td>
                                               <td >อื่นๆ </td><td><input type="text" id="hum_str_other" name="hum_str_other" placeholder="ระบุ" value='{{ $other_gov }}'></td>

                                           </tr>
                                       </table>
                                   </td>
                               </tr>

                               <tr>
                                   <td style="padding-left:20px;" colspan="2"><input type="checkbox" id="hum_str_bu" name="hum_str_owner_type" value="เอกชน" onclick="causeOfDamageValidate()" /><label for="hum_str_bu">เป็นสวนของเอกชนหรือส่วนบุคคล </label></td>
                               </tr>
                               <tr>
                                   <td colspan="2">
                                       <table align="center" class="table table-form table-borderless">
                                           <tr>
                                               <td >ส่วนของอาคาร</td><td> <input type="text" id="hum_stc_bld_bu_num" name="hum_stc_bld_bu_num" placeholder="ระบุ (หลัง)" value='{{ $bld_bu }}'> </td>
                                               <td >รั้ว</td><td><input type="text" id="hum_stc_fence_bu_num" name="hum_stc_fence_bu_num" placeholder="ระบุ  (หลัง)" value='{{ $fence_bu ?? "" }}'> </td>
                                               <td >อื่นๆ </td><td><input type="text" id="hum_str_other_bu" name="hum_str_other" placeholder="ระบุ" value='{{$other_bu}}' ></td>

                                           </tr>
                                       </table>
                                   </td>
                               </tr>
                               <tr>
                                   <td style="padding-bottom:20px;"></td>
                               </tr>
                                {{-- infa --}}
                                {{-- infa --}}
                                <tr>
                                        <td colspan="2"><input type="checkbox" name="hum_type" id="huminfa" value="ระบบสาธารณูปโภค" /> <label for="huminfa"> ระบบสาธารณูปโภค (ถนน ท่อลอด สะพานและอื่นๆ) </label></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:40px;"><input type="checkbox" id="hum_road" name="hum_road" {{add($blk_problem_detail[$id]->hum_road)}}><label for="hum_road">ถนนขวางทางน้ำ </label></td>
                                        <td style="padding-left:40px;"><input type="checkbox" id="hum_smallconvert" name="hum_smallconvert"  {{ add($blk_problem_detail[$id]->hum_smallconvert)}}><label for="hum_smallconvert">ท่อลอดถนนที่ตัดลำน้ำมีขนาดเล็กเกินไประบายน้ำหลากไม่ทัน</label></td>
                                    </tr>
                                    <tr>
                                            <td style="padding-left:40px;"><input type="checkbox" id="hum_road_paralel" name="hum_road_paralel" {{ add($blk_problem_detail[$id]->hum_road_paralel )}} > <label for="hum_road_paralel">ถนนขนานลำน้ำสร้างกินพื้นที่ลำน้ำ </label></td>
                                            <td style="padding-left:40px;"><input type="checkbox" id="hum_replaced_convert" name="hum_replaced_convert" {{ add($blk_problem_detail[$id]->hum_replaced_convert)}}><label for="hum_replaced_convert">วางท่อตามแนวลำน้ำทดแทนลำน้ำเดิม</label></td>
                                     </tr>
                                    <tr>
                                        <td style="padding-left:40px;" colspan="2"> <input type="checkbox" id="hum_bridge_pile" name="hum_bridge_pile" {{ add($blk_problem_detail[$id]->hum_bridge_pile )}}><label for="hum_bridge_pile">สะพานมีหน้าตัดแคบเกินไป หรือมีต่อม่อมากเกินไปในช่วงฤดูน้ำหลากระบายไม่ทัน</label></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:10px;"></td>
                                    </tr>
                                    <tr>
                                        <td ><input type="checkbox" id="hum_soil_cover" name="hum_soil_cover" {{ add($blk_problem_detail[$id]->hum_soil_cover) }} /><label for="hum_soil_cover">การถมดิน </label></td>
                                     </tr>
                                    <tr>
                                        <td ><input type="checkbox" id="hum_trash" name="hum_trash" {{add($blk_problem_detail[$id]->hum_trash)}} /><label for="hum_trash">สิ่งปฏิกูล </label></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" id="hum_other" name="hum_other" value='{{ $blk_problem_detail[$id]->hum_other ?? "" }}' onclick="causeOfDamageValidate()"/><label for="hum_other">อื่นๆ </label></td>
                                        <td ><input type="text" name="hum_other_detail" id="hum_other_detail" placeholder="ระบุ" /></td>
                                    </tr>
                            </table>
                            {{-- 3.2 --}}
                            <table class="table table-form table-borderless">

                                    <tr>
                                        <th colspan="6">3.2 ระดับกีดขวาง (เปอร์เซ็นต์คิดโดนพื้นที่ที่ถูกกีดขวางต่อพื้นที่ลำน้ำเดิม) </th>
                                    </tr>
                                </table>
                                <table align="center" class="table table-form table-borderless"> 
                                    <tr>
                                        <td ><input type="radio" id="problevel1" name="prob_level" value="1-30%"  /> <label for="problevel1">น้อย (1-30%) </label></td>
                                        <td ><input type="radio" id="problevel2" name="prob_level" value="30-70%" /><label for="problevel2">กลาง (30-70%)</label></td>
                                        <td ><input type="radio" id="problevel3" name="prob_level" value="มากกว่า 70%" /><label for="problevel3">มาก (มากกว่า 70%)</label></td>
                                    </tr>
                                </table>
                                <br>
                                {{-- ข้อ 4 การแก้ไข --}}
    
                                <h4><span class="number">4</span> การดำเนินการแก้ไขของหน่วยงานท้องถิ่น และหน่วยงานที่รับผิดชอบ</h4>
    
                                <table align="center" class="table table-form table-borderless">
                                    <tr>
                                        <td align="right">หน่วยงานที่รับผิดชอบ :</td>
                                    <td colspan="6"><input type="text" id="responsed_dept" name="responsed_dept" value="{{$solution[0]->responsed_dept}}">
                                            <div class="invalid-feedback"></div>
                                        </td>
                                    </tr>
                                    <tr>
    
                                        <td style="padding-left:40px;"><input type="radio" id="sol_how" name="sol_how" value="ปรับปรุงแก้ไข" onclick="solHowValidate()"><label for="sol_how">ปรับปรุงแก้ไขโดย </label></td>
                                        <td colspan="4"><input type="text" id="responsed_dept2" name="sol_edit" placeholder="(วิธีแก้ไขหรือโครงการ)" value="{{$solution[0]->sol_edit}}" disabled></td>
                                    </tr>
                                    <tr>
    
                                        <td style="padding-left:40px;"><input type="radio" id="sol_how2" name="sol_how" value="เจรจา" onclick="solHowValidate()"><label for="sol_how2">เจรจา</label></td>
                                        <td style="padding-left:40px;" colspan="2"><input type="radio" id="sol_how3" name="sol_how" value="ฟ้องร้อง"  onclick="solHowValidate()"><label for="sol_how3">ฟ้องร้อง</label></td>
                                        <td style="padding-left:40px;" colspan="2"><input type="radio" id="sol_how4" name="sol_how" value="รื้อถอน" onclick="solHowValidate()"><label for="sol_how4">รื้อถอน</label></td>
                                        <td style="padding-left:40px;" colspan="2" 99><input type="radio" id="sol_how5" name="sol_how" value="ยังไม่ได้ดำเนินการ" onclick="solHowValidate()"><label for="sol_how5">ยังไม่ได้ดำเนินการ</label></td>
                                    </tr>
                                </table>
                                {{-- 4.1 --}}
                                <table class="table table-form table-borderless">
                                    <tr>
                                        <th colspan="6">4.1 ผลการดำเนินการ </th>
                                    </tr>
                                </table>
                                <table class="table table-form table-borderless">
                                    <tr>
                                        <td width="15%"></td>
                                        <td colspan="2"><input type="radio" id="result_selector1" name="result_selector" value="ได้ผลดีสามารถแก้ไขปัญหาได้" ><label for="result_selector1">ได้ผลดีสามารถแก้ไขปัญหาได้</label></td>
                                        <td colspan="2"><input type="radio" id="result_selector2" name="result_selector" value="ได้ผลดีพอสมควรแก้ไขปัญหาได้บางส่วน" ><label for="result_selector2">ได้ผลดีพอสมควรแก้ไขปัญหาได้บางส่วน</label></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2"><input type="radio" id="result_selector3" name="result_selector" value="ได้ผลไม่ดีเท่าที่ควรแก้ไขปัญหาได้น้อย" ><label for="result_selector3"> ได้ผลไม่ดีเท่าที่ควรแก้ไขปัญหาได้น้อย</label></td>
                                        <td colspan="2"><input type="radio" id="result_selector4" name="result_selector" value="ไม่ได้ผล" ><label for="result_selector4"> ไม่ได้ผล </label></td>
                                    </tr>
                                </table>
                                {{-- 4.2 --}}
                                <table class="table table-form table-borderless">
                                    <tr>
                                        <th colspan="6">4.2 สถานภาพปัจจุบันของโครงการที่แก้ไขปัญหาได้ </th>
                                    </tr>
    
                                </table>
                                <table align="center" width="90%" class="table table-form table-borderless">
                                    <tr>
                                        <td><input type="radio" id="proj_status1" name="proj_status" value="plan" /><label for="proj_status1"> อยู่ในแผน </label></td>
                                        <td><input type="radio" id="proj_status2" name="proj_status" value="received" /><label for="proj_status2">ได้รับงบประมาณแล้ว</label></td>
                                        <td><input type="radio" id="proj_status3" name="proj_status" value="making" /><label for="proj_status3">กำลังปรับปรุงก่อสร้าง</label> </td>
                                        <td><input type="radio" id="proj_status4" name="proj_status" value="noplan" /><label for="proj_status4">ยังไม่มีในแผน </label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div id="showplan" class="myDiv" style="background-color:#fff;padding-top:30px;padding-bottom:30px;">
                                                <table align="center" >
                                                    <tr></tr>
                                                    <tr>
                                                        <td>ลักษณะโครงการ: </td>
                                                        <td><input type="text" id="proj_year" name="proj_year" step="any" placeholder="ระบุปี พ.ศ" value='{{ $blk_project->proj_year  }}'></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><input type="text" id="proj_name" name="proj_name" step="any" placeholder="ระบุชื่อโครงการ" value='{{ $blk_project->proj_char  }}'></td>
                                                    </tr>
                                                    <tr>
                                                        <td>งบประมาณ: </td>
                                                        <td><input type="text" id="proj_budget" name="proj_budget" step="any" placeholder="ระบุงบประมาณ" value='{{ $blk_project->proj_budget }}'></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div id="showreceived" class="myDiv" style="background-color:#fff;padding-top:10px;padding-bottom:30px;">
                                                <table align="center">
                                                    <tr></tr>
                                                    <tr>
                                                        <td>ลักษณะโครงการ: </td>
                                                        <td><input type="text" id="proj_name2" name="proj_name2" step="any" placeholder="ระบุชื่อโครงการ" value='{{ $blk_project->proj_char  }}'></td>
                                                    </tr>
    
                                                    <tr>
                                                        <td>งบประมาณ: </td>
                                                        <td><input type="text" id="proj_budget2" name="proj_budget2" step="any" placeholder="ระบุงบประมาณ" value='{{ $blk_project->proj_budget }}'></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                            </table>

                            <br><br>
                            <button type="submit" class="butsummit" >บันทึกข้อมูล</button>






                        </form>
                    </div>
                </div>

            </div> {{--flex-center --}}
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/location.js') }}"></script>
    <script src="{{ asset('js/showhide.js') }}"></script>
    <script src="{{ asset('js/chooseLocation.js') }}"></script>
    <script src="{{ asset('js/radioAndCheckbox.js') }}"></script>
    <script src="{{ asset('js/validateNewForm.js') }}"></script>
    <!-- {{-- <script>
                $(document).ready(function(){
                    $('input:checkbox').click(function() {
                        $('input:checkbox').not(this).prop('checked', false);
                    });
                });
        </script> --}} -->
</body>

</html>