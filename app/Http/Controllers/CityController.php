<?php

namespace App\Http\Controllers;

use App\City;
use App\Area;
use Illuminate\Http\Request;
use Session;
use Auth;
class CityController extends Controller
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
        $city = City::all();
        return view('admin.city.index')->with('city', $city);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.city.add');
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
            'name_en' => 'required',
            'name_ar' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }

        City::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,

        ]);
        Session::flash('success', 'You add City Successfuly  :)');
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
    public function edit(City $city)
    {
        return view('admin.city.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {

        $validator = validator()->make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }
        $city->name_ar = $request->name_ar;
        $city->name_en = $request->name_en;
        $city->update();
        Session::flash('success', 'You Edit City Successfully .');
        return redirect()->route('city.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    { 
         if(count($city->areas) > 0)
        {
            Session::flash('error', 'You can not delete this city because there are a lot process in their areas  :) !');
            return redirect()->back();
        }
        else{
            $city->delete();
            Session::flash('warning', 'You Deleted City Successfully :) !');
            return redirect()->back();
         }

    }
}
