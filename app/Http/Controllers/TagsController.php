<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;

class TagsController extends Controller
{
    public function __invoke(Tag $tag)
    {
        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('tag_id', $tag->id);
        })->with('user', 'category', 'tags')->latest()->paginate(15);

        return view('tags.show', compact('posts', 'tag'));
    }
}
