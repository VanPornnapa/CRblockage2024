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
    <!-- <link rel="stylesheet" href="{{ asset('css/myCss.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.css')}}">
    


        
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
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="dashboard-short-list">
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- basic table  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card" >
                                <h1 class="card-header"> </h1>
                                <div class="card-body" style="margin: 100px; 0">
                                    <center><h1 >ท่านไม่มีสิทธิ์ในการเข้าถึงข้อมูล </h1> </center>
                                
                                
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
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/js/data-table.js') }}"></script>



</body>
</html>
