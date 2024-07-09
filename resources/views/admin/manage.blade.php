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
                            <h2 class="pageheader-title">การจัดการผู้ใช้งาน (User management)</h2>
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
                                
                                <div class="card-body">
                                    <?php
                                            date_default_timezone_set('Asia/Bangkok');
                                            //echo date_default_timezone_get();
                                            ?>
                                    <div class="card-header drag-handle">
                                        <div class="row justify-content-end">
                                                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12" align="right">
                                                        <a href="{{ asset('/admin/register') }}"> <button class="btn btn-outline-success btn-lg btn-block">
                                                        <i class="fas fa-plus-circle"></i>  เพิ่มผู้ใช้งาน</button></a>
                                                        
                                                </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first" width=90% align="center">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="10%;"></th>
                                                    <th scope="col" width="15%;">ผู้ใช้</th>
                                                    <th scope="col" width="15%;">email</th>
                                                    <th scope="col" width="15%;">สถานะ</th>
                                                    <th scope="col" width="15%;">วันที่สมัคร</th>
                                                    <th scope="col" ></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for($i = 0;$i < count($data);$i++){ 
                                                    if($data[$i]->status_work != "surveyor"){?>
                                                    <tr >
                                                        <td align="center"><img src="{{ asset('images/admin/user.gif') }}" width=80% ></a></td>   
                                                        <td>{{$data[$i]->name}}</td>  
                                                        <td>{{$data[$i]->email}}	</td>  
                                                        <td>{{$data[$i]->status_work}}</td>  
                                                        <td align="center">{{$data[$i]->created_at}}</td>       
                                                        <td align="center">
                                                            <div class="btn-group ml-auto">
                                                                    <!-- <a> <button class="btn btn-outline-primary"><i class="fas fa-eye"></i> รายละเอียด</button> </a> &nbsp; &nbsp; -->
                                                                    <a href='{{ asset('/admin/edit') }}/{{$data[$i]->id}}' ><button class="btn btn-outline-primary"> <i class="fas fa-edit"></i> แก้ไข</button> </a>&nbsp; &nbsp;
                                                                    <a><button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> ลบ </button> </a>&nbsp; &nbsp;
                                                                    
                                                            </div>
                                                        </td> 
                                                    </tr>
                                                <?php } }?>
                                                
                                               
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
