<?php

namespace App\Http\Controllers;
use App\Tag;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $data = [
            'tags' => Tag::all()
        ];

        return view('guests.tags.index', $data);
    }
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->first();

        if (!$tag) {
            abort(404);
        }
        return view('guests.tags.show', compact('tag'));
    }
}
