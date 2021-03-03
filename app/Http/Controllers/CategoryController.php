<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use App\helper\Helper;
use Illuminate\Http\Request;

use Session;
use Auth;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

   
    /////function to show all category in inedex file bay passing all data .....

    public function index()
    {
        $category = Category::all();
        return view('admin.category.index')->with('category', $category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator()->make($request->all(), Category::roles());
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }
        $category = new Category;
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        $category->name_ar = $request->name_ar;
        if ($request->hasFile('icon')) {
            $category->icon = Helper::uploadImg($request->file("icon"), "/category/");
        }
        $category->save();
        Session::flash('success', 'You add Category Successfuly .');
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
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = validator()->make($request->all(), [
            'name_en' => 'required',
           
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        if ($request->hasFile('icon')) {
            // delete old image
            try {
                unlink(public_path("images/category") . "/" .  $category->icon);
            } catch (\Exception $exc) {
            }
            // upload new image
            $category->icon = Helper::uploadImg($request->file("icon"), "/category/");
        }
        $category->update();
        Session::flash('success', 'You Edit Category Successfully .');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(count($category->posts) > 0)
        {
            Session::flash('error', 'You can not delete this Category  because there are a lot of users work on it   :) !');
            return redirect()->back();
        }
        else{
              $category->delete();
              Session::flash('warning', 'You deleted this Category Succesfuly .');
             return redirect()->back();
    
       
        }
    }
}
