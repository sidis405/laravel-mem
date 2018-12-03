<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Repositories\TagsRepository;

class TagsController extends Controller
{
    public function __invoke(Tag $tag, TagsRepository $repo)
    {
        $posts = $repo->show($tag);

        return view('tags.show', compact('posts', 'tag'));
    }
}
