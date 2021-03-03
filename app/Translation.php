<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $table = 'translations';
    protected $fillable = ['key', 'word_en', 'word_ar'];

    protected $appends = [
    	'value'
    ];

    public function getValueAttribute() {
    	return [
    		"id" => $this->id,
    		"word_en" => $this->word_en,
    		"word_ar" => $this->word_ar,
    	];
    }

    public function getKeyAttribute() {
        return str_replace(' ', '_', $this->attributes['key']);
    }

}
