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
class Controller_admin extends BaseController
{
    public $errors = array();
    
    
    
    public function register_admin() {
        $admin = $this->check_if_admin();
        if (count($admin) != 0) {
            return Redirect("/admin/login");
        }
        else {
            return Redirect("/admin/register");
        }
        
    }
    
    private function check_if_admin() {
        
        $admin = App\Admin::all();
        return $admin;
    }
    public function registers_admin() {
        $admin = $this->check_if_admin();
        if (count($admin) == 0) {
                return view("register_admin");
        }
        else {
                return Redirect("/admin/login");
        
        }
        
    }
    
    public function setting() {
        $user = new \App\Http\Controllers\user();
        $how_visit = App\Admin::all();
        foreach ($how_visit as $how_visit2) {
            $visit = $how_visit2->how_visit;
        }
        if ( (Auth::check()) and  $user->check_if_what_admin_nurses_doctor(1) == true ) {
            return view("setting_admin")->with("visit",$visit);
        }
    }
    
    public function login_admin() {
        $user = new \App\Http\Controllers\user();
        
        if (Auth::check() and  ($user->check_if_what_admin_nurses_doctor(1) == true ) ) {
            return redirect("/admin/main");
         
        }
        else {
            return View("login_admin");
        }
        
    }
    
    public function register_action() {
        
        $user = new \App\Http\Controllers\user();
        $hour = new \App\Http\Controllers\hours_of_reception();
        $hour->check_minutes(Input::get("visit"));
        $admin = $this->check_if_admin();
        if (count($admin) == 0) {
            
            $bool = false;
            $error = array();

            $result = $user->check_password(Input::get("password"),Input::get("password_confirn"));
            if (Input::get("login") == "") {
                $bool = true;
                array_push($this->errors,"Musisz wpisać login");
            }
            if ($result == false ) {
                $bool = true;
                array_push($this->errors,"Podane hasła sa różne");
            }
            if (Input::get("password") == "") {
                $bool = true;
                array_push($this->errors,"Uzupełnij pole hasło");
            }
            if (count($hour->errors) != 0) {
                $bool = true;
                $this->errors = array_merge($this->errors, $hour->errors);
            }
            if ($bool == true)  {
                return Redirect("/admin/register")->with("error",$this->errors);
            }
            else {
                $user->add_user(1);
                $this->add_admin($user->id_users);
                return Redirect("/admin/main");
            }
        }
        else {
            return Redirect("/admin/login");
            
        }
             
             
        
    }

    public function add_doctor() {
        $user = new \App\Http\Controllers\user();
        if ( (Auth::check()) and  $user->check_if_what_admin_nurses_doctor(1) == true ) {
            return View("main_admin_add_doctor");
        }
        else {
             return Redirect('/admin/login');
            
        }
        
        
    }
    
    public function login_action() {
        $user = new \App\Http\Controllers\user();
        $admin = array(
            "login" => Input::get("login"),
            "password" => Input::get("password")
            
        );
        if (Input::get('login') == "" or Input::get('password') == "" ) {
            return Redirect('/admin/login')->with('error','Uzupełnij pole login i hasło');
        }
        if (Auth::attempt($admin) and $user->check_if_what_admin_nurses_doctor(1) == true) 
        
        {
         
                     return redirect("/admin/main");
           
            
        }
        else {

            return Redirect('/admin/login')->with('error','Nieprawidłowy login lub hasło');
        }
        
    }
    private function add_admin(int $id_user) {
        $admin = new \App\Admin;
        $admin->id_users = $id_user;
        $admin->how_visit = Input::get("visit");
        $admin->save();
        
    }
    public function setting_doctor() {
        $doctor = $this->select_dr();

        return View("setting_doctor_admin")->with("doctor",$doctor);
        
    }
    public function setting_nurses() {
        $nurse = $this->select_nurses();
        return View("setting_nurse_admin")->with("nurse",$nurse);
    }
    public function setting_doctor_id(int $id) {
        $dr = $this->select_dr_id($id);
        return View("setting_doctor_admin_id")->with("doctor",$dr);
    }
    public function setting_nurse_id(int $id) {
        $dr = $this->select_nr_id($id);
        return View("setting_nurse_admin_id")->with("doctor",$dr);
        
    }
    
    private function select_nr_id(int $id) {
        $nurse = new \App\Nurse();
        $nr = $nurse->where("id","=",$id)->get();
        $new_nr = array();
        foreach ($nr as $nr2) {
            $new_nr["name"] = $nr2->name;
            $new_nr["lastname"] = $nr2->lastname;
            $new_nr["id"] = $nr2->id_users;
        }
        return $new_nr;
        
    }
    
