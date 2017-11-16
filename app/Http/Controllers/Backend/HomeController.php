<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller{

    public function getIndex(Request $request){

        if($request->user()->role == 'operator')
            return redirect('backend/oficinas');

        return redirect('backend/fichas');

        //return view('layouts/backend',[
        //    'title' => 'Inicio',
        //    'content' => view('backend/home')
        //]);
    }

}
