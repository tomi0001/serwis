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
class user extends BaseController
{
    public $id_users;
    
    public function check_password($password,$password_confirn) {
        if ($password != $password_confirn) return false;
        else return true;
        
    }
    public function check_if_user($login) {
        $user = \App\User::where('login', '=', $login)->get();
        if (count($user) == 0) return false;
        else return true;
    }
    public function check_flap_for_doctor($type,$admin) {
        //$admin = new \App\Http\Controllers\Controller_admin();
        if (Input::get("name") == "") {
            array_push($admin->errors, "Uzupełnij pole imię");
            
        }
        if (Input::get("lastname") == "") {
            array_push($admin->errors, "Uzupełnij pole nazwisko");
            
        }
        if (Input::get("specializations") == "" and $type == "doctor") {
            array_push($admin->errors, "Uzupełnij pole specjalizacja");
            
        }
        if (Input::get("login") == "") {
            array_push($admin->errors, "Uzupełnij pole login");
            
        }
        if (preg_match('[0-9]', Input::get("name"))) {
            array_push($admin->errors, "Pole imię zawiera cyfry");
            
            
        }
        if (preg_match('[0-9]', Input::get("lastname"))) {
            array_push($admin->errors, "Pole nazwisko zawiera cyfry");
            
            
        }
        if (Input::get("password") == "") {
            array_push($admin->errors, "Wpisz hasło");
            
            
        }
       
        
    }
    
    public function add_user($role) {
        $user = new \App\User;
        $user->login = htmlspecialchars(Input::get("login"));
        $user->password = Hash::make(Input::get("password"));
        $user->role = $role;
        $user->save();
        $this->id_users =  $user->id;
    }
    public function check_if_what_admin_nurses_doctor($role) {
      if ( (Auth::check())   ) {
        $user = \App\User::where('id', '=', Auth::User()->id)->get();
            foreach ($user as $user_tab) {
                if ($user_tab->role == $role) {
                    return true;
                } 
        }
       }
        return false;
    }
    
}