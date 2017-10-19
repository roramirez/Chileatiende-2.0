<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $casts = [
        'mobile' => 'boolean'
    ];

    public function location(){
        return $this->belongsTo('App\Location');
    }

}