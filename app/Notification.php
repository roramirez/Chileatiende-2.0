<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    public function institution(){
        return $this->belongsTo('App\Institution');
    }

    protected $casts = [
        'date' => 'date',
        'read' => 'boolean'
    ];
}