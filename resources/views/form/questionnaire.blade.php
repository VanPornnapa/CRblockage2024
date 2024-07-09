<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
    

</head>
<body>
        <form action="{{route('form.Qnaire.store')}}" method="post">
     
            @csrf
            <h1>แบบสอบถาม</h1>             
            <label><span class="number">1</span>ลักษณะทั่วไป </label>
                <br><br>    
                <label>ประเภทลำน้ำที่เกิดปัญหากีดขวางทางน้ำ:</label>
               
                <table class="table table-borderless">
                        <tr>
                           <th scope="col" width="39%">แม่น้ำสายหลัก:</th>
                           <td colspan="2" width="56%">
                               <select id="river_main" name="river_main">
                                   <option value="แม่น้ำกก">แม่น้ำกก</option>
                                   <option value="แม่น้ำอิง">แม่น้ำอิง</option>
                                   <option value="แม่น้ำรวก">แม่น้ำรวก</option>
                               </select>
                           </td>
                           <td width="5%"></td>
                       </tr>
                       <tr>
                           <th scope="col">ลำน้ำ:</th>
                           <td colspan="2"><input type="text" id="river_name" name="river_name" placeholder="ชื่อลำน้ำ"></td>
                       </tr>
                       <tr>
                            <th scope="col">ประเภทลำน้ำ:</th>
                            <td colspan="2">
                                    <select id="river_type" name="river_type">
                                            <option value="Mainriver">แม่น้ำสายหลัก</option>
                                            <option value="Branchriver">แม่น้ำสาขา</option>
                                            <option value="Creek">ลำห้วย</option>
                                            <option value="Canal">คูคลอง</option>
                                            <option value="Ditch">เหมือง</option>
                                    </select>
                                </td>
                        </tr>
                 
                  
                   </table>
                <br><br>
                 <label>ที่ตั้งของช่วงลำน้ำที่เกิดปัญหา:</label>
                 <table class="table table-borderless">
                     <tr>
                        <th scope="col">จังหวัด:</th>
                        <td colspan="2">
                            <select id="blk_province" name="blk_province">
                                <option value="chiangrai">เชียงราย</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">อำเภอ:</th>
                        <td colspan="2">
                            <select id="blk_district" name="blk_district">
                                <option value="meueng">เมือง</option>
                                <option value="maechan">แม่จัน</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">ตำบล:</th>
                        <td colspan="2">
                            <select id="blk_tumbol" name="blk_tumbol">
                                <option value="meueng">เมือง</option>
                                <option value="maechan">แม่จัน</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">หมู่บ้าน:</th>
                        <td colspan="2">
                            <select id="blk_village" name="blk_village">
                                <option value="meueng">เมือง</option>
                                <option value="maechan">แม่จัน</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" colspan="3">พิกัดเริ่มต้นของปัญหา:</th>
                    </tr>
                    <tr>
                        <td><input type="text" id="latstart" name="latstart" placeholder="Latitude"></td>
                        <td><input type="text" id="longstart" name="longstart" placeholder="Longitude"></td>
                        <td><button onclick="getStLocation()">Location</button><td>
                    </tr>
                    <tr>
                        <th scope="col" colspan="3">พิกัดสิ้นสุดของปัญหา:</th>
                    </tr>
                    <tr>
                        <td><input type="text" id="latend" name="latend" placeholder="Latitude"></td>
                        <td><input type="text" id="longend" name="longend" placeholder="Longitude"></td>
                        <td><button onclick="getFinLocation()">Location</button><td>
                    </tr>
                </table>
 
                <label>หน้าตัดของลำน้ำเดิมโดยประมาณ (ก่อนเกิดปัญหา):</label>
                <table class="table table-borderless">
                    <tr>
                        <td><input type="text" id="cross_width_past" name="past[cross_width_past]" placeholder="กว้าง (ม.)"></td>
                        <td><input type="text" id="cross_depth_past" name="past[cross_depth_past]" placeholder="ลึก (ม.)"></td>
                        <td><input type="text" id="cross_slope_past" name="past[cross_slope_past]" placeholder="ความลาดชันตลิ่ง"></td>
                    </tr>
                </table>
                
                <label>หน้าตัดของลำน้ำปัจจุบัน (ที่เกิดปัญหา):</label>
                <table class="table table-borderless">
                    <tr>
                        <td colspan="3">หน้าตัดของลำน้ำก่อนถึงช่วงที่เริ่มเกิดปัญหา</td>
                    <tr>
                    <tr>
                        <td><input type="text" id="cross_width_now" name="current_start[cross_width_now]" placeholder="กว้าง (ม.)"></td>
                        <td><input type="text" id="cross_depth_now" name="current_start[cross_depth_now]" placeholder="ลึก (ม.)"></td>
                        <td><input type="text" id="cross_slope_now" name="current_start[cross_slope_now]" placeholder="ความลาดชันตลิ่ง"></td>
                    </tr>
                    <tr>
                        <td colspan="3">หน้าตัดของลำน้ำที่แคบสุดในช่วงของลำน้ำที่เกิดปัญหา</td>
                    <tr>
                    <tr>
                        <td><input type="text" id="cross_width_narrow" name="current_narrow[cross_width_narrow]" placeholder="กว้าง (ม.)"></td>
                        <td><input type="text" id="cross_depth_narrow" name="current_narrow[cross_depth_narrow]" placeholder="ลึก (ม.)"></td>
                        <td><input type="text" id="cross_slope_narrow" name="current_narrow[cross_slope_narrow]" placeholder="ความลาดชันตลิ่ง"></td>
                    </tr>
                    <tr>
                        <td>ท่อลอด : </td>
                        <td><input type="radio" id="culvert_round" value="round" name="culvert_type">ท่อกลม<br></td>
                        <td><input type="radio" id="culvert_square" value="square" name="culvert_type">ท่อเหลี่ยม</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>เส้นผ่าศูนย์กลาง (ม.)<br></td>
                        <td><input type="text" id="diameter_culvert" name="diameter" placeholder=""></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>กว้าง (ม.)<br></td>
                        <td><input type="text" id="width_culvert" name="culvert_width" placeholder=""></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>สูง (ม.)<br></td>
                        <td><input type="text" id="high_culvert" name="culvert_high" placeholder=""></td>
                    </tr>
                    <tr>
                        <td colspan="3">หน้าตัดของลำน้ำด้านท้ายน้ำหลังช่วงที่เกิดปัญหา</td>
                    <tr>
                    <tr>
                        <td><input type="text" id="cross_width_end" name="current_end[cross_width_end]" placeholder="กว้าง (ม.)"></td>
                        <td><input type="text" id="cross_depth_end" name="current_end[cross_depth_end]" placeholder="ลึก (ม.)"></td>
                        <td><input type="text" id="cross_slope_end" name="current_end[cross_slope_end]" placeholder="ความลาดชันตลิ่ง"></td>
                    </tr>
                </table>
                <label for="bio">ความยาวของช่วงลำน้ำที่เกิดปัญหา:</label>
                <table class="table table-borderless">
                    <tr>
                        <td colspan="3"><input type="radio" id="1" value="1" name="blk_length">เป็นจุดระยะไม่เกิน 10 เมตร</td>
                    </tr>
                    <tr>
                        <td><input type="radio" id="2" value="2" name="blk_length">10-1000 เมตร</td>
                        <td colspan="2"><input type="text" id="distance2" name="distance2" placeholder="ความยาวช่วงที่เกิดปัญหา (ม)"></td>
                    </tr>
                    <tr>
                        <td><input type="radio" id="3" value="3" name="blk_length">มากกว่า 1 กิโลเมตร</td>
                        <td colspan="2"><input type="text" id="distance3" name="distance3" placeholder="ความยาวช่วงที่เกิดปัญหา (กม.)"></td>
                    </tr>
                </table>

            <button type="submit">Submit</button>
        </form>
    <script src= "{{ asset('js/app.js') }}"></script>
    <script src= "{{ asset('js/location.js') }}"></script>
</body>
</html>