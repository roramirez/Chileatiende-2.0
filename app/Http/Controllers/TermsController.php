<?php

namespace App\Http\Controllers;

use App\Page;

class TermsController extends Controller{

    public function __invoke() {
        $content = view('terms/index');

        return view('layouts/layout',[
            'title' => 'Términos y condiciones de uso',
            'content' => $content
        ]);
    }

}
