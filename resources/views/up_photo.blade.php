<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel By FeatureA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
        <!-- Styles -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
     

            <div class="content">
                    <div class="title m-b-md">
                            <img src="{{ asset('images/logo/head_form.png') }}" width="100%">
                    </div>
      
                    <div class="title m-b-md">
                    
                        <form action="" method="get" enctype="multipart/form-data">
                            <span class="number">5</span>รูปภาพประกอบ

                            <table class="table table-borderless">
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr >
                                    <th>5.1 สิ่งปลูกสร้างที่กีดขวาง (ใส่รูปได้มากกว่า 1 รูป): </th>
                                    <td><div class="form-group">
                                        <input type="file" id = "photo_type_bld" name="photo_type_bld[]" class="form-control-file" multiple="true">
                                    </div>
                                    <div id="image_preview_bld"></div></td>
                                   
                                </tr>
                                <tr>
                                    <th>5.2 ที่ดิน (ใส่รูปได้มากกว่า 1 รูป): :</th>
                                    <td >
                                        <div class="form-group">
                                            <input type="file" id = "photo_type_land" name="photo_type_land[]" class="form-control-file" multiple="true">                   
                                            <div id="image_preview_land"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">รายละเอียด</td>
                                    <td>
                                        <select id="photo_detail_selector" name="photo_detail_selector">
                                            <option value="0">-- ระบุ --</option>
                                            <option value="มีเอกสารสิทธิ์">มีเอกสารสิทธิ์</option>
                                            <option value="ไม่มีเอกสารสิทธิ์">ไม่มีเอกสารสิทธิ์</option>
                                            <option value="ที่สาธารณะ">ที่สาธารณะ</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>5.3 รูปแม่น้ำ คู คลอง: </th>

                                </tr>
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

                                <tr>
                                    <th>5.4 รูปสเก็ตสภาพตำแหนงที่เกิดปัญหาของลำน้ำ:</th>
                                    <td colspan="2"><input type="file" id = "photo_type_prob_sketch" name="photo_type_prob_sketch[]" class="form-control-file" multiple="true"></td>                    
                                </tr>
                                
                                <tr>
                                    <td></td>
                                    <td><div id="image_preview_prob_sketch"></div><td>
                                </tr>
                            </table>
                         
                            
                        <br><br>
                        <button type="submit" class="butsummit">Submit</button>

                            
                        </form>
                    </div>
            </div>

        </div> {{--flex-center --}}

        <script src= "{{ asset('js/app.js') }}"></script>
        <script src= "{{ asset('js/imagePreview.js') }}"></script>
    </body>
</html>
