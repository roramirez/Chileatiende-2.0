<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    public $incrementing = false;

    protected $attributes = [
        'id' => '',
        'name' => '',
        'shortname' => '',
        'url' => '',
        'description' => '',
        'ministry_id' => null
    ];

    public function pages(){
        return $this->hasMany('App\Page');
    }

    public function ministry(){
        return $this->belongsTo('App\Ministry');
    }

    /*
    *   Atributos que serán mostrados a traves de la API pública.
    */
    public function toPublicArray(){
        return [
            'id' => $this->id,
            'nombre' => $this->name,
            'sigla' => $this->shortname,
            'url' => $this->url,
            'mision' => $this->description
        ];
    }

}