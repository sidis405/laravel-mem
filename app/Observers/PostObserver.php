<?php

namespace App\Observers;

use App\Post;
use App\Events\PostWasDeleted;
use App\Events\PostWasUpdated;

class PostObserver
{
    public function updated(Post $post)
    {
        event(new PostWasUpdated($post));
    }

    public function deleted(Post $post)
    {
        event(new PostWasDeleted($post));
    }
}
