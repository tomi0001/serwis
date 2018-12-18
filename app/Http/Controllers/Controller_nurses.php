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
    public $hour_open;
    public $hour_close;
    public $minutes = array();
    public $array_visit = array();
    private $i = 0;
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
    private function check_doctor_minutes($hour_start,$hour_end) {
        $doctor = new \App\Doctor();
        $hour_start = date("H:i:s",$hour_start);
        $hour_end = date("H:i:s",$hour_end);
        $qestion_hour_open  = $doctor->where("hour_open","<=",$hour_start)->where("hour_close",">=",$hour_end)->get();
        foreach ($qestion_hour_open as $qestion_hour_open2) {
            if (!empty($this->array_visit['id'][$this->i])) {
                $this->array_visit['id'][$this->i] .= "," . $qestion_hour_open2->id;
            }
            else {
                $this->array_visit['id'][$this->i] =  $qestion_hour_open2->id;
            }

        }
        
        $this->array_visit['name'][$this->i] = $this->rename_id_at_name($this->array_visit['id'][$this->i]);
        $this->array_visit['id'][$this->i] = explode(",",$this->array_visit['id'][$this->i]);
        $this->i++;
    }
    private function rename_id_at_name($array_doctor) {
        $doctor = new \App\Doctor();
        $array = explode(",",$array_doctor);
        $name3 = array();
        for ($i=0;$i < count($array);$i++) {
            $name  = $doctor->where("id","=",$array[$i])->get();
            
            foreach ($name as $name2) {
                $name3[$i] = $name2->name . " " . $name2->lastname;
            }
        }
        
        
        return $name3;
    }
    private function set_array_hour_doctor($second_int) {
 
        //$array_doctor = array();

        $explode_data_open  = explode(":",$this->hour_open);
        $explode_data_close  = explode(":",$this->hour_close);
        $data_open  = mktime($explode_data_open[0],$explode_data_open[1],$explode_data_open[2],date("m"),date("d"),date("Y"));
        $data_close = mktime($explode_data_close[0],$explode_data_close[1],$explode_data_close[2],date("m"),date("d"),date("Y"));

        for ($i=$data_open;$i < $data_close;$i+=$second_int) {
            
            $this->check_doctor_minutes($i,$i+$second_int);

        }

        
        
    }
    public function nurses_main($year = "",$month = "",$day = "",$action = "") {
            
        $user = new \App\Http\Controllers\user();
        if ( (Auth::check()) or $user->check_if_what_admin_nurses_doctor(3) ) {
            $kalendar = new \App\Http\Controllers\kalendar();
            $kalendar->set_date($month,$action,$day,$year);
            $how_day_month = $kalendar->check_month($kalendar->month,$kalendar->year);
            $back_month = $kalendar->return_back_month($kalendar->month,$kalendar->year);
            $next_month = $kalendar->return_next_month($kalendar->month,$kalendar->year);
            $text_month = $kalendar->return_month_text($kalendar->month);
            $next_year  = $kalendar->return_next_year($kalendar->year);
            $back_year  = $kalendar->return_back_year($kalendar->year);
            $this->select_common_hour();
            $this->set_minutes(60 * 30);
            
            $this->check_hour_closed();
            //print $this->hour_open;
            $this->set_array_hour_doctor(60 * 30);
            print ("<pre>");
            
            print_r($this->array_visit);
            print ("</pre>");
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
                    ->with("array_doctor",$this->array_visit);
            
        }
        else {
            
            return Redirect('/nurses/login')->with('error','Wylogowałeś się');
        }
        
    }
    public function set_minutes($minutes) {
        $hour_open_tmp = explode(":",$this->hour_open);
        $hour_close_tmp = explode(":",$this->hour_close);
        print $this->hour_close;
        $hour_open_tmp2 = mktime($hour_open_tmp[0],$hour_open_tmp[1],$hour_open_tmp[2],date("m"),date("d"),date("Y"));
        $hour_close_tmp2 = mktime($hour_close_tmp[0],$hour_close_tmp[1],$hour_close_tmp[2],date("m"),date("d"),date("Y"));
        $result = $hour_close_tmp2 - $hour_open_tmp2;
        $result_minutes = $result / $minutes;
        $j = 0;
        for ($i=$hour_open_tmp2;$i < $hour_close_tmp2;$i+= $minutes) {
            $this->array_visit['hour'][$j] = date("H:i:s",$i);
            $j++;
        }
         
         
        
    }
    private function set_common_hour_for_doctors($minutes_for_1_visit) {
        if ($this->hour_open == $this->hour_close) {
            $common_time = 3600 * 24;
        }
        else {
            $data_open  = date("Y-m-d") . " " . $this->hour_open;
            $data_close = date("Y-m-d") . " " . $this->hour_close;
            $common_time = time($data_close) - time($data_open);
        }
        $minutes_for_1_visit *= 60;
        return (int) ($common_time / $minutes_for_1_visit);
        

    }
    private function check_hour_closed() {
        $close_hour = explode(":",$this->hour_close);
        if ($close_hour[0] == "00") $this->hour_close = "23:59:00";
        
    }
    private function select_common_hour() {
        $doctor = new \App\Doctor();
        $hour_1 = $doctor->where("hour_open",">=","00:00:00")->orderBy("hour_open")->limit(1)->get();
        $hour_2 = $doctor->where("hour_close","<=","23:59:00")->orderBy("hour_close","DESC")->limit(1)->get();
        foreach ($hour_1 as $hour_11)  $this->hour_open =  $hour_11->hour_open;
        foreach ($hour_2 as $hour_22)  $this->hour_close =  $hour_22->hour_close;

        
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