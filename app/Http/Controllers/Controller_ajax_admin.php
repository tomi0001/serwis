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
class Controller_ajax_admin extends BaseController
{
    
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
    
    
    
}