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
        'title_ar',
        'publish_date',
        'end_date',
        'time_from',
        'time_to',
        'seconds',
        'url',
        'country_id',
        'city_id',
        'area_id',
        'description_en',
        'description_ar',
        'photo',
        'lat',
        'lng',
        'distance',
        'created_at',
        'updated_at',
        'title_en'
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
