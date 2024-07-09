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
    <style>
        #box {
            margin:10px 20px 0 20px;
        }
    </style>
        
</head>
<body>
    <div class="dashboard-main-wrapper">
        @include('includes.headmenu')
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
      
                <div class="container-fluid dashboard-content" style="margin-bottom:-40px;">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- icon fontawesome solid  -->
                            <!-- ============================================================== -->
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">โครงการแก้ปัญหาการกีดขวางทางน้ำในพื้นที่นำร่อง</h2>
                                </div>
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"> <a href="/">หน้าแรก </a> </li>
                                        <li class="breadcrumb-item"><a href="/project">โครงการนำร่อง</a> </li>
                                        <li class="breadcrumb-item"><a href="#!">โครงการที่ {{$id}} </a></li>
                                    </ul>
                                </div>      
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-sm-11">
                                        <div class="card">
                                            <div class="card-block">
                                                <div class="row" id="draggablePanelList">
                                                    <div class="col-lg-12 col-xl-9">
                                                        <div class="card-sub">
                                                           <img class="card-img-top img-fluid" src="{{ asset($cover) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-xl-3">
                                                        <div class="card card-figure">
                                                            <figure class="figure">
                                                                <img class="img-fluid" src="{{ asset($plan) }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"> <a href="{{ asset($plan_link)}}" target="_blank">เอกสารแบบก่อสร้าง </a> </h4>
                                                                    </figcaption>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  

                            </div>
                            <!-- ============================================================== -->
                            <!-- end icon fontawesome solid  -->
                            <!-- ============================================================== -->
                         
                        </div>
                    </div>
                    
                </div>
                @include('includes.foot')
      
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->

       
    </div>


</body>
</html>
