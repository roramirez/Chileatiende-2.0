<?php

namespace App\Http\Controllers;


use App\Category;
use App\Institution;
use App\Page;
use App\Suggestion;
use Illuminate\Http\Request;

class SearchController extends Controller{

    public function getIndex(Request $request){

        $query = $request->input('query');

        $data['query'] = $query;
        $data['results'] = Page::search($query)->paginate(10);
        $data['categories'] = Category::orderBy('name')->get();
        $data['institutions'] = Institution::orderBy('name')->get();

        return view('layouts/layout',[
            'query' => $query,
            'title' => 'Resultados de búsqueda',
            'content' => view('search/index',$data)
        ]);
    }

}
