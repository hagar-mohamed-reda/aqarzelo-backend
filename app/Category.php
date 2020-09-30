<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_ar','name_en', 'icon'
    ];

    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
