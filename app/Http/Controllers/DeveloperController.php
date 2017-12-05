<?php

namespace App\Http\Controllers;


class DeveloperController extends Controller {

    private $layout;

    const SECTIONS = [
        'index' => [
            'title' => 'API Chileatiende',
            'content' => 'developers/index'
        ],
        'fichas' => [
            'title' => 'Fichas',
            'content' => 'developers/files'
        ],
        'fichas_fichas_obtener' => [
            'title' => 'Fichas: Obtener',
            'content' => 'developers/getfiles'
        ],
        'fichas_fichas_listar' => [
            'title' => 'Fichas: Listar',
            'content' => 'developers/list'
        ],
        'fichas_fichas_listarporservicio' => [
            'title' => 'Fichas: listarPorServicio',
            'content' => 'developers/listbyservice'
        ],
        'servicios' => [
            'title' => 'Servicios',
            'content' => 'developers/services'
        ],
        'servicios_servicios_obtener' => [
            'title' => 'Servicios: Obtener',
            'content' => 'developers/getservices'
        ],
        'servicios_servicios_listar' => [
            'title' => 'Servicios: Listar',
            'content' => 'developers/listservices'
        ],
        'politica-de-uso' => [
            'title' => 'Políticas de Uso y Términos del Servicio',
            'content' => 'developers/terms'
        ]
    ];

    public function __construct() {
        $this->layout = 'layouts/api-layout';
    }

    public function __invoke($section = 'index', $subSection = null)
    {
        if ($subSection) {
            $section = $section . '_' . $subSection;
        }

        if(!isset(self::SECTIONS[$section])) {
            return abort('404');
        }

        return view($this->layout, [
            'title' => self::SECTIONS[$section]['title'],
            'content' => view(self::SECTIONS[$section]['content'], [])
        ]);
    }


}