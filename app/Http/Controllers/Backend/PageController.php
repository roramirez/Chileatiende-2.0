<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller{

    public function index(Request $request){
        $query = $request->input('query');
        if($query)
            $pages = Page::search($query)->where('master',true);
        else
            $pages = Page::masters();

        $data['query'] = $query;
        $data['pages'] = $pages->paginate(30);

        return view('layouts/backend',[
            'title' => 'Inicio',
            'content' => view('backend/pages/index', $data)
        ]);
    }

    public function show(Request $request, $pageId){
        $page = Page::find($pageId);

        if(!$request->user()->can('view', $page)){
            abort(403);
        }

        $data['page'] = $page;

        return view('layouts/backend',[
            'title' => 'Inicio',
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
            'title' => 'Inicio',
            'content' => view('backend/pages/edit', $data)
        ]);
    }

    public function edit(Request $request, $pageId){
        $page = Page::find($pageId);

        if(!$request->user()->can('update', $page)){
            abort(403);
        }

        $page->published_at = \Carbon\Carbon::now();
        $page->categories = $page->categories()->pluck('id');
        $page->related_pages = $page->relatedPages()->pluck('id');;

        $data['page'] = $page;
        $data['edit'] = true;

        return view('layouts/backend',[
            'title' => 'Inicio',
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

        $page->master = true;
        $page->title = $request->input('title');
        $page->alias = $request->input('alias');
        $page->published_at = \Carbon\Carbon::parse($request->input('published_at'));
        $page->image = $request->input('image');
        $page->objective = $request->input('objective');
        $page->details = $request->input('details');
        $page->beneficiaries = $request->input('beneficiaries');
        $page->requirements = $request->input('requirements');
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
        $page->relatedPages()->sync($request->input('related_pages'));
        $page->save();

        //Guardamos la versión
        $version = $page->replicate();
        $version->id = null;
        $version->master = false;
        $version->master_id = $page->id;
        $version->published = false;
        $version->save();
        //Ahora guardamos las relaciones
        $version->relatedPages()->sync($request->input('related_pages'));

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

        $this->validate($request, [
            'published' => 'required|boolean',
            'featured' => 'required|boolean',
            'boost' => 'required|numeric',
            'institution_id' => 'required|exists:institutions,id',
            'categories' => 'array',
        ]);

        $page = Page::find($pageId);
        $page->published = $request->input('published');
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

    public function versions($pageId){
        $data['edit'] = true;
        $data['page'] = Page::find($pageId);

        return view('layouts/backend',[
            'title' => 'Inicio',
            'content' => view('backend/pages/versions', $data)
        ]);
    }

    public function publishVersion(Request $request, $pageId, $versionId){
        $page = Page::find($pageId);
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
}
