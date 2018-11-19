<?php

namespace App\Listeners;

use App\Events\PostWasUpdated;
use App\Jobs\NotifyForUpdatedPost;

class SendEmailListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostWasUpdated $event)
    {
        $post = $event->post;
        $author = $post->user;
        $user = auth()->user();

        $sender = null;
        $recipient = null;

        if (! ($user->isAdmin() && $post->isAuthoredBy($user))) {
            [$sender, $recipient] = ($user->isAdmin() && ! $post->isAuthoredBy($user)) ? [$user, $author] : [$author, $user];

            NotifyForUpdatedPost::dispatch($sender, $recipient, $post);
        }
    }
}
