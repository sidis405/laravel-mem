<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\CategoriesRepository;

class CategoriesController extends Controller
{
    protected $repo;

    public function __construct(CategoriesRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return $this->repo->all();
    }

    public function show(Category $category)
    {
        $posts = $this->repo->show($category);

        return view('categories.show', compact('posts', 'category'));
    }
}
