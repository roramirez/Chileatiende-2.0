<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Rules\existsTemplateContent;
use Illuminate\Http\Request;
use App\Content;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->user()->can('view', Content::class))
            abort(403);

        $data['templates'] = $this->getTemplates();
        $data['content'] = Content::whereState(1)->get();

        return view('layouts/backend', [
            'title' => 'Contenido',
            'iconTitle' => 'pageview',
            'content' => view('backend/content/index', $data)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->user()->can('create', Content::class))
            abort(403);

        $content = new Content();

        $data['templates'] = $this->getTemplates();
        $data['content'] = $content;
        $data['edit'] = false;

        return view('layouts/backend', [
            'title' => 'Crear Contenido',
            'iconTitle' => 'note_add',
            'content' => view('backend/content/edit', $data)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->user()->can('create', Content::class))
            abort(403);

        $this->save($request, new Content());

        $request->session()->flash('status', 'Contenido creado con éxito');

        return response()->json(['redirect' => 'backend/contenidos']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $url = str_replace('/', '', $request->getRequestUri());

        $content = Content::whereUrl($url)->first();

//        if (strstr($content->content, '@view(')) {
//            $content->content = preg_replace('/\@view\((.*)\)/siU', view('${2}'), $content->content);
//        }

        preg_match_all(
            '/\@view\(\'(.*)\'\)/siU',
            $content->content,
            $matches,
            PREG_PATTERN_ORDER
        );

        foreach ($matches[1] as $match) {
            $content->content = str_replace("@view({$match})", '', $content->content);
            $match = str_replace('/', '.', $match);
            $content->content .= view($match)->render();
        }

        $data['content'] = $content->content;


        return view('layouts/layout', [
            'title' => $content->title,
            'content' => view('content/index', $data)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $content = Content::find($id);

        if (!$request->user()->can('update', $content))
            abort(403);

        $data['templates'] = $this->getTemplates();
        $data['content'] = $content;
        $data['edit'] = true;

        return view('layouts/backend', [
            'title' => 'Editar Contenido',
            'iconTitle' => 'edit',
            'content' => view('backend/content/edit', $data)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $content = Content::find($id);

        if (!$request->user()->can('update', $content))
            abort(403);

        $this->save($request, $content);

        $request->session()->flash('status', 'Contenido editada con éxito');

        return response()->json(['redirect' => 'backend/contenidos']);
    }

    /**
     * @param Request $request
     * @param Content $content
     * @return Content
     */
    private function save(Request $request, Content $content)
    {
        $this->validate($request, [
            'title' => 'required|max:512',
            'url' => 'required|max:512',
            'content' => 'required',
            'template' => ['required', new existsTemplateContent()],
        ]);

        $content->title = $request->input('title');
        $content->content = $request->input('content');
        $content->template = $request->input('template');
        $content->url = $request->input('url');
        $content->published = $request->input('published');
        $content->save();

        return $content;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $content = Content::find($id);

        if (!$request->user()->can('delete', $content))
            abort(403);

        $content->state = 0;
        $content->save();

        $request->session()->flash('status', 'Contenido eliminado con éxito');

        return redirect('backend/contenidos');
    }

    public function getTemplates()
    {
        $list = Storage::disk('views')->files('content');
        $list = collect($list)->map(function ($value, $key) {
            return str_replace(['content/', '.php'], '', $value);
        });

        return $list;
    }
}
