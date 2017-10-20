<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Support\Facades\Storage;

class TransparencyController extends Controller{

    public function __invoke() {
        $content = view('transparency/index');

        $transparencyData = json_decode(Storage::get('transparencia.json'));

        // dd($transparencyData);
        view()->share([
        	'list' => $transparencyData
        ]);

        return view('layouts/layout',[
            'title' => 'Enlaces para Transparencia activa',
            'content' => $content
        ]);
    }

}