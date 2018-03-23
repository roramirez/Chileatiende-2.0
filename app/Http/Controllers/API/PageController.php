<?php

namespace App\Http\Controllers\API;

use App\ApiUser;
use App\Http\Controllers\Controller;
use App\XML;
use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller{

    public function index(Request $request){
        $type = $request->get('type','json');
        $apiUser = ApiUser::where('token',$request->get('access_token'))->first();
        if(!$apiUser)
            abort(403);

        $query = $request->input('query');
        $maxResults = $request->input('maxResults', 10);
        $pageToken = $request->input('pageToken', 1);

        if(!is_numeric($pageToken))
            $pageToken = 1;
        
        $results = Page::search($query)->where('published',true)->where('master',false)->where('master_published',true)->paginate($maxResults,'page',$pageToken);

        $pages = [];

        foreach($results as $r){
            $pages[] = $r->toPublicArray();
        }

        $content = [
            'fichas' => [
                'titulo' => 'Listado de Fichas',
                'tipo' => 'chileatiende#fichasFeed',
                'nextPageToken' => $results->hasMorePages() ? $pageToken + 1 : null,
                'items' => ['ficha' => $pages],
                'total' => $results->total()
            ]
        ];

        if($type == 'xml')
            return response(XML::xml_encode($content))->header('Content-Type','text/xml');
        else
            return response()->json($content)->withCallback($request->input('callback'));

    }

    public function indexByInstitution(Request $request, $institutionId){
        $type = $request->get('type','json');
        $apiUser = ApiUser::where('token',$request->get('access_token'))->first();
        if(!$apiUser)
            abort(403);
        
        $results = Page::where('master',0)->where('published',1)->whereHas('masterPage',function($q) use ($institutionId){
            return $q->where('published',1)->where('institution_id', $institutionId);
        })->get();

        $pages = [];

        foreach($results as $r){
            $pages[] = $r->toPublicArray();
        }

        $content = [
            'fichas' => [
                'titulo' => 'Listado de Fichas',
                'tipo' => 'chileatiende#fichasFeed',
                'items' => $pages
            ]
        ];

        if($type == 'xml')
            return response(XML::xml_encode($content))->header('Content-Type','text/xml');
        else
            return $content;

    }

    public function show(Request $request, $id){
        $type = $request->get('type','json');

        $apiUser = ApiUser::where('token',$request->get('access_token'))->first();
        if(!$apiUser)
            abort(403);

        $master = Page::find($id);
        
        if(!$master || !$master->published){
            abort(404);
        }
        
        $page = $master->publishedVersion()->toPublicArray();

        $content = ['ficha' => $page];

        if($type == 'xml')
            return response(XML::xml_encode($content))->header('Content-Type','text/xml');
        else
            return $content;
    }

}