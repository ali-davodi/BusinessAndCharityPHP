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

Route::match(['get', 'post'], '/', 'UserProfile@show')->middleware('user.check');
Route::match(['get', 'post'], '/admin', 'UserProfile@admin')->middleware('user.check');
Route::match(['get', 'post'], '/register', 'UserProfile@register')->middleware('user.check');
Route::match(['get', 'post'], '/departments/request', 'Departments@request')->middleware('user.check');
Route::match(['get', 'post'], '/departments/list/{id}-{name}', 'Departments@getDepartment')->middleware('user.check');
Route::match(['get', 'post'], '/departments/list', 'Departments@list')->middleware('user.check');
Route::match(['get', 'post'], '/departments/create', 'Departments@create')->middleware('user.check');
Route::match(['get', 'post'], '/departments/edit/{id}', 'Departments@create')->middleware('user.check');
Route::match(['get', 'post'], '/departments/delete/{id}', 'Departments@delete')->middleware('user.check');
Route::match(['get', 'post'], '/departments/users/{id}', 'Departments@users')->middleware('user.check');
Route::match(['get', 'post'], '/departments/users/{id}/act/{dept_id}/{act}', 'Departments@usersAction')
    ->where(['act' => '(active|deactive)'])
    ->middleware('user.check');
Route::match(['get', 'post'], '/payment/{id}', 'Payment@request')->middleware('user.check');
Route::match(['get', 'post'], '/payment/{id}/create', 'Payment@create')->middleware('user.check');
Route::match(['get', 'post'], '/payment/{id}/delete', 'Payment@delete')->middleware('user.check');
Route::match(['get', 'post'], '/payments/list', 'Payment@list')->middleware('user.check');
Route::match(['get', 'post'], '/payments/act/{id}/{act}', 'Payment@paymentAct')->middleware('user.check');
Route::match(['get', 'post'], '/payments/delete/{id}', 'Payment@paymentDelete')->middleware('user.check');
Route::get('/logout', "UserProfile@logout")->middleware('user.check');
