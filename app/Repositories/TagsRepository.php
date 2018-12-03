<?php

namespace App\Repositories;

use App\Tag;
use App\Post;

class TagsRepository
{
    public function show(Tag $tag)
    {
        return Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('tag_id', $tag->id);
        })->with('user', 'category', 'tags')->latest()->paginate(15);
    }
}
