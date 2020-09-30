<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name_ar','name_en'
    ];

    public function areas()
    {
        return $this->hasMany('App\Area');
    }
}
