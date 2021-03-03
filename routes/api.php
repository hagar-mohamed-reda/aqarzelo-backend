<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */


//****************************************************************
// user api
//****************************************************************
// auth
Route::post('/user/register', "Api\user\AuthController@register");
Route::post('/user/login', "Api\user\AuthController@login");
Route::get('/user/profile/get', "Api\user\AuthController@loadProfile");
Route::post('/user/profile/update', "Api\user\AuthController@updateProfile");
Route::post('/user/forget-password', "Api\user\AuthController@forgetPassword");
Route::post('/user/reset-password', "Api\user\AuthController@resetPassword");
Route::post('/user/resend-sms', "Api\user\AuthController@resendSms");
Route::post('/user/change-password', "Api\user\AuthController@changePassword");
Route::post('/user/external/login', "Api\user\AuthController@loginAsExternalApi");

// company auth
Route::post('/company/register', "Api\company\AuthController@register");
Route::post('/company/login', "Api\company\AuthController@login");
Route::post('/company/profile/update', "Api\company\AuthController@updateProfile");
Route::post('/company/forget-password', "Api\company\AuthController@forgetPassword");
Route::post('/company/reset-password', "Api\company\AuthController@resetPassword");
Route::post('/company/resend-sms', "Api\company\AuthController@resendSms");
Route::post('/company/change-password', "Api\company\AuthController@changePassword");
Route::post('/company/external/login', "Api\company\AuthController@loginAsExternalApi");

// main
Route::post('/user/favourite/toggle', "Api\user\MainController@toggleFavourite");
Route::get('/user/favourite/get', "Api\user\MainController@getFavourites");
Route::post('/user/review/add', "Api\user\MainController@addReview");
Route::get('/user/review/get', "Api\user\MainController@getReviews");
Route::get('/user/notification/get', "Api\user\MainController@getNotifications");
Route::post('/user/post/remove', "Api\user\MainController@removePost");
Route::get('/user/post/get', "Api\user\MainController@getPosts");


//****************************************************************
// post api
//****************************************************************
Route::post('/post/add', "Api\post\MainController@addPost");
Route::post('/post/update', "Api\post\MainController@updatePost");
Route::post('/post/add/{resource}', "Api\post\MainController@updatePost");
Route::get('/post/search', "Api\post\MainController@search");
Route::get('/post/recommended', "Api\post\MainController@getRecommended");
Route::get('/post/get', "Api\post\MainController@get");
Route::get('/post/{post}', "Api\post\MainController@load");
Route::get('/post/add-view', "Api\post\MainController@addView");
Route::post('/post/add-image', "Api\post\MainController@uploadImage");
Route::post('/post/remove-image', "Api\post\MainController@removeImage");
Route::get('/post/image/get', "Api\post\MainController@getImages");




//****************************************************************
// chat api
//****************************************************************
Route::post('/chat/send', "Api\ChatController@sendMessage");
Route::get('/chat/get', "Api\ChatController@getMessages");
Route::get('/chat/user/get', "Api\ChatController@getUsers");



//****************************************************************
// global api
//****************************************************************
Route::get('/city/get', "Api\MainController@getCities");
Route::get('/country/get', "Api\MainController@getCountries");
Route::get('/area/get', "Api\MainController@getAreas");
Route::get('/category/get', "Api\MainController@getCategories");
Route::get('/ads/get', "Api\MainController@getAds");
Route::get('/setting/get', "Api\MainController@getSetting");
Route::post('/firebase/update', "Api\MainController@updateFirebaseToken");


//****************************************************************
// admin api
//****************************************************************
//

Route::get('test_login', function(){
    return App\User::find(1);
});


Route::post('admin/sign', 'Api\dashboard\admin\AuthController@login');

