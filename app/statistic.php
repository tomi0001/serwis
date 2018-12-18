<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class statistic extends Model
{
    public function add($how_page,$ip,$http_user_agent,$users_id,$date) {
        
        $this->insert(
         [
            ['how_page' => $how_page, 
                'ip' => $ip, 
                'http_user_agent' => $http_user_agent,
                'users_id' => $users_id,
                'date' => $date
            ]
     
        ]);
    }
    public function show($id) {
        return $this->where("users_id",$id);
        
    }
    public function User()  {
        
        return $this->belongsTo('App\User',"users_id","id")->select("login");
        
    }


}
