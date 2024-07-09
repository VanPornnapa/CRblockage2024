<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <style>
		@font-face{
		font-family:'THSarabunNew';
		font-style: normal;
		font-weight: normal;
		src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
		}
	    @font-face{
		font-family:'THSarabunNew';
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
            font-size:16px;
            line-height: 1.2;
		}
		.m-b-md {
			/* margin-bottom: 2px; */
        }  
        .table{
            width:100%;
			/* margin-bottom:0.1rem; */
            background-color:transparent
        }
        .table td,
        .table th{
            /* padding:-.5rem; */
			/* vertical-align:top; */
			padding-top: -.3rem;
            border-top:1px solid #000000;
            line-height: 96%;
        }
        .table thead th{
            /* vertical-align:bottom; */
            border-bottom:1px solid #000000
        }
        .table td{
            height:10;
        } 
        .table .table{background-color:#f8fafc}
        .table-bordered,
        .table-bordered td,
        .table-bordered th{border:1px solid #000000}
        .table-bordered thead td,
        /* .table-bordered thead th{border-bottom-width:2px} */
        .table{border-collapse:collapse!important}
        .table-borderless tbody+tbody,
        .table-borderless td,
        .table-borderless th,
		.table-borderless thead th{border:0}
		.text-center{text-align:center!important}
        .text-right{text-align:right!important}
        html { margin-bottom: 0px}
        p.test1 {
            margin-top:5px;
            margin-left: 3px;
            margin-bottom: 5px;
        }
        p.test2 {
            margin-top:1px;
            margin-left: 3px;
            margin-bottom: 5px;
            width: 340px; 
            word-wrap:break-word;
            line-height: 0.8;
        }
        footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;

                /** Extra personal styles **/
                /* background-color: #03a9f4; */
                color:#000;
                text-align: right;
                line-height: 1.5cm;
                content: counter(page);
        }
    </style>
        
</head>
<body>
    <footer>
        *หมายเหตุ ข้อมูลใช้เพื่อการศึกษาวางแผน ไม่สามารถใช้อ้างอิงทางกฎหมายและคดีความ
    </footer>
    <div class="row" >
        <div class="col-xl-1 col-lg-1">
        </div>
        <!-- ============================================================== -->
        <!-- basic table -->
        <!-- ============================================================== -->
        <?php 
            function checkZero($text) {
                if($text=="0" ||$text==NULL ){
                    $num="-";
                }else{
                    $num=$text;
                 }
                    return $num;
                }
            function checkProbleLevel($text){
                if($text==NULL){
                    return "-";
                }
                else if($text=="1-30%"){
                    return "น้อย";
                }else if($text=="30-70%"){
                    return "ปานกลาง";
                }else{
                    return "มาก";
                }
            }
            function checkPlan($text,$year,$char,$budget){
                if($text==NULL){
                    return "-";
                }else if ($text=="plan"){
                    $c="อยู่ในแผน ".$year." ".$char." งบประมาณ ".$budget." บาท";
                    return $c;
                }else if($text=="received"){
                    return "ได้รับงบประมาณแล้ว".$budget."บาท ลักษณะโครงการ ".$char;
                }else if($text=="making"){
                    return "กำลังปรับปรุงหรือก่อสร้าง";
                }else{
                    return "ยังไม่มีในแผน";
                }
            }
            function checkDamage($flood,$waste,$other){
                
                if($flood=="0" && $waste=="0" && $other=="0"){
                    return "  -";
                } else if($flood!=NULL||$flood!=0){
                    return "น้ำท่วม";
                }else if($waste!=NULL||$waste!=0){
                    return "น้ำเสีย";
                }else if($other!=NULL||$other!=0){
                    return "อื่นๆ";
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

            function checkW($text){
                 if($text=="0" ||$text==NULL ){
                        return " ";
                 }else{
                        return " ความลาดชันท้องน้ำ ".$text;
                 }
            }
            function DateTimeThai($strDate)
                            {
                                $strYear = (date("Y",strtotime($strDate))+543);
                                $strMonth= date("n",strtotime($strDate));
                                $strDay= date("j",strtotime($strDate));
                                // $strHour= date("H",strtotime($strDate));
                                // $strMinute= date("i",strtotime($strDate));
                                // $strSeconds= date("s",strtotime($strDate));
                                $strMonthCut =  Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                                $strMonthThai=$strMonthCut[$strMonth];
                                return "$strDay $strMonthThai $strYear ";
                            }
        ?>
        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12" > 
            <div class="card">
                    
                <div class="card-body">
                    <div class="flex-center position-ref full-height">
                        <div class="content">
                            <div class="title m-b-md" style="margin-top:-30px;">
                                <img src="{{ asset('images/logo/head_expert.png') }}" width="90%">
                            </div>
                            <div align="right">
                                 รหัสตำแหน่งกีดขวางที่: {{ $data[0]->blk_code }} 
                            </div>
                            {{-- <div align="right" style="margin-top: -10px;margin-bottom:5px;">
                                วันที่สำรวจ: {{DateTimeThai($data[0]->created_at)}}  
                           </div> --}}
                            <div class="title m-b-md">
                                <table  class="table table-borderless" width="80%" align="center">
                                       
                                        <tr>
                                            <td>ชื่อลำน้ำ {{ $data[0]->river->river_name }}</td>
                                            <td colspan="2"> เป็นสาขาของแม่น้ำ  {{  $data[0]->river->river_main  }} </td>
                                            <td>ประเภทลำน้ำ {{ $data[0]->river->river_type }}</td>
                                            <td>วันที่สำรวจ: {{DateTimeThai($data[0]->created_at)}}  </td>
                                        </tr>
                                        <tr>
                                            <td>หมู่บ้าน {{$data[0]->blockageLocation->blk_village}}</td>
                                            <td>ตำบล {{$data[0]->blockageLocation->blk_tumbol }}  </td>
                                            <td>อำเภอ {{  $data[0]->blockageLocation->blk_district  }}</td>
                                            <td>จังหวัด {{  $data[0]->blockageLocation->blk_province  }}</td>
                                        </tr>
                                </table>
            
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td colspan="4" class="text-center" style="background-color:#C0C0C0">พิกัดเริ่มปัญหา</td>
                                            <td colspan="4" class="text-center" style="background-color:#C0C0C0">พิกัดสิ้นสุดปัญหา</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr align="center">
                                            <td width="10%">X(UTM)</td>
                                            <td>{{$data[0]->blockageLocation->blk_start_utm->getLat()}}</td>
                                            <td width="10%">Y(UTM)</td>
                                            <td>{{$data[0]->blockageLocation->blk_start_utm->getLng()}}</td>
                                            <td width="10%">X(UTM)</td>
                                            <td>{{$data[0]->blockageLocation->blk_end_utm->getLat()}}</td>
                                            <td width="10%">Y(UTM)</td>
                                            <td>{{$data[0]->blockageLocation->blk_end_utm->getLng()}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered" style="margin-top:1px;">
                                    <thead>
                                        <tr>
                                            <td colspan="2" class="text-center" style="background-color:#C0C0C0">หน้าตัดลำน้ำที่เกิดปัญหา</td>
                                            <td colspan="4"  class="text-center" style="background-color:#C0C0C0">กว้าง (เมตร)</td>
                                            <td colspan="4"  class="text-center" style="background-color:#C0C0C0">ลึก (เมตร)</td>
                                            <td colspan="4"  class="text-center" style="background-color:#C0C0C0">ความชันตลิ่ง</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">หน้าตัดลำน้ำเดิมในอดีตก่อนเกิดปัญหา</td>
                                            <td colspan="4"  class="text-center" >{{ checkZero($pastData->width)}}</td>
                                            <td colspan="4"  class="text-center" >{{checkZero($pastData->depth) }}</td>
                                            <td colspan="4"  class="text-center" >{{ checkZero($pastData->slop) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">หน้าตัดลำน้ำก่อนถึงที่เกิดปัญหา</td>
                                            <td colspan="4"  class="text-center" >{{ checkZero($current_start->width) }}</td>
                                            <td colspan="4"  class="text-center" >{{ checkZero($current_start->depth) }}</td>
                                            <td colspan="4"  class="text-center" >{{checkZero($current_start->slop) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="14">หน้าตัดที่แคบที่สุดของช่วงที่เกิดปัญหา</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> - ทางน้ำเปิด</td>
                                            <td colspan="4"  class="text-center">{{ checkZero($current_narrow_new->waterway->width )}} </td>
                                            <td colspan="4"  class="text-center">{{ checkZero($current_narrow_new->waterway->depth) }}</td>
                                            <td colspan="4"  class="text-center">{{ checkZero($current_narrow_new->waterway->slop) }} </td>
                                        </tr>

                                        <tr>
                                            <td rowspan="2" colspan="2"> - สะพาน</td>
                                            <td rowspan="2" colspan="4"  class="text-center">{{ checkZero($current_brigde->width)}} </td>
                                            <td rowspan="2" colspan="4"  class="text-center">{{ checkZero($current_brigde->depth)}}</td>
                                            <td colspan="2" >ความยาวช่องตอม่อ</td>
                                            <td  class="text-center">{{ checkZero($current_brigde->len)}}</td>
                                            <td  class="text-center">เมตร</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"  >จำนวนตอม่อ</td>
                                            <td  class="text-center">{{ checkZero($current_brigde->num)}}</td>
                                            <td  class="text-center">ช่อง</td>
                                        </tr>

                                        <tr>
                                            <td rowspan="2"> - กรณีท่อลอด</td>
                                            <td>ท่อกลม</td>
                                            <td colspan="2"> เส้นผ่านศูนย์กลาง</td>
                                            <td class="text-center"> {{ checkZero($current_narrow_new->round->diameter)}} </td> 
                                            <td>เมตร</td>
                                            <td colspan="2"> ยาว </td>
                                            <td class="text-center"> {{ checkZero($current_narrow_new->round->len) }} </td>
                                            <td> เมตร</td>
                                            <td colspan="2"> จำนวนท่อ </td>
                                            <td class="text-center"> {{ checkZero($current_narrow_new->round->num) }} </td>
                                            <td> ช่อง</td>
                                        </tr>
                                        <tr>
                                            <td>ท่อเหลี่ยม</td>
                                            <td>กว้าง </td>
                                            <td class="text-center">{{ checkZero($current_narrow_new->square->width) }}  </td>
                                            <td class="text-center">เมตร</td>
                                            <td>สูง </td>
                                            <td class="text-center"> {{ checkZero($current_narrow_new->square->high)}} </td>
                                            <td class="text-center"> เมตร</td>
                                            <td>ยาว </td>
                                            <td class="text-center"> {{ checkZero($current_narrow_new->square->len)}} </td>
                                            <td class="text-center"> เมตร</td>
                                            <td>จำนวนท่อ </td>
                                            <td class="text-center">{{ checkZero($current_narrow_new->square->num)}}  </td>
                                            <td class="text-center">ช่อง</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> - อื่นๆ</td>
                                            <td colspan="12"> {{ checkZero($current_narrow_new->other->detail) }} </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">หน้าตัดลำน้ำด้านท้ายน้ำหลังช่วงที่เกิดปัญหา</td>
                                            <td class="text-center" colspan="4">{{ checkZero($current_end->width)  }}</td>
                                            <td class="text-center" colspan="4">{{ checkZero($current_end->depth)}} </td>
                                            <td class="text-center" colspan="4">{{ checkZero($current_end->slope) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table  class="table table-borderless" >
                                        <tr>
                                            <td colspan="2">ความยาวของช่วงลำน้ำที่เกิดปัญหา เป็นจุดระยะ  {{checkZero($data[0]->blk_length_type)}} </td>
                                            <td >การดาดผิวของลำน้ำ {{checkZero($data[0]->blk_surface)}}</td>
                                            <td >วัสดุที่ใช้ดาดผิวของลำน้ำ {{checkZero($data[0]->blk_surface_detail)}}</td>
                                        </tr>
                                        <tr>
                                            <td width=20%>ลักษณะความเสียหาย  {{ checkDamage($damageData->flood,$damageData->waste,$damageData->other->level)}}</td>
                                            <td width=30%>ระดับ {{checklevel($damageData->flood,$damageData->waste,$damageData->other->level)}}</td>
                                            <td>ความถี่ที่เกิดความเสียหาย  {{checkZero($data[0]->damage_frequency)}} </td>

                                            <?php 
                                                $level=checklevel($damageData->flood,$damageData->waste,$damageData->other->level);
                                            ?>
                                            <td>ระดับความเสี่ยง {{checkRisk($level,$data[0]->damage_frequency)}}</td>
                                        </tr>
                                </table>
                                <table  class="table table-borderless" width=90% >
                                        <tr>
                                            <td colspan="3">สาเหตุของการกีดขวางลำน้ำ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" width=15%> &nbsp;&nbsp;&nbsp;> โดยธรรมชาติ</td>
                                            <td colspan="2">{{checkZero($nut)}}</td>
                                        </tr>
                                        <tr>
                                            <td  width=15% valign="top"> &nbsp;&nbsp;&nbsp;> โดยมนุษย์</td>
                                            <td width=3% valign="top"> จาก</td>
                                            <td >
                                                <?php 
                                                    $n=0;
                                                        for($i=0;$i<5;$i++){
                                                            if($hum[$i]!=NULL){
                                                                if($i<2){
                                                                    echo $hum[$i]."<br>";
                                                                }else{
                                                                    echo $hum[$i]." ";
                                                                }
                                                                
                                                            }else{
                                                                $n=$n+1;
                                                            }
                                                        }
                                                    if($n==5){
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                </table>
            
                                <table class="table table-borderless" width=90% >
                                    <tr>
                                        <td width=20%>ระดับการกีดขวาง {{checkProbleLevel($problem[0]->prob_level)}}</td>
                                        <td>คิดเป็น {{checkZero($problem[0]->prob_level)}}</td>
                                        <td>หน่วยงานการดำเนินการแก้ไข {{checkZero($solution_id[0]->responsed_dept)}}</td>
                                    </tr>
                                        <tr>
                                            <td>โดยวิธี {{$solution_id[0]->sol_how}}</td>
                                            <td colspan="2">ผลการดำเนินการ {{checkZero($solution_id[0]->result)}} </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" valign="top">สภาพในปัจจุบันของโครงการที่แก้ไขปัญหา {{checkPlan($project_id[0]->proj_status,$project_id[0]->proj_year,$project_id[0]->proj_char,$project_id[0]->proj_budget)}}</td>
                                        </tr>
                                </table>
                                <table class="table table-bordered" width="400px;">
                                   
                                    <tbody>
                                        <tr>
                                            <td class="text-center" style="background-color:#C0C0C0" width=50%;>สภาพปัญหาการกีดขวางทางน้ำ</td>
                                            <td class="text-center" style="background-color:#C0C0C0" width=50%;>แนวทางและวิธีการแก้ไขปัญหาเบื้องต้น</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" valign="top">
                                                <p class="test2">{{checkZero($expert[0]->exp_problem)}} </p>
                                            </td>
                                            <td>
                                                <p class="test1">
                                                    ข้อมูลพื้นที่รับน้ำของตำแหน่งที่เกิดปัญหา  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  <br>
                                                    <?php 
                                                        if($expert[0]->exp_a25==0){ 
                                                            echo "A = ".checkZero($expert[0]->exp_area)." ตารางกิโลเมตร&nbsp;";
                                                            echo "L0 = ".checkZero($expert[0]->exp_L0)." กิโลเมตร&nbsp;";
                                                            echo "H = ".checkZero($expert[0]->exp_H)." เมตร&nbsp;";
                                                            echo "C = ".checkZero($expert[0]->exp_C)."<br>";
                                                            echo "tc = ".checkZero($expert[0]->exp_tc)." ชั่วโมง&nbsp;&nbsp;";
                                                            echo "I = ".checkZero($expert[0]->exp_I)." มิลลิเมตร&nbsp;";
                                                            echo "อัตราการไหลสูงสุด = ".checkZero($expert[0]->exp_maxflow)." m<sup>3</sup>/s &nbsp;<br>";
                                                            echo "Return period = ".checkZero($expert[0]->exp_returnPeriod)." ปี";
                                                        }else{
                                                            echo "A = ".checkZero($expert[0]->exp_area)." ตารางกิโลเมตร&nbsp;";
                                                            echo "อัตราการไหลสูงสุด = ".checkZero($expert[0]->exp_maxflow)." m<sup>3</sup>/s &nbsp;<br>";
                                                            echo "Return period = ".checkZero($expert[0]->exp_returnPeriod)." ปี";
                                                        }
                                                    ?> 
                                                        {{-- A = {{checkZero($expert[0]->exp_area)}} ตารางกิโลเมตร&nbsp;
                                                        L0 = {{checkZero($expert[0]->exp_L0)}} กิโลเมตร&nbsp; 
                                                        H = {{checkZero($expert[0]->exp_H)}} เมตร&nbsp;
                                                        C = {{checkZero($expert[0]->exp_C)}} <br>
                                                        tc = {{checkZero($expert[0]->exp_tc)}} ชั่วโมง&nbsp; 
                                                        I = {{checkZero($expert[0]->exp_I)}} มิลลิเมตร&nbsp;&nbsp; 
                                                        อัตราการไหลสูงสุด = {{checkZero($expert[0]->exp_maxflow)}} m<sup>3</sup>/s &nbsp;<br>
                                                        Return period =  {{checkZero($expert[0]->exp_returnPeriod)}} ปี --}}
                                                   
                                                </p>
                                            
                                            </td>
                                        
                                        
                                        </tr>
                                       
                                        <tr>
                                            <td>  <p class="test2"> {{checkZero($expert[0]->exp_solution)}} {{checkW($expert[0]->exp_slope)}} </p></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered" width="400px;"  style="margin-top:1px;">
                                    <thead>
                                        
                                        <!-- <tr>
                                            <td align="center"><div style="margin-top:10px;"><img src="https://survey.crflood.com/{{($expert[0]->exp_pixmap)  }}" width=180px;></div></td>
                                            <td align="center"> 
                                                 <div style="margin-top:10px;"><img src="https://survey.crflood.com/{{($expert[0]->exp_pix1)  }}" width=180px;></div>
                                                <div style="margin-top:5px;margin-bottom:10px;"><img src="https://survey.crflood.com/{{($expert[0]->exp_pix2) }}" width=180px;></div>
                                            </td>
                                        </tr> -->
                                        <?php 
                                            
                                            if(!empty($expert[0]->exp_google_map)){ ?>
                                                <tr>
                                                    <td colspan="3" style="background-color:#C0C0C0">รูปภาพประกอบ</td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td align="center"><div style="margin-top:10px;"><img src="https://survey.crflood.com/{{($expert[0]->exp_pixmap)  }}" width=140px;></div></td>
                                                    <td align="center"><div style="margin-top:-50px;"><img src="https://survey.crflood.com/images/map/{{($data[0]->blk_code)}}.JPG" width=200px;></div></td>
                                                    <td align="center"> 
                                                        <div style="margin-top:10px;"><img src="https://survey.crflood.com/{{($expert[0]->exp_pix1)  }}" width=160px;></div>
                                                        <div style="margin-top:5px;margin-bottom:5px;"><img src="https://survey.crflood.com/{{($expert[0]->exp_pix2) }}" width=160px;></div>
                                                    </td>
                                                </tr>
                                        <?php  }else{ ?>
                                                <tr>
                                                    <td colspan="2" style="background-color:#C0C0C0">รูปภาพประกอบ</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td align="center"><div style="margin-top:10px;"><img src="https://survey.crflood.com/{{($expert[0]->exp_pixmap)  }}" width=140px;></div></td>
                                                        <td align="center"> 
                                                            <div style="margin-top:10px;"><img src="https://survey.crflood.com/{{($expert[0]->exp_pix1)  }}" width=160px;></div>
                                                            <div style="margin-top:5px;margin-bottom:5px;"><img src="https://survey.crflood.com/{{($expert[0]->exp_pix2) }}" width=160px;></div>
                                                        </td>
                                                    </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>
                               
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/main-js.js') }}"></script>
<script src="{{ asset('js/shortable-nestable/Sortable.min.js') }}"></script>
<script src="{{ asset('js/shortable-nestable/sort-nest.js') }}"></script>
<script src="{{ asset('js/shortable-nestable/jquery.nestable.js') }}"></script>

<script src="{{ asset('js/location.js') }}"></script>
<script src="{{ asset('js/showhide.js') }}"></script>
<script src="{{ asset('js/chooseLocation.js') }}"></script>
<script src="{{ asset('js/validateNewForm.js') }}"></script>


</body>
</html>
