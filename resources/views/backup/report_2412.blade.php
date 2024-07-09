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
               
                <div class="dashboard-short-list">
                    
                        <div class="row">
                                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                                        <h4 ><a href="{{ asset('/blocker') }}">รายละเอียดแบบสำรวจ </a> &raquo; ผลการสำรวจการกีดขวางในแม่น้ำคูคลอง &raquo;  {{ $data[0]->blk_code }}</h4>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" align="right">
                                        <a href="{{ url('/') }}"><button class="btn btn-sm btn-outline-light " >
                                                <i class="fa fa-home"></i> หน้าแรก</button></a>
                                </div>
                                
                        </div>
                        <div class="row" >
                                <div class="col-xl-1 col-lg-1">
                                </div>
                                <!-- ============================================================== -->
                                <!-- basic table -->
                                <!-- ============================================================== -->
                                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12" > 
                                    <div class="card">
                                            <div class="title m-b-md">
                                                    <img src="{{ asset('images/logo/head_form.png') }}" width="100%">
                                            </div>
                                        <div align="right">
                                            <h4 class="card-header drag-handle"> รหัสตำแหน่งกีดขวางที่: {{ $data[0]->blk_code }} </h4>
                                        </div>
                                        <div class="card-body">
                                                <?php 
                                                   
                                                    $text= explode(" ",$data[0]->blockageLocation->blk_village);
                                                    $moo = $text[1];
                                                    $tambol=$text[2];
                                                    $code=str_split($data[0]->blk_code );
                                                    // $s_lat=str_split(number_format($data[0]->blockageLocation->blk_start_location->getLat(), 4, '.', ''));
                                                    // $s_lng=str_split(number_format($data[0]->blockageLocation->blk_start_location->getLng(), 4, '.', ''));
                                                    // $e_lat=str_split(number_format($data[0]->blockageLocation->blk_end_location->getLat(), 4, '.', ''));
                                                    // $e_lng=str_split(number_format($data[0]->blockageLocation->blk_end_location->getLng(), 4, '.', ''));
                                                    $s_lat=str_split($data[0]->blockageLocation->blk_start_utm->getLat());
                                                    $s_lng=str_split($data[0]->blockageLocation->blk_start_utm->getLng());
                                                    $e_lat=str_split($data[0]->blockageLocation->blk_end_utm->getLat());
                                                    $e_lng=str_split($data[0]->blockageLocation->blk_end_utm->getLng());
                                                ?>
                                                <table class="table-report" width="100%" align="center">
                                                    <tr>
                                                        <td> รหัสหมู่บ้าน 
                                                            <font class="box">0</font> 
                                                            <font class="box">0</font>
                                                            <font class="box">0</font>
                                                            <font class="box">0</font>
                                                            <font class="box">0</font>
                                                            <font class="box">{{$code[6]}}</font>
                                                            <font class="box">{{$code[7]}}</font>
                                                            <font class="box">{{$code[8]}}</font>
                                                        
                                                        </td>
                                                        <td> รหัสตำบล 
                                                            <font class="box">0</font>
                                                            <font class="box">0</font>
                                                            <font class="box">0</font>
                                                            <font class="box">{{$code[4]}}</font>
                                                            <font class="box">{{$code[5]}}</font>
                                                        </td>
                                                        <td> รหัสอำเภอ 
                                                            <font class="box">0</font>
                                                            <font class="box">0</font>
                                                            <font class="box">{{$code[2]}}</font>
                                                            <font class="box">{{$code[3]}}</font>
                                                        </td>
                                                        <td> รหัสจังหวัด <font class="box">5</font> <font class="box">7</font></td>
                                                    </tr>
                                                </table>

                                                <br>

                                                <table class="table-report1" width="90%" align="center" >
                                                    <tr>
                                                        <td colspan="5" class="line"> <font class="outline"> ผู้กรอกแบบสำรวจ &nbsp;&nbsp; </font> &nbsp; {{ $data[0]->blk_user_name}}</td>
                                                        <td align="right" class="line"> <font class="outline"> วัน/เดือน/ปี   </font> &nbsp; {{date_format($data[0]->created_at,"d/m/Y H:i") }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="line" >  <font class="outline"> ตำแหน่ง &nbsp;&nbsp; </font> &nbsp; ผู้ช่วยวิจัย</td>
                                                        <td colspan="2" class="line" align="right" ><font class="outline"> หน่วยงาน  </font> &nbsp; มหาวิทยาลัยเชียงใหม่</td>
                                                        <td colspan="2" class="line" align="right" ><font class="outline"> โทรศัพท์ </font> &nbsp; 085-9087632</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="line" > <font class="outline">  ตำแหน่งที่  &nbsp;&nbsp; </font> &nbsp;  {{$data[0]->blk_id}}</td>
                                                        <td colspan="3" align="center" class="line" > <font class="outline"> ชื่อลำน้ำ (ที่เกิดปัญหาการกีดขวางทางน้ำ) </font> &nbsp;  {{ $data[0]->river->river_name }}</td>
                                                        <td colspan="2" align="center"class="line" > <font class="outline">  เป็นสาขาของแม่น้ำ  </font> &nbsp; {{  $data[0]->river->river_main  }}</td>
                                                            
                                                    </tr>
                                                </table>

                 {{-- ข้อ1    --}}
                                             <br>
                                              <b>1. ลักษณะทั่วไป </b>
                                              <table class="table-report1" width="90%" align="center">
                                                  <tr>
                                                      <td class="line"> <font class="outline"> 1.1 ประเภทลำน้ำที่เกิดปัญหากีดขวางทางน้ำ</font> {{ $data[0]->river->river_type }} </td>
                                                  </tr>
                                            
                                                  <tr>
                                                       <td colspan="2"> 1.2 ที่ตั้งของช่วงลำน้ำที่เกิดปัญหา</td>
                                                  </tr>
                                              </table>

                                                <table class="table-report1" width="72%" align="center" style="margin-bottom: 10px;" >
                                                  <tr>  
                                                        <td class="line"> <font class="outline"> &nbsp;หมู่ที่ </font> &nbsp;{{ $moo }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                                          <font class="outline"> &nbsp;ชื่อหมู่บ้าน  </font > {{ $tambol }} 
                                                                          <font class="outline"> &nbsp;ตำบล  </font > &nbsp;  {{$data[0]->blockageLocation->blk_tumbol }} </td> 

                                                        <td class="line"> <font class="outline"> &nbsp;อำเภอ </font> &nbsp; {{  $data[0]->blockageLocation->blk_district  }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                                          <font class="outline"> &nbsp;จังหวัด  </font > &nbsp; เชียงราย </td> 
                                                    <tr>
                                                </table>

                                                <table class="table-report4" width="80%" align="center">
                                                    <tr >
                                                        <td >พิกัดเริ่มต้นของปัญหา </td>
                                                        <td >X (UTM)
                                                            <font class="box">{{$s_lat[0]}}</font>
                                                            <font class="box">{{$s_lat[1]}}</font>
                                                            <font class="box">{{$s_lat[2]}}</font>
                                                            <font class="box">{{$s_lat[3]}}</font>
                                                            <font class="box">{{$s_lat[4]}}</font>
                                                            <font class="box">{{$s_lat[5]}}</font>
                                                        </td>
                                                        {{-- <td >
                                                                <font class="box">5</font>
                                                                <font class="box">8</font>
                                                                <font class="box">8</font>
                                                                <font class="box">4</font>
                                                                <font class="box">0</font>
                                                                <font class="box">8</font>
                                                        </td> --}}
                                                        <td>Y (UTM)
                                                            <font class="box">{{$s_lng[0]}}</font>
                                                            <font class="box">{{$s_lng[1]}}</font>
                                                            <font class="box">{{$s_lng[2]}}</font>
                                                            <font class="box">{{$s_lng[3]}}</font>
                                                            <font class="box">{{$s_lng[4]}}</font>
                                                            <font class="box">{{$s_lng[5]}}</font>
                                                            <font class="box">{{$s_lng[6]}}</font>
                                                        </td>
                                                        {{-- <td >
                                                                <font class="box">2</font>
                                                                <font class="box">2</font>
                                                                <font class="box">2</font>
                                                                <font class="box">9</font>
                                                                <font class="box">5</font>
                                                                <font class="box">2</font>
                                                                <font class="box">2</font>
                                                        </td> --}}
                                                    </tr>
                                                    <tr height="5px;"></tr>
                                                    <tr>
                                                        <td >พิกัดสิ้นสุดของปัญหา  </td>
                                                         <td >X (UTM)
                                                            <font class="box">{{$e_lat[0]}}</font>
                                                            <font class="box">{{$e_lat[1]}}</font>
                                                            <font class="box">{{$e_lat[2]}}</font>
                                                            <font class="box">{{$e_lat[3]}}</font>
                                                            <font class="box">{{$e_lat[4]}}</font>
                                                            <font class="box">{{$e_lat[5]}}</font>
                                                        </td>
                                                        {{-- <td >
                                                                <font class="box">5</font>
                                                                <font class="box">8</font>
                                                                <font class="box">8</font>
                                                                <font class="box">4</font>
                                                                <font class="box">0</font>
                                                                <font class="box">8</font>
                                                        </td> --}}
                                                        <td>Y (UTM)
                                                            <font class="box">{{$e_lng[0]}}</font>
                                                            <font class="box">{{$e_lng[1]}}</font>
                                                            <font class="box">{{$e_lng[2]}}</font>
                                                            <font class="box">{{$e_lng[3]}}</font>
                                                            <font class="box">{{$e_lng[4]}}</font>
                                                            <font class="box">{{$e_lng[5]}}</font>
                                                            <font class="box">{{$e_lng[6]}}</font>
                                                        </td>
                                                        {{-- <td >
                                                                <font class="box">2</font>
                                                                <font class="box">2</font>
                                                                <font class="box">2</font>
                                                                <font class="box">9</font>
                                                                <font class="box">5</font>
                                                                <font class="box">2</font>
                                                                <font class="box">2</font>
                                                        </td> --}}
                                                    </tr>
                                              </table>

                                              <table class="table-report" width="90%" align="center">
                                                  <tr>
                                                      <td colspan="4">1.3 หน้าตัดของลำน้ำเดิมก่อนเกิดปัญหา (โดยประมาณ) </td>
                                                  </tr>
                                              </table>
                                              <table class="table-report2" width="80%" align="center">
                                                  <tr >
                                                      <td align="right" >กว้าง <font class="line">{{ $pastData->width}} &nbsp;</font> เมตร </td>
                                                      <td align="right">ลึก <font class="line">{{ $pastData->depth }} &nbsp;</font> เมตร</td>
                                                      <td align="right"> ความลาดชันของตลิ่ง <font class="line">{{ $pastData->slop }}&nbsp;</font>  เมตร</td>
                                                     
                                                    </tr>
                                              </table>

                                            <table class="table-report" width="90%" align="center">
                                                <tr>
                                                    <td colspan="4">1.4 หน้าตัดของลำน้ำในปัจจุบันที่เริ่มเกิดปัญหา</td>
                                                </tr>
                                            </table>

                                            <table class="table-report2" width="80%" align="center">
                                                <tr>
                                                        <td colspan="4">1.4.1 หน้าตัดของลำน้ำก่อนถึงช่วงที่เกิดปัญหา</td>
                                                </tr>
                                                <tr >
                                                    <td align="right">กว้าง <font class="line">{{ $current_start->width }} &nbsp;</font> เมตร </td>
                                                    <td align="right">ลึก <font class="line">{{ $current_start->depth }} &nbsp;</font> เมตร</td>
                                                    <td align="right"> ความลาดชันของตลิ่ง <font class="line">{{ $current_start->slop }}</font>&nbsp;  เมตร</td>
                                                </tr>
                                                <tr>
                                                        <td colspan="4">1.4.2 หน้าตัดของลำน้ำที่แคบสุดในช่วงของลำน้ำที่เกิดปัญหา</td>
                                                </tr>
                                            </table>

                                            <table class="table-report3" width="80%" align="center">
                                                
                                                        <tr >
                                                            <td ><font size="4"> {{checkCuase($current_narrow->width ) }} </font>&nbsp;ทางน้ำเปิด </td>
                                                            
                                                            <td align="left">&nbsp;&nbsp;&nbsp;กว้าง&nbsp;<font class="line">{{ $current_narrow->width }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font> เมตร 
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลึก&nbsp; <font class="line">{{ $current_narrow->depth }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font> เมตร</td>
                                                        </tr>
                                                        <?php if($current_narrow->type=="culvert"){
                                                            if(isset($current_narrow->culvert->diameter)){?>
                                                                <tr >
                                                                    <td ><font size="4"> &#9745; </font>&nbsp;ท่อกลม </td>
                                                                    <td align="left">&nbsp;&nbsp;&nbsp;เส้นผ่านศูนย์กลาง&nbsp;<font class="line">{{$current_narrow->culvert->diameter}} &nbsp;&nbsp;</font> เมตร 
                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;จำนวนท่อ &nbsp;<font class="line">{{ $current_narrow->num}} &nbsp;&nbsp;&nbsp;&nbsp;</font> ช่อง
                                                                    </td>
                                                                </tr>
                                                                <tr >
                                                                    <td ><font size="4"> &#9744; </font>&nbsp; ท่อเหลี่ยม </td>
                                                                    <td align="left">&nbsp;&nbsp;&nbsp; กว้าง&nbsp; <font class="line">{{$current_narrow->dwidth}}&nbsp;&nbsp;</font> เมตร 
                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;สูง&nbsp; <font class="line">{{ $current_narrow->dhigh}} &nbsp;&nbsp;</font> เมตร
                                                                                    &nbsp;&nbsp;&nbsp; จำนวนท่อ&nbsp; <font class="line">{{ $current_narrow->num}}&nbsp;&nbsp;;</font>  ช่อง</td>
                                                                </tr>
                                                           
                                                            <?php }else{?>
                                                                <tr >
                                                                    <td ><font size="4"> &#9744; </font>&nbsp; ท่อกลม </td>
                                                                    <td align="left">&nbsp;&nbsp;&nbsp;เส้นผ่านศูนย์กลาง&nbsp;<font class="line">{{$current_narrow->diameter}} &nbsp;&nbsp;</font> เมตร 
                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนท่อ &nbsp;<font class="line"> &nbsp;&nbsp;&nbsp;&nbsp;</font> ช่อง</td>
                                                                </tr>
                                                                <tr >
                                                                    <td ><font size="4"> &#9745; </font>&nbsp; ท่อเหลี่ยม </td>
                                                                    <td align="left">&nbsp;&nbsp;&nbsp;กว้าง&nbsp; <font class="line">{{$current_narrow->width}}&nbsp;&nbsp;</font> เมตร 
                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;สูง&nbsp; <font class="line">{{ $current_narrow->depth}} &nbsp;&nbsp;</font> เมตร
                                                                                    &nbsp;&nbsp;&nbsp;จำนวนท่อ&nbsp; <font class="line">{{ $current_narrow->num}}&nbsp;&nbsp;</font>  ช่อง</td>
                                                                </tr>

                                                        <?php }
                                                        }else{?>
                                                                <tr >
                                                                    <td ><font size="4"> &#9744; </font>&nbsp; ท่อกลม </td>
                                                                    <td align="left">&nbsp;&nbsp;&nbsp;เส้นผ่านศูนย์กลาง&nbsp;<font class="line">{{$current_narrow->diameter}}&nbsp;&nbsp;</font> เมตร 
                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนท่อ &nbsp;<font class="line"> &nbsp;&nbsp;&nbsp;</font> ช่อง</td>
                                                                    
                                                                </tr>
                                                                <tr >
                                                                    <td ><font size="4"> &#9744; </font>&nbsp;ท่อเหลี่ยม </td>
                                                                    <td align="left">&nbsp;&nbsp;&nbsp;กว้าง&nbsp; <font class="line">{{$current_narrow->dwidth}}&nbsp;&nbsp;</font> เมตร 
                                                                                      &nbsp;&nbsp;&nbsp;&nbsp;สูง&nbsp; <font class="line">{{ $current_narrow->dhigh}} &nbsp;&nbsp;</font> เมตร
                                                                                      &nbsp;&nbsp;&nbsp;&nbsp;จำนวนท่อ&nbsp; <font class="line">{{ $current_narrow->num}}&nbsp;&nbsp;</font>  ช่อง</td>
                                                                </tr>
                                                        <?php }?>
                                                      
                                                        <?php if ($current_narrow->type=="other") {?>
                                                            <tr >
                                                                <td colspan="2" ><font size="4"> {{checkCuase($current_narrow->other ) }}</font>&nbsp;&nbsp; อื่นๆ (โปรดระบุ)  
                                                                    <font class="line" >{{ $current_narrow->other  }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font></td>
                                                            </tr>
                                                        <?php } else {?>
                                                            <tr >
                                                                <td colspan="2" ><font size="4"> </font>&nbsp;&nbsp; อื่นๆ (โปรดระบุ)  
                                                                <font class="line" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font></td>
                                                            </tr>
                                                        <?php }?>
                                                       
                                                  

                                            </table>
                                            <table class="table-report2" width="80%" align="center">
                                                <tr>
                                                        <td colspan="4">1.4.3 หน้าตัดของลำน้ำท้ายน้ำหลังที่เกิดปัญหา</td>
                                                </tr>
                                                <tr >
                                                    <td align="right">กว้าง <font class="line">{{ $current_end->width  }} &nbsp;</font> เมตร </td>
                                                    <td align="right">ลึก <font class="line">{{ $current_end->depth}} &nbsp;</font> เมตร</td>
                                                    <td align="right"> ความลาดชันของตลิ่ง <font class="line">{{ $current_end->slope }}&nbsp;</font>  เมตร</td>
                                                </tr>
                                            </table>
                                            <table class="table-report1" width="90%" align="center">
                                                <?php if($data[0]->blk_length_type=="น้อยกว่า 10 เมตร"){
                                                            $lenght=$data[0]->blk_length_type;
                                                        }else{
                                                            $lenght=$data[0]->blk_length;
                                                        }
                                                ?>
                                                    <tr>
                                                        <td colspan="2">1.5 ความยาวของช่วงลำน้ำที่เกิดปัญหา <font class="line">{{$lenght}} &nbsp;</font></td>
                                                    </tr>
                                                    <tr>
                                                        <td >1.6 การดาดผิวของลำน้ำ &nbsp;&nbsp;&nbsp;<font class="line"> {{$data[0]->blk_surface}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font> </td>
                                                           
                                                        <td> &nbsp;&nbsp;&nbsp;วัสดุที่ใช้ดาดผิวของลำน้ำ &nbsp;&nbsp;&nbsp;<font class="line"> {{$data[0]->blk_surface_detail}}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">1.7 ความลาดชันท้องน้ำช่วงที่เกิดปัญหา &nbsp;&nbsp;&nbsp;<font class="line"> {{$data[0]->blk_slope_bed}} &nbsp;&nbsp;</font></td>
                                                    </tr>
                                            </table>
                                         {{-- ข้อ2   --}}
                                         <br>
                                         <b>2. ความเสียหายที่เกิดขึ้น </b>
                                         <table class="table-report" width="90%" align="center">
                                             <tr>
                                                 <td>2.1 ลักษณะความเสียหาย</td>
                                             </tr>
                                         </table>
                                         <table class="table-report" width="80%" align="center">
                                             <?php 
                                                function checklevel($text) {
                                                    if($text=="low"){
                                                        $level="น้อย";
                                                    }else if( $text=="median"){
                                                            $level="ปานกลาง";
                                                    }else if( $text=="high") {
                                                            $level="มาก";
                                                    }else{
                                                        $level=NULL;
                                                    }
                                                    return $level;
                                                }
                                                function checkDamage($text) {
                                                    if($text!="0"){
                                                            echo  "<font size=\"4\"> &#9745; </font>";
                                                    }else{
                                                            echo "<font size=\"4\"> &#9744; </font>";
                                                    }
                                                }
                                                if($damageData->other->detail=="NULL"){
                                                    $damage="";
                                                }else{
                                                    $damage=$damageData->other->detail;
                                                }
                                             ?>
                                                <tr >
                                                    <td ><font size="4"> {{checkDamage($damage_type->flood) }} </font>&nbsp;&nbsp; น้ำท่วม 
                                                    &nbsp;&nbsp;&nbsp;&nbsp;ระดับความรุนแรง&nbsp;<font class="line">{{checklevel($damageData->flood)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>  </td>
                                               </tr>
                                               <tr >
                                                    <td ><font size="4">{{checkDamage($damageData->waste) }}  </font>&nbsp;&nbsp; น้ำเสีย
                                                        &nbsp;&nbsp;&nbsp;&nbsp;ระดับความรุนแรง&nbsp;<font class="line">&nbsp; {{checklevel($damageData->waste)}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
                                               </tr>
                                               <tr >
                                                    <td ><font size="4"> {{checkDamage($damageData->other->level) }}  </font>&nbsp;&nbsp; อื่นๆ 
                                                        <font class="line">&nbsp;{{$damage}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font> 
                                                        ระดับความรุนแรง&nbsp;<font class="line">&nbsp;{{checklevel($damageData->other->level)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font></td>
                                               </tr>
                                         </table>
                                         <table class="table-report1" width="90%" align="center">
                                            <tr>
                                                <td>2.2 ความถี่ที่เกิดความเสียหาย <font class="line">{{$data[0]->damage_frequency}}&nbsp;&nbsp;&nbsp; </font></td>
                                            </tr>
                                        </table>

                                        {{-- ข้อ3   --}}
                                        <?php 
                                                    function checkCuase($text) {
                                                        if($text!=NULL){
                                                            echo  "<font size=\"4\"> &#9745; </font>";
                                                        }else{
                                                            echo "<font size=\"4\"> &#9744; </font>";
                                                        }
                                                    }
                                        ?>

                                        <br>
                                        <b>3. สภาพปัญหา </b>
                                        <table class="table-report1" width="90%" align="center">
                                            <tr>
                                                <td>3.1 สาเหตุการกีดขวางลำน้ำ โดย</td>
                                            </tr>
                                        </table>
                                        <?php 
                                            if ($problem[0]->nat_erosion!=NULL||$problem[0]->nat_shoal!=NULL||$problem[0]->nat_missing!=NULL||$problem[0]->nat_winding!=NULL||$problem[0]->nat_weed!=NULL||$problem[0]->nat_other!=NULL){
                                                $text="<font size=\"4\"> &#9745; </font>";
                                            }else{
                                                $text="<font size=\"4\"> &#9744; </font>";
                                            }
                                            if($problem[0]->hum_structure!=NULL||$problem[0]->hum_other!=NULL||$problem[0]->hum_trash!=NULL||$problem[0]->hum_soil_cover!=NULL){
                                                $hum="<font size=\"4\"> &#9745; </font>";
                                            }else{
                                                $hum="<font size=\"4\"> &#9744; </font>";
                                            }
                                            if($problem[0]->hum_stc_bld_num!=NULL||$problem[0]->hum_stc_fence_num!=NULL||$problem[0]->hum_str_other!=NULL){
                                                $hum_stc="<font size=\"4\"> &#9745; </font>";
                                            }else{
                                                $hum_stc="<font size=\"4\"> &#9744; </font>";
                                            }
                                            if($problem[0]->hum_stc_bld_bu_num!=NULL||$problem[0]->hum_stc_fence_bu_num!=NULL||$problem[0]->hum_str_other_bu!=NULL){
                                                $hum_stc_bu="<font size=\"4\"> &#9745; </font>";
                                            }else{
                                                $hum_stc_bu="<font size=\"4\"> &#9744; </font>";
                                            }
                                            if($problem[0]->hum_road!=NULL||$problem[0]->hum_smallconvert!=NULL||$problem[0]->hum_road_paralel!=NULL||$problem[0]->hum_replaced_convert!=NULL||$problem[0]->hum_bridge_pile!=NULL){
                                                $infa="<font size=\"4\"> &#9745; </font>";
                                            }else{
                                                $infa="<font size=\"4\"> &#9744; </font>";
                                            }
                                            if($problem[0]->prob_level=="1-30%"){
                                                $t="น้อย";
                                            }else if($problem[0]->prob_level=="30-70%"){
                                                $t="ปานกลาง";
                                            }else{
                                                $t="มาก";
                                            }
                                            if($solution_id[0]->sol_how=="ปรับปรุงแก้ไข"){
                                                $sol1="<font size=\"4\"> &#9745; </font>";
                                                $sol2="<font size=\"4\"> &#9744; </font>";
                                                $sol3="<font size=\"4\"> &#9744; </font>";
                                                $sol4="<font size=\"4\"> &#9744; </font>";
                                                $sol5="<font size=\"4\"> &#9744; </font>";
                                            }else if($solution_id[0]->sol_how=="เจรจาให้รื้อถอน"){
                                                $sol1="<font size=\"4\"> &#9744; </font>";
                                                $sol2="<font size=\"4\"> &#9745; </font>";
                                                $sol3="<font size=\"4\"> &#9744; </font>";
                                                $sol4="<font size=\"4\"> &#9744; </font>";
                                                $sol5="<font size=\"4\"> &#9744; </font>";
                                            }else if($solution_id[0]->sol_how=="ฟ้องร้อง"){
                                                $sol1="<font size=\"4\"> &#9744; </font>";
                                                $sol2="<font size=\"4\"> &#9744; </font>";
                                                $sol3="<font size=\"4\"> &#9745; </font>";
                                                $sol4="<font size=\"4\"> &#9744; </font>";
                                                $sol5="<font size=\"4\"> &#9744; </font>";
                                            }else if($solution_id[0]->sol_how=="รื้นถอน"){
                                                $sol1="<font size=\"4\"> &#9744; </font>";
                                                $sol2="<font size=\"4\"> &#9744; </font>";
                                                $sol3="<font size=\"4\"> &#9744; </font>";
                                                $sol4="<font size=\"4\"> &#9745; </font>";
                                                $sol5="<font size=\"4\"> &#9744; </font>";
                                            }else {
                                                $sol1="<font size=\"4\"> &#9744; </font>";
                                                $sol2="<font size=\"4\"> &#9744; </font>";
                                                $sol3="<font size=\"4\"> &#9744; </font>";
                                                $sol4="<font size=\"4\"> &#9744; </font>";
                                                $sol5="<font size=\"4\"> &#9745; </font>";
                                            }
                                            if($project_id[0]->proj_status=="plan"){
                                                $proj1="<font size=\"4\"> &#9745; </font>";
                                                $proj2="<font size=\"4\"> &#9744; </font>";
                                                $proj3="<font size=\"4\"> &#9744; </font>";
                                                $proj4="<font size=\"4\"> &#9744; </font>";
                                                $budget_plan=$project_id[0]->proj_budget;
                                                $budget_received=NULL;
                                                $name_plan=$project_id[0]->proj_char;
                                                $name_received=NULL;


                                            }else if($project_id[0]->proj_status=="received"){
                                                $proj1="<font size=\"4\"> &#9744; </font>";
                                                $proj2="<font size=\"4\"> &#9745; </font>";
                                                $proj3="<font size=\"4\"> &#9744; </font>";
                                                $proj4="<font size=\"4\"> &#9744; </font>";
                                                $budget_plan=NULL;
                                                $budget_received=$project_id[0]->proj_budget;
                                                $name_plan=NULL;
                                                $name_received=$project_id[0]->proj_char;
                                                
                                            }else if($project_id[0]->proj_status=="making"){
                                                $proj1="<font size=\"4\"> &#9744; </font>";
                                                $proj2="<font size=\"4\"> &#9744; </font>";
                                                $proj3="<font size=\"4\"> &#9745; </font>";
                                                $proj4="<font size=\"4\"> &#9744; </font>";
                                                $budget_plan=NULL;
                                                $budget_received=NULL;
                                                $name_plan=NULL;
                                                $name_received=NULL;
                                            }else{
                                                $proj1="<font size=\"4\"> &#9744; </font>";
                                                $proj2="<font size=\"4\"> &#9744; </font>";
                                                $proj3="<font size=\"4\"> &#9744; </font>";
                                                $proj4="<font size=\"4\"> &#9745; </font>";
                                                $budget_plan=NULL;
                                                $budget_received=NULL;
                                                $name_plan=NULL;
                                                $name_received=NULL;
                                            }



                                        ?>
                                        <table class="table-report1" width="80%" align="center">
                                            <tr> 
                                                <td ><?php echo $text?> ธรรมชาติ </td>
                                            </tr>
                                        </table>
                                        <table class="table-report3" width="70%" align="center">
                                            <tr>
                                                <td>{{checkCuase($problem[0]->nat_erosion) }} ตลิ่งพังการกัดเซาะ </td>
                                                <td>{{checkCuase($problem[0]->nat_shoal)}} การทับถมของตะกอน (ลำน้ำตื้นเขิน)</td>
                                                <td>{{checkCuase($problem[0]->nat_missing)}} ลำน้ำขาดหาย</td>
                                            </tr>
                                            <tr>
                                                <td>{{checkCuase($problem[0]->nat_winding)}} ลำน้ำคดเคี้ยวมาก </td>
                                                <td>{{checkCuase($problem[0]->nat_weed)}} วัชพืช <font class="line">{{$problem[0]->nat_weed_detail}}&nbsp;&nbsp;&nbsp;</font></td>
                                                <td>{{checkCuase($problem[0]->nat_other)}}อื่นๆ <font class="line">{{$problem[0]->nat_other_detail}}&nbsp;&nbsp;&nbsp;</font></td>
                                            </tr>
                                        </table>
                                        <table class="table-report1" width="80%" align="center">
                                            <tr> 
                                                <td><?php echo $hum?> มนุษย์ </td>
                                            </tr>
                                        </table>
                                        <table class="table-report3" width="70%" align="center">
                                            <tr>
                                                <td colspan="2">{{checkCuase($problem[0]->hum_structure)}} สิ่งปลูกสร้าง </td>
                                            </tr>
                                        </table>
                                        <table class="table-report4" width="70%" align="center">
                                            <tr>
                                                <td width=20px;></td>
                                                <td><?php echo $hum_stc?> เป็นของส่วนราชการ</td>
                                                <td colspan="2">&nbsp;&nbsp; เป็นส่วนอาคาร <font class="line">{{$problem[0]->hum_stc_bld_num}} &nbsp;&nbsp;</font> หลัง&nbsp;&nbsp; 
                                                    รั้ว <font class="line">{{$problem[0]->hum_stc_fence_num}} &nbsp;&nbsp;</font> หลัง &nbsp;&nbsp; 
                                                    อื่นๆ <font class="line">{{$problem[0]->hum_str_other}} &nbsp;&nbsp;</font></td>
                                            </tr>
                                             <tr>
                                                <td width=20px;></td>
                                                <td><?php echo $hum_stc_bu?>เป็นของส่วนเอกชน หรือส่วนบุคคล</td>
                                                <td>&nbsp;&nbsp; เป็นส่วนอาคาร <font class="line">{{$problem[0]->hum_stc_bld_bu_num}} &nbsp;&nbsp;</font> หลัง &nbsp;&nbsp; 
                                                    รั้ว <font class="line">{{$problem[0]->hum_stc_fence_bu_num}} &nbsp;&nbsp;</font> หลัง &nbsp;&nbsp; 
                                                    อื่นๆ <font class="line">{{$problem[0]->hum_str_other_bu}} &nbsp;&nbsp;</font></td>
                                            </tr>
                                        </table>
                                        <table class="table-report3" width="70%" align="center">
                                            <tr>
                                                <td colspan="2"><?php echo $infa ?>ระบบสาธารณูปโภค (ถนน ท่อลอด สะพานและอื่นๆ) </td>
                                            </tr>
                                            <tr> 
                                                <td width=20px;></td>
                                                <td>{{checkCuase($problem[0]->hum_road)}}ถนนขวางทางน้ำ</td>
                                            </tr>
                                            <tr>
                                                <td width=20px;></td>
                                                <td>{{checkCuase($problem[0]->hum_smallconvert)}}ท่อลอดถนนที่ตัดลำน้ำมีขนาดเล็กเกินไประบายน้ำหลากไม่ทัน</td>
                                            </tr>
                                            <tr>
                                                <td width=20px;></td>
                                                <td>{{checkCuase($problem[0]->hum_road_paralel)}}ถนนขนานลำน้ำสร้างกินพื้นที่ลำน้ำ</td>
                                            </tr>
                                            <tr>
                                                <td width=20px;></td>
                                                <td>{{checkCuase($problem[0]->hum_replaced_convert)}}วางท่อตามแนวลำน้ำทดแทนลำน้ำเดิม</td>
                                            </tr>
                                            <tr>
                                                <td width=20px;></td>
                                                <td colspan="3">{{checkCuase($problem[0]->hum_bridge_pile)}}สะพานมีหน้าตัดแคบเกินไป หรือมีต่อม่อมากเกินไปในช่วงฤดูน้ำหลากระบายไม่ทัน</td>
                                            </tr>
                                            <tr>
                                                <table class="table-report1" width="70%" align="center">
                                                    <tr>
                                                        <td >{{checkCuase($problem[0]->hum_soil_cover)}}การถมดิน </td>
                                                    </tr>
                                                    <tr>
                                                        <td >{{checkCuase($problem[0]->hum_other)}}สิ่งปฏิกูล <font class="line">{{$problem[0]->hum_other_detail}} </font></td>
                                            
                                                    </tr>
                                                </table>
                                            </tr>
                                           
                                        </table>
                                        <table class="table-report1" width="90%" align="center">
                                            <tr>
                                                <td>3.2 ระดับการกีดขวาง (เปอร์เซ็นคิดโดยพื้นที่ที่ถูกกีดขวางต่อพื้นที่ลำน้ำเดิม  <font class="line">{{  $t." (".$problem[0]->prob_level}}) </font></td>
                                            </tr>
                                        </table>
                                        
                                        {{-- ข้อ 4  --}}
                                        <br>
                                        <b>4. การดำเนินการแก้ไขของหน่วยงานท้องถิ่น และหน่วยงานที่รับผิดชอบ </b> <font class="line"> {{$solution_id[0]->responsed_dept}} </font>
                                        <table class="table-report1" width="80%" align="center">
                                            <tr>
                                            <td colspan="4"><?php echo $sol1?>ปรับปรุงแก้ไขโดย <font class="line">  {{$solution_id[0]->sol_edit}} &nbsp;&nbsp;&nbsp;&nbsp;</font></td>
                                            </tr>
                                            <tr>
                                                <td> <?php echo $sol2?> เจรจาให้รื้อถอน</td>
                                                <td> <?php echo $sol3?> ฟ้องร้อง</td>
                                                <td> <?php echo $sol4?>รื้อถอน</td>
                                                <td> <?php echo $sol5?>ยังไม่ได้ดำเนินการ</td>
                                            </tr>
                                        </table>   

                                         <table class="table-report1" width="90%" align="center">
                                            <tr>
                                                <td colspan="4">4.1 ผลการดำเนินการ <font class="line"> {{$solution_id[0]->result}}</font></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">4.2 สภาพในปัจจุบันของโครงการที่แก้ไขปัญหา </td>
                                            </tr>
                                        </table>   

                                        <table class="table-report4" width="80%" align="center">
                                            <tr>
                                                <td width=20px;></td>
                                                <td><?php echo $proj1?>อยู่ในแผน <font class="line">&nbsp;&nbsp;{{$project_id[0]->proj_year}}&nbsp;&nbsp;&nbsp;&nbsp;</font> ปี</td>
                                                 <td>ลักษณะโครงการ <font class="line">&nbsp;&nbsp;{{$name_plan}}&nbsp;&nbsp;&nbsp;&nbsp;</font>
                                                    งบประมาณ <font class="line">&nbsp;&nbsp;{{$budget_plan}}&nbsp;&nbsp;&nbsp;&nbsp;</font> บาท
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width=20px;></td>
                                                <td><?php echo $proj2?>ได้รับงบประมาณแล้ว  <font class="line">&nbsp;&nbsp;{{$budget_received}}&nbsp;&nbsp;&nbsp;&nbsp;</font> บาท </td>
                                                    <td> ลักษณะโครงการ <font class="line">&nbsp;&nbsp;{{$name_received}}&nbsp;&nbsp;&nbsp;&nbsp;</font>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width=20px;></td> 
                                                <td><?php echo $proj3?>กำลังปรับปรุงหรือก่อสร้าง</td>
                                            </tr>
                                                <td width=20px;></td>
                                                <td><?php echo $proj4?>ยังไม่มีในแผน </td>
                                            </tr>
                                        </table> 

                                        {{-- ข้อ 5  --}}
                                        <br>
                                        <b>5. รูปประกอบ </b> 
                                        <table class="table-report3" width="90%" align="center" border="1px" style="border-collapse: collapse;" >
                                            
                                            <?php if(isset($photo_Blockage[0]->thumbnail_name)){
                                                           $num=count($photo_Blockage);
                                                           $n=$num/3;
                                                           $i=0;
                                                           for($k=0;$k<$n+1;$k++){
                                                               ?>
                                                               <tr >   
                                                                   <?php 
                                                                   for($i=$i;$i<2+(2*$k);$i++)
                                                                       {  if($i==$num){ ?>
                                                                           <td></td>
                                                                       <?php    break;
                                                                       }else{?>
                                                                       <td align="center"><br> <img src="{{ asset($photo_Blockage[$i]->thumbnail_name) }}"><br> <br></td>
                                                                   <?php  } } ?>
                                                               <br></tr>

                                                           <?php } 
                                                       }?>
                                                   
                                       </table>    
                                        {{-- <table class="table-report3" width="90%" align="center" border="1">
                                            <tr >
                                                <td colspan="3"> 5.1 สิ่งปลูกสร้างที่กีดขวาง <br>
                                                    <?php if(isset($photo_Blockage[0]->thumbnail_name)){?>
                                                        <center> 
                                                             <?php
                                                                for($i=0;$i<count($photo_Blockage);$i++)
                                                                { ?>
                                                                    <img src="{{ asset($photo_Blockage[$i]->thumbnail_name) }}" width="50%"> <br><br>
                                                            <?php    } ?>  
                                                        </center>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"> 5.2 ที่ดิน : 
                                                    <?php if(isset($photo_Land[0]->thumbnail_name)){?>
                                                        {{{$photo_Land[0]->photo_detail}}}<br> 
                                                        <center> 
                                                                <?php
                                                                   for($i=0;$i<count($photo_Land);$i++)
                                                                   { ?>
                                                                       <img src="{{ asset($photo_Land[$i]->thumbnail_name) }}" width="50%"> <br><br>
                                                               <?php    } ?>  
                                                        </center>
                                                        
                                                    <?php }?>
                                                </td>                                                
                                            </tr>
                                            <tr>
                                                <td colspan="3">5.3 รูปแม่น้ำ คู คลอง</td>
                                            </tr>
                                            <tr >
                                                <td> ก่อนการรุกล้ำ: <br> 
                                                    <?php if(isset($photo_Riverbefore[0]->thumbnail_name)){?>
                                                        <center> 
                                                                <?php
                                                                   for($i=0;$i<count($photo_Riverbefore);$i++)
                                                                   { ?>
                                                                       <img src="{{ asset($photo_Riverbefore[$i]->thumbnail_name) }}" width="50%"> <br><br>
                                                               <?php    } ?>  
                                                        </center>
                                                    <?php }?>
                                                </td>
                                                <td> ระหว่างการรุกล้ำ:<br> 
                                                    <?php if(isset($photo_Riverprob[0]->thumbnail_name)){?>
                                                        <center> 
                                                                <?php
                                                                   for($i=0;$i<count($photo_Riverprob);$i++)
                                                                   { ?>
                                                                       <img src="{{ asset($photo_Riverprob[$i]->thumbnail_name) }}" width="50%"> <br><br>
                                                               <?php    } ?>  
                                                        </center>
                                                    <?php }?>
                                                </td>   
                                                <td> หลังการรุกล้ำ:<br> 
                                                    <?php if(isset($photo_Riverafter[0]->thumbnail_name)){?>
                                                        <center> 
                                                                <?php
                                                                   for($i=0;$i<count($photo_Riverafter);$i++)
                                                                   { ?>
                                                                       <img src="{{ asset($photo_Riverafter[$i]->thumbnail_name) }}" width="50%"> <br><br>
                                                               <?php    } ?>  
                                                        </center>
                                                    <?php }?>
                                                </td>                                             
                                            </tr>
                                            <tr>
                                                <td colspan="3">5.4 รูปสเก็ตสภาพตำแหน่งที่เกิดปัญหาของลำน้ำ<br>
                                                    <?php if(isset($photo_Probsketch[0]->thumbnail_name)){?>
                                                        <center> 
                                                                <?php
                                                                   for($i=0;$i<count($photo_Probsketch);$i++)
                                                                   { ?>
                                                                       <img src="{{ asset($photo_Probsketch[$i]->thumbnail_name) }}" width="50%"> <br><br>
                                                               <?php    } ?>  
                                                        </center>
                                                    <?php }?>
                                            </tr>
                                    </table>    --}}



                                      
                                        {{-- <tr>
                                                <td><li>รูปสเก็ตสภาพตำแหน่งที่เกิดปัญหาของลำน้ำ</li><br><center><img src="/{{$photo_Probsketch[0]->thumbnail_name}}" width="80%"/></center><br><br></td>
                                                <td><li>รูปแม่น้ำ คู คลอง ก่อนการรุกล้ำ</li><br><center><img src="/{{$photo_Riverbefore[0]->thumbnail_name}}" width="80%"/></center><br><br></td>
                                        </tr>
                                        <tr>
                                               
                                                <td><li>รูปแม่น้ำ คู คลอง ระหว่างการรุกล้ำ</li><br><center><img src="/{{$photo_Riverprob[0]->thumbnail_name}}" width="80%"/></center><br><br></td>
                                                <td><li>รูปแม่น้ำ คู คลอง หลังการรุกล้ำ</li><br><center><img src="/{{$photo_Riverafter[0]->thumbnail_name}}" width="80%"/></center><br><br></td>
                                        </tr> --}}







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
