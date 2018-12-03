<?php

namespace App\Repositories;

use App\Post;
use Illuminate\Http\Request;

class PostsRepository
{
    public function delete(Post $post)
    {
        $post->tags()->sync([]);

        $post->delete();

        return [];
    }

    public function update(Post $post, Request $request)
    {
        $post->update($request->validated());

        $post->tags()->sync($request->tags);

        return $post;
    }

    public function store(Request $request)
    {
        $post = auth()->user()->posts()->create($request->validated());

        $post->tags()->sync($request->tags);

        return $post;
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function all($howMany = 10)
    {
        $posts = Post::with('user', 'category', 'tags')->latest();

        if ($year = request('year')) {
            $posts->whereYear('created_at', request('year'));
        }

        if ($month = request('month')) {
            $posts->whereMonth('created_at', Carbon::parse(request('month'))->month);
        }

        return $posts->paginate($howMany);
    }
}
