<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    public $incrementing = false;

    protected $attributes = [
        'name' => '',
        'shortname' => '',
        'url' => '',
        'description' => '',
        'ministry_id' => null
    ];

    public function pages(){
        return $this->hasMany('App\Page');
    }

    public function ministry(){
        return $this->belongsTo('App\Ministry');
    }

}