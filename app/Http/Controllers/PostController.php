<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use App\Post;
use App\User;
use App\Image;
use DB;
use App\City;
use App\Area;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\helper\Helper;
use Session;



use Illuminate\Http\Request;

class PostController extends Controller
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
        if (Auth::user()->type == 'admin') {
            $posts = Post::orderBy('created_at', 'DESC')->get();
        } else {
            $id = Auth::user()->id;
            $posts = Post::where('user_id', '=', $id)->orderBy('created_at', 'DESC')->get();
        }


        return view('admin.post.index')->with('post', $posts);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::all();
        $category = Category::all();

        return view('admin.post.add', compact('city',  'category'));
    }



    public function areas()
    {
        $city_id = Input::get('city_id');
        $area = Area::where('city_id', '=', $city_id)->get();
        return response()->json($area);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

        $id = Auth::user()->id;

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'lng' => $request->lng,
            'lat' => $request->lat,
            'bedroom_number' => $request->bedroom_number,
            'address' => $request->address,
            'phone' => $request->phone,
            'bathroom_number' => $request->bathroom_number,
            'floor_number' => $request->floor_number,
            'build_date' => $request->build_date,
           
            'price_per_meter' => $request->price_per_meter,
            'finishing_type' => $request->finishing_type,
            'space' => $request->space,
            'has_garden' => $request->has_garden=="no"? 0 : 1,
            'has_parking' => $request->has_parking=="no"? 0 : 1,
            'payment_method' => $request->payment_method,
            'owner_type' => $request->owner_type,
            'finishing_type' => $request->finishing_type,
            'category_id' => $request->category_id,
            'user_id' => $id,
            'city_id' => $request->city_id,
            'area_id' => $request->area_id,
            'price' => $request->price,
        ]);
        
        if($request->hasFile('mastr_photo')){
             
       $master_photo = $request->file('mastr_photo');
        foreach ($master_photo as $image) {
            $a = new Image;
            $a->post_id = $post->id;
            $a->photo = Helper::uploadImg($image, "/posts/");
            $a->save();
        } 
        }
      
      

        if($request->hasFile('photo')){
        $images = $request->file('photo');
        foreach ($images as $image) {
            $a = new Image;
            $a->post_id = $post->id;
            $a->photo = Helper::uploadImg($image, "/posts/");
            $a->save();
        }
        }
         if($request->hasFile('360_photo')){
             
        $images_round = $request->file('360_photo');
        foreach ($images_round as $image) {
            $a = new Image;
            $a->is_360 = '1';
            $a->post_id = $post->id;
            $a->photo = Helper::uploadImg($image, "/posts/");
            $a->save();
        }

         }

         Session::flash('success', 'You add Post Successfuly  :)');
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
    public function edit(Post $post)
    {
        $city = City::all();
        $area = Area::all();
        $category = Category::all();

        return view('admin.post.edit', compact('city',  'area', 'category', 'post'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

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
        $post->city_id = $request->city_id;
        $post->area_id = $request->area_id;
        $post->price = $request->price;
        
        

       if($request->hasFile('mastr_photo')){
            //DB::statement("delete from images where post_id='$post->id' ");
            $master_photo = $request->file('mastr_photo');
            
            $a = Image::where('post_id', $post->id)->first();
            
            if (!$a) {
                $a = new Image();
            }
            $a->post_id = $post->id;
            $a->photo = Helper::uploadImg($master_photo[0], "/posts/");
            $a->save();
            //
            
        }
         
        //statement for delete all images has a realated with post where check by using $post->id.
        if ($request->hasFile('photo')) {
            //DB::statement("delete from images where post_id='$post->id' ");
            $images = $request->file('photo');
            foreach ($images as $image) {
                $a = new Image;
                $a->post_id = $post->id;
                $a->photo = Helper::uploadImg($image, "/posts/");
                $a->save();
            }
        }

         if ($request->hasFile('360_photo')) {
            //DB::statement("delete from images where post_id='$post->id' ");
            $images_round = $request->file('360_photo');
           foreach ($images_round as $image) {
            $a = new Image;
            $a->is_360 = '1';
            $a->post_id = $post->id;
            $a->photo = Helper::uploadImg($image, "/posts/");
            $a->save();
           }
        }

      
      


        $post->update();
        Session::flash('success', 'You Edit Post Successfuly  :)');
        return redirect()->route('post.index');
    }
    
    public function removeImage(Request $request, Image $image) {
        $filename = public_path() . "/images/posts" . "/" . $image->photo;
        if (file_exists($filename)) {
            unlink($filename);
        }
        $image->delete();
        
        return [
            "status" => 1,
            "message" => "تم حذف الصوره"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        
       // DB::statement("delete from images where post_id='$post->id' ");
       $images = $post->images;
       foreach ($images as $image) {
           try{
               unlink(public_path() . "/" . $image->photo);
           }catch(\Exception $e){}
       }
       
       $post->images()->delete();
       
        $post->delete();
        Session::flash('warning', 'You Deleted Post Successfuly  :)');

        return redirect()->back();

        
    }









    public function active(Post $post)
    {

        $post->active = 'active';
        $post->update();
        Session::flash('success', 'You Active this post Succesfuly .');

        return redirect()->back();
    }

    public function notActive(Post $post)
    {

        $post->active = 'not_active';
        $post->update();
        Session::flash('success', 'You Unactive this post Succesfuly .');

        return redirect()->back();
    }

    public function acceptedPost(Post $post)
    {

        $post->status = 'accepted';
        $post->update();
        
        $message_ar = trans("تم الموافقه علي منشورك من قبل الادمن ");
        $message_en = trans("admin accepted your post ");

        // notify the user
        $post->user->notify(
                        trans("messages_ar.post_alert", ["number" => $post->id]), trans("messages_en.post_alert", ["number" => $post->id]), $message_ar, $message_en, $post->id
                );
        
        $title_ar = trans("messages_ar.new_post", ["user" => $post->user->name]);
        $title_en = trans("messages_en.new_post", ["user" => $post->user->name]);

        // notify all user  
        User::notifyAll($title_ar, $title_en, $post->title, $post->title, $post->id);
           
        Session::flash('success', 'You Accepted this post Succesfuly .');

        return redirect()->back();
    }

    public function pandingPost(Post $post)
    {

        $post->status = 'pending';
        $post->update();
        Session::flash('warning', 'You Panding this post Succesfuly .');

        return redirect()->back();
    }

      public function trash(Post $post)
    {
        $post->status   = 'user_trash';
        $post->update();
        Session::flash('warning', 'You trash this Post Successfuly  :)');

        return redirect()->back();
    }

       public function retreve(Post $post)
    {
        $post->status   = 'accepted';
        $post->update();
        Session::flash('warning', 'You Retrive this Post Successfuly  :)');

        return redirect()->back();
    }

    public function refusedPost(Post $post)
    {

        $post->status = 'refused';
        $post->update();
        Session::flash('error', 'You Refused this post Succesfuly .');

        return redirect()->back();
    }
}
