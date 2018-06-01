<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Message;
use App\Page;
use Illuminate\Http\Request;

class MessagesController extends Controller {

    public function index($pageId) {
        return Page::with(['messages.user'])->find($pageId);
    }

    public function store(Request $request, $pageId) {
        $this->validate($request, [
            'text' => 'required'
        ]);

        $message = new Message;

        $message->page_id = $pageId;
        $message->text = $request->text;
        $message->user_id = $request->user()->id;

        if (!$message->save()) {
            response()->json(['message', 'Message store error'], 404);
        }

        return $message->fresh(['user', 'page']);
    }
}