<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use App\Http\Requests\PostRequest;
use App\Repositories\PostsRepository;

class PostsController extends Controller
{
    protected $repo;

    public function __construct(PostsRepository $repo)
    {
        $this->middleware('auth')->except('index', 'show');
        // $this->middleware('custom-manutenzione')->except('index', 'show');
        $this->middleware('can:update,post')->only('edit', 'update');
        $this->middleware('can:delete,post')->only('destroy');
        // $this->middleware('auth')->only('create', 'store', 'edit', 'udpate', 'delete');
        $this->repo = $repo;
    }

    public function index()
    {
        $posts = $this->repo->all(5);

        // if (request()->wantsJson() || request()->ajax()) {
        //     return $posts;
        // }

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show')->withPost($this->repo->show($post));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = new Post;

        return view('posts.create', compact('categories', 'tags', 'post'));
    }

    public function store(PostRequest $request)
    {
        $post = $this->repo->store($request);

        return redirect()->route('posts.show', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit', compact('categories', 'tags', 'post'));
    }

    public function update(Post $post, PostRequest $request)
    {
        $post = $this->repo->update($post, $request);

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $this->repo->delete($post);

        return redirect('/');
    }
}
