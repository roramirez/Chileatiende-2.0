<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function index(Request $request){


        $data['users'] = User::all();

        return view('layouts/backend',[
            'title' => 'Usuarios',
            'content' => view('backend/users/index', $data)
        ]);
    }

    public function create(){
        $user = new User();

        $data['user'] = $user;
        $data['edit'] = false;

        return view('layouts/backend',[
            'title' => 'Crear Categoria',
            'content' => view('backend/users/edit', $data)
        ]);
    }

    public function edit($id){
        $user = User::find($id);

        $data['user'] = $user;
        $data['edit'] = true;

        return view('layouts/backend',[
            'title' => 'Editar Categoria',
            'content' => view('backend/users/edit', $data)
        ]);
    }

    public function store(Request $request){
        $user = $this->save($request, new User());

        $request->session()->flash('status', 'Usuario creado con éxito');

        return response()->json(['redirect' => 'backend/usuarios']);
    }

    public function update(Request $request, $id){
        $this->save($request, User::find($id));

        $request->session()->flash('status', 'Usuario editado con éxito');

        return response()->json(['redirect' => 'backend/usuarios']);
    }

    private function save(Request $request, User $user){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'institution_id' => 'exists:institutions,id',
            'password' => 'confirmed'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->institution_id = $request->input('institution_id');

        if($password = $request->input('password'))
            $user->password = bcrypt($password);

        $user->save();


        return $user;
    }

    public function destroy(Request $request, $id){
        $user = User::find($id);
        $user->delete();

        $request->session()->flash('status', 'Usuario eliminado con éxito');

        return redirect('backend/usuarios');
    }


}
