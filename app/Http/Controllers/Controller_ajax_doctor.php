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
class Controller_ajax_doctor extends BaseController
{
    public $error = false;
    public $visit_text = false;
    public function save_visit() {
            
            if ($this->check_correctness_field(Input::get("drugs1")) == false) {
                $this->error = true;
            }
            if ($this->check_correctness_field(Input::get("drugs2")) == false) {
                $this->error = true;
            }
            if ($this->check_correctness_field(Input::get("drugs3")) == false) {
                $this->error = true;
            }
            if ($this->check_correctness_field(Input::get("drugs4")) == false) {
                $this->error = true;
            }
            if ($this->check_correctness_field(Input::get("drugs5")) == false) {
                $this->error = true;
            }
            if ($this->check_correctness_field(Input::get("drugs6")) == false) {
                $this->error = true;
            }
            if ($this->check_correctness_field(Input::get("drugs7")) == false) {
                $this->error = true;
            }
            if (Input::get("visit_text") == "") $this->visit_text = true;
            
            if ($this->error == true or $this->visit_text == true) return View("ajax_error")->with("error","Uzupełnij pola");
            else {
                $field = $this->implode_field();
                $count = $this->check_if_good_id_patients(Input::get("patient_id"),Input::get("doctor_id"));
                if ($count == true) {
                    print "sd";
                   $visit_id =  $this->save_field($field);
                   $this->save_drugs($visit_id);
                   $this->set_up_visit($visit_id);
                   $this->update_diseases(Input::get("patient_id"));
                   
                }
                else print "d";
                
            }
            
        
        
    }
    private function update_diseases($id_patient) {
        $diseases = new \App\Patient();
        $diseases->where("id",$id_patient)->update(["diseases"=>Input::get("diseases")]);
        
    }
    private function set_up_visit($id_visit) {
        $visit = new \App\Patients_register();
        $visit->where("id",$id_visit)->update(["if_visit"=>1]);
        
    }
    private function check_if_good_id_patients($id_patient,$id_doctor) {
        $register = new \App\Patients_register();
        $date_up = date("Y-m-d") . " 23:59:59";
        $date_down = date("Y-m-d") . " 00:00:00";
        $count = $register->where("date", ">",$date_down)
                  ->where("date","<",$date_up)
                  ->where("patients_id",$id_patient)
                  ->where("doctors_id",$id_doctor)->count();
        if ($count > 0) return true;
        else return false;
        
        
    }
    private function save_field(string $field) {
        $doctor = new \App\Visit();
        $doctor->patients_id = Input::get("patient_id");
        $doctor->doctors_id = Input::get("doctor_id");
        $doctor->visit_text = Input::get("visit_text");
        $doctor->date = date("Y-m-d H:i:s");
        $doctor->drugs = $field;
        $doctor->visit_id = Input::get("id_visit");
        $doctor->save();
        $id_last = $doctor->orderBy("id","DESC")->limit(1)->get();
        foreach ($id_last as $id_last2) return $id_last2->visit_id;
        
        
        
    }
    private function save_drugs($id_visit) {
        
        
        for ($i=0;$i < count(Input::get("drugs1"));$i++) {
            $drugs  = new \App\Drug();
            $drugs->name = Input::get("drugs1")[$i];
            $drugs->field1 = Input::get("drugs2")[$i];
            $drugs->field2 = Input::get("drugs3")[$i];
            $drugs->field3 = Input::get("drugs4")[$i];
            $drugs->field4 = Input::get("drugs5")[$i];
            $drugs->field5 = Input::get("drugs6")[$i];
            $drugs->field6 = Input::get("drugs7")[$i];
            $drugs->id_visit = $id_visit;
            $drugs->patients_id = Input::get("patient_id");
            $drugs->save();
            
        }
        
    }
    private function implode_field() {
        $field1 = implode("<br>",Input::get("drugs1"));
        $field2 = implode("<br>",Input::get("drugs2"));
        $field3 = implode("<br>",Input::get("drugs3"));
        $field4 = implode("<br>",Input::get("drugs4"));
        $field5 = implode("<br>",Input::get("drugs5"));
        $field6 = implode("<br>",Input::get("drugs6"));
        $field7 = implode("<br>",Input::get("drugs7"));
        return $field1 . "/" . $field2 . "/" . $field3 . "/" . $field4 . "/" . $field5 . "/" . $field6 . "/" . $field7;
        
    }
    
    
    private function check_correctness_field(array $field) {
        if (empty($field)) return true;
        for ($i=0;$i < count($field);$i++) {
            if ($field[$i] == "") return false;
            
        }
        return true;
    }
    
}