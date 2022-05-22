<?php

/*
|--ss------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('log_out', function(){
    Auth::logout();
    Session::flush();
    return Redirect::to('/');
 });
Route::post('patient_information_upload','PatientController@patient_information_upload');

Route::post('nurse_information_upload','NurseController@nurse_information_upload');

Route::get('/',"AdminController@home");

Route::get('intaker', function () {
    return view('intaker.patients_profile');
});


Route::get('export', 'ExcelController@export');





Route::get('patients_profile', function () {
    return view("intaker.patients_profile");
});


Route::get('nurse_profile', function () {
    return view("intaker.nurse_profile");
});

Route::post('import','ExcelController@import');

Route::post('nurse_file_import','ExcelController@nurse_file_import');


Route::get('scheduler','SchedulerController@main_page');
Route::post('assign_nurse','ExcelController@assign_nurse');

Route::get('patient_list','SchedulerController@show_patient_list');

Route::post('search_nurse','SchedulerController@search_nurse');





Route::get('distance_test','SchedulerController@distance_api_integrate');

Route::post('fetch_calendar_data','SchedulerController@fetch_calendar_data');

Route::post('submit_nurse','SchedulerController@submit_nurse');
Route::post('show_nurse_assign_modal','SchedulerController@show_nurse_assign_modal');

Route::get('admin','AdminController@main_page');

Route::get('super_admin','AdminController@super_admin_main_pages');

Route::get('create_user','AdminController@view_create_user');
Route::post('create_user','AdminController@create_user');

Route::post('login','AdminController@login');

Route::post('check_email_validity','AdminController@check_email_validity');


Route::get('view_user','AdminController@view_user_page');

Route::post('get_user_role_super_admin','AdminController@get_user_role_super_admin');

Route::post('update_user_role','AdminController@update_user_role');

Route::post('update_user_password','AdminController@update_user_password');

Route::post('delete_user','AdminController@delete_user');
Route::get('get_assigned_patient_data','AdminController@get_assigned_patient_data');

Route::get('get_assigned_nurse_data','AdminController@get_assigned_nurse_data');


Route::get('view_patient_List','PatientController@show_patient_list');

Route::get('view_nurse_List','NurseController@show_nurse_list');





