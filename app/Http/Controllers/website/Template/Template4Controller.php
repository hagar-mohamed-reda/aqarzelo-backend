<?php
namespace App\Http\Controllers\Website\Template;
use App\User;
use App\Post;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class Template4Controller extends Controller
{
    public function index($id)
    {
        $user =User::first();
        $posts = Post::where('user_id',$id)->get();
        return view('templates.template4.home',compact('user','posts'));
    }
}
