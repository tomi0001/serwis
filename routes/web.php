<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', "Controller_register@register");
Route::post('/register_action', "Controller_register@register_submit");
Route::get("/login","Controller_login@login");
Route::post("/login_action","Controller_login@login_action");
Route::get("/main","Controller_main@main");
Route::get("/","Controller_main@main");
