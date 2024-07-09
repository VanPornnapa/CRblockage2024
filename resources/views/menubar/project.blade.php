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
                                <br>
                                <div class="card-header">
                                    <div class="row justify-content-center">
                                    <br>
                                        <div class="col-sm-11">
                                            <div class="card" >
                                                    
                                                    <!--  -->
                                                    <div class="row" id="box">
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj1.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/1')}}">โครงการที่ 1 ปรับปรุงอาคารควบคุมน้ำคลองส่งน้ำของฝายห้วยปู </a> </h4>
                                                                        <p class="text-muted mb-0"> ตำบลป่าตึง อำเภอแม่จัน </p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj2.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/2')}}">โครงการที่ 2 ปรับปรุงอาคารควบคุมน้ำในสาขาลำห้วยแม่ไร่ </a> </h4>
                                                                        <p class="text-muted mb-0"> บ้านแม่ไร่ ตำบลแม่ไร่ อำเภอแม่จัน </p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj3.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/3')}}">โครงการที่ 3 ปรับปรุงระบบระบายน้ำในลำห้วยไคร้ </a> </h4>
                                                                        <p class="text-muted mb-0">ตำบลห้วยไคร้ อำเภอแม่สาย</p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj4.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/4')}}">โครงการที่ 4 ปรับปรุงระบบระบายน้ำของลำห้วยข้างทางหลวงชนบท </a> </h4>
                                                                        <p class="text-muted mb-0"> ชร.1042 บ้านจ้องเด่น ตำบลโป่งผา อำเภอแม่สาย </p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--  -->
                                                    <div class="row" id="box">
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj5.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/5')}}">โครงการที่ 5 ปรับปรุงระบบระบายน้ำด้านหน้าสำนักงาน </a> </h4>
                                                                        <p class="text-muted mb-0">เทศบาลตำบลเวียงพางคำ ตำบลเวียงพางคำ อำเภอแม่สาย </p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj6.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/6')}}">โครงการที่ 6 ปรับปรุงระบบระบายน้ำโรงเรียนอนุบาลแม่สาย</a> </h4>
                                                                        <p class="text-muted mb-0"> บ้านแม่สาย ตำบลเวียงพางคำ อำเภอแม่สาย </p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj7.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/7')}}">โครงการที่ 7 ปรับปรุงประตูระบายน้ำและฝายแม่น้ำคำ</a> </h4>
                                                                        <p class="text-muted mb-0"> ตำบลป่าสัก อำเภอเชียงแสน</p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj8.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/8')}}">โครงการที่ 8 ปรับปรุงระบบระบายน้ำในชุมชนบ้านแก่นเหนือ </a> </h4>
                                                                        <p class="text-muted mb-0"> ตำบลห้วยซ้อ อำเภอเชียงของ </p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--  -->
                                                    <div class="row" id="box">
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj9.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/9')}}">โครงการที่ 9 หน้ามัสยิดแม่ขะจาน ถนน ทล.108 </a> </h4>
                                                                        <p class="text-muted mb-0"> ตำบลแม่เจดีย์ใหม่ อำเภอเวียงป่าเป้า </p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj10.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/10')}}">โครงการที่ 10 ลำเหมืองคุ้มหลวง เทศบาลนครเชียงราย</a> </h4>
                                                                        <p class="text-muted mb-0">ตำบลรอบเวียง อำเภอเมืองเชียงราย </p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj11.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/11')}}">โครงการที่ 11 ห้วยหนองยาว</a> </h4>
                                                                        <p class="text-muted mb-0">ตำบลท่าสาย อำเภอเมืองเชียงราย </p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj12.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/12')}}">โครงการที่ 12 ถนนทางหลวงแผ่นดินหมายเลข 1020 </a> </h4>
                                                                        <p class="text-muted mb-0">ตำบลป่าตาล อำเภอขุนตาล </p>
                                                                    </figcaption>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--  -->
                                                    <div class="row" id="box">
                                                        <div class="col-lg-12 col-xl-3">
                                                            <div class="card card-figure">
                                                                <figure class="figure">
                                                                    <img class="img-fluid" src="{{ asset('images/project/cover/proj13.jpg') }}">
                                                                    <figcaption class="figure-caption">
                                                                        <h4 class="figure-title"><a href="{{ asset('/project/13')}}">โครงการที่ 13 วัดถ้ำผาจรุย</a> </h4>
                                                                        <p class="text-muted mb-0"> ตำบลป่าแงะ อำเภอป่าแดด </p>
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
