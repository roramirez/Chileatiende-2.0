<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{

    protected $casts = [
        'featured' => 'boolean',
        'exterior' => 'boolean'
    ];

    protected $attributes = [
        'order' => 0,
        'featured' => false,
        'exterior' => false
    ];

    public function pages(){
        return $this->belongsToMany('App\Page');
    }

}