
$("#photo_type_bld").change(function(){
$('#image_preview_bld').html("");
var total_file=document.getElementById("photo_type_bld").files.length;
for(var i=0;i<total_file;i++)
{
    $('#image_preview_bld').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
}
});

$("#photo_type_land").change(function(){
$('#image_preview_land').html("");
var total_file=document.getElementById("photo_type_land").files.length;
for(var i=0;i<total_file;i++)
{
    $('#image_preview_land').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
}
});

$("#photo_type_river_before").change(function(){
    $('#image_preview_river_before').html("");
    var total_file=document.getElementById("photo_type_river_before").files.length;
    for(var i=0;i<total_file;i++)
    {
        $('#image_preview_river_before').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
    }
});

$("#photo_type_river_prob").change(function(){
    $('#image_preview_river_prob').html("");
    var total_file=document.getElementById("photo_type_river_prob").files.length;
    for(var i=0;i<total_file;i++)
    {
        $('#image_preview_river_prob').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
    }
});

$("#photo_type_river_after").change(function(){
    $('#image_preview_river_after').html("");
    var total_file=document.getElementById("photo_type_river_after").files.length;
    for(var i=0;i<total_file;i++)
    {
        $('#image_preview_river_after').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
    }
});

$("#photo_type_prob_sketch").change(function(){
    $('#image_preview_prob_sketch').html("");
    var total_file=document.getElementById("photo_type_prob_sketch").files.length;
    for(var i=0;i<total_file;i++)
    {
        $('#image_preview_prob_sketch').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
    }
});

// $.getJSON('http://localhost/chiang-rai/public/getBlockageID/B00001', (data) => {
//     let pic1 = data[0]['photo'][0]['thumbnail_name'];
//     let pic2 = data[0]['photo'][1]['thumbnail_name'];
//     let pic3 = data[0]['photo'][2]['thumbnail_name'];
//     let pic4 = data[0]['photo'][3]['thumbnail_name'];
//     let pic5 = data[0]['photo'][4]['thumbnail_name'];
//     let pic6 = data[0]['photo'][5]['thumbnail_name'];

//     if(pic1 != null) $('#image_preview_bld').append("<img src='http://localhost/chiang-rai/public/"+ pic1 +"'>");
//     if(pic2 != null) $('#image_preview_land').append("<img src='http://localhost/chiang-rai/public/"+ pic2 +"'>");
//     if(pic3 != null) $('#image_preview_river_before').append("<img src='http://localhost/chiang-rai/public/"+ pic3 +"'>");
//     if(pic4 != null) $('#image_preview_river_prob').append("<img src='http://localhost/chiang-rai/public/"+ pic4 +"'>");
//     if(pic5 != null) $('#image_preview_river_after').append("<img src='http://localhost/chiang-rai/public/"+ pic5 +"'>");
//     if(pic6 != null) $('#image_preview_prob_sketch').append("<img src='http://localhost/chiang-rai/public/"+ pic6 +"'>");
// });
