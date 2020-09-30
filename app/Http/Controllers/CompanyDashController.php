<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Arr;
use App\Company;
use App\Service;
use App\User;
use App\Post;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\helper\Helper;

use App\Category;
use App\Template;
use App\City;
use App\Area;
use DB;
use Session;

class CompanyDashController extends Controller
{

    
    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //funcation to return Company Details  in layouts file

    public function layout()
    {
        $company = session("company");

        if ($company == null)
        {
            return view("company.login");
        }
        else{
            
        $user = Company::find($company);


        return view("company.layouts.menu", compact("user"));
 

        }
           
   }

    //// function to get all user belongs to a company .

    public function getUser()
    {
        $company = session("company");

        if ($company == null)
        {
            return view("company.login");
        }
        else{
              
        $user = Company::find($company);
        $users = User::select('*')->where('company_id', $company)->get();
        return view("company.user.index", compact("user", 'users'));
   
        }
           
 }





    public function index()
    {
        $company = session("company");
        if ($company == null)
        {
            return view("company.login");
        }
        else{
            $user = Company::find($company);
            $user_count = count($user->users);
            $post_count = Post::select('*', DB::raw('posts.id AS id'))->leftJoin('users', function ($join) {
                $join->on('posts.user_id', '=', 'users.id');
            })->where('users.company_id', $company)->get();
            $post_counts = count($post_count);
            return view("company", compact("user", 'user_count', 'post_counts'));
       
        }
    }



    ///Login function to enter to company dashbord

    public function login()
    {
        return view("company.login");
    }

    /// function to sgin in by enter emaol and password .

