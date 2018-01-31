<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Log;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller{

    public function index(Request $request){
        if(!$request->user()->can('view',Page::class))
            abort(403);

        $query = $request->input('query');
        $institutionId = $request->input('institution_id', function() use ($request){
            if(!$request->user()->ministerial && !$request->user()->interministerial)
                return $request->user()->institution_id;
            return null;
        });
        $ministryId = $request->input('ministry_id', function() use ($request){
            if(!$request->user()->interministerial)
                return $request->user()->institution->ministry_id;
            return null;
        });

        if($query || $institutionId || $ministryId){
            if(is_numeric($query)){
                $pages = Page::masters()->where('id', $query);
            }else{
                $pages = Page::search($query)->where('master',true);
                if($ministryId)
                    $pages->where('ministry_id',[$ministryId]);
                if($institutionId)
                    $pages->where('institution_id',[$institutionId]);
            }
        }else{
            $pages = Page::masters();
        }


        $data['filters'] = [
            'query' => $query,
            'institution_id' => $institutionId,
            'ministry_id' => $ministryId
        ];
        $data['pages'] = $pages->paginate(30);

        return view('layouts/backend',[
            'title' => 'Ver fichas',
            'content' => view('backend/pages/index', $data)
        ]);
    }

    public function featured(Request $request){
        if(!$request->user()->can('updateFeatured', Page::class)){
            abort(403);
        }

        $data['pages'] = Page::masters()->where('featured',1)->orderBy('order')->get();

        return view('layouts/backend',[
            'title' => 'Fichas destacadas',
            'content' => view('backend/pages/featured', $data)
        ]);
    }

    public function updateFeatured(Request $request){
        if(!$request->user()->can('updateFeatured', Page::class)){
            abort(403);
        }

        $this->validate($request,[
            'pages' => 'array',
            'pages.*.id' => 'required|exists:pages',
            'pages.*.order' => 'required|integer'
        ]);

        DB::beginTransaction();
        foreach($request->input('pages') as $p){
            $page = Page::find($p['id']);
            $page->order = $p['order'];
            $page->save();
        }
        DB::commit();

        $request->session()->flash('status', 'Orden de destacados actualizado con éxito.');

        return response()->json(['redirect' => 'backend/fichas/featured']);
    }

    public function show(Request $request, $pageId){
        $page = Page::find($pageId);

        if(!$request->user()->can('view', $page)){
            return \redirect('backend/fichas');
        }

        $page->categories = $page->categories()->pluck('id');
        $data['page'] = $page;

        return view('layouts/backend',[
            'title' => 'Ver ficha',
            'content' => view('backend/pages/show', $data)
        ]);
    }

    public function create(Request $request){
        $page = new Page();

        if(!$request->user()->can('create', $page)){
            abort(403);
        }

        $data['page'] = $page;
        $data['edit'] = false;

        return view('layouts/backend',[
            'title' => 'Editar ficha',
            'iconTitle' => 'edit',
            'content' => view('backend/pages/edit', $data)
        ]);
    }

    public function edit(Request $request, $pageId){
        $page = Page::find($pageId);

        if(!$request->user()->can('update', $page)){
            abort(403);
        }

        $page->related_pages = $page->relatedPages()->pluck('id');;

        $data['page'] = $page;
        $data['edit'] = true;

        return view('layouts/backend',[
            'title' => 'Editar ficha',
            'content' => view('backend/pages/edit', $data)
        ]);
    }

    public function store(Request $request){
        $page = new Page();

        if(!$request->user()->can('create', $page)){
            abort(403);
        }

        $page = $this->save($request, $page);

        $request->session()->flash('status', 'Ficha creada con éxito');

        return response()->json(['redirect' => 'backend/fichas/'.$page->id]);
    }

    public function update(Request $request, $pageId){
        $page = Page::find($pageId);

        if(!$request->user()->can('update', $page)){
            abort(403);
        }

        $page = $this->save($request, $page);

        $request->session()->flash('status', 'Ficha editada con éxito');

        return response()->json(['redirect' => 'backend/fichas/'.$page->id]);
    }

    private function save(Request $request, Page $page){
        $this->validate($request, [
            'title' => 'required',
            'alias' => 'required',
            'published_at' => 'required|date',
            'objective' => 'required',
            'related_pages' => 'array'
        ]);

        DB::beginTransaction();

        //Guardamos la ficha maestra
        $page->master = true;
        $page->institution_id = $page->institution_id ?? $request->user()->institution_id;
        $page->title = $request->input('title');
        $page->alias = $request->input('alias');
        $page->published_at = \Carbon\Carbon::parse($request->input('published_at'));
        $page->image = $request->input('image');
        $page->objective = $request->input('objective');
        $page->details = $request->input('details');
        $page->beneficiaries = $request->input('beneficiaries');
        $page->requirements = $request->input('requirements');
        $page->cost = $request->input('cost');
        $page->online = $request->input('online');
        $page->online_guide = $request->input('online_guide');
        $page->online_url = $request->input('online_url');
        $page->office = $request->input('office');
        $page->office_guide = $request->input('office_guide');
        $page->phone = $request->input('phone');
        $page->phone_guide = $request->input('phone_guide');
        $page->mail = $request->input('mail');
        $page->mail_guide = $request->input('mail_guide');
        $page->legal = $request->input('legal');
        $page->keywords = $request->input('keywords');
        $page->comments = $request->input('comments');
        $page->save();
        //Ahora guardamos las relacionadas
        $page->relatedPages()->sync($request->input('related_pages'));

        //Obtenemos la última versión (Para luego comparar los cambios)
        $lastVersion = $page->lastVersion();

        //Guardamos la versión
        $version = $page->replicate();
        $version->id = null;
        $version->master = false;
        $version->master_id = $page->id;
        $version->published = $lastVersion ? false : true;  //Si no hay mas versiones, entonces dejamos esta como la publicada
        $version->comments = '';
        $version->save();
        //Ahora guardamos las relacionadas
        $version->relatedPages()->sync($request->input('related_pages'));

        //Guardamos el log de cambios
        $log = new Log();
        $log->page_version_id = $version->id;
        $log->user_id = $request->user()->id;
        $log->description = $lastVersion ? $lastVersion->compare($version) : '<p>Se ha creado el trámite.</p>';
        $page->logs()->save($log);

        DB::commit();

        return $page;
    }

    public function destroy(Request $request, $id){
        $page = Page::find($id);

        if(!$request->user()->can('delete', $page)){
            abort(403);
        }

        $page->delete();

        $request->session()->flash('status', 'Ficha eliminada con éxito');

        return redirect('backend/fichas');
    }

    public function updateMaster(Request $request, $pageId){
        $page = Page::find($pageId);

        if(!$request->user()->can('updateMaster', $page)){
            abort(403);
        }

        $this->validate($request, [
            'featured' => 'required|boolean',
            'boost' => 'required|numeric',
            'institution_id' => 'required|exists:institutions,id',
            'categories' => 'array',
        ]);


        $page->featured = $request->input('featured');
        $page->boost = $request->input('boost');
        $page->categories()->sync($request->input('categories'));
        $page->institution_id = $request->input('institution_id');
        $page->save();

        //Actualizamos sus versiones en el indice de busquedas
        $page->versions->searchable();

        $request->session()->flash('status', 'Ficha guardada con éxito');

        return response()->json(['redirect' => 'backend/fichas/'.$page->id]);
    }

    public function updateStatus(Request $request, $pageId){
        $page = Page::find($pageId);

        if(!$request->user()->can('updateStatus', $page)){
            abort(403);
        }

        $action = $request->input('action');

        if($action == 'publish'){
            $page->status = '';
            $page->status_comment = '';
            $page->published = true;
            $version = $page->lastVersion();
            foreach($page->versions as $v){
                if($v->id != $version->id && $v->published){
                    $v->published = 0;
                    $v->save();
                }
            }
            $version->published = 1;
            $version->save();
        }elseif($action == 'unpublish'){
            $page->published = false;
            $page->status_comment = $request->input('status_comment');
        }elseif($action == 'revise'){
            $page->status = 'en_revision';
        }elseif($action == 'reject'){
            $page->status = 'rechazado';
            $page->status_comment = $request->input('status_comment');
        }
        /*
        $page->status = $status;
        $page->status_comment = $request->input('status_comment');
        if($status == 'rechazado')
            $page->published = false;
        elseif($status == '')
            $page->published = true;
        */
        $page->save();

        //Actualizamos sus versiones en el indice de busquedas
        $page->versions->searchable();

        $request->session()->flash('status', 'Ficha actualizada con éxito.');

        return response()->json(['redirect' => 'backend/fichas/'.$page->id]);
    }

    public function versions($pageId){
        $data['edit'] = true;
        $data['page'] = Page::find($pageId);

        return view('layouts/backend',[
            'title' => 'Versiones de la ficha',
            'content' => view('backend/pages/versions', $data)
        ]);
    }

    public function publishVersion(Request $request, $pageId, $versionId){
        $page = Page::find($pageId);

        if(!$request->user()->can('publishVersion', $page)){
            abort(403);
        }

        $version = Page::find($versionId);

        foreach($page->versions as $v){
            if($v->published){
                $v->published = 0;
                $v->save();
            }
        }

        $version->published = 1;
        $version->save();

        $request->session()->flash('status', 'Ficha publicada con éxito');

        return redirect('backend/fichas/'.$page->id.'/versions');
    }

    public function history(Request $request, $pageId){

        $data['edit'] = true;
        $data['page'] = Page::find($pageId);

        return view('layouts/backend',[
            'title' => 'Historial',
            'content' => view('backend/pages/history', $data)
        ]);
    }
}
