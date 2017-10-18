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
            'schedules' => 'required',
            'phones' => 'required',
            'fax' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'institution_id' => 'required',
            'location_id' => 'required',
        ]);

        $office->name = $request->input('name');
        $office->address = $request->input('address');
        $office->schedules = $request->input('schedules');
        $office->phones = $request->input('phones');
        $office->fax = $request->input('fax');
        $office->director = $request->input('director');
        $office->lat = $request->input('lat');
        $office->lng = $request->input('lng');
        $office->institution_id = $request->input('institution_id');
        $office->location_id = $request->input('location_id');
        $office->save();


        return $office;
    }

    public function destroy(Request $request, $id){
        $office = Office::find($id);
        $office->delete();

        $request->session()->flash('status', 'Oficina eliminada con éxito');

        return redirect('backend/oficinas');
    }


}
