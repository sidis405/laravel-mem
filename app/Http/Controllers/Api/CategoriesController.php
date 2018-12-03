<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return $this->repo->show($category);
    }
}
