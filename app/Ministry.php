<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    public $incrementing = false;

    protected $attributes = [
        'id' => '',
        'name' => '',
        'shortname' => '',
        'description' => '',
    ];

}