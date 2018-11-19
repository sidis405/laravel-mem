<?php

namespace App\Listeners;

use App\Events\PostWasDeleted;
use App\Jobs\NotifyForDeletedPost;

class SendDeletedEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostWasDeleted  $event
     * @return void
     */
    public function handle(PostWasDeleted $event)
    {
        $post = $event->post;
        $title = $event->post->title;
        $recipient = $post->user;
        $sender = auth()->user();

        NotifyForDeletedPost::dispatch($recipient, $sender, $title);
    }
}
