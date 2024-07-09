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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>     
</head>
<body>
    <div class="dashboard-main-wrapper">
        @include('includes.head')
        @include('includes.header')
        <div class="dashboard-wrapper">
            <div class="flex-center position-ref full-height">
                <div class="content">
                    <div class="title m-b-md">
                        <br>
                        <img src="{{ asset('images/logo/head_form.png') }}" width="100%">
                    </div>
                    <div class="row" style="padding-left:30px;">
                        {{-- <h4 class="pageheader-title"><a href="{{ asset('/blocker') }}">รายละเอียดแบบสำรวจ </a> &raquo; เพิ่มแบบสำรวจใหม่ &raquo; เพิ่มรูปภาพ {{$data[0]->blk_code}}</h4> --}}
                        <h4 class="pageheader-title"><a href="{{ asset('/expert') }}">ข้อเสนอแนะโดยผู้เชี่ยวชาญ </a>  &raquo; เพิ่มรูปภาพ {{$data[0]->blk_code}}</h4>
                    </div>
                    
                    <div class="title m-b-md">
                        <div class="row">
                            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12" > 

                                <form action="{{ route('expert.upphoto') }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('บันทึกข้อมูล !!');">
                                {{-- <form action="#" method="post" enctype="multipart/form-data" onsubmit="return confirm('บันทึกข้อมูล !!');"> --}}
                                     
                                    {{ csrf_field() }}
                                    <input id="blk_id" name="blk_id" type="hidden" value="{{ $data[0]->blk_id }}">
                                    <span class="number">1</span> Upload รูปภาพแผนที่กีดขวางทางน้ำ
                                    <div class="form-group">
                                        <br><input type="file" id = "photo_type_land" name="photo_type_land[]" class="form-control-file" multiple="true">                   
                                        <div id="image_preview_land"></div>
                                    </div>
                                    
                                    <span class="number">2</span>กรุณาเลือกรูปภาพประกอบจำนวน 2 รูปเพื่อประกอบรายงาน
                                    <div id="container">    
                                        <input id="num_pix" name="num_pix" type="hidden" value="{{ count($photo_Blockage) }}">
                                        <table style="margin-left: 30px;">
                                            

                                            <?php if(isset($photo_Blockage[0]->thumbnail_name)){
                                                        
                                                        for($i=0;$i<count($photo_Blockage);$i++){
                                                            ?>
                                                            <tr height=200px;>
                                                                    <td>
                                                                        <input type="checkbox" id="photo{{$i}}" name="photo{{$i}}" value='{{$photo_Blockage[$i]->thumbnail_name}}' /> 
                                                                    
                                                                        <label for="photo{{$i}}"> 
                                                                            <img src="https://survey.crflood.com/{{($photo_Blockage[$i]->thumbnail_name)  }}">
                                                                        </label>
                                                                    </td>
                                                                </tr>

                                                        <?php } 
                                                    }?>
                                                
                                        </table>    
                                    </div>
                                        

                                    
                                   
                                <br><br>
                                        <button type="submit" class="butsummit">บันทึกข้อมูล</button>
                                </form>    

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> {{--fashboard-wrapper --}}
    </div> {{--main --}}
        
    <script src= "{{ asset('js/app.js') }}"></script>
    <script src= "{{ asset('js/imagePreview.js') }}"></script>
    <script>
           $(document).ready(function(){
            var maxbox = 2,count=0;
            var container = $("#container")
            $('input:checkbox',container).click(function(){
                count = $('input:checkbox:checked',container).length;
                if(count > maxbox){ 
                    alert('คุณเลือกได้เพียง '+maxbox+' รายการ');
                    return false; 
                }
            });    
        });

    </script>
</body>
</html>