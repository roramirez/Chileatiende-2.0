<?php

namespace App\Http\Controllers;

use App\Page;

class PageController extends Controller{

    public function show($guid){
        $id = explode('-',$guid)[0];
        $master = Page::masters()->where('id',$id)->first();
        if(!$master || !$master->published){
            abort(404);
        }

        $master->addHit();

        $page = Page::find($id)->publishedVersion();
        $page->load('relatedPages');
        $page->load('similarPages');
        $data['page'] = $page;

        return view('layouts/layout',[
            'title' => $data['page']->title,
            'description' => str_limit(strip_tags($data['page']->objective),300),
            'keywords' => $data['page']->keywords,
            'author' => $data['page']->institution->name,
            'content' => view('pages/show', $data)
        ]);
    }

    public function featured(){
        $data['pages'] = Page::masters()->published()->where('featured',1)->orderBy('order')->get();

        return view('layouts/layout',[
            'title' => 'Fichas Destacadas',
            'content' => view('pages/featured', $data)
        ]);
    }

}
