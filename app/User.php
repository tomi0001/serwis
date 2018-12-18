<?php

namespace App;
use DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    public function search_user($name,$last_name,$age_from,$age_to,$city,$voivodeship) {
        $qustions =  new \App\User;
        if ($name != "") {
          $qustions  =   $this->where("name","like",$name);
        }
         if ($last_name != "") {
          $qustions  =   $this->where("last_name","like",$name);
        }
         if ($age_from != "") {
          $qustions =   $this->select(DB::raw("TIMESTAMPDIFF(YEAR, date_born, CURDATE()) as age "))->groupBy('age')->having("age",">=",$age_from);
        }
         if ($age_to != "") {
          $qustions =   $this->select(DB::raw("TIMESTAMPDIFF(YEAR, date_born, CURDATE()) as age "))->groupBy('age')->having("age","<=",$age_to);
        }
         if ($city != "") {
          $qustions =   $this->where("city","like",$name);
        }
         if ($voivodeship != "") {
          $qustions =   $this->where("voivodeship","like",$name);
        }
        
        return $qustions->get();
        
    }
}
