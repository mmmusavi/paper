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
    return view('home');
});

Route::get('home',function (){
    return redirect('/');
});

Route::get('login','LoginController@show');
Route::post('login','LoginController@checkUser');

Route::get('register','Auth\RegisterController@show');
Route::post('register','Auth\RegisterController@register');

Route::get('logout',function (){
    Auth::logout();
    return redirect('/');
});

Route::get('dashboard','DashboardController@index');
