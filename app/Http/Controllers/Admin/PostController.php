<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use illuminate\Support\Str;
use illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function valida(Request $request) {
        $request->validate([
            'title' => 'required|max:200',
            'content' => 'required'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
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

        $new_post = new Post();

        $new_post->fill($data);

        $slug = Str::slug($new_post->title, '-');
        $slug_appoggio = $slug;

        $post_attuale = Post::where('slug', $slug)->first();
        $cont = 1;

        if ($post_attuale) {
            $slug = $slug_appoggio . '-' . $cont;
            $cont++;
            $post_attuale = Post::where('slug', $slug)->first();
        }

        $new_post->slug = $slug;

        $new_post->user_id = Auth::id();

        $new_post->save();

        if(array_key_exists('tags', $data)) {
            $new_post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!$post) {
            abort(404);
        }

        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        $this->valida($request);

        if($data['title'] != $post->title) {
            $slug = Str::slug($post->title, '-');
            $slug_appoggio = $slug;
    
            $post_attuale = Post::where('slug', $slug)->first();
            $cont = 1;
    
            if ($post_attuale) {
                $slug = $slug_appoggio . '-' . $cont;
                $cont++;
                $post_attuale = Post::where('slug', $slug)->first();
            }
            $data['slug'] = $slug;
        }

        $post->update($data);

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
