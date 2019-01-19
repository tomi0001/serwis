/*
function add_patients() {
    
    alert("dobrze");
}
*/

function register_patients(i,hour,load) {
    var patients = $("#patients_" + i).val();
    var doctor = $("#doctor_" + i).val();
    $("#register_to_doctor_" + i).load(load + "?patients=" + patients + "&doctor=" + doctor + "&hour=" + hour);

  
}
/*
function hide_div() {
    alert("dobrze");
        //$(div).hide(120);
    
    
}
*/
function modyfik_setting(url) {
    var visit = $("#how_visit").val();  
    $("#modyfik_setting").load(url + "?visit=" + visit);
    
}

function modyfik_doctor_id(url,id) {
    var password = $("#password").val();
    var password_new = $("#password_confirm").val();
    var hour_open = $("#hour_open").val();
    var hour_close = $("#hour_close").val();
    var telefon_nr = $("#nr").val();
    $("#result").load(url + "?password=" + password + "&password_new=" + password_new + "&hour_open=" + hour_open + "&hour_close=" + hour_close + "&id=" + id + "&telefon_nr=" + telefon_nr);
}

function delete_visit(url,id) {
    var window = confirm("Czy na pewno usunąć");
    if (window == true) {
        //alert(id);
        $("#list_"+id).load(url+"?id=" + id);
        
    }

    
    
}

function add_drugs() {

            $("#drugss").append("<tr class='drugs' id='drug_'><td width='30'><input type='text' name='drugs1[]' class='form-control'></td><td width='10%'><input type='text' name='drugs2[]' class='form-control'></td><td width='10%'><input type='text' name='drugs3[]' class='form-control'></td><td width='10%'><input type='text' name='drugs4[]' class='form-control'></td><td width='10%'><input type='text' name='drugs5[]' class='form-control'></td><td width='10%'><input type='text' name='drugs6[]' class='form-control'></td><td width='10%'><input type='text' name='drugs7[]' class='form-control'><td><button onclick='delete_drugs()'  class='btn btn-primary drugsss'>Usuń wpis</button></td></tr>");

}
function delete_drugs() {
    
       $(document).on('click', '.drugsss', function() {
           $(this).parents('.drugs').remove();
       });
    
    }
function save_visit(url) {
    $("#ajax").load(url + "?" + $( "form" ).serialize());
    
}