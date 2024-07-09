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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>     
</head>
<body>
    <div class="flex-center position-ref full-height">
         <div class="content">
            <div class="title m-b-md">
                   <img src="{{ asset('images/logo/head_form.png') }}" width="100%">
            </div>
            <div class="row" style="padding-left:30px;">
                 <h4><a href="{{ asset('/blocker') }}">รายละเอียดแบบสำรวจ </a> &raquo; เพิ่มแบบสำรวจใหม่ &raquo; เพิ่มรูปภาพ</h4>
            </div>
            <div class="title m-b-md">
                <form action="" method="get" enctype="multipart/form-data" onsubmit="return confirm('กรุณาตรวจสอบความถูกต้อง !!');">
                    {{ csrf_field() }}
                    <span class="number">5</span>รูปภาพประกอบ

                    <table class="table-name">
                        <tr>
                            <th colspan="3"></th>
                        </tr>
                        <tr>
                            <td align="right">ประเภทรูปภาพ</td>
                            <td>
                                <select id="photo_type" name="photo_type" >
                                        <option value="0">-- ระบุ --</option>
                                        <option value="bld">สิ่งปลูกสร้างที่กีดขวาง</option>
                                        <option value="land">ที่ดิน</option>
                                        <option value="river">รูปแม่น้ำ คู คลอง</option>
                                        <option value="sketch">รูปสเก็ตสภาพตำแหนงที่เกิดปัญหาของลำน้ำ</option>
                                </select>
                            
                            <td>    </td>
                            </tr>
                    </table>

                    <div class="bld box">
                            <table class="table-name" width="100%">
                                    <tr>
                                            <td>
                                                <div class="form-group">
                                                    <input type="file" id = "photo_type_bld" name="photo_type_bld[]" class="form-control-file" multiple="true">
                                                </div>
                                                <div id="image_preview_bld"></div></td>
                                            </td>
                                    </tr>                                        
                            </table>
                    </div>

                    <div class="land box">
                            <table class="table-name" width="100%">
                                <tr>
                                    <td><input type="radio" id="photo_detail_selector1"  name="photo_detail_selector" value="มีเอกสารสิทธิ์"><label for="photo_detail_selector1">มีเอกสารสิทธิ์</td>
                                    <td><input type="radio" id="photo_detail_selector2"  name="photo_detail_selector" value="ไม่มีเอกสารสิทธิ์"><label for="photo_detail_selector2">ไม่มีเอกสารสิทธิ์</td>
                                    <td><input type="radio" id="photo_detail_selector3"  name="photo_detail_selector" value="ที่สาธารณะ"><label for="photo_detail_selector3">ที่สาธารณะ</td>
                                </tr> 
                               
                                <tr>
                                        <td colspan="3" >
                                            <div class="form-group">
                                                 <br><input type="file" id = "photo_type_land" name="photo_type_land[]" class="form-control-file" multiple="true">                   
                                                 <div id="image_preview_land"></div>
                                            </div>
                                        </td>
                                </tr>       
                            </table>
                        </div>


                    <div class="river box">
                        <table class="table-name" width="100%">
                                <tr>
                                        <td align="right">ก่อนการรุกล้ำ :</td>
                                        <td><input type="file" id = "photo_type_river_before" name="photo_type_river_before[]" class="form-control-file" multiple="true"> </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2"><div id="image_preview_river_before"></div><td>
                                    </tr>
                                
                                    <tr>
                                        <td align="right">ระหว่างการรุกล้ำ :</td>
                                        <td><input type="file" id = "photo_type_river_prob" name="photo_type_river_prob[]" class="form-control-file" multiple="true"> </td>
                                    </tr>
                                
                                    <tr>
                                        <td></td>
                                        <td colspan="2"><div id="image_preview_river_prob"></div></td>
                                    </tr>
                                    <tr>
                                        <td align="right">หลังการรุกล้ำ :</td>
                                        <td><input type="file" id="photo_type_river_after"  name="photo_type_river_after[]" class="form-control-file" multiple="true"> </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2"><div id="image_preview_river_after"></div></td>
                                    </tr>
                                
                        </table>
                    </div> 
                    

                    
                    <div class="sketch box">
                            <table class="table-name" width="100%">
                                    <tr>
                                            <td >
                                                <div class="form-group">
                                                    <input type="file" id = "photo_type_prob_sketch" name="photo_type_prob_sketch[]" class="form-control-file" multiple="true">                   
                                                    <div id="image_preview_prob_sketch"></div>
                                                </div>
                                            </td>
                                    </tr>                                        
                            </table>
                    </div>


                    
                </div>
                
                    
                <br><br>
                        <button type="submit" class="butsummit">บันทึกข้อมูล</button>
            </form>    
        </div>
    </div>

</div> {{--flex-center --}}
        
    <script src= "{{ asset('js/app.js') }}"></script>
    <script src= "{{ asset('js/imagePreview.js') }}"></script>
    <script>
        $(document).ready(function(){
        $("select").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".box").hide();
                }
            });
        }).change();
    });
        
    </script>

</body>
</html>