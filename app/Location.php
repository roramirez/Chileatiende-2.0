<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $incrementing = false;

    public function parent(){
        return $this->belongsTo('App\Location');
    }

}