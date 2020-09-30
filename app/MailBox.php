<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailBox extends Model
{
    protected $fillable = [
        'email', 'name','message' ,'user_type','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
 
}
