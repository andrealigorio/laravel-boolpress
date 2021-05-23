<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;
use illuminate\Support\Str;


class TagController extends Controller
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
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('admin.tags.create', compact('tags'));
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

        $new_tag = new Tag();

        $new_tag->fill($data);

        $new_tag->slug = Str::slug($new_tag->name, '-');

        $new_tag->save();

        return redirect()->route('admin.tags.index')->with('status_create', 'Aggiunto nuovo tag');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        if (!$tag) {
            abort(404);
        }

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->all();

        $this->valida($request);

        $tag->slug = Str::slug($data['name'], '-');

        $tag->update($data);

        return redirect()->route('admin.tags.index')->with('status_update', 'Tag modificato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('status_delete', 'Tag eliminato');
    }
}
