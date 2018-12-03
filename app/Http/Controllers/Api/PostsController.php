<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Repositories\PostsRepository;

class PostsController extends Controller
{
    protected $repo;

    public function __construct(PostsRepository $repo)
    {
        $this->middleware('jtw.auth')->except('index', 'show');
        $this->middleware('can:update,post')->only('edit', 'update');
        $this->middleware('can:delete,post')->only('destroy');
        $this->repo = $repo;
    }

    public function index()
    {
        return $this->repo->all(5);
    }

    public function show(Post $post)
    {
        return $this->repo->show($post);
    }

    public function store(PostRequest $request)
    {
        return $this->repo->store($request);
    }

    public function update(Post $post, PostRequest $request)
    {
        return $this->repo->update($post, $request);
    }

    public function destroy(Post $post)
    {
        return $this->repo->delete($post);
    }
}
