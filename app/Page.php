<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Searchable;

    public function hits(){
        return $this->hasMany('\App\Hit');
    }

    public function toSearchableArray()
    {
        return [
            'title'=>$this->title,
            'objective' => strip_tags($this->objective),
            'hit_count' => $this->hitCount()
            ];
    }

    public function hitCount(){
        return $this->hits()->sum('count');
    }

    public function scopePopular($query){
        return $query
            ->with('hits')
            ->get()
            ->sortByDesc(function($d){
                return $d->hits->sum('count');
            })
            ->slice(0,3);
    }
}