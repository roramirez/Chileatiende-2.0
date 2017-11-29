<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller{

    public function index(Request $request){


        $data['categories'] = Category::orderBy('featured', 'desc')->orderBy('order')->get();

        return view('layouts/backend',[
            'title' => 'Categorías',
            'iconTitle' => 'visibility',
            'content' => view('backend/categories/index', $data)
        ]);
    }

    public function create(){
        $category = new Category();

        $data['category'] = $category;
        $data['edit'] = false;

        return view('layouts/backend',[
            'title' => 'Crear Categoría',
            'iconTitle' => 'note_add',
            'content' => view('backend/categories/edit', $data)
        ]);
    }

    public function edit($id){
        $category = Category::find($id);

        $data['category'] = $category;
        $data['edit'] = true;

        return view('layouts/backend',[
            'title' => 'Editar Categoría',
            'iconTitle' => 'edit',
            'content' => view('backend/categories/edit', $data)
        ]);
    }

    public function store(Request $request){
        $category = $this->save($request, new Category());

        $request->session()->flash('status', 'Categoría creada con éxito');

        return response()->json(['redirect' => 'backend/categorias']);
    }

    public function update(Request $request, $id){
        $this->save($request, Category::find($id));

        $request->session()->flash('status', 'Categoría editada con éxito');

        return response()->json(['redirect' => 'backend/categorias']);
    }

    private function save(Request $request, Category $category){
        $this->validate($request, [
            'name' => 'required',
            'featured' => 'required|boolean',
            'order' => 'required|numeric'
        ]);

        $category->name = $request->input('name');
        $category->featured = $request->input('featured');
        $category->order = $request->input('order');

        $category->save();


        return $category;
    }

    public function destroy(Request $request, $id){
        $category = Category::find($id);
        $category->delete();

        $request->session()->flash('status', 'Categoría eliminada con éxito');

        return redirect('backend/categorias');
    }


}
