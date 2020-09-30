<?php

namespace App\Http\Controllers;

use App\Area;
use App\City;
use Illuminate\Http\Request;
use Session;
use Auth;

class AreaController extends Controller
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
        $area = Area::all();
        return view('admin.area.index')->with('area', $area);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::all();
        return view('admin.area.add')->with('city', $city);
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
            'city_id' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }
        Area::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'city_id' => $request->city_id
        ]);
        Session::flash('success', 'You add Area Successfuly  :)');
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
    public function edit(Area $area)
    {
        $city = City::all();
        return view('admin.area.edit', compact('area'))->with('city', $city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {

        $validator = validator()->make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
            'city_id' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }
        $area->name_ar = $request->name_ar;
        $area->name_en = $request->name_en;
        $area->city_id = $request->city_id;
        $area->update();

        Session::flash('success', 'You Edit Area Successfully .');
        return redirect()->route('area.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {

        $area->delete();
        Session::flash('warning', 'You Deleted Area Successfully :) !');
        return redirect()->back();
    }
}
