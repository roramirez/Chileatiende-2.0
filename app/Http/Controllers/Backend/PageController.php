<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller{

    public function index(){

        $data['pages'] = Page::paginate(30);

        return view('layouts/backend',[
            'title' => 'Inicio',
            'content' => view('backend/pages/index', $data)
        ]);
    }

    public function edit($pageId){

        $data['page'] = Page::find($pageId);

        return view('layouts/backend',[
            'title' => 'Inicio',
            'content' => view('backend/pages/edit', $data)
        ]);
    }

    public function update(Request $request, $pageId){
        $this->validate($request, [
            'title' => 'required|string',
            'institution_id' => 'required|exists:institutions,id',
            'objective' => 'required|string'
        ]);

        $page = Page::find($pageId);
        $page->title = $request->input('title');
        $page->institution_id = $request->input('institution_id');
        $page->objective = $request->input('objective');
        $page->save();

        $request->session()->flash('status', 'Ficha guardada con éxito');
    }

}
