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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['prevent-back-history','auth','auth.checkstatus']],function(){
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['prevent-back-history']],function(){
            
    Route::get('/admin','Admin\Auth\LoginController@showLoginForm')->name('admin');
    Route::get('/admin/login','Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/admin/login','Admin\Auth\LoginController@login');
    Route::post('/admin/logout','Admin\Auth\LoginController@logout')->name('admin.logout');
    
});



Route::group(['middleware' => ['prevent-back-history','admin.auth']], function(){
    //prefix('/admin')->name('admin.')->namespace('Admin')
    //All the admin routes will be defined here...
    //Login Routes
    Route::resource('admin/users','Admin\UserController');
    Route::get('admin/dashboard','Admin\HomeController@index')->name('admin.dashboard');
    
});