<?php

namespace App\Http\Controllers\Backend\API;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller{

    public function index(){

        return Category::all();
    }



}
