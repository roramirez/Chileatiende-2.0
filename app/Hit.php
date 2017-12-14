<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
    public $timestamps = false;

    protected $casts = [
        'date' => 'date'
    ];
}