<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'cost',
        'max_post',
        'min_post',
        'show_logo',
        'country_id',
        'city_id',
        'area_id',
        'recommended_post',
        'user_number',
        'period',
        'model_id',
        'model_type'
    ];

    protected $appends = [
        'can_delete'
    ];
    
    public function getCanDeleteAttribute() {
        return !Post::where('category_id', $this->id)->exists();
    }

    public static function roles() {
        return [
            "name_ar" => "required",
            "name_en" => "required",
            "cost" => "required",
            "max_post" => "required",
            "min_post" => "required",
            "user_number" => "required",
            "period" => "required",
        ];
    }
     
    public function country() {
        return $this->belongsTo(Country::class);
    }
     
    public function city() {
        return $this->belongsTo(City::class);
    }
     
    public function area() {
        return $this->belongsTo(Area::class);
    }
}
