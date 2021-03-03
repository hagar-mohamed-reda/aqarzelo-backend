<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name_ar','name_en'
    ];
    
    protected $appends = [
        'can_delete'
    ];
    
    public function getCanDeleteAttribute() {
        return !Post::where('country_id', $this->id)->exists() || !City::where('country_id', $this->id)->exists();
    }

    public function city()
    {
        return $this->hasMany('App\City');
    }
    
    public static function roles() {
        return [
            "name_ar" => "required",
            "name_en" => "required"
        ];
    }
}
