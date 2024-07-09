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
                            <h2 class="pageheader-title">ข้อมูลสำรวจรายละเอียดการกีดขวางทางน้ำ</h2>
                            <h5>สำรวจโดย {{ Auth::user()->name }}</h5>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="dashboard-short-list">
                    <div class="row">
                        
                            <!-- ============================================================== -->
                            <!-- basic table -->
                            <!-- ============================================================== -->
                            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                        <?php
                                        date_default_timezone_set('Asia/Bangkok');
                                        //echo date_default_timezone_get();
                                ?>
                                <div class="card-header drag-handle">
                                    <div class="row">
                                            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                                                <h5 > รายละเอียดแบบสำรวจ  </h5>
                                            </div>
                                            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12" align="right">
                                                    <a href="{{ asset('/newblockage') }}"> <button class="btn btn-sm btn-outline-light">
                                                    <i class="fas fa-plus-circle"></i>  เพิ่มข้อมูลการกีดขวางทางน้ำ</button></a>
                                                    
                                            </div>
                                            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 col-12" align="right">
                                                    <a href="{{ url('/') }}"><button class="btn btn-sm btn-outline-light " >
                                                    <i class="fa fa-home"></i> หน้าแรก</button></a>
                                            </div>
                                    </div>
                                </div>
                                                                  
                                      
                                    <div class="card-body" style="overflow-x:auto;">
                                        <table class="table_bg" width="100%" >
                                            <thead>
                                                <tr>
                                                    <th scope="col" >#</th>
                                                    <th scope="col" >id</th>
                                                    <th scope="col" >รหัส</th>
                                                    <th scope="col" >ชื่อลำน้ำ</th>
                                                    <th scope="col" >ประเภทลำน้ำ</th>
                                                    <th scope="col" >ลำน้ำ</th>
                                                    <th scope="col" >หมู่บ้าน</th>
                                                    <th scope="col" >ตำบล</th>
                                                    <th scope="col" >อำเภอ</th>
                                                    <th scope="col" >จังหวัด</th>
                                                    <th scope="col" >Latitude </th>
                                                    <th scope="col" >Longitude</th>
                                                    <th scope="col" >วันที่เก็บข้อมูล</th>
                                                    <th scope="col" >ผู้กรอก</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for($i = 0;$i < count($data);$i++){ 
                                                    date_default_timezone_set('asia/bangkok');
                                                    //dd(new DateTime());                                                    
                                                    $dateT=date_format($data[$i]->created_at,"d/m/Y H:i");
                                                    ?>
                                                    <tr >
                                                        <th scope="row" data-label="ลำดับ">{{$i+1}}</th>
                                                        <td data-label="รหัส">{{$data[$i]->blk_id}}</td>
                                                        <td data-label="รหัส">{{$data[$i]->blk_code}}</td>
                                                        <td data-label="ลำน้ำ">{{$data[$i]->River->river_name}} </td>
                                                        <td data-label="ลำน้ำ"> {{$data[$i]->River->river_type}} </td>
                                                        <td data-label="ลำน้ำ"> {{$data[$i]->River->river_main}} </td>
                                                        <td data-label="ที่ตั้ง">{{$data[$i]->blockageLocation->blk_village}} </td>
                                                        <td>{{$data[$i]->blockageLocation->blk_tumbol}} </td>
                                                        <td>{{$data[$i]->blockageLocation->blk_district}}</td>
                                                        <td>เชียงราย</td>
                                                        <td>{{ $data[$i]->blockageLocation->blk_start_location->getLat()}}</td>
                                                        <td>{{ $data[$i]->blockageLocation->blk_start_location->getLng()}}</td>

                                                        <td data-label="วันที่เก็บข้อมูล">{{$dateT}}</td>
                                                        <td>{{$data[$i]->blk_user_name}}</td>
                                                                                    
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
