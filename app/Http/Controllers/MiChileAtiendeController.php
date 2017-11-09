<?php

namespace App\Http\Controllers;

use App\Page;

class MiChileAtiendeController extends Controller{

    public function getIndex() {
        $content = view('mi-chileatiende/index');

        return view('layouts/layout',[
            'search' => false,
            'title' => 'Mi ChileAtiende',
            'content' => $content
        ]);
    }

}
