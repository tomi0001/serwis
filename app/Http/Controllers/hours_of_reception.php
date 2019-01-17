<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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



class hours_of_reception extends BaseController
{
    private $i = 0;
    public $hour_open;
    public $hour_close;
    public $min;
    public $minutes = array();
    public $array_visit = array();
    public $errors = array();
    function __construct() {
        $admin = new \App\Admin();
        $adm = $admin->all();
        foreach ($adm as $adm2) {
            $this->min = $adm2->how_visit;
        }
        
    }
    public function check_doctor_minutes(string $hour_start,string $hour_end) {
        $doctor = new \App\Doctor();
        $hour_start2 = date("H:i:s",$hour_start);
        $hour_end2 = date("H:i:s",$hour_end);
        
        $qestion_hour_open  = $doctor->where("hour_open","<=",$hour_start2)->where("hour_close",">=",$hour_end2)->get();
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
    
    public function rename_id_at_name(string $array_doctor) {
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
    
    public function rename_hour_at_int(string $date) {
        $date2 = explode(" ",$date);
        $day = explode("-",$date2[0]);
        $hour = explode(":",$date2[1]);
        return mktime($hour[0],$hour[1],$hour[2],$day[1],$day[2],$day[0]);
        
    }
    public function check_minutes(string $minutes) {
        if (!is_numeric($minutes) or strstr($minutes, ".")) array_push($this->errors, "Liczba nie jest liczbą całkowitą");
        if ($minutes < 5 or $minutes > 240) array_push($this->errors, "Liczba minut musi się mieścić w zakresie od 5 do 240 minut");
        
    }
    
    
    public function set_array_hour_doctor(int $second_int) {
        $doctor = new \App\Doctor();

        $explode_data_open  = explode(":",$this->hour_open);
        $explode_data_close  = explode(":",$this->hour_close);
        $data_open  = mktime($explode_data_open[0],$explode_data_open[1],$explode_data_open[2],date("m"),date("d"),date("Y"));
        $data_close = mktime($explode_data_close[0],$explode_data_close[1],$explode_data_close[2],date("m"),date("d"),date("Y"));
        $i = $data_open;
        while($i < $data_close) {

            $check = $doctor->where("hour_open","<=",date("H:i:s",$i))->where("hour_close",">",date("H:i:s",$i + $second_int))->get();
            if ($i + ($this->min * 60) > $data_close) break;
            if (count($check) == 0) {
                $i+=60;
            }
            else {
                $this->check_doctor_minutes($i,$i+$second_int);
                $i+=$second_int;
            }
            
        }

        
        
    }

    public function set_minutes(int $minutes) {
        $doctor = new \App\Doctor();
        $hour_open_tmp = explode(":",$this->hour_open);
        $hour_close_tmp = explode(":",$this->hour_close);
        $hour_open_tmp2 = mktime($hour_open_tmp[0],$hour_open_tmp[1],$hour_open_tmp[2],date("m"),date("d"),date("Y"));
        $hour_close_tmp2 = mktime($hour_close_tmp[0],$hour_close_tmp[1],$hour_close_tmp[2],date("m"),date("d"),date("Y"));
        $result = $hour_close_tmp2 - $hour_open_tmp2;
        $result_minutes = $result / $minutes;
        $j = 0;
        $i = $hour_open_tmp2;
        while($i < $hour_close_tmp2) {
            $check = $doctor->where("hour_open","<=",date("H:i:s",$i))->where("hour_close",">",date("H:i:s",$i + $minutes))->get();
            if ($i + (60 * $this->min) > $hour_close_tmp2) break;
            if (count($check) == 0) {
                $i+=60;
            }
            else {
                $this->array_visit['hour'][$j] = date("H:i:s",$i);
                $i+= $minutes;
                $j++;
            }
        }
         
         
        
    }
    public function compare_hour(string $hour_open,string $hour_close) {
        $hour_open_explode = explode(":",$hour_open);
        $hour_close_explode = explode(":",$hour_close);
        if ($hour_open_explode[0] < $hour_close_explode[0]) return true;
        elseif ($hour_open_explode[0] == $hour_close_explode[0]) {
            if ($hour_open_explode[1] < $hour_close_explode[1]) return true;
            else return false;
            
        }
        else return false;
        
    }
    public function set_common_hour_for_doctors(int $minutes_for_1_visit) {
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
    public function check_hour_closed() {
        $close_hour = explode(":",$this->hour_close);
        if ($close_hour[0] == "00") $this->hour_close = "23:59:00";
        
    }
    public function select_common_hour() {
        $doctor = new \App\Doctor();
        $hour_1 = $doctor->where("hour_open",">=","00:00:00")->orderBy("hour_open")->limit(1)->get();
        $hour_2 = $doctor->where("hour_close","<=","23:59:00")->orderBy("hour_close","DESC")->limit(1)->get();
        foreach ($hour_1 as $hour_11)  $this->hour_open =  $hour_11->hour_open;
        foreach ($hour_2 as $hour_22)  $this->hour_close =  $hour_22->hour_close;

        
    }    
    
}