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
    <!-- leaflet -->
    <link rel="stylesheet" href="https://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" type="text/css">
    <style type="text/css">
        .textAlignVer{
            /* -webkit-transform: rotate(-90deg); 
            -moz-transform: rotate(-90deg); 
            transform: rotate(-90deg);  */
            -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
         margin-left: -10em;
         margin-right: -10em;
            
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
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">รายงานสรุปผลสภาพปัญหาการกีดขวางในแม่น้ำคูคลอง</h2>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="dashboard-short-list">
                    <div class="row">
                            <?php 
                            function checkCuase($text) {
                                if($text!=NULL){
                                    return "/";
                                }else{
                                    return '';
                                }
                            }
                        ?>
                            <!-- ============================================================== -->
                            <!-- basic table -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                        <br>
                                        <h5 style="padding-left:30px;"><a href="{{ asset('/result') }}">  รายงาน </a> &raquo; รายงานสรุปผล </h5>
                                    
                                      
                                    <div class="card-body" style="overflow-x:auto;">
                                            
                                        <table class="table_result" width="100%"  >
                                            <thead align="center">
                                                <tr>
                                                    <th scope="col" rowspan="4">#</th>
                                                    <th scope="col" rowspan="4">รหัส</th>
                                                    <th scope="col" rowspan="4">หมู่บ้าน</th>
                                                    <th scope="col" rowspan="4">ตำบล</th>
                                                    <th scope="col" rowspan="4">ชื่อลำน้ำ</th>
                                                    {{-- <th scope="col" colspan="2">พิกัดเริ่มต้น</th>
                                                    <th scope="col" colspan="2">พิกัดสิ้นสุด</th> --}}
                                                    <th scope="col" colspan="16">สภาพปัญหา</th>
                                                    <th scope="col" rowspan="2" colspan="2">ระดับการกีดขวาง</th>
                                                </tr>
                                                <tr>
                                                    {{-- <th scope="col" rowspan="3"> X</th>
                                                    <th scope="col" rowspan="3"> Y </th>
                                                    <th scope="col" rowspan="3"> X</th>
                                                    <th scope="col" rowspan="3"> Y</th> --}}
                                                    <th scope="col" colspan="6"> ธรรมชาติ</th>
                                                    <th scope="col" colspan="10" > มนุษย์</th>
                                                   
                                                </tr>
                                                <tr>
                                                    <th scope="col" rowspan="2" class="textAlignVer" width="4%"> ตลิ่งพัง</th>
                                                    <th scope="col" rowspan="2" class="textAlignVer" width="4%"> ลำน้ำตื้นเขิน</th>
                                                    <th scope="col" rowspan="2" class="textAlignVer" width="4%"> ลำน้ำขาดหาย </th>
                                                    <th scope="col" rowspan="2" class="textAlignVer" width="4%"> ลำน้ำคดเคี้ยว </th>
                                                    <th scope="col" rowspan="2" class="textAlignVer" width="4%"> วัชพืช </th>
                                                    <th scope="col" rowspan="2" class="textAlignVer" width="4%"> อื่นๆ </th>
                                                    <th scope="col" colspan="2" > สิ่งปลูกสร้าง</th>
                                                    <th scope="col" colspan="5" > ระบบสาธารณูปโภค</th>
                                                    <th scope="col" rowspan="2" class="textAlignVer" width="4%"> การถมดิน</th>
                                                    <th scope="col" rowspan="2" class="textAlignVer" width="4%"> สิ่งปฏิกูล</th>
                                                    <th scope="col" rowspan="2" class="textAlignVer" width="4%"> อื่นๆ</th>
                                                    <th scope="col" rowspan="2" class="textAlignVer"> ระดับ</th>
                                                    <th scope="col" rowspan="2" class="textAlignVer"> เปอร์เซ็นต์ (%)</th>
                                                </tr>
                                                <tr height="100px;">
                                                    <th scope="col" class="textAlignVer" width="4%"> ส่วนราชการ</th>
                                                    <th scope="col" class="textAlignVer" width="4%"> ส่วนเอกชน</th>
                                                    <th scope="col" class="textAlignVer" width="4%"> ถนนขวาง</th>
                                                    <th scope="col" class="textAlignVer" width="4%"> ท่อลอดเล็ก</th>
                                                    <th scope="col" class="textAlignVer" width="4%"> ถนนขนาน</th>
                                                    <th scope="col" class="textAlignVer" width="4%"> วางท่อแทน</th>
                                                    <th scope="col" class="textAlignVer" width="4%"> สะพาน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php for($i = 0;$i < count($data);$i++){?>
                                                        <tr align="center" >
                                                            <?php
                                                              $string=$data[$i]->blockageLocation->blk_village;
                                                              $vill=explode(' ', $string);
                                                              $vill=$vill[2];
                                                              if($problem[$i]->prob_level=="1-30%"){
                                                                $lev="น้อย";
                                                              }else if($problem[$i]->prob_level=="30-70%"){
                                                                $lev="ปานกลาง";
                                                              }else{
                                                                $lev="มาก";
                                                              }

                                                              if(empty($problem[$i]->hum_stc_bld_num)&&empty($problem[$i]->hum_stc_fence_num)&&empty($problem[$i]->hum_str_other)){
                                                                  $gov[$i]="";
                                                              }else{$gov[$i]="/";}

                                                              if(empty($problem[$i]->hum_stc_bld_bu_num)&&empty($problem[$i]->hum_stc_fence_bu_num)&&empty($problem[$i]->hum_str_other_bu)){
                                                                  $bu[$i]="";
                                                              }else{$bu[$i]="/";}

                                                            ?>
                                                             
                                                            <td scope="row">{{$i+1}}</td>
                                                            <td data-label="รหัส"><a href='{{ asset('/report_detail') }}/{{$data[$i]->blk_id}}' >{{$data[$i]->blk_code}}</a></td>
                                                            <td data-label="หมู่บ้าน">{{$vill}} </td>
                                                            <td data-label="ตำบล">{{$data[$i]->blockageLocation->blk_tumbol}} </td>
                                                            <td data-label="ลำน้ำ">{{$data[$i]->River->river_name}}</td>
                                                            {{-- <td data-label="X เริ่ม">{{ number_format($data[$i]->blockageLocation->blk_start_location->getLat(), 2, '.', '') }} </td>
                                                            <td data-label="Y เริ่ม">{{ number_format($data[$i]->blockageLocation->blk_start_location->getLng(), 2, '.', '') }} </td>
                                                            <td data-label="X สิ้นสุด">{{ number_format($data[$i]->blockageLocation->blk_end_location->getLat(), 2, '.', '') }} </td>
                                                            <td data-label="Y สิ้นสุด">{{ number_format($data[$i]->blockageLocation->blk_end_location->getLng(), 2, '.', '') }} </td>--}}
                                                            <td data-label="ตลิ่งพัง">{{checkCuase($problem[$i]->nat_erosion)}}</td> 
                                                            <td data-label="ลำน้ำตื้นเขิน">{{checkCuase($problem[$i]->nat_shoal)}}</td>
                                                            <td data-label="ลำน้ำขาดหาย">{{checkCuase($problem[$i]->nat_missing)}}</td>
                                                            <td data-label="ลำน้ำคดเคี้ยว">{{checkCuase($problem[$i]->nat_winding)}}</td>
                                                            <td data-label="วัชพืช">{{checkCuase($problem[$i]->nat_weed_detail)}}</td>
                                                            <td data-label="อื่นๆ">{{checkCuase($problem[$i]->nat_other)}}</td>
                                                            <td data-label="ส่วนราชการ">{{$gov[$i]}}</td>
                                                            <td data-label="ส่วนเอกชน">{{$bu[$i]}}</td>
                                                            <td data-label="ถนนขวาง">{{checkCuase($problem[$i]->hum_road)}}</td>
                                                            <td data-label="ท่อลอดเล็ก">{{checkCuase($problem[$i]->hum_smallconvert)}}</td>
                                                            <td data-label="ถนนขนาน">{{checkCuase($problem[$i]->hum_road_paralel)}}</td>
                                                            <td data-label="วางท่อแทน">{{checkCuase($problem[$i]->hum_replaced_convert)}}</td>
                                                            <td data-label="สะพาน">{{checkCuase($problem[$i]->hum_bridge_pile)}}</td>
                                                            <td data-label="การถมดิน">{{checkCuase($problem[$i]->hum_soil_cover)}}</td>
                                                            <td data-label="สิ่งปฏิกูล">{{checkCuase($problem[$i]->hum_trash)}}</td>
                                                            <td data-label="อื่นๆ">{{checkCuase($problem[$i]->hum_other_detail)}}</td>
                                                            <td data-label="ระดับ">{{$lev}}</td>
                                                            <td data-label="เปอร์เซ็นต์ (%)"> {{$problem[$i]->prob_level}} </td>

                                                                                           
                                                        </tr>
                                                    <?php }?>
                                                
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end basic table -->
                            <!-- ============================================================== -->
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



</body>
</html>
