<?php

namespace App\Http\Controllers;


use App\Category;
use App\Page;
use App\Suggestion;

class HomeController extends Controller{

    public function getIndex(){

        $content = view('home/index',[
            'featured' => Page::masters()->where('featured',1)->limit(4)->get(),
            'categories' => Category::where('featured',1)->limit(9)->get()
        ]);

        return view('layouts/home-layout',[
            'suggestions' => Suggestion::orderBy('count', 'desc')->limit(5)->get(),
            'title' => 'Inicio',
            'content' => $content
        ]);
    }

}
