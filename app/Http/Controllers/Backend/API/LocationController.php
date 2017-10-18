<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller{

    public function index(Request $request){
        $type = $request->input('type');

        if($type){
            return Location::where('type',$type)->get();
        }

        return Location::all();
    }



}
