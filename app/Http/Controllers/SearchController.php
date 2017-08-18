<?php

namespace App\Http\Controllers;


use App\Page;
use App\Suggestion;
use Illuminate\Http\Request;

class SearchController extends Controller{

    public function getIndex(Request $request){

        $data['query'] = $request->input('query');
        $data['results'] = Page::search($data['query'])->get();

        return view('layout',[
            'title' => 'Resultados de búsqueda',
            'content' => view('search/index',$data)
        ]);
    }

}
