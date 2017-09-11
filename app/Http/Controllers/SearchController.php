<?php

namespace App\Http\Controllers;


use App\Page;
use App\Suggestion;
use Illuminate\Http\Request;

class SearchController extends Controller{

    public function getIndex(Request $request){

        $query = $request->input('query');

        $data['query'] = $query;
        $data['results'] = Page::search($query)->paginate(10);

        return view('layout',[
            'query' => $query,
            'title' => 'Resultados de búsqueda',
            'content' => view('search/index',$data)
        ]);
    }

}
