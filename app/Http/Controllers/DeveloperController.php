<?php

namespace App\Http\Controllers;


use App\ApiUser;
use App\Mail\ApiUserCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function createAccessToken(){
        return view($this->layout, [
            'title' => 'Crear API Key',
            'content' => view('developers/create-access-token')
        ]);
    }

    public function storeAccessToken(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:api_users,email',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $apiUser = new ApiUser();
        $apiUser->email = $request->get('email');
        $apiUser->first_name = $request->get('first_name');
        $apiUser->last_name = $request->get('last_name');
        $apiUser->company = $request->get('company');
        $apiUser->token = str_random(16);
        $apiUser->save();

        Mail::to($apiUser->email)->send(new ApiUserCreated($apiUser));

        $request->session()->flash('status', 'API Key creada con éxito');

        return response()->json(['redirect' => 'desarrolladores']);
    }

}