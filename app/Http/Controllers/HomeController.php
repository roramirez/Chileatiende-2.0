<?php

namespace App\Http\Controllers;


use App\Category;
use App\Page;
use App\Suggestion;
use Illuminate\Http\Request;

class HomeController extends Controller{

    public function getIndex(Request $request){

        $skin = $request->input('skin');

        if($request->user() && $request->user()->hasCustomizationData()){
            $content = view('home/index-authenticated',[
                'featured' => Page::masters()->published()->where('featured',1)->limit(4)->get(),
                'categories' => $request->user()->categories()->orderBy('order')->get()
            ]);
        }else{
            $content = view('home/index',[
                'featured' => Page::masters()->published()->where('featured',1)->limit(4)->get(),
                'categories' => Category::where('featured',1)->orderBy('order')->limit(9)->get()
            ]);
        }


        return view('layouts/home-layout',[
            'suggestions' => Suggestion::orderBy('count', 'desc')->limit(5)->get(),
            'title' => 'Inicio',
            'content' => $content,
            'skin' => $skin
        ]);
    }

}
