<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Institution;

class InstitutionController extends Controller{

    public function index(Request $request){

        
        $results = Institution::all();

        $institutions = [];
        foreach($results as $r){
            $institutions[] = $r->toPublicArray();
        }

        return [
            'servicios' => [
                'titulo' => 'Listado de Servicios',
                'tipo' => 'chileatiende#serviciosFeed',
                'items' => $institutions
            ]
        ];

    }


    public function show(Request $requst, $id){
        $institution = Institution::find($id);
        
        $institution = $institution->toPublicArray();

        return ['servicio' => $institution];
    }


}