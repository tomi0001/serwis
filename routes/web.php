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

Route::get('/admin', "Controller_admin@register_admin");
Route::get('/admin/register', "Controller_admin@registers_admin");
Route::get('/admin/login', "Controller_admin@login_admin");
Route::post('/admin/register_action', "Controller_admin@register_action");
Route::post("/admin/login_action","Controller_admin@login_action");
Route::get("/admin/main","Controller_admin@admin_main");
Route::get("/admin/add_doctor","Controller_admin@add_doctor");
Route::post("/admin/add_doctor_form/{type?}","Controller_admin@add_nurse_or_doctor_form");
Route::post("/admin/add_nurse_form/{type?}","Controller_admin@add_nurse_or_doctor_form");
Route::get("/admin/sukces","Controller_admin@sukces");
Route::get("/admin/add_nurse","Controller_admin@add_nurse");
Route::get("/admin/setting","Controller_admin@setting");
Route::get("/admin/setting_doctor","Controller_admin@setting_doctor");
Route::get("/admin/setting_doctor/{id?}","Controller_admin@setting_doctor_id");

Route::get("/nurses/login","Controller_nurses@login_nurses");
Route::post("/nurses/login_action","Controller_nurses@login_action");
Route::get("/nurses/main/{year?}/{month?}/{day?}/{action?}","Controller_nurses@nurses_main");
Route::get("/nurses/logout","Controller_nurses@logout_action");
Route::get("/nurses/add_patients","Controller_nurses@add_patients");
Route::get("/nurses/add_patients_action","Controller_nurses@add_patients_action");


Route::get("/ajax_nurser/register_to_doctor","Controller_ajax_nurses@register_to_doctor");
Route::get("/ajax_admin/modyfik_setting","Controller_ajax_admin@modyfik_setting");