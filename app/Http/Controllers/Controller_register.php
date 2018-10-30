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
class Controller_register extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function register() {
        
        return View("register");
        
        
    }
    
    public function register_submit(StoreBlogPost $request) {

        
     $rules = $request->rules();
     $validation = Validator::make(Request::all(), $rules);
     if ($validation->fails() )
      {

            return Redirect('register')->withErrors($validation)->withInput();
    
        
      }   
      else return $this->save_user();
    }


        
      private function save_user()   {
            
            $user = new \App\User;
            $user->password = Hash::make(Request::get('password'));
            $user->login = htmlspecialchars(Request::get('login'));
            $user->email = htmlspecialchars(Request::get('email'));
            $user->name = htmlspecialchars(Request::get('name'));
            $user->lastname = htmlspecialchars(Request::get('lastname'));
            $user->date_born = htmlspecialchars(Request::get('born'));
            $user->city = htmlspecialchars(Request::get('city'));
            $user->telefon_nr = htmlspecialchars(Request::get('telefon'));
            $user->voivodeship = htmlspecialchars(Request::get('voivodeship'));
            $user->education = htmlspecialchars(Request::get('education'));
            $user->addiction  = htmlspecialchars(Request::get('addiction'));
            $user->interested  = htmlspecialchars(Request::get('interested'));
            $user->hobby = htmlspecialchars(Request::get('hobby'));
            $user->sex = htmlspecialchars(Request::get('sex'));
            if (Request::file('file') != "") {
                $path = Storage::put('public',Request::file('file')); 
                $user->image = htmlspecialchars($path);
            }
            $user->date_register = date("Y-m-d H:i:s");
            if ($user->save())
            {       
                    return Redirect('login')->with('login_sukces','ZArejestrowałęś się pomyślnie możesz się teraz zalogować');
            }
      }

}
