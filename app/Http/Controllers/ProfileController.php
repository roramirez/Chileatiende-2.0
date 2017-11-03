<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

class ProfileController extends Controller{

    public function edit(Request $request) {
        $content = view('profile/edit',[
            'user' => $request->user()
        ]);

        return view('layouts/layout',[
            'title' => 'Perfil',
            'content' => $content
        ]);
    }

    public function update(Request $request){
        $this->validate($request,[
            'birth_date' => 'required|date',
            'gender' => 'required|in:m,f',
            'nationality' => 'required',
            'foreigner' => 'required|boolean',
            'rsh' => 'nullable|integer|min:0'
        ]);

        $user = $request->user();
        $user->birth_date = $request->input('birth_date');
        $user->gender = $request->input('gender');
        $user->nationality = $request->input('nationality');
        $user->foreigner = $request->input('foreigner');
        $user->rsh = $request->input('rsh');

        $user->save();

        return response()->json(['redirect' => '/']);
    }
}
