<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name_ar','name_en'
    ];

    public function city()
    {
        return $this->hasMany('App\City');
    }
}
