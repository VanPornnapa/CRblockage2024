<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blockage::CRflood</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
     <!-- Styles -->
     <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Mitr', sans-serif;
               
            }
            .position-ref {
            position: relative;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .content {
                text-align: left;
                
            }

            .title {
                font-size:16px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

           
        </style>

        <style type="text/css">
            .box{
                color: #fff;
                padding: 20px;
                display: none;
                margin-top: 20px;
                width: 100%;
            }
            .river{ background: #fff; }
            .land{ background: #fff; color: #fff; }
            .bld{  }
            .sketch{}
        </style>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>      --}}
</head>
<body>

    <div class="dashboard-main-wrapper">
        @include('includes.headmenu')
        <div class="container-fluid dashboard-content" style="margin-bottom:-40px;">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- ============================================================== -->
                    <!-- icon fontawesome solid  -->
                    <!-- ============================================================== -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">ตารางรายงานแนวทางการแก้ไขสภาพปัญหาการกีดขวางในแม่น้ำคูคลอง</h2>
                            
                        </div>
                        <div class="card-body" >
                            <div class="row" style="padding-left:30px;">
                                {{-- <h4 class="pageheader-title"><a href="{{ asset('/blocker') }}">รายละเอียดแบบสำรวจ </a> &raquo; เพิ่มแบบสำรวจใหม่ &raquo; เพิ่มรูปภาพ {{$data[0]->blk_code}}</h4> --}}
                                <h5 ><a href="{{ asset('/') }}">หน้าแรก </a>  &raquo; ตารางรายงานแนวทางการแก้ไขสภาพปัญหาการกีดขวางในแม่น้ำคูคลอง</h5>
                            </div>
                            <br><BR>
                            <div class="flex-center position-ref full-height">
                                <div class="content">
                                   
                                   <div class="title m-b-md">
                                        <form id="amp" name="amp" action='{{ route('reports/solution') }}' method="get"> 
                                           {{-- {{ csrf_field() }} --}}
                                           
                                                <span class="number">*</span> ข้อมูลสภาพปัญหาและแนวทางการแก้ไขปัญหาเบื้องต้น  <br><Br>
                                            <div class="row" width="800px" >
                                                <table class="table-name" width=70% align=center style="margin-bottom:60px;">
                                                    
                                                    <tr style="padding-top:20px;">
                                                        <td align="right">อำเภอ :</td>
                                                        <td>
                                                            <select name="amp" class="selectpicker " id="blk_district" > 
                                                                <option value="sum">- - กรุณาเลือกอำเภอ - -</option>
                                                                <!-- <option value="sum">รวม 9 อำเภอ</option> -->
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
                                                                <option value="เวียงป่าเป้า">เวียงป่าเป้า</option>
                                                                <option value="พญาเม็งราย">พญาเม็งราย</option>
                                                                <option value="เทิง">เทิง</option>
                                                                <option value="พาน">พาน</option>
                                                                <option value="ขุนตาล">ขุนตาล</option>
                                                            </select> 
                                                        </td>
                                                    </tr>
                                                        <tr>
                                                            <td align="right">ตำบล :</td>
                                                            <td>
                                                                <select id="blk_tumbolCR" name="tumbol" >
                                                                    <option value='sum'>-- เลือกตำบล --</option>
                                                                    
                                                                </select>
                                                            </td>
                                                        </tr>
                                                </table>    
                                            </div>
                                       
                                            <button type="submit" class="butsummit" formtarget="_blank"> PDF </button> </a>
                                        </form>    
                                    </div>
                                </div>
                          
                            </div>
                        </div>
                    <!-- ============================================================== -->
                    <!-- end icon fontawesome solid  -->
                    <!-- ============================================================== -->
                    <br><BR><BR>
                </div>
            </div>
            
        </div>
        
        @include('includes.foot')
    </div>


    

</div> {{--flex-center --}}
<script src="{{ asset('js/chooseLocation_table.js') }}"></script>
{{-- <script src= "{{ asset('js/app.js') }}"></script> --}}
   

</body>
</html>