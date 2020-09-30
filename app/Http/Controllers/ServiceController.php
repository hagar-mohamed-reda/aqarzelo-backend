<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use App\helper\Helper;
use Session;
use Auth;

class ServiceController extends Controller
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
        $service = Service::all();
        return view('admin.service.index')->with('service', $service);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.service.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =  validator()->make($request->all(), [
            'name' => 'required',
            'icon' => 'required|mimes:jpeg,jpg,bmp,png',
            'max_user' => 'required|numeric',
            'max_post' => 'required|numeric',
            'max_post_image' => 'required|numeric',
            'price' => 'required|numeric'
        ]);


        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }

        $service = new Service;
        $service->name = $request->name;
        $service->max_user = $request->max_user;
        $service->max_post = $request->max_post;
        $service->max_post_image = $request->max_post_image;
        $service->price = $request->price;

        if ($request->hasFile('icon')) {
            $service->icon = Helper::uploadImg($request->file("icon"), "/service/");
        }
        $service->save();

        Session::flash('success', 'You add Services Successfuly  :)');
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
    public function edit(Service $service)
    {
        return view('admin.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {

        $validator =  validator()->make($request->all(), [
            'name' => 'required',
            'max_user' => 'required|numeric',
            'max_post' => 'required|numeric',
            'max_post_image' => 'required|numeric',
            'price' => 'required|numeric'
        ]);


        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }

        $service->name = $request->name;
        $service->max_user = $request->max_user;
        $service->max_post = $request->max_post;
        $service->max_post_image = $request->max_post_image;
        $service->price = $request->price;
        if ($request->hasFile('icon')) {
            // delete old image
            try {
                unlink(public_path("images/service") . "/" .  $service->icon);
            } catch (\Exception $exc) {
            }
            // upload new image
            $service->icon = Helper::uploadImg($request->file("icon"), "/service/");
        }
        $service->update();
        Session::flash('success', 'You Edit Service Successfully .');

        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {

        if(count($service->companies) > 0)
        {
            Session::flash('error', 'You can not delete this Servies because there are a lot of users work on it you can un active it   :) !');
            return redirect()->back();
        }
        else{
            $service->delete();
            Session::flash('warning', 'You deleted this Service Succesfuly .');
            return redirect()->back();
       
        }
    }
}
