<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
</head>
<body>
        <form action="{{route('form.Qnaire2.addProblem')}}" method="get">
            <h1>แบบสอบถาม</h1>             
            <span class="number">2</span>สภาพปัญหา
            <br><br> 
            <label>ระดับความรุนแรง:</label>
            <table class="table table-borderless">
                <tr>
                    <td colspan="3"><input type="radio" id="prob_level_1" value="prob_level_1" name="prob_level_percent">น้อย (1-30%)</td>
                </tr>
                <tr>
                    <td colspan="3"><input type="radio" id="prob_level_2" value="prob_level_2" name="prob_level_percent">ปานกลาง (30-70%)</td>
                </tr>
                <tr>
                    <td colspan="3"><input type="radio" id="prob_level_3" value="prob_level_3" name="prob_level_percent">มาก (มากกว่า 70%)</td>
                </tr>
            </table>

            <label for="job">สาเหตุการถูกกีดขวางลำน้ำ:</label>
            <table class="table table-borderless">
                <tr>           
                    <td><input type="radio" name="prob_cause_type" value="ธรรมชาติ" /> ธรรมชาติ </td>
                    <td><input type="radio" name="prob_cause_type" value="มนุษย์"/> มนุษย์ </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="showOne"  class="myDiv">
                            <table >
                                <tr> 
                                    <td>สาเหตุ: </td>          
                                    <td colspan="2"><input type="radio" name="nat_cause_type" value="nat_cause_1" /> ตลิ่งพัง, การกัดเซาะ</td>  
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2"><input type="radio" name="nat_cause_type" value="nat_cause_2" /> การทับถมของตะกอน (ลำน้ำตื้นเขิน)</td>       
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2"><input type="radio" name="nat_cause_type" value="nat_cause_3" />ลำน้ำขาดหาย</td>       
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2"><input type="radio" name="nat_cause_type" value="nat_cause_4" /> ลักษณะทางกายภาพของล้ำน้ำ</td>       
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="radio" name="nat_cause_type" value="nat_cause_5" /> วัชพืช </td>  
                                    <td><input type="text" id="nat_cause_5_detail" name="nat_cause_5_detail" placeholder="ระบุวัชพืช"></td>     
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="radio" name="nat_cause_type" value="nat_cause_6" />อื่นๆ</td>  
                                    <td><input type="text" id="nat_cause_6_detail" name="nat_cause_6_detail" placeholder="ระบุ"></td>     
                                </tr>
                            </table>
                        </div>
                        <div id="showTwo" class="myDiv">
                            <table >
                                <tr> 
                                    <td>สาเหตุ: </td>          
                                    <td><input type="radio" name="human_cause_type" value="human_cause_1" />สิ่งปลูกสร้าง</td>  
                                    <td><input type="text" id="bld_type" name="bld_type" placeholder="ระบุรูปแบบ"></td>
                                </tr>
                                <tr> 
                                    <td></td>          
                                    <td></td>  
                                    <td><input type="text" id="bld_amount" name="bld_amount" placeholder="ระบุจำนวน"></td>
                                </tr>
                                <tr> 
                                    <td></td>          
                                    <td><input type="radio" name="human_cause_type" value="human_cause_2" />ระบบสาธารณูปโภค </td>  
                                    <td>
                                        <div class="button dropdown"> 
                                            <select id="human_cause_2_selector">
                                                <option value="road">ถนน</option>
                                                <option value="culvert">ท่อลอด</option>
                                                <option value="bridge">สะพาน</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr> 
                                    <td></td>          
                                    <td colspan="2"><input type="radio" name="human_cause_type" value="human_cause_3" />ลำน้ำขาดหาย</td>  
                                </tr>
                                <tr> 
                                    <td></td>          
                                    <td colspan="2"><input type="radio" name="human_cause_type" value="human_cause_4" />การถมดิน</td>  
                                </tr>
                                <tr> 
                                    <td></td>          
                                    <td><input type="radio" name="human_cause_type" value="human_cause_5" />สิ่งปฏิกูล</td>  
                                    <td>
                                        <div class="button dropdown"> 
                                            <select id="human_cause_5_selector">
                                                <option value="trash_1">ขยะ</option>
                                                <option value="trash_2">เศษวัสดุ</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>  
                                    <td><input type="radio" name="human_cause_type" value="human_cause_6" />อื่นๆ</td> 
                                    <td><input type="text" id="other_detail" name="other_detail" placeholder="ระบุ"></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
            
            <label>ลักษณะความเสียหายที่เคยเกิดขึ้น:</label>
            <table class="table table-borderless">
                <tr>
                    <td></td>          
                    <td><input type="radio" name="damage_type" value="น้ำท่วม" />น้ำท่วม </td>  
                    <td>
                        <div class="button dropdown"> 
                            <select name="damage_level[flood]">
                                <option value="-">ระดับ</option>
                                <option value="low">น้อย</option>
                                <option value="medium">ปานกลาง</option>
                                <option value="most">มาก</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>          
                    <td><input type="radio" name="damage_type" value="น้ำเสีย" />น้ำเสีย</td>  
                    <td>
                        <div class="button dropdown"> 
                            <select name="damage_level[waste]">
                                    <option value="-">ระดับ</option>
                                    <option value="low">น้อย</option>
                                    <option value="medium">ปานกลาง</option>
                                    <option value="most">มาก</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>          
                    <td><input type="radio" name="damage_type" value="อื่นๆ" />อื่นๆ</td>  
                    <td><input type="text" id="damage_3_detail" name="damage_level[other]" placeholder="ระบุลักษณะ"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="button dropdown"> 
                            <select name="damage_level[other][level]">
                                    <option value="-">ระดับ</option>
                                    <option value="low">น้อย</option>
                                    <option value="medium">ปานกลาง</option>
                                    <option value="most">มาก</option>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>

            <label>ความถี่ที่เกิดความเสียหาย:</label>
            <table class="table table-borderless">
                <tr>
                    <td></td>          
                    <td><input type="radio" name="damage_frequency" value="ทุกปี" /><label for="over_13" class="light" >ทุกปี</label></td>  
                </tr>
                <tr>
                    <td></td>          
                    <td><input type="radio" name="damage_frequency" value="บางปี" /><label for="over_13" class="light" >บางปี</label></td>  
                    <td><input type="text" id="damage_frequency_detail" name="damage_frequency_detail" placeholder="ระบุความถี่"></td>
                </tr>
            </table>


            <button type="submit">Next</button>
        </form>
        <script src= "{{ asset('js/app.js') }}"></script>
       <script src= "{{ asset('js/showhide.js') }}"></script>
</body>
</html>