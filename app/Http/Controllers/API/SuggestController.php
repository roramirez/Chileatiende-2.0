<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Suggestion;
use Illuminate\Http\Request;

class SuggestController extends Controller{

    public function getIndex(Request $request){
        $query = $request->input('query');

        return $query ? Suggestion::suggest($query) : [];
    }

}