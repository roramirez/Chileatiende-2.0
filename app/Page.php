<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
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

    protected $appends = ['guid'];

    public function masterPage(){
        return $this->belongsTo('\App\Page','master_id');
    }

    public function versions(){
        return $this->hasMany('\App\Page','master_id');
    }

    public function relatedPages(){
        return $this->belongsToMany('\App\Page','page_related_page','page_id','related_page_id');
    }

    public function similarPages(){
        return $this->belongsToMany('\App\Page','page_similar_page','page_id','similar_page_id');
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
        if(!$this->master && !$this->published){    //No indexamos las versiones no publicadas
            return [];
        }else{
            return [
                'id' => $this->id,
                'master' => $this->master,
                'master_id' => $this->master_id,
                'published' => $this->published,
                'title'=>$this->title,
                'objective' => strip_tags($this->objective),
                'keywords' => $this->keywords,
                'institution_id' => $this->institution_id,
                'category_id' => $this->categories->pluck('id'),
                'hit_count' => $this->hitCount(),
            ];
        }
    }

    public function hitCount(){
        if($this->master)
            $page = $this;
        else
            $page = $this->masterPage;


        return $page->hits()->where('date','>=', Carbon::now()->subYear())->sum('count');
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

        $cacheKey = 'pageIdsOrderedByPopularity';

        if(!Cache::has($cacheKey)){
            $popular = Page::masters()
                ->join('hits','hits.page_id','=','pages.id')
                ->groupBy('pages.id')
                ->select(DB::raw('pages.id, SUM(hits.count) as hits'))
                ->where('hits.date', '>=', Carbon::now()->subYear())
                ->orderBy('hits','desc')
                ->get()
                ->pluck('id')
                ->toArray();

            Cache::put($cacheKey, $popular, 24 * 60);
        }

        $popular = Cache::get($cacheKey);

        return $query
            ->orderByRaw('FIELD(id,'.implode(',',$popular).')')
            ->limit(3);
    }

    public function getGuidAttribute(){
        return ($this->master ? $this->id : $this->master_id).'-'.$this->alias;
    }

    public function getFeaturedAttribute(){
        return (boolean)($this->master ? $this->attributes['featured'] : $this->masterPage->attributes['featured']);
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