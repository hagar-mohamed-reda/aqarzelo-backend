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

Route::group(['middleware' => ['mobile']], function () {



//********************************************************
// website template
//********************************************************
Route::get('/template2/create/{id}', 'website\Template\Template2Controller@index')->name('createTemplate2');
Route::get('/template3/create/{id}', 'website\Template\Template3Controller@index')->name('createTemplate3');
Route::get('/template4/create/{id}', 'website\Template\Template4Controller@index')->name('createTemplate4');


Route::get('/personal/{name}', 'website\TemplateController@getSite');



//********************************************************
// website routes
//********************************************************
Route::get('/', 'website\HomeController@index');
Route::get('/login', 'website\LoginController@index');
Route::get('/logout', 'website\LoginController@logout');
Route::post('/sign-in', 'website\LoginController@signIn');
Route::post('/forget-password', 'website\LoginController@forgetPassword');
Route::post('/change-password', 'website\LoginController@changePassword');
Route::get('/change-password', 'website\LoginController@changePasswordPage');
Route::post('/user/register', 'website\RegisterController@signUpUser');
Route::post('/company/register', 'website\RegisterController@signUpCompany');
Route::get('/sign-up', 'website\RegisterController@index');
Route::get('/map', 'website\PostController@index');
Route::get('/profile', 'website\ProfileController@index');
Route::post('/profile/update', 'website\ProfileController@update');
Route::post('/profile/update/image', 'website\ProfileController@updateImage');
Route::post('/profile/update/cover', 'website\ProfileController@updateCover');
Route::post('/post/send-message', 'website\PostController@setMessageToCompany');
Route::post('/post/send-comment', 'website\PostController@addComment');
Route::get('/edit-post', 'website\PostController@edit');
Route::get('/post/toggle/favourite', 'website\PostController@addFavourite');
Route::get('/create-post', 'website\PostController@create');
Route::get('/contact', 'website\ContactController@index');
Route::post('/contact/send-message', 'website\ContactController@sendMessage');

Route::get('/create-website', 'website\TemplateController@index');
Route::get('/help', 'website\HelperController@index');
Route::get('/get-user', 'website\TemplateController@getUser');

// lang
Route::get("/locale/{lang}", function($lang){
    session(["locale" => $lang]);
    $direction = "rtl";
	if ($lang == "en")
		$direction = "ltr";
	else
		$direction = "rtl";

	session(["direction" => $direction]);

	//return session("locale");
	return back();
});


});


Route::get('/panorama', 'website\PostController@panorama');
Route::get('/chart', function(){
    return view("website.chart");
});

