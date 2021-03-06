<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    protected $fillable = [
        'name_ar','name_en', 'city_id'
    ];

    protected $appends = [
        'can_delete', 'country_id','posts'
    ];

    public function getCanDeleteAttribute() {
        return !Post::where('area_id', $this->id)->exists();
    }
    
    public function getPostsAttribute() {
        return Post::where('area_id', $this->id)->exists();
    }

    public function getCountryIdAttribute() {
        return optional($this->city)->country_id;
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public static function roles() {
        return [
            "city_id" => "required",
            "name_ar" => "required",
            "name_en" => "required"
        ];
    }
}
