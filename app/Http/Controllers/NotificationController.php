<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

class NotificationController extends Controller{

    public function index(Request $request){
        $read = $request->get('read');

        $query = $request->user()->notifications();
        if($read != null){
            $query->where('read',$read);
        }
        $notifications = $query->paginate(10);

        $unreadCount = $request->user()->notifications()->where('read',0)->count();

        return view('layouts/layout',[
            'title' => 'Notificaciones',
            'content' => view('notifications/index',[
                'notifications' => $notifications,
                'unreadCount' => $unreadCount,
                'read' => $read
            ])
        ]);
    }

}
