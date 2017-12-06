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
        'first_name', 'last_name', 'email', 'password',
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
        'interministerial' => 'boolean',
        'birth_date' => 'date',
        'foreigner' => 'boolean'
    ];

    protected $attributes = [
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'role' => 'counterpart',
        'institution_id' => null,
        'ministerial' => false,
        'interministerial' => false
    ];

    public function institution(){
        return $this->belongsTo('App\Institution');
    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function getNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }

    public function scopeBackend($query){
        return $query->where('backend',1);
    }

    public function hasCustomizationData(){

        if($this->categories()->count() == 0)
            return false;

        return true;
    }
}