    public function sign(Request $request)
    {

        try {
            $users = Company::where("email", $request->email)->first();

            if (Hash::check($request->password, $users->password)) {
                session(["company" => $users->id]);
                Session::flash('success', 'You Login Succesfuly .');

                return redirect()->route('company.dash');
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Please Check Your Data ..');
            return redirect()->back();
        }
    }

    //// function to logout and expire section

    public function logout()
    {
        session(["company" => null]);


        return redirect()->route('company.login');
    }


    ////function to create user to return add view

    public function createUser()
    {
        $company = session("company");
        if ($company == null)
        {
            return view("company.login");
        }else{
            $user = Company::find($company);
            $city = City::all();
          $template = Template::all();
          $area = Area::all();
  
          return view('company.user.add', compact('city', 'template', 'area', 'user'));
   
        }
           

         }
    //////////////////////

    public function areas()
    {
        $city_id = Input::get('city_id');
        $area = Area::where('city_id', '=', $city_id)->get();
        return response()->json($area);
    }

    //function to store users by form .
    public function storeUser(Request $request)
    {
        $companys = session("company");
        if ($companys == null) {
            return view("company.login");
        }
        else{
            $company = Company::find($companys);
            $count = count($company->users);
    
            if ($company->service->max_user > $count) {
                $validator =   validator()->make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|max:11',
                    'password' => 'required|min:8',
    
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
                $user->company_id =$companys;
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
            } else {
                Session::flash('error', 'You Can not add user any more your limite is: ' . $company->service->max_user);
                return back();
            }

        }

             
    }



    public function editUser($id)
    {
        $company = session("company");
        if ($company == null)
        {  return view("company.login");}
        else{
            $users = User::find($id);
            $city = City::all();
            $template = Template::all();
            $area = Area::all();
            $user = Company::find($company);
            return view('company.user.edit', compact('user', 'users', 'area', 'template', 'city'));
      
        }
           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)

    {  
        $company = session("company");
        if ($company == null)
        {  return view("company.login");
        }else{
/*
        $user = User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;

        $user->address = $request->address;
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
       $user = User::find($id);

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


        return redirect()->route('company.user.index');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($id)
    { 
        $company = session("company");
        if ($company == null)
        {  return view("company.login");
        }
        else{
        $user = User::find($id);

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
    }

    /////Show all Post for  users belongs To  a Company  ------------ Company Posts
    public function showPosts()
    {
        $company = session("company");
        if ($company == null)
        { 
            return view("company.login");
        }else{
                 
        $user = Company::find($company);
        $post = Post::select('*', DB::raw('posts.id AS id'))->leftJoin('users', function ($join) {
            $join->on('posts.user_id', '=', 'users.id');
        })->where('users.company_id', $company)->get();
        return view('company.post.index', compact('post', 'user'));
        }
           

    }

    public function editPost($id)
    {
       
        $company = session("company");
        if ($company == null)
        {
            return view("company.login");
        }
        else{
            $post = Post::find($id);
            $city = City::all();
            $area = Area::all();
            $category = Category::all();
            $user = Company::find($company);
            return view('company.post.edit', compact('city',  'area', 'category', 'post', 'user'));
      
        }
            

    }

    public function updatePost(Request $request, $id)
    {
        $company = session("company");
        if ($company == null)
        {
            return view("company.login");
        }
        else{
        $validator = validator()->make($request->all(), [
            'title' => 'required',
            'finishing_type' => 'required',
            'description' => 'required',
            'type' => 'required',
            'price_per_meter' => 'required|numeric',
            'space' => 'required|numeric',
        ]);


        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->type = $request->type;
        $post->lng = $request->lng;
        $post->lat = $request->lat;
        $post->bedroom_number = $request->bedroom_number;
        $post->address = $request->address;
        $post->phone = $request->phone;
        $post->bathroom_number = $request->bathroom_number;
        $post->floor_number = $request->floor_number;
        $post->build_date = $request->build_date;
       
        $post->price_per_meter = $request->price_per_meter;
        $post->finishing_type = $request->finishing_type;
        $post->space = $request->space;
        $post->has_garden = $request->has_garden=="no"? 0 : 1;
        $post->has_parking = $request->has_parking=="no"? 0 : 1;
        $post->payment_method = $request->payment_method;
        $post->owner_type = $request->owner_type;
        $post->category_id = $request->category_id;
        $post->price = $request->price;

        $post->city_id = $request->city_id;
        $post->area_id = $request->area_id;
        //statement for delete all images has a realated with post where check by using $post->id.
      
          
        //statement for delete all images has a realated with post where check by using $post->id.
        if ($request->hasFile('photo')) {
            DB::statement("delete from images where post_id='$post->id' ");
            $images = $request->file('photo');
            foreach ($images as $image) {
                $a = new Image;
                $a->post_id = $post->id;
                $a->photo = Helper::uploadImg($image, "/posts/");
                $a->save();
            }
        }

         if ($request->hasFile('360_photo')) {
            DB::statement("delete from images where post_id='$post->id' ");
            $images_round = $request->file('360_photo');
           foreach ($images_round as $image) {
            $a = new Image;
            $a->is_360 = '1';
            $a->post_id = $post->id;
            $a->photo = Helper::uploadImg($image, "/posts/");
            $a->save();
           }
        }


   if($request->hasFile('mastr_photo')){
                DB::statement("delete from images where post_id='$post->id' ");
       $master_photo = $request->file('mastr_photo');
        foreach ($master_photo as $image) {
            $a = new Image;
            $a->post_id = $post->id;
            $a->photo = Helper::uploadImg($image, "/posts/");
            $a->save();
        } 
        }
      
      

        $post->update();
        Session::flash('success', 'You Edit Post Successfuly  :)');
        return redirect()->route('company.show.posts');
    }
}

    public function destroyPost($id)
    {  
        $company = session("company");
        if ($company == null)
        {
            return view("company.login");
        }
        else{
        $post = Post::find($id);
        $post->delete();
        Session::flash('warning', 'You deleted This  Post Successfuly  :)');


        return redirect()->route('company.show.posts');
        }
    }
}
