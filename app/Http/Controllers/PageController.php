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

        $data['page'] = Page::find($id)->getPublishedVersion();

        return view('layouts/layout',[
            'title' => $data['page']->title,
            'content' => view('pages/show', $data)
        ]);
    }

}
