<?php

namespace App\Http\Controllers;

use App\Institution;

class InstitutionController extends Controller{

    public function index(){

        $data['institutions'] = Institution::has('pages')->orderBy('name')
            ->get()
            ->groupBy(function($d){
                return $d->name[0];
            });

        return view('layouts/layout',[
            'title' => 'Instituciones Asociadas',
            'content' => view('institutions/index', $data)
        ]);
    }

    public function show($id){

        $data['institution'] = Institution::find($id);

        return view('layouts/layout',[
            'title' => $data['institution']->name,
            'content' => view('institutions/show', $data)
        ]);
    }

}
