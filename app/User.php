<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'ministerial' => 'boolean',
        'interministerial' => 'boolean'
    ];

    protected $attributes = [
        'name' => '',
        'email' => '',
        'role' => 'editor',
        'institution_id' => null,
        'ministerial' => false,
        'interministerial' => false
    ];

    public function institution(){
        return $this->belongsTo('App\Institution');
    }
}
