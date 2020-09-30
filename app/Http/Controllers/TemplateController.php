<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;

use App\Profile;
use App\User;
use App\helper\Helper;
use Session;
use Auth;

class TemplateController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
   

    /**
     * @param String $name name of the tempate
     * @return String html of the template
     */
    public function preview($name) {
        try {
            $profile = new Profile(new User());
            return view("templates." . $name . ".home", compact('profile'));
        } catch (\Exception $exc) {
            return "";
        }
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::all();
        return view('admin.template.index')->with('templates', $templates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.template.add');
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
            'url' => 'required',
            'photo' => 'required',
            'price' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return back();
        }

        $template = new Template;
        $template->name = $request->name;
        $template->url = $request->url;
        $template->price = $request->price;
        if ($request->hasFile('photo')) {
            $template->photo = Helper::uploadImg($request->file("photo"), "/company/");
        }
        $template->save();
        Session::flash('success', 'You add Template Successfuly  :)');
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


    public function active(Template $template)
    {

        $template->active = 'active';
        $template->update();
        Session::flash('success', 'You Active Template  Successfuly  :)');

        return redirect()->back();
    }

    public function notActive(Template $template)
    {

        $template->active = 'not_active';
        $template->update();
        Session::flash('success', 'You Un active Template  Successfuly  :)');

        return redirect()->back();
    }
}
