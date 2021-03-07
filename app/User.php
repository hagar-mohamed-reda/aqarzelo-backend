<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use DB;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements Profilable {

    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active', 'name', 'email',
        'password', 'phone', 'photo',
        'cover', 'address', 'api_token',
        'company_id', 'lng', 'lat', 'type',
        'template_id', 'city_id', 'area_id',
        'firebase_token', 'attached_file',
        'about', 'facebook', 'youtube_link',
        'youtube_video', 'twitter', 'whatsapp',
        'linkedin', 'website', 'website_available_days',
        'sms_code', 'post_id_tmp', 'templete_id', 'is_external',
        'verify_code', 'role_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * The attributes that are appended to object after loaded from db.
     *
     * @var array
     */
    protected $appends = [
        'photo_url', 'cover_url', 'can_delete', 'plan'
    ];

    public function getPlanAttribute() {
        return Plan::where('model_id', $this->id)->where('model_type', $this->type)->first();
    }


    public function getCanDeleteAttribute() {
        return !Post::where('user_id', $this->id)->exists();
    }
/*
    public function getPermissionsAttribute() {
        $ids = DB::table('permission_role')->where('role_id', optional($this->roles()->first())->id)->pluck('permission_id')->toArray();

        $permissions = Permission::whereIn('id', $ids)->pluck('id', 'name')->toArray();
        return $permissions;
    }
*/
    /**
     * return category object
     *
     * @return Category
     */
    public function getCategoryAttribute() {
        return $this->category()->first();
    }


    /**
     * return url of the image of the user
     *
     * @return String
     */
    public function getPhotoUrlAttribute() {
        if (!$this->photo)
            return url('images/user.jpg');
        return url('/images/users') . "/" . $this->photo;
    }


    /**
     * return url of the cover image
     *
     * @return String
     */
    public function getCoverUrlAttribute() {
        return $this->cover? url('/images/users') . "/" . $this->cover : url('images/cover.jpg');
    }


    /**
     * notify all users with the post
     *
     * @param String $title_ar
     * @param String $title_en
     * @param String $body_ar
     * @param String $body_en
     */
    public static function notifyAll($title_ar, $title_en, $body_ar, $body_en, $post_id) {
        foreach (User::all() as $user) {
            $user->notify($title_ar, $title_en, $body_ar, $body_en, $post_id);
        }
    }


    /**
     * notify the user with new post status
     * notify the user with notification and firebase notification
     *
     * @param String $title_ar
     * @param String $title_en
     * @param String $body_ar
     * @param String $body_en
     * @param Integer $post_id
     */
    public function notify($title_ar, $title_en, $body_ar, $body_en, $post_id=null, $userId=null) {
        try {
            if ($post_id)
            DB::statement("delete from notifications where user_id='".$this->id."' and post_id=$post_id ");
            Notification::create([
                "title" => $title_en,
                "title_ar" => $title_ar,
                "body" => $body_en,
                "body_ar" => $body_ar,
                "user_id" => $this->id,
                "post_id" => $post_id
            ]);

            $data = [
                "title_ar" => $title_ar,
                "title_en" => $title_en,
                "body_ar" => $body_ar,
                "body_en" => $body_en,
                "post_id" => $post_id,
                "user_id" => $userId
            ];

            $token = [$this->firebase_token];
            return Helper::firebaseNotification($token, $data);
        } catch (Exception $e) {}
    }


    /**
     * check the user active or not active
     *
     * @return boolean
     */
    public function isActive() {
        return $this->active == 'active'? true : false;
    }

    /**
     * check the user login or not with api_token
     *
     * @param Request $request
     * @return User $user
     */
    public static function auth(Request $request) {
        if (!$request->api_token)
            return null;
        $user = User::with(['plan', 'company', 'notifications'])->where("api_token", $request->api_token)->first();
        return $user;
    }

    /**
     * send message to a user
     *
     * @param User user
     * @param String message
     */
    public function sendMessage(User $user, $message) {
        $chat = Chat::create([
            "user_from" => $this->id,
            "user_to" => $user->id,
            "message" => $message,
        ]);
        // notify the another user
        $user->notify(trans("messages_en.new_message_from", ["user" => $this->name]), trans("messages_en.new_message_from", ["user" => $this->name]), $message, $message, null, $user->id);

        return $chat;
    }


    /**
     * return all chat messages
     *
     * @return Array
     */
    public function messages() {
        return Chat::where("user_from", $this->id)->orWhere("user_to", $this->id)->get();
    }

    public function template() {
        return $this->belongsTo('App\Templete', 'templete_id');
    }

    public function plan() {
        return $this->belongsTo('App\Plan', 'plan_id')->where('model_type', $this->type);
    }

    public function city() {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function role() {
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function area() {
        return $this->belongsTo('App\Area', 'area_id');
    }

    public function company() {
        return $this->belongsTo('App\Company', 'company_id')->select('id', 'name', 'type', 'photo', 'active');
    }

    public function posts() {
        return $this->hasMany('App\Post')->where("status", "!=", "user_trash");
    }

    public function notifications() {
        return $this->hasMany('App\Notification');
    }

    public function mails() {
        return $this->hasMany('App\MailBox');
    }

    public function postReviews() {
        return $this->hasMany('App\PostReview');
    }

    public function websiteReviews() {
        return $this->hasMany('App\WebsiteReview');
    }

    public function favourites() {
        return $this->hasMany('App\Favourite');
    }

    public function getCurrentPlan() {
        $plan = Plan::where('model_type', $this->type)->where('model_id', $this->id)->first();

        if (!$plan) {
            $plan = Plan::where('model_type', $this->type)->first();
        }

        if (!$plan) {
            $plan =Plan::where('model_type', optional($this->company)->type)
                    ->where('model_id', optional($this->company)->id)->first();
        }

        if (!$plan) {
            $plan =Plan::where('model_type', optional($this->company)->type)->first();
        }

        return $plan;
    }

}
