<?php

namespace App\Http\Controllers;

use App\Institution;

class InstitutionController extends Controller{

    public function index(){

        $data['institutions'] = Institution::orderBy('name')
            ->get()
            ->groupBy(function($d){
                return $d->name[0];
            });

        return view('layouts/layout',[
            'title' => 'Instituciones Asociadas',
            'content' => view('institutions/index', $data)
        ]);
    }

}
