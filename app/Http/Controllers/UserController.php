<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Arr;
use App\Company;
use App\Template;
use App\Service;
use App\City;
use App\Area;
use App\helper\Helper;
use Session;
use Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{

    
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index')->with('user', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $city = City::all();
        $template = Template::all();
        $area = Area::all();
        $company = Company::all();
        return view('admin.user.add', compact('city', 'template', 'area', 'company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =   validator()->make($request->all(), [
            'name' => 'required',
             'email' => 'required|email|unique:users',
            'phone' => 'required|size:11|unique:users',
            'password' => 'required|min:8',
            'photo' => 'required|mimes:jpeg,jpg,bmp,png',
            'cover' => 'required|mimes:jpeg,jpg,bmp,png',

        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->lat = $request->lat;
        $user->lng = $request->lng;
        $user->templete_id = $request->templete_id;
        $user->city_id = $request->city_id;
        $user->area_id = $request->area_id;
        $user->company_id = $request->company_id;
        $user->attached_file = $request->attached_file;
        $user->about = $request->about;
        $user->facebook = $request->facebook;
        $user->youtube_link = $request->youtube_link;
        $user->youtube_video = $request->youtube_video;
        $user->twitter = $request->twitter;
        $user->whatsapp = $request->whatsapp;
        $user->linkedin = $request->linkedin;
        $user->website = $request->website;
        $user->website_available_days = $request->website_available_days;
        if ($request->hasFile('photo')) {
            $user->photo = Helper::uploadImg($request->file("photo"), "/users/");
        }
        if ($request->hasFile('cover')) {
            $user->cover = Helper::uploadImg($request->file("cover"), "/users/");
        }
        $user->save();
        Session::flash('success', 'You add User Successfuly  :)');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $city = City::all();
        $template = Template::all();
        $area = Area::all();
        $company = Company::all();
        return view('admin.user.edit', compact('city', 'template', 'area', 'company', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

      
     
        /*
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->company_id = $request->company_id;
        $user->lng = $request->lng;
        $user->lat = $request->lat;
        $user->templete_id = $request->templete_id;
        $user->city_id = $request->city_id;
        $user->area_id = $request->area_id;
        $user->attached_file = $request->attached_file;
        $user->about = $request->about;
        $user->facebook = $request->facebook;
        $user->youtube_link = $request->youtube_link;
        $user->youtube_video = $request->youtube_video;
        $user->twitter = $request->twitter;
        $user->whatsapp = $request->whatsapp;
        $user->website_available_days = $request->website_available_days;
        */
        
         $data = $request->all();
        $data = Arr::except($request->all(), ["password","email"]);
        
         $user->update($data);
        
        if ($request->has("password") && $request->password) {
            $user->update([
                "password" => bcrypt($request->password)        
            ]);
        }

        if ($request->hasFile('photo')) {
            // delete old image
            try {
                if ($user->photo != "photo.jpg")
                    unlink(public_path("images/users") . "/" .  $user->photo);
            } catch (\Exception $exc) {
            }
            // upload new image
            $user->photo = Helper::uploadImg($request->file("photo"), "/users/");
        }
        ////////////////
        if ($request->hasFile('cover')) {
            // delete old image
            try {
                if ($user->cover != "cover.jpg")
                    unlink(public_path("images/users") . "/" .  $user->cover);
            } catch (\Exception $exc) {
            }
            // upload new image
            $user->cover = Helper::uploadImg($request->file("cover"), "/users/");
        }

        $user->update();
        Session::flash('success', 'You Edit User Successfully .');

        return redirect("/admin/user");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if(count($user->posts) > 0)
        {
            Session::flash('error', 'You can not delete this user because there are a lot of posts in our application belong to him  you can un active it   :) !');
            return redirect()->back();
        }
        else{
            $user->delete();
            Session::flash('success', 'You Delete This User  Successfuly  :)');
    
            return redirect()->back();
       
        }
       
    }

    public function active(User $user)
    {

        $user->active = 'active';
        $user->update();
        Session::flash('success', 'You Active This User  Successfuly  :)');

        return redirect()->back();
    }

    public function notActive(User $user)
    {

        $user->active = 'not_active';
        $user->update();
        Session::flash('success', 'You Un active This User  Successfuly  :)');

        return redirect()->back();
    }
}
