<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Searchable;

    public function hits(){
        return $this->hasMany('\App\Hit');
    }

    public function institution(){
        return $this->belongsTo('\App\Institution');
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
            ->join('hits','hits.page_id','=','pages.id')
            ->groupBy('pages.id')
            ->select(DB::raw('pages.*, SUM(hits.count) as hits'))
            ->orderBy('hits','desc')
            ->limit(3);
    }
}