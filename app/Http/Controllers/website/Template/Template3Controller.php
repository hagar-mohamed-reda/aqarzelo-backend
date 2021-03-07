<?php
namespace App\Http\Controllers\Website\Template;
use App\User;
use App\Post;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class Template3Controller extends Controller
{
  public function index($id)
    {
        $user =User::first();
        $posts = Post::where('user_id',$id)->get();
        return view('templates.template3.home',compact('user','posts'));
    }


}
