<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Input;
use Auth;
use Hash;
use DB;
use Log;
use App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class Controller_doctor extends BaseController
{
    public $list_patients = array();
    public $i = 0;
    public $id_visit;
    public function login_doctor() {
        
        $user = new \App\Http\Controllers\user();
        if ( !(Auth::check()) or !$user->check_if_what_admin_nurses_doctor(2) ) {
            return view("login_doctor");
        }
        else {
            
            return redirect("/doctor/main");
        }
        
    }
    
    public function logout_action() {
        Auth()->logout();
        return redirect("/doctor/login")->with("sukces","Wylogowałeś się");
        
    }
    public function login_action() {
        $user = new \App\Http\Controllers\user();
        $doctor = array(
            "login" => Input::get("login"),
            "password" => Input::get("password")
            
        );
        if (Input::get('login') == "" or Input::get('password') == "" ) {
            return Redirect('/doctor/login')->with('error','Uzupełnij pole login i hasło');
        }
        if (Auth::attempt($doctor) and $user->check_if_what_admin_nurses_doctor(2)  == true) 
        
        {
         
                     return redirect("/doctor/main");
           
            
        }
        else {

            return Redirect('/doctor/login')->with('error','Nieprawidłowy login lub hasło');
        }
    }
    private function select_list_patients() {
        $doctor = new \App\patients_register();
        $date = date("Y-m-d") . " 00:00:00";
        $date_close = date("Y-m-d") . " 23:59:00";
        $list = $doctor->where("date",">=",$date)
                ->where("date","<=",$date_close)
                ->where("doctors_id",$this->select_id_doctors(Auth()->id()))
                ->get();
       
        foreach ($list as $list2) {
            $this->select_name_patients($list2->patients_id,$list2->date,$list2->if_visit,$list2->id);
            
        }
    }
    private function select_name_patients(int $id_patient,string $date,bool $visit,int $id) {
        $patients = new \App\Patient();
        $hour = explode(" ",$date);
        $select_name_patients = $patients->where("id",$id_patient)->get();
        $new_patients = array();
        $i = 0;
        foreach ($select_name_patients as $select_name_patients2) {
            $this->list_patients[$this->i]['id'] = $select_name_patients2->id;
            $this->list_patients[$this->i]['name'] = $select_name_patients2->name;
            $this->list_patients[$this->i]['lastname'] = $select_name_patients2->lastname;
            $this->list_patients[$this->i]['pesel'] = $select_name_patients2->pesel;
            $this->list_patients[$this->i]['date'] = $hour[1];
            $this->list_patients[$this->i]['visit'] = $visit;
            $this->list_patients[$this->i]['id_visit'] = $id;
            $this->i++;
        }
        $this->list_patients = array_merge($this->list_patients,$new_patients);
        
    }
    private function select_id_doctors(int $id) {
        $doctor = new \App\Doctor();
        $id_doctor = $doctor->where("id_users",$id)->get();
        foreach ($id_doctor as $id_doctor2) {
            return $id_doctor2->id;
            
        }
    }
    private function division_drugs(string $drugs)  {
        $drugs1 = explode(",",$drugs);
        for ($i=0;$i < count($drugs1);$i++) {
            
            $drugs2[$i] = explode("/",$drugs1[$i]);
        }
        return $drugs2;
        
    }
    public function doctor_main() {
        $user = new \App\Http\Controllers\user();
        if ( (Auth::check()) and $user->check_if_what_admin_nurses_doctor(2) ) {
            
            $this->select_list_patients();

            return View("patients_register_visit")->with("list_patients",$this->list_patients);
        }
        else {

            return Redirect('/doctor/login')->with('error','Nieprawidłowy login lub hasło');
        }
        
    }
        
    public function patients_list(int $id,int $id_visit) {
        $user = new \App\Http\Controllers\user();
        if ( (Auth::check()) and $user->check_if_what_admin_nurses_doctor(2) ) {
            $list = $this->select_visit_id($id);
            $name = $this->select_name_patients_id($id);
            return View("visit_patients_id")->with("list",$list)
                    ->with("name",$name)
                    ->with("id_visit",$id_visit);
        }
        else {
            
             return Redirect('/doctor/login')->with('error','Nieprawidłowy login lub hasło');
        }
    }
    private function select_name_patients_id(int $id) {
        $patients = new \App\Patient();
        $name = $patients->where("id",$id)->get();
        return $name;
    }
    private function select_visit_id(int $id) {
        $patients = new \App\Patients_register();
        $list = $patients->selectRaw("patients_registers.patients_id as patients_id")
                ->selectRaw("patients_registers.date as date")
                ->selectRaw("doctors.id as id")
                ->selectRaw("doctors.name as name")
                ->selectRaw("doctors.lastname as lastname")
                ->join("doctors","patients_registers.doctors_id","doctors.id")
                ->where("patients_id",$id)
                ->where("if_visit",1)
                ->orderBy("date","DESC")->paginate(10);
        return $list;
        
    }
    private function select_drugs_last_visit( int $id_visit,int $patient_id) {
        $patients = new \App\Drug();
        $list = $patients->selectRaw("name as name")
                ->selectRaw("field1 as field1")
                ->selectRaw("field2 as field2")
                ->selectRaw("field3 as field3")
                ->selectRaw("field4 as field4")
                ->selectRaw("field5  as field5")
                ->selectRaw("field6  as field6")
                ->selectRaw("drugs.id_visit as id_visit")
                ->join("visits","visits.visit_id","drugs.id_visit")
                ->where("drugs.patients_id",$patient_id)
                ->get();
        
        
            return $list;
            //return $drugs->drugs;
        
        
        //dd($div_drugs);
        
    }
    

    private function check_diseases(int $id_visit) {
        $patients = new \App\Patients_register();
        $list = $patients->selectRaw("patients_registers.id as id")
                ->selectRaw("patients.diseases as diseases")
                ->join("patients","patients_registers.patients_id","patients.id")
                ->where("patients_registers.id",$id_visit)
                ->get();
        foreach ($list as $diseases) {
            return $diseases->diseases;
        }
        
    }
    private function select_id_doctor($id_visit) {
        $patients = new \App\Patients_register();
        $list = $patients->where("id",$id_visit)->get();
        foreach ($list as $list2) {
            return $list2->doctors_id;
        }
        
    }
    private function select_id_patient($id_visit) {
        $patients = new \App\Patients_register();
        $list = $patients->where("id",$id_visit)->get();
        foreach ($list as $list2) {
            return $list2->patients_id;
        }
        
    }
    private function check_if_visit_was(int $id_visit) {
        $visit = new \App\Patients_register();
        $if_visit = $visit->where("id",$id_visit)->where("if_visit",1)->count();
        if ($if_visit > 0) return false;
        else return true;
    }
    public function new_visit(int  $id_visit) {

         
        $diseases = $this->check_diseases($id_visit);

        $doctor_id = $this->select_id_doctor($id_visit);
        $patient_id = $this->select_id_patient($id_visit);
        $drugs = $this->select_drugs_last_visit($id_visit,$patient_id);
        if ($this->check_if_visit_was( $id_visit) == true ) {
            return View("new_visit_doctor")->with("id_visit",$id_visit)
                    ->with("diseases",$diseases)
                    ->with("drugs",$drugs)
                    ->with("patient_id",$patient_id)
                    ->with("doctor_id",$doctor_id);
        }
        
    }
    

}