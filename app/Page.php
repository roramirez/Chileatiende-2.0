<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use TwigBridge\Facade\Twig;

class Page extends Model
{
    use Searchable;

    protected $casts = [
        'online' => 'boolean',
        'office' => 'boolean',
        'phone' => 'boolean',
        'mail' => 'boolean',
        'featured' => 'boolean',
        'published' => 'boolean',
        'master' => 'boolean',
    ];

    public function masterPage(){
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

    public function toSearchableArray(){
        if($this->master && $this->published){
            $publishedVersion = $this->getPublishedVersion();
            return [
                'id' => $this->id,
                'title'=>$publishedVersion->title,
                'objective' => strip_tags($publishedVersion->objective),
                'hit_count' => $this->hitCount()
            ];
        }

        return [];
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
        return ($this->master ? $this->id : $this->master_id).'-'.$this->alias;
    }

    public function getHowtoAttribute(){
        return $this->online || $this->office || $this->phone || $this->mail;
    }

    public function getPublishedVersion(){
        return $this->versions()->published()->first();
    }

    public function getLastVersion(){
        return $this->versions()->orderBy('id','desc')->first();

    }
}