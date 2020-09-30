<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Company;
use App\Template;
use App\Service;
use App\City;
use App\Area;
use App\helper\Helper;
use Session;
use Auth;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index')->with('company', $companies);
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
        $service = Service::all();
        return view('admin.company.add', compact('city', 'template', 'area', 'service'));
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

        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->password =  bcrypt($request->password);
        $company->phone = $request->phone;
        $company->address = $request->address;
        $company->lat = $request->lat;
        $company->lng = $request->lng;
        $company->templete_id = $request->templete_id;
        $company->city_id = $request->city_id;
        $company->area_id = $request->area_id;
        $company->service_id = $request->service_id;
        $company->attached_file = $request->attached_file;
        $company->about = $request->about;
        $company->facebook = $request->facebook;
        $company->youtube_link = $request->youtube_link;
        $company->youtube_video = $request->youtube_video;
        $company->twitter = $request->twitter;
        $company->whatsapp = $request->whatsapp;
        $company->linkedin = $request->linkedin;
        $company->website = $request->website;
        $company->website_available_days = $request->website_available_days;
        if ($request->hasFile('photo')) {
            $company->photo = Helper::uploadImg($request->file("photo"), "/company/");
        }
        if ($request->hasFile('cover')) {
            $company->cover = Helper::uploadImg($request->file("cover"), "/company/");
        }
        $company->save();
        Session::flash('success', 'You add Company Successfuly  :)');
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
    public function edit(Company $company)
    {
        $city = City::all();
        $template = Template::all();
        $area = Area::all();
        $service = Service::all();
        return view('admin.company.edit', compact('company', 'city', 'template', 'area', 'service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {

        $validator =   validator()->make($request->all(), [
            'name' => 'required',
            //'email' => 'required|email',
            //'phone' => 'required|max:11',
           

        ]);


        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }
        /*
        $company->name = $request->name;
        $company->email = $request->email;
       // $company->password = bcrypt($request->password);
        $company->phone = $request->phone;
        $company->address = $request->address;
        $company->lat = $request->lat;
        $company->lng = $request->lng;
        $company->templete_id =  $request->templete_id;
        $company->city_id = $request->city_id;
        $company->area_id = $request->area_id;
        $company->service_id = $request->service_id;
        $company->attached_file = $request->attached_file;
        $company->about = $request->about;
        $company->facebook = $request->facebook;
        $company->youtube_link = $request->youtube_link;
        $company->youtube_video =  $request->youtube_video;
        $company->twitter = $request->twitter;
        $company->whatsapp = $request->whatsapp;
        $company->linkedin = $request->linkedin;
        $company->website = $request->website;
        $company->website_available_days = $request->website_available_days;
        */
        
        $data = $request->all();
        $data = Arr::except($request->all(), ["password","email"]);
        
        $company->update($data);
        
        if ($request->has("password") && $request->password) {
            $company->update([
                "password" => bcrypt($request->password)        
            ]);
        }
        
        if ($request->hasFile('photo')) {
            // delete old image
            try {
                unlink(public_path("images/company") . "/" .  $company->photo);
            } catch (\Exception $exc) {
            }
            // upload new image
            $company->photo = Helper::uploadImg($request->file("photo"), "/company/");
        }
        ////////////////
        if ($request->hasFile('cover')) {
            // delete old image
            try {
                unlink(public_path("images/company") . "/" .  $company->cover);
            } catch (\Exception $exc) {
            }
            // upload new image
            $company->cover = Helper::uploadImg($request->file("cover"), "/company/");
        }


        $company->update();
        Session::flash('success', 'You Edit Company Successfully .');

        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {

        if(count($company->users) > 0)
        {
            Session::flash('error', 'You can not delete this company because there are a lot of users work on it you can un active it   :) !');
            return redirect()->back();
        }
        else{
            $company->delete();
            Session::flash('success', 'You Deleted Company Successfully .');
            return redirect()->back();
       
        }
    }

      public function active(Company $company)
    {

        $company->active = 'active';
        $company->update();
        Session::flash('success', 'You Active Company  Successfuly  :)');

        return redirect()->back();
    }

     public function notActive(Company $company)
    {

        $company->active = 'not_active';
        $company->update();
        Session::flash('success', 'You Un active Company  Successfuly  :)');

        return redirect()->back();
    }
}
