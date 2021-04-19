<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name_ar','name_en', 'country_id'
    ];

    protected $appends = [
        'can_delete'
    ];

    public function getCanDeleteAttribute() {
        return !Post::where('city_id', $this->id)->exists() || !Area::where('city_id', $this->id)->exists();
    }

    public function country() {
        return $this->belongsTo("App\Country");
    }

    public function areas()
    {
        return $this->hasMany('App\Area');
    }
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public static function roles() {
        return [
            "country_id" => "required",
            "name_ar" => "required",
            "name_en" => "required"
        ];
    }
}
