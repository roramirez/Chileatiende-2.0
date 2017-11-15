<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

class ProfileController extends Controller{

    public function edit(Request $request) {
        $user = $request->user();
        $user->categories = $user->categories()->pluck('id');

        $content = view('profile/edit',[
            'user' => $user
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
            'categories' => 'array'
        ]);

        $user = $request->user();
        $user->birth_date = \Carbon\Carbon::parse($request->input('birth_date'));
        $user->gender = $request->input('gender');
        $user->nationality = $request->input('nationality');
        $user->foreigner = $request->input('foreigner');
        $user->save();

        $user->categories()->sync($request->input('categories'));


        return response()->json(['redirect' => '/']);
    }
}
