<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Ministry;
use Illuminate\Http\Request;

class MinistryController extends Controller{

    public function index(Request $request){
        if(!$request->user()->can('view', Ministry::class))
            abort(403);

        $data['ministries'] = Ministry::all();

        return view('layouts/backend',[
            'title' => 'Ministerios',
            'content' => view('backend/ministries/index', $data)
        ]);
    }

    public function create(Request $request){
        if(!$request->user()->can('create', Ministry::class))
            abort(403);

        $ministry = new Ministry();

        $data['ministry'] = $ministry;
        $data['edit'] = false;

        return view('layouts/backend',[
            'title' => 'Agregar ministerio',
            'iconTitle' => 'note_add',
            'content' => view('backend/ministries/edit', $data)
        ]);
    }

    public function edit(Request $request, $id){
        $ministry = Ministry::find($id);

        if(!$request->user()->can('update', $ministry))
            abort(403);

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
            'id' => 'required',
            'name' => 'required',
        ]);

        $ministry->id = $request->input('id');
        $ministry->name = $request->input('name');
        $ministry->shortname = $request->input('shortname');
        $ministry->description = $request->input('description');
        $ministry->save();


        return $ministry;
    }

    public function destroy(Request $request, $id){
        $ministry = Ministry::find($id);

        if(!$request->user()->can('delete', $ministry))
            abort(403);

        $ministry->delete();

        $request->session()->flash('status', 'Institucion eliminada con éxito');

        return redirect('backend/ministerios');
    }


}
