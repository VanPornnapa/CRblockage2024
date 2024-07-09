//console.log('hello');

var ID = window.location.href.replace("https://survey.crflood.com/blockage/", "");
// var ID = window.location.href.replace("http://localhost/chiang-rai/public/blockage", "");
// console.log(ID);

function Province(id,district) {
  // Empty the dropdown
  
  $('#blk_district').find('option').not(':first').remove();

  // AJAX request 
  $.ajax({
  
//  url: 'http://localhost/chiang-rai/public/getdistrict/' + id,
 url: 'https://survey.crflood.com/getdistrict/' + id,
  //url: link+'getVillage/' + id,
 
    type: 'get',
    dataType: 'json',
    success: function (response) {

      var len = 0;
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >
        for (var i = 0; i < len; i++) {

          var id = response['data'][i].vill_id;
          var name = response['data'][i].vill_district;
          var option = "<option value='" + name + "'>" + name + "</option>";
          $("#blk_district").append(option);
          if (district == name) {
            $('#blk_district option:contains(' + district + ')').prop({selected: true});
          }
        }

      }

    }
  });
}


function District(id, tumbol) {


    // Empty the dropdown

    $('#blk_tumbol').find('option').not(':first').remove();

    // AJAX request 
    $.ajax({
     
  // url: 'http://localhost/chiang-rai/public/getTumbol/' + id,
  url: 'https://survey.crflood.com/getTumbol/' + id,
     // url: link+'getTumbol/' + id,
      type: 'get',
      dataType: 'json',
      success: function (response) {

        var len = 0;
        
        if (response['data'] != null) {
          len = response['data'].length;
        }

        if (len > 0) {
          // Read data and create <option >

          

          for (var i = 0; i < len; i++) {

            var id = response['data'][i].vill_id;
            var name = response['data'][i].vill_tunbol;
            var option = "<option value='" + name + "'>" + name + "</option>";
            $("#blk_tumbol").append(option);
            if (tumbol == name) {
              $('#blk_tumbol option:contains(' + tumbol + ')').prop({selected: true});
            }
          }
        }

      }
    });
}


function Tumbol(id, vill) {
      // Empty the dropdown
      $('#blk_village').find('option').not(':first').remove();

      // AJAX request 
      $.ajax({
      
  //  url: 'http://localhost/chiang-rai/public/getVillage/' + id,
    url: 'https://survey.crflood.com/getVillage/' + id,
      //url: link+'getVillage/' + id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
  
          var len = 0;
          if (response['data'] != null) {
            len = response['data'].length;
          }
  
          if (len > 0) {
            // Read data and create <option >
            for (var i = 0; i < len; i++) {
  
  
              var name = response['data'][i].vill_name;
              var moo = response['data'][i].vill_moo;
              var village = "หมู่ที่ " + moo + " " + name;
  
              var option = "<option value='" + village + "'>" + village + "</option>";
  
              $("#blk_village").append(option);
              if (vill == village) {
                $('#blk_village option:contains(' + vill + ')').prop({selected: true});
              }
            }
          }
  
        }
      });
}
//console.log(ID);
if(ID.length > 4){
  //console.log(ID.length);
  
    // $.getJSON('http://localhost/chiang-rai/public/getBlockageID/' + ID, (data) => {
    $.getJSON('https://survey.crflood.com/getBlockageID/' + ID, (data) => {
    // $.getJSON(link+'getBlockageID/' + ID, (data) => {
  let id = data[0]['blockage_location']['blk_district'];
  //console.log(data);
  if (id != '0') {
    $('#blk_district option:contains(' + id + ')').prop({selected: true});
  }
  let tumbol = data[0]['blockage_location']['blk_tumbol'];
  District(id, tumbol);
  id = tumbol;
  let vill = data[0]['blockage_location']['blk_village'];
  Tumbol(id, vill)
});
}

$(document).ready(function () {
  // District Change

  $('#blk_province').change(function () {
      let id = $('#blk_province').val();
      //console.log(id)
      Province(id, "0");

  });

});




$(document).ready(function () {
  // District Change

  $('#blk_district').change(function () {
      let id = $('#blk_district').val();
      //console.log(id)
      District(id, "0");

  });

});


$(document).ready(function () {

  // Tombol Change
  $('#blk_tumbol').change(function () {

    // Tombol name
    var id = $(this).val();
    //var id2='แม่จัน';
    //alert(id);
    //alert(id2);
    Tumbol(id, "0");


  });

});


function District(id, tumbol) {


  // Empty the dropdown

  $('#blk_tumbolCR').find('option').not(':first').remove();

  // AJAX request 
  $.ajax({
   
//  url: 'http://localhost/chiang-rai/public/getTumbol/' + id,
  url: 'https://survey.crflood.com/getTumbol/' + id,
   // url: link+'getTumbol/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {

      var len = 0;
      
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >

        // var option = "<option value='sum'> ทั้งหมด</option>";
        // $("#blk_tumbolCR").append(option);

        for (var i = 0; i < len; i++) {

          var id = response['data'][i].vill_id;
          var name = response['data'][i].vill_tunbol;
             option = "<option value='" + name + "'>" + name + "</option>";
          $("#blk_tumbolCR").append(option);
          if (tumbol == name) {
            $('#blk_tumbolCR option:contains(' + tumbol + ')').prop({selected: true});
          }
        }
      }

    }
  });
}
