<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller{


    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        $path = $request->file('file')->store('public/images');

        return preg_replace('/^public/','storage',$path);
    }


}
