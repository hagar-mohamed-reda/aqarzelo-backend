<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'title_en', 'description_en', 'title_ar', 'description_ar', 'expire_date', 'active', 'photo','logo'
    ];

    
    /**
     * The attributes that are appended to object after loaded from db.
     *
     * @var array
     */
    protected $appends = [
        'image', 'logo_url'
    ];

    
    /**
     * return image url
     * 
     * @return String
     */
    public function getImageAttribute() {
        return url('/images/ads') . '/' . $this->photo;
       
    } 
    
    public function getLogoUrlAttribute() {
        return url('/images/ads') . '/' . $this->logo;
    } 
    
   
    


 }
