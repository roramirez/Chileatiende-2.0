<?php

namespace App\Http\Controllers;

use App\Page;

class AboutController extends Controller{

    public function __invoke() {
        $content = view('about/index');

        return view('layouts/layout',[
            'title' => 'Qué es Chileatiende',
            'content' => $content
        ]);
    }

}
