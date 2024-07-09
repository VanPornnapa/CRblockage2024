function loadRadioButton(uid){
 //   $.getJSON('http://localhost/chiang-rai/public/report_detail/' + uid, (data) => {
//$.getJSON('http://localhost/chiang-rai/public/getBlockageID/' + uid, (data) => {
$.getJSON('https://survey.crflood.com/getBlockageID/' + uid, (data) => {
  let current_narrow = JSON.parse(data[0]['blockage_crossection']['current_narrow']);
  console.log(current_narrow['type']);

    // blockage_crossection_current_narrow
    // switch(current_narrow['type']){
    //     case "waterway" : $('#xsection_status').attr('checked', true);
    //         break;
    //     case "culvert" : $('#xsection_status2').attr('checked', true);
    //         break;
    //     case "other" : $('#xsection_status3').attr('checked', true);
    //         break;
    // }
    // if((typeof current_narrow['width'] != "undefined" ) ||(typeof current_narrow['type']=="waterway") )$('#xsection_status').attr('checked', true);

    // if(typeof current_narrow['culvert']['diameter'] != "undefined")$('#culvert_round').attr('checked', true);
    
    // if ((typeof current_narrow['culvert']['width'] != "undefined")||(typeof current_narrow['culvert']['width'] != null))$('#culvert_square').attr('checked', true);

    // if ((typeof current_narrow['other'] != "undefined") ||(typeof current_narrow['type']=="other") ||(typeof current_narrow['other']!= null)  )$('#xsection_status3').attr('checked', true);
        
    if((current_narrow['width'] != null ) ||(typeof current_narrow['type']=="waterway") )$('#xsection_status').attr('checked', true);
    if(current_narrow['culvert']['diameter']!= null)$('#culvert_round').attr('checked', true);
    if ( current_narrow['culvert']['width'] != null)$('#culvert_square').attr('checked', true);
    if ((current_narrow['other'] != "undefined") ||(current_narrow['type']=="other") ||(current_narrow['other']!= null)  )$('#xsection_status3').attr('checked', true);
    // changing blk_length radio
    let blk_length_type = data[0]['blk_length_type'];
    switch(blk_length_type){
        case "น้อยกว่า 10 เมตร" : $('#blk_length1').attr('checked', true);
            break;
        case "10 -1000 เมตร" : $('#blk_length2').attr('checked', true);
            $('#blk_length').show();
            break;
        case "มากกว่า 1 กิโลเมตร" : $('#blk_length3').attr('checked', true);
        $("#blk_length_1k").show();
        break;
    }

    // damage_type checkbox
    let damage_type = JSON.parse(data[0].damage_type);
    if(damage_type['flood'] != "0") $('#damage_type1').attr('checked', true);
    if(damage_type['waste'] != "0") $('#damage_type2').attr('checked', true);
    if(damage_type['other'] != "0") $('#damage_type3').attr('checked', true);

    // damage_level radio
    let damage_level = JSON.parse(data[0].damage_level);
    switch(damage_level['flood'])
    {
        case "low" : $('#damageflood1').attr('checked', true);
            break;
        case "medium" : $('#damageflood2').attr('checked', true);
            break;
        case "high" : $('#damageflood3').attr('checked', true);
            break;
    }
    switch(damage_level['waste'])
    {
        case "low" : $('#damagewaste1').attr('checked', true);
            break;
        case "medium" : $('#damagewaste2').attr('checked', true);
            break;
        case "high" : $('#damagewaste3').attr('checked', true);
            break;     
    }
    switch(damage_level['other']['level'])
    {
        case "low" : $('#damageother1').attr('checked', true);
            break;
        case "medium" : $('#damageother2').attr('checked', true);
            break;
        case "high" : $('#damageother3').attr('checked', true);
            break;     
    }

    // for selection blk_length
    let blockage_length = null;
    $('#blk_length option:contains(' + blockage_length + ')').prop({selected: true});

    // radio blk_surface
    let blk_surface = data[0]['blk_surface'];    
    switch(blk_surface){
        case "ไม่ดาดผิว" : $('#blk_surface1').attr('checked', true);
            break;
        case "ดาดผิว" : $('#blk_surface2').attr('checked', true);
            break;
    }

    // checkbox blk_damage_level
    // let damage_level = JSON.parse(data[0]['damage_level']);
    // console.log(damage_level);   
    
    // radio damage_frequency
    let damage_frequency = data[0]['damage_frequency'];
    switch(damage_frequency){
        case "มากกว่า 4 ปีครั้ง" : $('#damage_frequency1').attr('checked', true);
            break;
        case "2-4 ปีครั้ง" : $('#damage_frequency2').attr('checked', true);
            break;
        case "ทุกปี" : $('#damage_frequency3').attr('checked', true);
            break;
    }

    // sol_how radio
    let sol_how = data[0]['solution'][0]['sol_how'];
    // console.log(sol_how);
    switch(sol_how){
        case "ปรับปรุงแก้ไข" : $('#sol_how').attr('checked', true);
            break;
        case "เจรจา" : $('#sol_how2').attr('checked', true);
            break;
        case "ฟ้องร้อง" : $('#sol_how3').attr('checked', true);
            break;
        case "รื้อถอน" : $('#sol_how4').attr('checked', true);
            break;
        case "ยังไม่ได้ดำเนินการ" : $('#sol_how5').attr('checked', true);
            break;
    }
    
    // solution result radio
    
    let result = data[0]['solution'][0]['result'];
    // console.log(data[0]['solution'][0]['proj_id']);
    switch(result){
        case "ได้ผลดีสามารถแก้ไขปัญหาได้" : $('#result_selector1').attr('checked', true);
            break;
        case "ได้ผลดีพอสมควรแก้ไขปัญหาได้บางส่วน" : $('#result_selector2').attr('checked', true);
            break;
        case "ได้ผลไม่ดีเท่าที่ควรแก้ไขปัญหาได้น้อย" : $('#result_selector3').attr('checked', true);
            break;
        case "ไม่ได้ผล" : $('#result_selector4').attr('checked', true);
            break;
    }

    // Project Resolve
    let result1= data[0]['solution'][0]['project'][0]['proj_status'];
     console.log(data[0]['solution'][0]['project'][0]['proj_status']);
    switch(result1){
        case "plan" : $('#proj_status1').attr('checked', true);
            break;
        case "received" : $('#proj_status2').attr('checked', true);
            break;
        case "making" : $('#proj_status3').attr('checked', true);
            break;
        case "noplan" : $('#proj_status4').attr('checked', true);
            break;
    }

    // checkbox problem_detail
    // let array = ['nat_erosion', 'nat_shoal', 'nat_missing', 'nat_winding', 'nat_weed', 'nat_other', 'hum_structure', 'hum_road',
    //     'hum_smallconvert', 'hum_road_paralel', 'hum_replaced_convert', 'hum_bridge_pile', 'hum_soil_cover', 'hum_trash', 'hum_other'
    // ];
    // array.forEach(element => {
    //     let value = document.getElementById(element).value;
    //     if(value === "1") $('#' + element).attr('checked', true);
    // });
    

});


    // proj_status radio
 


}

function loadProjStatus(temp)
{
    // console.log(temp);
    switch(temp){
        case "plan" : $('#proj_status1').attr('checked', true);
            $("#showplan").show();
            break;
        case "received" : $('#proj_status2').attr('checked', true);
            $("#showreceived").show();
            break;
        case "making" : $('#proj_status3').attr('checked', true);
            break;
        case "noplan" : $('#project_status4').attr('checked', true);
            break;
    }      
}



function checkHumStr(temp){


    let humStr = JSON.parse(temp);

    // owner type radio
    let ownerType = humStr['hum_str_owner_type'];
    switch(ownerType){
        case "ราชการ" : $('#hum_str_gov').attr('checked', true);
            break;
        case "เอกชน" : $('#hum_str_bu').attr('checked', true);
            break;
    }

    // prob level radio
    let prob_level = humStr['prob_level'];
    switch(prob_level){
        case "1-30%" : $('#problevel1').attr('checked', true);
            break;
        case "30-70%" : $('#problevel2').attr('checked', true);
            break;
        case "มากกว่า 70%" : $('#problevel3').attr('checked', true);
    }

}