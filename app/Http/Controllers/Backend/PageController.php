<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller{

    public function index(){

        $data['pages'] = Page::masters()->paginate(30);

        return view('layouts/backend',[
            'title' => 'Inicio',
            'content' => view('backend/pages/index', $data)
        ]);
    }

    public function show($pageId){
        $data['page'] = Page::find($pageId);

        return view('layouts/backend',[
            'title' => 'Inicio',
            'content' => view('backend/pages/show', $data)
        ]);
    }

    public function create(){
        $data['page'] = new Page();
        $data['edit'] = false;

        return view('layouts/backend',[
            'title' => 'Inicio',
            'content' => view('backend/pages/edit', $data)
        ]);
    }

    public function edit($pageId){
        $page = Page::find($pageId);
        $page->categories = $page->categories()->pluck('id');

        $data['page'] = $page;
        $data['edit'] = true;

        return view('layouts/backend',[
            'title' => 'Inicio',
            'content' => view('backend/pages/edit', $data)
        ]);
    }

    public function store(Request $request){
        $page = $this->save($request, new Page());

        $request->session()->flash('status', 'Ficha creada con éxito');

        return response()->json(['redirect' => 'backend/fichas/'.$page->id]);
    }

    public function update(Request $request, $pageId){
        $page = $this->save($request, Page::find($pageId));

        $request->session()->flash('status', 'Ficha editada con éxito');

        return response()->json(['redirect' => 'backend/fichas/'.$page->id]);
    }

    private function save(Request $request, Page $page){
        $this->validate($request, [
            'title' => 'required',
            'featured' => 'boolean',
            'institution_id' => 'required|exists:institutions,id',
            'categories' => 'array',
            'objective' => 'required',
        ]);

        $page->title = $request->input('title');
        $page->featured = $request->input('featured');
        $page->institution_id = $request->input('institution_id');
        $page->categories()->sync($request->input('categories'));
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
        $page->keywords = $request->input('keywords');
        $page->save();

        $version = $page->replicate();
        $version->id = null;
        $version->master = 0;
        $version->master_id = $page->id;
        $version->published = 0;
        $version->save();

        return $page;
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
