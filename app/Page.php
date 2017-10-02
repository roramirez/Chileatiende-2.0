<?php

namespace App;

use Carbon\Carbon;
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
        'published_at' => 'date'
    ];

    public function masterPage(){
        return $this->belongsTo('\App\Page','master_id');
    }

    public function versions(){
        return $this->hasMany('\App\Page','master_id');
    }

    public function hits(){
        if(!$this->master)
            return $this->masterPage->hasMany('\App\Hit');

        return $this->hasMany('\App\Hit');
    }

    public function institution(){
        if(!$this->master)
            return $this->masterPage->belongsTo('\App\Institution');

        return $this->belongsTo('\App\Institution');
    }

    public function categories(){
        if(!$this->master)
            return $this->masterPage->belongsToMany('\App\Category');

        return $this->belongsToMany('\App\Category');
    }

    public function toSearchableArray(){
        if($this->master && $this->published){
            $publishedVersion = $this->publishedVersion();
            return [
                'id' => $this->id,
                'title'=>$publishedVersion->title,
                'objective' => strip_tags($publishedVersion->objective),
                'keywords' => $publishedVersion->keywords,
                'institution_id' => $this->institution_id,
                'category_id' => $this->categories->pluck('id'),
                'hit_count' => $this->hitCount(),
            ];
        }

        return [];
    }

    public function hitCount(){
        return $this->hits()->where('date','>=', Carbon::now()->subYear())->sum('count');
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

    public function getFeaturedAttribute(){
        return ($this->master ? $this->attributes['featured'] : $this->masterPage->attributes['featured']);
    }

    public function getHowtoAttribute(){
        return $this->online || $this->office || $this->phone || $this->mail;
    }

    public function publishedVersion(){
        return $this->versions()->published()->first();
    }

    public function lastVersion(){
        return $this->versions()->orderBy('id','desc')->first();

    }
}