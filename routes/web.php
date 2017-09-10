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

Route::get('/home',function (){
    return redirect('/');
});

Route::get('/login','LoginController@show');
Route::post('/login','LoginController@checkUser');

Route::get('/register','Auth\RegisterController@show');
Route::post('/register','Auth\RegisterController@register');

Route::get('/logout',function (){
    Auth::logout();
    return redirect('/');
});

Route::get('/dashboard','DashboardController@index');

//papers
Route::get('/dashboard/papers','DashboardController@papersList');
Route::get('/dashboard/papers/new','DashboardController@NewPaperShow');
Route::post('/dashboard/papers/new','DashboardController@NewPaperPost');
Route::get('/dashboard/papers/delete/{id}','DashboardController@DeletePaper');
Route::get('/dashboard/papers/edit/{id}','DashboardController@EditPaperShow');
Route::post('/dashboard/papers/edit/{id}','DashboardController@EditPaper');

//volumes
Route::get('/dashboard/volumes','DashboardController@volumesList');
Route::get('/dashboard/volumes/new','DashboardController@NewVolumeShow');
Route::post('/dashboard/volumes/new','DashboardController@NewVolumePost');
Route::get('/dashboard/volumes/delete/{id}','DashboardController@DeleteVolume');
Route::get('/dashboard/volumes/edit/{id}','DashboardController@EditVolumeShow');
Route::post('/dashboard/volumes/edit/{id}','DashboardController@EditVolume');

Route::post('/Process/GetProfile','DashboardController@GetProfile');

//
Route::get('/' , 'HomeController@index');