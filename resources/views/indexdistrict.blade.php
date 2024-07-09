<!DOCTYPE html>
<html>
   <head>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   </head>
   <body>

     <!-- District Dropdown -->
     อำเภอ : <select id='sel_district' name='sel_district'>
       <option value='0'>-- เลือกอำเภอ --</option>
 
       <!-- Read Departments -->
       @foreach($districtData['data'] as $village)
         <option value='{{ $village->vill_district }}'>{{ $village->vill_district  }}</option>
       @endforeach

    </select>

    <br><br>
    <!-- Tumbol Dropdown -->
    ตำบล : <select id='sel_tombol' name='sel_tombol'>
       <option value='0'>-- เลือกตำบล --</option>
    </select>

    <br><br>
    <!-- Village Dropdown -->
    หมู่บ้าน : <select id='sel_vill' name='sel_vill'>
       <option value='0'>-- เลือกหมู่บ้าน --</option>
    </select>



    <script src= "{{ asset('js/chooseLocation.js') }}"></script>


  </body>
</html>