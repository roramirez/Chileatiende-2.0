<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Ministry;
use Illuminate\Http\Request;

class MinistryController extends Controller{

    public function index(Request $request){


        $data['ministries'] = Ministry::all();

        return view('layouts/backend',[
            'title' => 'Ministerios',
            'content' => view('backend/ministries/index', $data)
        ]);
    }

    public function create(){
        $ministry = new Ministry();

        $data['ministry'] = $ministry;
        $data['edit'] = false;

        return view('layouts/backend',[
            'title' => 'Agregar ministerio',
            'iconTitle' => 'note_add',
            'content' => view('backend/ministries/edit', $data)
        ]);
    }

    public function edit($id){
        $ministry = Ministry::find($id);

        $data['ministry'] = $ministry;
        $data['edit'] = true;

        return view('layouts/backend',[
            'title' => 'Editar Ministerio',
            'iconTitle' => 'edit',
            'content' => view('backend/ministries/edit', $data)
        ]);
    }

    public function store(Request $request){
        $ministry = $this->save($request, new Ministry());

        $request->session()->flash('status', 'Institucion creada con éxito');

        return response()->json(['redirect' => 'backend/ministerios']);
    }

    public function update(Request $request, $id){
        $this->save($request, Ministry::find($id));

        $request->session()->flash('status', 'Institucion editada con éxito');

        return response()->json(['redirect' => 'backend/ministerios']);
    }

    private function save(Request $request, Ministry $ministry){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $ministry->name = $request->input('name');
        $ministry->shortname = $request->input('shortname');
        $ministry->description = $request->input('description');
        $ministry->save();


        return $ministry;
    }

    public function destroy(Request $request, $id){
        $ministry = Ministry::find($id);
        $ministry->delete();

        $request->session()->flash('status', 'Institucion eliminada con éxito');

        return redirect('backend/ministerios');
    }


}
