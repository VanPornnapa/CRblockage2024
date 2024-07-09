
<?php ini_set("memory_limit","521M"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Blockage PDF</title>
    <style>
		@font-face{
		font-family:  'THSarabunNew';
		font-style: normal;
		font-weight: normal;
		src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
		}
	    @font-face{
		font-family:  'THSarabunNew';
		font-style: normal;
		font-weight: normal;
		src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
		}
		html, body {
			background-color: #fff;
			color: #000000;
			font-family: "THSarabunNew";
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
			font-size:15px;
		}
		.m-b-md {
			/* margin-bottom: 2px; */
        }  
        .table{
            width:100%;
            /* margin-bottom:1rem; */
            background-color:transparent;
            border-collapse: collapse;
        }
        
        td {
            
            border: 1px black solid;
        }
    .rotate {
    text-align: center;
    white-space: normal;
    vertical-align: middle;
    width: 1.5em;
    }
    .rotate div {
        -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
        -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
    -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
            margin-left:-10px;
            margin-right: -10px;
            margin-top: -10px;
            text-align: left;
    }

    .checkmark{
        display:inline-block;
        content: '';
        width: 3px;
        height: 10px;
        border: solid #000;
        border-width: 0 1px 1px 0;
        transform: rotate(40deg);
        margin-left: 10px;
    }}
    
	</style>
</head>
<body>
    <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="row" align="center" style="page-break-after:always;"> 
                    <img src="{{ asset('images/logo/'.$amp.'.jpg') }}" width="100%"> 
                </div>
                {{-- <div class="row" align="center" style="margin-top:-80px;margin-bottom:-50px"> 
                    <img src="{{ asset('images/logo/head.png') }}" width="80%"> 
                </div> --}}
                <div class="title m-b-md">
                    <?php 
                            function checkCuase($text) {
                                if($text!=NULL ||$text!=0 ){
                                    $img='https://survey.crflood.com/images/logo/checkOnly.png';
                                   // $img='http://localhost/chiang-rai/public/images/logo/checkOnly.png';
                                    //echo "<img src='{$img}'  width=15px;>";
                                    //return "images/logo/checkOnly.png";
                                    echo "<div class=\"checkmark\"></div>";
                                }else{
                                    return '';
                                }
                            }
                        ?>
                    
                    <table class="table table-bordered">
                    <thead align="center" >
                        <tr style="background-color:#C0C0C0">
                            <td rowspan="4" class="text-center">#</td>
                            <td rowspan="4" class="text-center">รหัส</td>
                            <td rowspan="4" >หมู่บ้าน</td>
                            <td rowspan="4" >ตำบล</td>
                            <td rowspan="4" >ชื่อลำน้ำ</td>
                            <td rowspan="2" colspan="2" >พิกัดเริ่มต้น</td>
                            <td rowspan="2" colspan="2" >พิกัดสิ้นสุด</td>

                            <td colspan="16">สภาพปัญหา</td>
                            <td rowspan="2" colspan="2">ระดับการกีดขวาง</td>
                        </tr>
                        <tr style="background-color:#C0C0C0">
                            <td colspan="6" > ธรรมชาติ</td>
                            <td colspan="10"> มนุษย์</td>
                           
                        </tr>
                        <tr>
                            <td rowspan="2">X</td>
                            <td rowspan="2">Y</td>
                            <td rowspan="2">X</td>
                            <td rowspan="2">Y</td>
                            <td rowspan="2" class='rotate' > <div>ตลิ่งพัง</div></td>
                            <td rowspan="2" class='rotate' > <div>ลำน้ำตื้นเขิน</div></td>
                            <td rowspan="2" class='rotate'> <div>ลำน้ำขาดหาย</div> </td>
                            <td rowspan="2" class='rotate'> <div>ลำน้ำคดเคี้ยว</div> </td>
                            <td rowspan="2" class='rotate' > <div>วัชพืช </div></td>
                            <td rowspan="2" class='rotate'> <div>อื่นๆ</div> </td>
                            <td colspan="2" > สิ่งปลูกสร้าง</td>
                            <td colspan="5" > ระบบสาธารณูปโภค</td>
                            <td rowspan="2" class='rotate' > <div>การถมดิน</div></td>
                            <td rowspan="2" class='rotate' > <div>สิ่งปฏิกูล</div></td>
                            <td rowspan="2" class='rotate'> <div>อื่นๆ</div></td>
                            <td rowspan="2" class='rotate'><div> ระดับ</div></td>
                            <td rowspan="2" class='rotate'> <div>เปอร์เซ็นต์</div></td>
                        </tr>
                        <tr >
                            <td class="rotate" style="padding-top:20;padding-bottom:20px;" > <div>ส่วนราชการ</div></td>
                            <td class="rotate" > <div>ส่วนเอกชน</div></td>
                            <td class="rotate" > <div>ถนนขวาง</div></td>
                            <td class="rotate" > <div>ท่อลอดเล็ก</div></td>
                            <td class="rotate" > <div>ถนนขนาน</div></td>
                            <td class="rotate" ><div> วางท่อแทน</div></td>
                            <td class="rotate" ><div> สะพาน</div></td>
                        </tr>
                    </thead>
                   
                    <?php $num =count($problem);
                        for($i = 0;$i < $num;$i++){?>
                        <tr align="center" >
                            <?php
                              $string=$problem[$i]->blk_village;
                              $vill=explode(' ', $string);
                              $vill=$vill[2];
                              if($problem[$i]->prob_level=="1-30%"){
                                $lev="น้อย";
                                $problem[$i]->prob_level="1-30";
                              }else if($problem[$i]->prob_level=="30-70%"){
                                $lev="ปานกลาง";
                                $problem[$i]->prob_level="30-70";
                              }else{
                                $lev="มาก";
                                $problem[$i]->prob_level=">70";
                              }
                            ?>
                             
                            <td scope="row">{{$i+1}}</td>
                            <td>{{$problem[$i]->blk_code}}</td>
                            <td>{{$vill}} </td>
                            <td>{{$problem[$i]->blk_tumbol}} </td>
                            <td>{{$problem[$i]->river_name}}</td>
                            {{-- <td> - - </td>
                            <td> - - </td>
                            <td> - - </td>
                            <td> - - </td> --}}

                            <td>{{ $problem[$i]->lat_utm_start}} </td>
                            <td>{{ $problem[$i]->lng_utm_start}} </td>
                            <td>{{$problem[$i]->lat_utm_stop}} </td>
                            <td>{{$problem[$i]->lng_utm_stop}} </td>
                            <td>{{checkCuase($problem[$i]->nat_erosion)}}</td> 
                            <td>{{checkCuase($problem[$i]->nat_shoal)}}</td>
                            <td>{{checkCuase($problem[$i]->nat_missing)}}</td>
                            <td>{{checkCuase($problem[$i]->nat_winding)}}</td>
                            <td>{{checkCuase($problem[$i]->nat_weed_detail)}}</td>
                            <td>{{checkCuase($problem[$i]->nat_other)}}</td>
                            <td>{{checkCuase($problem[$i]->gov)}}</td>
                            <td>{{checkCuase($problem[$i]->bu)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_road)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_smallconvert)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_road_paralel)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_replaced_convert)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_bridge_pile)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_soil_cover)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_trash)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_other_detail)}}</td>
                            <td>{{$lev}}</td>
                            <td> {{$problem[$i]->prob_level}} </td>                              
                        </tr>
                    <?php }?>
                    <tbody>
                        
                    </tbody>
                    </table>
                    
                </div>
            </div>
        </div>

        
</body>
</html>