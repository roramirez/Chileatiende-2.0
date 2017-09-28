<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{

    protected $casts = [
        'date' => 'date'
    ];
}