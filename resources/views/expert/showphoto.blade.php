<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blockage::CRflood</title>
    <style>
        body {
          font-family: Verdana, sans-serif;
          margin: 0;
        }
        
        * {
          box-sizing: border-box;
        }
        
        .row > .column {
          padding: 0 8px;
        }
        
        .row:after {
          content: "";
          display: table;
          clear: both;
        }
        
        .column {
          float: left;
          width: 25%;
          margin-top: 10px;
        }
       

        .columnmap {
          float: left;
          width: 20%;
          margin-top: 10px;
        }

        .columnDown {
          float: left;
          width: 10%;
        }
        
        /* The Modal (background) */
        .modal {
          display: none;
          position: fixed;
          z-index: 1;
          padding-top: 100px;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          overflow: auto;
          background-color: black;
        }
        
        /* Modal Content */
        .modal-content {
          position: relative;
          background-color: #fefefe;
          margin: auto;
          padding: 0;
          width: 90%;
          max-width: 1200px;
        }
        
        /* The Close Button */
        .closeph {
          color:#f2f2f2;
          position: absolute;
          top: 20px;
          right: 50px;
          font-size: 3.35rem;
          
        }
        
        .closeph:hover,
        .closeph:focus {
          color:#f2f2f2;
          text-decoration: none;
          cursor: pointer;
        }
        
        .mySlides {
          display: none;
        }
        
        .cursor {
          cursor: pointer;
        }
        
        /* Next & previous buttons */
        .prev,
        .nextph {
          background-color:#000;
          cursor: pointer;
          position: absolute;
          top: 50%;
          width: auto;
          padding: 16px;
          margin-top: -80px;
          color: white;
          font-weight: bold;
          font-size: 30px;
          transition: 0.6s ease;
          border-radius: 0 3px 3px 0;
          user-select: none;
          -webkit-user-select: none;
        }
        
        /* Position the "next button" to the right */
        .nextph {
          right: 0;
          border-radius: 3px 0 0 3px;
        }
        
        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .nextph:hover {
          background-color: rgba(0, 0, 0, 0.8);
        }
        
        /* Number text (1/3 etc) */
        .numbertext {
          color: #f2f2f2;
          font-size: 12px;
          padding: 8px 12px;
          position: absolute;
          top: 0;
        }
        
        img {
          margin-bottom: -4px;
        }
        
        .caption-container {
          text-align: center;
          background-color: black;
          padding: 2px 16px;
          color: white;
        }
        
        .demo {
          opacity: 0.6;
        }
        
        .active,
        .demo:hover {
          opacity: 1;
        }
        
        img.hover-shadow {
          transition: 0.3s;
        }
        
        .hover-shadow:hover {
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        @media only screen and (max-width: 600px) {
          .column {
              float: left;
              width: 50%;
              margin-top: 10px;
            }
          .columnmap {
              float: left;
              width: 50%;
              margin-top: 10px;
            }
          .columnDown {
            float: left;
            width: 20%;
            } 
        }
    </style>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>     
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
                        <h3 class="card-title"><a href="{{ asset('/') }}">หน้าหลัก </a> &raquo;  รูปภาพประกอบสิ่งกีดขวาง :{{$data[0]->blk_code}}</h3>
                        <h3 class="card-subtitle">ตำแหน่งที่ตั้ง : {{$location[0]->blk_village}} ต.{{$location[0]->blk_tumbol}} อ.{{$location[0]->blk_district}} จ.{{$location[0]->blk_province}}</h3>
                        
                      </div>
                        <!-- The four columns -->
                        <div class="card-body" >
                          <div class="alert alert-primary" style="margin:0 -20px 0;">รูปภาพแผนที่แสดงขอบเขตพื้นที่รับน้ำ</div>
                          <div class="row">
                              <div class="columnmap" align="center">
                                  <img src="https://survey.crflood.com/{{($expert[0]->exp_pixmap)  }}" onclick="openModal();currentSlide({{1}})" style="width:40%" class="hover-shadow cursor">
                              </div>
                              <div class="column">
                                  <img src="https://survey.crflood.com/images/map/{{($data[0]->blk_code)}}.JPG"  onclick="openModal();currentSlide({{2}})" style="width:70%" class="hover-shadow cursor">
                              </div>
                          </div>
                          <br>
                          <div class="alert alert-primary" style="margin:0 -20px 0;">รูปภาพสำรวจตำแหน่งจุดกีดขวางทางน้ำ</div>
                          <div class="row">
                            
                            <?php for($i=0;$i<count($photo_Blockage);$i++){?>
                              <div class="column">
                                  <img src="https://survey.crflood.com/{{($photo_Blockage[$i]->photo_name)  }}" onclick="openModal();currentSlide({{$i+3}})" style="width:100%" class="hover-shadow cursor">
                              </div>
                          <?php } ?> 
                          </div>
                          
                          
                          
                          <div id="myModal" class="modal">
                                  <span class="closeph cursor" onclick="closeModal()"> &times; </span>
                              <div class="modal-content">
                                <?php   $num =count($photo_Blockage)+1; ?>
                                  <div class="mySlides">
                                    <div class="numbertext">{{$i+1}} / {{$num}}</div>
                                    <center><img src="https://survey.crflood.com/{{($expert[0]->exp_pixmap)  }}"  style="width:40%"></center>
                                  </div>
                                  <div class="mySlides">
                                    <div class="numbertext">{{$i+2}} / {{$num}}</div>
                                    <center><img src="https://survey.crflood.com/images/map/{{($data[0]->blk_code)}}.JPG"   style="width:80%"></center>
                                  </div>
                                  <?php for($i=0;$i<count($photo_Blockage);$i++){?>
                                      <div class="mySlides">
                                          <div class="numbertext">{{$i+3}} / {{$num}}</div>
                                          <img src="https://survey.crflood.com/{{($photo_Blockage[$i]->photo_name)}}"  style="width:100%">
                                      </div>
                                  <?php } ?>
                                  
                                      
                              
                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                <a class="nextph" onclick="plusSlides(1)">&#10095;</a>
                            
                                <div class="caption-container">
                                  <p id="caption"></p>
                                </div>
                                <div class="caption-container" width=120%>
                                  <div class="columnDown">
                                    <img class="demo cursor" src="https://survey.crflood.com/{{($expert[0]->exp_pixmap)}}" style="width:40%" onclick="currentSlide({{1}})" >
                                  </div>
                                  <div class="columnDown">
                                    <img class="demo cursor" src="https://survey.crflood.com/images/map/{{($data[0]->blk_code)}}.JPG"  style="width:80%" onclick="currentSlide({{2}})" >
                                  </div>
                                  <?php for($i=0;$i<count($photo_Blockage);$i++){?>
                                      <div class="columnDown">
                                          <img class="demo cursor" src="https://survey.crflood.com/{{($photo_Blockage[$i]->photo_name)  }}" style="width:100%" onclick="currentSlide({{$i+3}})" >
                                      </div>
                                  <?php } ?>
                                      
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

    </div> {{--main --}}
        
    <script src= "{{ asset('js/app.js') }}"></script>
    <script>
        function openModal() {
          document.getElementById("myModal").style.display = "block";
        }
        
        function closeModal() {
          document.getElementById("myModal").style.display = "none";
        }
        
        var slideIndex = 1;
        showSlides(slideIndex);
        
        function plusSlides(n) {
          showSlides(slideIndex += n);
        }
        
        function currentSlide(n) {
          showSlides(slideIndex = n);
        }
        
        function showSlides(n) {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("demo");
          var captionText = document.getElementById("caption");
          if (n > slides.length) {slideIndex = 1}
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";
          }
          for (i = 0; i < dots.length; i++) {
              dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";
          dots[slideIndex-1].className += " active";
          captionText.innerHTML = dots[slideIndex-1].alt;
        }
    </script>
            
    
</body>
</html>