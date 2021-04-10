<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Company extends Authenticatable implements Profilable {

    use Notifiable;
    /**
     * id of the admin company [akar zello]
     *
     * @var String
     */
    public static $ADMIN_COMPANY_ID = 1;




    protected $fillable = [
        'name', 'email', 'password',
        'phone', 'photo', 'address',
        'cover', 'type', 'active',

        'lng', 'lat', 'templete_id',
        'city_id', 'area_id', 'service_id',
        'attached_file', 'about', 'facebook',
        'youtube_link', 'youtube_video',
        'twitter', 'whatsapp', 'linkedin',
        'website', 'website_available_days', 'commercial_no','address', 'api_token',
        'type'// developer, broker
    ];


    /**
     * The attributes that are appended to object after loaded from db.
     *
     * @var array
     */
    protected $appends = [
        'photo_url', 'cover_url', 'can_delete', 'plan', 'plan_id', 'country_id'
    ];

    public function getCountryIdAttribute() {
        return optional($this->city)->country_id;
    }

    public function getPlanIdAttribute() {
        $item = PlanAssign::where('model_id', $this->id)->latest()->where('model_type', $this->type)->first();
        return optional($item)->plan_id;
    }

    public function getPlanAttribute() {
        $item = PlanAssign::where('model_id', $this->id)->latest()->where('model_type', $this->type)->first();
        return Plan::where('id', optional($item)->plan_id)->first();
    }

    public function getCanDeleteAttribute() {
        return !User::where('company_id', $this->id)->exists();
    }

    /**
     * return url of the image of the user
     *
     * @return String
     */
    public function getPhotoUrlAttribute() {
        if (!$this->photo)
            return url('images/company.jpg');
        return url('/images/company') . "/" . $this->photo;
    }


    /**
     * return url of the cover image
     *
     * @return String
     */
    public function getCoverUrlAttribute() {
        return url('/images/company') . "/" . $this->cover;
    }

    public function users() {
        return $this->hasMany('App\User');
    }

    public function posts() {
        return Post::query()
                ->join("users", "posts.user_id", "=", "users.id")->
                where("users.company_id", $this->id);
    }

    public function city() {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function area() {
        return $this->belongsTo('App\Area', 'area_id');
    }

    public function service() {
        return $this->belongsTo('App\Service', 'service_id');
    }

    public function templete() {
        return $this->belongsTo('App\Templete', 'templete_id');
    }

    public static function auth() {
        return Company::find(session('company'));
    }

    /**
     * is the company has admin role
     * return true if the id of company is [1]
     * return false if not
     * @return boolean
     */
    public function isAdmin() {
        return $this->id == 1? true : false;
    }
}
