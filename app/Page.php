<?php

namespace App;

use Carbon\Carbon;
use cogpowered\FineDiff\Diff;
use cogpowered\FineDiff\Granularity\Word;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use TwigBridge\Facade\Twig;
use App\Category;
use Kyslik\ColumnSortable\Sortable;

class Page extends Model
{
    use Searchable, Sortable;

    protected $casts = [
        'online' => 'boolean',
        'office' => 'boolean',
        'phone' => 'boolean',
        'mail' => 'boolean',
        'featured' => 'boolean',
        'published' => 'boolean',
        'master' => 'boolean',
        'published_at' => 'date',
        'comments' => 'object'
    ];

    protected $appends = ['guid', 'howto'];

    protected $attributes = [
        'title' => '',
        'alias' => '',
        'published_at' => null,
        'image' => '',
        'objective' => '',
        'details' => '',
        'beneficiaries' => '',
        'requirements' => '',
        'cost' => '',
        'validity' => '',
        'online' => false,
        'online_guide' => '',
        'online_url' => '',
        'office' => false,
        'office_guide' => '',
        'phone' => false,
        'phone_guide' => '',
        'consulate' => false,
        'consulate_guide' => '',
        'mail' => false,
        'mail_guide' => '',
        'legal' => '',
        'keywords' => '',
        'comments' => '{}'
    ];

    public $sortable = ['id','title','status','published','updated_at'];

    public function masterPage(){
        return $this->belongsTo('\App\Page','master_id');
    }

    public function versions(){
        return $this->hasMany('\App\Page','master_id');
    }

    public function messages(){
        return $this->hasMany('\App\Message','page_id');
    }

    public function relatedPages(){
        return $this->belongsToMany('\App\Page','page_related_page','page_id','related_page_id');
    }

    public function similarPages(){
        return $this->belongsToMany('\App\Page','page_similar_page','page_id','similar_page_id');
    }

    public function logs(){
        return $this->hasMany('\App\Log');
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

            return [
                'id' => $this->id,
                'master' => $this->master,
                'master_id' => $this->master_id,
                'master_published' => $this->master ? $this->published : $this->masterPage->published,
                'published' => $this->published,
                'title'=>$this->title,
                'objective' => strip_tags($this->objective),
                'keywords' => $this->keywords,
                'institution_id' => $this->institution->id,
                'ministry_id' => $this->institution->ministry_id,
                'category_id' => $this->categories->pluck('id'),
                'hit_count' => $this->hitCount(),
                'boost' => $this->master ? $this->boost : $this->masterPage->boost
            ];

    }

    public function hitCount(){
        if($this->master)
            $page = $this;
        else
            $page = $this->masterPage;


        return $page->hits()->where('date','>=', Carbon::now()->subYear())->sum('count');
    }

    public function addHit(){
        if(!$this->master)
            return;

        DB::beginTransaction();
        $hits = $this->hits()->where('date', Carbon::now()->format('Y-m-d'))->first();
        if(!$hits){
            $hits = new Hit();
            $hits->page_id = $this->id;
            $hits->date = Carbon::now()->format('Y-m-d');
        }
        $hits->count++;
        $hits->save();

        $sessionVisit = new SessionVisit();
        $sessionVisit->page_id = $this->id;
        $sessionVisit->session_id = session()->getId();
        $sessionVisit->save();

        DB::commit();
        $this->publishedVersion()->searchable();
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

        $cacheKey = 'Page::scopePopular::pageIdsOrderedByPopularity';

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

    public function getFeaturedAttribute($value){
        return (boolean) ($this->master ? $value : $this->masterPage->featured);
    }

    public function getHowtoAttribute(){
        return $this->online || $this->office || $this->phone || $this->mail || $this->consulate;
    }

    public function getBoostAttribute($value){
        return $this->master ? $value : $this->masterPage->boost;
    }

    public function publishedVersion(){
        return $this->versions()->published()->first();
    }

    public static function popularPublishedVersions($categoryId){
        $cacheKey = 'Page::popularPublishedVersions?categoryId='.$categoryId;

        if(!Cache::has($cacheKey)){
            $popular = self::whereHas('categories',function($q) use ($categoryId){
                return $q->where('id',$categoryId);
            })->masters()->published()->popular()->get();
            
            $publishedVersions = collect();
            foreach($popular as $p){
                $publishedVersions->push($p->publishedVersion());
            }

            Cache::put($cacheKey, $publishedVersions, 24 * 60);
        }

        return Cache::get($cacheKey);
    }

    public function lastVersion(){
        return $this->versions()->orderBy('id','desc')->first();

    }

    public function compare(Page $page){

        $diff = new Diff(new Word());
        $exclude = ['id','master','published','created_at','updated_at'];

        $differences = [];
        foreach($this->attributes as $key=>$a){
            if(!in_array($key,$exclude) && $a != $page->attributes[$key])
                $differences[$key] = $diff->render($a, $page->attributes[$key]);
        }

        $text = '';
        foreach($differences as $key => $d){
            $text.='<p>Modificación en <strong>'.$key.'</strong>:</p>';
            $text.=html_entity_decode($d);
        }

        return $text;
    }

    /*
     * Deprecated
     */
    public function getCodeAttribute(){
        $correlative = $this->masterPage->correlative;
        if(!$correlative)
            $correlative = $this->masterPage->id;

        return $this->institution->id.'-'.$correlative;
    }

    /*
    *   Atributos que serán mostrados a traves de la API pública.
    */
    public function toPublicArray(){
        return [
            'id' => $this->masterPage->id,
            'codigo' => $this->code,
            'servicio' => $this->institution->name,
            'fecha' => $this->published_at ? $this->published_at->toDateTimeString() : null,
            'titulo' => $this->title,
            'objetivo' => $this->objective,
            'beneficiarios' => $this->beneficiaries,
            'costo' => $this->cost,
            'marco_legal' => $this->legal,
            'guia_online' => $this->online_guide,
            'guia_online_url' => $this->online_url,
            'guia_oficina' => $this->office_guide,
            'guia_correo' => $this->mail_guide,
            'guia_telefonico' => $this->phone_guide,
            'guia_consulado' => $this->consulate_guide,
            'vigencia' => $this->validity,
            'plazo' => '',
            'doc_requeridos' => $this->requirements,
            'updated_data_at' => $this->published_at ? $this->published_at->toDateTimeString() : null,
            'observaciones' => '',
            'temas' => ['tema' => []],
            'tags' => ['tag' => []],
            'chileclic_id' => null,
            'permalink' => url('fichas/'.$this->guid),
        ];
    }
}