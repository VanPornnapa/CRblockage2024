<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
    <!-- Styles -->
    <style>
        html,
        body {
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
            font-size: 16px;
        }

        .links>a {
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

<body onload="checkHumStr('{{ $blk_problem_detail[$id]   }}'); loadRadioButton('{{ $uid }}'); loadProjStatus('{{ $blk_project->proj_status }}');">

    <div class="flex-center position-ref full-height">
    

        <div class="content">
            <div class="title m-b-md">
                <img src="{{ asset('images/logo/head_form.png') }}" width="100%">
            </div>

    

            <div class="title m-b-md">

                {{-- <form action="{{route('form.storeform')}}" method="get"> --}}
                <form action="{{route('form.storeform')}}" method="get">
                    <table class="table table-borderless">
                        <tr>
                            <th colspan="3">ลำน้ำที่เกิดปัญหาการกีดขวางทางน้ำ</th>
                        </tr>
                        <tr>
                            <th>ชื่อลำน้ำ : </th>
                            <td><input type="text" id="river_name" name="river_name" value='{{ $river[$id]->river_name ?? "" }}' placeholder="-- กรอกชื่อ --" required ></td>

                        </tr>
                        <tr>
                            <th align="right"> เป็นสาขาของแม่น้ำ :</th>
                            <td><input type="text" id="river_main" name="river_main" value='{{ $river[$id]->river_main ?? "" }}' placeholder="-- กรอกชื่อ --" required></td>
                        </tr>
                        <tr>
                            <th>ประเภทลำน้ำ : </th>
                            <td>
                                <div id="app">
                                    <river-component :river_type='{!! json_encode($river[$id]->river_type) !!}'></river-component>
                                </div>

                            </td>
                        </tr>
                    </table>
                    <br>
                    {{-- 1 ลักษณะทั่วไป--}}
                    <span class="number">1</span>ลักษณะทั่วไป

                    <table class="table table-borderless">

                        {{-- 1.1 --}}
                        <tr>
                            <th colspan="2">1.1 ที่ตั้งของช่วงเวลาที่เกิดปัญหา </th>
                        </tr>
                        <tr>
                            <td align="right">จังหวัด : </td>
                            <td colspan="2">
                                <select id="blk_province" name="blk_province" value=''>
                                    <option value="chiangrai">เชียงราย</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            
                            <td align="right">อำเภอ : </td>
                            <td colspan="2">
                                <select id='blk_district' name='blk_district' required>
                                    <option value='0'>-- เลือกอำเภอ --</option>

                                    <!-- Read district -->

                                    @foreach($districtData['data'] as $village)
                                    <option value='{{ $village->vill_district }}'>{{ $village->vill_district  }}</option>
                                    @endforeach

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">ตำบล : </td>
                            <td colspan="2">
                                <select id="blk_tumbol" name="blk_tumbol" required>
                                    <option value='0'>-- เลือกตำบล --</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">หมู่บ้าน : </td>
                            <td colspan="2">
                                <select id="blk_village" name="blk_village" required>
                                    <option value='0'>-- เลือกหมู่บ้าน --</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <table style="margin-left:10px;" class="table table-borderless">
                        <tr>
                            <td colspan="5">พิกัดเริ่มต้นของปัญหา : </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="text" id="latstart" name="latstart" placeholder="Latitude" value='{{ $obj[$id]->blockage_location->blk_start_location->coordinates[0] ?? "" }}' required ></td>
                            <td><input type="text" id="longstart" name="longstart" placeholder="Longitude" value='{{ $obj[$id]->blockage_location->blk_start_location->coordinates[1] ?? "" }}' required ></td>
                            <td align="right"> <button type="button" onclick="getStLocation()">Location</button>
                        </tr>
                        <tr>
                            <td colspan="5">พิกัดสิ้นสุดของปัญหา : </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="text" id="latend" name="latend" placeholder="Latitude" value='{{ $obj[$id]->blockage_location->blk_end_location->coordinates[0] ?? "" }}' required ></td>
                            <td><input type="text" id="longend" name="longend" placeholder="Longitude" value='{{ $obj[$id]->blockage_location->blk_end_location->coordinates[1] ?? "" }}' required ></td>
                            <td align="right"><button type="button" onclick="getFinLocation()">Location</button>
                            <td>
                        </tr>

                    </table>
                    {{-- 1.2 --}}
                    <table class="table table-borderless">
                        <tr>
                            <th colspan="4">1.2 หน้าตัดของลำน้ำเดิมในอดีตก่อนเกิดปัญหา </th>
                        </tr>
                        <tr>
                            <td width="9%"></td>
                            <td><input type="text" id="cross_width_past" name="past[width]" placeholder="กว้าง (ม.)" value='{{ $blk_crossection_past->width ?? "" }}' required ></td>
                            <td><input type="text" id="cross_depth_past" name="past[depth]" placeholder="ลึก (ม.)" value='{{ $blk_crossection_past->depth ?? "" }}' required ></td>
                            <td><input type="text" id="cross_slope_past" name="past[slop]" placeholder="ความลาดชันตลิ่ง" value='{{ $blk_crossection_past->slop ?? "" }}' required ></td>
                        </tr>
                    </table>
                    {{-- 1.3 --}}
                    <table class="table table-borderless">

                        <tr>
                            <th colspan="4">1.3 หน้าตัดของช่วงลำน้ำในปัจจุบันที่เกิดปัญหา </th>
                        </tr>
                        <tr>

                            <td style="padiing-left:20px;" colspan="3">1.3.1. หน้าตัดของลำน้ำ<b>ก่อน</b>ถึงช่วงที่เริ่มที่เกิดปัญหา </td>
                        </tr>
                        <tr>
                            <td width="9%"></td>
                            <td><input type="text" id="cross_width_now" name="current_start[width]" placeholder="กว้าง (ม.)" value='{{ $blk_crossection_current_start->width ?? "" }}' required ></td>
                            <td><input type="text" id="cross_depth_now" name="current_start[depth]" placeholder="ลึก (ม.)" value='{{ $blk_crossection_current_start->depth ?? "" }}' required ></td>
                            <td><input type="text" id="cross_slope_now" name="current_start[slop]" placeholder="ความลาดชันตลิ่ง" value='{{ $blk_crossection_current_start->slop ?? "" }}' required ></td>
                        </tr>
                        <tr>

                            <td colspan="3" style="padiing-left:20px;">1.3.2. หน้าตัดของลำน้ำที่<b>แคบที่สุด</b>ในช่วงของลำน้ำที่เกิดปัญหา </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="radio" id="xsection_status" name="current_narrow[type]" value="waterway" required onclick="xsectionRadioValidation()"/><label for="xsection_status"> ทางน้ำเปิด </label></td>
                            <td><input type="radio" id="xsection_status2" name="current_narrow[type]" value="culvert" required onclick="xsectionRadioValidation()"/><label for="xsection_status2">ท่อลอด</label></td>
                            <td><input type="radio" id="xsection_status3" name="current_narrow[type]" value="other" required onclick="xsectionRadioValidation()"/><label for="xsection_status3">อื่นๆ</label></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div id="showwaterway" class="myDiv" style="background-color:#fff;">
                                    <table align="center">
                                        <tr>
                                            <td><input type="text" id="cross_width_narrow" name="current_narrow[width]" placeholder="กว้าง (ม.)" value='{{ $blk_crossection_current_narrow->width ?? "" }}' ></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="cross_depth_narrow" name="current_narrow[depth]" placeholder="ลึก (ม.)" value='{{ $blk_crossection_current_narrow->depth ?? "" }}' ></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="cross_slope_narrow" name="current_narrow[slop]" placeholder="ความลาดชันตลิ่ง" value='{{ $blk_crossection_current_narrow->slop ?? "" }}' ></td>
                                        </tr>

                                    </table>
                                </div>
                                <div id="showculvert" class="myDiv" style="background-color:#fff;">
                                    <table align="center">
                                        <tr> disabled

                                            <td><input type="radio" id="culvert_round" value="round" name="current_narrow[culvert]" onclick="culvertValidate()"><label for="culvert_round">ท่อกลม</label></td>
                                            <td><input type="number" id="diameter_culvert" name="current_narrow[culvert][diameter]" placeholder="เส้นผ่าศูนย์กลาง (ม.)" value='{{ $blk_crossection_current_narrow->culvert->diameter ?? "" }}'  disabled></td>

                                        </tr>
                                        <tr>

                                            <td width="20%"><input type="radio" id="culvert_square" value="square" name="current_narrow[culvert]" onclick="culvertValidate()"><label for="culvert_square">ท่อเหลี่ยม</label></td>
                                            <td width="40%"><input type="number" id="width_culvert" name="current_narrow[culvert][width]" placeholder="กว้าง (ม.)" value='{{ $blk_crossection_current_narrow->culvert->width ?? "" }}' disabled></td>

                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td width="15%"><input type="number" id="high_culvert" name="current_narrow[culvert][high]" placeholder="สูง (ม.)" value='{{ $blk_crossection_current_narrow->culvert->high ?? "" }}'  disabled></td>

                                        </tr>
                                    </table>

                                </div>
                                <div id="showother" class="myDiv" style="background-color:#fff;">
                                    <table align="center">
                                        <tr>
                                            <td width="5%">
                                            <td>
                                            <td><textarea rows="5" cols="100" id="current_narrow" name="current_narrow[culvert][other]" placeholder="ระบุลักษณะ" value='{{ $blk_crossection_current_narrow->culvert->other ?? "" }}' ></textarea></td>
                                        </tr>

                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>

                            <td colspan="3" style="padiing-left:20px;">1.3.3. หน้าตัดของลำน้ำ<b>ท้ายน้ำ</b>หลังช่วงที่เกิดปัญหา </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="number" id="cross_width_end" name="current_end[width]" placeholder="กว้าง (ม.)" value='{{ $blk_crossection_current_end->width ?? "" }}' required ></td>
                            <td><input type="number" id="cross_depth_end" name="current_end[depth]" placeholder="ลึก (ม.)" value='{{ $blk_crossection_current_end->depth ?? "" }}' required ></td>
                            <td><input type="number" id="cross_slope_end" name="current_end[slope]" placeholder="ความลาดชันตลิ่ง" value='{{ $blk_crossection_current_end->slope ?? "" }}' required ></td>
                        </tr>
                    </table>
                    {{-- 1.5 --}}
                    <table>
                        <tr>
                            <th colspan="3">1.4 ความยาวของช่วงลำน้ำที่เกิดปัญหา </th>
                        </tr>
                    </table>
                    <table align="center" width="90%">

                        <tr>
                            <td><input type="radio" id="blk_length1" value="น้อยกว่า 10 เมตร" name="blk_length" required><label for="blk_length1">น้อยกว่า 10 เมตร. </label></td>
                            <td><input type="radio" id="blk_length2" value="10 -1000 เมตร" name="blk_length" required onclick="causeOfDamageValidate()"><label for="blk_length2"> 10 -1000 เมตร.</label></td>
                            <td><input type="radio" id="blk_length3" value="มากกว่า 1 กิโลเมตร" name="blk_length" required onclick="causeOfDamageValidate()"><label for="blk_length3">มากกว่า 1 กิโลเมตร</label></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="padding-left:30px;">
                                <select id="blk_length" name="blk_length" class="blk_length_div" value='{{ $obj[$id]->blk_length ?? "" }}'>
                                    <option value="">-- ระบุระยะ --</option>
                                    <option value="10-50 เมตร">10-50 เมตร</option>
                                    <option value="50-100 เมตร">50-100 เมตร</option>
                                    <option value="100-200 เมตร">100-200 เมตร</option>
                                    <option value="200-400 เมตร">200-400 เมตร</option>
                                    <option value="400-600 เมตร">400-600 เมตร</option>
                                    <option value="600-800 เมตร">600-800 เมตร</option>
                                    <option value="800-1000 เมตร">800-1000 เมตร</option>
                                </select>
                            </td>
                            <td style="padding-left:30px;"><input type="text" id="blk_length_1k" name="blk_length_1k" class="blk_length_div" placeholder="-- ระบุระยะมากกว่า 1 กม.--" value='{{ $obj[$id]->blk_length ?? "" }}'></td>
                        </tr>

                    </table>
                    {{-- 1.6 --}}
                    <table class="table table-borderless">
                        <tr>
                            <th>1.5 การดาดผิวของลำน้ำ </th>
                            <td><input type="radio" id="blk_surface1" value="ไม่ดาดผิว" name="blk_surface" required><label for="blk_surface1">ไม่ดาดผิว</label></td>
                            <td><input type="radio" id="blk_surface2" value="ดาดผิว" name="blk_surface" required><label for="blk_surface2">ดาดผิว</label></td>
                            <td></td>
                        </tr>
                        <tr>

                            <td align="right">วัสดุที่ดาดผิวของลำน้ำ : </td>
                            <td colspan="2"><input type="text" id="blk_surface_detail" name="blk_surface_detail" placeholder="ระบุวัสดุ" value='{{ $obj[$id]->blk_surface_detail ?? "" }}' required ></td>

                        </tr>

                    </table>
                    {{-- 2 ความเสียหาย --}}
                    <span class="number">2</span>ความเสียหายที่เคยเกิดขึ้น
                    <table>
                        <tr>
                            <th colspan="6">2.1 ลักษณะของความเสียหาย </th>
                        </tr>
                    </table>
                    <table align="center" width="70%">
                        <tr>

                            <td colspan="2"><input type="checkbox" id="damage_type1" value="น้ำท่วม" name="damage_type" onclick="damageLevelRadioValidation()"><label for="damage_type1">น้ำท่วม</label></td>
                            <td><input type="radio" id="damageflood1" name="damage_level[flood]" value="low" disabled/> <label for="damageflood1">น้อย</label></td>
                            <td><input type="radio" id="damageflood2" name="damage_level[flood]" value="medium" disabled/><label for="damageflood2"> ปานกลาง</label></td>
                            <td><input type="radio" id="damageflood3" name="damage_level[flood]" value="high" disabled/> <label for="damageflood3">มาก</label></td>
                        </tr>
                        <tr>

                            <td colspan="2"><input type="checkbox" id="damage_type2" value="น้ำเสีย" name="damage_type" onclick="damageLevelRadioValidation()"><label for="damage_type2">น้ำเสีย</label></td>
                            <td><input type="radio" id="damagewaste1" name="damage_level[waste]" value="low" disabled/><label for="damagewaste1"> น้อย </label></td>
                            <td><input type="radio" id="damagewaste2" name="damage_level[waste]" value="medium" disabled/><label for="damagewaste2"> ปานกลาง </label></td>
                            <td><input type="radio" id="damagewaste3" name="damage_level[waste]" value="high" disabled/><label for="damagewaste3"> มาก </label></td>
                        </tr>
                        <tr>
                            <td width="10%"><input type="checkbox" id="damage_type3" value="อื่นๆ" name="damage_type" onclick="damageLevelRadioValidation()"><label for="damage_type3">อื่นๆ</label></td>
                            <td width="20%"><input type="text" name="damage_level[other][detail]" placeholder="ระบุ" value='{{ $blk_damage_level->other->detail ?? "" }}'></td>
                            <td><input type="radio" id="damageother1" name="damage_level[other][level]" value="low" disabled/><label for="damageother1"> น้อย </label></td>
                            <td><input type="radio" id="damageother2" name="damage_level[other][level]" value="medium" disabled/> <label for="damageother2">ปานกลาง </label></td>
                            <td><input type="radio" id="damageother3" name="damage_level[other][level]" value="high" disabled/> <label for="damageother3">มาก </label></td>
                        </tr>
                    </table>
                    <table>

                        <tr>
                            <th colspan="5">2.2 ความถี่ที่เกิดความเสียหาย </th>
                        </tr>
                    </table>
                    <br>
                    <table align="center" width="80%">
                        <tr>
                            <td></td>
                            <td colspan="2"><input type="radio" id="damage_frequency1" value="มากกว่า 4 ปีครั้ง" name="damage_frequency" required><label for="damage_frequency1">มากกว่า 4 ปีครั้ง </label></td>
                            <td><input type="radio" id="damage_frequency2" value="2-4 ปีครั้ง" name="damage_frequency" required><label for="damage_frequency2">2-4 ปีครั้ง </label></td>
                            <td><input type="radio" id="damage_frequency3" value="ทุกปี" name="damage_frequency" required> <label for="damage_frequency3">ทุกปี </label></td>

                        </tr>
                    </table>
                    {{-- ข้อ 3 สภาพปัญหา --}}
                    <span class="number">3</span>สภาพปัญหา
                    <table class="table table-borderless">
                        <tr>
                            <th colspan="6">3.1 สาเหตุการกีดขวางลำน้ำโดย (เลือกได้หลายข้อ) </th>
                        </tr>
                    </table>
                    <table align="center" width="90%">
                        {{-- ธรรมชาติ --}}
                        <tr>

                            <td colspan="2">ธรรมชาติ</td>
                        </tr>
                        <tr>

                            <td><input type="checkbox" id="nat_erosion" name="nat_erosion" value='{{ $blk_problem_detail[$id]->nat_erosion ?? "" }}' /> <label for="nat_erosion"> ตลิ่งพัง, การกัดเซาะ </label></td>
                            <td><input type="checkbox" id="nat_shoal" name="nat_shoal" value='{{ $blk_problem_detail[$id]->nat_shoal ?? "" }}' /><label for="nat_shoal"> การทับถมของตะกอน (ลำน้ำตื้นเขิน)</label></td>


                        </tr>
                        <tr>

                            <td><input type="checkbox" id="nat_missing" name="nat_missing" value='{{ $blk_problem_detail[$id]->nat_missing ?? "" }}' /><label for="nat_missing">ลำน้ำขาดหาย</label></td>
                            <td><input type="checkbox" id="nat_winding" name="nat_winding" value='{{ $blk_problem_detail[$id]->nat_winding ?? "" }}' /> <label for="nat_winding">ลักษณะทางกายภาพของล้ำน้ำ </label></td>


                        </tr>
                        <tr>

                            <td><input type="checkbox" id="nat_weed" name="nat_weed" value='{{ $blk_problem_detail[$id]->nat_weed ?? "" }}' onclick="causeOfDamageValidate()"/> <label for="nat_weed"> วัชพืช </label></td>
                            <td><input type="text" id="nat_cause_5_detail" name="nat_weed_detail" placeholder="ระบุวัชพืช" value='{{ $blk_problem_detail[$id]->nat_weed_detail ?? "" }}'></td>
                        <tr>

                            <td><input type="checkbox" id="nat_other" name="nat_other" value='{{ $blk_problem_detail[$id]->nat_other ?? "" }}' onclick="causeOfDamageValidate()"/> <label for="nat_other"> อื่นๆ </label></td>
                            <td><input type="text" id="nat_cause_6_detail" name="nat_other_detail" placeholder="ระบุ" value='{{ $blk_problem_detail[$id]->nat_other_detail ?? "" }}' ></td>
                        </tr>
                        {{-- มนุษย์ --}}
                        <tr>
                            <td colspan="2">มนุษย์</td>
                        </tr>
                        {{-- สิ่งปลูกสร้าง --}}

                        <tr>

                            <td colspan="2"><input type="checkbox" id="hum_structure" name="hum_structure" value='{{ $blk_problem_detail[$id]->hum_structure ?? "" }}' onclick="damageLevelRadioValidation()" /><label for="hum_structure">สิ่งปลูกสร้าง</label></td>
                        </tr>
                        <tr>
                            <td style="padding-left:20px;" colspan="2"><input type="radio" id="hum_str_gov" name="hum_str_owner_type" value="ราชการ" onclick="causeOfDamageValidate()"/><label for="hum_str_gov">เป็นส่วนราชการ </label></td>

                        </tr>
                        <tr>
                            <td colspan="2">
                                <table align="center" width="85%">
                                    <tr>

                                        <td width="20%">&nbsp;&nbsp;ส่วนของอาคาร</td>
                                        <td width="10%"><input type="text" id="hum_stc_bld_num" name="hum_stc_bld_num" placeholder="ระบุ" value='{{ $blk_problem_detail[$id]->hum_stc_bld_num ?? "" }}' ></td>
                                        <td width="5%">หลัง</td>
                                        <td width="5%">&nbsp;&nbsp;รั้ว</td>
                                        <td width="10%"><input type="text" id="hum_stc_fence_num" name="hum_stc_fence_num" placeholder="ระบุ" value='{{ $blk_problem_detail[$id]->hum_stc_fence_num ?? "" }}' ></td>
                                        <td width="5%">หลัง</td>
                                        <td width="5%">&nbsp;&nbsp;อื่นๆ</td>
                                        <td width="20%"><input type="text" id="hum_str_other" name="hum_str_other" placeholder="ระบุ" value='{{ $blk_problem_detail[$id]->hum_str_other ?? "" }}' ></td>


                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left:20px;" colspan="2"><input type="radio" id="hum_str_bu" name="hum_str_owner_type" value="เอกชน" onclick="causeOfDamageValidate()" /><label for="hum_str_bu">เป็นสวนของเอกชนหรือส่วนบุคคล </label></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table align="center" width="85%">
                                    <tr>

                                        <td width="20%">&nbsp;&nbsp;ส่วนของอาคาร</td>
                                        <td width="10%"><input type="text" id="hum_stc_bld_num" name="hum_stc_bld_num" placeholder="ระบุ" value='{{ $blk_problem_detail[$id]->hum_stc_bld_num ?? "" }}' ></td>
                                        <td width="5%">หลัง</td>
                                        <td width="5%">&nbsp;&nbsp;รั้ว</td>
                                        <td width="10%"><input type="text" id="hum_stc_fence_num" name="hum_stc_fence_num" placeholder="ระบุ" value='{{ $blk_problem_detail[$id]->hum_stc_fence_num ?? "" }}' ></td>
                                        <td width="5%">หลัง</td>
                                        <td width="5%">&nbsp;&nbsp;อื่นๆ</td>
                                        <td width="20%"><input type="text" id="hum_str_other" name="hum_str_other" placeholder="ระบุ" value='{{ $blk_problem_detail[$id]->hum_str_other ?? "" }}' ></td>


                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom:20px;"></td>
                        </tr>
                        {{-- infa --}}
                        <tr>
                            <td colspan="2"><input type="checkbox" name="hum_type" id="huminfa" value="ระบบสาธารณูปโภค" /> <label for="huminfa"> ระบบสาธารณูปโภค (ถนน ท่อลอด สะพานและอื่นๆ) </label></td>
                        </tr>
                        <tr>
                            <td style="padding-left:20px;"><input type="checkbox" id="hum_road" name="hum_road" value='{{ $blk_problem_detail[$id]->hum_road ?? "" }}' /><label for="hum_road">ถนนขวางทางน้ำ </label></td>
                            <td><input type="checkbox" id="hum_smallconvert" name="hum_smallconvert" value='{{ $blk_problem_detail[$id]->hum_smallconvert ?? "" }}' /><label for="hum_smallconvert">ท่อลอดถนนที่ตัดลำน้ำมีขนาดเล็กเกินไประบายน้ำหลากไม่ทัน</label></td>
                        </tr>
                        <tr>
                            <td style="padding-left:20px;"><input type="checkbox" id="hum_road_paralel" name="hum_road_paralel" value='{{ $blk_problem_detail[$id]->hum_road_paralel ?? "" }}' /> <label for="hum_road_paralel">ถนนขนานลำน้ำสร้างกินพื้นที่ลำน้ำ </label></td>
                            <td><input type="checkbox" id="hum_replaced_convert" name="hum_replaced_convert" value='{{ $blk_problem_detail[$id]->hum_replaced_convert ?? "" }}' /><label for="hum_replaced_convert">วางท่อตามแนวลำน้ำทดแทนลำน้ำเดิม</label></td>
                        </tr>
                        <tr>
                            <td style="padding-left:20px;" colspan="2"> <input type="checkbox" id="hum_bridge_pile" name="hum_bridge_pile" value='{{ $blk_problem_detail[$id]->hum_bridge_pile ?? "" }}' /><label for="hum_bridge_pile">สะพานมีหน้าตัดแคบเกินไป หรือมีต่อม่อมากเกินไปในช่วงฤดูน้ำหลากระบายไม่ทัน</label></td>
                        </tr>
                        <tr>
                            <td style="padding-bottom:20px;"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="checkbox" id="hum_soil_cover" name="hum_soil_cover" value='{{ $blk_problem_detail[$id]->hum_soil_cover ?? "" }}' /><label for="hum_soil_cover">การถมดิน </label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="checkbox" id="hum_trash" name="hum_trash" value='{{ $blk_problem_detail[$id]->hum_trash ?? "" }}' /><label for="hum_trash">สิ่งปฏิกูล </label></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" id="hum_other" name="hum_other" value='{{ $blk_problem_detail[$id]->hum_other ?? "" }}' onclick="causeOfDamageValidate()"/><label for="hum_other">อื่นๆ </label></td>
                            <td colspan="2"><input type="text" name="hum_other_detail" id="hum_other_detail" placeholder="ระบุ" /></td>
                        </tr>
                    </table>
                    {{-- 3.2 --}}









                    <table class="table table-borderless">

                        <tr>
                            <th colspan="6">3.2 ระดับกีดขวาง (เปอร์เซ็นต์คิดโดนพื้นที่ที่ถูกกีดขวางต่อพื้นที่ลำน้ำเดิม) </th>
                        </tr>

                        <tr>
                            <td></td>
                            <td colspan="2"><input type="radio" id="problevel1" name="prob_level" value="1-30%" required/> <label for="problevel1">น้อย (1-30%) </label></td>
                            <td><input type="radio" id="problevel2" name="prob_level" value="30-70%" required/><label for="problevel2">กลาง (30-70%)</label></td>
                            <td><input type="radio" id="problevel3" name="prob_level" value="มากกว่า 70%" required/><label for="problevel3">มาก (มากกว่า 70%)</label></td>
                        </tr>
                    </table>
                    {{-- ข้อ 4 การแก้ไข --}}
                    <span class="number">4</span> การดำเนินการแก้ไขของหน่วยงานท้องถิ่น และหน่วยงานที่รับผิดชอบ

                    <table align="center">
                        <tr>
                            <td style="padding-left:20px;" align="right">หน่วยงานที่รับผิดชอบ :</td>
                            <td colspan="6"><input type="text" id="responsed_dept" name="responsed_dept" value='{{ $obj[$id]->solution->responsed_dept }}' required ></td>
                        </tr>
                        <tr>

                            <td style="padding-left:40px;"><input type="radio" id="sol_how" name="sol_how" value="ปรับปรุงแก้ไขโดย" required onclick="solHowValidate()"><label for="sol_how">ปรับปรุงแก้ไขโดย </label></td>
                            <td colspan="4"><input type="text" id="responsed_dept2" name="responsed_dept2" value='{{ $obj[$id]->solution->sol_how ?? "" }}'></td>
                            <td>(วิธีแก้ไขหรือโครงการ)</td>
                        </tr>
                        <tr>

                            <td style="padding-left:40px;"><input type="radio" id="sol_how2" name="sol_how" value="เจรจา" required><label for="sol_how2">เจรจา</label></td>
                            <td colspan="2"><input type="radio" id="sol_how3" name="sol_how" value="ฟ้องร้อง" required<label for="sol_how3">ฟ้องร้อง</label></td>
                            <td colspan="2"><input type="radio" id="sol_how4" name="sol_how" value="รื้อถอน" required><label for="sol_how4">รื้อถอน</label></td>
                            <td colspan="2" 99><input type="radio" id="sol_how5" name="sol_how" value="ยังไม่ได้ดำเนินการ" required><label for="sol_how5">ยังไม่ได้ดำเนินการ</label></td>   
                        </tr>
                    </table>
                    {{-- 4.1 --}}
                    <table>
                        <tr>
                            <th colspan="6">4.1 ผลการดำเนินการ </th>
                        </tr>
                        <tr>
                            <td width="15%"></td>
                            <td colspan="2"><input type="radio" id="result_selector1" name="result_selector" value="ได้ผลดีสามารถแก้ไขปัญหาได้" required><label for="result_selector1">ได้ผลดีสามารถแก้ไขปัญหาได้</label></td>
                            <td colspan="2"><input type="radio" id="result_selector2" name="result_selector" value="ได้ผลดีพอสมควรแก้ไขปัญหาได้บางส่วน" required><label for="result_selector2">ได้ผลดีพอสมควรแก้ไขปัญหาได้บางส่วน</label></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"><input type="radio" id="result_selector3" name="result_selector" value="ได้ผลไม่ดีเท่าที่ควรแก้ไขปัญหาได้น้อย" required><label for="result_selector3"> ได้ผลไม่ดีเท่าที่ควรแก้ไขปัญหาได้น้อย</label></td>
                            <td colspan="2"><input type="radio" id="result_selector4" name="result_selector" value="ไม่ได้ผล" required><label for="result_selector4"> ไม่ได้ผล </label></td>
                        </tr>
                    </table>
                    {{-- 4.2 --}}
                    <table>
                        <tr>
                            <th colspan="6">4.2 สถานภาพปัจจุบันของโครงการที่แก้ไขปัญหาได้ </th>
                        </tr>

                    </table>
                    <table align="center" width="90%">
                        <tr>
                            <td><input type="radio" id="proj_status1" name="proj_status" value="plan" required  onclick="projStatusValidate()"/><label for="proj_status1"> อยู่ในแผน </label></td>
                            <td><input type="radio" id="proj_status2" name="proj_status" value="received" required  onclick="projStatusValidate()"/><label for="proj_status2">ได้รับงบประมาณแล้ว</label></td>
                            <td><input type="radio" id="proj_status3" name="proj_status" value="making" required/><label for="proj_status3">กำลังปรับปรุงก่อสร้าง</label> </td>
                            <td><input type="radio" id="proj_status4" name="proj_status" value="noplan" required/><label for="proj_status4">ยังไม่มีในแผน </label></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div id="showplan" class="myDiv">
                                    <table>
                                        <tr>
                                            <td>ลักษณะโครงการ: </td>
                                            <td><input type="number" id="proj_year" name="proj_year1" placeholder="ระบุปี พ.ศ" value='{{ $blk_project->proj_year ?? "" }}'></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="text" id="proj_name" name="proj_name1" placeholder="ระบุชื่อโครงการ" value='{{ $blk_project->proj_name ?? "" }}' ></td>
                                        </tr>
                                        <tr>
                                            <td>งบประมาณ: </td>
                                            <td><input type="number" id="proj_budget" name="proj_budget1" placeholder="ระบุงบประมาณ" value='{{ $blk_project->proj_budget ?? "" }}' ></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="showreceived" class="myDiv">
                                    <table>
                                        <tr>
                                            <td>ลักษณะโครงการ: </td>
                                            <td><input type="number" id="proj_year" name="proj_year2" placeholder="ระบุปี พ.ศ" value='{{ $blk_project->proj_year ?? "" }}' ></td>
                                        </tr>

                                        <tr>
                                            <td>งบประมาณ: </td>
                                            <td><input type="number" id="proj_budget" name="proj_budget2" placeholder="ระบุงบประมาณ" value='{{ $blk_project->proj_budget ?? "" }}' ></td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <br><br>
                    <button type="submit" class="butsummit"  onclick="validateCheckbox()">Submit</button>



                    


                </form>
            </div>
        </div>

    </div> {{--flex-center --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/location.js') }}"></script>
    <script src="{{ asset('js/showhide.js') }}"></script>
    <script src="{{ asset('js/chooseLocation.js') }}"></script>
    <script src="{{ asset('js/radioAndCheckbox.js') }}"></script>
    <script src="{{ asset('js/validateNewForm.js') }}"></script>
    {{-- <script>
                $(document).ready(function(){
                    $('input:checkbox').click(function() {
                        $('input:checkbox').not(this).prop('checked', false);
                    });
                });
        </script> --}}
</body>

</html>