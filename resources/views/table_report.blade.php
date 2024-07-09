
<!DOCTYPE html>
<html>
<head>
    <title>Blockage PDF</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
        }
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 1cm;
            color:#000;
            text-align: right;
            line-height: 1.5cm;
            content: counter(page);
        }
        
	</style>
</head>
<body>
    <footer>
        หมายเหตุ ข้อมูลใช้เพื่อการศึกษาวางแผน ไม่สามารถใช้อ้างอิงทางกฎหมายและคดีความ
    </footer>
    <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="row" align="center" style="page-break-after:always;"> 
                    <img src="{{ asset('images/logo/amp/sum9.png') }}" width="100%"> 
                </div>
                {{-- <div class="row" align="center" style="margin-top:-80px;margin-bottom:-50px"> 
                    <img src="{{ asset('images/logo/head.png') }}" width="80%"> 
                </div> --}}
                <div class="title m-b-md">
                    <?php 
                            function checkCuase($text) {
                                if($text!=NULL ||$text!=0 ){
                                    //$img='https://survey.crflood.com/images/logo/checkOnly.png';
                                    //$img='http://localhost/chiang-rai/public/images/logo/checkOnly.png';
                                     //echo "<img src='{$img}'  width=15px;>";
                                    //return "images/logo/checkOnly.png";
                                    echo "<div class=\"checkmark\"></div>";
                                }else{
                                    return '';
                                }
                            }
                            function checkRisk($level,$fq){
                                if($level=="มาก"){
                                    $l=3;
                                }else if($level=="ปานกลาง"){
                                    $l=2;
                                }else{
                                    $l=1;
                                }

                                if($fq=="ทุกปี"){
                                    $f=3;
                                }else if($fq=="2-4 ปีครั้ง"){
                                    $f=2;
                                }else{
                                    $f=1;
                                }
                                
                                $cal=$l*$f;

                                if($cal<3){
                                    return "น้อย";
                                }
                                else if($cal<6){
                                    return "ปานกลาง";
                                }else{
                                    return "มาก";
                                }
                            }
                            function checklevel($flood,$waste,$other) {
                                if($flood!=NULL||$flood!=0){
                                    if($flood=="low"){
                                        $level="น้อย";
                                    }else if( $flood=="medium"){
                                        $level="ปานกลาง";
                                    }else if( $flood=="high") {
                                        $level="มาก";
                                    }else{
                                        $level=NULL;
                                    }
                                }else if($waste!=NULL||$waste!=0){
                                    if($waste=="low"){
                                        $level="น้อย";
                                    }else if( $waste=="medium"){
                                        $level="ปานกลาง";
                                    }else if( $waste=="high") {
                                        $level="มาก";
                                    }else{
                                        $level=NULL;
                                    }

                                }else if($other!=NULL||$other!=0){
                                    if($other=="low"){
                                        $level="น้อย";
                                    }else if( $other=="medium"){
                                        $level="ปานกลาง";
                                    }else if( $other=="high") {
                                        $level="มาก";
                                    }else{
                                        $level=NULL;
                                    }
                                }
                                    return $level;
                            }

                            function DateTimeThai($strDate)
                            {
                                $strYear = (date("Y",strtotime($strDate))+543)-2500;
                                $strMonth= date("n",strtotime($strDate));
                                $strDay= date("j",strtotime($strDate));
                                // $strHour= date("H",strtotime($strDate));
                                // $strMinute= date("i",strtotime($strDate));
                                // $strSeconds= date("s",strtotime($strDate));
                                $strMonthCut =  Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                                $strMonthThai=$strMonthCut[$strMonth];
                                return "$strDay/$strMonth/$strYear ";
                            }
                        ?>
                    
                    <table class="table table-bordered">
                    <thead align="center" >
                        <tr style="background-color:#C0C0C0">
                            <td width="2%" rowspan="4" class="text-center">#</td>
                            <td width="5%" rowspan="4" class="text-center">รหัส</td>
                            <td width="3%" rowspan="4" >หมู่บ้าน</td>
                            <td width="5%" rowspan="4" >ตำบล</td>
                            <td width="5%" rowspan="4" >ชื่อลำน้ำ</td>
                            <td width="10%" rowspan="4" >วันที่สำรวจ</td>
                            <td width="5%" rowspan="2" colspan="2" >พิกัดเริ่มต้น</td>
                            <td width="5%" rowspan="2" colspan="2" >พิกัดสิ้นสุด</td>

                            <td width="40%" colspan="16">สาเหตุและสภาพปัญหา</td>
                            <td width="10%" rowspan="4" >ระดับความเสี่ยง<br>จากการกีดขวาง<br>ทางน้ำ</td>
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
                   
                    <?php $num =count($data);
                        for($i = 0;$i < $num;$i++){?>
                        <tr align="center" >
                            <?php
                              $string=$data[$i]->blockageLocation->blk_village;
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
                              $damage=json_decode($data[$i]->damage_level);
                            //   echo $damage->flood;
                                $level=checklevel($damage->flood,$damage->waste,$damage->other->level);

                            
        
                            ?>
                             
                            <td scope="row">{{$i+1}}</td>
                            <td>{{$data[$i]->blk_code}}</td>
                            <td>{{$vill}} </td>
                            <td>{{$data[$i]->blockageLocation->blk_tumbol}} </td>
                            <td>{{$data[$i]->River->river_name}}</td>
                            <td>{{ $data[$i]->blockageLocation->blk_start_utm->getLat()}} </td>
                            <td>{{ $data[$i]->blockageLocation->blk_start_utm->getLng()}} </td>
                            <td>{{$data[$i]->blockageLocation->blk_end_utm->getLat() }} </td>
                            <td>{{$data[$i]->blockageLocation->blk_end_utm->getLng()}} </td>
                            <td>{{DateTimeThai($data[$i]->blockageLocation->created_at)}} </td>
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
                            <td>{{checkRisk($level,$data[$i]->damage_frequency)}}</td>                              
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