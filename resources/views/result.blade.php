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
                            <h2 class="pageheader-title">รายงานสรุปผลแบบสำรวจการกีดขวางทางน้ำในแม่น้ำคูคลอง และถนน จังหวัดเชียงราย</h2>
                         
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
     
                <div class="dashboard-short-list">
                    <div class="row">
                            
                            <!-- ============================================================== -->
                            <!-- basic table Chiang Rai-->
                            <!-- ============================================================== -->
                            
                            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">จังหวัดเชียงราย</h5>
                                    <h4 class="card-header drag-handle"> <a href='{{ asset('/report/map') }}' >&#9872; แผนที่แสดงจุดกีดขวางทางน้ำ จำแนกตามระดับความเสี่ยงจากการกีดขวางทางน้ำ </a> </h4>
                                    <h4 class="card-header drag-handle"> <a href='{{ asset('/report/chart/?amp=อำเภอทั้งหมด') }}' >&#9872; กราฟแสดงสัดส่วนสิ่งกีดขวางทางน้ำ </a> </h4>
                                    <h4 class="card-header drag-handle">
                                        <form id="amp" name="amp" action='{{ route('report/pdf') }}' method="get"> 
                                            <a href='#'> &#9872; รายงานสรุปผลสภาพปัญหาการกีดขวางในแม่น้ำคูคลอง  กรุณาเลือก
                                        
                                            <select name="amp" class="selectpicker " id="amp" > 
                                            <option value="0">-- อำเภอ --</option>
                                            <option value="sum">อำเภอทั้งหมด</option>
                                            <option value="เชียงของ">เชียงของ</option>
                                            <option value="เชียงแสน">เชียงแสน</option>
                                            <option value="เวียงแก่น">เวียงแก่น</option>
                                            <option value="เวียงชัย">เวียงชัย</option>
                                            <option value="เวียงเชียงรุ้ง">เวียงเชียงรุ้ง</option>
                                            <option value="แม่จัน">แม่จัน</option>
                                            <option value="แม่สาย">แม่สาย</option>
                                            <option value="แม่ฟ้าหลวง">แม่ฟ้าหลวง</option>
                                            <option value="ดอยหลวง">ดอยหลวง</option>
                                            <option value="เมืองเชียงราย">เมืองเชียงราย</option>
                                            <option value="ป่าแดด">ป่าแดด</option>
                                            <option value="แม่ลาว">แม่ลาว</option>
                                            <option value="แม่สรวย">แม่สรวย</option>
                                            <option value="เวียงป่าเปา">เวียงป่าเปา</option>
                                            <option value="พญาเม็งราย">พญาเม็งราย</option>
                                            <option value="เทิง">เทิง</option>
                                            <option value="พาน">พาน</option>
                                            <option value="ขุนตาล">ขุนตาล</option>
                                            </select> 
                                                
                                            <button type="submit" class="butsummit"> PDF </button> </a>
                                        </form> 
                                    </h4>


                                    <h4 class="card-header drag-handle">
                                        <form id="sol" name="amp" action='{{ route('report/solution') }}' method="get"> 
                                            <a href='#'> &#9872; ข้อมูลสภาพปัญหาและแนวทางการแก้ไขปัญหาเบื้องต้น  กรุณาเลือก
                                        
                                            <select name="amp" class="selectpicker " id="sol" > 
                                            <option value="0">-- อำเภอ --</option>
                                            <option value="sum">อำเภอทั้งหมด</option>
                                            <option value="เชียงของ">เชียงของ</option>
                                            <option value="เชียงแสน">เชียงแสน</option>
                                            <option value="เวียงแก่น">เวียงแก่น</option>
                                            <option value="เวียงชัย">เวียงชัย</option>
                                            <option value="เวียงเชียงรุ้ง">เวียงเชียงรุ้ง</option>
                                            <option value="แม่จัน">แม่จัน</option>
                                            <option value="แม่สาย">แม่สาย</option>
                                            <option value="แม่ฟ้าหลวง">แม่ฟ้าหลวง</option>
                                            <option value="ดอยหลวง">ดอยหลวง</option>
                                            <option value="เมืองเชียงราย">เมืองเชียงราย</option>
                                            <option value="ป่าแดด">ป่าแดด</option>
                                            <option value="แม่ลาว">แม่ลาว</option>
                                            <option value="แม่สรวย">แม่สรวย</option>
                                            <option value="เวียงป่าเปา">เวียงป่าเปา</option>
                                            <option value="พญาเม็งราย">พญาเม็งราย</option>
                                            <option value="เทิง">เทิง</option>
                                            <option value="พาน">พาน</option>
                                            <option value="ขุนตาล">ขุนตาล</option>
                                            </select> 
                                                
                                            <button type="submit" class="butsummit"> PDF </button> </a>
                                        </form> 
                                    </h4>

                                        
                                    </div>
                                </div>
                       
                    </div>
                            <!-- ============================================================== -->
                            <!-- end basic table -->
                            <!-- ============================================================== -->
                </div>

                {{-- <div class="dashboard-short-list">
                    <div class="row">
                            
                            <!-- ============================================================== -->
                            <!-- basic table Chiang Mai-->
                            <!-- ============================================================== -->
                            
                            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">จังหวัดเชียงใหม่</h5>
                                    <h4 class="card-header drag-handle"> <a href='{{ asset('/report/mapCM') }}' >&#9872; แผนที่แสดงจุดกีดขวางลำน้ำ </a> </h4>
                                    <h4 class="card-header drag-handle"> <a href='{{ asset('/report/chartCM/?amp=3+อำเภอ') }}' >&#9872; กราฟแสดงสัดส่วนสิ่งกีดขวางลำน้ำ </a> </h4>
                                    <h4 class="card-header drag-handle">
                                        <form id="amp" name="amp" action='{{ route('report/pdfCM') }}' method="get"> 
                                            <a href='#'> &#9872; รายงานสรุปผลสภาพปัญหาการกีดขวางในแม่น้ำคูคลอง  กรุณาเลือก
                                        
                                            <select name="amp" class="selectpicker " id="amp" > 
                                            <option value="0">-- อำเภอ --</option>
                                            <option value="sum">รวม 3 อำเภอ</option>
                                            <option value="ฝาง">ฝาง</option>
                                            <option value="ไชยปราการ">ไชยปราการ</option>
                                            <option value="แม่อาย">แม่อาย</option>
                                            </select> 
                                                
                                            <button type="submit" class="butsummit"> PDF </button> </a>
                                        </form> 
                                    </h4>
                                        
                                    </div>
                                </div>
                       
                    </div>
                            <!-- ============================================================== -->
                            <!-- end basic table -->
                            <!-- ============================================================== -->
                </div> --}}

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
