<?php

namespace App\Http\Controllers;


use App\Suggestion;

class HomeController extends Controller{

    public function getIndex(){
        return view('home-layout',[
            'suggestions' => Suggestion::orderBy('count', 'desc')->limit(5)->get(),
            'title' => 'Inicio',
            'content' => view('home/index')
        ]);
    }

}
