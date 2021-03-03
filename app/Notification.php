<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model {


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'post_id', 'user_id', 'seen', 'title_ar', 'body_ar', 'icon'
    ];


    /**
     * The attributes that are appended to object after loaded from db.
     *
     * @var array
     */
    protected $appends = [
        'post', 'diff_time'
    ];


    public static function notify($title, $body, $icon) {    
        self::create([
            "title" => $title, 
            "body_ar" => $body, 
            "body_en" => $body, 
            "icon" => $icon, 
            "user_id" => request()->user()->id
        ]);
    }
    /**
     * return post attribute as Object
     *
     * @return Post $post
     */
    public function getPostAttribute() {
        return $this->post()->first();
    }

    /**
     * return diffrent time readable for human
     *
     * @return Post $post
     */
    public function getDiffTimeAttribute() {
        //$time = Carbon::parse($this->created_at);
        return Carbon::parse($this->created_at)->diffForHumans();
    }


    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function post() {
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function seen() {
        $this->seen = '1';
        $this->update();
    }

}
