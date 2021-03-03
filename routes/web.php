<?php

use App\Area;
use App\Http\Controllers\DashController;
use Illuminate\Http\Request; 
use database\migrations\LaratrustSetupTables;
use Illuminate\Database\Schema\Blueprint; 

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

Route::get('/run_work', function(){ 
    echo "done";
});

Route::get('/start_laratrust_migration', function(){
    // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users and teams (Many To Many Polymorphic)
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('user_id');
            $table->string('user_type');

            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id', 'user_type']);
        });

        // Create table for associating permissions to users (Many To Many Polymorphic)
        Schema::create('permission_user', function (Blueprint $table) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('user_id');
            $table->string('user_type');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'permission_id', 'user_type']);
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
});

Route::get('/dashboard', 'DashController@show')->name('dashboard2');
Route::get('/dash', 'DashController@show')->name('dashboard');



Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {


    Auth::routes();
    Route::resource('service', 'ServiceController');
    Route::resource('setting', 'SettingController');
    Route::resource('advertise', 'AdsController');
    Route::resource('template', 'TemplateController');
    Route::resource('company', 'CompanyController');
    Route::resource('user', 'UserController');
    Route::post('user/{user}', 'UserController@update')->name("user.update.1");
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    Route::resource('city', 'CityController');
    Route::resource('area', 'AreaController');
    Route::resource('notifi', 'NotificationController');
    Route::resource('mail', 'MailboxController');

    Route::get('template/active/{template}', 'TemplateController@active')->name('template.active');
    Route::get('template/not/active/{template}', 'TemplateController@notActive')->name('template.not_active');

    Route::get('company/active/{company}', 'CompanyController@active')->name('company.active');
    Route::get('company/not/active/{company}', 'CompanyController@notActive')->name('company.not_active');

    Route::get('ads/active/{ads}', 'AdsController@active')->name('ads.active');
    Route::get('ads/not/active/{ads}', 'AdsController@notActive')->name('ads.not_active');

    Route::get('user/active/{user}', 'UserController@active')->name('user.active');
    Route::get('user/not/active/{user}', 'UserController@notActive')->name('user.not_active');



    Route::get('post/active/{post}', 'PostController@active')->name('post.active');
    Route::get('post/not/active/{post}', 'PostController@notActive')->name('post.not_active');


    Route::get('post/accepted/{post}', 'PostController@acceptedPost')->name('post.accepted');

    Route::get('post/panding/{post}', 'PostController@pandingPost')->name('post.panding');

    Route::get('post/refused/{post}', 'PostController@refusedPost')->name('post.refused');
    Route::get('post/trash/{post}', 'PostController@trash')->name('post.trash');
    Route::get('post/retreve/{post}', 'PostController@retreve')->name('post.retreve');
    Route::post('post/images/remove/{image}', 'PostController@removeImage')->name('post.removeImage');

});


Route::get('company/login', 'CompanyDashController@login')->name('company.login');
Route::post('company/login', 'CompanyDashController@sign')->name('company.login.submit');

Route::middleware(['company_auth'])->group(function(){

    Route::get('/company-post', 'CompanyPostController@index')->name('company-post.index');
    Route::get('/company-post/create', 'CompanyPostController@create')->name('company-post.create');
    Route::get('/company-post/{post}/edit', 'CompanyPostController@edit')->name('company-post.edit');

    Route::post('/company-post', 'CompanyPostController@store')->name('company-post.store');
    Route::put('/company-post/{post}', 'CompanyPostController@update')->name('company-post.update');
    Route::delete('/company-post/{post}', 'CompanyPostController@destroy')->name('company-post.destroy');


    Route::get('company/dash', 'CompanyDashController@index')->name('company.dash');
    Route::post('company/logout', 'CompanyDashController@logout')->name('company.logout');

    Route::get('company/user/create', 'CompanyDashController@createUser')->name('company.create.user');
    Route::post('company/user/store', 'CompanyDashController@storeUser')->name('company.store.user');
    Route::get('company/user', 'CompanyDashController@getUser')->name('company.user.index');
    Route::get('company/user/edit/{id}', 'CompanyDashController@editUser')->name('company.user.edit');
    Route::post('company/user/update/{id}', 'CompanyDashController@updateUser')->name('company.user.update');
    Route::get('company/user/delete/{id}', 'CompanyDashController@destroyUser')->name('company.user.destroy');
    Route::get('company/post/show', 'CompanyDashController@showPosts')->name('company.show.posts');

    //
    Route::get('company-post/active/{post}', 'CompanyPostController@active')->name('company-post.active');
    Route::get('company-post/not/active/{post}', 'CompanyPostController@notActive')->name('company-post.not_active');
    Route::get('company-post/accepted/{post}', 'CompanyPostController@acceptedPost')->name('company-post.accepted');
    Route::get('company-post/panding/{post}', 'CompanyPostController@pandingPost')->name('company-post.panding');
    Route::get('company-post/refused/{post}', 'CompanyPostController@refusedPost')->name('company-post.refused');
    Route::get('company-post/trash/{post}', 'CompanyPostController@trash')->name('company-post.trash');
    Route::get('company-post/retreve/{post}', 'CompanyPostController@retreve')->name('company-post.retreve');
    Route::post('company-post/images/remove/{image}', 'CompanyPostController@removeImage')->name('company-post.removeImage');

    //Route::get('company/post/edit/{id}', 'CompanyDashController@editPost')->name('company.post.edit');
    //Route::post('company/post/update/{id}', 'CompanyDashController@updatePost')->name('company.post.update');
    //Route::get('company/post/delete/{id}', 'CompanyDashController@destroyPost')->name('company.post.destroy');

});


Route::get('/json-area', 'PostController@areas');
Route::get('/json-area/company', 'CompanyDashController@areas');



Route::get('show/count', 'CompanyDashController@index');
