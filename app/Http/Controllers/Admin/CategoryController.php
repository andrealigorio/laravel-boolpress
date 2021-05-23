<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use illuminate\Support\Str;

class CategoryController extends Controller
{
    public function valida(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->valida($request);

        $new_category = new Category();

        $new_category->fill($data);

        $new_category->slug = Str::slug($new_category->name, '-');

        $new_category->save();

        return redirect()->route('admin.categories.index')->with('status_create', 'Aggiunta nuova categoria');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if(!$category) {
            abort(404);
        }

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();

        $this->valida($request);

        $category->slug = Str::slug($data['name'], '-');

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('status_update', 'Categoria modificata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status_delete', 'Categoria eliminata');
    }
}
