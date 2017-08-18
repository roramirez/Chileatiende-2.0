<?php

namespace App\Http\Controllers;


class HomeController extends Controller{

    public function getIndex(){
        return view('layout',[
            'title' => 'Inicio',
            'content' => view('home/index')
        ]);
    }

}