Route::group(["prefix" => "", "middleware" => ["auth:api"]], function() {

//countries start
    Route::get('dashboard', 'Api\dashboard\admin\DashboardController@index');

//countries start
    Route::get('countries', 'Api\dashboard\admin\CountryController@index');
    Route::post('countries/store', 'Api\dashboard\admin\CountryController@store');
    Route::post('countries/update/{resource}', 'Api\dashboard\admin\CountryController@update');
    Route::post('countries/delete/{resource}', 'Api\dashboard\admin\CountryController@destroy');


//cities start
    Route::get('cities', 'Api\dashboard\admin\CityController@index');
    Route::post('cities/store', 'Api\dashboard\admin\CityController@store');
    Route::post('cities/update/{resource}', 'Api\dashboard\admin\CityController@update');
    Route::post('cities/delete/{resource}', 'Api\dashboard\admin\CityController@destroy');


//areas start
    Route::get('areas', 'Api\dashboard\admin\AreaController@index');
    Route::post('areas/store', 'Api\dashboard\admin\AreaController@store');
    Route::post('areas/update/{resource}', 'Api\dashboard\admin\AreaController@update');
    Route::post('areas/delete/{resource}', 'Api\dashboard\admin\AreaController@destroy');


//ads start
    Route::get('ads', 'Api\dashboard\admin\AdsController@index');
    Route::post('ads/store', 'Api\dashboard\admin\AdsController@store');
    Route::post('ads/update/{resource}', 'Api\dashboard\admin\AdsController@update');
    Route::post('ads/delete/{resource}', 'Api\dashboard\admin\AdsController@destroy');


//categories start
    Route::get('categories', 'Api\dashboard\admin\CategoryController@index');
    Route::post('categories/store', 'Api\dashboard\admin\CategoryController@store');
    Route::post('categories/update/{resource}', 'Api\dashboard\admin\CategoryController@update');
    Route::post('categories/delete/{resource}', 'Api\dashboard\admin\CategoryController@destroy');

//roles start
    Route::get('roles', 'Api\dashboard\admin\RoleController@index');
    Route::post('roles/store', 'Api\dashboard\admin\RoleController@store');
    Route::post('roles/update/{resource}', 'Api\dashboard\admin\RoleController@update');
    Route::post('roles/permission/{resource}', 'Api\dashboard\admin\RoleController@updatePermission');
    Route::post('roles/delete/{resource}', 'Api\dashboard\admin\RoleController@destroy');

//users start
    Route::get('users', 'Api\dashboard\admin\UserController@index');
    Route::post('users/store', 'Api\dashboard\admin\UserController@store');
    Route::post('users/update/{resource}', 'Api\dashboard\admin\UserController@update');
    Route::post('users/delete/{resource}', 'Api\dashboard\admin\UserController@destroy');

//companies start
    Route::get('companies', 'Api\dashboard\admin\CompanyController@index');
    Route::post('companies/store', 'Api\dashboard\admin\CompanyController@store');
    Route::post('companies/update/{resource}', 'Api\dashboard\admin\CompanyController@update');
    Route::post('companies/delete/{resource}', 'Api\dashboard\admin\CompanyController@destroy');

//plans start
    Route::get('plans', 'Api\dashboard\admin\PlanController@index');
    Route::post('plans/store', 'Api\dashboard\admin\PlanController@store');
    Route::post('plans/update/{resource}', 'Api\dashboard\admin\PlanController@update');
    Route::post('plans/delete/{resource}', 'Api\dashboard\admin\PlanController@destroy');

//permissions start
    Route::get('permissions', 'Api\dashboard\admin\PermissionController@index');
    Route::post('permissions/store', 'Api\dashboard\admin\PermissionController@store');
    Route::post('permissions/update/{resource}', 'Api\dashboard\admin\PermissionController@update');
    Route::post('permissions/delete/{resource}', 'Api\dashboard\admin\PermissionController@destroy');

//PermissionGroup start
    Route::get('permission-groups', 'Api\dashboard\admin\PermissionGroupController@index');
    Route::post('permission-groups/store', 'Api\dashboard\admin\PermissionGroupController@store');
    Route::post('permission-groups/update/{resource}', 'Api\dashboard\admin\PermissionGroupController@update');
    Route::post('permission-groups/delete/{resource}', 'Api\dashboard\admin\PermissionGroupController@destroy');

// translation
    Route::get('translation', 'Api\dashboard\admin\TranslationController@index');
    Route::get('translation/get', 'Api\dashboard\admin\TranslationController@get');
    Route::post('translation/update', 'Api\dashboard\admin\TranslationController@update');

//posts start
    Route::get('posts', 'Api\dashboard\admin\PostController@index');
    Route::get('posts/{resource}', 'Api\dashboard\admin\PostController@load');
    Route::post('posts/store', 'Api\dashboard\admin\PostController@store');
    Route::post('posts/update/{resource}', 'Api\dashboard\admin\PostController@update');
    Route::post('posts/delete/{resource}', 'Api\dashboard\admin\PostController@destroy');
});
