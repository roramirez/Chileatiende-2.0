<?php

namespace App\Http\Controllers\API;

use App\ApiUser;
use App\Http\Controllers\Controller;
use App\XML;
use Illuminate\Http\Request;
use App\Institution;

class InstitutionController extends Controller{

    public function index(Request $request){
        $type = $request->get('type','json');
        $apiUser = ApiUser::where('token',$request->get('access_token'))->first();
        if(!$apiUser)
            abort(403);

        
        $results = Institution::has('pages')->get();

        $institutions = [];
        foreach($results as $r){
            $institutions[] = $r->toPublicArray();
        }

        $content = [
            'servicios' => [
                'titulo' => 'Listado de Servicios',
                'tipo' => 'chileatiende#serviciosFeed',
                'items' => ['servicio' => $institutions],
                'total' => $results->count()
            ]
        ];

        if($type == 'xml')
            return response(XML::xml_encode($content))->header('Content-Type','text/xml');
        else
            return response()->json($content)->withCallback($request->input('callback'));

    }


    public function show(Request $request, $id){
        $type = $request->get('type','json');
        $apiUser = ApiUser::where('token',$request->get('access_token'))->first();
        if(!$apiUser)
            abort(403);

        $institution = Institution::find($id);
        
        $institution = $institution->toPublicArray();

        $content = ['servicio' => $institution];

        if($type == 'xml')
            return response(XML::xml_encode($content))->header('Content-Type','text/xml');
        else
            return $content;
    }


}