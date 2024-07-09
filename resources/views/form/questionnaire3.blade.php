<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
</head>
<body>
        <form action="{{route('form.Qnaire3.addSolution')}}" method="get">
            <h1>แบบสอบถาม</h1>             
            <span class="number">3</span>การดำเนินการแก้ไขของหน่วยงานท้องถิ่น และหน่วยงานที่รับผิดชอบ
            <br><br> 
            <label>ระบุหน่วยงาน:</label>
            <input type="text" id="responsed_dept" name="responsed_dept" >
            <br><br>

            <label>ปรับปรุงแก้ไขโดย:</label>
            <table class="table table-borderless">
                <tr>
                    <td ><input type="checkbox" name="sol_how[talk]" value="1">เจรจา</td>
                    <td><input type="checkbox" name="sol_how[demolish]" value="1">รื้อถอน</td>
                    <td ><input type="checkbox" name="sol_how[sue]" value="1">ฟ้องร้อง</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" name="sol_how[improve]" value="1">ปรับปรุง</td>
                    <td colspan="2"><input type="checkbox" name="sol_how[notimplement]" value="1">ยังไม่ได้ดำเนินการ</td>
                
                </tr>
                <tr>
                    <td ><input type="checkbox" name="sol_how[other]" value="1">อื่นๆ</td>
                    <td colspan="2"><input type="text" id="sol_howุ" name="sol_how[detail]" placeholder="ระบุ"></td>
                </tr>
            </table>
            <label>ผลการดำเนินการ:</label>
                <select id="result_selector" name="result_selector">
                    <option value="ได้ผลดีสามารถแก้ไขปัญหาได้">ได้ผลดีสามารถแก้ไขปัญหาได้</option>
                    <option value="ได้ผลดีพอสมควรแก้ไขปัญหาได้บางส่วน">ได้ผลดีพอสมควรแก้ไขปัญหาได้บางส่วน</option>
                    <option value="ได้ผลไม่ดีเท่าที่ควรแก้ไขปัญหาได้น้อย">ได้ผลไม่ดีเท่าที่ควรแก้ไขปัญหาได้น้อย</option>
                    <option value="ไม่ได้ผล">ไม่ได้ผล</option>
                </select>
            
            <br><br>
            <label for="job">สถานภาพในปัจจุบันของโครงการที่แก้ไขปัญหา:</label>
            <table class="table table-borderless">
                <tr>           
                    <td><input type="radio" name="proj_status" value="plan" /> อยู่ในแผน</td>
                    <td><input type="radio" name="proj_status" value="received"/>ได้รับงบประมาณแล้ว</td>
                    <td><input type="radio" name="proj_status" value="noplan"/>ยังไม่มีในแผน </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div id="showplan"  class="myDiv">
                            <table>
                                <tr> 
                                    <td>ลักษณะโครงการ: </td>   
                                    <td><input type="text" id="proj_year" name="proj_year1" placeholder="ระบุปี พ.ศ"></td>        
                                </tr>
                                <tr>   
                                    <td></td>   
                                    <td><input type="text" id="proj_name" name="proj_name1" placeholder="ระบุชื่อโครงการ"></td>        
                                </tr>
                                <tr>   
                                        <td></td>   
                                        <td><input type="text" id="proj_type" name="proj_type1" placeholder="ระบุลักษณะโครงการ"></td>        
                                    </tr>
                                <tr> 
                                    <td>งบประมาณ: </td>  
                                    <td><input type="text" id="proj_budget" name="proj_budget1" placeholder="ระบุงบประมาณ"></td>         
                                </tr>
                            </table>
                        </div>
                        <div id="showreceived"  class="myDiv">
                            <table>
                                    <tr> 
                                            <td>ลักษณะโครงการ: </td>   
                                            <td><input type="text" id="proj_year" name="proj_year2" placeholder="ระบุปี พ.ศ"></td>        
                                    </tr>
                                    <tr>   
                                            <td></td>   
                                            <td><input type="text" id="proj_name" name="proj_name2" placeholder="ระบุชื่อโครงการ"></td>        
                                    </tr>
                                    <tr>   
                                                <td></td>   
                                                <td><input type="text" id="proj_type" name="proj_type2" placeholder="ระบุลักษณะโครงการ"></td>        
                                    </tr>
                                    <tr> 
                                            <td>งบประมาณ: </td>  
                                            <td><input type="text" id="proj_budget" name="proj_budget2" placeholder="ระบุงบประมาณ"></td>         
                                    </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table> 
        <button type="submit">Next</button>
        </form>

    <script src= "{{ asset('js/app.js') }}"></script>
    <script src= "{{ asset('js/showhide.js') }}"></script>
</body>
</html>