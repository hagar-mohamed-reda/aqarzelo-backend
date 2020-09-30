<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Company;
use App\Helper;
use App\Message;
use App\MailBox;
use App\Profile;
use App\Post;

class TemplateController extends WebsiteController
{

    /**
     * get view of create website page
     * 
     * @return String html of create website.
     */
    public function index() {  
        return view($this->prefix . ".createSite");
    }
     
    
    /**
     * get register user as json
     * 
     * @return User $user
     */
    public function getUser() {  
        return Profile::auth();
    }

    
    /**
     * get register user as json
     * 
     * @return User $user
     */
    public function getSite($name) {  
    	$user = User::where("name", $name)->first();

    	if (!$user) 
    		return redirect("/");
 
    	if ($user->templete_id == null)
    		return redirect("/");

    	$templetes = [
    		2, 3, 4
    	];


    	if (!in_array($user->templete_id, $templetes))
    		return redirect("/");
 
        $posts = Post::where('user_id', $user->id)->get(); 
        return view('templates.template'. $user->templete_id .'.home',compact('user','posts'));
    }

    
       
 
   
}
 