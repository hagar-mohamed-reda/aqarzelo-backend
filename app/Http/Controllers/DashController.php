<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Post;
use App\Company;

use App\MailBox;

use App\User;

use DB;
use App\Ads;
use Illuminate\Http\Request;
use Auth;

class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function __construct()
    {
        $this->middleware('auth');
    }





    public function show()
    {
        $u_id = Auth::user()->id;
        $notifi = Notification::where("user_id", "=", $u_id)->orderBy('created_at', 'DESC')->take(10)->get();
        $u_id = Auth::user()->id;
        $mail = MailBox::where("user_id", "=", $u_id)->orderBy('created_at', 'DESC')->take(10)->get();
        $mail_count = count($mail);
        $post = Post::all();
        $count_post = count($post);
        $user_post = count(Auth::user()->posts);
        $company = Company::all();
        $count_company = count($company);
        $ads = Ads::all();
        $count_ads = count($ads);
        $users = User::all();
        $count_users = count($users);
        return view('welcome', compact('count_post', 'mail_count', 'count_company', 'user_post', 'count_ads', 'count_users', 'mail', 'notifi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
