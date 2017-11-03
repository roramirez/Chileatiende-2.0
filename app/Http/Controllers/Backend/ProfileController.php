<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller{



    public function edit(Request $request){
        $user = $request->user();

        $data['user'] = $user;
        $data['edit'] = true;

        return view('layouts/backend',[
            'title' => 'Editar Perfil',
            'content' => view('backend/profile/index', $data)
        ]);
    }



    public function update(Request $request){
        $this->save($request, $request->user());

        $request->session()->flash('status', 'Usuario editado con éxito');

        return response()->json(['redirect' => 'backend/perfil']);
    }

    private function save(Request $request, User $user){
        $this->validate($request, [
            'first_name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed'
        ]);

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        if($password = $request->input('password'))
            $user->password = bcrypt($password);

        $user->save();


        return $user;
    }



}
