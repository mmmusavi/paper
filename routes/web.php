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

Route::get('login',['as' => 'login', 'uses' => 'LoginController@show']);
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
Route::get('/dashboard/papers/up/{id}','DashboardController@PaperUp');
Route::get('/dashboard/papers/down/{id}','DashboardController@PaperDown');
Route::post('/dashboard/papers/edit/{id}','DashboardController@EditPaper');

//volumes
Route::get('/dashboard/volumes','DashboardController@volumesList');
Route::get('/dashboard/volumes/new','DashboardController@NewVolumeShow');
Route::post('/dashboard/volumes/new','DashboardController@NewVolumePost');
Route::get('/dashboard/volumes/delete/{id}','DashboardController@DeleteVolume');
Route::get('/dashboard/volumes/edit/{id}','DashboardController@EditVolumeShow');
Route::get('/dashboard/volumes/up/{id}','DashboardController@VolumeUp');
Route::get('/dashboard/volumes/down/{id}','DashboardController@VolumeDown');
Route::post('/dashboard/volumes/edit/{id}','DashboardController@EditVolume');

//volume_cat
Route::get('/dashboard/volumeCat','DashboardController@volumeCatList');
Route::get('/dashboard/volumeCat/new','DashboardController@NewvolumeCatShow');
Route::post('/dashboard/volumeCat/new','DashboardController@NewvolumeCatPost');
Route::get('/dashboard/volumeCat/delete/{id}','DashboardController@DeletevolumeCat');
Route::get('/dashboard/volumeCat/edit/{id}','DashboardController@EditvolumeCatShow');
Route::get('/dashboard/volumeCat/up/{id}','DashboardController@VolumeCatUp');
Route::get('/dashboard/volumeCat/down/{id}','DashboardController@VolumeCatDown');
Route::post('/dashboard/volumeCat/edit/{id}','DashboardController@EditvolumeCat');

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
Route::post('/Process/DoRefs','DashboardController@DoRefs');

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

//add to cart
Route::get('/addtocart/{id}','ProfileController@addtoCart');
Route::get('/deleteCart/{id}','ProfileController@deleteCart');
Route::get('/checkout','ProfileController@checkout');

//editing referees and about
Route::get('/dashboard/pages','DashboardController@pageIndex');
Route::post('/dashboard/pages/post','DashboardController@EditPage');

//showing referees and about us and contact us
Route::get('referees','HomeController@RefIndex');
Route::get('AboutUs','HomeController@AboutIndex');
Route::get('ContactUs','HomeController@ContactIndex');

//sending contact us
Route::post('/dashboard/message/post','HomeController@SendContact');

//showing messages sent from contact us page
Route::get('/dashboard/messages','DashboardController@MessageShow');
