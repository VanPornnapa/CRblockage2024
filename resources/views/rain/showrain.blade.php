<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IDF Curve::CRflood</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.css') }}">
    <style>
        #container {
        height: 800px; 
        width: 100%; 
        margin: 0 auto; 
        }
        .loading {
            margin-top: 10em;
            text-align: center;
            color: gray;
        }
    </style>
    <script src="{{ asset('js/rain/highmap.js') }}"></script>
    <script src="{{ asset('js/rain/chiangrai.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    /* Style the input field */
        #myInput {
            padding: 10px;
            margin-top: -6px;
            border: 0;
            border-radius: 0;
        }
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding: 100px 0 5px 0; /* Location of the box */
           
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: hidden ; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.85); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 32%;
            /* max-width: 700px; */
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 60%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {  
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)} 
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)} 
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 50px;
            right: 50px;
            color: #fff;
            font-size: 70px;
            font-weight: bold;
            transition: 0.9s;
        }

        .close:hover,
        .close:focus {
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
            .close {
                position: absolute;
                top: 70px;
                right: 10px;
                color: #fff;
                font-size: 30px;
                font-weight: bold;
                transition: 0.9s;
            }
            .modal-content {
                margin: auto;
                display: block;
                width: 80%;
                /* max-width: 700px; */
            }
        }
    </style>

     
</head>
<body>

    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
                <nav class="navbar navbar-expand-lg bg-white fixed-top">
                    <a class="navbar-brand" href="{{ url('/mapthai/chiangrai') }}">Intensity-Duration-Frequency Curve (IDF Curve)</a>
                   
                </nav>
        </div>
        <div class="container-fluid dashboard-content" style="margin-bottom:-40px;">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- ============================================================== -->
                    <!-- icon fontawesome solid  -->
                    <!-- ============================================================== -->
                    <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">กราฟความเข้มฝน-ช่วงเวลา-ความถี่การเกิด (IDF curve)  ของอำเภอ{{$amp}} จังหวัดเชียงราย  </h3>
                                
                            </div>
                            <div class="row" style="margin-left:20px; margin-top:-10px;" >
                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-6 col-6">
                                    <h5 class="card-subtitle"><a href="{{ asset('/mapthai/chiangrai') }}">จังหวัดเชียงราย </a> &raquo; อำเภอ{{$amp}} </h5>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 col-4">
                                    <br>
                                    <div class="dropdown" >
                                        <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown" style="margin= 5px;">ค้นหา อำเภอ
                                            <span class="caret"></span>
                                        </button>
                                            <ul class="dropdown-menu">
                                                <input class="selectpicker" id="myInput" type="text" placeholder="ค้นหา..">
                                                <li><a href="{{ url('/mapthai/chiangrai/เมืองเชียงราย') }}">&nbsp; &nbsp;เมืองเชียงราย</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/ขุนตาล') }}">&nbsp; &nbsp;ขุนตาล</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เชียงของ') }}">&nbsp; &nbsp;เชียงของ</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เชียงแสน') }}">&nbsp; &nbsp;เชียงแสน</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เวียงแก่น') }}">&nbsp; &nbsp;เวียงแก่น</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เวียงเชียงรุ้ง') }}">&nbsp; &nbsp;เวียงเชียงรุ้ง</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เวียงป่าเป้า') }}">&nbsp; &nbsp;เวียงป่าเป้า</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/แม่จัน') }}">&nbsp; &nbsp;แม่จัน</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/แม่ลาว') }}">&nbsp; &nbsp;แม่ลาว</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/แม่สรวย') }}">&nbsp; &nbsp;แม่สรวย</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/แม่สาย') }}">&nbsp; &nbsp;แม่สาย</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/แม่ฟ้าหลวง') }}">&nbsp; &nbsp;แม่ฟ้าหลวง</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/ดอยหลวง') }}">&nbsp; &nbsp;ดอยหลวง</a></li>
                                              
                                                <li><a href="{{ url('/mapthai/chiangrai/ป่าแดด') }}">&nbsp; &nbsp;ป่าแดด</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/พาน') }}">&nbsp; &nbsp;พาน</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/เทิง') }}">&nbsp; &nbsp;เทิง</a></li>
                                                <li><a href="{{ url('/mapthai/chiangrai/พญาเม็งราย') }}">&nbsp; &nbsp;พญาเม็งราย</a></li>
                                            </ul>
                                    </div>
                                </div>
                            </div>
                        
                        <div class="card-body" >
                            <?php if($amp!="พาน" && $amp!="ป่าแดด" && $amp!="ขุนตาล"){?>
                                <div class="row justify-content-center" >
                                    <!-- grid column -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <!-- .card -->
                                                <div class="card card-figure">
                                                    <!-- .card-figure -->
                                                    <figure class="figure">
                                                        <!-- .figure-img -->
                                                        <div class="figure-attachment">
                                                            <img src="{{ asset($amp_name)}}" id="myImg" class="img-fluid" width="60%"> 
                                                        </div>
                                                        <div id="myModal" class="modal">
                                                            <span class="close">&times;</span>
                                                            <img class="modal-content" id="img01" width="60%">
                                                            <div id="caption"></div>
                                                        </div>
                                                        <!-- /.figure-img -->
                                                        <figcaption class="figure-caption">
                                                            <ul class="list-inline d-flex text-muted mb-0">
                                                                <li class="list-inline-item text-truncate mr-auto"> อำเภอ{{$amp}} จังหวัดเชียงราย</li>
                                                                <li class="list-inline-item">
                                                                        ดาวน์โหลด<a href="{{ asset($amp_name)}}" download>  <span><i class="fas fa-download "></i></span></a>
                                                                </li>
                                                            </ul>
                                                        </figcaption>
                                                    </figure>
                                                    <!-- /.card-figure -->
                                                </div>
                                                <!-- /.card -->
                                                <div class="row justify-content-end">
                                                        <div class="col-3" style="margin:-40px 20px 0 0;text-align:right;">
                                                            <h5 class="card-subtitle" > update 2020 </h5>
                                                        </div>
                                                </div>
                                            </div>
                                            <!-- /grid column -->
                                        </div>  
                                    
                                </div>
                            <?php } else{ ?> 
                            
                                        <div class="row justify-content-center" >
                                            <!-- grid column -->
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" >
                                                    <!-- .card -->
                                                        <div class="card card-figure"  >
                                                            <center><h3 > อยู่ระหว่างดำเนินการ <br> หรือ <br> เลือกใช้กราฟของอำเภอใกล้เคียง </h3></center>
                                                        </div>
                                            </div>
                                        </div>
                                        
                            
                            <?php } ?>

                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end icon fontawesome solid  -->
                    <!-- ============================================================== -->
                    <br><BR><BR>
                </div>
            </div>
            
        </div>
        <div class="footer">
                <div class="row justify-content-md-center" align="center">
                    <div class="col-md-8" style="margin-top: 10px;">
                       <a href="https://cendim.eng.cmu.ac.th/">
                            <img src="{{ asset('images/logo/footer/cendim.jpg') }}" width="15%">
                            ศูนย์วิจัยด้านการจัดการภัยพิบัติทางธรรมชาติ มหาวิทยาลัยเชียงใหม่ (CENDiM)
                       </a>
                    </div>
                
                </div>        
        </div>
  
    </div>


<script src= "{{ asset('js/app.js') }}"></script> 

    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".dropdown-menu li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
            img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
            modal.style.display = "none";
        }
    </script>


</body>
</html>