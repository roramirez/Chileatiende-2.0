<?php

namespace App\Http\Controllers;


use App\Category;
use App\Institution;
use App\Page;
use App\Search;
use App\Suggestion;
use Illuminate\Http\Request;

class SearchController extends Controller{

    public function getIndex(Request $request){

        $query = $request->input('query');
        $institutionId = $request->input('institution');
        $categoryId = $request->input('category');

        $results = Page::search($query)->where('published',true)->where('master',false)->where('master_published',true);
        if($institutionId)
            $results->where('institution_id',[$institutionId]);
        if($categoryId)
            $results->where('category_id',[$categoryId]);

        $results = $results->paginate(10);

        if($query && $results->total() > 0){
            $search = new Search();
            $search->query = $query;
            $search->save();
        }

        $data['query'] = $query;
        $data['institution'] = Institution::find($institutionId);
        $data['category'] = Category::find($categoryId);
        $data['results'] = $results;
        $data['categories'] = Category::orderBy('name')->get();
        $data['institutions'] = Institution::has('pages')->orderBy('name')->get();

        return view('layouts/layout',[
            'query' => $query,
            'title' => 'Resultados de búsqueda',
            'content' => view('search/index',$data)
        ]);
    }

}
