<?php

namespace App\Http\Controllers;
use App\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => Category::all()
        ];

        return view('guests.categories.index', $data);
    }
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            abort(404);
        }
        return view('guests.categories.show', compact('category'));
    }
}
