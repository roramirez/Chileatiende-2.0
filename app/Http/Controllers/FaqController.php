<?php

namespace App\Http\Controllers;

use App\Office;
use App\Page;

class FaqController extends Controller{

	const TITLES = [
		'preguntas-frecuentes' => 'Preguntas Frecuentes',
		'atencion-telefonica' => 'Atención Telefónica',
		'oficinas-moviles' => 'Oficinas Móviles'
	];

    public function __invoke($page = 'preguntas-frecuentes')
    {	
    	if (!array_key_exists($page, self::TITLES)) {
    		return view('layouts/layout',[
	            'content' =>  view('errors/404'),
	            'title' => '404'
	        ]);
    	}

        $content = view('faq/' . $page);

        view()->share([
        	'title' => self::TITLES[$page]
        ]);
    	
    	return view('layouts/layout',[
            'content' => $content
        ]);
    }

    public function getMobileOffices(){
        return view('layouts/layout',[
            'title' => 'Sucursales',
            'content' => view('faq/mobile-offices',[
                'offices' => Office::with('location','location.parent','location.parent.parent')->where('mobile',1)->get()
            ])
        ]);
    }

    public function getOffices(){
        return view('layouts/layout',[
            'title' => 'Sucursales',
            'content' => view('faq/offices',[
                'offices' => Office::with('location','location.parent','location.parent.parent')->where('mobile',0)->get()
            ])
        ]);
    }

}
