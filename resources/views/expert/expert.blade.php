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
    <!-- leaflet -->
    <link rel="stylesheet" href="https://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" type="text/css">

        
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
                            <h2 class="pageheader-title">ข้อมูลสภาพปัญหาและแนวทางการแก้ไขปัญหาเบื้องต้นของตำแหน่งสิ่งกีดขวาง จังหวัดเชียงราย</h2>
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
                                <h5 class="card-header">ข้อเสนอแนะและแนวทางการแก้ไขปัญหาโดยผู้เชี่ยวชาญ</h5>
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
                                                        <td data-label="รหัส">{{$data[$i]->blk_code}}</td>
                                                        <td align="left" data-label="ลำน้ำ">{{$data[$i]->river_name}}, {{$data[$i]->river_main}} </td>
                                                        <td align="left" data-label="หมู่บ้าน">{{$data[$i]->blk_village}} </td>
                                                        <td align="left" data-label="ตำบล">ต.{{$data[$i]->blk_tumbol}}</td>
                                                        <td data-label="อำเภอ">อ.{{$data[$i]->blk_district}}</td>
                                              
                                                        
                                                        <td data-label="">
                                                                {{-- <div class="btn-group ml-auto">
                                                                  
                                                                    <a href='{{ asset('/reportBlockage') }}/{{$data[$i]->blk_id}}' > <button class="btn btn-sm btn-outline-light"><i class="fas fa-eye"></i>  รายละเอียด</button> </a>
                                                               </div> --}}
                                                                <div class="btn-group ml-auto">
                                                                    <a href='{{ asset('expert/report/') }}/{{$data[$i]->blk_id}}' >  <button class="btn btn-sm btn-outline-light"><i class="fas fa-edit"></i> แก้ไขข้อมูล</button> </a>
                                                                    <a href='{{ asset('expert/photo/') }}/{{$data[$i]->blk_id}}' >  <button class="btn btn-sm btn-outline-light"><i class="fas fa-images"></i> เลือกรูปภาพ</button> </a>
                                                                    {{-- <a href='{{ asset('/reportBlockage') }}/{{$data[$i]->blk_id}}' > <button class="btn btn-sm btn-outline-light"><i class="fas fa-eye"></i> รายละเอียด</button> </a> --}}
                                                                    <a href='{{ asset('/report/pdf/') }}/{{$data[$i]->blk_id}}' >  <button class="btn btn-sm btn-outline-light"><i class="fas fa-eye"></i> รายงาน</button> </a>
                                                                    
                                                                </div>
                                                        </td>
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
