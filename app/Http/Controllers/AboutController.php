<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class AboutController extends Controller{

    public function __invoke(Request $request) {
        $skin = $request->get('skin');

        $content = $skin == 'exterior' ? view('about/exterior') : view('about/index');

        return view('layouts/layout',[
            'title' => 'Qué es Chileatiende',
            'content' => $content
        ]);
    }

}
