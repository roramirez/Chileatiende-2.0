<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Ministry;

class MinistryController extends Controller{

    public function index(){

        return Ministry::select('id','name','shortname','description')->get();
    }



}
