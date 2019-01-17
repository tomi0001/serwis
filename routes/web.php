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
Route::get("/admin/setting_nurses","Controller_admin@setting_nurses");
Route::get("/admin/setting_nurse/{id?}","Controller_admin@setting_nurse_id");
Route::get("/admin/logout","Controller_admin@logout_action");



Route::get("/admin/modyfik_doctor_id","Controller_ajax_admin@modyfik_doctor_id");
Route::get("/admin/modyfik_nurse_id","Controller_ajax_admin@modyfik_nurse_id");
Route::get("/ajax_admin/modyfik_setting","Controller_ajax_admin@modyfik_setting");



Route::get("/nurses/login","Controller_nurses@login_nurses");
Route::post("/nurses/login_action","Controller_nurses@login_action");
Route::get("/nurses/main/{year?}/{month?}/{day?}/{action?}","Controller_nurses@nurses_main");
Route::get("/nurses/logout","Controller_nurses@logout_action");
Route::get("/nurses/add_patients","Controller_nurses@add_patients");
Route::get("/nurses/add_patients_action","Controller_nurses@add_patients_action");
Route::get("/nurses/patients_list","Controller_nurses@patients_list");
Route::get("/nurses/patients_list/{id?}","Controller_nurses@patients_list_id");

Route::get("/ajax_nurses/delete_visit","Controller_ajax_nurses@delete_visit");
Route::get("/ajax_nurser/register_to_doctor","Controller_ajax_nurses@register_to_doctor");


Route::get("/doctor/login","Controller_doctor@login_doctor");
Route::post("/doctor/login_action","Controller_doctor@login_action");
Route::get("/doctor/main","Controller_doctor@doctor_main");
Route::get("/doctor/logout","Controller_doctor@logout_action");
Route::get("/doctor/patients_list/{id?}/{id_visit?}","Controller_doctor@patients_list");
Route::get("/doctor/new_visit/{id_visit?}","Controller_doctor@new_visit");
Route::get("/doctor/new_visit_submit","Controller_ajax_doctor@save_visit");