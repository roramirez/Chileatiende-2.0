<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Institution;
use App\Mail\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller{

    public function create(Request $request){
        if(!$request->user()->can('create', \App\Notification::class))
            abort(403);

        return view('layouts/backend',[
            'title' => 'Enviar Notificación',
            'iconTitle' => 'note_add',
            'content' => view('backend/notifications/edit')
        ]);
    }

    public function store(Request $request){
        if(!$request->user()->can('create', \App\Notification::class))
            abort(403);

        $this->validate($request, [
            'institution_id' => 'required|exists:institutions,id',
            'title' => 'required',
            'message' => 'required'
        ]);

        $users = User::where('email','!=','')->get();
        $institution = Institution::find($request->get('institution_id'));
        $title = $request->get('title');
        $message = $request->get('message');

        foreach($users as $u){
            Mail::to($u->email)->send(new Notification($institution, $title, $message));
        }


        $request->session()->flash('status', 'Notificación enviada con éxito.');

        return response()->json(['redirect' => 'backend']);
    }


}
