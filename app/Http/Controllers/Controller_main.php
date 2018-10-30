<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use DB;
use Request;
use Hash;
use Illuminate\Http\File;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBlogPost;
use Auth;
class Controller_main  extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
 
    public function main() {
        $statistic = new Statistic;
 
        
        if (Auth::check()) 
        {
            print "dobrze";
        }
        else {

            return Redirect('login')->with('login_error','Nieprawidłowy login lub hasło');
        }
        
        
    }
    
    
    
}