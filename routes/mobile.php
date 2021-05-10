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



//********************************************************
// mobile route
//********************************************************
Route::get('/phone', function () {
    if ((strpos(request()->server('HTTP_USER_AGENT'), 'Android') === false) ||
        (strpos(request()->server('HTTP_USER_AGENT'), 'iPhone') === false)) {
        if (request()->has("post_id") && strpos(request()->url(), 'phone') !== false) {
            return redirect("/map?post_id=" . request()->post_id);
        }
    }
    return view("mobile.index");

});
Route::get('/phone/splash', function () {
    return view("mobile.splash");
});
Route::get('/phone/choose-location', function () {
    return view("mobile.chooseLocation");
});
Route::get('/phone/map-picker', function () {
    return view("mobile.mapPicker");
});
Route::get('/phone/home', function () {
    return view("mobile.home");
});
Route::get('/phone/setting', function () {
    return view("mobile.setting");
});
Route::get('/phone/login', function () {
    return view("mobile.login");
});
Route::get('/phone/register', function () {
    return view("mobile.register");
});
Route::get('/phone/notification', function () {
    return view("mobile.notification");
});
Route::get('/phone/favourite', function () {
    return view("mobile.favourite");
});
Route::get('/phone/help', function () {
    return view("mobile.help");
});
Route::get('/phone/contact', function () {
    return view("mobile.contact");
});
Route::get('/phone/profile', function () {
    return view("mobile.profile");
});
Route::get('/phone/profile/edit', function () {
    return view("mobile.editProfile");
});
Route::get('/phone/change-password', function () {
    return view("mobile.changePassword");
});
Route::get('/phone/filter', function () {
    return view("mobile.filter");
});
Route::get('/phone/post/show', function () {
    return view("mobile.post");
});
Route::get('/phone/post/create', function () {
    return view("mobile.createPost.index");
});
Route::get('/phone/chat', function () {
    return view("mobile.chat");
});
Route::get('/phone/chat/users', function () {
    return view("mobile.chatUser");
});


Route::get('/phone/test', function () {
    dump(Request::url());
});
