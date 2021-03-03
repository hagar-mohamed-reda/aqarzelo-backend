<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_ar','name_en', 'icon'
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
            "name_en" => "required"
        ];
    }
    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
