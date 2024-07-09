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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.css')}}">
    


        
</head>
<body>
<div class="dashboard-main-wrapper">
        @include('includes.head')
        @include('includes.headeradmin')
        
        
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
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="dashboard-short-list">
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- basic table  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <?php if(Auth::user()->status_work == "admin"){ ?> 
                                    <h3 class="card-header">รายละเอียดแบบสำรวจ สำหรับผู้ดูแลระบบ : {{ Auth::user()->name }}</h3>
                                <?php } else{ ?>
                                    <h3 class="card-header">รายละเอียดแบบสำรวจที่ถูกสำรวจโดย {{ Auth::user()->name }} </h3>
                                <?php } ?>
                                <div class="card-body">
                                    <?php
                                            date_default_timezone_set('Asia/Bangkok');
                                            //echo date_default_timezone_get();
                                            ?>
                                    <div class="card-header drag-handle">
                                        <div class="row">
                                                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12" align="right">
                                                        <a href="{{ asset('/newblockage') }}"> <button class="btn btn-sm btn-outline-light">
                                                        <i class="fas fa-plus-circle"></i>  เพิ่มข้อมูลการกีดขวางทางน้ำ</button></a>
                                                        
                                                </div>
                                                <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 col-12" align="right">
                                                        <a href="{{ url('/') }}"><button class="btn btn-sm btn-outline-light " >
                                                        <i class="fa fa-home"></i> หน้าแรก</button></a>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first" width=90% align="center">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="5%;">#</th>
                                                    <th scope="col" width="10%;">รหัส</th>
                                                    <th scope="col" width="15%;">ลำน้ำ</th>
                                                    {{-- <th scope="col" width="15%;">ประเภทลำน้ำ</th> --}}
                                                    <th scope="col" width="25%;">ที่ตั้ง</th>
                                                    <th scope="col" width="15%;">วันที่เก็บข้อมูล</th>
                                                    <th scope="col" width="10%;"></th>
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
                                                        <td data-label="รหัส">{{$data[$i]->blk_code}}</td>
                                                        <td data-label="ลำน้ำ">{{$data[$i]->River->river_name}}, {{$data[$i]->River->river_main}} </td>
                                                        {{-- <td data-label="ประเภทลำน้ำ">{{$data[$i]->River->river_type}} </td> --}}
                                                        <td data-label="ที่ตั้ง">{{$data[$i]->blockageLocation->blk_village}} ต.{{$data[$i]->blockageLocation->blk_tumbol}} อ.{{$data[$i]->blockageLocation->blk_district}}</td>
                                                        <td data-label="วันที่เก็บข้อมูล">{{$dateT}}</td>
                                                        <td data-label="">
                                                                <div class="btn-group ml-auto">
                                                                    <a href='{{ asset('/reportBlockage') }}/{{$data[$i]->blk_id}}' > <button class="btn btn-sm btn-outline-light"><i class="fas fa-eye"></i> รายละเอียด</button> </a>
                                                                    <a href='{{ asset('/editblockage') }}/{{$data[$i]->blk_id}}' >  <button class="btn btn-sm btn-outline-light"><i class="fas fa-edit"></i> แก้ไข</button> </a>
                                                                    <a href='{{ asset('/form/questionnaire5') }}/{{$data[$i]->blk_id}}' >  <button class="btn btn-sm btn-outline-light"><i class="fas fa-images"></i> รูปถ่าย</button> </a>
                                                                    
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
                        <!-- ============================================================== -->
                        <!-- end basic table  -->
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

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
{{-- <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script> --}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/js/data-table.js') }}"></script>



</body>
</html>
