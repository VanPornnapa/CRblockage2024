
// var river_name = document.getElementById('river_name');
// river_name.addEventListener('change', (e, target) => {
//     console.log(river_name.validity.valid);
//     $('#river_name').addClass("form-control is-invalid");
// });


function validateForm(id) {
    var element = document.getElementById(id);
    // console.log(element.type);
    if (!element.validity) {
        element.className = "form-control is-invalid";
        element.parentNode.querySelector('.invalid-feedback').textContent = "กรุณากรอกตัวเลข";
        //element.parentNode.querySelector('.invalid-feedback').textContent = "กรุณากรอกตัวเลข";
    }
    else element.className = "";

}

function validateTambol(id) {
    var element = document.getElementById("tumbol");
    // console.log(element.type);
    if (!element.validity) {
        element.className = "form-control is-invalid";
        element.parentNode.querySelector('.invalid-feedback').textContent = "กรุณากรอกตัวเลข";
        //element.parentNode.querySelector('.invalid-feedback').textContent = "กรุณากรอกตัวเลข";
    }
    else element.className = "";

}

function validatenumber(id) {
    var element = document.getElementById("cross_width_past");
    // console.log(element.validity.valid);
    if (element.validity.rangeOverflow) {
        // element.className = "form-control is-invalid";
        // element.parentNode.querySelector('.invalid-feedback').textContent = "กรุณากรอกตัวเลข";
        //element.parentNode.querySelector('.invalid-feedback').textContent = "กรุณากรอกตัวเลข";
    }
    else element.className = "";

}

function inboxValidate(array, detail) {
    let i;
    let isCheck = false;
    let checker = [];

    let a;
    for (a = 0; a < detail.length; a++) {
        let j;
        for (j = 0; j < detail[a].length; j++)
            $('#' + detail[a][j]).attr('required', true);

    }
    for (i = 0; i < array.length; i++) {
        isCheck = document.getElementById(array[i]).checked;
        if (isCheck) checker.push(1);
        else checker.push(0);
    }

    console.log(checker);

    let j;
    for (j = 0; j < detail.length; j++) {

        let k;
        for (k = 0; k < detail[j].length; k++) {

            if (checker[j] == 0) {
                $('#' + detail[j][k]).removeAttr('required');
                $('#' + detail[j][k]).attr('disabled', true);
                $('#' + detail[j][k]).prop('checked', false);
                $('#' + detail[j][k]).val('');

            }
            else { $('#' + detail[j][k]).removeAttr('disabled'); }
            // console.log('l'); 
            // console.log(document.getElementById(detail[j][k]));
        }

    }

    // if (!isCheck) {
    //     let i;
    //     for (i = 0; i < detail.length; i++) {
    //         let k;
    //         for (k = 0; k < detail[i].length; k++) $('#' + detail[i][k]).removeAttr('required');
    //     }
    // }
}

function xsectionRadioValidation() {

    let array = ['xsection_status', 'xsection_status2', 'xsection_status3', 'xsection_status4'];
    
    //let detail = [['cross_width_narrow', 'cross_depth_narrow', 'cross_slope_narrow','cross_slopebed_narrow'], ['culvert_round', 'culvert_square'], ['current_narrow']];
    inboxValidate(array);

}


function validateCheckbox() {
    let content = [['#damage_type1', '#damage_type2', '#damage_type3'], ['#nat_erosion', '#nat_shoal', '#nat_missing', '#nat_winding', '#nat_weed', '#nat_other', '#hum_structure', '#huminfa', '#hum_road', '#hum_smallconvert', '#hum_road_paralel', '#hum_replaced_convert', '#hum_bridge_pile', '#hum_soil_cover', '#hum_trash', '#hum_other']];

    content.forEach(array => {
        let isValid = false;

        array.forEach(element => {
            $(element).attr('required', true);
        });
        array.forEach(element => {
            let box = document.querySelector(element).checked;
            // console.log(box);
            if (box) isValid = true;
        });
        // console.log(isValid);
        if (isValid) {
            array.forEach(element => {
                $(element).removeAttr('required');
            });
        }
    });

}


function damageLevelRadioValidation() {
    let array = ['damage_type1', 'damage_type2', 'damage_type3', 'hum_structure'];
    let detail = [['damageflood1', 'damageflood2', 'damageflood3'], ['damagewaste1', 'damagewaste2', 'damagewaste3'], ['damageotherdetail', 'damageother1', 'damageother2', 'damageother3']];
    //console.log(document.getElementById('hum_structure').checked);
    inboxValidate(array, detail);
    causeOfDamageValidate();
    
}

function causeOfDamageValidate() {
    let array = ['nat_weed', 'nat_other', 'hum_other', 'sol_how', 'blk_length2', 'blk_length3'];
    let detail = [['nat_cause_5_detail'], ['nat_cause_6_detail'], ['hum_other_detail'], ['responsed_dept2'], ['blk_length'], ['blk_length_1k']];
    inboxValidate(array, detail);


}

function projStatusValidate() {
    let array = ['proj_status1', 'proj_status2'];
    //let detail = [['proj_year', 'proj_name', 'proj_budget'], ['proj_name2', 'proj_budget2']];
    inboxValidate(array);
}

function solHowValidate() {
    array = ['sol_how'];
    detail = [['responsed_dept2']];
    inboxValidate(array, detail);
}

function culvertValidate() {
    array = ['culvert_round', 'culvert_square'];
    detail = [['diameter_culvert','num_culvert1'], ['width_culvert', 'high_culvert','num_culvert2']];
    inboxValidate(array, detail);
}


function blk_surfaceValidate() {
    
    array = ['blk_surface1', 'blk_surface2'];
    detail = [[],['blk_surface_detail']];
    inboxValidate(array, detail);
}

function hum_stcValidate()
{
    array = ['hum_stc_bld_num','hum_stc_fence_num', 'hum_str_other'];
    check1 = false;
    array.forEach(element => {
        text = document.getElementById(element).value;
        if(text != null) check1 = true;
    });
    if(check1)
    {
        array.forEach(element => {
            $('#' + element).removeAttr('required');
        }); 
    }

    array2 = ['hum_stc_bld_num','hum_stc_fence_num', 'hum_str_other'];
    check2 = false;
    array2.forEach(element => {
        text = document.getElementById(element).value;
        if(text != null) check1 = true;
    });
    if(check2)
    {
        array2.forEach(element => {
            $('#' + element).removeAttr('required');
        }); 
    }
}

function hum_stcValidate2()
{
    array = ['hum_stc_bld_num2','hum_stc_fence_num2', 'hum_str_other2'];
    check1 = false;
    array.forEach(element => {
        text = document.getElementById(element).value;
        if(text != null) check1 = true;
    });
    if(check1)
    {
        array.forEach(element => {
            $('#' + element).removeAttr('required');
        }); 
    }

    array2 = ['hum_stc_bld_num2','hum_stc_fence_num2', 'hum_str_other2'];
    check2 = false;
    array2.forEach(element => {
        text = document.getElementById(element).value;
        if(text != null) check1 = true;
    });
    if(check2)
    {
        array2.forEach(element => {
            $('#' + element).removeAttr('required');
        }); 
    }
}
