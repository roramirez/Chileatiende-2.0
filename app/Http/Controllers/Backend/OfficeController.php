<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller{

    public function index(Request $request){


        $data['offices'] = Office::with('location')->get();

        return view('layouts/backend',[
            'title' => 'Oficinas',
            'content' => view('backend/offices/index', $data)
        ]);
    }

    public function create(){
        $data['office'] = new Office();
        $data['edit'] = false;

        return view('layouts/backend',[
            'title' => 'Crear Oficina',
            'content' => view('backend/offices/edit', $data)
        ]);
    }

    public function edit($id){
        $office = Office::find($id);

        $data['office'] = $office;
        $data['edit'] = true;

        return view('layouts/backend',[
            'title' => 'Editar Oficina',
            'content' => view('backend/offices/edit', $data)
        ]);
    }

    public function store(Request $request){
        $office = $this->save($request, new Office());

        $request->session()->flash('status', 'Oficina creada con éxito');

        return response()->json(['redirect' => 'backend/oficinas']);
    }

    public function update(Request $request, $id){
        $this->save($request, Office::find($id));

        $request->session()->flash('status', 'Oficina editada con éxito');

        return response()->json(['redirect' => 'backend/oficinas']);
    }

    private function save(Request $request, Office $office){
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
        ]);

        $office->name = $request->input('name');
        $office->address = $request->input('address');
        $office->save();


        return $office;
    }


}
