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
                            <div class="page-header">
                                       
                            <h2 class="pageheader-title"><a href="{{ asset('/report_admin') }}">รายละเอียดแบบสำรวจ </a> &raquo; ผลการสำรวจการกีดขวางในแม่น้ำคูคลอง </h2>
                            {{-- <h3> รหัส {{ $data[0]->blk_id}} {{ $data[0]->blockageLocation->blk_village}} ต.{{ $data[0]->blockageLocation->blk_tumbol}} อ.{{ $data[0]->blockageLocation->blk_district}}</h3> --}}
                            </div>
                            
                        </div>
                </div>
                <div class="dashboard-short-list">
                        <div class="row" >
                                <div class="col-xl-1 col-lg-1">
                                </div>
                                <!-- ============================================================== -->
                                <!-- basic table -->
                                <!-- ============================================================== -->
                                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12" > 
                                    <div class="card">
                                        <div align="right">
                                            <h4 class="card-header drag-handle"> รหัสตำแหน่งกีดขวางที่: {{ $data[0]->blk_code }} </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                
                                                        <table class="table-name" width="90%" align="center">
                                                            <tr>
                                                                <td > <h3>ชื่อลำน้ำ <u>{{ $data[0]->river->river_name }}</u> </h3></td>
                                                                <td> <h3>ประเภทลำน้ำ<u> {{ $data[0]->river->river_type }}</u></h3> </td>
                                                                <td> <h3>หมู่บ้าน<u> {{ $data[0]->blockageLocation->blk_village }}</u></h3> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><h3>ตำบล <u>{{ $data[0]->blockageLocation->blk_tumbol }} </u></h3></td>
                                                                <td><h3>อำเภอ <u>{{ $data[0]->blockageLocation->blk_district }} </u></h3></td>
                                                                <td> <h3>จังหวัด <u> เชียงราย </u></h3></td>
                                                            </tr>
                                                        </table>
                                                    

                                                {{-- <div class="col-xl-4 col-lg-2 col-md-4 col-sm-4 col-4"  >
                                                    <h3>ชื่อลำน้ำ <u>{{ $data[0]->river->river_name }}</u> </h3>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4"  >
                                                    <h3>ประเภทลำน้ำ<u> {{ $data[0]->river->river_type }}</u></h3>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4"  >
                                                    <h3>หมู่บ้าน<u> {{ $data[0]->blockageLocation->blk_village }}</u></h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-xl-4 col-lg-2 col-md-4 col-sm-4 col-4"  >
                                                        <h3>ตำบล <u>{{ $data[0]->blockageLocation->blk_tumbol }} </u></h3>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4"  >
                                                        <h3>อำเภอ <u>{{ $data[0]->blockageLocation->blk_district }} </u></h3>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4"  >
                                                        <h3>จังหวัด <u> เชียงราย </u></h3>
                                                    </div>
                                            </div> --}}
                                            </div>
                                            
                                            <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="2" class="text-center" style="background-color:#C0C0C0">พิกัดเริ่มปัญหา</td>
                                                            <td colspan="2" class="text-center" style="background-color:#C0C0C0">พิกัดสิ้นสุดปัญหา</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody >
                                                        <tr>
                                                            <td>ละติจูด: {{ number_format($data[0]->blockageLocation->blk_start_location->getLat(), 4, '.', '') }}</td>
                                                            <td>ลองจิจูด: {{ number_format($data[0]->blockageLocation->blk_start_location->getLng(), 4, '.', '') }}</td>
                                                            <td>ละติจูด: {{ number_format($data[0]->blockageLocation->blk_end_location->getLng(), 4, '.', '')}}</td>
                                                            <td>ลองจิจูด: {{ number_format($data[0]->blockageLocation->blk_end_location->getLng(), 4, '.', '')}}</td>
                                                        </tr>
                                                    </tbody>
                                            </table>
                                            <br>
                                            <table class="table-name" width="100%">
                                                        <tr>
                                                            <td><h5>ความยาวของช่วงลำน้ำที่เกิดปัญหา :<u> {{$data[0]->blk_length_type}} ({{$data[0]->blk_length}})  </u></h5></td> 
                                                            <td><h5>การดาดผิวของน้ำ :<u> {{$data[0]->blk_surface}}  </u></h5></td>
                                                            <td><h5>วัสดุที่ใช้ดาดผิวของน้ำ :<u> {{$data[0]->blk_surface_detail}} </u></h5></td>
                                                        </tr>
                                            </table>
                                            <br>
                                            <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="2" class="text-center" style="background-color:#C0C0C0">หน้าตัดลำน้ำที่เกิดปัญหา</td>
                                                            <td class="text-center" style="background-color:#C0C0C0">กว้าง (เมตร)</td>
                                                            <td class="text-center" style="background-color:#C0C0C0">ลึก (เมตร)</td>
                                                            <td class="text-center" style="background-color:#C0C0C0">ความชันตลิ่ง</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <tr>
                                                                <td colspan="2">หน้าตัดลำน้ำเดิมในอดีตก่อนเกิดปัญหา</td>
                                                                <td class="text-center">{{ $pastData->width}}</td>
                                                                <td class="text-center">{{ $pastData->depth }}</td>
                                                                <td class="text-center">{{ $pastData->slop }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">หน้าตัดลำน้ำก่อนถึงที่เกิดปัญหา</td>
                                                                <td class="text-center">{{ $current_start->width }}</td>
                                                                <td class="text-center">{{ $current_start->depth }}</td>
                                                                <td class="text-center">{{ $current_start->slop }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5">หน้าตัดที่แคบที่สุดของช่วงที่เกิดปัญหา</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"> &nbsp;&nbsp;&nbsp;- ทางน้ำเปิด</td>
                                                                <td class="text-center">{{ $current_narrow->width }}</td>
                                                                <td class="text-center">{{ $current_narrow->depth }}</td>
                                                                <td class="text-center">{{ $current_narrow->slop }}</td>
                                                            </tr>

                                                            <?php if($current_narrow->type=="culvert"){
                                                                if($current_narrow->culvert->diameter!=NULL){?>
                                                                <tr>
                                                                    <td rowspan="2"> &nbsp;&nbsp;&nbsp;- กรณีท่อลอด</td>
                                                                    <td>ท่อกลม</td>
                                                                    <td colspan="2" >เส้นผ่านศูนย์กลาง&#9;&#9;{{$current_narrow->culvert->diameter}}  (เมตร)</td>
                                                                    <td class="text-center"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ท่อเหลี่ยม</td>
                                                                    <td class="text-center">{{$current_narrow->dwidth}}</td>
                                                                    <td class="text-center">{{ $current_narrow->dhigh}}</td>
                                                                    <td class="text-center"></td>
                                                                </tr>
                                                                <?php }else{?>
                                                                    <tr>
                                                                        <td rowspan="2"> &nbsp;&nbsp;&nbsp;- กรณีท่อลอด</td>
                                                                        <td>ท่อกลม</td>
                                                                        <td colspan="2" >เส้นผ่านศูนย์กลาง&#9;&#9;{{$current_narrow->diameter}}  (เมตร)</td>
                                                                        <td class="text-center"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ท่อเหลี่ยม</td>
                                                                        <td class="text-center">{{$current_narrow->culvert->width}}</td>
                                                                        <td class="text-center">{{ $current_narrow->culvert->high}}</td>
                                                                        <td class="text-center"></td>
                                                                    </tr>

                                                            <?php }
                                                            }else{?>
                                                                    <tr>
                                                                        <td rowspan="2"> &nbsp;&nbsp;&nbsp;- กรณีท่อลอด</td>
                                                                        <td>ท่อกลม</td>
                                                                        <td colspan="2" >เส้นผ่านศูนย์กลาง&#9;&#9;{{$current_narrow->diameter}}  (เมตร)</td>
                                                                        <td class="text-center"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ท่อเหลี่ยม</td>
                                                                        <td class="text-center">{{$current_narrow->dwidth}}</td>
                                                                        <td class="text-center">{{ $current_narrow->dhigh}}</td>
                                                                        <td class="text-center"></td>
                                                                    </tr> 
                                                            <?php }?>

                                                            <tr>
                                                                    <td colspan="2"> &nbsp;&nbsp;&nbsp;- อื่น ๆ</td>
                                                                    <td colspan="3" class="text-center">{{ $current_narrow->other  }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">หน้าตัดลำน้ำด้านท้ายน้ำหลังช่วงที่เกิดปัญหา</td>
                                                                <td class="text-center">{{ $current_end->width }}</td>
                                                                <td class="text-center">{{ $current_end->depth }}</td>
                                                                <td class="text-center">{{ $current_end->slope }}</td>
                                                            </tr>
                                                        </tbody>
                                                    
                                            </table>

                                            <br>
                                        <div style="overflow-x:auto;">            
                                            <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="2" class="text-center" style="background-color:#C0C0C0">ลักษณะของความเสียหาย                                                                </td>
                                                            <td class="text-center" style="background-color:#C0C0C0">น้อย</td>
                                                            <td class="text-center" style="background-color:#C0C0C0">ปานกลาง</td>
                                                            <td class="text-center" style="background-color:#C0C0C0">มาก</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            
                                                            <tr>
                                                                <td colspan="2">- น้ำท่วม</td>
                                                                <?php 
                                                                    if($damageData->flood=="low"){ 
                                                                        $num1="/";
                                                                        $num2="";
                                                                        $num3="";
                                                                    }else if($damageData->flood=="medium"){
                                                                        $num1="";
                                                                        $num2="/";
                                                                        $num3="";
                                                                    }else if($damageData->flood=="high"){
                                                                        $num1="";
                                                                        $num2="";
                                                                        $num3="/";
                                                                    }else{
                                                                        $num1="";
                                                                        $num2="";
                                                                        $num3="";
                                                                    }
                                                                ?>
                                                                    <td class="text-center"><?php echo $num1 ?></td>
                                                                    <td class="text-center"><?php echo $num2 ?></td>
                                                                    <td class="text-center"><?php echo $num3 ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">- น้ำเสีย</td>
                                                                <?php 
                                                                    if($damageData->waste=="low"){ 
                                                                        $num1="/";
                                                                        $num2="";
                                                                        $num3="";
                                                                    }else if($damageData->waste=="medium"){
                                                                        $num1="";
                                                                        $num2="/";
                                                                        $num3="";
                                                                    }else if($damageData->waste=="high"){
                                                                        $num1="";
                                                                        $num2="";
                                                                        $num3="/";
                                                                    }else{
                                                                        $num1="";
                                                                        $num2="";
                                                                        $num3="";
                                                                    }
                                                                ?>
                                                                    <td class="text-center"><?php echo $num1 ?></td>
                                                                    <td class="text-center"><?php echo $num2 ?></td>
                                                                    <td class="text-center"><?php echo $num3 ?></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                    <?php if( $damageData->other->detail=="NULL"){
                                                                        $test="";
                                                                    } else{
                                                                        $test=$damageData->other->detail;
                                                                    }?>
                                                                    <td colspan="2">- อื่นๆ  <u> {{$test}} </u></td>
                                                                   
                                                                    {{-- <td> <input type="text" value="{{ $damageData->other->detail}}" size="3"> </td> --}}
                                                                    <?php 
                                                                    if($damageData->other->level=="low"){ 
                                                                        $num1="/";
                                                                        $num2="";
                                                                        $num3="";
                                                                    }else if($damageData->other->level=="medium"){
                                                                        $num1="";
                                                                        $num2="/";
                                                                        $num3="";
                                                                    }else if($damageData->other->level=="high"){
                                                                        $num1="";
                                                                        $num2="";
                                                                        $num3="/";
                                                                    }else{
                                                                        $num1="";
                                                                        $num2="";
                                                                        $num3="";
                                                                    }
                                                                ?>
                                                                <td class="text-center"><?php echo $num1 ?></td>
                                                                <td class="text-center"><?php echo $num2 ?></td>
                                                                <td class="text-center"><?php echo $num3 ?></td>
                                                            </tr>
                                                            <tr>
                                                               <td colspan="2">ความถี่ที่เกิดความเสียหาย :</td>
                                                               <td colspan="3"> {{$data[0]->damage_frequency}} </td> 
                                                            </tr>
                                                    </tbody>
                                                   
                                            </table>
                                        </div>
                                            <br>
                        
                                            <?php 
                                                    function checkCuase($text) {
                                                        if($text!=NULL){
                                                            return "/";
                                                        }else{
                                                            return ' ';
                                                        }
                                                    }
                                            ?>
                                    <div style="overflow-x:auto;">
                                            <table class="table table-bordered text-center" align="center" style="color:#000" >
                                                <tr>
                                                        <td colspan="6" class="text-left" style="background-color:#C0C0C0">สาเหตุของการกีดขวางลำน้ำ</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="left"> <b>1.ธรรมชาติ </b></td>
                                                </tr>
                                                <tr style="background-color:#C0C0C0">
                                                    <td width="15px">ตลิ่งพัง <br>การกัดเซาะ</td>
                                                    <td width="10px">การทับถมของตะกอน<br> (ลำน้ำตื้นเขิน)</td>
                                                    <td width="15px">ลำน้ำขาดหาย</td>
                                                    <td width="10px">ลักษณะทางกายภาพ<br>ของล้ำน้ำ</td>
                                                    <td width="15px">วัชพืช</td>
                                                    <td width="10px">อื่นๆ</td>
                                                </tr>
                                                <tr>
                                                        <td >{{checkCuase($problem[0]->nat_erosion)}} </td>
                                                        <td>{{checkCuase($problem[0]->nat_shoal)}}</td>
                                                        <td>{{checkCuase($problem[0]->nat_missing)}}</td>
                                                        <td>{{checkCuase($problem[0]->nat_winding)}}</td>
                                                        <td>{{checkCuase($problem[0]->nat_weed_detail)}}</td>
                                                        <td>{{checkCuase($problem[0]->nat_other_detail)}}</td>
                                                        {{--  --}}
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="left"> <b>2. มนุษย์ </b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="left">  2.1.สิ่งปลูกสร้าง </td>
                                                </tr>
                                                <tr style="background-color:#C0C0C0">
                                                    <td colspan="3">สิ่งปลูกสร้าง</td>
                                                    <td>ส่วนของอาคาร <br>(หลัง)</td>
                                                    <td>รั้ว <br>(หลัง)</td>
                                                    <td>อื่นๆ </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="left">&nbsp; &nbsp;- เป็นส่วนราชการ {{$problem[0]->hum_str_owner_type}}</td>
                                                    <td>{{$problem[0]->hum_stc_bld_num}}</td>
                                                    <td>{{$problem[0]->hum_stc_fence_num}}</td>
                                                    <td>{{$problem[0]->hum_str_other}}</td>
                                                </tr>
                                                <tr>
                                                        <td colspan="3" align="left">&nbsp; &nbsp;- เป็นสวนของเอกชนหรือส่วนบุคคล {{$problem[0]->hum_str_owner_type}}</td>
                                                        <td>{{$problem[0]->hum_stc_bld_bu_num}}</td>
                                                        <td>{{$problem[0]->hum_stc_fence_bu_num}}</td>
                                                        <td>{{$problem[0]->hum_str_other_bu}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="left">  2.2. ระบบสาธารณูปโภค (ถนน ท่อลอด สะพานและอื่นๆ) </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="left" > &nbsp; &nbsp;- ถนนขวางทางน้ำ</td>
                                                    <td colspan="3" align="center">{{checkCuase($problem[0]->hum_road)}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="left">&nbsp; &nbsp;- ท่อลอดถนนที่ตัดลำน้ำมีขนาดเล็กเกินไประบายน้ำหลากไม่ทัน</td>
                                                    <td colspan="3" align="center">{{checkCuase($problem[0]->hum_smallconvert)}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="left">&nbsp; &nbsp;- ถนนขนานลำน้ำสร้างกินพื้นที่ลำน้ำ</td>
                                                    <td colspan="3" align="center">{{checkCuase($problem[0]->hum_road_paralel)}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="left">&nbsp; &nbsp;- วางท่อตามแนวลำน้ำทดแทนลำน้ำเดิม</td>
                                                    <td colspan="3" align="center">{{checkCuase($problem[0]->hum_replaced_convert)}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="left">&nbsp; &nbsp;- สะพานมีหน้าตัดแคบเกินไป หรือมีต่อม่อมากเกินไปในช่วงฤดูน้ำหลากระบายไม่ทัน</td>
                                                    <td colspan="3" align="center">{{checkCuase($problem[0]->hum_bridge_pile)}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="left">  2.3. การถมดิน </td>
                                                    <td colspan="3">{{checkCuase($problem[0]->hum_soil_cover)}}</td>
                                                </tr>
                                                <tr>
                                                        <td colspan="3" align="left">  2.4. สิ่งปฏิกูล </td>
                                                        <td colspan="3">{{checkCuase($problem[0]->hum_trash)}}</td>
                                                </tr>
                                                <tr>
                                                        <td colspan="3" align="left">  2.5. อื่นๆ </td>
                                                        <td colspan="3">{{$problem[0]->hum_other_detail}}</td>
                                                </tr>
                                                <tr>
                                                        <td colspan="3" align="left">ระดับการกีดขว้าง</td>
                                                        <td colspan="3" align="left">{{$problem[0]->prob_level}} </td> 
                                                </tr>

                                            </table>
                                    </div>
                                            <br>
                                            <table class="table-name">
                                                <thead>
                                                    <tr>
                                                        
                                                    <td><h5>หน่วยงานการดำเนินการแก้ไข : <u>{{$data[0]->Solution->responsed_dept}}</u></h5></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><h5>โดยวิธี : <u>{{$data[0]->Solution->sol_how}}</u></h5></td>
                                                        <td colspan="2"><h5>ผลการดำเนินการ : <u>{{$data[0]->Solution->result}}</u></h5></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h5>สภาพในปัจจุบันของโครงการที่แก้ไขปัญหา :</h5></td>
                                                        <?php if($project_id[0]->proj_status=="plan"){
                                                                $text="อยู่ในแผน โครงการ:".$project_id[0]->proj_name." ปี ".$project_id[0]->proj_year." งบประมาณ".$project_id[0]->proj_budget. "บาท"; 
                                                            }else if ($project_id[0]->proj_status=="received"){
                                                                $text="ได้รับงบประมาณแล้ว  ปี".$project_id[0]->proj_year ." งบประมาณ ".$project_id[0]->proj_budget ." บาท";
                                                            }else if($project_id[0]->proj_status=="making"){
                                                                $text="กำลังปรับปรุงก่อสร้าง";
                                                            }else{
                                                                $text="ยังไม่มีในแผน";

                                                            }?>
                                                        <td><h5> <u><?php echo $text; ?></u></h5></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            
                                            
                                            <?php if(!empty($photo_Blockage[0]->thumbnail_name)){?>
                                                <table class="table table-bordered">                                                                                              
                                                        <thead>
                                                            <tr>
                                                                <td colspan="3" style="background-color:#C0C0C0">รูปภาพประกอบ</td>
                                                            </tr>
                                                        </thead>
                                                    <table class="table_bg" width=100% border="1" >
                                                            <tbody>
                                                                <tr >
                                                                        <td style="padding:10px;"><li>สิ่งปลูกสร้างที่กีดขวาง</li> <br><center><img src="/{{$photo_Blockage[0]->thumbnail_name}}" width="80%"></center><br><br></td>
                                                                        <td><li>ที่ดิน : {{$photo_Land[0]->photo_detail}} </li><br><center><img src="/{{$photo_Land[0]->thumbnail_name}}" width="80%" ></center><br><br></td>  
                                                                            
                                                                </tr>
                                                                <tr>
                                                                        <td><li>รูปสเก็ตสภาพตำแหน่งที่เกิดปัญหาของลำน้ำ</li><br><center><img src="/{{$photo_Probsketch[0]->thumbnail_name}}" width="80%"/></center><br><br></td>
                                                                        <td><li>รูปแม่น้ำ คู คลอง ก่อนการรุกล้ำ</li><br><center><img src="/{{$photo_Riverbefore[0]->thumbnail_name}}" width="80%"/></center><br><br></td>
                                                                </tr>
                                                                <tr>
                                                                       
                                                                        <td><li>รูปแม่น้ำ คู คลอง ระหว่างการรุกล้ำ</li><br><center><img src="/{{$photo_Riverprob[0]->thumbnail_name}}" width="80%"/></center><br><br></td>
                                                                        <td><li>รูปแม่น้ำ คู คลอง หลังการรุกล้ำ</li><br><center><img src="/{{$photo_Riverafter[0]->thumbnail_name}}" width="80%"/></center><br><br></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                </table>
                                            <?php }else{?>
                                                <table class="table table-bordered">                                                                                              
                                                    <thead>
                                                        <tr>
                                                                <td colspan="3" style="background-color:#C0C0C0">รูปภาพประกอบ >>>> <u>ยังไม่ได้เพิ่มรูปประกอบ </u></td>
                                                        </tr>
                                                    </thead>
                                                 </table>

                                            <?php }?>

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
