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
class Controller_nurses extends BaseController
{

    public $errors = array();
    
    public function login_nurses() {
        $user = new \App\Http\Controllers\user();
        if ( !(Auth::check()) or !$user->check_if_what_admin_nurses_doctor(3) ) {
            return view("login_nurses");
        }
        else {
            
            return redirect("/nurses/main");
        }
        
    }
    public function logout_action() {
        Auth()->logout();
        return redirect("/nurses/login")->with("sukces","Wylogowałeś się");
        
    }
    public function add_patients() {
        $user = new \App\Http\Controllers\user();
        if ( (Auth::check()) or $user->check_if_what_admin_nurses_doctor(3) ) {
            return View("add_patients");
            
        }
        
    }
    
    
    
    public function add_patients_action() {
        $int = (int) Input::get("nr");
        if (Input::get("name") == "") {
            array_push($this->errors,"Podaj imię pacjenta");
        }
        if (Input::get("lastname") == "") {
            array_push($this->errors,"Podaj nazwisko pacjenta");
        }
        if (Input::get("pesel") == "") {
            array_push($this->errors,"Podaj pesel pacjenta");
        }
        if (strlen(Input::get("pesel")) != 11) {
            array_push($this->errors,"Pesel pacjenta musi się skaładać z 11 znaków");
        }
        if (Input::get("adress") == "") {
            array_push($this->errors,"Podaj adres pacjenta");
        }
        if (Input::get("nr") == "") {
            array_push($this->errors,"Podaj numer telefonu pacjenta");
        }
        if ($int == 0 or strstr(Input::get("nr"),".")) {
            array_push($this->errors,"Numer telefonu musi być liczbą");
        }
        if (Input::get("date") == "") {
            array_push($this->errors,"Podaj date urodzenia pacjenta");
        }
        if (Input::get("date") != "") {
            $date = explode("-",Input::get("date"));
            $datetime = mktime(0,0,0,$date[1],$date[2],$date[0]);
            if ($datetime > time()) {
                array_push($this->errors,"Data urodzenia pacjenta jest większa od terazniejszej daty");
            }
        }
        if ($this->check_if_is_patient_pesel(Input::get("pesel"))) {
            array_push($this->errors,"Już jest pacjent o takim peselu");
        }
        if (Input::get("name") == "") {
            array_push($this->errors,"Podaj imię pacjenta");
        }
        if (count($this->errors) != 0) {
            return redirect("/nurses/add_patients")->with("errors",$this->errors)->withInput();
        }
        else {
            $this->save_patients();
            return redirect("/nurses/add_patients")->with("succes","Pomyslnie dodano pacjenta");
        }
    }
    private function save_patients() {
        $patients = new \App\Patient();
        $patients->name = Input::get("name");
        $patients->lastname = Input::get("lastname");
        $patients->date_born = Input::get("date");
        $patients->pesel = Input::get("pesel");
        $patients->adress = Input::get("adress");
        $patients->sex = Input::get("sex");
        $patients->telefon_nr = Input::get("nr");
        $patients->diseases = Input::get("diseases");
        $patients->save();
        
    }
    private function check_if_is_patient_pesel($pesel) {
        $patients = new \App\Patient();
        $check = $patients->where("pesel",$pesel)->get();
        if (count($check) == 0) return false;
        else return true;
        
        
    }


    public function nurses_main($year = "",$month = "",$day = "",$action = "") {
            
        $user = new \App\Http\Controllers\user();
        if ( (Auth::check()) or $user->check_if_what_admin_nurses_doctor(3) ) {
            $kalendar = new \App\Http\Controllers\kalendar();
            $hours_of_reception = new \App\Http\Controllers\hours_of_reception();
            $kalendar->set_date($month,$action,$day,$year);
            $how_day_month = $kalendar->check_month($kalendar->month,$kalendar->year);
            $back_month = $kalendar->return_back_month($kalendar->month,$kalendar->year);
            $next_month = $kalendar->return_next_month($kalendar->month,$kalendar->year);
            $text_month = $kalendar->return_month_text($kalendar->month);
            $next_year  = $kalendar->return_next_year($kalendar->year);
            $back_year  = $kalendar->return_back_year($kalendar->year);
            $hours_of_reception->select_common_hour();
            $hours_of_reception->set_minutes(60 * $hours_of_reception->min);
            $patients = $this->select_patients();
            $hours_of_reception->check_hour_closed();
            $hours_of_reception->set_array_hour_doctor(60 * $hours_of_reception->min);


            return view("main_nurses")
                    ->with("month",$kalendar->month)
                    ->with("year",$kalendar->year)
                    ->with("day",$kalendar->day)
                    ->with("action",$kalendar->action)
                    ->with("how_day_month",$how_day_month)
                    ->with("back",$back_month)
                    ->with("next",$next_month)
                    ->with("back_year",$back_year)
                    ->with("next_year",$next_year)
                    ->with("text_month",$text_month)
                    ->with("day2",1)
                    ->with("day1",1)
                    ->with("day3",$kalendar->day)
                    ->with("day_week",$kalendar->day_week)
                    ->with("array_doctor",$hours_of_reception->array_visit)
                    ->with("patients",$patients)
                    ->with("date",$year . "-" . $month . "-" . $day . "?");
           
        }
        else {
            
            return Redirect('/nurses/login')->with('error','Wylogowałeś się');
        }
        
    }

    private function select_patients() {
        $patients = new \App\Patient();
        $select = $patients->all();
        return $select;
        
    }

    public function login_action() {
        $user = new \App\Http\Controllers\user();
        $nurses = array(
            "login" => Input::get("login"),
            "password" => Input::get("password")
            
        );
        if (Input::get('login') == "" or Input::get('password') == "" ) {
            return Redirect('/nurses/login')->with('error','Uzupełnij pole login i hasło');
        }
        if (Auth::attempt($nurses) and $user->check_if_what_admin_nurses_doctor(3)  == true) 
        
        {
         
                     return redirect("/nurses/main");
           
            
        }
        else {

            return Redirect('/nurses/login')->with('error','Nieprawidłowy login lub hasło');
        }
    }
    
    
}