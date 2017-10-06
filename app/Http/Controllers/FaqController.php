<?php

namespace App\Http\Controllers;

use App\Page;

class FaqController extends Controller{

	const TITLES = [
		'preguntas-frecuentes' => 'Preguntas Frecuentes',
		'sucursales' => 'Sucursales',
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

        $content = view('pages/' . $page);

        view()->share([
        	'title' => self::TITLES[$page]
        ]);
    	
    	return view('layouts/layout',[
            'content' => $content
        ]);
    }

}
