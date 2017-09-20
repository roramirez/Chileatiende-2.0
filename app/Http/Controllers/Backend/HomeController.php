<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class HomeController extends Controller{

    public function getIndex(){

        return view('layouts/backend',[
            'title' => 'Inicio',
            'content' => view('backend/home')
        ]);
    }

}
