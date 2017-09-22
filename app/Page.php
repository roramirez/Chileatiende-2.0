<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use TwigBridge\Facade\Twig;

class Page extends Model
{
    use Searchable;

    public function master(){
        return $this->belongsTo('\App\Page','master_id');
    }

    public function versions(){
        return $this->hasMany('\App\Page','master_id');
    }

    public function hits(){
        return $this->hasMany('\App\Hit');
    }

    public function institution(){
        return $this->belongsTo('\App\Institution');
    }

    public function categories(){
        return $this->belongsToMany('\App\Category');
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

    public function scopeMasters($query){
        return $query
            ->where('master',1);
    }

    public function scopePublished($query){
        return $query
            ->where('published',1);
    }

    public function scopePopular($query){
        return $query
            ->join('hits','hits.page_id','=','pages.id')
            ->groupBy('pages.id')
            ->select(DB::raw('pages.*, SUM(hits.count) as hits'))
            ->orderBy('hits','desc')
            ->limit(3);
    }

    public function getGuidAttribute(){
        return $this->id.'-'.$this->alias;
    }

    public function getPublishedVersion(){
        return $this->versions()->published()->first();
    }

    public function getLastVersion(){
        return $this->versions()->orderBy('id','desc')->first();

    }
}