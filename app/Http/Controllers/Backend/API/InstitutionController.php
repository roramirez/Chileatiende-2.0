<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Institution;

class InstitutionController extends Controller{

    public function index(){

        return Institution::all();
    }



}
