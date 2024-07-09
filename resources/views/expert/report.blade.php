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
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.css') }}">
    <!-- leaflet -->
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" type="text/css">

   <style>
       .outline {
            border-bottom:3px #ffffff solid;
            background: transparent;
        }
        .line {
            border-bottom:1px #83748d dotted;
            background: transparent;
        }
        .box{
            border: 1px solid #83748d;
            padding: 0 5px 0 5px ;
            margin-left: 1px;
        }
        .box142{
            border: 1px solid #83748d;
            padding: 0 2px 0 2px ;
            margin-left: 1px;
            margin-bottom: -3px;
        }
        table{
            color: #000000;
            
           
        }
        /* tr{
            height: 25px;
        } */
        .t_center{
            text-align: center;
        }
        p.test {
            width: 40em; 
            word-wrap: break-word;
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
               
                <div class="">
                    
                        <div class="row">
                                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                                        <h4 ><a href="{{ asset('/blocker') }}">ข้อเสนอแนะโดยผู้เชี่ยวชาญ </a> &raquo;  {{ $data[0]->blk_code }}</h4>
                                        {{-- <h4 ><a href="{{ asset('/blocker') }}">ข้อเสนอแนะโดยผู้เชี่ยวชาญ </a> &raquo; xxxxxxx </h4> --}}
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" align="right">
                                        <a href="{{ url('/') }}"><button class="btn btn-sm btn-outline-light " >
                                            <i class="fa fa-home"></i> หน้าแรก</button></a>
                                        <a href='{{ asset('/expert/pdf/') }}/{{$data[0]->blk_id}}' >
                                            <button class="btn btn-sm btn-outline-light " >
                                            <i class="fa fa-file-pdf"></i> PDF</button></a>                        
                                </div>
                        </div>

                                <div class="row" >
                                    <div class="col-xl-1 col-lg-1">
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- basic table -->
                                    <!-- ============================================================== -->
                                    <?php 
                                        function checkZero($text) {
                                            if($text=="0" ||$text==NULL ){
                                                $num="-";
                                            }else{
                                                $num=$text;
                                             }
                                                return $num;
                                            }
                                        function checkProbleLevel($text){
                                            if($text==NULL){
                                                return "-";
                                            }
                                            else if($text=="1-30%"){
                                                return "น้อย";
                                            }else if($text=="30-70%"){
                                                return "ปานกลาง";
                                            }else{
                                                return "มาก";
                                            }
                                        }
                                        function checkPlan($text,$year,$char,$budget){
                                            if($text==NULL){
                                                return "-";
                                            }else if ($text=="plan"){
                                                $c="อยู่ใน".$year." ลักษณะโครงการ".$char." งบประมาณ ".$budget." บาท";
                                                return $c;
                                            }else if($text=="received"){
                                                return "ได้รับงบประมาณแล้ว".$budget."บาท ลักษณะโครงการ ".$char;
                                            }else if($text=="making"){
                                                return "กำลังปรับปรุงหรือก่อสร้าง";
                                            }else{
                                                return "ยังไม่มีในแผน";
                                            }
                                        }
                                        function checkDamage($flood,$waste,$other){
                                            
                                            if($flood=="0" && $waste=="0" && $other=="0"){
                                                return "  -";
                                            } else if($flood!=NULL||$flood!=0){
                                                return "น้ำท่วม";
                                            }else if($waste!=NULL||$waste!=0){
                                                return "น้ำเสีย";
                                            }else if($other!=NULL||$other!=0){
                                                return "อื่นๆ";
                                            }
                                        }
                                        function checklevel($flood,$waste,$other) {
                                            if($flood!=NULL||$flood!=0){
                                                if($flood=="low"){
                                                    $level="น้อย";
                                                }else if( $flood=="medium"){
                                                    $level="ปานกลาง";
                                                }else if( $flood=="high") {
                                                    $level="มาก";
                                                }else{
                                                    $level=NULL;
                                                }
                                            }else if($waste!=NULL||$waste!=0){
                                                if($waste=="low"){
                                                    $level="น้อย";
                                                }else if( $waste=="medium"){
                                                    $level="ปานกลาง";
                                                }else if( $waste=="high") {
                                                    $level="มาก";
                                                }else{
                                                    $level=NULL;
                                                }

                                            }else if($other!=NULL||$other!=0){
                                                if($other=="low"){
                                                    $level="น้อย";
                                                }else if( $other=="medium"){
                                                    $level="ปานกลาง";
                                                }else if( $other=="high") {
                                                    $level="มาก";
                                                }else{
                                                    $level=NULL;
                                                }
                                            }
                                                return $level;
                                        }
                                    ?>
                                    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12" > 
                                        <div class="card">
                                                
                                            <div class="card-body">
                                                <div class="flex-center position-ref full-height">
                                                    <div class="content">
                                                        <div class="title m-b-md">
                                                            <br>
                                                            <center><h2>การแก้ไขข้อมูลแนวทางการแก้ไขปัญหาสำหรับผู้เชี่ยวชาญ</h2></center>
                                                            <br>
                                                            {{-- <img src="{{ asset('images/logo/head_form.png') }}" width="100%"> --}}
                                                        </div>
                                                        <div align="right">
                                                            <h4> รหัสตำแหน่งกีดขวางที่: {{ $data[0]->blk_code }} </h4>
                                                        </div>
                                                        <h3><span class="number">1 </span>  ข้อมูลจากการสำรวจ  </h3> 
                                                        <div class="title m-b-md">
                                                            <table  width="80%" align="center">
                                                                   
                                                                    <tr>
                                                                        <td>ชื่อลำน้ำ {{ $data[0]->river->river_name }}</td>
                                                                        <td colspan="2"> เป็นสาขาของแม่น้ำ  {{  $data[0]->river->river_main  }} </td>
                                                                        <td>ประเภทลำน้ำ {{ $data[0]->river->river_type }}</td>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <td>หมู่บ้าน {{$data[0]->blockageLocation->blk_village}}</td>
                                                                        <td>ตำบล {{$data[0]->blockageLocation->blk_tumbol }}  </td>
                                                                        <td>อำเภอ {{  $data[0]->blockageLocation->blk_district  }}</td>
                                                                        <td>จังหวัด {{  $data[0]->blockageLocation->blk_province  }}</td>
                                                                    </tr>
                                                            </table>
                                        
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <td colspan="4" class="text-center" style="background-color:#C0C0C0">พิกัดเริ่มปัญหา</td>
                                                                        <td colspan="4" class="text-center" style="background-color:#C0C0C0">พิกัดสิ้นสุดปัญหา</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr align="center">
                                                                        <td width="5%">X(UTM)</td>
                                                                        <td>{{$data[0]->blockageLocation->blk_start_utm->getLat()}}</td>
                                                                        <td width="5%">Y(UTM)</td>
                                                                        <td>{{$data[0]->blockageLocation->blk_start_utm->getLng()}}</td>
                                                                        <td width="5%">X(UTM)</td>
                                                                        <td>{{$data[0]->blockageLocation->blk_end_utm->getLat()}}</td>
                                                                        <td width="5%">Y(UTM)</td>
                                                                        <td>{{$data[0]->blockageLocation->blk_end_utm->getLng()}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <td colspan="2" class="text-center" style="background-color:#C0C0C0">หน้าตัดลำน้ำที่เกิดปัญหา</td>
                                                                        <td colspan="3"  class="text-center" style="background-color:#C0C0C0">กว้าง (เมตร)</td>
                                                                        <td colspan="3"  class="text-center" style="background-color:#C0C0C0">ลึก (เมตร)</td>
                                                                        <td colspan="3"  class="text-center" style="background-color:#C0C0C0">ความชันตลิ่ง</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="2">หน้าตัดลำน้ำเดิมในอดีตก่อนเกิดปัญหา</td>
                                                                        <td colspan="3"  class="text-center" >{{ checkZero($pastData->width)}}</td>
                                                                        <td colspan="3"  class="text-center" >{{checkZero($pastData->depth) }}</td>
                                                                        <td colspan="3"  class="text-center" >{{ checkZero($pastData->slop) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2">หน้าตัดลำน้ำก่อนถึงที่เกิดปัญหา</td>
                                                                        <td colspan="3"  class="text-center" >{{ checkZero($current_start->width) }}</td>
                                                                        <td colspan="3"  class="text-center" >{{ checkZero($current_start->depth) }}</td>
                                                                        <td colspan="3"  class="text-center" >{{checkZero($current_start->slop) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="11">หน้าตัดที่แคบที่สุดของช่วงที่เกิดปัญหา</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2"> - ทางน้ำเปิด</td>
                                                                        <td colspan="3"  class="text-center">{{ checkZero($current_narrow_new->waterway->width )}} </td>
                                                                        <td colspan="3"  class="text-center">{{ checkZero($current_narrow_new->waterway->depth) }}</td>
                                                                        <td colspan="3"  class="text-center">{{ checkZero($current_narrow_new->waterway->slop) }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td rowspan="2"> - กรณีท่อลอด</td>
                                                                        <td>ท่อกลม</td>
                                                                        <td colspan="3" style="border: none;"> เส้นผ่านศูนย์กลาง</td>
                                                                        <td colspan="2" class="text-center"> {{ checkZero($current_narrow_new->round->diameter)}} </td> 
                                                                        <td>เมตร</td>
                                                                        <td> จำนวนท่อ </td>
                                                                        <td class="text-center"> {{ checkZero($current_narrow_new->round->num) }} </td>
                                                                        <td> ช่อง</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ท่อเหลี่ยม</td>
                                                                        <td>กว้าง </td>
                                                                        <td class="text-center">{{ checkZero($current_narrow_new->square->width) }}  </td>
                                                                        <td>เมตร</td>
                                                                        <td>สูง </td>
                                                                        <td class="text-center"> {{ checkZero($current_narrow_new->square->high)}} </td>
                                                                        <td> เมตร</td>
                                                                        <td>จำนวนท่อ </td>
                                                                        <td class="text-center">{{ checkZero($current_narrow_new->square->num)}}  </td>
                                                                        <td>ช่อง</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2"> - อื่นๆ</td>
                                                                        <td colspan="9"> {{ checkZero($current_narrow_new->other->detail) }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2">หน้าตัดลำน้ำด้านท้ายน้ำหลังช่วงที่เกิดปัญหา</td>
                                                                        <td class="text-center" colspan="3">{{ checkZero($current_end->width)  }}</td>
                                                                        <td class="text-center" colspan="3">{{ checkZero($current_end->depth)}} </td>
                                                                        <td class="text-center" colspan="3">{{ checkZero($current_end->slope) }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                            <table  width=90% style="margin-left: 20px;">
                                                                    <tr>
                                                                        <tr>
                                                                            <td colspan="2"><b>ความยาวของช่วงลำน้ำที่เกิดปัญหา เป็นจุดระยะ </b> {{checkZero($data[0]->blk_length_type)}} </td>
                                                                            <td ><b>การดาดผิวของน้ำ</b> {{checkZero($data[0]->blk_surface)}}</td>
                                                                            <td ><b>วัสดุที่ใช้ดาดผิวของน้ำ</b> {{checkZero($data[0]->blk_surface_detail)}}</td>
                                                                        </tr>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width=20%><b>ลักษณะความเสียหาย </b> {{ checkDamage($damageData->flood,$damageData->waste,$damageData->other->level)}}</td>
                                                                        <td width=30%><b>ระดับ</b> {{checklevel($damageData->flood,$damageData->waste,$damageData->other->level)}}</td>
                                                                        <td><b>ความถี่ที่เกิดความเสียหาย </b> {{checkZero($data[0]->damage_frequency)}} </td>
                                                                    </tr>
                                                            </table>
                                                            <table  width=90% style="margin-left: 20px;">
                                                                    <tr>
                                                                        <td colspan="3"><b>สาเหตุของการกีดขวางลำน้ำ</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="1" width=15%> &nbsp;&nbsp;&nbsp;> <b>โดยธรรมชาติ</b></td>
                                                                        <td colspan="2">{{checkZero($nut)}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td  width=15% valign="top"> &nbsp;&nbsp;&nbsp;> <b>โดยมนุษย์</b></td>
                                                                        <td width=3% valign="top"> จาก</td>
                                                                        <td >
                                                                            <?php 
                                                                                $n=0;
                                                                                    for($i=0;$i<5;$i++){
                                                                                        if($hum[$i]!=NULL){
                                                                                            echo $hum[$i]."<br>";
                                                                                        }else{
                                                                                            $n=$n+1;
                                                                                        }
                                                                                    }
                                                                                if($n==5){
                                                                                    echo "-";
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                            </table>
                                        
                                                            <table width=90% style="margin-left: 20px;">
                                                                <tr>
                                                                    <td width=20%> <b>ระดับการกีดขว้าง</b> {{checkProbleLevel($problem[0]->prob_level)}}</td>
                                                                    <td><b>คิดเป็น</b> {{checkZero($problem[0]->prob_level)}}</td>
                                                                    <td><b>หน่วยงานการดำเนินการแก้ไข</b> {{checkZero($solution_id[0]->responsed_dept)}}</td>
                                                                </tr>
                                                                    <tr>
                                                                        <td><b>โดยวิธี </b>{{$solution_id[0]->sol_how}}</td>
                                                                        <td colspan="2"><b>ผลการดำเนินการ</b> {{checkZero($solution_id[0]->result)}} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3"><b>สภาพในปัจจุบันของโครงการที่แก้ไขปัญหา</b> {{checkPlan($project_id[0]->proj_status,$project_id[0]->proj_year,$project_id[0]->proj_char,$project_id[0]->proj_budget)}}</td>
                                                                    </tr>
                                                            </table>
                                                            <br><br>
                                                            <h3><span class="number">2 </span>  รูปภาพประกอบ </h3> 
                                                            <table class="table table-bordered">
                                                                
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center"> 
                                                                            
                                                                            <img src="https://survey.crflood.com/{{($photo_Blockage[0]->thumbnail_name) }}">
                                                                        </td>
                                                                        <td align="center">
                                                                            <img src="https://survey.crflood.com/{{($photo_Blockage[1]->thumbnail_name) }}">
                                                                        </td>

                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <br><br>
                                                            <h3><span class="number">3 </span>  ข้อมูลสำหรับผู้เชียวชาญ  </h3> 


                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <td colspan="2" style="background-color:#C0C0C0">คำอธิบายสภาพปัญหา</td>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center" style="background-color:#C0C0C0" widht=30%>คำอธิบายสภาพปัญหาเบื้องต้น</td>
                                                                        <td class="text-center" style="background-color:#C0C0C0" >ข้อมูลพื้นที่รับน้ำของตำแน่งที่เกิดปัญหา</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td  ><textarea rows="8" cols="50" style="color:#000;"> {{checkZero($expert[0]->exp_problem)}} </textarea></td>
                                                                        <td rowspan="3">
                                                                            <table class="table table-bordered">
                                                                                <tr>
                                                                                    <td>พื้นที่ลาดชัน : </td>
                                                                                    <td><input type="text" value='{{checkZero($expert[0]->exp_slope)}}'></td>
                                                                                    <td></td>
                                                                                </tr>    
                                                                                <tr>
                                                                                    <td>A =</td>
                                                                                    <td><input type="text" value=' {{checkZero($expert[0]->exp_area)}}'></td>
                                                                                    <td>ตารางกิโลเมตร</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td> L0 =</td>
                                                                                    <td><input type="text" value=' {{checkZero($expert[0]->exp_L0)}}'></td>
                                                                                    <td>กิโลเมตร</td>
                                                                                </tr>
                                                                              
                                                                                <tr>
                                                                                    <td> H =</td>
                                                                                    <td><input type="text" value=' {{checkZero($expert[0]->exp_H)}}'></td>
                                                                                    <td>เมตร</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td> C  =</td>
                                                                                    <td><input type="text" value=' {{checkZero($expert[0]->exp_C)}}'></td>
                                                                                    <td></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td> tc  =</td>
                                                                                    <td><input type="text" value=' {{checkZero($expert[0]->exp_tc)}}'></td>
                                                                                    <td>ชั่วโมง</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td> I  =</td>
                                                                                    <td><input type="text" value=' {{checkZero($expert[0]->exp_I)}}'></td>
                                                                                    <td>มิลลิเมตร</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td> อัตราการไหลสูงสุด  =</td>
                                                                                    <td><input type="text" value=' {{checkZero($expert[0]->exp_maxflow)}}'></td>
                                                                                    <td>m<sup>3</sup>/s</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td> Return period  =</td>
                                                                                    <td><input type="text" value=' {{checkZero($expert[0]->exp_returnPeriod)}}'></td>
                                                                                    <td>ปี</td>
                                                                                </tr>

                                                                            </table>  
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center" style="background-color:#C0C0C0">แนวทางการแก้ไขเบื้องต้น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td ><textarea rows="8" cols="50" style="color:#000;"> {{checkZero($expert[0]->exp_solution)}} </textarea></td>
                                                                    </tr>
                                                                    
                                                                </tbody>
                                                                
                                                            </table>
                                                           
                                                            <button type="submit" class="butsummit" >บันทึกข้อมูล</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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


<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/main-js.js') }}"></script>
<script src="{{ asset('js/shortable-nestable/Sortable.min.js') }}"></script>
<script src="{{ asset('js/shortable-nestable/sort-nest.js') }}"></script>
<script src="{{ asset('js/shortable-nestable/jquery.nestable.js') }}"></script>

<script src="{{ asset('js/location.js') }}"></script>
<script src="{{ asset('js/showhide.js') }}"></script>
<script src="{{ asset('js/chooseLocation.js') }}"></script>
<script src="{{ asset('js/validateNewForm.js') }}"></script>


</body>
</html>
