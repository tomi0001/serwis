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
class Controller_login extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function login() {
        if (!Auth::check()) {
            return View("login");
        }
        else {
            
            return Redirect("main");
        }
    }
    public function login_action() {
        
        
        
         

        $user = array(
            'login' => Request::get('login'),
            'password' => Request::get('password')
        );
        

        if (Request::get('login') == "" and Request::get('password') == "" ) {
            return Redirect('login')->with('login_error','Uzupełnij pole login i hasło');
        }
        
        if (Auth::attempt($user))
        {
            return Redirect('main');
        }
        else {

            return Redirect('login')->with('login_error','Nieprawidłowy login lub hasło');
        }
        
        
    }
    
    
    
}