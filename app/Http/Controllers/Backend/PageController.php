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

    public function create(){
        $data['page'] = new Page();
        $data['edit'] = false;

        return view('layouts/backend',[
            'title' => 'Inicio',
            'content' => view('backend/pages/edit', $data)
        ]);
    }

    public function edit($pageId){
        $data['page'] = Page::find($pageId);
        $data['edit'] = true;

        return view('layouts/backend',[
            'title' => 'Inicio',
            'content' => view('backend/pages/edit', $data)
        ]);
    }

    public function store(Request $request){
        $this->save($request, new Page());
    }

    public function update(Request $request, $pageId){
        $this->save($request, Page::find($pageId));
    }

    private function save(Request $request, Page $page){
        $this->validate($request, [
            'title' => 'required|string',
            'institution_id' => 'required|exists:institutions,id',
            'objective' => 'required|string',
            'details' => 'string'
        ]);

        $page->title = $request->input('title');
        $page->institution_id = $request->input('institution_id');
        $page->objective = $request->input('objective');
        $page->details = $request->input('details');
        $page->save();

        $request->session()->flash('status', 'Ficha guardada con éxito');
    }
}
