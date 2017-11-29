<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function index(Request $request){
        if(!$request->user()->can('view', User::class))
            abort(403);

        $data['users'] = User::backend()->get();

        return view('layouts/backend',[
            'title' => 'Usuarios',
            'iconTitle' => 'person',
            'content' => view('backend/users/index', $data)
        ]);
    }

    public function create(Request $request){
        if(!$request->user()->can('create', User::class))
            abort(403);

        $user = new User();

        $data['user'] = $user;
        $data['edit'] = false;

        return view('layouts/backend',[
            'title' => 'Crear Categoria',
            'iconTitle' => 'note_add',
            'content' => view('backend/users/edit', $data)
        ]);
    }

    public function edit(Request $request, $id){
        $user = User::find($id);

        if(!$request->user()->can('update', $user))
            abort(403);

        $data['user'] = $user;
        $data['edit'] = true;

        return view('layouts/backend',[
            'title' => 'Editar Categoria',
            'iconTitle' => 'edit',
            'content' => view('backend/users/edit', $data)
        ]);
    }

    public function store(Request $request){
        if(!$request->user()->can('create', User::class))
            abort(403);

        $user = $this->save($request, new User());

        $request->session()->flash('status', 'Usuario creado con éxito');

        return response()->json(['redirect' => 'backend/usuarios']);
    }

    public function update(Request $request, $id){
        $user = User::find($id);

        if(!$request->user()->can('update', $user))
            abort(403);

        $this->save($request, $user);

        $request->session()->flash('status', 'Usuario editado con éxito');

        return response()->json(['redirect' => 'backend/usuarios']);
    }

    private function save(Request $request, User $user){
        $this->validate($request, [
            'first_name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'institution_id' => 'exists:institutions,id',
            'ministerial' => 'boolean',
            'interministerial' => 'boolean',
            'password' => 'confirmed'
        ]);

        $user->backend = true;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->institution_id = $request->input('institution_id');
        $user->ministerial = $request->input('ministerial');
        $user->interministerial = $request->input('interministerial');

        if($password = $request->input('password'))
            $user->password = bcrypt($password);

        $user->save();


        return $user;
    }

    public function destroy(Request $request, $id){
        $user = User::find($id);

        if(!$request->user()->can('delete', $user))
            abort(403);

        $user->delete();

        $request->session()->flash('status', 'Usuario eliminado con éxito');

        return redirect('backend/usuarios');
    }


}
