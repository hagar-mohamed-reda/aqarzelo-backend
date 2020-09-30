<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\PostReview;
use App\MailBox;
use App\Message;
use App\Favourite;
use App\Profile;

class PostController extends WebsiteController
{
    /**
     * max comments for user on post
     * @var Integer
     */
    private static $commentNumber = 1;
    
    /**
     * return view of post page
     * @return type String html of view
     */
    public function index(Request $request) {
        $post = $request->has("post_id")? Post::find($request->post_id): null;
        
        return view($this->prefix . ".post.posts", compact('post'));
    }
    
    /**
     * get create post view
     * @return type
     */
    public function create() {
        return view($this->prefix . ".post.create.index");
    }
    
    /**
     * get edit post view
     * @return type
     */
    public function edit() {
        return view($this->prefix . ".post.create.index");
    }

    /**
     * get panorama view
     * @return type
     */
    public function panorama() {
        return view($this->prefix . ".post.panorama");
    }
    
    /**
     * send message to company
     * 
     * @param Request $request
     */
    public function setMessageToCompany(Request $request) {   
        $post = Post::find($request->post_id);
        
        if ($post) {
            MailBox::create([
                "email" => $request->email,
                "name" => $request->name,
                "user_id" => $post->user->company->id,
                "user_type" => "COMPANY",
                "message" => $request->phone . "<br>" .  $request->message,
            ]);
            return Message::success(trans("words.done"));
        }
        
        return Message::error(trans("words.please_fill_all_data"));
    }
    
    /**
     * add comment for post
     * 
     * @param Request $request
     */
    public function addComment(Request $request) {   
        $post = Post::find($request->post_id);
        $user = Profile::auth();
        
        if ($post && $user) {
            if (PostReview::where("user_id", $user->id)->where("post_id", $post->id)->count() >= self::$commentNumber)
                    return Message::error(trans("words.cant_add_more_than_n_comment_for_post", ["number" => self::$commentNumber]));
            
            PostReview::create([
                "user_id" => $user->id,
                "post_id" => $post->id,
                "comment" => $request->comment,
                "rate" => $request->rate? $request->rate : 0,
            ]);
            return Message::success(trans("words.done"));
        } else { 
            return Message::error(trans("words.login_first"));
        }
        
        return Message::error(trans("words.please_fill_all_data"));
    }
     
    /**
     * add comment for post
     * 
     * @param Request $request
     */
    public function addFavourite(Request $request) {   
        $post = Post::find($request->post_id);
        $user = Profile::auth();
        
        if ($post && $user) { 
            $favourite = Favourite::where("post_id", $post->id)->where("user_id", $user->id)->first();
            
            if ($favourite) {
                $favourite->delete();
                return Message::success(trans("words.post_remove_from_favourite"));
            } else {
                Favourite::create([
                    "user_id" => $user->id,
                    "post_id" => $post->id, 
                ]);
                return Message::success(trans("words.post_add_to_favourite"));
            } 
        }
        
        return Message::error(trans("words.login_first"));
    }
}
