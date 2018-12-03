<?php

namespace App\Repositories;

use App\Post;
use App\Category;

class CategoriesRepository
{
    public function show(Category $category)
    {
        return Post::where('category_id', $category->id)->with('user', 'category', 'tags')->latest()->paginate(15);
    }

    public function all()
    {
        Category::whereHas('posts')->withCount('posts')->get()->sortByDesc('posts_count');
    }
}
