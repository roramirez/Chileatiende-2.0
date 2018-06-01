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
        'foreigner' => 'boolean',
        'active' => 'boolean'
    ];

    protected $attributes = [
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'role' => 'counterpart',
        'institution_id' => null,
        'ministerial' => false,
        'interministerial' => false,
        'active' => true
    ];

    public function institution(){
        return $this->belongsTo('App\Institution');
    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function notifications(){
        return $this->hasMany('App\Notification');
    }

    public function getNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }

    public function messages(){
        return $this->hasMany('\App\Message','user_id');
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
