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

//affiliations
Route::get('/dashboard/affiliations','DashboardController@AffiliationsList');
Route::get('/dashboard/affiliations/delete/{id}','DashboardController@DeleteAffiliation');
Route::get('/dashboard/affiliations/edit/{id}','DashboardController@EditAffiliationShow');
Route::post('/dashboard/affiliations/edit/{id}','DashboardController@EditAffiliation');

//keywords
Route::get('/dashboard/keywords','DashboardController@KeywordsList');
Route::get('/dashboard/keywords/delete/{id}','DashboardController@DeleteKeyword');
Route::get('/dashboard/keywords/edit/{id}','DashboardController@EditKeywordShow');
Route::post('/dashboard/keywords/edit/{id}','DashboardController@EditKeyword');

//users
Route::get('/dashboard/users','DashboardController@UsersList');
Route::get('/dashboard/users/delete/{id}','DashboardController@DeleteUser');
Route::get('/dashboard/users/edit/{id}','DashboardController@EditUserShow');
Route::post('/dashboard/users/edit/{id}','DashboardController@EditUser');

Route::post('/Process/GetProfile','DashboardController@GetProfile');
Route::post('/Process/GetAffiliation','DashboardController@GetAffiliation');

Route::get('storage/PaperFiles/{filename}', function ($filename)
{
    $path = storage_path().'\\app\\PaperFiles\\'.$filename;
    return Response::download($path);
});
//volume page
Route::get('/' , 'HomeController@index');
Route::get('/volume/{id}' , 'HomeController@ViewVolumePapers');

//paper page
Route::get('/paper/{id}','HomeController@ViewPaper');

Route::get('/profile','ProfileController@index');
Route::get('/profile/account','ProfileController@account');