<?php

namespace App\Http\Controllers;

use App\Ads;
use App\helper\Helper;
use Session;
use Illuminate\Http\Request;
use Auth;


class AdsController extends Controller
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
        $ads = Ads::all();
        return view('admin.ads.index')->with('ads', $ads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ads.add');
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

            'title_en' => 'required',
            'title_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'url' => 'required',
            'photo' => 'required',
            'expire_date' => 'required'
        ]);


        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }

        $ads = new Ads;
        $ads->title_en = $request->title_en;
        $ads->title_ar = $request->title_ar;
        $ads->description_en = $request->description_en;
        $ads->description_ar = $request->description_ar;
        $ads->url = $request->url;
        $ads->expire_date = $request->expire_date;
        if ($request->hasFile('photo')) {
            $ads->photo = Helper::uploadImg($request->file("photo"), "/ads/");
        }
         if ($request->hasFile('logo')) {
            $ads->logo = Helper::uploadImg($request->file("logo"), "/ads/");
        }
        $ads->save();

        Session::flash('success', 'You add Advetise Successfuly  :)');
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

    public function edit($ads)
    {
        $ads = Ads::find($ads);
        return view('admin.ads.edit', compact('ads'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $ads)
    {
        $validator =  validator()->make($request->all(), [

            'title_en' => 'required',
            'title_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'url' => 'required',

            'expire_date' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }
        $ads = Ads::find($ads);

        $ads->title_en = $request->title_en;
        $ads->title_ar = $request->title_ar;
        $ads->description_en = $request->description_en;
        $ads->description_ar = $request->description_ar;
        $ads->url = $request->url;
        $ads->expire_date = $request->expire_date;

        if ($request->hasFile('photo')) {
            // delete old image
            try {
                unlink(public_path("images/ads") . "/" .  $ads->photo);
            } catch (\Exception $exc) {
            }
            // upload new image
            $ads->photo = Helper::uploadImg($request->file("photo"), "/ads/");
        }
        
        
          if ($request->hasFile('logo')) {
            // delete old image
            try {
                unlink(public_path("images/ads") . "/" .  $ads->logo);
            } catch (\Exception $exc) {
            }
            // upload new image
            $ads->logo = Helper::uploadImg($request->file("logo"), "/ads/");
        }


        $ads->update();
        Session::flash('success', 'You Edit Advetise Successfully .');


        return redirect()->route('advertise.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ads)
    {
        $ads = Ads::find($ads);
        
        $ads->delete();
        Session::flash('warning', 'You deleted this Advertise Succesfuly .');

        return redirect()->back();
    }

    public function active(Ads $ads)
    {

        $ads->active = 'active';
        $ads->update();
        Session::flash('success', 'You Active this Advertise Succesfuly .');

        return redirect()->back();
    }

    public function notActive(Ads $ads)
    {

        $ads->active = 'not_active';
        $ads->update();
        Session::flash('success', 'You Unactive this Advertise Succesfuly .');

        return redirect()->back();
    }
}
