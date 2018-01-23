<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;

class ContentController extends Controller
{
    public $content;

    public function __construct(Request $request)
    {
        $url = preg_replace('/\//siU', '', $request->getRequestUri(), 1);
        $this->content = Content::published()->whereUrl($url)->first();
    }

    public function __invoke()
    {

        if (is_null($this->content)) {
            return view('layouts/layout', [
                'title' => '404',
                'content' => view("errors/404")
            ]);
        }

        $data['title'] = $this->content->title;
        $data['updated_at'] = $this->content->updated_for_human;
        $data['content'] = $this->content->content;

        $view = "content/{$this->content->template}";

        return view('layouts/layout', [
            'title' => $this->content->title,
            'content' => view($view, $data)
        ]);
    }

}