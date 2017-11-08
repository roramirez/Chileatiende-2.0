<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller{

    public function index(Request $request){

        $query = $request->input('query');
        if($query)
            return Page::search($query)->where('master',true)->get();


        return [];
    }

    public function show($id){
        return Page::find($id);
    }



}
