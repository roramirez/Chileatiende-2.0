<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller{

    public function index(Request $request){


        $data['institutions'] = Institution::with('ministry')->get();

        return view('layouts/backend',[
            'title' => 'Instituciones',
            'content' => view('backend/institutions/index', $data)
        ]);
    }

    public function create(){
        $institution = new Institution();

        $data['institution'] = $institution;
        $data['edit'] = false;

        return view('layouts/backend',[
            'title' => 'Agregar Institución',
            'iconTitle' => 'note_add',
            'content' => view('backend/institutions/edit', $data)
        ]);
    }

    public function edit($id){
        $institution = Institution::find($id);

        $data['institution'] = $institution;
        $data['edit'] = true;

        return view('layouts/backend',[
            'title' => 'Editar Institución',
            'iconTitle' => 'edit',
            'content' => view('backend/institutions/edit', $data)
        ]);
    }

    public function store(Request $request){
        $institution = $this->save($request, new Institution());

        $request->session()->flash('status', 'Institución creada con éxito');

        return response()->json(['redirect' => 'backend/instituciones']);
    }

    public function update(Request $request, $id){
        $this->save($request, Institution::find($id));

        $request->session()->flash('status', 'Institucion editada con éxito');

        return response()->json(['redirect' => 'backend/instituciones']);
    }

    private function save(Request $request, Institution $institution){
        $this->validate($request, [
            'name' => 'required',
            'shortname' => 'required',
            'url' => 'required|url',
            'description' => 'required',
            'ministry_id' => 'required|exists:ministries,id'
        ]);

        $institution->name = $request->input('name');
        $institution->shortname = $request->input('shortname');
        $institution->url = $request->input('url');
        $institution->description = $request->input('description');
        $institution->ministry_id = $request->input('ministry_id');
        $institution->save();


        return $institution;
    }

    public function destroy(Request $request, $id){
        $institution = Institution::find($id);
        $institution->delete();

        $request->session()->flash('status', 'Institución eliminada con éxito');

        return redirect('backend/instituciones');
    }


}