    private function select_dr_id(int $id) {
        $doctor = new \App\Doctor();
        $dr = $doctor->where("id","=",$id)->get();
        $new_dr = array();
        foreach ($dr as $dr2) {
            $new_dr["name"] = $dr2->name;
            $new_dr["lastname"] = $dr2->lastname;
            $new_dr["hour_open"] = substr($dr2->hour_open,0,5);
            $new_dr["hour_close"] = substr($dr2->hour_close,0,5);
            $new_dr["telefon_nr"] = $dr2->telefon_nr;
            $new_dr["id"] = $dr2->id_users;
        }
        return $new_dr;
        
    }

    private function select_dr() {
        $doctor = new \App\Doctor();
        $dr = $doctor->all();

        return $dr;
    }
    private function select_nurses() {
        $nurse = new \App\Nurse();
        $nr = $nurse->all();
      
        return $nr;
    }
    public function admin_main() {
        $user = new \App\Http\Controllers\user();
        if (   Auth::check() and  $user->check_if_what_admin_nurses_doctor(1) ) {
            return View("main_admin");
        }
        else {
             return Redirect('/admin/login');
            
        }
    }

    
    public function add_nurse() {
        $user = new \App\Http\Controllers\user();
        if ($user->check_if_what_admin_nurses_doctor(1) == true and  (Auth::check())) {
            return View("main_admin_add_nurse");
        }
        else {
             return Redirect('/admin/login');
            
        }
        
    }
    
 
    public function add_nurse_or_doctor_form($type) {
        
        $user = new \App\Http\Controllers\user();
        
        if ($user->check_if_what_admin_nurses_doctor(1) == true and  (Auth::check())) {
            if ($user->check_if_user(Input::get("login")) == true) {
                
                array_push($this->errors, "Login  o takiej nazwie juz istnieje");
            }
            
            $errors = $user->check_flap_for_doctor($type,$this);
            if ($type == "doctor") {
                $this->check_hour_doctor(Input::get("hour_open"),1);
                $this->check_hour_doctor(Input::get("hour_close"),2);
            }
            
            if (count($this->errors) != 0) {
                return redirect("/admin/add_$type")->with("errors",$this->errors);
                
            }
            else {
                
                if ($type == "doctor") {
                    $user->add_user(2);
                    $this->save_doctor($user->id_users);
                }
                else {
                    $user->add_user(3);
                    $this->save_nurse($user->id_users); 
                }
                return redirect("/admin/sukces")->with("sukces","Pomyslnie dodano doktora");
            }
            
        }
        else {
             return Redirect('/admin/login');
            
        }       
        
    }
    
    public function logout_action() {
        Auth()->logout();
        return redirect("/admin/login")->with("sukces","Wylogowałeś się");
        
    }
    public function check_hour_doctor($hour,int $nr) {
        //$error = array();
        $i = 0;
        $bool = false;
        if ($len = strlen($hour) != 5) {
            //$error[$i] = "Godzina $nr musi się skałdać z 5 znaków";
            array_push($this->errors,"Godzina $nr musi się składać z 5 znaków");
          //  $i++;
        }
        if ($sub = substr_count($hour,":") != 1) {
            //$error[$i] = "Godziny $nr nie są poprzedzone znakiem :";
            array_push($this->errors,"Godziny $nr nie są poprzedzone znakiem :");
            //$i++;
        }
        if ($sub != 1 ) {
            
            $division = explode(":",$hour);
             if (!preg_match ('/^[0-9]+$/', $division[0])) $bool = true;
             if (!preg_match ('/^[0-9]+$/', $division[1])) $bool = true;
             if ($bool == true) array_push ($this->errors, "Godzina $nr musi być wartością numeryczną");
        }
        //return $error;
    }
    public function sukces() {
        $user = new \App\Http\Controllers\user();
        if ($user->check_if_what_admin_nurses_doctor(1) == true and  (Auth::check())) {
            
            return view("sukces_admin");
        }
        else {
             return Redirect('/admin/login');
            
        }  
        
    }
    private function save_doctor(int $id_users) {

        
        $doctor = new \App\Doctor;
        $doctor->name = htmlspecialchars(Input::get("name"));
        $doctor->lastname = htmlspecialchars(Input::get("lastname"));
        $doctor->specializations = htmlspecialchars(Input::get("specializations"));
        $doctor->sex = htmlspecialchars(Input::get("sex"));
        $doctor->telefon_nr = htmlspecialchars(Input::get("telefon_nr"));
        $doctor->hour_open = Input::get("hour_open");
        $doctor->hour_close = Input::get("hour_close");
        $doctor->id_users = $id_users;
        $doctor->save();
        
    }
    private function save_nurse(int $id_users) {

        
        $nurse = new \App\Nurse;
        $nurse->name = htmlspecialchars(Input::get("name"));
        $nurse->lastname = htmlspecialchars(Input::get("lastname"));
        $nurse->sex = htmlspecialchars(Input::get("sex"));
        $nurse->id_users = $id_users;
        $nurse->save();
        
    }
    
}