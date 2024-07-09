// $(document).ready(function(){
//     $('input[type="radio"]').click(function(){
//     	var demovalue = $(this).val(); 
//         $("div.myDiv").hide();
//         $("#show"+demovalue).show();
//     });
// });

// show detail for current_narrow
// $.getJSON('http://localhost/chiang-rai/public/getBlockageID/B00001', (data) => {
//     let current_narrow = JSON.parse(data[0]['blockage_crossection']['current_narrow']);
//     console.log(current_narrow['type']);
//     let demovalue = current_narrow['type'];
//     $("div.myDiv").hide();
//     $("#show"+demovalue).show();    
// });

$("div.myDiv").hide();
$(".blk_length_div").hide();

$(document).ready(function(){
    $("#xsection_status").click(function(){
        var demovalue = $(this).val(); 
        // console.log(demovalue);
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
$(document).ready(function(){
    $("#xsection_status2").click(function(){
        var demovalue = $(this).val(); 
        // console.log(demovalue);
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
$(document).ready(function(){
    $("#xsection_status3").click(function(){
        var demovalue = $(this).val(); 
        // console.log(demovalue);
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
$(document).ready(function(){
    $("#xsection_status4").click(function(){
        var demovalue = $(this).val(); 
        // console.log(demovalue);
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
$(document).ready(function(){
    $("#proj_status1").click(function(){
    	var demovalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
$(document).ready(function(){
    $("#proj_status2").click(function(){
    	var demovalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
$(document).ready(function(){
    $("#proj_status3").click(function(){
    	var demovalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
$(document).ready(function(){
    $("#proj_status4").click(function(){
    	var demovalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
$(document).ready(function(){
    $("#blk_length1").click(function(){
        $(".blk_length_div").hide();
        
    });
});
$(document).ready(function(){
    $("#blk_length2").click(function(){
        $(".blk_length_div").hide();
        $("#blk_length").show();
    });
});
$(document).ready(function(){
    $("#blk_length3").click(function(){
        $(".blk_length_div").hide();
        $("#blk_length_1k").show();
    });
});