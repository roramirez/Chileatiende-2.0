<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Page;

class PageController extends Controller{

    public function index(){

        return Page::masters()->select('id','title')->get();
    }



}
