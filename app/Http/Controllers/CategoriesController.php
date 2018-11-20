<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        return Category::whereHas('posts')->withCount('posts')->get()->sortByDesc('posts_count');
    }

    public function show(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->with('user', 'category', 'tags')->latest()->paginate(15);

        return view('categories.show', compact('posts', 'category'));
    }
}
