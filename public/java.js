function add_patients() {
    
    alert("dobrze");
}


function register_patients(i,hour,load) {
    var patients = $("#patients_" + i).val();
    var doctor = $("#doctor_" + i).val();
    //alert(hour);
    
    $("#register_to_doctor_" + i).load(load + "?patients=" + patients + "&doctor=" + doctor + "&hour=" + hour);

    
}

function hide_div() {
    alert("dobrze");
        //$(div).hide(120);
    
    
}

function modyfik_setting(url) {
    var visit = $("#how_visit").val();  
    $("#modyfik_setting").load(url + "?visit=" + visit);
    
}