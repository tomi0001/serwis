<?php
/*
 * Autor Tomasz Leszczyński - tomi0001@gmail.com 2019
 * Wszelkie prawa zastrzeżone 
 */
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
class Controller_ajax_admin extends BaseController
{
    public $errors = array();
    public function modyfik_setting() {
        $hour = new \App\Http\Controllers\hours_of_reception();
        $hour->check_minutes(Input::get("visit"));
        
        
        if (count($hour->errors) == 0) {
            $this->update_minutes_visit();
            return View("ajax_sukces")->with("sukces","Poprawnie zmodyfikowałeś minuty");
        }
        else {
            return View("ajax_error_array")->with("error",$hour->errors);
            
        }
       
        
    }
    
    private function update_minutes_visit() {
        $admin = new \App\Admin;
        
        $admin->where("id_users",Auth::user()->id)->update(["how_visit"=>Input::get("visit")]);
        
    }
    
    public function modyfik_doctor_id() {
        $user = new \App\Http\Controllers\user();
        $admin = new \App\Http\Controllers\Controller_admin();
        $hour = new \App\Http\Controllers\hours_of_reception();
        $admin->check_hour_doctor(Input::get("hour_open"),1);
        $admin->check_hour_doctor(Input::get("hour_close"),2);
        if ($hour->compare_hour(Input::get("hour_open"),Input::get("hour_close")) ==false ) {
            array_push($admin->errors, "Godzina 1 jest większa od godziny drugiej");
        }
        $bool = false;
        if (Input::get("password") != "" or Input::get("password_new") != "" ) {
            $result = $user->check_password(Input::get("password"),Input::get("password_new"));
            if ($result == false) {
                array_push($this->errors, "Podane hasła się różnią");
                $admin->errors = array_merge($admin->errors, $this->errors);
            }
            $bool = true;
        }
        if (count($admin->errors) == 0) {
            $this->edition_doctor(Input::get("id"),$bool);
            if ($bool == true) {
                $user->edition_user(Input::get("id"));
            }
            return view("ajax_sukces")->with("sukces","Pomyslnie edytowano doktora");
        }
        else return view("ajax_error_array")->with("error",$admin->errors);
        
    }
    
    public function modyfik_nurse_id() {
        $user = new \App\Http\Controllers\user();
        $bool = false;
        if (Input::get("password") != "" or Input::get("password_new") != "" ) {
            $result = $user->check_password(Input::get("password"),Input::get("password_new"));
            if ($result == false) {
                array_push($this->errors, "Podane hasła się różnią");
            }
            $bool = true;
        }
        if (count($this->errors) == 0) {
            if ($bool == true) {
                $user->edition_user(Input::get("id"));
            }
            return view("ajax_sukces")->with("sukces","Pomyslnie edytowano doktora");
        }
        else return view("ajax_error_array")->with("error",$this->errors);
        
        
    }
    
    private function edition_doctor($id) {
        $doctor = new \App\Doctor;
        $user = new \App\User;
        $doctor->where("id_users","=",$id)
                ->update(["hour_open" => Input::get("hour_open"),
                          "hour_close" => Input::get("hour_close"),
                          "telefon_nr"=>Input::get("telefon_nr")]);

        
    }
    
}