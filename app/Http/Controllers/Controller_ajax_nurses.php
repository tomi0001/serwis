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
class Controller_ajax_nurses extends BaseController
{

    public function register_to_doctor() {
      $user = new \App\Http\Controllers\user();
        if ( (Auth::check()) or $user->check_if_what_admin_nurses_doctor(3) ) {
        $user = new \App\Http\Controllers\user();
        $hour2 = new \App\Http\Controllers\hours_of_reception();
        $hour = str_replace("?"," ",Input::get("hour"));
        $date_hour = $hour2->rename_hour_at_int($hour);
        $int = $date_hour + $hour2->min * 60;
        $date_hour = $hour2->rename_hour_at_int($hour);
        $date_hour_close = date("Y-m-d H:i:s",$int);
        $date_now = $hour2->rename_hour_at_int(date("Y-m-d H:i:s"));
        if ( (Auth::check()) or $user->check_if_what_admin_nurses_doctor(3) ) {
        
            $check = $this->check_if_is_visit_register($hour,$date_hour_close);
            if ($date_hour < $date_now) {
                return View("ajax_error")->with("error","Rejestracja są tylko na późniejsze godziny");
            }
            else if ($check == true) {
                $this->save_registration($hour,$date_hour_close);
                return View("ajax_sukces")->with("sukces","Pomyślnie zarejestrowałeś pacjenta");
            }
            else {
                return View("ajax_error")->with("error","Już jest taki pacjent zarejestrowany do takiego lekarza");
            }
        }
      }
        //    print "d";
        
    }
    private function check_if_is_visit_register($hour,$hour_close) {
        
        $visit = new \App\patients_register();
        $hour2 = new \App\Http\Controllers\hours_of_reception();
        
        //$count = $visit->whereRaw("(date >= '$hour' and date_close >= '$hour_close')")->get();
        //print count($count);
  
        $count = $visit
                ->where("date",">=",$hour)
                ->where("date_close","<=",$hour_close)
                ->where("doctors_id","=",Input::get("doctor"))->get();
        $count2 = $visit
                ->where("date",">=",$hour)
                ->where("date_close","<=",$hour_close)
                ->where("patients_id","=",Input::get("patients"))->get();
        
 
        if ( count($count) == 0  and count($count) == 0) return true;
        else {
            return false;
        }
 
 
        
    }
    public function delete_visit() {
        $user = new \App\Http\Controllers\user();
        if ( (Auth::check()) or $user->check_if_what_admin_nurses_doctor(3) ) {
            if ($this->check_if_visit_is_true(Input::get("id"))) {
                $this->delete_visit_id(Input::get("id"));
               
            }
            
        }
        
    }
    private function delete_visit_id($id) {
        $visit = new \App\patients_register();
        $visit->where("id",$id)->delete();
    }
    private function check_if_visit_is_true($id) {
        $visit = new \App\patients_register();
        $count = $visit->where("id",$id)
               ->where("if_visit",0)->count();
        if ($count != 0) return true;
        else return false;
        
    }
    private function save_registration($hour,$hour_close) {
        $visit = new \App\patients_register();
        $visit->patients_id = Input::get("patients");
        $visit->doctors_id = Input::get("doctor");
        $visit->date = $hour;
        $visit->date_close = $hour_close;
        $visit->if_visit = false;
        $visit->save();
        
    }
    
}