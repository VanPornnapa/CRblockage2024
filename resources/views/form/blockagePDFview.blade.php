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
		/*@font-face{
		font-family:  'THSarabunNew';
		font-style: normal;
		font-weight: normal;
		src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
		}
		@font-face{
		font-family:  'THSarabunNew';
		font-style: normal;
		font-weight: normal;
		src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
		} */
		
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
			font-size:20px;
		}
		.m-b-md {
			/* margin-bottom: 2px; */
        }  
        .table{
            width:100%;
            /* margin-bottom:1rem; */
            background-color:transparent
        }
        .table td,
        .table th{
            /* padding:.2rem; */
            /* vertical-align:top; */
            border-top:1px solid #000000
        }
        .table thead th{
            /* vertical-align:bottom; */
            border-bottom:1px solid #000000;
        }
        .table tbody+tbody{
            border-top:2px solid #000000
        }
        .table .table{background-color:#f8fafc}
        /* .table-sm td, */
        /* .table-sm th{padding:.3rem} */
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
	</style>
</head>
<body>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <img src="{{ asset('images/logo/head_form.png') }}" width="100%">
                </div>
                <div class="title m-b-md">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <td colspan="2" class="text-right">รหัสตำแหน่งกีดขวางที่</td>
                                <td colspan="1"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ชื่อลำน้ำ </td>
                                <td>ประเภทลำน้ำ</td>
                                <td>หมู่บ้าน</td>
                            </tr>
                            <tr>
                                <td>ตำบล</td>
                                <td>อำเภอ</td>
                                <td>จังหวัด</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="2" class="text-center" style="background-color:#C0C0C0">พิกัดเริ่มปัญหา</td>
                            <td colspan="2" class="text-center" style="background-color:#C0C0C0">พิกัดสิ้นสุดปัญหา</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>X</td>
                            <td>Y</td>
                            <td>X</td>
                            <td>Y</td>
                        </tr>
                    </tbody>
                    </table>
                    <br>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="2" class="text-center" style="background-color:#C0C0C0">หน้าตัดลำน้ำที่เกิดปัญหา</td>
                            <td class="text-center" style="background-color:#C0C0C0">กว้าง (เมตร)</td>
                            <td class="text-center" style="background-color:#C0C0C0">ลึก (เมตร)</td>
                            <td class="text-center" style="background-color:#C0C0C0">ความชันตลิ่ง</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">หน้าตัดลำน้ำเดิมในอดีตก่อนเกิดปัญหา</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">หน้าตัดลำน้ำก่อนถึงที่เกิดปัญหา</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5">หน้าตัดที่แคบที่สุดของช่วงที่เกิดปัญหา</td>
                        </tr>
                        <tr>
                            <td colspan="2">ลำน้ำ</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td rowspan="2">กรณีท่อลอด</td>
                            <td>ท่อกลม</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>ท่อเหลี่ยม</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">หน้าตัดลำน้ำด้านท้ายน้ำหลังช่วงที่เกิดปัญหา</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    </table>
                    <br>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <td colspan="2">ความยาวของช่วงลำน้ำที่เกิดปัญหา</td>
                                <td colspan="1">การดาดผิวของน้ำ</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">วัสดุที่ใช้ดาดผิวของน้ำ</td>
                            </tr>
                            <tr>
                                <td>ลักษณะความเสียหาย</td>
                                <td>ระดับ</td>
                                <td>ความถี่ที่เกิดความเสียหาย</td>
                            </tr>
                            <tr>
                                <td colspan="3">สาเหตุของการกีดขวางลำน้ำ</td>
                            </tr>
                            <tr>
                                <td colspan="3"> &nbsp;&nbsp;&nbsp;> โดยธรรมชาติ</td>
                            </tr>
                            <tr>
                                <td colspan="3"> &nbsp;&nbsp;&nbsp;> โดยมนุษย์</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <td>ระดับการกีดขว้าง</td>
                                <td>คิดเป็น</td>
                                <td>หน่วยงานการดำเนินการแก้ไข</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>โดยวิธี</td>
                                <td colspan="2">ผลการดำเนินการ</td>
                            </tr>
                            <tr>
                                <td colspan="3">สภาพในปัจจุบันของโครงการที่แก้ไขปัญหา</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td colspan="2" style="background-color:#C0C0C0">คำอธิบายสภาพปัญหา</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center" style="background-color:#C0C0C0">คำอธิบายสภาพปัญหาเบื้องต้น</td>
                                <td class="text-center" style="background-color:#C0C0C0">แนวทางการแก้ไขเบื้องต้น</td>
                            </tr>
                            <tr>
                                <td rowspan="3"></td>
                                <td>ข้อมูลพื้นที่รับน้ำของตำแน่งที่เกิดปัญหา</td>
                            </tr>
                            <tr>
                                <td> อัตราการไหลสูงสุด</td>
                            </tr>
                            <tr>
                                <td> คำอธิบาย</td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <td colspan="2" style="background-color:#C0C0C0">รูปภาพประกอบ</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ภาพ</td>
                                <td>ภาพ</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ URL::to('reportblockage/pdf/B00003') }}">Export PDF</a> 
                </div>
            </div>
        </div>

        
</body>
</html>