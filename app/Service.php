<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
     protected $fillable = [
        'name', 'icon','max_user' ,'max_post' ,'max_post_image' ,'price'
    ];

    public function companies()
    {
        return $this->hasMany('App\Company');
    }
      

     
}
